<?php
require_once 'mysql.php';
$pdo = get_pdo();

function find_items($itemsId){
    global $pdo;

    $sql = "SELECT * FROM order_items ID=:id";
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
            'order_id' => $row['order_id'],
            'product_id' => $row['product_id'],
            'quatity' => $row['quatity'],
            'price' => $row['price'],
        );
    }

    return null;
}

function get_items_by_order($order_id){
    global $pdo;

    $sql = "SELECT * FROM order_items WHERE ORDER_ID=:order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("category_id", $order_id);
    

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $items_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $items_list[] = array(
            'id' => $row['id'],
            'order_id' => $row['order_id'],
            'product_id' => $row['product_id'],
            'quatity' => $row['quatity'],
            'price' => $row['price'],
        );
    }
    
    return $items_list;
}

function get_all_items(){
    global $pdo;

    $sql = "SELECT * FROM  order_items";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $items_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $items_list[] = array(
            'id' => $row['id'],
            'order_id' => $row['order_id'],
            'product_id' => $row['product_id'],
            'quatity' => $row['quatity'],
            'price' => $row['price'],
        );
    }
    
    return $items_list;
}

function get_hot_order(){
    global $pdo;

    $sql = "SELECT * FROM ORDERS WHERE VIEW > 20 ORDER BY VIEW DESC LIMIT 10";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     

    // Lặp kết quả
    $items_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $items_list[] = array(
            'id' => $row['id'],
            'order_id' => $row['order_id'],
            'product_id' => $row['product_id'],
            'quatity' => $row['quatity'],
            'price' => $row['price'],
        );
    }
    
    return $items_list;
}


?>
?>