<?php 
    include_once './MVC/Core/app.php';
    include_once './MVC/Core/controller.php';
    include_once './MVC/Core/connectDB.php';
    spl_autoload_register(function($className) {
        if(file_exists("./MVC/Controllers/".$className.".php")) {
            require_once "./MVC/Controllers/".$className.".php";
        }
        if(file_exists("./MVC/Models/".$className.".php")) {
            require_once "./MVC/Models/".$className.".php";
        }
    });
?>