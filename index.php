<?php
// Composer autoload.
require __DIR__ . '/vendor/autoload.php';

// Load required classes.
use App\Classes\Products;
use App\Classes\DeliveryRules;
use App\Classes\Offers;
use App\Classes\Basket;

// Product catalog.
$catalog = [
    new Products('R01', 32.95),
    new Products('G01', 24.95),
    new Products('B01', 7.95)
];

// Set up delivery rule.
$deliveryRule = new DeliveryRules();

// Setup buy one get another as half price.
$offers = new Offers();
$offers->setBuyOneGetOneAsHalf('R01');

// ===== Example 1
// Create basket
$basket1 = new Basket($catalog, $deliveryRule, $offers);

// Add products
$basket1->add('B01');
$basket1->add('G01');
// ===== Example 1

// ===== Example 2
// Create basket
$basket2 = new Basket($catalog, $deliveryRule, $offers);

// Add products
$basket2->add('R01');
$basket2->add('R01');
// ===== Example 2

// ===== Example 3
// Create basket
$basket3 = new Basket($catalog, $deliveryRule, $offers);

// Add products
$basket3->add('R01');
$basket3->add('G01');
// ===== Example 3

// ===== Example 4
// Create basket
$basket4 = new Basket($catalog, $deliveryRule, $offers);

// Add products
$basket4->add('B01');
$basket4->add('B01');
$basket4->add('R01');
$basket4->add('R01');
$basket4->add('R01');
// ===== Example 4

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Challenge</title>
    <style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2;}

    tr:hover {background-color: #ddd;}

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
    </style>
</head>
<body>
    <h1>Code Challenge</h1>
    <table>
        <thead>
            <tr>
                <th>Products</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>B01, G01</td>
                <td>$<?php echo $basket1->total() ?></td>
            </tr>
            <tr>
                <td>R01, R01</td>
                <td>$<?php echo $basket2->total() ?></td>
            </tr>
            <tr>
                <td>R01, G01</td>
                <td>$<?php echo $basket3->total() ?></td>
            </tr>
            <tr>
                <td>B01, B01, R01, R01, R01</td>
                <td>$<?php echo $basket4->total() ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
