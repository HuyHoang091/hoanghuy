<?php
session_start();

function isValidDate($date) {
    $format = 'Y-m-d H:i:s';
    $dateTime = DateTime::createFromFormat($format, $date);
    return $dateTime && $dateTime->format($format) == $date;
}

function isValidText($text) {
    return preg_match("/^[\p{L}\s]+$/u", $text);
}

$Id_Media = isset($_POST["Id_Media"]) ? $_POST["Id_Media"] : null;
$tieude_media_Post = isset($_POST["title_media_Post"]) ? $_POST["title_media_Post"] : null;
$noidung_media_Post = isset($_POST["content_media_Post"]) ? $_POST["content_media_Post"] : null;
$tacgia_media_Post = isset($_POST["arthor_media_Post"]) ? $_POST["arthor_media_Post"] : null;
$theloai_media_Post = isset($_POST["type_media_Post"]) ? $_POST["type_media_Post"] : null;
$thanhpho_media_Post = isset($_POST["city_media_Post"]) ? $_POST["city_media_Post"] : null;
$datnuoc_media_Post = isset($_POST["country_media_Post"]) ? $_POST["country_media_Post"] : null;
$anh_media_Post = $_FILES["picture_media_Post"];
$capnhat = date('Y-m-d H:i:s');

$errors = [];

if (is_null($Id_Media)) $errors[] = "Thiếu ID media.";
if (is_null($tieude_media_Post)) $errors[] = "Thiếu tiêu đề.";
if (is_null($noidung_media_Post)) $errors[] = "Thiếu thông tin chi tiết";
if (is_null($tacgia_media_Post)) $errors[] = "Thiếu tác giả.";
if (is_null($theloai_media_Post)) $errors[] = "Thiếu thể loại.";
if (is_null($datnuoc_media_Post)) $errors[] = "Thiếu đất nước";
if (is_null($thanhpho_media_Post)) $errors[] = "Thiếu thành phố";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

if (isValidText($tacgia_media_Post) 
&& isValidText($theloai_media_Post)
&& isValidText($datnuoc_media_Post)
&& isValidText($thanhpho_media_Post)
) {
    require_once 'ketnoi.php';

    $target_file = null;

    if ($anh_media_Post && $anh_media_Post['size'] > 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($anh_media_Post["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($anh_media_Post["tmp_name"]);
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

    $updateQuery = "UPDATE media_Post SET 
                    title_media_Post='$tieude_media_Post',
                    content_media_Post='$noidung_media_Post', 
                    arthor_media_Post='$tacgia_media_Post', 
                    type_media_Post='$theloai_media_Post', 
                    city_media_Post='$thanhpho_media_Post', 
                    country_media_Post='$datnuoc_media_Post'";

    if ($target_file) {
        $updateQuery .= ", picture_media_Post='$target_file'";
    }

    $updateQuery .= " WHERE id=$Id_Media";

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = "Dữ liệu đã được cập nhật thành công!";
        header("Location: GD_QL_media.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Dữ liệu nhập vào chưa chuẩn!";
}
?>
