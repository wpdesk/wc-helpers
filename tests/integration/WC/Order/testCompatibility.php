<?php


use WPDesk\WC\Helper\Compatibility\HelperFactory;
use WPDesk\WC\Helper\Factory;
use WPDesk\WC\Helper\Order\Compatibility\AbstractWrapper;
use WPDesk\WC\Helper\Order\OrderCompatible;

class testOrderCompatibility extends WP_UnitTestCase
{

    private $testValues = [];

    /** @var \WC_Order */
    private $order;

    /** @var OrderCompatible */
    private $orderHelper;

    /** @var HelperFactory */
    private $compatibilityFactory;

    public function setUp()
    {
    	$date_paid = new \WC_DateTime('2017-01-01');
	    $date_completed = new \WC_DateTime('2017-01-02');
        $whatever         = 1;
        $this->testValues = [
            'billing_first_name'   => $whatever++,
            'billing_last_name'    => $whatever++,
            'billing_company'      => $whatever++,
            'billing_address_1'    => $whatever++,
            'billing_address_2'    => $whatever++,
            'billing_city'         => $whatever++,
            'billing_state'        => $whatever++,
            'billing_postcode'     => $whatever++,
            'billing_country'      => $whatever++,
            'billing_email'        => 'some@address.com',
            'billing_phone'        => $whatever++,
            'shipping_first_name'  => $whatever++,
            'shipping_last_name'   => $whatever++,
            'shipping_company'     => $whatever++,
            'shipping_address_1'   => $whatever++,
            'shipping_address_2'   => $whatever++,
            'shipping_city'        => $whatever++,
            'shipping_state'       => $whatever++,
            'shipping_postcode'    => $whatever++,
            'shipping_country'     => $whatever++,
            'payment_method'       => $whatever++,
            'payment_method_title' => $whatever++,
            'transaction_id'       => $whatever++,
            'customer_ip_address'  => $whatever++,
            'customer_user_agent'  => $whatever++,
            'created_via'          => $whatever++,
            'customer_note'        => $whatever++,
            'date_completed'       => $date_completed,
            'date_paid'            => $date_paid,
            'cart_hash'            => $whatever++,
            'order_key'            => $whatever++,
            'customer_id'          => $whatever,
            'status'               => 'processing'
        ];

        $this->order = $order = WC_Helper_Order::create_order(1);

        $this->compatibilityFactory = $factory = Factory::create_compatibility_helper_factory();
        $this->orderHelper          = $factory->create_order_helper($order);
    }

    public function test_wc_order_compatibility_getters()
    {
        $this->set_all_setters($this->orderHelper, $this->testValues);
        $this->assert_all_getters($this->orderHelper, $this->testValues);
    }

    public function test_wc_order_compatibility_getters_after_save()
    {
        $this->set_all_setters($this->orderHelper, $this->testValues);
        $this->orderHelper->save();

        $orderAfterSave       = wc_get_order($this->orderHelper->get_id());
        $orderHelperAfterSave = $this->compatibilityFactory->create_order_helper($orderAfterSave);
        $this->assert_all_getters($orderHelperAfterSave, $this->testValues);
    }

    public function test_wc_order_compatibility_id()
    {
        $this->assertEquals(AbstractWrapper::get_order_id($this->order), $this->orderHelper->get_id(),
            'Id\s should be equal');
    }

    /**
     * @param OrderCompatible $order
     * @param array $testValues
     */
    private function set_all_setters(OrderCompatible $order, $testValues)
    {
        foreach ($testValues as $key => $value) {
            $setterMethod = 'set_' . $key;
            $order->{$setterMethod}($value);
        }
    }

    /**
     * @param OrderCompatible $order
     * @param array $testValues
     */
    private function assert_all_getters(OrderCompatible $order, $testValues)
    {

        foreach ($testValues as $key => $value) {
            $getterMethod = 'get_' . $key;
            $valueFromOrder = $order->{$getterMethod}();
            $this->assertEquals($value, $order->{$getterMethod}(), "Invalid get value for {$getterMethod}");
        }
    }
}