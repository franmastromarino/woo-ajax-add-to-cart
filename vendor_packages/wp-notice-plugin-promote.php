<?php

if ( class_exists( 'QuadLayers\\WP_Notice_Plugin_Promote\\Load' ) ) {
	add_action('init', function() {
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
		define( 'QLWCAJAX_PROMOTE_PREMIUM_INSTALL_URL', 'https://quadlayers.com/products/woocommerce-direct-checkout/?utm_source=qlwcajax_plugin&utm_medium=dashboard_notice&utm_campaign=premium_upgrade&utm_content=premium_install_button' );
		define( 'QLWCAJAX_PROMOTE_PREMIUM_SELL_URL', 'https://quadlayers.com/products/woocommerce-direct-checkout/?utm_source=qlwcajax_plugin&utm_medium=dashboard_notice&utm_campaign=premium_upgrade&utm_content=premium_link' );
		/**
		 * Notice cross sell 1
		 */
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_SLUG', 'wp-whatsapp-chat' );
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_NAME', 'Social Chat' );
		define(
			'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_TITLE',
			wp_kses(
				sprintf(
					'<h3 style="margin:0">%s</h3>',
					esc_html__( 'Turn more visitors into customers.', 'woo-ajax-add-to-cart' )
				),
				array(
					'h3' => array(
						'style' => array()
					)
				)
			)
		);
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_DESCRIPTION', esc_html__( 'Social Chat allows your users to start a conversation from your website directly to your WhatsApp phone number with one click.', 'woo-ajax-add-to-cart' ) );
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_URL', 'https://quadlayers.com/products/whatsapp-chat/?utm_source=qlwcajax_plugin&utm_medium=dashboard_notice&utm_campaign=cross_sell&utm_content=social_chat_link' );
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_1_LOGO_SRC', plugins_url( '/assets/backend/img/wp-whatsapp-chat.jpeg', QLWCAJAX_PLUGIN_FILE ) );
		/**
		 * Notice cross sell 2
		 */
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_SLUG', 'woocommerce-checkout-manager' );
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_NAME', 'WooCommerce Checkout Manager' );
		define(
			'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_TITLE',
			wp_kses(
				sprintf(
					'<h3 style="margin:0">%s</h3>',
					esc_html__( 'Customize your checkout in minutes.', 'woo-ajax-add-to-cart' )
				),
				array(
					'h3' => array(
						'style' => array()
					)
				)
			)
		);
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_DESCRIPTION', esc_html__( 'WooCommerce Checkout Manager allows you to add custom fields to the checkout page, related to billing, Shipping or Additional fields sections.', 'woo-ajax-add-to-cart' ) );
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_URL', 'https://quadlayers.com/products/woocommerce-checkout-manager/?utm_source=qlwcajax_plugin&utm_medium=dashboard_notice&utm_campaign=cross_sell&utm_content=checkout_manager_link' );
		define( 'QLWCAJAX_PROMOTE_CROSS_INSTALL_2_LOGO_SRC', plugins_url( '/assets/backend/img/woocommerce-checkout-manager.jpg', QLWCAJAX_PLUGIN_FILE ) );

		new \QuadLayers\WP_Notice_Plugin_Promote\Load(
			QLWCAJAX_PLUGIN_FILE,
			array(
				array(
					'type'               => 'ranking',
					'notice_delay'       => 0,
					'notice_logo'        => QLWCAJAX_PROMOTE_LOGO_SRC,
					'notice_title'       => wp_kses(
						sprintf(
							'<h3 style="margin:0">%s</h3>',
							esc_html__( 'Enjoying WooCommerce Ajax Add to Cart?', 'woo-ajax-add-to-cart' )
						),
						array(
							'h3' => array(
								'style' => array()
							)
						)
					),
					'notice_description' => esc_html__( 'A quick 5-star review helps us keep improving the plugin and supporting users like you. It only takes 2 seconds — thank you!', 'woo-ajax-add-to-cart' ),
					'notice_link'        => QLWCAJAX_PROMOTE_REVIEW_URL,
					'notice_more_link'   => 'https://quadlayers.com/account/support/?utm_source=qlwcajax_plugin&utm_medium=dashboard_notice&utm_campaign=support&utm_content=report_bug_button',
					'notice_more_label'  => esc_html__(
						'Report a bug',
						'woo-ajax-add-to-cart'
					),
				),
				array(
					'plugin_slug'        => QLWCAJAX_PROMOTE_PREMIUM_SELL_SLUG,
					'plugin_install_link'   => QLWCAJAX_PROMOTE_PREMIUM_INSTALL_URL,
					'plugin_install_label'  => esc_html__(
						'Purchase Now',
						'woo-ajax-add-to-cart'
					),
					'notice_delay'       => WEEK_IN_SECONDS,
					'notice_logo'        => QLWCAJAX_PROMOTE_LOGO_SRC,
					'notice_title'       => wp_kses(
						sprintf(
							'<h3 style="margin:0">%s</h3>',
							esc_html__( 'Save 20% today!', 'woo-ajax-add-to-cart' )
						),
						array(
							'h3' => array(
								'style' => array()
							)
						)
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
				),
				array(
					'plugin_slug'        => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_SLUG,
					'notice_delay'       => MONTH_IN_SECONDS * 3,
					'notice_logo'        => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_LOGO_SRC,
					'notice_title'       => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_TITLE,
					'notice_description' => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_DESCRIPTION,
					'notice_more_link'   => QLWCAJAX_PROMOTE_CROSS_INSTALL_1_URL
				),
				array(
					'plugin_slug'        => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_SLUG,
					'notice_delay'       => MONTH_IN_SECONDS * 6,
					'notice_logo'        => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_LOGO_SRC,
					'notice_title'       => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_TITLE,
					'notice_description' => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_DESCRIPTION,
					'notice_more_link'   => QLWCAJAX_PROMOTE_CROSS_INSTALL_2_URL
				),
			)
		);
	});
}
