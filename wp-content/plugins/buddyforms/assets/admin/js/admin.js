(function ($) {
    $.getStylesheet = function (href) {
        var $d = $.Deferred();
        var $link = $('<link/>', {
            rel: 'stylesheet',
            type: 'text/css',
            href: href
        }).appendTo('head');
        $d.resolve($link);
        return $d.promise();
    };
})(jQuery);

function createNewPageOpenModal(e) {
    var dialog = jQuery('<div></div>').dialog({
        modal: true,
        title: "Info",
        open: function () {
            var markup = 'Name your Page' +
                '<input id="bf_create_page_name" type="text" value="">';
            jQuery(this).html(markup);
        },
        buttons: {
            'Add': function () {
                var page_name = jQuery('#bf_create_page_name').val();
                dialog.html('<span class="spinner is-active"></span>');
                if (buddyformsGlobal) {
                    jQuery.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: buddyformsGlobal.admin_url,
                        data: {
                            "action": "buddyforms_new_page",
                            "page_name": page_name
                        },
                        success: function (data) {
                            if (data['error']) {
                                console.log(data['error']);
                            } else {
                                jQuery('#attached_page').append(jQuery('<option>', {
                                    value: data['id'],
                                    text: data['name']
                                }));
                                jQuery('#attached_page').val(data['id']);
                            }
                            dialog.dialog("close");
                        },
                        error: function () {
                            dialog.dialog("close");
                        }
                    });
                }
            }
        }
    });
    e.preventDefault();
    return false;
}

//
// Helper function to get the post id from url
//
var bf_getUrlParameter = function bf_getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

//
// Generate a custom string to append to the field slug in case of duplicate
//
function buddyformsMakeFieldId() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

//
// Autofill empty slug's fields
// or append hashes to duplicate ones
//
function buddyformAutoFillEmptyOrDuplicateSlugs() {
    var findFieldsSlugs = jQuery("#post input[name^='buddyforms_options[form_fields]'][name$='[slug]'][type!='hidden']");
    findFieldsSlugs.each(function () {
        var fieldSlugs = jQuery(this);
        if (!fieldSlugs.val()) {
            console.log('empty field slug');
            var field_id = fieldSlugs.attr('data');
            var fieldContainer = jQuery('li#field_' + field_id);
            if (fieldContainer && fieldContainer.length > 0) {
                var fieldNameValue = fieldContainer.find('tr.use_as_slug input[name="buddyforms_options[form_fields][' + field_id + '][name]"]').val();
                if (fieldNameValue) {
                    var slugFromName = slug(fieldNameValue, {lower: false});
                    fieldContainer.find('tr.slug' + field_id + ' input[name="buddyforms_options[form_fields][' + field_id + '][slug]"]').val(slugFromName);
                }
            }
        }
        findFieldsSlugs.each(function () {
            if (jQuery(this).val() === fieldSlugs.val() && fieldSlugs.attr('name') !== jQuery(this).attr('name')) {
                fieldSlugs.val(fieldSlugs.val() + '_' + buddyformsMakeFieldId());
                return false;
            }
        });
    });
}

//
// Validate an email using regex
//
function buddyformsIsEmailOrShortcode(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})|\[(.*?)(\s.*?)?\]$/;
    return regex.test(email);
}

//
// Validate multiples email address separated by coma
//
function buddyformsValidateMultiEmail(string) {
    var result = true;
    if (string) {
        var isMulti = /[;,]+/.test(string);
        if (isMulti) {
            var values = string.split(/[;,]+/);
            jQuery.each(values, function (index, email) {
                result = buddyformsIsEmailOrShortcode(email.trim());
                if (!result) {
                    return result;
                }
            });
        } else {
            result = buddyformsIsEmailOrShortcode(string);
            if (!result) {
                return result;
            }
        }
    } else {
        result = false;
    }

    return result;
}

//
// Validate notification email element
//
function buddyforms_validate_notifications_email(element) {
    if (element) {
        var value = jQuery(element).val();
        if (value) {
            var isValid = buddyformsValidateMultiEmail(jQuery(element).val());
            if (!isValid) {
                jQuery(element)[0].setCustomValidity('Invalid Email(s)');
                jQuery(element).addClass('bf-error');
            } else {
                jQuery(element)[0].setCustomValidity('');
                jQuery(element).removeClass('bf-error');
            }
            return isValid;
        } else {
            jQuery(element)[0].setCustomValidity('');
            jQuery(element).removeClass('bf-error');
        }
    }
    return true;
}

//
// Update form builder form elements list number 1,2,3,...
//
function bf_update_list_item_number() {
    jQuery(".buddyforms_forms_builder ul").each(function () {
        jQuery(this).children("li").each(function (t) {
            jQuery(this).find("td.field_order .circle").first().html(t + 1)
        })
    })
}

//
// Helper Function to use dialog instead of alert
//
function bf_alert(alert_message) {
    jQuery('<div></div>').dialog({
        modal: true,
        title: "Info",
        open: function () {
            jQuery(this).html(alert_message);
        },
        buttons: {
            Ok: function () {
                jQuery(this).dialog("close");
            }
        }
    });
}

// Update ths list number 1,2,3,... for the mail trigger
function bf_update_list_item_number_mail() {
    jQuery("#mailcontainer .bf_trigger_list_item").each(function (t) {
        jQuery(this).find("td.field_order .circle").first().html(t + 1)
    })
}

function buddyforms_load_select2(element) {
    jQuery.when(jQuery.getStylesheet(buddyformsGlobal.assets.select2_css), jQuery.getScript(buddyformsGlobal.assets.select2_js))
        .then(function () {
            if (jQuery.fn.select2) {
                element.select2({
                    placeholder: "Select an option"
                });
            } else {
                console.log('BF-Error loading select2 assets, please contact support.');
            }
        }, function () {
            console.log('BF-Error loading select2 assets, please contact support.');
        });
}

//
// Helper Function to lode form element templates depend on the form type
//
function load_formbuilder_template(template, completeCallBack) {
    var postTitle = jQuery('input#title');
    if (buddyformsGlobal) {
        jQuery.ajax({
            type: 'POST',
            dataType: "json",
            url: buddyformsGlobal.admin_url,
            data: {
                "action": "buddyforms_form_template",
                "template": template,
                "title": postTitle.val()
            },
            success: function (data) {
                jQuery.each(data, function (i, val) {
                    switch (i) {
                        case 'formbuilder':
                            var form_builder = jQuery('.buddyforms_forms_builder');
                            form_builder.replaceWith(val);
                            bf_update_list_item_number();
                            jQuery(document.body).trigger({type: "buddyform:load_fields"});
                            break;
                        case 'mail_notification':
                            jQuery('.buddyforms_accordion_notification').html(val);
                            jQuery('#no-trigger-mailcontainer').hide();

                            tinymce.execCommand('mceRemoveEditor', false, 'bf_mail_body' + val['trigger_id']);
                            tinymce.execCommand('mceAddEditor', false, 'bf_mail_body' + val['trigger_id']);

                            bf_update_list_item_number_mail();

                            break;
                        case 'form_setup':
                            jQuery.each(val, function (i2, form_setup) {
                                if (form_setup instanceof Object) {
                                    jQuery.each(form_setup, function (form_setup_key, form_setup_option) {
                                        var element;
                                        if (form_setup_option instanceof Object) {
                                            jQuery.each(form_setup_option, function (form_setup_key2, form_setup_option2) {
                                                element = jQuery('[name="buddyforms_options[' + i2 + '][' + form_setup_key + '][' + form_setup_key2 + ']"]');
                                                buddyform_apply_template_to_element(element, form_setup_option2);
                                            });
                                        } else {
                                            element = jQuery('[name="buddyforms_options[' + i2 + '][' + form_setup_key + ']"]');
                                            buddyform_apply_template_to_element(element, form_setup_option);
                                        }
                                    });
                                }

                                if (form_setup instanceof Array) {
                                    buddyform_apply_template_to_element(jQuery('[name="buddyforms_options[' + i2 + '][]"]'), form_setup);
                                } else {
                                    buddyform_apply_template_to_element(jQuery('[name="buddyforms_options[' + i2 + ']"]'), form_setup);
                                }
                                // Add Select2 Support
                                var adminSelect2 = jQuery(".bf-select2");
                                if (adminSelect2.length > 0) {
                                    buddyforms_load_select2(adminSelect2);
                                }
                                // Check the form type and only display the relevant form setup tabs
                                from_setup_form_type(jQuery('#bf-form-type-select').val());
                            });
                            break;
                        default:
                            bf_alert(val);
                    }
                });
                tb_remove();
                if (!postTitle.val()) {
                    postTitle.val(buddyformsMakeFieldId());
                    jQuery('input#title').focus();
                    jQuery('#title-prompt-text').addClass('screen-reader-text');
                }
                jQuery('[name="buddyforms_options[slug]"]').val('');
            },
            error: function () {
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
            },
            complete: function (jqXHR, textStatus) {
                if (typeof completeCallBack === 'function') {
                    completeCallBack(jqXHR, textStatus);
                }
            }
        });
    }

    return false;
}

/**
 *
 * @param element
 * @param value
 */
function buddyform_apply_template_to_element(element, value) {
    if (element.length === 1) {
        element.val(value).trigger('change');
    } else {
        jQuery.each(element, function () {
            var current = jQuery(this);
            var current_val = current.val();
            current.prop("checked", (current_val === value));
        });
    }
}

//
// Process the form errors and scroll to it
//
function buddyforms_process_errors(errors) {
    var form_with_no_errors = true;
    if (errors.length > 0) {
        jQuery.each(errors, function (index, current_error) {
            if (!current_error.isValid) {
                form_with_no_errors = false;
                var type = current_error.type || 'accordion';
                switch (type) {
                    case 'title':
                    case 'content':
                    case 'textarea':
                    case 'text':
                    case 'post_excerpt':
                    case 'number':
                    case 'subject':
                    case 'message': {
                        jQuery("a[href='#validation-" + type + "-" + current_error.field_id + "']").click();
                        var sortableBuddyformsElements = jQuery("#sortable_buddyforms_elements");
                        sortableBuddyformsElements.accordion({
                            active: false
                        });
                        //Find the parent, the element id and expand it
                        jQuery(current_error.element).closest(".accordion-body.ui-accordion-content.collapse").addClass("ui-accordion-content-active").css("height", "auto");
                        var li_id = jQuery(current_error.element).closest('li.bf_list_item');
                        var li_position = jQuery('#sortable_buddyforms_elements li.bf_list_item').index(jQuery(li_id));
                        sortableBuddyformsElements.accordion({
                            active: li_position
                        });
                        jQuery('#buddyforms_form_setup').removeClass('closed');
                        jQuery('#buddyforms_form_elements').removeClass('closed');
                        break;
                    }
                    case 'accordion': {
                        var general_tab_id = jQuery(current_error.element).closest('div').parent().attr("id");
                        jQuery("a[href='#" + general_tab_id + "']").click();

                        //close all
                        var sortableBuddyformsElements = jQuery("#sortable_buddyforms_elements");
                        sortableBuddyformsElements.accordion({
                            active: false
                        });
                        //Find the parent, the element id and expand it
                        jQuery(current_error.element).closest(".accordion-body.ui-accordion-content.collapse").addClass("ui-accordion-content-active").css("height", "auto");
                        var li_id = jQuery(current_error.element).closest('li.bf_list_item');
                        var li_position = jQuery('#sortable_buddyforms_elements li.bf_list_item').index(jQuery(li_id));
                        sortableBuddyformsElements.accordion({
                            active: li_position
                        });
                        jQuery('#buddyforms_form_setup').removeClass('closed');
                        jQuery('#buddyforms_form_elements').removeClass('closed');
                        break;
                    }
                    case 'settings': {
                        if (!jQuery(current_error.element).is(':visible')) {
                            var currentId = jQuery(current_error.element).closest('div.tab-pane.ui-widget-content.ui-corner-bottom').attr('id');
                            jQuery('.buddyform-nav-tabs li[aria-controls="' + currentId + '"]>a').click()
                        }
                        break;
                    }
                }
                var element_name = jQuery(current_error.element).attr('name');
                jQuery("html, body").animate({scrollTop: jQuery('[name="' + element_name + '"]').offset().top - 250}, 1000);
                return false;
            }
        });
    }

    return form_with_no_errors;
}

var bfErrors = [];

function bfValidateRule(fieldId, option, elem, field_type) {
    var element_min = jQuery("[field_id=" + fieldId + "_validation_minlength]")[0];
    var element_max = jQuery("[field_id=" + fieldId + "_validation_maxlength]")[0];
    if (element_max && element_min) {

        var element_min_value = parseInt(element_min.value);
        var element_max_value = parseInt(element_max.value);
        var element_min_parent = jQuery(element_min).parent();
        var element_max_parent = jQuery(element_max).parent();
        //Celan previous messages
        jQuery(element_min_parent).find("label#" + fieldId + "_validation_error_message").remove();
        jQuery(element_max_parent).find("label#" + fieldId + "_validation_error_message").remove();

        //If both min and max value are equals zero then skip validation
        if (element_min_value === 0 && element_max_value === 0) {
            bfErrors = bfErrors.filter(function (obj) {
                return obj.field_id !== fieldId;
            });
        } else {

            if (option === "min") {
                if (element_min_value < 0) {
                    bfErrors.push({isValid: false, element: element_min, type: field_type, field_id: fieldId});
                    jQuery(element_min_parent).append("<label id='" + fieldId + "_validation_error_message' class='error'>Value must be greater or equals zero.</label>");
                } else {
                    if (element_min_value >= element_max_value) {
                        //If the min length validation fails, add the error to the array
                        bfErrors.push({isValid: false, element: element_min, type: field_type, field_id: fieldId});
                        //Add the label with the validation error message
                        jQuery(element_min_parent).append("<label id='" + fieldId + "_validation_error_message' class='error'>Min value must be lesser than Max.</label>");
                    } else {
                        //If the Validation for Min Length was succesful the remove the error from the array
                        bfErrors = bfErrors.filter(function (obj) {
                            return obj.field_id !== fieldId;
                        });
                    }
                }

            } else if (option === "max") {

                if (element_max_value < 0) {
                    bfErrors.push({isValid: false, element: element_max, type: field_type, field_id: fieldId});
                    jQuery(element_max_parent).append("<label id='" + fieldId + "_validation_error_message' class='error'>Value must be greater or equals zero.</label>");
                } else {

                    if (element_max_value <= element_min_value) {
                        //If the max length validation fails, add the error to the array
                        bfErrors.push({isValid: false, element: element_max, type: field_type, field_id: fieldId});
                        //Add the label with the validation error message
                        jQuery(element_max_parent).append("<label id='" + fieldId + "_validation_error_message' class='error'>Max value must be greater than Min.</label>");
                    } else {
                        //If the Validation for Min Length was succesful the remove the error from the array
                        bfErrors = bfErrors.filter(function (obj) {
                            return obj.field_id !== fieldId;
                        });
                    }
                }
            }
        }
    }
}

/**
 * Copy element to clipboard
 *
 * @since 2.4.5
 */
function buddyformsCopyStringToClipboard(string) {
    var el = document.createElement('textarea');
    el.value = string;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    var selected =
        document.getSelection().rangeCount > 0
            ? document.getSelection().getRangeAt(0)
            : false;
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    if (selected) {
        document.getSelection().removeAllRanges();
        document.getSelection().addRange(selected);
    }
}

/**
 * Find the localize string
 */
function bf_trans(str) {

    if (typeof str === 'string'
        && typeof buddyformsGlobal !== 'undefined'
        && typeof buddyformsGlobal.localize !== 'undefined'
        && typeof buddyformsGlobal.localize.bf_trans !== 'undefined'
    ) {
        const localize_str = Object.values(buddyformsGlobal.localize.bf_trans).find(function(elm) {
            return elm.msgid === str
        });

        return (typeof localize_str !== 'undefined') ? localize_str.msgstr : str;
    }

    return str;
}

//
// Lets do some stuff after the document is loaded
//
jQuery(document).ready(function (jQuery) {

    if (buddyformsGlobal) {
        //Fix to show the form editor and hide all unrelated meta-boxes it suppose to only apply in certain pages
        var currentScreen = buddyformsGlobal.current_screen || false;
        var isAdmin = buddyformsGlobal.is_admin || false;
        if (currentScreen && isAdmin) {
            if (
                currentScreen.id === 'edit-buddyforms' || currentScreen.id === 'buddyforms' ||
                currentScreen.id === 'buddyforms_page_buddyforms_submissions' || currentScreen.id === 'buddyforms_page_buddyforms_settings' ||
                currentScreen.id === 'buddyforms_page_bf_add_ons'
            ) {
                var post = jQuery('#post');
                jQuery('#wpbody-content').html('<div class="wrap"></div>');
                jQuery('#wpbody-content .wrap').html(post);

                jQuery(window).scrollTop(0);

                // Hide all post box metaboxes except the buddyforms meta boxes
                jQuery('div .postbox').not('.buddyforms-metabox').hide();

                // Show the submit metabox
                jQuery('#submitdiv').show();
                post.removeClass('hidden');
            }
        }
    }


    // Add Select2 Support
    var adminSelect2 = jQuery(".bf-select2");
    if (adminSelect2.length > 0) {
        buddyforms_load_select2(adminSelect2);
    }

    // Prevent form submission if enter key is pressed on text fields
    jQuery(document).on('keyup keypress', 'form input[type="text"]', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            return false;
        }
    });

    /**
     * Click on the button to preview a form type from the demo site
     * @since 2.4.0
     */
    jQuery(document.body).on('click', '.bf-preview', function () {
        var key = jQuery(this).attr('data-key');
        var src = jQuery(this).attr('data-src');
        var iFrame = jQuery('#iframe-' + key);
        if (iFrame.length > 0) {
            iFrame.attr('src', src);
        }
    });

    /**
     * Add Sortable to radiobutton, checkbox, dropdown and gdpr
     *
     * @since 2.4.1
     */
    var sortableTable = jQuery('table.wp-list-table.element_field_table_sortable');
    if (sortableTable && sortableTable.length > 0) {
        sortableTable.sortable({
            items: "tr.field_item"
        });
    }

    // Mail Notifications from email display only if selected
    jQuery(document.body).on('change', '.bf_mail_from_name_multi_checkbox input', function () {

        var val = jQuery(this).val();

        if (val === 'custom') {
            jQuery(this).closest('.wp-list-table').find('.mail_from_name_custom').removeClass('hidden');
        } else {
            jQuery(this).closest('.wp-list-table').find('.mail_from_name_custom').addClass('hidden');
        }

    });

    // Mail Notifications from email display only if selected
    jQuery(document.body).on('change', '.bf_mail_from_multi_checkbox input', function () {

        var val = jQuery(this).val();

        if (val === 'custom') {
            jQuery(this).closest('.wp-list-table').find('.mail_from_custom').removeClass('hidden');
        } else {
            jQuery(this).closest('.wp-list-table').find('.mail_from_custom').addClass('hidden');
        }

    });

    // Mail Notifications sent to display only if selected
    jQuery(document.body).on('change', '.bf_sent_mail_to_multi_checkbox input', function () {

        var val = jQuery(this).val();

        if (jQuery(this).is(':checked')) {
            jQuery(this).closest('.wp-list-table').find('.mail_to_' + val + '_address').removeClass('hidden').prop('required', true);
        } else {
            jQuery(this).closest('.wp-list-table').find('.mail_to_' + val + '_address').addClass('hidden').prop('required', false);
        }

    });

    // Validate the form before publish
    jQuery('#publish').click(function () {

        var post_title = jQuery('[name="post_title"]');


        if (post_title.val() === '') {
            post_title.removeClass('bf-ok');
            post_title.addClass('bf-error');
            bfErrors.push({isValid: false, element: post_title, type: 'title'});
        } else {
            post_title.removeClass('bf-error');
            post_title.addClass('bf-ok');
        }


        //Validate emails notifications
        var mail_to_cc_addresses = jQuery('input[name^="buddyforms_options[mail_submissions]"][name$="[mail_to_cc_address]"]');
        jQuery.each(mail_to_cc_addresses, function (index, mail_to_cc_address) {
            var result = buddyforms_validate_notifications_email(mail_to_cc_address);
            bfErrors.push({isValid: result, element: mail_to_cc_address, type: 'settings'});
        });

        var mail_to_bcc_addresses = jQuery('input[name^="buddyforms_options[mail_submissions]"][name$="[mail_to_bcc_address]"]');
        jQuery.each(mail_to_bcc_addresses, function (index, mail_to_bcc_address) {
            var result = buddyforms_validate_notifications_email(mail_to_bcc_address);
            bfErrors.push({isValid: result, element: mail_to_bcc_address, type: 'settings'});
        });

        var mail_to_addresses = jQuery('input[name^="buddyforms_options[mail_submissions]"][name$="[mail_to_address]"]');
        jQuery.each(mail_to_addresses, function (index, mail_to_address) {
            var result = buddyforms_validate_notifications_email(mail_to_address);
            bfErrors.push({isValid: result, element: mail_to_address, type: 'settings'});
        });

        var mail_from = jQuery('input[name^="buddyforms_options[mail_submissions]"][name$="[mail_from_custom]"]');
        if (mail_from.length > 0) {
            var result = buddyforms_validate_notifications_email(mail_from);
            bfErrors.push({isValid: result, element: mail_from, type: 'settings'});
        }

        //Fill and avoid duplicates of field slugs
        buddyformAutoFillEmptyOrDuplicateSlugs();

        // traverse all the required elements looking for an empty one
        jQuery("#post input[required]").each(function () {
            // if the value is empty, that means that is invalid
            var isValid = (jQuery(this).val() != "");

            if (isValid) {
                jQuery(this).removeClass("bf-error");
                var element_name = jQuery(this).eq(0).attr('name');
                bfErrors = bfErrors.filter(function (obj) {
                    return obj.field_name !== element_name;
                });


            } else {
                var element_name = jQuery(this).eq(0).attr('name');
                bfErrors.push({isValid: isValid, element: jQuery(this)[0], type: 'accordion', field_name: element_name});
                jQuery(this).addClass("bf-error");
                return false;
            }
        });
        var validation_result = buddyforms_process_errors(bfErrors);

        return validation_result;

    });

    /**
     *
     * @since 2.5.26
     */
    jQuery(document).on('click', 'button#btn-compile-custom', function (event) {
        event.preventDefault();
        jQuery('#buddyforms_template_header_container').show('slow').css('display', 'flex');
        jQuery('#formbuilder-action-templates').show('slow');
        jQuery('#buddyforms_template_list_container').hide('fast');
    });

    /**
     *
     * @since 2.5.26
     */
    jQuery(document).on('click', '#formbuilder-show-templates', function () {
        jQuery('#buddyforms_template_header_container').hide('fast');
        jQuery('#buddyforms_template_list_container').show('slow');
        jQuery('#formbuilder-show-templates').hide();
    });

    //
    // Remove form element form the form builder
    //
    jQuery(document).on('click', '.bf_delete_field', function () {

        var del_id = jQuery(this).attr('id');
        var delete_str = bf_trans('Delete Permanently');

        if (confirm(delete_str))
            jQuery("#field_" + del_id).remove();

        return false;
    });

    //
    // Delete mail notification trigger
    //
    jQuery(document).on('click', '.bf_delete_trigger', function () {
        var del_id = jQuery(this).attr('id');
        var delete_str = bf_trans('Delete Permanently');

        if (confirm(delete_str)) {
            jQuery("#trigger" + del_id).remove();
            jQuery(".trigger" + del_id).remove();
        }
        return false;
    });

    //
    // Add new options to select, checkbox form element. The js will ad one more line for value and label
    //
    jQuery(document).on('click', '.bf_add_gdpr', function () {

        if (buddyformsGlobal) {
            var action = jQuery(this);
            var gdpr_type = jQuery(this).attr('data-gdpr-type');

            var numItems = jQuery('#table_row_' + gdpr_type + '_select_options table.element_field_table_sortable tbody tr').size();

            var type = jQuery('#gdpr_option_type').val();

            var message = '';
            if (buddyformsGlobal.admin_text[type]) {
                message = buddyformsGlobal.admin_text[type]
            }

            var error_message = '';
            if (buddyformsGlobal.admin_text['error_message']) {
                error_message = buddyformsGlobal.admin_text['error_message']
            }

            numItems = numItems + 1;
            jQuery('#table_row_' + gdpr_type + '_select_options table.element_field_table_sortable tbody').append(
                '<tr class="field_item field_item_' + gdpr_type + '_' + numItems + '">' +
                '<td><div class="dashicons dashicons-image-flip-vertical"></div></td>' +
                '<td>' +
                '<p><b>Agreement Text</b></p>' +
                '<textarea rows="3" name="buddyforms_options[form_fields][' + gdpr_type + '][options][' + numItems + '][label]" cols="50">' + message + '</textarea>' +
                '<p><b>Error Message</b></p>' +
                '<textarea rows="3" name="buddyforms_options[form_fields][' + gdpr_type + '][options][' + numItems + '][error_message]" cols="50">' + error_message + '</textarea>' +
                '</td>' +
                '<td class="manage-column column-author">' +
                '<div class="checkbox">' +
                '   <label class="">' +
                '       <input type="checkbox" name="buddyforms_options[form_fields][' + gdpr_type + '][options][' + numItems + '][checked][]" value="checked"><span>Checked</span>' +
                '   </label>' +
                '</div>' +
                '<div class="checkbox">' +
                '   <label class="">' +
                '       <input type="checkbox" name="buddyforms_options[form_fields][' + gdpr_type + '][options][' + numItems + '][required][]" value="required"><span>Required</span>' +
                '   </label>' +
                '</div>' +
                '</td>' +
                '<td class="manage-column column-author">' +
                '<a href="#" id="' + gdpr_type + '_' + numItems + '" class="bf_delete_input">Delete</a>' +
                '</td>' +
                '</tr>');
            return false;
        }
    });

    /**
     * Reset option for multiple choice fields radio and checkboxes for backend
     *
     * @since 2.4.1
     */
    jQuery(document.body).on('click', '.button.bf_reset_multi_input', function (event) {
        event.preventDefault();
        var groupName = jQuery(this).attr('data-group-name');
        var fieldId = jQuery(this).attr('data-field-id');
        jQuery('input[name="buddyforms_options[form_fields][' + fieldId + '][default]"][value="' + groupName + '"]').attr('checked', false);
        return false;
    });

    /**
     * Add new options to gdpr, checkbox form element. The js will add one more line for value and label
     *
     * @since 2.4.1
     */
    jQuery(document).on('click', '.bf_add_input', function () {
        var action = jQuery(this);
        var args = action.attr('href').split("/");
        var numItems = jQuery('#table_row_' + args[0] + '_select_options table.element_field_table_sortable tbody tr').size();

        numItems = numItems + 1;
        jQuery('#table_row_' + args[0] + '_select_options table.element_field_table_sortable tbody').append(
            '<tr class="field_item field_item_' + args[0] + '_' + numItems + '">' +
            '<td><div class="dashicons dashicons-image-flip-vertical"></div></td>' +
            '<td><input class="field-sortable" required="required" type="text" name="buddyforms_options[form_fields][' + args[0] + '][options][' + numItems + '][label]"></td>' +
            '<td><input class="field-sortable" required="required" type="text" name="buddyforms_options[form_fields][' + args[0] + '][options][' + numItems + '][value]"></td>' +
            '<td class="manage-column column-default"><p>Save the Form</p></td>' +
            '<td class="manage-column column-default"><a href="#" id="' + args[0] + '_' + numItems + '" class="bf_delete_input">Delete</a></td>' +
            '</tr>');
        return false;
    });

    //
    // Remove an option from a select or checkbox
    //
    jQuery(document).on('click', '.bf_delete_input', function () {
        var del_id = jQuery(this).attr('id');
        var delete_str = bf_trans('Delete Permanently');

        if (confirm(delete_str))
            jQuery(".field_item_" + del_id).remove();
        return false;
    });

    bf_update_list_item_number();

    jQuery(document).on('mousedown', '.bf_list_item', function () {
        itemList = jQuery(this).closest('.sortable').sortable({
            update: function (event, ui) {
                bf_update_list_item_number();
            }
        });
    });

    bf_update_list_item_number_mail();

     //
    // Trigger the email test notification
    //
	jQuery(document).on('click', '.bf_test_trigger:not(disabled)', function(e) {
		e.preventDefault();
		e.stopPropagation();
		var test_id = jQuery(this).attr('id');
		var actionLink = jQuery(this);
		actionLink.attr('disabled', true);
		actionLink.text('Sending...');
		jQuery.ajax({
			type: 'POST',
			dataType: 'json',
			// contentType: 'application/x-www-form-urlencoded; utf-8',
			url: buddyformsGlobal.admin_url,
			data: {
				'action': 'buddyforms_test_email',
				'notification_id': test_id,
				'form_slug': actionLink.attr('data-form-slug'),
				'nonce': buddyformsGlobal.ajaxnonce,
			},
			success: function(data) {
				alert(data);
			},
			error: function(request) {
				alert(request.responseText);
			},
			complete: function(){
				actionLink.removeAttr('disabled');
				actionLink.text('Test');
			}
		});

		return false;
	});

    //
    // Add notification inside the wizard
    //
    jQuery(document).on('click', '#mail_notification_add_new', function () {
        if (buddyformsGlobal) {
            jQuery.ajax({
                type: 'POST',
                dataType: "json",
                url: buddyformsGlobal.admin_url,
                data: {
                    "action": "buddyforms_new_mail_notification",
                    'form_slug': jQuery(this).attr('data-form-slug'),
					'nonce': buddyformsGlobal.ajaxnonce,
                },
                success: function (data) {
                    //console.log(data);

                    jQuery('#no-trigger-mailcontainer').hide();
                    jQuery('#mailcontainer').append(data['html']);

                    tinymce.execCommand('mceRemoveEditor', false, 'bf_mail_body' + data['trigger_id']);
                    tinymce.execCommand('mceAddEditor', false, 'bf_mail_body' + data['trigger_id']);

                    bf_update_list_item_number_mail();

                    jQuery(document.body).trigger({type: "buddyform:load_notifications"});
                }
            });
        }
        return false;
    });

    //
    // Add new mail notification
    //
    jQuery(document).on('click', '#post_status_mail_notification_add_new', function () {
        var error = false;
        var trigger = jQuery('.post_status_mail_notification_trigger select').val();

        if (!trigger) {
            return false;
        }

        if (trigger === 'none') {
            bf_alert('You have to select a trigger first.');
            return false;
        }

        // traverse all the required elements looking for an empty one
        jQuery("#post-status-mail-container li.bf_trigger_list_item").each(function () {
            if (jQuery(this).attr('id') == 'trigger' + trigger) {
                bf_alert('Trigger already exists');
                error = true;
            }
        });

        if (error == true)
            return false;
        if (buddyformsGlobal) {
            jQuery.ajax({
                type: 'POST',
                url: buddyformsGlobal.admin_url,
                data: {
                    "action": "buddyforms_new_post_status_mail_notification",
                    'form_slug': jQuery(this).attr('data-form-slug'),
					'nonce': buddyformsGlobal.ajaxnonce,
                    "trigger": trigger
                },
                success: function (data) {
                    if (data == 0) {
                        bf_alert('trigger already exists');
                        return false;
                    }
                    jQuery('#no-trigger-post-status-mail-container').hide();
                    jQuery('#post-status-mail-container').append(data);

                    tinymce.execCommand('mceRemoveEditor', false, 'bf_mail_body');
                    tinymce.execCommand('mceAddEditor', false, 'bf_mail_body');

                    bf_update_list_item_number_mail();

                    jQuery(document.body).trigger({type: "buddyform:load_notifications"});
                }
            });
        }
        return false;
    });

    //
    // Permissions Section - select all roles and caps
    //
    jQuery(document).on('click', '.bf_check_all', function (e) {

        if (buddyformsGlobal) {

                jQuery('.bf_permissions :checkbox').not("[disabled]").prop('checked', true);
                jQuery(this).removeClass();
                jQuery(this).addClass("bf_uncheck_all");
                jQuery(this).text(buddyformsGlobal.admin_text.uncheck);
        }
        e.preventDefault();
    });
    jQuery(document).on('click', '.bf_uncheck_all', function (e) {

        if (buddyformsGlobal) {

                jQuery('.bf_permissions :checkbox').not("[disabled]").prop('checked', false);
                jQuery(this).removeClass();
                jQuery(this).addClass("bf_check_all");
                jQuery(this).text(buddyformsGlobal.admin_text.check);

        }
        e.preventDefault();
    });

    jQuery(document).on('click', '.bf_check', function (e) {
        if (buddyformsGlobal) {
            if (jQuery(".bf_permissions input[type='checkbox']").prop("checked")) {
                jQuery(this).text(buddyformsGlobal.admin_text.check);
            } else {
                jQuery(this).text(buddyformsGlobal.admin_text.uncheck);
            }
        }
        e.preventDefault();
    });


    jQuery('.bf_check').trigger('click');
    //
    // #bf-create-page-modal


    //
    // At last let as remove elements added by other plugins we could not remove with the default functions.
    //

    // Remove all Visual Composer elements form BuddyForms View
    jQuery('*[class^="vc_"]').remove();

    //
    // Layout Meta-box related functions
    //
    if (buddyformsGlobal && buddyformsGlobal.post_type === 'buddyforms') {
        jQuery(document).on('click', '#bf_load_layout_options', function () {
            jQuery('.layout-spinner').addClass('is-active').show();
            var form_slug = jQuery('#bf_form_layout_select').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: buddyformsGlobal.admin_url,
                data: {
                    'action': 'buddyforms_load_form_layout',
                    'form_slug': form_slug
                },
                success: function (data) {
                    update_layout_options_screen(data);
                }
            });
            return false;
        });

        jQuery(document).on('click', '#bf_reset_layout_options', function (event) {
            jQuery('.layout-spinner-reset').addClass('is-active').show();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: buddyformsGlobal.admin_url,
                data: {
                    'action': 'buddyforms_load_form_layout',
                    'form_slug': 'reset'
                },
                success: function (data) {
                    update_layout_options_screen(data);
                }
            });
            return false;
        });

        function update_layout_options_screen(data) {
            jQuery('.layout-spinner').removeClass('is-active').hide();
            var layout_container = jQuery('#buddyforms_form_designer');
            if (layout_container.length > 0) {
                jQuery.each(data, function (key, val) {
                    var item = jQuery(layout_container).find('input[name^="buddyforms_options[layout]"][name*="' + key + '"]');
                    var itemColor = jQuery('input[name^="buddyforms_options[layout]"][name*="' + key + '"][name$="[color]"]');
                    var itemStyle = jQuery('input[name^="buddyforms_options[layout]"][name*="' + key + '"][name$="[style]"][value="' + val.style + '"]');
                    var type;
                    if (item || itemColor || itemStyle) {
                        type = item.attr('type');
                        if ((typeof type === 'undefined' || !type) && itemColor.length > 0) {
                            type = itemColor.attr('type');
                        }
                    }

                    if ('custom_css' === key) {
                        jQuery('#' + key).text(val);
                    }

                    if (item.length > 0 && type) {
                        switch (type) {
                            case 'text':
                            case 'number':
                                item.val(val || '');
                                break;
                            case 'radio':
                                jQuery('input[name^="buddyforms_options[layout]"][name*="' + key + '"][value="' + val + '"]').prop('checked', true).trigger('change');
                                break;
                            case 'checkbox':
                                var currentItem = jQuery('input[name^="buddyforms_options[layout]"][name*="' + key + '"]');
                                currentItem.prop('checked', (val && currentItem.val() === val)).trigger('change');
                                break;
                        }
                    }

                    if (itemColor.length > 0) {
                        itemColor.val(val && val.color || '').trigger('change');
                    }

                    if (itemStyle.length > 0) {
                        itemStyle.prop('checked', val && val.style).trigger('change');
                    }
                });
            }
        }
    }

    jQuery(document).on('change', 'select.captcha-version', function (e) {
        var selectedVersion = jQuery(this).val();
        if(selectedVersion === 'v3') {
            jQuery('tr[id$="_captcha_v3_action"]').show();
            jQuery('tr[id$="_captcha_v3_score"]').show();
            jQuery('.bf_hide_captcha_v2_options').show();
        } else {
            jQuery('tr[id$="_captcha_v3_action"]').hide();
            jQuery('tr[id$="_captcha_v3_score"]').hide();
            jQuery('.bf_hide_captcha_v2_options').hide();
        }
    });

    jQuery(document).on('click', '.bf-ready-to-copy', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var currentElement = jQuery(this);
        if (currentElement.is('input')) {
            buddyformsCopyStringToClipboard(currentElement.val());
        } else {
            var parentHeader = jQuery(this).closest('.accordion-heading-options');
            var accordionBody = parentHeader.parent().find('.accordion-body');
            accordionBody.removeClass('ui-accordion-content-active').hide();
            buddyformsCopyStringToClipboard(currentElement.text());
            accordionBody.addClass('ui-accordion-content-active');
        }
        return false;
    });

});
