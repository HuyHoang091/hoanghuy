<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanly1";

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem file có phải là hình ảnh thật hay không
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước file
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Chỉ cho phép một số định dạng file nhất định
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Kiểm tra nếu $uploadOk được đặt thành 0 bởi một lỗi nào đó
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // Nếu mọi thứ đều ổn, thử tải file lên và cập nhật vào cơ sở dữ liệu
    } else {
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Lưu đường dẫn file vào cơ sở dữ liệu
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Lấy username từ session
            if (isset($_SESSION['user']['username'])) {
                $username = $_SESSION['user']['username'];

                // Cập nhật đường dẫn ảnh vào bảng account
                $sql_update = "UPDATE account SET picture_Account = 'http://localhost/hoanghuy/Deadline/$target_file' WHERE username_Account = '$username'";

                if ($conn->query($sql_update) === TRUE) {
                    echo "The file has been uploaded and path updated in database for user: $username.<br>";
                    echo "<script>alert('Cập nhật thành công!');
                    window.parent.postMessage({functionName: 'huyup'}, '*');
                    </script>";
                } else {
                    echo "Error updating record: " . $conn->error . "<br>";
                }
            } else {
                echo "Session username not set.<br>";
            }

            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>
