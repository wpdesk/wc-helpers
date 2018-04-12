<?php

interface WPDesk_Helpers_WC_Factory_Interface {
	/**
	 * @param WC_Order $order
	 * @param $version
	 *
	 * @return WPDesk_Helpers_WC_Order_Interface
	 */
	public function create_order_helper( WC_Order $order, $version = WC_VERSION );
}