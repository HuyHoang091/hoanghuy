<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/seach10.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/header.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/content9.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/globalcss.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/carcontainer1.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .date-picker {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        width: 200px;
        }
    </style>
    <style>
        body{
            background: #ecf0f5;
        }
        .thesb{
            background: #F2F2F2;
            color: black;
            padding: 7px;
            font-size: 14px;
        }
        .item:hover{
            background-color: #d9e7f7;
        }
        .item{
            height: 45px;
            padding-left: 10px;
            padding-top: 8px;
            padding-bottom: 5px;
        }
        .date-picker {
            width: 102.1% !important;
            padding: 0px !important;
            background: white;
            color: black;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .dropdown-toggle {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown .dropdown-menu {
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            display: none;
            top: calc(100% + 10px);
            border-radius: 4px;
            padding: 10px;
            font-size: 18px;
        }

        .dropdown .dropdown-menu.show {
            display: block;
        }

        .dropdown .dropdown-item {
            padding: 12px 16px;
            text-decoration: none;
            display: grid;
            grid-template-columns: 4fr 1fr;
            background: white !important;
            color: #333;
        }

        .dropdown .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .input-group {
            display: flex;
            width: 65px;
        }

        .input-group-btn {
            display: flex;
            flex-direction: column;
        }

        .form-control {
            flex: 1;
            text-align: center;
            width: 10px;
            border: none;
            font-size: 15px;
        }

        .btn-outline-secondary {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #495057;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
</head>
<body>
<form id="autoForm" method="post" action="./Ve_may_bay">
    <input type="hidden" id="selectedDateHidden" name="selectedDateHidden" value="<?php echo $data['date']; ?>">
    <input type="hidden" id="selectedDateHidden1" name="selectedDateHidden1" value="<?php echo $data['date1']; ?>">
    <input type="hidden" name="kv" id="test" value="<?php echo $data['kv']; ?>">
    <input type="hidden" name="adults" id="adults" value="<?php echo $data['lon']; ?>">
    <input type="hidden" name="children" id="children" value="<?php echo $data['tre']; ?>">
    <input type="hidden" name="infant" id="infant" value="<?php echo $data['be']; ?>">
    <input type="hidden" name="gialon" id="lon">
    <input type="hidden" name="giatre" id="tre">
    <input type="hidden" name="giabe" id="be">
    <input type="hidden" name="gialon1" id="lon1">
    <input type="hidden" name="giatre1" id="tre1">
    <input type="hidden" name="giabe1" id="be1">
    <input type="hidden" name="giavedi" id="giavd">
    <input type="hidden" name="giaveve" id="giavv">
    <input type="hidden" name="giodi" id="giod">
    <input type="hidden" name="giove" id="giov">
    <input type="hidden" name="giodi1" id="giod1">
    <input type="hidden" name="giove1" id="giov1">
    <input type="hidden" name="kv1" id="kieuve1">
    <input type="hidden" name="hangcb" id="hangcb" value="<?php if(isset($data['hangcb'])){echo $data['hangcb'];} ?>">
    <input type="hidden" name="gdut" id="gdut" value="<?php if(isset($data['gdut'])){echo $data['gdut'];} ?>">
    <input type="hidden" name="gvut" id="gvut" value="<?php if(isset($data['gvut'])){echo $data['gvut'];} ?>">
    <input type="hidden" name="hangbayloc" id="hangbayloc" value="<?php if(isset($data['hangbayloc'])){echo $data['hangbayloc'];} ?>">
    <input type="hidden" name="hangbayloc1" id="hangbayloc1" value="<?php if(isset($data['hangbayloc1'])){echo $data['hangbayloc1'];} ?>">
    <input type="hidden" name="hmaybay" id="hmaybay">
    <input type="hidden" name="hmaybay1" id="hmaybay1">
    <input type="hidden" name="action" id="action" value="default">
    <div class="div1" style="margin-top: 80px !important;">
        <div style="padding: 10px 0px 20px 0px; font-size: 13px;">
            <a href="/hoanghuy/Deadline/Home/Get_data" style="color: #555863;">Vé máy bay</a>
            <span> / </span>
            <a href="#" style="color: #555863;">Vé máy bay <?php echo $data['tu'] ?> đi <?php echo $data['den'] ?></a>
        </div>
        <div>
            <span>
                <select name="" id="kieuve" onchange="handleUpdate()" style="height: 50px; background: #ecf0f5; border: none; outline: none;">
                    <option value="Khứ hồi" <?php if(isset($data['kv'])){if($data['kv']=="Khứ hồi"){echo "selected";}}; ?>>Khứ hồi</option>
                    <option value="Một chiều" <?php if(isset($data['kv'])){if($data['kv']=="Một chiều"){echo "selected";}}; ?>>Một chiều</option>
                </select>
            </span>
            <span>
                <select name="" id="hangmb" onchange="handleUpdate()" style="height: 50px; background: #ecf0f5; border: none; outline: none;">
                    <option value="Nhiều hạng" <?php if(isset($data['hangcb'])){if($data['hangcb']=="Nhiều hạng"){echo "selected";}}; ?>>Nhiều hạng</option>
                    <option value="Thương gia" <?php if(isset($data['hangcb'])){if($data['hangcb']=="Thương gia"){echo "selected";}}; ?>>Thương gia</option>
                    <option value="Phổ thông" <?php if(isset($data['hangcb'])){if($data['hangcb']=="Phổ thông"){echo "selected";}}; ?>>Phổ thông</option>
                </select>
            </span>
            <span style="font-size: 13px;">Giờ đi ưu tiên:
                <select name="" id="timgd" onchange="handleUpdate()" 
                style="height: 50px; border: none;outline: none;position: relative;
                left: -100px;background: none;width: 150px;text-align: right;">
                    <option value="02:00" <?php if(isset($data['gdut'])){if($data['gdut']=="02:00"){echo "selected";}}; ?>>02:00</option>
                    <option value="02:30" <?php if(isset($data['gdut'])){if($data['gdut']=="02:30"){echo "selected";}}; ?>>02:30</option>
                    <option value="03:00" <?php if(isset($data['gdut'])){if($data['gdut']=="03:00"){echo "selected";}}; ?>>03:00</option>
                    <option value="03:30" <?php if(isset($data['gdut'])){if($data['gdut']=="03:30"){echo "selected";}}; ?>>03:30</option>
                    <option value="04:00" <?php if(isset($data['gdut'])){if($data['gdut']=="04:00"){echo "selected";}}; ?>>04:00</option>
                    <option value="04:30" <?php if(isset($data['gdut'])){if($data['gdut']=="04:30"){echo "selected";}}; ?>>04:30</option>
                    <option value="05:00" <?php if(isset($data['gdut'])){if($data['gdut']=="05:00"){echo "selected";}}else{echo "selected";}; ?>>05:00</option>
                    <option value="05:30" <?php if(isset($data['gdut'])){if($data['gdut']=="05:30"){echo "selected";}}; ?>>05:30</option>
                    <option value="06:00" <?php if(isset($data['gdut'])){if($data['gdut']=="06:00"){echo "selected";}}; ?>>06:00</option>
                    <option value="06:30" <?php if(isset($data['gdut'])){if($data['gdut']=="06:30"){echo "selected";}}; ?>>06:30</option>
                    <option value="07:00" <?php if(isset($data['gdut'])){if($data['gdut']=="07:00"){echo "selected";}}; ?>>07:00</option>
                    <option value="07:30" <?php if(isset($data['gdut'])){if($data['gdut']=="07:30"){echo "selected";}}; ?>>07:30</option>
                    <option value="08:00" <?php if(isset($data['gdut'])){if($data['gdut']=="08:00"){echo "selected";}}; ?>>08:00</option>
                    <option value="08:30" <?php if(isset($data['gdut'])){if($data['gdut']=="08:30"){echo "selected";}}; ?>>08:30</option>
                    <option value="09:00" <?php if(isset($data['gdut'])){if($data['gdut']=="09:00"){echo "selected";}}; ?>>09:00</option>
                    <option value="09:30" <?php if(isset($data['gdut'])){if($data['gdut']=="09:30"){echo "selected";}}; ?>>09:30</option>
                    <option value="10:00" <?php if(isset($data['gdut'])){if($data['gdut']=="10:00"){echo "selected";}}; ?>>10:00</option>
                    <option value="10:30" <?php if(isset($data['gdut'])){if($data['gdut']=="10:30"){echo "selected";}}; ?>>10:30</option>
                    <option value="11:00" <?php if(isset($data['gdut'])){if($data['gdut']=="11:00"){echo "selected";}}; ?>>11:00</option>
                    <option value="11:30" <?php if(isset($data['gdut'])){if($data['gdut']=="11:30"){echo "selected";}}; ?>>11:30</option>
                    <option value="12:00" <?php if(isset($data['gdut'])){if($data['gdut']=="12:00"){echo "selected";}}; ?>>12:00</option>
                    <option value="12:30" <?php if(isset($data['gdut'])){if($data['gdut']=="12:30"){echo "selected";}}; ?>>12:30</option>
                    <option value="13:00" <?php if(isset($data['gdut'])){if($data['gdut']=="13:00"){echo "selected";}}; ?>>13:00</option>
                    <option value="13:30" <?php if(isset($data['gdut'])){if($data['gdut']=="13:30"){echo "selected";}}; ?>>13:30</option>
                    <option value="14:00" <?php if(isset($data['gdut'])){if($data['gdut']=="14:00"){echo "selected";}}; ?>>14:00</option>
                    <option value="14:30" <?php if(isset($data['gdut'])){if($data['gdut']=="14:30"){echo "selected";}}; ?>>14:30</option>
                    <option value="15:00" <?php if(isset($data['gdut'])){if($data['gdut']=="15:00"){echo "selected";}}; ?>>15:00</option>
                    <option value="15:30" <?php if(isset($data['gdut'])){if($data['gdut']=="15:30"){echo "selected";}}; ?>>15:30</option>
                    <option value="16:00" <?php if(isset($data['gdut'])){if($data['gdut']=="16:00"){echo "selected";}}; ?>>16:00</option>
                    <option value="16:30" <?php if(isset($data['gdut'])){if($data['gdut']=="16:30"){echo "selected";}}; ?>>16:30</option>
                    <option value="17:00" <?php if(isset($data['gdut'])){if($data['gdut']=="17:00"){echo "selected";}}; ?>>17:00</option>
                    <option value="17:30" <?php if(isset($data['gdut'])){if($data['gdut']=="17:30"){echo "selected";}}; ?>>17:30</option>
                    <option value="18:00" <?php if(isset($data['gdut'])){if($data['gdut']=="18:00"){echo "selected";}}; ?>>18:00</option>
                    <option value="18:30" <?php if(isset($data['gdut'])){if($data['gdut']=="18:30"){echo "selected";}}; ?>>18:30</option>
                    <option value="19:00" <?php if(isset($data['gdut'])){if($data['gdut']=="19:00"){echo "selected";}}; ?>>19:00</option>
                    <option value="19:30" <?php if(isset($data['gdut'])){if($data['gdut']=="19:30"){echo "selected";}}; ?>>19:30</option>
                    <option value="20:00" <?php if(isset($data['gdut'])){if($data['gdut']=="20:00"){echo "selected";}}; ?>>20:00</option>
                    <option value="20:30" <?php if(isset($data['gdut'])){if($data['gdut']=="20:30"){echo "selected";}}; ?>>20:30</option>
                    <option value="21:00" <?php if(isset($data['gdut'])){if($data['gdut']=="21:00"){echo "selected";}}; ?>>21:00</option>
                    <option value="21:30" <?php if(isset($data['gdut'])){if($data['gdut']=="21:30"){echo "selected";}}; ?>>21:30</option>
                    <option value="22:00" <?php if(isset($data['gdut'])){if($data['gdut']=="22:00"){echo "selected";}}; ?>>22:00</option>
                    <option value="22:30" <?php if(isset($data['gdut'])){if($data['gdut']=="22:30"){echo "selected";}}; ?>>22:30</option>
                    <option value="23:00" <?php if(isset($data['gdut'])){if($data['gdut']=="23:00"){echo "selected";}}; ?>>23:00</option>
                </select>
            </span>
            <span style="font-size: 13px; position: relative; left: -100px; <?php if($data['kv']=="Một chiều"){echo "display: none";}else{echo "";} ?>">Giờ về ưu tiên:
                <select name="" id="timgv" onchange="handleUpdate()" 
                style="height: 50px; border: none;outline: none;position: relative;
                left: -100px;background: none;width: 150px;text-align: right;">
                    <option value="02:00" <?php if(isset($data['gvut'])){if($data['gvut']=="02:00"){echo "selected";}}; ?>>02:00</option>
                    <option value="02:30" <?php if(isset($data['gvut'])){if($data['gvut']=="02:30"){echo "selected";}}; ?>>02:30</option>
                    <option value="03:00" <?php if(isset($data['gvut'])){if($data['gvut']=="03:00"){echo "selected";}}; ?>>03:00</option>
                    <option value="03:30" <?php if(isset($data['gvut'])){if($data['gvut']=="03:30"){echo "selected";}}; ?>>03:30</option>
                    <option value="04:00" <?php if(isset($data['gvut'])){if($data['gvut']=="04:00"){echo "selected";}}; ?>>04:00</option>
                    <option value="04:30" <?php if(isset($data['gvut'])){if($data['gvut']=="04:30"){echo "selected";}}; ?>>04:30</option>
                    <option value="05:00" <?php if(isset($data['gvut'])){if($data['gvut']=="05:00"){echo "selected";}}else{echo "selected";}; ?>>05:00</option>
                    <option value="05:30" <?php if(isset($data['gvut'])){if($data['gvut']=="05:30"){echo "selected";}}; ?>>05:30</option>
                    <option value="06:00" <?php if(isset($data['gvut'])){if($data['gvut']=="06:00"){echo "selected";}}; ?>>06:00</option>
                    <option value="06:30" <?php if(isset($data['gvut'])){if($data['gvut']=="06:30"){echo "selected";}}; ?>>06:30</option>
                    <option value="07:00" <?php if(isset($data['gvut'])){if($data['gvut']=="07:00"){echo "selected";}}; ?>>07:00</option>
                    <option value="07:30" <?php if(isset($data['gvut'])){if($data['gvut']=="07:30"){echo "selected";}}; ?>>07:30</option>
                    <option value="08:00" <?php if(isset($data['gvut'])){if($data['gvut']=="08:00"){echo "selected";}}; ?>>08:00</option>
                    <option value="08:30" <?php if(isset($data['gvut'])){if($data['gvut']=="08:30"){echo "selected";}}; ?>>08:30</option>
                    <option value="09:00" <?php if(isset($data['gvut'])){if($data['gvut']=="09:00"){echo "selected";}}; ?>>09:00</option>
                    <option value="09:30" <?php if(isset($data['gvut'])){if($data['gvut']=="09:30"){echo "selected";}}; ?>>09:30</option>
                    <option value="10:00" <?php if(isset($data['gvut'])){if($data['gvut']=="10:00"){echo "selected";}}; ?>>10:00</option>
                    <option value="10:30" <?php if(isset($data['gvut'])){if($data['gvut']=="10:30"){echo "selected";}}; ?>>10:30</option>
                    <option value="11:00" <?php if(isset($data['gvut'])){if($data['gvut']=="11:00"){echo "selected";}}; ?>>11:00</option>
                    <option value="11:30" <?php if(isset($data['gvut'])){if($data['gvut']=="11:30"){echo "selected";}}; ?>>11:30</option>
                    <option value="12:00" <?php if(isset($data['gvut'])){if($data['gvut']=="12:00"){echo "selected";}}; ?>>12:00</option>
                    <option value="12:30" <?php if(isset($data['gvut'])){if($data['gvut']=="12:30"){echo "selected";}}; ?>>12:30</option>
                    <option value="13:00" <?php if(isset($data['gvut'])){if($data['gvut']=="13:00"){echo "selected";}}; ?>>13:00</option>
                    <option value="13:30" <?php if(isset($data['gvut'])){if($data['gvut']=="13:30"){echo "selected";}}; ?>>13:30</option>
                    <option value="14:00" <?php if(isset($data['gvut'])){if($data['gvut']=="14:00"){echo "selected";}}; ?>>14:00</option>
                    <option value="14:30" <?php if(isset($data['gvut'])){if($data['gvut']=="14:30"){echo "selected";}}; ?>>14:30</option>
                    <option value="15:00" <?php if(isset($data['gvut'])){if($data['gvut']=="15:00"){echo "selected";}}; ?>>15:00</option>
                    <option value="15:30" <?php if(isset($data['gvut'])){if($data['gvut']=="15:30"){echo "selected";}}; ?>>15:30</option>
                    <option value="16:00" <?php if(isset($data['gvut'])){if($data['gvut']=="16:00"){echo "selected";}}; ?>>16:00</option>
                    <option value="16:30" <?php if(isset($data['gvut'])){if($data['gvut']=="16:30"){echo "selected";}}; ?>>16:30</option>
                    <option value="17:00" <?php if(isset($data['gvut'])){if($data['gvut']=="17:00"){echo "selected";}}; ?>>17:00</option>
                    <option value="17:30" <?php if(isset($data['gvut'])){if($data['gvut']=="17:30"){echo "selected";}}; ?>>17:30</option>
                    <option value="18:00" <?php if(isset($data['gvut'])){if($data['gvut']=="18:00"){echo "selected";}}; ?>>18:00</option>
                    <option value="18:30" <?php if(isset($data['gvut'])){if($data['gvut']=="18:30"){echo "selected";}}; ?>>18:30</option>
                    <option value="19:00" <?php if(isset($data['gvut'])){if($data['gvut']=="19:00"){echo "selected";}}; ?>>19:00</option>
                    <option value="19:30" <?php if(isset($data['gvut'])){if($data['gvut']=="19:30"){echo "selected";}}; ?>>19:30</option>
                    <option value="20:00" <?php if(isset($data['gvut'])){if($data['gvut']=="20:00"){echo "selected";}}; ?>>20:00</option>
                    <option value="20:30" <?php if(isset($data['gvut'])){if($data['gvut']=="20:30"){echo "selected";}}; ?>>20:30</option>
                    <option value="21:00" <?php if(isset($data['gvut'])){if($data['gvut']=="21:00"){echo "selected";}}; ?>>21:00</option>
                    <option value="21:30" <?php if(isset($data['gvut'])){if($data['gvut']=="21:30"){echo "selected";}}; ?>>21:30</option>
                    <option value="22:00" <?php if(isset($data['gvut'])){if($data['gvut']=="22:00"){echo "selected";}}; ?>>22:00</option>
                    <option value="22:30" <?php if(isset($data['gvut'])){if($data['gvut']=="22:30"){echo "selected";}}; ?>>22:30</option>
                    <option value="23:00" <?php if(isset($data['gvut'])){if($data['gvut']=="23:00"){echo "selected";}}; ?>>23:00</option>
                </select>
            </span>
        </div>
        <div class="tkiem">
            <div class="diadiem">
                <div class="grid-phanlo position-relative">
                        <div class="grid-chuyenbay" style="background: white; min-width: 102.1%; border-top-left-radius: 4px; border-bottom-left-radius: 4px">
                            <div class="img"><img src="/hoanghuy/Deadline/Public/Pictures/di.jpg" alt="" style="width: 100%;"></div>
                                <div style="display: flex;">
                                <input type="text" id="passengers-1" name="passengers1" class="container-combobox" value="<?php echo $data['tu'] ?>" style="border: none; outline: none; font-size: 14px;" readonly>
                                </div>
                                <!---------Điểm đi---->
                                <div class="option-container-1 position-absolute" style="z-index: 1000; opacity: 0.91;overflow: auto;height: 350px;margin-top: 45px; left: auto; width: 25.5%;">
                                    <div>
                                        <div class="thesb">Sân bay nội địa phổ biến</div>
                                    </div>
                                    <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();

                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynoidia";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["SanBay"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-1')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                                    <div>
                                        <div class="thesb">Sân bay quốc tế phổ biến</div>
                                    </div>
                                    <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();
                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynuocngoai";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["San"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-1')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                                </div>
                                <!---------Điểm đến---->
                                <div class="option-container-2 position-absolute" style="z-index: 1000; opacity: 0.91;overflow: auto;height: 350px;margin-top: 45px; left: auto; width: 25.5%;">
                                    <div>
                                        <div class="thesb">Sân bay nội địa phổ biến</div>
                                    </div>
                                    <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();

                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynoidia";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["SanBay"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-2')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                                    <div>
                                        <div class="thesb">Sân bay quốc tế phổ biến</div>
                                    </div>
                                    <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();
                        
                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynuocngoai";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["San"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-2')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                                </div>
                            </div>
                            <div class="grid-chuyenbay" style="background: white ;min-width: 102.1%; border-top-right-radius: 4px; border-bottom-right-radius: 4px">
                                <div class="img"><img src="/hoanghuy/Deadline/Public/Pictures/ve.png" alt="" style="width: 100%;"></div>
                                <div style="display: flex;">
                                <input type="text" id="passengers-2" name="passengers2" class="container-combobox" value="<?php echo $data['den'] ?>" style="border: none; outline: none; font-size: 14px;" readonly>
                                
                            </div>
                        </div>
                    </div>
            </div>
            <div class="grid-phanlo">
                <div id="datePicker1" class="date-picker" style="border-top-left-radius: 4px; border-bottom-left-radius: 4px;">
                    <label href="">
                        <div class="grid-chuyenbay">
                            <div class="img">
                                <img src="/hoanghuy/Deadline/Public/Pictures/tgdi.png" alt="" style="width: 55%;">
                            </div>
                            <div>
                                <div style="margin-left: 4px; margin-top: 10px;">
                                    <span id="selectedDate1"><?php echo $data['date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>    
                <div id="<?php if($data['kv']=="Một chiều"){echo "";}else{echo "datePicker2";} ?>" class="date-picker" style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;">
                    <label href="" style="<?php if($data['kv']=="Một chiều"){echo "display: none";}else{echo "";} ?>">
                        <div class="grid-chuyenbay">
                            <div class="img">
                                <img src="/hoanghuy/Deadline/Public/Pictures/tgdi.png" alt="" style="width: 55%;">
                            </div>
                            <div>
                                <div style="margin-left: 4px; margin-top: 10px;">
                                    <span id="selectedDate2"><?php echo $data['date1'] ?></span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            
            <div>
                <button type="submit" name="Timkiem" style="background: orange;width: 100%;height: 100%;color: white;border: none;cursor: pointer;border-radius: 4px;font-size: 13px;">Tìm</button>
            </div>
        </div>
    </div>
    <div class="<?php if($data['kv']=="Một chiều"){ echo "grid-cot";}else{echo "grid-cot1";} ?>" id="<?php if($data['kv']=="Một chiều"){ echo "";}else{echo "cot";} ?>" style="min-height: 350px;">
        <div class='grid-div1' id="ve" style="background: none;padding-top: 0px;">
            <div style="background: #ffffff80; padding: 15px">
                <div style="margin-bottom: 10px;">
                    <span><?php echo $data['tu'] ?></span>
                    <span>→</span>
                    <span><?php echo $data['den'] ?></span>
                </div>
                <div><?php echo $data['date'] ?></div>
            </div>
            <div style="background: white; padding: 15px;">
                <div class='text-danger' id='hangbay'>Vietjet Air</div>
                <div class='phanlo-ve' id='lodi'>
                        <div>
                            <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDi' style="font-size: 20px;">06:00</strong></p>
                            <p style='margin-bottom: 4px; margin-top: 5px; font-size: 12px;' id='diemDi'>Hà Nội (HAN)</p>
                        </div>
                    <div>
                        <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDen' style="font-size: 20px;">8:10</strong></p>
                        <p style='margin-top: 5px; margin-bottom: 4px; font-size: 12px;' id='diemDen'>Hồ Chí Minh (SGN)</p>
                    </div>
                    <div class='hien' id='hieng' style="grid-column: span 2;">
                        <p style='margin-bottom: 5px; margin-top: 4px; font-size: 13px;'><strong>Thời gian bay</strong></p>
                        <p style='margin-bottom: 4px; margin-top: 5px; font-size: 12px;' id='flightDuration'>2h10p</p>
                    </div>
                    <div style="grid-column: span 2;"></div>
                    <div>
                        <p style='margin-bottom: 5px; margin-top: 0px; font-size: 13px;'>Giá vé:</p>
                        <p style='margin-bottom: 5px; margin-top: 5px; font-size: 12px;'>(Đã bao gồm thuế, phí)</p>
                    </div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px;'><strong id='gia'>1.000.000 VND</strong></p>
                    </div>
                </div>
            </div>
            <div style="background: #ffffff80; padding: 15px;display: flex; justify-content: center; color: #26bed6; cursor: pointer;" id="doibd" class=""doibd>Đổi chuyến bay đi</div>
            
        </div>

        <div class="grid-hien" id="cot1">
            <div id="loc" style="width: <?php if($data['kv']=="Một chiều"){echo "100%";}else{echo "102.8%";} ?>;">
                <div id="locngay" style="background: #ffffff80; padding: 12px;">
                    <span><?php echo $data['tu'] ?></span>
                    <span>→</span>
                    <span ><?php echo $data['den'] ?></span>
                    <span id="cut" style="float: right;"><?php echo $data['date'] ?></span>
                </div>
                <div id="loctheo" style="background: white; color: #555863; padding: 9px 15px; font-size: 14px;">
                    <span>Lọc theo:</span>
                    <span>
                        <select name="kieuloc" id="kieuloc" onchange="handleUpdate1()" style=" border: none; outline: none;">
                            <option value="Tất cả" <?php if(isset($data['hangbayloc'])){if($data['hangbayloc']=="Tất cả"){echo "selected";}} ?>>Tất cả</option>
                            <option value="Vietjet" <?php if(isset($data['hangbayloc'])){if($data['hangbayloc']=="Vietjet"){echo "selected";}} ?>>Vietjet</option>
                            <option value="VietnamAirlines" <?php if(isset($data['hangbayloc'])){if($data['hangbayloc']=="VietnamAirlines"){echo "selected";}} ?>>VietnamAirlines</option>
                            <option value="Bambo" <?php if(isset($data['hangbayloc'])){if($data['hangbayloc']=="Bambo"){echo "selected";}} ?>>Bambo</option>
                        </select>
                    </span>
                </div>
                <div id="macpt" style="font-size: 13px;color: #316f0f;font-weight: 400; margin-top: 15px;">✔ Giá đã bao gồm thuế phí</div>
                <div style="font-size: 18px;font-weight: 700;color: #003c71;margin: 15px 2px 10px 2px;">Đề xuất chiều đi tốt nhất cho bạn</div>
            </div>
            <?php
                if(isset($data['gdut'])&&isset($data['hangbayloc'])){
                    load2($data['tu'], $data['den'], $data['lon'], $soTreEm = $data['tre'], $data['be'],$data['gdut'],$data['hangbayloc'], $data['hangcb']);
                }
                else{
                    load2($data['tu'], $data['den'], $data['lon'], $soTreEm = $data['tre'], $data['be']);
                }
            ?>
        </div>
        <div class='grid-div1' id="ve1" style="background: none;padding-top: 0px;">
            <div style="background: #ffffff80; padding: 15px">
                <div style="margin-bottom: 10px;">
                    <span><?php echo $data['den'] ?></span>
                    <span>→</span>
                    <span><?php echo $data['tu'] ?></span>
                </div>
                <div><?php echo $data['date1'] ?></div>
            </div>
            <div style="background: white; padding: 15px;">
                <div class='text-danger' id='hangbay1'>Vietjet Air</div>
                <div class='phanlo-ve' id='lodi'>
                        <div>
                            <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDi1' style="font-size: 20px;">06:00</strong></p>
                            <p style='margin-bottom: 4px; margin-top: 5px; font-size: 12px;' id='diemDi1'>Hà Nội (HAN)</p>
                        </div>
                    <div>
                        <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDen1' style="font-size: 20px;">8:10</strong></p>
                        <p style='margin-top: 5px; margin-bottom: 4px; font-size: 12px;' id='diemDen1'>Hồ Chí Minh (SGN)</p>
                    </div>
                    <div class='hien' id='hieng' style="grid-column: span 2;">
                        <p style='margin-bottom: 5px; margin-top: 4px; font-size: 13px;'><strong>Thời gian bay</strong></p>
                        <p style='margin-bottom: 4px; margin-top: 5px; font-size: 12px;' id='flightDuration1'>2h10p</p>
                    </div>
                    <div style="grid-column: span 2;"></div>
                    <div>
                        <p style='margin-bottom: 5px; margin-top: 0px; font-size: 13px;'>Giá vé:</p>
                        <p style='margin-bottom: 5px; margin-top: 5px; font-size: 12px;'>(Đã bao gồm thuế, phí)</p>
                    </div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px;'><strong id='gia1'>1.000.000 VND</strong></p>
                    </div>
                </div>
            </div>
            <div style="background: #ffffff80; padding: 15px;display: flex; justify-content: center; color: #26bed6; cursor: pointer;" id="doibv">Đổi chuyến bay về</div>
            
        </div>
        <div class="<?php if($data['kv']=="Một chiều"){ echo "grid-thu";}else{echo "grid-an";} ?>" id="cot2">
            <div id="loc1" style="width: 102.8%;">
                <div id="locngay1" style="background: #ffffff80; padding: 12px; height: 53px; font-size: 16px;">
                    <span><?php echo $data['den'] ?></span>
                    <span>→</span>
                    <span ><?php echo $data['tu'] ?></span>
                    <span id="cut1" style="float: left; padding: 15px 0px 0px 0px;"><?php echo $data['date1'] ?></span>
                </div>
                <div id="loctheo1" style="background: white; color: #555863; padding: 9px 15px; font-size: 14px; display: none;">
                    <span>Lọc theo:</span>
                    <span>
                        <select name="kieuloc1" id="kieuloc1" onchange="handleUpdate1()" style=" border: none; outline: none;">
                        <option value="Tất cả" <?php if(isset($data['hangbayloc1'])){if($data['hangbayloc1']=="Tất cả"){echo "selected";}} ?>>Tất cả</option>
                            <option value="Vietjet" <?php if(isset($data['hangbayloc1'])){if($data['hangbayloc1']=="Vietjet"){echo "selected";}} ?>>Vietjet</option>
                            <option value="VietnamAirlines" <?php if(isset($data['hangbayloc1'])){if($data['hangbayloc1']=="VietnamAirlines"){echo "selected";}} ?>>VietnamAirlines</option>
                            <option value="Bambo" <?php if(isset($data['hangbayloc1'])){if($data['hangbayloc1']=="Bambo"){echo "selected";}} ?>>Bambo</option>
                        </select>
                    </span>
                </div>
                <div id="macpt1" style="font-size: 13px;color: #316f0f;font-weight: 400; margin-top: 15px; opacity: 0;">✔ Giá đã bao gồm thuế phí</div>
                <div style="font-size: 18px;font-weight: 700;color: #003c71;margin: 15px 2px 10px 2px;">Đề xuất chiều về tốt nhất cho bạn</div>
            </div>
            <?php
                if(isset($data['gvut'])&&isset($data['hangbayloc1'])){
                    load3($data['tu'], $data['den'], $data['lon'], $soTreEm = $data['tre'], $data['be'],$data['gvut'],$data['hangbayloc1'], $data['hangcb']);
                }
                else{
                    load3($data['tu'], $data['den'], $data['lon'], $soTreEm = $data['tre'], $data['be']);
                }
            ?>
        </div>
    </div>

    <div class="modal fade">
        <div class="dialog-container" >
            <div>Thông tin chuyến bay</div>
            <div>
                <div>
                    <p>Đi Thứ hai</p>
                    <p>09-01-2024</p>
                </div>
                <div>Logo</div>
                <div>
                    <p>VietnamAirlines</p>
                    <p>Eco</p>
                </div>
                <div>
                    <p>09:00</p>
                    <p>Hà Nội (HAN)</p>
                </div>
                <div>✈</div>
                <div>
                    <p>11:10</p>
                    <p>Hồ Chí Minh (SGN)</p>
                </div>
                <div>
                    <p>02h 10p</p>
                    <p>Bay thẳng</p>
                </div>
            </div>
        </div>
    </div>
    <!-- địa điểm -->
    <script>
        let container1 = document.querySelector(".option-container-1");
        let container2 = document.querySelector(".option-container-2");

        const selectOption = (value, id) => {
            
            handleUpdate();
            document.getElementById(id).value = value;
            container1.style.display = "none";
            container2.style.display = "none";
        }
        document.querySelector('#passengers-1').addEventListener('focus', function(e) {
            container1.style.display = "block";
        })
        document.addEventListener('click', function(event) {
            var clickedElement = event.target;
            if (!container1.contains(clickedElement) && clickedElement.id !== 'passengers-1') {
                container1.style.display = "none";
            }
        });
        document.querySelector('#passengers-2').addEventListener('focus', function(e) {
            container2.style.display = "block";
        })
        document.addEventListener('click', function(event) {
            var clickedElement = event.target;
            if (!container2.contains(clickedElement) && clickedElement.id !== 'passengers-2') {
                container2.style.display = "none";
            }
        });
    </script>
    <!-- ngày tháng -->
    <script>
        function getDayName(dateStr) {
            const date = new Date(dateStr);
            const days = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
            return days[date.getDay()];
        }
        function formatDate1(date) {
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
        let isFirstLoad = true;
        const datePicker1 = flatpickr("#datePicker1", {
            dateFormat: "d-m-Y",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const selectedDateSpan1 = document.getElementById('selectedDate1');
                    const selectedSpan1 = document.getElementById('selectedDateHidden');
                    const dayName = getDayName(selectedDates[0]);
                    selectedDateSpan1.textContent = `${dayName}, ${dateStr}`;
                    selectedSpan1.value = `${dayName}, ${dateStr}`;
                    handleUpdate();

                    if (isFirstLoad) {
                        const selectedDateSpan2 = document.getElementById('selectedDate2');
                        const selectedSpan2 = document.getElementById('selectedDateHidden1');
                        const dayAfterTomorrow = new Date(selectedDates[0]);
                        dayAfterTomorrow.setDate(dayAfterTomorrow.getDate() + 2);
                        dayAfter = getDayName(dayAfterTomorrow);
                        dateAfter = formatDate1(dayAfterTomorrow)
                        selectedDateSpan2.textContent = `${dayAfter}, ${dateAfter}`;
                        selectedSpan2.value = `${dayAfter}, ${dateAfter}`;
                        isFirstLoad = false; 
                    }

                    const date2 = datePicker2.selectedDates[0];
                    if (date2 && selectedDates[0] > date2) {
                        alert("Ngày đi không được sau ngày về!");
                        datePicker1.clear();
                        selectedDateSpan1.textContent = "";
                    }
                }
            }
        });
        const datePicker2 = flatpickr("#datePicker2", {
            dateFormat: "d-m-Y",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const selectedDateSpan2 = document.getElementById('selectedDate2');
                    const selectedSpan2 = document.getElementById('selectedDateHidden1');
                    const dayName = getDayName(selectedDates[0]);
                    handleUpdate();
                    selectedDateSpan2.textContent = `${dayName}, ${dateStr}`;
                    selectedSpan2.value = `${dayName}, ${dateStr}`;

                    const date1 = datePicker1.selectedDates[0];
                    if (date1 && selectedDates[0] < date1) {
                        alert("Ngày về không được trước ngày đi!");
                        datePicker2.clear();
                        selectedDateSpan2.textContent = "";
                    }
                }
            }
        });
    </script>
    <!-- ẩn hiện -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("cot2").onclick = function() {
                var elements0 = document.querySelectorAll("#cot2");
                var elements1 = document.querySelectorAll("#cot1");
                var elements2 = document.querySelectorAll("#cot1 #lodi, #cot2 #lodi");
                var elements3 = document.querySelectorAll("#cot1 #hieng, #cot2 #hieng");
                var elements4 = document.querySelectorAll("#cot1 #love, #cot2 #love");
                var elements5 = document.querySelectorAll("#cot1 #ang, #cot2 #ang");
                var elements6 = document.querySelectorAll("#cot1 #spandi, #cot2 #spandi");
                var elements7 = document.querySelectorAll("#cot1 #spanve, #cot2 #spanve");
                var elements8 = document.querySelectorAll("#cot1 #hienb, #cot2 #hienb");
                var elements9 = document.querySelectorAll("#cot1 #anb, #cot2 #anb");
                var element10 = document.getElementById("cot");
                var element11 = document.getElementById("loc");
                var element12 = document.getElementById("locngay");
                var element13 = document.getElementById("cut");
                var element14 = document.getElementById("loctheo");
                var element15 = document.getElementById("loc1");
                var element16 = document.getElementById("locngay1");
                var element17 = document.getElementById("cut1");
                var element18 = document.getElementById("loctheo1");
                var element19 = document.getElementById("macpt");
                var element20 = document.getElementById("macpt1");

                toggleClass(elements0, "grid-an", "grid-hien");
                toggleClass(elements1, "grid-hien", "grid-an");
                toggleClass(elements2, "phanlo", "phanlo-an");
                toggleClass(elements3, "hien", "span" && "an");
                toggleClass(elements4, "phanlo-an", "phanlo");
                toggleClass(elements5, "an" && "span", "hien");
                toggleClass(elements6, "ss", "span");
                toggleClass(elements7, "span",);
                toggleClass(elements8, "hien", "an");
                toggleClass(elements9, "an", "hien");
                element10.classList.remove("grid-cot1");
                element10.classList.add("grid-cot2");
                element11.style.removeProperty("width");
                element11.style.width = "106%";
                element12.style.height = "53px";
                element12.style.fontSize = "16px";
                element13.style.removeProperty("float");
                element13.style.float = "left";
                element13.style.padding = "15px 0px 0px 0px"
                element14.style.display = "none";
                element15.style.removeProperty("width");
                element15.style.width = "102.8%";
                element16.style.removeProperty("height");
                element16.style.removeProperty("font-size");
                element17.style.removeProperty("float");
                element17.style.float = "right";
                element17.style.removeProperty("padding");
                element18.style.display = "block";
                element19.style.opacity = "0";
                element20.style.opacity = "1";
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("cot1").onclick = function() {
                var elements0 = document.querySelectorAll("#cot2");
                var elements1 = document.querySelectorAll("#cot1");
                var elements2 = document.querySelectorAll("#cot1 #lodi, #cot2 #lodi");
                var elements3 = document.querySelectorAll("#cot1 #hieng, #cot2 #hieng");
                var elements4 = document.querySelectorAll("#cot1 #love, #cot2 #love");
                var elements5 = document.querySelectorAll("#cot1 #ang, #cot2 #ang");
                var elements6 = document.querySelectorAll("#cot1 #spandi, #cot2 #spandi");
                var elements7 = document.querySelectorAll("#cot1 #spanve, #cot2 #spanve");
                var elements8 = document.querySelectorAll("#cot1 #hienb, #cot2 #hienb");
                var elements9 = document.querySelectorAll("#cot1 #anb, #cot2 #anb");
                var element10 = document.getElementById("cot");
                var element11 = document.getElementById("loc");
                var element12 = document.getElementById("locngay");
                var element13 = document.getElementById("cut");
                var element14 = document.getElementById("loctheo");
                var element15 = document.getElementById("loc1");
                var element16 = document.getElementById("locngay1");
                var element17 = document.getElementById("cut1");
                var element18 = document.getElementById("loctheo1");
                var element19 = document.getElementById("macpt");
                var element20 = document.getElementById("macpt1");


                toggleClass(elements0, "grid-hien", "grid-an");
                toggleClass(elements1, "grid-an", "grid-hien");
                toggleClass(elements2, "phanlo-an", "phanlo");
                toggleClass(elements3, "span" && "an", "hien");
                toggleClass(elements4, "phanlo", "phanlo-an");
                toggleClass(elements5, "hien", "an" && "span");
                toggleClass(elements6, "span", "ss");
                toggleClass(elements7, "", "span");
                toggleClass(elements8, "an", "hien");
                toggleClass(elements9, "hien", "an");
                element10.classList.remove("grid-cot2");
                element10.classList.add("grid-cot1");
                element11.style.removeProperty("width");
                element11.style.width = "102.8%";
                element12.style.removeProperty("height");
                element12.style.removeProperty("font-size");
                element13.style.removeProperty("float");
                element13.style.float = "right";
                element13.style.removeProperty("padding");
                element14.style.display = "block";
                element15.style.width = "106%";
                element16.style.height = "53px";
                element16.style.fontSize = "16px";
                element17.style.removeProperty("float");
                element17.style.float = "left";
                element17.style.padding = "15px 0px 0px 0px"
                element18.style.display = "none";
                element19.style.opacity = "1";
                element20.style.opacity = "0";
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            let hienbutClicked = false;
            let anbutClicked = false;

            var hienbButtons = document.querySelectorAll(".hienbut");
            hienbButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    event.stopPropagation();
                    var kv = '<?php echo $data['kv']; ?>';
                    var ngaydi = document.getElementById("selectedDate1").innerText;
                    var ngayve = document.getElementById("selectedDate2").innerText;
                    if(ngaydi==ngayve){
                        if (anbutClicked) {
                        var giaText = document.getElementById("gioDen").innerText;
                        var gia1Text = document.getElementById("gioDi1").innerText;

                        var gia = parseInt(giaText.replace(":", ""), 10);
                        var gia1 = parseInt(gia1Text.replace(":", ""), 10);

                        

                        if (gia + 300 > gia1) {
                            alert("Để thuận tiện, bạn nên chọn chuyến bay về có giờ khởi hành cách thời điểm chuyến bay đi hạ cánh ít nhất 3 tiếng.");
                            return;
                        }
                        }
                    }
                    else {
                        if(anbutClicked){
                            document.getElementById('autoForm').submit();
                        }
                        else {
                            if(kv==="Một chiều"){
                            document.getElementById('autoForm').submit();
                            }
                            hienbutClicked = true;
                            var elements0 = document.querySelectorAll("#cot2, #cot2 *");
                            var elements1 = document.getElementById("cot1");
                            var elements4 = document.querySelectorAll("#cot1 #love, #cot2 #love");
                            var elements5 = document.querySelectorAll("#cot1 #ang, #cot2 #ang");
                            var elements7 = document.querySelectorAll("#cot1 #spanve, #cot2 #spanve");
                            var elements9 = document.querySelectorAll("#cot1 #anb, #cot2 #anb");
                            var element10 = document.getElementById("cot");
                            var element11 = document.getElementById("ve");
                            var element15 = document.getElementById("loc1");
                            var element16 = document.getElementById("locngay1");
                            var element17 = document.getElementById("cut1");
                            var element18 = document.getElementById("loctheo1");
                            var element20 = document.getElementById("macpt1");

                            toggleClass(elements0, "grid-an", "grid-hien");
                            elements1.classList.remove("grid-hien");
                            elements1.classList.add("grid-thu");
                            toggleClass(elements4, "phanlo-an", "phanlo");
                            toggleClass(elements5, "an" && "span", "hien");
                            toggleClass(elements7,"span",);
                            toggleClass(elements9,"an","hien");

                            element10.classList.remove("grid-cot1");
                            element10.classList.add("grid-cot2");

                            element11.classList.remove("grid-div1");
                            element11.classList.add("grid-div2");
                            element15.style.removeProperty("width");
                            element15.style.width = "102.8%";
                            element16.style.removeProperty("height");
                            element16.style.removeProperty("font-size");
                            element17.style.removeProperty("float");
                            element17.style.float = "right";
                            element17.style.removeProperty("padding");
                            element18.style.display = "block";
                            element20.style.opacity = "1";
                        }
                    }
                });
            });
            var hienbButtons = document.querySelectorAll(".anbut");
            hienbButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    event.stopPropagation();
                    var ngaydi = document.getElementById("selectedDate1").innerText;
                    var ngayve = document.getElementById("selectedDate2").innerText;
                    if(ngaydi==ngayve){
                        if (hienbutClicked) {
                        var giaText = document.getElementById("gioDen").innerText;
                        var gia1Text = document.getElementById("gioDi1").innerText;

                        var gia = parseInt(giaText.replace(":", ""), 10);
                        var gia1 = parseInt(gia1Text.replace(":", ""), 10);

                        

                        if (gia + 300 > gia1) {
                            alert("Để thuận tiện, bạn nên chọn chuyến bay về có giờ khởi hành cách thời điểm chuyến bay đi hạ cánh ít nhất 3 tiếng.");
                            return;
                        }
                        }
                    }
                    else {
                        if(hienbutClicked){
                            document.getElementById('autoForm').submit();
                        }
                        else {
                            anbutClicked = true;
                            var elements0 = document.querySelectorAll("#cot2");
                            var elements1 = document.querySelectorAll("#cot1");
                            var elements2 = document.querySelectorAll("#cot1 #lodi, #cot2 #lodi");
                            var elements3 = document.querySelectorAll("#cot1 #hieng, #cot2 #hieng");
                            var elements4 = document.querySelectorAll("#cot1 #love, #cot2 #love");
                            var elements5 = document.querySelectorAll("#cot1 #ang, #cot2 #ang");
                            var elements6 = document.querySelectorAll("#cot1 #spandi, #cot2 #spandi");
                            var elements7 = document.querySelectorAll("#cot1 #spanve, #cot2 #spanve");
                            var elements8 = document.querySelectorAll("#cot1 #hienb, #cot2 #hienb");
                            var elements9 = document.querySelectorAll("#cot1 #anb, #cot2 #anb");
                            var element10 = document.getElementById("cot");
                            var element11 = document.getElementById("ve1");
                            var elements12 = document.getElementById("cot2");
                            var element12 = document.getElementById("loc");
                            var element13 = document.getElementById("locngay");
                            var element14 = document.getElementById("cut");
                            var element15 = document.getElementById("loctheo");

                            elements12.classList.remove("grid-hien");
                            elements12.classList.add("grid-thu");
                            toggleClass(elements0, "grid-hien", "grid-an");
                            toggleClass(elements1, "grid-an", "grid-hien");
                            toggleClass(elements2, "phanlo-an", "phanlo");
                            toggleClass(elements3, "span" && "an", "hien");
                            toggleClass(elements4, "phanlo", "phanlo-an");
                            toggleClass(elements5, "hien", "an" && "span");
                            toggleClass(elements6, "span", "ss");
                            toggleClass(elements7, "", "span");
                            toggleClass(elements8, "an", "hien");
                            toggleClass(elements9, "hien", "an");
                            element10.classList.remove("grid-cot2");
                            element10.classList.add("grid-cot1");
                            element11.classList.remove("grid-div1");
                            element11.classList.add("grid-div2");
                            element11.style.removeProperty("width");
                            element12.style.width = "102.8%";
                            element13.style.removeProperty("height");
                            element13.style.removeProperty("font-size");
                            element14.style.removeProperty("float");
                            element14.style.float = "right";
                            element14.style.removeProperty("padding");
                            element15.style.display = "block";
                        }
                    }
                    });
            });
            document.getElementById("doibd").onclick = function() {
                hienbutClicked = false;
                var elements0 = document.querySelectorAll("#cot2");
                var elements1 = document.querySelectorAll("#cot1");
                var elements2 = document.querySelectorAll("#cot1 #lodi, #cot2 #lodi");
                var elements3 = document.querySelectorAll("#cot1 #hieng, #cot2 #hieng");
                var elements4 = document.querySelectorAll("#cot1 #love, #cot2 #love");
                var elements5 = document.querySelectorAll("#cot1 #ang, #cot2 #ang");
                var elements6 = document.querySelectorAll("#cot1 #spandi, #cot2 #spandi");
                var elements7 = document.querySelectorAll("#cot1 #spanve, #cot2 #spanve");
                var elements8 = document.querySelectorAll("#cot1 #hienb, #cot2 #hienb");
                var elements9 = document.querySelectorAll("#cot1 #anb, #cot2 #anb");
                var element10 = document.getElementById("cot");
                var element11 = document.getElementById("ve");
                var element12 = document.getElementById("cot1");
                var element13 = document.getElementById("loc");
                var element14 = document.getElementById("locngay");
                var element15 = document.getElementById("cut");
                var element16 = document.getElementById("loctheo");
                var element17 = document.getElementById("loc1");
                var element18 = document.getElementById("locngay1");
                var element19 = document.getElementById("cut1");
                var element20 = document.getElementById("loctheo1");
                var element21 = document.getElementById("macpt");
                var element22 = document.getElementById("macpt1");

                toggleClass(elements0, "grid-hien", "grid-an");
                toggleClass(elements1, "grid-an", "grid-hien");
                toggleClass(elements2, "phanlo-an", "phanlo");
                toggleClass(elements3, "span" && "an", "hien");
                toggleClass(elements4, "phanlo", "phanlo-an");
                toggleClass(elements5, "hien", "an" && "span");
                toggleClass(elements6, "span", "ss");
                toggleClass(elements7, "", "span");
                toggleClass(elements8, "an", "hien");
                toggleClass(elements9, "hien", "an");
                element10.classList.remove("grid-cot2");
                element10.classList.add("grid-cot1");
                element11.classList.remove("grid-div2");
                element11.classList.add("grid-div1");
                element12.classList.remove("grid-thu"); 
                element13.style.removeProperty("width");
                element13.style.width = "102.8%";
                element14.style.removeProperty("height");
                element14.style.removeProperty("font-size");
                element15.style.removeProperty("float");
                element15.style.float = "right";
                element15.style.removeProperty("padding");
                element16.style.display = "block";
                element17.style.width = "106%";
                element18.style.height = "53px";
                element18.style.fontSize = "16px";
                element19.style.removeProperty("float");
                element19.style.float = "left";
                element19.style.padding = "15px 0px 0px 0px"
                element20.style.display = "none";
                element21.style.opacity = "1";
                element22.style.opacity = "0";
            }
            document.getElementById("doibv").onclick = function() {
                anbutClicked = false;
                var elements0 = document.querySelectorAll("#cot2");
                var elements1 = document.querySelectorAll("#cot1");
                var elements2 = document.querySelectorAll("#cot1 #lodi, #cot2 #lodi");
                var elements3 = document.querySelectorAll("#cot1 #hieng, #cot2 #hieng");
                var elements4 = document.querySelectorAll("#cot1 #love, #cot2 #love");
                var elements5 = document.querySelectorAll("#cot1 #ang, #cot2 #ang");
                var elements6 = document.querySelectorAll("#cot1 #spandi, #cot2 #spandi");
                var elements7 = document.querySelectorAll("#cot1 #spanve, #cot2 #spanve");
                var elements8 = document.querySelectorAll("#cot1 #hienb, #cot2 #hienb");
                var elements9 = document.querySelectorAll("#cot1 #anb, #cot2 #anb");
                var element10 = document.getElementById("cot");
                var element11 = document.getElementById("ve1");
                var element12 = document.getElementById("cot2");
                var element13 = document.getElementById("loc");
                var element14 = document.getElementById("locngay");
                var element15 = document.getElementById("cut");
                var element16 = document.getElementById("loctheo");
                var element17 = document.getElementById("loc1");
                var element18 = document.getElementById("locngay1");
                var element19 = document.getElementById("cut1");
                var element20 = document.getElementById("loctheo1");
                var element21 = document.getElementById("macpt");
                var element22 = document.getElementById("macpt1");

                toggleClass(elements0, "grid-an", "grid-hien");
                toggleClass(elements1, "grid-hien", "grid-an");
                toggleClass(elements2, "phanlo", "phanlo-an");
                toggleClass(elements3, "hien", "span" && "an");
                toggleClass(elements4, "phanlo-an", "phanlo");
                toggleClass(elements5, "an" && "span", "hien");
                toggleClass(elements6, "ss", "span");
                toggleClass(elements7, "span",);
                toggleClass(elements8, "hien", "an");
                toggleClass(elements9, "an", "hien");
                element10.classList.remove("grid-cot1");
                element10.classList.add("grid-cot2");
                element11.classList.remove("grid-div2");
                element11.classList.add("grid-div1");
                element12.classList.remove("grid-thu");
                element13.style.removeProperty("width");
                element13.style.width = "106%";
                element14.style.height = "53px";
                element14.style.fontSize = "16px";
                element15.style.removeProperty("float");
                element15.style.float = "left";
                element15.style.padding = "15px 0px 0px 0px"
                element16.style.display = "none";
                element17.style.removeProperty("width");
                element17.style.width = "102.8%";
                element18.style.removeProperty("height");
                element18.style.removeProperty("font-size");
                element19.style.removeProperty("float");
                element19.style.float = "right";
                element19.style.removeProperty("padding");
                element20.style.display = "block";
                element21.style.opacity = "0";
                element22.style.opacity = "1";
            }
        });
        
        function toggleClass(elements, classToRemove, classToAdd) {
            if (elements instanceof NodeList || elements instanceof HTMLCollection) {
                elements.forEach(function(element) {
                    if (classToRemove) {
                        element.classList.remove(classToRemove);
                    }
                    if (classToAdd) {
                        element.classList.add(classToAdd);
                    }
                });
            } else {
                if (classToRemove) {
                    elements.classList.remove(classToRemove);
                }
                if (classToAdd) {
                    elements.classList.add(classToAdd);
                }
            }
        }
    </script>
    <!-- chuyền thẻ -->
    <script>
        function fillData(hangbay, gioDi, diemDi, gioDen, diemDen, flightDuration, gia, lon, tre, be) {
            let imageTag = "";
            if (hangbay === "Vietjet") {
                imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vietjet.png' alt='Viettel' style='width:90px;height:20px;margin-left:5px;'>";
            } else if (hangbay === "VietnamAirlines") {
                imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vnair.png' alt='VietnamAirlines' style='width:55px;height:20px;margin-left:5px;'>";
            } else if (hangbay === "Bamboo") {
                imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/bamboo.png' alt='Bamboo' style='width:25px;height:20px;margin-left:5px;'>";
            }
            console.log(hangbay);
            document.getElementById('hangbay').innerHTML = imageTag + " " + hangbay + " - Eco";
            document.getElementById('gioDi').innerHTML = gioDi;
            document.getElementById('diemDi').innerHTML = diemDi;
            document.getElementById('gioDen').innerHTML = gioDen;
            document.getElementById('diemDen').innerHTML = diemDen;
            document.getElementById('flightDuration').innerHTML = flightDuration + ', Bay thẳng';
            document.getElementById('gia').innerHTML = gia;
            document.getElementById('lon').value = lon;
            document.getElementById('tre').value = tre;
            document.getElementById('be').value = be;
            document.getElementById('giavd').value = gia.replace(/[^\d]/g, '');
            document.getElementById('giod').value = gioDi;
            document.getElementById('giov').value = gioDen;
            document.getElementById('hmaybay').value = hangbay;
        }
        function fillData1(hangbay, gioDi, diemDi, gioDen, diemDen, flightDuration, gia, lon, tre, be) {
            let imageTag = "";
            if (hangbay === "Vietjet") {
                imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vietjet.png' alt='Viettel' style='width:90px;height:20px;margin-left:5px;'>";
            } else if (hangbay === "VietnamAirlines") {
                imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vnair.png' alt='VietnamAirlines' style='width:55px;height:20px;margin-left:5px;'>";
            } else if (hangbay === "Bamboo") {
                imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/bamboo.png' alt='Bamboo' style='width:25px;height:20px;margin-left:5px;'>";
            }
            document.getElementById('hangbay1').innerHTML = imageTag + " " + hangbay + " - Eco";
            document.getElementById('gioDi1').innerHTML = gioDi;
            document.getElementById('diemDi1').innerHTML = diemDi;
            document.getElementById('gioDen1').innerHTML = gioDen;
            document.getElementById('diemDen1').innerHTML = diemDen;
            document.getElementById('flightDuration1').innerHTML = flightDuration + ', Bay thẳng';
            document.getElementById('gia1').innerHTML = gia;
            document.getElementById('lon1').value = lon;
            document.getElementById('tre1').value = tre;
            document.getElementById('be1').value = be;
            document.getElementById('giavv').value = gia.replace(/[^\d]/g, '');
            document.getElementById('giod1').value = gioDi;
            document.getElementById('giov1').value = gioDen;
            document.getElementById('hmaybay1').value = hangbay;
        }
    </script>
    <!-- giá vé -->
    <?php
        function calculateTotalPrice($basePrice, $departureTime, $class, $adults, $children, $infants) {
            $adultPrice = calculateTicketPrice($basePrice, $departureTime, $class, "adult");
            $childPrice = calculateTicketPrice($basePrice, $departureTime, $class, "child");
            $infantPrice = calculateTicketPrice($basePrice, $departureTime, $class, "infant");

            return $adults * $adultPrice + $children * $childPrice + $infants * $infantPrice;
        }

        // Hàm tính giá vé dựa trên giờ đi, hạng vé, loại hành khách và khoảng cách
        function calculateTicketPrice($basePrice, $departureTime, $class, $passengerType) {
            $departureDateTime = new DateTime($departureTime);
            $hour = $departureDateTime->format('H');

            // Tăng giảm giá vé theo giờ đi
            if ($hour >= 7 && $hour <= 10) {
                $price = $basePrice * 1.1; // 10% tăng giá vào giờ cao điểm
            } elseif ($hour >= 21 || $hour < 6) {
                $price = $basePrice * 0.9; // 10% giảm giá vào giờ thấp điểm
            } else {
                $price = $basePrice; // Giá bình thường vào các giờ khác
            }

            // Tăng giảm giá vé theo hạng vé
            if ($class == "Thương gia") {
                $price *= 2; // Gấp đôi giá vé cơ bản cho hạng thương gia
            }

            // Tăng giảm giá vé theo loại hành khách
            if ($passengerType == "child") {
                $price *= 0.9; // Giảm 10% giá vé cho trẻ em
            } elseif ($passengerType == "infant") {
                $price *= 0.1; // Giảm 90% giá vé cho trẻ nhỏ
            }
            return $price;
        }
    ?>
    <!-- thẻ -->
    <script>
        window.addEventListener('load', function() {
        var parentDiv = document.getElementById('cot');
        var stickyElement = document.getElementById('ve');
        var placeholder = null;
        var initialOffset = parentDiv.offsetTop; // Vị trí ban đầu của phần tử stickyElement

        // Lưu trữ kích thước ban đầu của stickyElement
        var initialStickyWidth = stickyElement.offsetWidth;
        var initialStickyHeight = stickyElement.offsetHeight;

        // Kiểm tra và thực hiện "trôi" theo màn hình
        function checkStickyBehavior() {
            var scrollY = window.scrollY || window.pageYOffset;
            var hasGridDiv2Class = stickyElement.classList.contains('grid-div2');

            if (hasGridDiv2Class && scrollY >= initialOffset) {
                if (!placeholder) {
                    placeholder = document.createElement('div');
                    placeholder.className = 'placeholder';
                    placeholder.style.height = initialStickyHeight + 'px';
                    stickyElement.parentNode.insertBefore(placeholder, stickyElement);
                    stickyElement.style.position = 'fixed';
                    stickyElement.style.top = '80px';
                    var newWidth = initialStickyWidth - 30;
                    stickyElement.style.width = newWidth + 'px';
                    // Sử dụng chiều rộng ban đầu
                }
            } else {
                if (placeholder) {
                    placeholder.parentNode.removeChild(placeholder);
                    placeholder = null;
                    stickyElement.style.position = '';
                    stickyElement.style.top = '';
                    stickyElement.style.width = ''; // Đặt lại chiều rộng khi không còn "trôi"
                }
            }
        }

        // Xử lý khi cuộn trang
        window.addEventListener('scroll', checkStickyBehavior);

        // Sử dụng MutationObserver để theo dõi thay đổi của phần tử 've'
        var observer = new MutationObserver(function(mutationsList, observer) {
            mutationsList.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    var currentClass = stickyElement.className;
                    var hasGridDiv2Class = stickyElement.classList.contains('grid-div2');

                    if (hasGridDiv2Class) {
                        // Lấy lại kích thước khi chuyển qua class grid-div2
                        initialStickyWidth = stickyElement.offsetWidth;
                        initialStickyHeight = stickyElement.offsetHeight;

                        // Xử lý khi có class grid-div2 (kích hoạt lại "trôi")
                        checkStickyBehavior();
                    } else {
                        // Xử lý khi có class grid-div1 (vô hiệu hóa "trôi")
                        if (placeholder) {
                            placeholder.parentNode.removeChild(placeholder);
                            placeholder = null;
                        }
                        stickyElement.style.position = '';
                        stickyElement.style.top = '';
                        stickyElement.style.width = ''; // Đặt lại chiều rộng khi không còn "trôi"
                    }
                }
            });
        });

        // Bắt đầu quan sát các thay đổi trong phần tử 've'
        observer.observe(stickyElement, { attributes: true });

        // Xử lý ban đầu khi tải trang
        checkStickyBehavior();
        });


    </script>
    <script>
        window.addEventListener('load', function() {
        var parentDiv = document.getElementById('cot');
        var stickyElement = document.getElementById('ve1');
        var placeholder = null;
        var initialOffset = parentDiv.offsetTop; // Vị trí ban đầu của phần tử stickyElement

        // Lưu trữ kích thước ban đầu của stickyElement
        var initialStickyWidth = stickyElement.offsetWidth;
        var initialStickyHeight = stickyElement.offsetHeight;

        // Kiểm tra và thực hiện "trôi" theo màn hình
        function checkStickyBehavior() {
            var scrollY = window.scrollY || window.pageYOffset;
            var hasGridDiv2Class = stickyElement.classList.contains('grid-div2');

            if (hasGridDiv2Class && scrollY >= initialOffset) {
                if (!placeholder) {
                    placeholder = document.createElement('div');
                    placeholder.className = 'placeholder';
                    placeholder.style.height = initialStickyHeight + 'px';
                    stickyElement.parentNode.insertBefore(placeholder, stickyElement);
                    stickyElement.style.position = 'fixed';
                    stickyElement.style.top = '80px';
                    stickyElement.style.right = '12.25%';
                    var newWidth = initialStickyWidth - 20;
                    stickyElement.style.width = newWidth + 'px';
                    // Sử dụng chiều rộng ban đầu
                }
            } else {
                if (placeholder) {
                    placeholder.parentNode.removeChild(placeholder);
                    placeholder = null;
                    stickyElement.style.position = '';
                    stickyElement.style.top = '';
                    stickyElement.style.width = ''; // Đặt lại chiều rộng khi không còn "trôi"
                }
            }
        }

        // Xử lý khi cuộn trang
        window.addEventListener('scroll', checkStickyBehavior);

        // Sử dụng MutationObserver để theo dõi thay đổi của phần tử 've'
        var observer = new MutationObserver(function(mutationsList, observer) {
            mutationsList.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    var currentClass = stickyElement.className;
                    var hasGridDiv2Class = stickyElement.classList.contains('grid-div2');

                    if (hasGridDiv2Class) {
                        // Lấy lại kích thước khi chuyển qua class grid-div2
                        initialStickyWidth = stickyElement.offsetWidth;
                        initialStickyHeight = stickyElement.offsetHeight;

                        // Xử lý khi có class grid-div2 (kích hoạt lại "trôi")
                        checkStickyBehavior();
                    } else {
                        // Xử lý khi có class grid-div1 (vô hiệu hóa "trôi")
                        if (placeholder) {
                            placeholder.parentNode.removeChild(placeholder);
                            placeholder = null;
                        }
                        stickyElement.style.position = '';
                        stickyElement.style.top = '';
                        stickyElement.style.width = ''; // Đặt lại chiều rộng khi không còn "trôi"
                    }
                }
            });
        });

        // Bắt đầu quan sát các thay đổi trong phần tử 've'
        observer.observe(stickyElement, { attributes: true });

        // Xử lý ban đầu khi tải trang
        checkStickyBehavior();
        });


    </script>

    <script>
        function handleUpdate() {
            var element1 = document.getElementById("<?php if($data['kv']=="Một chiều"){echo "cot1";}else{echo "cot";} ?>");
            document.getElementById("kieuve1").value = document.getElementById("kieuve").value;
            document.getElementById("hangcb").value = document.getElementById("hangmb").value;
            document.getElementById("gdut").value = document.getElementById("timgd").value;
            document.getElementById("gvut").value = document.getElementById("timgv").value;
            document.getElementById("hangbayloc").value = document.getElementById("kieuloc").value;
            document.getElementById("hangbayloc1").value = document.getElementById("kieuloc1").value;
            element1.classList.add("grid-thu");

        }
        function handleUpdate1() {
            var element1 = document.getElementById("<?php if($data['kv']=="Một chiều"){echo "cot1";}else{echo "cot";} ?>");
            document.getElementById("kieuve1").value = document.getElementById("kieuve").value;
            document.getElementById("hangcb").value = document.getElementById("hangmb").value;
            document.getElementById("gdut").value = document.getElementById("timgd").value;
            document.getElementById("gvut").value = document.getElementById("timgv").value;
            document.getElementById("hangbayloc").value = document.getElementById("kieuloc").value;
            document.getElementById("hangbayloc1").value = document.getElementById("kieuloc1").value;
            element1.classList.add("grid-thu");
            document.getElementById('action').value = 'kieuloc';
            document.getElementById('autoForm').submit();
        }
    </script>
    <script>
        function showDetails(link) {
            // Tìm thẻ div chứa bảng chi tiết (nằm trong thẻ cha của link)
            var detailTable = link.parentNode.querySelector('.detail-table');
            
            // Đảo ngược trạng thái hiển thị của bảng chi tiết
            if (detailTable.style.display === 'none') {
                detailTable.style.display = 'block';
            } else {
                detailTable.style.display = 'none';
            }
        }
    </script>
    <!----load---->
    <?php
        function load2($diemDi, $diemDen, $soNguoiLon, $soTreEm, $soTreNho, $gdloc = null, $hbloc = null, $hangcb = null){
            require_once 'MVC/Core/connectDB1.php';
            $db = new connectDB1();
            $conn = $db->getConnection();
            
            // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
            $sql = "SELECT DiemDi, DiemDen, Hang, HangBay, Gia, GioDi FROM giave WHERE DiemDi='$diemDi' AND DiemDen='$diemDen'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $diemDiFromSQL = $row["DiemDi"];
                    $diemDenFromSQL = $row["DiemDen"];
                    $hang = $row["Hang"];
                    $hangbay = $row["HangBay"];
                    $giaCoBan = $row["Gia"];
                    $gioDi = $row["GioDi"];

                    // Lặp để in nhiều thẻ cách nhau 2 tiếng cho đến 23 giờ
                    $gioDiDateTime = new DateTime($gioDi);
                    while ($gioDiDateTime->format('H') != 0 && $gioDiDateTime->format('H') != 1) {
                        // Tính toán giá vé dựa trên số lượng hành khách, giờ đi, hạng vé và khoảng cách
                        $giaCuoiCung = calculateTotalPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, $soNguoiLon, $soTreEm, $soTreNho);
                        $giaNguoiLon = calculateTicketPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, "adult");
                        $giaTreEm = calculateTicketPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, "child");
                        $giaEmBe = calculateTicketPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, "infant");
                        // Định dạng giá vé
                        $gia = number_format($giaCuoiCung, 0, ',', '.') . " VND";
                        $gianl = number_format($giaNguoiLon, 0, ',', '.') . " VND";
                        $giate = number_format($giaTreEm, 0, ',', '.') . " VND";
                        $giaeb = number_format($giaEmBe, 0, ',', '.') . " VND";

                        // Truy vấn thời gian bay từ bảng thoigianbay
                        $flightTimeSql = "SELECT ThoiGianBay FROM thoigianbay WHERE DiemDi='$diemDi' AND DiemDen='$diemDen'";
                        $flightTimeResult = $conn->query($flightTimeSql);
                        if ($flightTimeResult->num_rows > 0) {
                            $flightTimeRow = $flightTimeResult->fetch_assoc();
                            $thoiGianBay = $flightTimeRow["ThoiGianBay"];
                        } else {
                            $thoiGianBay = '02:10:00'; // Giả sử thời gian bay mặc định là 2 giờ 10 phút nếu không tìm thấy
                        }

                        // Tách giờ và phút từ ThoiGianBay
                        list($hours, $minutes, $seconds) = explode(':', $thoiGianBay);

                        // Tính toán giờ đến dựa trên thời gian bay
                        $gd = $gioDiDateTime->format('H:i');
                        $flightDuration = new DateInterval("PT{$hours}H{$minutes}M");
                        $gioDiDateTimeClone = clone $gioDiDateTime; // Clone để giữ thời gian gốc
                        $gioDiDateTimeClone->add($flightDuration);
                        $gioDen = $gioDiDateTimeClone->format('H:i');

                        // Xác định thẻ hình ảnh dựa trên hãng hàng không
                        $imageTag = "";
                        if ($hangbay == "Vietjet") {
                            $imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vietjet.png' alt='Viettel' style='width:90px;height:20px;margin-left:5px;'>";
                        } else if ($hangbay == "VietnamAirlines") {
                            $imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vnair.png' alt='VietnamAirlines' style='width:55px;height:20px;margin-left:5px;'>";
                        } else if ($hangbay == "Bamboo") {
                            $imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/bamboo.png' alt='Bamboo' style='width:25px;height:20px;margin-left:5px;'>";
                        }
                        $class = 'grid-div';$hcb = "Eco";
                        if($hang=="Phổ thông"){
                            $hcb = "Eco";
                        }
                        else if($hang=="Thương gia"){
                            $hcb = "Business";
                        }
                        if($gdloc!=null&&$hangcb!="Nhiều hạng"){
                            $loc = str_replace(":", "", $gdloc);
                            $ss = str_replace(":", "", $gd);
                            
                            $class = 'grid-thu';
                            
                            if ((int)$ss >= (int)$loc && ($hbloc == 'Tất cả' || $hbloc == $hangbay) && $hang == $hangcb) {
                                $class = 'grid-div';
                                if($hangcb=="Phổ thông"){
                                    $hcb = "Eco";
                                }
                                else if($hangcb=="Thương gia"){
                                    $hcb = "Business";
                                }
                            }
                        }
                        else if($gdloc!=null){
                            $loc = str_replace(":", "", $gdloc);
                            $ss = str_replace(":", "", $gd);
                            
                            $class = 'grid-thu';
                            
                            if ((int)$ss >= (int)$loc && ($hbloc == 'Tất cả' || $hbloc == $hangbay)) {
                                $class = 'grid-div';
                            }
                        }
                        $cl='';$cl1='';$cl2='';
                        if($soNguoiLon==0){
                            $cl = "grid-thu";
                        }
                        if($soTreEm==0){
                            $cl1 = "grid-thu";
                        }
                        if($soTreNho==0){
                            $cl2 = "grid-thu";
                        }
                        // Hiển thị thẻ vé máy bay
                        echo "<div class='$class'>
                            <div class='text-danger'>$imageTag $hangbay - $hcb</div>
                            <div class='phanlo' id='lodi'>
                                <div class='phancot'>
                                    <div>
                                        <p style='margin-bottom: 8px;'>$gd</p>
                                        <p style='margin-top: 8px;'>$diemDi</p>
                                    </div>
                                    <div><p>✈</p></div>
                                </div>
                                <div>
                                    <p style='margin-bottom: 8px;'>$gioDen</p>
                                    <p style='margin-top: 8px;'>$diemDen</p>
                                </div>
                                <div class='hien' id='hieng'>
                                    <p style='margin-bottom: 8px;'>{$flightDuration->h}h {$flightDuration->i}p</p>
                                    <p style='margin-top: 8px;'>Bay thẳng</p>
                                </div>
                                <div style='justify-self: end;' id='spandi' class='ss'>
                                    <p style='margin: 7px;'><strong>$gia</strong></p>
                                    <p style='margin: 7px;' class='hienbut'>
                                        <button 
                                        type='button' class='hien' id='hienb' 
                                        onclick='fillData(\"$hangbay\", \"$gd\", \"$diemDi\", \"$gioDen\", \"$diemDen\", \"{$flightDuration->h}h {$flightDuration->i}p\", \"$gia\", \"$soNguoiLon x " . number_format($giaNguoiLon, 0, ',', '.') . "\", \"$soTreEm x " . number_format($giaTreEm, 0, ',', '.') . "\", \"$soTreNho x " . number_format($giaEmBe, 0, ',', '.') . "\")' 
                                        style='color: white;cursor: pointer;border: 1px solid #f68709;background-color: #f79321;transition: all .15s ease-in-out;width: 100%;border-radius: 4px;font-size: 13px;padding: 5px;max-width: 120px;z-index: 1;position: relative;'
                                        >Chọn
                                        </button>
                                    </p>
                                </div>
                            </div> 
                            <div class='hien' id='hienb'>
                                <span onclick='showDetails(this)' style='color: #26bed6; cursor: pointer;'>Chi tiết vé</span>
                                <div class='detail-table' style='display: none;'>
                                    <div><hr/></div>
                                    <div style='margin: 10px 0px;'>
                                        <span>$diemDi</span>
                                        <span>→</span>
                                        <span>$diemDen</span>
                                    </div>
                                    <div style='color: #828282;margin: 10px 0px 30px 0px;'>$hcb</div>
                                    <div class='$cl' style='display: grid; grid-template-columns: 4fr 1fr'>
                                        <div>Giá vé người lớn (x$soNguoiLon)</div>
                                        <div style='text-align: right;'>$gianl</div>
                                    </div>
                                    <div class='$cl1' style='display: grid; grid-template-columns: 4fr 1fr;margin: 10px 0px;'>
                                        <div>Giá vé người lớn (x$soTreEm)</div>
                                        <div style='text-align: right;'>$giate</div>
                                    </div>
                                    <div class='$cl2' style='display: grid; grid-template-columns: 4fr 1fr;margin: 10px 0px;'>
                                        <div>Giá vé người lớn (x$soTreNho)</div>
                                        <div style='text-align: right;'>$giaeb</div>
                                    </div>
                                    <div style='display: grid; grid-template-columns: 5fr 1fr;margin: 10px 0px;'>
                                        <div style='color: #828282;'>Thuế phí</div>
                                        <div style='text-align: right; color: #828282;'>Đã bao gồm</div>
                                    </div>
                                    <div><hr/></div>
                                    <div style='display: grid; grid-template-columns: 4fr 1fr'>
                                        <div>Thành tiền:</div>
                                        <div style='text-align: right; color: #828282;'>$gia</div>
                                    </div>
                                </div>
                            </div>   
                        </div>";

                        // Tăng thời gian đi lên 2 tiếng
                        $gioDiDateTime->add(new DateInterval('PT2H'));
                    }
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            
            // Hàm tính giá vé tổng dựa trên giờ đi, hạng vé, số lượng hành khách và khoảng cách
        }
        function load3($diemDen, $diemDi, $soNguoiLon, $soTreEm, $soTreNho, $gdloc = null, $hbloc = null, $hangcb = null){
            require_once 'MVC/Core/connectDB1.php';
            $db = new connectDB1();
            $conn = $db->getConnection();

            // Lấy dữ liệu từ $data (giả sử dữ liệu từ một form hoặc nguồn dữ liệu khác)
            // $diemDen = $data['tu'];
            // $diemDi = $data['den'];
            // $soNguoiLon = $data['lon'];
            // $soTreEm = $data['tre'];
            // $soTreNho = $data['be'];

            // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
            $sql = "SELECT DiemDi, DiemDen, Hang, HangBay, Gia, GioDi FROM giave WHERE DiemDi='$diemDen' AND DiemDen='$diemDi'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $diemDiFromSQL = $row["DiemDi"];
                    $diemDenFromSQL = $row["DiemDen"];
                    $hang = $row["Hang"];
                    $hangbay = $row["HangBay"];
                    $giaCoBan = $row["Gia"];
                    $gioDi = $row["GioDi"];

                    // Lặp để in nhiều thẻ cách nhau 2 tiếng cho đến 23 giờ
                    $gioDiDateTime = new DateTime($gioDi);
                    while ($gioDiDateTime->format('H') != 0 && $gioDiDateTime->format('H') != 1) {
                        // Tính toán giá vé dựa trên số lượng hành khách, giờ đi, hạng vé và khoảng cách
                        $giaCuoiCung = calculateTotalPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, $soNguoiLon, $soTreEm, $soTreNho);
                        $giaNguoiLon = calculateTicketPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, "adult");
                        $giaTreEm = calculateTicketPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, "child");
                        $giaEmBe = calculateTicketPrice($giaCoBan, $gioDiDateTime->format('Y-m-d H:i:s'), $hang, "infant");

                        // Định dạng giá vé
                        $gia = number_format($giaCuoiCung, 0, ',', '.') . " VND";
                        $gianl = number_format($giaNguoiLon, 0, ',', '.') . " VND";
                        $giate = number_format($giaTreEm, 0, ',', '.') . " VND";
                        $giaeb = number_format($giaEmBe, 0, ',', '.') . " VND";

                        // Truy vấn thời gian bay từ bảng thoigianbay
                        $flightTimeSql = "SELECT ThoiGianBay FROM thoigianbay WHERE DiemDi='$diemDi' AND DiemDen='$diemDen'";
                        $flightTimeResult = $conn->query($flightTimeSql);
                        if ($flightTimeResult->num_rows > 0) {
                            $flightTimeRow = $flightTimeResult->fetch_assoc();
                            $thoiGianBay = $flightTimeRow["ThoiGianBay"];
                        } else {
                            $thoiGianBay = '02:10:00'; // Giả sử thời gian bay mặc định là 2 giờ 10 phút nếu không tìm thấy
                        }

                        // Tách giờ và phút từ ThoiGianBay
                        list($hours, $minutes, $seconds) = explode(':', $thoiGianBay);

                        // Tính toán giờ đến dựa trên thời gian bay
                        $gd = $gioDiDateTime->format('H:i');
                        $flightDuration = new DateInterval("PT{$hours}H{$minutes}M");
                        $gioDiDateTimeClone = clone $gioDiDateTime; // Clone để giữ thời gian gốc
                        $gioDiDateTimeClone->add($flightDuration);
                        $gioDen = $gioDiDateTimeClone->format('H:i');

                        // Xác định thẻ hình ảnh dựa trên hãng hàng không
                        $imageTag = "";
                        if ($hangbay == "Vietjet") {
                            $imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vietjet.png' alt='Viettel' style='width:90px;height:20px;margin-left:5px;'>";
                        } else if ($hangbay == "VietnamAirlines") {
                            $imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/vnair.png' alt='VietnamAirlines' style='width:55px;height:20px;margin-left:5px;'>";
                        } else if ($hangbay == "Bamboo") {
                            $imageTag = "<img src='/hoanghuy/Deadline/Public/Pictures/bamboo.png' alt='Bamboo' style='width:25px;height:20px;margin-left:5px;'>";
                        }
                        $class = 'grid-div';$hcb = "Eco";
                        if($hang=="Phổ thông"){
                            $hcb = "Eco";
                        }
                        else if($hang=="Thương gia"){
                            $hcb = "Business";
                        }
                        if($gdloc!=null&&$hangcb!="Nhiều hạng"){
                            $loc = str_replace(":", "", $gdloc);
                            $ss = str_replace(":", "", $gd);
                            
                            $class = 'grid-thu';
                            
                            if ((int)$ss >= (int)$loc && ($hbloc == 'Tất cả' || $hbloc == $hangbay) && $hang == $hangcb) {
                                $class = 'grid-div';
                                if($hangcb=="Phổ thông"){
                                    $hcb = "Eco";
                                }
                                else if($hangcb=="Thương gia"){
                                    $hcb = "Business";
                                }
                            }
                        }
                        else if($gdloc!=null){
                            $loc = str_replace(":", "", $gdloc);
                            $ss = str_replace(":", "", $gd);
                            
                            $class = 'grid-thu';
                            
                            if ((int)$ss >= (int)$loc && ($hbloc == 'Tất cả' || $hbloc == $hangbay)) {
                                $class = 'grid-div';
                            }
                        }
                        $cl='';$cl1='';$cl2='';
                        if($soNguoiLon==0){
                            $cl = "grid-thu";
                        }
                        if($soTreEm==0){
                            $cl1 = "grid-thu";
                        }
                        if($soTreNho==0){
                            $cl2 = "grid-thu";
                        }
                        // Hiển thị thẻ vé máy bay
                        echo "<div class='$class'>
                            <div class='text-danger'>$imageTag $hangbay - $hcb</div>
                            <div class='phanlo-an' id='love'>
                                <div class='phancot'>
                                    <div>
                                        <p style='margin-bottom: 8px;'>$gd</p>
                                        <p style='margin-top: 8px;'>$diemDi</p>
                                    </div>
                                    <div><p>✈</p></div>
                                </div>
                                <div>
                                    <p style='margin-bottom: 8px;'>$gioDen</p>
                                    <p style='margin-top: 8px;'>$diemDen</p>
                                </div>
                                <div class='an span' id='ang'>
                                    <p style='margin-bottom: 8px;'>{$flightDuration->h}h {$flightDuration->i}p</p>
                                    <p style='margin-top: 8px;'>Bay thẳng</p>
                                </div>
                                <div style='justify-self: end;' class='span' id='spanve'>
                                    <p style='margin: 7px;'><strong>$gia</strong></p>
                                    <p style='margin: 7px;' class='anbut'><button type='button' class='an' id='anb' onclick='fillData1(\"$hangbay\", \"$gd\", \"$diemDi\", \"$gioDen\", \"$diemDen\", \"{$flightDuration->h}h {$flightDuration->i}p\", \"$gia\", \"$soNguoiLon x " . number_format($giaNguoiLon, 0, ',', '.') . "\", \"$soTreEm x " . number_format($giaTreEm, 0, ',', '.') . "\", \"$soTreNho x " . number_format($giaEmBe, 0, ',', '.') . "\")' style='color: white;cursor: pointer;border: 1px solid #f68709;background-color: #f79321;transition: all .15s ease-in-out;width: 100%;border-radius: 4px;font-size: 13px;padding: 5px;max-width: 120px;z-index: 1;position: relative;'>Chọn</button></p>
                                </div>
                            </div> 
                            <div class='an' id='anb'>
                                <span onclick='showDetails(this)' style='color: #26bed6; cursor: pointer;'>Chi tiết vé</span>
                                <div class='detail-table' style='display: none; font-size:14px;'>
                                    <div><hr/></div>
                                    <div style='margin: 10px 0px;'>
                                        <span>$diemDi</span>
                                        <span>→</span>
                                        <span>$diemDen</span>
                                    </div>
                                    <div style='color: #828282;margin: 10px 0px 30px 0px;'>$hcb</div>
                                    <div class='$cl' style='display: grid; grid-template-columns: 4fr 1fr'>
                                        <div>Giá vé người lớn (x$soNguoiLon)</div>
                                        <div style='text-align: right;'>$gianl</div>
                                    </div>
                                    <div class='$cl1' style='display: grid; grid-template-columns: 4fr 1fr;margin: 10px 0px;'>
                                        <div>Giá vé người lớn (x$soTreEm)</div>
                                        <div style='text-align: right;'>$giate</div>
                                    </div>
                                    <div class='$cl2' style='display: grid; grid-template-columns: 4fr 1fr;margin: 10px 0px;'>
                                        <div>Giá vé người lớn (x$soTreNho)</div>
                                        <div style='text-align: right;'>$giaeb</div>
                                    </div>
                                    <div style='display: grid; grid-template-columns: 5fr 1fr;margin: 10px 0px;'>
                                        <div style='color: #828282;'>Thuế phí</div>
                                        <div style='text-align: right; color: #828282;'>Đã bao gồm</div>
                                    </div>
                                    <div><hr/></div>
                                    <div style='display: grid; grid-template-columns: 4fr 1fr'>
                                        <div>Thành tiền:</div>
                                        <div style='text-align: right; color: #828282;'>$gia</div>
                                    </div>
                                </div>
                            </div>   
                        </div>";

                        // Tăng thời gian đi lên 2 tiếng
                        $gioDiDateTime->add(new DateInterval('PT2H'));
                    }
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        }
    ?>
</form>
</body>
</html>