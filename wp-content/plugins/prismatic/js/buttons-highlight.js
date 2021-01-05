/* Prismatic - TinyMCE Buttons for Highlight.js */

(function() {
	
	'use strict';
	
	tinymce.create('tinymce.plugins.PrismaticButtons', {
		
		init : function(ed, url) {
			
			ed.addButton('button_prism', {
				
				title   : 'Add Highlight.js Code',
				icon    : 'code',
				
				onclick : function() {
					
					var code = {
						language : '',
						snippet  : ''
					};
					
					ed.windowManager.open({
						
						title     : 'Add Highlight.js code',
						tooltip   : 'Add Highlight.js code',
						minWidth  : 400,
						minHeight : 300,
						
						body : [
							{
								type     : 'listbox',
								name     : 'language',
								value    : '',
								minWidth : 400,
								value    : code.language,
								
								values : [
									{ text : 'Language..',    value : '' },
									{ text : 'Apache',        value : 'apache' },
									{ text : 'AppleScript',   value : 'applescript' },
									{ text : 'Arduino',       value : 'arduino' },
									{ text : 'Bash',          value : 'bash' },
									{ text : 'C#',            value : 'cs' },
									{ text : 'C++',           value : 'cpp' },
									{ text : 'CSS',           value : 'css' },
									{ text : 'CoffeeScript',  value : 'coffeescript' },
									{ text : 'D',             value : 'd' },
									{ text : 'Dart',          value : 'dart' },
									{ text : 'Diff',          value : 'diff' },
									{ text : 'Elixir',        value : 'elixir' },
									{ text : 'G-code',        value : 'gcode' },
									{ text : 'GML',           value : 'gml' },
									{ text : 'Go',            value : 'go' },
									{ text : 'Groovy',        value : 'groovy' },
									{ text : 'HTML/XML',      value : 'xml' },
									{ text : 'HTTP',          value : 'http' },
									{ text : 'Ini',           value : 'ini' },
									{ text : 'JSON',          value : 'json' },
									{ text : 'Java',          value : 'java' },
									{ text : 'JavaScript',    value : 'javascript' },
									{ text : 'Kotlin',        value : 'kotlin' },
									{ text : 'Lua',           value : 'lua' },
									{ text : 'Makefile',      value : 'makefile' },
									{ text : 'Markdown',      value : 'markdown' },
									{ text : 'Nginx',         value : 'nginx' },
									{ text : 'Objective-C',   value : 'objectivec' },
									{ text : 'PHP',           value : 'php' },
									{ text : 'Perl',          value : 'perl' },
									{ text : 'Plaintext',     value : 'plaintext' },
									{ text : 'PowerShell',    value : 'powershell' },
									{ text : 'Python',        value : 'python' },
									{ text : 'R',             value : 'r' },
									{ text : 'Ruby',          value : 'ruby' },
									{ text : 'Rust',          value : 'rust' },
									{ text : 'Scala',         value : 'scala' },
									{ text : 'Shell Session', value : 'shell' },
									{ text : 'SQL',           value : 'sql' },
									{ text : 'Swift',         value : 'swift' },
									{ text : 'TypeScript',    value : 'typescript' },
									{ text : 'YAML',          value : 'yaml' },
								],
								
								onselect : function() {
									code.language = this.value();
								},
							},
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
							ed.insertContent('<pre><code class="language-'+ code.language +'">'+ code.snippet + '</code></pre>');
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