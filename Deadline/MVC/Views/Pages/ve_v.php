<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .phan {
            /* display: grid; */
            margin: 100px 20%;
            /* background: white;
            height: 750px; */
            border-radius: 15px;
            /* font-family: apple-system, BlinkMacSystemFont, "Segoe UI", Tahoma, Helvetica, sans-serif; */
            padding: 17px;
        }
        body {
            background: #ecf0f5;
        }
        .cut {
            background: #e0e0e0;
            padding: 10px 10px 30px 10px;
            position: relative; /* Ensure pseudo-element is positioned relative to this element */
            overflow: hidden; /* Hide overflow to prevent pseudo-element from affecting layout */
            
        }
        .cut:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 0;
            border-bottom: 25px solid white; /* Adjust this value to control the size of the cut */
            border-right: 25px solid transparent;
            z-index: 1; /* Ensure pseudo-element is above the background but below the content */
        }
    </style>
</head>
<body>
    <div class="phan">
        <div>Thông tin vé</div>
        <div style="margin-bottom: 50px;"><hr/></div>


        <!-- <div style="height: 330px;
                    padding: 5px;
                    border: groove; background: white;">
            <div style="font-weight: bold;">Thứ hai, 20-10-2024 > Thứ hai, 20-10-2024 Chuyến đi đến Hà Nội (HAN)</div>
            <div><hr/></div>
            <label style="font-size: 16px;" for="">Liên Hệ:</label>
            <div style="font-weight: bold;">MAI HUY HOANG</div>
            <div><hr/></div>
            <div style="display: grid; grid-template-columns: 6.5% 93.5%;">
                <div><img style="width: 50px;" src="/hoanghuy/Deadline/Public/Pictures/maybay.png" alt=""></div>
                <div>
                    <label>KHỞI HÀNH: <label style="font-size: 18px;font-weight: 600;">Thứ hai, 20-10-2024 > Đến: Thứ hai, 20-10-2024</label></label>
                    <div style="color: #828282; font-size: 14px;">Vui lòng kiểm tra thời gian bay trước khi khởi hành</div>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 4fr 2fr;">
                <div class="cut">
                    <div style="position: relative; z-index: 1;">
                        <div>VIETNAM AIRLINES</div>
                        <div style="font-weight: bold;margin-bottom: 7px;">VN 0224</div>
                        <div style="font-size: 12px;">Thời gian bay:</div>
                        <div style="font-size: 12px;margin-bottom: 7px;">2 tiếng 10 phút</div>
                        <div style="font-size: 12px;">Khoang:</div>
                        <div style="font-size: 12px;margin-bottom: 7px;">Phổ thông</div>
                        <div style="font-size: 12px;">Tình trạng chỗ:</div>
                        <div style="font-size: 12px;">Đã xác nhận</div>
                    </div>
                </div>
                <div style="border: groove; display: grid; grid-template-rows: 20% 80%;">
                    <div style="display: grid; grid-template-columns: 3fr 1fr 3fr; padding: 5px 10px 0px 10px;">
                        <span>
                            HÀ NỘI (HAN)
                        </span>
                        <span>
                            >
                        </span>
                        <span>
                            HỒ CHÍ MINH (SGN)
                        </span>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr;">
                        <div style="border-right: groove;border-top: groove; padding:0px 10px;">
                            <div>Giờ khởi hành:</div>
                            <div>22:00</div>
                            <div style="font-weight: bold; font-size: 14px;margin-bottom: 10px;">(ngày 20-10-2024)</div>
                            <div style="font-size: 14px;">Cổng:</div>
                            <div style="font-size: 14px;">Coming soon</div>
                        </div>
                        <div style="border-top: groove; padding: 0px 10px;">
                            <div>Giờ đến:</div>
                            <div>00:10</div>
                            <div style="font-weight: bold; font-size: 14px;margin-bottom: 10px;">(ngày 20-10-2024)</div>
                            <div style="font-size: 14px;">Cổng:</div>
                            <div style="font-size: 14px;">Coming soon</div>
                        </div>
                    </div>
                </div>
                <div style="border-top: groove; border-bottom: groove;border-right: groove; padding: 10px;">
                    <div>Máy bay:</div>
                    <div>AIRBUS INDUSTRIE</div>
                    <div style="margin-bottom: 5px;">A321 JET</div>
                    <div style="font-size: 14px;">Quãng đường đi</div>
                    <div style="font-size: 14px;">(Dặm)</div>
                    <div style="font-size: 14px;">Coming soon</div>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; margin-top: 15px;">
                <div style="background: #e0e0e0; border-right: groove;">
                    <div>Tên Hành Khách</div>
                    <div></div>
                </div>
                <div style="background: #e0e0e0; border-right: groove;">
                    <div>Ghế</div>
                    <div>Được thông báo khi checkin</div>
                </div>
                <div style="background: #e0e0e0">
                    <div>eTicket</div>
                    <div>Coming soon</div>
                </div>
            </div>
        </div> -->
            <?php
                require_once 'MVC/Core/connectDB1.php';
                $db = new connectDB1();
                $conn = $db->getConnection();

                function removeVietnameseAccents($str) {
                    $accents_arr = array(
                        'a' => ['á', 'à', 'ả', 'ã', 'ạ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ'],
                        'e' => ['é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ'],
                        'i' => ['í', 'ì', 'ỉ', 'ĩ', 'ị'],
                        'o' => ['ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ'],
                        'u' => ['ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'],
                        'y' => ['ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'],
                        'd' => ['đ'],
                        'A' => ['Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ'],
                        'E' => ['É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ'],
                        'I' => ['Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'],
                        'O' => ['Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ'],
                        'U' => ['Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự'],
                        'Y' => ['Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'],
                        'D' => ['Đ']
                    );

                    foreach ($accents_arr as $key => $accents) {
                        foreach ($accents as $accent) {
                            $str = str_replace($accent, $key, $str);
                        }
                    }

                    return $str;
                }

                if ($user) {
                    $taikhoan = $user['username'];
                    $sql = "SELECT tt.*, tk.*
                            FROM thongtinhanhkhach tt
                            JOIN thongtinlienhe tk ON tt.IDLienHe = tk.ID
                            WHERE tk.TaiKhoan = '$taikhoan'";
                    $result = $conn->query($sql);

                    $flight_infos = array(
                        array("VN 0224", "AIRBUS INDUSTRIE", "A321 JET"),
                        array("VN 0244", "BOEING", "B737"),
                        array("VN 0333", "AIRBUS", "A380"),
                        array("VN 0401", "BOEING", "B747"),
                        array("VN 0505", "AIRBUS INDUSTRIE", "A330"),
                        array("VN 0606", "BOEING", "B787"),
                        array("VN 0707", "AIRBUS", "A350"),
                        array("VN 0808", "EMBRAER", "E190"),
                        array("VN 0909", "BOMBARDIER", "CRJ900"),
                        array("VN 1010", "AIRBUS INDUSTRIE", "A319"),
                        array("VN 1111", "BOEING", "B777"),
                        array("VN 1212", "AIRBUS", "A300"),
                        array("VN 1313", "BOEING", "B737 MAX"),
                        array("VN 1414", "AIRBUS INDUSTRIE", "A321 NEO"),
                        array("VN 1515", "BOEING", "B787-10")
                    );

                    $info_count = count($flight_infos);
                    $info_index = 0;

                    $displayed_flights = [];

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $IDLienHe = $row['IDLienHe'];
                            $lienHe = strtoupper(removeVietnameseAccents($row['TenLienHe']));
                            $diemDi = strtoupper(removeVietnameseAccents($row['DiemDi']));
                            $diemDen = strtoupper(removeVietnameseAccents($row['DiemDen']));
                            $hang = strtoupper(removeVietnameseAccents($row['HangBay']));
                            $ngayDi = $row['NgayDi'];
                            $gioBay = $row['GioBay'];
                            $gioDen = date('H:i', strtotime($row['GioDen']));

                            if (in_array("$gioBay-$IDLienHe-$ngayDi", $displayed_flights)) {
                                continue;
                            }
                
                            $displayed_flights[] = "$gioBay-$IDLienHe-$ngayDi";

                            $date = DateTime::createFromFormat('Y-m-d', $ngayDi);
                            if ($date) {
                                $daysOfWeek = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
                                $dayOfWeek = $daysOfWeek[$date->format('w')];
                                $formattedDateForDisplay = $dayOfWeek . ", " . $date->format('d-m-Y');
                            } else {
                                echo "Định dạng ngày không hợp lệ.";
                            }

                            $flight_info = $flight_infos[$info_index % $info_count];
                            $info_index++;

                            $maChuyenBay = $flight_info[0];
                            $tenMayBay = $flight_info[1];
                            $loaiMayBay = $flight_info[2];

                            echo "
                            <div style='padding: 5px; border: groove; background: white; margin-bottom: 15px'>
                                <div style='font-weight: bold;'>$formattedDateForDisplay > $formattedDateForDisplay Chuyến đi đến $diemDen</div>
                                <div><hr/></div>
                                <label style='font-size: 16px;' for=''>Liên Hệ:</label>
                                <div style='font-weight: bold;'>$lienHe</div>
                                <div><hr/></div>
                                <div style='display: grid; grid-template-columns: 6.5% 93.5%;'>
                                    <div><img style='width: 50px;' src='/hoanghuy/Deadline/Public/Pictures/maybay.png' alt=''></div>
                                    <div>
                                        <label>KHỞI HÀNH: <label style='font-size: 18px; font-weight: 600;'>$formattedDateForDisplay > Đến: $formattedDateForDisplay</label></label>
                                        <div style='color: #828282; font-size: 14px;'>Vui lòng kiểm tra thời gian bay trước khi khởi hành</div>
                                    </div>
                                </div>
                                <div style='display: grid; grid-template-columns: 2fr 4fr 2fr;'>
                                    <div class='cut'>
                                        <div style='position: relative; z-index: 1;'>
                                            <div>$hang</div>
                                            <div style='font-weight: bold; margin-bottom: 7px;'>$maChuyenBay</div>
                                            <div style='font-size: 12px;'>Thời gian bay:</div>
                                            <div style='font-size: 12px; margin-bottom: 7px;'>2 tiếng 10 phút</div>
                                            <div style='font-size: 12px;'>Khoang:</div>
                                            <div style='font-size: 12px; margin-bottom: 7px;'>Phổ thông</div>
                                            <div style='font-size: 12px;'>Tình trạng chỗ:</div>
                                            <div style='font-size: 12px;'>Đã xác nhận</div>
                                        </div>
                                    </div>
                                    <div style='border: groove; display: grid; grid-template-rows: 20% 80%;'>
                                        <div style='display: grid; grid-template-columns: 3fr 1fr 3fr; padding: 5px 10px 0px 10px;'>
                                            <span>$diemDi</span>
                                            <span>></span>
                                            <span>$diemDen</span>
                                        </div>
                                        <div style='display: grid; grid-template-columns: 1fr 1fr;'>
                                            <div style='border-right: groove; border-top: groove; padding: 0px 10px;'>
                                                <div>Giờ khởi hành:</div>
                                                <div>$gioBay</div>
                                                <div style='font-weight: bold; font-size: 14px; margin-bottom: 10px;'>($formattedDateForDisplay)</div>
                                                <div style='font-size: 14px;'>Cổng:</div>
                                                <div style='font-size: 14px;'>Coming soon</div>
                                            </div>
                                            <div style='border-top: groove; padding: 0px 10px;'>
                                                <div>Giờ đến:</div>
                                                <div>$gioDen</div>
                                                <div style='font-weight: bold; font-size: 14px; margin-bottom: 10px;'>($formattedDateForDisplay)</div>
                                                <div style='font-size: 14px;'>Cổng:</div>
                                                <div style='font-size: 14px;'>Coming soon</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style='border-top: groove; border-bottom: groove; border-right: groove; padding: 10px;'>
                                        <div>Máy bay:</div>
                                        <div>$tenMayBay</div>
                                        <div style='margin-bottom: 5px;'>$loaiMayBay</div>
                                        <div style='font-size: 14px;'>Quãng đường đi</div>
                                        <div style='font-size: 14px;'>(Dặm)</div>
                                        <div style='font-size: 14px;'>Coming soon</div>
                                    </div>
                                </div>
                                <div style='display: grid; grid-template-columns: 1fr 1fr 1fr; margin-top: 15px;'>
                                    <div style=' border-right: groove; border-left: groove;'>
                                        <div style='background: #e0e0e0;'>Tên Hành Khách</div>
                                        <div></div>
                                        ";
                                    $IDLienHe = $row['IDLienHe'];
                                    $sql_hanhkhach = "SELECT * FROM thongtinhanhkhach WHERE IDLienHe = $IDLienHe";
                                    $result_hanhkhach = $conn->query($sql_hanhkhach);

                                    if ($result_hanhkhach->num_rows > 0) {
                                        while ($row_hanhkhach = $result_hanhkhach->fetch_assoc()) {
                                            if($row_hanhkhach['GioBay']==$gioBay&&$row_hanhkhach['NgayDi']==$ngayDi){
                                                $tt = "";
                                                if($row_hanhkhach['TrangThai']=="Đã sử dụng"){
                                                    $tt = "style='display: none;'";
                                                }
                                                echo "<div>" . $row_hanhkhach['TenHanhKhach'] . " <button $tt class='cancel-btn' data-id='" . $row_hanhkhach['ID'] . "' style='float: right; font-size: 10px; margin-right: 1px; cursor: pointer;'>Hủy</button></div>";
                                            }
                                        }
                                    } else {
                                        echo "<div>Không có thông tin hành khách</div>";
                                    }

                                echo "</div>
                                <div style=' border-right: groove;'>
                                    <div style='background: #e0e0e0;'>Ghế</div>
                                    <div>Được thông báo khi checkin</div>
                                </div>
                                <div style=' border-right: groove;'>
                                    <div style='background: #e0e0e0;'>eTicket</div>
                                    <div>Coming soon</div>
                                </div>
                            </div>
                        </div>";
                        }
                    } else {
                        echo "0 results";
                    }
                }

                $conn->close();
            ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.cancel-btn').click(function() {
            var id = $(this).data('id');
            var confirmation = confirm("Bạn có chắc chắn muốn hủy không? (Lưu ý: Bạn sẽ mất 40% giá vé!)");
            if (confirmation) {
                $.ajax({
                    url: '/hoanghuy/Deadline/cancel_ticket.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        });
    });
</script>
</body>
</html>