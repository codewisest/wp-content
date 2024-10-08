<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

// Page (category, tag, archive, author) title

if ( green_planet_need_page_title() ) {
	green_planet_sc_layouts_showed('title', true);
	green_planet_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$green_planet_blog_title = green_planet_get_blog_title();
							$green_planet_blog_title_text = $green_planet_blog_title_class = $green_planet_blog_title_link = $green_planet_blog_title_link_text = '';
							if (is_array($green_planet_blog_title)) {
								$green_planet_blog_title_text = $green_planet_blog_title['text'];
								$green_planet_blog_title_class = !empty($green_planet_blog_title['class']) ? ' '.$green_planet_blog_title['class'] : '';
								$green_planet_blog_title_link = !empty($green_planet_blog_title['link']) ? $green_planet_blog_title['link'] : '';
								$green_planet_blog_title_link_text = !empty($green_planet_blog_title['link_text']) ? $green_planet_blog_title['link_text'] : '';
							} else
								$green_planet_blog_title_text = $green_planet_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($green_planet_blog_title_class); ?>"><?php
								$green_planet_top_icon = green_planet_get_category_icon();
								if (!empty($green_planet_top_icon)) {
									$green_planet_attr = green_planet_getimagesize($green_planet_top_icon);
									?><img src="<?php echo esc_url($green_planet_top_icon); ?>" alt="<?php esc_attr__('Image', 'green-planet')?>" <?php if (!empty($green_planet_attr[3])) green_planet_show_layout($green_planet_attr[3]);?>><?php
								}
								echo wp_kses_data($green_planet_blog_title_text);
							?></h1>
							<?php
							if (!empty($green_planet_blog_title_link) && !empty($green_planet_blog_title_link_text)) {
								?><a href="<?php echo esc_url($green_planet_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($green_planet_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'green_planet_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>