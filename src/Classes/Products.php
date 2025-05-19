<?php

namespace App\Classes;

class Products {
    private string $code;
    private float $price;

    public function __construct(string $code, float $price) {
        $this->code = $code;
        $this->price = $price;
    }

    /**
     * Get product code.
     *
     * @return string
     */
    public function getCode():string {
        return $this->code;
    }

    /**
     * Get product price.
     *
     * @return float
     */
    public function getPrice():float {
        return $this->price;
    }
}
