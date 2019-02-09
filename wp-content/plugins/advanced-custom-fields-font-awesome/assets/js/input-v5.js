(function($){
	
	function update_preview( value, parent ) {
		var class_prefix = ( ACFFA.major_version >= 5 ) ? '' : 'fa ';
		$( '.acf-field-setting-fa_live_preview .acf-input', parent ).html( '<i class="' + class_prefix + value + '" aria-hidden="true"></i>' );
		$( '.icon_preview', parent ).html( '<i class="' + class_prefix + value + '" aria-hidden="true"></i>' );
	}

	function select2_init_args( element, parent ) {
		return {
			key			: $( parent ).data('key'),
			allowNull	: $( element ).data('allow_null'),
			ajax		: 1,
			ajaxAction	: 'acf/fields/font-awesome/query'
		}
	}

	function select2_init( fa_field ) {
		var $select = $( fa_field );
		var parent = $( $select ).closest('.acf-field-font-awesome');

		update_preview( $select.val(), parent );

		acf.select2.init( $select, select2_init_args( fa_field, parent ), parent );
	}

	acf.add_action( 'select2_init', function( $input, args, settings, $field ) {
		if ( $field instanceof jQuery && $field.hasClass('fontawesome-edit') ) {
			$field.addClass('select2_initalized');
		}
	});

	// Add our classes to FontAwesome select2 fields
	acf.add_filter( 'select2_args', function( args, $select, settings, $field ) {
		if ( $select.hasClass('select2-fontawesome') ) {
			args.dropdownCssClass = 'fa-select2-drop fa' + ACFFA.major_version;
			args.containerCssClass = 'fa-select2 fa' + ACFFA.major_version;
		}

		return args;
	});

	// Update FontAwesome field previews in field create area
	acf.add_action( 'open_field/type=font-awesome', function( $el ) {
		var $field_objects = $('.acf-field-object[data-type="font-awesome"]');

		$field_objects.each( function( index, field_object ) {
			update_preview( $( 'select.fontawesome-create', field_object ).val(), field_object );

			if ( $( '.acf-field[data-name="icon_sets"] input[type="checkbox"][value="custom"]:checked', field_object ).length ) {
				$( '.acf-field-setting-custom_icon_set', field_object ).show();
			} else {
				$( '.acf-field-setting-custom_icon_set', field_object ).hide();
			}

		});
	});

	// Uncheck standard icon set choices if 'custom icon set' is checked, and show the custom icon set select box
	$( document ).on( 'change', '.acf-field[data-name="icon_sets"] input[type="checkbox"]', function() {
		var parent = $( this ).closest('.acf-field-object-font-awesome');
		if ( $( this ).is('[value="custom"]') && $( this ).is(':checked') ) {
			$( 'input[type="checkbox"]:not([value="custom"])', parent ).prop('checked', false);
			$( '.acf-field-setting-custom_icon_set', parent ).show();
		} else {
			$( 'input[type="checkbox"][value="custom"]', parent ).prop('checked', false);
			$( '.acf-field-setting-custom_icon_set', parent ).hide();
		}
	});

	// Handle new menu items with FontAwesome fields assigned to them
	$( document ).on( 'menu-item-added', function( event, $menuMarkup ) {
		var $fa_fields = $( 'select.fontawesome-edit:not(.select2_initalized)', $menuMarkup );

		if ( $fa_fields.length ) {
			$fa_fields.each( function( index, fa_field ) {
				select2_init( fa_field );
			});
		}
	});

	// Update FontAwesome field previews and init select2 in field edit area
	acf.add_action( 'ready_field/type=font-awesome append_field/type=font-awesome show_field/type=font-awesome', function( $el ) {
		var $fa_fields = $( 'select.fontawesome-edit:not(.select2_initalized)', $el );

		if ( $fa_fields.length ) {
			$fa_fields.each( function( index, fa_field ) {
				select2_init( fa_field );
			});
		}
	});

	// Update FontAwesome field previews when value changes
	$( document ).on( 'select2:select', 'select.select2-fontawesome', function() {
		var $input = $( this );

		if ( $input.hasClass('fontawesome-create') ) {
			update_preview( $input.val(), $input.closest('.acf-field-object') );
			$('.acf-field-setting-default_label input').val( $( 'option:selected', $input ).html() );
		}

		if ( $input.hasClass('fontawesome-edit') ) {
			update_preview( $input.val(), $input.closest('.acf-field-font-awesome') );
		}
	});

})(jQuery);
