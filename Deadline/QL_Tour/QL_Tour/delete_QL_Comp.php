<?php
    session_start();
    $Id_Comp = $_GET["Id_Comp"];

    require_once 'ketnoi.php';

    $xoaquerry = "DELETE FROM Comp WHERE id= $Id_Comp";

    mysqli_query($conn, $xoaquerry);
    $_SESSION['message'] = "Dữ liệu đã được thêm thành công!";
    header("Location: GD_QL_Tour.php");
?>