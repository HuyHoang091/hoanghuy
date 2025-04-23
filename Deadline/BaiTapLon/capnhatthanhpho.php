<?php
$id = $_POST['id'];
$ten = $_POST["nameCity"];
$chitiet = $_POST["detailCity"];
$anh= basename($_FILES["pictureCity"]["name"]);
$idCountry = $_POST['idCountry'];
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
if(isset($anh)&& $anh!= ""){
move_uploaded_file($_FILES["pictureCity"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$cap_nhat_thanh_pho = "UPDATE city SET 
nameCity ='$ten',
detailCity='$chitiet',
pictureCity='$anh'
 WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_thanh_pho);
header("Location: qlthanhpho.php?xid=$idCountry");
}
else{
require_once 'ketnoi.php';
$cap_nhat_thanh_pho = "UPDATE city SET 
nameCity ='$ten',
detailCity='$chitiet'
WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_thanh_pho);
header("Location: qlthanhpho.php?xid=$idCountry");
}
?>