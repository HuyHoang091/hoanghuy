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
    <form method="post" action="http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/suadltthk">
    <div class="grid-cot1" style="gap: 20px !important;">
        <div style=" padding: 25px;">
            <?php 
            if(isset($data['dulieu'])&& mysqli_num_rows($data['dulieu'])>0){
                $row1=mysqli_fetch_array($data['dulieu'])
            ?>

            <input required type="hidden" class="form-control dd2" name="ID" 
            value="<?php echo $row1['ID'] ?>">
            <input required type="hidden" class="form-control dd2" name="IDLH" 
            value="<?php echo $row1['IDLienHe'] ?>">
            <label >Tên hành khách</label>
            <input required type="text" class="form-control dd2" name="THK" 
            value="<?php echo $row1['TenHanhKhach'] ?>">
            <label >Giới tính</label>
            <select name="GT" class="form-control dd2">
                <option value="">---Chọn giới tính---</option>
                <option value="Nam" <?php if($row1['GioiTinh']=='Nam') echo 'selected' ?>>Nam</option>
                <option value="Nữ" <?php if($row1['GioiTinh']=='Nữ') echo 'selected' ?>>Nữ</option>
            </select>
            <label >Ngày sinh</label>
            <input required type="date" class="form-control dd2" name="NS" 
            value="<?php echo $row1['NgaySinh'] ?>">
            <label >Hãng bay</label>
            <select name="HB" class="form-control dd2">
                <option value="Vietjet" <?php if($row1['HangBay']=='Vietjet') echo 'selected' ?>>Vietjet</option>
                <option value="VietnamAirlines" <?php if($row1['HangBay']=='VietnamAirlines') echo 'selected' ?>>VietnamAirlines</option>
                <option value="Bambo" <?php if($row1['HangBay']=='Bambo') echo 'selected' ?>>Bambo</option>
            </select>
            <label >Điểm đi</label>
            <select name="DDI" class="form-control dd2">
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
            <select name="DDEN" class="form-control dd2">
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
            <label >Giờ bay</label>
            <input required type="time" class="form-control dd2" name="GB" 
            value="<?php echo $row1['GioBay'] ?>">
            <label >Giờ đến</label>
            <input required type="time" class="form-control dd2" name="GD" 
            value="<?php echo $row1['GioDen'] ?>">
            <label >Ngày đi</label>
            <input required type="date" class="form-control dd2" name="ND" 
            value="<?php echo $row1['NgayDi'] ?>">
            <label >Trạng thái</label>
            <select name="TrangThai" class="form-control dd2">
                <option value="Chưa sử dụng" <?php if($row1['TrangThai']=='Chưa sử dụng') echo 'selected' ?>>Chưa sử dụng</option>
                <option value="Đã sử dụng" <?php if($row1['TrangThai']=='Đã sử dụng') echo 'selected' ?>>Đã sử dụng</option>
            </select>

            <?php        
            }
            ?>

            <button type="submit" style="margin-top: 10px;" class="btn btn-primary" name="btnLuu">Lưu</button>
        </div>
    </div>        
    </form>
</body>
</html>