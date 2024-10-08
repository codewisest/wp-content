<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_post_id    = get_the_ID();
$green_planet_post_date  = green_planet_get_date();
$green_planet_post_title = get_the_title();
$green_planet_post_link  = get_permalink();
$green_planet_post_author_id   = get_the_author_meta('ID');
$green_planet_post_author_name = get_the_author_meta('display_name');
$green_planet_post_author_url  = get_author_posts_url($green_planet_post_author_id, '');

$green_planet_args = get_query_var('green_planet_args_widgets_posts');
$green_planet_show_date = isset($green_planet_args['show_date']) ? (int) $green_planet_args['show_date'] : 1;
$green_planet_show_image = isset($green_planet_args['show_image']) ? (int) $green_planet_args['show_image'] : 1;
$green_planet_show_author = isset($green_planet_args['show_author']) ? (int) $green_planet_args['show_author'] : 1;
$green_planet_show_counters = isset($green_planet_args['show_counters']) ? (int) $green_planet_args['show_counters'] : 1;
$green_planet_show_categories = isset($green_planet_args['show_categories']) ? (int) $green_planet_args['show_categories'] : 1;

$green_planet_output = green_planet_storage_get('green_planet_output_widgets_posts');

$green_planet_post_counters_output = '';
if ( $green_planet_show_counters ) {
	$green_planet_post_counters_output = '<span class="post_info_item post_info_counters">'
								. green_planet_get_post_counters('comments')
							. '</span>';
}


$green_planet_output .= '<article class="post_item with_thumb">';

if ($green_planet_show_image) {
	$green_planet_post_thumb = get_the_post_thumbnail($green_planet_post_id, green_planet_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($green_planet_post_thumb) $green_planet_output .= '<div class="post_thumb">' . ($green_planet_post_link ? '<a href="' . esc_url($green_planet_post_link) . '">' : '') . ($green_planet_post_thumb) . ($green_planet_post_link ? '</a>' : '') . '</div>';
}

$green_planet_output .= '<div class="post_content">'
			. ($green_planet_show_categories 
					? '<div class="post_categories">'
						. green_planet_get_post_categories()
						. $green_planet_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($green_planet_post_link ? '<a href="' . esc_url($green_planet_post_link) . '">' : '') . ($green_planet_post_title) . ($green_planet_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('green_planet_filter_get_post_info', 
								'<div class="post_info">'
									. ($green_planet_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($green_planet_post_link ? '<a href="' . esc_url($green_planet_post_link) . '" class="post_info_date">' : '') 
											. esc_html($green_planet_post_date) 
											. ($green_planet_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($green_planet_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'green-planet') . ' ' 
											. ($green_planet_post_link ? '<a href="' . esc_url($green_planet_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($green_planet_post_author_name) 
											. ($green_planet_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$green_planet_show_categories && $green_planet_post_counters_output
										? $green_planet_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
green_planet_storage_set('green_planet_output_widgets_posts', $green_planet_output);
?>