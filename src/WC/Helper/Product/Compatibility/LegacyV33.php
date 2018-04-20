<?php

namespace WPDesk\WC\Helper\Product\Compatibility;

use WPDesk\WC\Helper\Product\ProductCompatible;

class LegacyV33 extends AbstractWrapper implements ProductCompatible
{
    public function save()
    {
        return $this->product->save();
    }

    public function get_post_data()
    {
        return $this->product->get_post_data();
    }

    public function get_id()
    {
        return $this->product->get_id();
    }

    public function get_parent_id($context = 'view')
    {
        return $this->product->get_parent_id($context);
    }

    public function get_stock_status($context = 'view')
    {
        return $this->product->get_stock_status($context);
    }


}