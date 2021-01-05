<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


class BuddyFormsSubmissionPage {
	/**
	 * @var BuddyForms_Submissions_List_Table
	 */
	private $bf_submissions_table;
	/*
	 * @var default capability
	 */
	private $bf_submission_capability = 'read';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'buddyforms_create_submissions_page' ) );

		add_filter( 'set-screen-option', array( $this, 'buddyforms_submissions_set_option' ), 10, 3 );
		add_action( 'admin_init', array( $this, 'redirect_after_delete' ) );
	}

	public function buddyforms_create_submissions_page() {
		$buddyforms_submission_admin_page = add_submenu_page( 'edit.php?post_type=buddyforms', __( 'Submissions', 'buddyforms' ), __( 'Submissions', 'buddyforms' ), $this->bf_submission_capability, 'buddyforms_submissions', array( $this, 'buddyforms_submissions_screen' ) );
		add_action( "load-$buddyforms_submission_admin_page", array( $this, 'buddyforms_submissions_add_options' ) );
	}

	public function buddyforms_submissions_add_options() {
		$option = 'per_page';
		$args   = array(
			'label'   => __( 'Entries', 'buddyforms' ),
			'default' => 10,
			'option'  => 'entries_per_page'
		);
		add_screen_option( $option, $args );

		$this->bf_submissions_table = new BuddyForms_Submissions_List_Table;
	}

	public function buddyforms_submissions_screen() {
		global $buddyforms, $current_screen, $parent_file, $form_slug, $post_id;



		// Check that the user is allowed to update options
		if ( ! current_user_can( $this->bf_submission_capability ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'buddyforms' ) );
		}
		?>
        <div id="post" class="bf_admin_wrap wrap">
		<?php
		include( BUDDYFORMS_INCLUDES_PATH . '/admin/admin-header.php' );
		?>
        <hr style="margin-bottom: 0px !important;"/><?php
		$this->bf_submissions_table->prepare_items();


		$user_list = get_users();
		$selected_form = '';
		$selected_author = isset( $_GET['submission_author'] ) ? $_GET['submission_author'] : "all";
		if ( isset( $_GET['form_slug'] ) ) {
			$current_screen->set_parentage( $parent_file );
			$current_screen->render_screen_meta();
			$selected_form = $_GET['form_slug'];
		}
		?>

        <div id="icon-users" class="icon32"><br/></div>
		<table width="100%">
			<tr>
				<td>
					<div id="buddyforms_admin_main_menu" class="">
						<ul>
							<li>
								<h4><?php _e( 'Select a form to display the submissions', 'buddyforms' ) ?></h4>
								<script type="text/javascript">
									jQuery(document).ready(function (jQuery) {
										jQuery('#buddyforms_admin_menu_submissions_form_select').change(function () {
											window.location = '?post_type=buddyforms&page=buddyforms_submissions&form_slug=' + this.value
										});
										jQuery('#search_author_button').click(function () {

											var fslug = jQuery('#buddyforms_admin_menu_submissions_form_select').val();
											var author_dropdown_value = jQuery('#buddyforms_admin_menu_submissions_author_select').val();
											window.location = '?post_type=buddyforms&page=buddyforms_submissions&form_slug=' + fslug+'&submission_author='+author_dropdown_value
										});
										jQuery('.metabox-prefs input:checkbox').each(function () {
											var colID = jQuery(this).attr('id');
											var hasCheckedAtt = document.getElementById(colID).hasAttribute('checked');
											if (!hasCheckedAtt) {
												document.getElementById(colID).checked = false
											}
										})
									})
								</script>
								<select id="buddyforms_admin_menu_submissions_form_select">
									<option value="none"><?php _e( 'Select Form', 'buddyforms' ) ?></option>
									<?php foreach ( $buddyforms as $form_slug => $form ) : ?>
										<?php if ( ! $this->has_the_capability( $form_slug ) ) : ?>
											<?php continue; ?>
										<?php endif; ?>
										<option <?php selected( $selected_form, $form_slug ) ?> value="<?php echo $form_slug ?>"><?php echo $form['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</li>
						</ul>
					</div>
				</td>

				<td align="right">
				<div>
					<ul>
						<li>
							<h4> <?php _e( 'Filter Submissions by Author', 'buddyforms' ) ?> </h4>
							<select id="buddyforms_admin_menu_submissions_author_select">
								<option value="all"><?php _e( 'All Authors', 'buddyforms' ) ?></option>
								<?php foreach ( $user_list as $user_index => $user_value ) : ?>

									<option <?php selected( $selected_author, $user_value->ID ) ?> value="<?php echo $user_value->ID  ?>"><?php echo $user_value->data->display_name; ?></option>
								<?php endforeach; ?>
							</select>
							<input type="button" id="search_author_button" class="button" value="<?php _e( 'Search Author', 'buddyforms' ) ?>">

						</li>
					</ul>

				</div>
				</td>
			</tr>
		</table>


		<?php if ( isset( $_GET['form_slug'] ) ) : ?>
			<?php if ( $this->has_the_capability( $_GET['form_slug'] ) ) : ?>
				<?php if ( ! isset( $_GET['entry'] ) ) { ?>
                    <form id="filter" method="get">
                        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
						<?php $this->bf_submissions_table->display(); ?>
                    </form>
				<?php } ?>

				<?php if ( isset( $_GET['action'] ) && isset( $_GET['entry'] ) ) {
					$form_slug = get_post_meta( $_GET['entry'], '_bf_form_slug', true );
					$post_id   = $_GET['entry'];
					require_once( BUDDYFORMS_INCLUDES_PATH . 'admin/submission-single.php' );
				} ?>
                </div>
			<?php else: ?>
                <strong><?php _e( 'You do not have sufficient permissions to access this page.', 'buddyforms' ) ?></strong>
			<?php endif; ?>
		<?php endif; ?>
		<?php
	}

	/**
	 * Determine if the user have the capability to get the submission for this form.
	 * Note: This return true for user with admin role, checking the `activate_plugins` capability
	 *
	 * @param $form_slug
	 *
	 * @return bool
	 * @since 2.3.1
	 *
	 */
	function has_the_capability( $form_slug ) {
		if ( empty( $form_slug ) ) {
			return false;
		}
		if ( current_user_can( 'activate_plugins' ) ) {
			return true;
		}

		return current_user_can( 'buddyforms_' . $form_slug . '_admin-submission' );
	}

	function redirect_after_delete() {
		global $buddyforms;

		$action    = isset( $_GET['action'] ) ? $_GET['action'] : "";
		$entry     = isset( $_GET['post'] ) ? $_GET['post'] : "";
		$form_slug = isset( $_GET['form_slug'] ) ? $_GET['form_slug'] : "";
		if ( $action === 'delete' && $this->has_the_capability( $form_slug ) ) {
			$buddyFData = isset( $buddyforms[ $form_slug ]['form_fields'] ) ? $buddyforms[ $form_slug ]['form_fields'] : [];
			foreach ( $buddyFData as $key => $value ) {

				$field = $value['slug'];
				$type  = $value['type'];
				if ( $type == 'upload' ) {
					//Check if the option Delete Files When Remove Entry is ON.
					$can_delete_files = isset( $value['delete_files'] ) ? true : false;
					if ( $can_delete_files ) {
						// If true then Delete the files attached to the entry
						$column_val = get_post_meta( $entry, $field, true );
						if ( ! empty( $column_val ) ) {
							$attachmet_id = explode( ",", $column_val );
							foreach ( $attachmet_id as $id ) {
								wp_delete_attachment( $id, true );
							}
						}
					}
				}
			}
		}

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'buddyforms_submissions' && isset( $_GET['entry'] ) ) {
			if ( ! get_post( $_GET['entry'] ) ) {
				wp_redirect( '?post_type=buddyforms&page=buddyforms_submissions&form_slug=' . $_GET['form_slug'] );
			}
		}
	}

	/**
	 * @param $status
	 * @param $option
	 * @param $value
	 *
	 * @return mixed
	 */
	function buddyforms_submissions_set_option( $status, $option, $value ) {
		return $value;
	}
}

function buddyforms_submission_page_init() {
	new BuddyFormsSubmissionPage();
}

add_action( 'init', 'buddyforms_submission_page_init' );

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Class BuddyForms_Submissions_List_Table
 */
class BuddyForms_Submissions_List_Table extends WP_List_Table {
	/**
	 * @var void
	 */
	public $exclude_columns;

	/**
	 * BuddyForms_Submissions_List_Table constructor.
	 */
	function __construct() {

		//Set parent defaults
		parent::__construct( array(
			'singular' => 'Submission',     //singular name of the listed records
			'plural'   => 'Submissions',    //plural name of the listed records
			'ajax'     => false            //does this table support ajax?
		) );

		$this->exclude_columns = buddyforms_get_exclude_field_slugs();
	}

	/**
	 * @param WP_Post $item
	 *
	 * @return string
	 */
	function column_ID( $item ) {
		global $buddyforms;

		$form_slug = isset( $_GET['form_slug'] ) ? $_GET['form_slug'] : "";
		$actions   = array(
			'edit'   => sprintf( '<a href="post.php?post=%s&action=%s">%s</a>', $item->ID, 'edit', __( 'Edit', 'buddyforms' ) ),
			'delete' => '<a href="' . get_delete_post_link( $item->ID, '', true ) . '&form_slug=' . $form_slug . '" class="submitdelete deletion" onclick="return confirm(\'' . __( 'Are you sure you want to delete that entry?', 'buddyforms' ) . '\');" title="' . __( 'Delete', 'buddyforms' ) . '">' . __( 'Delete', 'buddyforms' ) . '</a>',
		);

		if ( isset( $buddyforms[ $_GET['form_slug'] ]['post_type'] ) && $buddyforms[ $_GET['form_slug'] ]['post_type'] == 'bf_submissions' ) {
			$actions['edit'] = sprintf( '<a href="?post_type=buddyforms&page=%s&action=%s&entry=%s&form_slug=%s">%s</a>', $_REQUEST['page'], 'edit', $item->ID, $_GET['form_slug'], __( 'View Submission', 'buddyforms' ) );
		}

		// Return the title contents
		return sprintf( '<span style="color:silver">%1$s</span>%2$s',
			$item->ID,
			$this->row_actions( $actions )
		);
	}

	/**
	 * @param WP_Post $item
	 * @param string $column_name
	 */
	function column_default( $item, $column_name ) {
		$bf_value = get_post_meta( intval( $item->ID ), $column_name, true );
		$bf_field = buddyforms_get_form_field_by_slug( $_GET['form_slug'], $column_name );
		if ( $bf_field !== false ) {
			$this->get_column_values( $column_name, $bf_field['type'], $item, $bf_value, $bf_field );
		}
		if ( $column_name == 'Creation_Date' ) {
			echo get_the_date( 'F j, Y', $item->ID );
		}
		if ( $column_name == 'Author' ) {
			$post = get_post( $item->ID );
			if ( ! empty( $post->post_author ) ) {
				echo apply_filters( 'bf_submission_column_default_author_meta', get_the_author_meta( 'nickname', $post->post_author ), $post->post_author );
			} else {
				_e( 'Anonymous', 'buddyforms' );
			}
		}
	}

	public function get_column_values( $field_slug, $field_type, $item, $bf_value, $bf_field ) {
		$post = get_post( $item->ID );

		$bf_value = buddyforms_get_field_output( $item->ID, $bf_field, $post, $bf_value, $field_slug );

		echo apply_filters( "bf_submission_column_default", $bf_value, $item, $field_type, $field_slug );
	}


	function prepare_items() {
		global $wpdb;

		$per_page = $this->get_items_per_page( 'entries_per_page', 10 );

		$columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = $this->get_column_info();

		$this->get_bulk_actions();

		$data = array();
		$author_filter = isset( $_GET['submission_author'] ) ? is_numeric($_GET['submission_author']) ? $_GET['submission_author'] : false : false;
		if ( isset( $_GET['form_slug'] ) ) {
			$customkey   = '_bf_form_slug'; // set to your custom key
			$customvalue = ! empty( $_GET['form_slug'] ) ? $_GET['form_slug'] : '';
			$sql_args    = array( 'ID', 'post_title', 'post_author' );
			$sql_select  = implode( ', ', $sql_args );
			if($author_filter){
				$sql_query = $wpdb->prepare( "SELECT {$sql_select} FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE ID = {$wpdb->postmeta}.post_id AND meta_key = %s AND meta_value = %s AND post_author = %d ORDER BY post_date DESC", $customkey, $customvalue,$author_filter );
			}
			else{
				$sql_query = $wpdb->prepare( "SELECT {$sql_select} FROM {$wpdb->posts}, {$wpdb->postmeta} WHERE ID = {$wpdb->postmeta}.post_id AND meta_key = %s AND meta_value = %s  ORDER BY post_date DESC", $customkey, $customvalue );
			}
			$data        = $wpdb->get_results( $sql_query );
		}

		$current_page = $this->get_pagenum();
		$total_items  = count( $data );

		$data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );

		$this->items = $data;

		$this->set_pagination_args( array(
			'total_items' => $total_items,                  //WE have to calculate the total number of items
			'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
			'total_pages' => ceil( $total_items / $per_page )   //WE have to calculate the total number of pages
		) );
	}

	/**
	 * @return array
	 */
	function get_columns() {
		global $buddyforms;

		$columns = array(
			'ID'            => 'ID',
			'Author'        => __( 'Author', 'buddyforms' ),
			'Creation_Date' => __( 'Creation Date', 'buddyforms' ),
		);

		if ( isset( $_GET['form_slug'] ) && isset( $buddyforms[ $_GET['form_slug'] ]['form_fields'] ) ) {
			foreach ( $buddyforms[ $_GET['form_slug'] ]['form_fields'] as $key => $field ) {
				if ( ! empty( $field['slug'] ) && ! in_array( $field['slug'], $this->exclude_columns ) ) {
					$columns[ $field['slug'] ] = ! empty( $field['name'] ) ? $field['name'] : $field['slug'];
				}
			}

		}

		return $columns;
	}
}
