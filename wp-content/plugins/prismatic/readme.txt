=== Prismatic ===

Plugin Name: Prismatic
Plugin URI: https://perishablepress.com/prismatic/
Description: Display beautiful syntax-highlighted code snippets with Prism.js or Highlight.js
Tags: code, snippets, syntax, highlight, language,  snippet, pre, prettify, prism, css, fence
Author: Jeff Starr
Contributors: specialk
Author URI: https://plugin-planet.com/
Donate link: https://monzillamedia.com/donate.html
Requires at least: 4.1
Tested up to: 5.6
Stable tag: 2.6
Version: 2.6
Requires PHP: 5.6.20
Text Domain: prismatic
Domain Path: /languages
License: GPL v2 or later

Display beautiful syntax-highlighted code snippets with Prism.js or Highlight.js



== Description ==

__The only 3-in-1 syntax highlighter!__

Display beautiful code snippets with Prism.js, Highlight.js, or plain code escaping:

* __Prism.js__     - Code escape + syntax highlight using [Prism.js](https://prismjs.com/)
* __Highlight.js__ - Code escape + syntax highlight using [Highlight.js](https://highlightjs.org/)
* __Plain Flavor__ - Code escape without syntax highlight

Check out a [demo post using Highlight.js](https://dev-tricks.com/favorite-highlight-js-styles/). I also use this plugin at [WP-Mix](https://wp-mix.com/) for all code snippets.


**Prism.js Features**

* Supports __56__ coding languages
* Choose from all __8__ available Prism themes
* Provides a Gutenberg block for adding code snippets
* Provides TinyMCE/Visual buttons for adding code snippets
* Enable Prism plugin [Line Numbers](https://prismjs.com/plugins/line-numbers/)
* Enable Prism plugin [Line Highlight](https://prismjs.com/plugins/line-highlight/)
* Enable Prism plugin [Show Language](https://prismjs.com/plugins/show-language/)
* Enable Prism plugin [Copy Code Button](https://prismjs.com/plugins/copy-to-clipboard/)
* Highlights code in post content, excerpts, and comments
* Detects `language-` and `lang-` class prefixes
* Limit syntax highlighting to Posts and Pages
* Highlight single-line and multi-line code
* Granular control over code escaping
* Smart loading of CSS &amp; JS assets
* Support for ACF on single post views

**Highlight.js Features**

* Supports __42__ coding languages
* Choose from all __90+__ available Highlight themes
* Provides a Gutenberg block for adding code snippets
* Provides TinyMCE/Visual buttons for adding code snippets
* Customize the Highlight.js init JavaScript
* Highlights code in post content, excerpts, and comments
* Limit syntax highlighting to Posts and Pages
* Highlight multi-line blocks of code
* Detects `language-` and `lang-` class prefixes
* Enable support for no-prefix class names
* Granular control over code escaping
* Smart loading of CSS &amp; JS assets

**Plain Flavor Features**

* Enable code escaping for post content, excerpts, and/or comments
* Enable code escaping on the frontend, Admin Area, or both
* Provides a Gutenberg block for adding code snippets
* Provides TinyMCE/Visual buttons for adding code snippets
* Escapes single-line and multi-line code snippets
* Escapes `<code>` tags (based on configuration)

**General Features**

* Easy to set up &amp; configure
* Built with the WordPress API
* Squeaky clean, error-free code
* Born of simplicity, no frills
* Lightweight, fast and flexible
* Focused on performance and security
* Loads CSS/JS assets only when required
* Adheres to HTML coding best practices
* Works with the Gutenberg Block Editor
* Regularly updated and "future proof"

_Prismatic escapes only the essentials to keep your code clean._

[Check out the screenshots](https://wordpress.org/plugins/prismatic/screenshots/) for more details!

**Privacy**

This plugin does not collect or store any user data. It does not set any cookies, and it does not connect to any third-party locations. Thus, this plugin does not affect user privacy in any way.



== Screenshots ==

1.  Prismatic General Settings
2.  Prismatic Prism.js Settings
3.  Prismatic Highlight.js Settings
4.  Prismatic Plain Flavor Settings
5.  Prism.js : Twilight theme (choose from 7 Prism.js themes!)
6.  Highlight.js : Arduino Light theme (choose from 77 Highlight.js themes!)
7.  Highlight.js : Gruvbox Dark theme (choose from 77 Highlight.js themes!)
8.  Cleanly escaped code without syntax highlighting (Plain Flavor)
9.  Gutenberg Prismatic block (under Formatting menu)
10. Prismatic block showing added code and language select
11. Prismatic TinyMCE/Visual button for adding code snippets
12. Prismatic TinyMCE panel showing added code and selected language


== Installation ==

**Installing Prismatic**

1. Make a backup of your database
2. Upload the plugin to your blog and activate
3. Visit the plugin settings to configure options

_[More info on installing WP plugins](https://wordpress.org/support/article/managing-plugins/#installing-plugins)_



**Quick Start Guide**

Here is a quick guide to get started with Prismatic:

1. Activate the plugin and visit the Prismatic settings page
2. Choose Prism.js or Highlight.js for syntax highlighting
3. Optionally visit the Prism.js or Highlight.js tab to customize options

You are now ready to go. To add a code snippet to any WP Post or Page:

* If using Gutenberg Block Editor, click on the Prismatic block
* If using Classic Editor, click on the Prismatic TinyMCE button

To get a better idea, view the screenshots on the [Prismatic homepage](https://wordpress.org/plugins/prismatic/).

The Prismatic block or button makes it easy to add your code snippet and choose a language. The plugin automatically will output the correct markup to display your code with syntax highlighting. No code editing required! Note: Advanced usage information provided further down on this page.



**Like the plugin?**

If you like Prismatic, please take a moment to [give a 5-star rating](https://wordpress.org/support/plugin/prismatic/reviews/?rate=5#new-post). It helps to keep development and support going strong. Thank you!



**Uninstalling**

Prismatic cleans up after itself. All plugin settings will be removed from your database when the plugin is uninstalled via the Plugins screen. NOTE that uninstalling the plugin will NOT touch any of your post content. Only the plugin options are removed when the plugin is uninstalled via the Plugins screen.



**Restore Default Options**

To restore default plugin options, either uninstall/reinstall the plugin or visit the Prismatic General Settings &gt; Restore default plugin options.



**Usage: Syntax Highlighting**

The Prismatic plugin follows the same conventions used by [Prism.js](https://prismjs.com/) and [Highlight.js](https://highlightjs.org/). Here are the basic steps:

1. Visit the Prismatic General Settings and choose your library 
2. Visit the settings tab for your chosen library
3. Choose a theme and configure your options

Once the settings are configured, you can enable syntax highlighting for any code snippet by doing one of the following:

* Wrap multi-line code with pre &amp; code tags: &lt;pre&gt;&lt;code&gt;...&lt;/code&gt;&lt;/pre&gt;
* Wrap single-line code with code tags: &lt;code&gt;...&lt;/code&gt;

The plugin also provides a Prismatic Gutenberg block and TinyMCE buttons. So you can add code snippets with a few clicks easily.

__Note:__ Prism.js highlights both multi-line and single-line code snippets. Highlight.js only supports multi-line code snippets.

With the proper markup in place, you can indicate a specific language by adding a class of `language-abc` or `lang-abc` to the &lt;code&gt; tag (where "abc" is the language identifier). For example, to indicate PHP as the language for a single-line code snippet:

	<code class="language-php"><?php echo 'Hello world'; ?></code>

Likewise, to indicate HTML as the language for a multi-line code snippet:

	<pre><code class="language-html">
		<table>
			<tr>
				<th>Name</th>
				<th>Side</th>
				<th>Role</th>
			<tr>
				<td>Darth</td>
				<td>Dark</td>
				<td>Sith</td>
			</tr>
		</table>
	</code></pre>

Alternately, the language class may be placed on the &lt;pre&gt; tag, for example:

	<pre class="language-html"><code class="optional">
		<table>
			<tr>
				<th>Name</th>
				<th>Side</th>
				<th>Role</th>
			<tr>
				<td>Darth</td>
				<td>Dark</td>
				<td>Sith</td>
			</tr>
		</table>
	</code></pre>

Note: in the previous example, ignore the `class="optional"` added to the code tag; it is used to prevent markdown from mangling the code example on this web page.

Basically, the prefix of the class names (i.e., "lang-" or "language-") are the same for Prism.js and Highlight.js. The difference is the language identifier (e.g., "css" or "html") used to specify each language. Check out the following "About Prism.js" and "About Highlight.js" sections for more information.

__Note:__ In addition to detecting the `language-` and `lang-` prefixes, Highlight.js also will try to auto-detect the language without it being specified. Plus as an option, you can enable the Highlight.js setting, "Support no-prefix class names" to enable use of language identifiers without any `language-` or `lang-` prefix.

> Pro Tip: Language class names work when added to the &lt;pre&gt; tag for both Prism.js and Highlight.js.



**Usage: Code escaping**

Just like Prism.js and Highlight.js, the Prismatic plugin follows HTML coding standards. To enable code escaping:

1. Visit the Prismatic General Settings and choose your library
2. Enable "Code Escaping" via the settings tab of your chosen library
3. Do one of the following:
	* Wrap multi-line code with pre &amp; code tags: &lt;pre&gt;&lt;code&gt;...&lt;/code&gt;&lt;/pre&gt;
	* Wrap single-line code with code tags: &lt;code&gt;...&lt;/code&gt;

For example, the code snippets included in either of the following markup examples would be escaped (note that the class attribute is not required for code escaping).

This is a single-line example:

	<code class="language-php"><?php echo 'Hello world'; ?></code>

This is a multi-line code example:
	
	<pre><code class="language-html">
		<table>
			<tr>
				<th>Name</th>
				<th>Side</th>
				<th>Role</th>
			<tr>
				<td>Darth</td>
				<td>Dark</td>
				<td>Sith</td>
			</tr>
		</table>
	</code></pre>

So what exactly happens when the "Code Escaping" options are enabled? Here is a summary that applies to each section (post content, excerpts, and comments):

* __Frontend only__ - code snippets are escaped at runtime (no changes made to content in the database)
* __Admin Area only__ - code snippets are escaped when viewed via the Admin Area (changes will be saved to database if the "Update" or "Publish" button is clicked)
* __Frontend &amp; Admin Area__ - both of the previous are applied
* __None__ - all code escaping is disabled

Note that each library &mdash; Prism.js, Highlight.js, and Plain Flavor &mdash; features its own code-escape settings. So the code-escape settings that are applied depends on the currently active library. Visit the plugin's General Settings to choose your library. Then visit that library's tab to configure its code-escape settings.

When code escaping is enabled for either/both the frontend or Admin Area, the plugin makes the following changes to any code contained within &lt;code&gt;&lt;/code&gt; tags:

	\r                     removed
	&                      replaced with &amp;
	<                      replaced with &lt;
	>                      replaced with &gt;
	trailing whitespace    removed

These are the _only_ changes made to your code, no other changes are made. 

As mentioned, the difference between code escaping on the frontend vs. the Admin Area is that, on the frontend, the above changes are made at runtime and not saved to the database; whereas in the Admin Area, the changes are made when the code is viewed via a content editor, such that any changes made will be saved to the database when the user clicks the "Update" or "Publish" button. Please keep this in mind when choosing your code-escape settings.
		
__Important!__ As explained, enabling code escaping in the Admin Area may result in the escaped code getting saved in the database. This is fine in most cases, but there may be situations where escaping should only happen at runtime. If that is the case, or if you are unsure, choose the "Frontend only" option for the "Code Escaping" setting. The "Frontend only" option only modifies code when displayed on the frontend and does not save any changes to the database.



**Usage: Gutenberg Block Editor**

To highlight a code block using Gutenberg:

1. Select the Prismatic block
2. Select a code language (via sidebar options)
3. Add your code and done.



**Usage: Classic TinyMCE Editor**

To highlight code using the TinyMCE/Visual/Rich-Text Editor:

1. Click the Prismatic button (looks like `<>`)
2. Choose a code language
3. Add your code and click "OK" button

There also is a Prismatic Quicktag button ("pre") for those using the Plain-Text editor.



**Usage: Prism.js Plugins**

Currently the Prismatic plugin provides four plugins for Prism.js.

* [Line Highlight](https://prismjs.com/plugins/line-highlight/) - Requires adding `data-line` attribute to the pre element
* [Line Numbers](https://prismjs.com/plugins/line-numbers/) - Requires adding `line-numbers` attribute to the pre element
* [Show Language](https://prismjs.com/plugins/show-language/) - No additional steps required
* [Copy to Clipboard](https://prismjs.com/plugins/copy-to-clipboard/) - No additional steps required

Any/all of these plugins can be enabled in the Prism.js settings. To learn more about usage and options, visit the plugin links in the above list.



**About Prism.js**

Prism.js version used in Prismatic plugin: __1.21.0__

__Prism.js resources__

* [Homepage](https://prismjs.com/)
* [GitHub](https://github.com/PrismJS/prism)
* [Changelog](https://github.com/PrismJS/prism/blob/gh-pages/CHANGELOG.md)

__License &amp; Info__

	/*
		Prism: Lightweight, robust, elegant syntax highlighting
		MIT license https://www.opensource.org/licenses/mit-license.php/
		@author Lea Verou https://lea.verou.me
	*/

__Supported Languages__

	Language       Class
	
	Apache         = apacheconf
	AppleScript    = applescript
	Arduino        = arduino
	Bash           = bash
	Batch          = batch
	C              = c
	C#             = csharp
	C++            = cpp
	C-like         = clike
	CoffeeScript   = coffeescript
	CSS            = css
	D              = d
	Dart           = dart
	Diff           = diff
	Elixir         = elixir
	G-code         = gcode
	Git            = git
	Go             = go
	GraphQL        = graphql
	Groovy         = groovy
	HCL            = hcl
	HTML/XML/Etc.  = markup, html, xml, svg, mathml, ssml, atom, rss
	HTTP           = http
	Ini            = ini
	Java           = java
	JavaScript     = javascript
	JSON           = json
	JSX            = jsx
	Kotlin         = kotlin
	LaTeX          = latex
	Liquid         = liquid
	Lua            = lua
	Makefile       = makefile
	Markdown       = markdown
	Markup         = markup
	NGINX          = nginx
	Objective-C    = objectivec
	Pascal         = pascal
	Perl           = perl
	PHP            = php
	PowerShell     = powershell
	Python         = python
	R              = r
	Ruby           = ruby
	Rust           = rust
	SASS           = sass
	Scala          = scala
	SCSS           = scss
	Shell Session  = shell-session
	Solidity       = solidity
	SQL            = sql
	Swift          = swift
	TSX            = tsx
	Twig           = twig
	TypeScript     = typescript
	Visual Basic   = visual-basic
	YAML           = yaml

So for example, to specify a code block as C++, you would write:

	Single line: <code class="language-cpp">...</code>
	
	Multi-line: <pre><code class="language-cpp">...</code></pre>
	
	Alternate: <pre class="language-cpp"><code class="optional">...</code></pre>

Note: in the previous example, ignore the `class="optional"` added to the code tag (for the "Alternate" syntax); it is used to prevent markdown from mangling the code example on this web page.

To disable Prism.js syntax highlighting for any snippet, simply omit the language class. Or, to disable syntax highlighting for a code snippet while also loading the Prism.js stylesheet, add a class of `language-none`, for example:

	<code class="language-none">...</code>

_I'm glad to add more languages, [make a suggestion](https://perishablepress.com/contact/)_



**About Highlight.js**

Highlight.js version used in Prismatic plugin: __10.1.2__

__Highlight.js resources__

* [Homepage](https://highlightjs.org/)
* [GitHub](https://github.com/isagalaev/highlight.js)
* [Changelog](https://github.com/isagalaev/highlight.js/blob/master/CHANGES.md)

__License &amp; Info__

	/*
		Syntax highlighting with language autodetection.
		Copyright (c) 2006, Ivan Sagalaev https://highlightjs.org/
		All rights reserved. BSD3 License @ https://git.io/hljslicense
	*/

__Supported Languages__

	Language       Class
	
	Apache         = apache, apacheconf
	AppleScript    = applescript, osascript
	Arduino        = arduino
	Bash           = bash, sh, zsh
	C#             = cs, csharp
	C++            = cpp, c, cc, h, c++, h++, hpp
	CSS            = css
	CoffeeScript   = coffeescript, coffee, cson, iced
	D              = d
	Dart           = dart
	Diff           = diff, patch
	Elixir         = elixir
	G-code         = gcode, nc
	GML            = gml
	Go             = go, golang
	Groovy         = groovy
	HTML/XML/Etc.  = xml, html, xhtml, rss, atom, xjb, xsd, xsl, plist
	HTTP           = http, https
	Ini            = ini
	JSON           = json
	Java           = java, jsp
	JavaScript     = javascript, js, jsx
	Kotlin         = kotlin
	Lua	           = lua
	Makefile       = makefile, mk, mak
	Markdown       = markdown, md, mkdown, mkd
	Nginx          = nginx, nginxconf
	Objective-C    = objectivec, mm, objc, obj-c
	PHP            = php, php3, php4, php5, php6
	Perl           = perl, pl, pm
	Plaintext      = plaintext, txt, text
	PowerShell     = powershell, ps
	Python         = python, py, gyp
	R              = r
	Ruby           = ruby, rb, gemspec, podspec, thor, irb
	Rust           = rust
	Scala          = scala
	Shell Session  = shell
	SQL            = sql
	Swift          = swift
	TypeScript     = typescript, ts
	YAML           = yaml

So for example, to specify a code block as C++, you would write:

	Single line: <code class="language-cpp">...</code>
	
	Multi-line: <pre><code class="language-cpp">...</code></pre>
	
	Alternate: <pre class="language-cpp"><code class="optional">...</code></pre>

Note: in the previous example, ignore the `class="optional"` added to the code tag (for the "Alternate" syntax); it is used to prevent markdown from mangling the code example on this web page.

To disable Highlight.js syntax highlighting for any code block, add a class of `nohighlight`, like so:

	<code class="nohighlight">...</code>

Similarly, you can add a class of `plaintext` to make arbitrary text look like code, but without highlighting:

	<code class="plaintext">...</code>

_I'm glad to add more languages, [make a suggestion](https://perishablepress.com/contact/)_



== Upgrade Notice ==

To upgrade Prismatic, remove the old version and replace with the new version. Or just click "Update" from the Plugins screen and let WordPress do it for you automatically.

__Note:__ uninstalling the plugin from the WP Plugins screen results in the removal of all settings from the WP database. 



== Frequently Asked Questions ==

**Can you add another language for Prism.js or Highlight.js?**

Yes, feel free to [suggest a language](https://perishablepress.com/contact/)


**Does this work with Gutenberg Block Editor?**

Yes, the plugin provides a "Prismatic" block that makes it easy to add code snippets that will be highlighted on the front-end. Also provides "add code" buttons for the Classic TinyMCE (Visual/Text) Editor. Add code, choose a language, done!


**Display syntax-highlighted code inside Block Editor?**

If for some reason you want to view syntax-highlighted code inside of the Block Editor, you can do it with the Classic Block:

1. Select the Classic Block
2. Click on the Prismatic TinyMCE button
3. Enter your code and save changes

The code won't be highlighted initially, but if you refresh the page after making changes, or visit the page again in the future, the code will be displayed with syntax highlighting applied.


**How to syntax highlight code inside of ACF field?**

As of Prismatic version 2.3, code snippets inside of ACF fields are highlighted automatically. Simply add the required class (e.g., `language-php`) just like any other code snippet, and the plugin will detect and highlight the code. To also escape the highlighted code, enable escaping for post content via the setting, Prism &gt; Code Escaping &gt; Content. Note: ACF is supported only on single post views.


**How to make highlighting work with Autoptimize?**

For Prismatic plugin to work with Autoptimize, a script needs to be excluded. For details, check out [this post](https://ncoughlin.com/prismatic-syntax-highlighter-compatibility-autoptimize-plugin/) by Nick Coughlin.


**How to disable block styles on frontend?**

If you are not using Gutenberg Block Editor, you can disable the plugin's block stylesheet. Simply enable the plugin setting, "Block Styles". Save changes and done.

FYI: the Prismatic block styles are included via: `/prismatic/css/styles-blocks.css`


**Got a question?**

Send any questions or feedback via my [contact form](https://perishablepress.com/contact/)



== Support development of this plugin ==

I develop and maintain this free plugin with love for the WordPress community. To show support, you can [make a donation](https://monzillamedia.com/donate.html) or purchase one of my books: 

* [The Tao of WordPress](https://wp-tao.com/)
* [Digging into WordPress](https://digwp.com/)
* [.htaccess made easy](https://htaccessbook.com/)
* [WordPress Themes In Depth](https://wp-tao.com/wordpress-themes-book/)

And/or purchase one of my premium WordPress plugins:

* [BBQ Pro](https://plugin-planet.com/bbq-pro/) - Super fast WordPress firewall
* [Blackhole Pro](https://plugin-planet.com/blackhole-pro/) - Automatically block bad bots
* [Banhammer Pro](https://plugin-planet.com/banhammer-pro/) - Monitor traffic and ban the bad guys
* [GA Google Analytics Pro](https://plugin-planet.com/ga-google-analytics-pro/) - Connect WordPress to Google Analytics
* [USP Pro](https://plugin-planet.com/usp-pro/) - Unlimited front-end forms

Links, tweets and likes also appreciated. Thank you! :)



== Changelog ==

Thank you to everyone providing feedback! If you like Prismatic, please take a moment to [give a 5-star rating](https://wordpress.org/support/plugin/prismatic/reviews/?rate=5#new-post). It helps to keep development and support going strong. Thank you!


**2.6 (2020/11/10)**

* Adds option to disable the Prismatic block stylesheet
* Adds `[prismatic_code]` shortcode for [nested code tags](https://wordpress.org/support/topic/sourcecode-with-tags-i-e-nested-tags/)
* Updates plugin script to account for changes in jQuery UI
* Fixes PHP Warnings re: `preg_split()` and `count()`
* Fixes bug with Visual Editor button and contributors
* Fixes bug with Visual Editor and code escaping (Thanks [@mgongee](https://wordpress.org/support/topic/html-tags-are-stripped-out-instead-of-being-escaped/))
* Improves the appearance of the plugin settings page
* Updates default translation template
* Tests on PHP 7.4 and 8.0
* Tests on WordPress 5.6

**2.5 (2020/08/07)**

Prism.js

* Updates Prism.js to version 1.21.0
* Updates all Prism plugins and themes
* Adds languages: Elixir, G-code, HCL, Liquid, R, Solidity
* Adds markup aliases (html, xml, svg, mathml, ssml, atom, rss)

Highlight.js

* Updates Highlight.js to version 10.1.2
* Updates all Highlight.js styles
* Adds languages: Elixir, G-code, R
* Removes `darkula` stylesheet and option
* Adds styles `lioshi`, `nnfx`, `nnfx-dark`, `srcery`
* Bugfix: Adds missing style options to settings menu
* Bugfix: Adds missing `plaintext` to code block options

General

* Refines readme/documentation
* Tests on WordPress 5.5

**2.4 (2020/03/13)**

* Upgrades Prism.js library to version 1.19.0
* Upgrades Highlight.js library to version 9.18.1
* Adds Shell Session, Batch, Rust languages to Prism.js
* Adds Rust language to Highlight.js
* Fixes PHP warnings about `strpos()` and `preg_split()`
* Adds version number to enqueued scripts and styles
* Fine tunes language and copy code button styles
* Tests on WordPress 5.4

**2.3 (2019/10/27)**

* Updates styles for plugin settings page
* Fixes bug with older versions of WordPress
* Adds "copy code to clipboard" button for Prism.js
* Adds support for Prism.js highlighting in ACF fields
* Adds support for `language-none` for Prism.js
* Generates new default translation template
* Updates documentation with further infos
* Tests on WordPress 5.3

**2.2 (2019/08/16)**

* Resolves several warnings in PHP 7+
* Adds `prismatic_get_default_options()`
* Adds Quicktag button for plain-text editor
* Adds TinyMCE buttons for Prism.js and Highlight.js
* Adds Blocks for Prism.js, Highlight.js, and Plain Flavor
* Changes priority of content filter in `prismatic_add_filters()`
* Updates Highlight.js core to version 9.15.9
* Adds YAML language for Highlight.js
* Updates Prism.js core to version 1.17.1
* Adds TSX language for Prism.js
* Updates some links to https
* Generates new default translation template
* Tests on WordPress 5.3 (alpha)

**2.1 (2019/04/28)**

* Bumps [minimum PHP version](https://codex.wordpress.org/Template:Server_requirements) to 5.6.20
* Adds Arduino language for Prism.js
* Updates Prism.js to latest version 1.16.0
* Updates Prism.js script for Java langauge
* Updates Prism.js themes and plugins
* Adds Arduino language for Highlight.js
* Adds GML language for Highlight.js
* Updates all Highlight.js stylesheets
* Updates default translation template
* Tests on WordPress 5.2

**2.0 (2019/03/06)**

* Updates Highlight.js to latest version 9.15.6
* Adds Highlight.js languages: D, Dart, Scala
* Adds 10 new Highlight.js themes
* Updates Prism.js to latest version 1.15.0
* Adds Prism.js languages: D, JSX, Dart, Scala
* Adds check for admin user for settings shortcut link
* Tweaks plugin settings screen UI
* Generates new default translation template
* Tests on WordPress 5.1 and 5.2 (alpha)

**1.9 (2019/02/02)**

* Just a version bump for compat with WP 5.1
* Full update coming soon :)

**1.8 (2018/11/14)**

* Fixes bug: Invalid argument foreach() resources-enqueue.php line 267
* Adds homepage link to Plugins screen
* Updates default translation template
* Tests on WordPress 5.0 (beta)

**1.7 (2018/08/17)**

* Adds `rel="noopener noreferrer"` to all [blank-target links](https://perishablepress.com/wordpress-blank-target-vulnerability/)
* Updates GDPR blurb and donate link
* Tweaks appearance of plugin settings page
* Generates new default translation template
* Further tests on WP versions 4.9 and 5.0 (alpha)

**1.6/1.6.1 (2018/05/07)**

* Updates Prism.js from 1.11 to 1.14
* Adds new Prism theme: "Tomorrow Night"
* Adds Prism language support for Go `go`, VBA `visual-basic`, Pascal `pascal`
* Adds Highlight language support for Go `go`
* Improves support for Gutenberg Editor
* Removes unused font file, `FontAwesome.otf`
* Tests on WordPress 5.0 (alpha)

**1.5 (2017/10/22)**

* Adds "Requires PHP" to plugin file headers
* Tests on WordPress 4.9

**1.4 (2017/07/31)**

* Fixes several PHP Warnings
* Updates Highlight.js to version 9.12.0
* Adds new languages for Highlight.js and Prism.js
* Adds GPL license text file
* Tests on WordPress 4.9 (alpha)

**1.3 (2017/03/24)**

* Updates some URLs to HTTPS
* Updates Prism.js to version 1.6
* Updates Highlight.js to version 9.11.0
* Adds new languages for Highlight.js and Prism.js
* Tweaks plugin settings styles
* Replaces global `$wp_version` with `get_bloginfo('version')`
* Tests on WordPress version 4.8

**1.2 (2016/11/16)**

* Adds support for AppleScript in Highlight.js
* Updates plugin URL in core files and readme.txt
* Changes stable tag from trunk to latest version
* Adds `&raquo;` to rate this link on Plugins screen
* Adds strong tags to admin notices on settings page
* Refines styles for popup dialog on settings page
* Tests on WordPress version 4.7 (beta)

**1.1 (2016/10/24)**

* Updates/adds some links
* Updates default language file
* Tests on WordPress version 4.7 (alpha)

**1.0 (2016/10/21)**

* Initial release
