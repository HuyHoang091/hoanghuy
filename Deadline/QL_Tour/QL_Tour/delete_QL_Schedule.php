<?php
    session_start();
    $Id_Schedule=$_GET["id"];
    $Id_Tour = $_GET["Id_Tour"];

    require_once 'ketnoi.php';

    $xoaquerry = "DELETE FROM Schedule WHERE id= $Id_Schedule";

    mysqli_query($conn, $xoaquerry);
    $_SESSION['message'] = "Dữ liệu đã được xóa thành công!";
    header("Location: GD_Comp.php?Id_Tour= $Id_Tour");
?>