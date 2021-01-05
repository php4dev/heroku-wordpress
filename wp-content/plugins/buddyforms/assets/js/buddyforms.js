/**
 * Frontend Hooks object
 *
 * This object needs to be declared early so that it can be used in code.
 * Preferably at a global scope.
 */
var BuddyFormsHooks = BuddyFormsHooks || {};

BuddyFormsHooks.actions = BuddyFormsHooks.actions || {};
BuddyFormsHooks.filters = BuddyFormsHooks.filters || {};

/**
 * Add a new Action callback to BuddyFormsHooks.actions
 *
 * @param tag The tag specified by do_action()
 * @param callback The callback function to call when do_action() is called
 * @param priority The order in which to call the callbacks. Default: 10 (like WordPress)
 */
BuddyFormsHooks.addAction = function (tag, callback, priority) {
    if (typeof priority === "undefined") {
        priority = 10;
    }
    // If the tag doesn't exist, create it.
    BuddyFormsHooks.actions[tag] = BuddyFormsHooks.actions[tag] || [];
    BuddyFormsHooks.actions[tag].push({priority: priority, callback: callback});
};

/**
 * Add a new Filter callback to BuddyFormsHooks.filters
 *
 * @param tag The tag specified by apply_filters()
 * @param callback The callback function to call when apply_filters() is called
 * @param priority Priority of filter to apply. Default: 10 (like WordPress)
 */
BuddyFormsHooks.addFilter = function (tag, callback, priority) {
    if (typeof priority === "undefined") {
        priority = 10;
    }
    // If the tag doesn't exist, create it.
    BuddyFormsHooks.filters[tag] = BuddyFormsHooks.filters[tag] || [];
    BuddyFormsHooks.filters[tag].push({priority: priority, callback: callback});
};

/**
 * Remove an Action callback from BuddyFormsHooks.actions
 *
 * Must be the exact same callback signature.
 * Warning: Anonymous functions can not be removed.
 * @param tag The tag specified by do_action()
 * @param callback The callback function to remove
 */
BuddyFormsHooks.removeAction = function (tag, callback) {
    BuddyFormsHooks.actions[tag] = BuddyFormsHooks.actions[tag] || [];
    BuddyFormsHooks.actions[tag].forEach(function (filter, i) {
        var originCall = filter.callback.name;
        var call = callback.toString();
        if (originCall == call) {
            BuddyFormsHooks.actions[tag].splice(i, 1);
        }
    });
};

/**
 * Remove a Filter callback from BuddyFormsHooks.filters
 *
 * Must be the exact same callback signature.
 * Warning: Anonymous functions can not be removed.
 * @param tag The tag specified by apply_filters()
 * @param callback The callback function to remove
 */
BuddyFormsHooks.removeFilter = function (tag, callback) {
    BuddyFormsHooks.filters[tag] = BuddyFormsHooks.filters[tag] || [];
    BuddyFormsHooks.filters[tag].forEach(function (filter, i) {
        if (filter.callback === callback) {
            BuddyFormsHooks.filters[tag].splice(i, 1);
        }
    });
};

/**
 * Calls actions that are stored in BuddyFormsHooks.actions for a specific tag or nothing
 * if there are no actions to call.
 *
 * @param tag A registered tag in Hook.actions
 * @param options Optional JavaScript object to pass to the callbacks
 */
BuddyFormsHooks.doAction = function (tag, options) {
    var actions = [];
    if (typeof BuddyFormsHooks.actions[tag] !== "undefined" && BuddyFormsHooks.actions[tag].length > 0) {
        BuddyFormsHooks.actions[tag].forEach(function (hook) {
            actions[hook.priority] = actions[hook.priority] || [];
            actions[hook.priority].push(hook.callback);
        });

        actions.forEach(function (BuddyFormsHooks) {
            BuddyFormsHooks.forEach(function (callback) {
                callback(options);
            });
        });
    }
};

/**
 * Calls filters that are stored in BuddyFormsHooks.filters for a specific tag or return
 * original value if no filters exist.
 *
 * @param tag A registered tag in Hook.filters
 * @param value The value
 * @param options Optional JavaScript object to pass to the callbacks
 * @options
 */
BuddyFormsHooks.applyFilters = function (tag, value, options) {
    var filters = [];
    if (typeof BuddyFormsHooks.filters[tag] !== "undefined" && BuddyFormsHooks.filters[tag].length > 0) {
        BuddyFormsHooks.filters[tag].forEach(function (hook) {
            filters[hook.priority] = filters[hook.priority] || [];
            filters[hook.priority].push(hook.callback);
        });
        filters.forEach(function (BuddyFormsBuilderHook) {
            BuddyFormsBuilderHook.forEach(function (callback) {
                value = callback(value, options);
            });
        });
    }
    return value;
};

/**
 * Frontend Hooks object End
 */

function bf_form_errors() {
    var errors = jQuery('.bf-alert-wrap ul li span');
    jQuery.each(errors, function (i, error) {
        var field_id = jQuery(error).attr('data-field-id');
        // console.log(field_id);
        if (field_id === 'user_pass') {
            jQuery('#' + field_id + '2').addClass('error');
        }
        jQuery('#' + field_id).addClass('error');
    });
}

/**
 * Get a field if it exist into the form, searching by type(default) or a provided key
 *
 * @since 2.4.0
 *
 * @param formSlug
 * @param search
 * @param fieldTargetKey
 * @returns {boolean|object}
 */
function getFieldDataBy(formSlug, search, fieldTargetKey) {
    if (buddyformsGlobal && buddyformsGlobal[formSlug]) {
        fieldTargetKey = fieldTargetKey || 'type';
        var fields = buddyformsGlobal[formSlug].form_fields;
        var result = jQuery.map(fields, function (element, key) {
            if (element[fieldTargetKey] === search) {
                element.id = key;
                return element;
            }
        });
        if (result && result[0]) {
            return result[0];
        }
    }
    return false;
}

/**
 * Helper function to get $_GET parameter
 */
function bf_getUrlParameter(sParam) {
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
}

function BuddyForms() {
    var submissionModalContent;
    var submissionModal;

    /**
     * Reset option for multiple choice fields radio and checkboxes
     */
    function resetInputMultiplesChoices(event) {
        event.preventDefault();
        var group_name = jQuery(this).attr('data-group-name');
        jQuery('input[name="' + group_name + '"]').attr('checked', false);
        return false;
    }

    /**
     * Special password redirects after registration
     * If a redirect url is added to the register page url we use this redirect and add it as hidden field to the form
     *
     * @param redirect
     */
    function specialPasswordRedirectAfterRegistration(redirect) {
        if (redirect) {
            jQuery('#submitted').append('<input type="hidden" name="bf_pw_redirect_url" value="' + redirect + '" />');
        }
    }

    function checkPasswordStrengthInternal(password1, blacklist, password2) {
        if (!jQuery.isArray(blacklist))
            blacklist = [blacklist.toString()];

        if (password1 != password2 && password2 && password2.length > 0)
            return 5;

        if ('undefined' === typeof window.zxcvbn) {
            // Password strength unknown.
            return -1;
        }

        return zxcvbn(password1, blacklist);
    }

    /**
     * Binding to trigger checkPasswordStrength
     */
    function checkPasswordStrength() {
        if (buddyformsGlobal) {
            var formSlug = getFormSlugFromFormElement(this);
            var context = '#buddyforms_form_' + formSlug;
            var pass1 = jQuery('input[name=buddyforms_user_pass]', context).val();
            var pass2 = jQuery('input[name=buddyforms_user_pass_confirm]', context).val();
            var strengthResult = jQuery('#password-strength', context);
            var blacklistArray = ['black', 'listed', 'word'];
            var passwordHint = jQuery('.buddyforms-password-hint', context);

            // Reset the form & meter
            BuddyFormsHooks.doAction('buddyforms:submit:disable', formSlug);

            strengthResult.removeClass('short bad good strong');

            // Extend our blacklist array with those from the inputs & site data
            blacklistArray = blacklistArray.concat(wp.passwordStrength.userInputBlacklist());

            // Get the password strength
            var strength = checkPasswordStrengthInternal(pass1, blacklistArray, pass2);

            var hint_html = '<small class="buddyforms-password-hint">';
            if (strength && strength.feedback) {
                if (strength.feedback.warning) {
                    hint_html += bf_trans('Warning: ') + bf_trans(strength.feedback.warning) + '<br/>';
                }
                if (strength.feedback.suggestions && strength.feedback.suggestions.length > 0) {
                    hint_html += bf_trans('Suggestions: ') + strength.feedback.suggestions.reduce(function(acc, cur){
                        return  acc + bf_trans(cur) + '<br/>';
                    }, '');
                }
            }
            hint_html += '</small>';
            passwordHint.remove();
            strengthResult.html('');
            switch (strength.score) {
                case 0:
                case 1:
                    strengthResult.addClass('short').html(buddyformsGlobal.pwsL10n.short);
                    break;
                case 2:
                    strengthResult.addClass('bad').html(buddyformsGlobal.pwsL10n.bad);
                    break;

                case 3:
                    strengthResult.addClass('good').html(buddyformsGlobal.pwsL10n.good);
                    break;

                case 4:
                    strengthResult.addClass('strong').html(buddyformsGlobal.pwsL10n.strong);
                    break;

                case 5:
                    strengthResult.addClass('short').html(buddyformsGlobal.pwsL10n.mismatch);
                    break;

                default:
                    strengthResult.addClass('short').html(buddyformsGlobal.pwsL10n.short);

            }

            // The meter function returns a result even if pass2 is empty,
            // enable only the submit button if the password is strong and
            // both passwords are filled up
            if (buddyformsGlobal.pwsL10n.required_strength <= strength.score && strength.score !== 5 && '' !== pass2.trim()) {
                BuddyFormsHooks.doAction('buddyforms:submit:enable', formSlug);
                strengthResult.after(hint_html);
            } else {
                var fieldData = getFieldFromSlug('user_pass', formSlug);
                if (fieldData && fieldData['required']) {
                    strengthResult.after(hint_html);
                } else {
                    //If The field is not required  and the value is emprty don´t valdiate.
                    if (pass1.trim() === "" && pass2.trim() === "") {
                        strengthResult.removeClass('short bad good strong');
                        BuddyFormsHooks.doAction('buddyforms:submit:enable', formSlug);
                    } else {
                        strengthResult.after(hint_html);
                    }
                }
            }

            return strength.score;
        }
        return '';
    }

    function bf_delete_post() {
        var post_id = jQuery(this).attr('id');
        var action_str_delete = bf_trans('Delete Permanently');

        action_str_delete = BuddyFormsHooks.applyFilters('buddyforms_global_delete_text', action_str_delete, [post_id]);

        if (confirm(action_str_delete)) {
            jQuery.ajax({
                type: 'POST',
                url: buddyformsGlobal.admin_url,
                data: {"action": "buddyforms_ajax_delete_post", "post_id": post_id},
                success: function (data) {
                    if (isNaN(data)) {
                        alert(data);
                    } else {
                        // var id = "#bf_post_li_";
                        // var li = id + data;
                        // li = li.replace(/\s+/g, '');
                        // jQuery(li).remove();
                        location.reload();
                    }
                },
                error: function (request) {
                    alert(request.responseText);
                }
            });
        } else {
            return false;
        }
        return false;
    }

    function openSubmissionModal() {
        var bf_submission_modal_content = fncBuddyForms.getSubmissionModalContent();
        if (bf_submission_modal_content && bf_submission_modal_content.length > 0) {
            var targetId = jQuery(this).attr('data-id');
            var target = jQuery("#bf-submission-modal_" + targetId);
            fncBuddyForms.submissionModal(target);
            jQuery('.buddyforms-posts-container').html(target);
            jQuery("#bf-submission-modal_" + targetId + " :input").attr("disabled", true);
            target.show();
        }
        return false;
    }

    function closeSubmissionModal() {
        var bf_submission_modal_content = fncBuddyForms.getSubmissionModalContent();
        if (bf_submission_modal_content && bf_submission_modal_content.length > 0) {
            var targetId = jQuery(this).attr('data-id');
            var submissionTarget = fncBuddyForms.getSubmissionModal();
            bf_submission_modal_content.find('.bf_posts_' + targetId).prepend(submissionTarget);
            jQuery('.buddyforms-posts-container').html(bf_submission_modal_content);
            jQuery("#bf-submission-modal_" + targetId).hide();
        }
        return false;
    }

    function createTaxItem() {
        var field_id = jQuery(this).attr('data-field_id');
        var field_slug = jQuery(this).attr('data-field_slug');
        var target = jQuery("#" + field_slug + "_create_new_tax_" + field_id);
        var newStateVal = target.val();

        // Set the value, creating a new option if necessary
        var createItemElement = jQuery("#category_create_new_tax");
        if (createItemElement && createItemElement.find("option[value='" + newStateVal + "']").length) {
            createItemElement.val(newStateVal).trigger("change");
        } else {
            // Create the DOM option that is pre-selected by default
            var newState = new Option(newStateVal, newStateVal, true, true);
            // Append it to the select
            jQuery("#" + field_id).append(newState).trigger('change');
            // CLear the text field
            target.val('');
        }
        return false;
    }

    /**
     * disable the ACF js navigate away pop up
     */
    function disableACFPopup() {
        if (typeof acf !== 'undefined') {
            acf.unload.active = false;
        }
    }

    function addValidationForUserWebsite() {
        jQuery.validator.addMethod("user-website", function (value, element) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            if(!value){
                return true;
            }

            var msjString = 'Please enter a valid URL.';
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (fieldData.validation_email_msj) {
                    msjString = fieldData.validation_email_msj;
                }
            }

            jQuery.validator.messages['bf-email'] = msjString;

            return /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
        }, "Please enter a valid URL.");// todo need il18n
    }

    function addValidationEmail() {
        jQuery.validator.addMethod("bf-email", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            var msjString = 'Enter a valid email.';
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (fieldData.validation_email_msj) {
                    msjString = fieldData.validation_email_msj;
                }
            }

            jQuery.validator.messages['bf-email'] = msjString;
            return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
        }, "");
    }

    function addValidationMinLength() {
        jQuery.validator.addMethod("minlength", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            var count = value.length;
            if (value === "") {
                return true;
            }

            var msjString = 'The minimum character length is %s. Please check.';
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (fieldData.validation_minlength_msj) {
                    msjString = fieldData.validation_minlength_msj;
                }
            }

            msjString = msjString.replace('%s', param);

            if (count < param) {
                jQuery.validator.messages['minlength'] = msjString;
                return false;
            }
            return true;
        }, "");
    }

    function addValidationMinValue() {
        jQuery.validator.addMethod("min-value", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            if (value === "") {
                return true;
            }

            var msjString = 'The minimum value allowed is: %s. Please check.';
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (fieldData.validation_min_msj) {
                    msjString = fieldData.validation_min_msj;
                }
            }

            msjString = msjString.replace('%s', param);

            if (value < param) {
                jQuery.validator.messages['min-value'] = msjString;
                return false;
            }
            return true;
        }, "");
    }

    function bfRequiredValidation(value, element, param) {
        var formSlug = getFormSlugFromFormElement(element);
        if (
            formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
            buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
        ) {
            return true;
        }
        var fieldSlug = jQuery(element).attr('name');
        var fieldData = getFieldFromSlug(fieldSlug, formSlug);
        fieldData = BuddyFormsHooks.applyFilters('buddyforms:validation:field:data', fieldData, [fieldSlug, formSlug, fieldData]);
        if (!fieldData) {//if not field data is not possible to validate it
            console.log('no data', element);
            return true;
        }

        var passValidationFieldTypes = ['upload', 'featured_image'];
        passValidationFieldTypes = BuddyFormsHooks.applyFilters('buddyforms:validation:pass', passValidationFieldTypes, [value, element, fieldData, formSlug]);

        if (passValidationFieldTypes && passValidationFieldTypes.length > 0) {
            var exist = jQuery.inArray(fieldData.type, passValidationFieldTypes);
            if (exist && exist >= 0) {
                return true;
            }
        }

        var result = false;
        var requiredMessage = fieldData.validation_error_message ? fieldData.validation_error_message : 'This field is required.'; //todo need il18n
        if (fieldData.type) {
            if (fieldData.type === 'gdpr') {
                requiredMessage = jQuery(element).attr('validation_error_message');
            }
        }

        switch (fieldData.type) {
            case 'post_formats':
                result = (value && (value !== 'Select a Post Format' || value !== 'Select a Post Format *' || value !== fieldData.name + ' *'));
                break;
            case 'taxonomy':
                result = (value && value !== "-1");
                break;
            default:
                result = value && value.length > 0;
        }

        result = BuddyFormsHooks.applyFilters('buddyforms:validation:required', result, [value, element, fieldData, formSlug]);
        requiredMessage = BuddyFormsHooks.applyFilters('buddyforms:validation:required:message', requiredMessage, [value, element, fieldData, formSlug]);

        jQuery.validator.messages['required'] = requiredMessage;

        return result;
    }

    function addValidationPhone() {
        jQuery.validator.addMethod("bf-tel", function (value, element, param) {

            $valid_phone_number = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/.test(value);
            if (value !== '' && !$valid_phone_number) {
                jQuery.validator.messages['bf-tel'] = "Invalid Phone Number";
                return false;
            }
            return true;

        }, "");
    }

    function addValidationMaxLength() {
        jQuery.validator.addMethod("maxlength", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            if (param === 0 || value === "") {
                return true;
            }

            var msjString = 'The maximum character length is %s. Please check.';
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (fieldData.validation_maxlength_msj) {
                    msjString = fieldData.validation_maxlength_msj;
                }
            }

            msjString = msjString.replace('%s', param);

            var count = value.length;
            if (count > param) {
                jQuery.validator.messages['maxlength'] = msjString;
                return false;
            }

            return true;
        }, "");
    }

    function addFeatureImageValidations() {
        jQuery.validator.addMethod("featured-image-required", function (value, element) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            var validation_error_message = jQuery(element).attr('validation_error_message');
            if (Dropzone) {
                var dropZoneId = jQuery(element).attr('name');
                var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                if (currentDropZone) {
                    var validation_result = currentDropZone.files.length > 0;
                    if (validation_result === false) {
                        jQuery.validator.messages['featured-image-required'] = validation_error_message;
                    }
                    return validation_result;
                }
            }
            return false;
        }, "");
        //Validation for error on upload fields
        var upload_error_validation_message = '';
        jQuery.validator.addMethod("featured-image-error", function (value, element) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            upload_error_validation_message = jQuery(element).attr('upload_error_validation_message');
            if (Dropzone) {
                var dropZoneId = jQuery(element).attr('name');
                var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                if (currentDropZone) {

                    for (var i = 0; i < currentDropZone.files.length; i++) {
                        var validation_result = currentDropZone.files[i].status === Dropzone.ERROR;
                        if (validation_result === true) {
                            jQuery.validator.messages['featured-image-error'] = upload_error_validation_message;
                            return false;
                        }
                    }

                    return true;
                }
            }
            return false;
        }, '');
    }

    function addUploadFieldValidations() {
        jQuery.validator.addMethod("upload-ensure-amount", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            if (Dropzone) {
                var dropZoneId = jQuery(element).attr('name');
                var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                if (currentDropZone) {
                    var validation_result = currentDropZone.files.length == param;
                    if (validation_result === false) {
                        jQuery.validator.messages['upload-ensure-amount'] = 'This field must have : ' + param + ' files';
                    }
                    return validation_result;

                }
            }
            return false;
        }, "");
        jQuery.validator.addMethod("upload-required", function (value, element) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            if (Dropzone) {
                var dropZoneId = jQuery(element).attr('name');
                var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                if (currentDropZone) {
                    return currentDropZone.files.length > 0;
                }
            }
            return false;
        }, "This field is required.");
        var multiple_files_validation_message = '';
        jQuery.validator.addMethod("upload-max-exceeded", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            multiple_files_validation_message = jQuery(element).attr('multiple_files_validation_message');
            if (Dropzone) {
                var dropZoneId = jQuery(element).attr('name');
                var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                if (currentDropZone) {
                    var validation_result = param >= currentDropZone.files.length;
                    if (validation_result === false) {
                        jQuery.validator.messages['upload-max-exceeded'] = multiple_files_validation_message;
                    }
                    return validation_result;
                }
            }
            return false;
        }, '');
        jQuery.validator.addMethod("upload-group", function (value, element) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            var $fields = jQuery('.upload_field_input', element.form),
                $fieldsFirst = $fields.eq(0),
                validator = $fieldsFirst.data("valid_req_grp") ? $fieldsFirst.data("valid_req_grp") : jQuery.extend({}, this),
                result = $fields.filter(function (key) {
                    var dropZoneId = jQuery(this).attr('name');
                    var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                    if (currentDropZone.files.length > 0) {
                        return currentDropZone.files.filter(function (file) {
                            return file.status !== Dropzone.SUCCESS;
                        });
                    } else {
                        return true;
                    }
                });
            var isValid = true;
            if (jQuery.isArray(result)) {
                isValid = result.length === 0;
            }

            // Store the cloned validator for future validation
            $fieldsFirst.data("valid_req_grp", validator);

            // If element isn't being validated, run each require_from_group field's validation rules
            if (!jQuery(element).data("being_validated")) {
                $fields.data("being_validated", true);
                $fields.each(function () {
                    validator.element(this);
                });
                $fields.data("being_validated", false);
            }
            return isValid;
        }, '');

        //Validation for error on upload fields
        var upload_error_validation_message = '';
        jQuery.validator.addMethod("upload-error", function (value, element) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            upload_error_validation_message = jQuery(element).attr('upload_error_validation_message');
            if (Dropzone) {
                var dropZoneId = jQuery(element).attr('name');
                var currentDropZone = jQuery('#' + dropZoneId)[0].dropzone;
                if (currentDropZone) {

                    for (var i = 0; i < currentDropZone.files.length; i++) {
                        var validation_result = currentDropZone.files[i].status === Dropzone.ERROR;
                        if (validation_result === true) {
                            jQuery.validator.messages['upload-error'] = upload_error_validation_message;
                            return false;
                        }
                    }

                    return true;
                }
            }
            return false;
        }, '');
    }

    function addValidationMaxValue() {
        jQuery.validator.addMethod("max-value", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }

            if (param === 0 || value === "") {
                return true;
            }

            var msjString = 'The maximum value allowed is: %s. Please check.';
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (fieldData.validation_max_msj) {
                    msjString = fieldData.validation_max_msj;
                }
            }

            msjString = msjString.replace('%s', param);

            if (value > param) {
                jQuery.validator.messages['max-value'] = msjString;
                return false;
            }

            return true;
        }, "");
    }

    function addDateFormatValidation() {
        jQuery.validator.addMethod("date-validation", function (value, element, param) {
            var formSlug = getFormSlugFromFormElement(element);
            if (
                formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation &&
                buddyformsGlobal[formSlug].js_validation[0] === 'disabled'
            ) {
                return true;
            }
            var currentFieldSlug = jQuery(element).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (!fieldData) {
                    return true;
                }
                //If the field is not required and is empty validate as true
                if (typeof fieldData['required'] === "undefined" && !value) {
                    return true;
                }

                var msjString = 'Invalid Format';
                var fieldDateFormat = (fieldData && fieldData.element_date_format) ? fieldData.element_date_format : 'dd/mm/yy';
                var enableTime = (fieldData && fieldData.enable_time && fieldData.enable_time[0] && fieldData.enable_time[0] === 'enable_time');
                fieldDateFormat = dateFormat.convert(fieldDateFormat, dateFormat.datepicker, dateFormat.momentJs);
                var newFormat = fieldDateFormat;
                if (enableTime) {
                    var fieldTimeFormat = (fieldData && fieldData.element_time_format) ? fieldData.element_time_format : 'hh:mm tt';
                    fieldTimeFormat = dateFormat.convert(fieldTimeFormat, dateFormat.timepicker, dateFormat.momentJs);
                    newFormat += ' ' + fieldTimeFormat;
                }
                //Convert year to year moment format
                var momentFnc = moment(value, newFormat, true);
                var isValid = momentFnc.isValid();

                if (fieldData.element_date_invalid_format) {
                    msjString = fieldData.element_date_invalid_format;
                }
            }
            if (isValid !== true) {
                jQuery.validator.messages['date-validation'] = msjString;
            }
            return isValid;

        });
    }

    function getFormSlugFromFormElement(element) {
        var formSlug = jQuery(element).data('form');
        if (!formSlug) {
            var form = jQuery(element).closest('form');
            var formId = form.attr('id');
            if (formId) {
                formSlug = formId.split('buddyforms_form_');
                formSlug = (formSlug[1]) ? formSlug[1] : false;
            } else {
                formSlug = false;
            }
        }
        return formSlug;
    }

    function getFieldFromSlug(fieldSlug, formSlug) {
        if (fieldSlug && formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].form_fields) {
            var hasPredefinedType = jQuery('[name="' + fieldSlug + '"]').attr('data-element-slug');
            if (hasPredefinedType) {
                fieldSlug = hasPredefinedType;
            }
            var fieldIdResult = Object.keys(buddyformsGlobal[formSlug].form_fields).filter(function (fieldId) {
                fieldSlug = fieldSlug.replace('[]', '');
                fieldSlug = BuddyFormsHooks.applyFilters('buddyforms:field:slug', fieldSlug, [formSlug, fieldId, buddyformsGlobal[formSlug]]);
                return buddyformsGlobal[formSlug].form_fields[fieldId].slug.toLowerCase() === fieldSlug.toLowerCase();
            });
            if (fieldIdResult) {
                return buddyformsGlobal[formSlug].form_fields[fieldIdResult];
            }
        }
        return false;
    }

    function getFieldFromName(fieldName, formSlug) {
        if (fieldName && typeof fieldName === "string" && formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].form_fields) {
            var fieldIdResult = Object.keys(buddyformsGlobal[formSlug].form_fields).filter(function (fieldId) {
                fieldName = fieldName.replace('[]', '');
                fieldName = BuddyFormsHooks.applyFilters('buddyforms:field:name', fieldName, [formSlug, fieldId, buddyformsGlobal[formSlug]]);
                return buddyformsGlobal[formSlug].form_fields[fieldId].name.toLowerCase() === fieldName.toLowerCase();
            });
            if (fieldIdResult) {
                return buddyformsGlobal[formSlug].form_fields[fieldIdResult];
            }
        }
        return false;
    }

    function getFieldFrom(fieldValue, formSlug, from = 'name') {
        if (fieldValue && typeof fieldValue === "string" && formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].form_fields) {
            var fieldIdResult = Object.keys(buddyformsGlobal[formSlug].form_fields).filter(function (fieldId) {
                fieldValue = fieldValue.replace('[]', '');
                fieldValue = BuddyFormsHooks.applyFilters('buddyforms:field:from', fieldValue, [formSlug, fieldId, buddyformsGlobal[formSlug]]);
                return buddyformsGlobal[formSlug].form_fields[fieldId][from].toLowerCase() === fieldValue.toLowerCase();
            });
            if (fieldIdResult) {
                return buddyformsGlobal[formSlug].form_fields[fieldIdResult];
            }
        }
        return false;
    }

    function enabledGarlic() {
        var bf_garlic = jQuery('.bf-garlic');
        if (bf_garlic.length > 0) {
            bf_garlic.garlic();
        }
    }

    function enabledSelect2() {
        var bf_select_2 = jQuery('.bf-select2');
        if (bf_select_2.length > 0) {
            bf_select_2.each(function () {
                var reset = jQuery(this).attr('data-reset');
                var options = {
                    placeholder: "Select an option", // todo need il18n
                    tokenSeparators: [',', ' ']
                };
                if (reset) {
                    options['allowClear'] = true;
                }
                jQuery(this).select2(options);

                jQuery(this).on('change', function () {
                    var formSlug = jQuery(this).data('form');
                    if (formSlug && buddyformsGlobal[formSlug] && typeof buddyformsGlobal[formSlug].js_validation == "undefined") {
                        jQuery('#buddyforms_form_' + formSlug).valid();
                    }
                });
            });
        }
    }

    function enabledDateTime() {
        var dateElements = jQuery('.bf_datetimepicker');
        if (dateElements && dateElements.length > 0) {
            jQuery.each(dateElements, function (i, element) {
                var currentFieldSlug = jQuery(element).attr('name');
                var formSlug = getFormSlugFromFormElement(element);
                if (currentFieldSlug && formSlug) {
                    var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                    var fieldTimeStep = (fieldData && fieldData.element_time_step) ? fieldData.element_time_step : 60;
                    var fieldDateFormat = (fieldData && fieldData.element_date_format) ? fieldData.element_date_format : 'dd/mm/yy';
                    var fieldTimeFormat = (fieldData && fieldData.element_time_format) ? fieldData.element_time_format : 'hh:mm tt';
                    var enableTime = (fieldData && fieldData.enable_time && fieldData.enable_time[0] && fieldData.enable_time[0] === 'enable_time');
                    var enableDate = (fieldData && fieldData.enable_date && fieldData.enable_date[0] && fieldData.enable_date[0] === 'enable_date');
                    if (!enableDate && !enableTime) {
                        enableDate = true;
                    }

                    var dateTimePickerConfig = {
                        dateFormat: fieldDateFormat,
                        timeFormat: fieldTimeFormat,
                        showTimepicker: enableTime || false,
                        stepMinute: parseInt(fieldTimeStep),
                        onSelect: function () {
                            if (formSlug && buddyformsGlobal[formSlug] && typeof buddyformsGlobal[formSlug].js_validation == "undefined") {
                                jQuery('#buddyforms_form_' + formSlug).valid();
                            }
                        }
                    };

                    if (currentFieldSlug === 'schedule') {
                        dateTimePickerConfig['minDate'] = 0;
                        dateTimePickerConfig['stepMinute'] = 5;
                        dateTimePickerConfig['showTimepicker'] = true;
                        dateTimePickerConfig['dateFormat'] = 'dd/mm/yy';
                        dateTimePickerConfig['timeFormat'] = 'hh:mm tt';
                    }

                    dateTimePickerConfig = BuddyFormsHooks.applyFilters('buddyforms:field:date', dateTimePickerConfig, [element, fieldData, formSlug]);
                    jQuery(element).datetimepicker(dateTimePickerConfig);
                }
            });
        }
    }

    function enableJQueryTimeAddOn() {
        var timeElements = jQuery('.bf_jquerytimeaddon');
        if (timeElements && timeElements.length > 0) {
            jQuery.each(timeElements, function (i, element) {
                var currentFieldSlug = jQuery(element).attr('name');
                var formSlug = getFormSlugFromFormElement(element);
                if (currentFieldSlug && formSlug) {
                    var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                    var fieldTimeFormat = (fieldData.element_time_format) ? fieldData.element_time_format : "hh:mm tt";
                    var fieldStepHour = (fieldData.element_time_hour_step) ? fieldData.element_time_hour_step : 1;
                    var fieldStepMinute = (fieldData.element_time_minute_step) ? fieldData.element_time_minute_step : 1;

                    var timePickerConfig = {
                        timeFormat: fieldTimeFormat,
                        stepHour: parseInt(fieldStepHour),
                        timeOnly: true,
                        stepMinute: parseInt(fieldStepMinute),
                        controlType: 'select',
                        oneLine: true
                    };

                    timePickerConfig = BuddyFormsHooks.applyFilters('buddyforms:field:time', timePickerConfig, [element, fieldData, formSlug]);
                    jQuery(element).timepicker(timePickerConfig);
                }
            });
        }
    }

    function handleFeaturePost() {
        var statusElement = jQuery('select[name=status]');
        if (statusElement && statusElement.length > 0) {
            var bf_status = statusElement.val();
            jQuery('.bf_datetime_wrap').toggle(bf_status === 'future');

            statusElement.change(function () {
                var bf_status = jQuery(this).val();
                jQuery('.bf_datetime_wrap').toggle(bf_status === 'future');
            });
        }
    }

    function handleFormContent() {
        var formContentValElement = jQuery('#buddyforms_form_content_val');
        var formContentElement = jQuery('#buddyforms_form_content');
        if (formContentElement && formContentElement.length > 0 && formContentValElement && formContentValElement.length > 0) {
            var buddyforms_form_content_val = formContentValElement.html();
            formContentElement.html(buddyforms_form_content_val);
        }
    }

    function actionFromButtonWrapper(event) {
        var target = jQuery(this).data('target');
        var status = jQuery(this).data('status');
        var targetForms = jQuery('#buddyforms_form_' + target);
        BuddyFormsHooks.doAction('buddyforms:submit:click', [targetForms, target, status, event]);
    }


    function actionFromButton(args) {

        var targetForms = args[0];
        var target = args[1];
        var status = args[2];
        var event = args[3];
        event.preventDefault();
        var formOptions = 'publish';
        if (buddyformsGlobal && buddyformsGlobal[target] && buddyformsGlobal[target].status) {
            formOptions = buddyformsGlobal[target].status;
        }
        if (targetForms && targetForms.length > 0) {
            var fieldStatus = getFieldDataBy(target, 'status');
            if (fieldStatus === false) { //Not exist the field,
                var statusElement = targetForms.find('input[type="hidden"][name="status"]');
                if (statusElement && statusElement.length > 0) {
                    var post_status = status || formOptions;
                    statusElement.val(post_status);
                }
            }

            var captchaElement = jQuery('#buddyforms_form_' + target).find('#bf-cpchtk');
            if (captchaElement && captchaElement.length > 0) {
                reCaptchaV3NoAjax(args, function (submitCaptchaCallback) {

                    if(args[0]==='Submit'){
                        var targetForms = args[1];
                        targetForms.trigger('submit');
                    }
                });
                return false;
            }

            targetForms.trigger('submit');
        }
        return false;
    }

    function disableFormSubmit(formSlug) {
        var context = formSlug ? '#buddyforms_form_' + formSlug : false;
        var submitButton = jQuery('button.bf-submit, input[type="submit"]#buddyforms_password_submit', context);
        if (submitButton.length > 0) {
            var target = submitButton.data('target');
            if (target) {
                submitButton.attr('disabled', 'disabled');
            }
        }
    }

    function enableFormSubmit(formSlug) {
        var context = formSlug ? '#buddyforms_form_' + formSlug : false;
        var submitButton = jQuery('button.bf-submit, input[type="submit"]#buddyforms_password_submit', context);
        if (submitButton.length > 0) {
            var target = submitButton.data('target');
            if (target) {
                submitButton.removeAttr('disabled');
            }
        }
    }

    function errorPlacement(label, element) {
        var formSlug = getFormSlugFromFormElement(element);
        var fieldSlug = jQuery(element).attr('name');
        var fieldData = getFieldFromSlug(fieldSlug, formSlug);
        fieldData = BuddyFormsHooks.applyFilters('buddyforms:validation:field:data', fieldData, [fieldSlug, formSlug, fieldData]);
        if (!fieldData) {//if not field data is not possible to validate it
            return true;
        }
        switch (fieldData.type) {
            case "gdpr":
                element.parent().append(label);
                break;
            case "taxonomy":
            case "category":
            case "tags":
                element.closest('div.bf_field_group').find('.bf_inputs.bf-input').append(label).find('.select2-container span.select2-selection').addClass('error');
                break;
            case 'textarea':
            case 'buddyforms_form_content':
            case 'content':
            case 'post_excerpt':
                element.closest('div.wp-core-ui.wp-editor-wrap').append(label);
                element.closest('div.wp-core-ui.wp-editor-wrap').find('.wp-editor-container').addClass('error');
                break;
            case "checkbox":
            case "dropdown":
            case "radiobutton":
                var parentElement = jQuery(element).closest('.bf_field_group');
                if (parentElement) {
                    label.insertAfter(parentElement.find('.bf-input'));
                }
                break;
            case "featured_image":
            case "upload":
                element.closest('div.dropzone.dz-clickable').addClass('error');
                label.insertAfter(element);
                break;
            default:
                label.insertAfter(element);
        }
    }

    function validateGlobalConfig() {
        var forms = jQuery('.standard-form.buddyforms-active-form');
        if (forms && forms.length > 0) {
            jQuery.each(forms, function () {
                var currentForms = jQuery(this);
                var formSlug = getFormSlugFromFormElement(currentForms);
                if (formSlug && buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].js_validation && buddyformsGlobal[formSlug].js_validation[0] === 'disabled') {
                    return true;
                }

                jQuery.validator.methods.required = function (b, c, d) {
                    var targetElement = jQuery(c);
                    var hasControlClass = targetElement.hasClass('form-control');
                    var hasFormAttr = targetElement.attr('data-form');
                    if (hasFormAttr || hasControlClass) {
                        return bfRequiredValidation(b, c, d);
                    } else {
                        if (!this.depend(d, c)) {
                            return 'dependency-mismatch';
                        }
                        if ('select' === c.nodeName.toLowerCase()) {
                            var e = a(c).val();
                            return e && e.length > 0;
                        }
                        return this.checkable(c) ? this.getLength(b, c) > 0 : b.length > 0;
                    }
                };

                var validationSettings = {
                    invalidHandler: function(form, validator) {

                        if (!validator.numberOfInvalids()) {
                            return;
                        }

                        var firstElm = jQuery(validator.errorList[0].element);
                        var startRow = firstElm.parents('.bf-start-row').length;
                        if (startRow==0){

                            var position = firstElm.offset().top;
                            jQuery(window).scrollTop(parseInt(position) - 100);
                        }
                        else if(startRow >0){
                            var position = firstElm.parents('.bf-start-row').offset().top;
                            jQuery(window).scrollTop(parseInt(position) - 100);
                        }


                    },
                    ignore: function (index, element) {
                        var formSlug = getFormSlugFromFormElement(element);
                        var targetElement = jQuery(element);
                        var hasControlClass = targetElement.hasClass('form-control');
                        var hasFormAttr = targetElement.attr('data-form');
                        var ignore = true;
                        if (hasFormAttr || hasControlClass) {
                            ignore = false;
                        }

                        ignore = BuddyFormsHooks.applyFilters('buddyforms:validation:ignore', ignore, [targetElement, index, formSlug]);

                        return ignore;
                    },
                    errorPlacement: errorPlacement,
                    highlight: function (element, errorClass, validClass) {
                        var elem = jQuery(element);
                        if (elem.hasClass('select2-hidden-accessible')) {
                            elem.parent().find('span.select2-selection').addClass(errorClass);
                        } else if(elem.hasClass('wp-editor-area')){
                            elem.off('change').change(function(e) {
                                if (elem.valid()) {
                                    elem.parents('.wp-editor-container').removeClass(errorClass);
                                } else {
                                    elem.parents('.wp-editor-container').addClass(errorClass);
                                }
                            });
                        } else {
                            elem.addClass(errorClass);
                        }
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        var elem = jQuery(element);
                        if (elem.hasClass('select2-hidden-accessible')) {
                            elem.parent().find('span.select2-selection').removeClass(errorClass);
                        } else {
                            elem.removeClass(errorClass);
                        }
                    }
                };

                validationSettings = BuddyFormsHooks.applyFilters('buddyforms:validation:settings', validationSettings, [formSlug]);
                currentForms.validate(validationSettings);
            });
        }
    }

    function enablePriceField() {
        var priceElements = jQuery('.bf_woo_price');
        if (priceElements.length > 0 && jQuery.fn.priceFormat) {
            jQuery.each(priceElements, function (i, currentElement) {
                var currentFieldSlug = jQuery(currentElement).attr('name');
                var formSlug = getFormSlugFromFormElement(currentElement);
                if (currentFieldSlug && formSlug) {
                    var fieldData = getFieldFromSlug(currentFieldSlug, formSlug);
                    var thousandsSeparator = (fieldData.thousands_separator) ? fieldData.thousands_separator : '.';
                    var prefix = (fieldData.prefix) ? fieldData.prefix : '$';
                    var suffix = (fieldData.suffix) ? fieldData.suffix : '';
                    var centsSeparator = (fieldData.cents_separator) ? fieldData.cents_separator : ',';

                    jQuery(currentElement).priceFormat({
                        clearOnEmpty: true,
                        thousandsSeparator: thousandsSeparator,
                        prefix: prefix,
                        suffix: suffix,
                        centsSeparator: centsSeparator
                    });
                }
            });
        }
    }

    function triggerFormError(options) {
        var form_id = options[0], errors = options[1];
        if (buddyformsGlobal && form_id && errors && buddyformsGlobal[form_id] && buddyformsGlobal.localize.error_strings) {
            var id = 'buddyforms_form_' + form_id;
            var labelErrors = jQuery('#' + id + ' label.error');
            var errorSize = (errors.errors[id] && errors.errors[id].length) ? errors.errors[id].length : '';
            var errorFormat;
            if (errorSize == 1) {
                errorFormat = bf_trans('error was');
            } else {
                errorFormat = errorSize + ' ' + bf_trans('errors were');
            }
            //Clean all error
            jQuery('.bf-alert').remove();
            var errorHTMLItems = [];
            var targetForm = jQuery('#' + id);
            targetForm.find('.form-control').removeClass('error');
            targetForm.find('.bf_inputs.bf-input .select2-container span.select2-selection').removeClass('error');
            targetForm.find('.wp-editor-container').removeClass('error');
            labelErrors.remove();
            buddyformsGlobal[form_id].errors = errors.errors;
            jQuery.each(errors.errors[id], function (i, e) {
                var fieldData = getFieldFromSlug(i, form_id);
                if (!fieldData) {
                    errorHTMLItems.push({id: i, message: e});
                    return true;
                }
                var targetField;
                if (fieldData.type === 'category' || fieldData.type === 'taxonomy' || fieldData.type === 'tags' || fieldData.type === 'checkbox') {
                    targetField = jQuery('[name="' + fieldData.slug + '[]"]');
                } else {
                    targetField = jQuery('[name="' + fieldData.slug + '"]');
                }
                if (targetField && targetField.length === 0) {
                    targetField = jQuery('[data-element-slug="' + fieldData.slug + '"]');
                }
                if (targetField && targetField.length > 0) {
                    targetField.addClass('error');
                    var labelSlug = fieldData.slug + '-error';
                    var labelElement = jQuery('<label>').attr({id: labelSlug, class: 'error', for: fieldData.slug}).text(e);
                    errorPlacement(labelElement, targetField);
                }
            });

            if (errorHTMLItems.length > 0) {
                var errorHTML = '<div class="bf-alert error is-dismissible"><strong class="alert-heading">' + bf_trans('The following') + ' ' + errorFormat + ' ' + bf_trans('found: ') + '</strong><ul style="padding: 0; margin-left: 1em; padding-inline-start: 0.5em;">';
                jQuery.each(errorHTMLItems, function (i, e) {
                    if (e && e.message && e.message !== '') {
                        errorHTML += '<li data-target-field="' + e.id + '">' + e.message + '</li>'
                    }
                });
                errorHTML += '</ul></div>';
                targetForm.prepend(errorHTML);
            }

            var scrollElement = labelErrors.first();
            if (scrollElement.length > 0) {
                jQuery('html, body').animate({scrollTop: scrollElement.offset().top - 100}, {
                    duration: 500, complete: function () {
                        jQuery('html, body').on("click", function () {
                            jQuery('html, body').stop()
                        });
                    }
                }).one("click", function () {
                    jQuery('html, body').stop()
                });
            }
        }
    }

    function reCaptchaV3(options, callback) {
        var currentElement = jQuery('#buddyforms_form_' + options[0]).find('#bf-cpchtk');
        if (currentElement && currentElement.length > 0) {
            var formSlug = getFormSlugFromFormElement(currentElement);
            var currentFieldSlug = jQuery(currentElement).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldStateData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (typeof grecaptcha !== "undefined") {
                    grecaptcha.ready(function () {
                        var captcha_action = fieldStateData.captcha_v3_action.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '');
                        grecaptcha.execute(fieldStateData.captcha_site_key, {action: captcha_action}).then(function (token) {
                            jQuery(currentElement).val(token).change();
                            var recaptchaResponse = document.getElementById('bf-cpchtk');
                            recaptchaResponse.value = token;
                            callback(options);
                        });
                    });
                }
            }
        } else {
            callback(options);
        }
    }

    function reCaptchaV3NoAjax(options, callback) {
        var currentElement = jQuery('#buddyforms_form_' + options[1]).find('#bf-cpchtk');
        if (currentElement && currentElement.length > 0) {
            var formSlug = getFormSlugFromFormElement(currentElement);
            var currentFieldSlug = jQuery(currentElement).attr('name');
            if (currentFieldSlug && formSlug) {
                var fieldStateData = getFieldFromSlug(currentFieldSlug, formSlug);
                if (typeof grecaptcha !== "undefined") {
                    grecaptcha.ready(function () {
                        var captcha_action = fieldStateData.captcha_v3_action.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '');
                        grecaptcha.execute(fieldStateData.captcha_site_key, {action: captcha_action}).then(function (token) {
                            jQuery(currentElement).val(token).change();
                            var recaptchaResponse = document.getElementById('bf-cpchtk');
                            recaptchaResponse.value = token;
                            options.splice(0, 0, "Submit");
                            callback(options);
                        });
                    });
                }
            }
        } else {
            callback(options);
        }
    }

    function renderFormWrapper(options) {
        var captchaValidate = BuddyFormsHooks.applyFilters('buddyforms:captcha:validate', true, options);
        if (captchaValidate) {
            reCaptchaV3(options, function (arguments_options) {
                renderForm(arguments_options);
            });
        } else {
            renderForm(options);
        }
    }

    function renderForm(options) {
        var id = options[0], prevent = options[1], ajax = options[2], method = options[3],
            formTargetStatus = options[4];
        var formId = 'buddyforms_form_' + id;
        if (typeof (tinyMCE) != "undefined") {
            tinyMCE.triggerSave();
        }
        if (buddyformsGlobal) {
            var currentForm = jQuery("#" + formId);
            var formMessage = jQuery('#form_message_' + id);
            currentForm.data('initialize', buddyformsGlobal.ajaxnonce);
            //When the form is submitted, disable all submit buttons to prevent duplicate submissions
            BuddyFormsHooks.doAction('buddyforms:submit:disable');
            //For ajax, an anonymous onsubmit javascript function is bound to the form using jQuery.  jQuery's serialize function is used to grab each element's name/value pair.
            if (ajax) {
                if (id && buddyformsGlobal[id] && typeof buddyformsGlobal[id].js_validation == "undefined") {
                    if (typeof (formTargetStatus) == "undefined" || (formTargetStatus && formTargetStatus !== 'draft')) {
                        if (jQuery.validator && !currentForm.valid()) {
                            return false;
                        }
                    }
                }

                jQuery("#buddyforms_form_hero_" + id + " .form_wrapper form").LoadingOverlay("show");

                var FormData = currentForm.serialize();

                jQuery.ajax({
                    url: buddyformsGlobal.admin_url,
                    type: method,
                    dataType: 'json',
                    data: {
                        "action": "buddyforms_ajax_process_edit_post",
                        "data": FormData
                    },
                    error: function (xhr, status, error) {
                        formMessage.addClass('bf-alert error');
                        formMessage.html(xhr.responseText);
                    },
                    success: function (response) {
                        console.log(response);
                        jQuery.each(response, function (i, val) {
                            switch (i) {
                                case 'form_notice':
                                    formMessage.addClass('bf-alert success');
                                    formMessage.html(val);
                                    break;
                                case 'display_page':
                                    formMessage.html(val);
                                    break;
                                case 'form_remove':
                                    jQuery("#buddyforms_form_hero_" + id + " .form_wrapper").fadeOut("normal", function () {
                                        jQuery("#buddyforms_form_hero_" + id + " .form_wrapper").remove();
                                    });
                                    break;
                                case 'form_actions':
                                    jQuery("#buddyforms_form_" + id + " .form-actions").html(val);
                                    break;
                                case 'remove_draft':
                                    if (val && val == true) {
                                        jQuery("#buddyforms_form_" + id + " .form-actions .bf-draft").remove();
                                    }
                                    break;
                                default:
                                    jQuery('#buddyforms_form_' + id + ' input[name="'+ i +'"]').val(val);
                            }
                            jQuery('#recaptcha_reload').trigger('click');
                            BuddyFormsHooks.doAction('buddyforms:init', [id]);
                        });
                        if (response !== undefined && typeof response == "object" && response.errors) {
                            BuddyFormsHooks.doAction('buddyforms:error:trigger', [id, response]);
                        }
                    },
                    complete: function () {
                        BuddyFormsHooks.doAction('buddyforms:submit:enable');
                        // scroll to message after submit
                        var scrollElement = jQuery("#buddyforms_form_hero_" + id);
                        if (scrollElement.length > 0) {
                            jQuery('html, body').animate({scrollTop: scrollElement.offset().top - 100}, {
                                duration: 500, complete: function () {
                                    jQuery('html, body').on("click", function () {
                                        jQuery('html, body').stop()
                                    });
                                }
                            }).one("click", function () {
                                jQuery('html, body').stop()
                            });
                        }
                        jQuery("#buddyforms_form_hero_" + id + " .form_wrapper form").LoadingOverlay("hide");
                        bf_form_errors();
                    }
                });
            }
            return false;
        }

        //jQuery is used to set the focus of the form's initial element.
        if (!prevent.includes('focus')) {
            jQuery("#" + formId + ":input:visible:enabled:first").focus();
        }
    }

    function onCountryChange() {
        var currentElement = jQuery(this);
        var countryCodeSelected = currentElement.val();
        var formSlug = getFormSlugFromFormElement(currentElement);
        if (formSlug) {
            var currentForm = jQuery('#buddyforms_form_' + formSlug);
            if (currentForm.length > 0) {
                var stateElement = currentForm.find('.bf-state').first();
                var currentFieldSlug = jQuery(currentElement).attr('name');
                if (currentFieldSlug && formSlug) {
                    var fieldStateData = getFieldFromSlug(currentFieldSlug, formSlug);
                    var isLinkedCountry = (fieldStateData.link_with_state) ? fieldStateData.link_with_state : false;
                    if (isLinkedCountry && isLinkedCountry[0] && isLinkedCountry[0] === 'link') {
                        if (stateElement.length > 0) {
                            if (countryCodeSelected) {
                                var existState = stateElement.children('option[data-country="' + countryCodeSelected + '"]');
                                if (existState.length > 0) {
                                    stateElement.children('option').hide();
                                    stateElement.children('option[data-country="nostate"]').hide();
                                    existState.show();
                                } else {
                                    stateElement.children('option').hide();
                                    stateElement.children('option[data-country="nostate"]').show();
                                }
                            } else {
                                stateElement.children('option').hide();
                                stateElement.children('option[data-country="nostate"]').show();
                            }
                        }
                        stateElement.val('');
                    } else {
                        stateElement.children('option').show();
                    }
                }
            }
        }
    }

    return {
        submissionModal: function (target) {
            submissionModal = target;
        },
        getSubmissionModal: function () {
            return submissionModal;
        },
        submissionModalContent: function (target) {
            submissionModalContent = target;
        },
        getSubmissionModalContent: function () {
            return submissionModalContent;
        },
        getFormSlugFromFormElement: function (element) {
            return getFormSlugFromFormElement(element);
        },
        actionFromButton: function (e) {
            return actionFromButton(e);
        },
        getFieldFromName: function(fieldName, formSlug){
          return getFieldFromName(fieldName, formSlug);
        },
        getFieldFrom: function(fieldValue, formSlug, from){
          return getFieldFrom(fieldValue, formSlug, from);
        },
        getFieldFromSlug: function (fieldSlug, formSlug) {
            return getFieldFromSlug(fieldSlug, formSlug);
        },
        init: function (id) {
            id = id || false;

            if (id) {
                var currentForm = jQuery('#buddyforms_form_' + id);
                if (!currentForm.data('initialize')) {
                    currentForm.data('initialize', buddyformsGlobal.ajaxnonce);
                } else {
                    return false;
                }
            }

            jQuery(document).trigger('buddyforms-ready', [currentForm, id]);

            var redirect = bf_getUrlParameter('redirect_url');
            if (redirect) {
                specialPasswordRedirectAfterRegistration(redirect);
            }
            var bf_submission_modal_content = jQuery('.buddyforms-posts-content');
            if (bf_submission_modal_content.length > 0) {
                fncBuddyForms.submissionModalContent(bf_submission_modal_content);
            }
            jQuery(document.body).on('click', 'button[type="submit"][name="draft"].bf-draft', actionFromButtonWrapper);
            jQuery(document.body).on('click', 'button[type="submit"][name="submitted"].bf-submit', actionFromButtonWrapper);
            jQuery(document.body).on('click', '.button.bf_reset_multi_input', resetInputMultiplesChoices);
            jQuery(document.body).on('keyup', 'input[name=buddyforms_user_pass], input[name=buddyforms_user_pass_confirm]', checkPasswordStrength);
            jQuery(document).on("click", '.bf_delete_post', bf_delete_post);
            jQuery(document).on("click", '.bf-submission-modal', openSubmissionModal);
            jQuery(document).on("click", '.bf-close-submissions-modal', closeSubmissionModal);
            jQuery(document).on("click", '.create-new-tax-item', createTaxItem);
            jQuery(document).on("change", '.bf-country', onCountryChange);

            //Events
            BuddyFormsHooks.addAction('buddyforms:submit:disable', disableFormSubmit);
            BuddyFormsHooks.addAction('buddyforms:submit:enable', enableFormSubmit);
            BuddyFormsHooks.addAction('buddyforms:error:trigger', triggerFormError);
            BuddyFormsHooks.addAction('buddyforms:form:render', renderFormWrapper);
            BuddyFormsHooks.addAction('buddyforms:submit:click', actionFromButton);

            disableACFPopup();

            if (jQuery && jQuery.validator) {
                validateGlobalConfig();
                addValidationForUserWebsite();
                addValidationMinLength();
                addValidationMaxLength();
                addValidationMaxValue();
                addValidationMinValue();
                addDateFormatValidation();
                addValidationEmail();
                addValidationPhone();
                enabledDateTime();
                enableJQueryTimeAddOn();
                enablePriceField();
                addUploadFieldValidations();
                addFeatureImageValidations();
            }

            enabledSelect2();
            bf_form_errors();
            enabledGarlic();
            handleFeaturePost();
            handleFormContent();
        }
    }
}

var fncBuddyForms = BuddyForms();
jQuery(document).ready(function () {
    fncBuddyForms.init();
});

if (BuddyFormsHooks) {
    BuddyFormsHooks.addAction('buddyforms:init', function (id) {
        fncBuddyForms.init(id);
    }, 10);
}

// Example to extend the required validation using events
// BuddyFormsHooks.addFilter('buddyforms:validation:required', function (isValid, arguments) {
//     if (arguments.fieldData.type === 'title') {
//         isValid = arguments.value.length > 0;
//     }
//     return isValid;
// }, 10);
// BuddyFormsHooks.addFilter('buddyforms:validation:required:message', function (requiredMessage, arguments) {
//     if (arguments.fieldData.type === 'title') {
//         requiredMessage = 'Custom message';
//     }
//     return requiredMessage;
// }, 10);

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
