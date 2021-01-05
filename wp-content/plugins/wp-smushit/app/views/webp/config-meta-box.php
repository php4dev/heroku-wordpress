<?php
/**
 * WebP configarations meta box.
 *
 * @since 3.8.0
 * @package WP_Smush
 *
 * @var array    $servers              List of server names.
 * @var string   $detected_server      Current server name detected by this plugin..
 * @var array    $detected_server_name Current server name ( human readable ) detected by this plugin.
 * @var string   $nginx_config_code    Configuration code for NGINX server.
 * @var string   $apache_htaccess_code htaccess code for Apache server.
 * @var bool     $is_htaccess_written  Whether htaccess rules have been written or not.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<div class="sui-box-settings-row">
	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label">
			<?php esc_html_e( 'Server type', 'wp-smushit' ); ?>
		</span>
		<span class="sui-description">
			<?php
			esc_html_e( 'Choose your server type. If you don\'t know this, please contact your hosting provider.', 'wp-smushit' );
			?>
		</span>
	</div>
	<div class="sui-box-settings-col-2">
		<div class="sui-form-field sui-input-md">
			<label for="webp-server-type" id="label-webp-server-type" class="sui-settings-label" style="font-size:13px;color:#888888;">
				<?php esc_html_e( 'Server type', 'wp-smushit' ); ?>
			</label>
			<select id="webp-server-type" name="webp-server-type" aria-labelledby="label-webp-server-type" aria-describedby="description-webp-server-type">
				<?php foreach ( $servers as $key => $name ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $detected_server, $key ); ?>><?php echo esc_html( $name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php if ( ! empty( $detected_server_name ) ) : ?>
		<div class="sui-notice">
			<div class="sui-notice-content">
				<div class="sui-notice-message">
					<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
					<p>
						<?php /* translators: server type name. */ ?>
						<?php echo sprintf( esc_html( __( 'We\'ve automatically detected your server type is %s. If this is incorrect, manually select your server type to generate the relevant rules and instructions.', 'wp-smushit' ) ), esc_html( $detected_server_name ) ); ?>
					</p>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<div class="sui-box-settings-row">
	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label">
			<?php esc_html_e( 'Enable conversion', 'wp-smushit' ); ?>
		</span>
		<span class="sui-description">
			<?php
			esc_html_e( 'Follow the instructions to activate WebP conversion for this website.', 'wp-smushit' );
			?>
		</span>
	</div>

	<div class="sui-box-settings-col-2">

		<div id="webp-server-instructions-apache" class="webp-server-instructions sui-hidden" data-server="apache">
			<div class="sui-tabs">

				<div role="tablist" class="sui-tabs-menu">
					<button type="button" role="tab" id="webp-tab-auto" class="sui-tab-item active" aria-controls="webp-tab-content-auto" aria-selected="true">
						<?php esc_html_e( 'AUTOMATIC', 'wp-smushit' ); ?>
					</button>
					<button type="button" role="tab" id="webp-tab-manual" class="sui-tab-item" aria-controls="webp-tab-content-manual" aria-selected="false" tabindex="-1">
						<?php esc_html_e( 'MANUAL', 'wp-smushit' ); ?>
					</button>
				</div>

				<div class="sui-tabs-content">

					<div role="tabpanel" tabindex="0" id="webp-tab-content-auto" class="sui-tab-content active" aria-labelledby="webp-tab-auto">
						<p class="sui-description">
							<?php esc_html_e( 'Smush can automatically apply WebP conversion rules for Apache servers by writing your .htaccess file. Alternatively, switch to Manual to apply these rules yourself.', 'wp-smushit' ); ?>
						</p>
						<p class="sui-description">
							<?php esc_html_e( 'Please note: Some servers have both Apache and NGINX software which may not begin serving WebP images after applying the .htaccess rules. If errors occur after applying the rules, we recommend adding NGINX rules manually.', 'wp-smushit' ); ?>
						</p>

						<?php if ( $is_htaccess_written ) : ?>
							<button type="button" id="smush-webp-remove-htaccess" class="sui-button sui-button-ghost">
								<span class="sui-loading-text">
									<i class="sui-icon-trash" aria-hidden="true"></i><?php esc_html_e( 'Remove rules', 'wp-smushit' ); ?>
								</span>
								<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
							</button>
						<?php else : ?>
							<button type="button" id="smush-webp-apply-htaccess" class="sui-button sui-button-blue">
								<span class="sui-loading-text"><?php esc_html_e( 'Apply rules', 'wp-smushit' ); ?></span>
								<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
							</button>
						<?php endif; ?>
					</div>

					<div role="tabpanel" tabindex="0" id="webp-tab-content-manual" class="sui-tab-content" aria-labelledby="webp-tab-manual" hidden>
						<p class="sui-description">
							<?php esc_html_e( 'If you are unable to get the automated method working, you can copy the generated code below into your .htaccess file in the uploads directory (wp-content/uploads) to activate WebP conversion. If the file does not exist, you can create one.', 'wp-smushit' ); ?>
						</p>

						<ol class="sui-description">
							<li>
								<?php esc_html_e( 'Copy & paste the generated code below into your .htaccess file in the uploads directory (wp-content/uploads). If the file does not exist, you can create one', 'wp-smushit' ); ?>
							</li>
							<li>
								<?php
								printf(
									/* translators: 1. opening 'a' tag to check Webp conversion status, 2. closing 'a' tag, 3. opening 'a' tag to premium support. */
									esc_html__( 'Next, %1$sre-check WebP conversion status%2$s to see if it worked. %3$sStill having issues?%2$s', 'wp-smushit' ),
									'<a href="#smush-webp-recheck" id="smush-webp-recheck-link">',
									'</a>',
									'<a href="https://premium.wpmudev.org/hub/support/#get-support" target="_blank">'
								);
								?>
							</li>
						</ol>

						<pre class="sui-code-snippet"><?php echo esc_html( $apache_htaccess_code ); ?></pre>

						<h5 class="sui-settings-label" style="margin-top: 30px; font-size: 13px; color: #333333;"><?php esc_html_e( 'Troubleshooting', 'wp-smushit' ); ?></h5>

						<p class="sui-description">
							<?php esc_html_e( 'If .htaccess does not work, and you have access to vhosts.conf or httpd.conf try this', 'wp-smushit' ); ?>:
						</p>

						<ol class="sui-description">
							<li>
								<?php esc_html_e( 'Look for your site in the file and find the line that starts with <Directory> - add the code above that line and into that section and save the file.', 'wp-smushit' ); ?>
							</li>
							<li>
								<?php esc_html_e( 'Reload Apache.', 'wp-smushit' ); ?>
							</li>
							<li>
								<?php esc_html_e( "If you don't know where those files are, or you aren't able to reload Apache, you would need to consult with your hosting provider or a system administrator who has access to change the configuration of your server", 'wp-smushit' ); ?>
							</li>
						</ol>
						<p class="sui-description">
							<?php
							printf(
								/* translators: 1. opening 'a' tag to check Webp conversion status, 2. closing 'a' tag, 3. opening 'a' tag to premium support. */
								esc_html__( 'Next, %1$sre-check WebP conversion status%2$s to see if it worked. %3$sStill having issues?%2$s', 'wp-smushit' ),
								'<a href="#smush-webp-recheck" id="smush-webp-recheck-link">',
								'</a>',
								'<a href="https://premium.wpmudev.org/hub/support/#get-support" target="_blank">'
							);
							?>
						</li>
					</div>

					<pre class="sui-code-snippet"><?php echo esc_html( $apache_htaccess_code ); ?></pre>

					<h5 class="sui-settings-label" style="margin-top: 30px; font-size: 13px; color: #333333;"><?php esc_html_e( 'Troubleshooting', 'wp-smushit' ); ?></h5>

					<p class="sui-description">
						<?php esc_html_e( 'If .htaccess does not work, and you have access to vhosts.conf or httpd.conf try this', 'wp-smushit' ); ?>:
					</p>

					<ol class="sui-description">
						<li>
							<?php esc_html_e( 'Look for your site in the file and find the line that starts with <Directory> - add the code above into that section and save the file.', 'wp-smushit' ); ?>
						</li>
						<li>
							<?php esc_html_e( 'Reload Apache.', 'wp-smushit' ); ?>
						</li>
						<li>
							<?php esc_html_e( 'If you don\'t know where those files are, or you aren\'t able to reload Apache, you would need to consult with your hosting provider or a system administrator who has access to change the configuration of your server.', 'wp-smushit' ); ?>
						</li>
					</ol>
					<p class="sui-description">
						<?php
						printf(
							/* translators: 1. opening 'a' tag to premium support, 2. closing 'a' tag. */
							esc_html__( 'Still having trouble? %1$sGet support%2$s.', 'wp-smushit' ),
							'<a href="https://premium.wpmudev.org/hub/support/#get-support" target="_blank">',
							'</a>'
						);
						?>
					</p>

				</div><!-- /.sui-tabs -->

			</div><!-- #webp-server-instructions-apache -->
		</div>

		<div id="webp-server-instructions-nginx" class="webp-server-instructions sui-hidden" data-server="nginx">
			<span class="sui-settings-label" style="font-size:13px; color:#333333;font-weight:bold">
				<?php esc_html_e( 'For NGINX servers:', 'wp-smushit' ); ?>
			</span>

			<ol class="sui-description">
				<li>
					<?php esc_html_e( 'Insert the following in the server context of your configuration file (usually found in /etc/nginx/sites-available). "The server context" refers to the part of the configuration that starts with "server {" and ends with the matching "}".', 'wp-smushit' ); ?>
				</li>
				<li>
					<?php esc_html_e( 'Copy the generated code found below and paste it inside your server block.', 'wp-smushit' ); ?>
				</li>
				<li>
					<?php esc_html_e( 'Reload NGINX.', 'wp-smushit' ); ?>
				</li>
			</ol>

			<pre class="sui-code-snippet"><?php echo esc_html( $nginx_config_code ); ?></pre>

			<span class="sui-settings-label sui-margin-top" style="font-size:13px; color:#333333;font-weight:bold">
				<?php esc_html_e( 'Troubleshooting:', 'wp-smushit' ); ?>
			</span>

			<p class="sui-description">
				<?php esc_html_e( 'If you do not have access to your NGINX config files you will need to contact your hosting provider to make these changes.', 'wp-smushit' ); ?>
			</p>

			<p class="sui-description">
				<?php
				printf(
					/* translators: 1. opening 'a' tag to premium support, 2. closing 'a' tag. */
					esc_html__( 'Still having trouble? %1$sGet support%2$s.', 'wp-smushit' ),
					'<a href="https://premium.wpmudev.org/hub/support/#get-support" target="_blank">',
					'</a>'
				);
				?>
			</p>
		</div><!-- #webp-server-instructions-nginx -->
	</div>
</div>

<div class="sui-box-settings-row">
	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label">
			<?php esc_html_e( 'Revert WebP Conversion', 'wp-smushit' ); ?>
		</span>
		<span class="sui-description"><?php esc_html_e( 'If your server storage space is full, use this feature to revert the WebP conversions by deleting all generated files. The files will fall back to normal PNGs or JPEGs once you delete them.', 'wp-smushit' ); ?></span>
	</div>

	<div class="sui-box-settings-col-2">
		<button
			type="button"
			class="sui-button sui-button-ghost"
			id="wp-smush-webp-delete-all-modal-open"
			data-modal-open="wp-smush-wp-delete-all-dialog"
			data-modal-close-focus="wp-smush-webp-delete-all-modal-open"
		>
			<span class="sui-loading-text">
				<i class="sui-icon-trash" aria-hidden="true"></i>
				<?php esc_html_e( 'Delete WebP Files', 'wp-smushit' ); ?>
			</span>
			<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
		</button>

		<span class="sui-description">
			<?php
			esc_html_e( 'Note: This feature won’t delete the WebP files converted via CDN, only the files generated via the local WebP feature.', 'wp-smushit' );
			?>
		</span>
	</div>
</div>

<div class="sui-box-settings-row">
	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label">
			<?php esc_html_e( 'Deactivate', 'wp-smushit' ); ?>
		</span>

		<span class="sui-description">
			<?php
			esc_html_e(
				'If you no longer want to use this feature, click on Deactivate and we will disable the feature.',
				'wp-smushit'
			);
			?>
		</span>
	</div>

	<div class="sui-box-settings-col-2">
		<p class="sui-description" style="margin-bottom: 5px;">
			<?php esc_html_e( 'Note: Deactivation won’t delete existing WebP images.', 'wp-smushit' ); ?>
		</p>
		<button class="sui-button sui-button-ghost" id="smush-toggle-webp-button" data-action="disable">
			<span class="sui-loading-text">
				<i class="sui-icon-power-on-off" aria-hidden="true"></i><?php esc_html_e( 'Deactivate', 'wp-smushit' ); ?>
			</span>
			<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
		</button>
	</div>
</div>
