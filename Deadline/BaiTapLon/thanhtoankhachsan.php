<?php
require_once 'ketnoi.php';
$id = $_POST["id"];
$idAccount = $_POST["idAccount"];
$luotdatcu = $_POST["buyCountHotel"];
$trangthai = "Có người";
$ngaythanhtoan = date("Y-m-d H:i:s");
$ngayvao = $_POST["ngayvao"];
$dangso_ngayvao = strtotime($ngayvao);
$ngayra = $_POST["ngayra"];
$dangso_ngayra = strtotime($ngayra);
$dangso_songayo = $dangso_ngayra - $dangso_ngayvao;
$songayo = $dangso_songayo / (24*60*60);


if ($songayo >= 0) {
$ds_phong = "SELECT * FROM room WHERE id = $id";
$ketqua=mysqli_query($conn, $ds_phong);
$kq = mysqli_fetch_array($ketqua);
$idCategory = $kq["idCategory"];


$thanh_toan_phong_sql = "UPDATE room SET 
statusRoom ='$trangthai'
WHERE id = '$id' ";
mysqli_query($conn, $thanh_toan_phong_sql);




$ds_loai_phong = "SELECT * FROM roomCategory WHERE id = $idCategory";
$id_ks=mysqli_query($conn, $ds_loai_phong);
$rs = mysqli_fetch_array($id_ks);
$idHotel = $rs["idHotel"];

$luotdat = $luotdatcu + 1;
$cap_nhat_luot_dat = "UPDATE hotel SET 
buyCountHotel ='$luotdat' 
WHERE id = '$idHotel' ";
mysqli_query($conn, $cap_nhat_luot_dat);

echo $idAccount;

$dongia = $rs["priceCategory"];
$id_khach_san = "SELECT idHotel FROM roomCategory WHERE  id = $idCategory ";
$tong = $dongia * $songayo;


$them_hoa_don = "INSERT INTO bill
(payDayBill,
dayCheckIn,
dayCheckOut,
priceCategory,
countDay,
priceOrderBill,
idAccount,
idHotel
)
 VALUES ('$ngaythanhtoan','$ngayvao','$ngayra','$dongia','$songayo','$tong','$idAccount','$idHotel') ";
mysqli_query($conn, $them_hoa_don);
header("Location: danhsachphong.php?xid=$idCategory");
} 
else {

    $ds_phong = "SELECT * FROM room WHERE id = $id";
    $ketqua=mysqli_query($conn, $ds_phong);
    $kq = mysqli_fetch_array($ketqua);
    $idCategory = $kq["idCategory"];


}
?>