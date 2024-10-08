<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

green_planet_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$green_planet_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$green_planet_sticky_out = is_array($green_planet_stickies) && count($green_planet_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($green_planet_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($green_planet_sticky_out && !is_sticky()) {
			$green_planet_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $green_planet_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($green_planet_sticky_out) {
		$green_planet_sticky_out = false;
		?></div><?php
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