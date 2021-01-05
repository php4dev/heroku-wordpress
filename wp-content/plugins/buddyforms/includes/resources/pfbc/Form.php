<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/*
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
Copyright (c) 2015 Smart Systems
Copyright (c) 2009-2015 Andrew Porterfield

Version: 4.0
*/

/**
 * @param $class
 */
function PFBC_Load( $class ) {
	$file = dirname( __FILE__ ) . "/" . str_replace( "_", DIRECTORY_SEPARATOR, $class ) . ".php";
	if ( is_file( $file ) ) {
		include_once $file;
	}
}

try {
	spl_autoload_register( "PFBC_Load" );
} catch ( Exception $e ) {
	trigger_error( 'BF::PFBC_Load::Autoload_Error', E_USER_NOTICE );
}

/**
 * Class Form
 */
class Form extends Base {
	/**
	 * @var int
	 */
	public static $SUBMIT = 99;
	/**
	 * @var null
	 */
	protected static $form = null;
	/**
	 * @var Element[]
	 */
	protected $_elements = array();
	/**
	 * @var null
	 */
	protected $errorView;
	/**
	 * @var string
	 */
	protected $_prefix = "http";
	/**
	 * @var array
	 */
	protected $_values = array();
	/**
	 * @var array
	 */
	protected $_attributes = array();
	/**
	 * @var
	 */
	protected $ajax;
	/**
	 * @var
	 */
	protected $ajaxCallback;
	/**
	 * @var bool
	 */
	protected $noLabel = false;
	/*Prevents various automated from being automatically applied.  Current options for this array
	included jQuery, bootstrap and focus.*/
	/**
	 * @var string
	 */
	protected $resourcesPath;
	/**
	 * @var array
	 */
	protected $prevent = array();
	/**
	 * @var View_SideBySide
	 */
	protected $view;
	/**
	 * @var ErrorHandler
	 */
	protected $global_error;

	/**
	 * Form constructor.
	 *
	 * @param string $id
	 */
	public function __construct( $id = "pfbc" ) {

		$this->configure( array(
			"action" => $_SERVER['REQUEST_URI'],
			"id"     => preg_replace( "/\W/", "-", $id ),
			"method" => "post"
		) );

		if ( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] == "on" ) {
			$this->_prefix = "https";
		}

		/*The Standard view class is applied by default and will be used unless a different view is
		specified in the form's configure method*/
		if ( empty( $this->view ) ) {
			$this->view = new View_SideBySide;
		}

		$this->global_error = ErrorHandler::get_instance();

		$this->global_error->set_form( $this );

		/*The resourcesPath property is used to identify where third-party resources needed by the
		project are located.  This property will automatically be set properly if the PFBC directory
		is uploaded within the server's document root.  If symbolic links are used to reference the PFBC
		directory, you may need to set this property in the form's configure method or directly in this
		constructor.*/
		$path = dirname( __FILE__ ) . "/Resources";
		if ( strpos( $path, $_SERVER["DOCUMENT_ROOT"] ) !== false ) {
			$this->resourcesPath = substr( $path, strlen( $_SERVER["DOCUMENT_ROOT"] ) );
		} else {
			$this->resourcesPath = "/PFBC/Resources";
		}
	}

	/**
	 * Check if the form Element is valid or not
	 *
	 * @param string $id
	 *
	 * @return bool
	 */
	public static function isValid( $id ) {
		$valid = true;
		if ( ! empty( $id ) ) {
			$global_error = ErrorHandler::get_instance();
			if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
				$data = $_POST;
			} else {
				$data = $_GET;
			}

			$post_id       = ! empty( $data ) && ! empty( $data['post_id'] ) ? $data['post_id'] : 0;
			$form_instance = self::recover_instance( $id, $post_id );

			//Each element's value is saved in the session and checked against any validation rules applied to the element.
			if ( ! empty( $form_instance ) && ! empty( $form_instance->_elements ) ) {
				/** @var Element $element */
				foreach ( $form_instance->_elements as $element ) {
					$name          = $element->getAttribute( "name" );
					$field_options = $element->getFieldOptions();
					if ( $element instanceof Element_Email ) {
						$element->setValidation( new Validation_Email() );
					}
					if ( $element instanceof Element_Phone ) {
						$element->setValidation( new Validation_Phone() );
					}

					if ( $element instanceof Element_Upload ) {
						$name = $field_options['slug'];
					}

					if ( substr( $name, - 2 ) == "[]" ) {
						$name = substr( $name, 0, - 2 );
					}

					//The File element must be handled differently b/c it uses the $_FILES superglobal and not $_GET or $_POST.
					if ( $element instanceof Element_File ) {
						$data[ $name ] = $_FILES[ $name ]["name"];
					}

					if ( isset( $data[ $name ] ) ) {
						$value = $data[ $name ];
						if ( is_array( $value ) ) {
							$valueSize = sizeof( $value );
							for ( $v = 0; $v < $valueSize; ++ $v ) {
								$value[ $v ] = stripslashes( $value[ $v ] );
							}
						} else {
							$value = stripslashes( $value );
						}
					} else {
						$value = null;
					}

					//If a validation error is found, the error message is saved in the session along with the element's name.
					if ( is_array( $value ) ) {
						foreach ( $value as $v ) {
							if ( ! $element->isValid( $v ) ) {
								$element->setAttribute( 'class', 'error' );
								$valid = false;
							}
						}
					} else {
						if ( ! $element->isValid( $value ) ) {
							$element->setAttribute( 'class', 'error' );
							$valid = false;
						}
					}
				}
			}
		}

		return $valid;
	}

	/**
	 * This function create a new instance of the form by the From id
	 *
	 * @param $id
	 * @param $post_id
	 *
	 * @return bool|Form
	 * @since 2.4.7
	 */
	protected static function recover_instance( $id, $post_id ) {
		global $buddyforms;
		$form_instance = false;
		if ( ! empty( $buddyforms ) && ! empty( $buddyforms[ $id ] ) ) {
			$form = $buddyforms[ $id ];

			$form_instance     = new Form( $id );
			$form_instance_arg = array(
				'post_type'    => $form['post_type'],
				'customfields' => $form['form_fields'],
				'post_id'      => $post_id,
				'form_slug'    => $id,
			);

			// if the form has custom field to save as post meta data they get displayed here
			buddyforms_form_elements( $form_instance, $form_instance_arg, true );
		}

		return $form_instance;
	}

	/**
	 * @param $formId
	 * @param $items
	 * @param $values
	 * @param int $buttons
	 */
	public static function renderArray( $formId, $items, $values, $buttons = 1 ) {
		$form = new Form( $formId );
		$opts = Array();

		if ( empty ( $items['ajax'] ) ) {
			$items["ajax"] = Array( "Hidden", "", "", Array( "value" => "false" ) );
		} else {
			$opts['ajax']         = true;
			$opts['ajaxCallback'] = $items['ajax'];
			unset ( $items['ajax'] );
		}
		if ( $buttons ) {
			$items["noneSubmitButton"] = Array( "Button", "Submit" );
			if ( $buttons != Form::$SUBMIT ) {
				if ( ! empty ( $values['id'] ) ) {
					if ( is_array( $buttons ) ) {
						foreach ( $buttons as $k => $b ) {
							$items[ $k ] = $b;
						}
						$items['noneRemoveButton'] = Array(
							"Button",
							"Remove",
							"button",
							array( "class" => "btn-danger", "data-toggle" => "modal", "data-target" => "#rmConfirm" )
						);
					}
				}
				if ( ! empty ( $items['ajax'] ) ) {
					$items["noneCancelButton"] = Array(
						"Button",
						"Cancel",
						"button",
						array( "onclick" => "history.go(-1);" )
					);
				}
			}
		}
		$form->configure( $opts );
		$form->addElements( $items );
		if ( ! empty ( $values ) ) {
			$form->setValues( $values );
		}
		$form->render();
	}

	/**
	 * @param $items
	 */
	public function addElements( $items ) {
		foreach ( $items as $id => $props ) {
			$elementClassName = "Element_" . $props[0];
			for ( $i = 1; $i <= 4; $i ++ ) {
				if ( ! isset ( $props[ $i ] ) ) {
					$props[ $i ] = null;
				}
			}
			$element = new $elementClassName ( $props[1], $props[2], $props[3], $props[4] );
			if ( ! preg_match( "/^none/i", $id ) ) {
				$element->setAttribute( 'name', $id );
			}
			$this->AddElement( $element );
		}
	}

	/**
	 * @param Element $element
	 */
	public function addElement( Element $element ) {
		$element->_setForm( $this );

		//If the element doesn't have a specified id, a generic identifier is applied.
		$id   = $element->getAttribute( "id" );
		$name = $element->getAttribute( "name" );
		if ( empty ( $id ) && $name ) {
			$element->setAttribute( "id", $name );
		} elseif ( empty ( $id ) ) {
			$element->setAttribute( "id", $this->_attributes["id"] . "-element-" . sizeof( $this->_elements ) );
		}
		$this->_elements[] = $element;

		//For ease-of-use, the form tag's encytype attribute is automatically set if the File element class is added.
		if ( $element instanceof Element_File ) {
			$this->_attributes["enctype"] = "multipart/form-data";
		}
	}

	/**
	 * Override element in the element list for other element of the same type
	 *
	 * @param Element $new_element
	 * @param $element_position
	 *
	 * @since 2.5.5
	 *
	 */
	public function overrideExistingElement( Element $new_element, $element_position ) {
		if ( ! empty( $this->_elements ) && isset( $this->_elements[ $element_position ] ) ) {
			$this->_elements[ $element_position ] = $new_element;
		}
	}

	public function overrideAllExistingElements( $new_elements ) {
		if ( isset( $new_elements ) ) {
			$this->_elements = array_values( $new_elements );
		}
	}

	/**
	 * @param array $values
	 */
	public function setValues( array $values ) {
		$this->_values = array_merge( $this->_values, $values );
	}

	/**
	 * @param null $element
	 * @param bool $returnHTML
	 *
	 * @return string
	 */
	public function render( $element = null, $returnHTML = false ) {
		$this->view->_setForm( $this );

		$this->applyValues();

		if ( $returnHTML ) {
			ob_start();
		}

		if ( ! $element ) {
			$this->renderCSS();
			$this->renderJS();
		}
		$this->view->noLabel = $this->noLabel;
		$this->view->render( $element );

		if ( $returnHTML ) {
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		}

		return false;
	}

	protected function applyValues() {
		foreach ( $this->_elements as $element ) {
			$name = $element->getAttribute( "name" );
			if ( isset( $this->_values[ $name ] ) ) {
				$element->setAttribute( "value", $this->_values[ $name ] );
			} elseif ( substr( $name, - 2 ) == "[]" && isset( $this->_values[ substr( $name, 0, - 2 ) ] ) ) {
				$element->setAttribute( "value", $this->_values[ substr( $name, 0, - 2 ) ] );
			}
		}
	}

	/**
	 * This method restores the serialized form instance.
	 */
	protected function renderCSS() {
		$this->renderCSSFiles();

		echo '<style type="text/css">';
		$this->view->renderCSS();
		foreach ( $this->_elements as $element ) {
			$element->renderCSS();
		}
		echo '</style>';
	}

	protected function renderCSSFiles() {
		$urls = array();
		foreach ( $this->_elements as $element ) {
			$elementUrls = $element->getCSSFiles();
			if ( is_array( $elementUrls ) ) {
				$urls = array_merge( $urls, $elementUrls );
			}
		}

		//This section prevents duplicate css files from being loaded.
		if ( ! empty( $urls ) ) {
			$urls = array_values( array_unique( $urls ) );
			foreach ( $urls as $url ) {
				echo '<link type="text/css" rel="stylesheet" href="', $url, '"/>';
			}
		}
	}

	/**
	 * When ajax is used to submit the form's data, validation errors need to be manually sent back to the form using json.
	 */
	protected function renderJS() {
		$this->renderJSFiles();

		ob_start();
		echo '<script type="text/javascript">';
		$this->view->renderJS();
		foreach ( $this->_elements as $element ) {
			$element->renderJS();
		}

		$id        = $this->_attributes["id"];
		$form_slug = str_replace( 'buddyforms_form_', '', $id );
		$method    = $this->_attributes['method'];
		$prevent   = wp_json_encode( $this->prevent );
		if ( $this->ajax ) {
			echo <<<JS
		jQuery(document.body).on('submit', '#$id', function (event) {
		    var formIsInitialized = jQuery(this).data('initialize');
		    var formSlug = '$form_slug';
		    console.log(formSlug);
		    var hasError = (buddyformsGlobal && buddyformsGlobal[formSlug] && buddyformsGlobal[formSlug].hasOwnProperty('errors'));
		    console.log(hasError);
		    if(typeof formIsInitialized !== 'undefined' && !hasError){
		        return false;
		    }
            event.preventDefault();
            console.log('internal submit');
            if(BuddyFormsHooks){
                var formTargetStatus = 'publish';
                var formTargetStatusElement = jQuery(this).find("button[type=submit]:focus" );
                if(formTargetStatusElement){
                    formTargetStatus = formTargetStatusElement.attr('data-status');
                }
                BuddyFormsHooks.doAction('buddyforms:submit', [jQuery(this), event]);
                BuddyFormsHooks.doAction('buddyforms:form:render', ["$form_slug", $prevent, "$this->ajax", "$method", formTargetStatus]);
            } else {
                alert('Error, contact the admin!');
            }
            return false;
        });
JS;
		}
		$this->view->jQueryDocumentReady();
		foreach ( $this->_elements as $element ) {
			$element->jQueryDocumentReady();
		}

		echo '</script>';
		$output = ob_get_clean();

		echo $output;
	}

	protected function renderJSFiles() {
		$urls = array();
		foreach ( $this->_elements as $element ) {
			$elementUrls = $element->getJSFiles();
			if ( is_array( $elementUrls ) ) {
				$urls = array_merge( $urls, $elementUrls );
			}
		}

		//This section prevents duplicate js files from being loaded.
		if ( ! empty( $urls ) ) {
			$urls = array_values( array_unique( $urls ) );
			foreach ( $urls as $url ) {
				echo '<script type="text/javascript" src="', $url, '"></script>';
			}
		}
	}

	/**
	 * @param $formId
	 * @param null $values
	 * @param null $opts
	 *
	 * @return Form|null
	 */
	public static function open( $formId, $values = null, $opts = null ) {
		$default = Array();
		if ( $opts ) {
			foreach ( $opts as $key => $val ) {
				if ( $key == 'ajax' ) {
					$default['ajax']         = 1;
					$default['ajaxCallback'] = $opts['ajax'];
				} elseif ( $key == 'view' ) {
					$viewName        = 'View_' . $val;
					$default[ $key ] = new $viewName;
				} else {
					$default[ $key ] = $val;
				}
			}
		}
		self::$form = new Form ( $formId );
		self::$form->configure( $default );
		if ( ! empty ( $values ) ) {
			self::$form->setValues( $values );
		}
		self::$form->render( 'open' );

		return self::$form;
	}

	/**
	 * @param $type
	 * @param $props
	 *
	 * @return mixed
	 */
	public static function __callStatic( $type, $props ) {
		if ( $type == 'close' ) {
			if ( ! isset ( $props[0] ) ) {
				$props[0] = 1;
			}

			return self::_close( $props[0] );
		}

		return self::_call( self::$form, $type, $props );
	}

	/**
	 * The save method serialized the form's instance and saves it in the session.
	 *
	 * @param $form
	 * @param $type
	 * @param $props
	 *
	 * @return mixed
	 */
	private static function _call( $form, $type, $props ) {
		$elementClassName = "Element_$type";
		for ( $i = 0; $i <= 3; $i ++ ) {
			if ( ! isset ( $props[ $i ] ) ) {
				$props[ $i ] = null;
			}
		}

		$element = new $elementClassName ( $props[0], $props[1], $props[2], $props[3] );
		$form->AddElement( $element );
		$form->applyValues();
		$form->view->renderElement( $element );

		return $form;
	}

	/**
	 * Valldation errors are saved in the session after the form submission, and will be displayed to the user when redirected back to the form.
	 *
	 * @return array
	 */
	public function __sleep() {
		return array( "_attributes", "_elements", "errorView" );
	}

	/**
	 * @return mixed
	 */
	public function getAjax() {
		return $this->ajax;
	}

	/**
	 * An associative array is used to pre-populate form elements.  The keys of this array correspond with the element names.
	 *
	 * @return array
	 */
	public function getElements() {
		return $this->_elements;
	}

	/**
	 * Remove one element from the array of elements
	 *
	 * @param $position
	 *
	 * @since 2.4.6
	 *
	 */
	public function removeElement( $position ) {
		if ( $position >= 0 ) {
			unset( $this->_elements[ $position ] );
			$this->_elements = array_values( $this->_elements );
		}
	}

	/**
	 * @return ErrorView_Standard
	 */
	public function getErrorView() {
		return $this->global_error->get_error_view();
	}

	/**
	 * @return string
	 */
	public function getPrefix() {
		return $this->_prefix;
	}

	/**
	 * @return array
	 */
	public function getPrevent() {
		return $this->prevent;
	}

	/**
	 * @return string
	 */
	public function getResourcesPath() {
		return $this->resourcesPath;
	}

	/**
	 * Return an array errors
	 *
	 * @return WP_Error[]|BuddyForms_Error[]
	 * @since 2.4.7
	 *
	 */
	public function getErrors() {
		$global_error    = ErrorHandler::get_instance();
		$global_bf_error = $global_error->get_global_error();
		if ( ! empty( $global_bf_error ) ) {
			if ( $global_bf_error->has_errors() ) {
				return $global_error->get_global_error()->errors;
			}
		}

		return array();
	}

	/**
	 * @param $type
	 * @param $props
	 *
	 * @return mixed|void
	 */
	public function __call( $type, $props ) {
		if ( $type == 'close' ) {
			return $this->_close( $props[0] );
		}

		return $this->_call( $this, $type, $props );
	}

	/**
	 * @param int $buttons
	 *
	 * @return bool|void
	 */
	public function _close( $buttons = 1 ) {
		$this->renderCSS();
		$this->renderJS();
		if ( ! $buttons ) {
			return $this->view->renderFormClose();
		}
		echo '<div class="row"><div class="col-md-4"></div><div class="col-md-6">';
		$this->Button( "Submit" );
		if ( $buttons != Form::$SUBMIT ) {
			$this->Button( "Remove", "button", array(
				"class"       => "btn-danger",
				"data-toggle" => "modal",
				"data-target" => "#rmConfirm"
			) );
		}

		$this->Button( "Cancel", "button", array( "onclick" => "history.go(-1);" ) );
		echo '</div></div>';
		$this->view->renderFormClose();

		return true;
	}
}
