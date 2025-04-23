<?php
    session_start();
    $Id_Media = $_GET["Id_Media"];

    require_once 'ketnoi.php';

    $xoaquerry = "DELETE FROM media_Post WHERE id= $Id_Media";

    mysqli_query($conn, $xoaquerry);
    $_SESSION['message'] = "Dữ liệu đã được xóa thành công!";
    header("Location: GD_QL_media.php");
?>