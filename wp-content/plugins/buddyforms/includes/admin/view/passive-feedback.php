<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//Leaven empty tag to let automation add the path disclosure line
?>
<div class="tk-feedback" data-html2canvas-ignore="true" hidden="hidden">
	<div class="tk-feedback-frontend">
		<button class="tk-feedback-frontend-button tk-always-active" data-tk-feedback-action="dialog:1">
			<svg height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg">
				<path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 12h-2v-2h2v2zm0-4h-2V6h2v4z"></path>
			</svg>
		</button>
	</div>
	<div class="tk-feedback-backend">
		<div class="tk-feedback-backend-dialog" data-open="0">
			<div class="tk-feedback-backend-dialog-back" data-tk-feedback-action="dialog:0"></div>
			<div class="tk-feedback-backend-dialog-window">
				<div class="tk-feedback-backend-dialog-window-top"><?php _e('Send feedback', 'buddyforms'); ?></div>
				<div class="tk-feedback-backend-dialog-window-body">
					<div id="tk-feedback-alert" data-state="">
						<section data-id="ok"><?php _e('Sent successfully to support.', 'buddyforms'); ?></section>
						<section data-id="load"><?php _e('Sending...', 'buddyforms'); ?></section>
						<section data-id="user"><?php _e('Write something before sending.', 'buddyforms'); ?></section>
						<section data-id="server"><?php _e('We couldn\'t send it, try later', 'buddyforms'); ?></section>
					</div>
					<textarea id="tk-feedback-text" name="tk-feedback-text" placeholder="<?php _e('Have feedback? We’d love to hear it, but please don’t share sensitive information. Have questions?', 'buddyforms'); ?>"></textarea>
					<div id="tk-feedback-screenshot"><img src="" alt="<?php _e('Screenshot', 'buddyforms'); ?>"></div>
				</div>
				<div class="tk-feedback-backend-dialog-window-end">
					<button data-tk-feedback-action="dialog:0"><?php _e('Cancel', 'buddyforms'); ?></button>
					<button data-tk-feedback-action="submit:1"><?php _e('Send', 'buddyforms'); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>
