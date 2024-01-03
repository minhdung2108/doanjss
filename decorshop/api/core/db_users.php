<?php
require_once 'mysql.php';
$pdo = get_pdo();

function createUser($email, $password, $role){
    global $pdo;
    $sql = "INSERT INTO USERS(EMAIL, PASSWORD, ROLE)VALUE( :email, :password, :role)";
    $stmt = $pdo->prepare($sql);
    
    $stmt ->bindParam(':email',$email);
    $stmt ->bindParam(':password',$password);
    $stmt ->bindParam(':role',$role);

    $stmt->execute();

}
function updateUser($id, $email, $password, $role){
    global $pdo;
    $sql = "UPDATE USERS SET EMAIL=:email, PASSWORD=:password, ROLE=role WHERE ID=:id";
    $stmt = $pdo->prepare($sql);
    
    $stmt ->bindParam(':id',$id);
    $stmt ->bindParam(':email',$email);
    $stmt ->bindParam(':password',$password);
    $stmt ->bindParam(':role',$role);

    $stmt->execute();

}
function deleteUsers($id){
    global $pdo;
    $sql = "SELECT * FROM USERS WHERE ID =id";
    $stmt = $pdo->prepare($sql);
    
    $stmt ->bindParam(':id',$id);

    $stmt->execute();

}
function getUsers(){
    global $pdo;
    $sql = "SELECT * FROM user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stmt ->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt ->fetchAll();
    return $result;

}
function finUser($userId){
    global $pdo;

    $sql = "SELECT * FROM user";
    $stmt = $pdo ->prepare($sql);
    $stmt->bindParam("id", $userId);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $result = $stmt->fetchAll();

    foreach ($result as $row){
        return array(
            'id'=> $row['id'],
            'email'=> $row['email'],
            'password'=> $row['password'],
            'role'=> $row['role'],

        );
    }
    return null;
}
function finUserByEmail($userId){
    global $pdo;

    $sql = "SELECT * FROM USERS WHERE email=:email";
    $stmt = $pdo ->prepare($sql);
    $stmt->bindParam("email", $email);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $result = $stmt->fetchAll();

    foreach ($result as $row){
        return array(
            'id'=> $row['id'],
            'email'=> $row['email'],
            'password'=> $row['password'],
            'role'=> $row['role'],

        );
    }
    return null;
}

 
