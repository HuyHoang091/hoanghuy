<?php
    session_start();
    $Id_Transport=$_GET["Id_Transport"];
    $Id_Tour = $_GET["Id_Tour"];

    require_once 'ketnoi.php';

    $xoaquerry = "DELETE FROM Transport WHERE id= $Id_Transport";

    mysqli_query($conn, $xoaquerry);
    $_SESSION['message'] = "Dữ liệu đã được xóa thành công!";
    header("Location: GD_Tour.php?Id_Tour= $Id_Tour");
?>