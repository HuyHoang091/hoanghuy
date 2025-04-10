<?php
class connectDB1 {
    public $con;

    function __construct() {
        $this->con = mysqli_connect('localhost', 'root', '', 'quanly1');
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }

    function getConnection() {
        return $this->con;
    }

    // function __destruct() {
    //     mysqli_close($this->con);
    // }
}
?>
