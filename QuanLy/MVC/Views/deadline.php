<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/hoanghuy/QuanLy/Public/Css/gdquanly.css?v = <?php echo time(); ?>">
    <title>Quản lý</title>
</head>
<body>
    <header>
        <div style="display: flex;" class="logo">
          <img class ="logoct" src="http://localhost/hoanghuy/QuanLy/Public/Pictures/img/logoct.png">
          <h1 style="width: 800px;" id="quanly"><?php if($data['page']=='danhsachgiave_v'||$data['page']=='Giave_v'||$data['page']=='Giave_sua_v'){echo 'Quản lý giá vé';}
          else if($data['page']=='danhsachhanhkhach_v'||$data['page']=='Tthk_sua_v'||$data['page']=='Ttlh_sua_v'){echo 'Quản lý hành khách';}
          else if($data['page']=='danhsachtaikhoan_v'||$data['page']=='user_v'||$data['page']=='user_sua_v'){echo 'Quản lý tài khoản';}
          else if($data['page']=='danhsachtgbay_v'||$data['page']=='Tgbe_v'||$data['page']=='Tgb_sua_v'){echo 'Quản lý thới gian bay';} ?></h1>
         </div>
    </header>
    <section class="main-body">
    <div class="menu">
        <div class="menu-main" style="position: sticky;">
            <h2>Admin menu</h2>
            <div>
                <a href="http://localhost/hoanghuy/Deadline/BaiTapLon/khachsan.php"><button>Trang chủ</button></a>
            </div>
            
                <div>
                    <a href="http://localhost/hoanghuy/Deadline/QL_Tour/QL_Tour/GD_QL_Tour.php"><button>Quản lý Tour</button></a>
                </div>
            
            <div id="qlks">
                <button>Khách sạn</button>
            </div>
            <div id="ks" style="display: none;">
                <div>
                    <a href="http://localhost/hoanghuy/Deadline/BaiTapLon/qldatnuoc.php"><button style="background-color: #c2a179;">Quản lý khách sạn</button></a>
                </div>
                <div>
                    <a href="http://localhost/hoanghuy/Deadline/BaiTapLon/qlhoadonkhachsan.php"><button style="background-color: #c2a179;">Quản lý hóa đơn</button></a>
                </div>
                <div class="menu-tk">
                    <a href=""><button style="background-color: #c2a179;">Thống kê doanh thu khách sạn</button></a>
                    <div class="submenu-container">
                    <a href="http://localhost/hoanghuy/Deadline/BaiTapLon/tkkhachsantheongay.php"><button style="background-color: #c2a179;">Thống kê theo ngày</button></a>
                    <a href="http://localhost/hoanghuy/Deadline/BaiTapLon/tkkhachsantheothang.php"><button style="background-color: #c2a179;">Thống kê theo tháng</button></a>
                    <a href="http://localhost/hoanghuy/Deadline/BaiTapLon/tkkhachsantheothang.php"><button style="background-color: #c2a179;">Thống kê theo năm</button></a>
                    </div>
                </div>
                <div class="menu-tk">
                    <a href=""><button style="background-color: #c2a179;">Thống kê doanh thu Tour</button></a>
                    <div class="submenu-container">
                    <a href="http://localhost/hoanghuy/Deadline/QL_Tour/QL_Tour/thongketheongay.php"><button style="background-color: #c2a179;">Thống kê theo ngày</button></a>
                    <a href="http://localhost/hoanghuy/Deadline/QL_Tour/QL_Tour/thongketheothang.php"><button style="background-color: #c2a179;">Thống kê theo tháng</button></a>
                    <a href="http://localhost/hoanghuy/Deadline/QL_Tour/QL_Tour/thongketheothang.php"><button style="background-color: #c2a179;">Thống kê theo năm</button></a>
                    </div>
                </div>
            </div>
            <div id="qlvemb">
                <button>Vé máy bay</button>
            </div>
            <div id="vemb" style="display: none;">
                <div>
                    <a href="http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/Get_data"><button style="background-color: #c2a179;">Quản lý hành khách</button></a>
                </div>
                <div>
                    <a href="http://localhost/hoanghuy/QuanLy/Danhsachgiave/Get_data"><button style="background-color: #c2a179;">Quản lý gía vé</button></a>
                </div>
                <div>
                    <a href="http://localhost/hoanghuy/QuanLy/Danhsachtgbay/Get_data"><button style="background-color: #c2a179;">Quản lý thời gian bay</button></a>
                </div>
            </div>
            
                <div>
                    <a href="http://localhost/hoanghuy/Deadline/sinhvien/sinhvien/QL_Allmedia.php"><button>Quản lý cẩm nang</button></a>
                </div>
                
            
            <div>
                <a href="http://localhost/hoanghuy/QuanLy/Danhsachuser/Get_data"><button>Quản lý tài khoản</button></a>
            </div>
        </div>
    </div>
        <div class="tbdskhachsan">
          <?php 
            include_once './MVC/Views/Pages/'.$data['page'].'.php';
          ?>
        </div>
        </form>
      </div>
      </div>
    </section>
</body>
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
</html>