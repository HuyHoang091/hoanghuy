<?php
$id = $_POST['id'];
$ten = $_POST["nameHotel"];
$tieude = $_POST["introHotel"];
$chitiet = $_POST["detailHotel"];
$sonha = $_POST["numberHotel"];
$tenduong = $_POST["roadHotel"];
$tenthanhpho = $_POST["cityHotel"];
$tennuoc = $_POST["countryHotel"];
$anh= basename($_FILES["pictureHotel"]["name"]);
$idCountry = $_POST["idCountry"];

$target_dir = "./picture/";
$target_file = $target_dir . $anh;
if(isset($anh)&& $anh!= ""){
move_uploaded_file($_FILES["pictureHotel"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$cap_nhat_khach_san_sql = "UPDATE hotel SET 
nameHotel ='$ten',
introHotel='$tieude',
detailHotel='$chitiet',
numberHotel='$sonha',
roadHotel='$tenduong',
cityHotel='$tenthanhpho',
countryHotel='$tennuoc',
pictureHotel='$anh'
 WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_khach_san_sql);
header("Location: qlkhachsan.php?xid=$idCountry");
}
else{
    require_once 'ketnoi.php';
    $cap_nhat_khach_san_sql = "UPDATE hotel SET 
nameHotel ='$ten',
introHotel='$tieude',
detailHotel='$chitiet',
numberHotel='$sonha',
roadHotel='$tenduong',
cityHotel='$tenthanhpho',
countryHotel='$tennuoc'
 WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_khach_san_sql);
header("Location: qlkhachsan.php?xid=$idCountry");
}
?>