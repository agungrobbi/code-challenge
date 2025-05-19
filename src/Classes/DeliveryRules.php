<?php

namespace App\Classes;

use App\Interfaces\DeliveryRulesInterface;

class DeliveryRules implements DeliveryRulesInterface{
    /**
     * Get delivery cost from basket.
     *
     * @param float $subtotal
     * @return float
     */
    public function getDeliveryCost(float $subtotal): float
    {
        if ($subtotal >= 90) {
            return 0;
        }
        elseif ($subtotal >= 50) {
            return 2.95;
        }
        else {
            return 4.95;
        }
    }
}
