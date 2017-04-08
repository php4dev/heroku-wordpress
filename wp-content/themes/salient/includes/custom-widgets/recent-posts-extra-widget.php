<?php


function Recent_Posts_Extra_init() {
	register_widget('Recent_Posts_Extra_Widget');
}

add_action('widgets_init', 'Recent_Posts_Extra_init');

class Recent_Posts_Extra_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'recent_posts_extra_widget', 'description' => __( "The most recent posts on your site, including post thumbnails & dates.",NECTAR_THEME_NAME));
		parent::__construct('recent-posts-extra', __('Recent Posts Extra',NECTAR_THEME_NAME), $widget_ops);
		$this->alt_option_name = 'recent_posts_extra_widget';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('recent_posts_extra_widget', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts Extra',NECTAR_THEME_NAME) : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish'));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php global $post ?>
				<div class="post-widget-image"> <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php echo get_the_post_thumbnail($post->ID, 'blog-widget', array('title' => '')); ?></a></div> 
			<?php } ?>
			<div class="post-widget-text">
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a> 
				<span><?php the_time(get_option('date_format')); ?></span> 
			</div>
			<div class='clear'></div>
		</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('recent_posts_extra_widget', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['recent_posts_extra_widget']) )
			delete_option('recent_posts_extra_widget');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('recent_posts_extra_widget', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', NECTAR_THEME_NAME); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', NECTAR_THEME_NAME); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="2" /><br />
		<small><?php _e('(at most 15)', NECTAR_THEME_NAME); ?></small></p>
<?php
	}
}


?>