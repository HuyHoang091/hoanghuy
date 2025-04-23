<?php
session_start();

$ten_Comp = isset($_POST["name_Comp"]) ? $_POST["name_Comp"] : null;
$thongtin_Comp = isset($_POST["detail_Comp"]) ? $_POST["detail_Comp"] : null;
$sonha_Comp = isset($_POST["number_Comp"]) ? $_POST["number_Comp"] : null;
$duong_Comp = isset($_POST["road_Comp"]) ? $_POST["road_Comp"] : null;
$thanhpho_Comp = isset($_POST["id_City"]) ? $_POST["id_City"] : null;
$chutich_Comp = isset($_POST["ceo_Comp"]) ? $_POST["ceo_Comp"] : null;
$anh_Comp = isset($_FILES["picture_Comp"]) ? $_FILES["picture_Comp"] : null;

$errors = [];

if (is_null($ten_Comp)) $errors[] = "Thiếu tên công ti.";
if (is_null($thongtin_Comp)) $errors[] = "Thiếu thông tin chi tiết";
if (is_null($sonha_Comp)) $errors[] = "Thiếu số nhà.";
if (is_null($duong_Comp)) $errors[] = "Thiếu đường.";
if (is_null($thanhpho_Comp)) $errors[] = "Thiếu id thành phố";
if (is_null($chutich_Comp)) $errors[] = "Thiếu chủ tịch.";
if (is_null($anh_Comp)) $errors[] = "Thiếu ảnh đại diện.";

if (count($errors) > 0) {
    echo "Dữ liệu nhập vào không hợp lệ: " . implode(", ", $errors);
    exit();
}

function isValidText($text) {
    return preg_match("/^[\p{L}\s]+$/u", $text);
}

if (isValidText($ten_Comp) 
//&& isValidText($thongtin_Comp)
//&& isValidText($sonha_Comp) 
&& isValidText($duong_Comp) 
&& isValidText($chutich_Comp)
)  {
    require_once 'ketnoi.php';
    
    $target_dir = "uploads/";
    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["picture_Comp"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là một ảnh hợp lệ không
    $check = getimagesize($_FILES["picture_Comp"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Tệp không phải là một ảnh.";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước tệp
    // if ($_FILES["picture_Comp"]["size"] > 500000) {
    //     echo "Tệp quá lớn.";
    //     $uploadOk = 0;
    // }

    // Cho phép một số định dạng tệp nhất định
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
    && $imageFileType != "gif" ) {
        echo "Chỉ cho phép tệp JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Tệp của bạn không được tải lên.";
    } else {
        if (move_uploaded_file($_FILES["picture_Comp"]["tmp_name"], $target_file)) {
            $picture_Comp = $target_file;
            $checkQuery = "SELECT * FROM Comp WHERE 
            name_Comp = '$ten_Comp' 
            AND detail_Comp = '$thongtin_Comp' 
            AND number_Comp = '$sonha_Comp' 
            AND road_Comp = '$duong_Comp' 
            AND id_City = '$thanhpho_Comp' 
            AND ceo_Comp = '$chutich_Comp' 
            AND picture_Comp = '$picture_Comp'";
            $result = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($result) > 0) {
                echo "Dữ liệu đã tồn tại!";
            } else {
                $addQuery = "INSERT INTO Comp (name_Comp, detail_Comp, number_Comp, road_Comp, id_City, ceo_Comp, picture_Comp) 
                            VALUES ('$ten_Comp', '$thongtin_Comp', '$sonha_Comp','$duong_Comp','$thanhpho_Comp','$chutich_Comp','$picture_Comp')";
                
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
