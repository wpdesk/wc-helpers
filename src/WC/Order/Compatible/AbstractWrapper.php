<?php

namespace WPDesk\Compatibility\Helper\WC\Order\Compatible;

abstract class AbstractWrapper {
	/** @var \WC_Order */
	protected $order;

	/**
	 * @param $order
	 *
	 * @return int
	 */
	static function get_order_id($order) {
		return method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
	}

    /**
     * AbstractWrapper constructor.
     * @param \WC_Order $order
     */
	public function __construct( \WC_Order $order ) {
		$this->order = $order;
	}

}