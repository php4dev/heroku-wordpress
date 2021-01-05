/* Prismatic - Prism.js Block */

var 
	el                = wp.element.createElement,
	Fragment          = wp.element.Fragment,
	registerBlockType = wp.blocks.registerBlockType,
	RichText          = wp.editor.RichText,
	PlainText         = wp.editor.PlainText,
	RawHTML           = wp.editor.RawHTML,
	InspectorControls = wp.editor.InspectorControls,
	SelectControl     = wp.components.SelectControl,
	__                = wp.i18n.__;

registerBlockType('prismatic/blocks', {

	title    : 'Prismatic',
	icon     : 'editor-code',
	category : 'formatting',
	keywords : [ 
		__('code',      'prismatic'), 
		__('pre',       'prismatic'), 
		__('prism',     'prismatic'), 
		__('highlight', 'prismatic'), 
		__('prismatic', 'prismatic') 
	],
	attributes : {
		content : {
			type     : 'string',
			source   : 'text',
			selector : 'pre code',
		},
		language : {
			type    : 'string',
			default : '',
		},
		backgroundColor : {
			type    : 'string',
			default : '#f7f7f7',
		},
		textColor : {
			type    : 'string',
			default : '#373737',
		},
	},

	edit : function(props) {
		
		var 
			content         = props.attributes.content,
			language        = props.attributes.language,
			backgroundColor = props.attributes.backgroundColor,
			textColor       = props.attributes.textColor,
			className       = props.className;
		
		function onChangeContent(newValue) {
			props.setAttributes({ content: newValue });
		}
		
		function onChangelanguage(newValue) {
			props.setAttributes({ language: newValue });
		}
		
		return (
			el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						SelectControl,
						{
							label    : __('Select Language for Prism.js', 'prismatic'),
							value    : language,
							onChange : onChangelanguage,
							options  : [
								{ label : 'Language..',    value : '' },
								{ label : 'Apache',        value : 'apacheconf' },
								{ label : 'AppleScript',   value : 'applescript' },
								{ label : 'Arduino',       value : 'arduino' },
								{ label : 'Bash',          value : 'bash' },
								{ label : 'Batch',         value : 'batch' },
								{ label : 'C',             value : 'c' },
								{ label : 'C#',            value : 'csharp' },
								{ label : 'C++',           value : 'cpp' },
								{ label : 'C-like',        value : 'clike' },
								{ label : 'CoffeeScript',  value : 'coffeescript' },
								{ label : 'CSS',           value : 'css' },
								{ label : 'D',             value : 'd' },
								{ label : 'Dart',          value : 'dart' },
								{ label : 'Diff',          value : 'diff' },
								{ label : 'Elixir',        value : 'elixir' },
								{ label : 'G-code',        value : 'gcode' },
								{ label : 'Git',           value : 'git' },
								{ label : 'Go',            value : 'go' },
								{ label : 'GraphQL',       value : 'graphql' },
								{ label : 'Groovy',        value : 'groovy' },
								{ label : 'HCL',           value : 'hcl' },
								{ label : 'HTML',          value : 'markup' },
								{ label : 'HTTP',          value : 'http' },
								{ label : 'Ini',           value : 'ini' },
								{ label : 'Java',          value : 'java' },
								{ label : 'JavaScript',    value : 'javascript' },
								{ label : 'JSON',          value : 'json' },
								{ label : 'JSX',           value : 'jsx' },
								{ label : 'Kotlin',        value : 'kotlin' },
								{ label : 'LaTeX',         value : 'latex' },
								{ label : 'Liquid',        value : 'liquid' },
								{ label : 'Lua',           value : 'lua' },
								{ label : 'Makefile',      value : 'makefile' },
								{ label : 'Markdown',      value : 'markdown' },
								{ label : 'Markup',        value : 'markup' },
								{ label : 'NGINX',         value : 'nginx' },
								{ label : 'Objective-C',   value : 'objectivec' },
								{ label : 'Pascal',        value : 'pascal' },
								{ label : 'Perl',          value : 'perl' },
								{ label : 'PHP',           value : 'php' },
								{ label : 'PowerShell',    value : 'powershell' },
								{ label : 'Python',        value : 'python' },
								{ label : 'R',             value : 'r' },
								{ label : 'Ruby',          value : 'ruby' },
								{ label : 'Rust',          value : 'rust' },
								{ label : 'SASS',          value : 'sass' },
								{ label : 'Scala',         value : 'scala' },
								{ label : 'SCSS',          value : 'scss' },
								{ label : 'Shell Session', value : 'shell-session' },
								{ label : 'Solidity',      value : 'solidity' },
								{ label : 'SQL',           value : 'sql' },
								{ label : 'Swift',         value : 'swift' },
								{ label : 'TSX',           value : 'tsx' },
								{ label : 'Twig',          value : 'twig' },
								{ label : 'TypeScript',    value : 'typescript' },
								{ label : 'Visual Basic',  value : 'visual-basic' },
								{ label : 'YAML',          value : 'yaml' },
							]
						}
					)
				),
				el(
					PlainText,
					{
						tagName     : 'pre',
						key         : 'editable',
						placeholder : __('Add code..', 'prismatic'),
						className   : className,
						onChange    : onChangeContent,
						style       : { backgroundColor : backgroundColor, color : textColor },
						value       : content,
					}
				)
			)
		);
	},
	
	save : function(props) {
		
		var 
			content  = props.attributes.content,
			language = props.attributes.language;
		
		return el('pre', null, el('code', { className: 'language-'+ language }, content));
		
	},
});