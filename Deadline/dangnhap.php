<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once 'MVC/Core/connectDB.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $taikhoan = $_POST['txtUser'];
        $matkhau = $_POST['txtPass'];

        $db = new connectDB();
        $conn = $db->getConnection();

        $query = $conn->prepare('SELECT * FROM account WHERE username_Account = ?');
        $query->bind_param('s', $taikhoan);
        $query->execute();

        $query->store_result();
        $query->bind_result($id, $display_Account, $password_Account, $type_Account, $username_Account, $gender_Account, $phone_Account, $gmail_Account);

        // Fetch data if exists
        if ($query->fetch() && $matkhau == $password_Account) {
            $_SESSION['user'] = [
                'id' => $id,
                'taikhoan' => $display_Account,
                'quyen' => $type_Account,
                'username'=> $username_Account,
                'matkhau'=> $password_Account,
                'gioitinh'=> $gender_Account,
                'sdt'=> $phone_Account,
                'gmail'=> $gmail_Account
            ];
            echo "<script>
                window.parent.postMessage({functionName: 'dangnhap', user: {id: " . json_encode($id) . ", taikhoan: " . json_encode($display_Account) . ", quyen: " . json_encode($type_Account) . ", username: " . json_encode($username_Account) . ", matkhau: " . json_encode($password_Account) . ", gioitinh: " . json_encode($gender_Account) . ", sdt: " . json_encode($phone_Account) . ", gmail: " . json_encode($gmail_Account) . "}}, '*');
            </script>";
        } else {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!');
            window.location.href = '/hoanghuy/Deadline/dangnhap.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .dd1{width: 220px; height: 17px; padding: 5px;}
        body{
            text-align: center;
            align-content: center;
        }
    </style>    
</head>
<body>
    <div style="height: 50px;">
        <div onclick="huy()" style="float: right">
                    <div style="font-size: 27px;
                    cursor: pointer;
        width: 30px;
        background: red;
        color: white;
        border-radius: 10px;">×</div>
    </div>
    </div>
    
    <div>
        <form method="post" action="">
            
            <div style="margin-bottom: 40px">
                <img style="width: 120px;" src="/hoanghuy/Deadline/Public/Pictures/img/logoct.png" alt="">
            </div>
            <div>
            <input type="text" name="txtUser" class="dd1" placeholder="Nhập tài khoản">
            </div>
            <br>
            <div>
            <input type="password" name="txtPass" class="dd1" placeholder="Nhập mật khẩu">
            </div>
            <br>
            <div style="align-content: center;">
                <button style="padding: 7px 20px;
                                margin-top: 7px;
                                background: #7c7ce9;
                                color: white;
                                border: none;
                                border-radius: 2px;
                                cursor: pointer;">
                    Đăng nhập
                </button>
            </div>
            <br>
            <div>
                <span>Chưa có tài khoản?</span>
                <span><a style="text-decoration: none; color: #9fedf9;" href="/hoanghuy/Deadline/dangki.php">
                    Đăng ký</a>
                </span>
                <span>ngay</span>
            </div>
        </form>
    </div>
    <script>
        function huy(){
            window.parent.postMessage({functionName: 'huydn'}, '*');
        }
    </script>
</body>
</html>