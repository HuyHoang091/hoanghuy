<?php
session_start();

$ten_Tour = isset($_POST["name_Tour"]) ? $_POST["name_Tour"] : null;
$gioithieu_Tour = isset($_POST["intro_Tour"]) ? $_POST["intro_Tour"] : null;
$noidung_Tour = isset($_POST["detail_Tour"]) ? $_POST["detail_Tour"] : null;
$thanhpho_Tour = isset($_POST["id_City"]) ? $_POST["id_City"] : null;
$phinguoilon = isset($_POST["adultfee"]) ? $_POST["adultfee"] : null;
$phitrecon = isset($_POST["childfee"]) ? $_POST["childfee"] : null;
$anh_Tour = isset($_FILES["picture_Tour"]) ? $_FILES["picture_Tour"] : null;
$idcomp = isset($_POST["Id_Comp"]) ? $_POST["Id_Comp"] : null;
$luotmua = 0;

$errors = [];

if (is_null($ten_Tour)) $errors[] = "Thiếu tên tour.";
if (is_null($gioithieu_Tour)) $errors[] = "Thiếu lời giới thiệu.";
if (is_null($noidung_Tour)) $errors[] = "Thiếu nội dung.";
if (is_null($thanhpho_Tour)) $errors[] = "Thiếu id thành phố";
if (is_null($phinguoilon)) $errors[] = "Thiếu phí người lớn.";
if (is_null($phitrecon)) $errors[] = "Thiếu phí trẻ con.";
if (is_null($anh_Tour)) $errors[] = "Thiếu ảnh";
if (is_null($idcomp)) $errors[] = "Thiếu ID công ty.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

function isValidFloat($number) {
    return is_numeric($number) && floatval($number) == $number;
}

function isValidInt($number) {
    return filter_var($number, FILTER_VALIDATE_INT) !== false;
}

function isValidText($text) {
    return preg_match("/^[\p{L}\s]+$/u", $text);
}

if (isValidFloat($phinguoilon)
&& isValidFloat($phitrecon)
&& isValidInt($idcomp)
)  {
    require_once 'ketnoi.php';
    
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["picture_Tour"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["picture_Tour"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Tệp không phải là một ảnh.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
    && $imageFileType != "gif" ) {
        echo "Chỉ cho phép tệp JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Tệp của bạn không được tải lên.";
    } else {
        if (move_uploaded_file($_FILES["picture_Tour"]["tmp_name"], $target_file)) {
            $anh_Tour = $target_file;
            $checkQuery = "SELECT * FROM Tour WHERE 
            name_Tour = '$ten_Tour'
            AND intro_Tour = '$gioithieu_Tour' 
            AND detail_Tour = '$noidung_Tour' 
            AND id_City = '$thanhpho_Tour' 
            AND picture_Tour = '$anh_Tour'";
            $result = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($result) > 0) {
                echo "Dữ liệu đã tồn tại!";
            } else {
                $addQuery = "INSERT INTO Tour (name_Tour, intro_Tour, detail_Tour, id_City, picture_Tour, adultfee , childfee, buycount, id_Comp) 
                            VALUES ('$ten_Tour', '$gioithieu_Tour', '$noidung_Tour','$thanhpho_Tour','$anh_Tour', '$phinguoilon', '$phitrecon','$luotmua','$idcomp')";
                
                if (mysqli_query($conn, $addQuery)) {
                    $_SESSION['message'] = "Dữ liệu đã được thêm thành công!";
                    header("Location: GD_QL_Tour.php");
                    exit();
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Đã xảy ra lỗi khi tải lên tệp.";
        }
    }
    mysqli_close($conn);
} else {
    echo "Dữ liệu nhập vào chưa chuẩn!";
}
?>
