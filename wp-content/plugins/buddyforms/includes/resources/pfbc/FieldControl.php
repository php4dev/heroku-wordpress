<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
* Copyright (c) 2015 Smart Systems
* Copyright (c) 2009-2015 Andrew Porterfield
*
* Version: 4.0
*/

class FieldControl {
	public function __construct() {
		if ( class_exists( 'Element_Upload' ) ) {
			//Element_Upload
			add_action( 'buddyforms_process_field_submission', array( 'Element_Upload', 'upload_process_field_submission' ), 10, 7 );
			add_filter('buddyforms_field_localization', array('Element_Upload', 'localize_string'), 10, 1);
			add_filter('bf_submission_column_default', array('Element_Upload', 'submission_default_value'), 10, 4);
			add_action('buddyforms_update_post_meta', array('Element_Upload', 'save_post_meta'), 10, 2);
			//Element_PostFormats
			add_filter('buddyforms_element_required_validation', array('Element_PostFormats', 'required_validate'), 10, 3);
		}
	}
}
