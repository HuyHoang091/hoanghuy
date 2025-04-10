<?php
$id = $_GET['xid'];
$idCountry = $GET['idCountry'];
require_once 'ketnoi.php';
$xoa_khach_san ="DELETE FROM hotel where id= $id";
mysqli_query( $conn, $xoa_khach_san );
header("Location: qlkhachsan.php?xid=$idCountry");
?>