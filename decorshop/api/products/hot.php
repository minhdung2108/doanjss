<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_product.php';
$productList = get_hot_products();
echo json_encode($productList);