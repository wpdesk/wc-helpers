<?php

namespace WPDesk\WC\Helper\Compatibility;

class HelperFactoryLastest implements HelperFactory
{
    public function create_product_helper(\WC_Product $product)
    {
        return new \WPDesk\WC\Helper\Product\Compatible\Latest($product);
    }

    public function create_order_helper(\WC_Order $order)
    {
        return new \WPDesk\WC\Helper\Order\Compatible\Latest($order);
    }
}