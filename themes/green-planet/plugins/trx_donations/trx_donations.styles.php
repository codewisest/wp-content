<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'green_planet_trx_donations_get_css' ) ) {
	add_filter( 'green_planet_filter_get_css', 'green_planet_trx_donations_get_css', 10, 4 );
	function green_planet_trx_donations_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS



CSS;
		}
		
		return $css;
	}
}
?>