<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/hoanghuy/Deadline/Public/Css/seach10.css">
    <link rel="stylesheet" href="http://localhost/hoanghuy/73DCTT24_MVC%20-%20Copy/73DCTT24_MVC/Public/Css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/hoanghuy/73DCTT24_MVC%20-%20Copy/73DCTT24_MVC/Public/Css/dinhdang7.css">
    <style>
        .dd2{
            width: 440px;
        }
        body{
            background: #ecf0f5;
        }
    </style>
</head>
<body>
    <form method="post" action="http://localhost/hoanghuy/QuanLy/Danhsachuser/luu">
    <div class="grid-cot1" style="gap: 20px !important;">
        <div style=" padding: 25px;">

            <label >Tên người dùng</label>
            <input required type="text" class="form-control dd2" name="THK">
            <label >Mật khẩu</label>
            <input required type="password" class="form-control dd2" name="NS">
            <label >Quyền</label>
            <select name="Q" class="form-control dd2">
                <option value="khách hàng">khách hàng</option>
                <option value="admin">admin</option>
            </select>
            <label >Tài khoản</label>
            <input required type="text" class="form-control dd2" name="DDI">
            <label >Giới tính</label>
            <select name="GT" class="form-control dd2">
                <option value="">---Chọn giới tính---</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
            <label >Số điện thoại</label>
            <input required type="tel" class="form-control dd2" name="GB">
            <label >Email</label>
            <input required type="email" class="form-control dd2" name="GD">
            <input required type="hidden" value="http://localhost/hoanghuy/Deadline/Public/Pictures/img/account.png" name="pc" id="">
            <button type="submit" style="margin-top: 10px;" class="btn btn-primary" name="btnLuu">Lưu</button>
        </div>
    </div>        
    </form>
</body>
</html>