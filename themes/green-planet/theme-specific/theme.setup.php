<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('green_planet_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'green_planet_customizer_theme_setup1', 1 );
	function green_planet_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		green_planet_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Playfair Display',
				'family' => 'serif',
				'styles' => 'Playfair+Display:400,700,700i'
				),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif',
				'styles' => 'Montserrat:400,500,700'
				),
			array(
				'name'   => 'Droid Serif',
				'family' => 'serif',
				'styles' => 'Droid+Serif:400,700'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		green_planet_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		green_planet_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'green-planet'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'green-planet'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.6em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.4em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'green-planet'),
				'font-family'		=> 'Playfair Display, serif',
				'font-size' 		=> '5rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.06',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '',
				'margin-top'		=> '0.74em',
				'margin-bottom'		=> '0.74em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'green-planet'),
				'font-family'		=> 'Playfair Display, serif',
				'font-size' 		=> '4.375rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.07em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '',
				'margin-top'		=> '0.88em',
				'margin-bottom'		=> '0.88em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'green-planet'),
				'font-family'		=> 'Playfair Display , serif',
				'font-size' 		=> '3.438rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.09',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '',
				'margin-top'		=> '1.15em',
				'margin-bottom'		=> '1.15em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'green-planet'),
				'font-family'		=> 'Playfair Display , serif',
				'font-size' 		=> '2.188rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.29',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.1em',
				'margin-bottom'		=> '1.1em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'green-planet'),
				'font-family'		=> 'Playfair Display , serif',
				'font-size' 		=> '1.563rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.4',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1em',
				'margin-bottom'		=> '1em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'green-planet'),
				'font-family'		=> 'Playfair Display , serif',
				'font-size' 		=> '1.125rem',
				'font-weight'		=> '700',
				'font-style'		=> 'italic',
				'line-height'		=> '1.39',
				'text-decoration'	=> '',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '0.9em',
				'margin-bottom'		=> '0.9em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'green-planet'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'green-planet'),
				'font-family'		=> 'Playfair Display, sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'initial',
				'letter-spacing'	=> ''
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'green-planet'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '0.875rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> ''
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'green-planet'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'green-planet'),
				'font-family'		=> 'Droid Serif, serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'green-planet'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'green-planet'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '0.875rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'green-planet'),
				'description'		=> esc_html__('Font settings of the main menu items', 'green-planet'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '0.875rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.1px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'green-planet'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'green-planet'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '0.875rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		green_planet_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'green-planet'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',
					'bd_color'				=> '#e6e6e6',
		
					// Text and links colors
					'text'					=> '#9b9b93',
					'text_light'			=> '#9b9a93',
					'text_dark'				=> '#424242',
					'text_link'				=> '#6bb041',
					'text_hover'			=> '#a1c643',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#f1f0ed',
					'alter_bg_hover'		=> '#e6e8eb',
					'alter_bd_color'		=> '#e5e5e5',
					'alter_bd_hover'		=> '#dadada',
					'alter_text'			=> '#333333',
					'alter_light'			=> '#b7b7b7',
					'alter_dark'			=> '#1d1d1d',
					'alter_link'			=> '#e1a932',
					'alter_hover'			=> '#a1c643',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#f1f0ed',	//'rgba(221,225,229,0.3)',
					'input_bg_hover'		=> '#e7eaed',	//'rgba(221,225,229,0.3)',
					'input_bd_color'		=> '#f1f0ed',	//'rgba(221,225,229,0.3)',
					'input_bd_hover'		=> '#a1c643',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#e5e5e5',
					'input_dark'			=> '#1d1d1d',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',

				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'green-planet'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#0e0d12',
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#b7b7b7',
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#6bb041',
					'text_hover'			=> '#a1c643',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#1e1d22',
					'alter_bg_hover'		=> '#28272e',
					'alter_bd_color'		=> '#313131',
					'alter_bd_hover'		=> '#3d3d3d',
					'alter_text'			=> '#a6a6a6',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#e1a932',
					'alter_hover'			=> '#a1c643',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bg_hover'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bd_color'		=> '#2e2d32',	//'rgba(62,61,66,0.5)',
					'input_bd_hover'		=> '#a1c643',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#ffffff',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',

		
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('green_planet_customizer_add_theme_colors')) {
	function green_planet_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = green_planet_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = green_planet_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = green_planet_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = green_planet_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = green_planet_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = green_planet_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_08']  = green_planet_hex2rgba( $colors['alter_bg_color'], 0.8 );
			$colors['alter_bg_color_06']  = green_planet_hex2rgba( $colors['alter_bg_color'], 0.6 );
			$colors['alter_bg_color_04']  = green_planet_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = green_planet_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = green_planet_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['text_dark_07']  = green_planet_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_dark_09']  = green_planet_hex2rgba( $colors['text_dark'], 0.9 );
			$colors['text_hover_00']  = green_planet_hex2rgba( $colors['text_hover'], 0 );
			$colors['text_link_02']  = green_planet_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = green_planet_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = green_planet_hsb2hex(green_planet_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = green_planet_hsb2hex(green_planet_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_08'] = '{{ data.alter_bg_color_08 }}';
			$colors['alter_bg_color_06'] = '{{ data.alter_bg_color_06 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_dark_09'] = '{{ data.text_dark_09 }}';
			$colors['text_hover_00'] = '{{ data.text_hover_00 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('green_planet_customizer_add_theme_fonts')) {
	function green_planet_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !green_planet_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !green_planet_is_inherit($font['font-size'])
														? 'font-size:' . green_planet_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !green_planet_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !green_planet_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !green_planet_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !green_planet_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !green_planet_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !green_planet_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !green_planet_is_inherit($font['margin-top'])
														? 'margin-top:' . green_planet_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !green_planet_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . green_planet_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('green_planet_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'green_planet_customizer_theme_setup' );
	function green_planet_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('green_planet_filter_add_thumb_sizes', array(
			'green_planet-thumb-huge'		=> array(1170, 658, true),
			'green_planet-thumb-big' 		=> array( 760, 428, true),
			'green_planet-thumb-med' 		=> array( 370, 208, true),
			'green_planet-thumb-bigsquare' 		=> array( 660, 565, true),
			'green_planet-thumb-teamsize' 		=> array( 405, 525, true),
			'green_planet-thumb-donsize' 		=> array( 702, 580, true),
			'green_planet-thumb-tiny' 		=> array(  120,  120, true),
			'green_planet-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'green_planet-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = green_planet_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'green_planet_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('green_planet_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'green_planet_customizer_image_sizes' );
	function green_planet_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('green_planet_filter_add_thumb_sizes', array(
			'green_planet-thumb-huge'		=> esc_html__( 'Fullsize image', 'green-planet' ),
			'green_planet-thumb-big'			=> esc_html__( 'Large image', 'green-planet' ),
			'green_planet-thumb-med'			=> esc_html__( 'Medium image', 'green-planet' ),
			'green_planet-thumb-bigsquare'			=> esc_html__( 'Big square image', 'green-planet' ),
			'green_planet-thumb-teamsize'			=> esc_html__( 'Team Featured image', 'green-planet' ),
			'green_planet-thumb-donsize'			=> esc_html__( 'Donation row image', 'green-planet' ),
			'green_planet-thumb-tiny'		=> esc_html__( 'Small square avatar', 'green-planet' ),
			'green_planet-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'green-planet' ),
			'green_planet-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'green-planet' ),
			)
		);
		$mult = green_planet_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'green-planet' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'green_planet_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'green_planet_customizer_trx_addons_add_thumb_sizes');
	function green_planet_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-bigsquare',
								'trx_addons-thumb-teamsize',
								'trx_addons-thumb-donsize',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'green_planet_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'green_planet_customizer_trx_addons_get_thumb_size');
	function green_planet_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-bigsquare',
							'trx_addons-thumb-bigsquare-@retina',
							'trx_addons-thumb-teamsize',
							'trx_addons-thumb-teamsize-@retina',
							'trx_addons-thumb-donsize',
							'trx_addons-thumb-donsize-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'green_planet-thumb-huge',
							'green_planet-thumb-huge-@retina',
							'green_planet-thumb-big',
							'green_planet-thumb-big-@retina',
							'green_planet-thumb-med',
							'green_planet-thumb-med-@retina',
							'green_planet-thumb-bigsquare',
							'green_planet-thumb-bigsquare-@retina',
							'green_planet-thumb-teamsize',
							'green_planet-thumb-teamsize-@retina',
							'green_planet-thumb-donsize',
							'green_planet-thumb-donsize-@retina',							
							'green_planet-thumb-tiny',
							'green_planet-thumb-tiny-@retina',
							'green_planet-thumb-masonry-big',
							'green_planet-thumb-masonry-big-@retina',
							'green_planet-thumb-masonry',
							'green_planet-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>