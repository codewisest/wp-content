<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_args = get_query_var('green_planet_logo_args');

// Site logo
$green_planet_logo_image  = green_planet_get_logo_image(isset($green_planet_args['type']) ? $green_planet_args['type'] : '');
$green_planet_logo_text   = green_planet_is_on(green_planet_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$green_planet_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($green_planet_logo_image) || !empty($green_planet_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url(home_url('/')); ?>"><?php
		if (!empty($green_planet_logo_image)) {
			$green_planet_attr = green_planet_getimagesize($green_planet_logo_image);
			echo '<img src="'.esc_url($green_planet_logo_image).'" alt="'.esc_attr__('Image', 'green-planet').'"'.(!empty($green_planet_attr[3]) ? sprintf(' %s', $green_planet_attr[3]) : '').'>' ;
		} else {
			green_planet_show_layout(green_planet_prepare_macros($green_planet_logo_text), '<span class="logo_text">', '</span>');
			green_planet_show_layout(green_planet_prepare_macros($green_planet_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>