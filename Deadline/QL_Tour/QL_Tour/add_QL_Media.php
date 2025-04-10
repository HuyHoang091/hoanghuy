<?php
session_start();

function isValidDate($date) {
    // Kiểm tra định dạng ngày tháng (Y-m-d H:i:s)
    $format = 'Y-m-d H:i:s';
    $dateTime = DateTime::createFromFormat($format, $date);
    return $dateTime && $dateTime->format($format) == $date;
}

// Hàm kiểm tra dữ liệu đầu vào chỉ chứa các ký tự chữ cái và khoảng trắng
function isValidText($text) {
    return preg_match("/^[\p{L}\s]+$/u", $text);
}


$tieude_media_Post = isset($_POST["title_media_Post"]) ? $_POST["title_media_Post"] : null;
$noidung_media_Post = isset($_POST["content_media_Post"]) ? $_POST["content_media_Post"] : null;
$tacgia_media_Post = isset($_POST["arthor_media_Post"]) ? $_POST["arthor_media_Post"] : null;
$theloai_media_Post = isset($_POST["type_media_Post"]) ? $_POST["type_media_Post"] : null;
$thanhpho_media_Post = isset($_POST["city_media_Post"]) ? $_POST["city_media_Post"] : null;
$datnuoc_media_Post = isset($_POST["country_media_Post"]) ? $_POST["country_media_Post"] : null;
$anh_media_Post = isset($_FILES["picture_media_Post"]) ? $_FILES["picture_media_Post"] : null;
$ngaydang = date('Y-m-d H:i:s');
$tuongtac = 0;
$thich = 0;
$che = 0;

$errors = [];

if (is_null($tieude_media_Post)) $errors[] = "Thiếu tiêu đề.";
if (is_null($noidung_media_Post)) $errors[] = "Thiếu thông tin chi tiết";
if (is_null($tacgia_media_Post)) $errors[] = "Thiếu tác giả.";
if (is_null($theloai_media_Post)) $errors[] = "Thiếu thể loại.";
if (is_null($anh_media_Post)) $errors[] = "Thiếu ảnh";
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
    // Kết nối 
    require_once 'ketnoi.php';

    $target_dir = "uploads/";
    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["picture_media_Post"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là một ảnh hợp lệ không
    $check = getimagesize($_FILES["picture_media_Post"]["tmp_name"]);
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
        if (move_uploaded_file($_FILES["picture_media_Post"]["tmp_name"], $target_file)) {
            $picture_media_Post = $target_file;

            // Kiểm tra xem dữ liệu đã tồn tại hay chưa
            $checkQuery = "SELECT * FROM media_Post 
            WHERE title_media_Post = '$tieude_media_Post' 
            AND content_media_Post = '$noidung_media_Post' 
            AND arthor_media_Post = '$tacgia_media_Post' 
            AND type_media_Post = '$theloai_media_Post'";
            $result = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($result) > 0) {
                echo "Dữ liệu đã tồn tại!";
            } else {
                $addQuery = "INSERT INTO media_Post (title_media_Post,
                                            content_media_Post,
                                            arthor_media_Post,
                                            type_media_Post,
                                            picture_media_Post,
                                            postday_media_Post,
                                            city_media_Post,
                                            country_media_Post,
                                            interaction_media_Post,
                                            like_media_Post,
                                            dislike_media_Post) 
                            VALUES  ('$tieude_media_Post',
                                            '$noidung_media_Post',
                                            '$tacgia_media_Post',
                                            '$theloai_media_Post',
                                            '$picture_media_Post',
                                            '$ngaydang',
                                            '$thanhpho_media_Post',
                                            '$datnuoc_media_Post',
                                            '$tuongtac',
                                            '$thich',
                                            '$che')";
                
                if (mysqli_query($conn, $addQuery)) {
                    $_SESSION['message'] = "Dữ liệu đã được thêm thành công!";
                    header("Location: GD_QL_Media.php");
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
