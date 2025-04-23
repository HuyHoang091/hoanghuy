<?php
$id = $_POST['id'];
$ten = $_POST["nameRoom"];
$trangthai = $_POST["statusRoom"];
$anh= basename($_FILES["pictureRoom"]["name"]);
$idCategory = $_POST["idCategory"];
$target_dir = "./picture/";
$target_file = $target_dir . $anh;
if(isset($anh)&& $anh!= ""){
move_uploaded_file($_FILES["pictureRoom"]["tmp_name"], $target_file);
require_once 'ketnoi.php';
$cap_nhat_phong_sql = "UPDATE room SET 
nameRoom ='$ten',
statusRoom='$trangthai',
pictureRoom='$anh'
 WHERE id = '$id' ";
mysqli_query($conn, $cap_nhat_phong_sql);
header("Location: qlphong.php?xid=$idCategory");
}
else{
    require_once 'ketnoi.php';
    $cap_nhat_phong_sql = "UPDATE room SET 
    nameRoom ='$ten',
    statusRoom ='$trangthai'
     WHERE id = '$id' ";
    mysqli_query($conn, $cap_nhat_phong_sql);
    header("Location: qlphong.php?xid=$idCategory");
}
?>