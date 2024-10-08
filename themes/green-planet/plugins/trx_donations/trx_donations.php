<?php
/* ThemeREX Donations support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('green_planet_trx_donations_theme_setup1')) {
	add_action( 'after_setup_theme', 'green_planet_trx_donations_theme_setup1', 1 );
	function green_planet_trx_donations_theme_setup1() {
		add_filter( 'green_planet_filter_list_posts_types',	'green_planet_trx_donations_list_post_types');
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('green_planet_trx_donations_theme_setup3')) {
	add_action( 'after_setup_theme', 'green_planet_trx_donations_theme_setup3', 3 );
	function green_planet_trx_donations_theme_setup3() {
		if (green_planet_exists_trx_donations()) {
		
			green_planet_storage_merge_array('options', '', array(
				// Section 'Donations' - settings to show pages with Donations posts
				'donations' => array(
					"title" => esc_html__('Donations', 'green-planet'),
					"desc" => wp_kses_data( __('Select parameters to display the donations pages', 'green-planet') ),
					"type" => "section"
					),
				'expand_content_donations' => array(
					"title" => esc_html__('Expand content', 'green-planet'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'green-planet') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_donations' => array(
					"title" => esc_html__('Header style', 'green-planet'),
					"desc" => wp_kses_data( __('Select style to display the site header on the donations pages', 'green-planet') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_donations' => array(
					"title" => esc_html__('Header position', 'green-planet'),
					"desc" => wp_kses_data( __('Select position to display the site header on the donations pages', 'green-planet') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_donations' => array(
					"title" => esc_html__('Header widgets', 'green-planet'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the donations pages', 'green-planet') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_donations' => array(
					"title" => esc_html__('Sidebar widgets', 'green-planet'),
					"desc" => wp_kses_data( __('Select sidebar to show on the donations pages', 'green-planet') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_donations' => array(
					"title" => esc_html__('Sidebar position', 'green-planet'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the donations pages', 'green-planet') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_donations' => array(
					"title" => esc_html__('Hide sidebar on the single donation', 'green-planet'),
					"desc" => wp_kses_data( __("Hide sidebar on the single donation's page", 'green-planet') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_donations' => array(
					"title" => esc_html__('Widgets above the page', 'green-planet'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'green-planet') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_donations' => array(
					"title" => esc_html__('Widgets above the content', 'green-planet'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'green-planet') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_donations' => array(
					"title" => esc_html__('Widgets below the content', 'green-planet'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'green-planet') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_donations' => array(
					"title" => esc_html__('Widgets below the page', 'green-planet'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'green-planet') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_donations' => array(
					"title" => esc_html__('Footer Color Scheme', 'green-planet'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'green-planet') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_donations' => array(
					"title" => esc_html__('Footer widgets', 'green-planet'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'green-planet') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_donations' => array(
					"title" => esc_html__('Footer columns', 'green-planet'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'green-planet') ),
					"dependency" => array(
						'footer_widgets_donations' => array('^hide')
					),
					"std" => 0,
					"options" => green_planet_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_donations' => array(
					"title" => esc_html__('Footer fullwide', 'green-planet'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'green-planet') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('green_planet_trx_donations_theme_setup9')) {
	add_action( 'after_setup_theme', 'green_planet_trx_donations_theme_setup9', 9 );
	function green_planet_trx_donations_theme_setup9() {
		
		if (green_planet_exists_trx_donations()) {
			add_action( 'wp_enqueue_scripts', 								'green_planet_trx_donations_frontend_scripts', 1100 );
			add_filter( 'green_planet_filter_merge_styles',						'green_planet_trx_donations_merge_styles' );
			add_filter( 'green_planet_filter_get_post_info',		 				'green_planet_trx_donations_get_post_info');
			add_filter( 'green_planet_filter_post_type_taxonomy',				'green_planet_trx_donations_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'green_planet_filter_detect_blog_mode',				'green_planet_trx_donations_detect_blog_mode' );
				add_filter( 'green_planet_filter_get_post_categories', 			'green_planet_trx_donations_get_post_categories');
				add_action( 'green_planet_action_before_post_meta',				'green_planet_trx_donations_action_before_post_meta');
			}
		}
		if (is_admin()) {
			add_filter( 'green_planet_filter_tgmpa_required_plugins',			'green_planet_trx_donations_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'green_planet_trx_donations_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('green_planet_filter_tgmpa_required_plugins',	'green_planet_trx_donations_tgmpa_required_plugins');
	function green_planet_trx_donations_tgmpa_required_plugins($list=array()) {
		if (in_array('trx_donations', green_planet_storage_get('required_plugins'))) {
			$path = green_planet_get_file_dir('plugins/trx_donations/trx_donations.zip');
			$list[] = array(
					'name' 		=> esc_html__('ThemeREX Donations', 'green-planet'),
					'slug' 		=> 'trx_donations',
					'version'	=> '1.7.2',
					'source'	=> !empty($path) ? $path : 'upload://trx_donations.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if trx_donations installed and activated
if ( !function_exists( 'green_planet_exists_trx_donations' ) ) {
	function green_planet_exists_trx_donations() {
		return class_exists('TRX_DONATIONS');
	}
}

// Return true, if current page is any trx_donations page
if ( !function_exists( 'green_planet_is_trx_donations_page' ) ) {
	function green_planet_is_trx_donations_page() {
		$rez = false;
		if (green_planet_exists_trx_donations()) {
			$rez = (is_single() && get_query_var('post_type') == TRX_DONATIONS::POST_TYPE) 
					|| is_post_type_archive(TRX_DONATIONS::POST_TYPE) 
					|| is_tax(TRX_DONATIONS::TAXONOMY);
		}
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'green_planet_trx_donations_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'green_planet_filter_detect_blog_mode', 'green_planet_trx_donations_detect_blog_mode' );
	function green_planet_trx_donations_detect_blog_mode($mode='') {
		if (green_planet_is_trx_donations_page())
			$mode = 'donations';
		return $mode;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'green_planet_trx_donations_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'green_planet_filter_post_type_taxonomy',	'green_planet_trx_donations_post_type_taxonomy', 10, 2 );
	function green_planet_trx_donations_post_type_taxonomy($tax='', $post_type='') {
		if (green_planet_exists_trx_donations() && $post_type == TRX_DONATIONS::POST_TYPE)
			$tax = TRX_DONATIONS::TAXONOMY;
		return $tax;
	}
}

// Show categories of the current product
if ( !function_exists( 'green_planet_trx_donations_get_post_categories' ) ) {
	//Handler of the add_filter( 'green_planet_filter_get_post_categories', 		'green_planet_trx_donations_get_post_categories');
	function green_planet_trx_donations_get_post_categories($cats='') {
		if ( green_planet_exists_trx_donations() && get_post_type()==TRX_DONATIONS::POST_TYPE ) {
			$cats = green_planet_get_post_terms(', ', get_the_ID(), TRX_DONATIONS::TAXONOMY);
		}
		return $cats;
	}
}

// Add 'donation' to the list of the supported post-types
if ( !function_exists( 'green_planet_trx_donations_list_post_types' ) ) {
	//Handler of the add_filter( 'green_planet_filter_list_posts_types', 'green_planet_trx_donations_list_post_types');
	function green_planet_trx_donations_list_post_types($list=array()) {
		if (green_planet_exists_trx_donations())
			$list[TRX_DONATIONS::POST_TYPE] = esc_html__('Donations', 'green-planet');
		return $list;
	}
}

// Show price of the current product in the widgets and search results
if ( !function_exists( 'green_planet_trx_donations_get_post_info' ) ) {
	//Handler of the add_filter( 'green_planet_filter_get_post_info', 'green_planet_trx_donations_get_post_info');
	function green_planet_trx_donations_get_post_info($post_info='') {
		if (green_planet_exists_trx_donations()) {
			if (get_post_type()==TRX_DONATIONS::POST_TYPE) {
				// Goal and raised
				$goal = get_post_meta( get_the_ID(), 'trx_donations_goal', true );
				if (!empty($goal)) {
					$raised = get_post_meta( get_the_ID(), 'trx_donations_raised', true );
					if (empty($raised)) $raised = 0;
					$manual = get_post_meta( get_the_ID(), 'trx_donations_manual', true );
					$plugin = TRX_DONATIONS::get_instance();
					$post_info .= '<div class="post_info post_meta post_donation_info">'
										. '<span class="post_info_item post_meta_item post_donation_item post_donation_goal">'
											. '<span class="post_info_label post_meta_label post_donation_label">' . esc_html__('Group goal:', 'green-planet') . '</span>'
											. ' ' 
											. '<span class="post_info_number post_meta_number post_donation_number">' . trim($plugin->get_money($goal)) . '</span>'
										. '</span>'
										. '<span class="post_info_item post_meta_item post_donation_item post_donation_raised">'
											. '<span class="post_info_label post_meta_label post_donation_label">' . esc_html__('Raised:', 'green-planet') . '</span>'
											. ' '
											. '<span class="post_info_number post_meta_number post_donation_number">' . trim($plugin->get_money($raised+$manual)) . ' (' . round(($raised+$manual)*100/$goal, 2) . '%)' . '</span>'
										. '</span>'
									. '</div>';
				}
			}
		}
		return $post_info;
	}
}

// Show price of the current product in the search results streampage
if ( !function_exists( 'green_planet_trx_donations_action_before_post_meta' ) ) {
	//Handler of the add_action( 'green_planet_action_before_post_meta', 'green_planet_trx_donations_action_before_post_meta');
	function green_planet_trx_donations_action_before_post_meta() {
		green_planet_show_layout(green_planet_trx_donations_get_post_info());
	}
}
	
// Enqueue trx_donations custom styles
if ( !function_exists( 'green_planet_trx_donations_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'green_planet_trx_donations_frontend_scripts', 1100 );
	function green_planet_trx_donations_frontend_scripts() {
		if (green_planet_is_on(green_planet_get_theme_option('debug_mode')) && green_planet_get_file_dir('plugins/trx_donations/trx_donations.css')!='')
			wp_enqueue_style( 'trx_donations',  green_planet_get_file_url('plugins/trx_donations/trx_donations.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'green_planet_trx_donations_merge_styles' ) ) {
	//Handler of the add_filter('green_planet_filter_merge_styles', 'green_planet_trx_donations_merge_styles');
	function green_planet_trx_donations_merge_styles($list) {
		$list[] = 'plugins/trx_donations/trx_donations.css';
		return $list;
	}
}


// Return text for the "I agree ..." checkbox
if ( ! function_exists( 'green_planet_trx_donations_privacy_text' ) ) {
    function green_planet_trx_donations_privacy_text( $text='' ) {
        return green_planet_get_privacy_text();
    }
}

// Add plugin-specific colors and fonts to the custom CSS
if (green_planet_exists_trx_donations()) { require_once GREEN_PLANET_THEME_DIR . 'plugins/trx_donations/trx_donations.styles.php'; }
?>