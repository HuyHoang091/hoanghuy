<?php
    require_once('ketnoi.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $taikhoan = $_POST['tk'];
        $matkhau = $_POST['mk'];
        $tendangnhap = $_POST['tdn'];
        $gioitinh = $_POST['gt'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $kieutk = 'khách hàng';
        $picture = 'C:/xampp/htdocs/hoanghuy/Deadline/Public/Pictures/picture.png';
    
        $stmt = $conn->prepare("SELECT * FROM account WHERE username_Account = ?");
        $stmt->bind_param("s", $taikhoan);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                alert('Tài khoản đã tồn tại. Vui lòng chọn tài khoản khác.');
                window.location.href = './dangki.php';
            </script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO account (display_Account, password_Account, type_Account, username_Account, gender_Account, phone_Account, gmail_Account, picture_Account) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $tendangnhap, $matkhau, $kieutk, $taikhoan, $gioitinh, $sdt, $email, $picture);
        
            if ($stmt->execute()) {
                echo "<script>
                alert('Đăng ký thành công!');
                window.location.href = './dangnhap.php';
                </script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra khi thêm tài khoản');</script>";
            }
        }
        $stmt->close();
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://www.example.com/background.jpg'); /* Đường dẫn đến hình nền */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            text-align: center;
            color: #666;
        }
        .ratings {
            color: #26bed6;
        }
        /* .form-grid .input-group {
            margin-bottom: 10px;
        } */
        .form-grid .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-grid .input-group input, .form-grid .input-group select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        .form-grid .input-group select {
            
            background-size: 10px;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .btn-search {
            width: 100%;
            background-color: orange;
            border: none;
            color: white;
            padding: 15px 0;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-search:hover {
            background-color: #26bed6;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <div class="container">
            <div>
                <div style="float: right">
                            <div style="font-size: 25px;
                            cursor: pointer;
                            width: 30px;
                            background: #aaaaaa;
                            color: white;
                            border-radius: 10px;
                            position: fixed;
                            text-align: center;
                            top: 4px;
                            right: 4px;">
                <a style="text-decoration: none; color: black;" href="./dangnhap.php">↵</a></div>
            </div>
            <div>
                <img style="width: 120px;" src="./img/logoct.png" alt="">
            </div>
            <h1>Đăng ký</h1>
            <p>Thủ tục nhanh gọn - hỗ trợ chuyên nghiệp và tận tâm <span class="ratings">Đăng ký ngay</span></p>
            <form>
                <div class="form-grid">
                    <div class="input-group" style="font-size: 14px;">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="tdn" placeholder="Tên đăng nhập">
                    </div>
                    <div class="input-group" style="font-size: 14px;">
                        <label>Tài khoản</label>
                        <input type="text" name="tk" placeholder="Tài khoản">
                    </div>
                    <div class="input-group" style="font-size: 14px;">
                        <label>Mật khẩu</label>
                        <input type="password" name="mk" placeholder="Mật khẩu">
                    </div>
                    <div class="input-group" style="font-size: 14px;">
                        <label>Giới tính</label>
                        <select style="width: calc(100% - 0px);" name="gt">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="input-group" style="font-size: 14px;">
                        <label>Số điện thoại</label>
                        <input type="text" name="sdt" placeholder="Số điện thoại">
                    </div>
                    <div class="input-group" style="font-size: 14px;">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                </div>
                <button type="submit" class="btn-search">Đăng ký</button>
            </form>
        </div>
    </form>
</body>
</html>