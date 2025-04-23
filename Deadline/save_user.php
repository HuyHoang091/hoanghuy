<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $_SESSION['user'] = [
        'id' => $data['id'],
        'taikhoan' => $data['taikhoan'],
        'quyen' => $data['quyen'],
        'username' => $data['username'],
        'matkhau' => $data['matkhau'],
        'gioitinh'=> $data['gioitinh'],
        'sdt'=> $data['sdt'],
        'gmail'=> $data['gmail']
    ];
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
