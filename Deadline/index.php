<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once './MVC/bridge.php';
    $myapp=new app();
?>