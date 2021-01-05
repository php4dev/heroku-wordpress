jQuery(document).ready(function() {
    var submitButtons = jQuery("div.form-actions button.bf-submit[type=submit], div.form-actions button.bf-draft[type=button]");
    var submitButton;
    if (submitButtons.length > 0) {
        submitButton = jQuery.map(submitButtons, function (element) {
            return (jQuery(element).attr('type') === 'submit' && jQuery(element).hasClass('bf-submit')) ? jQuery(element) : null;
        })[0];
        var existingHtmlInsideSubmitButton = submitButton.html();
    }

    jQuery(".featured-image-uploader").each(function(index, value) {
        var current = jQuery(this),
            id = current.attr('id'),
            max_file_size = current.attr('max_file_size'),
            page = current.attr('page'),
            uploadFields = current.data('entry');

        var clickeable = page !== 'buddyforms_submissions';
        var currentField = jQuery('#field_' + id);

        if(buddyformsGlobal) {

            // Fallback:
            // Check if the form was already inizialize
            // by a third party plugin or theme.
            const dropzoneControl = current[0].dropzone;
            if (dropzoneControl) {
                dropzoneControl.destroy();
            }

            var myDropzone = new Dropzone("div#" + id, {
                url: buddyformsGlobal.admin_url,
                maxFilesize: max_file_size,
                acceptedFiles: 'image/*',
                maxFiles: 1,
                clickable: clickeable,
                addRemoveLinks: clickeable,
                init: function () {
                    this.on('complete', function () {
                        if (submitButtons.length > 0) {
                            submitButtons.removeAttr("disabled");
                            submitButton.html(existingHtmlInsideSubmitButton);
                        }
                    });
                    this.on('addedfile', function () {
                        jQuery("#field_" + id + "-error").text("");
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                        if (submitButtons.length > 0) {
                            submitButtons.attr("disabled", "disabled");
                            submitButton.html(buddyformsGlobal.localize.upload.submitButton || 'Upload in progress');
                        }
                    });

                    this.on('sending', function (file, xhr, formData) {
                        formData.append('action', 'handle_dropped_media');
                        formData.append('nonce', buddyformsGlobal.ajaxnonce);
                    });

                    this.on('success', function (file, response) {
                        current.removeClass('error');
                        file.previewElement.classList.add("dz-success");
                        file['attachment_id'] = response; // push the id for future reference
                        var ids = currentField.val() + ',' + response;
                        var idsFormat = "";
                        if (ids[0] === ',') {
                            idsFormat = ids.substring(1, ids.length);
                        } else {
                            idsFormat = ids;
                        }
                        currentField.val(idsFormat);
                    });

                    this.on('error', function (file, response) {
                        file.previewElement.classList.add("dz-error");
                        jQuery(file.previewElement).find('div.dz-error-message>span').text(response);
                        if (submitButtons.length > 0) {
                            submitButtons.removeAttr("disabled");
                            submitButton.html(existingHtmlInsideSubmitButton);
                        }
                    });
                    this.on('removedfile', function (file) {
                        var attachment_id = file.attachment_id;
                        var ids = currentField.val();
                        var remainigIds = ids.replace(attachment_id, "");
                        if (remainigIds[0] === ',') {
                            remainigIds = remainigIds.substring(1, ids.length);
                        }
                        var lastChar = remainigIds[remainigIds.length - 1];
                        if (lastChar === ',') {
                            remainigIds = remainigIds.slice(0, -1);
                        }
                        currentField.val(remainigIds);
                        submitButtons.attr("disabled", "disabled");
                        jQuery.post(buddyformsGlobal.admin_url, {
                            action: 'handle_deleted_media',
                            media_id: attachment_id,
                            nonce: buddyformsGlobal.ajaxnonce
                        }, function (data) {
                            console.log(data);
                        }).always(function () {
                            if (submitButtons.length > 0) {
                                submitButtons.removeAttr("disabled");
                                submitButton.html(existingHtmlInsideSubmitButton);
                            }
                        });
                    });

                    if (uploadFields) {
                        for (var key in uploadFields) {
                            if (key) {
                                var mockFile = {
                                    name: uploadFields[key]['name'],
                                    size: uploadFields[key]['size'],
                                    url: uploadFields[key]['url'],
                                    attachment_id: uploadFields[key]['attachment_id']
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
            });
        }

    });
});

if(Dropzone) {
    Dropzone.autoDiscover = false;
}
