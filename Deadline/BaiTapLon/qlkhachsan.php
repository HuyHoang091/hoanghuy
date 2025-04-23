<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<?php
require_once 'ketnoi.php';
$idCountry = $_GET["xid"];
$ten_dat_nuoc = "SELECT * FROM country WHERE id = $idCountry";
$ketqua = mysqli_query($conn,$ten_dat_nuoc);
$kq = mysqli_fetch_array($ketqua);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="gdquanly.css?v = <?php echo time(); ?>">
    <title>Quản lý khách sạn</title>
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

        <h1>Quản lý khách sạn</h1>
        <div class="ctn-search">
          <form class="ql-search" action="" method="POST"> 
            <input type="text" name="search" placeholder="Tìm kiếm"><button href=""><img src="./img/timkiem.png"></button>
        </form>
        </div>
        <div class="btn-dialog">
          <a href="#themkhachsan"><button>Thêm khách sạn</button></a>
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
          <h2>Danh sách khách sạn</h2>
             <table class="table hover">
                <thead>
                    <tr>
                        <td class ="cot-name">Tên khách sạn</td>
                        <td class ="cot-intro">Tiêu đề</td>
                        <td class ="cot-detail">Chi tiết</td>
                        <td class ="cot-address">Địa chỉ</td>
                        <td class ="cot-buycount">Lượt mua</td>
                        <td class ="cot-picture">Ảnh</td>
                        <td class ="cot-ql">QL loại phòng</td>
                        <td class ="cot-suaxoa">Sửa Xóa</td>
                    </tr>
                       
                </thead>
                <?php 
                   require_once 'ketnoi.php';
                   if(isset($_POST['search'])&&($_POST!="")){
                    $search = $_POST["search"];
                   }
                   else{
                    $search = "";
                   }
                       if ($search != '') {
                         $listquerry = "SELECT * FROM hotel WHERE nameHotel LIKE '%" . $search . "%'";
                       }
                        else 
                              $listquerry = "SELECT * FROM hotel"; 
                              $result = mysqli_query($conn, $listquerry);
                              while ($row = mysqli_fetch_array($result)){
                         ?>
                         <tbody>
                                  <tr>
                                     <td><?php echo $row["nameHotel"]; ?></td>
                                     <td><?php echo $row["introHotel"]; ?></td>
                                     <td><?php echo $row["detailHotel"]; ?></td>
                                     <td><?php echo $row["numberHotel"]; ?> <?php echo $row["roadHotel"]; ?> <?php echo $row["cityHotel"]; ?> <?php echo $row["countryHotel"]; ?></td>
                                     <td><?php echo $row["buyCountHotel"]; ?></td>
                                     <td><img class ="tbimg" src="./picture/<?php echo $row["pictureHotel"]; ?>"></td>
                                     <td>
                                       <a href="qlloaiphong.php?xid=<?php echo $row['id'];?>" ><button class ="btn-table">Loại phòng</button></a> 
                                     </td>
                                     <td>
                                       <a href="suakhachsan.php?id=<?php echo $row['id'];?>&&idCountry=<?php echo $kq['id'];?>"><button class = "btn-sua">Sửa</button></a> 
                                       <a onclick="return confirm('Bạn có chắc muốn xóa khách sạn này không?');" href="xoakhachsan.php?xid=<?php echo $row['id'];?>&&idCountry=<?php echo $kq['id'];?>"><button class = "btn-xoa">Xóa</button></a>
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
               <h2>Thêm khách sạn</h2>
                 <div class="form-them">
                 <form action="themkhachsan.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                         <label for="nameHotel">Tên khách sạn :</label>
                         <input required type="text" name = "nameHotel" class="form-control" placeholder="Nhập tên khách sạn" id="nameHotel">
                       </div>
                       <div class="form-group">
                         <label for="introHotel">Tiêu đề :</label>
                         <input required type="text" name ="introHotel" class="form-control" placeholder="Nhập tiêu đề" id="introHotel">
                       </div>
                       <div class="form-group">
                         <label for="detailHotel">Chi tiết:</label>
                         <input required type="text" name ="detailHotel" class="form-control" placeholder="Nhập chi tiết" id="detailHotel">
                       </div>
                         <input hidden required type="text" name ="countryHotel" class="form-control" value="<?php echo $kq["nameCountry"];?>" placeholder="Nhập đất nước" id="countryHotel">
                        <div class="form-group">
                        <label for="cityHotel">Tên thành phố :</label>
                        <select required name="cityHotel" class="form-control" id="cityHotel">
                        <?php
                        require_once 'ketnoi.php';
                        $danh_sach_thanh_pho = "SELECT * FROM city WHERE idCountry = $idCountry";
                        $result = mysqli_query($conn,$danh_sach_thanh_pho);
                        while($row =mysqli_fetch_array($result)){
                        ?>
                        <option value="<?php echo $row["nameCity"] ?>"><?php echo $row["nameCity"] ?></option>
                        <?php
                        }
                        ?>
                        </select>
                         </div>
                         <div class="form-group">
                         <label for="roadHotel">Tên đường :</label>
                         <input required type="text" name ="roadHotel" class="form-control" placeholder="Nhập tên đường" id="roadHotel">
                        </div>
                       <div class="form-group">
                         <label for="numberHotel">Số nhà :</label>
                         <input type="text" name ="numberHotel" class="form-control" placeholder="Nhập số nhà" id="numberHotel">
                       </div>
                    <div class="form-group">
                      <label for="pictureHotel">Ảnh :</label>
                      <input required type="file" name ="pictureHotel" class="form-control" placeholder="Nhập ảnh" id="pictureHotel">
                    </div>
                    <input required hidden type="text" name ="idCountry"  class="form-control" value="<?php echo $kq["id"] ?>" placeholder="Nhập nội dung" id="idCountry">
              <div class="form-group">
              <button class="btn-them">Thêm</button>
              </div>
          </form>
          <div class="form-group">
          <a href="#"><button class="btn-dong">Đóng</button></a>
          </div>  
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