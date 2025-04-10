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
    <form method="post" action="http://localhost/hoanghuy/QuanLy/Danhsachgiave/suadl">
    <div class="grid-cot1" style="gap: 20px !important;">
        <div style=" padding: 25px;">

            <?php 
            if(isset($data['dulieu'])&& mysqli_num_rows($data['dulieu'])>0){
                $row1=mysqli_fetch_array($data['dulieu'])
            ?>
            <input type="hidden" name="id" id="" value="<?php echo $row1['ID'] ?>">
            <label >Điểm đi</label>
            <select name="ddi" class="form-control dd2">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "quanly1";
    
                // Tạo kết nối
                $conn = new mysqli($servername, $username, $password, $dbname);
    
                
                    $ss=$row1['DiemDi'];
                
                // Kiểm tra kết nối
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $se='';
                // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                $sql = "SELECT * FROM sanbaynoidia";
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tinh=$row["Tinh"];
                        $tinh=$row["Tinh"];
                        if($ss==$tinh){
                            $se='selected';
                        }
                        else{
                            $se='';
                        }
                        echo"<option value='$tinh' $se>$tinh</option>";
                    }
                } else {
                    echo "0 results";
                }
        
                $conn->close();
            ?>
            </select>
            <label >Điểm Đến</label>
            <select name="dde" class="form-control dd2">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "quanly1";
    
                // Tạo kết nối
                $conn = new mysqli($servername, $username, $password, $dbname);
               
                    $ss=$row1['DiemDen'];
                
                // Kiểm tra kết nối
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                $sql = "SELECT * FROM sanbaynoidia";
                $result = $conn->query($sql);
                $se='';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tinh=$row["Tinh"];
                        if($ss==$tinh){
                            $se='selected';
                        }
                        else{
                            $se='';
                        }
                        echo"<option value='$tinh' $se >$tinh</option>";
                    }
                } else {
                    echo "0 results";
                }
        
                $conn->close();
            ?>
            </select>
            <label >Hãng bay</label>
            <select name="hb" class="form-control dd2">
                <option value="Vietjet" <?php if($row1['HangBay']=='Vietjet') echo 'selected' ?>>Vietjet</option>
                <option value="VietnamAirlines" <?php if($row1['HangBay']=='VietnamAirlines') echo 'selected' ?>>VietnamAirlines</option>
                <option value="Bamboo" <?php if($row1['HangBay']=='Bamboo') echo 'selected' ?>>Bamboo</option>
            </select>
            <label >Hạng</label>
            <select name="hang" class="form-control dd2">
                <option value="Phổ thông" <?php if($row1['Hang']=='Phổ thông') echo 'selected' ?>>Phổ thông</option>
                <option value="Thương gia" <?php if($row1['Hang']=='Thương gia') echo 'selected' ?>>Thương gia</option>
            </select>
            <label >Giờ hoạt động</label>
            <input required type="time" class="form-control dd2" name="gio" value="<?php echo $row1['GioDi'] ?>">
            <label >Giá</label>
            <input required type="tel" class="form-control dd2" name="gia" value="<?php echo $row1['Gia'] ?>">

            <?php        
            }
            ?>
            <button type="submit" style="margin-top: 10px;" class="btn btn-primary" name="btnLuu">Lưu</button>
        </div>
    </div>        
    </form>
</body>
</html>