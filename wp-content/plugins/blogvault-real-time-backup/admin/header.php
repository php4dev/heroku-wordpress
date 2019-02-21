<?php
	if ($this->bvmain->isMalcare()) {
		$headerColor = "#4686f5";
		$pluginSlug = "malcare-security";
		$headerLogoLink = $this->getWebPage() . "/?utm_source=mc_plugin_lp_logo&utm_medium=logo_link&utm_campaign=mc_plugin_lp_header&utm_term=header_logo&utm_content=image_link";
	} else {
		$headerColor = "#25bea0";
		$pluginSlug = "blogvault-real-time-backup";
		$headerLogoLink = $this->getWebPage() . "/?utm_source=bv_plugin_lp_logo&utm_medium=logo_link&utm_campaign=bv_plugin_lp_header&utm_term=header_logo&utm_content=image_link";
	}
?>
<div id="content-wrapper" style="width: 99%;">
	<!-- Content HTML goes here -->
	<div class="mui-container-fluid">
		<div class="mui--appbar-height"></div>
		<br><br>
		<div class="mui-row">
			<div style="background: <?php echo $headerColor;?>; overflow: hidden;">
				<a href="<?php echo $headerLogoLink; ?>"><img src="<?php echo plugins_url($this->getPluginLogo(), __FILE__); ?>" style="padding: 10px;"></a>
				<div class="top-links">
					<span class="bv-top-button"><a href="https://wordpress.org/support/plugin/<?php echo $pluginSlug; ?>/reviews/#new-post">Leave a Review</a></span>
					<span class="bv-top-button"><a href="https://wordpress.org/support/plugin/<?php echo $pluginSlug; ?>/">Need Help?</a></span>
				</div>
			</div>
		</div>
	</div>
</div>