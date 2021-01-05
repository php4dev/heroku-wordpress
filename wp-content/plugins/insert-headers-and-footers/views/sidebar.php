<?php
/**
 * Donations Sidebar
 */
?>
<!-- Improve Your Site -->
<div class="postbox">
	<h3 class="hndle">
		<span><?php esc_html_e( 'Improve Your Site', 'insert-headers-and-footers' ); ?></span>
	</h3>

	<div class="inside">
		<p>
			<?php
			printf(
				/* translators: %s: Link to WPBeginner blog */
				esc_html__( 'Want to take your site to the next level? Check out our daily free WordPress tutorials on %s.', 'insert-headers-and-footers' ),
				sprintf(
					'<a href="http://www.wpbeginner.com/?utm_source=wpadmin&utm_campaign=freeplugins" target="_blank">%s</a>',
					esc_html__( 'WPBeginner blog', 'insert-headers-and-footers' )
				)
			);
			?>
		</p>

		<p>
			<?php esc_html_e( 'Some of our popular guides:', 'insert-headers-and-footers' ); ?>
		</p>

		<ul>
			<li>
				<a href="http://www.wpbeginner.com/wordpress-performance-speed/?utm_source=wpadmin&utm_campaign=freeplugins" target="_blank">
					<?php esc_html_e( 'Speed Up WordPress', 'insert-headers-and-footers' ); ?>
				</a>
			</li>
			<li>
				<a href="http://www.wpbeginner.com/wordpress-security/?utm_source=wpadmin&utm_campaign=freeplugins" target="_blank">
					<?php esc_html_e( 'Improve WordPress Security', 'insert-headers-and-footers' ); ?>
				</a>
			</li>
			<li>
				<a href="http://www.wpbeginner.com/wordpress-seo/?utm_source=wpadmin&utm_campaign=freeplugins" target="_blank">
					<?php esc_html_e( 'Boost Your WordPress SEO', 'insert-headers-and-footers' ); ?>
				</a>
			</li>
		</ul>

	</div>
</div>

<!-- Donate -->
<div class="postbox">
	<h3 class="hndle">
		<span><?php esc_html_e( 'Our WordPress Plugins', 'insert-headers-and-footers' ); ?></span>
	</h3>
	<div class="inside">
		<p>
			<?php esc_html_e( 'Like this plugin? Check out our other WordPress plugins:', 'insert-headers-and-footers' ); ?>
		</p>
		<p>
			<?php
			printf(
				'<a href="%1$s" target="_blank">%2$s</a> - %3$s',
				esc_url( 'https://wordpress.org/plugins/wpforms-lite/' ),
				esc_html__( 'WPForms', 'insert-headers-and-footers' ),
				esc_html__( 'Drag & Drop WordPress Form Builder', 'insert-headers-and-footers' )
			);
			?>
		</p>
		<p>
			<?php
			printf(
				'<a href="%1$s" target="_blank">%2$s</a> - %3$s',
				esc_url( 'https://wordpress.org/plugins/google-analytics-for-wordpress/' ),
				esc_html__( 'MonsterInsights', 'insert-headers-and-footers' ),
				esc_html__( 'Google Analytics Made Easy for WordPress', 'insert-headers-and-footers' )
			);
			?>
		</p>
		<p>
			<?php
			printf(
				'<a href="%1$s" target="_blank">%2$s</a> - %3$s',
				esc_url( 'http://optinmonster.com/' ),
				esc_html__( 'OptinMonster', 'insert-headers-and-footers' ),
				esc_html__( 'Best WordPress Lead Generation Plugin', 'insert-headers-and-footers' )
			);
			?>
		</p>
		<p>
			<?php
			printf(
				'<a href="%1$s" target="_blank">%2$s</a> - %3$s',
				esc_url( 'https://www.seedprod.com/' ),
				esc_html__( 'SeedProd', 'insert-headers-and-footers' ),
				esc_html__( 'Get the best WordPress Coming Soon Page plugin', 'insert-headers-and-footers' )
			);
			?>
		</p>
	</div>
</div>
