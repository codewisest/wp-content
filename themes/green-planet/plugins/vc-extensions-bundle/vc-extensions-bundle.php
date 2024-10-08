<?php
/* WPBakery Page Builder Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('green_planet_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'green_planet_vc_extensions_theme_setup9', 9 );
	function green_planet_vc_extensions_theme_setup9() {
		if (green_planet_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'green_planet_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'green_planet_filter_merge_styles',						'green_planet_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'green_planet_filter_tgmpa_required_plugins',		'green_planet_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'green_planet_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('green_planet_filter_tgmpa_required_plugins',	'green_planet_vc_extensions_tgmpa_required_plugins');
	function green_planet_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (in_array('vc-extensions-bundle', green_planet_storage_get('required_plugins'))) {
			$path = green_planet_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			$list[] = array(
					'name' 		=> esc_html__('WPBakery Page Builder Extensions Bundle', 'green-planet'),
					'slug' 		=> 'vc-extensions-bundle',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'green_planet_exists_vc_extensions' ) ) {
	function green_planet_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'green_planet_vc_extensions_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'green_planet_vc_extensions_frontend_scripts', 1100 );
	function green_planet_vc_extensions_frontend_scripts() {
		if (green_planet_is_on(green_planet_get_theme_option('debug_mode')) && green_planet_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'vc-extensions-bundle',  green_planet_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'green_planet_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('green_planet_filter_merge_styles', 'green_planet_vc_extensions_merge_styles');
	function green_planet_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>