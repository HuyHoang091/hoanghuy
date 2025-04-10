<?php 
require_once 'ketnoi.php';

// Kiểm tra xem tham số Id_Comp có tồn tại không
if (!isset($_GET["Id_Media"])) {
    // Xử lý khi tham số không tồn tại, ví dụ chuyển hướng hoặc thông báo lỗi
    echo "Tham số Id_Media không tồn tại.";
    exit(); // Dừng việc thực thi tiếp tục nếu không có Id_Comp
}

$Id_Media = $_GET["Id_Media"];

$sua_sql = "SELECT * FROM media_Post WHERE id = $Id_Media";
$ketqua = mysqli_query($conn, $sua_sql);
$r = mysqli_fetch_assoc($ketqua);
$ngaycapnhat = date('d/m/Y', strtotime('now'));
$ngaydang = date('d/m/Y', strtotime($r['postday_media_Post']));

if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM media_Post WHERE id = ?");
    $stmt->bind_param("i", $Id_Media);
    
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
      <h1>Thông tin bài viết</h1>
        <form action="update_Media.php" method="post" enctype="multipart/form-data"  >
        <input type="hidden" name="Id_Media" value ="<?php echo $Id_Media ?>" id="">
            <div class="form-group">
                <label for="title_media_Post">Tiêu đề bài viết</label>
                <input type="text" id="title_media_Post" class="form-control" name="title_media_Post" value="<?php echo htmlspecialchars($row['title_media_Post']) ?>" />
            </div>
            <div class="form-group">
                <label for="content_media_Post">Nội dung</label>
                <textarea id="content_media_Post" name="content_media_Post" class="form-control" ><?php echo $row['content_media_Post'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="arthor_media_Post">Tác giả</label>
                <input type="text" id="athor_media_Post" name="arthor_media_Post" class="form-control" value="<?php echo htmlspecialchars($row['arthor_media_Post']) ?>"/>
            </div>
            <div class="form-group">
                <label for="type_media_Post">Thể loại</label>
                <input type="text" id="type_media_Post" name="type_media_Post" class="form-control"  value="<?php echo htmlspecialchars($row['type_media_Post']) ?>"/>
            </div>
            <div class="form-group">
                <label for="city_media_Post">Thành phố</label>
                <input type="text" id="city_media_Post" name="city_media_Post" class="form-control" value="<?php echo htmlspecialchars($row['city_media_Post']) ?>"/>
            </div>
            <div class="form-group">
                <label for="country_media_Post">Đất nước</label>
                <input type="text" id="country_media_Post" name="country_media_Post" class="form-control" value="<?php echo htmlspecialchars($row['country_media_Post']) ?>"/>
            </div>
                <div class="form-group">
                <label for="interaction_media_Post">Lượt tương tác</label>
                <input type="int" id="interaction_media_Post" name="interaction_media_Post" class="form-control" value="<?php echo htmlspecialchars($row['interaction_media_Post']) ?>" readonly/>
            </div>
            </div>
                <div class="form-group">
                <label for="like_media_Post">Lượt thích</label>
                <input type="int" id="like_media_Post" name="like_media_Post" class="form-control" value="<?php echo htmlspecialchars($row['like_media_Post']) ?>"readonly />
            </div>
            </div>
                <div class="form-group">
                <label for="dislike_media_Post">Lượt chê</label>
                <input type="int" id="dislike_media_Post" name="interaction_media_Post" class="form-control" value="<?php echo htmlspecialchars($row['dislike_media_Post']) ?>" readonly />
            </div>
            <div class="form-group">
                <label for="postday_media_Post">Ngày đăng:</label>
                <input type="text" name="postday_media_Post" value ="<?php echo $ngaydang;?>" class="form-control" id="ngaydang_Meo" readonly>
              </div>
              <div class="form-group">
                <label for="updateday_media_Post">Ngày cập nhật:</label>
                <input type="text" name="updateday_media_Post" value ="<?php echo $ngaycapnhat;?>" class="form-control" id="updateday_media_Post" readonly>
              </div>
        <div class="form-group">
            <label for="current_picture_media_Post">Ảnh hiện tại</label>
            <div>
                <img src="<?php echo htmlspecialchars($row['picture_media_Post']); ?>" alt="Ảnh công ty" style="max-width: 200px;">
            </div>
        </div>
            <div class="form-group">
                <label for="picture_media_Post">Ảnh muốn đổi</label>
                <input type="file" id="picture_media_Post" name="picture_media_Post" class="form-control" ?>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
    </form>
    </div>
        <script>
        // Khởi tạo CKEditor 5 cho trường "Thông tin chi tiết"
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
