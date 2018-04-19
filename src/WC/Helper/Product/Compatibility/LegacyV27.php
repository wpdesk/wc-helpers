<?php

namespace WPDesk\WC\Helper\Product\Compatible;

use WPDesk\WC\Helper\Compatibility\Traits\PostMetaDataManagement;
use WPDesk\WC\Helper\Product\ProductCompatible;

class LegacyV27 extends AbstractWrapper implements ProductCompatible
{
    use PostMetaDataManagement;

    const META_NAME_PARENT_ID = '_parent_id';
    const META_NAME_STOCK_STATUS = '_stock_status';

    public function __construct(\WC_Product $product)
    {
        parent::__construct($product);
        $this->post_id = static::get_product_id($product);
    }

    public function get_post_data()
    {
        if ( $this->product->is_type( 'variation' ) ) {
            $post_data = get_post( $this->get_parent_id() );
        } else {
            $post_data = get_post( $this->get_id() );
        }
        return $post_data;
    }

    public function get_id()
    {
        return parent::get_product_id($this->product);
    }

    public function get_parent_id($context = 'view')
    {
        return $this->get_post_meta(self::META_NAME_PARENT_ID, true);
    }

    public function get_stock_status( $context = 'view' ) {
        return $this->get_post_meta(self::META_NAME_STOCK_STATUS, true);
    }


}