<?php
$id = $_GET['xid'];
$idHotel = $_GET['idHotel'];
require_once 'ketnoi.php';
$xoa_loai_phong ="DELETE FROM RoomCategory where id= $id";
mysqli_query( $conn, $xoa_loai_phong );
header("Location: qlloaiphong.php?xid=$idHotel");
?>