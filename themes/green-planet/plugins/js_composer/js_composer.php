<?php
/* WPBakery Page Builder support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('green_planet_vc_theme_setup9')) {
	add_action( 'after_setup_theme', 'green_planet_vc_theme_setup9', 9 );
	function green_planet_vc_theme_setup9() {
		if (green_planet_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'green_planet_vc_frontend_scripts', 1100 );
			add_filter( 'green_planet_filter_merge_styles',						'green_planet_vc_merge_styles' );
	
			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,					'green_planet_vc_add_params_classes', 10, 3 );
			
			// Color scheme
			$scheme = array(
				"param_name" => "scheme",
				"heading" => esc_html__("Color scheme", 'green-planet'),
				"description" => wp_kses_data( __("Select color scheme to decorate this block", 'green-planet') ),
				"group" => esc_html__('Colors', 'green-planet'),
				"admin_label" => true,
				"value" => array_flip(green_planet_get_list_schemes(true)),
				"type" => "dropdown"
			);
			vc_add_param("vc_section", $scheme);
			vc_add_param("vc_row", $scheme);
			vc_add_param("vc_row_inner", $scheme);
			vc_add_param("vc_column", $scheme);
			vc_add_param("vc_column_inner", $scheme);
			vc_add_param("vc_column_text", $scheme);
			
			// Alter height and hide on mobile for Empty Space
			vc_add_param("vc_empty_space", array(
				"param_name" => "alter_height",
				"heading" => esc_html__("Alter height", 'green-planet'),
				"description" => wp_kses_data( __("Select alternative height instead value from the field above", 'green-planet') ),
				"admin_label" => true,
				"value" => array(
					esc_html__('Tiny', 'green-planet') => 'tiny',
					esc_html__('Small', 'green-planet') => 'small',
					esc_html__('Medium', 'green-planet') => 'medium',
					esc_html__('Large', 'green-planet') => 'large',
					esc_html__('Huge', 'green-planet') => 'huge',
					esc_html__('From the value above', 'green-planet') => 'none'
				),
				"type" => "dropdown"
			));
			vc_add_param("vc_empty_space", array(
				"param_name" => "hide_on_mobile",
				"heading" => esc_html__("Hide on mobile", 'green-planet'),
				"description" => wp_kses_data( __("Hide this block on the mobile devices, when the columns are arranged one under another", 'green-planet') ),
				"admin_label" => true,
				"std" => 0,
				"value" => array(
					esc_html__("Hide on mobile", 'green-planet') => "1",
					esc_html__("Hide on notebook", 'green-planet') => "2" 
					),
				"type" => "checkbox"
			));
			
			// Add Narrow style to the Progress bars
			vc_add_param("vc_progress_bar", array(
				"param_name" => "narrow",
				"heading" => esc_html__("Narrow", 'green-planet'),
				"description" => wp_kses_data( __("Use narrow style for the progress bar", 'green-planet') ),
				"std" => 0,
				"value" => array(esc_html__("Narrow style", 'green-planet') => "1" ),
				"type" => "checkbox"
			));
			
			// Add param 'Closeable' to the Message Box
			vc_add_param("vc_message", array(
				"param_name" => "closeable",
				"heading" => esc_html__("Closeable", 'green-planet'),
				"description" => wp_kses_data( __("Add 'Close' button to the message box", 'green-planet') ),
				"std" => 0,
				"value" => array(esc_html__("Closeable", 'green-planet') => "1" ),
				"type" => "checkbox"
			));
		}
		if (is_admin()) {
			add_filter( 'green_planet_filter_tgmpa_required_plugins',		'green_planet_vc_tgmpa_required_plugins' );
			add_filter( 'vc_iconpicker-type-fontawesome',				'green_planet_vc_iconpicker_type_fontawesome' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'green_planet_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('green_planet_filter_tgmpa_required_plugins',	'green_planet_vc_tgmpa_required_plugins');
	function green_planet_vc_tgmpa_required_plugins($list=array()) {
		if (in_array('js_composer', green_planet_storage_get('required_plugins'))) {
			$path = green_planet_get_file_dir('plugins/js_composer/js_composer.zip');
			$list[] = array(
					'name' 		=> esc_html__('WPBakery Page Builder', 'green-planet'),
					'slug' 		=> 'js_composer',
					'source'	=> !empty($path) ? $path : 'upload://js_composer.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if WPBakery Page Builder installed and activated
if ( !function_exists( 'green_planet_exists_visual_composer' ) ) {
	function green_planet_exists_visual_composer() {
		return class_exists('Vc_Manager');
	}
}

// Check if WPBakery Page Builder in frontend editor mode
if ( !function_exists( 'green_planet_vc_is_frontend' ) ) {
	function green_planet_vc_is_frontend() {
		return (isset($_GET['vc_editable']) && $_GET['vc_editable']=='true')
			|| (isset($_GET['vc_action']) && $_GET['vc_action']=='vc_inline');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'green_planet_vc_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'green_planet_vc_frontend_scripts', 1100 );
	function green_planet_vc_frontend_scripts() {
		if (green_planet_exists_visual_composer()) {
			if (green_planet_is_on(green_planet_get_theme_option('debug_mode')) && green_planet_get_file_dir('plugins/js_composer/js_composer.css')!='')
				wp_enqueue_style( 'js_composer',  green_planet_get_file_url('plugins/js_composer/js_composer.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'green_planet_vc_merge_styles' ) ) {
	//Handler of the add_filter('green_planet_filter_merge_styles', 'green_planet_vc_merge_styles');
	function green_planet_vc_merge_styles($list) {
		$list[] = 'plugins/js_composer/js_composer.css';
		return $list;
	}
}
	
// Add theme icons into VC iconpicker list
if ( !function_exists( 'green_planet_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'green_planet_vc_iconpicker_type_fontawesome' );
	function green_planet_vc_iconpicker_type_fontawesome($icons) {
		$list = green_planet_get_list_icons();
		if (!is_array($list) || count($list) == 0) return $icons;
		$rez = array();
		foreach ($list as $icon)
			$rez[] = array($icon => str_replace('icon-', '', $icon));
		return array_merge( $icons, array(esc_html__('Theme Icons', 'green-planet') => $rez) );
	}
}



// Shortcodes
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( !function_exists( 'green_planet_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'green_planet_vc_add_params_classes', 10, 3 );
	function green_planet_vc_add_params_classes($classes, $sc, $atts) {
		if (in_array($sc, array('vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text'))) {
			if (!empty($atts['scheme']) && !green_planet_is_inherit($atts['scheme']))
				$classes .= ($classes ? ' ' : '') . 'scheme_' . $atts['scheme'];
		} else if (in_array($sc, array('vc_empty_space'))) {
			if (!empty($atts['alter_height']) && !green_planet_is_off($atts['alter_height']))
				$classes .= ($classes ? ' ' : '') . 'height_' . $atts['alter_height'];
			if (!empty($atts['hide_on_mobile'])) {
				if (strpos($atts['hide_on_mobile'], '1')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_mobile';
				if (strpos($atts['hide_on_mobile'], '2')!==false)	$classes .= ($classes ? ' ' : '') . 'hide_on_notebook';
			}
		} else if (in_array($sc, array('vc_progress_bar'))) {
			if (!empty($atts['narrow']) && (int) $atts['narrow']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_progress_bar_narrow';
		} else if (in_array($sc, array('vc_message'))) {
			if (!empty($atts['closeable']) && (int) $atts['closeable']==1)
				$classes .= ($classes ? ' ' : '') . 'vc_message_box_closeable';
		}
		return $classes;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (green_planet_exists_visual_composer()) { require_once GREEN_PLANET_THEME_DIR . 'plugins/js_composer/js_composer.styles.php'; }
?>