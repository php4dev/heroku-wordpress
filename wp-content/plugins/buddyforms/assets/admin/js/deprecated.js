jQuery(document).ready(function (jQuery) {
//
// This is the old sidbear based add form elements function. Its deprecated but let us support it till 2.0
//
    jQuery('.bf_add_element_action').on('click', function () {

        var action = jQuery(this);
        var post_id = bf_getUrlParameter('post');

        if (post_id == undefined)
            post_id = 0;

        var fieldtype = jQuery(this).data("fieldtype");
        var unique = jQuery(this).data("unique");

        var exist = jQuery("#sortable_buddyforms_elements .bf_" + fieldtype);

        if (unique === 'unique') {
            if (exist !== null && typeof exist === 'object' && exist.length > 0) {
                bf_alert('This element can only be added once into each form');
                return false;
            }
        }
        if(buddyformsGlobal) {
            jQuery.ajax({
                type: 'POST',
                url: buddyformsGlobal.admin_url,
                data: {
                    "action": "buddyforms_display_form_element",
                    "fieldtype": fieldtype,
                    "unique": unique,
                    "post_id": post_id
                },
                success: function (data) {
                    if (data == 'unique') {
                        bf_alert('This element can only be added once into each form');
                        return false;
                    }

                    jQuery('.buddyforms_template').remove();

                    data = data.replace('accordion-body collapse', 'accordion-body in collapse');

                    var myvar = action.attr('href');
                    var arr = myvar.split('/');
                    jQuery('#sortable_buddyforms_elements').append(data);

                    bf_update_list_item_number();

                    jQuery('#buddyforms_form_elements').removeClass('closed');
                    jQuery("html, body").animate({scrollTop: jQuery('#buddyforms_form_elements ul li:last').offset().top - 200}, 1000);

                },
                error: function () {
                    ;
                    jQuery('<div></div>').dialog({
                        modal: true,
                        title: "Info",
                        open: function () {
                            var markup = 'Something went wrong ;-(sorry)';
                            jQuery(this).html(markup);
                        },
                        buttons: {
                            Ok: function () {
                                jQuery(this).dialog("close");
                            }
                        }
                    });
                }
            });
        }
        return false;
    });
});