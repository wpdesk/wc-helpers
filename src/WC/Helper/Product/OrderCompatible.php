<?php

namespace WPDesk\WC\Helper\Product;

/**
 * Interface for Product as is in the latest WC 3.x version
 */
interface ProductCompatible
{
    /**
     * Save data to the database.
     *
     * @since 3.0.0
     * @return int order ID
     */
    public function save();
}