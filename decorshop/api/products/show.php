<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_product.php';
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $product = find_product($productId);
    echo json_encode($product);
}