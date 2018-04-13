<?php

namespace WPDesk\Compatibility\Helper\WC\Order;

interface HelperFactory {
	/**
	 * @param \WC_Order $order
	 * @param int $version
	 */
	public function create_helper( \WC_Order $order, $version );
}