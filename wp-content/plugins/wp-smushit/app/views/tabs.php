<?php
/**
 * Tabs layout
 *
 * @package WP_Smush
 *
 * @var \Smush\App\Abstract_Page $this
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<div class="sui-sidenav smush-sidenav">
	<ul class="sui-vertical-tabs sui-sidenav-hide-md">
		<?php foreach ( $this->get_tabs() as $tab_id => $name ) : ?>
			<li class="sui-vertical-tab <?php echo esc_attr( 'smush-' . $tab_id ); ?> <?php echo ( $tab_id === $this->get_current_tab() ) ? 'current' : null; ?>">
				<a href="<?php echo esc_url( $this->get_tab_url( $tab_id ) ); ?>">
					<?php echo esc_html( $name ); ?>
				</a>
				<?php do_action( 'wp_smush_admin_after_tab_' . $this->get_slug(), $tab_id ); ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<div class="sui-sidenav-hide-lg">
		<select class="sui-mobile-nav">
			<?php foreach ( $this->get_tabs() as $tab_id => $name ) : ?>
				<option value="<?php echo esc_url( $this->get_tab_url( $tab_id ) ); ?>" <?php selected( $this->get_current_tab(), $tab_id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>
