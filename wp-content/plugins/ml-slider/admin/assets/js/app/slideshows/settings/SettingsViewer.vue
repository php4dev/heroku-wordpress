<script>
import { EventManager } from '../../utils'
export default {
	props: {
	},
	data() {
		return {}
	},
	mounted() {
		let $ = window.jQuery

		// This code was ported from admin.js and will be refactored in a later branch
        $(".useWithCaution").on("change", function(){
            if(!this.checked) {
                return alert(metaslider.useWithCaution);
            }
		});
		
    	$(".metaslider-ui").on('click', '.ms-toggle .hndle, .ms-toggle .handlediv', function() {
            $(this).parent().toggleClass('closed');
		});
		
		// Switch slider types when on the label and pressing enter
        $('.metaslider-ui').on('keypress', '.slider-lib-row label', function (event) {
            if (32 === event.which) {
                event.preventDefault();
                $('.slider-lib-row #' + $(this).attr('for')).trigger('click');
            }
		});
		
		// Enable the correct options for this slider type
        var switchType = function(slider) {
            $('.metaslider .option:not(.' + slider + ')').attr('disabled', 'disabled').parents('tr').hide();
            $('.metaslider .option.' + slider).removeAttr('disabled').parents('tr').show();
            $('.metaslider input.radio:not(.' + slider + ')').attr('disabled', 'disabled');
            $('.metaslider input.radio.' + slider).removeAttr('disabled');
    
            $('.metaslider .showNextWhenChecked:visible').parent().parent().next('tr').hide();
            $('.metaslider .showNextWhenChecked:visible:checked').parent().parent().next('tr').show();
    
            // make sure that the selected option is available for this slider type
            if ($('.effect option:selected').attr('disabled') === 'disabled') {
                $('.effect option:enabled:first').attr('selected', 'selected');
            }
    
            // make sure that the selected option is available for this slider type
            if ($('.theme option:selected').attr('disabled') === 'disabled') {
                $('.theme option:enabled:first').attr('selected', 'selected');
            }
        };
    
        // enable the correct options on page load
        switchType($(".metaslider .select-slider:checked").attr("rel"));
    
        var toggleNextRow = function(checkbox) {
            if(checkbox.is(':checked')){
                checkbox.parent().parent().next("tr").show();
            } else {
                checkbox.parent().parent().next("tr").hide();
            }
		}
		
		toggleNextRow($(".showNextWhenChecked"))
		EventManager.$on('metaslider/app-loaded', () => { toggleNextRow($(".showNextWhenChecked")) })
    
        $(".metaslider-ui").on("change", ".showNextWhenChecked", function() {
            toggleNextRow($(this));
        });
    
        // mark the slide for resizing when the crop position has changed
        $(".metaslider-ui").on('change', '.left tr.slide .crop_position', function() {
            $(this).closest('tr').data('crop_changed', true);
        });
    
        // handle slide libary switching
        $(".metaslider-ui").on("click", ".select-slider", function() {
            switchType($(this).attr("rel"));
        });
	}
}
</script>
