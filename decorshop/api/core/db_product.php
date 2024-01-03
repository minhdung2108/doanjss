<?php
require_once 'mysql.php';
$pdo = get_pdo();

function find_product($productId){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS WHERE ID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("id", $productId);
    
    // thực hiện truy vấn
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    // Lặp kết quả
    foreach ($result as $row){
        return array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'category_id' => $row['category_id']
        );
    }

    return null;
}

function get_products_by_category($category_id){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS WHERE CATEGORY_ID=:category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("category_id", $category_id);
    

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $product_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $product_list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'category_id' => $row['category_id']
        );
    }
    
    return $product_list;
}

function get_all_products(){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $product_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $product_list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'category_id' => $row['category_id']
        );
    }
    
    return $product_list;
}

function get_hot_products(){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS WHERE VIEW > 20 ORDER BY VIEW DESC LIMIT 10";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $product_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $product_list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'category_id' => $row['category_id']
        );
    }
    
    return $product_list;
}

function find_product_by_name($key){
    global $pdo;

    $sql = "SELECT * FROM PRODUCTS WHERE NAME LIKE '%$key%'";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
     
    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();
     
    $product_list = array();

    // Lặp kết quả
    foreach ($result as $row){
        $product_list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $row['image'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'category_id' => $row['category_id']
        );
    }
    
    return $product_list;
}
?>