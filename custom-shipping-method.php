<?php

/**
 * Plugin Name: Custom Shipping Method
 * Description: Adds a custom shipping method to WooCommerce.
 * Version: 1.0
 * Author: Engy
 * Text Domain: custom-shipping-method
 */

defined('ABSPATH') || exit;
define('CSM_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

// include files
require_once CSM_PLUGIN_DIR_PATH. 'includes/custom-shipping-method-functions.php';

// register hooks
add_action('plugins_loaded', 'csm_check_woocommerce_active');

add_action('woocommerce_shipping_init', 'custom_shipping_method_init');

add_filter('woocommerce_shipping_methods', 'csm_add_custom_shipping_method');