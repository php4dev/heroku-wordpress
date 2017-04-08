<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="vc_ui-list-bar-group">

	<?php foreach ( $list_presets as $presets ) :  ?>
		<?php if ( $presets ) :  ?>
			<ul class="vc_ui-list-bar vc_ui-list-bar-o-bounded">
				<?php foreach ( $presets as $id => $title ) :  ?>
					<?php

					if ( ! $title ) {
						$title = __( 'Untitled', 'js_composer' );
					}

					if ( $default_id === $id ) {
						$title .= ' ' . __( '(default)', 'js_composer' );
					}

					?>
					<li class="vc_ui-list-bar-item">
						<button type="button"
						        class="vc_ui-list-bar-item-trigger"
						        data-vc-load-settings-preset="<?php echo $id ?>"
						        title="<?php echo esc_attr( $title ) ?>">
							<?php echo esc_html( $title ) ?>
						</button>
						<?php if ( vc_user_access()
							           ->part( 'presets' )
							           ->checkStateAny( true, null )
							           ->get() && is_numeric( $id )
						) :  ?>
							<div class="vc_ui-list-bar-item-actions">
								<button type="button"
								        class="vc_general vc_ui-control-button"
								        data-vc-delete-settings-preset="<?php echo $id ?>"
									>
									<i class="vc_ui-icon-pixel vc_ui-icon-pixel-control-trash-dark"></i>
								</button>
							</div>
						<?php endif ?>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	<?php endforeach ?>
	<?php if ( vc_user_access()
		->part( 'presets' )
		->checkStateAny( true, null )
		->get()
	) :  ?>
		<ul class="vc_ui-list-bar">
			<li class="vc_ui-list-bar-item">
				<button type="button" class="vc_ui-list-bar-item-trigger" data-vc-save-settings-preset>
					<?php _e( 'Save as preset', 'js_composer' ) ?>
				</button>
			</li>
			<li class="vc_ui-list-bar-item">
				<button type="button" class="vc_ui-list-bar-item-trigger" data-vc-save-default-settings-preset>
					<?php _e( 'Set as default', 'js_composer' ) ?>
				</button>
			</li>
			<?php if ( $default_id ) :  ?>
				<li class="vc_ui-list-bar-item">
					<button type="button" class="vc_ui-list-bar-item-trigger" data-vc-restore-default-settings-preset>
						<?php _e( 'Restore default', 'js_composer' ) ?>
					</button>
				</li>
			<?php endif ?>
		</ul>
	<?php endif; ?>
</div>
