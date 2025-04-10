<?php
$idCountry = $_POST["idCountry"];
$ten = $_POST["nameHotel"];
$tieude = $_POST["introHotel"];
$chitiet = $_POST["detailHotel"];
$sonha = $_POST["numberHotel"];
$tenduong = $_POST["roadHotel"];
$tenthanhpho = $_POST["cityHotel"];
$tennuoc = $_POST["countryHotel"];
$luotmua = $_POST["buyCountHotel"];
$anh= basename($_FILES["pictureHotel"]["name"]);

$target_dir = "./picture/";
$target_file = $target_dir . $anh;
move_uploaded_file($_FILES["pictureHotel"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$them_khach_san = "INSERT INTO hotel
(nameHotel,
introHotel,
detailHotel,
numberHotel,
roadHotel,
cityHotel,
countryHotel,
buyCountHotel,
pictureHotel,
idCountry)
 VALUES ('$ten','$tieude','$chitiet','$sonha','$tenduong','$tenthanhpho','$tennuoc','$luotmua','$anh','$idCountry') ";
mysqli_query($conn, $them_khach_san);
header("Location: qlkhachsan.php?xid=$idCountry");
?>
