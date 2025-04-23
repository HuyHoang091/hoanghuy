<?php
$id = $_GET['xid'];
require_once 'ketnoi.php';
$xoa_dat_nuoc ="DELETE FROM country where id= $id";
mysqli_query( $conn, $xoa_dat_nuoc );
header("Location: qldatnuoc.php");
?>