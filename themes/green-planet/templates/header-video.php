<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.14
 */
$green_planet_header_video = green_planet_get_header_video();
$green_planet_embed_video = '';
if (!empty($green_planet_header_video) && !green_planet_is_from_uploads($green_planet_header_video)) {
	if (green_planet_is_youtube_url($green_planet_header_video) && preg_match('/[=\/]([^=\/]*)$/', $green_planet_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$green_planet_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($green_planet_header_video) . '[/embed]' ));
			$green_planet_embed_video = green_planet_make_video_autoplay($green_planet_embed_video);
		} else {
			$green_planet_header_video = str_replace('/watch?v=', '/embed/', $green_planet_header_video);
			$green_planet_header_video = green_planet_add_to_url($green_planet_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$green_planet_embed_video = '<iframe src="' . esc_url($green_planet_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php green_planet_show_layout($green_planet_embed_video); ?></div><?php
	}
}
?>