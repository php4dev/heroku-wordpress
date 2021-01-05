// get/post via jQuery
(function ($) {
    $.extend({
        ure_getGo: function (url, params) {
            document.location = url + '?' + $.param(params);
        },
        ure_postGo: function (url, params) {
            var $form = $('<form>')
                    .attr('method', 'post')
                    .attr('action', url);
            $.each(params, function (name, value) {
                $("<input type='hidden'>")
                        .attr('name', name)
                        .attr('value', value)
                        .appendTo($form);
            });
            $form.appendTo('body');
            $form.submit();
        }
    });
})(jQuery);


jQuery(function() {

    jQuery( '#ure_add_role' ).button({
        label: ure_data.add_role
    }).click(function ( event ) {
        event.preventDefault();
        ure_main.show_add_role_dialog();
    });

    jQuery( '#ure_add_capability' ).button({
        label: ure_data.add_capability
    }).click( function ( event ) {
        event.preventDefault();
        ure_main.show_add_capability_dialog();
    });

    var del_cap = jQuery( '#ure_delete_capability' );
    if ( del_cap.length > 0 ) {
        del_cap.button({
            label: ure_data.delete_capability
        }).click(function ( event ) {
            event.preventDefault();
            jQuery.ajax( ure_main.get_caps_to_remove );
        });
    }            

    var del_role = jQuery( '#ure_delete_role' );
    if ( del_role.length>0 ) {
        del_role.button({
            label: ure_data.delete_role
        }).click(function ( event ) {
            event.preventDefault();
            ure_main.show_delete_role_dialog();
        });
    }

    jQuery('#ure_rename_role').button({
        label: ure_data.rename_role
    }).click(function (event) {
        event.preventDefault();
        ure_main.show_rename_role_dialog();
    });



    if ( jQuery('#ure_select_all_caps').length>0 ) {
        jQuery('#ure_select_all_caps').click( ure_main.auto_select_caps );
    }    

    ure_main.count_caps_in_groups();
    ure_main.sizes_update(); 
    jQuery('#ure_caps_groups_list').selectable({
        selected: function( event, ui ) {
            // do not allow multiple selection
            jQuery(ui.selected).siblings().removeClass('ui-selected');
            ure_main.caps_refresh( ui.selected.id );
        }
    });
    ure_main.select_selectable_element( jQuery('#ure_caps_groups_list'), jQuery('#ure_caps_group_all') );
    jQuery('#granted_only').click( ure_main.show_granted_caps_only );
    
});


// Main User Role Editor object
var ure_main = {
    selected_group: 'all', 
    caps_counter: null,
    class_prefix: 'ure-',


    ajax_error: function ( jqXHR, textStatus, errorThrown) {
        jQuery('#ure_task_status').hide();
        ure_main.show_notice( textStatus, 'error' );
    },


    // change color of apply to all check box - for multi-site setup only
    apply_to_all_on_click: function (cb) {
        el = document.getElementById('ure_apply_to_all_div');
        if (cb.checked) {
            el.style.color = '#FF0000';
        } else {
            el.style.color = '#000000';
        }
    },
    

    apply_selection: function (cb_id) {
        var qfilter = jQuery('#quick_filter').val();
        var parent_div = jQuery('#ure_cap_div_'+ cb_id);
        var disabled = jQuery('#'+ cb_id).attr('disabled');
        var result = false;
        if ( parent_div.hasClass( ure_main.class_prefix + ure_main.selected_group ) && // make selection inside currently selected group of capabilities only
            !parent_div.hasClass('hidden') && disabled!=='disabled' ) {   // select not hidden and not disabled checkboxes (capabilities) only
            //  if quick filter is not empty, then apply selection to the tagged element only
            if ( qfilter==='' || parent_div.hasClass('ure_tag') ) {
                result = true;
            }
        }

        return result;
    },


    auto_select_caps: function (event) {

        if ( event.shiftKey ) {
            jQuery('.ure-cap-cb').each(function () {   // reverse selection
                if ( ure_main.apply_selection( this.id ) ) {
                    jQuery(this).prop('checked', !jQuery(this).prop('checked'));
                }
            });
        } else {    
            jQuery('.ure-cap-cb').each(function () { // switch On/Off all checkboxes
                if ( ure_main.apply_selection( this.id ) ) {
                    jQuery(this).prop('checked', jQuery('#ure_select_all_caps').prop('checked'));
                }
            });
        }

    },
    
    
    caps_refresh_all: function () {
        jQuery('.ure-cap-div').each(function () {
            if (jQuery(this).hasClass('hidden')) {
                if ( !jQuery(this).hasClass(ure_main.class_prefix + 'deprecated') ) {
                    jQuery(this).removeClass('hidden');
                }
            }        
        });
    },

    
    caps_refresh_for_group: function (group_id) {
        var show_deprecated = jQuery('#ure_show_deprecated_caps').prop('checked');
        jQuery('.ure-cap-div').each(function () {
            var el = jQuery(this);
            if (el.hasClass(ure_main.class_prefix + group_id)) {
                if (el.hasClass('hidden')) {
                    if (el.hasClass('blocked')) {
                        return;
                    }
                    if (el.hasClass(ure_main.class_prefix + 'deprecated')) {
                        if (group_id==='deprecated' || show_deprecated) {
                            el.removeClass('hidden');
                        }
                    } else {                    
                        el.removeClass('hidden');
                    }                
                } else {
                    if (el.hasClass(ure_main.class_prefix + 'deprecated')) {
                        if (!show_deprecated) {
                            el.addClass('hidden');
                        }
                    }
                }
            } else {
                if (!el.hasClass('hidden')) {
                    el.addClass('hidden');
                }
            }
        });    
    },


    change_caps_columns_quant: function () {
        var selected_index = parseInt( jQuery('#caps_columns_quant').val() );
        var columns = ure_main.validate_columns( selected_index );
        var el = jQuery('#ure_caps_list');
        el.css('-moz-column-count', columns);
        el.css('-webkit-column-count', columns);
        el.css('column-count', columns);

    },


    caps_refresh: function ( group ) {

        var group_id = group.substr(15);
        ure_main.selected_group = group_id;
        if (group_id === 'all') {
            ure_main.caps_refresh_all();
        } else {
            ure_main.caps_refresh_for_group( group_id );
        }    
        ure_main.change_caps_columns_quant();
        jQuery('#granted_only').prop('checked', false);
    },
    
    
    hide_notice: function(el) {
        if ( el.parentNode!==null) {
            el.parentNode.removeChild(el);
        }        
    },
    
                
    show_notice: function(msg_text, msg_type) {

        /* create notice div */
        var div = document.createElement('div');
        div.classList.add('notice', 'is-dismissible');
        if (msg_type=='success') {
            div.classList.add('notice-success'); // Green left border
        } else if (msg_type=='info') {
            div.classList.add('notice-info');   // Blue left border
        } else if (msg_type=='error') {
            div.classList.add('notice-error');   // Red left border
        } else if (msg_type=='warning') {
            div.classList.add('notice-warning');   // Yellow left border
        }
        /* create paragraph element to hold message */
        var par = document.createElement('p');
        /* Add message text */
        par.appendChild(document.createTextNode(msg_text));
        // Optionally add a link here

        /* Add the whole message to notice div */
        div.appendChild(par);
        
        /* Create Dismiss icon */
        var but = document.createElement('button');
        but.setAttribute('type', 'button');
        but.classList.add('notice-dismiss');
        /* Add screen reader text to Dismiss icon */
        var bSpan = document.createElement('span');
        bSpan.classList.add('screen-reader-text');
        bSpan.appendChild(document.createTextNode('Dismiss this notice'));
        but.appendChild(bSpan);
        /* Add Dismiss icon to notice */
        div.appendChild(but);
        
        /* Insert notice after the first h1 */
        var h1 = document.getElementsByTagName('h1')[0];
        h1.parentNode.insertBefore(div, h1.nextSibling);
        /* Make the notice dismissable when the Dismiss icon is clicked */
        but.addEventListener('click', function () {
            div.parentNode.removeChild(div);
        });
        setTimeout(this.hide_notice, 7000, div);    // remove automatically after 7 sec.
    },


    show_granted_caps_only: function () {
        var show_deprecated = jQuery('#ure_show_deprecated_caps').prop('checked');
        var hide_flag = jQuery('#granted_only').prop('checked');
        jQuery('.ure-cap-div').each(function () {
            var cap_div = jQuery(this);
            if ( !cap_div.hasClass(ure_main.class_prefix + ure_main.selected_group ) ) {    // apply to the currently selected group only
                return;
            }
            var cap_id = cap_div.attr('id').substr( 12 );        
            var granted = jQuery('#'+ cap_id).prop('checked');
            if ( granted ) {
                return;
            }
            if ( hide_flag ) {
                if ( !cap_div.hasClass('hidden') ) {
                    cap_div.addClass('hidden');
                }
            } else {
                if ( cap_div.hasClass('ure-deprecated') && !show_deprecated ) {
                    return;
                }
                if ( cap_div.hasClass('hidden') ) {
                    cap_div.removeClass('hidden');
                }
            }
        });    
    },
    

    sizes_update: function () {
        
        var width = jQuery('#ure_caps_td').css('width');
        var el = jQuery('#ure_caps_list_container');
        el.css('width', width);
        var height = jQuery('#ure_caps_td').css('height');
        el.css('max-height', height);
        
    },


    ui_button_text: function(caption) {
        var wrapper = '<span class="ui-button-text">' + caption + '</span>';

        return wrapper;
    },            


    validate_columns: function (columns) {    
        
        if ( columns==1 || ure_main.selected_group==='all' ) {  
            return columns;
        }

        // Do not split list on columns in case it contains less then < 25 capabilities
        for (var i=0; i<ure_main.caps_counter.length; i++) {
            if ( ure_main.caps_counter[i].id===ure_main.selected_group ) {
                if ( ure_main.caps_counter[i].total<=25 ) {
                    columns = 1;
                }
                break;
            }
        }

        return columns;
    },
    

    init_caps_counter: function () {
        ure_main.caps_counter = new Array();
        jQuery('#ure_caps_groups_list li').each(function() {
            var group_id = jQuery(this).attr('id').substr(15);
            var group_counter = {'id': group_id, 'total': 0, 'granted':0};
            ure_main.caps_counter.push( group_counter );
        });
    
    },


    count_caps_in_groups: function () {    
        ure_main.init_caps_counter();
    
        jQuery('.ure-cap-div').each(function () {
            var cap_div = jQuery(this);
            var capability = cap_div.attr('id').substr(12);
            for (var i=0; i<ure_main.caps_counter.length; i++) {
                if (cap_div.hasClass(ure_main.class_prefix + ure_main.caps_counter[i].id)) {
                    ure_main.caps_counter[i].total++;
                    if (jQuery('#'+ capability).is(':checked')) {
                        ure_main.caps_counter[i].granted++;
                    }
                }                            
            }
        });
    
        for (var i=0; i<ure_main.caps_counter.length; i++) {
            var el = jQuery('#ure_caps_group_'+ ure_main.caps_counter[i].id);
            var old_text = el.text();
            var key_pos = old_text.indexOf('(');    // exclude (0/0) text if it is in string already
            if ( key_pos>0 ) {
                old_text = old_text.substr( 0, key_pos - 1 );
            }
            var value = old_text +' ('+ ure_main.caps_counter[i].total +'/'+ ure_main.caps_counter[i].granted +')';

            el.text(value);
        }
    
    },


    refresh_role_view: function ( response ) {
        jQuery('#ure_task_status').hide();
        if (response!==null && response.result=='error') {
            ure_main.show_notice( response.message, 'error' );
            return;
        }

        // remove "Granted Only" filter is it was set before current role change
        var granted_only = jQuery('#granted_only').prop('checked');
        if (granted_only) {
            jQuery('#granted_only').prop('checked', false);
            ure_main.show_granted_caps_only();
        }

        if ( response.hasOwnProperty( 'role_id' ) && response.hasOwnProperty( 'role_name' ) ) {
            ure_current_role = response.role_id;
            ure_current_role_name = response.role_name;        
        }
        // Select capabilities granted to a newly selected role and exclude others
        jQuery('.ure-cap-cb').each(function () { // go through all capabilities checkboxes
            if (this.id.length===0) {
                return;
            }
            if ( response.hasOwnProperty( 'caps' ) ) {
                jQuery(this).prop('checked', response.caps.hasOwnProperty(this.id) && response.caps[this.id]);
            }
            if ( ure_data.do_not_revoke_from_admin==1 ) {  
                var el = document.getElementById(this.id);
                if ( 'administrator'===ure_current_role ) {
                    el.addEventListener( 'click', ure_main.turn_it_back );
                } else {
                    el.removeEventListener( 'click', ure_main.turn_it_back );
                }
            }
        }); 
    
        // Recalculate granted capabilities for capabilities groups
        ure_main.count_caps_in_groups();
        ure_main.select_selectable_element( jQuery('#ure_caps_groups_list'), jQuery('#ure_caps_group_all') );    

        if (response.hasOwnProperty( 'options' ) ) {
            // additional options section
            jQuery('#additional_options').find(':checkbox').each(function() {   // go through all additional options checkboxes
                jQuery(this).prop('checked', response.options.hasOwnProperty(this.id));
            });
        }
    
    },


    role_change: function( role_id ) {

        jQuery('#ure_task_status').show();
        var data = {
            'action': 'ure_ajax',
            'sub_action':'get_role_caps', 
            'role': role_id, 
            'wp_nonce': ure_data.wp_nonce};
        jQuery.post( ajaxurl, data, ure_main.refresh_role_view, 'json' );

    },


    show_add_role_dialog: function() {
        
        jQuery('#ure_add_role_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 450,
            height: 230,
            resizable: false,
            title: ure_data.add_new_role_title,
            'buttons': {
                'Add Role': function () {
                    var role_id = jQuery('#user_role_id').val();
                    if ( role_id=='' ) {
                        ure_main.show_notice( ure_data.role_name_required, 'warning' );
                        return false;
                    }
                    if ( !( /^[\w-]*$/.test( role_id ) ) ) {
                        ure_main.show_notice( ure_data.role_name_valid_chars, 'warning' );
                        return false;
                    }
                    if ( ( /^[0-9]*$/.test( role_id ) ) ) {
                        ure_main.show_notice( ure_data.numeric_role_name_prohibited, 'warning' );
                        return false;
                    }
                    var role_name = jQuery('#user_role_name').val();
                    var role_copy_from = jQuery('#user_role_copy_from').val();

                    jQuery('#ure_task_status').show();
                    jQuery.ajax( {
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        data: {
                            action: 'ure_ajax',
                            sub_action: 'add_role',                            
                            user_role_id: role_id,
                            user_role_name: role_name,
                            user_role_copy_from: role_copy_from,
                            network_admin: ure_data.network_admin,
                            wp_nonce: ure_data.wp_nonce
                        },
                        success: ure_main.add_role_success,
                        error: ure_main.ajax_error
                    } );

                    jQuery( this ).dialog('close');
                },
                CancelAddRole: function () {
                    jQuery(this).dialog('close');
                    return false;
                }
            }
        });
        jQuery( '.ui-dialog-buttonpane button:contains("Add Role")' ).attr( 'id', 'dialog-add-role-button' );
        jQuery( '#dialog-add-role-button' ).html( this.ui_button_text( ure_data.add_role ) );
        jQuery( '.ui-dialog-buttonpane button:contains("CancelAddRole")' ).attr( 'id', 'dialog-add-role-cancel-button' );
        jQuery( '#dialog-add-role-cancel-button' ).html( this.ui_button_text( ure_data.cancel ) );

    },

    add_role_to_select: function( select_id, role_id, role_name ) {
      
        jQuery( '#'+ select_id )
          .append( jQuery( '<option>', {value : role_id} )
          .text( role_name +' ('+ role_id +')' ) );
    },
    
    
    select_selectable_element: function (selectable_container, elements_to_select) {
        // add unselecting class to all elements in the styleboard canvas except the ones to select
        jQuery('.ui-selected', selectable_container).not(elements_to_select).removeClass('ui-selected').addClass('ui-unselecting');    
        // add ui-selecting class to the elements to select
        jQuery(elements_to_select).not('.ui-selected').addClass('ui-selecting');
        // trigger the mouse stop event (this will select all .ui-selecting elements, and deselect all .ui-unselecting elements)
        selectable_container.data('ui-selectable')._mouseStop(null);
    },

    
    sort_roles_select: function ( role_id ) {
        var select_list = jQuery('#user_role option');
        select_list.sort( function( a, b ) {
            var res = 0;
            if (a.value<b.value) {
                res = -1;
            } else {
                res = 1;
            }
            return res;
        });
        jQuery('#user_role').html( select_list );
        jQuery('#user_role').val( role_id );
    },
        
    sort_roles_del_select: function ( ) {
        var select_list = jQuery('#del_user_role option');
        select_list.sort( function( a, b ) {
            var res = 0;
            if (a.value<b.value) {
                res = -1;
            } else {
                res = 1;
            }
            return res;
        });
        jQuery('#del_user_role').html( select_list );

    },
    
    add_role_success: function( data ) {
        jQuery('#ure_task_status').hide();
        if ( data.result=='success' ) {
            if ( data.role_id.length>0 ) {
                // update list of roles available for selection as current role
                ure_main.add_role_to_select( 'user_role', data.role_id, data.role_name );
                ure_main.sort_roles_select( data.role_id );
                ure_main.role_change( data.role_id );                
                
                // Update the list of roles available for deletion
                ure_main.add_role_to_select( 'del_user_role', data.role_id, data.role_name );
                ure_main.sort_roles_del_select();
                if ( !jQuery( '#ure_delete_role' ).is( ':visible') ) {
                    jQuery( '#ure_delete_role' ).show();
                }
            }
            ure_main.show_notice( data.message, 'success' );
        } else {
            ure_main.show_notice( data.message, 'error' );
        }
    },
    
    
    show_add_capability_dialog: function() {
                
        jQuery('#ure_add_capability_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 350,
            height: 190,
            resizable: false,
            title: ure_data.add_capability,
            'buttons': {
                'Add Capability': function () {
                    var capability_id = jQuery( '#capability_id' ).val();
                    if ( capability_id == '' ) {
                        ure_main.show_notice( ure_data.capability_name_required, 'warning' );
                        return false;
                    }
                    if ( !( /^[\w-]*$/.test( capability_id ) ) ) {
                        ure_main.show_notice( ure_data.capability_name_valid_chars, 'warning' );
                        return false;
                    }  
                    jQuery('#ure_task_status').show();
                    jQuery.ajax( {
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        data: {
                            action: 'ure_ajax',
                            sub_action: 'add_capability',                            
                            capability_id: capability_id,
                            user_role: jQuery('#user_role').val(),
                            network_admin: ure_data.network_admin,
                            wp_nonce: ure_data.wp_nonce
                        },
                        success: ure_main.add_capability_success,
                        error: ure_main.ajax_error
                    } );
                    jQuery( this ).dialog( 'close' );
                },
                CancelAddCapability: function () {
                    jQuery(this).dialog('close');
                }
            }
        });
        jQuery('.ui-dialog-buttonpane button:contains("Add Capability")').attr('id', 'dialog-add-capability-button');
        jQuery('#dialog-add-capability-button').html(this.ui_button_text(ure_data.add_capability));
        jQuery('.ui-dialog-buttonpane button:contains("CancelAddCapability")').attr('id', 'add-capability-dialog-cancel-button');
        jQuery('#add-capability-dialog-cancel-button').html(this.ui_button_text(ure_data.cancel));
        
    },


    add_capability_success: function( data ) {
        jQuery('#ure_task_status').hide();
        if ( data.result=='success' ) {
            if ( data.html.length>0 ) {
                jQuery( '#ure_caps_list' ).html( data.html );
                ure_main.refresh_role_view( data );
            }
            ure_main.show_notice( data.message, 'success' );
        } else {
            ure_main.show_notice( data.message, 'error' );
        }
    },
    
    
    show_delete_capability_dialog: function () {
        jQuery('#ure_delete_capability_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 350,
            height: 400,
            resizable: false,
            title: ure_data.delete_capability,
            buttons: {
                'Delete Capability': function () {
                    if ( !confirm( ure_data.delete_capability + ' - ' + ure_data.delete_capability_warning ) ) {
                        return;
                    }  
                    var values = {};
                    jQuery.each( jQuery('#ure_remove_caps_form').serializeArray(), function( i, field ) {
                        values[field.name] = field.value;
                    });
                    jQuery('#ure_task_status').show();
                    jQuery.ajax( {
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        data: {
                            action: 'ure_ajax',
                            sub_action: 'delete_capability',
                            values: values,
                            network_admin: ure_data.network_admin,
                            wp_nonce: ure_data.wp_nonce
                        },
                        success: ure_main.delete_capability_success,
                        error: ure_main.ajax_error
                    } );
                    jQuery(this).dialog('close');
                },
                CancelDeleteCapability: function () {
                    jQuery(this).dialog('close');
                }
            }
        });
        // translate buttons caption
        jQuery('.ui-dialog-buttonpane button:contains("Delete Capability")').attr('id', 'dialog-delete-capability-button');
        jQuery('#dialog-delete-capability-button').html(this.ui_button_text(ure_data.delete_capability));
        jQuery('.ui-dialog-buttonpane button:contains("CancelDeleteCapability")').attr('id', 'delete-capability-dialog-cancel-button');
        jQuery('#delete-capability-dialog-cancel-button').html(this.ui_button_text(ure_data.cancel));
        jQuery('#ure_remove_caps_select_all').click(this.remove_caps_auto_select);
    },
    
    
    delete_capability_success: function( data ) {
        jQuery('#ure_task_status').hide();
        if ( data.result=='success' ) {
            if ( data.deleted_caps.length>0 ) {
                for(var i=0; i<data.deleted_caps.length; i++) {
                    jQuery('#ure_cap_div_'+ data.deleted_caps[i]).remove();
                }
                ure_main.count_caps_in_groups();
            }
            ure_main.show_notice( data.message, 'success' );
        } else {
            ure_main.show_notice( data.message, 'error' );
        }
    },
    
    
    // Get from the server a list of capabilities we can delete and show dialog to select what to delete
    get_caps_to_remove: {
        url: ajaxurl,
        type: 'POST',
        dataType: 'json',
        async: true,
        data: {
            action: 'ure_ajax',
            sub_action: 'get_caps_to_remove',
            current_role: jQuery('#user_role').val(),
            network_admin: ure_data.network_admin,
            wp_nonce: ure_data.wp_nonce
        },
        success: function ( response ) {
            //var data = jQuery.parseJSON(response);
            if ( typeof response.result !== 'undefined' ) {
                if ( response.result === 'success' ) {
                    jQuery('#ure_delete_capability_dialog .ure-input').html( response.html );
                    ure_main.show_delete_capability_dialog();
                } else if (data.result === 'failure') {
                    ure_main.show_notice( data.message, 'error' );
                } else {
                    ure_main.show_notice( 'Wrong response: ' + response, 'error' )
                }
            } else {
                ure_main.show_notice( 'Wrong response: ' + response, 'error' )
            }
        },
        error: this.ajax_error        
    },
    
    remove_caps_auto_select: function (event) {
        if (event.shiftKey) {
            jQuery('.ure-cb-column').each(function () {   // reverse selection
                jQuery(this).prop('checked', !jQuery(this).prop('checked'));
            });
        } else {    // switch On/Off all checkboxes
            jQuery('.ure-cb-column').prop('checked', jQuery('#ure_remove_caps_select_all').prop('checked'));

        }
    },
    
    
    show_delete_role_dialog: function () {
        jQuery('#ure_delete_role_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 320,
            height: 190,
            resizable: false,
            title: ure_data.delete_role,
            buttons: {
                'Delete Role': function () {
                    var user_role_id = jQuery('#del_user_role').val();
                    var question = '';
                    if (user_role_id!=-1) {
                        question = ure_data.delete_role +' "'+ user_role_id +'"';
                    } else {
                        question = jQuery('#del_user_role').find('option:selected').text();
                    }
                    question += '?';
                    if ( !confirm( question ) ) {
                        return false;
                    }
                    
                    jQuery('#ure_task_status').show();
                    jQuery.ajax( {
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        data: {
                            action: 'ure_ajax',
                            sub_action: 'delete_role',
                            user_role_id: user_role_id,
                            network_admin: ure_data.network_admin,
                            wp_nonce: ure_data.wp_nonce
                        },
                        success: ure_main.delete_role_success,
                        error: ure_main.ajax_error
                    } );
                    
                    jQuery(this).dialog('close');
                },
                CancelDeleteRole: function () {
                    jQuery(this).dialog('close');
                }
            }
        });
        // translate buttons caption
        jQuery('.ui-dialog-buttonpane button:contains("Delete Role")').attr('id', 'dialog-delete-role-button');
        jQuery('#dialog-delete-role-button').html( ure_main.ui_button_text( ure_data.delete_role ) );
        jQuery('.ui-dialog-buttonpane button:contains("CancelDeleteRole")').attr('id', 'dialog-delete-role-cancel-button');
        jQuery('#dialog-delete-role-cancel-button').html( ure_main.ui_button_text( ure_data.cancel ) );
    },
    
    
    delete_role_success: function( data ) {
        jQuery('#ure_task_status').hide();
        if ( data.result=='success' ) {
            if ( data.deleted_roles.length>0 ) {
                force_current_role_change = false;
                for( var i=0; i<data.deleted_roles.length; i++ ) {
                    jQuery('#del_user_role option[value="'+ data.deleted_roles[i] +'"]').remove();                                        
                    jQuery('#user_role option[value="'+ data.deleted_roles[i] +'"]').remove();
                    if ( data.deleted_roles[i]==ure_current_role ) {
                        force_current_role_change = true;
                    }
                } 
                var del_role_list = jQuery('#del_user_role option');                
                if ( del_role_list.length==1 ) {
                    jQuery( '#ure_delete_role' ).hide();
                }
                if ( force_current_role_change ) {                                        
                    var select_role_list = jQuery('#user_role option');
                    var el = select_role_list[select_role_list.length-1];
                    var role_id = el.value;
                    jQuery('#user_role').val( role_id );
                    ure_main.role_change( role_id );
                }
            }
            ure_main.show_notice( data.message, 'success' );            
        } else {
            ure_main.show_notice( data.message, 'error' );
        }
    },
    
    
    show_rename_role_dialog: function () {

        jQuery('#ure_rename_role_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 450,
            height: 230,
            resizable: false,
            title: ure_data.rename_role_title,
            'buttons': {
                'Rename Role': function () {
                    var role_id = jQuery('#ren_user_role_id').val();
                    var role_name = jQuery('#ren_user_role_name').val();
                    jQuery('#ure_task_status').show();
                    jQuery.ajax( {
                        url: ajaxurl,
                        type: 'POST',
                        dataType: 'json',
                        async: true,
                        data: {
                            action: 'ure_ajax',
                            sub_action: 'rename_role',
                            user_role_id: role_id,
                            user_role_name: role_name,
                            network_admin: ure_data.network_admin,
                            wp_nonce: ure_data.wp_nonce
                        },
                        success: ure_main.rename_role_success,
                        error: ure_main.ajax_error
                    } );                    
                    jQuery(this).dialog('close');
                },
                CancelRenameRole: function () {
                    jQuery(this).dialog('close');
                    return false;
                }
            }
        });
        jQuery('.ui-dialog-buttonpane button:contains("Rename Role")').attr('id', 'dialog-rename-role-button');
        jQuery('#dialog-rename-role-button').html( ure_main.ui_button_text( ure_data.rename_role ) );
        jQuery('.ui-dialog-buttonpane button:contains("CancelRenameRole")').attr('id', 'rename-role-dialog-cancel-button');
        jQuery('#rename-role-dialog-cancel-button').html( ure_main.ui_button_text( ure_data.cancel ) );
        jQuery('#ren_user_role_id').val( ure_current_role );
        jQuery('#ren_user_role_name').val( ure_current_role_name );

    },
    
    
    rename_role_success: function( data ) {
        
        jQuery('#ure_task_status').hide();
        if ( data.result=='success' ) {
            if ( data.role_id.length>0 ) {
                jQuery( '#user_role option[value="'+ data.role_id+'"]' ).text( data.role_name +' ('+ data.role_id +')' );
                ure_current_role_name = data.role_name;
            }
            ure_main.show_notice( data.message, 'success' );            
        } else {
            ure_main.show_notice( data.message, 'error' );
        }
    },
    
    hide_pro_banner: function() {
        jQuery('#ure_task_status').show();
        jQuery.ajax( {
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {
                action: 'ure_ajax',
                sub_action: 'hide_pro_banner',                
                network_admin: ure_data.network_admin,
                wp_nonce: ure_data.wp_nonce
            },
            success: ure_main.hide_pro_banner_success,
            error: ure_main.ajax_error
        } );        
    },
    
    hide_pro_banner_success: function( data ) {
        jQuery('#ure_task_status').hide();
        if ( data.result=='success' ) {
            jQuery( '#ure_pro_advertisement' ).hide();
        } else {
            ure_main.show_notice( data.message, 'error' );
        }
    },
    
    filter_capabilities: function( cap_id ) {
        var div_list = jQuery('.ure-cap-div');
        for (var i = 0; i < div_list.length; i++) {
            var el = jQuery('#'+ div_list[i].id);
            if ( cap_id !== '' ) {
                if (div_list[i].id.substr(11).indexOf(cap_id) !== -1 ) {
                    el.addClass('ure_tag');
                    el.removeClass('filtered');
                    div_list[i].style.color = '#27CF27';
                } else {                                    
                    el.removeClass('ure_tag');
                    el.addClass('filtered');
                    div_list[i].style.color = '#000000';
                }
            } else {
                el.removeClass('ure_tag');
                el.removeClass('filtered');
                div_list[i].style.color = '#000000';
            }
        }

    },
    
    // turn on checkbox back if clicked to turn off - for 'administrator' role only!
    turn_it_back: function( event ) {
    
        if ( 'administrator'===ure_current_role ) {
            event.target.checked = true; 
        }

    }
    

};  // end of ure_main declaration
//-------------------------------


function ure_ui_button_text(caption) {
    var wrapper = '<span class="ui-button-text">' + caption + '</span>';

    return wrapper;
}


jQuery(function ($) {
            
    $('#ure_update_role').button({
        label: ure_data.update
    }).click(function () {
        if (ure_data.confirm_role_update == 1) {
            event.preventDefault();
            ure_confirm(ure_data.confirm_submit, ure_form_submit);
        }
    });


    function ure_form_submit() {
        $('#ure_form').submit();
    }

    
    function ure_show_default_role_dialog() {
        $('#ure_default_role_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 320,
            height: 190,
            resizable: false,
            title: ure_data.default_role,
            buttons: {
                'Set New Default Role': function () {
                    $(this).dialog('close');
                    var user_role_id = $('#default_user_role').val();
                    $.ure_postGo(ure_data.page_url,
                            {action: 'change-default-role', user_role_id: user_role_id, ure_nonce: ure_data.wp_nonce});
                },
                CancelDefaultRole: function () {
                    $(this).dialog('close');
                }
            }
        });
        // translate buttons caption
        $('.ui-dialog-buttonpane button:contains("Set New Default Role")').attr('id', 'dialog-default-role-button');
        $('#dialog-default-role-button').html(ure_ui_button_text(ure_data.set_new_default_role));
        $('.ui-dialog-buttonpane button:contains("CancelDefaultRole")').attr('id', 'default-role-dialog-cancel-button');
        $('#default-role-dialog-cancel-button').html(ure_ui_button_text(ure_data.cancel));
    }
    

    if ($('#ure_default_role').length > 0) {
        $('#ure_default_role').button({
            label: ure_data.default_role
        }).click(function (event) {
            event.preventDefault();                
            ure_show_default_role_dialog();
        });
    }
    

    function ure_confirm(message, routine) {

        $('#ure_confirmation_dialog').dialog({
            dialogClass: 'wp-dialog',
            modal: true,
            autoOpen: true,
            closeOnEscape: true,
            width: 400,
            height: 180,
            resizable: false,
            title: ure_data.confirm_title,
            'buttons': {
                'No': function () {
                    $(this).dialog('close');
                    return false;
                },
                'Yes': function () {
                    $(this).dialog('close');
                    routine();
                    return true;
                }
            }
        });
        $('#ure_cd_html').html(message);

        $('.ui-dialog-buttonpane button:contains("No")').attr('id', 'dialog-no-button');
        $('#dialog-no-button').html(ure_ui_button_text(ure_data.no_label));
        $('.ui-dialog-buttonpane button:contains("Yes")').attr('id', 'dialog-yes-button');
        $('#dialog-yes-button').html(ure_ui_button_text(ure_data.yes_label));

    }
    // end of ure_confirm()


});
// end of jQuery(function() ...


function ure_turn_caps_readable(user_id) {
    var ure_obj = 'user';
    if (user_id === 0) {
        ure_obj = 'role';
    }

    jQuery.ure_postGo(ure_data.page_url, {action: 'caps-readable', object: ure_obj, user_id: user_id, ure_nonce: ure_data.wp_nonce});

}
// end of ure_turn_caps_readable()


function ure_turn_deprecated_caps(user_id) {

    var ure_obj = 'user';
    if (user_id === 0) {
        ure_obj = 'role';
    }
    jQuery.ure_postGo(ure_data.page_url, {action: 'show-deprecated-caps', object: ure_obj, user_id: user_id, ure_nonce: ure_data.wp_nonce});

}
// ure_turn_deprecated_caps()


jQuery(window).resize(function () {
    ure_main.sizes_update();
});
