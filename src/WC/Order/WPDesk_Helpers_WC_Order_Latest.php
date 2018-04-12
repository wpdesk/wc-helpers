<?php

class WPDesk_Helpers_WC_Order_Latest implements WPDesk_Helpers_WC_Order_Interface {
	/** @var WC_Order */
	private $order;

	public function __construct( WC_Order $order ) {
		$this->order = $order;
	}

	public function save() {
		$this->order->save();
	}

	public function set_status( $new_status, $note = '', $manual_update = false ) {
		$this->order->set_status( $new_status, $note, $manual_update );
	}

	public function update_status( $new_status, $note = '', $manual = false ) {
		$this->order->update_status( $new_status, $note, $manual );
	}

	public function get_order_number() {
		$this->order->get_order_number();
	}

	public function get_order_key( $context = 'view' ) {
		$this->order->get_order_key( $context );
	}

	public function get_customer_id( $context = 'view' ) {
		$this->order->get_customer_id( $context );
	}

	public function get_user_id( $context = 'view' ) {
		$this->order->get_user_id( $context );
	}

	public function get_user() {
		$this->order->get_user();
	}

	public function get_billing_first_name( $context = 'view' ) {
		$this->order->get_billing_first_name( $context );
	}

	public function get_billing_last_name( $context = 'view' ) {
		$this->order->get_billing_last_name( $context );
	}

	public function get_billing_company( $context = 'view' ) {
		$this->order->get_billing_company( $context );
	}

	public function get_billing_address_1( $context = 'view' ) {
		$this->order->get_billing_address_1( $context );
	}

	public function get_billing_address_2( $context = 'view' ) {
		$this->order->get_billing_address_2( $context );
	}

	public function get_billing_city( $context = 'view' ) {
		$this->order->get_billing_city( $context );
	}

	public function get_billing_state( $context = 'view' ) {
		$this->order->get_billing_state( $context );
	}

	public function get_billing_postcode( $context = 'view' ) {
		$this->order->get_billing_postcode( $context );
	}

	public function get_billing_country( $context = 'view' ) {
		$this->order->get_billing_country( $context );
	}

	public function get_billing_email( $context = 'view' ) {
		$this->order->get_billing_email( $context );
	}

	public function get_billing_phone( $context = 'view' ) {
		$this->order->get_billing_phone( $context );
	}

	public function get_shipping_first_name( $context = 'view' ) {
		$this->order->get_shipping_first_name( $context );
	}

	public function get_shipping_last_name( $context = 'view' ) {
		$this->order->get_shipping_last_name( $context );
	}

	public function get_shipping_company( $context = 'view' ) {
		$this->order->get_shipping_company( $context );
	}

	public function get_shipping_address_1( $context = 'view' ) {
		$this->order->get_shipping_address_1( $context );
	}

	public function get_shipping_address_2( $context = 'view' ) {
		$this->order->get_shipping_address_2( $context );
	}

	public function get_shipping_city( $context = 'view' ) {
		$this->order->get_shipping_city( $context );
	}

	public function get_shipping_state( $context = 'view' ) {
		$this->order->get_shipping_state( $context );
	}

	public function get_shipping_postcode( $context = 'view' ) {
		$this->order->get_shipping_postcode( $context );
	}

	public function get_shipping_country( $context = 'view' ) {
		$this->order->get_shipping_country( $context );
	}

	public function get_payment_method( $context = 'view' ) {
		$this->order->get_payment_method( $context );
	}

	public function get_payment_method_title( $context = 'view' ) {
		$this->order->get_payment_method_title( $context );
	}

	public function get_transaction_id( $context = 'view' ) {
		$this->order->get_transaction_id( $context );
	}

	public function get_customer_ip_address( $context = 'view' ) {
		$this->order->get_customer_ip_address( $context );
	}

	public function get_customer_user_agent( $context = 'view' ) {
		$this->order->get_customer_user_agent( $context );
	}

	public function get_created_via( $context = 'view' ) {
		$this->order->get_created_via( $context );
	}

	public function get_customer_note( $context = 'view' ) {
		$this->order->get_customer_note( $context );
	}

	public function get_date_completed( $context = 'view' ) {
		$this->order->get_date_completed( $context );
	}

	public function get_date_paid( $context = 'view' ) {
		$this->order->get_date_paid( $context );
	}

	public function get_cart_hash( $context = 'view' ) {
		$this->order->get_cart_hash( $context );
	}

	public function get_address( $type = 'billing' ) {
		$this->order->get_address( $type );
	}

	public function get_shipping_address_map_url() {
		$this->order->get_shipping_address_map_url();
	}

	public function get_formatted_billing_full_name() {
		$this->order->get_formatted_billing_full_name();
	}

	public function get_formatted_shipping_full_name() {
		$this->order->get_formatted_shipping_full_name();
	}

	public function get_formatted_billing_address( $empty_content = '' ) {
		$this->order->get_formatted_billing_address( $empty_content );
	}

	public function get_formatted_shipping_address( $empty_content = '' ) {
		$this->order->get_formatted_shipping_address( $empty_content );
	}

	public function has_billing_address() {
		$this->order->has_billing_address();
	}

	public function has_shipping_address() {
		$this->order->has_shipping_address();
	}

	public function set_order_key( $value ) {
		$this->order->set_order_key( $value );
	}

	public function set_customer_id( $value ) {
		$this->order->set_customer_id( $value );
	}

	public function set_billing_first_name( $value ) {
		$this->order->set_billing_first_name( $value );
	}

	public function set_billing_last_name( $value ) {
		$this->order->set_billing_last_name( $value );
	}

	public function set_billing_company( $value ) {
		$this->order->set_billing_company( $value );
	}

	public function set_billing_address_1( $value ) {
		$this->order->set_billing_address_1( $value );
	}

	public function set_billing_address_2( $value ) {
		$this->order->set_billing_address_2( $value );
	}

	public function set_billing_city( $value ) {
		$this->order->set_billing_city( $value );
	}

	public function set_billing_state( $value ) {
		$this->order->set_billing_state( $value );
	}

	public function set_billing_postcode( $value ) {
		$this->order->set_billing_postcode( $value );
	}

	public function set_billing_country( $value ) {
		$this->order->set_billing_country( $value );
	}

	public function set_billing_email( $value ) {
		$this->order->set_billing_email( $value );
	}

	public function set_billing_phone( $value ) {
		$this->order->set_billing_phone( $value );
	}

	public function set_shipping_first_name( $value ) {
		$this->order->set_shipping_first_name( $value );
	}

	public function set_shipping_last_name( $value ) {
		$this->order->set_shipping_last_name( $value );
	}

	public function set_shipping_company( $value ) {
		$this->order->set_shipping_company( $value );
	}

	public function set_shipping_address_1( $value ) {
		$this->order->set_shipping_address_1( $value );
	}

	public function set_shipping_address_2( $value ) {
		$this->order->set_shipping_address_2( $value );
	}

	public function set_shipping_city( $value ) {
		$this->order->set_shipping_city( $value );
	}

	public function set_shipping_state( $value ) {
		$this->order->set_shipping_state( $value );
	}

	public function set_shipping_postcode( $value ) {
		$this->order->set_shipping_postcode( $value );
	}

	public function set_shipping_country( $value ) {
		$this->order->set_shipping_country( $value );
	}

	public function set_payment_method( $payment_method = '' ) {
		$this->order->set_payment_method( $payment_method );
	}

	public function set_payment_method_title( $value ) {
		$this->order->set_payment_method_title( $value );
	}

	public function set_transaction_id( $value ) {
		$this->order->set_transaction_id( $value );
	}

	public function set_customer_ip_address( $value ) {
		$this->order->set_customer_ip_address( $value );
	}

	public function set_customer_user_agent( $value ) {
		$this->order->set_customer_user_agent( $value );
	}

	public function set_created_via( $value ) {
		$this->order->set_created_via( $value );
	}

	public function set_customer_note( $value ) {
		$this->order->set_customer_note( $value );
	}

	public function set_date_completed( $date = null ) {
		$this->order->set_date_completed( $date );
	}

	public function set_date_paid( $date = null ) {
		$this->order->set_date_paid( $date );
	}

	public function set_cart_hash( $value ) {
		$this->order->set_cart_hash( $value );
	}

	public function key_is_valid( $key ) {
		$this->order->key_is_valid( $key );
	}

	public function has_cart_hash( $cart_hash = '' ) {
		$this->order->has_cart_hash( $cart_hash );
	}

	public function is_editable() {
		$this->order->is_editable();
	}

	public function is_paid() {
		$this->order->is_paid();
	}

	public function is_download_permitted() {
		$this->order->is_download_permitted();
	}

	public function needs_shipping_address() {
		$this->order->needs_shipping_address();
	}

	public function has_downloadable_item() {
		$this->order->has_downloadable_item();
	}

	public function get_downloadable_items() {
		$this->order->get_downloadable_items();
	}

	public function needs_payment() {
		$this->order->needs_payment();
	}

	public function needs_processing() {
		$this->order->needs_processing();
	}

	public function get_checkout_payment_url( $on_checkout = false ) {
		$this->order->get_checkout_payment_url( $on_checkout );
	}

	public function get_checkout_order_received_url() {
		$this->order->get_checkout_order_received_url();
	}

	public function get_cancel_order_url( $redirect = '' ) {
		$this->order->get_cancel_order_url( $redirect );
	}

	public function get_cancel_order_url_raw( $redirect = '' ) {
		$this->order->get_cancel_order_url_raw( $redirect );
	}

	public function get_cancel_endpoint() {
		$this->order->get_cancel_endpoint();
	}

	public function get_view_order_url() {
		$this->order->get_view_order_url();
	}

	public function get_edit_order_url() {
		$this->order->get_edit_order_url();
	}

	public function add_order_note( $note, $is_customer_note = 0, $added_by_user = false ) {
		$this->order->add_order_note( $note, $is_customer_note, $added_by_user );
	}

	public function get_customer_order_notes() {
		$this->order->get_customer_order_notes();
	}

	public function get_refunds() {
		$this->order->get_refunds();
	}

	public function get_total_refunded() {
		$this->order->get_total_refunded();
	}

	public function get_total_tax_refunded() {
		$this->order->get_total_tax_refunded();
	}

	public function get_total_shipping_refunded() {
		$this->order->get_total_shipping_refunded();
	}

	public function get_item_count_refunded( $item_type = '' ) {
		$this->order->get_item_count_refunded( $item_type );
	}

	public function get_total_qty_refunded( $item_type = 'line_item' ) {
		$this->order->get_total_qty_refunded( $item_type );
	}

	public function get_qty_refunded_for_item( $item_id, $item_type = 'line_item' ) {
		$this->order->get_qty_refunded_for_item( $item_id, $item_type );
	}

	public function get_total_refunded_for_item( $item_id, $item_type = 'line_item' ) {
		$this->order->get_total_refunded_for_item( $item_id, $item_type );
	}

	public function get_tax_refunded_for_item( $item_id, $tax_id, $item_type = 'line_item' ) {
		$this->order->get_tax_refunded_for_item( $item_id, $tax_id, $item_type );
	}

	public function get_total_tax_refunded_by_rate_id( $rate_id ) {
		$this->order->get_total_tax_refunded_by_rate_id( $rate_id );
	}

	public function get_remaining_refund_amount() {
		$this->order->get_remaining_refund_amount();
	}

	public function get_remaining_refund_items() {
		$this->order->get_remaining_refund_items();
	}

	public function get_order_item_totals( $tax_display = '' ) {
		$this->order->get_order_item_totals( $tax_display );
	}


}