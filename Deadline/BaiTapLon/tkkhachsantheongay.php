
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gdthongke.css?v = <?php echo time(); ?>">
    <title>Quản lý phòng</title>   
</head>
<body>
    <header>

        </div class="logo">
          <img class ="logoct" src="./img/logoct.png">
         </div>

        <h1>Thống kê doanh thu khách sạn</h1>
       <div class="ctn-search">
        <form class="tk-search" method="GET" action="">
            <label for="month-year">Tháng năm</label>
            <input type="month" id="month-year" name="month-year"value = <?php echo $df = date("Y-m") ?>>
            <button>Tìm kiếm</button>
        </form>
       </div>
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
    <?php 

    require_once "ketnoi.php" ;
    if (isset($_GET["month-year"] )) {
        $month_year = $_GET["month-year"];
        $dangso_month_year  = strtotime($month_year);
        $year =date ("Y", $dangso_month_year);
        $month = date ("m", $dangso_month_year);
    }
    else{
        $year = date("Y");
        $month = date("m");
    }
        $danh_sach_tk_ngay = "SELECT DAY(payDayBill) as payDayBill , priceOrderBill FROM bill WHERE YEAR(payDayBill) = $year && MONTH(payDayBill) =  $month GROUP BY DAY(payDayBill) ORDER BY payDayBill LIMIT 31";
        $result = mysqli_query($conn, $danh_sach_tk_ngay);
    if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $mang[] = $row;
    }
    ?>
        <h2 class="h2-day">Doanh thu khách sạn theo ngày của tháng <?php echo $month ?> năm <?php echo $year ?></h2>
    <div class="bieudo-container">

        <?php
        $doanh_thu_cao_nhat = 0;
        foreach ($mang as $row) {
            if ($row["priceOrderBill"] > $doanh_thu_cao_nhat) {
                $doanh_thu_cao_nhat = $row["priceOrderBill"];
            }
        }

        for ($i = 0; $i < count($mang); $i++) {
            $chieudai = ($mang[$i]["priceOrderBill"] / $doanh_thu_cao_nhat) * 100;
            $maucot = 'green';

            if ($i > 0 && $mang[$i]["priceOrderBill"] <= $mang[$i - 1]["priceOrderBill"]) {
                $maucot = 'red';
            }
            ?>
            <div class="cot" style="height: <?php echo $chieudai ?>%; background-color: <?php echo $maucot; ?>;" title="Tổng: <?php echo $mang[$i]["priceOrderBill"] ?> VND">
                <div class="cot-label">Ngày <?php echo $mang[$i]["payDayBill"] ?></div>
            </div>
            <?php
        }
        ?>
            </div>
    <?php
    } 
    else {
        echo '<h2 class="h2-day">Không có dữ liệu cho tháng ' . $month . ' năm ' . $year . '.</h2>';
    }
    ?>
    </div>
</section>
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