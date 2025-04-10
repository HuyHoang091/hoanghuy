<?php 
session_start();
require_once 'ketnoi.php';

if ($conn) {
    // Truy vấn để lấy 3 Tour có lượt mua nhiều nhất dựa trên bảng Tour
    $sql = "
    SELECT *
    FROM 
        Tour
    ORDER BY 
        buycount DESC;
    ";

    // Chuẩn bị và thực thi truy vấn
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        // Lấy dữ liệu và lưu vào mảng
        $topTours = array();
        while ($row = $result->fetch_assoc()) {
            $topTours[] = $row;
        }
    } else {
        echo "Error executing query: " . $stmt->error;
        exit();
    }

    // Đóng statement
    $stmt->close();
} else {
    echo "Database connection failed: " . mysqli_connect_error();
    exit();
}

?>
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
    
    <!-- <link rel="stylesheet" href="GD_user_danhsach_Tour.css"> -->
    
    <link rel="stylesheet" href="GD_user_danhsach_Tour.css?v = <?php echo time(); ?>">
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
<div id="iframeContainer">
        <iframe id="iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
    </div>
    <header>
        <!----------------------------------------------LOGO------------------------------------------------------->
        </div class="logo">
            <img class ="logoct" src="./img/logoct.png">
        <div class="menu">
            <li><a href="/hoanghuy/Deadline/BaiTapLon/khachsan.php">Khách sạn</a></li>
            <li><a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/GD_user_danhsach_Tour.php">Tour</a></li>
            <li><a href="/hoanghuy/Deadline/">Vé máy bay</a></li>
            <li><a href="/hoanghuy/Deadline/sinhvien/sinhvien/gioithieu.html">Giới thiệu</a></li>
            <li><a href="/hoanghuy/Deadline/sinhvien/sinhvien/hotro.html">Hỗ trợ</a></li>
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
                        <div onclick="window.location.href='/hoanghuy/QuanLy/'" style="cursor: pointer;
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
                <li><input type="text" placeholder="Bạn muốn đi đâu?"> <button href="">Tìm kiếm</button>
            </li>
            </div>
        </div>
    </section>
<!-- -------------------------danh sach Tour --------------------------------- -->
<div class ="tour-holder" id ="tour-holder">
<div class="card-container" id="tour-container">
        <?php foreach ($topTours as $tour): ?>
        <div class="card">
        <a href="GD_user_chitiet_Tour.php?Id_Tour=<?php echo $tour['id']; ?>">
            <img src="<?php echo $tour['picture_Tour']; ?>" alt="Tour Image">
            <div class="discount-banner">lượt mua :<?php echo $tour['buycount']; ?>🔥</div>
            <div class="content">
                <div class="title"><?php echo $tour['name_Tour']; ?></div>
                <div class="details">
                    <ul>
                        <li><i>Giới thiệu :<?php echo $tour['intro_Tour']; ?></i></li>
                    </ul>
                </div>
                <div class="price">Phí người lớn :<?php echo $tour['adultfee']; ?> <small>VND</small></div>
                <div class="price">Phí trẻ con :<?php echo $tour['childfee']; ?> <small>VND</small></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button class="load-more" onclick="loadMore(event)">Xem thêm</button>
</div>
    
    <section class="slide">
        <h1 class="hot">Danh sách tour nổi tiếng</h1>
        <div class="aspect-ratio">
            <?php foreach ($topTours as $tour): ?>
                <img src="<?php echo $tour['picture_Tour']; ?>" alt="<?php echo $tour['name_Tour']; ?>">
            <?php endforeach; ?>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card');
      const loadMoreBtn = document.querySelector('.load-more');
      let visibleCards = 3; // Số thẻ hiển thị mặc định

      function showCards() {
        cards.forEach((card, index) => {
          if (index < visibleCards) {
            card.style.display = 'block';
          }
        });
      }

      loadMoreBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của nút
        visibleCards += 3; // Tăng số thẻ hiển thị mỗi lần nhấp
        showCards();
        if (visibleCards >= cards.length) {
          loadMoreBtn.style.display = 'none'; // Ẩn nút nếu không còn thẻ nào để hiển thị
        }
      });

      showCards(); // Hiển thị các thẻ ban đầu
    });
// Các phần JavaScript khác 
const header = document.querySelector("header")
window.addEventListener("scroll", function () {
    let x = window.pageYOffset
    console.log(x)
    if (x > 0) {
        header.classList.add("sticky")
    } else {
        header.classList.remove("sticky")
    }
});

const imgPosition = document.querySelectorAll(".aspect-ratio img")

const imgContainer = document.querySelector(".aspect-ratio")

let dotItem = document.querySelectorAll(".dot"); // Lựa chọn tất cả các phần tử có class "dot"

if (dotItem) { // Kiểm tra xem dotItem có tồn tại không trước khi sử dụng forEach
    dotItem.forEach(function (item, index) {
        item.addEventListener("click", function () {
            slide(index);
        });
    });
}

let imgNumber = imgPosition.length
let index = 0

imgPosition.forEach(function (image, index) {
    image.style.left = index * 100 + "%"
})

function imgSlide() {
    index++;
    if (index >= imgNumber) {
        index = 0
    }
    slide(index)
}

function slide(index) {
    imgContainer.style.left = "-" + index * 100 + "%"
    const dotActive = document.querySelector(".active")
    dotActive.classList.remove("active")
    dotItem[index].classList.add("active")
}

setInterval(imgSlide, 2000)

</script>
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