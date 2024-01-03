<?php
header('Access-Control-Allow-Origin: *');
require_once '../core/db_users.php';
if (isset($_POST['email'])){
    $email = $_POST['email'];
    $pasword = $_POST['password'];

    $user = finUserByEmail($email);
    if($user == null) {
        createUser($email, $pasword, 'user');
        $response = array(
            'code' => 200,
            'message' => 'create'
        );
    }else{
        $response = array(
            'code' => 200,
            'message' => 'create'

        );
    }
    echo json_encode($response);

}
?>