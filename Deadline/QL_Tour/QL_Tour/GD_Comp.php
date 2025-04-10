<?php 
require_once 'ketnoi.php';

// Kiểm tra xem tham số Id_Comp có tồn tại không
if (!isset($_GET["Id_Comp"])) {
    echo "Tham số Id_Comp không tồn tại.";
    exit(); // Dừng việc thực thi tiếp tục nếu không có Id_Comp
}

$Id_Comp = $_GET["Id_Comp"];

if ($conn) {
    $stmt = $conn->prepare("
        SELECT 
            Comp.*, 
            City.name_City, 
            Country.name_Country 
        FROM Comp 
        JOIN City ON Comp.id_City = City.id 
        JOIN Country ON City.id_Country = Country.id 
        WHERE Comp.id = ?
    ");
    $stmt->bind_param("i", $Id_Comp);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    } else {
        echo "Error executing query: " . $stmt->error;
        exit();
    }

} else {
    echo "Database connection failed: " . mysqli_connect_error();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thông tin công ty</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <!-- CKFinder -->
    <script src="ckfinder/ckfinder.js"></script>
  </head>
  <body>
    <div class="container">
      <h1>Thông tin công ty</h1>
        <form action="update_QL_Comp.php" method="post" enctype="multipart/form-data"  >
        <input type="hidden" name="Id_Comp" value ="<?php echo $Id_Comp ?>" id="">
        <input type="hidden" name="Id_City" value ="<?php echo $row['id_City'] ?>" id="">
            <div class="form-group">
                <label for="name_Comp">Tên công ty</label>
                <input type="text" id="name_Comp" class="form-control" name="name_Comp" value="<?php echo htmlspecialchars($row['name_Comp']) ?>" />
            </div>
            <div class="form-group">
                <label for="detail_Comp">Thông tin chi tiết</label>
                <textarea id="detail_Comp" name="detail_Comp" class="form-control"><?php echo htmlspecialchars($row['detail_Comp']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="number_Comp">Số điện thoại</label>
                <input type="text" id="number_Comp" name="number_Comp" class="form-control"  value="<?php echo htmlspecialchars($row['number_Comp']) ?>"/>
            </div>
            <div class="form-group">
                <label for="road_Comp">Đường xá</label>
                <input type="text" id="road_Comp" name="road_Comp" class="form-control" value="<?php echo htmlspecialchars($row['road_Comp']) ?>"/>
            </div>
            <div class="form-group">
                <label for="city_Comp">Thành phố</label>
                <input type="text" id="city_Comp" name="city_Comp" class="form-control" value="<?php echo htmlspecialchars($row['name_City']) ?>" readonly />
            </div>
            <div class="form-group">
                <label for="country_Comp">Đất nước</label>
                <input type="text" id="country_Comp" name="country_Comp" class="form-control" value="<?php echo htmlspecialchars($row['name_Country']) ?>" readonly />
            </div>
            <div class="form-group">
                <label for="ceo_Comp">Chủ tịch công ty</label>
                <input type="text" id="ceo_Comp" name="ceo_Comp" class="form-control" value="<?php echo htmlspecialchars($row['ceo_Comp']) ?>"/>
            </div>
            <div class="form-group">
                <label for="current_picture_Comp">Ảnh hiện tại</label>
                <div>
                    <img src="<?php echo htmlspecialchars($row['picture_Comp']); ?>" alt="Ảnh công ty" style="max-width: 200px;">
                </div>
            </div>
            <div class="form-group">
                <label for="picture_Comp">Ảnh muốn đổi</label>
                <input type="file" id="picture_Comp" name="picture_Comp" class="form-control" />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>


    <div class="container">
        <h2>Danh sách tour</h2>
        <form class="ip-search" action="" method="POST">
            <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm">
            <button type="submit">Tìm kiếm</button>
            <div class="form-group">
                <select class="form-control" id="tieuchi_search" name="tieuchi_search">
                    <option value="noidungtimkiem_Comp">Tên công ty (tìm kiếm gần đúng)</option>
                </select>
            </div>
        </form>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Ảnh đại diện</th>
                    <th>Tên tour</th>
                    <th>Thông tin giới thiệu</th>
                    <th>Thông tin chi tiết</th>
                    <th>Địa chỉ</th>
                    <th>Chi phí cho người lớn</th>
                    <th>Chi phí cho trẻ con</th>
                    <th>Lượt mua</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php 
        require_once 'ketnoi.php';

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $criteria = $_POST['tieuchi_search'];

            $valid_columns = ['name_Tour', 'intro_Tour', 'detail_Tour'];

            if (in_array($criteria, $valid_columns)) {
                $search = mysqli_real_escape_string($conn, $search);

                $listquery = "SELECT Tour.*, City.name_City, Country.name_Country 
                              FROM Tour 
                              INNER JOIN City ON Tour.id_City = City.id 
                              INNER JOIN Country ON City.id_Country = Country.id 
                              WHERE $criteria LIKE '%" . $search . "%'";
            } else {
                $listquery = "SELECT Tour.*, City.name_City, Country.name_Country 
                              FROM Tour 
                              INNER JOIN City ON Tour.id_City = City.id 
                              INNER JOIN Country ON City.id_Country = Country.id";
            }
        } else {
            $listquery = "SELECT Tour.*, City.name_City, Country.name_Country 
                          FROM Tour 
                          INNER JOIN City ON Tour.id_City = City.id 
                          INNER JOIN Country ON City.id_Country = Country.id";
        }

        $result = mysqli_query($conn, $listquery);
        while ($r = mysqli_fetch_array($result)){
        ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($r["picture_Tour"]); ?>" alt="Tour Image" style="width:100px; height:auto;"></td>
                    <td><?php echo htmlspecialchars($r["name_Tour"]); ?></td>
                    <td><?php echo htmlspecialchars($r["intro_Tour"]); ?></td>
                    <td><?php echo ($r["detail_Tour"]); ?></td>
                    <td><?php echo htmlspecialchars($r["name_City"]); ?> , <?php echo htmlspecialchars($r["name_Country"]); ?></td>
                    <td><?php echo htmlspecialchars($r["adultfee"]); ?></td>
                    <td><?php echo htmlspecialchars($r["childfee"]); ?></td>
                    <td><?php echo htmlspecialchars($r["buycount"]); ?></td>
                    <td>
                        <a href="GD_Tour.php?Id_Comp=<?php echo $Id_Comp?>&Id_Tour=<?php echo htmlspecialchars($r["id"])?>" class="btn btn-warning">Sửa</a>
                        <a onclick="return confirm('Delete confirmation')" href="delete_QL_Tour.php?Id_Comp=<?php echo $Id_Comp?>&Id_Tour=<?php echo htmlspecialchars($r["id"])?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php
            }
            $stm
            ?>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Thêm mới</button>
        
        <!-- Modal thêm công ty -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm Tour</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> 
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="add_QL_Tour.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="Id_City" value ="<?php echo $r['id_City'] ?>" id="">
                        <input type="hidden" name="Id_Comp" value ="<?php echo $Id_Comp ?>" id="">
                            <div class="form-group">
                                <label for="name_Comp">Tên tour du lịch</label>
                                <input type="text" id="name_Tour" class="form-control" name="name_Tour" required/>
                            </div>
                            <div class="form-group">
                                <label for="intro_Tour">Lời giới thiệu</label>
                                <input type="text" id="intro_Tour" name="intro_Tour" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="detail_Tour">Thông tin chi tiết</label>
                                <textarea id="detail_Tour" name="detail_Tour" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                            <label for="id_City">Thành phố</label>
                            <select id="id_City" name="id_City" class="form-control">
                                <?php
                                // Lấy danh sách thành phố từ cơ sở dữ liệu để hiển thị trong dropdown
                                $city_query = "SELECT id, name_City FROM City";
                                $city_result = $conn->query($city_query);
                                while ($city = $city_result->fetch_assoc()) {
                                    echo '<option value="' . $city['id'] . '">' . $city['name_City'] . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="adultfee">Phí người lớn</label>
                                <input type="text" id="adultfee" name="adultfee" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="childfee">Phí trẻ con</label>
                                <input type="text" id="childfee" name="childfee" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="picture_Tour">Ảnh đại diện</label>
                                <input type="file" id="picture_Tour" name="picture_Tour" class="form-control"  />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
        <h2>Danh sách tour</h2>
        <form class="ip-search" action="" method="POST">
            <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm">
            <button type="submit">Tìm kiếm</button>
            <div class="form-group">
                <select class="form-control" id="tieuchi_search" name="tieuchi_search">
                    <option value="noidungtimkiem_Comp">Tên công ty (tìm kiếm gần đúng)</option>
                </select>
            </div>
        </form>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Ảnh đại diện</th>
                    <th>Tên tour</th>
                    <th>Thông tin giới thiệu</th>
                    <th>Thông tin chi tiết</th>
                    <th>Địa chỉ</th>
                    <th>Chi phí cho người lớn</th>
                    <th>Chi phí cho trẻ con</th>
                    <th>Lượt mua</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php 
        require_once 'ketnoi.php';

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $criteria = $_POST['tieuchi_search'];

            $valid_columns = ['name_Tour', 'intro_Tour', 'detail_Tour'];

            if (in_array($criteria, $valid_columns)) {
                $search = mysqli_real_escape_string($conn, $search);

                $listquery = "SELECT Tour.*, City.name_City, Country.name_Country 
                              FROM Tour 
                              INNER JOIN City ON Tour.id_City = City.id 
                              INNER JOIN Country ON City.id_Country = Country.id 
                              WHERE $criteria LIKE '%" . $search . "%'";
            } else {
                $listquery = "SELECT Tour.*, City.name_City, Country.name_Country 
                              FROM Tour 
                              INNER JOIN City ON Tour.id_City = City.id 
                              INNER JOIN Country ON City.id_Country = Country.id";
            }
        } else {
            $listquery = "SELECT Tour.*, City.name_City, Country.name_Country 
                          FROM Tour 
                          INNER JOIN City ON Tour.id_City = City.id 
                          INNER JOIN Country ON City.id_Country = Country.id";
        }

        $result = mysqli_query($conn, $listquery);
        while ($r = mysqli_fetch_array($result)){
        ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($r["picture_Tour"]); ?>" alt="Tour Image" style="width:100px; height:auto;"></td>
                    <td><?php echo htmlspecialchars($r["name_Tour"]); ?></td>
                    <td><?php echo htmlspecialchars($r["intro_Tour"]); ?></td>
                    <td><?php echo ($r["detail_Tour"]); ?></td>
                    <td><?php echo htmlspecialchars($r["name_City"]); ?> , <?php echo htmlspecialchars($r["name_Country"]); ?></td>
                    <td><?php echo htmlspecialchars($r["adultfee"]); ?></td>
                    <td><?php echo htmlspecialchars($r["childfee"]); ?></td>
                    <td><?php echo htmlspecialchars($r["buycount"]); ?></td>
                    <td>
                        <a href="GD_Tour.php?Id_Comp=<?php echo $Id_Comp?>&Id_Tour=<?php echo htmlspecialchars($r["id"])?>" class="btn btn-warning">Sửa</a>
                        <a onclick="return confirm('Delete confirmation')" href="delete_QL_Tour.php?Id_Comp=<?php echo $Id_Comp?>&Id_Tour=<?php echo htmlspecialchars($r["id"])?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php
            }
            $stm
            ?>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Thêm mới</button>
        
        <!-- Modal thêm công ty -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm Tour</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div> 
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="add_QL_Tour.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="Id_City" value ="<?php echo $r['id_City'] ?>" id="">
                        <input type="hidden" name="Id_Comp" value ="<?php echo $Id_Comp ?>" id="">
                            <div class="form-group">
                                <label for="name_Comp">Tên tour du lịch</label>
                                <input type="text" id="name_Tour" class="form-control" name="name_Tour" />
                            </div>
                            <div class="form-group">
                                <label for="intro_Tour">Lời giới thiệu</label>
                                <input type="text" id="intro_Tour" name="intro_Tour" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="detail_Tour">Thông tin chi tiết</label>
                                <textarea id="detail_Tour" name="detail_Tour" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="id_City">Thành phố</label>
                            <select id="id_City" name="id_City" class="form-control">
                                <?php
                                // Lấy danh sách thành phố từ cơ sở dữ liệu để hiển thị trong dropdown
                                $city_query = "SELECT id, name_City FROM City";
                                $city_result = $conn->query($city_query);
                                while ($city = $city_result->fetch_assoc()) {
                                    echo '<option value="' . $city['id'] . '">' . $city['name_City'] . '</option>';
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="adultfee">Phí người lớn</label>
                                <input type="text" id="adultfee" name="adultfee" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="childfee">Phí trẻ con</label>
                                <input type="text" id="childfee" name="childfee" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="picture_Tour">Ảnh đại diện</label>
                                <input type="file" id="picture_Tour" name="picture_Tour" class="form-control" />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
</div>
                   
        <script>
        // Khởi tạo CKEditor 5 cho trường "Thông tin chi tiết"
        ClassicEditor
            .create(document.querySelector('#detail_Comp'), {
                ckfinder: {
                    uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: [
                    'ckfinder', 'imageUpload', '|', 'heading', '|', 
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', 
                    'blockQuote'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
        <script>
        // Khởi tạo CKEditor 5 cho trường "Thông tin chi tiết"
        ClassicEditor
            .create(document.querySelector('#detail_Tour'), {
                ckfinder: {
                    uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: [
                    'ckfinder', 'imageUpload', '|', 'heading', '|', 
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', 
                    'blockQuote'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
  </body>
</html>
