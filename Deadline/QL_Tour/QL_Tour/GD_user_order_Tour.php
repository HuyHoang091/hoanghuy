<?php
session_start();
require_once 'ketnoi.php';

$Id_Tour = $_GET["Id_Tour"];
$Id_Account = $_GET["Id_Account"];

if ($conn) {
    // Lấy thông tin tour
    $stmt = $conn->prepare("SELECT * FROM Tour WHERE id = ?");
    $stmt->bind_param("i", $Id_Tour);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    } else {
        echo "Error executing query: " . $stmt->error;
        exit();
    }

    $stmt->close();

    // Truy vấn để lấy thông tin lịch trình từ bảng Schedule dựa trên id_Tour
    $stmt_schedule = $conn->prepare("SELECT * FROM Schedule WHERE id_Tour = ?");
    $stmt_schedule->bind_param("i", $Id_Tour);
    
    if ($stmt_schedule->execute()) {
        $result_schedule = $stmt_schedule->get_result();
        
        // Lấy dữ liệu và lưu vào mảng $schedules
        $schedules = array();
        while ($row_schedule = $result_schedule->fetch_assoc()) {
            $schedules[] = $row_schedule;
        }
    } else {
        echo "Error executing query: " . $stmt_schedule->error;
        exit();
    }

    $stmt_schedule->close();

    $Id_Transport = isset($_GET['Id_Transport']) ? $_GET['Id_Transport'] : null;
$transport_info = null;

if ($Id_Transport) {
    $stmt_transport = $conn->prepare("SELECT * FROM Transport WHERE id = ?");
    $stmt_transport->bind_param("i", $Id_Transport);
    
    if ($stmt_transport->execute()) {
        $result_transport = $stmt_transport->get_result();
        $transport_info = $result_transport->fetch_assoc();
    } else {
        echo "Error executing query: " . $stmt_transport->error;
        exit();
    }

    $stmt_transport->close();
}

$Id_Room = isset($_GET['Id_Room']) ? $_GET['Id_Room'] : null;
    $room_info = null;

    if ($Id_Room) {
        $stmt_room = $conn->prepare("
            SELECT 
                room_type_Hotel.name_type_room,
                room_type_Hotel.price_room_type_Hotel,
                Hotel.name_Hotel
            FROM 
                room_type_Hotel
            JOIN 
                Hotel ON room_type_Hotel.id_Hotel = Hotel.id
            WHERE 
                room_type_Hotel.id = ?
        ");
        $stmt_room->bind_param("i", $Id_Room);
        
        if ($stmt_room->execute()) {
            $result_room = $stmt_room->get_result();
            $room_info = $result_room->fetch_assoc();
        } else {
            echo "Error executing query: " . $stmt_room->error;
            exit();
        }

        $stmt_room->close();
    }

} else {
    echo "Database connection failed: " . mysqli_connect_error();
    exit();
}
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/40f672cbfb.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="GD_user_order_Tour.css?v = <?php echo time(); ?>">
    <title>Đặt Tour</title>
</head>
<body>
<div class="main-content">
    <div class="container">
        <h1 class="post-title"><?php echo htmlspecialchars($row['name_Tour']); ?></h1>
        <hr>
        <div class="post-image">
            <img src="<?php echo htmlspecialchars($row['picture_Tour']); ?>" alt="Ảnh bài viết">
        </div>
        <div class="post-content">
            <p><?php echo ($row['detail_Tour']); ?></p>
        </div>
        <div class="post-content">
            <p>Giá người lớn: <?php echo nl2br(htmlspecialchars($row['adultfee'])); ?></p>
            <p>Giá trẻ con: <?php echo nl2br(htmlspecialchars($row['childfee'])); ?></p>
        </div>
        <div class="form-group">
            <label>Số lượng người lớn</label>
            <div class="counter-container">
                <button type="button" class="counter-button" id="btn-minus">-</button>
                <input type="text" class="counter-value" id="adult-count" value="1" readonly/>
                <button type="button" class="counter-button" id="btn-plus">+</button>
            </div>
        </div>
        <div class="form-group">
            <label>Số lượng trẻ con</label>
            <div class="counter-container">
                <button type="button" class="counter-button" id="btn-child-minus">-</button>
                <input type="text" class="counter-value" id="child-count" value="1" readonly/>
                <button type="button" class="counter-button" id="btn-child-plus">+</button>
            </div>
        </div>
        <div class="form-group">
            <label for="schedule">Lịch trình</label>
            <select id="schedule" class="form-control">
                <?php foreach ($schedules as $schedule): ?>
                    <option value="<?php echo $schedule['startday'] . '|' . $schedule['endday']; ?>">
                        <?php echo date_format(date_create($schedule['startday']), 'd/m/Y') . ' - ' . date_format(date_create($schedule['endday']), 'd/m/Y'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="duration">Số ngày</label>
            <input type="text" id="duration" class="form-control" readonly />
        </div>
        <div class="form-group">
            <label>Phương thức đưa đón</label>
            <div id="transport-info">
                <?php if ($transport_info): ?>
                    <p>Thể loại: <?php echo htmlspecialchars($transport_info['travel_type']); ?></p>
                    <p>Dịch vụ: <?php echo htmlspecialchars($transport_info['service']); ?></p>
                    <p>Địa điểm bắt đầu: <?php echo htmlspecialchars($transport_info['startplace']); ?></p>
                    <p>Địa điểm kết thúc: <?php echo htmlspecialchars($transport_info['endplace']); ?></p>
                    <p>Thời gian khởi hành: <?php echo htmlspecialchars($transport_info['starttime']); ?></p>
                    <p>Hãng: <?php echo htmlspecialchars($transport_info['brand']); ?></p>
                    <p>Giá phương tiện: <?php echo htmlspecialchars($transport_info['price']); ?></p>
                <?php else: ?>
                    <p>Không có thông tin phương tiện được chọn</p>
                <?php endif; ?>
            </div>
        </div>
        <form id="search_vehicle_Form">
            <a href="shopping_vehicle.php?Id_Tour=<?php echo $Id_Tour?>&Id_Room=<?php echo $Id_Room ?>&Id_Account=<?php echo $Id_Account ?>" class="btn btn-danger">Tìm kiếm phương tiện</a>
        </form>   
        <hr>
       
        <div class="form-group">
            <label for="total-cost">Giá tiền</label>
            <input type="text" id="total-cost" class="form-control" readonly />
        </div>
        <form action="add_Order.php" method="POST" >
            <input type="hidden" name="Id_Tour" value="<?php echo htmlspecialchars($Id_Tour); ?>">
            <input type="hidden" name="Id_Room" value="<?php echo htmlspecialchars($Id_Room); ?>">
            <input type="hidden" name="Id_Transport" value="<?php echo htmlspecialchars($Id_Transport); ?>">
            <input type="hidden" name="Id_Account" value="<?php echo htmlspecialchars($Id_Account); ?>">
            <input type="hidden" name="Id_Schedule" value="<?php echo $schedule['id']; ?>">
            <input type="hidden" name="total_cost" id="total-cost-hidden" value="">
            <input type="hidden" name="adult_count" id="adult-count-hidden" value="">
            <input type="hidden" name="child_count" id="child-count-hidden" value="">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn chắc chắn muốn đặt')" >Đặt Tour</button>
        </form>
    </>
</div>

<script>
$(document).ready(function() {
    $('#btn-minus').on('click', function() {
        var count = parseInt($('#adult-count').val());
        if (count > 1) {
            $('#adult-count').val(count - 1);
            calculateTotalCost();
        }
    });

    $('#btn-plus').on('click', function() {
        var count = parseInt($('#adult-count').val());
        $('#adult-count').val(count + 1);
        calculateTotalCost();
    });

    $('#btn-child-minus').on('click', function() {
        var count = parseInt($('#child-count').val());
        if (count > 1) {
            $('#child-count').val(count - 1);
            calculateTotalCost();
        }
    });

    $('#btn-child-plus').on('click', function() {
        var count = parseInt($('#child-count').val());
        $('#child-count').val(count + 1);
        calculateTotalCost();
    });

    $('#schedule').on('change', function() {
        calculateDuration();
        calculateTotalCost();
    });

    calculateDuration();
    calculateTotalCost();

    function calculateDuration() {
        var dates = $('#schedule').val().split('|');
        var startDate = new Date(dates[0]);
        var endDate = new Date(dates[1]);
        var duration = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        $('#duration').val(duration + ' ngày');
    }

    function calculateTotalCost() {
        var adultCount = parseInt($('#adult-count').val());
        var childCount = parseInt($('#child-count').val());
        var vehicleFee = parseFloat("<?php echo isset($transport_info['price']) ? $transport_info['price'] : 0; ?>");
        var roomFee = parseFloat("<?php echo isset($room_info['price_room_type_Hotel']) ? $room_info['price_room_type_Hotel'] : 0; ?>");
        var adultFee = parseFloat("<?php echo $row['adultfee']; ?>");
        var childFee = parseFloat("<?php echo $row['childfee']; ?>");
        var duration = parseInt($('#duration').val());

        if (!isNaN(adultCount) && !isNaN(childCount) && !isNaN(adultFee) && !isNaN(childFee) && !isNaN(duration)) {
            var totalCost = ((adultFee * adultCount) + (childFee * childCount) + roomFee) * duration + vehicleFee;
            $('#total-cost').val(totalCost.toLocaleString('vi-VN') + ' VND');
            $('#total-cost-hidden').val(totalCost);
            $('#adult-count-hidden').val(adultCount);
            $('#child-count-hidden').val(childCount);
        } else {
            $('#total-cost').val('N/A');
            $('#total-cost-hidden').val('');
            $('#adult-count-hidden').val('');
            $('#child-count-hidden').val('');
        }
    }
});
</script>
</body>
</html>