<?php

defined('ABSPATH') || exit;

if (!class_exists('WC_Custom_Shipping_Method')) {
    class WC_Custom_Shipping_Method extends WC_Shipping_Method
    {
        /**
         * Summary of __construct
         * Constructor for the custom shipping method.
         * @param mixed $instance_id Optional. Instance ID of the shipping method.
         */
        public function __construct($instance_id = 0)
        {
            $this->id                 = 'custom_shipping_method';
            $this->instance_id        = absint($instance_id);
            $this->method_title       = __('Custom Shipping Method', 'custom-shipping-method');
            $this->method_description = __('Custom Shipping Method for WooCommerce', 'custom-shipping-method');

            $this->supports = array(
                'shipping-zones',
                'instance-settings-modal',
                'instance-settings',
            );

            $this->init();
        }

        /**
         * Summary of init
         * Initializes the custom shipping method.
         * @return void
         */
        public function init()
        {
            $this->init_form_fields();
            $this->init_settings();

            $this->enabled = $this->get_option('enabled');
            $this->title   = $this->get_option('title');
            $this->cost    = $this->get_option('cost');

            add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
        }

        /**
         * Summary of init_form_fields
         * Initializes the form fields for the shipping method settings.
         * @return void
         */
        public function init_form_fields()
        {
            $this->instance_form_fields = array(
                'enabled' => array(
                    'title'       => __('Enable', 'custom-shipping-method'),
                    'label'       => __('Enable', 'custom-shipping-method'),
                    'type'        => 'checkbox',
                    'description' => __('Enable this shipping method.', 'custom-shipping-method'),
                    'default'     => 'yes',
                ),
                'title' => array(
                    'title'       => __('Title', 'custom-shipping-method'),
                    'label'       => __('Title', 'custom-shipping-method'),
                    'type'        => 'text',
                    'description' => __('Title to be displayed during checkout.', 'custom-shipping-method'),
                    'default'     => __('Custom Shipping', 'custom-shipping-method'),
                ),
                'cost' => array(
                    'title'       => __('Cost', 'custom-shipping-method'),
                    'label'       => __('Cost', 'custom-shipping-method'),
                    'type'        => 'number',
                    'description' => __('Cost of shipping.', 'custom-shipping-method'),
                    'default'     => 0,
                ),
            );
        }

        /**
         * Summary of calculate_shipping
         * Calculates the shipping cost for a given package.
         * @param mixed $package The package array containing details for the shipping calculation.
         * @return void
         */
        public function calculate_shipping($package = array())
        {
            $rate = array(
                'id'       => $this->id,
                'instance' => $this->instance_id,
                'label'    => $this->instance_settings['title'],
                'cost'     => $this->instance_settings['cost'],
                'calc_tax' => 'per_item'
            );

            $this->add_rate($rate);
        }
    }
}
