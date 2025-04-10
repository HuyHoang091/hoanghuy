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

    $pass = $conn->real_escape_string($_POST['passmoi']);
    $userId = $user['username'];

    // Cập nhật pass vào cơ sở dữ liệu
    $sql = "UPDATE account SET password_Account='$pass' WHERE username_Account='$userId'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Password updated successfully.');
        window.location.href = 'http://localhost/hoanghuy/Deadline/taikhoan/Get_data';</script>";
    } else {
        echo "Error updating pass: " . $conn->error;
    }

    $conn->close();
}
?>
