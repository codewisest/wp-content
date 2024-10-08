<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_header_css = $green_planet_header_image = '';
$green_planet_header_video = green_planet_get_header_video();
if (true || empty($green_planet_header_video)) {
	$green_planet_header_image = get_header_image();
	if (green_planet_is_on(green_planet_get_theme_option('header_image_override')) && apply_filters('green_planet_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($green_planet_cat_img = green_planet_get_category_image()) != '')
				$green_planet_header_image = $green_planet_cat_img;
		} else if (is_singular() || green_planet_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$green_planet_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($green_planet_header_image)) $green_planet_header_image = $green_planet_header_image[0];
			} else
				$green_planet_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($green_planet_header_image) || !empty($green_planet_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($green_planet_header_video!='') echo ' with_bg_video';
					if ($green_planet_header_image!='') echo ' '.esc_attr(green_planet_add_inline_css_class('background-image: url('.esc_url($green_planet_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (green_planet_is_on(green_planet_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(green_planet_is_inherit(green_planet_get_theme_option('header_scheme')) 
													? green_planet_get_theme_option('color_scheme') 
													: green_planet_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($green_planet_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (green_planet_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>