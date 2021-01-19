<?php
/**
 * Ajax class file.
 *
 * @package Briqpay_For_WooCommerce/Classes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Ajax class.
 */
class Briqpay_Ajax extends WC_AJAX {
	/**
	 * Hook in ajax handlers.
	 */
	public static function init() {
		self::add_ajax_events();
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		$ajax_events = array(
			'briqpay_get_order' => true,
		);
		foreach ( $ajax_events as $ajax_event => $nopriv ) {
			add_action( 'wp_ajax_woocommerce_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			if ( $nopriv ) {
				add_action( 'wp_ajax_nopriv_woocommerce_' . $ajax_event, array( __CLASS__, $ajax_event ) );
				// WC AJAX can be used for frontend ajax requests.
				add_action( 'wc_ajax_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			}
		}
	}


	/**
	 *
	 */
	public static function briqpay_get_order() {
		error_log( var_export( WC()->session->get( 'briqpay_session_id' ), true ) );
		$briqpay_order = BRIQPAY()->api->get_briqpay_order(
			array(
				'session_id' => WC()->session->get( 'briqpay_session_id' ),
			)
		);

		error_log( var_export( $briqpay_order, true ) );
		wp_send_json_success(
			array(
				'billing_address'  => $briqpay_order['billingaddress'],
				'shipping_address' => $briqpay_order['shippingaddress'],
			)
		);
		wp_die();
	}

}
Briqpay_Ajax::init();