<?php
$ten = $_POST["nameRoom"];
$trangthai = $_POST["statusRoom"];
$anh= basename($_FILES["pictureRoom"]["name"]);
$idCategory = $_POST["idCategory"];
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
move_uploaded_file($_FILES["pictureRoom"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$them_phong = "INSERT INTO room
(nameRoom,
statusRoom,
pictureRoom,
idCategory)
 VALUES ('$ten','$trangthai','$anh','$idCategory') ";
mysqli_query($conn, $them_phong);
header("Location: qlphong.php?xid=$idCategory");
?>