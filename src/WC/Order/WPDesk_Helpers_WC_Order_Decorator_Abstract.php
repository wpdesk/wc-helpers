<?php

class WPDesk_Helpers_WC_Order_Decorator_Abstract {
	/** @var WC_Order */
	protected $order;

	/**
	 * @param $order
	 *
	 * @return int
	 */
	static function get_order_id($order) {
		return method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
	}

	public function __construct( WC_Order $order ) {
		$this->order = $order;
	}

}