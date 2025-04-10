<?php
session_start();

$id_Tour = isset($_POST["Id_Tour"]) ? $_POST["Id_Tour"] : null;
$id_Schedule = isset($_POST["Id_Schedule"]) ? $_POST["Id_Schedule"] : null;
$ngaybatdau = isset($_POST["startday"]) ? $_POST["startday"] : null;
$ngayketthuc = isset($_POST["endday"]) ? $_POST["endday"] : null;


$errors = [];

if (is_null($ngaybatdau)) $errors[] = "Thiếu ngày bắt đầu.";
if (is_null($ngayketthuc)) $errors[] = "Thiếu ngày kết thúc.";
if (is_null($id_Tour)) $errors[] = "Thiếu ID tour du lịch.";
if (is_null($id_Schedule)) $errors[] = "Thiếu ID lịch";

// Validate date format and ensure dates are not in the past
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$currentDate = date('Y-m-d');

if (!validateDate($ngaybatdau)) $errors[] = "Ngày bắt đầu không đúng định dạng.";
if (!validateDate($ngayketthuc)) $errors[] = "Ngày kết thúc không đúng định dạng.";
if ($ngaybatdau < $currentDate) $errors[] = "Ngày bắt đầu không được nhỏ hơn ngày hiện tại.";
if ($ngayketthuc < $currentDate) $errors[] = "Ngày kết thúc không được nhỏ hơn ngày hiện tại.";
if ($ngayketthuc < $ngaybatdau) $errors[] = "Ngày kết thúc không được nhỏ hơn ngày bắt đầu.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

// Connect to database
require_once 'ketnoi.php';

if ($conn) {
    // Check if the schedule exists for update
    $checkQuery = "SELECT * FROM Schedule WHERE id_Tour = ?";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt) {
        $stmt->bind_param("i", $id_Schedule);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the existing schedule
            $updateQuery = "UPDATE Schedule SET startday = ?, endday = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            if ($stmt) {
                $stmt->bind_param("ssi", $ngaybatdau, $ngayketthuc, $id_Schedule);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Dữ liệu đã được cập nhật thành công!";
                    header("Location:GD_QL_Tour.php");
                    exit();
                } else {
                    echo "Lỗi: " . $stmt->error;
                }
            } else {
                echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
            }
        } else {
            echo "Dữ liệu không tồn tại!";
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
