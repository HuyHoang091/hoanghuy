<?php
$ten = $_POST["nameCountry"];
$chitiet = $_POST["detailCountry"];
$anh= basename($_FILES["pictureCountry"]["name"]);
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
move_uploaded_file($_FILES["pictureCountry"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$them_dat_nuoc = "INSERT INTO country
(nameCountry,
detailCountry,
pictureCountry)
 VALUES ('$ten','$chitiet','$anh') ";
mysqli_query($conn, $them_dat_nuoc);
header("Location: qldatnuoc.php");
?>