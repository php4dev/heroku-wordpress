<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVDynSync')) :
	
class BVDynSync {

	public static $dynsync_table = 'dynamic_sync';
	public $bvmain;
	/**
	 * PHP5 constructor.
	 */
	function __construct($bvmain) {
		$this->bvmain = $bvmain;
	}

	function init() {
		$this->add_actions_and_listeners();
		add_action('clear_dynsync_config', array($this, 'clearConfig'));
	}

	public function clearConfig() {
		$this->bvmain->info->deleteOption('bvdynplug');
		$this->bvmain->info->deleteOption('bvDynSyncActive');
		$this->bvmain->info->deleteOption('bvWooDynSync');
		$this->bvmain->db->dropBVTable(BVDynSync::$dynsync_table);
	}

	public static function getDynSyncTableName() {
		return $this->bvmain->db->getBVTable(BVDynSync::$dynsync_table);
	}

	function add_event($event_type, $event_data) {
		global $wp_current_filter;
		$site_id = get_current_blog_id();
		$values = array ( "event_type" => $event_type, "event_tag" => end($wp_current_filter), "event_data" => maybe_serialize($event_data), "site_id" => $site_id);
		$this->bvmain->db->replaceIntoBVTable(BVDynSync::$dynsync_table, $values);
	}

	function add_db_event($table, $message) {
		$_msg = array();
		$_msg['table'] = $table;
		$_msg['data'] = $message;
		$this->add_event('db', $_msg);
	}

	function post_action_handler($post_id) {
		if (current_filter() == 'delete_post')
			$msg_type = 'delete';
		else 
			$msg_type = 'edit';
		$this->add_db_event('posts', array('ID' => $post_id, 'msg_type' => $msg_type));
	}

	function get_ignored_postmeta() {
		$defaults = array(
			'_excluded_links'
		);
		$ignored_postmeta = $this->bvmain->info->getOption('bvIgnoredPostmeta');
		if (empty($ignored_postmeta)) {
			$ignored_postmeta = array();
		}
		return array_unique(array_merge($defaults, $ignored_postmeta));
	}

	function postmeta_insert_handler($meta_id, $post_id, $meta_key, $meta_value='') {
		if (in_array($meta_key, $this->get_ignored_postmeta(), true))
			return;
		$this->add_db_event('postmeta', array('meta_id' => $meta_id));
	}

	function postmeta_modification_handler($meta_id, $object_id, $meta_key, $meta_value) {
		if (in_array($meta_key, $this->get_ignored_postmeta(), true))
			return;
		if (!is_array($meta_id))
			return $this->add_db_event('postmeta', array('meta_id' => $meta_id));
		foreach ($meta_id as $id) {
			$this->add_db_event('postmeta', array('meta_id' => $id));
		}
	}

	function postmeta_action_handler($meta_id, $post_id = null, $meta_key = null) {
		if (in_array($meta_key, $this->get_ignored_postmeta(), true))
			return;
		if ( !is_array($meta_id) )
			return $this->add_db_event('postmeta', array('meta_id' => $meta_id));
		foreach ( $meta_id as $id )
			$this->add_db_event('postmeta', array('meta_id' => $id));
	}

	function comment_action_handler($comment_id) {
		if (current_filter() == 'delete_comment')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';
		if (!is_array($comment_id)) {
			if (wp_get_comment_status($comment_id) != 'spam')
				$this->add_db_event('comments', array('comment_ID' => $comment_id, 'msg_type' => $msg_type));
		} else {
			foreach ($comment_id as $id) {
				if (wp_get_comment_status($comment_id) != 'spam')
					$this->add_db_event('comments', array('comment_ID' => $idi, 'msg_type' => $msg_type));
			}
		}
	}

	function commentmeta_insert_handler($meta_id, $comment_id = null) {
		if (empty($comment_id) || wp_get_comment_status($comment_id) != 'spam')
			$this->add_db_event('commentmeta', array('meta_id' => $meta_id));
	}

	function commentmeta_modification_handler($meta_id, $object_id, $meta_key, $meta_value) {
		if (current_filter() == 'deleted_comment_meta')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';
		if (!is_array($meta_id))
			return $this->add_db_event('commentmeta', array('meta_id' => $meta_id, 'msg_type' => $msg_type));
		foreach ($meta_id as $id) {
			$this->add_db_event('commentmeta', array('meta_id' => $id, 'msg_type' => $msg_type));
		}
	}

	function userid_action_handler($user_or_id) {
		if (is_object($user_or_id))
			$userid = intval( $user_or_id->ID );
		else
			$userid = intval( $user_or_id );
		if ( !$userid )
			return;
		if (current_filter() == 'deleted_user')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';

		$this->add_db_event('users', array('ID' => $userid));
	}

	function usermeta_insert_handler($umeta_id, $user_id = null) {
		$this->add_db_event('usermeta', array('umeta_id' => $umeta_id));
	}

	function usermeta_modification_handler($umeta_id, $object_id, $meta_key, $meta_value = '') {
		if (current_filter() == 'delete_usermeta')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';
		if (!is_array($umeta_id))
			return $this->add_db_event('usermeta', array('umeta_id' => $umeta_id, 'msg_type' => $msg_type));
		foreach ($umeta_id as $id) {
			$this->add_db_event('usermeta', array('umeta_id' => $id, 'msg_type' => $msg_type));
		}
	}

	function link_action_handler($link_id) {
		$this->add_db_event('links', array('link_id' => $link_id));
	}

	function edited_terms_handler($term_id, $taxonomy = null) {
		$this->add_db_event('terms', array('term_id' => $term_id));
	}

	function term_handler($term_id, $tt_id, $taxonomy) {
		$this->add_db_event('terms', array('term_id' => $term_id));
		$this->term_taxonomy_handler($tt_id, $taxonomy);
	}

	function delete_term_handler($term, $tt_id, $taxonomy, $deleted_term ) {
		$this->add_db_event('terms', array('term_id' => $term, 'msg_type' => 'delete'));
	}

	function term_taxonomy_handler($tt_id, $taxonomy = null) {
		$this->add_db_event('term_taxonomy', array('term_taxonomy_id' => $tt_id));
	}

	function term_taxonomies_handler($tt_ids) {
		foreach((array)$tt_ids as $tt_id) {
			$this->term_taxonomy_handler($tt_id);
		}
	}

	function term_relationship_handler($object_id, $term_id) {
		$this->add_db_event('term_relationships', array('term_taxonomy_id' => $term_id, 'object_id' => $object_id));
	}

	function term_relationships_handler($object_id, $term_ids) {
		foreach ((array)$term_ids as $term_id) {
			$this->term_relationship_handler($object_id, $term_id);
		}
	}

	function set_object_terms_handler( $object_id, $terms, $tt_ids ) {
		$this->term_relationships_handler( $object_id, $tt_ids );
	}

	function get_ignored_options() {
		$defaults = array(
			'cron',
			'wpsupercache_gc_time',
			'rewrite_rules',
			'akismet_spam_count',
			'iwp_client_user_hit_count',
			'_disqus_sync_lock',
			'stats_cache'
		);
		$ignored_options = $this->bvmain->info->getOption('bvIgnoredOptions');
		if (empty($ignored_options)) {
			$ignored_options = array();
		}
		return array_unique(array_merge($defaults, $ignored_options));
	}

	function get_ping_permission($option_name) {
		$ping_permitted = true;
		$ignored_options = $this->get_ignored_options();
		foreach($ignored_options as $val) {
			if ($val{0} == '/') {
				if (preg_match($val, $option_name))
					$ping_permitted = false;
			} else {
				if ($val == $option_name)
					$ping_permitted = false;
			}
			if (!$ping_permitted)
				break;
		}
		return $ping_permitted;
	}

	function option_handler($option_name) {
		if (current_filter() == 'deleted_option')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';
		$ping_permitted = $this->get_ping_permission($option_name);
		if ($ping_permitted)
			$this->add_db_event('options', array('option_name' => $option_name, 'msg_type' => 'delete'));
		return $option_name;
	}

	function theme_action_handler($theme) {
		$this->add_event('themes', array('theme' => $this->bvmain->info->getOption('stylesheet')));
	}

	function plugin_action_handler($plugin='') {
		$this->add_event('plugins', array('name' => $plugin));
	}

	function upload_handler($file) {
		$this->add_event('uploads', array('file' => $file['file']));
		return $file;	
	}

	function wpmu_new_blog_create_handler($site_id) {
		$this->add_db_event('blogs', array('site_id' => $site_id));
	}

	function sitemeta_handler($option) {
		$ping_permitted = $this->get_ping_permission($option);
		if ($ping_permitted && is_multisite()) {
			$this->add_db_event('sitemeta', array('site_id' => $this->bvmain->db->getSiteId(), 'meta_key' => $option));
		}
		return $ping_permitted;
	}

	/* WOOCOMMERCE SUPPORT FUNCTIONS BEGINS FROM HERE*/

	function woocommerce_resume_order_handler($order_id) {
		$this->add_db_event('woocommerce_order_items', array('order_id' => $order_id, 'msg_type' => 'delete'));
		$meta_ids = array();
		$itemmeta_table = $this->bvmain->db->getWPTable('woocommerce_order_itemmeta');
		$items_table = $this->bvmain->db->getWPTable('woocommerce_order_items');
		foreach( $this->bvmain->db->getResult($this->bvmain->db->prepare("SELECT {$itemmeta_table}.meta_id FROM {$itemmeta_table} INNER JOIN {$items_table} WHERE {$items_table}.order_item_id = {$itemmeta_table}.order_item_id AND {$items_table}.order_id = %d", $order_id)) as $key => $row) {
			if (!in_array($row->meta_id, $meta_ids, true)) {
				$meta_ids[] = $row->meta_id;
				$this->add_db_event('woocommerce_order_itemmeta', array('meta_id' => $row->meta_id, 'msg_type' => 'delete'));
			}
		}
	}

	function woocommerce_new_order_item_handler($item_id, $item, $order_id) {
		$this->add_db_event('woocommerce_order_items', array('order_item_id' => $item_id));
		$this->add_db_event('woocommerce_order_itemmeta', array('order_item_id' => $item_id));
	}

	function woocommerce_update_order_item_handler($item_id, $args){
		$this->add_db_event('woocommerce_order_items', array('order_item_id' => $item_id));
	}

	function woocommerce_delete_order_item_handler($item_id) {
		$this->add_db_event('woocommerce_order_itemmeta', array('order_item_id' => $item_id, 'msg_type' => 'delete'));
		$this->add_db_event('woocommerce_order_items', array('order_item_id' => $item_id, 'msg_type' => 'delete'));
	}

	function woocommerce_downloadable_product_permissions_delete_handler($bool, $download_id, $product_id, $order) {
		$this->add_db_event('woocommerce_downloadable_product_permissions', array('order_id' => $order->id, 'product_id' => $product_id, 'download_id' => $download_id));
		return true;
	}

	function woocommerce_attribute_added_handler($attribute_id, $attribute) {
		$this->add_db_event('woocommerce_attribute_taxonomies', array('attribute_id' => $attribute_id));
	}

	function woocommerce_attribute_updated_handler($attribute_id, $attribute, $old_attribute_name) {
		$this->add_db_event('woocommerce_attribute_taxonomies', array('attribute_id' => $attribute_id));
		# $woocommerce->attribute_taxonomy_name( $attribute_name )
		$this->add_db_event('term_taxonomy', array('taxonomy' => wc_attribute_taxonomy_name($attribute['attribute_name'])));
		# sanitize_title( $attribute_name )
		$this->add_db_event('woocommerce_termmeta', array('meta_key' => 'order_pa_' . $attribute['attribute_name']));#deprecated
		$this->add_db_event('termmeta', array('meta_key' => 'order_pa_' . $attribute['attribute_name']));
		$this->add_db_event('postmeta', array('meta_key' => '_product_attributes'));
		# sanitize_title( $attribute_name )
		$this->add_db_event('postmeta', array('meta_key' => 'attribute_pa_' . $attribute['attribute_name']));
	}

	function woocommerce_attribute_deleted_handler($attribute_id, $attribute_name, $taxonomy) {
		return $this->add_db_event('woocommerce_attribute_taxonomies', array('attribute_id' => $attribute_id, 'msg_type' => 'delete'));
	}

	function woocommerce_revoke_access_to_product_download_handler($download_id, $product_id, $order_id, $permission_id ) {
		$this->add_db_event('woocommerce_downloadable_product_permissions', array('permission_id' => $permission_id, 'msg_type' => 'delete'));
	}

	function woocommerce_tax_rate_handler($tax_rate_id, $_tax_rate) {
		$this->add_db_event('woocommerce_tax_rates', array('tax_rate_id' => $tax_rate_id));
		$this->add_db_event('woocommerce_tax_rate_locations', array('tax_rate_id' => $tax_rate_id));
	}

	function woocommerce_tax_rate_deleted_handler($tax_rate_id) {
		$this->add_db_event('woocommerce_tax_rates', array('tax_rate_id' => $tax_rate_id, 'msg_type' => 'delete'));
		$this->add_db_event('woocommerce_tax_rate_locations', array('tax_rate_id' => $tax_rate_id, 'msg_type' => 'delete'));
	}

	function woocommerce_grant_product_download_access_handler($data) {
		$this->add_db_event('woocommerce_downloadable_product_permissions', array('download_id' => $data['download_id'], 'user_id' => $data['user_id'], 'order_id' => $data['order_id'], 'product_id' => $data['product_id']));
	}

	function woocommerce_download_product_handler($user_email, $order_key, $product_id, $user_id, $download_id, $order_id) {
		$this->add_db_event('woocommerce_downloadable_product_permissions', array('order_id' => $order_id, 'user_id' => $user_id, 'order_key' => $order_key, 'product_id' => $product_id));
	}

	function woocommerce_delete_order_items_handler($postid) {
		$meta_ids = array();
		$order_item_ids = array();
		foreach( $this->bvmain->db->getResult("SELECT {$this->bvmain->db->dbprefix}woocommerce_order_itemmeta.meta_id, {$this->bvmain->db->dbprefix}woocommerce_order_items.order_item_id FROM {$this->bvmain->db->dbprefix}woocommerce_order_items JOIN {$this->bvmain->db->dbprefix}woocommerce_order_itemmeta ON {$this->bvmain->db->dbprefix}woocommerce_order_items.order_item_id = {$this->bvmain->db->dbprefix}woocommerce_order_itemmeta.order_item_id WHERE {$this->bvmain->db->dbprefix}woocommerce_order_items.order_id = '{$postid}'") as $key => $row) {
			if (!in_array($row->meta_id, $meta_ids, true)) {
				$meta_ids[] = $row->meta_id;
				$this->add_db_event('woocommerce_order_itemmeta', array('meta_id' => $row->meta_id, 'msg_type' => 'delete'));
			}
			if (!in_array($row->order_item_id, $order_item_ids, true)) {
				$order_item_ids[] = $row->order_item_id;
				$this->add_db_event('woocommerce_order_items', array('order_item_id' => $row->order_item_id, 'msg_type' => 'delete'));
			}
		}
	}

	function woocommerce_payment_token_handler($token_id) {
		$this->add_db_event('woocommerce_payment_tokens', array('token_id' => $token_id));
	}

	function woocommerce_payment_token_deleted_handler($token_id, $object) {
		$this->add_db_event('woocommerce_payment_tokens', array('token_id' => $token_id, 'msg_type' => 'delete'));
		$this->add_db_event('woocommerce_payment_tokenmeta', array('payment_token_id' => $token_id, 'msg_type' => 'delete'));
	}

	function woocommerce_shipping_zone_method_added_handler($instance_id, $method_id, $zone_id) {
		$this->add_db_event('woocommerce_shipping_zone_methods', array('instance_id' => $instance_id));
		$this->add_db_event('woocommerce_shipping_zones', array('zone_id' => $zone_id));
		$this->add_db_event('woocommerce_shipping_zone_locations', array('zone_id' => $zone_id));
	}

	function woocommerce_shipping_zone_method_deleted_handler($instance_id, $method_id, $zone_id) {
		$this->add_db_event('woocommerce_shipping_zone_methods', array('instance_id' => $instance_id, 'msg_type' => 'delete'));
	}

	function woocommerce_shipping_zone_method_status_toggled_handler($instance_id, $method_id, $zone_id, $is_enabled) {
		$this->add_db_event('woocommerce_shipping_zone_methods', array('instance_id' => absint( $instance_id )));
	}

	function woocommerce_deleted_order_downloadable_permissions_handler($post_id) {
		$this->add_db_event('woocommerce_downloadable_product_permissions', array('order_id' => $post_id, 'msg_type' => 'delete'));
	}

	function woocommerce_delete_shipping_zone_handler($zone_id) {
		$this->add_db_event('woocommerce_shipping_zone_methods', array('zone_id' => $zone_id, 'msg_type' => 'delete'));
		$this->add_db_event('woocommerce_shipping_zone_locations', array('zone_id' => $zone_id, 'msg_type' => 'delete'));
		$this->add_db_event('woocommerce_shipping_zones', array('zone_id' => $zone_id, 'msg_type' => 'delete'));
	}

	function woocommerce_webhook_handler($webhook_id) {
		$this->add_db_event('wc_webhooks', array('webhook_id' => $webhook_id));
	}

	function woocommerce_webhook_delete_handler($webhook_id, $webhook) {
		$this->add_db_event('wc_webhooks', array('webhook_id' => $webhook_id, 'msg_type' => 'delete'));
	}

	function woocommerce_delete_shipping_zone_method_handler($instance_id) {
		$this->add_db_event('woocommerce_shipping_zone_methods', array('instance_id' => $instance_id, 'msg_type' => 'delete'));
	}

	function woocommerce_order_term_meta_handler($meta_id, $object_id, $meta_key, $meta_value) {
		if (current_filter() == 'deleted_order_item_meta')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';
		if (!is_array($meta_id)) {
			$this->add_db_event('woocommerce_order_itemmeta', array('meta_id' => $meta_id, 'msg_type' => $msg_type));
		} else {
			foreach ($meta_id as $id) {
				$this->add_db_event('woocommerce_order_itemmeta', array('meta_id' => $id, 'msg_type' => $msg_type));
			}
		}
	}

	function woocommerce_payment_token_meta_handler($meta_id, $object_id, $meta_key, $meta_value) {
		if (current_filter() == 'deleted_payment_token_meta')
			$msg_type = 'delete';
		else
			$msg_type = 'edit';
		if (!is_array($meta_id)) {
			$this->add_db_event('woocommerce_payment_tokenmeta', array('meta_id' => $meta_id, 'msg_type' => $msg_type));
		} else {
			foreach ($meta_id as $id) {
				$this->add_db_event('woocommerce_payment_tokenmeta', array('meta_id' => $id, 'msg_type' => $msg_type));
			}
		}
	}

	function woocommerce_api_product_attribute_handler($id, $data) {
		$this->add_db_event('woocommerce_attribute_taxonomies', array('attribute_id' => $id));
	}


	/* ADDING ACTION AND LISTENERS FOR CAPTURING EVENTS. */
	public function add_actions_and_listeners() {
		/* CAPTURING EVENTS FOR WP_COMMENTS TABLE */
		add_action('delete_comment', array($this, 'comment_action_handler'));
		add_action('wp_set_comment_status', array($this, 'comment_action_handler'));
		add_action('trashed_comment', array($this, 'comment_action_handler'));
		add_action('untrashed_comment', array($this, 'comment_action_handler'));
		add_action('wp_insert_comment', array($this, 'comment_action_handler'));
		add_action('comment_post', array($this, 'comment_action_handler'));
		add_action('edit_comment', array($this, 'comment_action_handler'));

		/* CAPTURING EVENTS FOR WP_COMMENTMETA TABLE */
		add_action('added_comment_meta', array($this, 'commentmeta_insert_handler' ), 10, 2);
		add_action('updated_comment_meta', array($this, 'commentmeta_modification_handler'), 10, 4);
		add_action('deleted_comment_meta', array($this, 'commentmeta_modification_handler'), 10, 4);

		/* CAPTURING EVENTS FOR WP_USERMETA TABLE */
		add_action('added_user_meta', array($this, 'usermeta_insert_handler' ), 10, 2);
		add_action('updated_user_meta', array($this, 'usermeta_modification_handler' ), 10, 4);
		add_action('deleted_user_meta', array($this, 'usermeta_modification_handler' ), 10, 4);
		add_action('added_usermeta',  array( $this, 'usermeta_modification_handler'), 10, 4);
		add_action('update_usermeta', array( $this, 'usermeta_modification_handler'), 10, 4);
		add_action('delete_usermeta', array( $this, 'usermeta_modification_handler'), 10, 4);

		/* CAPTURING EVENTS FOR WP_USERS TABLE */
		add_action('user_register', array($this, 'userid_action_handler'));
		add_action('password_reset', array($this, 'userid_action_handler'));
		add_action('profile_update', array($this, 'userid_action_handler'));
		add_action('deleted_user', array($this, 'userid_action_handler'));

		/* CAPTURING EVENTS FOR WP_POSTS TABLE */
		add_action('delete_post', array($this, 'post_action_handler'));
		add_action('trash_post', array($this, 'post_action_handler'));
		add_action('untrash_post', array($this, 'post_action_handler'));
		add_action('edit_post', array($this, 'post_action_handler'));
		add_action('save_post', array($this, 'post_action_handler'));
		add_action('wp_insert_post', array($this, 'post_action_handler'));
		add_action('edit_attachment', array($this, 'post_action_handler'));
		add_action('add_attachment', array($this, 'post_action_handler'));
		add_action('delete_attachment', array($this, 'post_action_handler'));
		add_action('private_to_published', array($this, 'post_action_handler'));
		add_action('wp_restore_post_revision', array($this, 'post_action_handler'));

		/* CAPTURING EVENTS FOR WP_POSTMETA TABLE */
		// Why events for both delete and deleted
		add_action('added_post_meta', array($this, 'postmeta_insert_handler'), 10, 4);
		add_action('update_post_meta', array($this, 'postmeta_modification_handler'), 10, 4);
		add_action('updated_post_meta', array($this, 'postmeta_modification_handler'), 10, 4);
		add_action('delete_post_meta', array($this, 'postmeta_modification_handler'), 10, 4);
		add_action('deleted_post_meta', array($this, 'postmeta_modification_handler'), 10, 4);
		add_action('added_postmeta', array($this, 'postmeta_action_handler'), 10, 3);
		add_action('update_postmeta', array($this, 'postmeta_action_handler'), 10, 3);
		add_action('delete_postmeta', array($this, 'postmeta_action_handler'), 10, 3);

		/* CAPTURING EVENTS FOR WP_LINKS TABLE */
		add_action('edit_link', array($this, 'link_action_handler'));
		add_action('add_link', array($this, 'link_action_handler'));
		add_action('delete_link', array($this, 'link_action_handler'));

		/* CAPTURING EVENTS FOR WP_TERM AND WP_TERM_TAXONOMY TABLE */
		add_action('created_term', array($this, 'term_handler'), 10, 3);
		add_action('edited_term', array( $this, 'term_handler' ), 10, 3);
		add_action('edited_terms', array($this, 'edited_terms_handler'), 10, 2);
		add_action('delete_term', array($this, 'delete_term_handler'), 10, 4);
		add_action('edit_term_taxonomy', array($this, 'term_taxonomy_handler'), 10, 2);
		add_action('delete_term_taxonomy', array($this, 'term_taxonomy_handler'));
		add_action('edit_term_taxonomies', array($this, 'term_taxonomies_handler'));
		add_action('add_term_relationship', array($this, 'term_relationship_handler'), 10, 2);
		add_action('delete_term_relationships', array($this, 'term_relationships_handler'), 10, 2);
		add_action('set_object_terms', array($this, 'set_object_terms_handler'), 10, 3);

		add_action('switch_theme', array($this, 'theme_action_handler'));
		add_action('activate_plugin', array($this, 'plugin_action_handler'));
		add_action('deactivate_plugin', array($this, 'plugin_action_handler'));

		/* CAPTURING EVENTS FOR WP_OPTIONS */
		add_action('deleted_option', array($this, 'option_handler'));
		add_action('updated_option', array($this, 'option_handler'));
		add_action('added_option', array($this, 'option_handler'));

		/* CAPTURING EVENTS FOR FILES UPLOAD */
		add_action('wp_handle_upload', array($this, 'upload_handler'));

		/* These are applicable only in case of WPMU */
		/* XNOTE: Handle registration_log_handler from within the server */
		add_action('wpmu_new_blog', array($this, 'wpmu_new_blog_create_handler'), 10, 1);
		add_action('refresh_blog_details', array($this, 'wpmu_new_blog_create_handler'), 10, 1);
		add_action('delete_site_option',array($this, 'sitemeta_handler'), 10, 1);
		add_action('add_site_option', array($this, 'sitemeta_handler'), 10, 1);
		add_action('update_site_option', array($this, 'sitemeta_handler'), 10, 1);

		$is_woo_dyn = $this->bvmain->info->getOption('bvWooDynSync');
		if ($is_woo_dyn == 'yes') {
			add_action('woocommerce_resume_order', array($this, 'woocommerce_resume_order_handler'), 10, 1);
			add_action('woocommerce_new_order_item', 	array($this, 'woocommerce_new_order_item_handler'), 10, 3);
			add_action('woocommerce_update_order_item', array($this, 'woocommerce_update_order_item_handler'), 10, 2);
			add_action('woocommerce_delete_order_item', array($this, 'woocommerce_delete_order_item_handler'), 10, 1);
			add_action('woocommerce_delete_order_items', array($this, 'woocommerce_delete_order_items_handler'), 10, 1);
			add_action('added_order_item_meta', array($this, 'woocommerce_order_term_meta_handler' ), 10, 4);
			add_action('updated_order_item_meta', array($this, 'woocommerce_order_term_meta_handler'), 10, 4);
			add_action('deleted_order_item_meta', array($this, 'woocommerce_order_term_meta_handler'), 10, 4);

			add_action('woocommerce_attribute_added', array($this, 'woocommerce_attribute_added_handler' ), 10, 2 );
			add_action('woocommerce_attribute_updated', array($this, 'woocommerce_attribute_updated_handler'), 10, 3 );
			add_action('woocommerce_attribute_deleted', array($this, 'woocommerce_attribute_deleted_handler'), 10, 3 );

			add_action('woocommerce_tax_rate_added', array($this, 'woocommerce_tax_rate_handler'), 10, 2);
			add_action('woocommerce_tax_rate_deleted', array($this, 'woocommerce_tax_rate_deleted_handler'), 10, 1);
			add_action('woocommerce_tax_rate_updated', array($this, 'woocommerce_tax_rate_handler'), 10, 2);

			add_action('woocommerce_new_webhook', array($this, 'woocommerce_webhook_handler'), 10, 1);
			add_action('woocommerce_webhook_updated', array($this, 'woocommerce_webhook_handler'), 10, 1);
			add_action('woocommerce_webhook_deleted', array($this, 'woocommerce_webhook_delete_handler'), 10, 2);

			add_action('woocommerce_download_product', array($this, 'woocommerce_download_product_handler'), 10, 6);
			add_action('woocommerce_grant_product_download_access', array($this, 'woocommerce_grant_product_download_access_handler'), 10, 1);
			add_action('woocommerce_ajax_revoke_access_to_product_download', array($this, 'woocommerce_revoke_access_to_product_download_handler'), 10, 4);
			add_action('woocommerce_deleted_order_downloadable_permissions', array($this, 'woocommerce_deleted_order_downloadable_permissions_handler'), 10, 1);
			add_filter('woocommerce_process_product_file_download_paths_remove_access_to_old_file', array($this, 'woocommerce_downloadable_product_permissions_delete_handler', 10, 4));

			add_action('woocommerce_new_payment_token', array($this, 'woocommerce_payment_token_handler'), 10, 1);
			add_action('woocommerce_payment_token_created', array($this, 'woocommerce_payment_token_handler'), 10, 1);
			add_action('woocommerce_payment_token_updated', array($this, 'woocommerce_payment_token_handler'), 10, 1);
			add_action('woocommerce_payment_token_deleted', array($this, 'woocommerce_payment_token_deleted_handler'), 10, 2);
			add_action('added_payment_token_meta', array($this, 'woocommerce_payment_token_meta_handler' ), 10, 4);
			add_action('updated_payment_token_meta', array($this, 'woocommerce_payment_token_meta_handler'), 10, 4);
			add_action('deleted_payment_token_meta', array($this, 'woocommerce_payment_token_meta_handler'), 10, 4);


			add_action('woocommerce_shipping_zone_method_added', array($this, 'woocommerce_shipping_zone_method_added_handler'), 10, 3);
			add_action('woocommerce_shipping_zone_method_status_toggled', array($this, 'woocommerce_shipping_zone_method_status_toggled_handler'), 10, 4);
			add_action('woocommerce_shipping_zone_method_deleted', array($this, 'woocommerce_shipping_zone_method_deleted_handler'), 10, 3);

			add_action('woocommerce_delete_shipping_zone', array($this, 'woocommerce_delete_shipping_zone_handler'), 10, 1);
			add_action('woocommerce_delete_shipping_zone_method', array($this, 'woocommerce_delete_shipping_zone_method_handler'), 10, 1);

			add_action('woocommerce_api_create_product_attribute', array($this, 'woocommerce_api_product_attribute_handler'), 10, 2);
			add_action('woocommerce_api_edit_product_attribute', array($this, 'woocommerce_api_product_attribute_handler'), 10, 2);
		}
	}
}
endif;