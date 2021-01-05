<?php

if (!defined('ABSPATH')) {
    die('No direct access.');
}

/**
 * Class to handle analytics for MetaSlider. Will act more like a controller
 */
class MetaSlider_Analytics
{

    /**
     * @var Appsero\Insights $appsero
     */
    public $appsero;

    /**
     * @var array $whereToShow
     */
    public $whereToShow = array('plugins', 'dashboard');

    /**
     * Start various analytics systems
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: are we going to collect anything else like # slideshow, etc?
        // Since only one service for now, keep it simple and just load it directly
        $this->boot(
            apply_filters('metaslider_appsero_app_key', 'c3c10cf6-1a8f-4d7f-adf3-6bbbc5fe2885'),
            apply_filters('metaslider_appsero_app_name', 'MetaSlider'),
            apply_filters('metaslider_appsero_app_path', METASLIDER_PATH . 'ml-slider.php')
        );

        // Show notice only if they are not already opt in (pro will override this to show the opt-out notice once)
        add_action('admin_notices', array($this, 'showOptInNotice'));
        add_action('wp_ajax_handle_optin_action', array($this, 'handleOptinDismiss'));
        add_action('admin_enqueue_scripts', array($this, 'addAdminNonce'));
    }

    /**
     * Show the dang thing
     *
     * @return void
     */
    public function addAdminNonce()
    {
        wp_register_script('metaslider-optin-extra-js', '');
        wp_enqueue_script('metaslider-optin-extra-js');
        $nonce = wp_create_nonce('metaslider_optin_notice_nonce');
        $this->wp_add_inline_script(
            'metaslider-optin-extra-js',
            "window.metaslider_optin_notice_nonce = '{$nonce}'"
        );
    }

    /**
     * Show the dang thing
     *
     * @return void
     */
    public function showOptInNotice()
    {
        if (self::siteIsOptin()) {
            return;
        }
        $current_page = get_current_screen();
        if ($current_page && in_array($current_page->base, $this->whereToShow)) {
            if (!get_user_option('metaslider_optin_notice_dismissed') && !get_user_option('wp_metaslider_analytics_onboarding_status')) { ?>
            <div
                id="metaslider-optin-notice"
                class="notice updated"
                style="display:flex;align-items:stretch;justify-content:space-between;position:relative">
                <div style="display:flex;align-items:center;position:relative">
                    <img
                        src="<?php echo METASLIDER_BASE_URL.'admin/images/metaslider_logo.png'?>"
                        width="60" height="60"
                        style="margin-right:0.5rem;"
                        alt="<?php _e('MetaSlider Logo', 'ml-slider');?>" />
                    <div>
                        <h3 style="margin-bottom:0.25rem;"><?php _e('Thanks for using MetaSlider', 'ml-slider'); ?></h3>
                        <p style="max-width:850px;">
                            <?php printf(__('We are currently building the next version of MetaSlider. Can you help us out by sharing non-sensitive diagnostic information? We\'d also like to send you infrequent emails with important security and feature updates. See our %s for more details.', 'ml-slider'), '<a target="_blank" href="https://www.metaslider.com/privacy-policy">' . __('privacy policy', 'ml-slider') . '</a>'); ?>
                        </p>
                    </div>
                </div>
                <div style="display:flex;flex-direction:column;justify-content: space-between;align-items:flex-end;margin:8px 0 12px;">
                    <button
                        style="max-width:15px;border:0;background:0;color: #7b7b7b;white-space:nowrap;cursor: pointer;padding: 0"
                        title="Dismiss notice"
                        aria-label="Dismiss MetaSlider activation notice"
                        onclick="jQuery('#metaslider-optin-notice').remove();jQuery.post(window.ajaxurl, {action: 'handle_optin_action', activate: false, _wpnonce: metaslider_optin_notice_nonce });">
                        <svg style="width:100%" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <button class="button button-primary" onclick="jQuery('#metaslider-optin-notice').remove();jQuery.post(window.ajaxurl, {action: 'handle_optin_action', activate: true, _wpnonce: metaslider_optin_notice_nonce });"><?php _e('Agree', 'ml-slider'); ?></button>
                </div>
            </div>
        <?php }
        }
    }

    /**
     * Handle the skip on the notice
     *
     * @return void
     */
    public function handleOptinDismiss()
    {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'metaslider_optin_notice_nonce')) {
            wp_send_json_error(array(
                'message' => __('The security check failed. Please refresh the page and try again.', 'ml-slider')
            ), 401);
        }
        // They opted in, so we can instruct Appsero to communicate with the server
        if (isset($_REQUEST['activate']) && filter_var($_REQUEST['activate'], FILTER_VALIDATE_BOOLEAN)) {
            update_option('metaslider_optin_via', 'notice', true);
            $this->optin();
        }
        update_user_option(get_current_user_id(), 'metaslider_optin_notice_dismissed', time());
        wp_send_json_success();
    }

    /**
     * Start Appsero's insights client
     *
     * @var string $key - The app key
     * @var string $name - The app slug
     * @var string $path - The app path to main file
     *
     * @return MetaSlider_Analytics
     */
    public function boot($key, $name, $path)
    {
        if (is_multisite()) {
            return $this;
        }
        if (!class_exists('MSAppsero/Client')) {
            require_once(METASLIDER_PATH . 'lib/appsero/src/Client.php');
        }
        add_filter('ml-slider_tracker_data', array($this, 'filterTrackingData'));
        $client = new MSAppsero\Client($key, $name, $path);
        $this->appsero = $client->insights();
        return $this;
    }

    /**
     * Start Appsero's insights client
     *
     * @return void
     */
    public function load()
    {
        if (!$this->appsero) {
            return;
        }

        if (self::siteIsOptin()) {
            // If the user has opted in to sharing data with MetaSlider, we can skip the Appsero opt in
            // $this->appsero->hide_notice()->init()->optinIfNotAlready(); <-- would be nice
            $this->appsero->hide_notice()->add_extra(array($this, 'extraDataToCollect'))->init();
            if (get_option('ml-slider_allow_tracking') === 'no') {
                $this->appsero->optin();
            }
        } else {
            // Here we are hiding the notice for users that aren't opted in, because we are serving our own notices
            // We will make sure they are opted out from appsero too. Note, this initializes, but that's just for
            // showing the notice and doesn't do any actual tracking unless the user approves.
            $this->appsero->hide_notice()->add_extra(array($this, 'extraDataToCollect'))->init();
            if (get_option('ml-slider_allow_tracking') === 'yes') {
                $this->appsero->optout();
            }
        }
    }

    /**
     * Filter Appsero's data
     * - We want the user that opts in, not the first admin user
     *
     * @var array $data - The data from Appsero
     *
     * @return array
     */
    public function filterTrackingData($data)
    {
        if (!$extras = get_option('metaslider_optin_user_extras')) {
            return $data;
        }
        if ($admin_user = get_userdata($extras['id'])) {
            $data['admin_email'] = $admin_user->user_email;
            $data['first_name'] = $admin_user->first_name ? $admin_user->first_name : $admin_user->display_name;
            $data['last_name']  = $admin_user->last_name;
        }
        return $data;
    }

    /**
     * Add some extra fields - This is called async now so no need to cache it.
     *
     * @return void
     */
    public function extraDataToCollect()
    {
        try {
            $sliders_count = new WP_Query(array(
                'post_type' => 'ml-slider',
                'post_status' => array('inherit', 'publish'),
                'suppress_filters' => 1,
                'posts_per_page' => -1
            ));

            $date_activated = new DateTime();
            $date_activated->setTimestamp((int) get_option('ms_hide_all_ads_until'));
            $date_activated->modify('-2 week');
            $date_activated = $date_activated->getTimeStamp();
            $data = array(
                'has_pro_installed' => metaslider_pro_is_installed() ? metaslider_pro_version() : 'false',
                'cancelled_tour_on' => get_option('metaslider_tour_cancelled_on'),
                'optin_user_info' => get_option('metaslider_optin_user_extras'),
                'optin_via' => get_option('metaslider_optin_via'),
                'slider_count' => $sliders_count ? $sliders_count->found_posts : 0,
                'first_activated_on' => $date_activated > 0 ? $date_activated : 0
            );
            return $data;
        } catch (\Throwable $th) {
            return array();
        }
    }

    /**
     * Helper method for checking whether the site has opted in
     *
     * @return boolean
     */
    public static function siteIsOptin()
    {
        // Users of non-WP.org plugins can manage the opt in state manually here
        if (apply_filters('metaslider_force_optout', false)) {
            return self::updateOptinStatusTo(false);
        }
        if (apply_filters('metaslider_force_optin', false)) {
            return self::updateOptinStatusTo(true);
        }

        $settings = get_option('metaslider_global_settings');
        return isset($settings['optIn']) && (int) $settings['optIn'] > 0;
    }

    /**
     * Helper method for setting the opt in status
     *
     * @var string $status - Whether the user is opt in ('true') or opt out ('false')
     *
     * @return boolean - The same as $status
     */
    public static function updateOptinStatusTo($status)
    {
        $settings = get_option('metaslider_global_settings');

        $settings['optIn'] = filter_var($status, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        update_option('metaslider_global_settings', $settings, true);

        return filter_var($status, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Method to optin
     * Note: Need to init() before optin/optout
     *
     * @return void
     */
    public function optin()
    {
        $current_user = wp_get_current_user();
        update_option('metaslider_optin_user_extras', array(
            'id' => $current_user->ID,
            'email' => $current_user->user_email,
            'ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
            'time' => time()
        ));

        if ($this->appsero) {
            $this->appsero->hide_notice()->add_extra(array($this, 'extraDataToCollect'))->init();
            $this->appsero->optin();
        }

        self::updateOptinStatusTo('true');
    }

    /**
     * Method to optout
     * Note: Need to init() before optin/optout
     *
     * @return void
     */
    public function optout()
    {
        // We could possibly track who opted out, but for now just clear it
        update_option('metaslider_optin_user_extras', array());

        if ($this->appsero) {
            $this->appsero->hide_notice()->init();
            $this->appsero->optout();
        }

        self::updateOptinStatusTo('false');
    }

    /**
     * Polyfill to handle the wp_add_inline_script() function.
     *
     * @param  string $handle   The script identifier
     * @param  string $data     The script to add, without <script> tags
     * @param  string $position Whether to output before or after
     *
     * @return object|bool
     */
    public function wp_add_inline_script($handle, $data, $position = 'after')
    {
        if (function_exists('wp_add_inline_script')) {
            return wp_add_inline_script($handle, $data, $position);
        }
        global $wp_scripts;
        if (!$data) {
            return false;
        }

        // First fetch any existing scripts
        $script = $wp_scripts->get_data($handle, 'data');

        // Append to the end
        $script .= $data;

        return $wp_scripts->add_data($handle, 'data', $script);
    }
}
