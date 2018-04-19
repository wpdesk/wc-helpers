<?php

namespace WPDesk\WC\Helper\Compatibility;

class HelperFactoryLegacyV27 implements HelperFactory
{
    public function create_product_helper(\WC_Product $product)
    {
        return new \WPDesk\WC\Helper\Product\Compatible\LegacyV27($product);
    }

    public function create_order_helper(\WC_Order $order)
    {
        return new \WPDesk\WC\Helper\Order\Compatible\LegacyV27($order);
    }
}