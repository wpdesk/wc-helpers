<?php

namespace WPDesk\WC\Helper\Product\Compatible;

use WPDesk\WC\Helper\Compatibility\MetaDataTrait\MetaDataTrait;
use WPDesk\WC\Helper\Product\ProductCompatible;

class LegacyV27 extends AbstractWrapper implements ProductCompatible
{
    use MetaDataTrait;

    public function __construct(\WC_Product $product)
    {
        parent::__construct($product);
        $this->post_id = static::get_product_id($product);
    }
}