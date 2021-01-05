<div class="wrap">
	<h2><?php echo $this->plugin->displayName; ?> &raquo; <?php esc_html_e( 'Settings', 'insert-headers-and-footers' ); ?></h2>

	<?php
	if ( isset( $this->message ) ) {
		?>
		<div class="updated fade"><p><?php echo $this->message; ?></p></div>
		<?php
	}
	if ( isset( $this->errorMessage ) ) {
		?>
		<div class="error fade"><p><?php echo $this->errorMessage; ?></p></div>
		<?php
	}
	?>

	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- Content -->
			<div id="post-body-content">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<h3 class="hndle"><?php esc_html_e( 'Settings', 'insert-headers-and-footers' ); ?></h3>

						<div class="inside">
							<form action="options-general.php?page=<?php echo $this->plugin->name; ?>" method="post">
								<p>
									<label for="ihaf_insert_header"><strong><?php esc_html_e( 'Scripts in Header', 'insert-headers-and-footers' ); ?></strong></label>
									<textarea name="ihaf_insert_header" id="ihaf_insert_header" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['ihaf_insert_header']; ?></textarea>
									<?php
									printf(
										/* translators: %s: The `<head>` tag */
										esc_html__( 'These scripts will be printed in the %s section.', 'insert-headers-and-footers' ),
										'<code>&lt;head&gt;</code>'
									);
									?>
								</p>
								<?php if ( $this->body_open_supported ) : ?>
								<p>
									<label for="ihaf_insert_body"><strong><?php esc_html_e( 'Scripts in Body', 'insert-headers-and-footers' ); ?></strong></label>
									<textarea name="ihaf_insert_body" id="ihaf_insert_body" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['ihaf_insert_body']; ?></textarea>
									<?php
									printf(
										/* translators: %s: The `<head>` tag */
										esc_html__( 'These scripts will be printed just below the opening %s tag.', 'insert-headers-and-footers' ),
										'<code>&lt;body&gt;</code>'
									);
									?>
								</p>
								<?php endif; ?>
								<p>
									<label for="ihaf_insert_footer"><strong><?php esc_html_e( 'Scripts in Footer', 'insert-headers-and-footers' ); ?></strong></label>
									<textarea name="ihaf_insert_footer" id="ihaf_insert_footer" class="widefat" rows="8" style="font-family:Courier New;"><?php echo $this->settings['ihaf_insert_footer']; ?></textarea>
									<?php
									printf(
										/* translators: %s: The `</body>` tag */
										esc_html__( 'These scripts will be printed above the closing %s tag.', 'insert-headers-and-footers' ),
										'<code>&lt;/body&gt;</code>'
									);
									?>
								</p>
								<?php wp_nonce_field( $this->plugin->name, $this->plugin->name . '_nonce' ); ?>
								<p>
									<input name="submit" type="submit" name="Submit" class="button button-primary" value="<?php esc_attr_e( 'Save', 'insert-headers-and-footers' ); ?>" />
								</p>
							</form>
						</div>
					</div>
					<!-- /postbox -->
				</div>
				<!-- /normal-sortables -->
			</div>
			<!-- /post-body-content -->

			<!-- Sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<?php require_once( $this->plugin->folder . '/views/sidebar.php' ); ?>
			</div>
			<!-- /postbox-container -->
		</div>
	</div>
</div>
