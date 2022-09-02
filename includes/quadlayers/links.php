<?php

namespace Perfect_Woocommerce_Brands\Admin;

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

class QLWCAJAX_Admin_Links {

	protected static $_instance;

	function __construct() {
		add_filter( 'plugin_action_links_' . QLWCAJAX_PLUGIN_BASENAME, array( $this, 'add_action_links' ) );
	}

	public function add_action_links( $links ) {
		$links[] = '<a target="_blank" href="' . QLWCAJAX_PURCHASE_URL . '">' . esc_html__( 'Premium', 'woo-ajax-add-to-cart' ) . '</a>';
		return $links;
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}

QLWCAJAX_Admin_Links::instance();
