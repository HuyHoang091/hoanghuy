<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gddanhsach.css?v = <?php echo time(); ?>">
    <title>Danh sách khách sạn</title>
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
<header>
        <!----------------------------------------------LOGO------------------------------------------------------->
        </div class="logo">
            <img class ="logoct" src="./img/logoct.png">
        </div>
        <div class="menu">
            <li><a href="khachsan.php">Khách sạn</a></li>
            <li><a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/GD_user_danhsach_Tour.php">Tour</a></li>
            <li><a href="/hoanghuy/Deadline/">Vé máy bay</a></li>
            <li><a href="/hoanghuy/Deadline/sinhvien/sinhvien/gioithieu.html">Giới thiệu</a></li>
            <li><a href="/hoanghuy/Deadline/sinhvien/sinhvien/hotro.html">Hỗ trợ</a></li>
            
        </div>
        <div class="ctn-search">
          <form  action="" method="POST"> 
            <div class="ql-search"><input type="text" name="search" placeholder="Tìm kiếm"><button href=""><img src="./img/timkiem.png"></button></div>
        </form>
        
        </div>
    </header>
<!------------------------------------------------------BODY-MLEM--------------------------------------------------------------------------------->

<section class="main-body">
    <div class="filter-container">
        <div class="menu-main">
            <h2>Một số địa điểm khác</h2>
            <div>
                <a href="danhsachkhachsan.php?xid=Ninh Bình"><button>Khách sạn Ninh Bình</button></a>
            </div>
            <div>
                <a href="danhsachkhachsan.php?xid=Hà Nội"><button>Khách sạn Hà Nội</button></a>
            </div>
            <div>
                <a href="danhsachkhachsan.php?xid=Vũng Tàu"><button>Khách sạn Vũng Tàu</button></a>
            </div>
            <div>
                <a href="danhsachkhachsan.php?xid=Quảng Bình"><button>Khách sạn Quảng Bình</button></a>
            </div>
            <div>
                <a href="danhsachkhachsan.php?xid=Hồ Chí Minh"><button>Khách sạn Hồ Chí Minh</button></a>
            </div>
            <div>
                <a href="danhsachkhachsan.php?xid=Khánh Hòa"><button>Khách sạn Khánh Hòa</button></a>
            </div>
            <div>
                <a href="danhsachkhachsan.php?xid=Nam Định"><button>Khách sạn Nam Định</button></a>
            </div>
        </div>
    </div>
        <!---------------------------------------------Content------------------------------------------------------->

        <div class="main-content">
            
            <div class="detail">
                <?php 
                require_once 'ketnoi.php';
                if(isset($_POST['search'])&&($_POST!="")){
                    $search = $_POST["search"];
                   }
                   else{
                    $search = $_GET["xid"];
                   }
                   if ($search != '') {
                    $danh_sach_khach_san = "SELECT * FROM hotel WHERE cityHotel LIKE '%" . $search . "%'";
               }
           else 
           $danh_sach_khach_san = "SELECT * FROM hotel";
           $ketqua = mysqli_query($conn,$danh_sach_khach_san);
           if (mysqli_num_rows($ketqua) > 0){
           $kq = mysqli_fetch_array($ketqua);
           $cityHotel = $kq["cityHotel"];
           $danh_sach_thanh_pho = "SELECT * FROM city WHERE nameCity = '$cityHotel'";
           $danh_sach_tp = mysqli_query($conn,$danh_sach_thanh_pho);
           $final = mysqli_fetch_array($danh_sach_tp);
                ?>
                <h2><?php echo $final["nameCity"]; ?></h2>
                <img src="./picture/<?php echo $final["pictureCity"] ?>">
                <p><?php echo $final["detailCity"] ?></p>
            
            </div>
            <div class="content-container">            

            <h2>Danh sách khách sạn <?php echo $final["nameCity"]; ?></h2>
            <?php
           }
           else{
            echo "<h2 class='loi'>Không tìm thấy dữ liệu <h2>";
           }
           ?>
                <?php 
                require_once 'ketnoi.php';
                if(isset($_POST['search'])&&($_POST!="")){
                    $search = $_POST["search"];
                   }
                   else{
                    $search = $_GET["xid"];
                   }
                if ($search != '') {
                         $danh_sach_khach_san = "SELECT * FROM hotel WHERE cityHotel LIKE '%" . $search . "%'";
                    }
                else 
                $danh_sach_khach_san = "SELECT * FROM hotel";
                $ketqua = mysqli_query($conn,$danh_sach_khach_san);
                if (mysqli_num_rows($ketqua) > 0){
                while($row = mysqli_fetch_array($ketqua)){
                    
                $idHotel = $row["id"];
                $lay_so_tien = "SELECT priceCategory FROM roomCategory WHERE idHotel = $idHotel";
                $kq = mysqli_query($conn,$lay_so_tien);
                $tong = 0;
                $dem = 0;
                 while ($tien = mysqli_fetch_array($kq)) {
                $so_tien = (float)$tien["priceCategory"];
                $tong = $tong + $so_tien;
                $dem ++;
                }
                $tbc = $tong/$dem;
            ?>
            <div class="container-ds">
            <div class="content">
                    <a href="danhsachloaiphong.php?xid=<?php echo $row['id'];?>"><img class="img-hotel" src="./picture/<?php echo $row["pictureHotel"] ?>" alt=""></a>
                    <a  href="danhsachloaiphong.php?xid=<?php echo $row['id'];?>"><h2 class ="name-hotel"><?php echo $row["nameHotel"]  ?></h2></a><br>
                    <a  href="danhsachloaiphong.php?xid=<?php echo $row['id'];?>"><h3 class="intro-hotel"><?php echo $row["introHotel"] ?></h3></a><br>
                    <a  href="danhsachloaiphong.php?xid=<?php echo $row['id'];?>"><p><?php echo $row["numberHotel"] ?> <?php echo $row["roadHotel"] ?> <?php echo $row["cityHotel"] ?> <?php echo $row["countryHotel"] ?></p></a><br>
                    <a  href="danhsachloaiphong.php?xid=<?php echo $row['id'];?>"><p class="buyCount-hotel">Lượt đặt: <?php echo $row["buyCountHotel"] ?></p></a>
                </div>
            <div class ="tbc">
                <a class ="lable-tbc" href="danhsachloaiphong.php?xid=<?php echo $idHotel;?>"><p>Giá trung bình 1 ngày: </p></a>
                <a class="kq-tbc" href="danhsachloaiphong.php?xid=<?php echo $idHotel?>"><p><?php echo $tbc ?> $</p></a>
            </div>
            </div>
            <?php
            }
        }
        else{
            echo "<p class='loi'>Null<p>";
        }
            ?>
    
            </div>
        </div>
    </section>
        <!----------------------------------------------IMG-APP------------------------------------------------------->
        <section class="app-container">
        
        <div class="img-app">
            <p>Tải ứng dụng UTTVIVU</p>
            <img src="./img/appstore.png">
            <img src="./img/googleplay.png">
        </div>

    </section>
    <!----------------------------------------------FOOT------------------------------------------------------->
    <section class="footer-top">
        <li><a href=""><img src="./img/logoct.png"></a></li>
        <li><a href=""></a>Liên hệ</li>
        <li><a href=""></a>Điều kiện & Điều khoản</li>
        <li><a href=""></a>Giới thiệu</li>
        <li>
            <a href="" class="fab fa-facebook-f"></a>
            <a href="" class="fab fa-youtube"></a>
            <a href="" class="fab fa-twitter"></a>
            <a href="" class="fab fa-tiktok"></a>
        </li>
    </section>
    <section class="footer-center">
    <p>
        Công ty cổ phần trách nhiệm hữu hạn 4 thành viên với số đăng ký kinh doanh: 0123456789 <br>
        Địa chỉ: 54 Triều Khúc, Thanh Xuân, Hà Nội <br>
        Hỗ trợ: <b> 0969688842 </b>
    </p>
    </section>
    <section class="footer-bottom">
        <p>4tv@tourtravelchill.com</p>
    </section>
    <div id="iframeContainer">
        <iframe id="iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
    </div>
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
    <!--------------------------------------------------SCRIP---------------------------------------------------------->

</body>
<script>
    const header = document.querySelector("header")
    window.addEventListener("scroll",function(){    
    x = window.pageYOffset
    console.log(x)
    if(x>0){
        header.classList.add("sticky")
    }
    else{
        header.classList.remove("sticky")
    }
})
</script>
</html>