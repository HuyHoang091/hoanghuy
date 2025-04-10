<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/seach10.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/bootstrap.min.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/dinhdang7.css">
    
    <style>
        .dd2{
            width: 440px;
        }
        body{
            background: #ecf0f5;
        }
    </style>
    <style>
        /* CSS để ẩn iframe ban đầu */
        #iframeContainer {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45%;
            height: 56%;
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
</head>
<body>
    <form id="FormTT" method="post" action="./themve">
        <input type="hidden" name="diemdi" value="<?php echo $data['tu'] ?>">
        <input type="hidden" name="diemden" value="<?php echo $data['den'] ?>">
        <input type="hidden" name="giobay" value="<?php echo $data['giodi'] ?>">
        <input type="hidden" name="gioden" value="<?php echo $data['giove'] ?>">
        <input type="hidden" name="ngaydi" value="<?php
                                                $daysOfWeek = ["Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật"];
                                                foreach ($daysOfWeek as $day) {
                                                    $data['date'] = str_replace($day . ", ", "", $data['date']);
                                                }
                                                $date = DateTime::createFromFormat('d-m-Y', $data['date']);
                                                if ($date) {
                                                    echo $date->format('Y-m-d');
                                                } else {
                                                    echo "Định dạng ngày không hợp lệ.";
                                                }
                                                ?>">
        <input type="hidden" name="ngayve" value="<?php
                                                $daysOfWeek = ["Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật"];
                                                foreach ($daysOfWeek as $day) {
                                                    $data['date1'] = str_replace($day . ", ", "", $data['date1']);
                                                }
                                                $date = DateTime::createFromFormat('d-m-Y', $data['date1']);
                                                if ($date) {
                                                    echo $date->format('Y-m-d');
                                                } else {
                                                    echo "Định dạng ngày không hợp lệ.";
                                                }
                                                ?>">
        <input type="hidden" name="giobay1" value="<?php echo $data['giodi1'] ?>">
        <input type="hidden" name="gioden1" value="<?php echo $data['giove1'] ?>">
        <input type="hidden" name="lon" id="loncheck" value="<?php echo $data['lon'] ?>">
        <input type="hidden" name="tre" id="trecheck" value="<?php echo $data['tre'] ?>">
        <input type="hidden" name="be" id="becheck" value="<?php echo $data['be'] ?>">
        <input type="hidden" name="kv" id="test" value="<?php echo $data['kv']; ?>">
        <input type="hidden" name="user" id="us" value="<?php if(isset($user['username'])){echo $user['username'];} ?>">
        <input type="hidden" name="hmaybay" id="test" value="<?php echo $data['hmaybay']; ?>">
        <input type="hidden" name="hmaybay1" id="test" value="<?php echo $data['hmaybay1']; ?>">
        <input type="hidden" name="sothenganhang" id="sothenganhang">
        <input type="hidden" name="nganhang" id="nganhang">
        <input type="hidden" name="gialon" id="test" value="<?php $parts = explode('x', $data['gialon']);
                                                                if (count($parts) == 2) {
                                                                $number = str_replace('.', '', trim($parts[1]));
                                                                echo (int)$number;} ?>">
        <input type="hidden" name="giatre" id="test" value="<?php $parts = explode('x', $data['giatre']);
                                                                if (count($parts) == 2) {
                                                                $number = str_replace('.', '', trim($parts[1]));
                                                                echo (int)$number;} ?>">
        <input type="hidden" name="giabe" id="test" value="<?php $parts = explode('x', $data['giabe']);
                                                                if (count($parts) == 2) {
                                                                $number = str_replace('.', '', trim($parts[1]));
                                                                echo (int)$number;} ?>">
        <input type="hidden" name="gialon1" id="test" value="<?php $parts = explode('x', $data['gialon1']);
                                                                if (count($parts) == 2) {
                                                                $number = str_replace('.', '', trim($parts[1]));
                                                                echo (int)$number;} ?>">
        <input type="hidden" name="giatre1" id="test" value="<?php $parts = explode('x', $data['giatre1']);
                                                                if (count($parts) == 2) {
                                                                $number = str_replace('.', '', trim($parts[1]));
                                                                echo (int)$number;} ?>">
        <input type="hidden" name="giabe1" id="test" value="<?php $parts = explode('x', $data['giabe1']);
                                                                if (count($parts) == 2) {
                                                                $number = str_replace('.', '', trim($parts[1]));
                                                                echo (int)$number;} ?>">                                      
        <div class="grid-cot1" style="gap: 20px !important;margin-top: 110px;">
            <div style=" background: white; padding: 25px;">
                <div style="font-size: 24px; color: #003c71; margin-bottom: 10px;">Thông tin liên hệ</div>
                <div class="" id="ttlh">
                    <label style="font-size: 14px; font-weight: 300; color: #828282;">Quý danh</label>
                    <select name="gioitinhlh" id="quydanh" class="form-control dd2">
                        <option value="">---Chọn giới tính---</option>
                        <option value="Quý ông">Quý ông</option>
                        <option value="Quý bà">Quý bà</option>
                    </select>
                    <label style="font-size: 14px; font-weight: 300; color: #828282;">Họ và tên đầy đủ</label>
                    <input type="text" id="htlh" class="form-control dd2" name="txtTenlienhe">
                    <label style="font-size: 14px; font-weight: 300; color: #828282;">Số điện thoại</label>
                    <input type="tel" id="sdtlh" class="form-control dd2" name="txtDtlienhe">

                    <label style="font-size: 14px; font-weight: 300; color: #828282;">Chọn kênh liên lạc nhận vé</label>
                    <div style="margin-bottom: 10px;">
                    <input type="radio" style="width: 30px;" name="a" id="zalo" value="Zalo" checked>Zalo
                    <input type="radio" style="width: 30px;" name="a" id="em" value="Email">Email
                    </div>
                    
                    <input id="email" type="email" class="form-control dd2 thu" placeholder="Nhập email" name="elienhe">

                    <button type="button" id="ntt" class="btn btn-primary" style="margin-top: 20px; background: #F79321; border: none; padding: 10px; width: 300px;" name="btnLuu">Nhập thông tin hành khách ></button>
                </div>
                <div class="grid-thu" id="ttkh">
                    <div style="margin-bottom: 10px;">
                        <span id="gioitinh">Quý ông</span>
                        <span><strong id="tenlienhe"></strong></span>
                        <span>-</span>
                        <span id="lienhe">0917834505</span>
                    </div>
                    <div style="font-size: 24px; color: #003c71; margin-bottom: 10px;">Thông tin hành khách</div>
                    <?php
                        $songuoilon = $data['lon'];
                        for($i = 0; $i < $songuoilon; $i++)
                        {
                            echo "<div>
                        <span><strong>Người lớn</strong></span>
                        <span><strong>". ($i + 1) ."</strong></span>
                        </div>
                        <label style='font-size: 14px; font-weight: 300; color: #828282;'>Quý danh</label>
                        <select name='gthkl".($i+1)."' id='gtlon".($i+1)."' class='form-control dd2'>
                            <option value=''>---Chọn giới tính---</option>
                            <option value='Nam'>Quý ông</option>
                            <option value='Nữ'>Quý bà</option>
                        </select>
                        <label style='font-size: 14px; font-weight: 300; color: #828282;'>Họ và tên đầy đủ</label>
                        <input type='text' class='form-control dd2' id='tenlon".($i+1)."' name='txtTenhkl".($i+1)."'>
                        <label >Ngày sinh</label>
                        <input type='date' class='form-control dd2' id='nslon".($i+1)."' style='margin-bottom: 15px' name='txtNshkl".($i+1)."'>";
                        }
                        $songuoitre = $data['tre'];
                        for($i = 0; $i < $songuoitre; $i++)
                        {
                            echo "<div>
                        <span><strong>Trẻ em</strong></span>
                        <span><strong>". ($i + 1) ."</strong></span>
                        </div>
                        <label style='font-size: 14px; font-weight: 300; color: #828282;'>Quý danh</label>
                        <select name='gthkt".($i+1)."' id='gttre".($i+1)."' class='form-control dd2'>
                            <option value=''>---Chọn giới tính---</option>
                            <option value='Nam'>Quý ông</option>
                            <option value='Nữ'>Quý bà</option>
                        </select>
                        <label style='font-size: 14px; font-weight: 300; color: #828282;'>Họ và tên đầy đủ</label>
                        <input type='text' class='form-control dd2' id='tentre".($i+1)."' name='txtTenhkt".($i+1)."'>
                        <label >Ngày sinh</label>
                        <input type='date' class='form-control dd2' id='nstre".($i+1)."' style='margin-bottom: 15px' name='txtNshkt".($i+1)."'>";
                        }
                        $songuoibe = $data['be'];
                        for($i = 0; $i < $songuoibe; $i++)
                        {
                            echo "<div>
                        <span><strong>Em bé</strong></span>
                        <span><strong>". ($i + 1) ."</strong></span>
                        </div>
                        <label style='font-size: 14px; font-weight: 300; color: #828282;'>Quý danh</label>
                        <select name='gthkb".($i+1)."' id='gtbe".($i+1)."' class='form-control dd2'>
                            <option value=''>---Chọn giới tính---</option>
                            <option value='Nam'>Quý ông</option>
                            <option value='Nữ'>Quý bà</option>
                        </select>
                        <label style='font-size: 14px; font-weight: 300; color: #828282;'>Họ và tên đầy đủ</label>
                        <input type='text' class='form-control dd2' id='tenbe".($i+1)."' name='txtTenhkb".($i+1)."'>
                        <label >Ngày sinh</label>
                        <input type='date' class='form-control dd2' id='nsbe".($i+1)."' style='margin-bottom: 15px' name='txtNshkb".($i+1)."'>";
                        }
                    ?>
                    
                    <button type="button" class="btn btn-primary" style="margin-top: 20px; background: #F79321; border: none; padding: 10px; width: 300px;" name="btnLuu" onclick="<?php if(isset($user['taikhoan'])){echo 'showQRConfirmation()';}else{echo 'checkuser()';} ?>">Giữ vé & Thanh toán</button>
                </div>
            </div>
            
            <div class='grid-div2' id="ve" style="min-height: <?php if($data['kv']=="Một chiều"){echo "350px";}else{echo "500px";} ?>; overflow: auto; background: #f6f8fa;">
                <div style="font-size: 14px;">Chiều đi | <?php echo $data['date'] ?></div>
                <div class='' id='hangbay'><?php if ($data['hmaybay'] == "Vietjet") {
                            echo "<img src='/hoanghuy/Deadline/Public/Pictures/vietjet.png' alt='Viettel' style='width:90px;height:20px;margin-left:5px;'>";
                        } else if ($data['hmaybay'] == "VietnamAirlines") {
                            echo "<img src='/hoanghuy/Deadline/Public/Pictures/vnair.png' alt='VietnamAirlines' style='width:55px;height:20px;margin-left:5px;'>";
                        } else if ($data['hmaybay'] == "Bamboo") {
                            echo "<img src='/hoanghuy/Deadline/Public/Pictures/bamboo.png' alt='Bamboo' style='width:25px;height:20px;margin-left:5px;'>";
                        } ?> <?php echo $data['hmaybay'] ?></div>
                    <div class='phanlo-ve1' id='lodi'>
                        
                        <div>
                            <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDi' style="font-size: 20px;"><?php echo $data['giodi'] ?></strong></p>
                            <p style='margin-bottom: 4px; margin-top: 5px; font-size: 12px;' id='diemDi'><?php echo $data['tu'] ?></p>
                        </div>
                    
                    <div>
                        <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDen' style="font-size: 20px;"><?php echo $data['giove'] ?></strong></p>
                        <p style='margin-top: 5px; margin-bottom: 4px; font-size: 12px;' id='diemDen'><?php echo $data['den'] ?></p>
                    </div>
                    
                    <div>
                        <p style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; color: #828282;'>Chi phí</p>
                    </div>
                    <div></div>
                    <div style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; display: <?php if($data['lon']==0){echo 'none';} else {echo 'block';} ?>;'>Người lớn</div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px; font-size: 14px; font-weight: 300; float:right; display: <?php if($data['lon']==0){echo 'none';} else {echo 'block';} ?>;'><?php echo $data['gialon'] ?></p>
                    </div>
                    <div style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; display: <?php if($data['tre']==0){echo 'none';} else {echo 'block';} ?>;'>Trẻ em</div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px; font-size: 14px; font-weight: 300; float:right; display: <?php if($data['tre']==0){echo 'none';} else {echo 'block';} ?>;'><?php echo $data['giatre'] ?></p>
                    </div>
                    <div style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; display: <?php if($data['be']==0){echo 'none';} else {echo 'block';} ?>;'>Em bé</div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px; font-size: 14px; font-weight: 300; float:right; display: <?php if($data['be']==0){echo 'none';} else {echo 'block';} ?>;'><?php echo $data['giabe'] ?></p>
                    </div>
                </div>
                <div class="<?php if($data['kv']=="Một chiều"){echo "grid-thu";} ?>"><hr/></div>
                <div style="font-size: 14px;" class="<?php if($data['kv']=="Một chiều"){echo "grid-thu";} ?>">Chiều vể | <?php echo $data['date1'] ?></div>
                <div class=' <?php if($data['kv']=="Một chiều"){echo "grid-thu";} ?>' id='hangbay'><?php if ($data['hmaybay1'] == "Vietjet") {
                            echo "<img src='/hoanghuy/Deadline/Public/Pictures/vietjet.png' alt='Viettel' style='width:90px;height:20px;margin-left:5px;'>";
                        } else if ($data['hmaybay1'] == "VietnamAirlines") {
                            echo "<img src='/hoanghuy/Deadline/Public/Pictures/vnair.png' alt='VietnamAirlines' style='width:55px;height:20px;margin-left:5px;'>";
                        } else if ($data['hmaybay1'] == "Bamboo") {
                            echo "<img src='/hoanghuy/Deadline/Public/Pictures/bamboo.png' alt='Bamboo' style='width:25px;height:20px;margin-left:5px;'>";
                        } ?> <?php echo $data['hmaybay1'] ?></div>
                    <div class='phanlo-ve1 <?php if($data['kv']=="Một chiều"){echo "grid-thu";} ?>' id='lodi'>
                        
                        <div>
                            <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDi' style="font-size: 20px;"><?php echo $data['giodi1'] ?></strong></p>
                            <p style='margin-bottom: 4px; margin-top: 5px; font-size: 12px;' id='diemDi'><?php echo $data['den'] ?></p>
                        </div>
                    
                    <div>
                        <p style='margin-bottom: 5px;margin-top: 5px;' ><strong id='gioDen' style="font-size: 20px;"><?php echo $data['giove1'] ?></strong></p>
                        <p style='margin-top: 5px; margin-bottom: 4px; font-size: 12px;' id='diemDen'><?php echo $data['tu'] ?></p>
                    </div>
                    
                    <div>
                        <p style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; color: #828282;'>Chi phí</p>
                    </div>
                    <div></div>
                    <div style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; display: <?php if($data['lon']==0){echo 'none';} else {echo 'block';} ?>;'>Người lớn</div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px; font-size: 14px; font-weight: 300; float:right; display: <?php if($data['lon']==0){echo 'none';} else {echo 'block';} ?>;'><?php echo $data['gialon1'] ?></p>
                    </div>
                    <div style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; display: <?php if($data['tre']==0){echo 'none';} else {echo 'block';} ?>;'>Trẻ em</div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px; font-size: 14px; font-weight: 300; float:right; display: <?php if($data['tre']==0){echo 'none';} else {echo 'block';} ?>;'><?php echo $data['giatre1'] ?></p>
                    </div>
                    <div style='margin-bottom: 5px; margin-top: 0px; font-size: 14px; font-weight: 300; display: <?php if($data['be']==0){echo 'none';} else {echo 'block';} ?>;'>Em bé</div>
                    <div id='spandi' class='ss'>
                        <p style='margin-top: 0px; font-size: 14px; font-weight: 300; float:right; display: <?php if($data['be']==0){echo 'none';} else {echo 'block';} ?>;'><?php echo $data['giabe1'] ?></p>
                    </div>
                    
                </div>
                <div><hr/></div>
                <div class="phanlo-ve">
                    <div>Tổng tiền:</div>
                    <div ><strong style="float: right;"><?php if($data['kv']=="Một chiều"){echo number_format($data['giavedi'], 0, ',', '.') . " VND";}else{echo number_format($data['giavedi'] + $data['giaveve'], 0, ',', '.') . " VND";} ?></strong></div>
                </div>
                    
            </div>
            
        </div>
        <div id="iframeContainer">
            <iframe id="iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
        </div>
    </form>
    <script>
        function showQRConfirmation() {
            if(checkhk()){
                document.getElementById("iframeContainer").style.display = "block";
                document.getElementById("iframe").src = "/hoanghuy/qr-confirmation-project/public/index.php?data=<?php echo urlencode($data['giavedi'] + $data['giaveve']); ?>"; 
            }
            else{
                alert("Vui lòng nhập đầy đủ thông tin!");
                return;
            }
        }

        function checkuser(){
            alert('Vui lòng đăng nhập trước khi thanh toán!');
        }

        function checkhk(){
            var kq = false;
            const lon = document.getElementById('loncheck').value;
            const tre = document.getElementById('trecheck').value;
            const be = document.getElementById('becheck').value;
            for(let i = 1; i <= lon; i++){
                const gtlon = document.getElementById('gtlon' + i).value;
                const tenlon = document.getElementById('tenlon' + i).value;
                const nslon = document.getElementById('nslon' + i).value;
                if(gtlon!=""&&tenlon!=""&&nslon!=""){
                    kq=true;
                }
                else{
                    kq=false;
                }
            }
            for(let i = 1; i <= tre; i++){
                const gttre = document.getElementById('gttre' + i).value;
                const tentre = document.getElementById('tentre' + i).value;
                const nstre = document.getElementById('nstre' + i).value;
                if(gttre!=""&&tentre!=""&&nstre!=""){
                    kq=true;
                }
                else{
                    kq=false;
                }
            }
            for(let i = 1; i <= be; i++){
                const gtbe = document.getElementById('gtbe' + i).value;
                const tenbe = document.getElementById('tenbe' + i).value;
                const nsbe = document.getElementById('nsbe' + i).value;
                if(gtbe!=""&&tenbe!=""&&nsbe!=""){
                    kq=true;
                }
                else{
                    kq=false;
                }
            }
            return kq;
        }

        function qrScanned() {
            document.getElementById("iframeContainer").style.display = "none";
        }
        
        function qrHuy() {
            document.getElementById("iframeContainer").style.display = "none";
        }

        window.addEventListener('message', function(event) {
            var data = event.data;
            window[data.functionName]();
            document.getElementById("sothenganhang").value = data.user;
            document.getElementById("nganhang").value = data.nganhang;
            if(data.functionName == "qrScanned"){
                document.getElementById('FormTT').submit();
            }
        });
    </script>
    <script>
        function check(){
            var kq = false;
            quydanh = document.getElementById('quydanh').value;
            htlh = document.getElementById('htlh').value;
            sdtlh = document.getElementById('sdtlh').value;
            if(quydanh!=""&&htlh!=""&&sdtlh!=""){
                kq = true;
            }
            else{
                kq = false;
            }
            return kq;
        }
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("zalo").onclick = function() {
                var element = document.getElementById("email");
                element.classList.add("thu");
            }
            document.getElementById("em").onclick = function() {
                var element = document.getElementById("email");
                element.classList.remove("thu");
            }
            document.getElementById("ntt").onclick = function() {
                if(document.getElementById('us').value==""){
                    alert("Vui lòng đăng nhập để thực hiện!");
                    return;
                }
                else if(check()){
                    var element1 = document.getElementById("ttlh");
                    var element2 = document.getElementById("ttkh");
                    element1.classList.add("grid-thu");
                    element2.classList.remove("grid-thu");
                    document.getElementById('tenlienhe').innerHTML = document.getElementById('htlh').value;
                    document.getElementById('gioitinh').innerHTML = document.getElementById('quydanh').value;
                    document.getElementById('lienhe').innerHTML = document.getElementById('sdtlh').value;
                }
                else{
                    alert("Vui lòng nhập đầy đủ thông tin!");
                    return;
                }
            }
        });
    </script>
</body>
</html>