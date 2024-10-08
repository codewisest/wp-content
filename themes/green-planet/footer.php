<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */

						// Widgets area inside page content
						green_planet_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					green_planet_create_widgets_area('widgets_below_page');

					$green_planet_body_style = green_planet_get_theme_option('body_style');
					if ($green_planet_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$green_planet_footer_style = green_planet_get_theme_option("footer_style");
			if (strpos($green_planet_footer_style, 'footer-custom-')===0) $green_planet_footer_style = 'footer-custom';
			get_template_part( "templates/{$green_planet_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (green_planet_is_on(green_planet_get_theme_option('debug_mode')) && green_planet_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(green_planet_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>