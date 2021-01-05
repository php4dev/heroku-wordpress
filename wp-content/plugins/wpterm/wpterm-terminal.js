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
var wpterm_debug = 0;
var prompt_buffer = last_login + prompt;
var prompt_length = prompt_buffer.length;
var command;
var history_buffer = [];
var history_pos = 0;
var running = 0;
var ajax_hnd;
// Audible bell (not compatible with IE <=11):
var snd = new Audio("data:audio/wav;base64,UklGRkgBAABXQVZFZm10IBAAAAABAAEAESsA" +
	"ABErAAABAAgAZGF0YSQBAACBf359cm9rgaB5lQOF/6NVG6Gop49deZGkmF1IkaOhYUSKpoZqTE+c" +
	"op5tUnSNkYZ1gIeOfXt7iIeEd3mDhISCfoF8fYKCgH+HiYV9foWJhn9/gIeGgXx/hYZ+fX6FgH9/" +
	"f3+CgoF7eYKMhn99gYV/fn6FhoF/f399f4OChIF9gYGBe4CDhIN9fn+CgH6AgoSAgICAgIGAf4F/" +
	"f4CBfoB/gIF/gICAgH9+gYGAgIF/gH9+gX9/f4F/gYJ/gH6AgICAf39/f4F/f3+BfoF/gH5/gYB/" +
	"gIF/enl4fH2Bg4aGhYJ/fn9+gYKEg4KAfnx9f4CAg4KBgIB9f4CBg4OCgYGBgICBgYGAgoCAgIB/" +
	"gX+Bf4CAgYCAf4GBgYCBgICBgoGBgIB/");

// Display the current prompt and position cursor:
jQuery( "#terminal" ).val( prompt_buffer );
set_cursor_position( document.getElementById("terminal"), prompt_length );


/* ================================================================== */

// Increase/decrease font size:
function font_size( choice ) {
	var current_font = parseInt( jQuery("#terminal" ).css( 'font-size' ) );
	if ( choice == 1 ) {
		if ( current_font < 20 ) {
			current_font++;
		}
	} else {
		if ( current_font >= 9 ) {
			current_font--;
		}
	}
	jQuery( '#terminal' ).css( 'font-size', current_font + 'px' );
	jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
}

// Enable/disable line wrapping
function line_wrapping( what ) {
	if ( jQuery('#terminal').attr( 'wrap' ) == 'off' ) {
		jQuery('#terminal').attr( 'wrap', 'soft' );
		jQuery('#wrap-line').attr( 'title', wrap_on );
	} else {
		jQuery('#terminal').attr( 'wrap', 'off' );
		jQuery('#wrap-line').attr( 'title', wrap_off );
	}
	jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
}

// Reposition the cursor:
function set_cursor_position( what, where ) {
  if ( what.setSelectionRange ) {
	 what.focus();
	 what.setSelectionRange( where, where );
	// IE only:
  } else if ( what.createTextRange ) {
	 var range = what.createTextRange();
	 range.collapse( true );
	 range.moveEnd( 'character', where );
	 range.moveStart( 'character', where );
	 range.select();
  }
}

/* ================================================================== */

// Hook keydown and paste events:
jQuery( "#terminal" ).bind('keydown paste', function( event ) {

	// Clear error class
	if ( jQuery( '#terminal' ).hasClass( 'error' ) ) {
		jQuery( '#terminal' ).removeClass( 'error' );
	}

	// Initialise/clear some data:
	var data_returned = '';
	var command = '';

	// We are aleady waiting for an answer?
	if ( running == 1 ) {
		// CTRL + c key pressed (stop execution)?
		if ( event.ctrlKey || event.metaKey ) {
			if ( event.which == 67 ) {
				ajax_hnd.abort()
				return false;
			}
		// Warn the user:
		} else {
			alert( in_progress );
			return false;
		}
	}

	// Scroll down to the prompt if a key is pressed (does not affect mouse),
	if ( event.which ) {
		jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
	}

	// Get the cursor position:
	var cursor = get_cursor_position( 'terminal' );
	if ( wpterm_debug == 1 ) {
		console.log( 'WPTerm: Cursor position is ' + cursor );
	}

	// Left, backspace or home key pressed?
	if ( event.which == 8 || event.which == 37 || event.which == 36 ) {
		// Home key: move the cursor right after the prompt,
		// instead of the beginning of the current line:
		if ( event.which == 36 ) {
			set_cursor_position( document.getElementById("terminal"), prompt_length );
			return false;
		}
		// Force to output text after the prompt only:
		if ( cursor == prompt_length ) {
			if ( visual_bell ) { visbell(); }
			if ( audible_bell ) { beep(); }
			return false;
		}
		if ( cursor < prompt_length ) {
			set_cursor_position( document.getElementById("terminal"), document.getElementById("terminal").value.length );
			return false;
		}
		return true;
	}
	// Re-position the cursor, if it was moved elsewhere before the prompt:
	if ( cursor < prompt_length ) {
		set_cursor_position( document.getElementById("terminal"), document.getElementById("terminal").value.length );
		if ( wpterm_debug == 1 ) {
			console.log( 'WPTerm: Repositionning cursor to end of buffer' );
		}
		// Let it go...
	}


	// UP arrow pressed?
	if ( event.which == 38 ) {
		if ( typeof history_buffer[history_pos] !== 'undefined' && history_buffer[history_pos] !== null ) {
			jQuery( '#terminal' ).val( prompt_buffer +  history_buffer[history_pos] );
			history_pos++;
		} else {
			// Bell, don't update:
			if ( visual_bell ) { visbell(); }
			if ( audible_bell ) { beep(); }
		}
		// Force to scroll down (Opera, Chrome...):
		jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
		return false;
	}
	//  DOWN arror pressed?
	if ( event.which == 40 ) {
		if ( typeof history_buffer[history_pos - 1 ] !== 'undefined' && history_buffer[history_pos - 1 ] !== null ) {
			jQuery( '#terminal' ).val( prompt_buffer +  history_buffer[ history_pos - 1 ] );
			history_pos--;
		} else {
			// Update with prompt only:
			jQuery( '#terminal' ).val( prompt_buffer );
			if ( visual_bell ) { visbell(); }
			if ( audible_bell ) { beep(); }
		}
		// Force to scroll down (Opera, Chrome...):
		jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
		return false;
	}


	// TAB key pressed?
	if ( event.which == 9 ) {
		event.preventDefault();

		// TAB completion is disabled?
		if ( emul_tab != 1 ) {
			data_returned = '\nWPTerm: ' + emul_tab_msg;
			if ( audible_bell ) { beep(); }
			update_request();
			if ( visual_bell ) { visbell(); }
			return false;
		}

		command = jQuery( '#terminal' ).val().substring( prompt_length );

		// No command entered yet?
		if ( command == '' ) {
			if ( visual_bell ) { visbell(); }
			if ( audible_bell ) { beep(); }
			return false;
		}

		// There is something, let's check if it matches any command from the history buffer:
		var completion_buffer = [];
		for ( var i = 0; i < history_buffer.length; i++ ) {
			var match_command = history_buffer[i].substring( 0, command.length );
			if ( match_command  == command ) {
				completion_buffer[i] = history_buffer[i];
			}
		}

		// Remove duplicates:
		completion_buffer = completion_buffer.filter( function( item, index, input_array ) {
			return input_array.indexOf( item ) == index;
		});

		// We found something:
		if ( completion_buffer.length > 0 ) {

			// We only have one occurrence, display it:
			if ( completion_buffer.length == 1 ) {
			if ( wpterm_debug == 1 ) {
				console.log( 'WPTerm: 1 TAB completion occurrence found: ' +
					completion_buffer[0] );
			}
			jQuery( "#terminal" ).val( prompt_buffer + completion_buffer[0] + ' ' );

			// We have more than one occurence, show them all (one by line):
			} else {
				var multi_occurrences = '';
				for ( var i = 0; i < completion_buffer.length; i++ ) {
					if ( typeof completion_buffer[i] !== 'undefined' && completion_buffer[i] !== null ) {
						multi_occurrences += '\n ' + completion_buffer[i];
					}
				}
				if ( wpterm_debug == 1 ) {
					console.log( 'WPTerm: ' + completion_buffer.length +
						' TAB completion occurrences found: ' +
						multi_occurrences );
				}
				// Update prompt:
				prompt_buffer += multi_occurrences + "\n" + prompt;
				prompt_length = prompt_buffer.length;
				jQuery( "#terminal" ).val( prompt_buffer + command );
				// Make sure to scroll to the bottom if needed:
				jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
			}
		} else {
			// Nothing found:
			if ( visual_bell ) { visbell(); }
			if ( audible_bell ) { beep(); }
		}
		return false;
	}


	// CTRL+L key pressed (clear screen):
	if ( ( event.ctrlKey || event.metaKey ) && event.which == 76 ) {
		clear_screen( 1 );
		return false;
	}


	// ENTER key pressed:
	if ( event.which == 13 ) {

		// Retrieve and trim the command:
		command = jQuery.trim( jQuery( '#terminal' ).val().substring( prompt_length ) );

		// Make sure we have a command:
		if ( command != '' ) {

			// Check for built-in commands first:

			// Clear screen commands (CTRL-L is handled separately):
			if ( command == 'clear' || command == 'reset' || command == 'cls' ) {
				clear_screen( 0 );
				return false;

			// Logout & al. commands:
			} else if ( command.match( /^(exit|logout|quit|reboot|shutdown)$/ ) ) {
				if ( confirm( logout_msg ) ) {
					window.location.replace( logout_url);
				}
				data_returned = '\nWPTerm: ' + op_cancelled;
				update_request();
				return false;
			// Have you mooed today?
			} else if ( command == 'wpterm moo' ) {
				data_returned = '\n   m00h  (__)\n      \x5c  ~Oo~___\n    ' +
					'     (..)  |\x5c/\n___________| |"|_____________';
				update_request();
				return false;
			} else if ( command.match( /^(version$|wpterm\b)/ ) ) {
				data_returned = version;
				update_request();
				return false;
			// Warning notice:
			} else if ( command == 'notice' ) {
				jQuery( "#wpterm-warning" ).slideDown();
				update_request();
				return false;
			// Contextual help:
			} else if ( command == 'help' ) {
				jQuery( "#contextual-help-link" ).trigger( "click" );
				update_request();
				return false;
			} else if ( command.match( /^iptables/ ) ) {
				data_returned = '\nWPTerm: ' + iptables;
				update_request();
				return false;
			// History command:
			} else if ( command == 'history' ) {
				var x = 1;
				for ( var i = history_buffer.length; i >= 0 ; i-- ) {
					if ( typeof history_buffer[i] !== 'undefined' && history_buffer[i] !== null ) {
						data_returned += '\n ' + x++ + ' ' + history_buffer[i];
					}
				}
				// Add the `history` command too:
				data_returned += '\n ' + x++ + ' history';
				update_request();
				return false;
			// Clear history command:
			} else if ( command == 'history -c' ) {
				history_buffer.length = 0;
				update_request();
				return false;
			// Run it!
			} else {
				run_command();
			}

		// No command (empty line):
		} else {
			update_request();
		}

		return false;

	} // ENTER key pressed:


	// Update screen with command and prompt:
	function update_request() {
		// Update prompt:
		update_prompt();
		// Save the command to history buffer if it is not empty,
		// but don't save the `history -c` command:
		if ( command != '' && command != 'history -c' ) {
			history_buffer.unshift( command );
		}
		// Reset history_pos:
		history_pos = 0;
	}

	function update_prompt() {
		// Build the terminal output:
		prompt_buffer += command + data_returned + "\n" + prompt;
		// Turn the whole string into an array...
		var res_array = prompt_buffer.split( "\n" );
		// ...keep only the last `scrollback` lines...
		res_array = res_array.slice( - scrollback );
		// ...re-create the string...
		prompt_buffer = res_array.join( "\n" );
		prompt_length = prompt_buffer.length;
		// ...and refresh the terminal:
		jQuery( "#terminal" ).val( prompt_buffer );
		// Make sure to scroll to the bottom if needed:
		jQuery( '#terminal' ).scrollTop( jQuery( '#terminal' )[0].scrollHeight );
	}


	function clear_screen( ev ) {
		// Used for CTRL-L key only:
		if ( ev == 1 ) {
			event.preventDefault();
		}
		jQuery( '#terminal' ).val( prompt );
		prompt_buffer = prompt;
		prompt_length = prompt_buffer.length;
		// Don't save CTRL-L to history buffer!
		if ( ev != 1 ) {
			history_buffer.unshift( command );
		}
	}

	function get_cursor_position( what ) {
		return document.getElementById( what ).selectionStart
	}

	// Visual bell:
	function visbell() {
		jQuery( '#terminal' ).addClass( 'error' );
	}
	// Audible bell:
	function beep() {
		snd.play();
	}

	// Run a command via WordPress admin-ajax:
	 function run_command() {
		if ( wpterm_debug == 1 ) {
			console.log( 'WPTerm: Sending AJAX POST request to run command: `' +
				command + '` (via PHP "' + exec + '") from current working directory "' +
				cwd + '"' );
		}
		// We're busy:
		running = 1;
		jQuery('#progress_gif').show();

		var data = {
			'action': 'wptermajax',
			'wpterm_ajax_nonce': wpterm_ajax_nonce,
			'cmd': command,
			'cwd': cwd,
			'exec': exec,
			'abs': abspath,
			'scrollback': scrollback
		};

		ajax_hnd = jQuery.ajax( {
			// No timeout, the user can abort by pressing CTRL+C:
			type: "POST",
			url: ajaxurl,
			data: data,
			dataType: "text",
			success: function( response ) {

				var  res = response.split( '::' );
				// We may have more than one '::' occurrence:
				res.push( res.splice( 1 ).join( '::' ) );

				if ( res[0] != '' ) {
					cwd = res[0];
					prompt = user + ':' + res[0] + ' $ ';

					if ( res[1] != '' ) {
						// Data to outpout. We don't need to sanitise it,
						// because the DOM is ready:
						data_returned = '\n' + res[1];
					} else {
						// Avoid empty new lines if no data was
						// returned (e.g., `cd /` etc):
						data_returned = '';
					}

				} else {
					// We are seriously in trouble 8-X
					data_returned = '\n' + unknown_err;
				}

				// Update screen:
				update_request();

				// We're no longer busy:
				jQuery('#progress_gif').hide();
				running = 0;

			},
			error: function( xhr, status, err ) {
				data_returned = '\nwpterm error: ' + err;
				update_request();
				jQuery('#progress_gif').hide();
				running = 0;
			}
		});
	};

});

/* ================================================================== */
// EOF
