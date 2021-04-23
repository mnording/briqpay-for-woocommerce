<?php
/**
 * The HTML for the admin order metabox content.
 *
 * @package Briqpay_For_WooCommerce/Templates
 */

?>

<p><b><?php esc_html_e( 'Payment method', 'briqpay-for-woocommerce' ); ?>:</b> <?php echo esc_html( $payment_method ); ?></p>
<p><b><?php esc_html_e( 'PSP name', 'briqpay-for-woocommerce' ); ?>:</b> <?php echo esc_html( $psp_name ); ?></p>
<?php
if ( ! empty( $rules_results ) && $failed_rules ) {
	?>
	<button type="button" id="briqpay_show_rules" class="button"><?php esc_html_e( 'Show rules results' ); ?></button>
	<div id="briqpay_rules_result_wrapper" class="briqpay_hide_rules">
		<div id="briqpay_rules_results">
			<div id="briqpay_close_rules"href="#"><span class="dashicons dashicons-dismiss"></span></div>
			<h3><?php esc_html_e( 'Failed rules for this order.' ); ?></h3>
			<?php
			foreach ( $rules_results as $psp_rules ) {
				?>
				<h4><?php echo esc_html( $psp_rules['pspname'] ); ?></h4>
				<ul>
				<?php
				foreach ( $psp_rules['rulesResult'] as $rules_result ) {
					if ( isset( $rules_result['outcome'] ) && ! $rules_result['outcome'] ) {
						?>
						<li><?php echo esc_html( $rules_result['friendlyname'] ); ?></li>
						<?php
					}
				}
				?>
				</ul>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

