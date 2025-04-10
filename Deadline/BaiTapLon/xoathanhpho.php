<?php
$id = $_GET['xid'];
$idCountry = $_GET["idCountry"];
require_once 'ketnoi.php';
$xoa_thanh_pho ="DELETE FROM city where id= $id";
mysqli_query( $conn, $xoa_thanh_pho );
header("Location: qlthanhpho.php?xid=$idCountry");
?>