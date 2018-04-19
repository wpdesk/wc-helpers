<?php

namespace WPDesk\WC\Helper\Order\Compatible;

use WPDesk\WC\Helper\Order\OrderCompatible;

/**
 * Class WPDesk_Helpers_WC_Factory
 * @deprecated
 */
class Factory implements \WPDesk\WC\Helper\Order\HelperFactory
{
    /**
     * @param \WC_Order $order
     * @param $version
     *
     * @return OrderCompatible
     */
    public function create_helper(\WC_Order $order, $version = WC_VERSION)
    {
        if (version_compare($version, '2.7', '<')) {
            return new LegacyV27($order);
        } else {
            return new Latest($order);
        }
    }
}