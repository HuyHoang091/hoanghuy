<?php 
session_start();
require_once 'ketnoi.php';

$Id_Tour = $_GET["Id_Tour"];
$Id_Room = $_GET["Id_Room"];
$Id_Account = $_GET["Id_Account"];

// Fetch filter parameters
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$start_place = isset($_GET['start_place']) ? $_GET['start_place'] : '';
$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$travel_type = isset($_GET['travel_type']) ? $_GET['travel_type'] : 'Oto';

if ($conn) {
    // Base query
    $sql = "SELECT * FROM Transport WHERE travel_type = ?";

    // Add filters to the query
    if (!empty($start_date)) {
        $sql .= " AND starttime >= ?";
    }
    if (!empty($end_date)) {
        $sql .= " AND (return_date <= ? OR return_date IS NULL)";
    }
    if (!empty($destination)) {
        $sql .= " AND endplace LIKE ?";
    }
    if (!empty($start_place)) {
        $sql .= " AND startplace LIKE ?";
    }
    if (!empty($brand)) {
        $sql .= " AND brand = ?";
    }
    $sql .= " ORDER BY price ASC;";

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $params = array($travel_type);

    if (!empty($start_date)) {
        $params[] = $start_date;
    }
    if (!empty($end_date)) {
        $params[] = $end_date;
    }
    if (!empty($destination)) {
        $params[] = '%' . $destination . '%';
    }
    if (!empty($start_place)) {
        $params[] = '%' . $start_place . '%';
    }
    if (!empty($brand)) {
        $params[] = $brand;
    }

    $stmt->bind_param(str_repeat('s', count($params)), ...$params);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        // Lấy dữ liệu và phân biệt phương tiện một chiều và khứ hồi
        $one_way = array();
        $round_trip = array();
        while ($row = $result->fetch_assoc()) {
            if (empty($row['return_date'])) {
                $one_way[] = $row;
            } else {
                $round_trip[] = $row;
            }
        }
    } else {
        echo "Error executing query: " . $stmt->error;
        exit();
    }

    // Đóng statement
    $stmt->close();
} else {
    echo "Database connection failed: " . mysqli_connect_error();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/40f672cbfb.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="shopping_vehicle.css"> -->
    <link rel="stylesheet" href="shopping_vehicle.css?v = <?php echo time(); ?>">
    <title>Khách sạn UTT</title>
</head>
<body>
    <header>
        
        <div class="logo">
            <img class="logoct" src="./img/logoct.png" alt="Logo">
        </div>
        <form method="GET" action="">
        <input type="hidden" name="Id_Tour" value="<?php echo htmlspecialchars($Id_Tour); ?>">
        <input type="hidden" name="Id_Room" value="<?php echo htmlspecialchars($Id_Room); ?>">
        <input type="hidden" name="Id_Account" value="<?php echo htmlspecialchars($Id_Account); ?>">

        <label for="start_date">Ngày bắt đầu:</label>
        <input type="date" name="start_date" id="start_date" >

        <label for="end_date">Ngày kết thúc:</label>
        <input type="date" name="end_date" id="end_date">

        <label for="destination">Điểm đến:</label>
        <input type="text" name="destination" id="destination">

        <label for="start_place">Điểm khởi hành:</label>
        <input type="text" name="start_place" id="start_place">

        <label for="brand">Hãng:</label>
        <select name="brand" id="brand">
            <option value="">Tất cả</option>
            <option value="Shoppe">Shoppe</option>
            <option value="Tiki">Tiki</option>
            <option value="Grab">Grab</option>
        </select>

        <label for="travel_type">Loại phương tiện:</label>
        <select name="travel_type" id="travel_type">
            <option value="Oto">Oto</option>
            <option value="Máy bay">Máy bay</option>
        </select>

        <button type="submit">Lọc</button>
    </form>
    </header>

    <h1 class="">Danh sách 1 chiều </h1>
   <!-- Danh sách Oto 1 chiều-->
   <div class="card-container" id="vehicle-container">
   <h1 class="">Danh sách 1 chiều </h1>
        <?php foreach ($one_way as $vehicle): ?>
        <form method="GET" action="GD_user_order_Tour.php">
            <input type="hidden" name="Id_Transport" value="<?php echo htmlspecialchars($vehicle['id']); ?>">
            <input type="hidden" name="Id_Tour" value="<?php echo htmlspecialchars($Id_Tour); ?>">
            <input type="hidden" name="Id_Room" value="<?php echo htmlspecialchars($Id_Room); ?>">
            <input type="hidden" name="Id_Account" value="<?php echo htmlspecialchars($Id_Account); ?>">
            <div class="card">
                <div class="type">Hạng : <?php echo htmlspecialchars($vehicle['service']); ?>🔥</div>
                <div class="content">
                    <div class="details">
                        <ul>
                            <li>Địa điểm bắt đầu: <?php echo htmlspecialchars($vehicle['startplace']); ?></li>
                            <li>Địa điểm kết thúc: <?php echo htmlspecialchars($vehicle['endplace']); ?></li>
                            <li>Thời gian khởi hành: <?php echo htmlspecialchars($vehicle['starttime']); ?></li>
                            <li>Hãng: <?php echo htmlspecialchars($vehicle['brand']); ?></li>
                        </ul>
                    </div>
                    <div class="price">Giá: <?php echo htmlspecialchars($vehicle['price']); ?> <small>VND</small></div>
                </div>
                <button type="submit">Chọn</button>
            </div>
        </form>
        <?php endforeach; ?>
    </div>
    <button class="load-more" onclick="loadMore(event)">Xem thêm</button>

     <!-- Danh sách Oto khứ hồi-->
   <div class="card-container" id="vehicle-container">
   <h1 class="">Danh sách 2 chiều </h1>
        <?php foreach ($round_trip as $vehicle): ?>
        <form method="GET" action="GD_user_order_Tour.php">
            <input type="hidden" name="Id_Transport" value="<?php echo htmlspecialchars($vehicle['id']); ?>">
            <input type="hidden" name="Id_Tour" value="<?php echo htmlspecialchars($Id_Tour); ?>">
            <input type="hidden" name="Id_Room" value="<?php echo htmlspecialchars($Id_Room); ?>">
            <input type="hidden" name="Id_Account" value="<?php echo htmlspecialchars($Id_Account); ?>">
            <div class="card">
                <div class="type">Hạng : <?php echo htmlspecialchars($vehicle['service']); ?>🔥</div>
                <div class="content">
                    <div class="details">
                        <ul>
                            <li>Địa điểm bắt đầu: <?php echo htmlspecialchars($vehicle['startplace']); ?></li>
                            <li>Địa điểm kết thúc: <?php echo htmlspecialchars($vehicle['endplace']); ?></li>
                            <li>Thời gian khởi hành: <?php echo htmlspecialchars($vehicle['starttime']); ?></li>
                            <li>Hãng: <?php echo htmlspecialchars($vehicle['brand']); ?></li>
                            <li>Ngày kết thúc: <?php echo htmlspecialchars($vehicle['return_date']); ?></li>
                        </ul>
                    </div>
                    <div class="price">Giá: <?php echo htmlspecialchars($vehicle['price']); ?> <small>VND</small></div>
                </div>
                <button type="submit">Chọn</button>
            </div>
        </form>
        <?php endforeach; ?>
    </div>
    <button class="load-more" onclick="loadMore(event)">Xem thêm</button>

    <!-- Footer -->
    <section class="footer-top">
        <li><a href=""><img src="./img/logoct.png" alt="Logo"></a></li>
        <li><a href="#">Liên hệ</a></li>
        <li><a href="#">Điều kiện & Điều khoản</a></li>
        <li><a href="#">Giới thiệu</a></li>
        <li>
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-youtube"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-tiktok"></a>
        </li>
    </section>
    <section class="footer-center">
        <p>
            Công ty cổ phần trách nhiệm hữu hạn 4 thành viên với số đăng ký kinh doanh: 0123456789 <br>
            Địa chỉ: 54 Triều Khúc, Thanh Xuân, Hà Nội <br>
            Hỗ trợ: <b>0969688842</b>
        </p>
    </section>
    <section class="footer-bottom">
        <p>4tv@tourtravelchill.com</p>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card');
      const loadMoreBtn = document.querySelector('.load-more');
      let visibleCards = 3;

      function showCards() {
        cards.forEach((card, index) => {
          if (index < visibleCards) {
            card.style.display = 'block';
          }
        });
      }

      loadMoreBtn.addEventListener('click', function(event) {
        event.preventDefault();
        visibleCards += 3;
        showCards();
        if (visibleCards >= cards.length) {
          loadMoreBtn.style.display = 'none';
        }
      });

      showCards();
    });

    const header = document.querySelector("header");
    window.addEventListener("scroll", function () {
        let x = window.pageYOffset;
        if (x > 0) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    });
    </script>
</body>
</html>
