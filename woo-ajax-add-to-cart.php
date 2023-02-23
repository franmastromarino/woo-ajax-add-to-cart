<?php

/**
 * Plugin Name:             Ajax add to cart for WooCommerce
 * Plugin URI:              https://quadlayers.com
 * Description:             Ajax add to cart for WooCommerce products
 * Version:                 1.4.2
 * Text Domain:             woo-ajax-add-to-cart
 * Author:                  QuadLayers
 * Author URI:              https://quadlayers.com
 * License:                 GPLv3
 * Domain Path:             /languages
 * Request at least:        4.7.0
 * Tested up to:            6.1
 * Requires PHP:            5.6
 * WC requires at least:    4.0
 * WC tested up to:         7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'QLWCAJAX_PLUGIN_NAME', 'Ajax add to cart for WooCommerce' );
define( 'QLWCAJAX_PLUGIN_VERSION', '1.4.2' );
define( 'QLWCAJAX_PLUGIN_FILE', __FILE__ );
define( 'QLWCAJAX_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR );
define( 'QLWCAJAX_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'QLWCAJAX_PREFIX', 'qlwcajax' );
define( 'QLWCAJAX_WORDPRESS_URL', 'https://wordpress.org/plugins/woo-ajax-add-to-cart/' );
define( 'QLWCAJAX_REVIEW_URL', 'https://wordpress.org/support/plugin/woo-ajax-add-to-cart/reviews/?filter=5#new-post' );
define( 'QLWCAJAX_DEMO_URL', 'https://quadlayers.com/portfolio/woocommerce-direct-checkout/?utm_source=qlwcajax_admin' );
define( 'QLWCAJAX_PURCHASE_URL', QLWCAJAX_DEMO_URL );
define( 'QLWCAJAX_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qlwcajax_admin' );
define( 'QLWCAJAX_GROUP_URL', 'https://www.facebook.com/groups/quadlayers' );

define( 'QLWCAJAX_PREMIUM_SELL_SLUG', 'woocommerce-direct-checkout-pro' );
define( 'QLWCAJAX_PREMIUM_SELL_NAME', 'WooCommerce Direct Checkout' );
define( 'QLWCAJAX_PREMIUM_SELL_URL', 'https://quadlayers.com/portfolio/woocommerce-direct-checkout/?utm_source=qlwcajax_admin' );

define( 'QLWCAJAX_CROSS_INSTALL_SLUG', 'woocommerce-checkout-manager' );
define( 'QLWCAJAX_CROSS_INSTALL_NAME', 'Checkout Manager' );
define( 'QLWCAJAX_CROSS_INSTALL_DESCRIPTION', esc_html__( 'Checkout Field Manager( Checkout Manager ) for WooCommerce allows you to add custom fields to the checkout page, related to billing, Shipping or Additional fields sections.', 'woo-ajax-add-to-cart' ) );
define( 'QLWCAJAX_CROSS_INSTALL_URL', 'https://quadlayers.com/portfolio/woocommerce-checkout-manager/?utm_source=qlwcajax_admin' );


require_once QLWCAJAX_PLUGIN_DIR . 'includes/quadlayers/widget.php';
require_once QLWCAJAX_PLUGIN_DIR . 'includes/quadlayers/notices.php';
require_once QLWCAJAX_PLUGIN_DIR . 'includes/quadlayers/links.php';

if ( ! class_exists( 'QLWCAJAX' ) ) {

	class QLWCAJAX {

		protected static $instance;

		function ajax_dismiss_notice() {

			if ( $notice_id = ( isset( $_POST['notice_id'] ) ) ? sanitize_key( $_POST['notice_id'] ) : '' ) {

				update_user_meta( get_current_user_id(), $notice_id, true );

				wp_send_json( $notice_id );
			}

			wp_die();
		}

		function add_product_js() {

			global $post;

			wp_register_script( 'woo-ajax-add-to-cart', plugin_dir_url( __FILE__ ) . 'assets/frontend/woo-ajax-add-to-cart.min.js', array( 'jquery', 'wc-add-to-cart' ), QLWCAJAX_PLUGIN_VERSION, true );

			if ( function_exists( 'is_product' ) && is_product() ) {

				$product = wc_get_product( $post->ID );

				$enabled = apply_filters( 'qlwcajax_product_enabled', '__return_true', $product );

				if ( ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) && $enabled ) {
					wp_enqueue_script( 'woo-ajax-add-to-cart' );
				}
			}
		}

		function init() {
			add_action( 'wp_enqueue_scripts', array( $this, 'add_product_js' ), 99 );
			add_action( 'wp_ajax_qlwcajax_dismiss_notice', array( $this, 'ajax_dismiss_notice' ) );
		}

		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
				self::$instance->init();
			}
			return self::$instance;
		}
	}

	QLWCAJAX::instance();
}
