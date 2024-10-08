<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('green_planet_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'green_planet_essential_grid_theme_setup9', 9 );
	function green_planet_essential_grid_theme_setup9() {
		if (green_planet_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'green_planet_essential_grid_frontend_scripts', 1100 );
			add_filter( 'green_planet_filter_merge_styles',					'green_planet_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'green_planet_filter_tgmpa_required_plugins',		'green_planet_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'green_planet_exists_essential_grid' ) ) {
	function green_planet_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'green_planet_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('green_planet_filter_tgmpa_required_plugins',	'green_planet_essential_grid_tgmpa_required_plugins');
	function green_planet_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', green_planet_storage_get('required_plugins'))) {
			$path = green_planet_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'green-planet'),
						'slug' 		=> 'essential-grid',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'green_planet_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'green_planet_essential_grid_frontend_scripts', 1100 );
	function green_planet_essential_grid_frontend_scripts() {
		if (green_planet_is_on(green_planet_get_theme_option('debug_mode')) && green_planet_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'essential-grid',  green_planet_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'green_planet_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('green_planet_filter_merge_styles', 'green_planet_essential_grid_merge_styles');
	function green_planet_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>