
# Acme Widget Co

![PHP](https://img.shields.io/badge/PHP-8.0%2B-blue)
![PHPUnit](https://img.shields.io/badge/PHPUnit-11.5-green)
![PHPStan](https://img.shields.io/badge/PHPStan-Level%205-blueviolet)

## Requirements

 1.  **Product Catalog**
     -  Red Widget (R01): \$32.95
     -  Green Widget (G01): \$24.95
     -  Blue Widget (B01): \$7.95

 2. **Delivery Rules**
    - Orders ≥ \$90: Free
    - Orders ≥ \$50 and < \$90: \$2.95
    - Orders < \$50: \$4.95

 2. **Special Offers**
    - Buy 1 Red Widget, get 2nd half price

## How It Works

### Assumptions

 1. **Product Catalog**
    - Products won't change mid-calculation
    - Product code are case-sensitive (`'R01' ≠ 'r01'`)

 2. **Offers System**
    - Only one active offer type supported (but extendable via `OffersInterface`)
    - Half price discount applied to same product in pairs

1. **Rounding**
   - Uses `PHP_ROUND_HALF_DOWN` for financial rounding
   - Example: `98.275 → $98.27` (not $98.28)

2. **Error Handling**
   - Throws `InvalidArgumentException` for unknown product codes
   - No silent failures (all type checks are strict)


### Example Scenarios

| Products               | Calculation Steps                     | Total  |
|------------------------|---------------------------------------|--------|
| B01, G01               | (7.95 + 24.95) + 4.95 delivery        | $37.85 |
| R01, R01               | (32.95 + 16.48 discount) + 4.95       | $54.37 |
| R01, G01               | (32.95 + 24.95) + 2.95 delivery       | $60.85 |
| B01, B01, R01, R01, R01| (7.95*2 + 32.95*3 - 16.48) + 0 delivery | $98.27 |


### Core Components

1. **Product Catalog**
   - Immutable `Products` objects store:
     ```php
     $product = new Products('R01', 32.95) // Code + Price
     ```
   - Accessed via `$product->getCode()` and `$product->getPrice()`

2. **Delivery Rules**
   - Tiered Pricing:
     ```php
     public function getDeliveryCost(float $subtotal): float {
         if ($subtotal >= 90) return 0;
         elseif ($subtotal >= 50) return 2.95;
         else return 4.95;
     }
     ```
   - *Uses pre-discount subtotal* (per requirements)

3. **Special Offers**
   - Buy 1 Get 2nd Half Price:
     ```php
     $offers->setBuyOneGetOneAsHalf('R01');
     ```
   - Counts pairs and applies 50% discount to every second item

4. **Basket Workflow**
   ```php
   $basket = new Basket($catalog, $deliveryRules, $offers);
   $basket->add('R01'); // Add by product code
   $total = $basket->total(); // Calculate final price
   ```

5. **Total Calculation**
   The `total()` method:
   - Sums product prices → **Subtotal**
   - Applies offers → **Discount**
   - Calculates delivery → **Shipping**
   - Returns: `(Subtotal - Discount) + Shipping`

## Installation

1. Clone repository:
   ```bash
   git clone https://github.com/agungrobbi/code-challenge.git
   cd code-challenge
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

## Testing

1. Run unit tests:
    ```bash
    composer run test
    ```

2. Run phpstan analysis:
    ```bash
    composer run analyse
    ```
