<?php
// Kết nối đến cơ sở dữ liệu MySQL

// Cho phép tất cả các nguồn (origin) truy cập API
header('Access-Control-Allow-Origin: *');
// Cho phép các phương thức HTTP được sử dụng (GET, POST, etc.)
header('Access-Control-Allow-Methods: GET, POST');
// Cho phép các tiêu đề tùy chỉnh được gửi trong yêu cầu
header('Access-Control-Allow-Headers: Content-Type');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ yêu cầu AJAX
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$password = $data['password'];

// Truy vấn cơ sở dữ liệu để kiểm tra email và mật khẩu
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Email và mật khẩu hợp lệ
    $response = array('success' => true, 'message' => 'Đăng nhập thành công');
} else {
    // Email hoặc mật khẩu không chính xác
    $response = array('success' => false, 'message' => 'Email hoặc mật khẩu không chính xác');
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();

// Trả về kết quả dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
?>