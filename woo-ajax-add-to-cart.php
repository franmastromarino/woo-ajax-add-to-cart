<?php
/**
 * Plugin Name: Ajax add to cart for WooCommerce
 * Description: Ajax add to cart for WooCommerce products
 * Version:     1.1.4
 * Author:      QuadLayers
 * Author URI:  https://www.quadlayers.com
 * Copyright:   2019 QuadLayers (https://www.quadlayers.com)
 * Text Domain: woo-ajax-add-to-cart
 */
if (!defined('ABSPATH')) {
  die('-1');
}
if (!defined('QLWCAJAX_PLUGIN_NAME')) {
  define('QLWCAJAX_PLUGIN_NAME', 'Ajax add to cart for WooCommerce');
}
if (!defined('QLWCAJAX_PLUGIN_VERSION')) {
  define('QLWCAJAX_PLUGIN_VERSION', '1.1.4');
}
if (!defined('QLWCAJAX_PLUGIN_FILE')) {
  define('QLWCAJAX_PLUGIN_FILE', __FILE__);
}
if (!defined('QLWCAJAX_PLUGIN_DIR')) {
  define('QLWCAJAX_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('QLWCAJAX_DOMAIN')) {
  define('QLWCAJAX_DOMAIN', 'qlwcajax');
}
if (!defined('QLWCAJAX_WORDPRESS_URL')) {
  define('QLWCAJAX_WORDPRESS_URL', 'https://wordpress.org/plugins/woo-ajax-add-to-cart/');
}
if (!defined('QLWCAJAX_REVIEW_URL')) {
  define('QLWCAJAX_REVIEW_URL', 'https://wordpress.org/support/plugin/woo-ajax-add-to-cart/reviews/?filter=5#new-post');
}
if (!defined('QLWCAJAX_DEMO_URL')) {
  define('QLWCAJAX_DEMO_URL', 'https://quadlayers.com/portfolio/woocommerce-direct-checkout/?utm_source=qlwcajax_admin');
}
if (!defined('QLWCAJAX_PURCHASE_URL')) {
  define('QLWCAJAX_PURCHASE_URL', QLWCAJAX_DEMO_URL);
}
if (!defined('QLWCAJAX_SUPPORT_URL')) {
  define('QLWCAJAX_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qlwcajax_admin');
}
if (!defined('QLWCAJAX_GROUP_URL')) {
  define('QLWCAJAX_GROUP_URL', 'https://www.facebook.com/groups/quadlayers');
}

if (!class_exists('QLWCAJAX')) {

  class QLWCAJAX {

    protected static $instance;

    function ajax_dismiss_notice() {

      if ($notice_id = ( isset($_POST['notice_id']) ) ? sanitize_key($_POST['notice_id']) : '') {

        update_user_meta(get_current_user_id(), $notice_id, true);

        wp_send_json($notice_id);
      }

      wp_die();
    }

    function add_product_js() {

      wp_register_script('woo-ajax-add-to-cart', plugin_dir_url(__FILE__) . 'assets/woo-ajax-add-to-cart.min.js', array('jquery', 'wc-add-to-cart'), QLWCAJAX_PLUGIN_VERSION, true);

      if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('woo-ajax-add-to-cart');
      }
    }

    function add_notices() {
      if (!get_user_meta(get_current_user_id(), 'qlwcajax-update-notice', true)) {
        ?>
        <div id="qlwcajax-admin-rating" class="qlwcajax-notice notice is-dismissible" data-notice_id="qlwcajax-update-notice">
          <div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
            <div class="notice-image">
              <img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url('/assets/qlwcdc.png', QLWCAJAX_PLUGIN_FILE); ?>" alt="<?php echo esc_html(QLWCAJAX_PLUGIN_NAME); ?>>">
            </div>
            <div class="notice-content" style="margin-left: 15px;">
              <p>
                <?php printf(esc_html__('Hello! Do you want to improve your sales?', 'woo-ajax-add-to-cart'), QLWCAJAX_PLUGIN_NAME); ?>
                <br/>
                <?php esc_html_e('We want to invite you to meet our WooCommerce Direct Checkout plugin which allows you to simplifies the checkout process by skipping the shopping cart page and other tips.', 'woo-ajax-add-to-cart'); ?>
              </p>
              <a href="<?php echo esc_url(QLWCAJAX_PURCHASE_URL); ?>" class="button-primary" target="_blank">
                <?php esc_html_e('More Info!', 'woo-ajax-add-to-cart'); ?>
              </a>
              <?php if (current_user_can('activate_plugins')): ?>
                <a href="<?php echo wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=woocommerce-direct-checkout'), 'install-plugin_woocommerce-direct-checkout'); ?>" class="button-secondary" target="_blank">
                  <?php esc_html_e('Install', 'woo-ajax-add-to-cart'); ?>
                </a>
              <?php endif; ?>
            </div>				
          </div>
        </div>
        <script>
          (function ($) {
            $('.qlwcajax-notice').on('click', '.notice-dismiss', function (e) {
              e.preventDefault();
              var notice_id = $(e.delegateTarget).data('notice_id');
              $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                  notice_id: notice_id,
                  action: 'qlwcajax_dismiss_notice',
                },
                success: function (response) {
                  console.log(response);
                },
              });
            });
          })(jQuery);
        </script>
        <?php
      }
    }

    function add_action_links($links) {

      $links[] = '<a target="_blank" href="' . QLWCAJAX_PURCHASE_URL . '">' . esc_html__('Premium', 'woo-ajax-add-to-cart') . '</a>';

      return $links;
    }

    function init() {
      add_action('wp_enqueue_scripts', array($this, 'add_product_js'), 99);
      add_action('wp_ajax_qlwcajax_dismiss_notice', array($this, 'ajax_dismiss_notice'));
      add_action('admin_notices', array($this, 'add_notices'));
      add_filter('plugin_action_links_' . plugin_basename(QLWCAJAX_PLUGIN_FILE), array($this, 'add_action_links'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  QLWCAJAX::instance();
}
