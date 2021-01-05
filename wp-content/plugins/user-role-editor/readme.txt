=== User Role Editor ===
Contributors: shinephp
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=vladimir%40shinephp%2ecom&lc=RU&item_name=ShinePHP%2ecom&item_number=User%20Role%20Editor%20WordPress%20plugin&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: user, role, editor, security, access, permission, capability
Requires at least: 4.0
Tested up to: 5.6
Stable tag: 4.57.1
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

User Role Editor WordPress plugin makes user roles and capabilities changing easy. Edit/add/delete WordPress user roles and capabilities.

== Description ==

User Role Editor WordPress plugin allows you to change user roles and capabilities easy.
Just turn on check boxes of capabilities you wish to add to the selected role and click "Update" button to save your changes. That's done. 
Add new roles and customize its capabilities according to your needs, from scratch of as a copy of other existing role. 
Unnecessary self-made role can be deleted if there are no users whom such role is assigned.
Role assigned every new created user by default may be changed too.
Capabilities could be assigned on per user basis. Multiple roles could be assigned to user simultaneously.
You can add new capabilities and remove unnecessary capabilities which could be left from uninstalled plugins.
Multi-site support is provided.

To read more about 'User Role Editor' visit [this page](http://www.shinephp.com/user-role-editor-wordpress-plugin/) at [shinephp.com](http://shinephp.com)


Do you need more functionality with quality support in a real time? Do you wish to remove advertisements from User Role Editor pages? 
[Buy Pro version](https://www.role-editor.com). 
[User Role Editor Pro](https://www.role-editor.com) includes extra modules:
<ul>
<li>Block selected admin menu items for role.</li>
<li>Hide selected front-end menu items for no logged-in visitors, logged-in users, roles.</li>
<li>Block selected widgets under "Appearance" menu for role.</li>
<li>Show widgets at front-end for selected roles.</li>
<li>Block selected meta boxes (dashboard, posts, pages, custom post types) for role.</li>
<li>"Export/Import" module. You can export user role to the local file and import it to any WordPress site or other sites of the multi-site WordPress network.</li> 
<li>Roles and Users permissions management via Network Admin  for multisite configuration. One click Synchronization to the whole network.</li>
<li>"Other roles access" module allows to define which other roles user with current role may see at WordPress: dropdown menus, e.g assign role to user editing user profile, etc.</li>
<li>Manage user access to editing posts/pages/custom post type using posts/pages, authors, taxonomies ID list.</li>
<li>Per plugin users access management for plugins activate/deactivate operations.</li>
<li>Per form users access management for Gravity Forms plugin.</li>
<li>Shortcode to show enclosed content to the users with selected roles only.</li>
<li>Posts and pages view restrictions for selected roles.</li>
<li>Admin back-end pages permissions viewer</li>
</ul>
Pro version is advertisement free. Premium support is included.

== Installation ==

Installation procedure:

1. Deactivate plugin if you have the previous version installed.
2. Extract "user-role-editor.zip" archive content to the "/wp-content/plugins/user-role-editor" directory.
3. Activate "User Role Editor" plugin via 'Plugins' menu in WordPress admin menu. 
4. Go to the "Users"-"User Role Editor" menu item and change your WordPress standard roles capabilities according to your needs.

== Frequently Asked Questions ==
- Does it work with WordPress in multi-site environment?
Yes, it works with WordPress multi-site. By default plugin works for every blog from your multi-site network as for locally installed blog.
To update selected role globally for the Network you should turn on the "Apply to All Sites" checkbox. You should have superadmin privileges to use User Role Editor under WordPress multi-site.
Pro version allows to manage roles of the whole network from the Netwok Admin.

To read full FAQ section visit [this page](http://www.shinephp.com/user-role-editor-wordpress-plugin/#faq) at [shinephp.com](shinephp.com).

== Screenshots ==
1. screenshot-1.png User Role Editor main form
2. screenshot-2.png Add/Remove roles or capabilities
3. screenshot-3.png User Capabilities link
4. screenshot-4.png User Capabilities Editor
5. screenshot-5.png Bulk change role for users without roles
6. screenshot-6.png Assign multiple roles to the selected users

To read more about 'User Role Editor' visit [this page](http://www.shinephp.com/user-role-editor-wordpress-plugin/) at [shinephp.com](shinephp.com).

= Translations =

If you wish to check available translations or help with plugin translation to your language visit this link
https://translate.wordpress.org/projects/wp-plugins/user-role-editor/


== Changelog =
= [4.57.1] 10.12.2020 =
* Fix: Nextgen Gallery's user capabilities were not shown as granted after current role change via roles selection dropdown list.
* Fix: PHP Warning:  The magic method __wakeup() must have public visibility. __wakeup() method was defined as private as a part of the Singleton design partern. Method was redefined as public but with exception inside to prevent its usage.
* Update: jQuery [MultiSelect](http://multiple-select.wenzhixin.net.cn/) plugin  was updated to version 1.5.2

= [4.57] 09.11.2020 =
* Update: Marked as compatible with WordPress 5.6.
* Update: " jQuery( document ).ready( handler ) " was replaced globally with " jQuery( handler ) " for compatibility with [jQuery 3.0](https://api.jquery.com/ready/) and WordPress 5.6.
* Update: jQuery UI CSS was updated to version 1.12.1
* Fix: "Grant Roles" button produced JavaScript error, if single user without any role granted (None) was selected.

= [4.56.1] 05.09.2020 =
* New: WordPress multisite: Main site: Users->User Role Editor->Apply to All->Update: 'ure_after_network_roles_update' action hook was added. It is executed after all roles were replicated from the main site to the all other subsites of the network.
* Fix: "Granted Only" filter did not work.
* Fix: Warning was fixed: wp-content/plugins/user-role-editor/js/ure.js: jQuery.fn.attr('checked') might use property instead of attribute.

= [4.56] 09.08.2020 =
* New: User capabilities 'install_languages', 'resume_plugins', 'resume_themes', 'view_site_health_checks' were added to the list of supported WordPress built-in user capabilities.
* Update: Single site WordPress installation: URE automatically grants all existing user capabilities to WordPress built-in 'administrator' role before opening its page "Users->User Role Editor". 
* Fix: Extra slash was removed between URE_PLUGIN_URL and the image resource when outputting URE_PLUGIN_URL .'/images/ajax-loader.gif' at 'Users->User Role Editor' page.
* Info: Marked as compatible with WordPress 5.5.

= [4.55.1] 06.06.2020 =
* Security fix: User with 'edit_users' capability could assign to another user a role not included into the editable roles list. This fix is required to install ASAP for all sites which have user(s) with 'edit_users' capability granted not via 'administrator' role.
* Update: URE_Uninstall class properties were made 'protected' to be accessible in URE_Uninstall_Pro class included into the Pro version.

File changelog.txt contains the full list of changes.

== Additional Documentation ==

You can find more information about "User Role Editor" plugin at [this page](http://www.shinephp.com/user-role-editor-wordpress-plugin/)

I am ready to answer on your questions about plugin usage. Use [plugin page comments](http://www.shinephp.com/user-role-editor-wordpress-plugin/) for that.

== Upgrade Notice ==
= [4.56.1] 05.09.2020 =
* New: WordPress multisite: Main site: Users->User Role Editor->Apply to All->Update: 'ure_after_network_roles_update' action hook was added. It is executed after all roles were replicated from the main site to the all other subsites of the network.
* Fix: "Granted Only" filter did not work.
* Fix: Warning was fixed: wp-content/plugins/user-role-editor/js/ure.js: jQuery.fn.attr('checked') might use property instead of attribute.
