<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_sidebar_position = green_planet_get_theme_option('sidebar_position');
if (green_planet_sidebar_present()) {
	ob_start();
	$green_planet_sidebar_name = green_planet_get_theme_option('sidebar_widgets');
	green_planet_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($green_planet_sidebar_name) ) {
		dynamic_sidebar($green_planet_sidebar_name);
	}
	$green_planet_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($green_planet_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($green_planet_sidebar_position); ?> widget_area<?php if (!green_planet_is_inherit(green_planet_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(green_planet_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'green_planet_action_before_sidebar' );
				green_planet_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $green_planet_out));
				do_action( 'green_planet_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>