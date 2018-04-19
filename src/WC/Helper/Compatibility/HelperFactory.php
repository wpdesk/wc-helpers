<?php

namespace WPDesk\WC\Helper\Compatibility;

interface HelperFactory
{
    public function create_product_helper( \WC_Product $product );
    public function create_order_helper( \WC_Order $order );
}