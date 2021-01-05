<?php
/*
Plugin Name: WPTerm
Plugin URI: https://nintechnet.com/bruandet/
Description: An xterm-like plugin to run non-interactive shell commands.
Author: Jerome Bruandet
Version: 1.1.1
Author URI: https://nintechnet.com/
Text Domain: wpterm
Domain Path: /languages
License: GPLv3 or later
*
 +=====================================================================+
 |      __        ______ _____                                         |
 |      \ \      / /  _ \_   _|__ _ __ _ __ ___                        |
 |       \ \ /\ / /| |_) || |/ _ \ '__| '_ ` _ \                       |
 |        \ V  V / |  __/ | |  __/ |  | | | | | |                      |
 |         \_/\_/  |_|    |_|\___|_|  |_| |_| |_|                      |
 |                                                                     |
 | (c) Jerome Bruandet ~ https://nintechnet.com/                       |
 +=====================================================================+
*/
define( 'WPTERM_VERSION', '1.1.1' );

/* ================================================================== */

if (! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

/* ================================================================== */

$null = __('An xterm-like plugin to run non-interactive shell commands.', 'wpterm');

/* ================================================================== */

// Use PHP session only if we have a defined password:
if (! headers_sent() && defined( 'WPTERM_PASSWORD' ) ) {
	if (version_compare(PHP_VERSION, '5.4', '<') ) {
		if (! session_id() ) {
			session_start();
		}
	} else {
		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}
	}
}

/* ================================================================== */

// Force WP to load our translation files:
load_plugin_textdomain(
	'wpterm',
	FALSE,
	dirname( plugin_basename( __FILE__ ) ).'/languages/'
);

/* ================================================================== */

function wpterm_activate() {

	// Make sure the user meets the requirements to run WPTerm:

	if ( PATH_SEPARATOR == ';' ) {
		exit( __( 'WPTerm is not compatible with Microsoft Windows.', 'wpterm' ) );
	}

	global $wp_version;
	if ( version_compare( $wp_version, '3.3', '<' ) ) {
		exit( sprintf( __( 'WPTerm requires WordPress 3.3 or greater but your current version is %s.', 'wpterm' ), htmlspecialchars( $wp_version ) ) );
	}

	if ( version_compare( PHP_VERSION, '5.3.0', '<' ) ) {
		exit( sprintf( __( 'WPTerm requires PHP 5.3 or greater but your current version is %s.', 'wpterm' ), PHP_VERSION ) );
	}

}

register_activation_hook( __FILE__, 'wpterm_activate' );

/* ================================================================== */

function wpterm_settings_link( $links ) {

	// Display the link in the "Plugins" page:

   $links[] = '<a href="'. get_admin_url( null, 'tools.php?page=wpterm' ) .
					'">' . __( 'Terminal', 'wpterm' ) . '</a>';
   return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpterm_settings_link' );

/* ================================================================== */

function wpterm_js_insert() {

	// Insert our JS and CSS files in the footer for the admin...
	if (! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	// ...when viewing WPTerm pages only:
	if (! empty( $_GET['page'] ) && $_GET['page'] == 'wpterm' ) {

		// Load terminal JS code only if we are requesting the terminal tab:
		if (! empty( $_GET['wptermtab'] ) && $_GET['wptermtab'] == 'terminal' ) {
			wp_enqueue_script(
				'wpterm_script2',
				plugin_dir_url( __FILE__ ) . 'wpterm-terminal.js',
				array( 'jquery' )
			);

		} else {
			wp_enqueue_script(
				'wpterm_script',
				plugin_dir_url( __FILE__ ) . 'wpterm.js',
				array( 'jquery' )
			);
		}

		wp_enqueue_style(
			'wpterm_style',
			plugin_dir_url( __FILE__ ) . 'wpterm.css'
		);
	}
}

add_action( 'admin_footer', 'wpterm_js_insert' );

/* ================================================================== */

function wpterm_admin_menu() {

	// Append WPTerm menu to the "Tools" menu:

	global $menu_hook;

	require_once( plugin_dir_path(__FILE__) . 'wpterm-help.php' );

	$menu_hook = add_submenu_page(
		'tools.php',
		'WPTerm',
		'WPTerm',
		// In a multisite environment, only the
		// superadmin will be able to access WPTerm:
		'activate_plugins',
		'wpterm',
		'wpterm_main_menu'
	);

	// Load contextual help:
	add_action( 'load-' . $menu_hook, 'wpterm_help' );

}

add_action( 'admin_menu', 'wpterm_admin_menu' );

/* ================================================================== */

function wpterm_main_menu() {

	// Show the selected tab and page:

	// If the terminal is password protected,
	// check if the user is authenticated:
	if (! wpterm_is_allowed() ) { return; }

	$tab = array ( 'terminal', 'settings', 'about', 'donate' );
	// Make sure $_GET['wptermtab']'s value is okay,
	// otherwise set it to its default 'terminal' value:
	if (! isset( $_GET['wptermtab'] ) || ! in_array( $_GET['wptermtab'], $tab ) ) {
		$_GET['wptermtab'] = 'terminal';
	}
	$wpterm_menu = "wpterm_menu_{$_GET['wptermtab']}";
	$wpterm_menu();

}

/* ================================================================== */

function wpterm_get_blogtimezone() {

	// Get the timezone:

	// From WordPress...
	$tzstring = get_option( 'timezone_string' );
	if (! $tzstring ) {
		// ...or PHP?
		$tzstring = ini_get( 'date.timezone' );
		if (! $tzstring ) {
			// Set it to UTC if we cannot find it:
			$tzstring = 'UTC';
		}
	}
	date_default_timezone_set( $tzstring );
}

/* ================================================================== */

function wpterm_menu_terminal() {

	// Display the terminal:

	// Fetch our options:
	$wpterm_options = wpterm_menu_get_settings();

	// Retrieve the current user info (name, home dir etc):
	$userinfo = posix_getpwuid( posix_getuid() );

	// Get current working directory:
	if ( $wpterm_options['user-home'] == 'abspath' ) {
		// WP current dir (a.k.a. ABSPATH):
		$cwd = htmlspecialchars( rtrim( ABSPATH, '/' ) );
	} else {
		// Linux home dir:
		$cwd = htmlspecialchars( rtrim( $userinfo['dir'], '/' ) );
	}

	// Get the blog timezone:
	wpterm_get_blogtimezone();

	$last_login = '';
	$kernel_info = '';

	// Get/set last login:
	if (! empty( $wpterm_options['last_login'] ) ) {
		list ( $time, $user, $ip ) = explode( ':', $wpterm_options['last_login'], 3 );
		// Try to get hostname from its IP:
		if (! $host =  gethostbyaddr( $ip ) ) {
			$host = $ip;
		}
		$date = date_i18n( 'D M d H:i:s Y', $time );
		// We'll display this along the "welcome" message:
		$last_login = sprintf(
			__( 'Last login: %s, %s from %s', 'wpterm' ),
			htmlspecialchars( $user ),
			$date,
			htmlspecialchars( $host ) . '\n'
		);
	}

	// Get the current user (system and WordPress) + his/her IP:
	$current_user = wp_get_current_user();
	$wpuser = htmlspecialchars( $current_user->user_login );
	$user = htmlspecialchars( $userinfo['name'] );
	$ip = htmlspecialchars( $_SERVER['REMOTE_ADDR'] );
	$time = time();

	// We refuse to run if we're root (unless stated otherwise):
	if ( $user == 'root' && ! defined( 'THOU_SHALT_NOT_RUN_AS_ROOT' ) ) {
		?>
		<div class="error notice is-dismissible"><p><?php _e( 'Sorry, but I refuse to run as the <code>root</code> user.', 'wpterm' ) ?></p></div>
		<div class="wrap"><h1>WPTerm</h1></div>
		<?php
		return;
	}

	// Display a one-time notice if we just installed WPTerm
	// (this notice can be displayed again by entering `notice`
	// at the terminal prompt):
	$notice = __( "Thanks for using WPTerm!", "wpterm") . " ";
	$notice.= __( "This is a one-time notice, please read it carefully:", "wpterm") . "<br />";
	$notice.= "<ol>";
	$notice.= "<li>" . __( "Just like a terminal, WPTerm lets you do almost everything you want (e.g., changing file permissions, viewing network connections or current processes etc). That's great, but if you aren't familiar with Linux commands, you can also damage your blog.", "wpterm")  . "<br />" . __( "Therefore, each time you use WPTerm, please follow this rule of thumb: <strong>if you don't know what you're doing, don't do it!</strong>", "wpterm") .  "</li>";
	$notice.= "<li>" . __( 'Take the time to password protect the access to WPTerm. Click on the contextual "Help" menu tab located in the upper right corner to get more details about how to enable this feature.', "wpterm" ) . "</li>";
	$notice.= "<li>" . __( "Do not try to run interactive commands, you can't (most would not run anyway because the TERM environment variable is not set). If you run one by mistake and are stuck at the prompt, press CTRL-C.", "wpterm" ) . "</li>";
	$notice.= "</ol>";
	$notice.=  __( "If you want to read this notice again, type <code>notice</code> from WPTerm prompt.", "wpterm" );
	if ( empty( $wpterm_options['version'] ) ) {
		$style = '';
	} else {
		$style = 'style="display:none" ';
	}
	// Display notice:
	?>
	<div <?php echo $style; ?>id="wpterm-warning" class="error notice"><?php echo $notice ?><p style="text-align:center"><a onclick="jQuery('#wpterm-warning').slideUp();"><?php _e( "Click to hide", "wpterm" ) ?></a></p></div>
	<?php

	// Save options to the database:
	$wpterm_options['last_login'] = "$time:$wpuser:$ip";
	$wpterm_options['version'] = WPTERM_VERSION;
	update_option( 'wpterm_options', $wpterm_options );

	// Greeting + help command (in english only, no i18n):
	$greeting['cowsay'] = '  _________________________________\n/ ';
	$greeting['cowsay'].= " Welcome and thank you for using" . ' \x5c\n| ';
	$greeting['cowsay'].= " WPTerm :)" . '                       |\n\x5c ';
	$greeting['cowsay'].= " If you need help, type 'help'. " . ' /\n';
	$greeting['cowsay'].= '  ---------------------------------\n        \x5c';
	$greeting['cowsay'].= '   ^__^              v' . WPTERM_VERSION . '\n';
	$greeting['cowsay'].= '         \x5c  (oo)\x5c_______\n';
	$greeting['cowsay'].= '            (__)\x5c       )\x5c/\x5c\n';
	$greeting['cowsay'].= '                ||----w |\n';
	$greeting['cowsay'].= '                ||     ||\n';
	$greeting['wpterm'] = '  __        ______ _____\n';
	$greeting['wpterm'].= '  \x5c \x5c      / /  _ \x5c_   _|__ _ __ _ __ ___\n';
	$greeting['wpterm'].= '   \x5c \x5c /\x5c / /| |_) || |/ _ \x5c \'__| \'_ ` _ \x5c\n';
	$greeting['wpterm'].= '    \x5c V  V / |  __/ | |  __/ |  | | | | | |\n';
	$greeting['wpterm'].= '     \x5c_/\x5c_/  |_|    |_|\x5c___|_|  |_| |_| |_| v' .
									WPTERM_VERSION . '\n';
	$greeting['wpterm'].= '     If you need help, type \'help\'.\n\n';
	$greeting['tux'] = '       .--.      [------------------------------]\n';
	$greeting['tux'].= '      |o_o |      WPTerm v' . WPTERM_VERSION . '\n';
	$greeting['tux'].= '      |:_/ |\n';
	$greeting['tux'].= '     //   \x5c \x5c     Welcome and thank you for\n';
	$greeting['tux'].= '    (|     | )    using WPTerm :)\n';
	$greeting['tux'].= '   /\'\x5c_   _/`\x5c    If you need help, type \'help\'.\n';
	$greeting['tux'].= '   \x5c___)-(___/   [------------------------------]\n';

	// Try to get the kernel info:
	list( $uname, $null ) = @run_command( 'uname -a', $wpterm_options['php-function'] );
	if (! empty( $uname ) ) {
		$kernel_info = htmlspecialchars( trim( $uname ) ) . '\n';
	} else {
		// Maybe we are running on a shared hosting account that has
		// PHP program execution functions disabled?
		?>
		<div class="error notice is-dismissible"><p><?php printf( __( "I was unable to run a shell command. Make sure that you are allowed to run %sPHP program execution functions%s, otherwise WPTerm will not function.", "wpterm" ), '<a href="http://php.net/manual/en/ref.exec.php">', '</a>' ) ?></p></div>
		<?php
	}

	// Security nonce used for the terminal (AJAX):
	$wpterm_ajax_nonce = wp_create_nonce( 'wpterm_menu_terminal' );

	?>
<style>
	.terminal-user {
		<?php
		if (! empty( $wpterm_options['bold-font'] ) ) {
			echo "font-weight:bold;\n";
		}
		?>
		background-color:<?php echo $wpterm_options['background-color-val'] ?>;
		color:<?php echo $wpterm_options['font-color-val'] ?>;
		font-family:<?php echo $wpterm_options['font-family'] ?>;
		font-size:<?php echo $wpterm_options['font-size'] ?>px;
	}
</style>
<script>
	var wpterm_ajax_nonce = "<?php echo $wpterm_ajax_nonce ?>";
	var prompt = "<?php echo "$user:$cwd" ?> $ ";
	var user = "<?php echo $user ?>";
	var cwd = "<?php echo $cwd ?>";
	var abspath = "<?php echo htmlspecialchars( rtrim( ABSPATH, '/' ) ) ?>";
	var exec = "<?php echo htmlspecialchars( $wpterm_options['php-function'] ) ?>";
	var last_login = "<?php echo $kernel_info . $greeting[$wpterm_options['welcome-message']] . $last_login ?>";
	var in_progress = "<?php echo esc_js( __( 'Operations in progress, please wait.', 'wpterm' ) ) .'\n'.
									esc_js( __( 'If you want to cancel, press CTRL+C.', 'wpterm' ) ) ?>";
	var op_cancelled = "<?php echo esc_js( __( 'operation cancelled', 'wpterm' ) ) ?>";
	var iptables = "<?php echo esc_js( __( 'if you want a good firewall, install NinjaFirewall (WP Edition):', 'wp-shell' ) );
						echo '\n        https://wordpress.org/plugins/ninjafirewall/'; ?>";
	var emul_tab = <?php echo (int) $wpterm_options['tab-completion'] ?>;
	var emul_tab_msg = "<?php echo esc_js( __( 'Tab completion is disabled. You can enable it from the Settings page', 'wpterm' ) ) ?>";
	var logout_url = "<?php echo html_entity_decode( wp_logout_url() ); ?>";
	var logout_msg = "<?php echo esc_js( __( 'Log out of WordPress?', 'wpterm' ) ) ?>";
	var unknown_err = "<?php echo esc_js( __( 'WPTerm: error, no data received', 'wpterm' ) ) ?>";
	var version = "<?php echo '\nWPTerm v' . WPTERM_VERSION ?>";
	var scrollback = <?php echo (int) $wpterm_options['scrollback'] ?>;
	var visual_bell = <?php echo (int) $wpterm_options['visual-bell'] ?>;
	var audible_bell = <?php echo (int) $wpterm_options['audible-bell'] ?>;
	var wrap_on	= "<?php echo esc_js( __( "Line wrapping is enabled", "wpterm" ) ) ?>";
	var wrap_off = "<?php echo esc_js( __( "Line wrapping is disabled", "wpterm" ) ) ?>";
</script>

<div class="wrap">
	<h1>WPTerm</h1>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="?page=wpterm&wptermtab=terminal" class="nav-tab nav-tab-active"><?php _e( 'Terminal', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=settings" class="nav-tab"><?php _e( 'Settings', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=about" class="nav-tab"><?php _e( 'About', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=donate" class="nav-tab"><?php _e( 'Donate', 'wpterm' ) ?></a>
	</h2>

	<table style="width:100%;padding-top:4px">
		<tr>
			<td width="100%">
				<textarea ondragstart="return false;" id="terminal" class="terminal terminal-user" onMouseOver="this.focus();" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" wrap="soft"></textarea>
			</td>
		</tr>
	</table>

	<table style="width:100%">
		<tr>
			<td style="width:50%;text-align:left">
				<img id="progress_gif" style="display:none" src="<?php echo plugins_url() ?>/wpterm/images/wpterm-progress.gif" width="51" height="13" title="<?php _e('Operations in progress, please wait.', 'wpterm') ?>">
			</td>
			<td style="width:50%;text-align:right">
				<img onClick="line_wrapping(this);" onTouchStart="line_wrapping(this);" id="wrap-line" border="0" src="<?php echo plugins_url() ?>/wpterm/images/wpterm-wrap.png" width="20" height="20" title="<?php _e( "Line wrapping is enabled", "wpterm" ) ?>" style="cursor:pointer">
				&nbsp;&nbsp;&nbsp;
				<img onClick="font_size(-1);" onTouchStart="font_size(-1);" border="0" src="<?php echo plugins_url() ?>/wpterm/images/wpterm-fontminus.png" width="21" height="20" title="<?php _e( "Decrease font size", "wpterm" ) ?>" style="cursor:pointer">
				&nbsp;&nbsp;&nbsp;
				<img onClick="font_size(1);" onTouchStart="font_size(1);" border="0" src="<?php echo plugins_url() ?>/wpterm/images/wpterm-fontplus.png" width="21" height="20" title="<?php _e( "Increase font size", "wpterm" ) ?>" style="cursor:pointer">
			</td>
		</tr>
	</table>

</div>
<?php
}

/* ================================================================== */

function wpterm_menu_settings() {

	// Display the settings page:

	// Save settings?
	if ( isset( $_POST['save-settings'] ) ) {
		// Verify security nonce:
		if ( empty( $_POST['wptermnonce'] ) || ! wp_verify_nonce( $_POST['wptermnonce'], 'save_settings' ) ) {
			wp_nonce_ays( 'save_settings' );
		}
		wpterm_menu_save_settings();
		echo '<div class="updated notice is-dismissible"><p>' . __('Your changes have been saved.', 'wpterm') .'</p></div>';
	}

	// Fetch, verify and sanitize the current settings:
	$wpterm_options = wpterm_menu_get_settings();

?>
<div class="wrap">
	<h1>WPTerm</h1>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="?page=wpterm&wptermtab=terminal" class="nav-tab"><?php _e( 'Terminal', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=settings" class="nav-tab nav-tab-active"><?php _e( 'Settings', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=about" class="nav-tab"><?php _e( 'About', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=donate" class="nav-tab"><?php _e( 'Donate', 'wpterm' ) ?></a>
	</h2>

	<br />

	<form method="post">

	<h3><?php _e('Fonts and Colors', 'wpterm') ?></h3>

	<table class="form-table">

		<tr>
			<th scope="row"><?php _e('Font color', 'wpterm') ?></th>
			<td align="left">
				<input type="text" name="font-color" value="<?php echo htmlspecialchars( $wpterm_options['font-color'] ) ?>" oninput="wpterm_preview('color', 'color', this.value)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<p>
					<span class="description">
						<?php printf ( __( 'Hexadecimal value (e.g., %s) or CSS color name (e.g., <code>red</code>).', 'wpterm' ), '<code>ffffff</code>' ) ?>
					</span>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Background color', 'wpterm') ?></th>
			<td align="left">
				<input type="text" name="background-color" value="<?php echo htmlspecialchars( $wpterm_options['background-color'] ) ?>" oninput="wpterm_preview('color', 'background', this.value)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<p>
					<span class="description">
						<?php printf ( __( 'Hexadecimal value (e.g., %s) or CSS color name (e.g., <code>red</code>).', 'wpterm' ), '<code>3465A4</code>' ) ?>
					</span>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Font size', 'wpterm') ?></th>
			<td align="left">
				<input type="number" class="small-text" name="font-size" step="1" min="9" max="20" value="<?php echo (int) $wpterm_options['font-size'] ?>" oninput="wpterm_preview('fontsize', 0, this.value);" /> px
				&nbsp;&nbsp;&nbsp;&nbsp;
				<label><input type="checkbox" id="bold_font" onchange="wpterm_preview('fontweight', 'bold_font', this.value);" name="bold-font"<?php checked( $wpterm_options['bold-font'], 1 ) ?> /><?php _e( 'Bold fonts', 'wpterm' ) ?></label>
				<p>
					<span class="description">
						<?php _e('From 9 to 20px.', 'wpterm') ?>
					</span>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Font family', 'wpterm') ?></th>
			<td align="left">
				<input type="text" class="regular-text" name="font-family" value="<?php echo htmlspecialchars( $wpterm_options['font-family'] ) ?>" oninput="wpterm_preview('fontface', 0, this.value)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<p>
					<span class="description">
						<?php _e( 'Multiple values must be comma separated (e.g., <code>Consolas,Monaco,monospace</code>)', 'wpterm' ) ?>
					</span>
				</p>
			</td>
		</tr>

		<?php
		if (! empty( $wpterm_options['bold-font'] ) ) {
			$font_weight = 'font-weight:bold;';
		} else {
			$font_weight = 'font-weight:normal;';
		}
		?>
		<tr>
			<th scope="row"><?php _e('Test', 'wpterm') ?></th>
			<td align="left">
				<textarea autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" id="textarea-test" rows="3" style="width:20em;resize:both;padding:10px;color:<?php echo htmlspecialchars( $wpterm_options['font-color-val'] ) ?>;background-color:<?php echo htmlspecialchars( $wpterm_options['background-color-val'] ) ?>;font-size:<?php echo (int) $wpterm_options['font-size'] ?>px;font-family:<?php echo htmlspecialchars( $wpterm_options['font-family'] ) ?>;<?php echo $font_weight ?>"><?php echo "ABCDEFGHIJKLMNOPQRSTUVWXYZ\nabcdefghijklmnopqrstuvwxyz\n0123456789" ?></textarea>
			</td>
		</tr>

	</table>

	<br />

	<h3><?php _e('Terminal', 'wpterm') ?></h3>

	<table class="form-table">

		<tr>
			<th scope="row"><?php _e('Use the following PHP function for command execution', 'wpterm') ?></th>
			<td align="left">
				<p>
					<label>
						<input type="radio" name="php-function" value="exec"<?php checked( $wpterm_options['php-function'], 'exec' ) ?> /><code>exec</code>
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="php-function" value="shell_exec"<?php checked( $wpterm_options['php-function'], 'shell_exec' ) ?> /><code>shell_exec</code>
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="php-function" value="system"<?php checked( $wpterm_options['php-function'], 'system' ) ?> /><code>system</code>
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="php-function" value="passthru"<?php checked( $wpterm_options['php-function'], 'passthru' ) ?> /><code>passthru</code>
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="php-function" value="backtick"<?php checked( $wpterm_options['php-function'], 'backtick' ) ?> /><code>`backticks`</code>
					</label>
				</p>
			</td>
		</tr>


		<tr>
			<th scope="row"><?php _e('Emulate pseudo-Tab completion?', 'wpterm') ?></th>
			<td align="left">
				<p>
					<label>
						<input type="radio" name="tab-completion" value="1"<?php checked( $wpterm_options['tab-completion'], 1 ) ?> /><?php _e( 'Yes', 'wpterm' ) ?>
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="tab-completion" value="0"<?php checked( $wpterm_options['tab-completion'], 0 ) ?> /><?php _e( 'No', 'wpterm' ) ?>
					</label>
				</p>
			</td>
		</tr>

		<?php
		// Retrieve user info:
		$userinfo = posix_getpwuid( posix_getuid() );
		?>
		<tr>
			<th scope="row"><?php _e('Default working directory', 'wpterm') ?></th>
			<td align="left">
				<p>
					<label>
						<input type="radio" name="user-home" value="abspath"<?php checked( $wpterm_options['user-home'], 'abspath' ) ?> /><?php printf( __( 'WordPress ABSPATH (%s)', 'wpterm' ), '<code>'. htmlspecialchars( ABSPATH ) .'</code>' ) ?>
					</label>
				</p>
				<span class="description"><?php printf( __( "Tip: to go back to that directory, type %s.", "wpterm" ), '<code>cd $ABSPATH</code>' ) ?></span>

				<p>
					<label>
						<input type="radio" name="user-home" value="homedir"<?php checked( $wpterm_options['user-home'], 'homedir' ) ?> /><?php printf( __( 'User home directory (%s)', 'wpterm' ), '<code>'. htmlspecialchars( $userinfo['dir'] ) .'</code>' ) ?>
					</label>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Scrollback', 'wpterm') ?></th>
			<td align="left">
				<label><?php printf( __( "Limit scrollback to %s lines", "wpterm" ) , '<input type="number" class="small-text" name="scrollback" step="1" min="1" max="3000" value="' . (int) $wpterm_options['scrollback'] .'" />' ) ?></label>
				<br>
				<span class="description">
					<?php _e('Max 3,000 lines.', 'wpterm') ?>
				</span>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Welcome message', 'wpterm') ?></th>
			<td align="left">
				<p>
					<label>
						<input type="radio" name="welcome-message" value="wpterm"<?php checked( $wpterm_options['welcome-message'], 'wpterm' ) ?> />WPTerm
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="welcome-message" value="cowsay"<?php checked( $wpterm_options['welcome-message'], 'cowsay' ) ?> />Cowsay
					</label>
				</p>
				<p>
					<label>
						<input type="radio" name="welcome-message" value="tux"<?php checked( $wpterm_options['welcome-message'], 'tux' ) ?> />Tux
					</label>
				</p>
			</td>
		</tr>

		<?php
		// IE up to 11 isn't compatible with our 'Audible bell':
		if ( isset( $_SERVER["HTTP_USER_AGENT"] ) && strpos( $_SERVER["HTTP_USER_AGENT"], '; rv:11' ) !== false ) {
			$disabled = ' disabled="disabled"';
		} else {
			$disabled = '';
		}
		?>
		<tr>
			<th scope="row"><?php _e('Terminal bell', 'wpterm') ?></th>
			<td align="left">
				<p><label id="visual-bell">
					<input type="checkbox" onchange="bell_preview(this, 'visual');" name="visual-bell"<?php checked( $wpterm_options['visual-bell'], 1 ) ?> /><?php _e( 'Visual bell', 'wpterm' ) ?>
				</label></p>
				<p><label>
				<input type="checkbox"<?php echo $disabled ?> onchange="bell_preview(this, 'beep');" name="audible-bell"<?php checked( $wpterm_options['audible-bell'], 1 ) ?> /><?php _e( 'Audible bell', 'wpterm' ) ?>
				</label></p>
			</td>
		</tr>

	</table>

	<br />
	<br />

	<input class="button-primary" type="submit" name="save-settings" value="<?php _e('Save Settings', 'wpterm') ?>" />

	<?php wp_nonce_field('save_settings', 'wptermnonce', 0); ?>

	</form>

</div>

<?php

}

/* ================================================================== */

function wpterm_menu_get_settings() {

	// Retrieve the current settings:

	$wpterm_options = get_option( 'wpterm_options' );

	if ( empty( $wpterm_options['font-color'] ) ) {
		$wpterm_options['font-color'] = 'ffffff';
	} else {
		$wpterm_options['font-color'] = preg_replace( '/\W/', '', $wpterm_options['font-color'] );
	}
	if ( ctype_xdigit( $wpterm_options['font-color'] ) ) {
		$wpterm_options['font-color-val'] = '#' . $wpterm_options['font-color'];
	} else {
		$wpterm_options['font-color-val'] = $wpterm_options['font-color'];
	}

	if ( empty( $wpterm_options['background-color'] ) ) {
		$wpterm_options['background-color'] = '3465A4';
	} else {
		$wpterm_options['background-color'] = preg_replace( '/\W/', '', $wpterm_options['background-color'] );
	}
	if ( ctype_xdigit( $wpterm_options['background-color'] ) ) {
		$wpterm_options['background-color-val'] = '#' . $wpterm_options['background-color'];
	} else {
		$wpterm_options['background-color-val'] = $wpterm_options['background-color'];
	}

	if (! isset( $wpterm_options['font-size'] ) || ! preg_match( '/^(?:9|1[0-9]|20)$/',  $wpterm_options['font-size'] ) ) {
		$wpterm_options['font-size'] = 13;
	}


	if (! empty( $wpterm_options['bold-font'] ) ) {
		$wpterm_options['bold-font'] = 1;
	} else {
		$wpterm_options['bold-font'] = 0;
	}

	if (! empty( $wpterm_options['font-family'] ) ) {
		$wpterm_options['font-family'] = preg_replace( '/[^\'" ,a-zA-Z]/', '', $wpterm_options['font-family'] );
		$wpterm_options['font-family'] = trim( $wpterm_options['font-family'], ' ,' );
	}
	if ( empty( $wpterm_options['font-family'] ) ) {
		$wpterm_options['font-family'] = 'Consolas,Monaco,monospace';
	}

	if ( empty( $wpterm_options['welcome-message'] ) || ! preg_match( '/^(?:wpterm|cowsay|tux)$/', $wpterm_options['welcome-message'] ) ) {
		$wpterm_options['welcome-message'] = 'wpterm';
	}

	if ( empty( $wpterm_options['php-function'] ) || ! preg_match( '/^(?:exec|shell_exec|system|passthru|backtick)$/', $wpterm_options['php-function'] ) ) {
		$wpterm_options['php-function'] = 'exec';
	}

	if (! isset( $wpterm_options['tab-completion'] ) || $wpterm_options['tab-completion'] == 1 ) {
		// Default value:
		$wpterm_options['tab-completion'] = 1;
	} else {
		$wpterm_options['tab-completion'] = 0;
	}


	if (! isset( $wpterm_options['user-home'] ) || $wpterm_options['user-home'] == 'abspath' ) {
		$wpterm_options['user-home'] = 'abspath';
	} else {
		$wpterm_options['user-home'] = 'homedir';
	}


	if (! empty( $wpterm_options['scrollback'] ) ) {
		$wpterm_options['scrollback'] = (int) $wpterm_options['scrollback'];
		if ( $wpterm_options['scrollback'] < 1 || $wpterm_options['scrollback'] > 3000 ) {
			$wpterm_options['scrollback'] = 512;
		}
	} else {
		$wpterm_options['scrollback'] = 512;
	}


	if (! isset( $wpterm_options['visual-bell'] ) || $wpterm_options['visual-bell'] == 1 ) {
		$wpterm_options['visual-bell'] = 1;
	} else {
		$wpterm_options['visual-bell'] = 0;
	}

	if (! empty( $wpterm_options['audible-bell'] ) ) {
		$wpterm_options['audible-bell'] = 1;
	} else {
		$wpterm_options['audible-bell'] = 0;
	}


	return $wpterm_options;

}

/* ================================================================== */

function wpterm_menu_save_settings() {

	// Check and save the terminal settings:

	$wpterm_options = get_option( 'wpterm_options' );


	if ( empty( $_POST['font-color'] ) ) {
		$wpterm_options['font-color'] = 'ffffff';
	} else {
		// Make sure $_POST['font-color'] contains only word characters:
		$wpterm_options['font-color'] = preg_replace( '/\W/', '', $_POST['font-color'] );
	}

	if ( empty( $_POST['background-color'] ) ) {
		$wpterm_options['background-color'] = '3465A4';
	} else {
		// Make sure $_POST['background-color'] contains only word characters:
		$wpterm_options['background-color'] = preg_replace( '/\W/', '', $_POST['background-color'] );
	}

	// Make sure $_POST['font-size'] is an integer between 9 and 20,
	// otherwise set it to 13, its default value:
	if (! isset( $_POST['font-size'] ) || ! preg_match( '/^(?:9|1[0-9]|20)$/',  $_POST['font-size'] ) ) {
		$wpterm_options['font-size'] = 13;
	} else {
		$wpterm_options['font-size'] = (int)$_POST['font-size'];
	}

	if (! empty( $_POST['bold-font'] ) ) {
		$wpterm_options['bold-font'] = 1;
	} else {
		$wpterm_options['bold-font'] = 0;
	}

	// Make sure $_POST['font-family'] contains only letters, commas, spaces, single and double quotes:
	if (! empty( $_POST['font-family'] ) ) {
		$wpterm_options['font-family'] = preg_replace( '/[^\'" ,a-zA-Z]/', '', $_POST['font-family'] );
		$wpterm_options['font-family'] = trim( $wpterm_options['font-family'], ' ,' );
	}
	if ( empty( $_POST['font-family'] ) ) {
		$wpterm_options['font-family'] = 'Consolas,Monaco,monospace';
	}

	// Make sure the value of $_POST['welcome-message'] is 'wpterm', 'cowsay' or 'tux',
	// otherwise set it to 'wpterm', its default value:
	if ( empty( $_POST['welcome-message'] ) || ! preg_match( '/^(?:wpterm|cowsay|tux)$/', $_POST['welcome-message'] ) ) {
		$wpterm_options['welcome-message'] = 'wpterm';
	} else {
		$wpterm_options['welcome-message'] = htmlspecialchars( $_POST['welcome-message'] );
	}

	// Make sure the value of $_POST['php-function'] is 'exec', 'shell_exec', 'system', 'passthru' or 'backtick',
	// otherwise set it to 'exec', its default value:
	if ( empty( $_POST['php-function'] ) || ! preg_match( '/^(?:exec|shell_exec|system|passthru|backtick)$/', $_POST['php-function'] ) ) {
		$wpterm_options['php-function'] = 'exec';
	} else {
		$wpterm_options['php-function'] = htmlspecialchars( $_POST['php-function'] );
	}

	if ( empty( $_POST['tab-completion'] ) || $_POST['tab-completion'] != 1 ) {
		$wpterm_options['tab-completion'] = 0;
	} else {
		$wpterm_options['tab-completion'] = 1;
	}

	// Make sure the value of $_POST['user-home'] is 'abspath' or 'homedir',
	// otherwise set it to 'abspath', its default value:
	if ( empty( $_POST['user-home'] ) || ! preg_match( '/^(?:abspath|homedir)$/', $_POST['user-home'] ) ) {
		$wpterm_options['user-home'] = 'abspath';
	} else {
		$wpterm_options['user-home'] = htmlspecialchars( $_POST['user-home'] );
	}

	// Make sure $_POST['scrollback'] is an integer between 1 and 3,000,
	// otherwise set it to 512, its default value:
	if (! empty( $_POST['scrollback'] ) ) {
		$wpterm_options['scrollback'] = (int) $_POST['scrollback'];
		if ( $wpterm_options['scrollback'] < 1 || $wpterm_options['scrollback'] > 3000 ) {
			$wpterm_options['scrollback'] = 512;
		}
	} else {
		$wpterm_options['scrollback'] = 512;
	}


	if (! empty( $_POST['audible-bell'] ) ) {
		$wpterm_options['audible-bell'] = 1;
	} else {
		$wpterm_options['audible-bell'] = 0;
	}
	if (! empty( $_POST['visual-bell'] ) ) {
		$wpterm_options['visual-bell'] = 1;
	} else {
		$wpterm_options['visual-bell'] = 0;
	}


	// Save current version too (we'll likely need it when updating the plugin):
	$wpterm_options['version'] = WPTERM_VERSION;

	update_option( 'wpterm_options', $wpterm_options );

}

/* ================================================================== */

function wpterm_menu_about() {

	if ( file_exists( plugin_dir_path(__FILE__) . 'LICENSE.TXT' ) ) {
		$gpl3 = file_get_contents( plugin_dir_path(__FILE__) . 'LICENSE.TXT' );
	} else {
		$gpl3 = __( 'Error: cannot open LICENSE.TXT!', 'wpterm' );
	}
?>
<div class="wrap">
	<h1>WPTerm</h1>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="?page=wpterm&wptermtab=terminal" class="nav-tab"><?php _e( 'Terminal', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=settings" class="nav-tab"><?php _e( 'Settings', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=about" class="nav-tab nav-tab-active"><?php _e( 'About', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=donate" class="nav-tab"><?php _e( 'Donate', 'wpterm' ) ?></a>
	</h2>

	<div class="card">
		<h1>WPTerm v<?php echo WPTERM_VERSION ?></h1>
		<h3>&copy; <?php echo date( 'Y' ) ?> Jerome Bruandet</h3>
		<strong><?php _e('From the same author:', 'wpterm' ) ?></strong>
		<ul>
			<li><a href="https://wordpress.org/plugins/ninjafirewall/">NinjaFirewall (WP Edition)</a>: <?php _e('A true Web Application Firewall to protect and secure WordPress.', 'wpterm' ) ?></li>
			<li><a href="https://wordpress.org/plugins/dashboard-cleaner/">Dashboard Cleaner</a>: <?php _e('Reclaim your admin dashboard: Get rid of annoying banners, unwanted ads and other nuisances.', 'wpterm' ) ?></li>
		</ul>
		<br />
		<br />
		<textarea id="wpterm-license" class="small-text code" style="display:none" cols="60" rows="8" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?php echo htmlspecialchars( $gpl3 ) ?></textarea>
		<input id="wpterm-license-button" type="button" class="button-secondary" value="<?php _e('View license', 'wpterm' ) ?>" onClick="show_license();" />
		<br />&nbsp;
	</div>
</div>
<?php
}

/* ================================================================== */

function wpterm_menu_donate() {

	// Donate menu:

?>
<div class="wrap">
	<h1><?php _e('Donate', 'wpterm' ) ?></h1>

	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="?page=wpterm&wptermtab=terminal" class="nav-tab"><?php _e( 'Terminal', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=settings" class="nav-tab"><?php _e( 'Settings', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=about" class="nav-tab"><?php _e( 'About', 'wpterm' ) ?></a>
		<a href="?page=wpterm&wptermtab=donate" class="nav-tab nav-tab-active"><?php _e( 'Donate', 'wpterm' ) ?></a>
	</h2>

	<div class="card">
		<p><?php _e('<strong>WPTerm</strong> is open-source and free. If you like it and want to support it, you can either donate or rate it on wordpress.org.', 'wpterm' ) ?></p>
		<hr />
		<h3><?php _e('PayPal donation', 'wpterm' ) ?></h3>
		<br />
		<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick" />
			<input type="hidden" name="business" value="wordpress<?php echo '@' ?>bruandet<?php echo '.' ?>net" />
			<input type="hidden" name="item_name" value="WPTerm donation" />
			<input type="hidden" name="currency_code" value="USD" />
			<label><strong><?php _e('Amount: USD', 'wpterm' ) ?></strong> <input type="number" name="amount" value="5" min="1" /></label>
			<p>
			<input type="image" src="<?php echo plugins_url() ?>/wpterm/images/pp.png" border="0" name="submit" />
		</form>
		<hr />
		<h3><?php _e('Bitcoin donation', 'wpterm' ) ?></h3>
		<br />
		<a href="bitcoin:13GH1yAU22ukKQ4AxhtBnb8eiNRtzbqsUC?message=WPTerm%20donation"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIYAAACGCAIAAACXG2XGAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4QYCCjMiGBn+rgAAAzJJREFUeNrtncFyg0AMQ6HD//9yeu10GsZG0jaGpzMhBMUSttfL/nq9NvBJOLZt2/fdft6fTL87/7tjKp9VrseF0H374l/5aYASKAEVL3Fpbldb3/lHwg8qXvXu/JVjjPeNKEG4AJSM95KuNygaWtH0yvkVD0vkGeJ9I0oQLgAlt/KSBLrP9a58ons9ifoVUYJwASjBSzz+kfCGbg3q5/Hp+hVRgnABKHm6l7g0tOsB3XzC1dtXfM5434gShAtAyXgvSdd2Ep5R8bD0mjHjfSNKEC4AJeOwLy7gdDU30c9Q/IwoQbgAlIC/vaRSI+rqeKI+1l3TtXJOxfW9zJcgXABKJuLYav0DxTOUfkbCwxRPcuVYJ+cnShAuACUjvUR5Hk9ovct7up+tXL8y21j0HqIE4QJQMtJLXNrdrWsptbVurpCeI1HWEfz6XUQJwgWgZHxe0p3PcPWxuzPwykzJyhyFKEG4AJQ8xUu6sxquPsfKWcVEbuG6BvolCBeAkuk4WxP8X/uIpHvvrvXESr5C7x3hAlDyRC9R+t5KfpDwBlddrtubIUoQLgAlT/SStF53j1F8qNsXcc2mXMhjiBKEC0DJSC9J5xldfxJn/ZblT6EcjihBuACUjM9LXPWldH9eyQkS8yuuHI4oQbgAlEzEcUFPXTpbWRuWyBVca39DfRqiBOECUDLeSxJ75VY0VJn1S7wfZfF+jkQJwgWgZLyXJJ67FY1O5A2u7+2+P5goQbgAlDzFS5TZurTmrswhVta7iBKEC0DJ3bxE0fGKx6TzDNd+J4l9Yi7U1ogShAtAyThceX9J91k+nXO45ldWvvvk5HqIEoQLQMlIL4l/h6nvvSAnaHmPklednJMoQbgAlIzDsWX23VL2gnT5h5IbuTzywnUSJQgXgJKRXpLQVkVzK9fTff9jYg8V1z6PRAnCBaDkbl6i5ASuPEZ571ZX95Uevuv3EiUIF4CSO3uJC0r/I72vopJPhOp1RAnCBaAEL7mo0a7eu6L1rvMofRSiBOECUHI3L1k5A+iaZ0zkOq4eD/0ShAtAyV1xNl+iIL1HZCIfUnzCtf6YGhfCBaBkqpdwFz4K3/F65gVuLsNPAAAAAElFTkSuQmCC"><br />13GH1yAU22ukKQ4AxhtBnb8eiNRtzbqsUC</a>
		<br />&nbsp;
		<hr />
		<h3><?php _e('Rate it', 'wpterm' ) ?></h3>
		<a href="https://wordpress.org/support/view/plugin-reviews/wpterm?rate=5#postform"><img title="<?php _e('Rate it', 'wpterm' ) ?>" border="0" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHQAAAAcCAIAAAA/XwxHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3woMCgQevC7e8gAAActJREFUaN7tmb9LAmEYx9/XM1OLNDMCB8MLQRCHoKGprbW1pcWh/yKabHVsjIj+gKgGh1q1oMEIIoIup8Ph0lOvO7F7720QuZI6fd9q6X2+2/G+H57j88D7gxdTShHkb+IDBSAX5EJ+LJfS5p7RbHGVE4tll0sV82G383BIODZCwVgfcxsbBaPtoHah02gB+6tyqWI+HjoIIaRZj4zNFI1llNtv4+CLrZmisaxy3Tb2w9JM0ViEEEL42xsa1W3ttGc82ZZCTMW2FGLVv5iLp30h2R+SpbAshWT/9NpkPOdDgrGYVS7qEXVTuztxGFoVC+ZuookUFo5lXhYCUuI4ll7F41YKBNIXg0qisTxr7tRE6mw2uTROKX/yfDa1jMVlOTY0HJ/MXEYX5kZsiwtHscz68NIjGstzWsCLoexB0GOitBHJbkkYWL6jGKkTj3WeqI7HsGgsq1xqXRGv8ec3qwssn1ziGLeenXp5MxrA8sntEr3mApH8zMr9/EoxHIm6v6M/U2C/uj+PilN7LSO1hOqVvKHVHHfAtLWiXomqJaSW920H2OGMIde+ble3P5f5GNPWinp1p2cDOxwMr79/F3hDA7kgFwJyQe6/yDsZhxXHUCuqgQAAAABJRU5ErkJggg==" width="116" height="28"><br /><?php _e('Rate it on WordPress.org', 'wpterm' ) ?></a>
		<br />&nbsp;
		<hr />
		<p><?php _e('Thanks!', 'wpterm' ) ?></p>
	</div>
</div>
<?php
}


/* ================================================================== */

add_action( 'wp_ajax_wptermajax', 'wptermajax_callback' );

function wptermajax_callback() {

	// The terminal AJAX callback function:

	if (! current_user_can( 'activate_plugins' ) ) { wp_die(0); }

	// Check AJAX security nonce:
	if ( check_ajax_referer( 'wpterm_menu_terminal', 'wpterm_ajax_nonce', false ) ) {

		// Path to return in case of fatal error:
		$if_error = htmlspecialchars( rtrim( ABSPATH, '/' ) ) . '::';

		// If the password protection is enabled, check the password:
		if (! wpterm_is_allowed( 'ajax' ) ) {
			echo $if_error . __( 'WPTerm: error, your password has expired. Reload this page to renew it.', 'wpterm');
			wp_die();
		}

		if ( empty( $_POST['cmd'] ) || empty( $_POST['cwd'] ) || empty( $_POST['exec'] ) || empty( $_POST['abs'] ) ) {
			echo $if_error . __( 'WPTerm error: missing command, path, function or abspath', 'wpterm' );
			wp_die();
		}
		// Make sure the max number of lines to returned to WPTerm
		// is a digit, otherwise set it to 512, its default value:
		if ( empty( $_POST['scrollback'] )  || ! ctype_digit( $_POST['scrollback'] ) ) {
			$scrollback = 512;
		} else {
			$scrollback = (int)$_POST['scrollback'];
		}
		// We don't want WordPress to escape strings with slashes:
		$cmd = stripslashes( trim( $_POST['cmd'] ) );
		$cwd = stripslashes( trim( $_POST['cwd'] ) );
		$abs = stripslashes( trim( $_POST['abs'] ) );
		// Set the ABSPATH variable, go to the current working directory,
		// run the command, redirect STDERR to STDOUT and return the current
		// working directory (it may have been changed e.g., `cd /foo/bar`):
		$command = sprintf( "ABSPATH=%s;cd %s;%s 2>&1;echo [-{-%s-}-]", $abs, $cwd, $cmd, '$PWD' );

		// Run the command:
		list( $res, $ret_var ) = @run_command( $command, trim( $_POST['exec'] ) );

		// Split the PWD and the data returned by the command:
		if ( preg_match( '`^(.+)?\[-{-(/.*?)-}-\]`s', $res, $match ) ) {
			// Turn the string into an array...
			$res_array = explode( "\n", $match[1] );
			// ...keep only the last $_POST['scrollback'] lines and re-create the string...
			$res_str = implode( "\n", array_slice( $res_array, -$_POST['scrollback'] ) );
			// ...and return it to WPTerm terminal:
			echo rtrim( $match[2] . '::' . $res_str );
		} else {
			if (! empty( $ret_var ) ) {
				echo $if_error . sprintf( __( 'WPTerm: error %s', 'wpterm' ), (int) $ret_var );
			} else {
				echo $if_error . __( 'WPTerm: unknown error. Are you allowed to run PHP program execution functions?', 'wpterm' );
			}
		}
	} else {
		echo '/::' . __( 'WPTerm: error, security nonces do not match. Try to reload this page to renew them.', 'wpterm');
	}
	wp_die();

}

/* ================================================================== */

function run_command( $command, $function ) {

	$ret_var = '';

	// Select which method to use to run the command:

	if ( $function == 'shell_exec' ) {
		$res = shell_exec( $command );

	} elseif ( $function == 'system' ) {
        ob_start();
        system( $command, $ret_var );
        $res = ob_get_contents();
        ob_end_clean();

	} elseif ( $function == 'passthru' ) {
        ob_start();
        passthru( $command, $ret_var );
        $res = ob_get_contents();
        ob_end_clean();

	} elseif ( $function == 'backtick' ) {
		$res = `$command`;

	} else {
		if ( exec( $command, $res, $ret_var ) ) {
			$res = implode( "\n", $res );
		}
	}

	return array( $res, $ret_var );

}

/* ================================================================== */

function wpterm_is_allowed( $is_ajax = null ) {

	// Check if a password was set:
	if (! defined( 'WPTERM_PASSWORD' ) ) {
		// No, let it go:
		return true;
	}

	// Check if the user session exists:
	if ( empty( $_SESSION['wptermpwd'] ) ) {
		// Return if this is an AJAX call (a warning
		// will be displayed from the terminal prompt):
		if ( isset( $is_ajax ) ) { return false; }
		// Display the password form:
		if( ! wpterm_password_prompt(1) ) {
			return false;
		}
	}
	// Check if passwords match:
	if ( $_SESSION['wptermpwd'] != WPTERM_PASSWORD ) {
		// Password does not match, clear it:
		unset( $_SESSION['wptermpwd'] );
		if ( isset( $is_ajax ) ) { return false; }
		// Display the password form:
		if (! wpterm_password_prompt(2) ) {
			return false;
		}
	}

	// Okay, go ahead!
	return true;

}

/* ================================================================== */

function wpterm_password_prompt( $err = 0 ) {

	// Display the password form:

	// Password form submitted?
	if ( isset( $_POST['wptermpwd'] ) ) {
		// Verify security nonce:
		if ( empty( $_POST['wptermnonce'] ) || ! wp_verify_nonce( $_POST['wptermnonce'], 'wpterm_password' ) ) {
			wp_nonce_ays( 'wpterm_password' );
		}
		// Verify password:
		if ( sha1( $_POST['wptermpwd'] ) === WPTERM_PASSWORD ) {
			$_SESSION['wptermpwd'] = sha1( $_POST['wptermpwd'] );
			return true;
		} else {
			$err = 3;
		}
	}

	if ( $err == 3 ) {
		?>
		<div class="error notice is-dismissible"><p><?php _e( 'Wrong password, please try again.', 'wpterm' ) ?></p></div>
		<?php
	} else {
		?>
		<div class="error notice is-dismissible"><p><?php printf( __( 'A password is required to access WPTerm (#%s).', 'wpterm' ), (int) $err ) ?></p></div>
		<?php
	}
?>

<div class="wrap">
	<h1>WPTerm</h1>

	<h2 class="nav-tab-wrapper wp-clearfix" style="cursor:not-allowed">
		<a class="nav-tab"><?php _e( 'Terminal', 'wpterm' ) ?></a>
		<a class="nav-tab"><?php _e( 'Settings', 'wpterm' ) ?></a>
		<a class="nav-tab"><?php _e( 'About', 'wpterm' ) ?></a>
		<a class="nav-tab"><?php _e( 'Donate', 'wpterm' ) ?></a>
	</h2>

	<div class="card">

		<form method="post">
			<h3><?php _e( 'Enter your WPTerm password:', 'wpterm' ) ?></h3>
			<p><input class="input" type="password" name="wptermpwd" placeholder="Password" autofocus /></p>
			<p><input type="submit" class="button-secondary" /></p>
			<?php wp_nonce_field('wpterm_password', 'wptermnonce', 0); ?>
		</form>

	</div>
</div>
<?php

	return false;

}

/* ================================================================== */
// EOF
