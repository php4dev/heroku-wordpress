<?php
/**
 * Post Object
*
* @author Mike Ems
* @package Mvied
*/
class Mvied_Post {

	/**
	 * @var int $ID Are you updating an existing post?
	 */
	public $ID;

	/**
	 * @var string $post_title The title of your post.
	 */
	public $post_title;

	/**
	 * @var string $post_content The full text of the post.
	 */
	public $post_content;

	/**
	 * @var string $post_name The name (slug) for your post
	 */
	public $post_name;

	/**
	 * @var string $post_status [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] Default 'draft'.
	 */
	public $post_status;

	/**
	 * @var string $post_type [ 'post' | 'page' | 'link' | 'nav_menu_item' | custom post type ] Default 'post'
	 */
	public $post_type;

	/**
	 * @var int $post_author The user ID number of the author. Default is the current user ID.
	 */
	public $post_author;

	/**
	 * @var string $ping_status [ 'closed' | 'open' ] Pingbacks or trackbacks allowed. Default is the option 'default_ping_status'.
	 */
	public $ping_status;

	/**
	 * @var int $post_parent Sets the parent of the new post, if any. Default 0.
	 */
	public $post_parent;

	/**
	 * @var int $menu_order If new post is a page, sets the order in which it should appear in supported menus. Default 0.
	 */
	public $menu_order;

	/**
	 * @var string $to_ping Space or carriage return-separated list of URLs to ping. Default empty string.
	 */
	public $to_ping;

	/**
	 * @var string $pinged Space or carriage return-separated list of URLs that have been pinged. Default empty string.
	 */
	public $pinged;

	/**
	 * @var string $post_password Password for post, if any. Default empty string.
	 */
	public $post_password;

	/**
	 * @var string $post_excerpt For all your post excerpt needs.
	 */
	public $post_excerpt;

	/**
	 * @var string $post_date [ Y-m-d H:i:s ] The time post was made.
	 */
	public $post_date;

	/**
	 * @var string $post_date_gmt [ Y-m-d H:i:s ] The time post was made, in GMT.
	 */
	public $post_date_gmt;

	/**
	 * @var string $comment_status [ 'closed' | 'open' ] Default is the option 'default_comment_status', or 'closed'.
	 */
	public $comment_status;

	/**
	 * @var array $post_category [ array(<category id>, ...) ] Default empty.
	 */
	public $post_category;

	/**
	 * @var string|array $tags_input [ '<tag>, <tag>, ...' | array ] Default empty.
	 */
	public $tags_input;

	/**
	 * @var string|array $tax_input [ array( <taxonomy> => <array | string> ) ] For custom taxonomies. Default empty.
	 */
	public $tax_input;

	/**
	 * @var string $page_template Default empty.
	 */
	public $page_template;

	/**
	 * Instantiate Post from ID
	 *
	 * @param int $id
	 * @throws Exception
	 * @return void
	 */
	public function __construct( $id = null) {
		if ( $id ) {
			$this->load( get_post($id, ARRAY_A) );
		}
	}

	/**
	 * Get Post Meta
	 *
	 * @param string $meta_key
	 * @param bool $single Return single value or array, default true
	 * @return mixed
	 */
	public function getPostMeta( $meta_key, $single = true ) {
		if ($this->ID) {
			return get_post_meta($this->ID, $meta_key, $single);
		}
	}

	/**
	 * Update Post Meta
	 *
	 * @param string $meta_key
	 * @param mixed $meta_value
	 * @return mixed
	 */
	public function updatePostMeta($meta_key, $meta_value) {
		if ($this->ID) {
			return update_post_meta($this->ID, $meta_key, $meta_value);
		}
	}

	/**
	 * Format objec to array
	 * 
	 * @param none
	 * @return array
	 */
	public function toArray() {
		return (array) $this;
	}

	/**
	 * Load from Array
	 *
	 * @param array $array
	 * @return mixed
	 */
	public function load( $array = array() ) {
		foreach($array as $key => $value) {
			$this->$key = $value;
		}
	}

	/**
	 * Save
	 *
	 * @param none
	 * @return void
	 */
	public function save() {
		if ($this->ID) {
			return wp_update_post( $this->toArray() );
		} else {
			return $this->ID = wp_insert_post( $this->toArray() );
		}
	}

}