<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.10
 */

// Footer sidebar
$green_planet_footer_name = green_planet_get_theme_option('footer_widgets');
$green_planet_footer_present = !green_planet_is_off($green_planet_footer_name) && is_active_sidebar($green_planet_footer_name);
if ($green_planet_footer_present) { 
	green_planet_storage_set('current_sidebar', 'footer');
	$green_planet_footer_wide = green_planet_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($green_planet_footer_name) ) {
		dynamic_sidebar($green_planet_footer_name);
	}
	$green_planet_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($green_planet_out)) {
		$green_planet_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $green_planet_out);
		$green_planet_need_columns = true;
		if ($green_planet_need_columns) {
			$green_planet_columns = max(0, (int) green_planet_get_theme_option('footer_columns'));
			if ($green_planet_columns == 0) $green_planet_columns = min(6, max(1, substr_count($green_planet_out, '<aside ')));
			if ($green_planet_columns > 1)
				$green_planet_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($green_planet_columns).' widget ', $green_planet_out);
			else
				$green_planet_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($green_planet_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$green_planet_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($green_planet_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'green_planet_action_before_sidebar' );
				green_planet_show_layout($green_planet_out);
				do_action( 'green_planet_action_after_sidebar' );
				if ($green_planet_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$green_planet_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>