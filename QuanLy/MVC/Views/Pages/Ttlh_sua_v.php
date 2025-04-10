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
    <form method="post" action="http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/suadlttlh">
    <div class="grid-cot1" style="gap: 20px !important;">
        <div style=" padding: 25px;">
            <?php 
            if(isset($data['dulieu'])&& mysqli_num_rows($data['dulieu'])>0){
                $row=mysqli_fetch_array($data['dulieu'])
            ?>

            <input type="hidden" class="form-control dd2" name="ID" 
            value="<?php echo $row['ID'] ?>">
            <label >Tên liên hệ</label>
            <input required type="text" class="form-control dd2" name="TLH" 
            value="<?php echo $row['TenLienHe'] ?>">
            <label >Quý danh</label>
            <select name="QD" class="form-control dd2">
                <option value="">---Chọn quý danh---</option>
                <option value="Quý ông" <?php if($row['GioiTinh']=='Quý ông') echo 'selected' ?>>Quý ông</option>
                <option value="Quý bà" <?php if($row['GioiTinh']=='Quý bà') echo 'selected' ?>>Quý bà</option>
            </select>
            <label >Số điện thoại</label>
            <input required type="tel" class="form-control dd2" name="DT" 
            value="<?php echo $row['SoDienThoai'] ?>">
            <label >Kênh liên hệ</label>
            <input required type="text" class="form-control dd2" name="KLH" 
            value="<?php echo $row['KenhLienHe'] ?>">
            <label >Email</label>
            <input required type="email" class="form-control dd2" name="Email" 
            value="<?php echo $row['Email'] ?>">
            <label >Tài khoản</label>
            <input required type="text" class="form-control dd2" name="TK" 
            value="<?php echo $row['TaiKhoan'] ?>">

            <?php        
            }
            ?>

            <button type="submit" style="margin-top: 10px;" class="btn btn-primary" name="btnLuu">Lưu</button>
        </div>
    </div>        
    </form>
</body>
</html>