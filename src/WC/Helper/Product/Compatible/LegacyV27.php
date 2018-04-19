<?php

namespace WPDesk\WC\Helper\Product\Compatible;

use WPDesk\WC\Helper\Product\ProductCompatible;

class LegacyV27 extends AbstractWrapper implements ProductCompatible
{
    /** @var int */
    private $product_id;

    /** @var array */
    private $meta_data = [];

    public function __construct(\WC_Product $product)
    {
        parent::__construct($product);
        $this->product_id = static::get_product_id($product);
    }

    /**
     * Save data to the database.
     *
     * @return int order ID
     */
    public function save()
    {
        foreach ($this->meta_data as $name => $value) {
            update_post_meta($this->product_id, $name, $value);
        }

        return $this->product_id;
    }
}