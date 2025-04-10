<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Xóa các biến session
$_SESSION = array();

// Hủy bỏ session
session_destroy();

// Hủy bỏ session cookie nếu có
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Phản hồi về cho JavaScript
echo json_encode(['status' => 'success']);
?>
