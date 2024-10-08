<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$green_planet_content = '';
$green_planet_blog_archive_mask = '%%CONTENT%%';
$green_planet_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $green_planet_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($green_planet_content = apply_filters('the_content', get_the_content())) != '') {
		if (($green_planet_pos = strpos($green_planet_content, $green_planet_blog_archive_mask)) !== false) {
			$green_planet_content = preg_replace('/(\<p\>\s*)?'.$green_planet_blog_archive_mask.'(\s*\<\/p\>)/i', $green_planet_blog_archive_subst, $green_planet_content);
		} else
			$green_planet_content .= $green_planet_blog_archive_subst;
		$green_planet_content = explode($green_planet_blog_archive_mask, $green_planet_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) green_planet_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$green_planet_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$green_planet_args = green_planet_query_add_posts_and_cats($green_planet_args, '', green_planet_get_theme_option('post_type'), green_planet_get_theme_option('parent_cat'));
$green_planet_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($green_planet_page_number > 1) {
	$green_planet_args['paged'] = $green_planet_page_number;
	$green_planet_args['ignore_sticky_posts'] = true;
}
$green_planet_ppp = green_planet_get_theme_option('posts_per_page');
if ((int) $green_planet_ppp != 0)
	$green_planet_args['posts_per_page'] = (int) $green_planet_ppp;
// Make a new query
query_posts( $green_planet_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($green_planet_content) && count($green_planet_content) == 2) {
	set_query_var('blog_archive_start', $green_planet_content[0]);
	set_query_var('blog_archive_end', $green_planet_content[1]);
}

get_template_part('index');
?>