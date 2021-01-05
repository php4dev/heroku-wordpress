<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//Leaven empty tag to let automation add the path disclosure line
?>
<div class="corner-head">
	<div class="bf-satisfaction" data-section="1">
		<div class="bf-satisfaction-container">
			<div class="bf-satisfaction-top">
				<div class="bf-satisfaction-top-title"><?php _e('How likely is it that you would recommend BuddyForms to a friend or colleague?', 'buddyforms'); ?></div>
			</div>
			<div class="bf-satisfaction-body">
				<section class="bf-satisfaction-column" data-section="1" data-section-title="<?php _e('How likely is it that you would recommend BuddyForms to a friend or colleague?', 'buddyforms'); ?>">
					<div>
						<span class="bf-satisfaction-body-medium"><?php _e('Not at all likely', 'buddyforms'); ?></span>
						<span class="bf-satisfaction-body-medium"><?php _e('Extremely likely', 'buddyforms'); ?></span>
					</div>
					<div class="bf-satisfaction-row">
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="0">
							<span>0</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="1">
							<span>1</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="2">
							<span>2</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="3">
							<span>3</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="4">
							<span>4</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="5">
							<span>5</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="6">
							<span>6</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="7">
							<span>7</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="8">
							<span>8</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="9">
							<span>9</span>
						</label>
						<label data-style="hover">
							<input type="radio" name="satisfaction_recommendation" value="10">
							<span>10</span>
						</label>
					</div>
					<div>
						<div></div>
						<button class="bf-satisfaction-button" data-user-error="<?php _e('Please select an item to continue', 'buddyforms'); ?>" data-server-error="<?php _e('Internal error', 'buddyforms'); ?>" data-satisfaction-form-action="ajax" data-satisfaction-form-inputs="satisfaction_recommendation:checked"><?php _e('Submit', 'buddyforms'); ?></button>
					</div>
				</section>
				<section class="bf-satisfaction-column" data-section="2" data-section-title="<?php _e('We are king to see you happy! What is that one thing, for you, that make BuddyForms stand apart? (Optional)', 'buddyforms'); ?>">
					<textarea name="satisfaction_comments" cols="30" rows="10"></textarea>
					<div>
						<div></div>
						<button class="bf-satisfaction-button" data-satisfaction-form-action="ajax" data-satisfaction-form-inputs="satisfaction_comments"><?php _e('Submit or Done', 'buddyforms'); ?></button>
					</div>
				</section>
				<section class="bf-satisfaction-column" data-section="3" data-section-title="<?php _e('Thanks you', 'buddyforms'); ?>">
					<div>
						<div></div>
						<button class="bf-satisfaction-button" data-satisfaction-action="close"><?php _e('Close', 'buddyforms'); ?></button>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
