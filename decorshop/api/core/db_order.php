<?php
require_once 'mysql.php';
$pdo = get_pdo();

function find_order($ordersId){
    global $pdo;

    $sql = "SELECT * FROM ORDERS WHERE ID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("id", $ordersId);
    
    // thực hiện truy vấn
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    // Lặp kết quả
    foreach ($result as $row){
        return array(
            'id' => $row['id'],
            'code' => $row['code'],
            'status' => $row['status'],
            'user_id' => $row['users'],
        );
    }

    return null;
}

function get_orders_by_user($user_id){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS WHERE CATEGORY_ID=:category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("category_id", $user_id);
    

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $user_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $user_list[] = array(
            'id' => $row['id'],
            'code' => $row['code'],
            'status' => $row['status'],
            'user_id' => $row['users'],
        );
    }
    
    return $user_list;
}

function get_all_orders(){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $user_id = array();

    // Lặp kết quả
    foreach ($result as $row){
        $user_id[] = array(
            'id' => $row['id'],
            'code' => $row['code'],
            'status' => $row['status'],
            'user_id' => $row['users'],
        );
    }
    
    return $user_id;
}

function get_hot_order(){
    global $pdo;

    $sql = "SELECT * FROM ORDERS WHERE VIEW > 20 ORDER BY VIEW DESC LIMIT 10";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $product_list = array();

    // Lặp kết quả
    $user_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $user_list[] = array(
            'id' => $row['id'],
            'code' => $row['code'],
            'status' => $row['status'],
            'user_id' => $row['users'],
        );
    }
    
    return $user_list;
}

function find_order_by_name($key){
    global $pdo;

    $sql = "SELECT * FROM ORDERS WHERE NAME LIKE '%$key%'";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $user_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $user_list[] = array(
            'id' => $row['id'],
            'code' => $row['code'],
            'status' => $row['status'],
            'user_id' => $row['users'],
        );
    }
    
    return $user_list;
}
?>