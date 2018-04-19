<?php

namespace WPDesk\WC\Helper\Product\Compatible;

use WPDesk\WC\Helper\Product\ProductCompatible;

class Latest extends AbstractWrapper implements ProductCompatible
{
    public function save()
    {
        return $this->product->save();
    }

}