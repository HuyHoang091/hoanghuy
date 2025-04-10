<?php
$id = $_GET['xid'];
$idCategory = $_GET['idCategory'];
require_once 'ketnoi.php';
$xoa_phong ="DELETE FROM room where id= $id";
mysqli_query( $conn, $xoa_phong );
header("Location: qlphong.php?xid=$idCategory");
?>