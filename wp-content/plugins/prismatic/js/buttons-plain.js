/* Prismatic - TinyMCE Buttons for Plain Flavor */

(function() {
	
	'use strict';
	
	tinymce.create('tinymce.plugins.PrismaticButtons', {
		
		init : function(ed, url) {
			
			ed.addButton('button_prism', {
				
				title   : 'Add Preformatted Code',
				icon    : 'code',
				
				onclick : function() {
					
					var code = {
						snippet  : ''
					};
					
					ed.windowManager.open({
						
						title     : 'Add Preformatted Code',
						tooltip   : 'Add Preformatted Code',
						minWidth  : 400,
						minHeight : 300,
						
						body : [
							{
								type        : 'textbox',
								name        : 'snippet',
								placeholder : 'Add Code Here',
								value       : '',
								minWidth    : 400,
								minHeight   : 300,
								multiline   : true,
								value       : code.snippet,
								
								oninput : function() {
									code.snippet = this.value();
								}
							}
						],
						
						onsubmit : function() {
							ed.insertContent('<pre><code>'+ code.snippet + '</code></pre>');
						}
						
					});
					
				}
				
			});
			
		},
		
		createControl : function(n, cm) {
			return null;
		},
		
	});
	
	tinymce.PluginManager.add('prismatic_buttons', tinymce.plugins.PrismaticButtons);
	
})();