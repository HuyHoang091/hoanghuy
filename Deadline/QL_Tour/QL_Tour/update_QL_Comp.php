<?php
session_start();

$ten_Comp = isset($_POST["name_Comp"]) ? $_POST["name_Comp"] : null;
$thongtin_Comp = isset($_POST["detail_Comp"]) ? $_POST["detail_Comp"] : null;
$soDT_Comp = isset($_POST["number_Comp"]) ? $_POST["number_Comp"] : null;
$duong_Comp = isset($_POST["road_Comp"]) ? $_POST["road_Comp"] : null;
$chutich_Comp = isset($_POST["ceo_Comp"]) ? $_POST["ceo_Comp"] : null;
$anh_Comp = isset($_FILES["picture_Comp"]) ? $_FILES["picture_Comp"] : null;
$Id_Comp = isset($_POST["Id_Comp"]) ? $_POST["Id_Comp"] : null;
$Id_City = isset($_POST["Id_City"]) ? $_POST["Id_City"] : null;

$errors = [];

if (is_null($ten_Comp)) $errors[] = "Thiếu tên công ty.";
if (is_null($thongtin_Comp)) $errors[] = "Thiếu thông tin chi tiết.";
if (is_null($soDT_Comp)) $errors[] = "Thiếu số điện thoại.";
if (is_null($duong_Comp)) $errors[] = "Thiếu đường.";
if (is_null($Id_City)) $errors[] = "Thiếu id thành phố.";
if (is_null($chutich_Comp)) $errors[] = "Thiếu chủ tịch.";
if (is_null($Id_Comp)) $errors[] = "Thiếu Id công ty.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

function isEmptyOrNull($data) {
    return !isset($data) || trim($data) === '';
}

function isValidText($text) {
    return preg_match("/^[\p{L}\s]+$/u", $text);
}

if (isValidText($ten_Comp) 
&& isValidText($chutich_Comp)
)  {
    require_once 'ketnoi.php';

    $target_file = null;

    if ($anh_Comp && $anh_Comp['size'] > 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($anh_Comp["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($anh_Comp["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Tệp không phải là một ảnh.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
        && $imageFileType != "gif" ) {
            echo "Chỉ cho phép tệp JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Tệp của bạn không được tải lên.";
            exit();
        } else {
            if (!move_uploaded_file($anh_Comp["tmp_name"], $target_file)) {
                echo "Đã xảy ra lỗi khi tải lên tệp.";
                exit();
            }
        }
    }

    $updateQuery = "UPDATE Comp SET 
                    name_Comp='$ten_Comp', 
                    detail_Comp='$thongtin_Comp', 
                    number_Comp='$soDT_Comp', 
                    road_Comp='$duong_Comp', 
                    ceo_Comp='$chutich_Comp'";

    if ($target_file) {
        $updateQuery .= ", picture_Comp='$target_file'";
    }

    $updateQuery .= " WHERE id=$Id_Comp";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = "Dữ liệu đã được cập nhật thành công!";
        header("Location: GD_QL_Tour.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Dữ liệu nhập vào chưa chuẩn!";
}
?>
