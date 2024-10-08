<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.10
 */

$green_planet_post_id    = get_the_ID();
$green_planet_footer_scheme =  green_planet_is_inherit(green_planet_get_theme_option('footer_scheme')) ? green_planet_get_theme_option('color_scheme') : green_planet_get_theme_option('footer_scheme');
$green_planet_footer_id = str_replace('footer-custom-', '', green_planet_get_theme_option("footer_style"));
if ((int) $green_planet_footer_id == 0) {
    $green_planet_footer_id = $green_planet_get_post_id(array(
            'name' => $green_planet_footer_id,
            'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
        )
    );
} else {
    $green_planet_footer_id = apply_filters('trx_addons_filter_get_translated_layout', $green_planet_footer_id);
}
$green_planet_footer_meta = get_post_meta($green_planet_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($green_planet_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($green_planet_footer_id))); 
						if (!empty($green_planet_footer_meta['margin']) != '') 
							echo ' '.esc_attr(green_planet_add_inline_css_class('margin-top: '.esc_attr(green_planet_prepare_css_value($green_planet_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($green_planet_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('green_planet_action_show_layout', $green_planet_footer_id);
	?>
</footer><!-- /.footer_wrap -->
