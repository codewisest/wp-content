<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

$green_planet_blog_style = explode('_', green_planet_get_theme_option('blog_style'));
$green_planet_columns = empty($green_planet_blog_style[1]) ? 2 : max(2, $green_planet_blog_style[1]);
$green_planet_expanded = !green_planet_sidebar_present() && green_planet_is_on(green_planet_get_theme_option('expand_content'));
$green_planet_post_format = get_post_format();
$green_planet_post_format = empty($green_planet_post_format) ? 'standard' : str_replace('post-format-', '', $green_planet_post_format);
$green_planet_animation = green_planet_get_theme_option('blog_animation');

?><div class="<?php echo 'classic' == $green_planet_blog_style[0] ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($green_planet_columns); ?>"><article id="post-<?php the_ID(); ?>"
            <?php post_class( 'post_item post_format_'.esc_attr($green_planet_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($green_planet_columns)
					. ' post_layout_'.esc_attr($green_planet_blog_style[0]) 
					. ' post_layout_'.esc_attr($green_planet_blog_style[0]).'_'.esc_attr($green_planet_columns)
					); ?>
	<?php echo (!green_planet_is_off($green_planet_animation) ? ' data-animation="'.esc_attr(green_planet_get_animation_classes($green_planet_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	green_planet_show_post_featured( array( 'thumb_size' => green_planet_get_thumb_size($green_planet_blog_style[0] == 'classic'
													? (strpos(green_planet_get_theme_option('body_style'), 'full')!==false 
															? ( $green_planet_columns > 2 ? 'big' : 'huge' )
															: (	$green_planet_columns > 2
																? ($green_planet_expanded ? 'med' : 'small')
																: ($green_planet_expanded ? 'big' : 'med')
																)
														)
													: (strpos(green_planet_get_theme_option('body_style'), 'full')!==false 
															? ( $green_planet_columns > 2 ? 'masonry-big' : 'full' )
															: (	$green_planet_columns <= 2 && $green_planet_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('green_planet_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('green_planet_action_before_post_meta'); 

			// Post meta
			green_planet_show_post_meta(array(
				'categories' => false,
				'date' => true,
				'edit' => $green_planet_columns < 3,
				'seo' => false,
				'share' => false,
				'counters' => 'comments',
				)
			);
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$green_planet_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote'))) {
			green_planet_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $green_planet_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'green-planet'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>