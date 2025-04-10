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
    <title>Quản lý loại phòng</title>   
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

        <h1>Quản lý loại phòng</h1>
        <div class="ctn-search">
        <form class="ql-search" action="" method="POST"> 
            <input type="text" name="search" placeholder="Tìm kiếm"> <button href=""><img src="./img/timkiem.png"></button>
        </form>
        </div>
        <div class="btn-dialog">
          <a href="#themkhachsan"><button>Thêm loại phòng</button></a>
        </div>
        <span style="padding-left: 90px;">
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
        <div class="menu-main">
            <h2>Admin menu</h2>
            <div>
                <a href="khachsan.php"><button>Trang chủ</button></a>
            </div>
            <div>
                <a href="qldatnuoc.php"><button>Quản lí</button></a>
            </div>
            <div>
                <a href="qlhoadonkhachsan.php"><button>Quản lý hóa đơn</button></a>
            </div>
            <div class="menu-tk">
                <a href=""><button>Thống kê doanh thu khách sạn</button></a>
                <div class="submenu-container">
                <a href="tkkhachsantheongay.php"><button>Thống kê theo ngày</button></a>
                <a href="tkkhachsantheothang.php"><button>Thống kê theo tháng</button></a>
                <a href="tkkhachsantheonam.php"><button>Thống kê theo năm</button></a>
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
    </div>
          <div class="tbdskhachsan">
            <h2>Danh loại phòng</h2>
              <table class="table hover">
                  <thead>
                      <tr>
                          <td class="cot-name">Tên loại phòng</td>
                          <td class="cot-detail">Chi tiết</td>
                          <td class="cot-price">Giá($)</td>
                          <td class="cot-picture">Ảnh</t1d>
                          <td class="cot-ql">Thêm phòng</td>
                          <td class="cot-suaxoa">Sửa Xóa</td>
                      </tr>
                        
                  </thead>
                  <?php 
                  $xid = $_GET["xid"];
                    require_once 'ketnoi.php';
                      $id_Hotel = "SELECT id FROM hotel WHERE id=$xid";
                      $ketqua = mysqli_query($conn, $id_Hotel);
                      $kq = mysqli_fetch_array($ketqua);
                    if(isset($_POST['search'])&&($_POST!="")){
                      $search = $_POST["search"];
                    }
                    else{
                      $search = "";
                    }
                        if ($search != '') {
                          $listquerry = "SELECT * FROM roomCategory WHERE nameCategory LIKE '%" . $search . "%' && idHotel = $xid" ;
                        }
                          else 
                                $listquerry = "SELECT * FROM roomCategory WHERE idHotel = $xid";
                                $result = mysqli_query($conn, $listquerry);
                                while ($row = mysqli_fetch_array($result)){
                          ?>
                          <tbody>
                                    <tr>
                                      <td><?php echo $row["nameCategory"]; ?></td>
                                      <td><?php echo $row["detailCategory"]; ?></td>
                                      <td><?php echo $row["priceCategory"]; ?></td>
                                      <td><img class="tbimg"  src="./picture/<?php echo $row["pictureCategory"]; ?>"></td>
                                      <td>
                                        <a href="qlphong.php?xid=<?php echo $row['id'];?>"><button class ="btn-table">Phòng</button></a> 
                                      </td>
                                      <td>
                                        <a href="sualoaiphong.php?id=<?php echo $row['id'];?>"><button class ="btn-sua">Sửa</button></a> 
                                        <a onclick="return confirm('Bạn có chắc muốn xóa khách sạn này không?');" href="xoaloaiphong.php?xid=<?php echo $row['id'];?>&&idHotel=<?php echo $row['idHotel'];?>"><button class ="btn-xoa">Xóa</button></a>
                                      </td>
                                    </tr>
          
                                    <?php
                                      }
                                      ?>
                          </tbody>
                      </table>
                  </div>
             </section>
             <section class="dialog-themkhachsan" id="themkhachsan">
               <a href="#" class="closee"></a>
               <div class="form">
               <h2>Thêm loại phòng</h2>
                 <div class="form-them">
                 <form action="themloaiphong.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                         <label for="nameCategory">Tên loại phòng :</label>
                         <input required type="text" name = "nameCategory" class="form-control" placeholder="Nhập loại phòng" id="nameCategory">
                       </div>
                       <div class="form-group">
                         <label for="detailCategory">Chi tiết :</label>
                         <input required type="text" name ="detailCategory" class="form-control" placeholder="Nhập chi tiết" id="detailCategory">
                       </div>
                       <div class="form-group">
                         <label for="priceCategory">Giá:</label>
                         <input required type="text" name ="priceCategory" class="form-control" placeholder="Nhập giá" id="priceCategory">
                       </div>
                    <div class="form-group">
                      <label for="pictureCategory">Ảnh :</label>
                      <input required type="file" name ="pictureCategory" class="form-control" placeholder="Nhập ảnh" id="pictureCategory">
                    </div>
                    <input required hidden type="text" name ="idHotel"  class="form-control" value="<?php echo $kq["id"] ?>" placeholder="Nhập nội dung" id="idHotel">
              <div class="form-group">
              <button class="btn-them">Thêm</button>
              </div>
      </form>
      <div class="form-group"><a href="#"><button class="btn-dong">Đóng</button></a></div>
        
      </div>
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
</body>
</html>