<?php
$ten = $_POST["nameCity"];
$chitiet = $_POST["detailCity"];
$anh= basename($_FILES["pictureCity"]["name"]);
$idCountry = $_POST["idCountry"];
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
require_once 'ketnoi.php';
$kiem_tra_thanh_pho = "SELECT * FROM city WHERE nameCity = '$ten'";
$result = mysqli_query($conn, $kiem_tra_thanh_pho);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Thành phố đã tồn tại!'); window.location.href = 'qlthanhpho.php?xid=$idCountry';</script>";
} else {
move_uploaded_file($_FILES["pictureCity"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$them_thanh_pho = "INSERT INTO city
(nameCity,
detailCity,
pictureCity,
idCountry
)
 VALUES ('$ten','$chitiet','$anh','$idCountry') ";
mysqli_query($conn, $them_thanh_pho);
header("Location: qlthanhpho.php?xid=$idCountry");
}
?>