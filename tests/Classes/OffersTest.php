<?php

namespace Tests\Classes;

use App\Classes\Offers;
use App\Classes\Products;
use PHPUnit\Framework\TestCase;

class OffersTest extends TestCase
{
    private Offers $offers;

    protected function setUp(): void
    {
        $this->offers = new Offers();
        $this->offers->setBuyOneGetOneAsHalf('R01');
    }

    public function testCountTotalOffers()
    {
        $products = [
            new Products('R01', 32.95),
            new Products('R01', 32.95),
            new Products('G01', 24.95)
        ];

        $this->assertEquals(16.475, $this->offers->countTotalOffers($products));
    }

    public function testNoDiscountForSingleProduct()
    {
        $products = [new Products('R01', 32.95)];
        $this->assertEquals(0.00, $this->offers->countTotalOffers($products));
    }

    public function testMultipleDiscounts()
    {
        $products = array_fill(0, 4, new Products('R01', 32.95));
        $this->assertEquals(32.95, $this->offers->countTotalOffers($products));
    }
}
