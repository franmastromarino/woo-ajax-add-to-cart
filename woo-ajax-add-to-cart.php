<?php

/**
 * Plugin Name:             Ajax add to cart for WooCommerce
 * Plugin URI:              https://quadlayers.com
 * Description:             Ajax add to cart for WooCommerce products
 * Version:                 2.4.1
 * Text Domain:             woo-ajax-add-to-cart
 * Author:                  QuadLayers
 * Author URI:              https://quadlayers.com
 * License:                 GPLv3
 * Domain Path:             /languages
 * Request at least:        4.7
 * Tested up to:            6.6
 * Requires PHP:            5.6
 * WC requires at least:    4.0
 * WC tested up to:         9.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'QLWCAJAX_PLUGIN_NAME', 'Ajax add to cart for WooCommerce' );
define( 'QLWCAJAX_PLUGIN_VERSION', '2.4.1' );
define( 'QLWCAJAX_PLUGIN_FILE', __FILE__ );
define( 'QLWCAJAX_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR );
define( 'QLWCAJAX_DOMAIN', 'qlwcajax' );
define( 'QLWCAJAX_PREFIX', QLWCAJAX_DOMAIN );
define( 'QLWCAJAX_WORDPRESS_URL', 'https://wordpress.org/plugins/woo-ajax-add-to-cart/' );
define( 'QLWCAJAX_REVIEW_URL', 'https://wordpress.org/support/plugin/woo-ajax-add-to-cart/reviews/?filter=5#new-post' );
define( 'QLWCAJAX_DEMO_URL', 'https://quadlayers.com/products/woocommerce-direct-checkout/?utm_source=qlwcajax_admin' );
define( 'QLWCAJAX_PURCHASE_URL', QLWCAJAX_DEMO_URL );
define( 'QLWCAJAX_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qlwcajax_admin' );
define( 'QLWCAJAX_GROUP_URL', 'https://www.facebook.com/groups/quadlayers' );
define( 'QLWCAJAX_DEVELOPER', false );
define( 'QLWCAJAX_PREMIUM_SELL_URL', 'https://quadlayers.com/products/woocommerce-direct-checkout/?utm_source=qlwcajax_admin' );

/**
 * Load composer autoload
 */
require_once __DIR__ . '/vendor/autoload.php';
/**
 * Load vendor_packages packages
 */
require_once __DIR__ . '/vendor_packages/wp-i18n-map.php';
require_once __DIR__ . '/vendor_packages/wp-dashboard-widget-news.php';
require_once __DIR__ . '/vendor_packages/wp-plugin-table-links.php';
require_once __DIR__ . '/vendor_packages/wp-notice-plugin-required.php';
require_once __DIR__ . '/vendor_packages/wp-notice-plugin-promote.php';
require_once __DIR__ . '/vendor_packages/wp-plugin-install-tab.php';
/**
 * Load plugin classes
 */
require_once __DIR__ . '/lib/class-plugin.php';

/**
 * Declare compatibility with WooCommerce Custom Order Tables.
 */
add_action(
	'before_woocommerce_init',
	function () {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}
);
