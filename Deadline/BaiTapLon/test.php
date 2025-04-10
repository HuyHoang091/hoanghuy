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
                       <div class="form-group">
                         <label for="countryHotel">Đất nước :</label>
                         <select required name="countryHotel" class="form-control" id="countryHotel">
                          <?php
                          require_once 'ketnoi.php';
                          $danh_sach_dat_nuoc = "SELECT * FROM country";
                          $ketqua = mysqli_query($conn,$danh_sach_dat_nuoc);
                          while($row = mysqli_fetch_array($ketqua)){
                          ?> 
                          <option value="<?php echo $row["nameCountry"] ?>"><?php echo $row["nameCountry"] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label for="cityHotel">Tên thành phố :</label>
                        <select required name="cityHotel" class="form-control" id="cityHotel">
                        <?php
                          require_once 'ketnoi.php';
                          $danh_sach_thanh_pho = "SELECT * FROM city";
                          $result = mysqli_query($conn,$danh_sach_thanh_pho);
                          while($row = mysqli_fetch_array($result)){
                          ?> 
                          <option value="<?php echo $row["nameCity"] ?>"><?php echo $row["nameCity"] ?></option>
                          <?php
                          }
                          ?>
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
              <div class="form-group">
              <button class="btn-them">Thêm</button>
              </div>
          </form>
          <div class="form-group">
          <a href="#"><button class="btn-dong">Đóng</button></a>
          </div>  
      </div>
      <?php
require_once 'ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Kiểm tra các giá trị từ form
    $nameHotel = isset($_POST['nameHotel']) ? trim($_POST['nameHotel']) : '';
    $introHotel = isset($_POST['introHotel']) ? trim($_POST['introHotel']) : '';
    $detailHotel = isset($_POST['detailHotel']) ? trim($_POST['detailHotel']) : '';
    $countryHotel = isset($_POST['countryHotel']) ? trim($_POST['countryHotel']) : '';
    $cityHotel = isset($_POST['cityHotel']) ? trim($_POST['cityHotel']) : '';
    $roadHotel = isset($_POST['roadHotel']) ? trim($_POST['roadHotel']) : '';
    $numberHotel = isset($_POST['numberHotel']) ? trim($_POST['numberHotel']) : '';
    $pictureHotel = isset($_FILES['pictureHotel']) ? $_FILES['pictureHotel'] : '';

    // Kiểm tra lỗi
    if (empty($nameHotel)) {
        $errors[] = 'Tên khách sạn không được để trống.';
    }
    if (empty($introHotel)) {
        $errors[] = 'Tiêu đề không được để trống.';
    }
    if (empty($detailHotel)) {
        $errors[] = 'Chi tiết không được để trống.';
    }
    if (empty($countryHotel)) {
        $errors[] = 'Đất nước không được để trống.';
    }
    if (empty($cityHotel)) {
        $errors[] = 'Thành phố không được để trống.';
    }
    if (empty($roadHotel)) {
        $errors[] = 'Tên đường không được để trống.';
    }
    if (empty($pictureHotel) || $pictureHotel['error'] != 0) {
        $errors[] = 'Ảnh không hợp lệ.';
    }

    // Nếu có lỗi, hiển thị lỗi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    } else {
        // Nếu không có lỗi, tiến hành xử lý lưu vào cơ sở dữ liệu
        // Tải ảnh lên
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($pictureHotel["name"]);
        move_uploaded_file($pictureHotel["tmp_name"], $target_file);

        // Lưu thông tin khách sạn vào cơ sở dữ liệu
        $sql = "INSERT INTO hotels (nameHotel, introHotel, detailHotel, countryHotel, cityHotel, roadHotel, numberHotel, pictureHotel) 
                VALUES ('$nameHotel', '$introHotel', '$detailHotel', '$countryHotel', '$cityHotel', '$roadHotel', '$numberHotel', '$target_file')";

        if (mysqli_query($conn, $sql)) {
            echo "Thêm khách sạn thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>