<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$green_planet_post_format = get_post_format();
$green_planet_post_format = empty($green_planet_post_format) ? 'standard' : str_replace('post-format-', '', $green_planet_post_format);
$green_planet_animation = green_planet_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($green_planet_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($green_planet_post_format) ); ?>
	<?php echo (!green_planet_is_off($green_planet_animation) ? ' data-animation="'.esc_attr(green_planet_get_animation_classes($green_planet_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	green_planet_show_post_featured(array(
		'thumb_size' => green_planet_get_thumb_size($green_planet_columns==1 ? 'big' : ($green_planet_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
            // Post meta
            green_planet_show_post_meta(array(
                'categories' => true,
                'author' => true,
                'date' => true,
                'edit' => false,
                'seo' => false,
                'share' => false,
                'counters' => ''    //comments,likes,views - comma separated in any combination
            ));
			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>