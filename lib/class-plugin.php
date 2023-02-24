<?php

namespace QuadLayers\QLWCAJAX;

class Plugin {

	protected static $instance;

	private function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_product_js' ), 99 );
	}

	public function add_product_js() {

		global $post;

		wp_register_script(
			'woo-ajax-add-to-cart',
			plugins_url(
				'assets/frontend/woo-ajax-add-to-cart.min.js',
				QLWCAJAX_PLUGIN_FILE
			),
			array(
				'jquery',
				'wc-add-to-cart',
			),
			QLWCAJAX_PLUGIN_VERSION,
			true
		);

		if ( function_exists( 'is_product' ) && is_product() ) {

			$product = wc_get_product( $post->ID );

			$enabled = apply_filters( 'qlwcajax_product_enabled', '__return_true', $product );

			if ( ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) && $enabled ) {
				wp_enqueue_script( 'woo-ajax-add-to-cart' );
			}
		}
	}

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

Plugin::instance();
