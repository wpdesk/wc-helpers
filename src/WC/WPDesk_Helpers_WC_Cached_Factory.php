<?php

class WPDesk_Helpers_WC_Factory implements WPDesk_Helpers_WC_Factory_Interface {
	/** @var WPDesk_Helpers_WC_Factory_Interface */
	private $factory;

	/** @var array */
	static $cache = [];

	public function __construct( WPDesk_Helpers_WC_Factory_Interface $factory ) {
		$this->factory = $factory;
	}

	/**
	 * @param int $id
	 *
	 * @return bool
	 */
	private function has_cached_order( $id ) {
		return isset( self::$cache[ $id ] );
	}

	/**
	 * @param WPDesk_Helpers_WC_Order_Interface $order
	 */
	private function set_cache_order( WPDesk_Helpers_WC_Order_Interface $order ) {
		$id = $order->get_id();
		if ( ! empty( $id ) ) {
			self::$cache[ $id ] = $order;
		}

	}

	/**
	 * @param int $id
	 *
	 * @return WPDesk_Helpers_WC_Order_Interface
	 */
	private function get_cache_order( $id ) {
		return self::$cache[ $id ];
	}

	/**
	 * @param WC_Order $order
	 * @param $version
	 *
	 * @return WPDesk_Helpers_WC_Order_Interface
	 */
	public function create_order_helper( WC_Order $order, $version = WC_VERSION ) {
		$id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

		if ( $this->has_cached_order( $id ) ) {
			return $this->get_cache_order( $id );
		} else {
			$order = $this->factory->create_order_helper( $order, $version );
			$this->set_cache_order( $order );

			return $order;
		}
	}
}