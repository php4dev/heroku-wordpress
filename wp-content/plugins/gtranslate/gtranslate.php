<?php
/*
Plugin Name: GTranslate
Plugin URI: https://gtranslate.io/?xyz=998
Description: Makes your website <strong>multilingual</strong> and available to the world using Google Translate. For support visit <a href="https://wordpress.org/support/plugin/gtranslate">GTranslate Support</a>.
Version: 2.8.61
Author: Translate AI Multilingual Solutions
Author URI: https://gtranslate.io
Text Domain: gtranslate

*/

/*  Copyright 2010 - 2020 Edvard Ananyan  (email : edo888@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('widgets_init', array('GTranslate', 'register'));
register_activation_hook(__FILE__, array('GTranslate', 'activate'));
register_deactivation_hook(__FILE__, array('GTranslate', 'deactivate'));
add_filter('plugin_action_links_' . plugin_basename(__FILE__), array('GTranslate', 'settings_link'));
add_action('admin_menu', array('GTranslate', 'admin_menu'));
add_action('init', array('GTranslate', 'enqueue_scripts'));
add_action('plugins_loaded', array('GTranslate', 'load_textdomain'));
add_shortcode('GTranslate', array('GTranslate', 'get_widget_code'));
add_shortcode('gtranslate', array('GTranslate', 'get_widget_code'));

class GTranslate extends WP_Widget {
    public static function activate() {
        $data = array(
            'gtranslate_title' => __('Website Translator', 'gtranslate'),
        );
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        add_option('GTranslate', $data);
    }

    public static function deactivate() {
        // delete_option('GTranslate');
    }

    public static function settings_link($links) {
        $settings_link = array('<a href="' . admin_url('options-general.php?page=gtranslate_options') . '">'.__('Settings', 'gtranslate').'</a>');
        return array_merge($links, $settings_link);
    }

    public static function control() {
        $data = get_option('GTranslate');
        ?>
        <p><label><?php _e('Title', 'gtranslate'); ?>: <input name="gtranslate_title" type="text" class="widefat" value="<?php echo $data['gtranslate_title']; ?>"/></label></p>
        <p><?php _e('Please go to <a href="' . admin_url('options-general.php?page=gtranslate_options') . '">'.__('GTranslate Settings', 'gtranslate').'</a> for configuration.', 'gtranslate'); ?></p>
        <?php
        if (isset($_POST['gtranslate_title'])){
            $data['gtranslate_title'] = esc_attr($_POST['gtranslate_title']);
            update_option('GTranslate', $data);
        }
    }

    public static function enqueue_scripts() {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        wp_enqueue_style( 'gtranslate-style', plugins_url('gtranslate-style'.$data['flag_size'].'.css', __FILE__) );
        wp_enqueue_script('jquery');

        // make sure main_lang is set correctly in config.php file
        if($data['pro_version'] or $data['enterprise_version']) {
            include dirname(__FILE__) . '/url_addon/config.php';

            if($main_lang != $data['default_language']) { // update main_lang in config.php
                $config_file = dirname(__FILE__) . '/url_addon/config.php';
                if(is_writable($config_file)) {
                    $config = file_get_contents($config_file);
                    $config = preg_replace('/\$main_lang = \'[a-z-]{2,5}\'/i', '$main_lang = \''.$data['default_language'].'\'', $config);
                    file_put_contents($config_file, $config);
                }
            }
        }
    }

    public static function load_textdomain() {
        load_plugin_textdomain('gtranslate');

        // set correct language direction
        global $text_direction;
        if(isset($_SERVER['HTTP_X_GT_LANG']) and in_array($_SERVER['HTTP_X_GT_LANG'], array('ar', 'iw', 'fa')))
            $text_direction = 'rtl';
        elseif(isset($_SERVER['HTTP_X_GT_LANG']))
            $text_direction = 'ltr';
    }

    public function widget($args, $instance) {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        echo $args['before_widget'];
        echo $args['before_title'] . $data['gtranslate_title'] . $args['after_title'];
        if(empty($data['widget_code']))
            _e('<b>Notice:</b> Please configure GTranslate from WP-Admin -> Settings -> GTranslate to see it in action.', 'gtranslate');
        else
            echo $data['widget_code'];

        // avoid caching issues
        if($data['widget_look'] == 'dropdown_with_flags' and ($data['pro_version'] or $data['enterprise_version'])) {
            echo '<script>jQuery(document).ready(function() {var lang_html = jQuery(".switcher div.option a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'.switcher div.selected a\').html(lang_html.replace("data-gt-lazy-", ""))});</script>';
        } elseif($data['widget_look'] == 'popup' and ($data['pro_version'] or $data['enterprise_version'])) {
            echo '<script>jQuery(document).ready(function() {var lang_html = jQuery(".gt_languages a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');});</script>';
        }

        // detect browser language
        if(!($data['pro_version'] or $data['enterprise_version']) and $data['detect_browser_language']) {
            if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
                $allowed_languages = $data['fincl_langs'];
            elseif($data['widget_look'] == 'flags_dropdown')
                $allowed_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
            else
                $allowed_languages = $data['incl_langs'];
            $allowed_languages = json_encode($allowed_languages);

            echo "<script>jQuery(document).ready(function() {";
            echo "var allowed_languages = $allowed_languages;var accept_language = navigator.language.toLowerCase() || navigator.userLanguage.toLowerCase();switch(accept_language) {case 'zh-cn': var preferred_language = 'zh-CN'; break;case 'zh': var preferred_language = 'zh-CN'; break;case 'zh-tw': var preferred_language = 'zh-TW'; break;case 'zh-hk': var preferred_language = 'zh-TW'; break;default: var preferred_language = accept_language.substr(0, 2); break;}if(preferred_language != '".$data['default_language']."' && GTranslateGetCurrentLang() == null && document.cookie.match('gt_auto_switch') == null && allowed_languages.indexOf(preferred_language) >= 0){doGTranslate('".$data['default_language']."|'+preferred_language);document.cookie = 'gt_auto_switch=1; expires=Thu, 05 Dec 2030 08:08:08 UTC; path=/;';";
            if($data['widget_look'] == 'dropdown_with_flags') {
                echo "var lang_html = jQuery('div.switcher div.option').find('img[alt=\"'+preferred_language+'\"]').parent().html();if(typeof lang_html != 'undefined')jQuery('div.switcher div.selected a').html(lang_html.replace('data-gt-lazy-', ''));";
            } elseif($data['widget_look'] == 'popup') {
                echo 'var lang_html = jQuery(".gt_languages a[onclick*=\'|"+preferred_language+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');';
            }
            echo "}});</script>";
        }

        echo $args['after_widget'];
    }

    public static function widget2($args) {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        echo $args['before_widget'];
        echo $args['before_title'] . $data['gtranslate_title'] . $args['after_title'];
        if(empty($data['widget_code']))
            _e('<b>Notice:</b> Please configure GTranslate from WP-Admin -> Settings -> GTranslate to see it in action.', 'gtranslate');
        else
            echo $data['widget_code'];

        // avoid caching issues
        if($data['widget_look'] == 'dropdown_with_flags' and ($data['pro_version'] or $data['enterprise_version'])) {
            echo '<script>jQuery(document).ready(function() {var lang_html = jQuery(".switcher div.option a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'.switcher div.selected a\').html(lang_html.replace("data-gt-lazy-", ""))});</script>';
        } elseif($data['widget_look'] == 'popup' and ($data['pro_version'] or $data['enterprise_version'])) {
            echo '<script>jQuery(document).ready(function() {var lang_html = jQuery(".gt_languages a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');});</script>';
        }

        // detect browser language
        if(!($data['pro_version'] or $data['enterprise_version']) and $data['detect_browser_language']) {
            if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
                $allowed_languages = $data['fincl_langs'];
            elseif($data['widget_look'] == 'flags_dropdown')
                $allowed_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
            else
                $allowed_languages = $data['incl_langs'];
            $allowed_languages = json_encode($allowed_languages);

            echo "<script>jQuery(document).ready(function() {";
            echo "var allowed_languages = $allowed_languages;var accept_language = navigator.language.toLowerCase() || navigator.userLanguage.toLowerCase();switch(accept_language) {case 'zh-cn': var preferred_language = 'zh-CN'; break;case 'zh': var preferred_language = 'zh-CN'; break;case 'zh-tw': var preferred_language = 'zh-TW'; break;case 'zh-hk': var preferred_language = 'zh-TW'; break;default: var preferred_language = accept_language.substr(0, 2); break;}if(preferred_language != '".$data['default_language']."' && GTranslateGetCurrentLang() == null && document.cookie.match('gt_auto_switch') == null && allowed_languages.indexOf(preferred_language) >= 0){doGTranslate('".$data['default_language']."|'+preferred_language);document.cookie = 'gt_auto_switch=1; expires=Thu, 05 Dec 2030 08:08:08 UTC; path=/;';";
            if($data['widget_look'] == 'dropdown_with_flags') {
                echo "var lang_html = jQuery('div.switcher div.option').find('img[alt=\"'+preferred_language+'\"]').parent().html();if(typeof lang_html != 'undefined')jQuery('div.switcher div.selected a').html(lang_html.replace('data-gt-lazy-', ''));";
            } elseif($data['widget_look'] == 'popup') {
                echo 'var lang_html = jQuery(".gt_languages a[onclick*=\'|"+preferred_language+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');';
            }
            echo "}});</script>";
        }

        echo $args['after_widget'];
    }

    public static function get_widget_code($atts) {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        if(empty($data['widget_code']))
            return __('<b>Notice:</b> Please configure GTranslate from WP-Admin -> Settings -> GTranslate to see it in action.', 'gtranslate');
        else {

            // avoid caching issues
            if($data['widget_look'] == 'dropdown_with_flags' and ($data['pro_version'] or $data['enterprise_version'])) {
                $data['widget_code'] .= '<script>jQuery(document).ready(function() {var lang_html = jQuery(".switcher div.option a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'.switcher div.selected a\').html(lang_html.replace("data-gt-lazy-", ""))});</script>';
            } elseif($data['widget_look'] == 'popup' and ($data['pro_version'] or $data['enterprise_version'])) {
                $data['widget_code'] .= '<script>jQuery(document).ready(function() {var lang_html = jQuery(".gt_languages a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');});</script>';
            }

            //$_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'ru-Ru'; // debug

            // detect browser language
            if(!($data['pro_version'] or $data['enterprise_version']) and $data['detect_browser_language']) {
                if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
                    $allowed_languages = $data['fincl_langs'];
                elseif($data['widget_look'] == 'flags_dropdown')
                    $allowed_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
                else
                    $allowed_languages = $data['incl_langs'];
                $allowed_languages = json_encode($allowed_languages);

                $data['widget_code'] .= "<script>jQuery(document).ready(function() {";
                $data['widget_code'] .= "var allowed_languages = $allowed_languages;var accept_language = navigator.language.toLowerCase() || navigator.userLanguage.toLowerCase();switch(accept_language) {case 'zh-cn': var preferred_language = 'zh-CN'; break;case 'zh': var preferred_language = 'zh-CN'; break;case 'zh-tw': var preferred_language = 'zh-TW'; break;case 'zh-hk': var preferred_language = 'zh-TW'; break;default: var preferred_language = accept_language.substr(0, 2); break;}if(preferred_language != '".$data['default_language']."' && GTranslateGetCurrentLang() == null && document.cookie.match('gt_auto_switch') == null && allowed_languages.indexOf(preferred_language) >= 0){doGTranslate('".$data['default_language']."|'+preferred_language);document.cookie = 'gt_auto_switch=1; expires=Thu, 05 Dec 2030 08:08:08 UTC; path=/;';";
                if($data['widget_look'] == 'dropdown_with_flags') {
                    $data['widget_code'] .= "var lang_html = jQuery('div.switcher div.option').find('img[alt=\"'+preferred_language+'\"]').parent().html();if(typeof lang_html != 'undefined')jQuery('div.switcher div.selected a').html(lang_html.replace('data-gt-lazy-', ''));";
                } elseif($data['widget_look'] == 'popup') {
                    $data['widget_code'] .= 'var lang_html = jQuery(".gt_languages a[onclick*=\'|"+preferred_language+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');';
                }
                $data['widget_code'] .= "}});</script>";
            }

            return $data['widget_code'];
        }
    }

    public static function register() {
        register_widget('GTranslateWidget');
    }

    public static function admin_menu() {
        add_options_page(__('GTranslate Options', 'gtranslate'), 'GTranslate', 'administrator', 'gtranslate_options', array('GTranslate', 'options'));

    }

    public static function options() {
        ?>
        <div class="wrap">
        <div id="icon-options-general" class="icon32"><br/></div>
        <h2><img src="<?php echo plugins_url('gt_logo.svg', __FILE__); ?>" border="0" title="<?php _e('GTranslate - your window to the world', 'gtranslate'); ?>" alt="G|translate" height="70"></h2>
        <?php
        if(isset($_POST['save']) and $_POST['save'])
            GTranslate::control_options();
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-effects-core');

        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style( 'wp-color-picker');
        wp_add_inline_script('wp-color-picker', 'jQuery(document).ready(function($) {$(".color-field").wpColorPicker({change:function(e,c){$("#"+e.target.getAttribute("id")+"_hidden").val(c.color.toString());e.target.value = c.color.toString();RefreshDoWidgetCode();}});});');

        /* code editor for widget_code textarea
        if(function_exists('wp_enqueue_code_editor')) {
            $editor_settings = wp_enqueue_code_editor(array('type' => 'text/html'));
            if($editor_settings !== false)
                wp_add_inline_script('code-editor', sprintf('jQuery(function() {wp.codeEditor.initialize("widget_code", %s);});', wp_json_encode($editor_settings)));
        }
        */

        $site_url = site_url();
        $wp_plugin_url = preg_replace('/^https?:/i', '', plugins_url() . '/gtranslate');

        extract($data);

        $gt_lang_array_json = '{"af":"Afrikaans","sq":"Albanian","am":"Amharic","ar":"Arabic","hy":"Armenian","az":"Azerbaijani","eu":"Basque","be":"Belarusian","bn":"Bengali","bs":"Bosnian","bg":"Bulgarian","ca":"Catalan","ceb":"Cebuano","ny":"Chichewa","zh-CN":"Chinese (Simplified)","zh-TW":"Chinese (Traditional)","co":"Corsican","hr":"Croatian","cs":"Czech","da":"Danish","nl":"Dutch","en":"English","eo":"Esperanto","et":"Estonian","tl":"Filipino","fi":"Finnish","fr":"French","fy":"Frisian","gl":"Galician","ka":"Georgian","de":"German","el":"Greek","gu":"Gujarati","ht":"Haitian Creole","ha":"Hausa","haw":"Hawaiian","iw":"Hebrew","hi":"Hindi","hmn":"Hmong","hu":"Hungarian","is":"Icelandic","ig":"Igbo","id":"Indonesian","ga":"Irish","it":"Italian","ja":"Japanese","jw":"Javanese","kn":"Kannada","kk":"Kazakh","km":"Khmer","ko":"Korean","ku":"Kurdish (Kurmanji)","ky":"Kyrgyz","lo":"Lao","la":"Latin","lv":"Latvian","lt":"Lithuanian","lb":"Luxembourgish","mk":"Macedonian","mg":"Malagasy","ms":"Malay","ml":"Malayalam","mt":"Maltese","mi":"Maori","mr":"Marathi","mn":"Mongolian","my":"Myanmar (Burmese)","ne":"Nepali","no":"Norwegian","ps":"Pashto","fa":"Persian","pl":"Polish","pt":"Portuguese","pa":"Punjabi","ro":"Romanian","ru":"Russian","sm":"Samoan","gd":"Scottish Gaelic","sr":"Serbian","st":"Sesotho","sn":"Shona","sd":"Sindhi","si":"Sinhala","sk":"Slovak","sl":"Slovenian","so":"Somali","es":"Spanish","su":"Sudanese","sw":"Swahili","sv":"Swedish","tg":"Tajik","ta":"Tamil","te":"Telugu","th":"Thai","tr":"Turkish","uk":"Ukrainian","ur":"Urdu","uz":"Uzbek","vi":"Vietnamese","cy":"Welsh","xh":"Xhosa","yi":"Yiddish","yo":"Yoruba","zu":"Zulu"}';
        $gt_lang_array = get_object_vars(json_decode($gt_lang_array_json));
        include dirname(__FILE__) . '/native_names_map.php'; // defines $native_names_map array
        //echo '<pre>' . print_r($native_names_map, true) . '</pre>';
        $gt_lang_array_native_json = json_encode($native_names_map);

        if(!empty($language_codes))
            $gt_lang_codes_json = json_encode(explode(',', $language_codes));
        else
            $gt_lang_codes_json = '[]';

        if(!empty($language_codes2))
            $gt_lang_codes2_json = json_encode(explode(',', $language_codes2));
        else
            $gt_lang_codes2_json = '[]';

$script = <<<EOT

var gt_lang_array_english = $gt_lang_array_json;
var gt_lang_array_native = $gt_lang_array_native_json;
var gt_lang_array = gt_lang_array_english;
var languages = [], language_codes = $gt_lang_codes_json, language_codes2 = $gt_lang_codes2_json;

//for(var key in gt_lang_array)
//  languages.push(gt_lang_array[key]);
if(language_codes.length == 0)
    for(var key in gt_lang_array)
        language_codes.push(key);
if(language_codes2.length == 0)
    for(var key in gt_lang_array)
        language_codes2.push(key);

var languages_map = {en_x: 0, en_y: 0, ar_x: 100, ar_y: 0, bg_x: 200, bg_y: 0, zhCN_x: 300, zhCN_y: 0, zhTW_x: 400, zhTW_y: 0, hr_x: 500, hr_y: 0, cs_x: 600, cs_y: 0, da_x: 700, da_y: 0, nl_x: 0, nl_y: 100, fi_x: 100, fi_y: 100, fr_x: 200, fr_y: 100, de_x: 300, de_y: 100, el_x: 400, el_y: 100, hi_x: 500, hi_y: 100, it_x: 600, it_y: 100, ja_x: 700, ja_y: 100, ko_x: 0, ko_y: 200, no_x: 100, no_y: 200, pl_x: 200, pl_y: 200, pt_x: 300, pt_y: 200, ro_x: 400, ro_y: 200, ru_x: 500, ru_y: 200, es_x: 600, es_y: 200, sv_x: 700, sv_y: 200, ca_x: 0, ca_y: 300, tl_x: 100, tl_y: 300, iw_x: 200, iw_y: 300, id_x: 300, id_y: 300, lv_x: 400, lv_y: 300, lt_x: 500, lt_y: 300, sr_x: 600, sr_y: 300, sk_x: 700, sk_y: 300, sl_x: 0, sl_y: 400, uk_x: 100, uk_y: 400, vi_x: 200, vi_y: 400, sq_x: 300, sq_y: 400, et_x: 400, et_y: 400, gl_x: 500, gl_y: 400, hu_x: 600, hu_y: 400, mt_x: 700, mt_y: 400, th_x: 0, th_y: 500, tr_x: 100, tr_y: 500, fa_x: 200, fa_y: 500, af_x: 300, af_y: 500, ms_x: 400, ms_y: 500, sw_x: 500, sw_y: 500, ga_x: 600, ga_y: 500, cy_x: 700, cy_y: 500, be_x: 0, be_y: 600, is_x: 100, is_y: 600, mk_x: 200, mk_y: 600, yi_x: 300, yi_y: 600, hy_x: 400, hy_y: 600, az_x: 500, az_y: 600, eu_x: 600, eu_y: 600, ka_x: 700, ka_y: 600, ht_x: 0, ht_y: 700, ur_x: 100, ur_y: 700};

function RefreshDoWidgetCode() {
    var new_line = "\\n";
    var widget_preview = '<!-- GTranslate: https://gtranslate.io/ -->'+new_line;
    var widget_code = '';
    var translation_method = 'onfly';
    var widget_look = jQuery('#widget_look').val();
    var default_language = jQuery('#default_language').val();
    var flag_size = jQuery('#flag_size').val();
    var monochrome_flags = jQuery('#monochrome_flags:checked').length > 0 ? true : false;
    var pro_version = jQuery('#pro_version:checked').length > 0 ? true : false;
    var enterprise_version = jQuery('#enterprise_version:checked').length > 0 ? true : false;
    var new_window = jQuery('#new_window:checked').length > 0 ? true : false;
    var show_in_menu = jQuery('#show_in_menu').val();
    var floating_language_selector = jQuery('#floating_language_selector').val();
    var native_language_names = jQuery('#native_language_names:checked').length > 0 ? true : false;
    var analytics = jQuery('#analytics:checked').length > 0 ? true : false;
    var detect_browser_language = jQuery('#detect_browser_language:checked').length > 0 ? true : false;
    var email_translation = jQuery('#email_translation:checked').length > 0 ? true : false;
    var switcher_text_color = jQuery('#switcher_text_color').val();
    var switcher_arrow_color = jQuery('#switcher_arrow_color').val();
    var switcher_border_color = jQuery('#switcher_border_color').val();
    var switcher_background_color = jQuery('#switcher_background_color').val();
    var switcher_background_shadow_color = jQuery('#switcher_background_shadow_color').val();
    var switcher_background_hover_color = jQuery('#switcher_background_hover_color').val();
    var dropdown_text_color = jQuery('#dropdown_text_color').val();
    var dropdown_hover_color = jQuery('#dropdown_hover_color').val();
    var dropdown_background_color = jQuery('#dropdown_background_color').val();

    // make sure default language is on
    if(widget_look == 'flags_dropdown' || widget_look == 'dropdown_with_flags' || widget_look == 'flags' || widget_look == 'flags_name' || widget_code == 'flags_code' || widget_look == 'popup')
        jQuery('#fincl_langs'+default_language).prop('checked', true);
    if(widget_look == 'dropdown' || widget_look == 'globe' || widget_look == 'lang_names' || widget_look == 'lang_codes')
        jQuery('#incl_langs'+default_language).prop('checked', true);

    if(pro_version || enterprise_version) {
        translation_method = 'redirect';
        jQuery('#new_window_option').show();
        jQuery('#url_translation_option').show();
        jQuery('#hreflang_tags_option').show();
        jQuery('#email_translation_option').show();
        if(email_translation)
            jQuery('#email_translation_debug_option').show();
        //jQuery('#auto_switch_option').hide();
    } else {
        jQuery('#new_window_option').hide();
        jQuery('#url_translation_option').hide();
        jQuery('#hreflang_tags_option').hide();
        jQuery('#email_translation_option').hide();
        jQuery('#email_translation_debug_option').hide();
        //jQuery('#auto_switch_option').show();
    }

    if(widget_look == 'dropdown' || widget_look == 'flags_dropdown' || widget_look == 'globe' || widget_look == 'lang_names' || widget_look == 'lang_codes') {
        jQuery('#dropdown_languages_option').show();
    } else {
        jQuery('#dropdown_languages_option').hide();
    }

    if(widget_look == 'globe') {
        jQuery('#alternative_flags_option').show();
    } else {
        jQuery('#alternative_flags_option').hide();
    }

    if(widget_look == 'flags' || widget_look == 'flags_dropdown' || widget_look == 'dropdown_with_flags' || widget_look == 'flags_name' || widget_look == 'flags_code' || widget_look == 'popup') {
        jQuery('#flag_languages_option').show();
        jQuery('#alternative_flags_option').show();
    } else {
        jQuery('#flag_languages_option').hide();
        if(widget_look != 'globe')
            jQuery('#alternative_flags_option').hide();
    }

    if(widget_look == 'flags_dropdown') {
        jQuery('#line_break_option').show();
    } else {
        jQuery('#line_break_option').hide();
    }

    if(widget_look == 'dropdown' || widget_look == 'lang_names' || widget_look == 'lang_codes' || widget_look == 'globe') {
        jQuery('#flag_size_option,#flag_monochrome_option').hide();
    } else {
        jQuery('#flag_size_option,#flag_monochrome_option').show();
    }

    if(widget_look == 'dropdown_with_flags') {
        jQuery('.switcher_color_options').show();
    } else {
        jQuery('.switcher_color_options').hide();
    }

    if(native_language_names) {
        gt_lang_array = gt_lang_array_native;
        jQuery('.en_names').hide();
        jQuery('.native_names').show();
    } else {
        gt_lang_array = gt_lang_array_english;
        jQuery('.native_names').hide();
        jQuery('.en_names').show();
    }

    if(pro_version && enterprise_version)
        pro_version = false;

    if(translation_method == 'on_fly' || translation_method == 'redirect' || translation_method == 'onfly') {
        // Adding flags and names
        if(widget_look == 'flags' || widget_look == 'flags_dropdown' || widget_look == 'flags_name' || widget_look == 'flags_code' || widget_look == 'lang_names' || widget_look == 'lang_codes') {
            jQuery.each(((widget_look == 'flags' || widget_look == 'flags_dropdown' || widget_look == 'flags_name' || widget_look == 'flags_code') ? language_codes : language_codes2), function(i, val) {
                lang = (widget_look == 'flags' || widget_look == 'flags_dropdown' || widget_look == 'flags_name' || widget_look == 'flags_code') ? language_codes[i] : language_codes2[i];
                if(widget_look == 'lang_names' || widget_look == 'lang_codes')
                    chklist = '#incl_langs';
                else
                    chklist = '#fincl_langs';
                if(jQuery(chklist+lang+':checked').length) {
                    lang_name = gt_lang_array[lang];

                    var href = '#';
                    if(pro_version) {
                        href = (lang == default_language) ? '$site_url' : '$site_url'.replace('$site_url'.split('/').slice(0, 3).join('/'), '$site_url'.split('/').slice(0, 3).join('/')+'/'+lang);
                        if(lang != default_language && href.endsWith('/'+lang)) href += '/';
                    } else if(enterprise_version)
                        href = (lang == default_language) ? '$site_url' : '$site_url'.replace('$site_url'.split('/').slice(2, 3)[0].replace('www.', ''), lang + '.' + '$site_url'.split('/').slice(2, 3)[0].replace('www.', '')).replace('://www.', '://');

                    widget_preview += '<a href="'+href+'" onclick="doGTranslate(\''+default_language+'|'+lang+'\');return false;" title="'+lang_name+'" class="glink nturl notranslate">';

                    //adding language flag
                    if(widget_look == 'flags' || widget_look == 'flags_dropdown' || widget_look == 'flags_name' || widget_look == 'flags_code') {
                        if(lang == 'en' && jQuery('#alt_us:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/en-us.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else if(lang == 'en' && jQuery('#alt_ca:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/en-ca.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else if(lang == 'pt' && jQuery('#alt_br:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/pt-br.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else if(lang == 'es' && jQuery('#alt_mx:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-mx.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else if(lang == 'es' && jQuery('#alt_ar:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-ar.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else if(lang == 'es' && jQuery('#alt_co:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-co.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else if(lang == 'fr' && jQuery('#alt_qc:checked').length)
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/fr-qc.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                        else
                            widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/'+lang+'.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang_name+'" />';
                    }

                    // adding language name/code
                    if(widget_look == 'flags_name')
                        widget_preview += ' <span>'+lang_name+'</span></a> ';
                    else if(widget_look == 'lang_names')
                        widget_preview += lang_name+'</a> ';
                    else if(widget_look == 'flags_code')
                        widget_preview += ' <span>'+lang.toUpperCase()+'</span></a> ';
                    else if(widget_look == 'lang_codes')
                        widget_preview += lang.toUpperCase()+'</a> ';
                    else if(widget_look == 'flags')
                        widget_preview += '</a>';
                    else if(widget_look == 'flags_dropdown')
                        widget_preview += '</a>';
                }
            });
        }

        // Adding dropdown
        if(widget_look == 'dropdown' || widget_look == 'flags_dropdown') {
            if((widget_look == 'flags' || widget_look == 'flags_dropdown') && jQuery('#add_new_line:checked').length)
                widget_preview += '<br />';
            else
                widget_preview += ' ';
            widget_preview += '<select onchange="doGTranslate(this);" class="notranslate" id="gtranslate_selector" aria-label="Website Language Selector">';

            widget_preview += '<option value="">Select Language</option>';
            jQuery.each(language_codes2, function(i, val) {
                lang = language_codes2[i];
                if(jQuery('#incl_langs'+lang+':checked').length) {
                    lang_name = gt_lang_array[lang];
                    widget_preview += '<option value="'+default_language+'|'+lang+'">'+lang_name+'</option>';
                }
            });
            widget_preview += '</select>';
        }

        // Adding onfly html and css
        if(translation_method == 'onfly') {
            widget_code += '<style>'+new_line;
            widget_code += "#goog-gt-tt {display:none !important;}"+new_line;
            widget_code += ".goog-te-banner-frame {display:none !important;}"+new_line;
            widget_code += ".goog-te-menu-value:hover {text-decoration:none !important;}"+new_line;
            widget_code += ".goog-text-highlight {background-color:transparent !important;box-shadow:none !important;}"+new_line;
            widget_code += "body {top:0 !important;}"+new_line;
            widget_code += "#google_translate_element2 {display:none!important;}"+new_line;
            widget_code += '</style>'+new_line+new_line;
            widget_code += '<div id="google_translate_element2"></div>'+new_line;
            widget_code += '<script>'+new_line;
            widget_code += 'function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: \'';
            widget_code += default_language;
            widget_code += '\',autoDisplay: false';
            widget_code += "}, 'google_translate_element2');}"+new_line;
            widget_code += '<\/script>';
            widget_code += '<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"><\/script>'+new_line;
        }

        if(monochrome_flags && (widget_look == 'flags' || widget_look == 'flags_dropdown' || widget_look == 'flags_name' || widget_look == 'flags_code')) {
            widget_preview += new_line+'<style>a.glink img {filter:grayscale(100%);-webkit-filter:grayscale(100%);}</style>'+new_line;
        }

        if(widget_look == 'globe') {
            widget_preview += '<span class="gsatelites"></span><span class="gglobe"></span>';

            // Adding css
            widget_preview += '<style>'+new_line;
            widget_preview += '.gglobe {background-image:url($wp_plugin_url/gtglobe.svg);opacity:0.8;border-radius:50%;height:40px;width:40px;cursor:pointer;display:block;-moz-transition: all 0.3s;-webkit-transition: all 0.3s;transition: all 0.3s;}'+new_line;
            widget_preview += '.gglobe:hover {opacity:1;-moz-transform: scale(1.2);-webkit-transform: scale(1.2);transform: scale(1.2);}'+new_line;
            widget_preview += '.gsatelite {background-color:#777777;opacity:0.95;border-radius:50%;height:24px;width:24px;cursor:pointer;position:absolute;z-index:100000;display:none;-moz-transition: all 0.3s;-webkit-transition: all 0.3s;transition: all 0.3s;}'+new_line;
            widget_preview += '.gsatelite:hover {opacity:1;-moz-transform: scale(1.3);-webkit-transform: scale(1.3);transform: scale(1.3);}'+new_line;
            widget_preview += '</style>'+new_line+new_line;

            // Adding javascript
            widget_preview += '<script>'+new_line;
            widget_preview += "function renderGSatelites($, e) { $('.gsatelite').remove();"+new_line;
            widget_preview += "var centerPosition = $('.gglobe').position();"+new_line;
            widget_preview += "centerPosition.left += Math.floor($('.gglobe').width() / 2) - 10;"+new_line;
            widget_preview += "centerPosition.top += Math.floor($('.gglobe').height() / 2) - 10;"+new_line;
            widget_preview += 'var language_codes2 = '+JSON.stringify(jQuery(".connectedSortable2 li input:checked").map(function() {return jQuery(this).val();}).toArray())+';'+new_line;
            widget_preview += 'var languages = '+JSON.stringify((function(){var langs = [], selected_lang_codes = jQuery(".connectedSortable2 li input:checked").map(function() {return jQuery(this).val();}).toArray();for(var key in selected_lang_codes)langs.push(gt_lang_array[selected_lang_codes[key]]);return langs;})())+';'+new_line;
            widget_preview += 'var us_flag = '+(jQuery('#alt_us:checked').length ? 'true' : 'false')+';'+new_line;
            widget_preview += 'var ca_flag = '+(jQuery('#alt_ca:checked').length ? 'true' : 'false')+';'+new_line;
            widget_preview += 'var br_flag = '+(jQuery('#alt_br:checked').length ? 'true' : 'false')+';'+new_line;
            widget_preview += 'var mx_flag = '+(jQuery('#alt_mx:checked').length ? 'true' : 'false')+';'+new_line;
            widget_preview += 'var qc_flag = '+(jQuery('#alt_qc:checked').length ? 'true' : 'false')+';'+new_line;
            widget_preview += 'var count = language_codes2.length, r0 = 55, r = r0, d = 34, cntpc = 12, nc = 0, m = 1.75;'+new_line;
            widget_preview += 'cntpc = 2 * Math.PI * r0 / 34;'+new_line;
            widget_preview += 'for (var i = 0, j = 0; i < count; i++, j++) {'+new_line;
            widget_preview += 'var x, y, angle;'+new_line;
            widget_preview += 'do {if (j + 1 > Math.round(2 * r0 * Math.PI / d) * (nc + 1) * (nc + 2) / 2) {nc++;r = r + r0;cntpc = Math.floor(2 * Math.PI * r / d);}angle = j * 2 * Math.PI / cntpc + Math.PI / 4;x = centerPosition.left + Math.cos(angle) * r;y = centerPosition.top + Math.sin(angle) * r;'+new_line;
            widget_preview += "var positionGSatelites = ($('.gsatelites').parent().css('position') == 'fixed' ? $('.gsatelites').parent().position() : $('.gsatelites').offset()),vpHeight = $(window).height(),vpWidth = $(window).width(),tpViz = positionGSatelites.top + y >= 0 && positionGSatelites.top + y < vpHeight,btViz = positionGSatelites.top + y + 24 > 0 && positionGSatelites.top + y + 24 <= vpHeight,ltViz = positionGSatelites.left + x >= 0 && positionGSatelites.left + x < vpWidth,rtViz = positionGSatelites.left + x + 24 > 0 && positionGSatelites.left + x + 24 <= vpWidth,vVisible = tpViz && btViz,hVisible = ltViz && rtViz;if (vVisible && hVisible) {break;} else {j++;}} while (j - i < 10 * count);"+new_line;
            widget_preview += "$('.gsatelites').append('<span class=\"gsatelite gs' + (i + 1) + ' glang_' + language_codes2[i] + '\" onclick=\"doGTranslate("+"\\\\'"+default_language+"|'+language_codes2[i]+'"+"\\\\'"+")\" title=\"' + languages[i] + '\" style=\"background-image:url($wp_plugin_url/24/' + (function(l){if(l == 'en' && us_flag)return 'en-us';if(l == 'pt' && br_flag)return 'pt-br';if(l == 'es' && mx_flag)return 'es-mx';return l;})(language_codes2[i]) + '.png);left:' + x + 'px;top:' + y + 'px;\"></span>');"+new_line;
            widget_preview += "$('.gs' + (i + 1)).delay((i + 1) * 10).fadeIn('fast');"+new_line;
            widget_preview += '}}'+new_line;
            widget_preview += "function hideGSatelites($) { $('.gsatelite').each(function(i) { $(this).delay(($('.gsatelite').length - i - 1) * 10).fadeOut('fast');});}"+new_line;
            widget_preview += "(function($) { $('body').click(function() {hideGSatelites($);});$('.gglobe').click(function(e) {e.stopPropagation();renderGSatelites($, e);});})(jQuery);"+new_line;
            widget_preview += '<\/script>'+new_line;
        }

        if(widget_look == 'popup') {
            widget_preview += '<a href="#" class="switcher-popup glink nturl notranslate" onclick="openGTPopup(this)">';

            if(default_language == 'en' && jQuery('#alt_us:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/en-us.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else if(default_language == 'en' && jQuery('#alt_ca:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/en-ca.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else if(default_language == 'pt' && jQuery('#alt_br:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/pt-br.png" height="'+flag_size+'" width="'+flag_size+'" alt="pt" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else if(default_language == 'es' && jQuery('#alt_mx:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-mx.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else if(default_language == 'es' && jQuery('#alt_ar:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-ar.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else if(default_language == 'es' && jQuery('#alt_co:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-co.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else if(default_language == 'fr' && jQuery('#alt_qc:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/fr-qc.png" height="'+flag_size+'" width="'+flag_size+'" alt="fr" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;
            else
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/'+default_language+'.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+default_language+'" /> <span>'+gt_lang_array[default_language]+'</span><span style="color:#666;font-size:8px;font-weight:bold;">&#9660;</span></a>'+new_line;

            // lightbox and content
            widget_preview += '<div id="gt_fade" class="gt_black_overlay"></div>'+new_line;
            widget_preview += '<div id="gt_lightbox" class="gt_white_content notranslate">'+new_line;
            widget_preview += '<div style="position:relative;height:14px;"><span onclick="closeGTPopup()" style="position:absolute;right:2px;top:2px;font-weight:bold;font-size:12px;cursor:pointer;color:#444;font-family:cursive;">X</span></div>'+new_line;
            widget_preview += '<div class="gt_languages">'+new_line;

            var count_languages = 0;

            jQuery.each(language_codes, function(i, val) {
                lang = language_codes[i];
                if(jQuery('#fincl_langs'+lang+':checked').length) {
                    lang_name = gt_lang_array[lang];

                    var href = '#';
                    if(pro_version) {
                        href = (lang == default_language) ? '$site_url' : '$site_url'.replace('$site_url'.split('/').slice(0, 3).join('/'), '$site_url'.split('/').slice(0, 3).join('/')+'/'+lang);
                        if(lang != default_language && href.endsWith('/'+lang)) href += '/';
                    } else if(enterprise_version)
                        href = (lang == default_language) ? '$site_url' : '$site_url'.replace('$site_url'.split('/').slice(2, 3)[0].replace('www.', ''), lang + '.' + '$site_url'.split('/').slice(2, 3)[0].replace('www.', '')).replace('://www.', '://');

                    widget_preview += '<a href="'+href+'" onclick="changeGTLanguage(\''+default_language+'|'+lang+'\', this);return false;" title="'+lang_name+'" class="glink nturl'+(default_language == lang ? ' selected' : '')+'">';

                    if(lang == 'en' && jQuery('#alt_us:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/en-us.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> <span>'+lang_name+'</span></a>';
                    else if(lang == 'en' && jQuery('#alt_ca:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/en-ca.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> <span>'+lang_name+'</span></a>';
                    else if(lang == 'pt' && jQuery('#alt_br:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/pt-br.png" height="'+flag_size+'" width="'+flag_size+'" alt="pt" /> <span>'+lang_name+'</span></a>';
                    else if(lang == 'es' && jQuery('#alt_mx:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/es-mx.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> <span>'+lang_name+'</span></a>';
                    else if(lang == 'es' && jQuery('#alt_ar:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/es-ar.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> <span>'+lang_name+'</span></a>';
                    else if(lang == 'es' && jQuery('#alt_co:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/es-co.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> <span>'+lang_name+'</span></a>';
                    else if(lang == 'fr' && jQuery('#alt_qc:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/fr-qc.png" height="'+flag_size+'" width="'+flag_size+'" alt="fr" /> <span>'+lang_name+'</span></a>';
                    else
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/'+lang+'.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang+'" /> <span>'+lang_name+'</span></a>';

                    count_languages++;
                }
            });

            widget_preview += '</div>'+new_line;
            widget_preview += '</div>'+new_line;

            //console.log('Count: ' + count_languages);

            flag_size = parseInt(flag_size);
            //console.log('Flag size: ' + flag_size);

            var popup_height = 25 + count_languages * ((flag_size > 16 ? flag_size : 20) + 10 + 1);

            //console.log('height: ' + popup_height);

            var popup_columns = Math.ceil(popup_height / 375);

            //console.log('Cols: ' + popup_columns);

            if(popup_height > 375)
                popup_height = 375;

            var popup_width = popup_columns * (326 + 15);

            //console.log('Width: ' + popup_width);

            if(popup_width > 980)
                popup_width = 980;

            if(popup_columns > 5)
                popup_columns = 5;

            // style
            widget_preview += '<style>'+new_line;
            if(monochrome_flags) widget_preview += 'a.glink img {filter:grayscale(100%);-webkit-filter:grayscale(100%);}'+new_line;
            widget_preview += '.gt_black_overlay {display:none;position:fixed;top:0%;left:0%;width:100%;height:100%;background-color:black;z-index:2017;-moz-opacity:0.8;opacity:.80;filter:alpha(opacity=80);}'+new_line;
            widget_preview += '.gt_white_content {display:none;position:fixed;top:50%;left:50%;width:'+popup_width+'px;height:'+popup_height+'px;margin:-'+(popup_height/2)+'px 0 0 -'+(popup_width/2)+'px;padding:6px 16px;border-radius:5px;background-color:white;color:black;z-index:19881205;overflow:auto;text-align:left;}'+new_line;
            widget_preview += '.gt_white_content a {display:block;padding:5px 0;border-bottom:1px solid #e7e7e7;white-space:nowrap;}'+new_line;
            widget_preview += '.gt_white_content a:last-of-type {border-bottom:none;}'+new_line;
            widget_preview += '.gt_white_content a.selected {background-color:#ffc;}'+new_line;
            widget_preview += '.gt_white_content .gt_languages {column-count:'+popup_columns+';column-gap:10px;}'+new_line;
            widget_preview += '.gt_white_content::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 3px rgba(0,0,0,0.3);border-radius:5px;background-color:#F5F5F5;}'+new_line;
            widget_preview += '.gt_white_content::-webkit-scrollbar {width:5px;}'+new_line;
            widget_preview += '.gt_white_content::-webkit-scrollbar-thumb {border-radius:5px;-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,.3);background-color:#888;}'+new_line;
            widget_preview += '</style>'+new_line+new_line;

            // javascript
            widget_preview += '<script>'+new_line;
            widget_preview += "function openGTPopup(a) {jQuery('.gt_white_content a img').each(function() {if(!jQuery(this)[0].hasAttribute('src'))jQuery(this).attr('src', jQuery(this).attr('data-gt-lazy-src'))});if(a === undefined){document.getElementById('gt_lightbox').style.display='block';document.getElementById('gt_fade').style.display='block';}else{jQuery(a).parent().find('#gt_lightbox').css('display', 'block');jQuery(a).parent().find('#gt_fade').css('display', 'block');}}"+new_line;
            widget_preview += "function closeGTPopup() {jQuery('.gt_white_content').css('display', 'none');jQuery('.gt_black_overlay').css('display', 'none');}"+new_line;
            widget_preview += "function changeGTLanguage(pair, a) {doGTranslate(pair);jQuery('a.switcher-popup').html(jQuery(a).html()+'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>');closeGTPopup();}"+new_line;
            widget_preview += "jQuery('.gt_black_overlay').click(function(e) {if(jQuery('.gt_white_content').is(':visible')) {closeGTPopup()}});"+new_line;
            widget_preview += '<\/script>'+new_line;

        }

        if(widget_look == 'dropdown_with_flags') {
            var font_size = 10;
            var widget_width = 163;
            var arrow_size = 7;

            if(flag_size == 16) {
                font_size = 10;
                widget_width = 163;
                arrow_size = 7;
            } else if(flag_size == 24) {
                font_size = 12;
                widget_width = 173;
                arrow_size = 11;
            } else if(flag_size == 32) {
                font_size = 14;
                widget_width = 193;
                arrow_size = 12;
            } else if(flag_size == 48) {
                font_size = 16;
                widget_width = 223;
                arrow_size = 14;
            }

            // Adding slider css
            widget_preview += '<style>'+new_line;
            widget_preview += '.switcher {font-family:Arial;font-size:'+font_size+'pt;text-align:left;cursor:pointer;overflow:hidden;width:'+widget_width+'px;line-height:17px;}'+new_line;
            widget_preview += '.switcher a {text-decoration:none;display:block;font-size:'+font_size+'pt;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;}'+new_line;
            widget_preview += '.switcher a img {vertical-align:middle;display:inline;border:0;padding:0;margin:0;opacity:0.8;'+(monochrome_flags ? 'filter:grayscale(100%);-webkit-filter:grayscale(100%);' : '' )+'}'+new_line;
            widget_preview += '.switcher a:hover img {opacity:1;}'+new_line;
            widget_preview += '.switcher .selected {background:'+switcher_background_color+' linear-gradient(180deg, '+switcher_background_shadow_color+' 0%, '+switcher_background_color+' 70%);position:relative;z-index:9999;}'+new_line;
            widget_preview += '.switcher .selected a {border:1px solid '+switcher_border_color+';color:'+switcher_text_color+';padding:3px 5px;width:'+(widget_width - 2 * 5 - 2 * 1)+'px;}'+new_line;
            widget_preview += '.switcher .selected a:after {height:'+flag_size+'px;display:inline-block;position:absolute;right:'+(flag_size < 20 ? 5 : 10)+'px;width:15px;background-position:50%;background-size:'+arrow_size+'px;background-image:url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' viewBox=\'0 0 285 285\'><path d=\'M282 76.5l-14.2-14.3a9 9 0 0 0-13.1 0L142.5 174.4 30.3 62.2a9 9 0 0 0-13.2 0L3 76.5a9 9 0 0 0 0 13.1l133 133a9 9 0 0 0 13.1 0l133-133a9 9 0 0 0 0-13z\' style=\'fill:'+escape(switcher_arrow_color)+'\'/></svg>");background-repeat:no-repeat;content:""!important;transition:all .2s;}'+new_line;
            widget_preview += '.switcher .selected a.open:after {-webkit-transform: rotate(-180deg);transform:rotate(-180deg);}'+new_line;
            widget_preview += '.switcher .selected a:hover {background:'+switcher_background_hover_color+'}'+new_line;
            widget_preview += '.switcher .option {position:relative;z-index:9998;border-left:1px solid '+switcher_border_color+';border-right:1px solid '+switcher_border_color+';border-bottom:1px solid '+switcher_border_color+';background-color:'+dropdown_background_color+';display:none;width:'+(widget_width - 2 * 1)+'px;max-height:198px;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;overflow-y:auto;overflow-x:hidden;}'+new_line;
            widget_preview += '.switcher .option a {color:'+dropdown_text_color+';padding:3px 5px;}'+new_line;
            widget_preview += '.switcher .option a:hover {background:'+dropdown_hover_color+';}'+new_line;
            widget_preview += '.switcher .option a.selected {background:'+dropdown_hover_color+';}'+new_line;
            widget_preview += '#selected_lang_name {float: none;}'+new_line;
            widget_preview += '.l_name {float: none !important;margin: 0;}'+new_line;
            widget_preview += '.switcher .option::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 3px rgba(0,0,0,0.3);border-radius:5px;background-color:#f5f5f5;}'+new_line;
            widget_preview += '.switcher .option::-webkit-scrollbar {width:5px;}'+new_line;
            widget_preview += '.switcher .option::-webkit-scrollbar-thumb {border-radius:5px;-webkit-box-shadow: inset 0 0 3px rgba(0,0,0,.3);background-color:#888;}'+new_line;
            widget_preview += '</style>'+new_line;

            // Adding slider html
            widget_preview += '<div class="switcher notranslate">'+new_line;
            widget_preview += '<div class="selected">'+new_line;

            widget_preview += '<a href="#" onclick="return false;">';

            if(default_language == 'en' && jQuery('#alt_us:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/en-us.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else if(default_language == 'en' && jQuery('#alt_ca:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/en-ca.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else if(default_language == 'pt' && jQuery('#alt_br:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/pt-br.png" height="'+flag_size+'" width="'+flag_size+'" alt="pt" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else if(default_language == 'es' && jQuery('#alt_mx:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-mx.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else if(default_language == 'es' && jQuery('#alt_ar:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-ar.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else if(default_language == 'es' && jQuery('#alt_co:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/es-co.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else if(default_language == 'fr' && jQuery('#alt_qc:checked').length)
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/fr-qc.png" height="'+flag_size+'" width="'+flag_size+'" alt="fr" /> '+gt_lang_array[default_language]+'</a>'+new_line;
            else
                widget_preview += '<img src="{$wp_plugin_url}/flags/'+flag_size+'/'+default_language+'.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+default_language+'" /> '+gt_lang_array[default_language]+'</a>'+new_line;

            widget_preview += '</div>'+new_line;

            widget_preview += '<div class="option">'+new_line;

            jQuery.each(language_codes, function(i, val) {
                lang = language_codes[i];
                if(jQuery('#fincl_langs'+lang+':checked').length) {
                    lang_name = gt_lang_array[lang];

                    var href = '#';
                    if(pro_version) {
                        href = (lang == default_language) ? '$site_url' : '$site_url'.replace('$site_url'.split('/').slice(0, 3).join('/'), '$site_url'.split('/').slice(0, 3).join('/')+'/'+lang);
                        if(lang != default_language && href.endsWith('/'+lang)) href += '/';
                    } else if(enterprise_version)
                        href = (lang == default_language) ? '$site_url' : '$site_url'.replace('$site_url'.split('/').slice(2, 3)[0].replace('www.', ''), lang + '.' + '$site_url'.split('/').slice(2, 3)[0].replace('www.', '')).replace('://www.', '://');

                    widget_preview += '<a href="'+href+'" onclick="doGTranslate(\''+default_language+'|'+lang+'\');jQuery(\'div.switcher div.selected a\').html(jQuery(this).html());return false;" title="'+lang_name+'" class="nturl'+(default_language == lang ? ' selected' : '')+'">';

                    if(lang == 'en' && jQuery('#alt_us:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/en-us.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> '+lang_name+'</a>';
                    else if(lang == 'en' && jQuery('#alt_ca:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/en-ca.png" height="'+flag_size+'" width="'+flag_size+'" alt="en" /> '+lang_name+'</a>';
                    else if(lang == 'pt' && jQuery('#alt_br:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/pt-br.png" height="'+flag_size+'" width="'+flag_size+'" alt="pt" /> '+lang_name+'</a>';
                    else if(lang == 'es' && jQuery('#alt_mx:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/es-mx.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> '+lang_name+'</a>';
                    else if(lang == 'es' && jQuery('#alt_ar:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/es-ar.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> '+lang_name+'</a>';
                    else if(lang == 'es' && jQuery('#alt_co:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/es-co.png" height="'+flag_size+'" width="'+flag_size+'" alt="es" /> '+lang_name+'</a>';
                    else if(lang == 'fr' && jQuery('#alt_qc:checked').length)
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/fr-qc.png" height="'+flag_size+'" width="'+flag_size+'" alt="fr" /> '+lang_name+'</a>';
                    else
                        widget_preview += '<img data-gt-lazy-src="{$wp_plugin_url}/flags/'+flag_size+'/'+lang+'.png" height="'+flag_size+'" width="'+flag_size+'" alt="'+lang+'" /> '+lang_name+'</a>';

                }
            });

            widget_preview += '</div>'+new_line;
            widget_preview += '</div>'+new_line;

            // Adding slider javascript
            widget_preview += '<script>'+new_line;
            widget_preview += "jQuery('.switcher .selected').click(function() {jQuery('.switcher .option a img').each(function() {if(!jQuery(this)[0].hasAttribute('src'))jQuery(this).attr('src', jQuery(this).attr('data-gt-lazy-src'))});if(!(jQuery('.switcher .option').is(':visible'))) {jQuery('.switcher .option').stop(true,true).delay(100).slideDown(500);jQuery('.switcher .selected a').toggleClass('open')}});"+new_line;
            widget_preview += "jQuery('.switcher .option').bind('mousewheel', function(e) {var options = jQuery('.switcher .option');if(options.is(':visible'))options.scrollTop(options.scrollTop() - e.originalEvent.wheelDelta);return false;});"+new_line;
            widget_preview += "jQuery('body').not('.switcher').click(function(e) {if(jQuery('.switcher .option').is(':visible') && e.target != jQuery('.switcher .option').get(0)) {jQuery('.switcher .option').stop(true,true).delay(100).slideUp(500);jQuery('.switcher .selected a').toggleClass('open')}});"+new_line;
            widget_preview += '<\/script>'+new_line;
        }

        // Adding javascript
        widget_code += new_line+new_line;
        widget_code += '<script>'+new_line;
        if(pro_version && translation_method == 'redirect' && new_window) {
            widget_code += "function openTab(url) {var form=document.createElement('form');form.method='post';form.action=url;form.target='_blank';document.body.appendChild(form);form.submit();}"+new_line;
            if(analytics)
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(typeof _gaq!='undefined'){_gaq.push(['_trackEvent', 'GTranslate', lang, location.pathname+location.search]);}else {if(typeof ga!='undefined')ga('send', 'event', 'GTranslate', lang, location.pathname+location.search);}var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';if(lang == '"+default_language+"')openTab(location.protocol+'//'+location.host+gt_request_uri);else openTab(location.protocol+'//'+location.host+'/'+lang+gt_request_uri);}"+new_line;
            else
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';if(lang == '"+default_language+"')openTab(location.protocol+'//'+location.host+gt_request_uri);else openTab(location.protocol+'//'+location.host+'/'+lang+gt_request_uri);}"+new_line;
        } else if(pro_version && translation_method == 'redirect') {
            if(analytics)
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(typeof _gaq!='undefined'){_gaq.push(['_trackEvent', 'GTranslate', lang, location.pathname+location.search]);}else {if(typeof ga!='undefined')ga('send', 'event', 'GTranslate', lang, location.pathname+location.search);}var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';if(lang == '"+default_language+"')location.href=location.protocol+'//'+location.host+gt_request_uri;else location.href=location.protocol+'//'+location.host+'/'+lang+gt_request_uri;}"+new_line;
            else
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var plang=location.pathname.split('/')[1];if(plang.length !=2 && plang != 'zh-CN' && plang != 'zh-TW' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';if(lang == '"+default_language+"')location.href=location.protocol+'//'+location.host+gt_request_uri;else location.href=location.protocol+'//'+location.host+'/'+lang+gt_request_uri;}"+new_line;
        } else if(enterprise_version && translation_method == 'redirect' && new_window) {
            widget_code += "function openTab(url) {var form=document.createElement('form');form.method='post';form.action=url;form.target='_blank';document.body.appendChild(form);form.submit();}"+new_line;
            if(analytics)
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(typeof _gaq!='undefined'){_gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);}else {if(typeof ga!='undefined')ga('send', 'event', 'GTranslate', lang, location.hostname+location.pathname+location.search);}var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';openTab(location.protocol+'//'+(lang == '"+default_language+"' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(RegExp('^' + plang + '[.]'), '')+gt_request_uri);}"+new_line;
            else
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';openTab(location.protocol+'//'+(lang == '"+default_language+"' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(RegExp('^' + plang + '[.]'), '')+gt_request_uri);}"+new_line;
        } else if(enterprise_version && translation_method == 'redirect') {
            if(analytics)
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(typeof _gaq!='undefined'){_gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);}else {if(typeof ga!='undefined')ga('send', 'event', 'GTranslate', lang, location.hostname+location.pathname+location.search);}var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';location.href=location.protocol+'//'+(lang == '"+default_language+"' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(RegExp('^' + plang + '[.]'), '')+gt_request_uri;}"+new_line;
            else
                widget_code += "function doGTranslate(lang_pair) {if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];var plang=location.hostname.split('.')[0];if(plang.length !=2 && plang.toLowerCase() != 'zh-cn' && plang.toLowerCase() != 'zh-tw' && plang != 'hmn' && plang != 'haw' && plang != 'ceb')plang='"+default_language+"';location.href=location.protocol+'//'+(lang == '"+default_language+"' ? '' : lang+'.')+location.hostname.replace('www.', '').replace(RegExp('^' + plang + '[.]'), '')+gt_request_uri;}"+new_line;
        } else if(translation_method == 'onfly') {
            widget_code += "function GTranslateGetCurrentLang() {var keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)');return keyValue ? keyValue[2].split('/')[2] : null;}"+new_line;
            widget_code += "function GTranslateFireEvent(element,event){try{if(document.createEventObject){var evt=document.createEventObject();element.fireEvent('on'+event,evt)}else{var evt=document.createEvent('HTMLEvents');evt.initEvent(event,true,true);element.dispatchEvent(evt)}}catch(e){}}"+new_line;
            if(analytics)
                widget_code += "function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0])return;if(typeof ga!='undefined'){ga('send', 'event', 'GTranslate', lang, location.hostname+location.pathname+location.search);}else{if(typeof _gaq!='undefined')_gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);}var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(sel[i].className.indexOf('goog-te-combo')!=-1){teCombo=sel[i];break;}if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}"+new_line;
            else
                widget_code += "function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0])return;var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(sel[i].className.indexOf('goog-te-combo')!=-1){teCombo=sel[i];break;}if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}"+new_line;
            if(widget_look == 'dropdown_with_flags') {
                widget_code += "if(GTranslateGetCurrentLang() != null)jQuery(document).ready(function() {var lang_html = jQuery('div.switcher div.option').find('img[alt=\"'+GTranslateGetCurrentLang()+'\"]').parent().html();if(typeof lang_html != 'undefined')jQuery('div.switcher div.selected a').html(lang_html.replace('data-gt-lazy-', ''));});"+new_line;
            } else if(widget_look == 'popup') {
                widget_code += 'if(GTranslateGetCurrentLang() != null)jQuery(document).ready(function() {var lang_html = jQuery(".gt_languages a[onclick*=\'|"+GTranslateGetCurrentLang()+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');});'+new_line;
            }
        }

        widget_code += '<\/script>'+new_line;

    }

    widget_code = widget_preview + widget_code;

    jQuery('#widget_code').val(widget_code);

    ShowWidgetPreview(widget_preview);

}

function ShowWidgetPreview(widget_preview) {
    widget_preview = widget_preview.replace(/javascript:doGTranslate/g, 'javascript:void')
    widget_preview = widget_preview.replace('onchange="doGTranslate(this);"', '');

    jQuery('head').append( jQuery('<link rel="stylesheet" type="text/css" />').attr('href', '$wp_plugin_url/gtranslate-style'+jQuery('#flag_size').val()+'.css') );
    jQuery('#widget_preview').html(widget_preview);
}

jQuery('#pro_version').attr('checked', '$pro_version'.length > 0);
jQuery('#enterprise_version').attr('checked', '$enterprise_version'.length > 0);
jQuery('#url_translation').attr('checked', '$url_translation'.length > 0);
jQuery('#add_hreflang_tags').attr('checked', '$add_hreflang_tags'.length > 0);
jQuery('#email_translation').attr('checked', '$email_translation'.length > 0);
jQuery('#email_translation_debug').attr('checked', '$email_translation_debug'.length > 0);
jQuery('#new_window').attr('checked', '$new_window'.length > 0);
jQuery('#show_in_menu').val('$show_in_menu');
jQuery('#floating_language_selector').val('$floating_language_selector');
jQuery('#native_language_names').attr('checked', '$native_language_names'.length > 0);
jQuery('#analytics').attr('checked', '$analytics'.length > 0);
jQuery('#detect_browser_language').attr('checked', '$detect_browser_language'.length > 0);
jQuery('#add_new_line').attr('checked', '$add_new_line'.length > 0);
jQuery('#default_language').val('$default_language');
jQuery('#widget_look').val('$widget_look');
jQuery('#flag_size').val('$flag_size');
jQuery('#monochrome_flags').attr('checked', '$monochrome_flags'.length > 0);
jQuery('#switcher_text_color').val('$switcher_text_color');
jQuery('#switcher_arrow_color').val('$switcher_arrow_color');
jQuery('#switcher_border_color').val('$switcher_border_color');
jQuery('#switcher_background_color').val('$switcher_background_color');
jQuery('#switcher_background_shadow_color').val('$switcher_background_shadow_color');
jQuery('#switcher_background_hover_color').val('$switcher_background_hover_color');
jQuery('#dropdown_text_color').val('$dropdown_text_color');
jQuery('#dropdown_hover_color').val('$dropdown_hover_color');
jQuery('#dropdown_background_color').val('$dropdown_background_color');

if(jQuery('#pro_version:checked').length || jQuery('#enterprise_version:checked').length) {
    jQuery('#new_window_option').show();
    jQuery('#url_translation_option').show();
    jQuery('#hreflang_tags_option').show();
    jQuery('#email_translation_option').show();
    if(jQuery('#email_translation:checked').length)
        jQuery('#email_translation_debug_option').show();
    //jQuery('#auto_switch_option').hide();
}

if('$widget_look' == 'dropdown' || '$widget_look' == 'flags_dropdown' || '$widget_look' == 'globe' || '$widget_look' == 'lang_names' || '$widget_look' == 'lang_codes') {
    jQuery('#dropdown_languages_option').show();
} else {
    jQuery('#dropdown_languages_option').hide();
}

if('$widget_look' == 'dropdown_with_flags') {
    jQuery('.switcher_color_options').show();
} else {
    jQuery('.switcher_color_options').hide();
}

if('$widget_look' == 'globe') {
    jQuery('#alternative_flags_option').show();
} else {
    jQuery('#alternative_flags_option').hide();
}

if('$widget_look' == 'flags' || '$widget_look' == 'flags_dropdown' || '$widget_look' == 'dropdown_with_flags' || '$widget_look' == 'flags_name' || '$widget_look' == 'flags_code' || '$widget_look' == 'popup') {
    jQuery('#flag_languages_option').show();
    jQuery('#alternative_flags_option').show();
} else {
    jQuery('#flag_languages_option').hide();
    if('$widget_look' != 'globe')
        jQuery('#alternative_flags_option').hide();
}

if('$widget_look' == 'flags_dropdown') {
    jQuery('#line_break_option').show();
} else {
    jQuery('#line_break_option').hide();
}

if('$widget_look' == 'dropdown' || '$widget_look' == 'lang_names' || '$widget_look' == 'lang_codes' || '$widget_look' == 'globe') {
    jQuery('#flag_size_option,#flag_monochrome_option').hide();
} else {
    jQuery('#flag_size_option,#flag_monochrome_option').show();
}

if(jQuery('#native_language_names:checked').length) {
    jQuery('.en_names').hide();
    jQuery('.native_names').show();
}

jQuery(function(){
    jQuery(".connectedSortable1").sortable({connectWith: ".connectedSortable1"}).disableSelection();
    jQuery(".connectedSortable2").sortable({connectWith: ".connectedSortable2"}).disableSelection();
    jQuery(".connectedSortable1").on("sortstop", function(event, ui) {
        language_codes = jQuery(".connectedSortable1 li input").map(function() {return jQuery(this).val();}).toArray();

        jQuery('#language_codes_order').val(language_codes.join(','));
        RefreshDoWidgetCode();
    });

    jQuery(".connectedSortable2").on("sortstop", function(event, ui) {
        language_codes2 = jQuery(".connectedSortable2 li input").map(function() {return jQuery(this).val();}).toArray();

        jQuery('#language_codes_order2').val(language_codes2.join(','));
        RefreshDoWidgetCode();
    });
});

function light_color_scheme() {
    jQuery('#switcher_text_color').iris('color', '#666');
    jQuery('#switcher_arrow_color').iris('color', '#666');
    jQuery('#switcher_border_color').iris('color', '#ccc');
    jQuery('#switcher_background_color').iris('color', '#fff');
    jQuery('#switcher_background_shadow_color').iris('color', '#efefef');
    jQuery('#switcher_background_hover_color').iris('color', '#f0f0f0');
    jQuery('#dropdown_text_color').iris('color', '#000');
    jQuery('#dropdown_hover_color').iris('color', '#fff');
    jQuery('#dropdown_background_color').iris('color', '#eee');

    return false;
}

function dark_color_scheme() {
    jQuery('#switcher_text_color').iris('color', '#f7f7f7');
    jQuery('#switcher_arrow_color').iris('color', '#f2f2f2');
    jQuery('#switcher_border_color').iris('color', '#161616');
    jQuery('#switcher_background_color').iris('color', '#303030');
    jQuery('#switcher_background_shadow_color').iris('color', '#474747');
    jQuery('#switcher_background_hover_color').iris('color', '#3a3a3a');
    jQuery('#dropdown_text_color').iris('color', '#eaeaea');
    jQuery('#dropdown_hover_color').iris('color', '#748393');
    jQuery('#dropdown_background_color').iris('color', '#474747');

    return false;
}
EOT;

// selected languages
if(count($fincl_langs) > 0)
    $script .= "jQuery.each(languages, function(i, val) {jQuery('#fincl_langs'+language_codes[i]).attr('checked', false);});\n";
if(count($incl_langs) > 0)
    $script .= "jQuery.each(languages, function(i, val) {jQuery('#incl_langs'+language_codes2[i]).attr('checked', false);});\n";
foreach($fincl_langs as $lang)
    $script .= "jQuery('#fincl_langs$lang').attr('checked', true);\n";
foreach($incl_langs as $lang)
    $script .= "jQuery('#incl_langs$lang').attr('checked', true);\n";

// alt flags
foreach($alt_flags as $flag)
    $script .= "jQuery('#alt_$flag').attr('checked', true);\n";

$script .= <<<EOT
if(jQuery('#widget_code').val() == '')
    RefreshDoWidgetCode();
else
    ShowWidgetPreview(jQuery('#widget_code').val());
EOT;
?>

        <form id="gtranslate" name="form1" method="post" class="notranslate" action="<?php echo admin_url('options-general.php?page=gtranslate_options'); ?>" onsubmit="return gt_validate_form();">

        <div class="postbox-container og_left_col">

        <div id="poststuff">
            <div class="postbox">
                <h3 id="settings"><?php _e('Widget options', 'gtranslate'); ?></h3>
                <div class="inside">
                    <table style="width:100%;" cellpadding="4">
                    <tr>
                        <td class="option_name"><?php _e('Widget look', 'gtranslate'); ?>:</td>
                        <td>
                            <select id="widget_look" name="widget_look" onChange="RefreshDoWidgetCode()">
                                <option value="dropdown_with_flags"><?php _e('Nice dropdown with flags', 'gtranslate'); ?></option>
                                <option value="flags_dropdown"><?php _e('Flags and dropdown', 'gtranslate'); ?></option>
                                <option value="dropdown"><?php _e('Dropdown', 'gtranslate'); ?></option>
                                <option value="flags"><?php _e('Flags', 'gtranslate'); ?></option>
                                <option value="flags_name"><?php _e('Flags with language name', 'gtranslate'); ?></option>
                                <option value="flags_code"><?php _e('Flags with language code', 'gtranslate'); ?></option>
                                <option value="lang_names"><?php _e('Language names', 'gtranslate'); ?></option>
                                <option value="lang_codes"><?php _e('Language codes', 'gtranslate'); ?></option>
                                <option value="globe"><?php _e('Globe', 'gtranslate'); ?></option>
                                <option value="popup">(beta) <?php _e('Popup', 'gtranslate'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="option_name"><?php _e('Translate from', 'gtranslate'); ?>:</td>
                        <td>
                            <select id="default_language" name="default_language" onChange="RefreshDoWidgetCode()">
                                <option value="af"><?php _e('Afrikaans', 'gtranslate'); ?></option>
                                <option value="sq"><?php _e('Albanian', 'gtranslate'); ?></option>
                                <option value="am"><?php _e('Amharic', 'gtranslate'); ?></option>
                                <option value="ar"><?php _e('Arabic', 'gtranslate'); ?></option>
                                <option value="hy"><?php _e('Armenian', 'gtranslate'); ?></option>
                                <option value="az"><?php _e('Azerbaijani', 'gtranslate'); ?></option>
                                <option value="eu"><?php _e('Basque', 'gtranslate'); ?></option>
                                <option value="be"><?php _e('Belarusian', 'gtranslate'); ?></option>
                                <option value="bn"><?php _e('Bengali', 'gtranslate'); ?></option>
                                <option value="bs"><?php _e('Bosnian', 'gtranslate'); ?></option>
                                <option value="bg"><?php _e('Bulgarian', 'gtranslate'); ?></option>
                                <option value="ca"><?php _e('Catalan', 'gtranslate'); ?></option>
                                <option value="ceb"><?php _e('Cebuano', 'gtranslate'); ?></option>
                                <option value="ny"><?php _e('Chichewa', 'gtranslate'); ?></option>
                                <option value="zh-CN"><?php _e('Chinese (Simplified)', 'gtranslate'); ?></option>
                                <option value="zh-TW"><?php _e('Chinese (Traditional)', 'gtranslate'); ?></option>
                                <option value="co"><?php _e('Corsican', 'gtranslate'); ?></option>
                                <option value="hr"><?php _e('Croatian', 'gtranslate'); ?></option>
                                <option value="cs"><?php _e('Czech', 'gtranslate'); ?></option>
                                <option value="da"><?php _e('Danish', 'gtranslate'); ?></option>
                                <option value="nl"><?php _e('Dutch', 'gtranslate'); ?></option>
                                <option value="en" selected="selected"><?php _e('English', 'gtranslate'); ?></option>
                                <option value="eo"><?php _e('Esperanto', 'gtranslate'); ?></option>
                                <option value="et"><?php _e('Estonian', 'gtranslate'); ?></option>
                                <option value="tl"><?php _e('Filipino', 'gtranslate'); ?></option>
                                <option value="fi"><?php _e('Finnish', 'gtranslate'); ?></option>
                                <option value="fr"><?php _e('French', 'gtranslate'); ?></option>
                                <option value="fy"><?php _e('Frisian', 'gtranslate'); ?></option>
                                <option value="gl"><?php _e('Galician', 'gtranslate'); ?></option>
                                <option value="ka"><?php _e('Georgian', 'gtranslate'); ?></option>
                                <option value="de"><?php _e('German', 'gtranslate'); ?></option>
                                <option value="el"><?php _e('Greek', 'gtranslate'); ?></option>
                                <option value="gu"><?php _e('Gujarati', 'gtranslate'); ?></option>
                                <option value="ht"><?php _e('Haitian Creole', 'gtranslate'); ?></option>
                                <option value="ha"><?php _e('Hausa', 'gtranslate'); ?></option>
                                <option value="haw"><?php _e('Hawaiian', 'gtranslate'); ?></option>
                                <option value="iw"><?php _e('Hebrew', 'gtranslate'); ?></option>
                                <option value="hi"><?php _e('Hindi', 'gtranslate'); ?></option>
                                <option value="hmn"><?php _e('Hmong', 'gtranslate'); ?></option>
                                <option value="hu"><?php _e('Hungarian', 'gtranslate'); ?></option>
                                <option value="is"><?php _e('Icelandic', 'gtranslate'); ?></option>
                                <option value="ig"><?php _e('Igbo', 'gtranslate'); ?></option>
                                <option value="id"><?php _e('Indonesian', 'gtranslate'); ?></option>
                                <option value="ga"><?php _e('Irish', 'gtranslate'); ?></option>
                                <option value="it"><?php _e('Italian', 'gtranslate'); ?></option>
                                <option value="ja"><?php _e('Japanese', 'gtranslate'); ?></option>
                                <option value="jw"><?php _e('Javanese', 'gtranslate'); ?></option>
                                <option value="kn"><?php _e('Kannada', 'gtranslate'); ?></option>
                                <option value="kk"><?php _e('Kazakh', 'gtranslate'); ?></option>
                                <option value="km"><?php _e('Khmer', 'gtranslate'); ?></option>
                                <option value="ko"><?php _e('Korean', 'gtranslate'); ?></option>
                                <option value="ku"><?php _e('Kurdish (Kurmanji)', 'gtranslate'); ?></option>
                                <option value="ky"><?php _e('Kyrgyz', 'gtranslate'); ?></option>
                                <option value="lo"><?php _e('Lao', 'gtranslate'); ?></option>
                                <option value="la"><?php _e('Latin', 'gtranslate'); ?></option>
                                <option value="lv"><?php _e('Latvian', 'gtranslate'); ?></option>
                                <option value="lt"><?php _e('Lithuanian', 'gtranslate'); ?></option>
                                <option value="lb"><?php _e('Luxembourgish', 'gtranslate'); ?></option>
                                <option value="mk"><?php _e('Macedonian', 'gtranslate'); ?></option>
                                <option value="mg"><?php _e('Malagasy', 'gtranslate'); ?></option>
                                <option value="ms"><?php _e('Malay', 'gtranslate'); ?></option>
                                <option value="ml"><?php _e('Malayalam', 'gtranslate'); ?></option>
                                <option value="mt"><?php _e('Maltese', 'gtranslate'); ?></option>
                                <option value="mi"><?php _e('Maori', 'gtranslate'); ?></option>
                                <option value="mr"><?php _e('Marathi', 'gtranslate'); ?></option>
                                <option value="mn"><?php _e('Mongolian', 'gtranslate'); ?></option>
                                <option value="my"><?php _e('Myanmar (Burmese)', 'gtranslate'); ?></option>
                                <option value="ne"><?php _e('Nepali', 'gtranslate'); ?></option>
                                <option value="no"><?php _e('Norwegian', 'gtranslate'); ?></option>
                                <option value="ps"><?php _e('Pashto', 'gtranslate'); ?></option>
                                <option value="fa"><?php _e('Persian', 'gtranslate'); ?></option>
                                <option value="pl"><?php _e('Polish', 'gtranslate'); ?></option>
                                <option value="pt"><?php _e('Portuguese', 'gtranslate'); ?></option>
                                <option value="pa"><?php _e('Punjabi', 'gtranslate'); ?></option>
                                <option value="ro"><?php _e('Romanian', 'gtranslate'); ?></option>
                                <option value="ru"><?php _e('Russian', 'gtranslate'); ?></option>
                                <option value="sm"><?php _e('Samoan', 'gtranslate'); ?></option>
                                <option value="gd"><?php _e('Scottish Gaelic', 'gtranslate'); ?></option>
                                <option value="sr"><?php _e('Serbian', 'gtranslate'); ?></option>
                                <option value="st"><?php _e('Sesotho', 'gtranslate'); ?></option>
                                <option value="sn"><?php _e('Shona', 'gtranslate'); ?></option>
                                <option value="sd"><?php _e('Sindhi', 'gtranslate'); ?></option>
                                <option value="si"><?php _e('Sinhala', 'gtranslate'); ?></option>
                                <option value="sk"><?php _e('Slovak', 'gtranslate'); ?></option>
                                <option value="sl"><?php _e('Slovenian', 'gtranslate'); ?></option>
                                <option value="so"><?php _e('Somali', 'gtranslate'); ?></option>
                                <option value="es"><?php _e('Spanish', 'gtranslate'); ?></option>
                                <option value="su"><?php _e('Sudanese', 'gtranslate'); ?></option>
                                <option value="sw"><?php _e('Swahili', 'gtranslate'); ?></option>
                                <option value="sv"><?php _e('Swedish', 'gtranslate'); ?></option>
                                <option value="tg"><?php _e('Tajik', 'gtranslate'); ?></option>
                                <option value="ta"><?php _e('Tamil', 'gtranslate'); ?></option>
                                <option value="te"><?php _e('Telugu', 'gtranslate'); ?></option>
                                <option value="th"><?php _e('Thai', 'gtranslate'); ?></option>
                                <option value="tr"><?php _e('Turkish', 'gtranslate'); ?></option>
                                <option value="uk"><?php _e('Ukrainian', 'gtranslate'); ?></option>
                                <option value="ur"><?php _e('Urdu', 'gtranslate'); ?></option>
                                <option value="uz"><?php _e('Uzbek', 'gtranslate'); ?></option>
                                <option value="vi"><?php _e('Vietnamese', 'gtranslate'); ?></option>
                                <option value="cy"><?php _e('Welsh', 'gtranslate'); ?></option>
                                <option value="xh"><?php _e('Xhosa', 'gtranslate'); ?></option>
                                <option value="yi"><?php _e('Yiddish', 'gtranslate'); ?></option>
                                <option value="yo"><?php _e('Yoruba', 'gtranslate'); ?></option>
                                <option value="zu"><?php _e('Zulu', 'gtranslate'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="option_name">* <?php _e('Sub-directory URL structure', 'gtranslate'); ?>:<br><code><small>http://example.com/<b>ru</b>/</small></code></td>
                        <td><input id="pro_version" name="pro_version" value="1" type="checkbox" onclick="if(jQuery('#pro_version').is(':checked') && jQuery('#enterprise_version').is(':checked'))jQuery('#enterprise_version').prop('checked', false);RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/> <a href="https://gtranslate.io/?xyz=998#pricing" target="_blank" title="If you already have a subscription, you can enable this.">* <?php _e('for paid plans only', 'gtranslate'); ?></a></td>
                    </tr>
                    <tr>
                        <td class="option_name">* <?php _e('Sub-domain URL structure', 'gtranslate'); ?>:<br><code><small>http://<b>es</b>.example.com/</small></code></td>
                        <td><input id="enterprise_version" name="enterprise_version" value="1" type="checkbox" onclick="if(jQuery('#pro_version').is(':checked') && jQuery('#enterprise_version').is(':checked'))jQuery('#pro_version').prop('checked', false);RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/> <a href="https://gtranslate.io/?xyz=998#pricing" target="_blank" title="If you already have a subscription, you can enable this.">* <?php _e('for paid plans only', 'gtranslate'); ?></a></td>
                    </tr>
                    <tr id="url_translation_option" style="display:none;">
                        <td class="option_name"><?php _e('Enable URL Translation', 'gtranslate'); ?>:</td>
                        <td><input id="url_translation" name="url_translation" value="1" type="checkbox"/></td>
                    </tr>
                    <tr id="hreflang_tags_option" style="display:none;">
                        <td class="option_name"><?php _e('Add hreflang tags', 'gtranslate'); ?>:</td>
                        <td><input id="add_hreflang_tags" name="add_hreflang_tags" value="1" type="checkbox"/></td>
                    </tr>
                    <tr id="email_translation_option" style="display:none;">
                        <td class="option_name"><?php _e('Enable WooCommerce Email Translation', 'gtranslate'); ?>:</td>
                        <td><input id="email_translation" name="email_translation" value="1" type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr id="email_translation_debug_option" style="display:none;">
                        <td class="option_name"><?php _e('Debug Email Translation', 'gtranslate'); ?>:</td>
                        <td><input id="email_translation_debug" name="email_translation_debug" value="1" type="checkbox"/></td>
                    </tr>
                    <tr id="new_window_option" style="display:none;">
                        <td class="option_name"><?php _e('Open in new window', 'gtranslate'); ?>:</td>
                        <td><input id="new_window" name="new_window" value="1" type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr>
                        <td class="option_name"><?php _e('Analytics', 'gtranslate'); ?>:</td>
                        <td><input id="analytics" name="analytics" value="1" type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr id="auto_switch_option">
                        <td class="option_name"><?php _e('Auto switch to browser language', 'gtranslate'); ?>:</td>
                        <td><input id="detect_browser_language" name="detect_browser_language" value="1" type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr>
                        <td class="option_name"><?php _e('Show in menu', 'gtranslate'); ?>:</td>
                        <td>
                            <select id="show_in_menu" name="show_in_menu">
                                <option value="" selected> - <?php _e('None', 'gtranslate'); ?> - </option>
                                <?php $menus = get_registered_nav_menus(); ?>
                                <?php foreach($menus as $location => $description): ?>
                                <option value="<?php echo $location; ?>"><?php echo $description; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr id="floating_option">
                        <td class="option_name"><?php _e('Show floating language selector', 'gtranslate'); ?>:</td>
                        <td>
                            <select id="floating_language_selector" name="floating_language_selector">
                                <option value="no"><?php _e('No', 'gtranslate'); ?></option>
                                <option value="top_left"><?php _e('Top left', 'gtranslate'); ?></option>
                                <option value="top_left_sticky"><?php _e('Top left (no-scroll)', 'gtranslate'); ?></option>
                                <option value="top_right"><?php _e('Top right', 'gtranslate'); ?></option>
                                <option value="top_right_sticky"><?php _e('Top right (no-scroll)', 'gtranslate'); ?></option>
                                <option value="bottom_left"><?php _e('Bottom left', 'gtranslate'); ?></option>
                                <option value="bottom_left_sticky"><?php _e('Bottom left (no-scroll)', 'gtranslate'); ?></option>
                                <option value="bottom_right"><?php _e('Bottom right', 'gtranslate'); ?></option>
                                <option value="bottom_right_sticky"><?php _e('Bottom right (no-scroll)', 'gtranslate'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="option_name"><?php _e('Show native language names', 'gtranslate'); ?>:</td>
                        <td><input id="native_language_names" name="native_language_names" value="1" type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr id="flag_size_option">
                        <td class="option_name"><?php _e('Flag size', 'gtranslate'); ?>:</td>
                        <td>
                        <select id="flag_size"  name="flag_size" onchange="RefreshDoWidgetCode()">
                            <option value="16" selected>16px</option>
                            <option value="24">24px</option>
                            <option value="32">32px</option>
                            <option value="48">48px</option>
                        </select>
                        </td>
                    </tr>
                    <tr id="flag_monochrome_option">
                        <td class="option_name"><?php _e('Monochrome flags', 'gtranslate'); ?>:</td>
                        <td><input id="monochrome_flags" name="monochrome_flags" value="1" type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr id="flag_languages_option" style="display:none;">
                        <td class="option_name" colspan="2"><div><?php _e('Flag languages', 'gtranslate'); ?>: <a onclick="jQuery('.connectedSortable1 input').attr('checked', true);RefreshDoWidgetCode()" style="cursor:pointer;text-decoration:underline;"><?php _e('Check All', 'gtranslate'); ?></a> | <a onclick="jQuery('.connectedSortable1 input').attr('checked', false);RefreshDoWidgetCode()" style="cursor:pointer;text-decoration:underline;"><?php _e('Uncheck All', 'gtranslate'); ?></a> <span style="float:right;"><b>HINT</b>: To reorder the languages simply drag and drop them in the list below.</span></div><br />
                        <div>
                        <?php $gt_lang_codes = explode(',', $language_codes); ?>
                        <?php for($i = 0; $i < count($gt_lang_array) / 26; $i++): ?>
                        <ul style="list-style-type:none;width:25%;float:left;" class="connectedSortable1">
                            <?php for($j = $i * 26; $j < 26 * ($i+1); $j++): ?>
                            <?php if(isset($gt_lang_codes[$j])): ?>
                            <li><input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="fincl_langs<?php echo $gt_lang_codes[$j]; ?>" name="fincl_langs[]" value="<?php echo $gt_lang_codes[$j]; ?>"><label for="fincl_langs<?php echo $gt_lang_codes[$j]; ?>"><span class="en_names"><?php _e($gt_lang_array[$gt_lang_codes[$j]], 'gtranslate'); ?></span><span class="native_names" style="display:none;"><?php echo $native_names_map[$gt_lang_codes[$j]]; ?></span></label></li>
                            <?php endif; ?>
                            <?php endfor; ?>
                        </ul>
                        <?php endfor; ?>
                        </div>
                        </td>
                    </tr>
                    <tr id="alternative_flags_option" style="display:none;">
                        <td class="option_name" colspan="2"><?php _e('Alternative flags', 'gtranslate'); ?>:<br /><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_us" name="alt_flags[]" value="us"><label for="alt_us"><?php _e('USA flag', 'gtranslate'); ?> (<?php _e('English', 'gtranslate'); ?>)</label><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_ca" name="alt_flags[]" value="ca"><label for="alt_ca"><?php _e('Canada flag', 'gtranslate'); ?> (<?php _e('English', 'gtranslate'); ?>)</label><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_br" name="alt_flags[]" value="br"><label for="alt_br"><?php _e('Brazil flag', 'gtranslate'); ?> (<?php _e('Portuguese', 'gtranslate'); ?>)</label><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_mx" name="alt_flags[]" value="mx"><label for="alt_mx"><?php _e('Mexico flag', 'gtranslate'); ?> (<?php _e('Spanish', 'gtranslate'); ?>)</label><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_ar" name="alt_flags[]" value="ar"><label for="alt_ar"><?php _e('Argentina flag', 'gtranslate'); ?> (<?php _e('Spanish', 'gtranslate'); ?>)</label><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_co" name="alt_flags[]" value="co"><label for="alt_co"><?php _e('Colombia flag', 'gtranslate'); ?> (<?php _e('Spanish', 'gtranslate'); ?>)</label><br />
                        <input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="alt_qc" name="alt_flags[]" value="qc"><label for="alt_qc"><?php _e('Quebec flag', 'gtranslate'); ?> (<?php _e('French', 'gtranslate'); ?>)</label><br />
                        </td>
                    </tr>
                    <tr id="line_break_option" style="display:none;">
                        <td class="option_name"><?php _e('Line break after flags', 'gtranslate'); ?>:</td>
                        <td><input id="add_new_line" name="add_new_line" value="1" type="checkbox" checked="checked" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()"/></td>
                    </tr>
                    <tr id="dropdown_languages_option" style="display:none;">
                        <td class="option_name" colspan="2"><div><?php _e('Languages', 'gtranslate'); ?>: <a onclick="jQuery('.connectedSortable2 input').attr('checked', true);RefreshDoWidgetCode()" style="cursor:pointer;text-decoration:underline;"><?php _e('Check All', 'gtranslate'); ?></a> | <a onclick="jQuery('.connectedSortable2 input').attr('checked', false);RefreshDoWidgetCode()" style="cursor:pointer;text-decoration:underline;"><?php _e('Uncheck All', 'gtranslate'); ?></a> <span style="float:right;"><b>HINT</b>: To reorder the languages simply drag and drop them in the list below.</span></div><br />
                        <div>
                        <?php $gt_lang_codes = explode(',', $language_codes2); ?>
                        <?php for($i = 0; $i < count($gt_lang_array) / 26; $i++): ?>
                        <ul style="list-style-type:none;width:25%;float:left;" class="connectedSortable2">
                            <?php for($j = $i * 26; $j < 26 * ($i+1); $j++): ?>
                            <?php if(isset($gt_lang_codes[$j])): ?>
                            <li><input type="checkbox" onclick="RefreshDoWidgetCode()" onchange="RefreshDoWidgetCode()" id="incl_langs<?php echo $gt_lang_codes[$j]; ?>" name="incl_langs[]" value="<?php echo $gt_lang_codes[$j]; ?>"><label for="incl_langs<?php echo $gt_lang_codes[$j]; ?>"><span class="en_names"><?php _e($gt_lang_array[$gt_lang_codes[$j]], 'gtranslate'); ?></span><span class="native_names" style="display:none;"><?php echo $native_names_map[$gt_lang_codes[$j]]; ?></span></label></li>
                            <?php endif; ?>
                            <?php endfor; ?>
                        </ul>
                        <?php endfor; ?>
                        </div>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>

        <div id="poststuff">
            <div class="postbox">
                <h3 id="settings"><?php _e('Widget code (for advanced users)', 'gtranslate'); ?></h3>
                <div class="inside">
                    <p><?php _e('This area is for advanced users ONLY who know HTML/CSS/Javascript and do not want to use "Show floating language selector" option.', 'gtranslate'); ?></p>
                    <?php _e('You can edit this if you wish', 'gtranslate'); ?>:<br />
                    <textarea id="widget_code" name="widget_code" onchange="ShowWidgetPreview(this.value)" style="font-family:Monospace;font-size:11px;height:150px;width:565px;"><?php echo $widget_code; ?></textarea><br />
                    <a href="#" onclick="RefreshDoWidgetCode();return false;"><?php _e('Reset code to default'); ?></a><br /><br />
                    <span style="color:red;"><?php _e('DO NOT COPY THIS INTO YOUR POSTS OR PAGES! Use [GTranslate] shortcode inside the post/page <br />or add a GTranslate widget into your sidebar from Appearance -> Widgets instead.', 'gtranslate'); ?></span><br /><br />
                    <?php _e('You can also use <code>&lt;?php echo do_shortcode(\'[gtranslate]\'); ?&gt;</code> in your template header/footer files.', 'gtranslate'); ?>
                </div>
            </div>
        </div>

        <input type="hidden" name="switcher_text_color" id="switcher_text_color_hidden" value="<?php echo $switcher_text_color; ?>" />
        <input type="hidden" name="switcher_arrow_color" id="switcher_arrow_color_hidden" value="<?php echo $switcher_arrow_color; ?>" />
        <input type="hidden" name="switcher_border_color" id="switcher_border_color_hidden" value="<?php echo $switcher_border_color; ?>" />
        <input type="hidden" name="switcher_background_color" id="switcher_background_color_hidden" value="<?php echo $switcher_background_color; ?>" />
        <input type="hidden" name="switcher_background_shadow_color" id="switcher_background_shadow_color_hidden" value="<?php echo $switcher_background_shadow_color; ?>" />
        <input type="hidden" name="switcher_background_hover_color" id="switcher_background_hover_color_hidden" value="<?php echo $switcher_background_hover_color; ?>" />
        <input type="hidden" name="dropdown_text_color" id="dropdown_text_color_hidden" value="<?php echo $dropdown_text_color; ?>" />
        <input type="hidden" name="dropdown_hover_color" id="dropdown_hover_color_hidden" value="<?php echo $dropdown_hover_color; ?>" />
        <input type="hidden" name="dropdown_background_color" id="dropdown_background_color_hidden" value="<?php echo $dropdown_background_color; ?>" />

        <input type="hidden" id="language_codes_order" name="language_codes" value="<?php echo $language_codes; ?>" />
        <input type="hidden" id="language_codes_order2" name="language_codes2" value="<?php echo $language_codes2; ?>" />
        <?php wp_nonce_field('gtranslate-save'); ?>

        <p><label for="use_encoding" title="Turn this on if you are not able to Save Changes, this will help.">I have issues saving</label> <input type="checkbox" id="use_encoding" name="use_encoding" value="1" /></p>

        <p class="submit"><input type="submit" class="button-primary" name="save" value="<?php _e('Save Changes'); ?>" /></p>

        <p style="margin-top:-10px;"><a target="_blank" href="https://wordpress.org/support/plugin/gtranslate/reviews/?filter=5"><?php _e('Love GTranslate? Give us 5 stars on WordPress.org :)', 'gtranslate'); ?></a></p>

        </div>

        <script>
        function gt_validate_form() {
           if(document.getElementById('use_encoding').checked)
               document.getElementById('widget_code').value =  btoa(encodeURIComponent(document.getElementById('widget_code').value));

           return true;
        }
        </script>

        </form>

        <div class="postbox-container og_right_col">
            <div id="poststuff">
                <div class="postbox">
                    <h3 id="settings"><?php _e('Widget preview', 'gtranslate'); ?></h3>
                    <div class="inside">
                        <div id="widget_preview"></div>
                    </div>
                </div>
            </div>

            <div id="poststuff" class="switcher_color_options">
                <div class="postbox">
                    <h3 id="settings"><?php _e('Color options', 'gtranslate'); ?> ( <a href="#" onclick="return light_color_scheme()">light</a> | <a href="#" onclick="return dark_color_scheme()">dark</a> )</h3>
                    <div class="inside">
                        <table style="width:100%;" cellpadding="0">
                            <tr>
                                <td class="option_name"><?php _e('Switcher text color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="switcher_text_color" id="switcher_text_color" class="color-field" value="#666" data-default-color="#666" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Switcher arrow color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="switcher_arrow_color" id="switcher_arrow_color" class="color-field" value="#666" data-default-color="#666" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Switcher border color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="switcher_border_color" id="switcher_border_color" class="color-field" value="#ccc" data-default-color="#ccc" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Switcher background color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="switcher_background_color" id="switcher_background_color" class="color-field" value="#fff" data-default-color="#fff" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Switcher background shadow color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="switcher_background_shadow_color" id="switcher_background_shadow_color" class="color-field" value="#fff" data-default-color="#efefef" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Switcher background hover color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="switcher_background_hover_color" id="switcher_background_hover_color" class="color-field" value="#f0f0f0" data-default-color="#f0f0f0" /></td>
                            </tr>

                            <tr>
                                <td class="option_name"><?php _e('Dropdown text color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="dropdown_text_color" id="dropdown_text_color" class="color-field" value="#000" data-default-color="#000" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Dropdown hover color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="dropdown_hover_color" id="dropdown_hover_color" class="color-field" value="#fff" data-default-color="#fff" /></td>
                            </tr>
                            <tr>
                                <td class="option_name"><?php _e('Dropdown background color', 'gtranslate'); ?>:</td>
                                <td><input type="text" name="dropdown_background_color" id="dropdown_background_color" class="color-field" value="#eee" data-default-color="#eee" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div id="poststuff">
                <div class="postbox">
                    <h3 id="settings"><?php _e('Paid version advantages', 'gtranslate'); ?></h3>
                    <div class="inside">
                        <ul style="list-style-type:square;padding-left:20px;">
                            <li style="margin:0;"><?php _e('Search engine indexing', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Search engine friendly (SEF) URLs', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Human level neural translations', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Edit translations manually', 'gtranslate'); ?></li>
                            <li style="margin:0;"><a href="https://gtranslate.io/website-translation-quote" title="Website Translation Price Calculator" target="_blank"><?php _e('Automatic translation post-editing service and professional translations', 'gtranslate'); ?></a></li>
                            <li style="margin:0;"><?php _e('Meta data translation (keywords, page description, etc...)', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('URL/slug translation', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Language hosting (custom domain like example.fr, example.es)', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Seamless updates', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Increased international traffic and AdSense revenue', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Works in China', 'gtranslate'); ?></li>
                            <li style="margin:0;"><?php _e('Priority Live Chat support', 'gtranslate'); ?></li>
                        </ul>

                        <p><?php _e('Prices starting from <b>$7.99/month</b>!', 'gtranslate'); ?></p>

                        <a href="https://gtranslate.io/?xyz=998#pricing" target="_blank" class="button-primary"><?php _e('Try Now (15 days free)', 'gtranslate'); ?></a> <a href="https://gtranslate.io/?xyz=998#faq" target="_blank" class="button-primary"><?php _e('FAQ', 'gtranslate'); ?></a> <a href="https://gtranslate.io/website-translation-quote" target="_blank" class="button-primary"><?php _e('Website Translation Quote', 'gtranslate'); ?></a> <a href="https://gtranslate.io/?xyz=998#contact" target="_blank" class="button-primary"><?php _e('Live Chat', 'gtranslate'); ?></a>
                    </div>
                </div>
            </div>

            <div id="poststuff">
                <div class="postbox">
                    <h3 id="settings"><?php _e('Do you like GTranslate?', 'gtranslate'); ?></h3>
                    <div class="inside">
                        <p><?php _e('Give us 5 stars on', 'gtranslate'); ?> <a href="https://wordpress.org/support/plugin/gtranslate/reviews/?filter=5">WordPress.org</a> :)</p>

                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=231165476898475";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>

                        <div class="fb-page" data-href="https://www.facebook.com/gtranslate" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/gtranslate" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/gtranslate">GTranslate</a></blockquote></div>
                    </div>
                </div>
            </div>

            <div id="poststuff">
                <div class="postbox">
                    <h3 id="settings"><?php _e('Useful links', 'gtranslate'); ?></h3>
                    <div class="inside">
                        <style>
                        ul.useful_links_list {list-style-type:square;padding-left:20px;margin:0;}
                        ul.useful_links_list li {margin:0;}
                        ul.useful_links_list li a {text-decoration:none;}
                        </style>
                        <table style="width:100%;" cellpadding="4">
                            <tr>
                                <td>
                                    <ul class="useful_links_list">
                                        <li><a href="https://gtranslate.io/videos" target="_blank"><?php _e('Videos', 'gtranslate'); ?></a></li>
                                        <li><a href="https://docs.gtranslate.io/how-tos" target="_blank"><?php _e('How-tos', 'gtranslate'); ?></a></li>
                                        <li><a href="https://gtranslate.io/blog" target="_blank"><?php _e('Blog', 'gtranslate'); ?></a></li>
                                        <li><a href="https://gtranslate.io/about-us" target="_blank"><?php _e('About GTranslate team', 'gtranslate'); ?></a></li>
                                        <li><a href="https://gtranslate.io/?xyz=998#faq" target="_blank"><?php _e('FAQ', 'gtranslate'); ?></a></li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="useful_links_list">
                                        <li><a href="https://my.gtranslate.io/" target="_blank"><?php _e('User dashboard', 'gtranslate'); ?></a></li>
                                        <li><a href="https://gtranslate.io/?xyz=998#pricing" target="_blank"><?php _e('Compare plans', 'gtranslate'); ?></a></li>
                                        <li><a href="https://gtranslate.io/website-translation-quote" target="_blank"><?php _e('Website Translation Quote', 'gtranslate'); ?></a></li>
                                        <li><a href="https://wordpress.org/support/plugin/gtranslate/reviews/" target="_blank"><?php _e('Reviews', 'gtranslate'); ?></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div id="poststuff">
                <div class="postbox">
                    <h3 id="settings"><?php _e('GTranslate Tour Video', 'gtranslate'); ?></h3>
                    <div class="inside">
                        <iframe width="480" height="270" src="https://www.youtube.com/embed/R4mfiKGZh_g" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div id="poststuff">
                <div class="postbox">
                    <h3 id="settings"><?php _e('Live Chat', 'gtranslate'); ?></h3>
                    <div class="inside">
                        <p>9am - 6pm (Mon - Fri) New York Time</p>
                        <p><?php _e('We are here to make your experience with GTranslate more convenient.'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <script><?php echo $script; ?></script>
        <style>
        #widget_preview a:focus {box-shadow:none;outline:none;}
        .switcher_color_options button {box-shadow:none !important;border:1px solid #b4b9be !important;border-radius:0 !important;}
        .switcher_color_options h3 a {text-decoration:none;font-weight:400;}
        .switcher_color_options h3 a:hover {text-decoration:underline;}
        .postbox #settings {padding-left:12px;}
        .og_left_col {      width: 59%;     }
        .og_right_col {     width: 39%;     float: right;       }
        .og_left_col #poststuff,        .og_right_col #poststuff {      min-width: 0;       }
        table.form-table tr th,     table.form-table tr td {        line-height: 1.5;       }
        table.form-table tr th {        font-weight: bold;      }
        table.form-table tr th[scope=row] { min-width: 300px;       }
        table.form-table tr td hr {     height: 1px;        margin: 0px;        background-color: #DFDFDF;      border: none;       }
        table.form-table .dashicons-before {        margin-right: 10px;     font-size: 12px;        opacity: 0.5;       }
        table.form-table .dashicons-facebook-alt {      color: #3B5998;     }
        table.form-table .dashicons-googleplus {        color: #D34836;     }
        table.form-table .dashicons-twitter {       color: #55ACEE;     }
        table.form-table .dashicons-rss {       color: #FF6600;     }
        table.form-table .dashicons-admin-site,     table.form-table .dashicons-admin-generic {     color: #666;        }

        .connectedSortable1, .connectedSortable1 li, .connectedSortable2, .connectedSortable2 li {margin:0;padding:0;}
        .connectedSortable1 li label, .connectedSortable2 li label {cursor:move;}
        </style>

        <script>window.intercomSettings = {app_id: "r70azrgx", 'platform': 'wordpress', 'translate_from': '<?php echo $default_language; ?>', 'is_sub_directory': <?php echo (empty($pro_version) ? '0' : '1'); ?>, 'is_sub_domain': <?php echo (empty($enterprise_version) ? '0' : '1'); ?>};(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/r70azrgx';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>

        <?php
    }

    public static function control_options() {
        check_admin_referer('gtranslate-save');

        $data = get_option('GTranslate');
        if(!is_array($data))
            GTranslate::load_defaults($data);

        $data['pro_version'] = isset($_POST['pro_version']) ? intval($_POST['pro_version']) : '';
        $data['enterprise_version'] = isset($_POST['enterprise_version']) ? intval($_POST['enterprise_version']) : '';
        $data['url_translation'] = isset($_POST['url_translation']) ? intval($_POST['url_translation']) : '';
        $data['add_hreflang_tags'] = isset($_POST['add_hreflang_tags']) ? intval($_POST['add_hreflang_tags']) : '';
        $data['email_translation'] = isset($_POST['email_translation']) ? intval($_POST['email_translation']) : '';
        $data['email_translation_debug'] = isset($_POST['email_translation_debug']) ? intval($_POST['email_translation_debug']) : '';
        $data['new_window'] = isset($_POST['new_window']) ? intval($_POST['new_window']) : '';
        $data['show_in_menu'] = isset($_POST['show_in_menu']) ? sanitize_text_field($_POST['show_in_menu']) : '';
        $data['floating_language_selector'] = isset($_POST['floating_language_selector']) ? sanitize_text_field($_POST['floating_language_selector']) : 'no';
        $data['native_language_names'] = isset($_POST['native_language_names']) ? intval($_POST['native_language_names']) : '';
        $data['analytics'] = isset($_POST['analytics']) ? intval($_POST['analytics']) : '';
        $data['detect_browser_language'] = isset($_POST['detect_browser_language']) ? intval($_POST['detect_browser_language']) : '';
        $data['add_new_line'] = isset($_POST['add_new_line']) ? intval($_POST['add_new_line']) : '';
        $data['default_language'] = isset($_POST['default_language']) ? sanitize_text_field($_POST['default_language']) : 'en';
        $data['translation_method'] = 'onfly';
        $data['widget_look'] = isset($_POST['widget_look']) ? sanitize_text_field($_POST['widget_look']) : 'flags_dropdown';
        $data['flag_size'] = isset($_POST['flag_size']) ? intval($_POST['flag_size']) : '16';
        $data['monochrome_flags'] = isset($_POST['monochrome_flags']) ? intval($_POST['monochrome_flags']) : '';
        $data['incl_langs'] = (isset($_POST['incl_langs']) and is_array($_POST['incl_langs'])) ? $_POST['incl_langs'] : array($data['default_language']);
        $data['fincl_langs'] = (isset($_POST['fincl_langs']) and is_array($_POST['fincl_langs'])) ? $_POST['fincl_langs'] : array($data['default_language']);
        $data['alt_flags'] = (isset($_POST['alt_flags']) and is_array($_POST['alt_flags'])) ? $_POST['alt_flags'] : array();

        $data['switcher_text_color'] = isset($_POST['switcher_text_color']) ? $_POST['switcher_text_color'] : '#666';
        $data['switcher_arrow_color'] = isset($_POST['switcher_arrow_color']) ? $_POST['switcher_arrow_color'] : '#666';
        $data['switcher_border_color'] = isset($_POST['switcher_border_color']) ? $_POST['switcher_border_color'] : '#ccc';
        $data['switcher_background_color'] = isset($_POST['switcher_background_color']) ? $_POST['switcher_background_color'] : '#fff';
        $data['switcher_background_shadow_color'] = isset($_POST['switcher_background_shadow_color']) ? $_POST['switcher_background_shadow_color'] : '#efefef';
        $data['switcher_background_hover_color'] = isset($_POST['switcher_background_color']) ? $_POST['switcher_background_hover_color'] : '#f0f0f0';
        $data['dropdown_text_color'] = isset($_POST['dropdown_text_color']) ? $_POST['dropdown_text_color'] : '#000';
        $data['dropdown_hover_color'] = isset($_POST['dropdown_hover_color']) ? $_POST['dropdown_hover_color'] : '#fff'; // #ffc
        $data['dropdown_background_color'] = isset($_POST['dropdown_background_color']) ? $_POST['dropdown_background_color'] : '#eee';

        $data['language_codes'] = (isset($_POST['language_codes']) and !empty($_POST['language_codes'])) ? sanitize_text_field($_POST['language_codes']) : 'af,sq,ar,hy,az,eu,be,bg,ca,zh-CN,zh-TW,hr,cs,da,nl,en,et,tl,fi,fr,gl,ka,de,el,ht,iw,hi,hu,is,id,ga,it,ja,ko,lv,lt,mk,ms,mt,no,fa,pl,pt,ro,ru,sr,sk,sl,es,sw,sv,th,tr,uk,ur,vi,cy,yi';
        $data['language_codes2'] = (isset($_POST['language_codes2']) and !empty($_POST['language_codes2'])) ? sanitize_text_field($_POST['language_codes2']) : 'af,sq,am,ar,hy,az,eu,be,bn,bs,bg,ca,ceb,ny,zh-CN,zh-TW,co,hr,cs,da,nl,en,eo,et,tl,fi,fr,fy,gl,ka,de,el,gu,ht,ha,haw,iw,hi,hmn,hu,is,ig,id,ga,it,ja,jw,kn,kk,km,ko,ku,ky,lo,la,lv,lt,lb,mk,mg,ms,ml,mt,mi,mr,mn,my,ne,no,ps,fa,pl,pt,pa,ro,ru,sm,gd,sr,st,sn,sd,si,sk,sl,so,es,su,sw,sv,tg,ta,te,th,tr,uk,ur,uz,vi,cy,xh,yi,yo,zu';

        if(isset($_POST['use_encoding']) and intval($_POST['use_encoding']) == 1)
            $data['widget_code'] = isset($_POST['widget_code']) ? rawurldecode(base64_decode(stripslashes($_POST['widget_code']))) : '';
        else
            $data['widget_code'] = isset($_POST['widget_code']) ? stripslashes($_POST['widget_code']) : '';

        echo '<p style="color:red;">' . __('Changes Saved', 'gtranslate') . '</p>';
        update_option('GTranslate', $data);

        if($data['pro_version']) { // check if rewrite rules are in place
            $htaccess_file = get_home_path() . '.htaccess';
            // todo: use insert_with_markers functions instead
            if(is_writeable($htaccess_file)) {
                $htaccess = file_get_contents($htaccess_file);
                if(strpos($htaccess, 'gtranslate.php') === false) { // no config rules
                    $rewrite_rules = file_get_contents(dirname(__FILE__) . '/url_addon/rewrite.txt');
                    $rewrite_rules = str_replace('GTRANSLATE_PLUGIN_PATH', str_replace(str_replace(array('https:', 'http:'), array(':', ':'), home_url()), '', str_replace(array('https:', 'http:'), array(':', ':'), plugins_url())) . '/gtranslate', $rewrite_rules);

                    $htaccess = $rewrite_rules . "\r\n\r\n" . $htaccess;
                    if(!empty($htaccess)) { // going to update .htaccess
                        file_put_contents($htaccess_file, $htaccess);
                        echo '<p style="color:red;">' . __('.htaccess file updated', 'gtranslate') . '</p>';
                    }
                }
            } else {
                $rewrite_rules = file_get_contents(dirname(__FILE__) . '/url_addon/rewrite.txt');
                $rewrite_rules = str_replace('GTRANSLATE_PLUGIN_PATH', str_replace(home_url(), '', plugins_url()) . '/gtranslate', $rewrite_rules);

                echo '<p style="color:red;">' . __('Please add the following rules to the top of your .htaccess file', 'gtranslate') . '</p>';
                echo '<pre style="background-color:#eaeaea;">' . $rewrite_rules . '</pre>';
            }

            // update main_lang in config.php
            $config_file = dirname(__FILE__) . '/url_addon/config.php';
            if(is_writable($config_file)) {
                $config = file_get_contents($config_file);
                $config = preg_replace('/\$main_lang = \'[a-z-]{2,5}\'/i', '$main_lang = \''.$data['default_language'].'\'', $config);
                file_put_contents($config_file, $config);
            } else {
                echo '<p style="color:red;">' . __('Cannot update gtranslate/url_addon/config.php file. Make sure to update it manually and set correct $main_lang.', 'gtranslate') . '</p>';
            }

        } else { // todo: remove rewrite rules
            // do nothing
        }
    }

    public static function load_defaults(& $data) {
        if(!is_array($data))
            $data = array();

        $data['pro_version'] = isset($data['pro_version']) ? $data['pro_version'] : '';
        $data['enterprise_version'] = isset($data['enterprise_version']) ? $data['enterprise_version'] : '';
        $data['url_translation'] = isset($data['url_translation']) ? $data['url_translation'] : '';
        $data['add_hreflang_tags'] = isset($data['add_hreflang_tags']) ? $data['add_hreflang_tags'] : '';
        $data['email_translation'] = isset($data['email_translation']) ? $data['email_translation'] : '';
        $data['email_translation_debug'] = isset($data['email_translation_debug']) ? $data['email_translation_debug'] : '';
        $data['new_window'] = isset($data['new_window']) ? $data['new_window'] : '';
        $data['show_in_menu'] = isset($data['show_in_menu']) ? $data['show_in_menu'] : ((isset($data['show_in_primary_menu']) and $data['show_in_primary_menu'] == 1) ? 'primary' : '');
        $data['floating_language_selector'] = isset($data['floating_language_selector']) ? $data['floating_language_selector'] : 'no';
        $data['native_language_names'] = isset($data['native_language_names']) ? $data['native_language_names'] : '';
        $data['analytics'] = isset($data['analytics']) ? $data['analytics'] : '';
        $data['detect_browser_language'] = isset($data['detect_browser_language']) ? $data['detect_browser_language'] : '';
        $data['add_new_line'] = isset($data['add_new_line']) ? $data['add_new_line'] : '1';

        if(!isset($data['default_language'])) {
            $locale_map = array('af'=>'af','am'=>'am','arq'=>'ar','ar'=>'ar','ary'=>'ar','az'=>'az','az_TR'=>'az','azb'=>'az','bel'=>'be','bg_BG'=>'bg','bn_BD'=>'bn','bs_BA'=>'bs','ca'=>'ca','bal'=>'ca','ceb'=>'ceb','co'=>'co','cs_CZ'=>'cs','cy'=>'cy','da_DK'=>'da','de_DE'=>'de','de_CH'=>'de','gsw'=>'de','el'=>'el','en_AU'=>'en','en_CA'=>'en','en_NZ'=>'en','en_ZA'=>'en','en_GB'=>'en','eo'=>'eo','es_AR'=>'es','es_CL'=>'es','es_CO'=>'es','es_GT'=>'es','es_MX'=>'es','es_PE'=>'es','es_PR'=>'es','es_ES'=>'es','es_VE'=>'es','et'=>'et','eu'=>'eu','fa_IR'=>'fa','fa_AF'=>'fa','fi'=>'fi','fr_BE'=>'fr','fr_CA'=>'fr','fr_FR'=>'fr','fy'=>'fy','ga'=>'ga','gd'=>'gd','gl_ES'=>'gl','gu'=>'gu','hau'=>'ha','haw_US'=>'haw','hi_IN'=>'hi','hr'=>'hr','hat'=>'ht','hu_HU'=>'hu','hy'=>'hy','id_ID'=>'id','is_IS'=>'is','it_IT'=>'it','he_IL'=>'iw','ja'=>'ja','jv_ID'=>'jw','ka_GE'=>'ka','kk'=>'kk','km'=>'km','kn'=>'kn','ko_KR'=>'ko','ckb'=>'ku','kir'=>'ky','lb_LU'=>'lb','lo'=>'lo','lt_LT'=>'lt','lv'=>'lv','mg_MG'=>'mg','mri'=>'mi','mk_MK'=>'mk','ml_IN'=>'ml','mn'=>'mn','mr'=>'mr','ms_MY'=>'ms','my_MM'=>'my','ne_NP'=>'ne','nl_NL'=>'nl','nl_BE'=>'nl','nb_NO'=>'no','nn_NO'=>'no','pa_IN'=>'pa','pl_PL'=>'pl','ps'=>'ps','pt_BR'=>'pt','pt_PT'=>'pt','ro_RO'=>'ro','ru_RU'=>'ru','snd'=>'sd','si_LK'=>'si','sk_SK'=>'sk','sl_SI'=>'sl','so_SO'=>'so','sq'=>'sq','sr_RS'=>'sr','su_ID'=>'su','sv_SE'=>'sv','sw'=>'sw','ta_IN'=>'ta','ta_LK'=>'ta','te'=>'te','tg'=>'tg','th'=>'th','tr_TR'=>'tr','uk'=>'uk','ur'=>'ur','uz_UZ'=>'uz','vi'=>'vi','xho'=>'xh','yor'=>'yo','zh_CN'=>'zh-CN','zh_HK'=>'zh-CN','zh_TW'=>'zh-TW');
            $locale = get_locale();
            $data['default_language'] = isset($locale_map[$locale]) ? $locale_map[$locale] : 'en';
        }

        $data['translation_method'] = isset($data['translation_method']) ? $data['translation_method'] : 'onfly';
        if($data['translation_method'] == 'on_fly') $data['translation_method'] = 'redirect';

        $data['widget_look'] = isset($data['widget_look']) ? $data['widget_look'] : 'dropdown_with_flags';
        $data['flag_size'] = isset($data['flag_size']) ? $data['flag_size'] : '24';
        $data['monochrome_flags'] = isset($data['monochrome_flags']) ? $data['monochrome_flags'] : '';
        $data['widget_code'] = isset($data['widget_code']) ? $data['widget_code'] : '';
        $data['incl_langs'] = isset($data['incl_langs']) ? $data['incl_langs'] : array('en', 'es', 'it', 'pt', 'de', 'fr', 'ru', 'nl', 'ar', 'zh-CN');
        $data['fincl_langs'] = isset($data['fincl_langs']) ? $data['fincl_langs'] : array('en', 'es', 'it', 'pt', 'de', 'fr', 'ru', 'nl', 'ar', 'zh-CN');
        $data['alt_flags'] = isset($data['alt_flags']) ? $data['alt_flags'] : array();

        $data['switcher_text_color'] = isset($data['switcher_text_color']) ? $data['switcher_text_color'] : '#666';
        $data['switcher_arrow_color'] = isset($data['switcher_arrow_color']) ? $data['switcher_arrow_color'] : '#666';
        $data['switcher_border_color'] = isset($data['switcher_border_color']) ? $data['switcher_border_color'] : '#ccc';
        $data['switcher_background_color'] = isset($data['switcher_background_color']) ? $data['switcher_background_color'] : '#fff';
        $data['switcher_background_shadow_color'] = isset($data['switcher_background_shadow_color']) ? $data['switcher_background_shadow_color'] : '#efefef';
        $data['switcher_background_hover_color'] = isset($data['switcher_background_hover_color']) ? $data['switcher_background_hover_color'] : '#fff';
        $data['dropdown_text_color'] = isset($data['dropdown_text_color']) ? $data['dropdown_text_color'] : '#000';
        $data['dropdown_hover_color'] = isset($data['dropdown_hover_color']) ? $data['dropdown_hover_color'] : '#fff'; // #ffc
        $data['dropdown_background_color'] = isset($data['dropdown_background_color']) ? $data['dropdown_background_color'] : '#eee';

        $data['language_codes'] = (isset($data['language_codes']) and !empty($data['language_codes'])) ? $data['language_codes'] : 'af,sq,am,ar,hy,az,eu,be,bn,bs,bg,ca,ceb,ny,zh-CN,zh-TW,co,hr,cs,da,nl,en,eo,et,tl,fi,fr,fy,gl,ka,de,el,gu,ht,ha,haw,iw,hi,hmn,hu,is,ig,id,ga,it,ja,jw,kn,kk,km,ko,ku,ky,lo,la,lv,lt,lb,mk,mg,ms,ml,mt,mi,mr,mn,my,ne,no,ps,fa,pl,pt,pa,ro,ru,sm,gd,sr,st,sn,sd,si,sk,sl,so,es,su,sw,sv,tg,ta,te,th,tr,uk,ur,uz,vi,cy,xh,yi,yo,zu';
        $data['language_codes2'] = (isset($data['language_codes2']) and !empty($data['language_codes2'])) ? $data['language_codes2'] : 'af,sq,am,ar,hy,az,eu,be,bn,bs,bg,ca,ceb,ny,zh-CN,zh-TW,co,hr,cs,da,nl,en,eo,et,tl,fi,fr,fy,gl,ka,de,el,gu,ht,ha,haw,iw,hi,hmn,hu,is,ig,id,ga,it,ja,jw,kn,kk,km,ko,ku,ky,lo,la,lv,lt,lb,mk,mg,ms,ml,mt,mi,mr,mn,my,ne,no,ps,fa,pl,pt,pa,ro,ru,sm,gd,sr,st,sn,sd,si,sk,sl,so,es,su,sw,sv,tg,ta,te,th,tr,uk,ur,uz,vi,cy,xh,yi,yo,zu';

        // add missing languages once
        if(strlen($data['language_codes']) < strlen($data['language_codes2']))
            $data['language_codes'] = $data['language_codes2'];
    }
}

class GTranslateWidget extends WP_Widget {

    function __construct() {
        parent::__construct('gtranslate', esc_html__('GTranslate', 'gtranslate'), array('description' => esc_html__('GTranslate language switcher', 'gtranslate')));
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        if(!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        if(empty($data['widget_code']))
            _e('<b>Notice:</b> Please configure GTranslate from WP-Admin -> Settings -> GTranslate to see it in action.', 'gtranslate');
        else
            echo $data['widget_code'];

        // avoid caching issues
        if($data['widget_look'] == 'dropdown_with_flags' and ($data['pro_version'] or $data['enterprise_version'])) {
            echo '<script>jQuery(document).ready(function() {var lang_html = jQuery(".switcher div.option a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'.switcher div.selected a\').html(lang_html.replace("data-gt-lazy-", ""))});</script>';
        } elseif($data['widget_look'] == 'popup' and ($data['pro_version'] or $data['enterprise_version'])) {
            echo '<script>jQuery(document).ready(function() {var lang_html = jQuery(".gt_languages a[onclick*=\'|"+jQuery(\'html\').attr(\'lang\')+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');});</script>';
        }

        // detect browser language
        if(!($data['pro_version'] or $data['enterprise_version']) and $data['detect_browser_language']) {
            if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
                $allowed_languages = $data['fincl_langs'];
            elseif($data['widget_look'] == 'flags_dropdown')
                $allowed_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
            else
                $allowed_languages = $data['incl_langs'];
            $allowed_languages = json_encode($allowed_languages);

            echo "<script>jQuery(document).ready(function() {";
            echo "var allowed_languages = $allowed_languages;var accept_language = navigator.language.toLowerCase() || navigator.userLanguage.toLowerCase();switch(accept_language) {case 'zh-cn': var preferred_language = 'zh-CN'; break;case 'zh': var preferred_language = 'zh-CN'; break;case 'zh-tw': var preferred_language = 'zh-TW'; break;case 'zh-hk': var preferred_language = 'zh-TW'; break;default: var preferred_language = accept_language.substr(0, 2); break;}if(preferred_language != '".$data['default_language']."' && GTranslateGetCurrentLang() == null && document.cookie.match('gt_auto_switch') == null && allowed_languages.indexOf(preferred_language) >= 0){doGTranslate('".$data['default_language']."|'+preferred_language);document.cookie = 'gt_auto_switch=1; expires=Thu, 05 Dec 2030 08:08:08 UTC; path=/;';";
            if($data['widget_look'] == 'dropdown_with_flags') {
                echo "var lang_html = jQuery('div.switcher div.option').find('img[alt=\"'+preferred_language+'\"]').parent().html();if(typeof lang_html != 'undefined')jQuery('div.switcher div.selected a').html(lang_html.replace('data-gt-lazy-', ''));";
            } elseif($data['widget_look'] == 'popup') {
                echo 'var lang_html = jQuery(".gt_languages a[onclick*=\'|"+preferred_language+"\']").html();if(typeof lang_html != "undefined")jQuery(\'a.switcher-popup\').html(lang_html.replace("data-gt-lazy-", "")+\'<span style=\"color:#666;font-size:8px;font-weight:bold;\">&#9660;</span>\');';
            }
            echo "}});</script>";
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'gtranslate'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }

}

class GTranslate_Notices {
    protected $prefix = 'gtranslate';
    public $notice_spam = 0;
    public $notice_spam_max = 3;

    // Basic actions to run
    public function __construct() {
        // Runs the admin notice ignore function incase a dismiss button has been clicked
        add_action('admin_init', array($this, 'admin_notice_ignore'));
        // Runs the admin notice temp ignore function incase a temp dismiss link has been clicked
        add_action('admin_init', array($this, 'admin_notice_temp_ignore'));

        // Adding notices
        add_action('admin_notices', array($this, 'gt_admin_notices'));
    }

    // Checks to ensure notices aren't disabled and the user has the correct permissions.
    public function gt_admin_notice() {

        $gt_settings = get_option($this->prefix . '_admin_notice');
        if (!isset($gt_settings['disable_admin_notices']) || (isset($gt_settings['disable_admin_notices']) && $gt_settings['disable_admin_notices'] == 0)) {
            if (current_user_can('manage_options')) {
                return true;
            }
        }
        return false;
    }

    // Primary notice function that can be called from an outside function sending necessary variables
    public function admin_notice($admin_notices) {

        // Check options
        if (!$this->gt_admin_notice()) {
            return false;
        }

        foreach ($admin_notices as $slug => $admin_notice) {
            // Call for spam protection

            if ($this->anti_notice_spam()) {
                return false;
            }

            // Check for proper page to display on
            if (isset( $admin_notices[$slug]['pages']) and is_array( $admin_notices[$slug]['pages'])) {

                if (!$this->admin_notice_pages($admin_notices[$slug]['pages'])) {
                    return false;
                }

            }

            // Check for required fields
            if (!$this->required_fields($admin_notices[$slug])) {

                // Get the current date then set start date to either passed value or current date value and add interval
                $current_date = current_time("n/j/Y");
                $start = (isset($admin_notices[$slug]['start']) ? $admin_notices[$slug]['start'] : $current_date);
                $start = date("n/j/Y", strtotime($start));
                $end = ( isset( $admin_notices[ $slug ]['end'] ) ? $admin_notices[ $slug ]['end'] : $start );
                $end = date( "n/j/Y", strtotime( $end ) );
                $date_array = explode('/', $start);
                $interval = (isset($admin_notices[$slug]['int']) ? $admin_notices[$slug]['int'] : 0);
                $date_array[1] += $interval;
                $start = date("n/j/Y", mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));
                // This is the main notices storage option
                $admin_notices_option = get_option($this->prefix . '_admin_notice', array());
                // Check if the message is already stored and if so just grab the key otherwise store the message and its associated date information
                if (!array_key_exists( $slug, $admin_notices_option)) {
                    $admin_notices_option[$slug]['start'] = $start;
                    $admin_notices_option[$slug]['int'] = $interval;
                    update_option($this->prefix . '_admin_notice', $admin_notices_option);
                }

                // Sanity check to ensure we have accurate information
                // New date information will not overwrite old date information
                $admin_display_check = (isset($admin_notices_option[$slug]['dismissed']) ? $admin_notices_option[$slug]['dismissed'] : 0);
                $admin_display_start = (isset($admin_notices_option[$slug]['start']) ? $admin_notices_option[$slug]['start'] : $start);
                $admin_display_interval = (isset($admin_notices_option[$slug]['int']) ? $admin_notices_option[$slug]['int'] : $interval);
                $admin_display_msg = (isset($admin_notices[$slug]['msg']) ? $admin_notices[$slug]['msg'] : '');
                $admin_display_title = (isset($admin_notices[$slug]['title']) ? $admin_notices[$slug]['title'] : '');
                $admin_display_link = (isset($admin_notices[$slug]['link']) ? $admin_notices[$slug]['link'] : '');
                $admin_display_dismissible= (isset($admin_notices[$slug]['dismissible']) ? $admin_notices[$slug]['dismissible'] : true);
                $output_css = false;

                // Ensure the notice hasn't been hidden and that the current date is after the start date
                if ($admin_display_check == 0 and strtotime($admin_display_start) <= strtotime($current_date)) {
                    // Get remaining query string
                    $query_str = esc_url(add_query_arg($this->prefix . '_admin_notice_ignore', $slug));

                    // Admin notice display output
                    echo '<div class="update-nag gt-admin-notice">';
                    echo '<div class="gt-notice-logo"></div>';
                    echo ' <p class="gt-notice-title">';
                    echo $admin_display_title;
                    echo ' </p>';
                    echo ' <p class="gt-notice-body">';
                    echo $admin_display_msg;
                    echo ' </p>';
                    echo '<ul class="gt-notice-body gt-red">
                          ' . $admin_display_link . '
                        </ul>';
                    if($admin_display_dismissible)
                        echo '<a href="' . $query_str . '" class="dashicons dashicons-dismiss"></a>';
                    echo '</div>';

                    $this->notice_spam += 1;
                    $output_css = true;
                }

                if ($output_css) {
                    wp_enqueue_style($this->prefix . '-admin-notices', plugins_url(plugin_basename(dirname(__FILE__))) . '/gtranslate-notices.css', array());
                }
            }

        }
    }

    // Spam protection check
    public function anti_notice_spam() {
        if ($this->notice_spam >= $this->notice_spam_max) {
            return true;
        }
        return false;
    }

    // Ignore function that gets ran at admin init to ensure any messages that were dismissed get marked
    public function admin_notice_ignore() {
        // If user clicks to ignore the notice, update the option to not show it again
        if (isset($_GET[$this->prefix . '_admin_notice_ignore'])) {
            $admin_notices_option = get_option($this->prefix . '_admin_notice', array());

            $key = $_GET[$this->prefix . '_admin_notice_ignore'];
            if(!preg_match('/^[a-z_0-9]+$/i', $key))
                return;

            $admin_notices_option[$key]['dismissed'] = 1;
            update_option($this->prefix . '_admin_notice', $admin_notices_option);
            $query_str = remove_query_arg($this->prefix . '_admin_notice_ignore');
            wp_redirect($query_str);
            exit;
        }
    }

    // Temp Ignore function that gets ran at admin init to ensure any messages that were temp dismissed get their start date changed
    public function admin_notice_temp_ignore() {
        // If user clicks to temp ignore the notice, update the option to change the start date - default interval of 14 days
        if (isset($_GET[$this->prefix . '_admin_notice_temp_ignore'])) {
            $admin_notices_option = get_option($this->prefix . '_admin_notice', array());
            $current_date = current_time("n/j/Y");
            $date_array   = explode('/', $current_date);
            $interval     = (isset($_GET['gt_int']) ? intval($_GET['gt_int']) : 14);
            $date_array[1] += $interval;
            $new_start = date("n/j/Y", mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]));

            $key = $_GET[$this->prefix . '_admin_notice_temp_ignore'];
            if(!preg_match('/^[a-z_0-9]+$/i', $key))
                return;

            $admin_notices_option[$key]['start'] = $new_start;
            $admin_notices_option[$key]['dismissed'] = 0;
            update_option($this->prefix . '_admin_notice', $admin_notices_option);
            $query_str = remove_query_arg(array($this->prefix . '_admin_notice_temp_ignore', 'gt_int'));
            wp_redirect( $query_str );
            exit;
        }
    }

    public function admin_notice_pages($pages) {
        foreach ($pages as $key => $page) {
            if (is_array($page)) {
                if (isset($_GET['page']) and $_GET['page'] == $page[0] and isset($_GET['tab']) and $_GET['tab'] == $page[1]) {
                    return true;
                }
            } else {
                if ($page == 'all') {
                    return true;
                }
                if (get_current_screen()->id === $page) {
                    return true;
                }

                if (isset($_GET['page']) and $_GET['page'] == $page) {
                    return true;
                }
            }
        }

        return false;
    }

    // Required fields check
    public function required_fields( $fields ) {
        if (!isset( $fields['msg']) or (isset($fields['msg']) and empty($fields['msg']))) {
            return true;
        }
        if (!isset( $fields['title']) or (isset($fields['title']) and empty($fields['title']))) {
            return true;
        }
        return false;
    }

    // Special parameters function that is to be used in any extension of this class
    public function special_parameters($admin_notices) {
        // Intentionally left blank
    }

    public function gt_admin_notices() {

        $deactivate_plugins= array('WP Translator' => 'wptranslator/WPTranslator.php', 'TranslatePress' => 'translatepress-multilingual/index.php', 'Google Language Translator' => 'google-language-translator/google-language-translator.php', 'Google Website Translator' => 'google-website-translator/google-website-translator.php', 'Weglot' => 'weglot/weglot.php', 'TransPosh' => 'transposh-translation-filter-for-wordpress/transposh.php');
        foreach($deactivate_plugins as $name => $plugin_file) {
            if(is_plugin_active($plugin_file)) {
                $deactivate_link = wp_nonce_url('plugins.php?action=deactivate&amp;plugin='.urlencode($plugin_file ).'&amp;plugin_status=all&amp;paged=1&amp;s=', 'deactivate-plugin_' . $plugin_file);
                $notices['deactivate_plugin_'.strtolower(str_replace(' ', '', $name))] = array(
                    'title' => sprintf(__('Please deactivate %s plugin', 'gtranslate'), $name),
                    'msg' => sprintf(__('%s plugin causes conflicts with GTranslate.', 'gtranslate'), $name),
                    'link' => '<li><span class="dashicons dashicons-dismiss"></span><a href="'.$deactivate_link.'">' . sprintf(__('Deactivate %s plugin', 'gtranslate'), $name) . '</a></li>',
                    'dismissible' => false,
                    'int' => 0
                );
            }
        }

        /*
        $one_week_support = esc_url(add_query_arg(array($this->prefix . '_admin_notice_ignore' => 'one_week_support')));

        $notices['one_week_support'] = array(
          'title' => __('Hey! How is it going?', 'gtranslate'),
          'msg' => __('Thank you for using GTranslate! We hope that you have found everything you need, but if you have any questions you can use our Live Chat or Forum:', 'gtranslate'),
          'link' => '<li><span class="dashicons dashicons-admin-comments"></span><a target="_blank" href="https://gtranslate.io/#contact">' . __('Get help', 'gtranslate') . '</a></li>' .
                    '<li><span class="dashicons dashicons-format-video"></span><a target="_blank" href="https://gtranslate.io/videos">'.__('Check videos', 'gtranslate') . '</a></li>' .
                    '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $one_week_support . '">' . __('Never show again', 'gtranslate') . '</a></li>',
          'int' => 1
        );
        */

        $two_week_review_ignore = esc_url(add_query_arg(array($this->prefix . '_admin_notice_ignore' => 'two_week_review')));
        $two_week_review_temp = esc_url(add_query_arg(array($this->prefix . '_admin_notice_temp_ignore' => 'two_week_review', 'gt_int' => 6)));

        $notices['two_week_review'] = array(
            'title' => __('Please Leave a Review', 'gtranslate'),
            'msg' => __("We hope you have enjoyed using GTranslate! Would you mind taking a few minutes to write a review on WordPress.org? <br>Just writing a simple <b>'thank you'</b> will make us happy!", 'gtranslate'),
            'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://wordpress.org/support/plugin/gtranslate/reviews/?filter=5" target="_blank">' . __('Sure! I would love to!', 'gtranslate') . '</a></li>' .
                      '<li><span class="dashicons dashicons-smiley"></span><a href="' . $two_week_review_ignore . '">' . __('I have already left a review', 'gtranslate') . '</a></li>' .
                      '<li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $two_week_review_temp . '">' . __('Maybe later', 'gtranslate') . '</a></li>' .
                      '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $two_week_review_ignore . '">' . __('Never show again', 'gtranslate') . '</a></li>',
            'later_link' => $two_week_review_temp,
            'int' => 5
        );

        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        $upgrade_tips_ignore = esc_url(add_query_arg(array($this->prefix . '_admin_notice_ignore' => 'upgrade_tips')));
        $upgrade_tips_temp = esc_url(add_query_arg(array($this->prefix . '_admin_notice_temp_ignore' => 'upgrade_tips', 'gt_int' => 7)));

        if($data['pro_version'] != '1' and $data['enterprise_version'] != '1') {
            $notices['upgrade_tips'][] = array(
                'title' => __('Did you know?', 'gtranslate'),
                'msg' => __('You can have <b>neural machine translations</b> which are human level by upgrading your GTranslate.', 'gtranslate'),
                'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://gtranslate.io/?xyz=998#pricing" target="_blank">' . __('Learn more', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $upgrade_tips_temp . '">' . __('Maybe later', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $upgrade_tips_ignore . '">' . __('Never show again', 'gtranslate') . '</a></li>',
                'later_link' => $upgrade_tips_temp,
                'int' => 2
            );

            $notices['upgrade_tips'][] = array(
                'title' => __('Did you know?', 'gtranslate'),
                'msg' => __('You can <b>increase</b> your international <b>traffic</b> by upgrading your GTranslate.', 'gtranslate'),
                'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://gtranslate.io/?xyz=998#pricing" target="_blank">' . __('Learn more', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $upgrade_tips_temp . '">' . __('Maybe later', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $upgrade_tips_ignore . '">' . __('Never show again', 'gtranslate') . '</a></li>',
                'later_link' => $upgrade_tips_temp,
                'int' => 2
            );

            $notices['upgrade_tips'][] = array(
                'title' => __('Did you know?', 'gtranslate'),
                'msg' => __('You can have your <b>translated pages indexed</b> in search engines by upgrading your GTranslate.', 'gtranslate'),
                'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://gtranslate.io/?xyz=998#pricing" target="_blank">' . __('Learn more', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $upgrade_tips_temp . '">' . __('Maybe later', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $upgrade_tips_ignore . '">' . __('Never show again', 'gtranslate') . '</a></li>',
                'later_link' => $upgrade_tips_temp,
                'int' => 2
            );

            $notices['upgrade_tips'][] = array(
                'title' => __('Did you know?', 'gtranslate'),
                'msg' => __('You can <b>increase</b> your <b>AdSense revenue</b> by upgrading your GTranslate.', 'gtranslate'),
                'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://gtranslate.io/?xyz=998#pricing" target="_blank">' . __('Learn more', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $upgrade_tips_temp . '">' . __('Maybe later', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $upgrade_tips_ignore . '">' . __('Never show again', 'gtranslate') . '</a></li>',
                'later_link' => $upgrade_tips_temp,
                'int' => 2
            );

            $notices['upgrade_tips'][] = array(
                'title' => __('Did you know?', 'gtranslate'),
                'msg' => __('You can <b>edit translations</b> by upgrading your GTranslate.', 'gtranslate'),
                'link' => '<li><span class="dashicons dashicons-external"></span><a href="https://gtranslate.io/?xyz=998#pricing" target="_blank">' . __('Learn more', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-calendar-alt"></span><a href="' . $upgrade_tips_temp . '">' . __('Maybe later', 'gtranslate') . '</a></li>' .
                          '<li><span class="dashicons dashicons-dismiss"></span><a href="' . $upgrade_tips_ignore . '">' . __('Never show again', 'gtranslate') . '</a></li>',
                'later_link' => $upgrade_tips_temp,
                'int' => 2
            );

            shuffle($notices['upgrade_tips']);
            $notices['upgrade_tips'] = $notices['upgrade_tips'][0];
        }

        $this->admin_notice($notices);
    }

}

if(is_admin()) {
    global $pagenow;

    if(!defined('DOING_AJAX') or !DOING_AJAX)
        new GTranslate_Notices();
}

$data = get_option('GTranslate');
GTranslate::load_defaults($data);

if($data['pro_version']) { // gtranslate redirect rules with PHP (for environments with no .htaccess support (pantheon, flywheel, etc.), usually .htaccess rules override this)

    @list($request_uri, $query_params) = explode('?', $_SERVER['REQUEST_URI']);

    if(preg_match('/^\/(af|sq|am|ar|hy|az|eu|be|bn|bs|bg|ca|ceb|ny|zh-CN|zh-TW|co|hr|cs|da|nl|en|eo|et|tl|fi|fr|fy|gl|ka|de|el|gu|ht|ha|haw|iw|hi|hmn|hu|is|ig|id|ga|it|ja|jw|kn|kk|km|ko|ku|ky|lo|la|lv|lt|lb|mk|mg|ms|ml|mt|mi|mr|mn|my|ne|no|ps|fa|pl|pt|pa|ro|ru|sm|gd|sr|st|sn|sd|si|sk|sl|so|es|su|sw|sv|tg|ta|te|th|tr|uk|ur|uz|vi|cy|xh|yi|yo|zu)\/(af|sq|am|ar|hy|az|eu|be|bn|bs|bg|ca|ceb|ny|zh-CN|zh-TW|co|hr|cs|da|nl|en|eo|et|tl|fi|fr|fy|gl|ka|de|el|gu|ht|ha|haw|iw|hi|hmn|hu|is|ig|id|ga|it|ja|jw|kn|kk|km|ko|ku|ky|lo|la|lv|lt|lb|mk|mg|ms|ml|mt|mi|mr|mn|my|ne|no|ps|fa|pl|pt|pa|ro|ru|sm|gd|sr|st|sn|sd|si|sk|sl|so|es|su|sw|sv|tg|ta|te|th|tr|uk|ur|uz|vi|cy|xh|yi|yo|zu)\/(.*)$/', $request_uri, $matches)) {
        header('Location: ' . '/' . $matches[1] . '/' . $matches[3] . (empty($query_params) ? '' : '?'.$query_params), true, 301);
        exit;
    } // #1 redirect double language codes /es/en/...

    if(preg_match('/^\/(af|sq|am|ar|hy|az|eu|be|bn|bs|bg|ca|ceb|ny|zh-CN|zh-TW|co|hr|cs|da|nl|en|eo|et|tl|fi|fr|fy|gl|ka|de|el|gu|ht|ha|haw|iw|hi|hmn|hu|is|ig|id|ga|it|ja|jw|kn|kk|km|ko|ku|ky|lo|la|lv|lt|lb|mk|mg|ms|ml|mt|mi|mr|mn|my|ne|no|ps|fa|pl|pt|pa|ro|ru|sm|gd|sr|st|sn|sd|si|sk|sl|so|es|su|sw|sv|tg|ta|te|th|tr|uk|ur|uz|vi|cy|xh|yi|yo|zu)$/', $request_uri)) {
        header('Location: ' . $request_uri . '/' . (empty($query_params) ? '' : '?'.$query_params), true, 301);
        exit;
    } // #2 add trailing slash

    if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
        $allowed_languages = $data['fincl_langs'];
    elseif($data['widget_look'] == 'flags_dropdown')
        $allowed_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
    else
        $allowed_languages = $data['incl_langs'];
    $allowed_languages = implode('|', $allowed_languages); // ex: en|ru|it|de
    if(preg_match('/^\/('.$allowed_languages.')\/(.*)/', $request_uri, $matches)) {
        $_GET['glang'] = $matches[1];
        $_GET['gurl'] = rawurldecode($matches[2]);

        require_once dirname(__FILE__) . '/url_addon/gtranslate.php';
        exit;
    } // #3 proxy translation
}

if(!empty($data['show_in_menu'])) {
    add_filter('wp_nav_menu_items', 'gtranslate_menu_item', 10, 2);
    function gtranslate_menu_item($items, $args) {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        if($args->theme_location == $data['show_in_menu']) {
            if($data['widget_look'] == 'dropdown_with_flags') {
                $items .= '<li style="position:relative;" class="menu-item menu-item-gtranslate">';
                $items .= '<div style="position:absolute;" id="gtranslate_wrapper">';
                $items .= GTranslate::get_widget_code(false);
                $items .= '</div>';
                $items .= '</li>';

            } else if($data['widget_look'] == 'globe' or $data['widget_look'] == 'dropdown' or $data['widget_look'] == 'flags_dropdown') {
                $items .= '<li style="position:relative;" class="menu-item menu-item-gtranslate">';
                $items .= GTranslate::get_widget_code(false);
                $items .= '</li>';

                if($data['widget_look'] == 'flags_dropdown') {
                    $items .= '<style>.menu-item-gtranslate a {display:inline !important;padding:0 !important;margin:0 !important;}</style>';
                }

            } else {
                // optimize menu look
                $html = GTranslate::get_widget_code(false);
                $html = str_replace('<a ', '<li style="position:relative;" class="menu-item menu-item-gtranslate"><a ', $html);
                $html = str_replace('</a>', '</a></li>', $html);

                $items = str_replace('gtranslate-parent', 'gtranslate-parent menu-item-has-children', $items);
                $parent_item_position = strpos($items, 'gtranslate-parent');
                if($parent_item_position !== false) {
                    $parent_link_position = strpos($items, '</a>', $parent_item_position);

                    $items = substr_replace($items, '</a><ul class="dropdown-menu sub-menu">'.$html.'</ul>', $parent_link_position, 4);
                } else {
                    $items .= $html;
                }
            }

        }

        return $items;
    }
}

if($data['floating_language_selector'] != 'no' and !is_admin()) {
    add_action('wp_footer', 'gtranslate_display_floating');
    function gtranslate_display_floating() {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        if($data['widget_look'] == 'dropdown_with_flags')
            $vertical_location = 0;
        else
            $vertical_location = 10;

        if(is_admin_bar_showing() and ($data['floating_language_selector'] == 'top_left' or $data['floating_language_selector'] == 'top_right' or $data['floating_language_selector'] == 'top_left_sticky' or $data['floating_language_selector'] == 'top_right_sticky'))
            $vertical_location += 32;

        $vertical_location = $vertical_location . 'px';

        switch($data['floating_language_selector']) {
            case 'top_left': $html = '<div style="position:fixed;top:'.$vertical_location.';left:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'top_left_sticky': $html = '<div style="position:absolute;top:'.$vertical_location.';left:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'top_right': $html = '<div style="position:fixed;top:'.$vertical_location.';right:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'top_right_sticky': $html = '<div style="position:absolute;top:'.$vertical_location.';right:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'bottom_left': $html = '<div style="position:fixed;bottom:'.$vertical_location.';left:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'bottom_left_sticky': $html = '<div style="position:absolute;bottom:'.$vertical_location.';left:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'bottom_right': $html = '<div style="position:fixed;bottom:'.$vertical_location.';right:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            case 'bottom_right_sticky': $html = '<div style="position:absolute;bottom:'.$vertical_location.';right:8%;z-index:999999;" id="gtranslate_wrapper">'.GTranslate::get_widget_code(false).'</div>'; break;
            default: $html = ''; break;
        }

        echo $html;
    }
}

if($data['pro_version'] or $data['enterprise_version']) {
    add_action('wp_head', 'gtranslate_request_uri_var');
    if(isset($_GET['page']) and $_GET['page'] == 'gtranslate_options')
        add_action('admin_head', 'gtranslate_request_uri_var');

    function gtranslate_request_uri_var() {
        echo "<script>var gt_request_uri = '".addslashes($_SERVER['REQUEST_URI'])."';</script>";
    }
}

if($data['url_translation'] and ($data['pro_version'] or $data['enterprise_version'])) {
    add_action('wp_head', 'gtranslate_url_translation_meta', 1);
    function gtranslate_url_translation_meta() {
        echo '<meta name="uri-translation" content="on" />';
    }
}

if($data['add_hreflang_tags'] and ($data['pro_version'] or $data['enterprise_version'])) {
    add_action('wp_head', 'gtranslate_add_hreflang_tags', 1);
    function gtranslate_add_hreflang_tags() {
        $data = get_option('GTranslate');
        GTranslate::load_defaults($data);

        $enabled_languages = array();
        if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
            $enabled_languages = $data['fincl_langs'];
        elseif($data['widget_look'] == 'flags_dropdown')
            $enabled_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
        else
            $enabled_languages = $data['incl_langs'];

        //$current_url = wp_get_canonical_url();
        $current_url = network_home_url(add_query_arg(null, null));

        if($current_url !== false) {
            // adding default language
            if($data['default_language'] === 'iw')
                echo '<link rel="alternate" hreflang="he" href="'.esc_url($current_url).'" />'."\n";
            elseif($data['default_language'] === 'jw')
                echo '<link rel="alternate" hreflang="jv" href="'.esc_url($current_url).'" />'."\n";
            else
                echo '<link rel="alternate" hreflang="'.$data['default_language'].'" href="'.esc_url($current_url).'" />'."\n";

            // adding enabled languages
            foreach($enabled_languages as $lang) {
                $href = '';
                $domain = str_replace('www.', '', $_SERVER['HTTP_HOST']);

                if($data['enterprise_version'])
                    $href = str_ireplace('://' . $_SERVER['HTTP_HOST'], '://' . $lang . '.' . $domain, $current_url);
                elseif($data['pro_version'])
                    $href = str_ireplace('://' . $_SERVER['HTTP_HOST'], '://' . $_SERVER['HTTP_HOST'] . '/' . $lang, $current_url);

                if(!empty($href) and $lang != $data['default_language']) {
                    if($lang === 'iw')
                        echo '<link rel="alternate" hreflang="he" href="'.esc_url($href).'" />'."\n";
                    elseif($lang === 'jw')
                        echo '<link rel="alternate" hreflang="jv" href="'.esc_url($href).'" />'."\n";
                    else
                        echo '<link rel="alternate" hreflang="'.$lang.'" href="'.esc_url($href).'" />'."\n";
                }
            }
        }
    }
}

// translate WP REST API posts and categories data in JSON response
if($data['pro_version'] or $data['enterprise_version']) {
    function gtranslate_rest_post($response, $post, $request) {
        if(isset($response->data['content']) and is_array($response->data['content']))
            $response->data['content']['gt_translate_keys'] = array(array('key' => 'rendered', 'format' => 'html'));

        if(isset($response->data['excerpt']) and is_array($response->data['excerpt']))
            $response->data['excerpt']['gt_translate_keys'] = array(array('key' => 'rendered', 'format' => 'html'));

        if(isset($response->data['title']) and is_array($response->data['title']))
            $response->data['title']['gt_translate_keys'] = array(array('key' => 'rendered', 'format' => 'text'));

        if(isset($response->data['link']))
            $response->data['gt_translate_keys'] = array(array('key' => 'link', 'format' => 'url'));

        // more fields can be added here

        return $response;
    }

    function gtranslate_rest_category($response, $category, $request) {
        if(isset($response->data['description']))
            $response->data['gt_translate_keys'][] = array('key' => 'description', 'format' => 'html');

        if(isset($response->data['name']))
            $response->data['gt_translate_keys'][] = array('key' => 'name', 'format' => 'text');

        if(isset($response->data['link']))
            $response->data['gt_translate_keys'][] = array('key' => 'link', 'format' => 'url');

        // more fields can be added here

        return $response;
    }

    add_filter('rest_prepare_post', 'gtranslate_rest_post', 10, 3);
    add_filter('rest_prepare_category', 'gtranslate_rest_category', 10, 3);
}

// auto redirect to browser language
if(($data['pro_version'] or $data['enterprise_version']) and $data['detect_browser_language'] and parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == parse_url(site_url(), PHP_URL_PATH) . '/' and isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) and isset($_SERVER['HTTP_USER_AGENT']) and !isset($_SERVER['HTTP_X_GT_LANG']) and preg_match('/bot|spider|slurp|facebook/i', $_SERVER['HTTP_USER_AGENT']) == 0) {
    if($data['widget_look'] == 'flags' or $data['widget_look'] == 'dropdown_with_flags' or $data['widget_look'] == 'flags_name' or $data['widget_look'] == 'flags_code' or $data['widget_look'] == 'popup')
        $allowed_languages = $data['fincl_langs'];
    elseif($data['widget_look'] == 'flags_dropdown')
        $allowed_languages = array_values(array_unique(array_merge($data['fincl_langs'], $data['incl_langs'])));
    else
        $allowed_languages = $data['incl_langs'];

    $accept_language = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

    // for debug purposes only
    if(isset($_GET['gt_auto_switch_to']))
        $accept_language = $_GET['gt_auto_switch_to'];

    if($accept_language == 'zh')
        $accept_language == 'zh-CN';

    if($accept_language != $data['default_language'] and in_array($accept_language, $allowed_languages) and !isset($_COOKIE['gt_auto_switch'])) {
        // set cookie for 30 days and redirect
        setcookie('gt_auto_switch', 1, time() + 2592000);

        if($data['pro_version'])
            header('Location: ' . home_url() . '/' . $accept_language . '/');
        if($data['enterprise_version'] and isset($_SERVER['HTTP_HOST']))
            header('Location: ' . str_replace('://'.$_SERVER['HTTP_HOST'], '://'.$accept_language.'.'.preg_replace('/^www\./', '', $_SERVER['HTTP_HOST']), site_url()));

        // todo: special redirect for language hosting

        exit;
    }

}

// convert wp_localize_script format into JSON + JS parser
if($data['pro_version'] or $data['enterprise_version']) {
    function gtranslate_filter_l10n_scripts() {
        global $wp_scripts;

        $translate_handles = array(
            'agile-store-locator-script',
            'wmc-wizard',
            'wc-address-i18n',
            'wc-checkout',
            'wc-country-select',
            'wc-add-to-cart',
            'wc-password-strength-meter',
            'googlecode_regular',
            'googlecode_property',
            'googlecode_contact',
            'mapfunctions',
            'myhome-min',

        );

        //echo '<!--' . print_r($wp_scripts, true). '-->';
        //return;

        foreach($wp_scripts->registered as $handle => $script) {
            if(isset($script->extra['data']) and in_array($handle, $translate_handles)) {
                $l10n = $script->extra['data'];
                preg_match_all('/var (.+) = ({(.*)});/', $l10n, $matches);
                //echo '<!--' . print_r($matches, true). '-->';

                if(isset($matches[1]) and isset($matches[2])) {
                    $vars = $matches[1];
                    $scripts = $matches[2];
                } else
                    continue;

                foreach($vars as $i => $var_name) {
                    $attribute_ids = $wp_scripts->get_data($handle, 'attribute-ids');
                    $attribute_ids[] = $var_name . '-gt-l10n-'.$i;
                    $jsons = $wp_scripts->get_data($handle, 'jsons');
                    $jsons[] = $scripts[$i];
                    $jss = $wp_scripts->get_data($handle, 'jss');
                    $jss[] = "var $var_name = JSON.parse(document.getElementById('$var_name-gt-l10n-$i').innerHTML);";

                    $wp_scripts->add_data($handle, 'attribute-ids', $attribute_ids);
                    $wp_scripts->add_data($handle, 'jsons', $jsons);
                    $wp_scripts->add_data($handle, 'jss', $jss);
                }

                unset($wp_scripts->registered[$handle]->extra['data']);
            }
        }

        //echo '<!--' . print_r($wp_scripts, true). '-->';

    }

    function gtranslate_add_script_attributes($tag, $handle) {
        global $wp_scripts;

        gtranslate_filter_l10n_scripts();

        if(isset($wp_scripts->registered[$handle]->extra['attribute-ids'])) {
            $attribute_ids = $wp_scripts->get_data($handle, 'attribute-ids');
            $jsons = $wp_scripts->get_data($handle, 'jsons');
            $jss = $wp_scripts->get_data($handle, 'jss');

            $return = '';
            foreach($attribute_ids as $i => $attribute_id) {
                $json = $jsons[$i];
                $js = $jss[$i];

                $return .= "<script id='$attribute_id' type='application/json'>$json</script>\n<script>$js</script>\n";
            }

            return $return . $tag;
        }

        return $tag;
    }

    // filter for woocommerce script params
    function gt_filter_woocommerce_scripts_data($data, $handle) {
        switch($handle) {
            case 'wc-address-i18n': {
                $data['gt_translate_keys'] = array(
                    array('key' => 'locale', 'format' => 'json'),
                    'i18n_required_text',
                    'i18n_optional_text',
                );

                $locale = json_decode($data['locale']);

                if(isset($locale->default->address_1))
                    $locale->default->address_1->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->address_2))
                    $locale->default->address_2->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->city))
                    $locale->default->city->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->postcode))
                    $locale->default->postcode->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->state))
                    $locale->default->state->gt_translate_keys = array('label', 'placeholder');

                if(isset($locale->default->shipping->address_1))
                    $locale->default->shipping->address_1->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->shipping->address_2))
                    $locale->default->shipping->address_2->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->shipping->city))
                    $locale->default->shipping->city->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->shipping->postcode))
                    $locale->default->shipping->postcode->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->shipping->state))
                    $locale->default->shipping->state->gt_translate_keys = array('label', 'placeholder');

                if(isset($locale->default->billing->address_1))
                    $locale->default->billing->address_1->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->billing->address_2))
                    $locale->default->billing->address_2->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->billing->city))
                    $locale->default->billing->city->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->billing->postcode))
                    $locale->default->billing->postcode->gt_translate_keys = array('label', 'placeholder');
                if(isset($locale->default->billing->state))
                    $locale->default->billing->state->gt_translate_keys = array('label', 'placeholder');

                $data['locale'] = json_encode($locale);
            } break;

            case 'wc-checkout': {
                $data['gt_translate_keys'] = array('i18n_checkout_error');
            } break;

            case 'wc-country-select': {
                $data['gt_translate_keys'] = array('i18n_ajax_error', 'i18n_input_too_long_1', 'i18n_input_too_long_n', 'i18n_input_too_short_1', 'i18n_input_too_short_n', 'i18n_load_more', 'i18n_no_matches', 'i18n_searching', 'i18n_select_state_text', 'i18n_selection_too_long_1', 'i18n_selection_too_long_n');
            } break;

            case 'wc-add-to-cart': {
                $data['gt_translate_keys'] = array('i18n_view_cart', array('key' => 'cart_url', 'format' => 'url'));
            } break;

            case 'wc-password-strength-meter': {
                $data['gt_translate_keys'] = array('i18n_password_error', 'i18n_password_hint', '');
            } break;

            default: break;
        }

        return $data;
    }

    function gt_woocommerce_geolocate_ip($false) {
        if(isset($_SERVER['HTTP_X_GT_VIEWER_IP']))
            $_SERVER['HTTP_X_REAL_IP'] = $_SERVER['HTTP_X_GT_VIEWER_IP'];
        elseif(isset($_SERVER['HTTP_X_GT_CLIENTIP']))
            $_SERVER['HTTP_X_REAL_IP'] = $_SERVER['HTTP_X_GT_CLIENTIP'];

        return $false;
    }

    //add_action('wp_print_scripts', 'gtranslate_filter_l10n_scripts', 1);
    //add_action('wp_print_header_scripts', 'gtranslate_filter_l10n_scripts', 1);
    //add_action('wp_print_footer_scripts', 'gtranslate_filter_l10n_scripts', 1);

    add_filter('script_loader_tag', 'gtranslate_add_script_attributes', 100, 2);

    add_filter('woocommerce_get_script_data', 'gt_filter_woocommerce_scripts_data', 10, 2 );

    add_filter('woocommerce_geolocate_ip', 'gt_woocommerce_geolocate_ip', 10, 4);

    // translate emails
    if($data['email_translation']) {
        function gt_translate_emails($args) {
            $subject = $args['subject'];
            $message = $args['message'];

            if(function_exists('curl_init') and isset($_SERVER['HTTP_X_GT_LANG'])) {
                //file_put_contents(dirname(__FILE__) . '/url_addon/debug.txt', date('Y-m-d H:i:s') . " - <subject>$subject</subject><message>$message</message>\n", FILE_APPEND);

                // translate woocommerce
                if(strpos($message, 'woocommerce') !== false) {
                    include dirname(__FILE__) . '/url_addon/config.php';
                    $server_id = intval(substr(md5(preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'])), 0, 5), 16) % count($servers);
                    $server = $servers[$server_id];
                    $host = $_SERVER['HTTP_X_GT_LANG'] . '.' . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST']);
                    $protocol = ((isset($_SERVER['HTTPS']) and ($_SERVER['HTTPS'] == 'on' or $_SERVER['HTTPS'] == 1)) or (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) and  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https' : 'http';

                    $headers = array();
                    $headers[] = 'Host: ' . $host;
                    // add real visitor IP header
                    if(isset($_SERVER['HTTP_CLIENT_IP']) and !empty($_SERVER['HTTP_CLIENT_IP']))
                        $viewer_ip_address = $_SERVER['HTTP_CLIENT_IP'];
                    if(isset($_SERVER['HTTP_CF_CONNECTING_IP']) and !empty($_SERVER['HTTP_CF_CONNECTING_IP']))
                        $viewer_ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'];
                    if(isset($_SERVER['HTTP_X_SUCURI_CLIENTIP']) and !empty($_SERVER['HTTP_X_SUCURI_CLIENTIP']))
                        $viewer_ip_address = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
                    if(!isset($viewer_ip_address))
                        $viewer_ip_address = $_SERVER['REMOTE_ADDR'];

                    $headers[] = 'X-GT-Viewer-IP: ' . $viewer_ip_address;
                    $headers[] = 'User-Agent: GTranslate-Email-Translate';

                    // add X-Forwarded-For
                    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) and !empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                        $headers[] = 'X-GT-Forwarded-For: ' . $_SERVER['HTTP_X_FORWARDED_FOR'];

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $protocol.'://'.$server.'.tdn.gtranslate.net'.wp_make_link_relative(plugins_url('gtranslate/url_addon/gtranslate-email.php').'?glang='.$_SERVER['HTTP_X_GT_LANG']));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                    curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/url_addon/cacert.pem');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('body' => do_shortcode("<subject>$subject</subject><message>$message</message>"), 'access_key' => md5(substr(NONCE_SALT, 0, 10) . substr(NONCE_KEY, 0, 5))));

                    if($data['email_translation_debug']) {
                        $fh = fopen(dirname(__FILE__) . '/url_addon/debug.txt', 'a');
                        curl_setopt($ch, CURLOPT_VERBOSE, true);
                        curl_setopt($ch, CURLOPT_STDERR, $fh);
                    }

                    $response = curl_exec($ch);
                    $response_info = curl_getinfo($ch);
                    curl_close($ch);

                    if($data['email_translation_debug']) {
                        file_put_contents(dirname(__FILE__) . '/url_addon/debug.txt', 'Response: ' . $response . "\n", FILE_APPEND);
                        file_put_contents(dirname(__FILE__) . '/url_addon/debug.txt', 'Response_info: ' . print_r($response_info, true) . "\n", FILE_APPEND);
                    }

                    if(isset($response_info['http_code']) and $response_info['http_code'] == 200) {
                        if($data['pro_version'])
                            $response = str_ireplace($host, $_SERVER['HTTP_HOST'] . '/' . $_SERVER['HTTP_X_GT_LANG'], $response);

                        preg_match_all('/<subject>(.*?)<\/subject><message>(.*?)<\/message>/s', $response, $matches);
                        //file_put_contents(dirname(__FILE__) . '/url_addon/debug.txt', 'Matches: ' . print_r($matches, true) . "\n", FILE_APPEND);

                        if(isset($matches[1][0], $matches[2][0])) {
                            $subject = $matches[1][0];
                            $message = $matches[2][0];

                            if($data['email_translation_debug']) {
                                file_put_contents(dirname(__FILE__) . '/url_addon/debug.txt', 'Translated Subject: ' . $subject . "\n", FILE_APPEND);
                                file_put_contents(dirname(__FILE__) . '/url_addon/debug.txt', 'Translated Message: ' . $message . "\n", FILE_APPEND);
                            }

                            $args['subject'] = $subject;
                            $args['message'] = $message;
                        }
                    }
                }
            }

            return $args;
        }

        add_filter('wp_mail', 'gt_translate_emails', 10000, 1);
    }
}

if($data['enterprise_version']) {
    // solve wp_get_referer issue
    function gt_allowed_redirect_hosts($hosts) {
        $gt_hosts = array();
        if(isset($_SERVER['HTTP_X_GT_LANG']))
            $gt_hosts[] = $_SERVER['HTTP_X_GT_LANG'] . '.' . str_replace('www.', '', $_SERVER['HTTP_HOST']);

        return array_merge($hosts, $gt_hosts);
    }

    add_filter('allowed_redirect_hosts', 'gt_allowed_redirect_hosts');
}