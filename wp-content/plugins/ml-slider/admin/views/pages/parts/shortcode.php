<?php if (!defined('ABSPATH')) {
    die('No direct access.');
}
/**
 * The shortcode module
 */
?>
<metaslider-shortcode inline-template>
	<div class="shadow-sm bg-white mb-6 flex flex-col">
		<div class="flex p-3 justify-between">
			<h3 class="p-0 m-0"><span><?php _e("How to Use", "ml-slider"); ?></span></h3>

			<div class="m-0 flex">
				<button @click.prevent="useTitle = !useTitle" class="flex items-end">
					<?php _e("Toggle title", "ml-slider"); ?>
				</button>
			</div>
		</div>

		<div class="m-3 mt-2">
			<p class="mt-0"><?php _e('To display your slideshow, add the following shortcode (in orange) to your page. If adding the slideshow to your theme files, additionally include the surrounding PHP code (in gray).&lrm;', 'ml-slider'); ?></p>

			<pre id="shortcode" ref="shortcode" dir="ltr" class="text-gray text-sm">&lt;?php echo do_shortcode('<br>&emsp;&emsp;<div @click.prevent="copyShortcode($event)" class="text-orange cursor-pointer whitespace-normal inline">[metaslider <template v-if="useTitle">title="{{ current.title }}"</template><template v-else>id="{{ current.id }}"</template>]</div><br>'); ?&gt;</pre>

			<div class="flex mt-4 justify-between">
				<p class="m-0"><?php _e('Click shortcode to copy', 'ml-slider'); ?></p>
				<button @click.prevent="copyAll()" class="text-xs flex items-center" title="<?php _e("Copy all code", "ml-slider"); ?>">
                    <svg class="text-gray mr-px rtl:mr-0 rtl:ml-px w-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                    <?php _e("Copy all", "ml-slider"); ?>
				</button>
			</div>

		</div>
	</div>
</metaslider-shortcode>
