=== Insert Headers and Footers ===
Contributors: WPbeginner, smub, deb255
Tags: code, content, css, facebook pixel, footer, footer code, footer scripts, footers, google analytics, head, header, header code, header scripts, headers, insert, insert code, insert scripts, js, meta, meta tags, scripts, wpmu
Requires at least: 3.6
Tested up to: 5.6
Requires PHP: 5.2
Stable tag: 1.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to add extra scripts to the header and footer of your blog by hooking into wp_head and wp_footer.

== Description ==

= Easily Insert Header and Footer Code =

Insert Headers and Footers is a simple plugin that lets you insert code like Google Analytics, custom CSS, Facebook Pixel, and more to your WordPress site header and footer. No need to edit your theme files!

The simple interface of the Insert Headers and Footers plugin gives you one place where you can insert scripts, rather than dealing with dozens of different plugins.

= Features of Insert Headers and Footers =

* Quick to set up
* Simple to insert scripts
* Insert header code and/or footer code
* Add <strong>Google Analytics</strong> code to any theme
* Add <strong>custom CSS</strong> across themes
* Insert <strong>Facebook pixel code</strong>
* Insert any code or script, including HTML and Javascript

= Credits =

This plugin is created by <a href="https://syedbalkhi.com/" rel="friend" title="Syed Balkhi">Syed Balkhi</a> and the <a href="http://www.wpbeginner.com/" rel="friend" title="WPBeginner">WPBeginner</a> team.

= What's Next =

If you find this plugin useful to insert header and footer scripts, please leave a good rating and consider checking out our other projects:

* <a href="http://optinmonster.com/" rel="friend" title="OptinMonster">OptinMonster</a> - Get More Email Subscribers
* <a href="http://wpforms.com/" rel="friend" title="WPForms">WPForms</a> - Best Contact Form Builder Plugin
* <a href="http://monsterinsights.com/" rel="friend" title="MonsterInsights">MonsterInsights</a> - Best Google Analytics Plugin

To learn more about WordPress, you can also visit <a href="http://www.wpbeginner.com/" rel="friend" title="WPBeginner">WPBeginner</a> for tutorials on topics like:

* <a href="http://www.wpbeginner.com/wordpress-performance-speed/" rel="friend" title="Ultimate Guide to WordPress Speed and Performance">WordPress Speed and Performance</a>
* <a href="http://www.wpbeginner.com/wordpress-security/" rel="friend" title="Ultimate WordPress Security Guide">WordPress Security</a>
* <a href="http://www.wpbeginner.com/wordpress-seo/" rel="friend" title="Ultimate WordPress SEO Guide for Beginners">WordPress SEO</a>

...and many more <a href="http://www.wpbeginner.com/category/wp-tutorials/" rel="friend" title="WordPress Tutorials">WordPress tutorials</a>.

== Installation ==

1. Install Insert Headers and Footers by uploading the `insert-headers-and-footers` directory to the `/wp-content/plugins/` directory. (See instructions on <a href="http://www.wpbeginner.com/beginners-guide/step-by-step-guide-to-install-a-wordpress-plugin-for-beginners/" rel="friend">how to install a WordPress plugin</a>.)
2. Activate Insert Headers and Footers through the `Plugins` menu in WordPress.
3. Insert code in your header or footer by going to the `Settings > Insert Headers and Footers` menu.

[youtube https://www.youtube.com/watch?v=AXM1QgMODW0]

== Screenshots ==

1. Settings Screen

== Frequently Asked Questions ==

= Can I use Insert Headers and Footers to install Google Analytics? =

Yes, you can insert your Google Analytics code in the `Scripts in Header` field.

= Can I use Insert Headers and Footers for Google AdSense? =

Yes, to verify your account or to tag your page for Auto ads, paste the code AdSense gives you, into the Scripts in Header field.

= How to disable Insert Headers and Footers on a specific page? =

You can use one of the three available boolean filters: disable_ihaf, disable_ihaf_footer, disable_ihaf_header, disable_ihaf_body and return true value in order to disable printing either on the entire page or specifically in the header or footer of a given page.

== Notes ==
Insert Headers and Footers is the easiest way to insert code in your WordPress headers and footers.

Our goal is to make using WordPress easy, both with our <a href="http://www.wpbeginner.com/wordpress-plugins/" rel="friend" title="WordPress Plugins">WordPress plugins</a> and resources like <a href="http://www.wpbeginner.com/" rel="friend">WPBeginner</a>, the largest WordPress resource site for beginners.

I feel that we have done that here. I hope find Insert Headers and Footers useful to insert scripts on your site.

Thank you
Syed Balkhi

== Changelog ==

= 1.5.0 =
* New: Code editors now use CodeMirror for syntax highlighting.

= 1.4.6 =
* Tested compatibility with WordPress 5.4.2

= 1.4.5 =
* Tested compatibility with WordPress 5.3.2
* Add support for printing scripts right after the opening body tag using the `wp_body_open` action

= 1.4.4 =
* Tested compatibility with WordPress 5.2
* Updated text-domain standards and in plugin header

= 1.4.3 =
* Update FAQs
* Introduce three new filters: disable_ihaf, disable_ihaf_footer, disable_ihaf_header

= 1.4.2 =
* Code cleanups

= 1.4.1 =
* Fixes for users running PHP version less than 5.5

= 1.4 =
* Tested with WordPress 4.7.2
* cleaned up code

= 1.3.3 =
* Tested with WordPress 4.3
* Fix: plugin_dir_path() and plugin_dir_url() used for Multisite / symlink support

= 1.3.2 =
* Fix: Dashboard widget logo URL when RSS feed cannot be loaded
* Fix: WordPress 4.0 support
* Added: POT language file

= 1.3.1 =
* Improved settings UI for WordPress 3.8+
* Bumped minimum version requirement

= 1.3 =
* fixed readme file

= 1.2 =
* cleaned up code

= 1.1 =
* fixed unnecessary CSS loading

= 1.0 =
* Initial version
