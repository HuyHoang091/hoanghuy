<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quanly1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(["success" => false, "message" => "Database connection failed"]));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cardholderName = $_POST['cardholderName'];
        $cardExpiryDate = $_POST['cardExpiryDate'];
        $cardNumber = $_POST['cardNumber'];
        $cardCcv = $_POST['cardCcv'];
        $transactionAmount = $_POST['tien'];
        $nganhang = $_POST['nganhang'];
    
        $sql = "SELECT * FROM ". $nganhang ." WHERE TenChuThe = ? AND SoThe = ? AND Ccv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $cardholderName, $cardNumber, $cardCcv);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentBalance = $row['SoDu'];
    
            if ($currentBalance >= $transactionAmount) {
                $newBalance = $currentBalance - $transactionAmount;
    
                $updateSql = "UPDATE ". $nganhang ." SET SoDu = ? WHERE TenChuThe = ? AND SoThe = ? AND Ccv = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("dsss", $newBalance, $cardholderName, $cardNumber, $cardCcv);
    
                if ($updateStmt->execute()) {
                    echo "<script> window.parent.postMessage('qrScanned', '*'); </script>";
                } else {
                    echo "<script>alert('Lỗi!');</script>";
                }
            } else {
                echo "<script>alert('Số dư không đủ để thực hiện giao dịch!');
                    window.parent.postMessage('qrHuy', '*');
                </script>";
            }
        } else {
            echo "<script>alert('Sai thông tin!');</script>";
        }
    }
?>