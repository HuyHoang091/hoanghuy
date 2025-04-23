<?php
$ten = $_POST["nameCategory"];
$chitiet = $_POST["detailCategory"];
$gia = $_POST["priceCategory"];
$anh= basename($_FILES["pictureCategory"]["name"]);
$idHotel = $_POST["idHotel"];
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
move_uploaded_file($_FILES["pictureCategory"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$them_loai_phong = "INSERT INTO roomCategory
(nameCategory,
detailCategory,
priceCategory,
pictureCategory,
idHotel)
 VALUES ('$ten','$chitiet','$gia','$anh','$idHotel') ";
mysqli_query($conn, $them_loai_phong);
header("Location: qlloaiphong.php?xid=$idHotel");
?>