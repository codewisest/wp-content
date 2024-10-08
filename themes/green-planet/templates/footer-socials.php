<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.10
 */


// Socials
if ( green_planet_is_on(green_planet_get_theme_option('socials_in_footer')) && ($green_planet_output = green_planet_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php green_planet_show_layout($green_planet_output); ?>
		</div>
	</div>
	<?php
}
?>