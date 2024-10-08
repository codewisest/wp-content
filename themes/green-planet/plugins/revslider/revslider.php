<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('green_planet_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'green_planet_revslider_theme_setup9', 9 );
	function green_planet_revslider_theme_setup9() {
		if (is_admin()) {
			add_filter( 'green_planet_filter_tgmpa_required_plugins',	'green_planet_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'green_planet_exists_revslider' ) ) {
	function green_planet_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'green_planet_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('green_planet_filter_tgmpa_required_plugins',	'green_planet_revslider_tgmpa_required_plugins');
	function green_planet_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', green_planet_storage_get('required_plugins'))) {
			$path = green_planet_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'green-planet'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
?>