<?php
/**
 * =======================================
 * Advanced Custom Fields Font Awesome Admin
 * =======================================
 * 
 * 
 * @author Matt Keys <https://profiles.wordpress.org/mattkeys>
 */

class ACFFA_Admin
{

	private $version;

	public function init()
	{
		$this->version = 'v' . ACFFA_MAJOR_VERSION;

		add_action( 'admin_notices', array( $this, 'show_upgrade_notice' ) );
		add_action( 'admin_notices', array( $this, 'maybe_notify_cdn_error' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'plugin_action_links', array( $this, 'add_settings_link' ), 10, 2 );
		add_action( 'admin_menu', array( $this, 'add_settings_page' ), 100 );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_filter( 'pre_update_option_acffa_settings', array( $this, 'intercept_icon_set_save' ), 10, 2 );
		add_filter( 'pre_update_option_acffa_settings', array( $this, 'maybe_refresh_icons' ), 20, 2 );
		add_action( 'wp_ajax_ACFFA_delete_icon_set', array( $this, 'ajax_remove_icon_set' ) );
	}

	public function show_upgrade_notice()
	{
		$acffa_settings = get_option( 'acffa_settings' );
		if ( ! isset( $acffa_settings['show_upgrade_notice'] ) ) {
			return;
		}
		?>
		<div class="notice notice-info is-dismissible">
			<p><?php echo sprintf( __( 'Visit the new ACF <a href="%s">FontAwesome Settings</a> page to change FontAwesome icon version, or to create custom icon sets.', 'acf-font-awesome' ), admin_url( '/edit.php?post_type=acf-field-group&page=fontawesome-settings' ) ); ?></p>
		</div>
		<?php
		unset( $acffa_settings['show_upgrade_notice'] );
		update_option( 'acffa_settings', $acffa_settings, false );
	}

	public function maybe_notify_cdn_error()
	{
		if ( ! get_option( 'ACFFA_cdn_error' ) ) {
			return;
		}

		delete_option( 'ACFFA_cdn_error' );
		$curl_info = curl_version();
		?>
		<div class="notice notice-error is-dismissible">
			<p><?php _e( 'The plugin "Advanced Custom Fields: Font Awesome" has detected an error while retrieving the latest FontAwesome icons. This may be due to temporary CDN downtime. However if problems persist, please contact your hosting provider to ensure cURL is installed and up to date. Detected cURL version: ', 'acf-font-awesome' ) . $curl_info['version']; ?></p>
		</div>
		<?php
	}

	public function enqueue_scripts( $hook )
	{
		if ( 'custom-fields_page_fontawesome-settings' != $hook ) {
			return;
		}

		wp_register_style( 'font-awesome', apply_filters( 'ACFFA_get_fa_url', '' ) );
		wp_enqueue_style( 'multi-select-css', ACFFA_PUBLIC_PATH . 'assets/inc/multi-select/multi-select.css', array( 'font-awesome' ) );

		wp_register_script( 'quicksearch-js', ACFFA_PUBLIC_PATH . 'assets/inc/quicksearch/jquery.quicksearch.js', array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'multi-select-js', ACFFA_PUBLIC_PATH . 'assets/inc/multi-select/jquery.multi-select.js', array( 'jquery' ), '0.9.12', true );
		wp_enqueue_script( 'acffa-settings', ACFFA_PUBLIC_PATH . 'assets/js/settings.js', array( 'multi-select-js', 'quicksearch-js' ), '1.0.0', true );
		wp_localize_script( 'acffa-settings', 'ACFFA', array(
			'search_string'		=> __( 'Search List', 'acf-font-awesome' ),
			'confirm_delete'	=> __( 'Are you sure you want to delete this icon set?', 'acf-font-awesome' ),
			'delete_fail'		=> __( 'There was an error while trying to delete the icon set, please refresh the page and try again.', 'acf-font-awesome' )
		));
	}

	public function add_settings_link( $links, $file )
	{
		if ( $file != ACFFA_BASENAME ) {
			return $links;
		}

		array_unshift( $links, '<a href="' . esc_url( admin_url( '/edit.php?post_type=acf-field-group&page=fontawesome-settings' ) ) . '">' . esc_html__( 'Settings', 'acf-font-awesome' ) . '</a>' );

		return $links;
	}

	public function add_settings_page()
	{
		$capability = apply_filters( 'acf/settings/capability', 'manage_options' );

		add_submenu_page(
			'edit.php?post_type=acf-field-group',
			'FontAwesome Settings',
			'FontAwesome Settings',
			$capability,
			'fontawesome-settings',
			array( $this, 'fontawesome_settings' )
		);
	}

	public function fontawesome_settings()
	{
		$errors = get_settings_errors( 'acffa_messages' );
		if ( isset( $_GET['settings-updated'] ) && ! $errors ) {
			add_settings_error( 'acffa_messages', 'acffa_message', __( 'Settings Saved', 'acf-font-awesome' ), 'updated' );
		}

		settings_errors( 'acffa_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
					settings_fields( 'acffa' );

					do_settings_sections( 'acffa' );

					submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}

	public function register_settings()
	{
		register_setting(
			'acffa',
			'acffa_settings',
			array(
				'sanitize_callback'	=> array( $this, 'sanitize_new_icon_set' )
			)
		);

		add_settings_section(
			'acffa_section_developers',
			__( 'Major Version', 'acf-font-awesome' ),
			array( $this, 'acffa_section_developers_cb' ),
			'acffa'
		);

		add_settings_field(
			'acffa_major_version',
			__( 'Version', 'acf-font-awesome' ),
			array( $this, 'acffa_major_version_cb' ),
			'acffa',
			'acffa_section_developers',
			array(
				'label_for'	=> 'acffa_major_version',
				'class'		=> 'acffa_row'
			)
		);

		add_settings_field(
			'acffa_pro_cdn',
			__( 'Enable Pro Icons?', 'acf-font-awesome' ),
			array( $this, 'acffa_pro_cdn_cb' ),
			'acffa',
			'acffa_section_developers',
			array(
				'label_for'	=> 'acffa_pro_cdn',
				'class'		=> 'acffa_row pro_icons'
			)
		);

		add_settings_field(
			'acffa_plugin_version',
			'Plugin Version',
			array( $this, 'acffa_plugin_version_cb' ),
			'acffa',
			'acffa_section_developers',
			array(
				'label_for'	=> 'acffa_plugin_version',
				'class'		=> 'acffa_row hidden'
			)
		);

		add_settings_section(
			'acffa_section_icon_set_builder',
			__( 'Icon Set Builder', 'acf-font-awesome' ),
			array( $this, 'acffa_section_icon_set_builder_cb' ),
			'acffa'
		);

		add_settings_field(
			'acffa_new_icon_set_label',
			__( 'New Icon Set Label', 'acf-font-awesome' ),
			array( $this, 'acffa_new_icon_set_label_cb' ),
			'acffa',
			'acffa_section_icon_set_builder',
			array(
				'label_for'	=> 'acffa_new_icon_set_label',
				'class'		=> 'acffa_row custom-icon-set'
			)
		);

		add_settings_field(
			'acffa_new_icon_set',
			__( 'New Icon Set', 'acf-font-awesome' ),
			array( $this, 'acffa_new_icon_set_cb' ),
			'acffa',
			'acffa_section_icon_set_builder',
			array(
				'label_for'	=> 'acffa_new_icon_set',
				'class'		=> 'acffa_row custom-icon-set'
			)
		);

		add_settings_field(
			'acffa_existing_icon_sets',
			__( 'Existing Icon Sets', 'acf-font-awesome' ),
			array( $this, 'acffa_existing_icon_sets_cb' ),
			'acffa',
			'acffa_section_icon_set_builder',
			array(
				'label_for'	=> 'acffa_existing_icon_sets',
				'class'		=> 'acffa_row custom-icon-set'
			)
		);
	}

	public function sanitize_new_icon_set( $data )
	{
		if ( isset( $data['acffa_new_icon_set_label'] ) || ! empty( $data['acffa_new_icon_set_label'] ) ) {
			$data['acffa_new_icon_set_label'] = sanitize_text_field( $data['acffa_new_icon_set_label'] );
		} else {
			$data['acffa_new_icon_set_label'] = false;
		}

		if ( isset( $data['acffa_new_icon_set'] ) || ! empty( $data['acffa_new_icon_set'] ) ) {
			$data['acffa_new_icon_set'] = array_map(
				'sanitize_text_field',
				wp_unslash( $data['acffa_new_icon_set'] )
			);
		} else {
			$data['acffa_new_icon_set'] = false;
		}

		if ( $data['acffa_new_icon_set_label'] && ! $data['acffa_new_icon_set'] ) {
			add_settings_error( 'acffa_messages', 'missing_label', __( 'Please select at least one icon when adding a new custom icon set.', 'acf-font-awesome' ), 'error' );
		} else if ( $data['acffa_new_icon_set'] && ! $data['acffa_new_icon_set_label'] ) {
			add_settings_error( 'acffa_messages', 'missing_icons', __( 'Label is required when adding a new custom icon set.', 'acf-font-awesome' ), 'error' );
		}

		return $data;
	}

	public function acffa_section_developers_cb( $args )
	{
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php _e( 'FontAwesome underwent big changes with the release of version 5. It is best to choose a version and stick with it.', 'acf-font-awesome' ); ?><br>
			<em><?php _e( 'Any icon selections saved prior to switching versions will need to be re-selected and re-saved after switching.', 'acf-font-awesome' ); ?></em>
		</p>
		<?php
	}

	public function acffa_major_version_cb( $args )
	{
		$options = get_option( 'acffa_settings' );
		$attributes = defined( 'ACFFA_OVERRIDE_MAJOR_VERSION' ) ? 'disabled' : false;
		?>
		<select <?php echo $attributes; ?> id="<?php echo esc_attr( $args['label_for'] ); ?>" name="acffa_settings[<?php echo esc_attr( $args['label_for'] ); ?>]">
			<option value="4" <?php echo isset( $options[ $args[ 'label_for'] ] ) ? ( selected( $options[ $args[ 'label_for'] ], 4, false ) ) : ( '' ); ?>>
			<?php _e( '4.x', 'acf-font-awesome' ); ?>
			</option>
			<option value="5" <?php echo isset( $options[ $args[ 'label_for'] ] ) ? ( selected( $options[ $args[ 'label_for'] ], 5, false ) ) : ( '' ); ?>>
			<?php _e( '5.x', 'acf-font-awesome' ); ?>
			</option>
		</select>
		<?php
		if ( defined( 'ACFFA_OVERRIDE_MAJOR_VERSION' ) ) :
			?>
			<p>
				<em><?php _e( 'The major version is manually set with the "ACFFA_override_major_version" filter, and cannot be modified from this screen. Please remove or update the filter to make changes.', 'acf-font-awesome' ); ?></em>
			</p>
			<?php
		endif;
	}

	public function acffa_pro_cdn_cb( $args )
	{
		$options = get_option( 'acffa_settings' );
		?>
		<p>
			<?php _e( 'If you have a FontAwesome Pro license, check the box below to enable the pro icons.', 'acf-font-awesome' ); ?><br>
			<em><?php _e( 'NOTE: You MUST add this domain in your FontAwesome "Pro CDN Domains" in order for this to work!', 'acf-font-awesome' ); ?></em>
		</p>
		<br>
		<p>
			<input type="checkbox" value="1" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="acffa_settings[<?php echo esc_attr( $args['label_for'] ); ?>]" <?php echo isset( $options[ $args[ 'label_for'] ] ) ? ( checked( $options[ $args[ 'label_for'] ] ) ) : ( '' ); ?> />
			<label for="<?php echo esc_attr( $args['label_for'] ); ?>"><?php _e( 'I have enabled this domain for CDN use. Turn on the pro icons!', 'acf-font-awesome' ); ?></label>
		</p>
		<?php
	}

	public function acffa_plugin_version_cb( $args )
	{
		?>
		<input type="hidden" value="<?php echo ACFFA_VERSION; ?>" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="acffa_settings[<?php echo esc_attr( $args['label_for'] ); ?>]" />
		<?php
	}

	public function acffa_section_icon_set_builder_cb( $args )
	{
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>">
			<?php _e( 'Use the icon set builder to create custom collections of FontAwesome icons to be used in your ACF FontAwesome fields', 'acf-font-awesome' ); ?><br>
			<em><?php _e( 'If you\'ve made changes the the FontAwesome version you are loading above, please refresh this page to see those changes reflected in the list below.', 'acf-font-awesome' ); ?></em>
		</p>
		<p class="icon-builder-complete-changes-notice">
	 		<strong><?php _e( 'You must save your changes to the major version before using the icon set builder.', 'acf-font-awesome' ); ?></strong>
		</p>
		<?php
	}

	public function acffa_new_icon_set_label_cb( $args )
	{
		?>
		<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="acffa_settings[<?php echo esc_attr( $args['label_for'] ); ?>]" placeholder="<?php _e( 'Custom Icon Set Name', 'acf-font-awesome' ); ?>">
		<p>
			<em><?php _e( 'NOTE: Providing a label that is already in use will overwrite the existing custom icon set.', 'acf-font-awesome' ); ?></em>
		</p>
		<?php
	}

	public function acffa_new_icon_set_cb( $args )
	{
		$options = get_option( 'acffa_settings' );
		?>
		<select multiple="multiple" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="acffa_settings[<?php echo esc_attr( $args['label_for'] ); ?>][]">
			<?php
				$fa_icons = apply_filters( 'ACFFA_get_icons', array() );
				if ( $fa_icons ) {
					if ( version_compare( ACFFA_MAJOR_VERSION, 5, '>=' ) ) {
						foreach ( $fa_icons['list'] as $prefix => $icons ) {
							$optgroup_label = apply_filters( 'ACFFA_icon_prefix_label', 'Regular', $prefix );
							echo '<optgroup label="' . $optgroup_label . '">';

							foreach( $icons as $k => $v ) {
								$value = str_replace( array( 'fas ', 'far ', 'fab ', 'fal ', 'fad ', 'fa-' ), '', $k );
								?>
								<option value="<?php echo $k; ?>"><?php echo $value; ?></option>
								<?php
							}

							echo '</optgroup>';
						}
					} else {
						foreach ( $fa_icons['list'] as $k => $v ) {
							$value = str_replace( array( 'fa-' ), '', $k );
							?>
							<option value="<?php echo $k; ?>"><?php echo $value; ?></option>
							<?php
						}
					}
				} else {
					?>
					<option value=""><?php _e( 'No Icons Found', 'acf-font-awesome' ); ?></option>
					<?php
				}
			?>
		</select>
		<?php
	}

	public function acffa_existing_icon_sets_cb( $args )
	{
		$custom_icon_sets_list = get_option( 'ACFFA_custom_icon_sets_list' );

		if ( isset( $custom_icon_sets_list[ $this->version ] ) && ! empty( $custom_icon_sets_list[ $this->version ] ) ) {
			?>
			<ul class="existing-custom-icon-sets">
			<?php
			foreach ( $custom_icon_sets_list[ $this->version ] as $icon_set_name => $icon_set_label ) {
				$icon_set = get_option( $icon_set_name );

				if ( ! $icon_set ) {
					$this->remove_icon_set( $custom_icon_sets_list, $icon_set_name, true );
				}
				?>
				<li class="icon-set" data-set-label="<?php echo esc_html( $icon_set_label ); ?>" data-set-name="<?php echo esc_html( $icon_set_name ); ?>">
					<span><strong><?php echo esc_html( $icon_set_label ); ?></strong> <span class="actions">( <a href="#" class="edit-icon-set"><?php _e( 'Load For Editing', 'acf-font-awesome' ); ?></a> | <a href="#" class="view-icon-list"><?php _e( 'Toggle Icon List', 'acf-font-awesome' ); ?></a> | <a href="#" class="delete-icon-set" data-icon-set-name="<?php echo esc_html( $icon_set_name ); ?>" data-nonce="<?php echo wp_create_nonce( 'acffa_delete_set_' . $icon_set_name ); ?>"><?php _e( 'Delete Icon Set', 'acf-font-awesome' ); ?></a> )</span></span>
					<ul class="icon-list">
						<?php
							if ( version_compare( ACFFA_MAJOR_VERSION, 5, '>=' ) ) {
								foreach ( $icon_set as $prefix => $icons ) {
									?>
									<li>
										<?php echo apply_filters( 'ACFFA_icon_prefix_label', 'Regular', $prefix ); ?>
										<ul>
											<?php
												foreach ( $icons as $class => $label ) {
													echo '<li class="icon" data-icon="' . $class . '">' . $label . '</li>';
												}
											?>
										</ul>
									</li>
									<?php
								}
							} else {
								foreach ( $icon_set as $class => $label ) {
									?>
									<li>
										<?php
											echo '<li class="icon" data-icon="' . $class . '">' . $label . '</li>';
										?>
									</li>
									<?php
								}
							}
						?>
					</ul>
				</li>
				<?php
			}
			?>
			</ul>
			<?php
		} else {
			_e( 'No existing custom icon set(s) found.', 'acf-font-awesome' );
		}
	}

	public function intercept_icon_set_save( $new_value, $old_value )
	{
		$label = $new_value['acffa_new_icon_set_label'];
		$icons = $new_value['acffa_new_icon_set'];

		unset( $new_value['acffa_new_icon_set_label'] );
		unset( $new_value['acffa_new_icon_set'] );

		if ( $label && $icons ) {
			$this->save_new_icon_set( $label, $icons );
		}

		return $new_value;
	}

	public function maybe_refresh_icons( $new_value, $old_value )
	{
		unset( $new_value['acffa_new_icon_set_label'] );
		unset( $new_value['acffa_new_icon_set'] );

		$refresh_icons = false;

		if ( $new_value['acffa_major_version'] !== $old_value['acffa_major_version'] ) {
			$refresh_icons = true;
		}

		if ( ! $refresh_icons ) {
			if ( ( isset( $new_value['acffa_pro_cdn'] ) && ! isset( $old_value['acffa_pro_cdn'] ) )
				 || ( ! isset( $new_value['acffa_pro_cdn'] ) && isset( $old_value['acffa_pro_cdn'] ) )
			) {
				 $refresh_icons = true;
			}
		}

		if ( $refresh_icons ) {
			do_action( 'ACFFA_refresh_latest_icons' );
		}

		return $new_value;
	}

	private function save_new_icon_set( $label, $icons )
	{
		$new_icon_set = array();

		$fa_icons = apply_filters( 'ACFFA_get_icons', array() );

		if ( version_compare( ACFFA_MAJOR_VERSION, 5, '>=' ) ) {
			foreach( $icons as $icon ) {
				$prefix = substr( $icon, 0, 3 );

				if ( isset( $fa_icons['list'][ $prefix ][ $icon ] ) ) {
					if ( ! isset( $new_icon_set[ $prefix ] ) ) {
						$new_icon_set[ $prefix ] = array();
					}
					$new_icon_set[ $prefix ][ $icon ] = $fa_icons['list'][ $prefix ][ $icon ];
				}
			}
		} else {
			foreach( $icons as $icon ) {
				if ( isset( $fa_icons['list'][ $icon ] ) ) {
					$new_icon_set[ $icon ] = $fa_icons['list'][ $icon ];
				}
			}
		}

		if ( ! empty( $new_icon_set ) ) {
			$option_name = 'ACFFA_custom_icon_list_' . $this->version . '_' . sanitize_html_class( $label );
			update_option( $option_name, $new_icon_set, false );
			$this->update_custom_icon_sets_list( $option_name, $label );
		}
	}

	private function update_custom_icon_sets_list( $option_name, $label )
	{
		$icon_sets_list = get_option( 'ACFFA_custom_icon_sets_list' );

		if ( ! $icon_sets_list ) {
			$icon_sets_list = array();
		}

		if ( ! isset( $icon_sets_list[ $this->version ] ) ) {
			$icon_sets_list[ $this->version ] = array();
		}

		if ( ! isset( $icon_sets_list[ $this->version ][ 'ACFFA_custom_icon_list_' . $option_name ] ) ) {
			$icon_sets_list[ $this->version ][ $option_name ] = $label;
		}

		update_option( 'ACFFA_custom_icon_sets_list', $icon_sets_list, false );
	}

	private function remove_icon_set( $custom_icon_sets_list = false, $icon_set_name, $list_only = false )
	{
		if ( ! $custom_icon_sets_list ) {
			$custom_icon_sets_list = get_option( 'ACFFA_custom_icon_sets_list' );
		}

		if ( ! isset( $custom_icon_sets_list[ $this->version ][ $icon_set_name ] ) ) {
			return;
		}

		unset( $custom_icon_sets_list[ $this->version ][ $icon_set_name ] );

		update_option( 'ACFFA_custom_icon_sets_list', $custom_icon_sets_list );

		if ( ! $list_only ) {
			delete_option( $icon_set_name );
		}
	}

	public function ajax_remove_icon_set()
	{
		$valid_nonce = check_ajax_referer( 'acffa_delete_set_' . $_POST['icon_set_name'], 'nonce', false );

		if ( ! $valid_nonce ) {
			wp_die( 'fail' );
		}

		$this->remove_icon_set( false, $_POST['icon_set_name'] );

		wp_die( 'success' );
	}

}

add_action( 'acf/init', array( new ACFFA_Admin, 'init' ), 10 );
