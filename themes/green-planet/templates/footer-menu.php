<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.10
 */

// Footer menu
$green_planet_menu_footer = green_planet_get_nav_menu('menu_footer');
if (!empty($green_planet_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php green_planet_show_layout($green_planet_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>