function userSatisfaction() {
    function ajaxEvent() {
        jQuery(document).on('click', '[data-satisfaction-form-action]', function (e) {
            e.preventDefault();
            let action = jQuery(this).attr('data-satisfaction-form-action');

            switch (action) {
                case 'ajax':
                    let href = '/';
                    let inputs = jQuery(this).attr('data-satisfaction-form-inputs').split(',');
                    let data = {};
                    if (href && inputs) {
                        inputs.forEach(input => {
                            let newInput = input.split(':');
                            let jqNewInput = newInput.length >= 2
                                ? jQuery('[name="' + newInput[0] + '"]:' + newInput[1])
                                : jQuery('[name="' + newInput[0] + '"]');

                            if (jqNewInput.length >= 1) {
                                Object.assign(data, { key: jqNewInput[0].name, value: jqNewInput.val() });
                            }
                        });

                        // Disable button to avoid
                        // duplicate actions.

                        if (Object.keys(data).length >= 1) {
                            const oldButtonText = jQuery(this).html();

                            jQuery(this).html('Sending...');
                            jQuery(this).attr('disabled', true);

                            let ajaxForm = jQuery.post({
                                url: buddyformsGlobal.admin_url,
                                dataType: 'json',
                                data: {
                                    'action': 'buddyforms_user_satisfaction_ajax',
                                    'nonce': buddyformsGlobal.ajaxnonce,
                                    'user_satisfaction_key': data.key,
                                    'user_satisfaction_value': data.value
                                }
                            });
                            ajaxForm.then((data, textStatus, jqXHR) => {
                                sectionNav();
                                jQuery(this).removeClass('error');
                                jQuery(this).removeClass('user');
                                jQuery(this).removeClass('server');
                            });
                            ajaxForm.fail((data, textStatus, jqXHR) => {
                                jQuery(this).addClass('error');
                                jQuery(this).addClass('server');
                                setTimeout(() => {
                                    jQuery(this).removeClass('error');
                                    jQuery(this).removeClass('server');
                                }, 15000);
                            });
                            ajaxForm.always(() => {
                                jQuery(this).html(oldButtonText);
                                jQuery(this).attr('disabled', false);
                            });
                            break;
                        } else {
                            jQuery(this).addClass('error');
                            jQuery(this).addClass('user');
                            setTimeout(() => {
                                jQuery(this).removeClass('error');
                                jQuery(this).removeClass('user');
                            }, 15000);
                        }
                    }
                    break;
            }
        });
    }

    function sectionNav(action) {
        let thisWindow = jQuery('.bf-satisfaction');
        let thisSection = Number(thisWindow.attr('data-section'));

        switch (action) {
            case '-': {
                thisSection--;
                break;
            }
            case '1': {
                thisSection = 1;
                break;
            }
            default: {
                thisSection++;
                break;
            }
        }
        thisWindow.attr('data-section', thisSection);
        jQuery('.bf-satisfaction .bf-satisfaction-top-title').html(jQuery('section[data-section="' + thisSection + '"]').attr('data-section-title'));
    }

    return {
        nav: function (action) {
            sectionNav(action);
        },
        init: function () {
            ajaxEvent();
            jQuery(document).on('click', '[data-section-browser]', function (e) {
                e.preventDefault();
                sectionNav(jQuery(this).attr('data-section-browser'));
            });
            jQuery(document).on('click', '[data-satisfaction-action]', function (e) {
                e.preventDefault();
                let state = jQuery(this).attr('data-satisfaction-action');
                if (state == 'close') {
                    jQuery('#corner-popup .corner-close').click();
                }
            });
        }
    };
}


jQuery(document).ready(function (jQuery) {
    //Popup for the themekraft bundle insisde the addons page
    var addonsContainer = jQuery('#fs_addons');
    var targetContainer = jQuery('#buddyforms_form_elements');
    if (((addonsContainer && addonsContainer.length > 0) || (targetContainer && targetContainer.length > 0)) && buddyformsMarketingHandler && buddyformsGlobal) {
        targetContainer.cornerpopup({
            variant: 10,
            slide: 1,
            slideTop: 1,
            escClose: 1,
            bgcolor: "#fff",
            bordercolor: "#efefef",
            textcolor: "#181818",
            btntextcolor: "#fff",
            content: buddyformsMarketingHandler.content,
        });
        if (addonsContainer && addonsContainer.length > 0) {
            jQuery('div#corner-popup').addClass('buddyforms-marketing-container buddyforms-marketing-bundle-container');
        }
    }
    //Popup for the viral share in the list of forms
    var formsList = jQuery('.type-buddyforms');
    if ((formsList && formsList.length >= 3) && buddyformsMarketingHandler && buddyformsGlobal && buddyformsMarketingHandler.content) {
        targetContainer.cornerpopup({
            variant: 10,
            slide: 1,
            slideTop: 1,
            escClose: 1,
            bgcolor: "#fff",
            bordercolor: "#efefef",
            textcolor: "#181818",
            btntextcolor: "#fff",
            afterPopup: function () {
                if (confirm('Close for ever?')) {
                    //hide for ever
                    jQuery.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: buddyformsGlobal.admin_url,
                        data: {
                            'action': 'buddyforms_marketing_form_list_coupon_for_free_close',
                            'key': 'form_list_coupon_for_free',
                            'nonce': buddyformsGlobal.ajaxnonce,
                        }
                    });
                }
            },
            content: buddyformsMarketingHandler.content,
        });
    }
    //Popup for user satisfaction
    if (buddyformsMarketingHandler && buddyformsGlobal && buddyformsMarketingHandler.content) {
        targetContainer.cornerpopup({
            variant: 10,
            slide: 1,
            slideTop: 1,
            escClose: 1,
            bgcolor: "#fff",
            bordercolor: "#efefef",
            textcolor: "#181818",
            btntextcolor: "#fff",
            afterPopup: function () {
                const current_section = jQuery(this).find('.bf-satisfaction').data('section');

                if (current_section > 1) {
                    return;
                }

                if (confirm('Close for ever?')) {
                    //hide for ever
                    jQuery.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: buddyformsGlobal.admin_url,
                        data: {
                            'action': 'buddyforms_marketing_hide_for_ever_close',
                            'popup_key': buddyformsMarketingHandler.key || '',
                            'nonce': buddyformsGlobal.ajaxnonce,
                        }
                    });
                }
            },
            content: buddyformsMarketingHandler.content,
        });
        jQuery('div#corner-popup').addClass('buddyforms-marketing-container buddyforms-marketing-bundle-container');
    }

    userSatisfaction().init();
});
