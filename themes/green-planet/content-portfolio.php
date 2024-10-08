<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_blog_style = explode('_', green_planet_get_theme_option('blog_style'));
$green_planet_columns = empty($green_planet_blog_style[1]) ? 2 : max(2, $green_planet_blog_style[1]);
$green_planet_post_format = get_post_format();
$green_planet_post_format = empty($green_planet_post_format) ? 'standard' : str_replace('post-format-', '', $green_planet_post_format);
$green_planet_animation = green_planet_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($green_planet_columns).' post_format_'.esc_attr($green_planet_post_format) ); ?>
	<?php echo (!green_planet_is_off($green_planet_animation) ? ' data-animation="'.esc_attr(green_planet_get_animation_classes($green_planet_animation)).'"' : ''); ?>
	>

	<?php
	$green_planet_image_hover = green_planet_get_theme_option('image_hover');
	// Featured image
	green_planet_show_post_featured(array(
		'thumb_size' => green_planet_get_thumb_size(strpos(green_planet_get_theme_option('body_style'), 'full')!==false || $green_planet_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $green_planet_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $green_planet_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>