<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * WPBakery Visual Composer admin editor
 *
 * @package WPBakeryVisualComposer
 *
 */

/**
 * VC backend editor.
 *
 * This editor is available on default Wp post/page admin edit page. ON admin_init callback adds meta box to
 * edit page.
 *
 * @since 4.2
 */
class Vc_Backend_Editor implements Vc_Editor_Interface {

	/**
	 * @var
	 */
	protected $layout;
	/**
	 * @var
	 */
	public $post_custom_css;
	/**
	 * @var bool|string $post - stores data about post.
	 */
	public $post = false;

	/**
	 * This method is called by Vc_Manager to register required action hooks for VC backend editor.
	 *
	 * @since  4.2
	 * @access public
	 */
	public function addHooksSettings() {
		// @todo - fix_roles do this only if be editor is enabled.
		add_action( 'wp_ajax_wpb_get_element_backend_html', array(
			&$this,
			'elementBackendHtml',
		) );
		// load backend editor
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' ); // @todo check is it needed?
		}
		add_action( 'add_meta_boxes', array(
			&$this,
			'render',
		), 5 );
		add_action( 'admin_print_scripts-post.php', array(
			&$this,
			'printScriptsMessages',
		) );
		add_action( 'admin_print_scripts-post-new.php', array(
			&$this,
			'printScriptsMessages',
		) );

	}

	/**
	 *    Calls add_meta_box to create Editor block. Block is rendered by WPBakeryVisualComposerLayout.
	 *
	 * @see WPBakeryVisualComposerLayout
	 * @since  4.2
	 * @access public
	 */
	public function render( $post_type ) {
		if ( $this->isValidPostType( $post_type ) ) {
			$this->registerBackendJavascript();
			$this->registerBackendCss();
			// B.C:
			visual_composer()->registerAdminCss();
			visual_composer()->registerAdminJavascript();

			// meta box to render
			add_meta_box( 'wpb_visual_composer', __( 'Visual Composer', 'js_composer' ), array(
				&$this,
				'renderEditor',
			), $post_type, 'normal', 'high' );
		}
	}

	/**
	 * Output html for backend editor meta box.
	 *
	 * @param null|Wp_Post $post
	 *
	 * @return bool
	 */
	public function renderEditor( $post = null ) {
		/**
		 * TODO: setter/getter for $post
		 */
		if ( ! is_object( $post ) || 'WP_Post' !== get_class( $post ) || ! isset( $post->ID ) ) {
			return false;
		}
		$this->post = $post;
		$post_custom_css = strip_tags( get_post_meta( $post->ID, '_wpb_post_custom_css', true ) );
		$this->post_custom_css = $post_custom_css;
		vc_include_template( 'editors/backend_editor.tpl.php', array(
			'editor' => $this,
			'post' => $this->post,
		) );
		add_action( 'admin_footer', array(
			&$this,
			'renderEditorFooter',
		) );
		do_action( 'vc_backend_editor_render' );

		return true;
	}

	/**
	 * Output required html and js content for VC editor.
	 *
	 * Here comes panels, modals and js objects with data for mapped shortcodes.
	 */
	public function renderEditorFooter() {
		vc_include_template( 'editors/partials/backend_editor_footer.tpl.php', array(
			'editor' => $this,
			'post' => $this->post,
		) );
		do_action( 'vc_backend_editor_footer_render' );
	}

	/**
	 * Check is post type is valid for rendering VC backend editor.
	 *
	 * @return bool
	 */
	public function isValidPostType( $type = '' ) {
		if( 'vc_grid_item' === $type ) { return false; }
		return vc_check_post_type( ! empty( $type ) ? $type : get_post_type() );
	}

	/**
	 * Enqueue required javascript libraries and css files.
	 *
	 * This method also setups reminder about license activation.
	 *
	 * @since  4.2
	 * @access public
	 */
	public function printScriptsMessages() {
		if ( ! vc_is_frontend_editor() && $this->isValidPostType( get_post_type() ) ) {
			if ( vc_user_access()
				->wpAny( 'manage_options' )
				->part( 'settings' )
				->can( 'vc-updater-tab' )
				->get()
			) {
				vc_license()->setupReminder();
			}
			$this->enqueueEditorScripts();
		}
	}

	/**
	 * Enqueue required javascript libraries and css files.
	 *
	 * @since  4.8
	 * @access public
	 */
	public function enqueueEditorScripts() {
		if($this->editorEnabled()) {
			$this->enqueueJs();
			$this->enqueueCss();
			WPBakeryShortCodeFishBones::enqueueCss();
			WPBakeryShortCodeFishBones::enqueueJs();
		} else {
			wp_enqueue_script( 'vc-backend-actions-js' );
			$this->enqueueCss(); //needed for navbar @todo split
		}
		do_action( 'vc_backend_editor_enqueue_js_css' );
	}

	/**
	 * Save generated shortcodes, html and visual composer status in posts meta.
	 *
	 * @deprecated 4.4
	 * @since  3.0
	 * @access public
	 *
	 * @param $post_id - current post id
	 *
	 * @return void
	 */
	public function save( $post_id ) {
		_deprecated_function( '\Vc_Backend_Editor::save', '4.4 (will be removed in 4.10)', '\Vc_Post_Admin::save' );
	}

	/**
	 * Create shortcode's string.
	 *
	 * @since  3.0
	 * @access public
	 * @deprecated 4.9
	 */
	public function elementBackendHtml() {
		_deprecated_function( '\Vc_Backend_Editor::elementBackendHtml', '4.9 (will be removed in 4.10)' );
		vc_user_access()
			->checkAdminNonce()
			->validateDie()
			->wpAny( 'edit_posts', 'edit_pages' )
			->validateDie()
			->part( 'backend_editor' )
			->can()// checks is backend_editor enabled( !== false )
			->validateDie();

		$data_element = vc_post_param( 'data_element' );

		if ( 'vc_column' === $data_element && null !== vc_post_param( 'data_width' ) ) {
			$output = do_shortcode( '[vc_column width="' . vc_post_param( 'data_width' ) . '"]' );
			echo $output;
		} elseif ( 'vc_row' === $data_element || 'vc_row_inner' === $data_element ) {
			$output = do_shortcode( '[' . $data_element . ']' );
			echo $output;
		} else {
			$output = do_shortcode( '[' . $data_element . ']' );
			echo $output;
		}
		die();
	}

	/**
	 * @deprecated 4.8
	 * @return string
	 */
	public function showRulesValue() {
		global $current_user;
		wp_get_current_user();
		/** @var $settings - get use group access rules */
		$settings = vc_settings()->get( 'groups_access_rules' );
		$role = is_object( $current_user ) && isset( $current_user->roles[0] ) ? $current_user->roles[0] : '';

		return isset( $settings[ $role ]['show'] ) ? $settings[ $role ]['show'] : '';
	}

	public function registerBackendJavascript() {
		// editor can be disabled but fe can be enabled. so we currently need this file. @todo maybe make backend-disabled.min.js
		wp_register_script( 'vc-backend-actions-js', vc_asset_url( 'js/dist/backend-actions.min.js' ), array(
			'jquery',
			'backbone',
			'underscore',
		), WPB_VC_VERSION, true );
		wp_register_script( 'vc-backend-min-js', vc_asset_url( 'js/dist/backend.min.js' ), array( 'vc-backend-actions-js' ), WPB_VC_VERSION, true );
		// used in tta shortcodes, and panels.
		wp_register_script( 'vc_accordion_script', vc_asset_url( 'lib/vc_accordion/vc-accordion.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		wp_register_script( 'wpb_php_js', vc_asset_url( 'lib/php.default/php.default.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		// used as polyfill for JSON.stringify and etc
		wp_register_script( 'wpb_json-js', vc_asset_url( 'lib/bower/json-js/json2.min.js' ), array(), WPB_VC_VERSION, true );
		// used in post settings editor
		wp_register_script( 'ace-editor', vc_asset_url( 'lib/bower/ace-builds/src-min-noconflict/ace.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		wp_register_script( 'webfont', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js' ); // Google Web Font CDN

		wp_localize_script( 'vc-backend-actions-js', 'i18nLocale', visual_composer()->getEditorsLocale() );
	}

	public function registerBackendCss() {
		wp_register_style( 'js_composer', vc_asset_url( 'css/js_composer_backend_editor.min.css' ), array(), WPB_VC_VERSION, false );

		if ( $this->editorEnabled() ) {
			/**
			 * @deprecated, used for accordions/tabs/tours
			 */
			wp_register_style( 'ui-custom-theme', vc_asset_url( 'css/ui-custom-theme/jquery-ui-less.custom.min.css' ), array(), WPB_VC_VERSION, false );

			/**
			 * @todo check vc_add-element-deprecated-warning for fa icon usage ( set to our font )
			 * also used in vc_icon shortcode
			 */
			 /* nectar addition */ 
			//wp_register_style( 'font-awesome', vc_asset_url( 'lib/bower/font-awesome/css/font-awesome.min.css' ), array(), WPB_VC_VERSION, false );
			/* nectar addition end */ 
			/**
			 * @todo check for usages
			 * definetelly used in edit form param: css_animation, but curreny vc_add_shortcode_param doesn't accept css [ @todo refactor that ]
			 */
			wp_register_style( 'animate-css', vc_asset_url( 'lib/bower/animate-css/animate.min.css' ), array(), WPB_VC_VERSION, false );
		}
	}

	public function enqueueJs() {
		$wp_dependencies = array(
			'jquery',
			'underscore',
			'backbone',
			'media-views',
			'media-editor',
			'wp-pointer',
			'mce-view',
			'wp-color-picker',
			'jquery-ui-sortable',
			'jquery-ui-droppable',
			'jquery-ui-draggable',
			'jquery-ui-autocomplete',
			'jquery-ui-resizable',
			// used in @deprecated tabs
			'jquery-ui-tabs',
			'jquery-ui-accordion',
		);
		$dependencies = array(
			'vc_accordion_script',
			'wpb_php_js',
			// used in our files [e.g. edit form saving sprintf]
			'wpb_json-js',
			'ace-editor',
			'webfont',
			'vc-backend-min-js',
		);

		// This workaround will allow to disable any of dependency on-the-fly
		foreach ( $wp_dependencies as $dependency ) {
			wp_enqueue_script( $dependency );
		}
		foreach ( $dependencies as $dependency ) {
			wp_enqueue_script( $dependency );
		}
	}

	public function enqueueCss() {
		$wp_dependencies = array(
			'wp-color-picker',
			'farbtastic',
			// deprecated for tabs/accordion
			'ui-custom-theme',
			// used in deprecated message and also in vc-icon shortcode
			'font-awesome',
			// used in css_animation edit form param
			'animate-css',
		);
		$dependencies = array(
			'js_composer',
		);

		// This workaround will allow to disable any of dependency on-the-fly
		foreach ( $wp_dependencies as $dependency ) {
			wp_enqueue_style( $dependency );
		}
		foreach ( $dependencies as $dependency ) {
			wp_enqueue_style( $dependency );
		}
	}

	/**
	 * @return bool
	 */
	public function editorEnabled() {
		return vc_user_access()->part( 'backend_editor' )->can()->get();
	}
}
