<?php

namespace Tests\Classes;

use App\Classes\Products;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    public function testProductCreation()
    {
        $product = new Products('R01', 32.95);
        $this->assertEquals('R01', $product->getCode());
        $this->assertEquals(32.95, $product->getPrice());
    }
}
