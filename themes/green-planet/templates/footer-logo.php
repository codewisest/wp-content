<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.10
 */

// Logo
if (green_planet_is_on(green_planet_get_theme_option('logo_in_footer'))) {
	$green_planet_logo_image = '';
	if (green_planet_get_retina_multiplier(2) > 1)
		$green_planet_logo_image = green_planet_get_theme_option( 'logo_footer_retina' );
	if (empty($green_planet_logo_image)) 
		$green_planet_logo_image = green_planet_get_theme_option( 'logo_footer' );
	$green_planet_logo_text   = get_bloginfo( 'name' );
	if (!empty($green_planet_logo_image) || !empty($green_planet_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($green_planet_logo_image)) {
					$green_planet_attr = green_planet_getimagesize($green_planet_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($green_planet_logo_image).'" class="logo_footer_image" alt="'.esc_attr__('Image', 'green-planet').'"'.(!empty($green_planet_attr[3]) ? sprintf(' %s', $green_planet_attr[3]) : '').'></a>' ;
				} else if (!empty($green_planet_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($green_planet_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>