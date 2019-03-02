=== Tuxedo Big File Uploads ===
Contributors: andtrev
Tags: AJAX, file uploader, files, files uploader, ftp, image uploader, plugin, upload, increase file upload limit
Requires at least: 3.4
Tested up to: 4.9.5
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enables large file uploads in the built-in WordPress media uploader.

== Description ==

Increase file upload limit in the standard built-in WordPress media uploader. Uploads can be as large as available disk space allows.

No messing with Apache/PHP initialization files or settings. No need to FTP.

Simply activate the plugin and use the media uploader as you normally would.

The browser uploader option is not supported, the multi-file uploader must be used to enable large file uploads.

* Small footprint that doesn't bog down WordPress with unnecessary features.
* Shows available disk space for temporary uploads directory or maximum upload size limit setting as maximum upload file size in media uploader.
* Options for maximum upload size limit, chunk size and max retries are available under the Uploading Files section on the Settings -> Media page.

In essence the plugin changes the Plupload settings for uploads and points the AJAX url to the plugin. This processes the
upload in chunks (separate smaller pieces) before handing it off to WordPress.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/tuxedo-big-file-uploads` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings -> Media -> Uploading Files screen to configure the plugin.

== Frequently Asked Questions ==

= How big can uploads be? =

Uploads can be as large as available disk space for temporary files allows, or up to the maximum upload size
limit set in Settings -> Media -> Uploading Files.

= Why does the maximum file size decrease after an upload? =

If no maximum upload size limit is set, then maximum file size is listed as the available free disk space for temporary uploads.
Free disk space will decrease as files are uploaded.
Additionally some systems use a separate partition for temporary files, free space may fluctuate as files
are uploaded and moved out of the temporary folder.

== Changelog ==

= 1.2 =
* Added maximum upload size limit setting.
* Stronger security: uploads now go through admin-ajax and check_admin_referer is called before any chunks are touched.

= 1.1 =
* Security fix: non-authenticated user could upload.

= 1.0.1 =
* Added fallback if the file info extension is missing.

= 1.0 =
* Initial release.
