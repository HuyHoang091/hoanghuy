<?php
$id = $_POST['id'];
$ten = $_POST["nameCountry"];
$chitiet = $_POST["detailCountry"];
$anh= basename($_FILES["pictureCountry"]["name"]);
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
if(isset($anh)&& $anh!= ""){
move_uploaded_file($_FILES["pictureCountry"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$cap_nhat_dat_nuoc = "UPDATE country SET 
nameCountry ='$ten',
detailCountry='$chitiet',
pictureCountry='$anh'
 WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_dat_nuoc);
header("Location: qldatnuoc.php");
}
else{
require_once 'ketnoi.php';
$cap_nhat_dat_nuoc = "UPDATE country SET 
nameCountry ='$ten',
detailCountry='$chitiet'
WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_dat_nuoc);
header("Location: qldatnuoc.php");
}
?>