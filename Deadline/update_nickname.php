<?php
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$user) {
    die("User not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quanly1";

    // Kết nối tới cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nickname = $conn->real_escape_string($_POST['nickname']);
    $userId = $user['username'];

    // Cập nhật nickname vào cơ sở dữ liệu
    $sql = "UPDATE account SET display_Account='$nickname' WHERE username_Account='$userId'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nickname updated successfully.');
        window.location.href = 'http://localhost/hoanghuy/Deadline/taikhoan/Get_data';</script>";
    } else {
        echo "Error updating nickname: " . $conn->error;
    }

    $conn->close();
}
?>
