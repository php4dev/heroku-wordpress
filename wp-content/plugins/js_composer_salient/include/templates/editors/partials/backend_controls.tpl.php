<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$editAccess = vc_user_access_check_shortcode_edit( $shortcode );
$allAccess = vc_user_access_check_shortcode_all( $shortcode );
?>
<div class="vc_controls<?php echo ! empty( $extended_css ) ? ' ' . $extended_css : '' ?>">
	<div class="vc_controls-<?php echo $position ?>">
		<a class="<?php echo esc_attr( $name_css_class ) ?>">
				<span class="vc_btn-content"
				      title="<?php if ( $allAccess ) : printf( __( 'Drag to move %s', 'js_composer' ), $name );
				      else : print( $name ); endif; ?>"><?php echo $name ?></span>
		</a>
			<?php foreach ( $controls as $control ) : ?>
				<?php if ( 'add' === $control && $add_allowed ) : ?>
					<a class="vc_control-btn vc_control-btn-prepend vc_edit" href="#"
					   title="<?php printf( __( 'Prepend to %s', 'js_composer' ), $name ) ?>"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
				<?php elseif ( $editAccess && 'edit' === $control ) :  ?>
					<a class="vc_control-btn vc_control-btn-edit" href="#"
					   title="<?php printf( __( 'Edit %s', 'js_composer' ), $name ) ?>"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
				<?php elseif ( $allAccess && 'clone' === $control ) :  ?>
					<a class="vc_control-btn vc_control-btn-clone" href="#"
					   title="<?php printf( __( 'Clone %s', 'js_composer' ), $name ) ?>"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
				<?php elseif ( $allAccess && 'delete' === $control ) :  ?>
					<a class="vc_control-btn vc_control-btn-delete" href="#"
					   title="<?php printf( __( 'Delete %s', 'js_composer' ), $name ) ?>"><span
							class="vc_btn-content"><span class="icon"></span></span></a>
				<?php endif ?>
			<?php endforeach ?>
	</div>
</div>
