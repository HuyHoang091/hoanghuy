<?php
session_start();

$Id_Tour = isset($_POST["Id_Tour"]) ? $_POST["Id_Tour"] : null;
$diembatdau = isset($_POST["startplace"]) ? $_POST["startplace"] : null;
$diemketthuc = isset($_POST["endplace"]) ? $_POST["endplace"] : null;
$thuonghieu = isset($_POST["brand"]) ? $_POST["brand"] : null;
$ngaydi = isset($_POST["starttime"]) ? $_POST["starttime"] : null;
$loai = isset($_POST["travel_type"]) ? $_POST["travel_type"] : null;
$dichvu = isset($_POST["service"]) ? $_POST["service"] : null;
$gia= isset($_POST["price"]) ? $_POST["price"] : null;
$ngayve= $_POST["return_date"];

$errors = [];

if (is_null($diembatdau)) $errors[] = "Thiếu điểm bắt đầu";
if (is_null($diemketthuc)) $errors[] = "Thiếu điểm kết thúc";
if (is_null($thuonghieu)) $errors[] = "Thiếu thương hiệu.";
if (is_null($ngaydi)) $errors[] = "Thiếu ngày đi.";
if (is_null($loai)) $errors[] = "Thiếu loại";
if (is_null($dichvu)) $errors[] = "Thiếu dịch vụ.";
if (is_null($gia)) $errors[] = "Thiếu giá";
if (is_null($Id_Tour)) $errors[] = "Thiếu ID tour du lịch.";

// Validate date format and ensure dates are not in the past
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$currentDate = date('Y-m-d');

if (!validateDate($ngaydi)) $errors[] = "Ngày bắt đầu không đúng định dạng.";
if (!validateDate($ngayve)) $errors[] = "Ngày kết thúc không đúng định dạng.";
if ($ngaydi < $currentDate) $errors[] = "Ngày bắt đầu không được nhỏ hơn ngày hiện tại.";
if ($ngayve < $currentDate) $errors[] = "Ngày kết thúc không được nhỏ hơn ngày hiện tại.";
if ($ngayve < $ngaydi) $errors[] = "Ngày kết thúc không được nhỏ hơn ngày bắt đầu.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

// Connect to database
require_once 'ketnoi.php';

if ($conn) {
    // Kiểm tra xem phương tiện đã tồn tại chưa
    $checkQuery = "SELECT * FROM Transport WHERE startplace = ? AND endplace = ? AND id_Tour = ? AND brand = ? AND travel_type = ? AND starttime = ? AND return_date = ? AND service = ? AND price = ?";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt) {
        $stmt->bind_param("ssissssss", $diembatdau, $diemketthuc, $Id_Tour, $thuonghieu, $loai, $ngaydi, $ngayve, $dichvu, $gia);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Dữ liệu đã tồn tại!";
        } else {
            // Thêm phương tiện mới
            $addQuery = "INSERT INTO Transport (startplace, endplace, id_Tour, brand, travel_type, starttime, return_date, service, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($addQuery);
            if ($stmt) {
                $stmt->bind_param("ssissssss", $diembatdau, $diemketthuc, $Id_Tour, $thuonghieu, $loai, $ngaydi, $ngayve, $dichvu, $gia);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Dữ liệu đã được thêm thành công!";
                    header("Location: GD_Tour.php?Id_Tour=$Id_Tour");
                    exit();
                } else {
                    echo "Lỗi: " . $stmt->error;
                }
            } else {
                echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
            }
        }
        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
    }
} else {
    echo "Database connection failed: " . mysqli_connect_error();
}
mysqli_close($conn);
?>