<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_link = get_permalink();
$green_planet_post_format = get_post_format();
$green_planet_post_format = empty($green_planet_post_format) ? 'standard' : str_replace('post-format-', '', $green_planet_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($green_planet_post_format) ); ?>><?php
	green_planet_show_post_featured(array(
		'thumb_size' => green_planet_get_thumb_size( 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . green_planet_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($green_planet_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($green_planet_link) . '">' . green_planet_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>