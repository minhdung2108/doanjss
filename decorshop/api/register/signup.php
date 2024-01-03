<?php
// Kết nối đến cơ sở dữ liệu MySQL

header('Access-Control-Allow-Origin: *');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repeatpassword'])) {
    // Lấy dữ liệu từ yêu cầu AJAX
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $checkSql = "SELECT id FROM users WHERE email = '$email'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
        $response = array('message' => 'Tên tài khoản đã tồn tại');
        echo json_encode($response);
    } else // Kiểm tra mật khẩu và xác nhận mật khẩu
    if ($password !== $repeatpassword) {
        $response = array('message' => 'Mật khẩu và xác nhận mật khẩu không khớp nhau');
        echo json_encode($response);
    } else {
        // Kiểm tra các yêu cầu về mật khẩu
        if (strlen($password) < 8) {
            $response = array('message' => 'Mật khẩu phải chứa ít nhất 8 ký tự');
            echo json_encode($response);
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $response = array('message' => 'Mật khẩu phải chứa ít nhất một số');
            echo json_encode($response);
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $response = array('message' => 'Mật khẩu phải chứa ít nhất một chữ hoa');
            echo json_encode($response);
        } else {
            // Thực hiện truy vấn SQL để lưu trữ dữ liệu vào cơ sở dữ liệu
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                $response = array('message' => 'Đăng ký thành công');
                echo json_encode($response);
            } else {
                $response = array('message' => 'Đã xảy ra lỗi');
                echo json_encode($response);
            }
        }
    }
}
 else {
$response = array('message' => 'Dữ liệu không hợp lệ');
echo json_encode($response);
}
$conn->close();



?>
