<?php

namespace WPDesk\WC\Helper\Compatibility\MetaDataTrait;

trait MetaDataTrait
{
    /** @var int */
    protected $post_id;

    /** @var array */
    protected $meta_data = [];

    /**
     * Save data to the database.
     *
     * @return int order ID
     */
    public function save()
    {
        foreach ($this->meta_data as $name => $value) {
            update_post_meta($this->post_id, $name, $value);
        }

        return $this->post_id;
    }

    /**
     * @param string $meta_key
     * @param bool $single
     *
     * @return mixed
     */
    protected function get_post_meta($meta_key, $single = false)
    {
        switch ($meta_key) {
            case 'order_date':
                return $this->order->order_date;
            case 'customer_note':
                return $this->order->customer_note;
            default:
                return get_post_meta($this->post_id, $meta_key, $single);
        }
    }

    /**
     * @param string $name
     * @param string $value
     */
    protected function set_post_meta($name, $value)
    {
        $this->meta_data[$name] = $value;
        return true;
    }
}