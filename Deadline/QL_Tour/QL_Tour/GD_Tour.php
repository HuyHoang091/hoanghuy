<?php 
$Id_Tour = $_GET["Id_Tour"];
session_start();
require_once 'ketnoi.php';

if ($conn) {
    $stmt = $conn->prepare("SELECT Tour.*, City.name_City, Country.name_Country, Comp.name_Comp FROM Tour 
                            JOIN City ON Tour.id_City = City.id 
                            JOIN Country ON City.id_Country = Country.id
                            JOIN Comp ON Tour.id_Comp = Comp.id
                            WHERE Tour.id = ?");
    $stmt->bind_param("i", $Id_Tour);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    } else {
        echo "Error executing query: " . $stmt->error;
        exit();
    }

    $stmt->close();
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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <!-- CKFinder -->
    <script src="ckfinder/ckfinder.js"></script>
</head>
<body>
<div class="container">
        <h1>Thông tin Tour</h1>
        <form action="update_QL_Tour.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="Id_Tour" value="<?php echo $Id_Tour ?>" id="">
            <input type="hidden" name="Id_Comp" value="<?php echo $row['id_Comp'] ?>" id="">
            <input type="hidden" name="Id_City" value="<?php echo $row['id_City'] ?>" id="">
            <div class="form-group">
                <label for="name_Tour">Tên Tour</label>
                <input type="text" id="name_Tour" class="form-control" name="name_Tour" value="<?php echo htmlspecialchars($row['name_Tour']) ?>" />
            </div>
            <div class="form-group">
                <label for="intro_Tour">Lời giới thiệu</label>
                <input type="text" id="intro_Tour" name="intro_Tour" value="<?php echo htmlspecialchars($row['intro_Tour']) ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label for="detail_Tour">Thông tin chi tiết</label>
                <textarea id="detail_Tour" name="detail_Tour" class="form-control"><?php echo htmlspecialchars($row['detail_Tour']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="city_Tour">Thành phố</label>
                <input type="text" id="city_Tour" name="city_Tour" class="form-control" value="<?php echo htmlspecialchars($row['name_City']) ?>" readonly />
            </div>
            <div class="form-group">
                <label for="country_Tour">Đất nước</label>
                <input type="text" id="country_Tour" name="country_Tour" class="form-control" value="<?php echo htmlspecialchars($row['name_Country']) ?>" readonly />
            </div>
            <div class="form-group">
                <label for="adultfee">Chi phí người lớn</label>
                <input type="text" id="adultfee" name="adultfee" value="<?php echo htmlspecialchars($row['adultfee']) ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label for="childfee">Chi phí trẻ con</label>
                <input type="text" id="childfee" name="childfee" value="<?php echo htmlspecialchars($row['childfee']) ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label for="current_picture_Tour">Ảnh hiện tại</label>
                <div>
                    <img src="<?php echo htmlspecialchars($row['picture_Tour']); ?>" alt="Ảnh tour" style="max-width: 200px;">
                </div>
            </div>
            <div class="form-group">
                <label for="picture_Tour">Ảnh muốn đổi</label>
                <input type="file" id="picture_Tour" name="picture_Tour" class="form-control" />
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
    <div class="container">
        <h2>Danh sách lịch trình</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Lượt mua</th>
                    <th>Sổ người tối đa</th>
                    <th>Sổ người dã đặt</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            require_once 'ketnoi.php';
            $listquerry = "SELECT * FROM Schedule WHERE id_Tour = '$Id_Tour'";
            $result = mysqli_query($conn, $listquerry);
            while ($r = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <td><?php echo $r["startday"]; ?></td>
                    <td><?php echo $r["endday"]; ?></td>
                    <td><?php echo $r["buycount"]; ?></td>
                    <td><?php echo $r["max_people"]; ?></td>
                    <td><?php echo $r["current_people"]; ?></td>
                    <td>
                        <a href="GD_Schedule.php?Id_Tour=<?php echo $Id_Tour?>&Id_Schedule=<?php echo $r["id"]?>" class="btn btn-warning">Sửa</a>
                        <a onclick="return confirm('Delete confirmation')" href="delete_QL_Schedule.php?Id_Tour=<?php echo $Id_Tour?>&Id_Schedule=<?php echo $r["id"]?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thêm mới</button>
        <!-- Modal thêm -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm lịch trình</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="add_QL_Schedule.php" method="POST">
                        <input type="hidden" name="Id_Tour" value="<?php echo $Id_Tour ?>" id="">
                            <div class="form-group">
                                <label for="startday">Ngày bắt đầu</label>
                                <input type="date" id="startday" class="form-control" name="startday" required />
                            </div>
                            <div class="form-group">
                                <label for="endday">Ngày kết thúc</label>
                                <input type="date" id="endday" name="endday" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="max_people">Số người tối đa</label>
                                <input type="text" id="max_people" name="max_people" class="form-control" required />
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
    <h2>Danh sách phương tiện</h2>
    <form class="ip-search" action="" method="POST">
        <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm">
        <button type="submit">Tìm kiếm</button>
        <div class="form-group">
            <select class="form-control" id="tieuchi_search" name="tieuchi_search">
                <option value="brand">Thương hiệu</option>
                <option value="startplace">Điểm khởi hành</option>
                <option value="endplace">Điểm đến</option>
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
                <th>Thương hiệu</th>
                <th>Điểm khởi hành</th>
                <th>Điểm đến</th>
                <th>Loại phương tiện</th>
                <th>Ngày đi</th>
                <th>Ngày về</th>
                <th>Dịch vụ</th>
                <th>Giá</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        require_once 'ketnoi.php';

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $criteria = $_POST['tieuchi_search'];

            $valid_columns = ['brand', 'startplace', 'endplace'];

            if (in_array($criteria, $valid_columns)) {
                $search = mysqli_real_escape_string($conn, $search);

                $listquery = "SELECT * FROM Transport WHERE $criteria LIKE '%" . $search . "%'";
            } else {
                $listquery = "SELECT * FROM Transport";
            }
        } else {
            $listquery = "SELECT * FROM Transport";
        }

        $result = mysqli_query($conn, $listquery);
        while ($r = mysqli_fetch_array($result)){
        ?>
            <tr>
                <td><?php echo htmlspecialchars($r["brand"]); ?></td>
                <td><?php echo htmlspecialchars($r["startplace"]); ?></td>
                <td><?php echo htmlspecialchars($r["endplace"]); ?></td>
                <td><?php echo htmlspecialchars($r["travel_type"]); ?></td>
                <td><?php echo htmlspecialchars($r["starttime"]); ?></td>
                <td><?php echo htmlspecialchars($r["return_date"]); ?></td>
                <td><?php echo htmlspecialchars($r["service"]); ?></td>
                <td><?php echo htmlspecialchars($r["price"]); ?></td>
                <td>
                    <a href="GD_Transport.php?Id_Transport=<?php echo htmlspecialchars($r["id"])?>&Id_Tour=<?php echo $Id_Tour?>" class="btn btn-warning">Sửa</a>
                    <a onclick="return confirm('Delete confirmation')" href="delete_QL_Transport.php?Id_Transport=<?php echo htmlspecialchars($r["id"])?>&Id_Tour=<?php echo $Id_Tour?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehicleModal" >Thêm mới</button>

<!-- Modal thêm phương tiện -->
<div class="modal" id="vehicleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm phương tiện</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> 
            <!-- Modal body -->
            <div class="modal-body">
                <form action="add_QL_Transport.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="Id_Tour" value="<?php echo $Id_Tour ?>" id="">
                    <div class="form-group">
                        <label for="startplace">Điểm khởi hành</label>
                        <input type="text" id="startplace" name="startplace" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="endplace">Điểm đến</label>
                        <input type="text" id="endplace" name="endplace" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="brand">Thương hiệu</label>
                        <input type="text" id="brand" name="brand" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="starttime">Ngày đi</label>
                        <input type="date" id="starttime" name="starttime" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="return_date">Ngày về</label>
                        <input type="date" id="return_date" name="return_date" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="travel_type">Loại phương tiện</label>
                        <select id="travel_type" name="travel_type" class="form-control">
                            <option value="Oto">Oto</option>
                            <option value="Máy bay">Máy bay</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service">Dịch vụ</label>
                        <select id="service" name="service" class="form-control">
                            <option value="Thương gia">Thương gia</option>
                            <option value="Phổ thông">Phổ thông</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá</label>
                        <input type="text" id="price" name="price" class="form-control" required />
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
