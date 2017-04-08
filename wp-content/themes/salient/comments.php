<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php 
$options = get_nectar_theme_options(); 
$fw_class = (!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? 'full-width-section custom-skip': null; ?>
<div class="comment-wrap <?php echo $fw_class;?>">

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php  if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') echo '<span><i>'. __("Join the discussion").'</i></span>' ?> <?php comments_number(__('No Comments',NECTAR_THEME_NAME), __('One Comment', NECTAR_THEME_NAME), __('% Comments', NECTAR_THEME_NAME) );?></h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ul class="comment-list <?php echo $fw_class; ?>">
		<?php wp_list_comments(array('avatar_size' => 60)); ?>
	</ul>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p>-->

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : 

$required_text = null;
$form_style = (!empty($options['form-style'])) ? $options['form-style'] : 'default'; 
$comment_label = ($form_style == 'minimal') ? '<label for="comment">' . __('My comment is..') . '</label>' : null;
$args = array(
  'id_form'           => 'commentform',
  'id_submit'         => 'submit',
  'title_reply'       => __( 'Leave a Reply', NECTAR_THEME_NAME ),
  'title_reply_to'    => __( 'Leave a Reply to %s', NECTAR_THEME_NAME ),
  'cancel_reply_link' => __( 'Cancel Reply', NECTAR_THEME_NAME ),
  'label_submit'      => __( 'Submit Comment', NECTAR_THEME_NAME ),

  'comment_field' =>  '<div class="row"><div class="col span_12">'.$comment_label.'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>',

  'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.', NECTAR_THEME_NAME ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',

  'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', NECTAR_THEME_NAME ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<div class="row"> <div class="col span_4">' .
      '<label for="author">' . __( 'Name', NECTAR_THEME_NAME ) .
      ' <span class="required">*</span></label> ' .
      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" /></div>',

    'email' =>
      '<div class="col span_4"><label for="email">' . __( 'Email', NECTAR_THEME_NAME ) .
      ' <span class="required">*</span></label>' .
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" /></div>',

    'url' =>
      '<div class="col span_4 col_last"><label for="url">' .
      __( 'Website', NECTAR_THEME_NAME ) . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></div></div>'
    )
  ),
);

comment_form($args);



endif; // if you delete this the sky will fall on your head ?>

</div>