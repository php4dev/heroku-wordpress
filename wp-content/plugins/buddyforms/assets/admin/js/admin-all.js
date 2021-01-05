jQuery(document).ready(function (jQuery) {
    //Remove submission default page notification
    jQuery(document.body).on('click', '#buddyforms_submission_default_page button.notice-dismiss', function () {
        jQuery.ajax({
            type: 'POST',
            dataType: "json",
            url: buddyformsGlobal.admin_url,
            data: {"action": "buddyforms_close_submission_default_page_notification", "nonce": buddyformsGlobal.ajaxnonce},
        })
    });
    jQuery(document.body).on('click', '#buddyforms_marketing_reset', function () {
        if (confirm('Are you sure?')) {
            var actionButton = jQuery(this);
            actionButton.attr('disabled', true);
            var actionButtonOriginalText = actionButton.text();
            actionButton.text('Loading...');
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: buddyformsGlobal.admin_url,
                data: {
                    'action': 'buddyforms_marketing_reset_permissions',
                    'nonce': buddyformsGlobal.ajaxnonce,
                },
                success: function (data) {
                    console.log(data);
                    actionButton.text(actionButtonOriginalText);
                    actionButton.removeAttr('disabled');
                },
                error: function (request, status, error) {
                    actionButton.text(actionButtonOriginalText);
                    actionButton.removeAttr('disabled');
                    alert(request.responseText);
                },
            });
        }
    });
    jQuery(document.body).on('click', '#btn-compile-custom', function() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: buddyformsGlobal.admin_url,
            data: {
                'action': 'buddyforms_custom_form_template',
                'nonce': buddyformsGlobal.ajaxnonce,
            },
            success: function(data) {
                console.log(data);
            },
            error: function(request, status, error) {
                console.log(data);
            },
        });
    });
});
