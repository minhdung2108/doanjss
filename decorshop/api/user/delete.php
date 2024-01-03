<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_users.php';
if (isset($_GET['id'])){
    $id = $_GET['id'];

    $user = finUser($email);
    if($user == null) {
        deleteUsers($id);
        $response = array(
            'code' => 200,
            'message' => 'delete success'
        );
    }else{
        $response = array(
            'code' => 600,
            'message' => 'user not found'

        );
    }
    echo json_encode($response);
}
?>