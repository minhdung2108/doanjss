<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_product.php';

if(isset($_GET['key'])){
    $key = $_GET['key'];
    $productList = find_product_by_name($key);    
    echo json_encode($productList);
}