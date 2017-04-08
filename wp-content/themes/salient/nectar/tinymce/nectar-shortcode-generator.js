jQuery(document).ready(function($){
	
	$('body').on('click','.nectar-shortcode-generator',function(){
       
 
            $.magnificPopup.open({
                mainClass: 'mfp-zoom-in',
 	 		 	items: {
 	  	     		src: '#nectar-sc-generator'
  	        	},
  	         	type: 'inline',
                removalDelay: 500
	    }, 0);    


        //slim editor shortcodes
	    if($(this).parents('.wp-editor-wrap').find('.wp-editor-area.slim').length > 0 || $(this).hasClass('slim') ) {
	    	$('#nectar-shortcodes optgroup[label="Columns"] option, #nectar-shortcodes optgroup[label="Portfolio/Blog"] option, #nectar-shortcodes option[value="full_width_section"], #nectar-shortcodes option[value="nectar_slider"], #nectar-shortcodes option[value="image_with_animation"], #nectar-shortcodes option[value="tabbed_section"], #nectar-shortcodes option[value="carousel"], #nectar-shortcodes option[value="video"], #nectar-shortcodes option[value="audio"]').hide();
	    	$('#nectar-shortcodes').trigger("chosen:updated");
	    }  else {
	    	$('#nectar-shortcodes optgroup, #nectar-shortcodes optgroup option').show();
	    	$('#nectar-shortcodes').trigger("chosen:updated");
	    }  
 
	}); 


});
