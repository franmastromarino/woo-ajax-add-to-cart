<?php

if ( class_exists( 'QuadLayers\\WP_Notice_Plugin_Promote\\Load' ) ) {
	/**
	 *  Promote constants
	 */
	define( 'QLWCAJAX_PROMOTE_LOGO_SRC', plugins_url( '/assets/backend/img/logo.jpg', QLWCAJAX_PLUGIN_FILE ) );
	/**
	 * Notice review
	 */
	define( 'QLWCAJAX_PROMOTE_REVIEW_URL', 'https://wordpress.org/support/plugin/woo-ajax-add-to-cart/reviews/?filter=5#new-post' );
	/**
	 * Notice premium sell
	 */
	define( 'QLWCAJAX_PROMOTE_PREMIUM_SELL_SLUG', 'woocommerce-direct-checkout' );
	define( 'QLWCAJAX_PROMOTE_PREMIUM_SELL_NAME', 'WooCommerce Direct Checkout PRO' );
	define( 'QLWCAJAX_PROMOTE_PREMIUM_SELL_URL', QLWCAJAX_PREMIUM_SELL_URL );
	/**
	 * Notice cross sell 1
	 */
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_SLUG', 'woocommerce-checkout-manager' );
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_NAME', 'WooCommerce Checkout Manager' );
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_DESCRIPTION', esc_html__( 'This plugin allows you to add custom fields to the checkout page, related to billing, shipping or additional fields sections.', 'woo-ajax-add-to-cart' ) );
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_URL', 'https://quadlayers.com/products/woocommerce-checkout-manager/?utm_source=qlwcajax_admin' );
	/**
	 * Notice cross sell 2
	 */
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_SLUG', 'perfect-woocommerce-brands' );
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_NAME', 'Perfect WooCommerce Brands' );
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_DESCRIPTION', esc_html__( 'Perfect WooCommerce Brands the perfect tool to improve customer experience on your site. It allows you to highlight product brands and organize them in lists, dropdowns, thumbnails, and as a widget.', 'woo-ajax-add-to-cart' ) );
	define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_URL', 'https://quadlayers.com/products/perfect-woocommerce-brands/?utm_source=qlwcajax_admin' );

	new \QuadLayers\WP_Notice_Plugin_Promote\Load(
		QLWCAJAX_PLUGIN_FILE,
		array(
			array(
				'type'               => 'ranking',
				'notice_delay'       => MONTH_IN_SECONDS,
				'notice_logo'        => QLWCAJAX_PROMOTE_LOGO_SRC,
				'notice_title'       => sprintf(
					esc_html__(
						'Hello! Thank you for choosing the %s plugin!',
						'woo-ajax-add-to-cart'
					),
					QLWCAJAX_PLUGIN_NAME
				),
				'notice_description' => esc_html__( 'Could you please give it a 5-star rating on WordPress? Your feedback boosts our motivation, helps us promote, and continues to improve this product. Your support matters!', 'woo-ajax-add-to-cart' ),
				'notice_link'        => QLWCAJAX_PROMOTE_REVIEW_URL,
				'notice_link_label'  => esc_html__(
					'Yes, of course!',
					'woo-ajax-add-to-cart'
				),
				'notice_more_link'   => QLWCAJAX_SUPPORT_URL,
				'notice_more_label'  => esc_html__(
					'Report a bug',
					'woo-ajax-add-to-cart'
				),
			),
			array(
				'plugin_slug'        => QLWCAJAX_PROMOTE_PREMIUM_SELL_SLUG,
				'notice_delay'       => MONTH_IN_SECONDS,
				'notice_logo'        => QLWCAJAX_PROMOTE_LOGO_SRC,
				'notice_title'       => esc_html__(
					'Hello! We have a special gift!',
					'woo-ajax-add-to-cart'
				),
				'notice_description' => sprintf(
					esc_html__(
						'Today we have a special gift for you. Use the coupon code %1$s within the next 48 hours to receive a %2$s discount on the premium version of the %3$s plugin.',
						'woo-ajax-add-to-cart'
					),
					'ADMINPANEL20%',
					'20%',
					QLWCAJAX_PROMOTE_PREMIUM_SELL_NAME
				),
				'notice_more_link'   => QLWCAJAX_PROMOTE_PREMIUM_SELL_URL,
				'notice_more_label'  => esc_html__(
					'More info!',
					'woo-ajax-add-to-cart'
				),
			),
			array(
				'plugin_slug'        => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_SLUG,
				'notice_delay'       => MONTH_IN_SECONDS * 4,
				'notice_logo'        => QLWCAJAX_PROMOTE_LOGO_SRC,
				'notice_title'       => sprintf(
					esc_html__(
						'Hello! We want to invite you to try our %s plugin!',
						'woo-ajax-add-to-cart'
					),
					QLWCAJAX_PROMOTE_CROSS_INSTALL_1_NAME
				),
				'notice_description' => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_DESCRIPTION,
				'notice_more_link'   => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_URL,
				'notice_more_label'  => esc_html__(
					'More info!',
					'woo-ajax-add-to-cart'
				),
			),
			array(
				'plugin_slug'        => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_SLUG,
				'notice_delay'       => MONTH_IN_SECONDS * 6,
				'notice_logo'        => QLWCAJAX_PROMOTE_LOGO_SRC,
				'notice_title'       => sprintf(
					esc_html__(
						'Hello! We want to invite you to try our %s plugin!',
						'woo-ajax-add-to-cart'
					),
					QLWCAJAX_PROMOTE_CROSS_INSTALL_2_NAME
				),
				'notice_description' => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_DESCRIPTION,
				'notice_more_link'   => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_URL,
				'notice_more_label'  => esc_html__(
					'More info!',
					'woo-ajax-add-to-cart'
				),
			),
		)
	);
}
