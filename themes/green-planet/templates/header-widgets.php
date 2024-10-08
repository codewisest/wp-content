<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

// Header sidebar
$green_planet_header_name = green_planet_get_theme_option('header_widgets');
$green_planet_header_present = !green_planet_is_off($green_planet_header_name) && is_active_sidebar($green_planet_header_name);
if ($green_planet_header_present) { 
	green_planet_storage_set('current_sidebar', 'header');
	$green_planet_header_wide = green_planet_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($green_planet_header_name) ) {
		dynamic_sidebar($green_planet_header_name);
	}
	$green_planet_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($green_planet_widgets_output)) {
		$green_planet_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $green_planet_widgets_output);
		$green_planet_need_columns = strpos($green_planet_widgets_output, 'columns_wrap')===false;
		if ($green_planet_need_columns) {
			$green_planet_columns = max(0, (int) green_planet_get_theme_option('header_columns'));
			if ($green_planet_columns == 0) $green_planet_columns = min(6, max(1, substr_count($green_planet_widgets_output, '<aside ')));
			if ($green_planet_columns > 1)
				$green_planet_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($green_planet_columns).' widget ', $green_planet_widgets_output);
			else
				$green_planet_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($green_planet_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$green_planet_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($green_planet_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'green_planet_action_before_sidebar' );
				green_planet_show_layout($green_planet_widgets_output);
				do_action( 'green_planet_action_after_sidebar' );
				if ($green_planet_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$green_planet_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>