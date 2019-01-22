<div id="content-wrapper">
	<div class="mui-container-fluid">
		<div class="mui-col-md-6 mui-col-md-offset-3" style="padding-top:1%;">
			<div class="mui-panel">
				<div class="mui--text-title">Enter your email to get started.</div>
				<div style="color:grey;padding:1% ;">All plans(<a href="https://blogvault.net/pricing?bvsrc=wpplugin&wpurl=<?php echo urlencode($this->bvmain->info->wpurl()) ?>">See Pricing</a>) come with free 1 week trial.</div>
				<form dummy=">" action="<?php echo $this->bvmain->appUrl(); ?>/plugin/bvstart" style="padding-top:10px;" onsubmit="document.getElementById('get-started').disabled = true;"  method="post" name="signup">
					<input type='hidden' name='bvsrc' value='wpplugin' />
						<?php echo $this->siteInfoTags(); ?>
					<input type="text" id="email" name="email" style="height: 35px;width:70%;" ><br><br>
					<input type="checkbox" name="consent" value="1"/>I agree to Blogvault <a href="https://www.blogvault.net/tos" target="_blank" rel="noopener noreferrer">Terms of Service</a> and <a href="https://www.blogvault.net/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy</a><br><br>
					<button id="get-started" class="mui-btn mui-btn--raised mui-btn--primary" type="submit" style="margin-left:10px;">Get started</button>
				</form>
			</div>
		</div>
	</div>
</div>