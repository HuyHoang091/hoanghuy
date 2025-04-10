<th?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"/>

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script> 
    <script src="ckfinder/ckfinder.js"></script> 
</head>
<body>
    <div class="container">
        <h2>Danh sách bài viết</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
            // Xóa thông báo sau khi hiển thị
            unset($_SESSION['message']);
        }
        ?>
        <form action="" method="POST">
            <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm">
            <button type="submit">Tìm kiếm</button>
            <div class="form-group">
                <select class="form-control" id="tieuchi_search" name="tieuchi_search">
                    <option value="fuzzy_tieu_de">Tiêu đề (tìm kiếm gần đúng)</option>
                </select>
            </div>
        </form>
        <table class="table table-dark">
            <thead class="thead-light">
                <tr>
                    <th>Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Thể loại</th>
                    <th>Nội dung</th>
                    <th>Tác giả</th>
                    <th>Thành phố</th>
                    <th>Đất nước</th>
                    <th>Ngày đăng</th>
                    <th>Ngày cập nhật</th>
                    <th>Lượt tương tác</th>
                    <th>Lượt thích</th>
                    <th>lượt chê </th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            require_once 'ketnoi.php';

            // Lấy từ khóa tìm kiếm và tiêu chí tìm kiếm từ form
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
                $criteria = $_POST['tieuchi_search'];

                // Whitelist of valid column names to prevent SQL injection
                $valid_columns = ['fuzzy_tieu_de'];

                if (in_array($criteria, $valid_columns)) {
                    // Escape the search term for safety
                    $search = mysqli_real_escape_string($conn, $search);

                    // Determine the query based on the search criteria
                    if ($criteria === 'fuzzy_tieu_de') {
                        $listquerry = "SELECT * FROM media_Post WHERE title_media_Post LIKE '%" . $search . "%'";
                    }
                } else {
                    $listquerry = "SELECT * FROM medial_Post
                    ";
                }
            } else {
                $listquerry = "SELECT * FROM media_Post ";
            }

            $result = mysqli_query($conn, $listquerry);
            while ($r = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <td><img src="<?php echo $r["picture_media_Post"]; ?>" alt="Post Image" style="width:100px; height:auto;"></td>
                    <td><?php echo $r["title_media_Post"]; ?></td>
                    <td><?php echo $r["type_media_Post"]; ?></td>
                    <td><?php echo $r["content_media_Post"]; ?></td>
                    <td><?php echo $r["arthor_media_Post"]; ?></td>
                    <td><?php echo $r["city_media_Post"]; ?></td>
                    <td><?php echo $r["country_media_Post"]; ?></td>
                    <td><?php echo $r["postday_media_Post"]; ?></td>
                    <td><?php echo $r["updateday_media_Post"]; ?></td>
                    <td><?php echo $r["interaction_media_Post"]; ?></td>
                    <td><?php echo $r["like_media_Post"]; ?></td>
                    <td><?php echo $r["dislike_media_Post"]; ?></td>
                    <td>
                        <a href="GD_Media.php?Id_Media=<?php echo $r["id"]?>" class="btn btn-warning">Sửa</a>
                        <a onclick="return confirm('Delete confirmation')" href="delete_Media.php?Id_Media=<?php echo $r["id"]?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Thêm mới</button>
        
        <!-- Modal thêm công ty -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm bài viết</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="add_Media.php" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="title_media_Post">Tiêu đề</label>
                                <input type="text" id="title_media_Post" class="form-control" name="title_media_Post" />
                            </div>
                            <div class="form-group">
                                <label for="content_media_Post">Nội dung</label>
                                <!-- <input type="text" id="noidung_vanhoa" class="form-control" name="noidung_vanhoa" /> -->
                                <textarea id="content_media_Post" name="content_media_Post" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="arthor_media_Post">Tác giả</label>
                                <input type="text" id="arthor_media_Post" name="arthor_media_Post" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="city_media_Post">Thành phố</label>
                                <input type="text" id="city_media_Post" name="city_media_Post" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="country_media_Post">Đất nước</label>
                                <input type="text" id="country_media_Post" name="country_media_Post" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="country_media_Post">Tác giả</label>
                                <input type="text" id="country_media_Post" name="country_media_Post" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="type_media_Post">Thể loại</label>
                                <input type="text" id="type_media_Post" name="type_media_Post" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="picture_media_Post">Ảnh đại diện</label>
                                <input type="file" id="picture_media_Post" name="picture_media_Post" class="form-control" />
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
    </div>
    <script>
        // Khởi tạo CKEditor 5 cho trường "noidung_vanhoa"
        ClassicEditor
            .create(document.querySelector('#content_media_Post'), {
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