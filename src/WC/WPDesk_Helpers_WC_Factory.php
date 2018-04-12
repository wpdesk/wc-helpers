<?php

class WPDesk_Helpers_WC_Factory implements WPDesk_Helpers_WC_Factory_Interface {
	/**
	 * @param WC_Order $order
	 * @param $version
	 *
	 * @return WPDesk_Helpers_WC_Order_Interface
	 */
	public function create_order_helper( WC_Order $order, $version = WC_VERSION ) {
		if ( version_compare( $version, '2.7', '<' ) ) {
			return new WPDesk_Helpers_WC_Order_LegacyV27( $order );
		} else {
			return new WPDesk_Helpers_WC_Order_Latest( $order );
		}
	}
}