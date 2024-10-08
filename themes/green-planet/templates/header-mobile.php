<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(green_planet_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('green_planet_logo_args', array('type' => 'inverse'));
		get_template_part( 'templates/header-logo' );
		set_query_var('green_planet_logo_args', array());

		// Mobile menu
		$green_planet_menu_mobile = green_planet_get_nav_menu('menu_mobile');
		if (empty($green_planet_menu_mobile)) {
			$green_planet_menu_mobile = apply_filters('green_planet_filter_get_mobile_menu', '');
			if (empty($green_planet_menu_mobile)) $green_planet_menu_mobile = green_planet_get_nav_menu('menu_main');
			if (empty($green_planet_menu_mobile)) $green_planet_menu_mobile = green_planet_get_nav_menu();
		}
		if (!empty($green_planet_menu_mobile)) {
			if (!empty($green_planet_menu_mobile))
				$green_planet_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$green_planet_menu_mobile
					);
			if (strpos($green_planet_menu_mobile, '<nav ')===false)
				$green_planet_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $green_planet_menu_mobile);
			green_planet_show_layout(apply_filters('green_planet_filter_menu_mobile_layout', $green_planet_menu_mobile));
		}

		// Search field
		do_action('green_planet_action_search', 'normal', 'search_mobile', false);
		
		// Social icons
		green_planet_show_layout(green_planet_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
