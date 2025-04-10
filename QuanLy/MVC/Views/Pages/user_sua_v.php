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
    <form method="post" action="http://localhost/hoanghuy/QuanLy/Danhsachuser/suadl">
    <div class="grid-cot1" style="gap: 20px !important;">
        <div style=" padding: 25px;">
            <?php 
            if(isset($data['dulieu'])&& mysqli_num_rows($data['dulieu'])>0){
                $row=mysqli_fetch_array($data['dulieu'])
            ?>

            <input type="hidden" class="form-control dd2" name="ID" 
            value="<?php echo $row['id'] ?>">
            <label >Tên người dùng</label>
            <input required type="text" class="form-control dd2" name="THK" 
            value="<?php echo $row['display_Account'] ?>">
            <label >Mật khẩu</label>
            <input required type="text" class="form-control dd2" name="NS" 
            value="<?php echo $row['password_Account'] ?>">
            <label >Quyền</label>
            <select name="Q" class="form-control dd2">
                <option value="khách hàng" <?php if($row['type_Account']=='khách hàng') echo 'selected' ?>>khách hàng</option>
                <option value="admin" <?php if($row['type_Account']=='admin') echo 'selected' ?>>admin</option>
            </select>
            <label >Tài Khoản</label>
            <input required type="text" class="form-control dd2" name="DDI" 
            value="<?php echo $row['username_Account'] ?>">
            <label >Giới tính</label>
            <select name="GT" class="form-control dd2">
                <option value="">---Chọn giới tính---</option>
                <option value="Nam" <?php if($row['gender_Account']=='Nam') echo 'selected' ?>>Nam</option>
                <option value="Nữ" <?php if($row['gender_Account']=='Nữ') echo 'selected' ?>>Nữ</option>
            </select>
            <label >Số điện thoại</label>
            <input required type="text" class="form-control dd2" name="GB" 
            value="<?php echo $row['phone_Account'] ?>">
            <label >Email</label>
            <input required type="text" class="form-control dd2" name="GD" 
            value="<?php echo $row['gmail_Account'] ?>">
            <input required type="hidden" class="form-control dd2" name="ND" 
            value="<?php echo $row['picture_Account'] ?>">

            <?php        
            }
            ?>

            <button type="submit" style="margin-top: 10px;" class="btn btn-primary" name="btnLuu">Lưu</button>
        </div>
    </div>        
    </form>
</body>
</html>