<?php


use WPDesk\WC\Helper\Factory;
use WPDesk\WC\Helper\Product\Compatibility\AbstractWrapper;

class testProductCompatibility extends WP_UnitTestCase {
    public function test_wc_product_compatibility_id()
    {
        $product = WC_Helper_Product::create_simple_product();

        $compatibilityFactory = Factory::create_compatibility_helper_factory();
        $this->productHelper  = $compatibilityFactory->create_product_helper($product);

        $this->assertEquals(AbstractWrapper::get_product_id($product), $this->productHelper->get_id(),
            'Id\s should be equal');
    }
}