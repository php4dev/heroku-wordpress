<?php
/*
 * Version: 1.2.2
 */



if (!class_exists('rpbwCommon')) {

	class rpbwCommon {

        public static $plugin_name = 'Remove "Powered by Wordpress"';
        public static $plugin_prefix = 'rpbw';
        public static $plugin_text_domain = 'remove-powered-by-wp';
        public static $plugin_premium_class = '';
        public static $plugin_trial = false;

		public static function plugin_version() {

            return remove_powered_by_wp_class::$version;

        }

        public static function enqueue_customize_controls_js() {

            wp_enqueue_script('webd-customize-controls', plugin_dir_url(__FILE__) . 'customize-controls.js', array('jquery', 'customize-controls'), self::plugin_version(), true);

        }

        public static function plugin_name() {

            return self::$plugin_name;

        }

        public static function plugin_prefix() {

            return self::$plugin_prefix;

        }

        public static function plugin_text_domain() {

            return self::$plugin_text_domain;

        }

        public static function plugin_trial() {

            return self::$plugin_trial;

        }

        public static function support_url() {

            return 'https://wordpress.org/support/plugin/' . self::$plugin_text_domain . '/';

        }

        public static function control_upgrade_text() {

            $upgrade_text = '<a href="' . self::upgrade_link() . '" title="' . sprintf(__('Upgrade now to %s Premium', self::$plugin_text_domain), self::$plugin_name) . '">' . sprintf(__('Upgrade now to %s Premium', self::$plugin_text_domain), self::$plugin_name) . '</a>';

            if (!class_exists(self::$plugin_premium_class) || !get_option(self::$plugin_prefix . '_purchased')) {

                if (!class_exists(self::$plugin_premium_class)) {

                    $upgrade_text .= sprintf(wp_kses(__(' or <a href="%s" title="Download Free Trial">trial it for 7 days</a>', self::$plugin_text_domain), array('a' => array('href' => array(), 'title' => array()))), esc_url(self::premium_link()));

                }

            }

            return $upgrade_text;

        }

        public static function control_section_description() {

            $default_description = sprintf(wp_kses(__('If you have any requests for new features, please <a href="%s" title="Support Forum">let us know in the support forum</a>.', self::$plugin_text_domain), array('a' => array('href' => array(), 'title' => array()))), esc_url(self::support_url()));

            $upgrade_text = self::control_upgrade_text() . '.';

            if (!class_exists(self::$plugin_premium_class) || !get_option(self::$plugin_prefix . '_purchased')) {

                if (!class_exists(self::$plugin_premium_class)) {

                    $section_description = '<strong>' . __('For even more options', self::$plugin_text_domain) . '</strong>' . ' ' . $upgrade_text;

                } else {

                    $section_description = '<strong>' . __('To keep using premium options', self::$plugin_text_domain) . '</strong>' . ' ' . $upgrade_text;

                }

            } else {

                $section_description = $default_description;

            }

            if (!class_exists('reset_customizer_class')) {

                $section_description .= ' ' . sprintf(
                    wp_kses(
                        __(
                            '<strong>To reset this section of options to default settings</strong> without affecting other sections in the customizer, install <a href="%s" title="Reset Customizer">Reset Customizer</a>.',
                            'options-for-twenty-twenty'
                        ),
                        array('strong' => array(), 'a' => array('href' => array(), 'title' => array()))
                    ),
                    esc_url(
                        add_query_arg(
                            array(
                                's' => 'reset+customizer+json+button+section+restore+deleted+publish+saved+injected',
                                'tab' => 'search',
                                'type' => 'term'
                            ),
                            self_admin_url('plugin-install.php')
                        )
                    )
                );

            }

            return $section_description;

        }

        public static function control_setting_upgrade_nag() {

            $upgrade_nag = self::control_upgrade_text() . __(' to use this option.', self::$plugin_text_domain);

            return $upgrade_nag;

        }

		public static function get_home_path() {

            if (!function_exists('get_home_path')) {

                require_once(ABSPATH . 'wp-admin/includes/file.php');

            }

            return get_home_path();

		}

        public static function add_hidden_control($wp_customize, $id, $section, $label = '', $description = '', $priority = 11) {

            $wp_customize->add_control($id, array(
                'label'         => $label,
                'description'   => $description,
                'section'       => $section,
                'settings'      => array(),
                'type'          => 'hidden',
				'priority'      => $priority
            ));

        }

		public static function sanitize_boolean($input = false) {

            if ($input) {

                return true;

            }

            return false;

        }

		public static function sanitize_options($input, $setting) {

            $choices = $setting->manager->get_control($setting->id)->choices;

            return (array_key_exists($input, $choices) ? $input : $setting->default);

        }

		public static function sanitize_multiple_options($input, $setting) {

            $valid_input = true;

            if ($input) {

                $input = explode(',', $input);

                $choices = $setting->manager->get_control($setting->id)->choices;

                foreach($input as $value) {

                    if (!array_key_exists($value, $choices)) {

                        $valid_input = false;

                    }

                }

            } else {

                $input = array('empty');

            }

            return ($valid_input ? $input : $setting->default);

        }

		public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $value = '') {

            $generated_css = '';
            $mod = get_theme_mod($mod_name);

            if ($mod && $value === '') {

                $generated_css = sprintf('%s { %s: %s; }', $selector, $style, $prefix.$mod.$postfix);
                echo $generated_css;

            } elseif ($mod) {

                $generated_css = sprintf('%s { %s:%s; }', $selector, $style, $prefix.$value.$postfix);
                echo $generated_css;

            }

        }

        public static function upgrade_link() {

            return add_query_arg('url', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'], 'https://webd.uk/product/' . self::$plugin_text_domain . '-' . (self::$plugin_premium_class ? 'upgrade' : 'contribution') . '/');

        }

        public static function premium_link() {

            return 'https://webd.uk/downloads/';

        }

        public static function plugin_action_links($settings_link, $premium = false) {

            $settings_links = array();

			$settings_links[] = '<a href="' . esc_url($settings_link) . '" title="' . __('Settings', self::$plugin_text_domain) . '">' . __('Settings', self::$plugin_text_domain) . '</a>';

            if (!get_option(self::$plugin_prefix . '_purchased')) {

                if ($premium) {

                    $settings_links[] = '<a href="' . self::upgrade_link() . '" title="' . sprintf(__('Buy %s Premium', self::$plugin_text_domain), self::$plugin_name) . '" style="color: orange; font-weight: bold;">' . __('Buy Now', self::$plugin_text_domain) . '</a>';

                } else {

                    $settings_links[] = '<a href="' . self::upgrade_link() . '" title="' . sprintf(__('Upgrade now to %s Premium', self::$plugin_text_domain), self::$plugin_name) . '" style="color: orange; font-weight: bold;">' . (self::$plugin_premium_class ? __('Upgrade', self::$plugin_text_domain) : __('Contribute', self::$plugin_text_domain)) . '</a>';

                }

                if ($premium) {

                    $settings_links[] = '<a href="' . wp_nonce_url('?activate-' . self::$plugin_prefix . '=true', self::$plugin_prefix . '_activate') . '" id="' . self::$plugin_prefix . '_activate_upgrade" title="' . __('Activate Purchase', self::$plugin_text_domain) . '" onclick="jQuery(this).append(&#39; <img src=&#34;/wp-admin/images/loading.gif&#34; style=&#34;float: none; width: auto; height: auto;&#34; />&#39;); setTimeout(function(){document.getElementById(\'' . self::$plugin_prefix . '_activate_upgrade\').removeAttribute(\'href\');},1); return true;">' . __('Activate Purchase', self::$plugin_text_domain) . '</a>';

                } elseif (self::$plugin_trial && !is_plugin_active(self::$plugin_text_domain . '-premium/' . self::$plugin_text_domain . '-premium.php')) {

                    $settings_links[] = '<a href="' . self::premium_link() . '" title="' . sprintf(__('Trial %s Premium', self::$plugin_text_domain), self::$plugin_name) . ' for 7 days">' . __('Download Trial', self::$plugin_text_domain) . '</a>';

                }

            } elseif ($premium) {

                $settings_links[] = '<strong style="color: green; display: inline;">' . __('Purchase Confirmed', self::$plugin_text_domain) . '</strong>';

            }

			return $settings_links;

		}

        public static function ajax_notice_handler() {

            check_ajax_referer(self::$plugin_prefix . '-ajax-nonce');

            if (current_user_can('manage_options')) {

                update_user_meta(get_current_user_id(), self::$plugin_prefix . '-notice-dismissed', self::plugin_version());

                if (isset($_REQUEST['donated']) && $_REQUEST['donated'] == 'true') {

    				update_option(self::$plugin_prefix . '_donated', true);

                }

            }

        }

        public static function admin_notices() {

            if (self::$plugin_premium_class) {

                if (get_option(self::$plugin_prefix . '_purchased') && !class_exists(self::$plugin_premium_class) && get_user_meta(get_current_user_id(), self::$plugin_prefix . '-notice-dismissed', true) != self::plugin_version()) {

?>

<div class="notice notice-error is-dismissible <?= self::$plugin_prefix; ?>-notice">

<p><strong><?= self::$plugin_name; ?></strong><br />
<?= __('In order to use the premium features, you need to install the premium version of the plugin ...', self::$plugin_text_domain); ?></p>

<p><a href="<?= self::premium_link(); ?>" title="<?= sprintf(__('Download %s Premium', self::$plugin_text_domain), self::$plugin_name); ?>" class="button-primary"><?= sprintf(__('Download %s Premium', self::$plugin_text_domain), self::$plugin_name); ?></a></p>

</div>

<script type="text/javascript">
    jQuery(document).on('click', '.<?= self::$plugin_prefix; ?>-notice .notice-dismiss', function() {
	    jQuery.ajax({
    	    url: ajaxurl,
    	    data: {
        		action: 'dismiss_<?= self::$plugin_prefix; ?>_notice_handler',
        		_ajax_nonce: '<?= wp_create_nonce(self::$plugin_prefix . '-ajax-nonce'); ?>'
    	    }
    	});
    });
</script>

<?php

                } elseif (!class_exists(self::$plugin_premium_class) && time() > (strtotime('+1 hour', filectime(__DIR__))) && get_user_meta(get_current_user_id(), self::$plugin_prefix . '-notice-dismissed', true) != self::plugin_version()) {

?>

<div class="notice notice-info is-dismissible <?= self::$plugin_prefix; ?>-notice">

<p><strong><?= sprintf(__('Thank you for using %s plugin', self::$plugin_text_domain), self::$plugin_name); ?></strong><br />
<?php

                    if (self::$plugin_trial == true) {

                        _e('Would you like to try even more features? Download your 7 day free trial now!', self::$plugin_text_domain); 

                    } else {

                        echo sprintf(__('Upgrade now to %s Premium to enable more options and features and contribute to the further development of this plugin.', self::$plugin_text_domain), self::$plugin_name);

                    }

?></p>

<p><?php

                    if (self::$plugin_trial == true) {

?>

<a href="<?= self::premium_link(); ?>" title="<?= sprintf(__('Try %s Premium', self::$plugin_text_domain), self::$plugin_name); ?>" class="button-primary"><?= sprintf(__('Trial %s Premium for 7 days', self::$plugin_text_domain), self::$plugin_name); ?></a>

<?php

                    }

?>
<a href="<?= self::upgrade_link(); ?>" title="<?= sprintf(__('Upgrade now to %s Premium', self::$plugin_text_domain), self::$plugin_name); ?>" class="button-primary"><?= sprintf(__('Upgrade now to %s Premium', self::$plugin_text_domain), self::$plugin_name); ?></a></p>

</div>

<script type="text/javascript">
    jQuery(document).on('click', '.<?= self::$plugin_prefix; ?>-notice .notice-dismiss', function() {
	    jQuery.ajax({
    	    url: ajaxurl,
    	    data: {
        		action: 'dismiss_<?= self::$plugin_prefix; ?>_notice_handler',
        		_ajax_nonce: '<?= wp_create_nonce(self::$plugin_prefix . '-ajax-nonce'); ?>'
    	    }
    	});
    });
</script>

<?php

                }

            } elseif (time() > (strtotime('+1 hour', filectime(__DIR__))) && get_user_meta(get_current_user_id(), self::$plugin_prefix . '-notice-dismissed', true) != self::plugin_version() && !get_option(self::$plugin_prefix . '_donated')) {

?>

<div class="notice notice-info is-dismissible <?= self::$plugin_prefix; ?>-notice">
<p><strong><?= sprintf(__('Thank you for using %s plugin', self::$plugin_text_domain), self::$plugin_name); ?></strong></p>
<?php

                do_action(self::$plugin_prefix . '_admin_notice_donate');

?>
<p><?= __('Funding plugins like this one with small financial contributions is essential to pay for the developers to continue to do what they do. Please take a moment to give a small amount ...', self::$plugin_text_domain); ?></p>
<p><a href="<?= self::upgrade_link(); ?>" title="<?= sprintf(__('Contribute to %s', self::$plugin_text_domain), self::$plugin_name); ?>" class="button-primary"><?= sprintf(__('Contribute to %s', self::$plugin_text_domain), self::$plugin_name); ?></a> <a href="#" id="<?= self::$plugin_prefix; ?>-already-paid" title="<?= __('Aleady Contributed!', self::$plugin_text_domain); ?>" class="button-primary"><?= __('Aleady Contributed!', self::$plugin_text_domain); ?></a></p>
</div>

<script type="text/javascript">
    jQuery(document).on('click', '#<?= self::$plugin_prefix; ?>-already-paid', function() {
        if (confirm(<?= json_encode(__('Have you really? Press "Cancel" for a coupon code 🙂', self::$plugin_text_domain)); ?>)) {
            alert(<?= json_encode(__('Thank you!', self::$plugin_text_domain)); ?>);
            jQuery('.<?= self::$plugin_prefix; ?>-notice').fadeTo(100, 0, function() {
                jQuery('.<?= self::$plugin_prefix; ?>-notice').slideUp(100, function() {
                    jQuery('.<?= self::$plugin_prefix; ?>-notice').remove()
                });
            });
            jQuery.ajax({
            	url: ajaxurl,
            	data: {
                	action: 'dismiss_<?= self::$plugin_prefix; ?>_notice_handler',
            	    donated: 'true',
        		    _ajax_nonce: '<?= wp_create_nonce(self::$plugin_prefix . '-ajax-nonce'); ?>'
            	}
        	});
        } else {
            alert(<?= json_encode(__('Use coupon code DONATE for 50% discount 🙂', self::$plugin_text_domain)); ?>);
            window.location.assign('<?= self::upgrade_link(); ?>');
        }
    });
    jQuery(document).on('click', '.<?= self::$plugin_prefix; ?>-notice .notice-dismiss', function() {
    	jQuery.ajax({
    	    url: ajaxurl,
    	    data: {
        		action: 'dismiss_<?= self::$plugin_prefix; ?>_notice_handler',
        		_ajax_nonce: '<?= wp_create_nonce(self::$plugin_prefix . '-ajax-nonce'); ?>'
    	    }
	    });
    });
</script>

<?php

            }

        }

	}

}

if (!function_exists('webd_customize_register')) {

	function webd_customize_register($wp_customize) {

		if (!class_exists('webd_Customize_Control_Checkbox_Multiple')) {

		    class webd_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

		        public $type = 'checkbox-multiple';

		        public function render_content() {

		            if ($this->choices) {

		                if ($this->label) {

?>
<span class="customize-control-title"><?= esc_html($this->label); ?></span>
<?php

		                }

		                if ($this->description) {

?>
<span class="description customize-control-description"><?= $this->description; ?></span>
<?php

		                }

		                $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value();

?>
<ul>
<?php

		                foreach ($this->choices as $value => $label) {

?>
    <li>
        <label>
            <input type="checkbox" value="<?= esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> /><?= esc_html($label); ?>
        </label>
    </li>
<?php

		                }

?>
        </ul>
        <input type="hidden" <?php $this->link(); ?> value="<?= esc_attr(implode(',', $multi_values)); ?>" />
<?php

		            }

		        }

		    }

		}

	}

}
	
?>
