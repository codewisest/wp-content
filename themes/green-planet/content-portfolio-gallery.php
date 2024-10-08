<?php
/**
 * The Gallery template to display posts
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
$green_planet_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($green_planet_columns).' post_format_'.esc_attr($green_planet_post_format) ); ?>
	<?php echo (!green_planet_is_off($green_planet_animation) ? ' data-animation="'.esc_attr(green_planet_get_animation_classes($green_planet_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($green_planet_image[1]) && !empty($green_planet_image[2])) echo intval($green_planet_image[1]) .'x' . intval($green_planet_image[2]); ?>"
	data-src="<?php if (!empty($green_planet_image[0])) echo esc_url($green_planet_image[0]); ?>"
	>

	<?php
	$green_planet_image_hover = 'icon';
	if (in_array($green_planet_image_hover, array('icons', 'zoom'))) $green_planet_image_hover = 'dots';
	// Featured image
	green_planet_show_post_featured(array(
		'hover' => $green_planet_image_hover,
		'thumb_size' => green_planet_get_thumb_size( strpos(green_planet_get_theme_option('body_style'), 'full')!==false || $green_planet_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h3 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h3>'
							. '<div class="post_description">'
								. green_planet_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'green-planet') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>