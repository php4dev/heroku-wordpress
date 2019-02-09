(function($){
	var old_major_version		= false,
		selected_major_version	= false;
	function evaluate_pro_visibility() {
		selected_major_version = $('#acffa_major_version').val();

		if ( 5 == selected_major_version ) {
			$('.acffa_row.pro_icons').show();
		} else {
			$('.acffa_row.pro_icons').hide();
			$('#pro_icons').prop( 'checked', false );
		}
	}

	$(document).ready( function() {
		old_major_version = $('#acffa_major_version').val();
		evaluate_pro_visibility();
	});

	$('#acffa_major_version').on( 'change', function() {
		evaluate_pro_visibility();

		var $iconSetBuilder = $('.custom-icon-set');

		if ( old_major_version !== selected_major_version ) {
			$iconSetBuilder.hide();
			$('.icon-builder-complete-changes-notice').show();
		} else {
			$iconSetBuilder.show();
			$('.icon-builder-complete-changes-notice').hide();
		}
	});

	$('select#acffa_new_icon_set').multiSelect({
		selectableHeader: '<input type="text" class="search-input" autocomplete="off" placeholder="' + ACFFA.search_string + '">',
		selectionHeader: '<input type="text" class="search-input" autocomplete="off" placeholder="' + ACFFA.search_string + '">',
		afterInit: function(ms){
			var that = this,
					$selectableSearch = that.$selectableUl.prev(),
					$selectionSearch = that.$selectionUl.prev(),
					selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
					selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

			that.qs1 = $selectableSearch.quicksearch( selectableSearchString )
			.on('keydown', function(e){
				if (e.which === 40){
					that.$selectableUl.focus();
					return false;
				}
			});

			that.qs2 = $selectionSearch.quicksearch( selectionSearchString )
			.on('keydown', function(e){
				if (e.which == 40){
					that.$selectionUl.focus();
					return false;
				}
			});
		},
		afterSelect: function(){
			this.qs1.cache();
			this.qs2.cache();
		},
		afterDeselect: function(){
			this.qs1.cache();
			this.qs2.cache();
		}
	});

	$( '.existing-custom-icon-sets .edit-icon-set' ).on( 'click', function( e ) {
		e.preventDefault();

		$('select#acffa_new_icon_set').multiSelect('deselect_all');

		var parent		= $( this ).closest('.icon-set'),
			label		= $( parent ).data('set-label'),
			$iconList	= $( 'li[data-icon]', parent ),
			iconsToLoad	= [];

		$iconList.each( function( index, icon ) {
			iconsToLoad.push( $( icon ).data('icon') );
		});

		$('#acffa_new_icon_set_label').val( label );
		$('select#acffa_new_icon_set').multiSelect( 'select', iconsToLoad );
	});

	$( '.existing-custom-icon-sets .view-icon-list' ).on( 'click', function( e ) {
		e.preventDefault();

		var parent = $( this ).closest('.icon-set');
		$( parent ).find('.icon-list').toggle();
	});

	$( '.existing-custom-icon-sets .delete-icon-set' ).on( 'click', function( e ) {
		e.preventDefault();

		var result = confirm( ACFFA.confirm_delete );
		if ( result ) {
			var nonce = $( this ).data('nonce'),
				iconSetName = $( this ).data('icon-set-name');

			$.post(
				ajaxurl,
				{
					'action'		: 'ACFFA_delete_icon_set',
					'nonce'			: nonce,
					'icon_set_name'	: iconSetName
				},
				function( response_msg ) {
					if ( 'success' == response_msg ) {
						$('.icon-set[data-set-name="' + iconSetName + '"]').remove();
					} else {
						alert( ACFFA.delete_fail );
					}
				}
			);
		}
	});
})(jQuery);
