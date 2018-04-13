<?php

namespace WPDesk\Compatibility\Helper\WC\Order\Compatible;

use WPDesk\Compatibility\Helper\WC\Order\Compatible;

/**
 * Class WPDesk_Helpers_WC_Factory
 * @deprecated
 */
class Factory implements \WPDesk\Compatibility\Helper\WC\Order\HelperFactory
{
    /**
     * @param \WC_Order $order
     * @param $version
     *
     * @return Compatible
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