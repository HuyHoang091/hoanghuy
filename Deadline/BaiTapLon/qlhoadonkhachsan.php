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
    <link rel="stylesheet" href="gdquanly.css?v = <?php echo time(); ?>">
    <title>Quản lý hóa đơn</title>  
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

        </div class="logo">
          <img class ="logoct" src="./img/logoct.png">
         </div>

        <h1>Quản lý hóa đơn</h1>
        <div class="ctn-search">

        <form class ="tk-search" method="GET" action="">
            <label for="start_date">Ngày bắt đầu:</label>
            <input required type="date" id="start_date" name="start_date" value = <?php echo $dauthang = date ("Y-m-01")?>>
            <label for="end_date">Ngày kết thúc:</label>
            <input required type="date" id="end_date" name="end_date" value = <?php echo $cuoithang = date ("Y-m-t"); ?> >
            <button type="submit">Tìm kiếm</button>
        </form>
        </div>
        <span style="padding-left: 190px;">
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
    </header>
    <section class="main-body">
    <div class="menu">
        <div class="menu-main" style="position: sticky;">
            <h2>Admin menu</h2>
            <div>
                <a href="khachsan.php"><button>Trang chủ</button></a>
            </div>
            
                <div>
                    <a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/GD_QL_Tour.php"><button>Quản lý Tour</button></a>
                </div>
            
            <div id="qlks">
                <button>Khách sạn</button>
            </div>
            <div id="ks" style="display: none;">
                <div>
                    <a href="/hoanghuy/Deadline/BaiTapLon/qldatnuoc.php"><button style="background-color: #c2a179;">Quản lý khách sạn</button></a>
                </div>
                <div>
                    <a href="/hoanghuy/Deadline/BaiTapLon/qlhoadonkhachsan.php"><button style="background-color: #c2a179;">Quản lý hóa đơn</button></a>
                </div>
                <div class="menu-tk">
                    <a href=""><button style="background-color: #c2a179;">Thống kê doanh thu khách sạn</button></a>
                    <div class="submenu-container">
                    <a href="/hoanghuy/Deadline/BaiTapLon/tkkhachsantheongay.php"><button style="background-color: #c2a179;">Thống kê theo ngày</button></a>
                    <a href="/hoanghuy/Deadline/BaiTapLon/tkkhachsantheothang.php"><button style="background-color: #c2a179;">Thống kê theo tháng</button></a>
                    <a href="/hoanghuy/Deadline/BaiTapLon/tkkhachsantheothang.php"><button style="background-color: #c2a179;">Thống kê theo năm</button></a>
                    </div>
                </div>
                <div class="menu-tk">
                    <a href=""><button style="background-color: #c2a179;">Thống kê doanh thu Tour</button></a>
                    <div class="submenu-container">
                    <a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/thongketheongay.php"><button style="background-color: #c2a179;">Thống kê theo ngày</button></a>
                    <a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/thongketheothang.php"><button style="background-color: #c2a179;">Thống kê theo tháng</button></a>
                    <a href="/hoanghuy/Deadline/QL_Tour/QL_Tour/thongketheothang.php"><button style="background-color: #c2a179;">Thống kê theo năm</button></a>
                    </div>
                </div>
            </div>
            <div id="qlvemb">
                <button>Vé máy bay</button>
            </div>
            <div id="vemb" style="display: none;">
                <div>
                    <a href="/hoanghuy/QuanLy/Danhsachhanhkhach/Get_data"><button style="background-color: #c2a179;">Quản lý hành khách</button></a>
                </div>
                <div>
                    <a href="/hoanghuy/QuanLy/Danhsachgiave/Get_data"><button style="background-color: #c2a179;">Quản lý gía vé</button></a>
                </div>
                <div>
                    <a href="/hoanghuy/QuanLy/Danhsachtgbay/Get_data"><button style="background-color: #c2a179;">Quản lý thời gian bay</button></a>
                </div>
            </div>
            
                <div>
                    <a href="/hoanghuy/Deadline/sinhvien/sinhvien/QL_Allmedia.php"><button>Quản lý cẩm nang</button></a>
                </div>
                
            
            <div>
                <a href="/hoanghuy/QuanLy/Danhsachuser/Get_data"><button>Quản lý tài khoản</button></a>
            </div>
        </div>
    </div>
        <div class="tbdskhachsan">
          <h2>Danh sách hóa đơn</h2>
             <table class="table hover">
                <thead>
                    <tr>
                        <td class = "cot-id">Mã hóa đơn</td>
                        <td class = "cot-date">Ngày thanh toán</td>
                        <td class ="cot-date">Ngày vào</td>
                        <td class ="cot-date">Ngày ra</td>
                        <td class ="cot-total">Tổng</td>
                    </tr>
                       
                </thead>
                <?php
                   require_once 'ketnoi.php';
                   if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                    $start_date = $_GET['start_date'];
                    $end_date = $_GET['end_date'];
                   }
                   else{
                    $start_date = "" && $end_date = "";
                   }
                       if ($start_date != ''&& $end_date != '') {
                         $listquerry = "SELECT * FROM bill WHERE payDayBill BETWEEN '$start_date' AND '$end_date'";
                       }
                        else
                              $listquerry = "SELECT * FROM bill";
                              $result = mysqli_query($conn, $listquerry);
                              while ($row = mysqli_fetch_array($result)){
                         ?>
                         <tbody>
                                  <tr>
                                     <td><?php echo $row["id"]; ?></td>
                                     <td><?php echo $row["payDayBill"]; ?></td>
                                     <td><?php echo $row["dayCheckIn"]; ?></td>
                                     <td><?php echo $row["dayCheckOut"]; ?></td>
                                     <td><?php echo $row["priceOrderBill"]; ?></td>
                                   </tr>
         
                                   <?php
                                     }
                                    ?>
                        </tbody>
                     </table>
                 </div>
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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("qlks").onclick = function() {
                var element = document.getElementById("ks");
                if(element.style.display === "none"){
                    element.style.display = "block";
                }
                else{
                    element.style.display = "none";
                }
            }
            document.getElementById("qlvemb").onclick = function() {
                var element = document.getElementById("vemb");
                if(element.style.display === "none"){
                    element.style.display = "block";
                }
                else{
                    element.style.display = "none";
                }
            }
            document.getElementById("qlcn").onclick = function() {
                var element = document.getElementById("cn");
                if(element.style.display === "none"){
                    element.style.display = "block";
                }
                else{
                    element.style.display = "none";
                }
            }
        });
</script>
</body>
</html>