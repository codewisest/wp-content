<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

green_planet_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', green_planet_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', green_planet_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', green_planet_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'green_planet-gallery-script', green_planet_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$green_planet_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$green_planet_sticky_out = is_array($green_planet_stickies) && count($green_planet_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$green_planet_cat = green_planet_get_theme_option('parent_cat');
	$green_planet_post_type = green_planet_get_theme_option('post_type');
	$green_planet_taxonomy = green_planet_get_post_type_taxonomy($green_planet_post_type);
	$green_planet_show_filters = green_planet_get_theme_option('show_filters');
	$green_planet_tabs = array();
	if (!green_planet_is_off($green_planet_show_filters)) {
		$green_planet_args = array(
			'type'			=> $green_planet_post_type,
			'child_of'		=> $green_planet_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $green_planet_taxonomy,
			'pad_counts'	=> false
		);
		$green_planet_portfolio_list = get_terms($green_planet_args);
		if (is_array($green_planet_portfolio_list) && count($green_planet_portfolio_list) > 0) {
			$green_planet_tabs[$green_planet_cat] = esc_html__('All', 'green-planet');
			foreach ($green_planet_portfolio_list as $green_planet_term) {
				if (isset($green_planet_term->term_id)) $green_planet_tabs[$green_planet_term->term_id] = $green_planet_term->name;
			}
		}
	}
	if (count($green_planet_tabs) > 0) {
		$green_planet_portfolio_filters_ajax = true;
		$green_planet_portfolio_filters_active = $green_planet_cat;
		$green_planet_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters green_planet_tabs green_planet_tabs_ajax">
			<ul class="portfolio_titles green_planet_tabs_titles">
				<?php
				foreach ($green_planet_tabs as $green_planet_id=>$green_planet_title) {
					?><li><a href="<?php echo esc_url(green_planet_get_hash_link(sprintf('#%s_%s_content', $green_planet_portfolio_filters_id, $green_planet_id))); ?>" data-tab="<?php echo esc_attr($green_planet_id); ?>"><?php echo esc_html($green_planet_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$green_planet_ppp = green_planet_get_theme_option('posts_per_page');
			if (green_planet_is_inherit($green_planet_ppp)) $green_planet_ppp = '';
			foreach ($green_planet_tabs as $green_planet_id=>$green_planet_title) {
				$green_planet_portfolio_need_content = $green_planet_id==$green_planet_portfolio_filters_active || !$green_planet_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $green_planet_portfolio_filters_id, $green_planet_id)); ?>"
					class="portfolio_content green_planet_tabs_content"
					data-blog-template="<?php echo esc_attr(green_planet_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(green_planet_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($green_planet_ppp); ?>"
					data-post-type="<?php echo esc_attr($green_planet_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($green_planet_taxonomy); ?>"
					data-cat="<?php echo esc_attr($green_planet_id); ?>"
					data-parent-cat="<?php echo esc_attr($green_planet_cat); ?>"
					data-need-content="<?php echo (false===$green_planet_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($green_planet_portfolio_need_content) 
						green_planet_show_portfolio_posts(array(
							'cat' => $green_planet_id,
							'parent_cat' => $green_planet_cat,
							'taxonomy' => $green_planet_taxonomy,
							'post_type' => $green_planet_post_type,
							'page' => 1,
							'sticky' => $green_planet_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		green_planet_show_portfolio_posts(array(
			'cat' => $green_planet_cat,
			'parent_cat' => $green_planet_cat,
			'taxonomy' => $green_planet_taxonomy,
			'post_type' => $green_planet_post_type,
			'page' => 1,
			'sticky' => $green_planet_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>