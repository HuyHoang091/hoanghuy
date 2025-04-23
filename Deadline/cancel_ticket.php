<?php
require_once 'MVC/Core/connectDB1.php';
$db = new connectDB1();
$conn = $db->getConnection();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT NganHang, SoThe, SoTien, IDLienHe, TrangThai FROM thongtinhanhkhach WHERE ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nganHang = $row['NganHang'];
        $soThe = $row['SoThe'];
        $soTien = $row['SoTien'];
        $IDLienHe = $row['IDLienHe'];
        $trangThai = $row['TrangThai'];

        if ($trangThai == "Đã sử dụng") {
            echo "Hủy thất bại: Vé đã được sử dụng.";
        } else {
            $sql_delete = "DELETE FROM thongtinhanhkhach WHERE ID = $id";
            if ($conn->query($sql_delete) === TRUE) {
                $sql_check = "SELECT * FROM thongtinhanhkhach WHERE IDLienHe = $IDLienHe";
                $result_check = $conn->query($sql_check);

                if ($result_check->num_rows == 0) {
                    $sql_delete_lienhe = "DELETE FROM thongtinlienhe WHERE ID = $IDLienHe";
                    $conn->query($sql_delete_lienhe);
                }

                $soDu = $soTien * 0.6;
                $sql_update = "UPDATE $nganHang SET SoDu = SoDu + $soDu WHERE SoThe = '$soThe'";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Hủy thành công, tiền đã được hoàn về tài khoản của bạn.";
                } else {
                    echo "Lỗi khi hoàn tiền: " . $conn->error;
                }
            } else {
                echo "Lỗi khi hủy vé: " . $conn->error;
            }
        }
    } else {
        echo "Không tìm thấy vé.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}

$conn->close();
?>
