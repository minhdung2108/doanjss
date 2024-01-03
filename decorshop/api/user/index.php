<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_users.php';
$usersList = getUsers() ;
echo json_encode($usersList);
?>