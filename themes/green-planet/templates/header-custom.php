<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.06
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
$green_planet_post_id    = get_the_ID();
$green_planet_header_id = str_replace('header-custom-', '', green_planet_get_theme_option("header_style"));
if ((int) $green_planet_header_id == 0) {
    $green_planet_header_id = $green_planet_get_post_id(array(
            'name' => $green_planet_header_id,
            'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
        )
    );
} else {
    $green_planet_header_id = apply_filters('trx_addons_filter_get_translated_layout', $green_planet_header_id);
}
$green_planet_header_meta = get_post_meta($green_planet_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($green_planet_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($green_planet_header_id)));
						echo !empty($green_planet_header_image) || !empty($green_planet_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($green_planet_header_video!='') 
							echo ' with_bg_video';
						if ($green_planet_header_image!='') 
							echo ' '.esc_attr(green_planet_add_inline_css_class('background-image: url('.esc_url($green_planet_header_image).');'));
						if (!empty($green_planet_header_meta['margin']) != '') 
							echo ' '.esc_attr(green_planet_add_inline_css_class('margin-bottom: '.esc_attr(green_planet_prepare_css_value($green_planet_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (green_planet_is_on(green_planet_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(green_planet_is_inherit(green_planet_get_theme_option('header_scheme')) 
														? green_planet_get_theme_option('color_scheme') 
														: green_planet_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($green_planet_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('green_planet_action_show_layout', $green_planet_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>