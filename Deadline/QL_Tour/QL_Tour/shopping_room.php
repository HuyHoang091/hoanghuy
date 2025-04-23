<?php
session_start();
require_once 'ketnoi.php';

$Id_Tour = $_GET["Id_Tour"];
$Id_Transport = $_GET["Id_Transport"];
$Id_Account = $_GET["Id_Account"];

if ($conn) {
    // Step 1: Get id_City from Tour table based on id_Tour
    $sql_tour = "SELECT id_City FROM Tour WHERE id = ?";
    $stmt_tour = $conn->prepare($sql_tour);
    $stmt_tour->bind_param("i", $Id_Tour);
    
    if ($stmt_tour->execute()) {
        $result_tour = $stmt_tour->get_result();
        
        if ($row_tour = $result_tour->fetch_assoc()) {
            $id_City = $row_tour['id_City'];
            
            // Step 2: Get list of hotels based on id_City
            $sql_hotels = "SELECT id, name_Hotel FROM Hotel WHERE id_City = ?";
            $stmt_hotels = $conn->prepare($sql_hotels);
            $stmt_hotels->bind_param("i", $id_City);
            
            if ($stmt_hotels->execute()) {
                $result_hotels = $stmt_hotels->get_result();
                $hotels = array();
                
                while ($row_hotel = $result_hotels->fetch_assoc()) {
                    $hotels[$row_hotel['id']] = $row_hotel['name_Hotel'];
                }
                
                $stmt_hotels->close();
                
                // Step 3: Get list of empty rooms based on hotel_ids
                if (!empty($hotels)) {
                    $hotel_ids_placeholder = implode(',', array_fill(0, count($hotels), '?'));
                    $sql_rooms = "SELECT rh.id, rh.status_room_Hotel, rh.picture_room_Hotel, rth.name_type_room, rth.price_room_type_Hotel, rth.id_Hotel 
                                  FROM room_Hotel rh
                                  JOIN room_type_Hotel rth ON rh.id_room_type_Hotel = rth.id
                                  WHERE rh.status_room_Hotel = 'Trống' AND rth.id_Hotel IN ($hotel_ids_placeholder)";
                    $stmt_rooms = $conn->prepare($sql_rooms);
                    
                    $stmt_rooms->bind_param(str_repeat('i', count($hotels)), ...array_keys($hotels));
                    
                    if ($stmt_rooms->execute()) {
                        $result_rooms = $stmt_rooms->get_result();
                        
                        // Fetch rooms and store in array
                        $rooms = array();
                        while ($row_room = $result_rooms->fetch_assoc()) {
                            $rooms[] = $row_room;
                        }
                        
                    } else {
                        echo "Error executing query: " . $stmt_rooms->error;
                    }
                    
                    $stmt_rooms->close();
                } else {
                    echo "No hotels found in the specified city.";
                }
            } else {
                echo "Error executing query: " . $stmt_hotels->error;
            }
        } else {
            echo "Tour not found.";
        }
    } else {
        echo "Error executing query: " . $stmt_tour->error;
    }
    
    $stmt_tour->close();
} else {
    echo "Database connection failed: " . mysqli_connect_error();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/40f672cbfb.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="GD_user_danhsach_Tour.css"> -->
    <link rel="stylesheet" href="shopping_vehicle.css?v = <?php echo time(); ?>">
    <title>Khách sạn UTT</title>
</head>
<body>
<h1 class="hot">Danh sách tour nổi tiếng</h1>
   <!-- Danh sách phong -->
   <div class="card-container" id="tour-container">
        <?php foreach ($rooms as $room): ?>
        <form method="GET" action="GD_user_order_Tour.php">
            <input type="hidden" name="Id_Room" value="<?php echo htmlspecialchars($room['id']); ?>">
            <input type="hidden" name="Id_Tour" value="<?php echo htmlspecialchars($Id_Tour); ?>">
            <input type="hidden" name="Id_Transport" value="<?php echo htmlspecialchars($Id_Transport); ?>">
            <input type="hidden" name="Id_Account" value="<?php echo htmlspecialchars($Id_Account); ?>">
            <div class="card">
                <div class="content">
                    <div class="details">
                        <ul>
                            <li>Tên khách sạn: <?php echo htmlspecialchars($hotels[$room['id_Hotel']]); ?></li>
                            <li>Loại phòng: <?php echo htmlspecialchars($room['name_type_room']); ?></li>
                            <li>Giá phòng: <?php echo htmlspecialchars($room['price_room_type_Hotel']); ?> VND</li>
                        </ul>
                    </div>
                    <div class="room-image">
                        <img src="<?php echo htmlspecialchars($room['picture_room_Hotel']); ?>" alt="Room Image">
                    </div>
                </div>
                <button type="submit">Chọn</button>
            </div>
        </form>
        <?php endforeach; ?>
    </div>
    <button class="load-more" onclick="loadMore(event)">Xem thêm</button>


<!-- Tour khứ hồi  -->
    <div class="card-container" id="tour-container">
        <?php foreach ($rooms as $room): ?>
        <form method="GET" action="GD_user_order_Tour.php">
            <input type="hidden" name="Id_Room" value="<?php echo htmlspecialchars($room['id']); ?>">
            <input type="hidden" name="Id_Tour" value="<?php echo htmlspecialchars($Id_Tour); ?>">
            <input type="hidden" name="Id_Transport" value="<?php echo htmlspecialchars($Id_Transport); ?>">
            <input type="hidden" name="Id_Account" value="<?php echo htmlspecialchars($Id_Account); ?>">
            <div class="card">
                <div class="content">
                    <div class="details">
                        <ul>
                            <li>Tên khách sạn: <?php echo htmlspecialchars($hotels[$room['id_Hotel']]); ?></li>
                            <li>Loại phòng: <?php echo htmlspecialchars($room['name_type_room']); ?></li>
                            <li>Giá phòng: <?php echo htmlspecialchars($room['price_room_type_Hotel']); ?> VND</li>
                        </ul>
                    </div>
                    <div class="room-image">
                        <img src="<?php echo htmlspecialchars($room['picture_room_Hotel']); ?>" alt="Room Image">
                    </div>
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
