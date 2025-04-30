<?php

if ( class_exists( 'QuadLayers\\WP_Plugin_Table_Links\\Load' ) ) {
	add_action('init', function() {
		new \QuadLayers\WP_Plugin_Table_Links\Load(
			QLWCAJAX_PLUGIN_FILE,
			array(

				array(
					'text' => esc_html__( 'Settings', 'woo-ajax-add-to-cart' ),
					'url'  => admin_url('admin.php?page=wc-settings&tab=products'),
					'target' => '_self',
				),
				array(
					'text' => esc_html__( 'Premium', 'woo-ajax-add-to-cart' ),
					'url'  => QLWCAJAX_PREMIUM_SELL_URL,
				),
				array(
					'place' => 'row_meta',
					'text'  => esc_html__( 'Support', 'woo-ajax-add-to-cart' ),
					'url'   => QLWCAJAX_SUPPORT_URL,
				),
				array(
					'place' => 'row_meta',
					'text'  => esc_html__( 'Documentation', 'woo-ajax-add-to-cart' ),
					'url'   => QLWCAJAX_DOCUMENTATION_URL,
				),
			)
		);
	});
}
