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
            <span style="padding-left: 490px;">
                <img style="height: 30px; margin-top:4px;" src="/hoanghuy/Deadline/Public/Pictures/icondn.png" alt="">
                <div id="dn" style="display: none; background: rgb(184 185 201 / 62%);;
                                    color: white;
                                    text-align: center;
                                    margin-top:15px;
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
                        <div onclick="window.location.href='qldatnuoc.php'" style="cursor: pointer;
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
<!------------------------------------------------------BODY-MLEM--------------------------------------------------------------------------------->

    <section class="main-body">
    <div class="filter-container">
            <div class="menu-main">
            <h2>Một số địa điểm khác</h2>
            <div>
                <a href="khachsan.php"><button>Khách sạn Ninh Bình</button></a>
            </div>
            <div>
                <a href="qldatnuoc.php"><button>Khách sạn Hà Nội</button></a>
            </div>
            <div>
                <a href="qlhoadonkhachsan.php"><button>Khách sạn Vũng Tàu</button></a>
            </div>
            <div>
                <a href=""><button>Khách sạn Quảng Bình</button></a>
            </div>
            <div>
                <a href=""><button>Khách sạn Hồ Chí Minh</button></a>
            </div>
            <div>
                <a href=""><button>Khách sạn Khánh Hòa</button></a>
            </div>
            <div>
                <a href=""><button>Khách sạn Nam Định</button></a>
            </div>
        </div>
            </div>
        <!---------------------------------------------Content------------------------------------------------------->

        <div class="main-content">
            
            <div class="detail">
                <?php
                $idHotel = $_GET ["xid"];
                require_once 'ketnoi.php';
                $danh_sach_khach_san = "SELECT * FROM hotel WHERE id = $idHotel";
                $result = mysqli_query($conn,$danh_sach_khach_san);
                $rs = mysqli_fetch_array($result);
                ?>
                <h2><?php echo $rs["nameHotel"]; ?></h2>
                <img src="./picture/<?php echo $rs["pictureHotel"] ?>">
                <p><?php echo $rs["detailHotel"] ?></p>
            </div>
            <div class="content-container">    
            <h2>Danh sách loại phòng khách sạn <?php echo $rs["nameHotel"]; ?></h2>
                <?php 
                $idHotel = $_GET ["xid"];
                require_once 'ketnoi.php';
                $danh_sach_loai_phong = "SELECT * FROM roomCategory WHERE idHotel = $idHotel";
                $ketqua = mysqli_query($conn,$danh_sach_loai_phong);
                while($row = mysqli_fetch_array($ketqua)){

            ?>
            <div class="container-ds">
            <div class="content">
                    <a href="danhsachphong.php?xid=<?php echo $row['id'];?>"><img class="img-hotel" src="./picture/<?php echo $row["pictureCategory"] ?>"></a>
                    <a  href="danhsachphong.php?xid=<?php echo $row['id'];?>"><h2 class ="name-hotel"><?php echo $row["nameCategory"]  ?></h2></a><br>
                    <a  href="danhsachphong.php?xid=<?php echo $row['id'];?>"><p class="detail-hotel"><?php echo $row["detailCategory"] ?></p></a><br> 
                </div>
            <div class ="tbc">
                <a class ="lable-tbc" href="danhsachphong.php?xid=<?php echo $row['id'];?>"><p>Giá: </p></a>
                <a class="kq-tbc" href="danhsachphong.php?xid=<?php echo $row['id']?>"><p><?php echo $row["priceCategory"] ?>$</p></a>
            </div>
            </div>
            <?php
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