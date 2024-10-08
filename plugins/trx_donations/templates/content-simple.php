<?php
/**
 * The template for displaying donation's content on the archive page
 *
 * @package ThemeREX Donations
 * @since ThemeREX Donations 1.0
 */

$plugin = TRX_DONATIONS::get_instance();
$column_class = isset($columns) && $columns > 1 
? str_replace( array('$1', '$2'), array('1', $columns), $plugin->get_option('column_class')!='' ? esc_attr($plugin->get_option('column_class')) : 'sc_donations_column-$1_$2' )
: '';

if (!empty($in_shortcode)) {
	?><div id="post-<?php the_ID(); ?>" class="post_item_<?php echo esc_attr($plugin->get_option('blog_style')); ?> post_type_<?php echo esc_attr(get_post_type()).' '.esc_attr($column_class); ?>"><?php
} else {
	?><article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_'.esc_attr($plugin->get_option('blog_style')).' post_type_'.esc_attr(get_post_type()).' '.esc_attr($column_class) ); ?>><?php
}
	// Post thumbnail
if ( has_post_thumbnail() ) {
	?>
	<div class="post_featured">
		<?php the_post_thumbnail( 'thumb_med', array( 'alt' => get_the_title() ) ); ?>
	</div><!-- .post_featured -->
	<?php
}
?>

<div class="post_body">

	<div class="post_header entry-header">
		<?php
		$tag = 'h' . (isset($columns) && $columns > 1 ? 5 : 4);
		the_title( sprintf( '<%s class="entry-title"><a href="%s" rel="bookmark">', esc_attr($tag), esc_url(get_permalink()) ), '</a></'.esc_attr($tag).'>' ); ?>
	</div><!-- .entry-header -->

	<div class="post_content entry-content">
		<?php
		global $post;
		$show_learn_more = true;
		if (!empty($post->post_excerpt)) {
			the_excerpt();
		} else if (strpos($post->post_content, '<!--more')!==false) {
			the_content( esc_html__( 'Learn more', 'trx_donations' ) );
			$show_learn_more = false;
		} else {
			the_excerpt();
		}
			// Goal and raised
		?></div><!-- .entry-content -->
	<?php
	if ( $show_learn_more ) {
		?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Get Involved', 'trx_donations'); ?></a></p><?php
	}

	?>

</div><!-- .post_body -->

<?php
if (empty($in_shortcode)) {
	?></article><?php
} else {
	?></div><?php
}
?>