<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('green_planet_mailchimp_get_css')) {
	add_filter('green_planet_filter_get_css', 'green_planet_mailchimp_get_css', 10, 4);
	function green_planet_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: transparent;
	border-color: {$colors['bg_color']};
	color: {$colors['bg_color']};
}
.mc4wp-form input[type="email"]::-webkit-input-placeholder {
  color: {$colors['bg_color']};
}
.mc4wp-form input[type="email"]::-moz-placeholder { 
  color: {$colors['bg_color']};
}
.mc4wp-form input[type="email"]:-ms-input-placeholder {
  color: {$colors['bg_color']};
}
.mc4wp-form input[type="email"]:-moz-placeholder { 
  color: {$colors['bg_color']};
}

.mc4wp-form .mc4wp-form-fields input[type="email"]{
	border-color: {$colors['bg_color']};
}

.mc4wp-form .mc4wp-form-fields input[type="email"]


.mc4wp-form .mc4wp-form-fields input[type="email"]::-webkit-input-placeholder { color: {$colors['bg_color']}; }
.mc4wp-form .mc4wp-form-fields input[type="email"]::placeholder { color: {$colors['bg_color']}; }
.mc4wp-form .mc4wp-form-fields input[type="email"]::-moz-placeholder          { color: {$colors['bg_color']}; }
.mc4wp-form .mc4wp-form-fields input[type="email"]:-ms-input-placeholder      { color: {$colors['bg_color']}; }

.mc4wp-form .mc4wp-form-fields input[type="submit"]{
	background-color: {$colors['bg_color']};
	color: {$colors['text_hover']};
}

.mc4wp-form .mc4wp-form-fields input[type="submit"]:hover{
	background-color: {$colors['text_link']};
	color: {$colors['inverse_text']};
}

CSS;
		}

		return $css;
	}
}
?>