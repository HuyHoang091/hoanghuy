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
    <script src="https://kit.fontawesome.com/40f672cbfb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="gdkhachsan.css?v = <?php echo time(); ?>">
    <title>Khách sạn UTT</title>
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
            <li><a href="danhsachkhachsan.php?xid= ">Khách sạn</a></li>
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
     
         
    <!----------------------------------------------SLIDE-Main------------------------------------------------------->

        <section class="aspect-ratio-169">
            <img src="./img/ks3.jpg">
    <!----------------------------------------------SEARCH------------------------------------------------------->
            <div class="search">
            <form  action="danhsachkhachsan.php" method="POST"> 
                <li><input type="text" name="search" placeholder="Bạn muốn đi đâu?"> <button href="">Tìm kiếm</button></li>
            </form>
            </div>
        </div>
    </section>

    <section class= "slide">
        <h1 class="hot">Khách sạn hot</h1>
        <p class="hot">Nhanh tay kẻo lỡ</p>
        <div class="aspect-ratio">
            <?php 
            require_once 'ketnoi.php';
            $khach_san_hot = "SELECT * FROM hotel ORDER BY buyCountHotel DESC LIMIT 5";
            $result = mysqli_query($conn, $khach_san_hot);
            while ($row = mysqli_fetch_array($result)){
            ?>
            <a href="danhsachloaiphong.php?xid=<?php echo $row["id"]; ?>"><img src="./picture/<?php echo $row["pictureHotel"] ?>"></a>
            <?php
            }
            ?>
            
        </div>
        <section class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </section>
        <!----------------------------------------------DOT------------------------------------------------------->
    </section>
    
    
    <!----------------------------------------------FAVOURITE-DOMESTIC------------------------------------------------------->
    <section class="favourite-container">
        <h1>Một vài điểm đến trong nước dành cho bạn</h1>
        <p>Lên rừng xuống biển.Trọn vẹn Việt Nam</p>
        <div class="img img1"><a href="danhsachkhachsan.php?xid=Ninh Bình"><img src="./img/ksnhatrang1.jpg"></a><li><a href="">Ninh Bình</a></li></div>
        <div class="img img2"><a href="danhsachkhachsan.php?xid=Đà Lạt"><img src="./img/ks3.jpg"></a><li><a href="">Đà Lạt</a></li></div>
        <div class="img img3"><a href="danhsachkhachsan.php?xid=Nha Trang"><img src="./img/khachsan.jpg"></a><li><a href="">Nha Trang</a></li></div>
        <div class="img img4"><a href="danhsachkhachsan.php?xid=Đà Nẵng"><img src="./img/khach-san-tam-coc-golden-rice-scaled.jpg"></a><li><a href="">Đà Nẵng</a></li></div>
        <div class="img img5"><a href="danhsachkhachsan.php?xid=Quảng Bình"><img src="./img/khach-san-ninh-binh-legend.jpg"></a><li><a href="">Quảng Bình</a></li></div>
        <div class="img img6"><a href="danhsachkhachsan.php?xid=Vũng Tàu"><img src="./img/bien.png"></a><li><a href="">Vũng Tàu</a></li></div>
        <div class="img img7"><a href="danhsachkhachsan.php?xid=Phan Thiết"><img src="./img/emeralda-ninh-binh.jpg"></a><li><a href="">Phan Thiết</a></li></div>
        <div class="img img8"><a href="danhsachkhachsan.php?xid=Hà Nội"><img src="./img/ks3.jpg"></a><li><a href="">Hà Nội</a></li></div> 
    </section>
    <section class="favourite-container">
        <h1>Một vài điểm đến quốc tế dành cho bạn</h1>
        <p>Bao la thế giới. Bốn bể là nhà</p>
        <div class="img img1"><a href="danhsachkhachsan.php?xid=Ninh Bình"><img src="./img/ksnhatrang1.jpg"></a><li><a href="">Ninh Bình</a></li></div>
        <div class="img img2"><a href="danhsachkhachsan.php?xid=Đà Lạt"><img src="./img/ks3.jpg"></a><li><a href="">Đà Lạt</a></li></div>
        <div class="img img3"><a href="danhsachkhachsan.php?xid=Nha Trang"><img src="./img/khachsan.jpg"></a><li><a href="">Nha Trang</a></li></div>
        <div class="img img4"><a href="danhsachkhachsan.php?xid=Đà Nẵng"><img src="./img/khach-san-tam-coc-golden-rice-scaled.jpg"></a><li><a href="">Đà Nẵng</a></li></div>
        <div class="img img5"><a href="danhsachkhachsan.php?xid=Quảng Bình"><img src="./img/khach-san-ninh-binh-legen.jpg"></a><li><a href="">Quảng Bình</a></li></div>
        <div class="img img6"><a href="danhsachkhachsan.php?xid=Vũng Tàu"><img src="./img/bien.png"></a><li><a href="">Vũng Tàu</a></li></div>
        <div class="img img7"><a href="danhsachkhachsan.php?xid=Phan Thiết"><img src="./img/emeralda-ninh-binh.jpg"></a><li><a href="">Phan Thiết</a></li></div>
        <div class="img img8"><a href="danhsachkhachsan.php?xid=Hà Nội"><img src="./img/ks3.jpg"></a><li><a href="">Hà Nội</a></li></div> 
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
    const imgPosition = document.querySelectorAll(".aspect-ratio img")

    const imgContainer = document.querySelector(".aspect-ratio")

    const dotItem = document.querySelectorAll (".dot")

    let imgNumber =imgPosition.length

    let index = 0
    
    imgPosition.forEach(function(image,index){
        image.style.left = index*100 + "%"
        dotItem[index].addEventListener("click",function(){
        slide (index)
    })
    })

    function imgSlide(){
        index++;
        console.log(index)
        if(index >= imgNumber){
           
            index = 0
        }
        slide (index)
    }

    function slide (index){
        imgContainer.style.left = "-"+index*100+ "%"
        const dotActive = document.querySelector(".active")
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }

    setInterval(imgSlide,2000)

</script>
</html>