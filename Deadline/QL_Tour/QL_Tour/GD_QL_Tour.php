<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách</title>
    <link rel="stylesheet" href="GD_QL_Tour.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <!-- CKFinder -->
    <script src="ckfinder/ckfinder.js"></script>
</head>
<body>
<header class="logo">
    <img class="logoct" src="./img/logoct.png">
</header>
<section class="main-body">
    <div class="menu">
        <div class="menu-main">
            <div>
                <a href="/hoanghuy/Deadline/BaiTapLon/qldatnuoc.php"><button>Admin menu</button></a>
            </div>
            <div>
                <a href="GD_QL_Tour.php"><button>Quản lý tour</button></a>
            </div>
            <div>
                <a href="admin.html"><button>Quản lý vé máy bay</button></a>
            </div>
            <div>
                <a href="GD_QL_media_Post.php"><button>Quản lý cẩm nang</button></a>
            </div>
            <div>
                <a href="admin.html"><button>Quản lý khách hàng</button></a>
            </div>
            <div>
                <a href="admin.html"><button>Thống kê</button></a>
            </div>
            <div>
                <a href="admin.html"><button>Tài khoản</button></a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Danh sách công ty </h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            // Xóa thông báo sau khi hiển thị
            unset($_SESSION['message']);
        }
        ?>
        <form class="ip-search" action="" method="POST">
            <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm">
            <button type="submit">Tìm kiếm</button>
            <div class="form-group">
                <select class="form-control" id="tieuchi_search" name="tieuchi_search">
                    <option value="noidungtimkiem_Comp">Tên công ty (tìm kiếm gần đúng)</option>
                </select>
            </div>
        </form>
        <table class="table">
            <thead class="th">
            <tr>
                <th>Ảnh công ty</th>
                <th>Tên công ty</th>
                <th>Thông tin chi tiết</th>
                <th>Địa chỉ công ty</th>
                <th>CEO</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            require_once 'ketnoi.php';

            // Lấy từ khóa tìm kiếm và tiêu chí tìm kiếm từ form
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
                $criteria = $_POST['tieuchi_search'];//dùng để chọn nhiều tiêu chí tiềm kiếm khác nhau như tìm kiếm theo tên , tìm kiếm theo địa chỉ

                // Whitelist of valid column names to prevent SQL injection
                $valid_columns = ['noidungtimkiem_Comp'];

                if (in_array($criteria, $valid_columns)) {
                    // Escape the search term for safety
                    $search = mysqli_real_escape_string($conn, $search);

                    // Determine the query based on the search criteria
                    if ($criteria === 'noidungtimkiem_Comp') {
                        $listquery = "SELECT Comp.*, City.name_City, Country.name_Country 
                                      FROM Comp 
                                      JOIN City ON Comp.id_City = City.id 
                                      JOIN Country ON City.id_Country = Country.id 
                                      WHERE Comp.name_Comp LIKE '%" . $search . "%'";
                    }
                } else {
                    $listquery = "SELECT Comp.*, City.name_City, Country.name_Country 
                                  FROM Comp 
                                  JOIN City ON Comp.id_City = City.id 
                                  JOIN Country ON City.id_Country = Country.id";
                }
            } else {
                $listquery = "SELECT Comp.*, City.name_City, Country.name_Country 
                              FROM Comp 
                              JOIN City ON Comp.id_City = City.id 
                              JOIN Country ON City.id_Country = Country.id";
            }

            $result = mysqli_query($conn, $listquery);
            while ($r = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <td class='td img'><img src="<?php echo $r["picture_Comp"]; ?>" alt="Company Image" style="width:100px; height:auto;"></td>
                    <td><?php echo $r["name_Comp"]; ?></td>
                    <td><?php echo $r["detail_Comp"]; ?></td>
                    <td><?php echo $r["number_Comp"] . ' ' . $r["road_Comp"] . ', ' . $r["name_City"] . ', ' . $r["name_Country"]; ?></td>
                    <td><?php echo $r["ceo_Comp"]; ?></td>
                    <td>
                        <a href="GD_Comp.php?Id_Comp=<?php echo $r["id"]?>" class="button sua">Sửa</a>
                        <a onclick="return confirm('Delete confirmation')" href="delete_QL_Comp.php?Id_Comp=<?php echo $r["id"]?>" class="button xoa">Xóa</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>

        <button type="button" class="button them-moi" data-toggle="modal" data-target="#myModal">Thêm mới</button>
        
    <!-- Modal thêm công ty -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm công ty</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="add_QL_Comp.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="Id_City" value ="<?php echo $r['id_City'] ?>" id="">
                        <div class="form-group">
                            <label for="name_Comp">Tên công ty</label>
                            <input type="text" id="name_Comp" class="form-control" name="name_Comp" required/>
                        </div>
                        <div class="form-group">
                            <label for="detail_Comp">Thông tin chi tiết</label>
                            <textarea id="detail_Comp" name="detail_Comp" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="number_Comp">Số điện thoại </label>
                            <input type="text" id="number_Comp" name="number_Comp" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="road_Comp">Đường xá</label>
                            <input type="text" id="road_Comp" name="road_Comp" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="id_City">Thành phố</label>
                            <select id="id_City" name="id_City" class="form-control">
                                <?php
                                // Fetch cities for the dropdown
                                $cityQuery = "SELECT City.id, City.name_City, Country.name_Country 
                                              FROM City 
                                              JOIN Country ON City.id_Country = Country.id";
                                $cityResult = mysqli_query($conn, $cityQuery);
                                while ($cityRow = mysqli_fetch_array($cityResult)) {
                                    echo '<option value="' . $cityRow['id'] . '">' . $cityRow['name_City'] . ', ' . $cityRow['name_Country'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ceo_Comp">Chủ tịch công ty</label>
                            <input type="text" id="ceo_Comp" name="ceo_Comp" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="picture_Comp">Ảnh đại diện</label>
                            <input type="file" id="picture_Comp" name="picture_Comp" class="form-control" />
                        </div>
                        <div>
                            <button type="submit" class="button them-moi">Thêm</button>
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

    // Hiển thị modal khi nhấn nút "Thêm mới"
    $(document).ready(function() {
        $('.btn.them-moi').on('click', function() {
            $('#myModal').addClass('show').css('display', 'block');
        });

        // Ẩn modal khi nhấn nút "Close"
        $('.close, .btn.btn-danger').on('click', function() {
            $('#myModal').removeClass('show').css('display', 'none');
        });
    });
</script>
</body>
</html>
