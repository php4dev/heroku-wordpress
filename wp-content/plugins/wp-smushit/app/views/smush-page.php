<?php
/**
 * Render Smush pages.
 *
 * @package WP_Smush
 */

namespace Smush\App\Views;

use WP_Smush;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Prevent warnings.
 *
 * @var \Smush\App\Abstract_Page $this
 */
$this->do_meta_boxes( 'summary' );
?>

<div class="sui-row-with-sidenav">
	<?php $this->show_tabs(); ?>
	<div>
		<?php $this->do_meta_boxes( $this->get_current_tab() ); ?>
	</div>
</div><!-- end row -->

<?php if ( ! WP_Smush::is_pro() ) : ?>
	<?php if ( 'bulk' === $this->get_current_tab() ) : ?>
		<div class="sui-row" id="sui-cross-sell-footer">
			<div><span class="sui-icon-plugin-2"></span></div>
			<h3><?php esc_html_e( 'Check out our other free wordpress.org plugins!', 'wp-smushit' ); ?></h3>
		</div>
		<div class="sui-row sui-cross-sell-modules">
			<div class="sui-col-md-4">
				<div class="sui-cross-1 sui-cross-hummingbird"><span></span></div>
				<div class="sui-box">
					<div class="sui-box-body">
						<h3><?php esc_html_e( 'Hummingbird Page Speed Optimization', 'wp-smushit' ); ?></h3>
						<p><?php esc_html_e( 'Performance Tests, File Optimization & Compression, Page, Browser & Gravatar Caching, GZIP Compression, CloudFlare Integration & more.', 'wp-smushit' ); ?></p>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/hummingbird-performance/' ); ?>" class="sui-button sui-button-ghost" target="_blank">
							<?php esc_html_e( 'View features', 'wp-smushit' ); ?> <i class="sui-icon-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="sui-col-md-4">
				<div class="sui-cross-2 sui-cross-defender"><span></span></div>
				<div class="sui-box">
					<div class="sui-box-body">
						<h3><?php esc_html_e( 'Defender Security, Monitoring, and Hack Protection', 'wp-smushit' ); ?></h3>
						<p><?php esc_html_e( 'Security Tweaks & Recommendations, File & Malware Scanning, Login & 404 Lockout Protection, Two-Factor Authentication & more.', 'wp-smushit' ); ?></p>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/defender-security/' ); ?>" class="sui-button sui-button-ghost" target="_blank">
							<?php esc_html_e( 'View features', 'wp-smushit' ); ?> <i class="sui-icon-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="sui-col-md-4">
				<div class="sui-cross-3 sui-cross-smartcrawl"><span></span></div>
				<div class="sui-box">
					<div class="sui-box-body">
						<h3><?php esc_html_e( 'SmartCrawl Search Engine Optimization', 'wp-smushit' ); ?></h3>
						<p><?php esc_html_e( 'Customize Titles & Metadata, OpenGraph, Twitter & Pinterest Support, Auto-Keyword Linking, SEO & Readability Analysis, Sitemaps, URL Crawler & more.', 'wp-smushit' ); ?></p>
						<a href="<?php echo esc_url( 'https://wordpress.org/plugins/smartcrawl-seo/' ); ?>" class="sui-button sui-button-ghost" target="_blank">
							<?php esc_html_e( 'View features', 'wp-smushit' ); ?> <i class="sui-icon-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="sui-cross-sell-bottom">
			<?php
			$site_url = add_query_arg(
				array(
					'utm_source'   => 'smush',
					'utm_medium'   => 'plugin',
					'utm_campaign' => 'smush_footer_upsell_notice',
				),
				esc_url( 'https://premium.wpmudev.org' )
			);
			?>
			<h3><?php esc_html_e( 'Your All-in-One WordPress Platform', 'wp-smushit' ); ?></h3>
			<p><?php esc_html_e( 'Pretty much everything you need for developing and managing WordPress based websites, and then some.', 'wp-smushit' ); ?></p>
			<a class="sui-button sui-button-green" href="<?php echo esc_url( $site_url ); ?>" id="dash-uptime-update-membership" target="_blank">
				<?php esc_html_e( 'Learn more', 'wp-smushit' ); ?>
			</a>
			<img class="sui-image" src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/dev-team.png' ); ?>" srcset="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/dev-team@2x.png' ); ?> 2x" alt="<?php esc_attr_e( 'Try pro features for free!', 'wp-smushit' ); ?>">
		</div>
	<?php endif; ?>

	<div class="sui-footer">
		<?php esc_html_e( 'Made with', 'wp-smushit' ); ?> <i class="sui-icon-heart" aria-hidden="true"></i> <?php esc_html_e( 'by WPMU DEV', 'wp-smushit' ); ?>
	</div>

	<ul class="sui-footer-nav">
		<li><a href="https://profiles.wordpress.org/wpmudev#content-plugins" target="_blank">
				<?php esc_html_e( 'Free Plugins', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/features/" target="_blank">
				<?php esc_html_e( 'Membership', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/roadmap/" target="_blank">
				<?php esc_html_e( 'Roadmap', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://wordpress.org/support/plugin/wp-smushit" target="_blank">
				<?php esc_html_e( 'Support', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/docs/" target="_blank">
				<?php esc_html_e( 'Docs', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/hub-welcome/" target="_blank">
				<?php esc_html_e( 'The Hub', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/terms-of-service/" target="_blank">
				<?php esc_html_e( 'Terms of Service', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://incsub.com/privacy-policy/" target="_blank">
				<?php esc_html_e( 'Privacy Policy', 'wp-smushit' ); ?>
			</a></li>
	</ul>

<?php else : ?>

	<div class="sui-footer">
		<?php esc_html_e( 'Made with', 'wp-smushit' ); ?> <i class="sui-icon-heart" aria-hidden="true"></i> <?php esc_html_e( 'by WPMU DEV', 'wp-smushit' ); ?>
	</div>

	<ul class="sui-footer-nav">
		<li><a href="https://premium.wpmudev.org/hub/" target="_blank">
				<?php esc_html_e( 'The Hub', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/projects/category/plugins/" target="_blank">
				<?php esc_html_e( 'Plugins', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/roadmap/" target="_blank">
				<?php esc_html_e( 'Roadmap', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/hub/support/" target="_blank">
				<?php esc_html_e( 'Support', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/docs/" target="_blank">
				<?php esc_html_e( 'Docs', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/hub/community/" target="_blank">
				<?php esc_html_e( 'Community', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/academy/" target="_blank">
				<?php esc_html_e( 'Academy', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://premium.wpmudev.org/terms-of-service/" target="_blank">
				<?php esc_html_e( 'Terms of Service', 'wp-smushit' ); ?>
			</a></li>
		<li><a href="https://incsub.com/privacy-policy/" target="_blank">
				<?php esc_html_e( 'Privacy Policy', 'wp-smushit' ); ?>
			</a></li>
	</ul>
<?php endif; ?>
