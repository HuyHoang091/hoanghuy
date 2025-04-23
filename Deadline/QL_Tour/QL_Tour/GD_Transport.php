<?php 
$Id_Transport = $_GET["Id_Transport"];
$Id_Tour = $_GET["Id_Tour"];
session_start();
require_once 'ketnoi.php';

if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM Transport WHERE id = ?");
    $stmt->bind_param("i", $Id_Transport);
    
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
    <title>Thông tin phương tiện</title>
    <!-- Latest compiled and minified CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    />

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
  <div class="container">
      <h1>Thông tin phương tiện</h1>
      <form action="update_QL_Transport.php" method="post">
        <input type="hidden" name="Id_Tour" value ="<?php echo $Id_Tour ?>" id="">
        <input type="hidden" name="Id_Transport" value ="<?php echo $Id_Transport ?>" id="">
        <div class="form-group">
          <label for="startplace">Điểm bắt đầu</label>
          <input
            type="text"
            id="startplace"
            class="form-control"
            name="startplace" value="<?php echo htmlspecialchars($row['startplace']) ?>"
          />
        </div>
        <div class="form-group">
          <label for="endplace">Điểm kết thúc</label>
          <input
            type="text"
            id="endplace"
            name="endplace" value="<?php echo htmlspecialchars($row['endplace']) ?>"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="brand">Thương hiệu</label>
          <input
            type="text"
            id="brand"
            name="brand" value="<?php echo htmlspecialchars($row['brand']) ?>"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="starttime">Ngày đi</label>
          <input
            type="date"
            id="starttime"
            name="starttime" value="<?php echo htmlspecialchars($row['starttime']) ?>"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="return_date">Ngày về</label>
          <input
            type="date"
            id="return_date"
            name="return_date" value="<?php echo htmlspecialchars($row['return_date']) ?>"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="travel_type">Loại phương tiện</label>
          <input
            type="text"
            id="travel_type"
            name="travel_type" value="<?php echo htmlspecialchars($row['travel_type']) ?>"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="service">Dịch vụ</label>
          <input
            type="text"
            id="service"
            name="service" value="<?php echo htmlspecialchars($row['service']) ?>"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="price">Giá</label>
          <input
            type="number"
            id="price"
            name="price" value="<?php echo htmlspecialchars($row['price']) ?>"
            class="form-control"
          />
        </div>
        <div>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
      </form>
    </div>
  </body>
</html>