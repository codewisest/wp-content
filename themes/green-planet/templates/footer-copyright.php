<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.10
 */

// Copyright area
$green_planet_footer_scheme =  green_planet_is_inherit(green_planet_get_theme_option('footer_scheme')) ? green_planet_get_theme_option('color_scheme') : green_planet_get_theme_option('footer_scheme');
$green_planet_copyright_scheme = green_planet_is_inherit(green_planet_get_theme_option('copyright_scheme')) ? $green_planet_footer_scheme : green_planet_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($green_planet_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$green_planet_copyright = green_planet_prepare_macros(green_planet_get_theme_option('copyright'));
				if (!empty($green_planet_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $green_planet_copyright, $green_planet_matches)) {
						$green_planet_copyright = str_replace($green_planet_matches[1], date(str_replace(array('{', '}'), '', $green_planet_matches[1])), $green_planet_copyright);
					}
					// Display copyright
					echo green_planet_show_layout($green_planet_copyright);
				}
			?></div>
		</div>
	</div>
</div>
