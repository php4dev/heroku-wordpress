/* Prismatic - Admin JavaScript */

jQuery(document).ready(function($) {
	
	$('.wp-admin .wrap form h2').prepend('<span class="fa fa-pad fa-cog"></span> ');
	
	$('.prismatic-reset-options').on('click', function(e) {
		e.preventDefault();
		$('.prismatic-modal-dialog').dialog('destroy');
		var link = this;
		var button_names = {}
		button_names[prismatic_settings.reset_true]  = function() { window.location = link.href; }
		button_names[prismatic_settings.reset_false] = function() { $(this).dialog('close'); }
		$('<div class="prismatic-modal-dialog">'+ prismatic_settings.reset_message +'</div>').dialog({
			title: prismatic_settings.reset_title,
			buttons: button_names,
			modal: true,
			width: 350,
			closeText: ''
		});
	});
	
});
