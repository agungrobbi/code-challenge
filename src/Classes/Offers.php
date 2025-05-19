<?php

namespace App\Classes;

use App\Interfaces\OffersInterface;

class Offers implements OffersInterface {
    private string $buyOneGetOneAsHalfProduct;
    private float $discount = 0;

    /**
     * Set product that have buy one get another half price.
     *
     * @param string $product
     * @return string
     */
    public function setBuyOneGetOneAsHalf(string $product): string {
        return $this->buyOneGetOneAsHalfProduct = $product;
    }

    /**
     * Get product with buy one get another half price.
     *
     * @param array $products
     */
    public function getBuyOneGetOneAsHalf(array $products) {
        if ($this->buyOneGetOneAsHalfProduct) {
            $filteredProducts = array_filter($products, function($product) {
                return $product->getCode() === $this->buyOneGetOneAsHalfProduct;
            });

            $productsCount = count($filteredProducts);
            $product = current($filteredProducts);

            $pairs = floor($productsCount / 2);
            if ($pairs > 0) {
                $this->discount = $pairs * ($product->getPrice() / 2);
            }
        }
    }

    /**
     * Count total offers.
     *
     * @param array $products
     * @return float
     */
    public function countTotalOffers(array $products): float {
        // Reset discount value for each call.
        $this->discount = 0;

        $this->getBuyOneGetOneAsHalf($products);
        return $this->discount;
    }
}
