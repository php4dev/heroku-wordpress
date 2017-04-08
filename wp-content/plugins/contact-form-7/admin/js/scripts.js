( function( $ ) {

	'use strict';

	if ( typeof _wpcf7 === 'undefined' || _wpcf7 === null ) {
		return;
	}

	$( function() {
		var welcomePanel = $( '#welcome-panel' );
		var updateWelcomePanel;

		updateWelcomePanel = function( visible ) {
			$.post( ajaxurl, {
				action: 'wpcf7-update-welcome-panel',
				visible: visible,
				welcomepanelnonce: $( '#welcomepanelnonce' ).val()
			} );
		};

		$( 'a.welcome-panel-close', welcomePanel ).click( function( event ) {
			event.preventDefault();
			welcomePanel.addClass( 'hidden' );
			updateWelcomePanel( 0 );
		} );

		$( '#contact-form-editor' ).tabs( {
			active: _wpcf7.activeTab,
			activate: function( event, ui ) {
				$( '#active-tab' ).val( ui.newTab.index() );
			}
		} );

		$( '#contact-form-editor-tabs' ).focusin( function( event ) {
			$( '#contact-form-editor .keyboard-interaction' ).css(
				'visibility', 'visible' );
		} ).focusout( function( event ) {
			$( '#contact-form-editor .keyboard-interaction' ).css(
				'visibility', 'hidden' );
		} );

		$( 'input:checkbox.toggle-form-table' ).click( function( event ) {
			$( this ).wpcf7ToggleFormTable();
		} ).wpcf7ToggleFormTable();

		if ( '' == $( '#title' ).val() ) {
			$( '#title' ).focus();
		}

		$.wpcf7TitleHint();

		$( '.contact-form-editor-box-mail span.mailtag' ).click( function( event ) {
			var range = document.createRange();
			range.selectNodeContents( this );
			window.getSelection().addRange( range );
		} );

		$.wpcf7UpdateConfigErrors();

		$( '[data-config-field]' ).change( function() {
			var postId = $( '#post_ID' ).val();

			if ( ! postId || -1 == postId ) {
				return;
			}

			var data = [];

			$( this ).closest( 'form' ).find( '[data-config-field]' ).each( function() {
				data.push( {
					'name': $( this ).attr( 'name' ).replace( /^wpcf7-/, '' ).replace( /-/g, '_' ),
					'value': $( this ).val()
				});
			});

			data.push( { 'name': 'context', 'value': 'dry-run' } );

			$.ajax( {
				method: 'POST',
				url: _wpcf7.apiSettings.root +
					'contact-form-7/v1/contact-forms/' + postId,
				beforeSend: function( xhr ) {
					xhr.setRequestHeader( 'X-WP-Nonce', _wpcf7.apiSettings.nonce );
				},
				data: data
			} ).done( function( response ) {
				_wpcf7.configValidator.errors = response.config_errors;
				$.wpcf7UpdateConfigErrors();
			} );
		} );

		$( window ).on( 'beforeunload', function( event ) {
			var changed = false;

			$( '#wpcf7-admin-form-element :input[type!="hidden"]' ).each( function() {
				if ( $( this ).is( ':checkbox, :radio' ) ) {
					if ( this.defaultChecked != $( this ).is( ':checked' ) ) {
						changed = true;
					}
				} else if ( $( this ).is( 'select' ) ) {
					$( this ).find( 'option' ).each( function() {
						if ( this.defaultSelected != $( this ).is( ':selected' ) ) {
							changed = true;
						}
					});
				} else {
					if ( this.defaultValue != $( this ).val() ) {
						changed = true;
					}
				}
			} );

			if ( changed ) {
				event.returnValue = _wpcf7.saveAlert;
				return _wpcf7.saveAlert;
			}
		} );

		$( '#wpcf7-admin-form-element' ).submit( function() {
			if ( 'copy' != this.action.value ) {
				$( window ).off( 'beforeunload' );
			}

			if ( 'save' == this.action.value ) {
				$( '#publishing-action .spinner' ).addClass( 'is-active' );
			}
		} );
	} );

	$.fn.wpcf7ToggleFormTable = function() {
		return this.each( function() {
			var formtable = $( this ).closest( '.contact-form-editor-box-mail' ).find( 'fieldset' );

			if ( $( this ).is( ':checked' ) ) {
				formtable.removeClass( 'hidden' );
			} else {
				formtable.addClass( 'hidden' );
			}
		} );
	};

	$.wpcf7UpdateConfigErrors = function() {
		var errors = _wpcf7.configValidator.errors;
		var errorCount = {
			total: 0,
		};

		$( '[data-config-field]' ).each( function() {
			$( this ).removeAttr( 'aria-invalid' );
			$( this ).next( 'ul.config-error' ).remove();

			var section = $( this ).attr( 'data-config-field' );

			if ( errors[ section ] ) {
				var $list = $( '<ul></ul>' ).attr( {
					'role': 'alert',
					'class': 'config-error'
				} );

				$.each( errors[ section ], function( i, val ) {
					var $li = $( '<li></li>' ).text( val.message );

					if ( val.link ) {
						var $link = $( '<a></a>' ).attr( {
							'href': val.link,
							'class': 'external dashicons dashicons-external'
						} ).append( $( '<span></span>' ).attr( {
							'class': 'screen-reader-text'
						} ).text( _wpcf7.configValidator.howToCorrect ) );

						$li = $li.append( ' ' ).append( $link );
					}

					$li.appendTo( $list );

					var tab = section
						.replace( /^mail_\d+\./, 'mail.' ).replace( /\..*$/, '' );

					if ( ! errorCount[tab] ) {
						errorCount[tab] = 0;
					}

					errorCount[tab] += 1;

					errorCount.total += 1;
				} );

				$( this ).after( $list ).attr( { 'aria-invalid': 'true' } );
			}
		} );

		$( '#contact-form-editor-tabs > li' ).each( function() {
			var $item = $( this );
			$item.find( 'span.dashicons' ).remove();
			var tab = $item.attr( 'id' ).replace( /-panel-tab$/, '' );

			$.each( errors, function( key, val ) {
				key = key.replace( /^mail_\d+\./, 'mail.' );

				if ( key.replace( /\..*$/, '' ) == tab ) {
					var $mark = $( '<span class="dashicons dashicons-warning"></span>' );
					$item.find( 'a.ui-tabs-anchor' ).first().append( $mark );
					return false;
				}
			} );

			var $tabPanelError = $( '#' + tab + '-panel > div.config-error:first' );
			$tabPanelError.empty();

			if ( errorCount[tab] ) {
				$tabPanelError
					.append( '<span class="dashicons dashicons-warning"></span> ' );

				if ( 1 < errorCount[tab] ) {
					var manyErrorsInTab = _wpcf7.configValidator.manyErrorsInTab
						.replace( '%d', errorCount[tab] );
					$tabPanelError.append( manyErrorsInTab );
				} else {
					$tabPanelError.append( _wpcf7.configValidator.oneErrorInTab );
				}
			}
		} );

		$( '#misc-publishing-actions .misc-pub-section.config-error' )
			.remove();

		if ( errorCount.total ) {
			var $warning = $( '<div></div>' )
				.addClass( 'misc-pub-section config-error' )
				.append( '<span class="dashicons dashicons-warning"></span> ' );

			if ( 1 < errorCount.total ) {
				$warning.append(
					_wpcf7.configValidator.manyErrors.replace( '%d', errorCount.total )
				);
			} else {
				$warning.append( _wpcf7.configValidator.oneError );
			}

			var $link = $( '<a></a>' ).attr( {
				'href': _wpcf7.configValidator.docUrl,
				'class': 'external dashicons dashicons-external'
			} ).append( $( '<span></span>' ).attr( {
				'class': 'screen-reader-text'
			} ).text( _wpcf7.configValidator.howToCorrect ) );

			$warning.append( ' ' ).append( $link );

			$( '#misc-publishing-actions' ).append( $warning );
		}
	}

	/**
	 * Copied from wptitlehint() in wp-admin/js/post.js
	 */
	$.wpcf7TitleHint = function() {
		var title = $( '#title' );
		var titleprompt = $( '#title-prompt-text' );

		if ( '' == title.val() ) {
			titleprompt.removeClass( 'screen-reader-text' );
		}

		titleprompt.click( function() {
			$( this ).addClass( 'screen-reader-text' );
			title.focus();
		} );

		title.blur( function() {
			if ( '' == $(this).val() ) {
				titleprompt.removeClass( 'screen-reader-text' );
			}
		} ).focus( function() {
			titleprompt.addClass( 'screen-reader-text' );
		} ).keydown( function( e ) {
			titleprompt.addClass( 'screen-reader-text' );
			$( this ).unbind( e );
		} );
	};

} )( jQuery );
