=== MetaSlider Lightbox ===
Contributors: matchalabs, DavidAnderson, dnutbourne, kbat82
Tags: wordpress slideshow lightbox,meta slider,metaslider,metaslider lightbox,slideshow lightbox,lightbox,slideshow,slider,wordpress lightbox
Requires at least: 3.5
Tested up to: 5.6
Stable tag: 1.11.3
Requires PHP: 5.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Extends MetaSlider allowing slides to be opened in a lightbox.

== Description ==

For use with the popular WordPress plugin <a href="https://wordpress.org/plugins/ml-slider/">MetaSlider</a> allowing slides to be opened in a lightbox, using one of the following supported lightbox plugins:<br>

<ul>
<li><a href="https://wordpress.org/plugins/easy-fancybox/">Easy FancyBox</a> <small>(300,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/simple-lightbox/">Simple Lightbox</a> <small>(200,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/foobox-image-lightbox/">FooBox Image Lightbox</a> <small>(100,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/wp-featherlight/">WP Featherlight</a> <small>(60,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/wp-colorbox/">WP Colorbox Lightbox</a> <small>(10,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/ari-fancy-lightbox/">ARI Fancy Lightbox</a> <small>(10,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/fancy-gallery/">Gallery Manager</a> <small>(8,000+ active installations)</small></li>
</ul>

We also support the following WordPress plugins, although they haven't had recent updates, or sometimes go long periods without the authors fixing issues:<br>

<ul>
<li><a href="https://wordpress.org/plugins/responsive-lightbox/">Responsive Lightbox by dFactory</a> <small>(300,000+ active installations)<br>Note: Some users are reporting errors with Responsive Lightbox by dFactory (<a href="https://wordpress.org/support/topic/conflict-with-metaslider-2/">see here</a>).</small></li>
<li><a href="https://wordpress.org/plugins/wp-lightbox-2/">WP Lightbox 2</a> <small>(90,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/wp-jquery-lightbox/">WP jQuery Lightbox</a> <small>(70,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/jquery-colorbox/">jQuery Colorbox</a> <small>(50,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/fancy-lightbox/">Fancy Lightbox</a> <small>(1,000+ active installations)</small></li>
<li><a href="https://wordpress.org/plugins/imagelightbox/">imageLightbox</a> <small>(1,000+ active installations)</small></li>
<li><a href="https://www.tipsandtricks-hq.com/wordpress-lightbox-ultimate-plugin-display-media-in-a-fancy-lightbox-overlay-3163">WP Lightbox Ultimate</a></li>
<li><a href="https://23systems.net/wordpress-plugins/lightbox-plus-for-wordpress/">Lightbox Plus</a></li>
</ul>

If you would like to use a lightbox plugin that isn't supported you can add support by hookng into the `metaslider_lightbox_supported_plugins` filter. If you need assistance, please open an issue.

== Screenshots ==

1. Toggle the lightbox in the advanced settings panel

== Installation ==

Requires: <br>

<ul>
<li><a href="https://wordpress.org/plugins/ml-slider/">MetaSlider</a> 3.0+ </li>
</ul>

and one of the following lightbox plugins:

<ul>
<li><a href="https://wordpress.org/plugins/easy-fancybox/">Easy FancyBox</a></li>
<li><a href="https://wordpress.org/plugins/simple-lightbox/">Simple Lightbox</a></li>
<li><a href="https://wordpress.org/plugins/responsive-lightbox/">Responsive Lightbox by dFactory</a></li>
<li><a href="https://wordpress.org/plugins/foobox-image-lightbox/">FooBox Image Lightbox</a></li>
<li><a href="https://wordpress.org/plugins/wp-featherlight/">WP Featherlight</a></li>
<li><a href="https://wordpress.org/plugins/wp-colorbox/">WP ColorBox Lightbox</a></li>
<li><a href="https://wordpress.org/plugins/fancy-gallery/">Gallery Manager</a></li>
<li><a href="https://wordpress.org/plugins/ari-fancy-lightbox/">ARI Fancy Lightbox – WordPress Popup</a></li>
<li><a href="https://wordpress.org/plugins/wp-lightbox-2/">WP Lightbox 2</a></li>
<li><a href="https://wordpress.org/plugins/wp-jquery-lightbox/">WP jQuery Lightbox</a></li>
<li><a href="https://wordpress.org/plugins/jquery-colorbox/">jQuery Colorbox</a></li>
<li><a href="https://wordpress.org/plugins/fancy-lightbox/">Fancy Lightbox</a></li>
<li><a href="https://wordpress.org/plugins/imagelightbox/">imageLightbox</a></li>
<li><a href="https://www.tipsandtricks-hq.com/wordpress-lightbox-ultimate-plugin-display-media-in-a-fancy-lightbox-overlay-3163">WP Lightbox Ultimate</a></li>
<li><a href="https://23systems.net/wordpress-plugins/lightbox-plus-for-wordpress/">Lightbox Plus</a></li>
</ul>


If you would like to use a lightbox plugin, you can filter the supported plugin list with the necessary attributes. For example, using <a target="_blank" href="https://wordpress.org/plugins/responsive-lightbox-lite/">Responsive Lightbox Lite</a>
<pre>
add_filter('metaslider_lightbox_supported_plugins', 'supported_plugins_list');
function supported_plugins_list($supported_plugins_list) {
    return array(
        'Responsive Lightbox' => array(
            'location' => 'responsive-lightbox-lite/responsive-lightbox-lite.php',
            'settings_url' => 'options-general.php?page=responsive-lightbox-lite',
            'rel' => 'lightbox',
            'attributes' => array(
                'data-lightbox-type' => 'iframe'
            )
        )
    );
}
</pre>

<p>Note that you can use <code>:url</code> or <code>:caption</code> to retrieve these items from the slides, such as <code>'data-lightbox-url' => ':url'</code></p>

The easy way:

1. Go to the Plugins Menu in WordPress
2. Search for "MetaSlider Lightbox"
3. Click "Install"

The not so easy way:

1. Upload the `ml-slider-lightbox` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Manage your slideshows using the 'MetaSlider' menu option

== Changelog ==

= 1.11.3 - 2020/Aug/22 =

* TWEAK: Updates readme and team account info

= 1.11.2 - 2020/April/09 =

* TWEAK: De-priortizes recomendation for Responsive Lightbox by dFactory due to inactivity

= 1.11.1 - 2019/Aug/14 =

* FIX: Fixes issue where the setting wouldn't save properly

= 1.11.0 - 2019/July/8 =

* FEATURE: Adds support for Gallery Manager Pro

= 1.10.4 - 2019/April/30 =

* TWEAK: Adds unique class name to admin notices

= 1.10.3 - 2019/Jan/04 =

* FIX: Fixes a bug where WP-Featherlight would not load as a gallery

= 1.10.2 - 2018/July/14 =

* TWEAK: Updates settings page for WP Lightbox 2 to match their update

= 1.10.1 - 2018/Mar/16 =

* FIX: Updates how lightbox plugins are checked for activation
* FIX: Addresses a bug that checks for previous slider settings
* FIX: Removes an incompatible lightbox plugin (duplicate name)

= 1.10.0 - 2018/Mar/16 =

* REFACTOR: Refactors lightbox to clean up attribute function
* REFACTOR: Refactors various parts of the code to extract supported plugin data
* REFACTOR: Extracts the class MetaSliderLightboxPlugin to its own file.
* REFACTOR: Changes the logic for check if the plugin is install and active.
* TWEAK: Adds a CSS class to the container that identifies the active lightbox plugin
* TWEAK: Adds filters to let users manipulate the plugin use
* REFACTOR: Refactors lightbox to clean up attribute function
* FEATURE: Adds support for additional lightbox plugins

= 1.9.3 - 2017/Nov/14 =

* FIX: FooBox Pro compatibility update
* FIX: Updates the FooBox Profile name
* FIX: Update Gallery Manager plugin settings
* TWEAK: Fix checks to slide URL

= 1.9.2 - 2018/Jan/26 =

* TWEAK: Update translation strings
* TWEAK: Adds warning message when no lightbox is active

= 1.9 [28/03/17] =
* Simple lightbox use slide caption instead of attachment caption

= 1.8 [16/03/17] =
* Update slide image URL to comply with new slide post type

= 1.7 [09/05/16] =
* Removes defunct Lightbox Plus plugin link (thanks to @Hendrik57)

= 1.6 [01/04/15] =
* Adds support for FooBox Image Lightbox and WP Lightbox 2 *Pro* versions

= 1.5 [30/01/15] =
* Adds support for FooBox Image Lightbox and Responsive Lightbox by dFactory

= 1.4 [15/12/14] =
* Hides dependancy warning in admin if WP Video Lightbox is activated (reported by and thanks to: vfontj)

= 1.3 [28/10/14] =
* Adds support for Fancy Gallery lightbox plugin (suggested by and thanks to: Zim1)

= 1.2 [17/09/14] =
* Support for additional lightbox plugins

= 1.1 [22/08/14] =
* Fix: Array assignment compatibility PHP < v5.4 (reported by and thanks to: andrea_montuori)

= 1.0 [15/08/14] =
* Initial version
