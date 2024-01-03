<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_category.php';

$categoryList = get_all_categories();
echo json_encode($categoryList);