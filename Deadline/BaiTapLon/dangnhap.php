<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taikhoan = $_POST['txtUser'];
    $matkhau = $_POST['txtPass'];

    require_once('ketnoi.php');

    $query = $conn->prepare('SELECT * FROM account WHERE username_Account = ?');
    $query->bind_param('s', $taikhoan);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user && $matkhau == $user['password_Account']) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'taikhoan' => $user['display_Account'],
            'quyen' => $user['type_Account'],
            'username'=> $user['username_Account'],
            'matkhau'=> $user['password_Account'],
            'gioitinh'=> $user['gender_Account'],
            'sdt'=> $user['phone_Account'],
            'gmail'=> $user['gmail_Account']
        ];
        echo "<script>
            window.parent.postMessage({functionName: 'dangnhap', user: {id: " . json_encode($user['id']) . ",taikhoan: " . json_encode($user['display_Account']) . ", quyen: " . json_encode($user['type_Account']) . ", username: " . json_encode($user['username_Account']) . ", matkhau: " . json_encode($user['password_Account']) . ", gioitinh: " . json_encode($user['gender_Account']) . ", sdt: " . json_encode($user['phone_Account']) . ", gmail: " . json_encode($user['gmail_Account']) . "}}, '*');
        </script>";
    } else {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!');
        window.location.href = 'http://localhost/BaiTapLon/dangnhap.php';</script>";
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
                <img style="width: 120px;" src="./img/logoct.png" alt="">
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
                <span><a style="text-decoration: none; color: #9fedf9;" href="./dangki.php">
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