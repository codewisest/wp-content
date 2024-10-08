<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'green_planet_vc_get_css' ) ) {
	add_filter( 'green_planet_filter_get_css', 'green_planet_vc_get_css', 10, 4 );
	function green_planet_vc_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.vc_tta.vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text {
	{$fonts['h5_font-family']}
}
.vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units,
.vc_progress_bar .vc_single_bar .vc_label,
.wpb-js-composer .vc_tta.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a {
	{$fonts['info_font-family']}
}

CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* Row and columns */
.scheme_self.vc_section,
.scheme_self.wpb_row,
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	color: {$colors['text']};
}
.scheme_self.vc_section[data-vc-full-width="true"],
.scheme_self.wpb_row[data-vc-full-width="true"],
.scheme_self.wpb_column > .vc_column-inner > .wpb_wrapper,
.scheme_self.wpb_text_column {
	background-color: {$colors['bg_color']};
}

/* Accordion */
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon {
	color: {$colors['text_hover']};
	background-color: transparent;
}
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:before,
.vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon:after {
	border-color: {$colors['text_hover']};
}
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a {
	color: {$colors['text_dark']};
}

.wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel:not(.vc_active)+.vc_tta-panel{
	border-color: {$colors['bd_color']};
}

.wpb-js-composer .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active,
.wpb-js-composer .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-body{
	background-color: {$colors['alter_bg_color']};
}

.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a{
	color: {$colors['text_dark']};
}

.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel:not(.vc_active) .vc_tta-panel-title > a:hover{
	color: {$colors['text_link']};
}

/* Tabs */
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab > a:hover,
.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active > a {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
}

/* Separator */
.vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['bd_color']};
}

/* Progress bar */
.vc_progress_bar .vc_single_bar {
	background-color: {$colors['alter_bg_color_04']};
}
.vc_progress_bar.vc_progress-bar-color-bar_red .vc_single_bar .vc_bar {
	background-color: {$colors['alter_link']};
}
.vc_progress_bar. .vc_single_bar .vc_label {
	color: {$colors['text_dark']};
}

.vc_color-warning.vc_message_box{
	background-color: #e1a932;
}

.vc_color-info.vc_message_box{
	background-color: #acc83d;
}

.vc_color-success.vc_message_box{
	background-color: #3d96c0;
}


.vc_color-warning.vc_message_box .vc_message_box-icon,
.vc_color-info.vc_message_box .vc_message_box-icon,
.vc_color-success.vc_message_box .vc_message_box-icon{
	color: white;
}

.vc_message_box_closeable:after{
	background-color: rgba(255,255,255,0.2);
	color: white;
}

CSS;
		}
		
		return $css;
	}
}
?>