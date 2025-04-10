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
        $nganhang = $_POST['nganhang'];

        $dateParts = explode("-", $cardExpiryDate);
        if (count($dateParts) == 2) {
            $day = $dateParts[0];
            $month = $dateParts[1];
        }

        $sql = "SELECT * FROM ". $nganhang ." WHERE TenChuThe = ? AND SoThe = ? AND MONTH(NgayPhatHanh) = ? AND DAY(NgayPhatHanh) = ? AND Ccv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $cardholderName, $cardNumber, $month, $day, $cardCcv);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                setTimeout(function() {
                    showQRConfirmation('" . $cardholderName . "', '" . $cardExpiryDate . "', '" . $cardNumber . "', '" . $cardCcv . "', '" . $nganhang . "');
                }, 100);
                setTimeout(function() {
                    sai('" . $cardholderName . "', '" . $cardExpiryDate . "', '" . $cardNumber . "', '" . $cardCcv . "', '" . $nganhang . "');
                }, 150);
            </script>";
        } else {
            echo "<script>alert('Thông tin thẻ không đúng. Vui lòng kiểm tra lại!');
                setTimeout(function() {
                    sai('" . $cardholderName . "', '" . $cardExpiryDate . "', '" . $cardNumber . "', '" . $cardCcv . "', '" . $nganhang . "');
                }, 100);
            </script>";
        }
    }
?>
<?php
$data = isset($_GET['data']) ? $_GET['data'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Confirmation</title>
    <style>
        /* CSS để ẩn iframe ban đầu */
        #iframeContainer {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            border: 2px solid #000;
            background-color: #fff;
            z-index: 1000;
            border-radius: 5px;
        }
        /* CSS cho nút hiển thị iframe */
        #showButton {
            margin: 20px;
        }
    </style>

    <style>
        .card {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .card img {
            width: 100%;
            border-radius: 8px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card.clicked {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <form id="Formbank" method="post">
        <input type="hidden" name="" id="abc" value="<?php echo $data ?>">
        <input type="hidden" name="nganhang" id="nganhang" value="">
        <div style="height: 50px;">
            <div onclick="huy()" style="float: right">
                        <div style="font-size: 27px;
                        cursor: pointer;
                        position: fixed; right: 10px;
                        width: 30px;
                        background: red;
                        color: white;
                        border-radius: 10px;text-align: center;">×</div>
        </div>
        <div style="margin: 0px 15%;">
            <div style="text-align: center; padding-top: 15px;">Phương thức thanh toán</div>
            <div><hr/></div>
            <div style="margin-left: 10px;">THẺ ATM VÀ TÀI KHOẢN NGÂN HÀNG <span id="+" style="float: right;
            margin-right: 15px;
            font-size: 18px;
            cursor: pointer;">+</span></div>
            <div><hr/></div>
            <div id="master" style="display: none;
                        grid-template-columns: 1fr 1fr 1fr 1fr;
                        gap: 10px;
                        padding: 5px 10px;
                        ">

            <div id="mastercard" class="card">
                <img src="http://localhost/hoanghuy/Deadline/Public/Pictures/mastercard.png" alt="Mastercard">
            </div>
            <div id="visa" style="align-content: center;" class="card">
                <img src="http://localhost/hoanghuy/Deadline/Public/Pictures/visa.png" alt="Visa">
            </div>

            </div>
            <div id="ttt" style="display: none;">
                <hr/>
                <div style="margin-left: 10px;">
                    THÔNG TIN THẺ
                </div>
                <hr/>
                <div style="padding: 5px 10px;">
                    <label for="">Tên chủ thẻ:</label>
                    <input name="cardholderName" id="ten" style="padding: 5px 10px; margin-left: 5px;" type="text" name="" id="" placeholder="Nguyen Van A">
                    <label style="margin-left: 5px;" for="">Ngày PH:</label>
                    <input name="cardExpiryDate" id="ngay" autocomplete="off" style="padding: 5px 10px; margin-left: 5px; width: 50px;" type="text" name="" id="" placeholder="dd-mm">
                </div>
                <div style="padding: 5px 10px;">
                    <label for="">Số thẻ:</label>
                    <input name="cardNumber" id="sothe" autocomplete="off" style="padding: 5px 10px; margin-left: 40px;" type="text" name="" id="" placeholder="0123456789">
                    <label style="margin-left: 5px;" for="">Ccv:</label>
                    <input name="cardCcv" id="ccv" autocomplete="off" style="padding: 5px 10px; margin-left: 38px; width: 50px;" type="text" name="" id="" placeholder="000">
                </div>
                <div>
                    <button type="button" onclick="check()" style="padding: 8px 28px;
                    float: right;
                    margin: 10px 10px 15px 0px;
                    background: #F79321;
                    border: none;
                    color: white;
                    border-radius: 5px;
                    cursor: pointer;">Thanh toán</button>
                </div>
            </div>
        </div>
        <div id="iframeContainer">
            <iframe id="iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
        </div>
    </form>
    
    <script>
        function huy(){
            window.parent.postMessage({functionName: 'qrHuy'}, '*');
        }
        document.getElementById("+").onclick = function() {
            if(document.getElementById("+").innerText == "+"){
                document.getElementById("+").innerText = "-";
                document.getElementById("master").style.display = "grid";
            }
            else{
                document.getElementById("+").innerText = "+";
                document.getElementById("master").style.display = "none";
            }
        }
        const masterCard = document.getElementById("mastercard");
        const visaCard = document.getElementById("visa");
        const ngay = document.getElementById("ngay");
        document.getElementById("mastercard").onclick = function() {
            document.getElementById("ttt").style.display = "block";
            document.getElementById("nganhang").value = "mastercash";
            masterCard.classList.add("clicked");
            visaCard.classList.remove("clicked");
        }
        document.getElementById("visa").onclick = function() {
            document.getElementById("ttt").style.display = "block";
            document.getElementById("nganhang").value = "visa";
            visaCard.classList.add("clicked");
            masterCard.classList.remove("clicked");
        }
        function showQRConfirmation(a,b,c,d,e) {
            var message = document.getElementById("abc").value;
            document.getElementById("iframeContainer").style.display = "block";
            document.getElementById("iframe").src = "http://localhost:3000?sotien=" + encodeURIComponent(message) + "&ten=" + encodeURIComponent(a) + "&ngay=" + encodeURIComponent(b) + "&sothe=" + encodeURIComponent(c) + "&ccv=" + encodeURIComponent(d) + "&nganhang=" + encodeURIComponent(e); 
        }
        function sai(a,b,c,d,e){
            document.getElementById("master").style.display = "grid";
            if(e == "visa"){
                document.getElementById("ttt").style.display = "block";
                document.getElementById("nganhang").value = "visa";
                visaCard.classList.add("clicked");
                masterCard.classList.remove("clicked");
            }
            else{
                document.getElementById("ttt").style.display = "block";
                document.getElementById("nganhang").value = "mastercash";
                masterCard.classList.add("clicked");
                visaCard.classList.remove("clicked");
            }
            document.getElementById("ten").value = a;
            document.getElementById("ngay").value = b;
            document.getElementById("sothe").value = c;
            document.getElementById("ccv").value = d;
            document.getElementById("nganhang").value = e;
            
        }
        function qrHuy() {
            document.getElementById("iframeContainer").style.display = "none";
        }
        window.addEventListener('message', function(event) {
            var functionName = event.data;
            window[functionName]();
            if(functionName == "qrScanned"){
                window.parent.postMessage({functionName: 'qrScanned', user: document.getElementById("sothe").value, nganhang: document.getElementById("nganhang").value}, '*');
            }
        });
        function qrScanned() {
            document.getElementById("iframeContainer").style.display = "none";
        }
    </script>
    <script>
        function check(){
            if(document.getElementById("ten").value == ""){
                alert("Vui lòng nhập tên chủ thẻ!");
                document.getElementById("ten").focus();
            }
            else if(document.getElementById("ngay").value == ""){
                alert("Vui lòng nhập ngày phát hành!");
                document.getElementById("ngay").focus();
            }
            else if(document.getElementById("sothe").value == ""){
                alert("Vui lòng nhập số thẻ!");
                document.getElementById("sothe").focus();
            }
            else if(document.getElementById("ccv").value == ""){
                alert("Vui lòng nhập mã ccv!");
                document.getElementById("ccv").focus();
            }
            else {
                document.getElementById("Formbank").submit();
            }
        }
    </script>
</body>
</html>
