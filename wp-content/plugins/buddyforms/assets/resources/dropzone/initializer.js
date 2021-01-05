function uploadHandler() {
    var submitButtons, submitButton,
        existingHtmlInsideSubmitButton = '';

    function getFirstSubmitButton(submitButtons) {
        submitButton = jQuery.map(submitButtons, function (element) {
            return (jQuery(element).attr('type') === 'submit' && jQuery(element).hasClass('bf-submit')) ? jQuery(element) : null;
        })[0];
        existingHtmlInsideSubmitButton = submitButton.html();
    }

    function buildDropZoneFieldsOptions() {
        jQuery(".upload_field").each(function () {
            var current = jQuery(this);
            var clickeable = (current.attr('page') !== 'buddyforms_submissions');
            var maxFileSize = current.attr('file_limit');
            var acceptedFiles = current.attr('accepted_files');
            var multipleFiles = current.attr('multiple_files');
            var entry = current.data('entry');
            var form_slug = current.attr('form-slug');
            jQuery('#buddyforms_form_' + form_slug).show();

            initSingleDropZone(current, current.attr('id'), maxFileSize, acceptedFiles, multipleFiles, clickeable, entry)
        })
    }

    function initSingleDropZone(current, id, maxSize, acceptedFiles, multipleFiles, clickeable, uploadFields) {
        //Hidden field
        var hidden_field = jQuery(current).find('input[type="text"][style*="hidden"]');
        //Container field
        var dropzoneStringId = '#' + id;
        //Set default values
        if (buddyformsGlobal) {
            var options = {
                url: buddyformsGlobal.admin_url,
                maxFilesize: maxSize,
                parallelUploads: 1,
                acceptedFiles: acceptedFiles,
                maxFiles: multipleFiles,
                clickable: clickeable,
                addRemoveLinks: clickeable,
                init: function () {
                    this.on('queuecomplete', function () {
                        current.removeClass('error');
                    });
                    this.on('addedfile', function () {
                        DropZoneAddedFile(dropzoneStringId);
                    });
                    this.on('success', function (file, response) {
                        DropZoneSuccess(file, response, hidden_field);
                    });
                    this.on('error', DropZoneError);
                    this.on('sending', DropZoneSending);
                    this.on('sendingmultiple', DropZoneSending);
                    this.on('complete', DropZoneComplete);
                    this.on('completemultiple', DropZoneComplete);
                    this.on('removedfile', function (file) {
                        DropZoneRemovedFile(file, hidden_field);
                    });

                    if (uploadFields) {
                        for (var key in uploadFields) {
                            if (key) {
                                var mockFile = {
                                    name: uploadFields[key]['name'],
                                    size: uploadFields[key]['size'],
                                    url: uploadFields[key]['url'],
                                    attachment_id: uploadFields[key]['attachment_id'],
                                };
                                this.emit('addedfile', mockFile);
                                this.emit('thumbnail', mockFile, mockFile.url);
                                this.emit('complete', mockFile);
                                this.files.push(mockFile);
                            }
                        }
                    }
                },
                //Language options
                dictMaxFilesExceeded: buddyformsGlobal.localize.upload.dictMaxFilesExceeded || "You can not upload any more files.",
                dictRemoveFile: buddyformsGlobal.localize.upload.dictRemoveFile || "Remove file",
                dictCancelUploadConfirmation: buddyformsGlobal.localize.upload.dictCancelUploadConfirmation || "Are you sure you want to cancel this upload?",
                dictCancelUpload: buddyformsGlobal.localize.upload.dictCancelUpload || "Cancel upload",
                dictResponseError: buddyformsGlobal.localize.upload.dictResponseError || "Server responded with {{statusCode}} code.",
                dictInvalidFileType: buddyformsGlobal.localize.upload.dictInvalidFileType || "You can't upload files of this type.",
                dictFileTooBig: buddyformsGlobal.localize.upload.dictFileTooBig || "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
                dictFallbackMessage: buddyformsGlobal.localize.upload.dictFallbackMessage || "Your browser does not support drag'n'drop file uploads.",
                dictDefaultMessage: buddyformsGlobal.localize.upload.dictDefaultMessage || "Drop files here to upload",
            };
            jQuery(current).dropzone(options);
        }
    }

    function DropZoneComplete() {
        enabledSubmitButtons();
    }

    function DropZoneAddedFile(dropzoneContainer) {
        jQuery(dropzoneContainer).find("label[class*='error']").text("");
        jQuery(dropzoneContainer).find('.dz-progress').hide()
    }

    function DropZoneSending(file, xhr, formData) {
        disableSubmitButtons(true);
        formData.append('action', 'handle_dropped_media');
        formData.append('nonce', buddyformsGlobal.ajaxnonce);
    }

    function DropZoneSuccess(file, response, currentField) {
        file.previewElement.classList.add("dz-success");
        file['attachment_id'] = response; // push the id for future reference
        var ids = jQuery(currentField).val() + ',' + response;
        var idsFormat = "";
        if (ids[0] === ',') {
            idsFormat = ids.substring(1, ids.length);
        } else {
            idsFormat = ids;
        }
        jQuery(currentField).attr('value', idsFormat);
    }

    function DropZoneError(file, response) {
        file.previewElement.classList.add("dz-error");
        jQuery(file.previewElement).find('div.dz-error-message>span').text(response);
        enabledSubmitButtons();
    }

    function DropZoneRemovedFile(file, currentField) {
        var attachment_id = file.attachment_id;
        var ids = jQuery(currentField).val();
        var remainigIds = ids.replace(attachment_id, "");
        if (remainigIds[0] === ',') {
            remainigIds = remainigIds.substring(1, ids.length);
        }
        var lastChar = remainigIds[remainigIds.length - 1];
        if (lastChar === ',') {
            remainigIds = remainigIds.slice(0, -1);
        }
        jQuery(currentField).attr('value', remainigIds);
        handleDeletedMedia(attachment_id);
    }

    function handleDeletedMedia(attachmentId) {
        disableSubmitButtons(false);
        jQuery.post(buddyformsGlobal.admin_url, {
            action: 'handle_deleted_media',
            media_id: attachmentId,
            nonce: buddyformsGlobal.ajaxnonce
        }, function (data) {
            console.log(data);
        }).always(function () {
            enabledSubmitButtons();
        });
    }

    function disableSubmitButtons(showButtonText) {
        if (buddyformsGlobal) {
            if (submitButtons.length > 0) {
                showButtonText = !!(showButtonText);
                submitButtons.attr("disabled", "disabled");
                if (showButtonText) {
                    submitButton.html(buddyformsGlobal.localize.upload.submitButton || 'Upload in progress'); // todo need il18n
                }
            }
        }
    }

    function checkToEnableSubmit() {
        var result = true;
        jQuery(".upload_field").each(function () {
            var currentDropZone = jQuery(this)[0].dropzone;
            if (currentDropZone && currentDropZone.files.length > 0) {
                var allFilesSuccessDiff = currentDropZone.files.filter(function (file) {
                    return file.status === Dropzone.UPLOADING;
                });
                result = allFilesSuccessDiff.length === 0;
            }
        });

        return result;
    }

    function enabledSubmitButtons() {
        if (submitButtons.length > 0 && checkToEnableSubmit()) {
            submitButtons.removeAttr("disabled");
            submitButton.html(existingHtmlInsideSubmitButton);
        }
    }

    return {
        init: function () {
            var uploadFields = jQuery(".upload_field");
            submitButtons = jQuery("div.form-actions button.bf-submit[type=submit], div.form-actions button.bf-draft[type=submit]");
            if (submitButtons.length > 0) {
                getFirstSubmitButton(submitButtons);
            }
            if (uploadFields.length > 0) {
                buildDropZoneFieldsOptions();
            }
        }
    }
}

function validateAndUploadImage(field) {

    var current = jQuery(field);
    var id = current.attr("field-id");
    jQuery("#" + id + "_label").text("");
    jQuery("#" + id + "_image").attr('src', "");
    jQuery("#field_" + id).val("");
    var url = jQuery("#" + id + "_upload_from_url").val();

    if (checkURL(url)) {

        jQuery("#" + id + "_upload_button").text("Uploading..");
        jQuery("#" + id + "_upload_button").attr('disabled', true);
        var submitButtons = jQuery("div.form-actions button.bf-submit[type=submit], div.form-actions button.bf-draft[type=button]");
        submitButtons.attr('disabled', true);

        jQuery.ajax({
            url: buddyformsGlobal.admin_url,
            type: 'post',
            data: {
                action: 'upload_image_from_url',
                url: encodeURIComponent(url),
                id: id
            },
            success: function (response) {
                var result = JSON.parse(response);
                if(result.status ==="OK"){
                    jQuery("#" + id + "_image").attr('src', result.response);
                    jQuery("#" + id + "_image").attr('width', 300);
                    jQuery("#" + id + "_image").attr('height', 300);
                    jQuery("#field_" + id).val(result.attachment_id);

                    jQuery("#" + id + "_upload_button").text("Upload");
                    jQuery("#" + id + "_upload_button").attr('disabled', false);
                    submitButtons.attr('disabled', false);
                }else{
                    if(result.status ==="FAILED"){
                        jQuery("#" + id + "_label").text(result.response);
                        jQuery("#" + id + "_upload_button").text("Upload");
                        jQuery("#" + id + "_upload_button").attr('disabled', false);
                        submitButtons.attr('disabled', false);
                    }
                }
            },
            error: function (error) {
                var result = JSON.parse(error);
            }

        });

    } else {
        jQuery("#" + id + "_label").text("Wrong Url Format");
    }
}

function checkURL(url) {
    return (url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

var uploadImplementation = uploadHandler();
jQuery(document).ready(function () {
    uploadImplementation.init();
});
if(Dropzone) {
    Dropzone.autoDiscover = false;
}
