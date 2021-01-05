// GDPR Data Request Form
( function( $ ) {
    'use strict';

    jQuery(document).ready(function() {

        $( '#buddyforms-gdpr-form' ).on( 'submit', function( event ) {

            event.preventDefault();

            var	button = $( '#buddyforms-gdpr-submit-button' ),
                data = {
                    'action':               'buddyforms_gdpr_data_request',
                    'buddyforms_gdpr_data_type' :      $( 'input[name=buddyforms_gdpr_data_type]:checked', '#buddyforms-gdpr-form').val(),
                    'buddyforms_gdpr_data_human_key':  $( '#buddyforms-gdpr-data-human-key' ).val(),
                    'buddyforms_gdpr_data_email':      $( '#buddyforms-gdpr-data-email' ).val(),
                    'buddyforms_gdpr_data_human':      $( '#buddyforms-gdpr-data-human' ).val(),
                    'buddyforms_gdpr_data_nonce':      $( '#buddyforms-gdpr-data-nonce' ).val(),
                };

            $( '.buddyforms-errors' ).remove();
            $( '.buddyforms-success' ).remove();
            if(buddyformsGlobal) {
                $.ajax({
                    url: buddyformsGlobal.admin_url,
                    type: 'post',
                    data: data,
                    success: function (response) {
                        if ('success' !== response.data) {
                            $('#buddyforms-gdpr-form').append('<div class="buddyforms-errors" style="display:none;">' + buddyformsGlobal.buddyforms_gdpr_localize.gdpr_errors + '<br />' + response.data + '</div>');
                            $('.buddyforms-errors').slideDown();
                        } else {
                            $('#buddyforms-gdpr-form').append('<div class="buddyforms-success" style="display:none;">' + buddyformsGlobal.buddyforms_gdpr_localize.gdpr_success + '</div>');
                            $('.buddyforms-success').slideDown();
                        }
                    }
                });
            }
        });
    });
})( jQuery );