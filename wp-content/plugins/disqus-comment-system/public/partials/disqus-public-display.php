<?php
/**
 * Markup which will replace the WordPress comments section on a given page.
 *
 * @link       https://disqus.com
 * @since      3.0
 *
 * @package    Disqus
 * @subpackage Disqus/public/partials
 */

?>

<div id="disqus_thread"></div>
<?php
if ( get_option( 'disqus_render_js' ) ) {
    global $post;
    $embed_vars = Disqus_Public::embed_vars_for_post( $post );
    $js = file_get_contents( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) . 'public/js/comment_embed.js' );
?>
<script>
    var embedVars = <?php echo json_encode( $embed_vars ); ?>;
    <?php echo $js; ?>
</script>
<?php
}
?>
