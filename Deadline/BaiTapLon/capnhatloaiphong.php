<?php
$id = $_POST['id'];
$ten = $_POST["nameCategory"];
$chitiet = $_POST["detailCategory"];
$gia = $_POST["priceCategory"];
$anh= basename($_FILES["pictureCategory"]["name"]);
$idHotel = $_POST["idHotel"];
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
if(isset($anh)&& $anh!= ""){
move_uploaded_file($_FILES["pictureCategory"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$cap_nhat_loai_phong_sql = "UPDATE roomCategory SET 
nameCategory ='$ten',
detailCategory='$chitiet',
priceCategory = $gia,
pictureCategory='$anh'
 WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_loai_phong_sql);
header("Location: qlloaiphong.php?xid=$idHotel");
}
else{
    require_once 'ketnoi.php';
    $cap_nhat_loai_phong_sql = "UPDATE roomCategory SET 
    nameCategory ='$ten',
    detailCategory='$chitiet',
    priceCategory = $gia
     WHERE id = '$id' ";
    mysqli_query($conn, $cap_nhat_loai_phong_sql);
    header("Location: qlloaiphong.php?xid=$idHotel");
}
?>