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
					'url'  => 'https://quadlayers.com/products/woocommerce-direct-checkout/?utm_source=qlwcajax_plugin&utm_medium=plugin_table&utm_campaign=cross_sell&utm_content=premium_link',
					'color' => 'green',
					'target' => '_blank',
				),
				array(
					'place' => 'row_meta',
					'text'  => esc_html__( 'Support', 'woo-ajax-add-to-cart' ),
					'url'   => 'https://quadlayers.com/account/support/?utm_source=qlwcajax_plugin&utm_medium=plugin_table&utm_campaign=support&utm_content=support_link',
				),
				array(
					'place' => 'row_meta',
					'text'  => esc_html__( 'Documentation', 'woo-ajax-add-to-cart' ),
					'url'   => 'https://quadlayers.com/documentation/woo-ajax-add-to-cart/?utm_source=qlwcajax_plugin&utm_medium=plugin_table&utm_campaign=documentation&utm_content=documentation_link',
				),
			)
		);
	});
}
