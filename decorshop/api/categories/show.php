<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_product.php';

if(isset($_GET['categoryId'])){
    $categoryId = $_GET['categoryId'];
    $productList = get_products_by_category($categoryId);    
    echo json_encode($productList);
}