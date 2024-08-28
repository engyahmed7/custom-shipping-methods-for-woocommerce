<?php

defined('ABSPATH') || exit;

/**
 * Summary of csm_check_woocommerce_active
 * Checks if WooCommerce is active and includes necessary files.
 * @return void
 */
function csm_check_woocommerce_active()
{
    if (class_exists('WooCommerce')) {
        include_files();
    } else {
        add_action('admin_notices', 'csm_admin_notice_missing_woocommerce');
    }
}

/**
 * Summary of include_files
 * Includes necessary files for the custom shipping method.
 * @return void
 */
function include_files()
{
    require_once CSM_PLUGIN_DIR_PATH . 'includes/classes/class-custom-shipping-method.php';
}

/**
 * Summary of csm_admin_notice_missing_woocommerce
 * Displays an admin notice if WooCommerce is not active.
 * @return void
 */
function csm_admin_notice_missing_woocommerce()
{
?>
    <div class="notice notice-error">
        <p><?php _e('Custom Shipping Method plugin requires WooCommerce to be installed and activated.', 'custom-shipping-method'); ?>
        </p>
    </div>
<?php
}

/**
 * Summary of csm_add_custom_shipping_method
 * 
 * Adds the custom shipping method to WooCommerce shipping methods.
 * @param mixed $methods
 * @return mixed
 */
function csm_add_custom_shipping_method($methods)
{
    $methods['custom_shipping_method'] = 'WC_Custom_Shipping_Method';
    return $methods;
}

/**
 * Summary of custom_shipping_method_init
 * Initializes the custom shipping method if the class exists.
 * @return void
 */

function custom_shipping_method_init()
{
    if (class_exists('WC_Custom_Shipping_Method')) {
        new WC_Custom_Shipping_Method();
    }
}
