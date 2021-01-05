<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $license_id = $VARS['license_id']; ?>
<script type="text/javascript">
    (function ($) {
        var prepareLicenseActivationDialog = function () {
            var $dialog = $('.fs-modal-license-activation');

            // Trigger the license activation dialog box.
            $($('.activate-license-trigger')[0]).click();

//            setTimeout(function(){
                $dialog.find('select.fs-licenses option[data-id=<?php echo $license_id ?>]')
                    .prop('selected', true)
                    .change();
//            }, 100);

        };
        if ($('.fs-modal-license-activation').length > 0) {
            prepareLicenseActivationDialog();
        } else {
            $('body').on('licenseActivationLoaded', function () {
                prepareLicenseActivationDialog();
            });
        }
    })(jQuery);
</script>