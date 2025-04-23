<?php
session_start();

$id_Tour = isset($_POST["Id_Tour"]) ? $_POST["Id_Tour"] : null;
$id_Transport = isset($_POST["Id_Transport"]) ? $_POST["Id_Transport"] : null;
$startplace = isset($_POST["startplace"]) ? $_POST["startplace"] : null;
$endplace = isset($_POST["endplace"]) ? $_POST["endplace"] : null;
$brand = isset($_POST["brand"]) ? $_POST["brand"] : null;
$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : null;
$travel_type = isset($_POST["travel_type"]) ? $_POST["travel_type"] : null;
$service = isset($_POST["service"]) ? $_POST["service"] : null;
$price = isset($_POST["price"]) ? $_POST["price"] : null;
$return_date = isset($_POST["return_date"]) ? $_POST["return_date"] : null;

$errors = [];

if (is_null($startplace)) $errors[] = "Thiếu điểm bắt đầu.";
if (is_null($endplace)) $errors[] = "Thiếu điểm kết thúc.";
if (is_null($brand)) $errors[] = "Thiếu thương hiệu.";
if (is_null($starttime)) $errors[] = "Thiếu thời gian bắt đầu.";
if (is_null($travel_type)) $errors[] = "Thiếu loại phương tiện.";
if (is_null($service)) $errors[] = "Thiếu dịch vụ.";
if (is_null($price)) $errors[] = "Thiếu giá.";
if (is_null($id_Tour)) $errors[] = "Thiếu ID tour du lịch.";
if (is_null($id_Transport)) $errors[] = "Thiếu ID phương tiện.";

// Validate date format and ensure dates are not in the past
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$currentDate = date('Y-m-d');

if (!validateDate($starttime)) $errors[] = "Ngày bắt đầu không đúng định dạng.";
if ($return_date && !validateDate($return_date)) $errors[] = "Ngày kết thúc không đúng định dạng.";
if ($starttime < $currentDate) $errors[] = "Ngày bắt đầu không được nhỏ hơn ngày hiện tại.";
if ($return_date && $return_date < $currentDate) $errors[] = "Ngày kết thúc không được nhỏ hơn ngày hiện tại.";
if ($return_date && $return_date < $starttime) $errors[] = "Ngày kết thúc không được nhỏ hơn ngày bắt đầu.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

// Connect to database
require_once 'ketnoi.php';

if ($conn) {
    // Check if the transport exists for update
    $checkQuery = "SELECT * FROM Transport WHERE id = ?";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt) {
        $stmt->bind_param("i", $id_Transport);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the existing transport
            if ($return_date) {
                $updateQuery = "UPDATE Transport SET startplace = ?, endplace = ?, brand = ?, starttime = ?, travel_type = ?, service = ?, price = ?, return_date = ? WHERE id = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("sssssissi", $startplace, $endplace, $brand, $starttime, $travel_type, $service, $price, $return_date, $id_Transport);
            } else {
                $updateQuery = "UPDATE Transport SET startplace = ?, endplace = ?, brand = ?, starttime = ?, travel_type = ?, service = ?, price = ? WHERE id = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("sssssssi", $startplace, $endplace, $brand, $starttime, $travel_type, $service, $price, $id_Transport);
            }

            if ($stmt->execute()) {
                $_SESSION['message'] = "Dữ liệu đã được cập nhật thành công!";
                header("Location: GD_Tour.php?Id_Tour=$id_Tour");
                exit();
            } else {
                echo "Lỗi: " . $stmt->error;
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
