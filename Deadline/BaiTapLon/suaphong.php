<?php
$id = $_GET["id"];
require_once 'ketnoi.php';
$sua_phong = "SELECT * FROM room WHERE id=$id";
$ketqua = mysqli_query($conn, $sua_phong);
$row = mysqli_fetch_array($ketqua);
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
    <link rel="stylesheet" href="gdsua.css?v = <?php echo time(); ?>">
    <title>Sửa phòng</title>
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
    <span style="padding-left: 890px;">
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
</head>
<body>
<header>
        </div class="logo">
          <img class ="logoct" src="./img/logoct.png">
         </div>

        <h1>Sửa khách sạn</h1>
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
        </div>
    </div>
        </section>
    <div class="container">
        <div class = panel-phong>
        <form action="capnhatphong.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value ="<?php echo $id;?>" id="">
            <div class="form-group-phong">
                <label for="nameRoom">Tên phòng :</label>
                <input required type="text" name = "nameRoom" class="form-control" value ="<?php echo $row["nameRoom"];?>" placeholder="Nhập tên phòng" id="nameRoom">
            </div>
            <div class="form-group-phong">
            <label for="statusRoom">Trạng thái :</label>
                <select required name="statusRoom" class="form-control" id="statusRoom">
                    <option value="Trống">Trống</option>
                    <option value="Có người">Có người</option>
                </select>
            </div>
            <div class="form-group-phong">
                <label for="pictureRoom">Ảnh :</label>
                <input  type="file" name ="pictureRoom" class="form-control" id="pictureRoom">
            </div>
            <input hidden type="text" name ="idCategory" class="form-control" value ="<?php echo $row["idCategory"];?>" id="idCategory">
            <div class="form-group-phong">
              <button class="btn-capnhat" >Cập nhật</button>
              </div>
            </div>
        </form>
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