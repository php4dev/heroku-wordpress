/* Prismatic - Plain Flavor Block */

var 
	el                = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	PlainText         = wp.editor.PlainText,
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
		
		function onChangeContent(newValue) {
			props.setAttributes({ content: newValue });
		}
		
		return el(
			PlainText,
			{
				tagName     : 'pre',
				key         : 'editable',
				placeholder : __('Add code..', 'prismatic'),
				onChange    : onChangeContent,
				className   : props.className,
				style       : { backgroundColor : props.attributes.backgroundColor, color : props.attributes.textColor },
				value       : props.attributes.content,
			}
		);
		
	},
	
	save : function(props) {
		return el('pre', null, el('code', null, props.attributes.content));
	},
		
});