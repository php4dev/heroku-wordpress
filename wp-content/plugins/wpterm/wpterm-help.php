<?php
/*
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

if (! defined( 'ABSPATH' ) ) { die( 'Forbidden' ); }

/* ================================================================== */

function wpterm_help() {

	// Contextual help:

	get_current_screen()->add_help_tab( array(
		'id'        => 'wpterm_settings',
		'title'     => __("Terminal settings", "wpterm"),
		'content'   => '<div style="height:300px;">' .
							'<h3>' . __( "Fonts and Colors", "wpterm" ) . '</h3>' .
							'<p>' . __( "You can select the terminal fonts and background colors as well as the font size and weight. Use hexadecimal values (e.g., <code>FFFFFF</code>) or CSS color names (e.g., <code>red</code>) for colors.", "wpterm" ) . "</p>" .
							'<h3>' . __( "Terminal", "wpterm" ) . '</h3>' .
							'<p><b>' . __( "Use the following PHP function for program execution", "wpterm" ) . '</b></p>' .
							'<p>' . __( "You can select which PHP function WPTerm will use to run the terminal commands.", "wpterm" ) .
							" " . __( "<code>exec</code> is the default one.", "wpterm" ) . ' ' . __( "Note that <code>`backticks`</code> is identical to <code>shell_exec()</code>.", "wpterm" ) . '</p>' .
							'<p><b>' . __( "Emulate pseudo-Tab completion?", "wpterm" ) . '</b></p>' .
							'<p>' . __( "Because it is not a real shell, WPTerm cannot reproduce the TAB completion feature of a regular terminal. It can, however, emulate its own one which is linked to your history, i.e., it applies only to the commands that you have typed during the current session. Those commands can be seen by entering <code>history</code> or by pressing the <code>UP</code> and <code>DOWN</code> arrows.", "wpterm" ) . '</p>' .
							'<p><b>' . __( "Default working directory", "wpterm" ) . '</b></p>' .
							'<p>' . __( "You can select to start the terminal in the WordPress root folder (a.k.a. <code>ABSPATH</code>) or in your user home directory (<code>~</code>).", "wpterm" ) .
							'<br />' .
							__( "Note that WPTerm adds a specific variable named <code>\$ABSPATH</code> to your environment. You can use it just like any other environment variables for instance:", "wpterm" ) . '</p>' .
							'<ul>' .
							'<li>' . sprintf( __( 'Go back to the ABSPATH: %s', "wpterm" ), '<code>cd $ABSPATH</code>' ) . '</li>' .
							'<li>' . sprintf( __( 'Display the ABSPATH: %s', "wpterm" ), '<code>echo $ABSPATH</code>' ) . '</li>' .
							'<li>' . sprintf( __( 'Find all files in the ABSPATH that were changed the last 10 days: %s', "wpterm" ), '<code>find $ABSPATH -type f -ctime -10</code>' ) . '</li>' .
							'</ul>' .
							'<p><b>' . __( "Scrollback", "wpterm" ) . '</b></p>' .
							'<p>' . __( "The scrollback buffer can keep up to 3,000 lines. Default value is set to 512 lines.", "wpterm" ) . '</p>' .
							'<p><b>' . __( "Welcome message", "wpterm" ) . '</b></p>' .
							'<p>' . __( "Select your welcome message.", "wpterm" ) . '</p>' .
							'<p><b>' . __( "Terminal bell", "wpterm" ) . '</b></p>' .
							'<p>' . __( "You can enable the visual or/and audible bell. Note that the audible bell is not compatible with some older browsers (e.g., IE 11 or earlier versions).", "wpterm" ) . '</p>' .
							'</div>'
	) );

	get_current_screen()->add_help_tab( array(
		'id'        => 'wpterm_security',
		'title'     => __( "Password protection", 'wpterm' ),
		'content'   =>	'<div style="height:300px;">' .
							'<h3>' . __( "Password protection", "wpterm" ) . '</h3>' .
							'<p>' . __( "You can password protect the access to WPTerm. To do so, follow these steps:", "wpterm" ) . "</p>" .
							'<ol>' .
							'<li>' . __( "Choose a password!", "wpterm" ) . "</li>" .
							'<li>' . __( "Generate a SHA1 hash of your password; from WPTerm terminal, enter the following command (replace <b>PASSWORD</b> with your chosen password):", "wpterm" ) .
							"<p><code>echo -n 'PASSWORD' | sha1sum</code></p>" . "</li>" .
							'<li>' . __( "Copy the 40-character hash returned by the above command.", "wpterm" ) . "</li>" .
							'<li>' . __( "Download your WordPress <code>wp-config.php</code> file. It is located inside your WordPress root folder. If you cannot find it, search it with the following command from WPTerm terminal:", "wpterm" ) .
							'<p><code>find $ABSPATH -type f -name \'wp-config.php\'</code></p>' . "</li>" .
							'<li>' . __( "Open that file and add the following line of code below your database credentials (replace <b>HASH</b> with your 32-character hash):", "wpterm" ) .
							'<p><code>define( \'WPTERM_PASSWORD\', \'HASH\' );</code></p>' . "</li>" .
							'</ol>' .
							'<p>' . __( "Next time you will access WPTerm, it will ask you to enter your password.", "wpterm" ) . '</p>' .
							'<h3>' . __( "Change or remove the password protection", "wpterm" ) . '</h3>' .
							'<p>' . __( "To change your password protection, simply generate a new SHA1 hash and edit <code>wp-config.php</code>.", "wpterm" ) . '</p>' .
							'<p>' .__( "You disable the password protection, remove the line from <code>wp-config.php</code>.", "wpterm" ) . '</p>' .
							'<h3>' . __( "Password expiration", "wpterm" ) . '</h3>' .
							'<p>' .__( "WPTerm relies on PHP sessions for the authentication process. In case of inactivity, the session will expire and you will be asked again for the password. That session timeout depends on your PHP configuration, not WPTerm.", "wpterm" ) . '</p>' .
							'</div><br /> '
	) );

	get_current_screen()->add_help_tab( array(
		'id'        => 'wpterm_command',
		'title'     => __( "Built-in commands", 'wpterm' ),
		'content'   =>	'<div style="height:300px;">' .
							'<p>' . __( "WPTerm has the following built-in commands:", "wpterm" ) . "</p>" .
							'<ul>' .
							'<li><code>clear</code>, <code>reset</code>, <code>cls</code>: ' . __( "Clear the terminal screen. Alternatively, you can press the <code>CTRL+L</code> keyboard shortcut.", "wpterm" ) . "</li>" .
							'<li><code>exit</code>, <code>quit</code>, <code>logout</code>, <code>shutdown</code>, <code>reboot</code>: ' . __( "Log out of WordPress.", "wpterm" ) . "</li>" .
							'<li><code>version</code>, <code>wpterm</code>: ' . __( "Show WPTerm version.", "wpterm" ) . "</li>" .
							'<li><code>notice</code>: ' . __( "Display the one-time warning notice.", "wpterm" ) . "</li>" .
							'<li><code>help</code>: ' . __( 'Open this contextual help menu.', "wpterm" ) . "</li>" .
							'<li><code>history</code>: ' . __( "Display the history buffer. You can also use the <code>UP</code> and <code>DOWN</code> arrows to display each element from the buffer.", "wpterm" ) . "</li>" .
							'<li><code>history -c</code>: ' . __( "Clear the history buffer.", "wpterm" ) . "</li>" .
							'<li><code>wpterm moo</code>: ' . __( "Don't even try!", "wpterm" ) . "</li>" .
							'</ol>' .
							'</div><br /> '
	) );
}

/* ================================================================== */
// EOF
