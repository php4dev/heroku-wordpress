<?php
	if ($this->bvmain->isMalcare()) {
		$mainTitle = "Are you Hacked? Scan Your Website for FREE.";
		$videoId = "rBuYh2dIadk";
		$testimonialImg = "/../img/testimonial_mc.png";
	} else {
		$mainTitle = "Create Smart Incremental Backups On Cloud.";
		$videoId = "Y4teDRL08mY";
		$testimonialImg = "/../img/testimonial_bv.png";
	}
?>
<div class="mui--text-title main-title"><?php echo $mainTitle; ?></div>
<br/><br/>
<div style= "width: 800px; margin: 20px auto; overflow: hidden;">
	<div style="width: 49%; float: left; border-right: 2px solid #333;">
		<iframe width="380" height="215" src="https://www.youtube.com/embed/<?php echo $videoId; ?>"></iframe>
	</div>
	<div style="width: 49%; float: right;">
		<img src="<?php echo plugins_url($testimonialImg, __FILE__); ?>"/>
	</div>
</div>