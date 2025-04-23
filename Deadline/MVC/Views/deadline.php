<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm và đặt vé máy bay</title>
    <!-- Link tới các file CSS bên ngoài -->
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/header.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/content5.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/globalcss.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/menu.css">
    <script src="https://kit.fontawesome.com/40f672cbfb.js" crossorigin="anonymous"></script>
    
    <!-- CSS chỉ định cho tab content -->
    <style>
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        body{
            margin: 0px;
        }
        .footer{
        text-align: center;
        }
        .footer-top{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        height: 70px;
        }
        .footer-top img{
        height: 50px;

        }
        .footer-top li{
        padding: 0 12px;
        position: relative;
        }
        .footer-top li::after{
        content: "";
        display: block;
        width: 1px;
        height: 80%;
        background: darkblue;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        }
        .footer-top li:last-child::after{
        display: none;
        }
        .footer-top li:last-child a{
        margin-right: 10px;
        color:cyan;
        }
        .footer-center{
        text-align: center;
        }
        .footer-bottom {
        margin: 20px 0;
        text-align: center;
        }
    </style>
    <style>
        #iframeContainer {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 23%;
            height: 60%;
            border: 2px solid #000;
            background-color: #a29a9ad1;
            z-index: 1000;
            border: none;
            border-radius: 10px;
        }
        #showButton {
            margin: 20px;
        }
    </style>
    
</head>
<body>
    <header style="background: rgba(255, 255, 255, 0.5);">
        <!----------------------------------------------LOGO------------------------------------------------------->
        </div class="logo">
            <img class ="logoct" src="/hoanghuy/Deadline/Public/Pictures/img/logoct.png">
        </div>
        <div class="menu">
            <li><a href="/hoanghuy/Deadline/BaiTapLon/khachsan.php">Khách sạn</a></li>
            <li><a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/GD_user_danhsach_Tour.php">Tour</a></li>
            <li><a href="/hoanghuy/Deadline/Home/Get_data">Vé máy bay</a></li>
            <li><a href="/hoanghuy/Deadline/gioithieu.html">Giới thiệu</a></li>
            <li><a href="/hoanghuy/Deadline/hotro.html">Hỗ trợ</a></li>
            <span style="padding-left: 490px;">
                <img style="height: 30px; margin-top:4px;" src="/hoanghuy/Deadline/Public/Pictures/icondn.png" alt="">
                <div id="dn" style="display: none; background: rgb(184 185 201 / 62%);;
                                    color: white;
                                    text-align: center;
                                    padding: 10px;
                                    border-radius: 5px;
                                    width: calc(<?php if(isset($user['taikhoan'])){echo "3% +";}else{echo "";} ?> 110px);
                                    /* z-index: 1000; */
                                    position: absolute;
                                    ">
                <div id="dangn" style="cursor: pointer; 
                                        background: #26bed6; 
                                        padding: 5px; border-radius: 4px; 
                                        <?php if(isset($user['taikhoan'])){echo "display: none";}else{echo "display: block";} ?>">
                    Đăng nhập
                </div>
                <div style="<?php if(isset($user['taikhoan'])){echo "display: block";}else{echo "display: none";} ?>">
                <!-- style="<?php if(isset($user['taikhoan'])){if($user['quyen']=='admin'){echo "display: block";}else{echo "display: none";}} ?>" -->
                    <div>
                        <div onclick="window.location.href='/hoanghuy/Deadline/ve/Get_data'" style="cursor: pointer;
                                    padding: 5px;
                                    border-radius: 4px;
                                    background: #e2dbdb82;
                                    margin-bottom: 3px;
                                    color: #221c1c;<?php if(isset($user['taikhoan'])){if($user['quyen']=='admin'){echo "display: none";}else{echo "display: block";}} ?>">
                            Vé máy bay
                        </div>
                        <div onclick="window.location.href='/hoanghuy/Deadline/BaiTapLon/qldatnuoc.php'" style="cursor: pointer;
                                    padding: 5px;
                                    border-radius: 4px;
                                    background: #e2dbdb82;
                                    margin-bottom: 3px;
                                    color: #221c1c;<?php if(isset($user['taikhoan'])){if($user['quyen']=='admin'){echo "display: block";}else{echo "display: none";}} ?>">
                            Quản lý
                        </div>
                    </div>
                    <div>
                        <div onclick="window.location.href='/hoanghuy/Deadline/taikhoan/Get_data'" style="cursor: pointer;
                                    padding: 5px;
                                    border-radius: 4px;
                                    background: #e2dbdb82;
                                    margin-bottom: 3px;
                                    color: #221c1c;<?php if(isset($user['taikhoan'])){if($user['quyen']=='admin'){echo "display: none";}else{echo "display: block";}} ?>">
                            Tài khoản
                        </div>
                    </div>
                    <div onclick="logout()" style="cursor: pointer; background: #ff3232;
                                                padding: 5px;
                                                border-radius: 4px;">
                        Đăng xuất
                    </div>
                </div>
                
            </div>
            </span>
            <span id="ussser" style="margin-top:10px; cursor: pointer;">
                <?php if(isset($user['taikhoan'])){echo $user['taikhoan'];}else{echo 'Tài khoản';} ?>
                
            </span>
            
        </div>
        
    </header>
    <div id="content">
    <?php
            include './MVC/Views/Pages/'.$data['page'].'.php';
        ?>
    <div class="card-container">
        <!-- <?php
            require_once 'MVC/Core/connectDB1.php';
            $db = new connectDB1();
            $conn = $db->getConnection();

            $sql = "SELECT DiemDi, DiemDen, Hang, Gia FROM giave";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $diemDi = $row["DiemDi"];
                    $diemDen = $row["DiemDen"];
                    $hang = $row["Hang"];
                    $Gia = $row["Gia"];
                    $imageTag = "";
                    if ($hang == "Viettel") {
                        $imageTag = "<img src='./Pictures/vietjet.png' alt='Viettel' style='width:110px;height:30px;margin-left:5px;'>";
                    } else if ($hang == "VietnamAirlines") {
                        $imageTag = "<img src='./Pictures/vnair.png' alt='VietnamAirlines' style='width:95px;height:40px;margin-left:5px;'>";
                    } else if ($hang == "Bamboo") {
                        $imageTag = "<img src='./Pictures/bamboo.png' alt='Bamboo' style='width:65px;height:50px;margin-left:5px;'>";
                    }
                    echo "<div class='card-ticket'>
                        <div>
                            $diemDi - $diemDen 
                        </div>
                        <div>
                            $imageTag
                        </div>
                        <div >
                            <h0>$Gia</h0>
                        </div>
                        <button class='inner-button'>
                            Xem
                        </button>
                    </div>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?> -->
    </div>
    <div id="iframeContainer">
        <iframe id="iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
    </div>
    <div class="footer-top">
        <li><a href=""><img src="/hoanghuy/Deadline/Public/Pictures/img/logoct.png"></a></li>
        <li><a href=""></a>Liên hệ</li>
        <li><a href=""></a>Điều kiện & Điều khoản</li>
        <li><a href=""></a>Giới thiệu</li>
        <li>
            <a href="" class="fab fa-facebook-f"></a>
            <a href="" class="fab fa-youtube"></a>
            <a href="" class="fab fa-twitter"></a>
            <a href="" class="fab fa-tiktok"></a>
        </li>
    </div>
    <div class="footer-center">
    <p>
        Công ty cổ phần trách nhiệm hữu hạn 4 thành viên với số đăng ký kinh doanh: 0123456789 <br>
        Địa chỉ: 54 Triều Khúc, Thanh Xuân, Hà Nội <br>
        Hỗ trợ: <b> 0969688842 </b>
    </p>
    </div>
    <div class="footer-bottom">
        <p>4tv@tourtravelchill.com</p>
    </div>
    <!------user--->
    <script>
        function showlogin() {
            document.getElementById("iframeContainer").style.display = "block";
            document.getElementById("iframe").src = "/hoanghuy/Deadline/dangnhap.php"; 
        }

        function dangnhap(user) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/hoanghuy/Deadline/save_user.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send(JSON.stringify(user));
        }

        function logout() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/hoanghuy/Deadline/logout.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send();
        }
        
        function huydn() {
            document.getElementById("iframeContainer").style.display = "none";
        }

        function huyup(){
            document.getElementById("iframeContainer").style.display = "none";
            location.reload();
        }

        window.addEventListener('message', function(event) {
            var data = event.data;
            console.log('Received message:', data);
            if (data.functionName === "dangnhap") {
                dangnhap(data.user);
            } else if (data.functionName === "huydn") {
                huydn();
            }
            else if (data.functionName === "huyup") {
                huyup();
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("ussser").onclick = function() {
                var element = document.getElementById("dn");
                if(element.style.display === "none"){
                    element.style.display = "block";
                }
                else{
                    element.style.display = "none";
                }
            }
            document.getElementById("dangn").onclick = function() {
                var element = document.getElementById("dn");
                showlogin();
                if(element.style.display === "none"){
                    element.style.display = "block";
                }
                else{
                    element.style.display = "none";
                }
            }
        });
        function huy(){
            window.parent.postMessage('huydn', '*');
        }
        
    </script>
</body>
</html>
