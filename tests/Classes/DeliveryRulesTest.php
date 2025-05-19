<?php

namespace Tests\Classes;

use App\Classes\DeliveryRules;
use PHPUnit\Framework\TestCase;

class DeliveryRulesTest extends TestCase
{
    private DeliveryRules $deliveryRules;

    protected function setUp(): void
    {
        $this->deliveryRules = new DeliveryRules();
    }
    public function testDeliveryCost()
    {
        $this->assertSame(0.0, $this->deliveryRules->getDeliveryCost(90.00));
        $this->assertSame(0.0, $this->deliveryRules->getDeliveryCost(100.00));
        $this->assertSame(2.95, $this->deliveryRules->getDeliveryCost(50.00));
        $this->assertSame(2.95, $this->deliveryRules->getDeliveryCost(75.00));
        $this->assertSame(4.95, $this->deliveryRules->getDeliveryCost(49.99));
        $this->assertSame(4.95, $this->deliveryRules->getDeliveryCost(0.00));
    }
}
