<?php

if ( class_exists( 'QuadLayers\\WP_Plugin_Table_Links\\Load' ) ) {
	new \QuadLayers\WP_Plugin_Table_Links\Load(
		QLWCAJAX_PLUGIN_FILE,
		array(
			array(
				'text' => esc_html__( 'Premium', 'perfect-woocommerce-brands' ),
				'url'  => QLWCAJAX_PURCHASE_URL,
			),
			array(
				'place' => 'row_meta',
				'text'  => esc_html__( 'Support', 'perfect-woocommerce-brands' ),
				'url'   => QLWCAJAX_SUPPORT_URL,
			),
		)
	);
}
