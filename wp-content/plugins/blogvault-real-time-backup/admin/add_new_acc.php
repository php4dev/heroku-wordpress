<?php
	if ($this->bvmain->isMalcare()) {
		$signupFormTitle = "Let's scan your website";
		$signupPurpose = ["Malware Scan", "Malware Clean", "Firewall", "Login Protection", "Others"];
		$signupButtonText = "Scan Site";
		$signupButtonColor = "#4686f5";
	} else {
		$signupFormTitle = "Let's get your FREE Backup";
		$signupPurpose = ["Backup", "Staging", "Restore", "Migrate", "Manage", "Others"];
		$signupButtonText = "Get started";
		$signupButtonColor = "#25bea0";
	}
?>
<div id="content-wrapper" style="width: 99%">
	<div class="mui-container-fluid" style="padding: 0px;">
		<div class="mui-col-md-10" style="padding-left: 0px;">
			<br>
			<div class="bv-box" style="padding-top: 10px; padding-bottom: 10px;">
			<?php require_once dirname( __FILE__ ) . "/top_box.php";?>
			</div>
			<div class="mui-panel new-account-panel">
				<form dummy=">" action="<?php echo $this->bvmain->appUrl(); ?>/plugin/bvstart" style="padding-top:10px; margin: 0px;" onsubmit="document.getElementById('get-started').disabled = true;"  method="post" name="signup">
					<div style="width: 800px; margin: 0 auto; padding: 10px;">
					<div class="mui--text-title form-title"><?php echo $signupFormTitle; ?></div>
						<input type='hidden' name='bvsrc' value='wpplugin' />
							<?php echo $this->siteInfoTags(); ?>
						<input type="text" class="bv-input" id="email" name="email" style="width:430px;" placeholder="Enter your email" required>
						<select name="purpose" class="bv-input select-purpose" required>
							<option value="" hidden>Looking for?</option>
							<?php
								foreach($signupPurpose as $value) {
									echo "<option value='".$value."'>".$value."</option>";
                }
							?>
						</select>
						<button id="get-started" class="mui-btn mui-btn--raised mui-btn--primaryi get-started-button" type="submit" style="background: <?php echo $signupButtonColor; ?>;"><?php echo $signupButtonText; ?></button><br/>
						<input type="checkbox" name="consent" value="1" required/>I agree to Blogvault <a href="https://www.blogvault.net/tos" target="_blank" rel="noopener noreferrer">Terms of Service</a> and <a href="https://www.blogvault.net/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
					</div>
				</form>
				<br/>
			</div>
		</div>
		<div class="mui-col-md-2 side">
			<?php if ($this->bvmain->isBlogvault()) { ?>
			<div class="side-box" style="margin: 0px !important;">
				<h2 class="side-box-title">Why choose BlogVault ?</h2>
				<strong>
					<ul>
						<li><span class="bv-tick">&#10003;</span> 100% Working Backups</li>
						<li><span class="bv-tick">&#10003;</span> FREE Staging Site</li>
						<li><span class="bv-tick">&#10003;</span> Fastest Website Recovery</li>
						<li><span class="bv-tick">&#10003;</span> Flawless 1-Click Migrations</li>
						<li><span class="bv-tick">&#10003;</span> WooCommerce Backups</li>
						<li><span class="bv-tick">&#10003;</span> Doesn't slow website ever</li>
						<li><span class="bv-tick">&#10003;</span> Full Website Management</li>
					</ul>
				</strong>
			</div>
			<div class="side-box" style="margin-top: 20px; overflow: hidden;">
				<h2 class="side-box-title">What's in BlogVault Pro?</h2>
				<strong>
					<ul>
						<li><span class="bv-tick">&#10003;</span> Daily Automatic Backups</li>
						<li><span class="bv-tick">&#10003;</span> Real-Time backups</li>
						<li><span class="bv-tick">&#10003;</span> Personalized Support</li>
						<li><span class="bv-tick">&#10003;</span> Add Users and Clients</li>
						<li><span class="bv-tick">&#10003;</span> White Label Plugin</li>
						<li><span class="bv-tick">&#10003;</span> Client Reporting</li>
					</ul>
				</strong>
				<div class="bv-upgrade-button"><a href="https://blogvault.net/pricing/?utm_source=bv_plugin_lp_pricing&utm_medium=lp_upgrade&utm_campaign=bv_plugin_lp_upgrade&utm_term=upgrade_button&utm_content=button_link">Get Me Pro &raquo;</a></span>
			</div>
		</div>
		<?php } ?>
	</div>
</div>