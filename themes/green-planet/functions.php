<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

if (!defined("GREEN_PLANET_THEME_DIR")) define("GREEN_PLANET_THEME_DIR", trailingslashit( get_template_directory() ));
if (!defined("GREEN_PLANET_CHILD_DIR")) define("GREEN_PLANET_CHILD_DIR", trailingslashit( get_stylesheet_directory() ));

// Theme storage
$GREEN_PLANET_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'essential-grid',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'trx_donations',
		'vc-extensions-bundle',
		'woocommerce',
        'wp-gdpr-compliance'
		),

    // Theme-specific URLs (will be escaped in place of the output)
    'theme_pro_key'      => 'env-ancora',
    'theme_demo_url' => 'http://ecoplanet.ancorathemes.com',
    'theme_doc_url' => 'http://ecoplanet.dv.ancorathemes.com/doc',
    'theme_support_url' => 'http://ancorathemes.com/theme-support/',
    'theme_download_url' => 'https://themeforest.net/downloads',
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('green_planet_theme_setup1') ) {
	add_action( 'after_setup_theme', 'green_planet_theme_setup1', 1 );
	function green_planet_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'green-planet', get_template_directory() . '/languages' );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'green_planet_filter_content_width', 1170 );
	}
}

if ( !function_exists('green_planet_theme_setup') ) {
	add_action( 'after_setup_theme', 'green_planet_theme_setup' );
	function green_planet_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				green_planet_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			green_planet_theme_fonts_for_editor()
			)
		);	
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'green-planet'),
			'menu_mobile' => esc_html__('Mobile Menu', 'green-planet'),
			'menu_footer' => esc_html__('Footer Menu', 'green-planet')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'green_planet_excerpt_length' );
		add_filter( 'excerpt_more',							'green_planet_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'green_planet_wp_head', 0);
		
		// Load current page/post customization (if present)
		add_action('wp_footer',		 						'green_planet_wp_footer');
		add_action('admin_footer',	 						'green_planet_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'green_planet_wp_scripts', 1000);			// priority 1000 - load styles
																									// before the plugin's support custom styles
																									// (with priority 1100)
		add_action('wp_footer',		 						'green_planet_localize_scripts');
		add_action('wp_enqueue_scripts', 					'green_planet_wp_scripts_responsive', 2000);	// priority 2000 - load responsive
																									// after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'green_planet_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'green_planet_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'green_planet_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'green_planet_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'green_planet_wp_scripts', 1000);
	function green_planet_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = green_planet_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('green_planet-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello',  green_planet_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'green_planet-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'green_planet-child', $child_stylesheet, array('green_planet-main'), null );
		}

		// Add custom bg image for the body_style == 'boxed'
		if ( green_planet_get_theme_option('body_style') == 'boxed' && ($bg_image = green_planet_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'green_planet-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( green_planet_is_off(green_planet_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'green_planet-styles', green_planet_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && green_planet_is_off(green_planet_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'green_planet-colors', green_planet_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'green_planet-main', green_planet_customizer_get_css() );

		// Add post nav background
		green_planet_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(green_planet_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', green_planet_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', green_planet_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( green_planet_is_off(green_planet_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'green_planet-init', green_planet_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', green_planet_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = green_planet_get_header_video();
			if (!empty($header_video) && !green_planet_is_inherit($header_video)) {
				if (green_planet_is_youtube_url($header_video))
					wp_enqueue_script( 'tubular', green_planet_get_file_url('js/jquery.tubular.js'), array('jquery'), null, true );
				else
					wp_enqueue_script( 'bideo', green_planet_get_file_url('js/bideo.js'), array(), null, true );
			}
			// Theme scripts
			wp_enqueue_script( 'green_planet-utils', green_planet_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'green_planet-init', green_planet_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (green_planet_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'green_planet_localize_scripts' ) ) {
	//Handler of the add_action('wp_footer', 'green_planet_localize_scripts');
	function green_planet_localize_scripts() {

		$video = green_planet_get_header_video();

		wp_localize_script( 'green_planet-init', 'GREEN_PLANET_STORAGE', apply_filters( 'green_planet_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', green_planet_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
			'mobile_device' => wp_is_mobile(),
						
			// Sidemenu options
			'menu_side_stretch' => green_planet_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => green_planet_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => green_planet_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => green_planet_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'comment_maxlength'	=> intval(green_planet_get_theme_setting('comment_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'green-planet'),
					'error_global'		=> esc_html__('Error data validation!', 'green-planet'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'green-planet'),
					'name_long'			=> esc_html__('Too long name', 'green-planet'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'green-planet'),
					'email_long'		=> esc_html__('Too long email address', 'green-planet'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'green-planet'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'green-planet'),
					'text_long'			=> esc_html__('Too long message text', 'green-planet')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'green_planet_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'green_planet_wp_scripts_responsive', 2000);
	function green_planet_wp_scripts_responsive() {
		wp_enqueue_style( 'green_planet-responsive', green_planet_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('green_planet_wp_head')) {
	//Handler of the add_action('wp_head',	'green_planet_wp_head', 1);
	function green_planet_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('green_planet_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'green_planet_add_body_classes' );
	function green_planet_add_body_classes( $classes ) {
		$classes[] = 'body_tag';
		$classes[] = 'scheme_' . esc_attr(green_planet_get_theme_option('color_scheme'));

		$blog_mode = green_planet_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(green_planet_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(green_planet_get_theme_option('blog_style'));
			if (green_planet_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (green_planet_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(green_planet_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (green_planet_is_on(green_planet_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (green_planet_is_on(green_planet_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(green_planet_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(green_planet_get_theme_option("header_position"));

		$menu_style= green_planet_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load current page/post customization (if present)
if ( !function_exists( 'green_planet_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'green_planet_wp_footer');
	//and add_action('admin_footer', 'green_planet_wp_footer');
	function green_planet_wp_footer() {
		if (($css = green_planet_get_inline_css()) != '') {
			wp_enqueue_style(  'green_planet-inline-styles',  green_planet_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'green_planet-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('green_planet_register_sidebars') ) {
	// Handler of the add_action('widgets_init', 'green_planet_register_sidebars');
	function green_planet_register_sidebars() {
		$sidebars = green_planet_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => $sb['name'],
										'description'   => $sb['description'],
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('green_planet_get_sidebars') ) {
	function green_planet_get_sidebars() {
		$list = apply_filters('green_planet_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'green-planet')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'green-planet')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Above Page Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'green-planet')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'green-planet')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'green-planet')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Below Page Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'green-planet')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'green-planet'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'green-planet')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('green_planet_theme_fonts_links') ) {
	function green_planet_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== _x( 'on', 'Google fonts: on or off', 'green-planet' ) );
		$custom_fonts_enabled = ( 'off' !== _x( 'on', 'Custom fonts (included in the theme): on or off', 'green-planet' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !green_planet_storage_empty('load_fonts') ) {
			$load_fonts = green_planet_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = green_planet_get_load_fonts_slug($font['name']);
					$url  = green_planet_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', green_planet_get_protocol(), $google_fonts, green_planet_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('green_planet_theme_fonts_for_editor') ) {
	function green_planet_theme_fonts_for_editor() {
		$links = array_values(green_planet_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('green_planet_excerpt_length') ) {
	function green_planet_excerpt_length( $length ) {
		return max(1, green_planet_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('green_planet_excerpt_more') ) {
	function green_planet_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'green_planet_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'green_planet_importer_set_options', 9 );
	function green_planet_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(green_planet_get_protocol() . '://demofiles.ancorathemes.com/ecoplanet/');
			// Required plugins
			$options['required_plugins'] = green_planet_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Green Planet Demo', 'green-planet');
			$options['files']['default']['domain_dev'] = esc_url(green_planet_get_protocol().'://ecoplanet.dv.ancorathemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(green_planet_get_protocol().'://ecoplanet.ancorathemes.com');		// Demo-site domain
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once GREEN_PLANET_THEME_DIR . 'includes/utils.php';
require_once GREEN_PLANET_THEME_DIR . 'includes/storage.php';
require_once GREEN_PLANET_THEME_DIR . 'includes/lists.php';
require_once GREEN_PLANET_THEME_DIR . 'includes/wp.php';

if (is_admin()) {
	require_once GREEN_PLANET_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once GREEN_PLANET_THEME_DIR . 'includes/admin.php';
}

require_once GREEN_PLANET_THEME_DIR . 'theme-options/theme.customizer.php';

require_once GREEN_PLANET_THEME_DIR . 'theme-specific/theme.tags.php';
require_once GREEN_PLANET_THEME_DIR . 'theme-specific/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($GREEN_PLANET_STORAGE['required_plugins']) && count($GREEN_PLANET_STORAGE['required_plugins']) > 0) {
	foreach ($GREEN_PLANET_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = green_planet_esc($plugin_slug);
		$plugin_path = GREEN_PLANET_THEME_DIR . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>