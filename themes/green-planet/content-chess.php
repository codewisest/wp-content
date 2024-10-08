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
$green_planet_columns = empty($green_planet_blog_style[1]) ? 1 : max(1, $green_planet_blog_style[1]);
$green_planet_expanded = !green_planet_sidebar_present() && green_planet_is_on(green_planet_get_theme_option('expand_content'));
$green_planet_post_format = get_post_format();
$green_planet_post_format = empty($green_planet_post_format) ? 'standard' : str_replace('post-format-', '', $green_planet_post_format);
$green_planet_animation = green_planet_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($green_planet_columns).' post_format_'.esc_attr($green_planet_post_format) ); ?>
	<?php echo (!green_planet_is_off($green_planet_animation) ? ' data-animation="'.esc_attr(green_planet_get_animation_classes($green_planet_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($green_planet_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	green_planet_show_post_featured( array(
											'class' => $green_planet_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => green_planet_get_thumb_size(
																	strpos(green_planet_get_theme_option('body_style'), 'full')!==false
																		? ( $green_planet_columns > 1 ? 'huge' : 'original' )
																		: (	$green_planet_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('green_planet_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			
			do_action('green_planet_action_before_post_meta'); 

			// Post meta
			$green_planet_post_meta = green_planet_show_post_meta(array(
									'categories' => $green_planet_columns == 1,
									'date' => true,
									'edit' => $green_planet_columns == 1,
									'seo' => false,
									'share' => false,
									'counters' => $green_planet_columns < 3 ? 'comments' : '',
									'echo' => false
									)
								);
			green_planet_show_layout($green_planet_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$green_planet_show_learn_more = !in_array($green_planet_post_format, array('link', 'aside', 'status', 'quote'));
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
				green_planet_show_layout($green_planet_post_meta);
			}
			// More button
			if ( $green_planet_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'green-planet'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>