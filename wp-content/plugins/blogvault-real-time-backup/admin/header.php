<div id="content-wrapper">
	<!-- Content HTML goes here -->
	<div class="mui-container-fluid">
		<div class="mui--appbar-height"></div>
		<br><br>
		<div class="mui-row" >
			<div class="mui-col-md-6 mui-col-md-offset-3 mui--text-center" style="padding-bottom:1.5%;">
				<a href="<?php echo $this->getWebPage() ?>"><img src="<?php echo plugins_url($this->getPluginLogo(), __FILE__); ?>" /></a>
			</div>
			<div class="mui-col-md-6 mui-col-md-offset-3 mui--text-center" >
				<?php if (!isset($_REQUEST['free'])) { ?>
						<div align="center" style="margin-bottom: 25px;">
				<?php if ($this->bvmain->getBrandName() === 'MalCare - Pro') {?>
							<iframe id="video" width="360" height="240" src="//www.youtube.com/embed/rBuYh2dIadk?rel=0" frameborder="0" allowfullscreen></iframe>
				<?php } else {?>
							<iframe style="border: 1px solid gray; padding: 3px;" src="https://player.vimeo.com/video/88638675?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="450" height="275" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php }?>
				  	</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>