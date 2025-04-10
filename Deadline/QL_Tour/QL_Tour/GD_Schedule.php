<?php 
$Id_Schedule = $_GET["Id_Schedule"];
session_start();
require_once 'ketnoi.php';

if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM Schedule WHERE id = ?");
    $stmt->bind_param("i", $Id_Schedule);
    
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
    <title>Thông tin công ti</title>
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
      <h1>Thông tin công ty</h1>
      <form action="update_QL_Schedule.php" method="post">
        <input type="hidden" name="Id_Tour" value ="<?php echo $Id_Tour ?>" id="">
        <input type="hidden" name="Id_Schedule" value ="<?php echo $Id_Schedule ?>" id="">
        <div class="form-group">
          <label for="startday">Ngày bắt đầu</label>
          <input
            type="date"
            id="startday"
            class="form-control"
            name="startday" value="<?php echo htmlspecialchars($row['startday']) ?>"
          />
        </div>
        <div class="form-group">
          <label for="endday">Ngày kết thúc</label>
          <input
            type="date"
            id="endday"
            name="endday" value="<?php echo htmlspecialchars($row['endday']) ?>"
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