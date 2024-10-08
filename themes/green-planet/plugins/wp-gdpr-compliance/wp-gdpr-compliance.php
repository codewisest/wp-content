<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('green_planet_gdpr_theme_setup9')) {
	add_action( 'after_setup_theme', 'green_planet_gdpr_theme_setup9', 9 );
	function green_planet_gdpr_theme_setup9() {
		if (green_planet_exists_gdpr()) {
			add_filter( 'green_planet_filter_merge_styles',					'green_planet_gdpr_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'green_planet_filter_tgmpa_required_plugins',		'green_planet_gdpr_tgmpa_required_plugins' );
		}
	}
}

if (!function_exists('green_planet_gdpr_theme_setup9')) {
    add_action( 'after_setup_theme', 'green_planet_gdpr_theme_setup9', 9 );
    function green_planet_gdpr_theme_setup9() {
        if (is_admin()) {
            add_filter( 'green_planet_filter_tgmpa_required_plugins',	'green_planet_gdpr_tgmpa_required_plugins' );
        }
    }
}


// Filter to add in the required plugins list
if ( !function_exists( 'green_planet_gdpr_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('green_planet_filter_tgmpa_required_plugins',	'green_planet_gdpr_tgmpa_required_plugins');
	function green_planet_gdpr_tgmpa_required_plugins($list=array()) {
        if (in_array( 'wp-gdpr-compliance', green_planet_storage_get('required_plugins'))) {
			$list[] = array(
                'name' 		=> esc_html__('WP GDPR Compliance', 'green-planet'),
				'slug' 		=> 'wp-gdpr-compliance',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'green_planet_exists_gdpr' ) ) {
	function green_planet_exists_gdpr() {
		return function_exists('__gdpr_load_plugin') || defined('GDPR_VERSION');
	}
}


