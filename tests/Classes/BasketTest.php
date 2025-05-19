<?php

namespace Tests\Classes;

use App\Classes\Basket;
use App\Classes\Products;
use App\Classes\DeliveryRules;
use App\Classes\Offers;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private array $catalog;
    private DeliveryRules $deliveryRules;
    private Offers $offers;

    protected function setUp(): void
    {
        $this->catalog = [
            new Products('R01', 32.95),
            new Products('G01', 24.95),
            new Products('B01', 7.95)
        ];

        $this->deliveryRules = new DeliveryRules();
        $this->offers = new Offers();
        $this->offers->setBuyOneGetOneAsHalf('R01');
    }

    public function testAddProduct()
    {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offers);
        $basket->add('R01');

        $this->expectNotToPerformAssertions(); // Just testing it doesn't throw
    }

    public function testAddInvalidProduct()
    {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offers);

        $this->expectException(\InvalidArgumentException::class);
        $basket->add('INVALID');
    }

    public function testTotalWithDelivery()
    {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offers);
        $basket->add('B01');
        $basket->add('G01');

        $this->assertEquals(37.85, $basket->total());
    }

    public function testTotalWithOffer()
    {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(54.37, $basket->total());
    }

    public function testComplexBasket()
    {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offers);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');

        $this->assertEquals(98.27, $basket->total());
    }
}
