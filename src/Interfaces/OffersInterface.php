<?php

namespace App\Interfaces;

interface OffersInterface {
    public function setBuyOneGetOneAsHalf(string $product): string;
    public function getBuyOneGetOneAsHalf(array $products);
    public function countTotalOffers(array $products): float;
}
