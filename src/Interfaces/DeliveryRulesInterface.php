<?php

namespace App\Interfaces;

interface DeliveryRulesInterface {
    public function getDeliveryCost(float $subtotal): float;
}
