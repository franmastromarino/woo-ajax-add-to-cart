<?php

namespace QuadLayers\QLWCAJAX;

final class Plugin {

	protected static $instance;

	private function __construct() {
		/**
		 * Load plugin textdomain.
		 */
		load_plugin_textdomain( 'woo-ajax-add-to-cart', false, QLWCAJAX_PLUGIN_DIR . '/languages/' );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_product_js' ), 99 );
		add_action( 'woocommerce_before_add_to_cart_form', array( $this, 'load_product_js' ) );
		add_filter( 'woocommerce_product_variation_get_attributes', array( $this, 'fix_add_missing_variation_attributes' ), 10, 2 );
		add_filter( 'woocommerce_cart_item_data_to_validate', array( $this, 'fix_remove_missing_variation_attributes' ), 10, 2 );
	}

	/**
	 * Add product js
	 */
	public function add_product_js() {

		global $post;

		wp_register_script(
			'woo-ajax-add-to-cart',
			plugins_url(
				'assets/frontend/woo-ajax-add-to-cart.js',
				QLWCAJAX_PLUGIN_FILE
			),
			array(
				'jquery',
				'wc-add-to-cart',
			),
			QLWCAJAX_PLUGIN_VERSION,
			true
		);
	}

	/**
	 * Load product js
	 */
	public function load_product_js() {

		global $product;

		$enabled = apply_filters( 'qlwcajax_product_enabled', '__return_true', $product );

		$supported_types = apply_filters( 'qlwcajax_product_supported_types', array( 'simple', 'variable' ), $product );

		if ( ( $product->is_type( $supported_types ) ) && $enabled ) {
			wp_enqueue_script( 'woo-ajax-add-to-cart' );
		}
	}

	/**
	 * Fix missing variation attributes when adding to cart via aja
	 *
	 * @param array      $attributes
	 * @param WC_Product $product
	 */
	public function fix_add_missing_variation_attributes( $attributes, $product ) {

		$values = array_filter( array_values( $attributes ) );

		// Check if the produc has empty attributes
		if ( ! empty( $values ) || empty( $_REQUEST['wc-ajax'] ) ) {
			return $attributes;
		}

		$_REQUEST['_changed_attributes'] = array();

		foreach ( $attributes as $key => $value ) {

			$request_key = 'attribute_' . $key;

			if ( '' === $value && isset( $_REQUEST[ $request_key ] ) ) {
				$_REQUEST['_changed_attributes'][ $request_key ] = $value;
				$attributes[ $key ]                              = $_REQUEST[ $request_key ];
			}
		}

		return $attributes;
	}

	/**
	 * Fix 'data_hash' invalidation when changing attributes
	 *
	 * @param array      $cart_item_data
	 * @param WC_Product $product
	 */
	public function fix_remove_missing_variation_attributes( $cart_item_data, $product ) {

		if ( ! isset( $_REQUEST['_changed_attributes'] ) || ! is_array( $_REQUEST['_changed_attributes'] ) || ! isset( $cart_item_data['attributes'] ) || ! is_array( $cart_item_data['attributes'] ) ) {
			return $cart_item_data;
		}

		foreach ( $cart_item_data['attributes'] as $attribute_name => $attribute_value ) {
			if ( isset( $_REQUEST['_changed_attributes'][ $attribute_name ] ) ) {
				$cart_item_data['attributes'][ $attribute_name ] = $_REQUEST['_changed_attributes'][ $attribute_name ];
			}
		}

		return $cart_item_data;
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

Plugin::instance();
