<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

green_planet_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(green_planet_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'classie', green_planet_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'imagesloaded', green_planet_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
	wp_enqueue_script( 'masonry', green_planet_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
	wp_enqueue_script( 'green_planet-gallery-script', green_planet_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$green_planet_classes = 'posts_container '
						. (substr(green_planet_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap' : 'masonry_wrap');
	$green_planet_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$green_planet_sticky_out = is_array($green_planet_stickies) && count($green_planet_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($green_planet_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$green_planet_sticky_out) {
		if (green_planet_get_theme_option('first_post_large') && !is_paged() && !in_array(green_planet_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($green_planet_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($green_planet_sticky_out && !is_sticky()) {
			$green_planet_sticky_out = false;
			?></div><div class="<?php echo esc_attr($green_planet_classes); ?>"><?php
		}
		get_template_part( 'content', $green_planet_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	green_planet_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>