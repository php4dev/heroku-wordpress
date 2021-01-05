<?php
/**
 * Dashboard page class: Dashboard extends Abstract_Page.
 *
 * @since 2.9.0
 * @package Smush\App\Pages
 */

namespace Smush\App\Pages;

use Smush\App\Abstract_Page;
use Smush\Core\Core;
use Smush\Core\Settings;
use WP_Smush;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Dashboard
 */
class Dashboard extends Abstract_Page {

	/**
	 * Register page action hooks
	 */
	public function add_action_hooks() {
		parent::add_action_hooks();

		add_action( 'smush_setting_column_right_inside', array( $this, 'settings_desc' ), 10, 2 );
		add_action( 'smush_setting_column_right_inside', array( $this, 'auto_smush' ), 15, 2 );
		add_action( 'smush_setting_column_right_inside', array( $this, 'image_sizes' ), 15, 2 );
		add_action( 'smush_setting_column_right_inside', array( $this, 'resize_settings' ), 20, 2 );
		add_action( 'smush_setting_column_right_inside', array( $this, 'usage_settings' ), 25, 2 );
		add_action( 'smush_setting_column_right_inside', array( $this, 'detection_settings' ), 10, 2 );
		add_action( 'smush_setting_column_right_outside', array( $this, 'full_size_options' ), 20, 2 );

		// Add stats to stats box.
		add_action( 'stats_ui_after_resize_savings', array( $this, 'pro_savings_stats' ), 15 );
		add_action( 'stats_ui_after_resize_savings', array( $this, 'conversion_savings_stats' ), 15 );

		// Icons in the submenu.
		add_filter( 'wp_smush_admin_after_tab_' . $this->get_slug(), array( $this, 'after_tab' ) );
	}

	/**
	 * Function triggered when the page is loaded before render any content.
	 */
	public function on_load() {
		// If a free user, update the limits.
		if ( ! WP_Smush::is_pro() ) {
			// Reset transient.
			Core::check_bulk_limit( true );
		}

		// Init the tabs.
		$this->tabs = apply_filters(
			'smush_setting_tabs',
			array(
				'bulk'         => __( 'Bulk Smush', 'wp-smushit' ),
				'directory'    => __( 'Directory Smush', 'wp-smushit' ),
				'integrations' => __( 'Integrations', 'wp-smushit' ),
				'lazy_load'    => __( 'Lazy Load', 'wp-smushit' ),
				'cdn'          => __( 'CDN', 'wp-smushit' ),
				'webp'         => __( 'WebP', 'wp-smushit' ),
				'tools'        => __( 'Tools', 'wp-smushit' ),
				'settings'     => __( 'Settings', 'wp-smushit' ),
				'tutorials'    => __( 'Tutorials', 'wp-smushit' ),
			)
		);

		// Don't display if Dashboard's whitelabel is hiding the documentation.
		if ( apply_filters( 'wpmudev_branding_hide_doc_link', false ) ) {
			unset( $this->tabs['tutorials'] );
		}

		$access = Settings::can_access();

		if ( ( ! is_network_admin() && ! $access ) || ( is_network_admin() && true === $access ) ) {
			unset( $this->tabs['bulk'] );
			unset( $this->tabs['integrations'] );
			unset( $this->tabs['lazy_load'] );
			unset( $this->tabs['cdn'] );
			unset( $this->tabs['tools'] );
			unset( $this->tabs['tutorials'] );
		}

		if ( is_network_admin() && is_array( $access ) ) {
			foreach ( $this->tabs as $tab => $name ) {
				if ( ! in_array( $tab, $access, true ) ) {
					continue;
				}

				unset( $this->tabs[ $tab ] );
			}
		}

		if ( ! is_network_admin() && is_array( $access ) ) {
			foreach ( $this->tabs as $tab => $name ) {
				if ( in_array( $tab, $access, true ) ) {
					continue;
				}

				unset( $this->tabs[ $tab ] );
			}
		}

		// Disabled on all subsites.
		if ( is_multisite() && ! is_network_admin() ) {
			unset( $this->tabs['webp'] );
			unset( $this->tabs['settings'] );
		}
	}

	/**
	 * Register meta boxes.
	 */
	public function register_meta_boxes() {
		if ( ! is_network_admin() ) {
			$this->add_meta_box(
				'summary',
				null,
				array( $this, 'dashboard_summary_metabox' ),
				null,
				null,
				'summary',
				array(
					'box_class'         => 'sui-box sui-summary sui-summary-smush',
					'box_content_class' => false,
				)
			);

			// If not a pro user.
			if ( ! WP_Smush::is_pro() ) {
				/**
				 * Allows to hook in additional containers after stats box for free version
				 * Pro Version has a full width settings box, so we don't want to do it there.
				 */
				do_action( 'wp_smush_after_stats_box' );
			}
		}

		if ( 'bulk' === $this->get_current_tab() && $this->should_render() ) {
			if ( ! is_network_admin() ) {
				// Show bulk smush box if a subsite admin.
				$class = WP_Smush::is_pro() ? 'wp-smush-pro-install' : '';
				$this->add_meta_box(
					'bulk',
					__( 'Bulk Smush', 'wp-smushit' ),
					array( $this, 'bulk_smush_metabox' ),
					null,
					null,
					'bulk',
					array(
						'box_class' => "sui-box bulk-smush-wrapper {$class}",
					)
				);
			}

			// Only for the Free version and when there aren't images to smush.
			if ( ! WP_Smush::is_pro() ) {
				$this->add_meta_box(
					'bulk/upgrade',
					'',
					null,
					null,
					null,
					'bulk',
					array(
						'box_class' => 'sui-box sui-hidden',
					)
				);
			}

			$class = WP_Smush::is_pro() ? 'wp-smush-pro' : '';
			$this->add_meta_box(
				'bulk-settings',
				__( 'Settings', 'wp-smushit' ),
				array( $this, 'bulk_settings_metabox' ),
				null,
				array( $this, 'common_metabox_footer' ),
				'bulk',
				array(
					'box_class' => "sui-box smush-settings-wrapper {$class}",
				)
			);

			// Do not show if pro user.
			if ( ! WP_Smush::is_pro() ) {
				$this->add_meta_box(
					'pro-features',
					__( 'Upgrade to Smush Pro', 'wp-smushit' ),
					array( $this, 'pro_features_metabox' ),
					null,
					null,
					'bulk'
				);
			}
		}

		if ( 'directory' === $this->get_current_tab() && $this->should_render() ) {
			$this->add_meta_box(
				'directory',
				__( 'Directory Smush', 'wp-smushit' ),
				array( $this, 'directory_smush_metabox' ),
				null,
				null,
				'directory',
				array(
					'box_class' => 'sui-box sui-message sui-no-padding',
				)
			);
		}

		if ( 'integrations' === $this->get_current_tab() && $this->should_render() ) {
			// Show integrations box.
			$class = WP_Smush::is_pro() ? 'smush-integrations-wrapper wp-smush-pro' : 'smush-integrations-wrapper';
			$this->add_meta_box(
				'integrations',
				__( 'Integrations', 'wp-smushit' ),
				array( $this, 'integrations_metabox' ),
				null,
				array( $this, 'common_metabox_footer' ),
				'integrations',
				array(
					'box_class'         => "sui-box {$class}",
					'box_content_class' => 'sui-box-body sui-upsell-items',
				)
			);
		}

		if ( 'lazy_load' === $this->get_current_tab() && $this->should_render() ) {
			if ( ! $this->settings->get( 'lazy_load' ) ) {
				$this->add_meta_box(
					'lazyload/disabled',
					__( 'Lazy Load', 'wp-smushit' ),
					null,
					array( $this, 'lazyload_metabox_header' ),
					null,
					'lazy_load',
					array(
						'box_class' => 'sui-box sui-message sui-no-padding',
					)
				);
			} else {
				$this->add_meta_box(
					'lazyload',
					__( 'Lazy Load', 'wp-smushit' ),
					array( $this, 'lazyload_metabox' ),
					array( $this, 'lazyload_metabox_header' ),
					array( $this, 'common_metabox_footer' ),
					'lazy_load'
				);
			}
		}

		if ( 'cdn' === $this->get_current_tab() && $this->should_render() ) {
			if ( ! WP_Smush::is_pro() ) {
				$this->add_meta_box(
					'cdn-upsell',
					__( 'CDN', 'wp-smushit' ),
					array( $this, 'cdn_upsell_metabox' ),
					array( $this, 'cdn_upsell_metabox_header' ),
					null,
					'cdn'
				);
			} else {
				if ( ! $this->settings->get( 'cdn' ) ) {
					$this->add_meta_box(
						'cdn/disabled',
						__( 'CDN', 'wp-smushit' ),
						null,
						array( $this, 'cdn_metabox_header' ),
						null,
						'cdn'
					);
				} else {
					$this->add_meta_box(
						'cdn',
						__( 'CDN', 'wp-smushit' ),
						array( $this, 'cdn_metabox' ),
						array( $this, 'cdn_metabox_header' ),
						array( $this, 'common_metabox_footer' ),
						'cdn'
					);
				}
			}
		}

		if ( 'webp' === $this->get_current_tab() && $this->should_render() ) {
			if ( ! WP_Smush::is_pro() ) {
				$this->add_meta_box(
					'webp/upsell',
					__( 'WebP', 'wp-smushit' ),
					null,
					array( $this, 'webp_upsell_metabox_header' ),
					null,
					'webp'
				);
			} else {
				if ( ! $this->settings->get( 'webp_mod' ) ) {
					$this->add_meta_box(
						'webp/disabled',
						__( 'WebP', 'wp-smushit' ),
						null,
						array( $this, 'webp_metabox_header' ),
						null,
						'webp'
					);
				} else {
					$this->add_meta_box(
						'webp/webp',
						__( 'WebP', 'wp-smushit' ),
						null,
						array( $this, 'webp_metabox_header' ),
						null,
						'webp'
					);

					if ( ! WP_Smush::get_instance()->core()->mod->webp->is_configured() ) {
						$this->add_meta_box(
							'webp_config',
							__( 'Configurations', 'wp-smushit' ),
							array( $this, 'webp_config_metabox' ),
							null,
							null,
							'webp'
						);
					}
				}
			}
		}

		if ( 'tools' === $this->get_current_tab() && $this->should_render() ) {
			$box_body_class = WP_Smush::is_pro() ? '' : 'sui-upsell-items';
			$this->add_meta_box(
				'tools',
				__( 'Tools', 'wp-smushit' ),
				array( $this, 'tools_metabox' ),
				null,
				array( $this, 'common_metabox_footer' ),
				'tools',
				array(
					'box_content_class' => "sui-box-body {$box_body_class}",
				)
			);
		}

		if ( 'settings' === $this->get_current_tab() && ( is_network_admin() || $this->should_render() ) ) {
			$this->add_meta_box(
				'settings',
				__( 'Settings', 'wp-smushit' ),
				array( $this, 'settings_metabox' ),
				null,
				array( $this, 'common_metabox_footer' ),
				'settings'
			);
		}

		if ( 'tutorials' === $this->get_current_tab() && $this->should_render() ) {
			$this->add_meta_box(
				'tutorials',
				__( 'Tutorials', 'wp-smushit' ),
				array( $this, 'tutorials_metabox' ),
				null,
				null,
				'tutorials'
			);
		}
	}

	/**
	 * Add remaining count to bulk smush tab.
	 *
	 * @param string $tab  Current tab.
	 */
	public function after_tab( $tab ) {
		// Don't display the count on the network admin for MU.
		if ( 'bulk' === $tab && ! is_network_admin() ) {
			$remaining = $this->get_total_images_to_smush();
			echo '<span class="sui-tag sui-tag-warning wp-smush-remaining-count' . ( 0 < $remaining ? '' : ' sui-hidden' ) . '">' . absint( $remaining ) . '</span>';
			echo '<i class="sui-icon-check-tick sui-success' . ( 0 < $remaining ? ' sui-hidden' : '' ) . '" aria-hidden="true"></i>';
		} elseif ( 'cdn' === $tab ) {
			$status = WP_Smush::get_instance()->core()->mod->cdn->status();
			if ( 'overcap' === $status ) {
				echo '<i class="sui-icon-warning-alert sui-error" aria-hidden="true"></i>';
			} elseif ( 'upgrade' === $status || 'activating' === $status ) {
				echo '<i class="sui-icon-warning-alert sui-warning" aria-hidden="true"></i>';
			} elseif ( 'enabled' === $status ) {
				echo '<i class="sui-icon-check-tick sui-success" aria-hidden="true"></i>';
			}
		} elseif ( 'lazy_load' === $tab && $this->settings->get( 'lazy_load' ) ) {
			echo '<i class="sui-icon-check-tick sui-success" aria-hidden="true"></i>';
		} elseif ( 'webp' === $tab ) {
			if ( ! WP_Smush::is_pro() || ! $this->settings->get( 'webp_mod' ) ) {
				return;
			}

			if ( WP_Smush::get_instance()->core()->mod->webp->is_configured() ) {
				echo '<i id="webp-tab-icon" class="sui-icon-check-tick sui-success" aria-hidden="true"></i>';
			} else {
				echo '<i id="webp-tab-icon" class="sui-icon-warning-alert sui-warning" aria-hidden="true"></i>';
			}
		}
	}

	/**
	 * Prints Dimensions required for Resizing
	 *
	 * @param string $name Setting name.
	 * @param string $class_prefix Custom class prefix.
	 */
	public function resize_settings( $name = '', $class_prefix = '' ) {
		// Add only to full size settings.
		if ( 'resize' !== $name ) {
			return;
		}

		// Dimensions.
		$resize_sizes = $this->settings->get_setting(
			WP_SMUSH_PREFIX . 'resize_sizes',
			array(
				'width'  => '',
				'height' => '',
			)
		);

		// Set default prefix is custom prefix is empty.
		$prefix = empty( $class_prefix ) ? WP_SMUSH_PREFIX : $class_prefix;

		// Get max dimensions.
		$max_sizes = WP_Smush::get_instance()->core()->get_max_image_dimensions();

		$setting_status = $this->settings->get( 'resize' );
		?>
		<div class="wp-smush-resize-settings-wrap<?php echo $setting_status ? '' : ' sui-hidden'; ?>">
			<div class="sui-row">
				<div class="sui-col">
					<label aria-labelledby="<?php echo esc_attr( $prefix ); ?>label-max-width" for="<?php echo esc_attr( $prefix ) . esc_attr( $name ) . '_width'; ?>" class="sui-label">
						<?php esc_html_e( 'Max width', 'wp-smushit' ); ?>
					</label>
					<input aria-required="true" type="number" class="sui-form-control wp-smush-resize-input"
							aria-describedby="<?php echo esc_attr( $prefix ); ?>resize-note"
							id="<?php echo esc_attr( $prefix ) . esc_attr( $name ) . '_width'; ?>"
							name="<?php echo esc_attr( WP_SMUSH_PREFIX ) . esc_attr( $name ) . '_width'; ?>"
							value="<?php echo isset( $resize_sizes['width'] ) && ! empty( $resize_sizes['width'] ) ? absint( $resize_sizes['width'] ) : 2560; ?>">
				</div>
				<div class="sui-col">
					<label aria-labelledby="<?php echo esc_attr( $prefix ); ?>label-max-height" for="<?php echo esc_attr( $prefix . $name ) . '_height'; ?>" class="sui-label">
						<?php esc_html_e( 'Max height', 'wp-smushit' ); ?>
					</label>
					<input aria-required="true" type="number" class="sui-form-control wp-smush-resize-input"
							aria-describedby="<?php echo esc_attr( $prefix ); ?>resize-note"
							id="<?php echo esc_attr( $prefix . $name ) . '_height'; ?>"
							name="<?php echo esc_attr( WP_SMUSH_PREFIX . $name ) . '_height'; ?>"
							value="<?php echo isset( $resize_sizes['height'] ) && ! empty( $resize_sizes['height'] ) ? absint( $resize_sizes['height'] ) : 2560; ?>">
				</div>
			</div>
			<div class="sui-description" id="<?php echo esc_attr( $prefix ); ?>resize-note">
				<?php
				printf(
					/* translators: %1$s: strong tag, %2$d: max width size, %3$s: tag, %4$d: max height size, %5$s: closing strong tag  */
					esc_html__( 'Currently, your largest image size is set at %1$s%2$dpx wide %3$s %4$dpx high%5$s.', 'wp-smushit' ),
					'<strong>',
					esc_html( $max_sizes['width'] ),
					'&times;',
					esc_html( $max_sizes['height'] ),
					'</strong>'
				);
				?>
				<div class="sui-notice sui-notice-info wp-smush-update-width sui-no-margin-bottom sui-hidden">
					<div class="sui-notice-content">
						<div class="sui-notice-message">
							<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
							<p><?php esc_html_e( "Just to let you know, the width you've entered is less than your largest image and may result in pixelation.", 'wp-smushit' ); ?></p>
						</div>
					</div>
				</div>
				<div class="sui-notice sui-notice-info wp-smush-update-height sui-no-margin-bottom sui-hidden">
					<div class="sui-notice-content">
						<div class="sui-notice-message">
							<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
							<p><?php esc_html_e( 'Just to let you know, the height you’ve entered is less than your largest image and may result in pixelation.', 'wp-smushit' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<span class="sui-description sui-toggle-description">
			<?php
			printf(
				/* translators: %s: link to gifgifs.com */
				esc_html__(
					'Note: Image resizing happens automatically when you upload attachments. To support
				retina devices, we recommend using 2x the dimensions of your image size. Animated GIFs will not be
				resized as they will lose their animation, please use a tool such as %s to resize
				then re-upload.',
					'wp-smushit'
				),
				'<a href="http://gifgifs.com/resizer/" target="_blank">http://gifgifs.com/resizer/</a>'
			);
			?>
			</span>
		<?php
	}

	/**
	 * Display a description in Settings - Usage Tracking.
	 *
	 * @since 3.1.0
	 *
	 * @param string $name  Setting name.
	 */
	public function usage_settings( $name ) {
		// Add only to full size settings.
		if ( 'usage' !== $name ) {
			return;
		}
		?>

		<span class="sui-description sui-toggle-description">
			<?php
			esc_html_e( 'Note: Usage tracking is completely anonymous. We are only tracking what features you are/aren’t using to make our feature decisions more informed.', 'wp-smushit' );
			?>
		</span>
		<?php
	}

	/**
	 * Display a description in Tools - Image Resize Detection.
	 *
	 * @since 3.2.1
	 *
	 * @param string $name  Setting name.
	 */
	public function detection_settings( $name ) {
		// Add only to full size settings.
		if ( 'detection' !== $name ) {
			return;
		}
		?>

		<span class="sui-description sui-toggle-description">
			<?php
			esc_html_e( 'Note: The highlighting will only be visible to administrators – visitors won’t see the highlighting.', 'wp-smushit' );
			?>
			<?php if ( $this->settings->get( 'detection' ) ) : ?>
				<?php if ( $this->settings->get( 'cdn' ) && $this->settings->get( 'auto_resize' ) ) : ?>
					<div class="sui-notice smush-highlighting-notice">
						<div class="sui-notice-content">
							<div class="sui-notice-message">
								<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
								<p>
									<?php
									esc_html_e(
										'Note: Images served via the Smush CDN are automatically resized to fit their containers, these will be skipped.',
										'wp-smushit'
									);
									?>
								</p>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="sui-notice sui-notice-info smush-highlighting-notice">
						<div class="sui-notice-content">
							<div class="sui-notice-message">
								<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
								<p>
									<?php
									printf(
										/* translators: %1$s: opening a tag, %2$s: closing a tag */
										esc_html__(
											'Incorrect image size highlighting is active. %1$sView the frontend%2$s of your website to see if any images aren\'t the correct size for their containers.',
											'wp-smushit'
										),
										'<a href="' . esc_url( home_url() ) . '" target="_blank">',
										'</a>'
									);
									?>
								</p>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php elseif ( 'detection' === $name ) : ?>
				<div class="sui-notice sui-notice-warning smush-highlighting-warning sui-hidden">
					<div class="sui-notice-content">
						<div class="sui-notice-message">
							<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
							<p><?php esc_html_e( 'Almost there! To finish activating this feature you must save your settings.', 'wp-smushit' ); ?></p>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</span>
		<?php
	}

	/**
	 * Show super smush stats in stats section.
	 *
	 * If a pro member and super smush is enabled, show super smushed
	 * stats else show message that encourage them to enable super smush.
	 * If free user show the avg savings that can be achived using Pro.
	 *
	 * @return void
	 */
	public function pro_savings_stats() {
		$core = WP_Smush::get_instance()->core();

		if ( ! WP_Smush::is_pro() ) {
			if ( empty( $core->stats ) || empty( $core->stats['pro_savings'] ) ) {
				$core->set_pro_savings();
			}
			$pro_savings      = $core->stats['pro_savings'];
			$show_pro_savings = $pro_savings['savings'] > 0;
			if ( $show_pro_savings ) {
				?>
				<li class="smush-avg-pro-savings" id="smush-avg-pro-savings">
					<span class="sui-list-label"><?php esc_html_e( 'Pro Savings', 'wp-smushit' ); ?>
						<span class="sui-tag sui-tag-pro sui-tooltip sui-tooltip-constrained" data-tooltip="<?php esc_html_e( 'Join WPMU DEV to unlock multi-pass lossy compression', 'wp-smushit' ); ?>">
							<?php esc_html_e( 'PRO', 'wp-smushit' ); ?>
						</span>
					</span>
					<span class="sui-list-detail wp-smush-stats">
						<span class="wp-smush-stats-human"><?php echo esc_html( $pro_savings['savings'] ); ?></span>
						<span class="wp-smush-stats-sep">/</span>
						<span class="wp-smush-stats-percent"><?php echo esc_html( $pro_savings['percent'] ); ?></span>%
					</span>
				</li>
				<?php
			}
		} else {
			$compression_savings = 0;
			if ( ! empty( $core->stats ) && ! empty( $core->stats['bytes'] ) ) {
				$compression_savings = $core->stats['bytes'] - $core->stats['resize_savings'];
			}
			?>
			<li class="super-smush-attachments">
				<span class="sui-list-label">
					<?php esc_html_e( 'Super-Smush Savings', 'wp-smushit' ); ?>
					<?php if ( ! $this->settings->get( 'lossy' ) ) { ?>
						<p class="wp-smush-stats-label-message sui-hidden-sm sui-hidden-md sui-hidden-lg">
							<?php
							$link_class = 'wp-smush-lossy-enable-link';
							if ( ( is_multisite() && Settings::can_access( 'bulk' ) ) || 'bulk' !== $this->get_current_tab() ) {
								$settings_link = $this->get_page_url() . '#enable-lossy';
							} else {
								$settings_link = '#';
								$link_class    = 'wp-smush-lossy-enable';
							}
							printf(
								/* translators: %1$s; starting a tag, %2$s: ending a tag */
								esc_html__( 'Compress images up to 2x more than regular smush with almost no visible drop in quality. %1$sEnable Super-Smush%2$s', 'wp-smushit' ),
								'<a role="button" class="' . esc_attr( $link_class ) . '" href="' . esc_url( $settings_link ) . '">',
								'</a>'
							);
							?>
						</p>
					<?php } ?>
				</span>
				<?php if ( WP_Smush::is_pro() ) : ?>
					<span class="sui-list-detail wp-smush-stats">
						<?php if ( ! $this->settings->get( 'lossy' ) ) : ?>
							<a role="button" class="sui-hidden-xs <?php echo esc_attr( $link_class ); ?>" href="<?php echo esc_url( $settings_link ); ?>">
								<?php esc_html_e( 'Enable Super-Smush', 'wp-smushit' ); ?>
							</a>
						<?php else : ?>
							<span class="smushed-savings">
								<?php echo esc_html( size_format( $compression_savings, 1 ) ); ?>
							</span>
						<?php endif; ?>
					</span>
				<?php endif; ?>
			</li>
			<?php
		}
	}

	/**
	 * Show conversion savings stats in stats section.
	 *
	 * Show Png to Jpg conversion savings in stats box if the
	 * settings enabled or savings found.
	 *
	 * @return void
	 */
	public function conversion_savings_stats() {
		$core = WP_Smush::get_instance()->core();

		if ( WP_Smush::is_pro() && ! empty( $core->stats['conversion_savings'] ) && $core->stats['conversion_savings'] > 0 ) {
			?>
			<li class="smush-conversion-savings">
				<span class="sui-list-label">
					<?php esc_html_e( 'PNG to JPEG savings', 'wp-smushit' ); ?>
				</span>
				<span class="sui-list-detail wp-smush-stats">
					<?php echo $core->stats['conversion_savings'] > 0 ? esc_html( size_format( $core->stats['conversion_savings'], 1 ) ) : '0 MB'; ?>
				</span>
			</li>
			<?php
		}
	}

	/**
	 * Single settings row html content.
	 *
	 * @param string $setting_m_key  Setting key.
	 * @param string $label          Setting label.
	 * @param string $name           Setting name.
	 * @param mixed  $setting_val    Setting value.
	 * @param bool   $disable        Disable the setting.
	 * @param bool   $upsell         Gray out row to show upsell.
	 *
	 * @return void
	 */
	public function settings_row( $setting_m_key, $label, $name, $setting_val, $disable = false, $upsell = false ) {
		?>
		<div class="sui-box-settings-row wp-smush-basic <?php echo $upsell || $disable ? 'sui-disabled' : ''; ?>">
			<div class="sui-box-settings-col-1">
				<span class="sui-settings-label <?php echo 'gutenberg' === $name ? 'sui-settings-label-with-tag' : ''; ?>">
					<?php echo esc_html( $label ); ?>
					<?php do_action( 'smush_setting_column_tag', $name ); ?>
				</span>

				<span class="sui-description">
					<?php echo wp_kses_post( WP_Smush::get_instance()->core()->settings[ $name ]['desc'] ); ?>
				</span>
			</div>
			<div class="sui-box-settings-col-2" id="column-<?php echo esc_attr( $setting_m_key ); ?>">
				<div class="sui-form-field">
					<?php if ( isset( WP_Smush::get_instance()->core()->settings[ $name ]['label'] ) ) : ?>
						<label for="<?php echo esc_attr( $setting_m_key ); ?>" class="sui-toggle">
							<input
								type="checkbox"
								value="1"
								id="<?php echo esc_attr( $setting_m_key ); ?>"
								name="<?php echo esc_attr( $setting_m_key ); ?>"
								aria-labelledby="<?php echo esc_attr( $setting_m_key . '-label' ); ?>"
								aria-describedby="<?php echo esc_attr( $setting_m_key . '-desc' ); ?>"
								<?php checked( $setting_val, 1, true ); ?>
								<?php disabled( $disable ); ?>
							/>
							<span class="sui-toggle-slider" aria-hidden="true"></span>
							<span id="<?php echo esc_attr( $setting_m_key . '-label' ); ?>" class="sui-toggle-label">
								<?php echo esc_html( WP_Smush::get_instance()->core()->settings[ $name ]['label'] ); ?>
							</span>
						</label>
					<?php endif; ?>
					<!-- Print/Perform action in right setting column -->
					<?php do_action( 'smush_setting_column_right_inside', $name ); ?>
				</div>
				<!-- Print/Perform action in right setting column -->
				<?php do_action( 'smush_setting_column_right_outside', $name ); ?>
			</div>
		</div>
		<?php
	}

	/**
	 * Show additional descriptions for settings.
	 *
	 * @param string $setting_key Setting key.
	 */
	public function settings_desc( $setting_key = '' ) {
		if ( empty( $setting_key ) || ! in_array(
			$setting_key,
			array(
				'resize',
				'original',
				'strip_exif',
				'png_to_jpg',
				's3',
			),
			true
		) ) {
			return;
		}

		if ( 'png_to_jpg' === $setting_key ) {
			?>
			<div class="sui-toggle-content">
				<div class="sui-notice sui-notice-info" style="margin-top: 10px">
					<div class="sui-notice-content">
						<div class="sui-notice-message">
							<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
							<p>
								<?php
								printf(
									/* translators: %1$s - <strong>, %2$s - </strong> */
									wp_kses( 'Note: Any PNGs with transparency will be ignored. Smush will only convert PNGs if it results in a smaller file size. The resulting file will have a new filename and extension (JPEG), and %1$sany hard-coded URLs on your site that contain the original PNG filename will need to be updated manually%2$s.', 'wp-smushit' ),
									'<strong>',
									'</strong>'
								);
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<?php
			return;
		}

		global $wp_version;

		?>
		<span class="sui-description sui-toggle-description" id="<?php echo esc_attr( WP_SMUSH_PREFIX . $setting_key . '-desc' ); ?>">
			<?php
			switch ( $setting_key ) {
				case 'resize':
					if ( version_compare( $wp_version, '5.2.999', '>' ) ) {
						esc_html_e( 'As of WordPress 5.3, large image uploads are resized down to a specified max width and height. If you require images larger than 2560px, you can override this setting here.', 'wp-smushit' );
					} else {
						esc_html_e( 'Save a ton of space by not storing over-sized images on your server. Set a maximum height and width for all images uploaded to your site so that any unnecessarily large images are automatically resized before they are added to the media gallery. This setting does not apply to images smushed using Directory Smush feature.', 'wp-smushit' );
					}
					break;
				case 'original':
					if ( version_compare( $wp_version, '5.2.999', '>' ) ) {
						esc_html_e( 'As of WordPress v5.3, every image that gets uploaded will have your normal thumbnail outputs, a new max sized image, and the original upload as backup. By default, Smush will only compress the thumbnail sizes your theme outputs, skipping the new max sized image. Enable this setting to include optimizing this image too.', 'wp-smushit' );
					} else {
						esc_html_e( 'By default, bulk smush will ignore your original uploads and only compress the thumbnail sizes your theme outputs. Enable this setting to also smush your original uploads. We recommend storing copies of your originals (below) in case you ever need to restore them.', 'wp-smushit' );
					}
					break;
				case 'strip_exif':
					esc_html_e(
						'Note: This data adds to the size of the image. While this information might be
					important to photographers, it’s unnecessary for most users and safe to remove.',
						'wp-smushit'
					);
					break;
				case 's3':
					esc_html_e( 'Note: For this process to happen automatically you need automatic smushing enabled.', 'wp-smushit' );
					break;
				default:
					break;
			}
			?>
		</span>
		<?php
	}

	/**
	 * Prints notice after auto compress settings.
	 *
	 * @since 3.2.1
	 *
	 * @param string $name  Setting key.
	 */
	public function auto_smush( $name = '' ) {
		// Add only to auto smush settings.
		if ( 'auto' !== $name ) {
			return;
		}

		$setting_status = $this->settings->get( 'auto' );

		?>
		<div class="sui-toggle-content">
			<div class="sui-notice <?php echo $setting_status ? '' : ' sui-hidden'; ?>" style="margin-top: 10px">
				<div class="sui-notice-content">
					<div class="sui-notice-message">
						<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
						<p><?php esc_html_e( 'Note: We will only automatically compress the image sizes selected above.', 'wp-smushit' ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Prints all the registered image sizes, to be selected/unselected for smushing.
	 *
	 * @param string $name Setting key.
	 *
	 * @return void
	 */
	public function image_sizes( $name = '' ) {
		// Add only to bulk smush settings.
		if ( 'bulk' !== $name ) {
			return;
		}

		// Additional image sizes.
		$image_sizes = $this->settings->get_setting( WP_SMUSH_PREFIX . 'image_sizes', false );
		$sizes       = WP_Smush::get_instance()->core()->image_dimensions();

		$all_selected = false === $image_sizes || count( $image_sizes ) === count( $sizes );
		?>
		<?php if ( ! empty( $sizes ) ) : ?>
			<div class="sui-side-tabs sui-tabs">
				<div data-tabs="">
					<label for="all-image-sizes" class="sui-tab-item <?php echo $all_selected ? 'active' : ''; ?>">
						<input type="radio" name="wp-smush-auto-image-sizes" value="all" id="all-image-sizes" <?php checked( $all_selected ); ?>>
						<?php esc_html_e( 'All', 'wp-smushit' ); ?>
					</label>
					<label for="custom-image-sizes" class="sui-tab-item <?php echo $all_selected ? '' : 'active'; ?>">
						<input type="radio" name="wp-smush-auto-image-sizes" value="custom" id="custom-image-sizes" <?php checked( $all_selected, false ); ?>>
						<?php esc_html_e( 'Custom', 'wp-smushit' ); ?>
					</label>
				</div><!-- end data-tabs -->
				<div data-panes>
					<div class="sui-tab-boxed <?php echo $all_selected ? 'active' : ''; ?>" style="display:none"></div>
					<div class="sui-tab-boxed <?php echo $all_selected ? '' : 'active'; ?>">
						<span class="sui-label"><?php esc_html_e( 'Included image sizes', 'wp-smushit' ); ?></span>
						<?php
						foreach ( $sizes as $size_k => $size ) {
							// If image sizes array isn't set, mark all checked ( Default Values ).
							if ( false === $image_sizes ) {
								$checked = true;
							} else {
								// WPMDUDEV hosting support: cast $size_k to string to properly work with object cache.
								$checked = is_array( $image_sizes ) ? in_array( (string) $size_k, $image_sizes, true ) : false;
							}
							?>
							<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
								<input type="checkbox" <?php checked( $checked, true ); ?>
										id="wp-smush-size-<?php echo esc_attr( $size_k ); ?>"
										name="wp-smush-image_sizes[]"
										value="<?php echo esc_attr( $size_k ); ?>">
								<span aria-hidden="true">&nbsp;</span>
								<span>
									<?php if ( isset( $size['width'], $size['height'] ) ) : ?>
										<?php echo esc_html( $size_k . ' (' . $size['width'] . 'x' . $size['height'] . ') ' ); ?>
									<?php else : ?>
										<?php echo esc_attr( $size_k ); ?>
									<?php endif; ?>
								</span>
							</label>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}

	/**
	 * Prints Resize, Smush Original, and Backup settings.
	 *
	 * @param string $name  Name of the current setting being processed.
	 */
	public function full_size_options( $name = '' ) {
		// Continue only if original image option.
		if ( 'original' !== $name || ! WP_Smush::is_pro() ) {
			return;
		}

		$setting_val = $this->settings->get( 'backup' );
		$setting_key = WP_SMUSH_PREFIX . 'backup';
		?>
		<div class="sui-form-field">
			<label for="<?php echo esc_attr( $setting_key ); ?>" class="sui-toggle">
				<input
					type="checkbox"
					value="1"
					id="<?php echo esc_attr( $setting_key ); ?>"
					name="<?php echo esc_attr( $setting_key ); ?>"
					aria-labelledby="<?php echo esc_attr( $setting_key . '-label' ); ?>"
					aria-describedby="<?php echo esc_attr( $setting_key ); ?>-desc"
					<?php checked( $setting_val, 1 ); ?>
				/>
				<span class="sui-toggle-slider" aria-hidden="true"></span>
				<span id="<?php echo esc_attr( $setting_key . '-label' ); ?>" class="sui-toggle-label">
					<?php echo esc_html( WP_Smush::get_instance()->core()->settings['backup']['label'] ); ?>
				</span>
			</label>
			<span class="sui-description sui-toggle-description">
				<?php echo esc_html( WP_Smush::get_instance()->core()->settings['backup']['desc'] ); ?>
			</span>
		</div>
		<?php
	}

	/**
	 * Show directory smush result notice.
	 *
	 * If we are redirected from a directory smush finish page,
	 * show the result notice if success/fail count is available.
	 *
	 * @since 2.9.0
	 */
	public function smush_result_notice() {
		// Get the counts from transient.
		$items          = (int) get_transient( 'wp-smush-show-dir-scan-notice' );
		$failed_items   = (int) get_transient( 'wp-smush-dir-scan-failed-items' );
		$skipped_items  = (int) get_transient( 'wp-smush-dir-scan-skipped-items' ); // Skipped because already optimized.
		$notice_message = esc_html__( 'Image compression complete.', 'wp-smushit' ) . ' ';
		$notice_class   = 'error';

		$total = $items + $failed_items + $skipped_items;

		/**
		 * 1 image was successfully optimized / 10 images were successfully optimized
		 * 1 image was skipped because it was already optimized / 5/10 images were skipped because they were already optimized
		 * 1 image resulted in an error / 5/10 images resulted in an error, check the logs for more information
		 *
		 * 2/10 images were skipped because they were already optimized and 4/10 resulted in an error
		 */

		if ( 0 === $failed_items && 0 === $skipped_items ) {
			$notice_message .= sprintf(
				/* translators: %d - number of images */
				_n(
					'%d image was successfully optimized',
					'%d images were successfully optimized',
					$items,
					'wp-smushit'
				),
				$items
			);
			$notice_class = 'success';
		} elseif ( 0 <= $skipped_items && 0 === $failed_items ) {
			$notice_message .= sprintf(
				/* translators: %1$d - number of skipped images, %2$d - total number of images */
				_n(
					'%d image was skipped because it was already optimized',
					'%1$d/%2$d images were skipped because they were already optimized',
					$skipped_items,
					'wp-smushit'
				),
				$skipped_items,
				$total
			);
			$notice_class = 'success';
		} elseif ( 0 === $skipped_items && 0 <= $failed_items ) {
			$notice_message .= sprintf(
				/* translators: %1$d - number of failed images, %2$d - total number of images */
				_n(
					'%d resulted in an error',
					'%1$d/%2$d images resulted in an error, check the logs for more information',
					$failed_items,
					'wp-smushit'
				),
				$failed_items,
				$total
			);
		} elseif ( 0 <= $skipped_items && 0 <= $failed_items ) {
			$notice_message .= sprintf(
				/* translators: %1$d - number of skipped images, %2$d - total number of images, %3$d - number of failed images */
				esc_html__( '%1$d/%2$d images were skipped because they were already optimized and %3$d/%2$d images resulted in an error', 'wp-smushit' ),
				$skipped_items,
				$total,
				$failed_items
			);
			$notice_class = 'warning';
		}

		// If we have counts, show the notice.
		if ( 0 < $total ) {
			// Delete the transients.
			delete_transient( 'wp-smush-show-dir-scan-notice' );
			delete_transient( 'wp-smush-dir-scan-failed-items' );
			delete_transient( 'wp-smush-dir-scan-skipped-items' );
			?>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					window.SUI.openNotice(
						'wp-smush-ajax-notice',
						'<p><?php echo $notice_message; ?></p>',
						{
							type: '<?php echo $notice_class; ?>',
							icon: 'info',
							dismiss: {
								show: true,
								label: '<?php esc_html_e( 'Dismiss', 'wp-smushit' ); ?>',
								tooltip: '<?php esc_html_e( 'Dismiss', 'wp-smushit' ); ?>',
							},
						}
					);
				});
			</script>
			<?php
		}
	}

	/**************************
	 * META BOXES
	 */

	/**
	 * Summary meta box.
	 */
	public function dashboard_summary_metabox() {
		$core = WP_Smush::get_instance()->core();

		$resize_count = $core->get_savings( 'resize', false, false, true );

		// Split human size to get format and size.
		$human = explode( ' ', $core->stats['human'] );

		$resize_savings = 0;
		// Get current resize savings.
		if ( ! empty( $core->stats['resize_savings'] ) && $core->stats['resize_savings'] > 0 ) {
			$resize_savings = size_format( $core->stats['resize_savings'], 1 );
		}

		$this->view(
			'summary/meta-box',
			array(
				'human_format'    => empty( $human[1] ) ? 'B' : $human[1],
				'human_size'      => empty( $human[0] ) ? '0' : $human[0],
				'remaining'       => $this->get_total_images_to_smush(),
				'resize_count'    => ! $resize_count ? 0 : $resize_count,
				'resize_enabled'  => (bool) $this->settings->get( 'resize' ),
				'resize_savings'  => $resize_savings,
				'stats_percent'   => $core->stats['percent'] > 0 ? number_format_i18n( $core->stats['percent'], 1 ) : 0,
				'total_optimized' => $core->stats['total_images'],
			)
		);
	}

	/**
	 * Returns the tutorials data to display.
	 *
	 * @since 3.7.1
	 * @return array
	 */
	protected function get_tutorials_data() {
		return array(
			array(
				'title'             => __( 'How to Get the Most Out of Smush Image Optimization', 'wp-smushit' ),
				'content'           => __( 'Set your site up for maximum success. Learn how to get the most out of Smush and streamline your images for peak site performance.', 'wp-smushit' ),
				'thumbnail_full'    => 'tutorial-1-thumbnail.png',
				'thumbnail_full_2x' => 'tutorial-1-thumbnail@2x.png',
				'url'               => 'https://premium.wpmudev.org/blog/how-to-get-the-most-out-of-smush/',
				'read_time'         => 5,
			),
			array(
				'title'             => __( "How To Ace Google's Image Page Speed Recommendations", 'wp-smushit' ),
				'content'           => __( "See how toggling specific Smush settings can easily help you resolve all 4 of Google's 'image-related' page speed recommendations.", 'wp-smushit' ),
				'thumbnail_full'    => 'tutorial-2-thumbnail.png',
				'thumbnail_full_2x' => 'tutorial-2-thumbnail@2x.png',
				'url'               => 'https://premium.wpmudev.org/blog/smush-pagespeed-image-compression/',
				'read_time'         => 6,
			),
			array(
				'title'             => __( 'How To Bulk Optimize Images With Smush', 'wp-smushit' ),
				'content'           => __( 'Skip the hassle of compressing all your images manually. Learn how Smush can easily help you do it in bulk.', 'wp-smushit' ),
				'thumbnail_full'    => 'tutorial-3-thumbnail.png',
				'thumbnail_full_2x' => 'tutorial-3-thumbnail@2x.png',
				'url'               => 'https://premium.wpmudev.org/blog/smush-bulk-optimize-images/',
				'read_time'         => 6,
			),
		);
	}

	/**
	 * Bulk smush meta box.
	 *
	 * Container box to handle bulk smush actions. Show progress bars,
	 * bulk smush action buttons etc. in this box.
	 */
	public function bulk_smush_metabox() {
		$core = WP_Smush::get_instance()->core();

		$total_images_to_smush = $this->get_total_images_to_smush();

		// This is the same calculation used for $core->remaining_count,
		// except that we don't add the re-smushed count here.
		$unsmushed_count = $core->total_count - $core->smushed_count - $core->skipped_count;

		$upgrade_url = add_query_arg(
			array(
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'smush_bulksmush_completed_pagespeed_upgradetopro',
			),
			$this->upgrade_url
		);

		$bulk_upgrade_url = add_query_arg(
			array(
				'coupon'       => 'SMUSH30OFF',
				'checkout'     => 0,
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => Core::$max_free_bulk < $total_images_to_smush ? 'smush_bulksmush_morethan50images_tryproforfree' : 'smush_bulksmush_lessthan50images_tryproforfree',
			),
			$this->upgrade_url
		);

		$this->view(
			'bulk/meta-box',
			array(
				'core'                  => $core,
				'hide_pagespeed'        => get_site_option( WP_SMUSH_PREFIX . 'hide_pagespeed_suggestion' ),
				'is_pro'                => WP_Smush::is_pro(),
				'lossy_enabled'         => WP_Smush::is_pro() && $this->settings->get( 'lossy' ),
				'unsmushed_count'       => $unsmushed_count > 0 ? $unsmushed_count : 0,
				'resmush_count'         => count( get_option( 'wp-smush-resmush-list', array() ) ),
				'total_images_to_smush' => $total_images_to_smush,
				'upgrade_url'           => $upgrade_url,
				'bulk_upgrade_url'      => $bulk_upgrade_url,
			)
		);
	}

	/**
	 * Settings meta box.
	 *
	 * Free and pro version settings are shown in same section. For free users, pro settings won't be shown.
	 * To print full size smush, resize and backup in group, we hook at `smush_setting_column_right_end`.
	 */
	public function bulk_settings_metabox() {
		$fields = $this->settings->get_bulk_fields();

		// Remove backups setting, as it's added separately.
		$key = array_search( 'backup', $fields, true );
		if ( false !== $key ) {
			unset( $fields[ $key ] );
		}

		$this->view(
			'bulk-settings/meta-box',
			array(
				'basic_features'   => Settings::$basic_features,
				'cdn_enabled'      => $this->settings->get( 'cdn' ),
				'grouped_settings' => $fields,
				'settings'         => $this->settings->get(),
				'settings_data'    => WP_Smush::get_instance()->core()->settings,
			)
		);
	}

	/**
	 * Pro features list box to show after settings.
	 */
	public function pro_features_metabox() {
		// Upgrade url for upsell.
		$upsell_url = add_query_arg(
			array(
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'smush-advanced-settings-upsell',
			),
			$this->upgrade_url
		);

		// Upgrade url with analytics keys.
		$upgrade_url = add_query_arg(
			array(
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'smush-advanced-settings-video-button',
			),
			$this->upgrade_url
		);

		$this->view(
			'pro-features/meta-box',
			array(
				'upgrade_url' => $upgrade_url,
				'upsell_url'  => $upsell_url,
			)
		);
	}

	/**
	 * Directory Smush meta box.
	 */
	public function directory_smush_metabox() {
		// Reset the bulk limit transient.
		if ( ! WP_Smush::is_pro() ) {
			Core::check_bulk_limit( true, 'dir_sent_count' );
		}

		$core = WP_Smush::get_instance()->core();

		$upgrade_url = add_query_arg(
			array(
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'smush_directorysmush_limit_notice',
			),
			$this->upgrade_url
		);

		$errors = 0;
		$images = array();
		if ( isset( $_GET['scan'] ) && 'done' === sanitize_text_field( wp_unslash( $_GET['scan'] ) ) ) {
			$images = $core->mod->dir->get_image_errors();
			$errors = $core->mod->dir->get_image_errors_count();
		}

		$this->view(
			'directory/meta-box',
			array(
				'errors'      => $errors,
				'images'      => $images,
				'root_path'   => $core->mod->dir->get_root_path(),
				'upgrade_url' => $upgrade_url,
			)
		);
	}

	/**
	 * Integrations meta box.
	 *
	 * Free and pro version settings are shown in same section. For free users, pro settings won't be shown.
	 * To print full size smush, resize and backup in group, we hook at `smush_setting_column_right_end`.
	 */
	public function integrations_metabox() {
		$core = WP_Smush::get_instance()->core();

		$upsell_url = add_query_arg(
			array(
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'smush-nextgen-settings-upsell',
			),
			$this->upgrade_url
		);

		$this->view(
			'integrations/meta-box',
			array(
				'basic_features'    => Settings::$basic_features,
				'is_pro'            => WP_Smush::is_pro(),
				'integration_group' => $this->settings->get_integrations_fields(),
				'settings'          => $this->settings->get(),
				'settings_data'     => $core->settings,
				'upsell_url'        => $upsell_url,
			)
		);
	}

	/**
	 * CDN meta box (for free users).
	 *
	 * @since 3.0
	 */
	public function cdn_upsell_metabox() {
		$upgrade_url = add_query_arg(
			array(
				'utm_source'   => 'smush',
				'utm_medium'   => 'plugin',
				'utm_campaign' => 'smush_cdn_upgrade_button',
			),
			$this->upgrade_url
		);

		$this->view(
			'cdn/upsell-meta-box',
			array(
				'upgrade_url' => $upgrade_url,
			)
		);
	}

	/**
	 * Upsell meta box header.
	 *
	 * @since 3.0
	 */
	public function cdn_upsell_metabox_header() {
		$this->view(
			'cdn/upsell-meta-box-header',
			array(
				'title' => __( 'CDN', 'wp-smushit' ),
			)
		);
	}

	/**
	 * CDN meta box.
	 *
	 * @since 3.0
	 */
	public function cdn_metabox() {
		$status = WP_Smush::get_instance()->core()->mod->cdn->status();

		// Available values: warning (inactive), success (active) or error (expired).
		$status_msg = array(
			'enabled'    => __(
				'Your media is currently being served from the WPMU DEV CDN. Bulk and Directory smush features are treated separately and will continue to run independently.',
				'wp-smushit'
			),
			'disabled'   => __( 'CDN is not yet active. Configure your settings below and click Activate.', 'wp-smushit' ),
			'activating' => __(
				'Your settings have been saved and changes are now propagating to the CDN. Changes can take up to 30
				minutes to take effect but your images will continue to be served in the mean time, please be patient.',
				'wp-smushit'
			),
			'upgrade'    => sprintf(
				__(
					/* translators: %1$s - starting a tag, %2$s - closing a tag */
					"You're almost through your CDN bandwidth limit. Please contact your administrator to upgrade your Smush CDN plan to ensure you don't lose this service. %1\$sUpgrade now%2\$s",
					'wp-smushit'
				),
				'<a href="https://premium.wpmudev.org/hub/account/" target="_blank">',
				'</a>'
			),
			'overcap'    => sprintf(
				__(
					/* translators: %1$s - starting a tag, %2$s - closing a tag */
					"You've gone through your CDN bandwidth limit, so we’ve stopped serving your images via the CDN. Contact your administrator to upgrade your Smush CDN plan to reactivate this service. %1\$sUpgrade now%2\$s",
					'wp-smushit'
				),
				'<a href="https://premium.wpmudev.org/hub/account/" target="_blank">',
				'</a>'
			),
		);

		$status_color = array(
			'enabled'    => 'success',
			'disabled'   => 'error',
			'activating' => 'warning',
			'upgrade'    => 'warning',
			'overcap'    => 'error',
		);

		$this->view(
			'cdn/meta-box',
			array(
				'cdn_group'     => $this->settings->get_cdn_fields(),
				'settings'      => $this->settings->get(),
				'settings_data' => WP_Smush::get_instance()->core()->settings,
				'status_msg'    => $status_msg[ $status ],
				'class'         => $status_color[ $status ],
				'status'        => $status,
			)
		);
	}

	/**
	 * CDN meta box header.
	 *
	 * @since 3.0
	 */
	public function cdn_metabox_header() {
		$this->view(
			'cdn/meta-box-header',
			array(
				'title'   => __( 'CDN', 'wp-smushit' ),
				'tooltip' => __( 'This feature is likely to work without issue, however our CDN is in beta stage and some issues are still present.', 'wp-smushit' ),
			)
		);
	}

	/**
	 * Upsell meta box header.
	 *
	 * @since 3.8.0
	 */
	public function webp_upsell_metabox_header() {
		$this->view( 'webp/upsell-meta-box-header' );
	}

	/**
	 * WebP meta box header.
	 *
	 * @since 3.8.0
	 */
	public function webp_metabox_header() {
		$this->view(
			'webp/meta-box-header',
			array(
				'is_disabled'   => ! $this->settings->get( 'webp_mod' ) || ! WP_Smush::get_instance()->core()->s3->setting_status(),
				'is_configured' => WP_Smush::get_instance()->core()->mod->webp->is_configured(),
			)
		);
	}

	/**
	 * WebP meta box.
	 *
	 * @since 3.8.0
	 */
	public function webp_config_metabox() {
		$webp    = WP_Smush::get_instance()->core()->mod->webp;
		$servers = $webp->get_servers();
		// WebP module does not support iss and cloudflare server.
		unset( $servers['iis'], $servers['cloudflare'] );

		$server_type          = strtolower( $webp->get_server_type() );
		$detected_server      = '';
		$detected_server_name = '';

		if ( isset( $servers[ $server_type ] ) ) {
			$detected_server      = $server_type;
			$detected_server_name = $servers[ $server_type ];
		}

		$this->view(
			'webp/config-meta-box',
			array(
				'servers'              => $servers,
				'detected_server'      => $detected_server,
				'detected_server_name' => $detected_server_name,
				'nginx_config_code'    => $webp->get_nginx_code(),
				'apache_htaccess_code' => $webp->get_apache_code( true ),
				'is_htaccess_written'  => $webp->is_htaccess_written(),
			)
		);
	}

	/**
	 * Settings meta box.
	 *
	 * @since 3.0
	 */
	public function settings_metabox() {
		$link = WP_Smush::is_pro() ? 'https://premium.wpmudev.org/translate/projects/wp-smushit/' : 'https://translate.wordpress.org/projects/wp-plugins/wp-smushit';

		$site_locale = get_locale();

		if ( 'en' === $site_locale || 'en_US' === $site_locale ) {
			$site_language = 'English';
		} else {
			require_once ABSPATH . 'wp-admin/includes/translation-install.php';
			$translations  = wp_get_available_translations();
			$site_language = isset( $translations[ $site_locale ] ) ? $translations[ $site_locale ]['native_name'] : __( 'Error detecting language', 'wp-smushit' );
		}

		$this->view(
			'settings/meta-box',
			array(
				'site_language'    => $site_language,
				'translation_link' => $link,
				'settings'         => $this->settings->get(),
				'settings_data'    => WP_Smush::get_instance()->core()->settings,
				'settings_group'   => array( 'accessible_colors', 'usage' ),
				'networkwide'      => get_site_option( WP_SMUSH_PREFIX . 'networkwide' ),
			)
		);
	}

	/**
	 * Lazy loading meta box header.
	 *
	 * @since 3.2.0
	 */
	public function lazyload_metabox_header() {
		$this->view(
			'lazyload/meta-box-header',
			array(
				'title'   => __( 'Lazy Load', 'wp-smushit' ),
				'tooltip' => __( 'This feature is likely to work without issue, however lazy load is in beta stage and some issues are still present', 'wp-smushit' ),
			)
		);
	}

	/**
	 * Lazy loading meta box.
	 *
	 * @since 3.2.0
	 */
	public function lazyload_metabox() {
		$this->view(
			'lazyload/meta-box',
			array(
				'settings' => $this->settings->get_setting( WP_SMUSH_PREFIX . 'lazy_load' ),
				'cpts'     => get_post_types( // custom post types.
					array(
						'public'   => true,
						'_builtin' => false,
					),
					'objects',
					'and'
				),
			)
		);
	}

	/**
	 * Tutorials meta box.
	 *
	 * @since 3.7.1
	 */
	public function tutorials_metabox() {
		$this->view( 'tutorials/meta-box' );
	}

	/**
	 * Common footer meta box.
	 *
	 * @since 3.2.0
	 */
	public function common_metabox_footer() {
		$this->view( 'meta-box-footer', array(), 'common' );
	}

	/**
	 * Tools meta box.
	 *
	 * @since 3.2.1
	 */
	public function tools_metabox() {
		$this->view(
			'tools/meta-box',
			array(
				'grouped_settings' => $this->settings->get_tools_fields(),
				'settings'         => $this->settings->get(),
				'settings_data'    => WP_Smush::get_instance()->core()->settings,
				'backups_count'    => WP_Smush::get_instance()->core()->mod->backup->get_attachments_with_backups(),
			)
		);
	}

	/**
	 * Calculates the total images to be smushed.
	 * This is all unsmushed images + all images to re-smush.
	 *
	 * We're not using $core->remaining_count because it excludes the resmush count
	 * when the amount of unsmushed images and amount of images to re-smush are the same.
	 * So, if you have 2 images to re-smush and 2 unsmushed images, it'll return 2 and no 4.
	 * We might need to check that there, it's used everywhere so we must be careful. Using this in the meantime.
	 *
	 * @since 3.7.2
	 *
	 * @return integer
	 */
	protected function get_total_images_to_smush() {
		$images_to_resmush = count( get_option( 'wp-smush-resmush-list', array() ) );

		// This is the same calculation used for $core->remaining_count,
		// except that we don't add the re-smushed count here.
		$unsmushed_count = WP_Smush::get_instance()->core()->total_count - WP_Smush::get_instance()->core()->smushed_count - WP_Smush::get_instance()->core()->skipped_count;

		// Sometimes this number can be negative, if there are weird issues with meta data.
		if ( $unsmushed_count > 0 ) {
			return $images_to_resmush + $unsmushed_count;
		}

		return $images_to_resmush;
	}

}
