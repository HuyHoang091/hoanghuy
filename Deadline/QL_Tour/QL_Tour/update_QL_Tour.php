<?php
session_start();

// Error array for collecting error messages
$errors = [];

// Helper functions
function isValidFloat($number) {
    return is_numeric($number) && floatval($number) == $number;
}

function isValidInt($number) {
    return filter_var($number, FILTER_VALIDATE_INT) !== false;
}

function isValidText($text) {
    return preg_match("/^[\p{L}\s]+$/u", $text);
}

// Get form inputs
$ten_Tour = isset($_POST["name_Tour"]) ? $_POST["name_Tour"] : null;
$gioithieu_Tour = isset($_POST["intro_Tour"]) ? $_POST["intro_Tour"] : null;
$thongtin_Tour = isset($_POST["detail_Tour"]) ? $_POST["detail_Tour"] : null;
$phinguoilon = isset($_POST["adultfee"]) ? $_POST["adultfee"] : null;
$phitrecon = isset($_POST["childfee"]) ? $_POST["childfee"] : null;
$anh_Tour = isset($_FILES["picture_Tour"]) ? $_FILES["picture_Tour"] : null;
$idCity = isset($_POST["Id_City"]) ? $_POST["Id_City"] : null;
$idComp = isset($_POST["Id_Comp"]) ? $_POST["Id_Comp"] : null;
$idTour = isset($_POST["Id_Tour"]) ? $_POST["Id_Tour"] : null;

// Validate inputs
if (is_null($ten_Tour)) $errors[] = "Thiếu tên công ty.";
if (is_null($gioithieu_Tour)) $errors[] = "Thiếu giới thiệu.";
if (is_null($thongtin_Tour)) $errors[] = "Thiếu thông tin chi tiết.";
if (is_null($phinguoilon)) $errors[] = "Thiếu phí người lớn.";
if (is_null($phitrecon)) $errors[] = "Thiếu phí trẻ con.";
if (is_null($idComp)) $errors[] = "Thiếu Id công ty.";
if (is_null($idTour)) $errors[] = "Thiếu Id Tour.";
if (is_null($idCity)) $errors[] = "Thiếu Id City.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

if (isValidText($ten_Tour) 
    && isValidFloat($phinguoilon)
    && isValidFloat($phitrecon)
    && isValidInt($idTour)) {
    
    require_once 'ketnoi.php';

    $target_file = null;

    if ($anh_Tour && $anh_Tour['size'] > 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($anh_Tour["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($anh_Tour["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Tệp không phải là một ảnh.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Chỉ cho phép tệp JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Tệp của bạn không được tải lên.";
            exit();
        } else {
            if (!move_uploaded_file($anh_Tour["tmp_name"], $target_file)) {
                echo "Đã xảy ra lỗi khi tải lên tệp.";
                exit();
            }
        }
    }

    $updateQuery = "UPDATE Tour SET 
                    name_Tour='$ten_Tour',
                    intro_Tour='$gioithieu_Tour', 
                    detail_Tour='$thongtin_Tour', 
                    id_City='$idCity', 
                    adultfee = '$phinguoilon',
                    childfee ='$phitrecon'";

    if ($target_file) {
        $updateQuery .= ", picture_Tour='$target_file'";
    }

    $updateQuery .= " WHERE id=$idTour";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = "Dữ liệu đã được cập nhật thành công!";
        header("Location:GD_Comp.php?Id_Comp=$idComp");
        //header("Location:GD_QL_Tour.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Dữ liệu nhập vào chưa chuẩn!";
}
?>
