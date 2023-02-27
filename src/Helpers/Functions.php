<?php

/**
 * Plugin helper functions
 *
 * @package WooCustomGateway
 * @subpackage WooCustomGateway/Helpers
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */

namespace Rich4rdMuvirimi\WooCustomGateway\Helpers;

use Rich4rdMuvirimi\WooCustomGateway\Model\Gateway;

/**
 * Class to handle plugin generic functions
 *
 * @package WooCustomGateway
 * @subpackage WooCustomGateway/Helpers
 *
 * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
 * @since 1.0.0
 * @version 1.0.0
 */
class Functions
{

    /**
     * Get initialized payment gateway class
     *
     * @return Gateway|false
     * @since 1.0.0
     * @version 1.0.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public static function gateway_instance($gateway)
    {
        if (function_exists('WC')) {

            if (WC()->payment_gateways) {
                $gateways = WC()->payment_gateways->payment_gateways();

                if (isset($gateways[$gateway])) {

                    $gateway = $gateways[$gateway];

                    if ($gateway instanceof Gateway) {
                        return $gateway;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get filtered gateway id
     *
     * @param int $id
     *
     * @return string
     * @since 1.3.0
     * @version 1.3.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public static function gateway_id(int $id): string
    {

        /**
         * Filter payment gateway id, has to be unique so that orders are not attributed to the wrong payment gateway
         *
         * @since 1.2.3
         * @version 1.2.3
         */
        return apply_filters(self::get_plugin_slug('-gateway-id'), self::gateway_slug() . '-' . $id, $id);
    }

    /**
     * Get unique plugin slug
     *
     * @param string $suffix
     *
     * @return string
     * @since 1.3.0
     * @version 1.3.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public static function get_plugin_slug(string $suffix = ''): string
    {
        return WOO_CUSTOM_GATEWAY_SLUG . $suffix;
    }

    /**
     * The slug name for payment gateway post types
     *
     * @return string
     * @since 1.0.0
     * @version 1.0.0
     *
     * @author Richard Muvirimi <rich4rdmuvirimi@gmail.com>
     */
    public static function gateway_slug(): string
    {
        return 'woocg-post';
    }

}
