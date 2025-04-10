<?php
session_start();
require_once 'ketnoi.php';

$Id_Tour = $_GET['Id_Tour'];

if ($conn) {
    // Lấy thông tin tour
    $stmt = $conn->prepare("SELECT * FROM Tour WHERE id = ?");
    $stmt->bind_param("i", $Id_Tour);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    } else {
        echo "Error executing query: " . $stmt->error;
        exit();
    }

    $stmt->close();

    // Truy vấn để lấy thông tin lịch trình từ bảng Schedule dựa trên id_Tour và current_people < max_people
    $stmt_schedule = $conn->prepare("SELECT * FROM Schedule WHERE id_Tour = ? AND current_people < max_people");
    $stmt_schedule->bind_param("i", $Id_Tour);
    
    if ($stmt_schedule->execute()) {
        $result_schedule = $stmt_schedule->get_result();
        
        // Lấy dữ liệu và lưu vào mảng $schedules
        $schedules = array();
        while ($row_schedule = $result_schedule->fetch_assoc()) {
            $schedules[] = $row_schedule;
        }
    } else {
        echo "Error executing query: " . $stmt_schedule->error;
        exit();
    }

    $stmt_schedule->close();

     // Tìm kiếm bài viết theo địa điểm
     $search_results = array();
     if (!empty($search_query)) {
         $stmt_search = $conn->prepare("SELECT title_media_Post, picture_media_Post FROM media_Post WHERE city_media_Post LIKE ? OR country_media_Post LIKE ?");
         $search_param = "%".$search_query."%";
         $stmt_search->bind_param("ss", $search_param, $search_param);
         
         if ($stmt_search->execute()) {
             $result_search = $stmt_search->get_result();
             while ($row_search = $result_search->fetch_assoc()) {
                 $search_results[] = $row_search;
             }
         } else {
             echo "Error executing query: " . $stmt_search->error;
             exit();
         }
 
         $stmt_search->close();
     }
 
    

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
// Kiểm tra xem người dùng đã đăng nhập chưa
$isLoggedIn = isset($_SESSION['user']);
$Id_Account = $user['id'] ?? null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/40f672cbfb.js" crossorigin="anonymous"></script>
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="GD_user_chitiet_Tour.css"> -->
    <link rel="stylesheet" href="GD_user_chitiet_Tour.css?v = <?php echo time(); ?>">
    <title>Khách sạn UTT</title>
</head>
<body>

<header>
    <div class="logo">
        <img class ="logoct" src="./img/logoct.png">
    </div>
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

<div class="main-content">
    <div class="container">
        <h1 class="post-title"><?php echo htmlspecialchars($row['name_Tour']); ?></h1>
        <div class="post-content">
            <p><?php echo nl2br(htmlspecialchars($row['intro_Tour'])); ?></p>
        </div>
        <div class="post-image">
            <img src="<?php echo htmlspecialchars($row['picture_Tour']); ?>" alt="Ảnh bài viết">
        </div>
        <div class="decription-content">
            <p><?php echo ($row['detail_Tour']); ?></p>
        </div>
        <div class="price">
            <p>Giá người lớn :<?php echo nl2br(htmlspecialchars($row['adultfee'])); ?> VND</p>
            <p>Giá trẻ con :<?php echo nl2br(htmlspecialchars($row['childfee'])); ?> VND</p>
        </div>
        <div class="departure-info">
            <table class="table">
                <thead>
                    <tr>
                        <th class="th">Ngày khởi hành</th>
                        <th class="th">Ngày kết thúc</th>
                        <th class="th">Thời gian</th>
                        <th class="th">Lượt mua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td class="td"><?php echo date_format(date_create($schedule['startday']), 'd/m/Y'); ?></td>
                            <td class="td"><?php echo date_format(date_create($schedule['endday']), 'd/m/Y'); ?></td>
                            <td class="td"><?php echo date_diff(date_create($schedule['startday']), date_create($schedule['endday']))->format('%a ngày %d đêm'); ?></td>
                            <th class="td"><?php echo nl2br(htmlspecialchars($schedule['buycount'])); ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if ($isLoggedIn): ?>
            <div class ="order-btn">
            <a href="GD_user_order_Tour.php?Id_Tour=<?php echo $Id_Tour?>&Id_Account=<?php echo $Id_Account?>" id = "nut-order">Đặt Tour</a>
        <?php else: ?>
            <p>Vui lòng đăng nhập để đặt tour.</p>
        <?php endif; ?>
            </div>
            
    </div>
    
    <div class="search-container">
        <div class="card">            
            <h2>TÌM BÀI VIẾT</h2>
        </div>  
        <hr class="hr2">   
        <div class="other">
            <input class="size-input" type="text" name ="search_query" placeholder="Nhập địa điểm">
            <button class="fas fa-search"></button>
            <hr class="hr2">
        </div>   
        <?php if (!empty($search_query)) { ?>
            <div class="search-results">
                <h2>Kết quả tìm kiếm cho "<?php echo htmlspecialchars($search_query); ?>"</h2>
                <ul>
                    <?php foreach ($search_results as $result) { ?>
                        <li>
                            <img src="<?php echo htmlspecialchars($result['picture_media_Post']); ?>" alt="Ảnh">
                            <p><?php echo htmlspecialchars($result['title_media_Post']); ?></p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
<div id="iframeContainer">
        <iframe id="iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
    </div>
    <hr>
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