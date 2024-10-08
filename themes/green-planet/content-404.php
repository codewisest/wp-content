<article <?php post_class( 'post_item_single post_item_404' ); ?>>
	<div class="post_content">
		<h1 class="page_title"><?php esc_html_e( '404', 'green-planet' ); ?></h1>
		<div class="page_info">
			<h2 class="page_subtitle"><?php esc_html_e('Oops...', 'green-planet'); ?></h2>
			<p class="page_description"><?php echo wp_kses_post(__("We're sorry, but <br>something went wrong.", 'green-planet')); ?></p>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="go_home theme_button"><?php esc_html_e('Homepage', 'green-planet'); ?></a>
		</div>
	</div>
</article>
