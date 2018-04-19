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

    /**
     * Get the product's post data.
     *
     * @deprecated 3.0.0
     * @return \WP_Post
     */
    public function get_post_data();

    /**
     * Returns the unique ID for this object.
     *
     * @since  2.6.0
     * @return int
     */
    public function get_id();

    /**
     * Get parent ID.
     *
     * @since 3.0.0
     * @param  string $context What the value is for. Valid values are view and edit.
     * @return int
     */
    public function get_parent_id($context = 'view');

    /**
     * Return the stock status.
     *
     * @param  string $context What the value is for. Valid values are view and edit.
     * @since 3.0.0
     * @return string
     */
    public function get_stock_status( $context = 'view' );
}