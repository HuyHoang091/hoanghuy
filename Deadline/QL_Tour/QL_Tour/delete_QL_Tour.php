<?php
    session_start();
    $Id_Tour = $_GET["Id_Tour"];
    $Id_Comp = $_GET["Id_Comp"];

    require_once 'ketnoi.php';

    $xoaquerry = "DELETE FROM Tour WHERE id= $Id_Tour";

    mysqli_query($conn, $xoaquerry);
    $_SESSION['message'] = "Dữ liệu đã được xóa thành công!";
    header("Location: GD_QL_Tour.php");
?>