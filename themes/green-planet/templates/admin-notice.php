<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage GREEN_PLANET
 * @since GREEN_PLANET 1.0.1
 */
?>
<div class="update-nag" id="green_planet_admin_notice">
	<h3 class="green_planet_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'green-planet'), wp_get_theme()->name); ?></h3>
	<?php
	if (!green_planet_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'green-planet')); ?></p><?php
	}
	?><p><?php
		if (green_planet_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'green-planet'); ?></a>
			<?php
		}
		if (function_exists('green_planet_exists_trx_addons') && green_planet_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'green-planet'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'green-planet'); ?></a>
        <a href="#" class="button green_planet_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'green-planet'); ?></a>
	</p>
</div>