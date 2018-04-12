<?php

class WPDesk_Helpers_WC_Cached_Factory implements WPDesk_Helpers_WC_Factory_Interface, \PSR\SimpleCache\CacheInterface {
	/** @var array */
	static $cache = [];
	/** @var WPDesk_Helpers_WC_Factory_Interface */
	private $factory;

	public function __construct( WPDesk_Helpers_WC_Factory_Interface $factory ) {
		$this->factory = $factory;
	}

	/**
	 * @param iterable $keys
	 * @param null $default
	 *
	 * @return Generator|iterable
	 */
	public function getMultiple( $keys, $default = null ) {
		foreach ( $keys as $key ) {
			yield $this->get( $key, $default );
		}
	}

	/**
	 * @param string $key
	 * @param null $default
	 *
	 * @return mixed|null
	 */
	public function get( $key, $default = null ) {
		if ( $this->has( $key ) ) {
			return self::$cache[ $key ];
		} else {
			return $default;
		}
	}

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	public function has( $key ) {
		return isset( self::$cache[ $key ] );
	}

	/**
	 * @param iterable $values
	 * @param int $ttl
	 *
	 * @return bool
	 */
	public function setMultiple( $values, $ttl = null ) {
		foreach ( $values as $key => $value ) {
			$this->set( $key, $value, $ttl );
		}

		return true;
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 * @param int $ttl
	 *
	 * @return bool
	 */
	public function set( $key, $value, $ttl = null ) {
		if ( ! empty( $key ) ) {
			self::$cache[ $key ] = $value;
		}

		return true;
	}

	/**
	 * @param iterable $keys
	 *
	 * @return bool
	 */
	public function deleteMultiple( $keys ) {
		foreach ( $keys as $key ) {
			$this->delete( $key );
		}

		return true;
	}

	/**
	 * @param string $key
	 *
	 * @return bool|void
	 */
	public function delete( $key ) {
		unset( self::$cache[ $key ] );
	}

	/**
	 * @return bool
	 */
	public function clear() {
		self::$cache = [];

		return true;
	}

	/**
	 * @param WC_Order $order
	 * @param $version
	 *
	 * @return WPDesk_Helpers_WC_Order_Interface
	 */
	public function create_order_helper( WC_Order $order, $version = WC_VERSION ) {
		$id = WPDesk_Helpers_WC_Order_Decorator_Abstract::get_order_id( $order );

		if ( $this->has( $id ) ) {
			return $this->get( $id );
		} else {
			$order = $this->factory->create_order_helper( $order, $version );
			$this->set( $id, $order );

			return $order;
		}
	}
}