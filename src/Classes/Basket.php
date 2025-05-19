<?php

namespace App\Classes;

use App\Interfaces\DeliveryRulesInterface;

class Basket {
    private array $catalog = [];
    private array $products = [];
    private DeliveryRulesInterface $deliveryRule;
    private object $offers;

    public function __construct (array $catalog, DeliveryRulesInterface $deliveryRule, object $offers) {
        $this->catalog = $catalog;
        $this->deliveryRule = $deliveryRule;
        $this->offers = $offers;
    }

    /**
     * Add product into basket.
     *
     * @param string $productCode
     * @return void
     */
    public function add(string $productCode) {
        foreach ($this->catalog as $product) {
            if ($product->getCode() === $productCode) {
                $this->products[] = $product;
                return;
            }
        }

        throw new \InvalidArgumentException("Product {$productCode} not found.");
    }

    /**
     * Count basket total.
     *
     * @return float
     */
    public function total(): float {
        $subtotal = array_reduce($this->products, function($carry, $product) {
            return $carry + $product->getPrice();
        }, 0);

        $discount = $this->offers->countTotalOffers($this->products);
        $deliveryCost = $this->deliveryRule->getDeliveryCost($subtotal - $discount);

        return round($subtotal - $discount + $deliveryCost, 2);

    }
}
