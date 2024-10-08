<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$green_planet_mult = green_planet_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120*$green_planet_mult ); 
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('About %s', 'green-planet'), '<span class="fn">'.get_the_author().'</span>')); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses_post(wpautop(get_the_author_meta( 'description' ))); ?>
			<?php do_action('green_planet_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
