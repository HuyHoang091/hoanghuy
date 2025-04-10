<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .phan {
            /* display: grid; */
            margin: 100px 20%;
            background: white;
            /* height: 800px; */
            border-radius: 15px;
            font-family: apple-system, BlinkMacSystemFont, "Segoe UI", Tahoma, Helvetica, sans-serif;
            padding: 17px;
        }
        body {
            background: #ecf0f5;
        }
        .btn {
            width: 50%;
            padding: 10px;
            border-radius: 9px;
            border: 1px solid #0000002b;
            background-clip: content-box;
            outline: none;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .up {
            padding: 7px 20px; 
            border-radius: 15px; 
            margin-top: 20px; 
            cursor: pointer; 
            background: #ecf0f5;
            border: none;
        }
        .up:hover {
            background: #979797;
            color: white;
        }
        .edit-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            font-size: 12px; /* Điều chỉnh kích thước của icon */
            color: #000; /* Màu sắc của icon */
            margin-left: 5px;
        }
        #editDiv {
            display: none;
            position: absolute;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: white;
            z-index: 100;
            margin-left: 10px;
        }
        #editDiv:after {
            content: '';
            position: absolute;
            top: 50%;
            left: -10px;
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent white transparent transparent;
        }
        #editDiv1 {
            display: none;
            position: absolute;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: white;
            z-index: 100;
            margin-left: 10px;
        }
        #editDiv1:after {
            content: '';
            position: absolute;
            top: 50%;
            left: -10px;
            margin-top: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent white transparent transparent;
        }
        .btnsua{
            padding: 10px 60px;
            margin-top: 25px;
            background-color: #e4e7f7;
            color: #6680ff;
            border: none;
            border-radius: 15px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .btnsua:hover{
            background-color:#6680ff;
            color:#e4e7f7;
        }
    </style>
</head>
<body>
    <div class="phan">
        <div style="padding-bottom: 7px;"><h1 style=" font-size: 16px; margin: 0px;">Thông tin cá nhân</h1></div>
        <div><hr/></div>
        <div style="justify-self: center; margin-top: 25px;">
            <div style="text-align: center;">
                <?php
                    require_once 'MVC/Core/connectDB1.php';
                    $db = new connectDB1();
                    $conn = $db->getConnection();
                    
                    $ss = "";
                    if(isset($user['username'])){
                        $ss = $user['username'];
                    }
                    // Sử dụng prepared statement để tránh SQL injection
                    $stmt = $conn->prepare("SELECT picture_Account FROM account WHERE username_Account = ?");
                    $stmt->bind_param("s", $ss);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $tinh = htmlspecialchars($row["picture_Account"], ENT_QUOTES, 'UTF-8');
                            echo "<img style='width: 105px;border-radius: 50%;overflow: hidden;border:groove;' src='$tinh' alt=''>";
                        }
                    } else {
                        echo "0 results";
                    }

                    $stmt->close();
                    $conn->close();
                ?>
            </div>
            <div style="text-align: center;">
                <button type="button" onclick="show()" class="up">Đổi ảnh đại diện</button>
            </div>
        </div>
        <div style="margin-top: 60px;">
            <label for="">Nickname</label>
            <div style="position: relative;">
                <input class="btn" type="text" style="color: #828282;" name="nickname" id="nicknameInput" value="<?php if(isset($user['taikhoan'])){echo $user['taikhoan']; }?>" readonly>
                <button class="edit-button" onclick="editFunction()">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <div id="editDiv" style="top: 17px;
                                        left: 82%;
                                        transform: translate(-100%, -50%);
                                        border-radius: 15px;">
                    <input type="text" style="padding: 5px 15px;
                                                border-radius: 5px;
                                                border: 1px solid #0000002b;
                                                background-clip: content-box;
                                                outline: none;" id="newNickname" name="newNickname" placeholder="Nhập tên mới">
                    <button style="background: #6680ff;
                                    color: white;
                                    padding: 5px 15px;
                                    border: none;
                                    border-radius: 5px;
                                    margin-top: 5px; width: 100%; cursor: pointer;"    onclick="submitNickname()">Cập nhật</button>
                </div>
            </div>
            <label for="">Giới Tính</label>
            <div>
                <input class="btn" type="text" style="color: #828282;" name="" id="" value="<?php if(isset($user['gioitinh'])){echo $user['gioitinh']; }?>" readonly>   
            </div>
            <label for="">Tài Khoản</label>
            <div>
                <input class="btn" type="text" style="color: #828282;" name="" id="" value="<?php if(isset($user['quyen'])){echo $user['quyen']; }?>" readonly>
            </div>
            <label for="">Mật khẩu</label>
            <div>
                <input class="btn" type="password" style="color: #828282;" name="" id="pass" value="<?php if(isset($user['matkhau'])){echo $user['matkhau']; }?>" readonly>
                <button class="edit-button" onclick="editFunction1()">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <div id="editDiv1" style="top: 97%;
                width: 195px;
                                        left: 68.5%;
                                        transform: translate(-100%, -50%);
                                        border-radius: 15px;">
                    <input type="password" style="padding: 5px 15px;
                                                border-radius: 5px;
                                                border: 1px solid #0000002b;
                                                background-clip: content-box;
                                                outline: none;" id="passcu" name="passcu" placeholder="Nhập mật khẩu cũ">
                    <input type="password" style="padding: 5px 15px;
                                                border-radius: 5px;display: none;
                                                border: 1px solid #0000002b;
                                                background-clip: content-box;
                                                outline: none;" id="passmoi" name="passmoi" placeholder="Nhập mật khẩu mới">
                    <button style="background: #6680ff;
                                    color: white;
                                    padding: 5px 15px;
                                    border: none;
                                    border-radius: 5px;
                                    margin-top: 5px; width: 100%; cursor: pointer;" id="next">Tiếp</button>
                    <button style="background: #6680ff;
                                    color: white;
                                    padding: 5px 15px;
                                    border: none;display: none;
                                    border-radius: 5px;
                                    margin-top: 5px; width: 100%; cursor: pointer;" id="capnhat" onclick="submitPass()">Cập nhật</button>                
                </div>
            </div>
            
            <label for="">Số Điện Thoại</label>
            <div>
                <input class="btn" type="text" style="color: #828282;" name="" id="" value="<?php if(isset($user['sdt'])){echo $user['sdt']; }?>" readonly>
            </div>
            <label for="">Email</label>
            <div>
                <input class="btn" type="email" style="color: #828282;" name="" id="" value="<?php if(isset($user['gmail'])){echo $user['gmail']; }?>" readonly>
            </div>
        </div>
        <div style="text-align: center;">
            <button class="btnsua" onclick="window.location.href='/hoanghuy/Deadline/taikhoan/sua'">Sửa <i class="fas fa-pencil-alt"></i></button>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("next").onclick = function() {
                var element = document.getElementById("passcu").value;
                var element1 = document.getElementById("pass").value;
                var element2 = document.getElementById("passcu");
                var element3 = document.getElementById("passmoi");
                var element4 = document.getElementById("next");
                var element5 = document.getElementById("capnhat");
                if(element === element1){
                    element2.style.display = "none";
                    element3.style.display = "block";
                    element4.style.display = "none";
                    element5.style.display = "block";
                }
                else{
                    alert('Mật khẩu không chính xác!');
                    document.getElementById("passcu").value = "";
                }
            }
        });

        function show() {
            document.getElementById("iframeContainer").style.display = "block";
            document.getElementById("iframe").src = "/hoanghuy/Deadline/picture.php"; 
        }

        function editFunction() {
            var editDiv = document.getElementById("editDiv");
            if(editDiv.style.display == "block"){
                editDiv.style.display = "none";
            }
            else{
                editDiv.style.display = "block";
            }
            
        }

        function editFunction1() {
            var editDiv = document.getElementById("editDiv1");
            if(editDiv.style.display == "block"){
                editDiv.style.display = "none";
            }
            else{
                editDiv.style.display = "block";
            }
            
        }

        function submitNickname() {
            var nickname = document.getElementById("newNickname").value;
            if (nickname != null && nickname != "") {
                var form = document.createElement("form");
                form.method = "POST";
                form.action = "/hoanghuy/Deadline/update_nickname.php";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "nickname";
                input.value = nickname;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }
        function submitPass() {
            var passmoi = document.getElementById("passmoi").value;
            if (passmoi != null && passmoi != "") {
                var form = document.createElement("form");
                form.method = "POST";
                form.action = "/hoanghuy/Deadline/update_pass.php";

                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "passmoi";
                input.value = passmoi;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
