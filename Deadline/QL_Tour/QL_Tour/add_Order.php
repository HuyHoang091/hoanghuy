<?php 
session_start();
require_once 'ketnoi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Id_Tour = $_POST['Id_Tour'];
    $Id_Room = isset($_POST['Id_Room']) ? $_POST['Id_Room'] : null;
    $Id_Transport = isset($_POST['Id_Transport']) ? $_POST['Id_Transport'] : null;
    $total_cost = $_POST['total_cost'];
    $adult_count = isset($_POST['adult_count']) ? intval($_POST['adult_count']) : 0;
    $child_count = isset($_POST['child_count']) ? intval($_POST['child_count']) : 0;
    $id_Account = $_POST['Id_Account'];
    $id_Schedule = $_POST['Id_Schedule'];

    // Kiểm tra dữ liệu
    if ($adult_count <= 0 && $child_count <= 0) {
        echo "Số lượng người lớn và trẻ em không hợp lệ.";
        exit();
    }

    $payday = date("Y-m-d H:i:s"); // Lấy thời gian hiện tại
    $total_count = $adult_count + $child_count;


    if ($conn) {
        // Lấy thông tin current_people và max_people từ bảng Schedule
        $stmt_schedule_info = $conn->prepare("SELECT current_people, max_people, buycount FROM Schedule WHERE id = ?");
        $stmt_schedule_info->bind_param("i", $id_Schedule);
        $stmt_schedule_info->execute();
        $result_schedule_info = $stmt_schedule_info->get_result();
        $schedule_info = $result_schedule_info->fetch_assoc();

        
        if (!$schedule_info) {
            echo "Không tìm thấy bản ghi Schedule với id = " . $id_Schedule;
            exit();
        }

        $current_people = $schedule_info['current_people'];
        $max_people = $schedule_info['max_people'];
        $buycount = $schedule_info['buycount'];

        // Kiểm tra điều kiện total_count + current_people <= max_people
        if (($total_count + $current_people) <= $max_people) {

            $new_buycount = $buycount + 1;
            $new_current_people = $current_people + $total_count;

            echo $new_current_people ;
            echo $total_cost;


            $stmt_update_schedule = $conn->prepare("UPDATE Schedule SET buycount = ?, current_people = ? WHERE id = ?");
            $stmt_update_schedule->bind_param("iii", $new_buycount, $new_current_people, $id_Schedule);
            $stmt_update_schedule->execute();

            // Cập nhật status_room_type_Hotel trong bảng room_Hotel nếu có Id_Room
            if ($Id_Room !== null) {
                $new_status_room_type_Hotel = "Có người";
                $stmt_update_room = $conn->prepare("UPDATE room_Hotel SET status_room_Hotel = ? WHERE id = ?");
                $stmt_update_room->bind_param("si", $new_status_room_type_Hotel, $Id_Room);
                $stmt_update_room->execute();
            }
            if ($Id_Room === '') {
                $Id_Room = null;
            }
            if ($Id_Transport === '') {
                $Id_Transport = null;
            }
            // Insert dữ liệu vào bảng Order_Tour nếu có đủ thông tin
                $stmt_insert_order = $conn->prepare("INSERT INTO Order_Tour (adult_number_Order_Tour, child_number_Order_Tour, total_price_Order_Tour, payday_Order_Tour, id_room_Hotel, id_Transport, id_Schedule, id_Account) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt_insert_order->bind_param("iidsiiii", $adult_count, $child_count, $total_cost, $payday, $Id_Room, $Id_Transport, $id_Schedule, $id_Account);

                if ($stmt_insert_order->execute()) {
                    $_SESSION['message'] = "Bạn đã đặt Tour thành công!";
                    header("Location: GD_user_danhsach_Tour.php");
                    exit();
                } else {
                    echo "Error: " . $stmt_insert_order->error;
                }

                $stmt_insert_order->close();
        } else {
            echo "Số người đặt vượt quá giới hạn cho phép của Tour này.";
        }

        $stmt_update_schedule->close();
        $stmt_schedule_info->close();
        if (isset($stmt_update_room)) {
            $stmt_update_room->close();
        }
    } else {
        echo "Database connection failed: " . mysqli_connect_error();
    }
}
?>