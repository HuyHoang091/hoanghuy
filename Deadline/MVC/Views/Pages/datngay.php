<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Tìm kiếm và đặt vé máy bay</title>
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/seach10.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/header.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/content9.css">
    <link rel="stylesheet" href="/hoanghuy/Deadline/Public/Css/globalcss.css">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .date-picker {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        width: 200px;
        }
    </style>
    <style>
        .thesb{
            background: #F2F2F2;
            color: black;
            padding: 7px;
            font-size: 14px;
        }
        .item:hover{
            background-color: #d9e7f7;
        }
        .item{
            height: 45px;
            padding-left: 10px;
            padding-top: 8px;
            padding-bottom: 5px;
        }
        .date-picker {
            width: 102.1% !important;
            padding: 0px !important;
            background: white;
            color: black;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .dropdown-toggle {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown .dropdown-menu {
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            display: none;
            top: calc(100% + 10px);
            border-radius: 4px;
            padding: 10px;
            font-size: 18px;
        }

        .dropdown .dropdown-menu.show {
            display: block;
        }

        .dropdown .dropdown-item {
            padding: 12px 16px;
            text-decoration: none;
            display: grid;
            grid-template-columns: 4fr 1fr;
            background: white !important;
            color: #333;
        }

        .dropdown .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .input-group {
            display: flex;
            width: 65px;
        }

        .input-group-btn {
            display: flex;
            flex-direction: column;
        }

        .form-control {
            flex: 1;
            text-align: center;
            width: 10px;
            border: none;
            font-size: 15px;
        }

        .btn-outline-secondary {
            background-color: transparent;
            border: 1px solid #ced4da;
            color: #495057;
            cursor: pointer;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <form action="/hoanghuy/Deadline/Datve/Get_data" method="post">
    <input type="hidden" id="selectedDateHidden" name="selectedDateHidden">
    <input type="hidden" id="selectedDateHidden1" name="selectedDateHidden1">
    <div style='background-image: url(/hoanghuy/Deadline/Public/Pictures/nen.jpg); width: 100%; height: 700px;'>
        <div class="cbdatve" style="padding-top: 160px !important">
            <div style="color: #000000ab;">
                <h1 style="margin: 0px;">
                    Đặt vé máy bay giá rẻ
                    <span style="font-size: 16px;
                                    padding: 10px 15px;
                                    background: #f4dcdb;
                                    border-radius: 50px;
                                    color: #e52822;">
                        <?php
                        require_once 'MVC/Core/connectDB1.php';
                        $db = new connectDB1();
                        $conn = $db->getConnection();

                        // Truy vấn SQL
                        $sql = "SELECT * FROM thongtinhanhkhach"; // Thay "your_table_name" bằng tên bảng của bạn
                        $result = $conn->query($sql);

                        // Đếm số dòng
                        $total_rows = $result->num_rows;
                        echo "☆ " . $total_rows . " khách đã đặt vé";

                        // Đóng kết nối
                        $conn->close();
                        ?>
                    </span>
                </h1>
                
            </div>
            <div><p style="font-size: 20px; margin: 15px 0px; color: #000000ab;">Xuất vé nhanh gọn - hỗ trợ chuyên nghiệp tận tâm</p></div>
            <div class="pv">
                <div class="grid-radio">
                    <div>
                    <label class="container-radio">
                        <input type="radio" value = "Khứ hồi" autocomplete="off" checker name="option" checked> Khứ hồi
                        <span >
                        </span>
                    </label>
                    </div> 
                    <div>   
                    <label class="container-radio">
                        <input type="radio" value = "Một chiều" autocomplete="off" checker name="option"> Một chiều
                        <span>
                        </span>
                    </label>
                    </div>
                </div>
                <div class="grid-combobox">
                    <div class="grid-phanlo position-relative">
                        <div class="grid-chuyenbay" style="background: white; min-width: 102.1%; border-top-left-radius: 4px; border-bottom-left-radius: 4px">
                            <div class="img"><img src="/hoanghuy/Deadline/Public/Pictures/di.jpg" alt="" style="width: 100%;"></div>
                            <div>
                                <div style="color: #756f6f; margin-left: 4px; margin-top: 12px;">Từ</div>
                            <input type="text" id="passengers-1" name="passengers1" class="container-combobox" value="Hà Nội (HAN)" readonly>
                            
                            </div>
                            <div class="option-container-1 position-absolute" style="z-index: 1000; opacity: 0.91; overflow: auto;height: 350px; left: auto; margin-top: 70px;">
                                <div>
                                    <div class="thesb">Sân bay nội địa phổ biến</div>
                                </div>
                                <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();

                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynoidia";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["SanBay"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-1')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                                <div>
                                    <div class="thesb">Sân bay quốc tế phổ biến</div>
                                </div>
                                <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();

                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynuocngoai";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["San"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-1')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                            </div>

                            <div class="option-container-2 position-absolute" style="z-index: 1000; opacity: 0.91;overflow: auto;height: 350px; left: auto; margin-top: 70px;">
                                <div>
                                        <div class="thesb">Sân bay nội địa phổ biến</div>
                                    </div>
                                    <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();
                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynoidia";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["SanBay"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-2')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                                <div>
                                    <div class="thesb">Sân bay quốc tế phổ biến</div>
                                </div>
                                <?php
                                    require_once 'MVC/Core/connectDB1.php';
                                    $db = new connectDB1();
                                    $conn = $db->getConnection();
                                    
                                    // Truy vấn dữ liệu từ bảng giave với điều kiện DiemDi và DiemDen trùng khớp
                                    $sql = "SELECT * FROM sanbaynuocngoai";
                                    $result = $conn->query($sql);
                        
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $tinh=$row["Tinh"];
                                            $sb=$row["San"];
                                            echo"<div onclick=\"selectOption('$tinh', 'passengers-2')\" class='item'>
                                                    <div style='color: black'>$tinh</div>
                                                    <div style='color: #928c8c'>$sb</div>
                                                </div>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                            
                                    $conn->close();
                                ?>
                            </div>
                        </div>
                        <div class="grid-chuyenbay" style="background: white ;min-width: 102.1%; border-top-right-radius: 4px; border-bottom-right-radius: 4px">
                            <div class="img"><img src="/hoanghuy/Deadline/Public/Pictures/ve.png" alt="" style="width: 100%;"></div>
                            <div>
                                <div style="color: #756f6f; margin-left: 4px; margin-top: 12px;">Đến</div>
                            <input type="text" id="passengers-2" name="passengers2" class="container-combobox" value="Hồ Chí Minh (SGN)" readonly>
                            
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" id="toggleBtn">
                            Chọn số khách
                        </button>
                        <div class="dropdown-menu" aria-labelledby="toggleBtn">
                            <div class="dropdown-item">
                                <label for="adults">Người lớn</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" id="adultsDecrement">-</button>
                                    </div>
                                    <input type="text" class="form-control" id="adults" name="adults" value="1" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" id="adultsIncrement">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <label for="children">Trẻ em</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" id="childrenDecrement">-</button>
                                    </div>
                                    <input type="text" class="form-control" id="children" name="children" value="0" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" id="childrenIncrement">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <label for="infant">Em bé</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" id="infantDecrement">-</button>
                                    </div>
                                    <input type="text" class="form-control" id="infant" name="infant" value="0" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-outline-secondary" type="button" id="infantIncrement">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid-phanlo">
                        <div id="datePicker1" class="date-picker" style="border-top-left-radius: 4px; border-bottom-left-radius: 4px;">
                            
                                <label href="">
                                    <div class="grid-chuyenbay">
                                        <div class="img">
                                            <img src="/hoanghuy/Deadline/Public/Pictures/tgdi.png" alt="" style="width: 55%;">
                                        </div>
                                        <div>
                                            <div style="margin-left: 4px; margin-top: 12px;">
                                                <span id="selectedDate1"></span>
                                            </div>
                                            <div style="margin-left: 4px; margin-top: 4px; color: #756f6f;">
                                                <span id="selectedDay1"></span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                           
                        </div>    
                        <div id="datePicker2" class="date-picker" style="border-top-right-radius: 4px; border-bottom-right-radius: 4px;">
                        
                                <label href="">
                                    <div class="grid-chuyenbay">
                                        <div class="img">
                                            <img src="/hoanghuy/Deadline/Public/Pictures/tgdi.png" alt="" style="width: 55%;">
                                        </div>
                                        <div>
                                            <div style="margin-left: 4px; margin-top: 12px;">
                                                <span id="selectedDate2"></span>
                                            </div>
                                            <div style="margin-left: 4px; margin-top: 4px; color: #756f6f;">
                                                <span id="selectedDay2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                        
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="tim-button" name="timkiem">Tìm chuyến bay</button>
                    </div>
                        </div>    
                        </div>        
                        
                    </div>
                    
                </div>
            </div>
        </div>
            
    </div>
    <div class="div1 ticker" style="margin-bottom: 7px; margin-top: 7px;">
        <div class="grid-chuyenbay">
            <div><img style="width: 100%;" src="/hoanghuy/Deadline/Public/Pictures/icon.png" alt=""></div>
            <div>
                <p style="margin-bottom: 7px;">Đặt vé nhanh chóng dễ dàng</p>
                <p style="color: #828282; font-size: 13px; margin-top: 7px;">Mua vé máy bay dễ dàng, xuất vé tức thời</p>
            </div>
        </div>
        <div class="grid-chuyenbay">
            <div><img style="width: 100%;" src="/hoanghuy/Deadline/Public/Pictures/icon1.png" alt=""></div>
            <div>
                <p style="margin-bottom: 7px;">Thanh toán an toàn</p>
                <p style="color: #828282; font-size: 13px; margin-top: 7px;">Nhiều hình thức thanh toán linh hoạt</p>
            </div>
        </div>
        <div class="grid-chuyenbay">
            <div><img style="width: 100%;" src="/hoanghuy/Deadline/Public/Pictures/icon2.jpg" alt=""></div>
            <div>
                <p style="margin-bottom: 7px;">Dịch vụ tận tâm</p>
                <p style="color: #828282; font-size: 13px; margin-top: 7px;">Hỗ trợ nhanh chóng, chuyên nghiệp, đáng tin cậy</p>
            </div>
        </div>
    </div>
      <!-- sân bay -->
      <script>
        let container1 = document.querySelector(".option-container-1");
        let container2 = document.querySelector(".option-container-2");

        const selectOption = (value, id) => {
            
            console.log("aa");
            document.getElementById(id).value = value;
            container1.style.display = "none";
            container2.style.display = "none";
        }
        document.querySelector('#passengers-1').addEventListener('focus', function(e) {
            container1.style.display = "block";
        })
        document.addEventListener('click', function(event) {
            var clickedElement = event.target;
            if (!container1.contains(clickedElement) && clickedElement.id !== 'passengers-1') {
                container1.style.display = "none";
            }
        });
        document.querySelector('#passengers-2').addEventListener('focus', function(e) {
            container2.style.display = "block";
        })
        document.addEventListener('click', function(event) {
            var clickedElement = event.target;
            if (!container2.contains(clickedElement) && clickedElement.id !== 'passengers-2') {
                container2.style.display = "none";
            }
        });
    </script>
    <!-- ngày tháng -->
    <script>
        function getDayName(dateStr) {
            const date = new Date(dateStr);
            const days = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
            return days[date.getDay()];
        }

        function formatDate(date) {
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            return `${day} tháng ${month}`;
        }
        let isFirstLoad = true;
        const datePicker1 = flatpickr("#datePicker1", {
            dateFormat: "d\\ t\\h\\á\\n\\g m",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const selectedDateSpan1 = document.getElementById('selectedDate1');
                    const selectedDaySpan1 = document.getElementById('selectedDay1');
                    const selectedDateHidden = document.getElementById('selectedDateHidden');
                    const dayName = getDayName(selectedDates[0]);
                    selectedDateSpan1.textContent = `${dateStr}`;
                    selectedDaySpan1.textContent = `${dayName}`;

                    if (isFirstLoad) {
                        const selectedDateSpan2 = document.getElementById('selectedDate2');
                        const selectedDaySpan2 = document.getElementById('selectedDay2');
                        const dayAfterTomorrow = new Date(selectedDates[0]);
                        dayAfterTomorrow.setDate(dayAfterTomorrow.getDate() + 2);
                        selectedDateSpan2.textContent = formatDate(dayAfterTomorrow);
                        selectedDaySpan2.textContent = day = getDayName(dayAfterTomorrow);
                        date = formatDate1(dayAfterTomorrow);
                        selectedDateHidden1.value = `${day}, ${date}`;
                        isFirstLoad = false; 
                    }

                    const date2 = datePicker2.selectedDates[0];
                    if (date2 && selectedDates[0] > date2) {
                        alert("Ngày đi không được sau ngày về!");
                        datePicker1.clear();
                        selectedDateSpan1.textContent = "";
                        selectedDaySpan1.textContent = "";
                        selectedDateHidden.value = "";
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const dayAfterTomorrow = new Date();
            dayAfterTomorrow.setDate(today.getDate() + 2);

            const selectedDate1 = document.getElementById('selectedDate1');
            const selectedDay1 = document.getElementById('selectedDay1');
            const selectedDate2 = document.getElementById('selectedDate2');
            const selectedDay2 = document.getElementById('selectedDay2');
            const selectedDateHidden = document.getElementById('selectedDateHidden');
            const selectedDateHidden1 = document.getElementById('selectedDateHidden1');

            selectedDate1.textContent = formatDate(today);
            selectedDay1.textContent = day= getDayName(today);
            date = formatDate1(today);
            selectedDateHidden.value = `${day}, ${date}`;

            selectedDate2.textContent = formatDate(dayAfterTomorrow);
            selectedDay2.textContent = day1 = getDayName(dayAfterTomorrow);
            date1 = formatDate1(dayAfterTomorrow);
            selectedDateHidden1.value = `${day1}, ${date1}`;
        });

        const datePicker2 = flatpickr("#datePicker2", {
            dateFormat: "d\\ t\\h\\á\\n\\g m",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const selectedDateSpan2 = document.getElementById('selectedDate2');
                    const selectedDaySpan2 = document.getElementById('selectedDay2');
                    const selectedDateHidden1 = document.getElementById('selectedDateHidden1');
                    const dayName = getDayName(selectedDates[0]);
                    selectedDateSpan2.textContent = `${dateStr}`;
                    selectedDaySpan2.textContent = `${dayName}`;

                    const date1 = datePicker1.selectedDates[0];
                    if (date1 && selectedDates[0] < date1) {
                        alert("Ngày về không được trước ngày đi!");
                        datePicker2.clear();
                        selectedDateSpan2.textContent = "";
                        selectedDaySpan2.textContent = "";
                        selectedDateHidden1.value = "";
                    }
                }
            }
        });
        //////////////////
        function formatDate1(date) {
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }


        let selectedDateFormatted = '';
        const selectedDateHidden = document.getElementById('selectedDateHidden');
        const selectedDateHidden1 = document.getElementById('selectedDateHidden1');

        datePicker1.config.onClose.push(function(selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                const dayName = getDayName(selectedDates[0]);
                date = formatDate1(selectedDates[0]);
                const formattedDate = `${dayName}, ${date}`;
                selectedDateHidden.value = `${dayName}, ${date}`;
            }
        });

        datePicker2.config.onClose.push(function(selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                const dayName = getDayName(selectedDates[0]);
                date = formatDate1(selectedDates[0]);
                const formattedDate = `${dayName}, ${date}`;
                selectedDateHidden1.value = `${dayName}, ${date}`;
            }
        });
    </script>
    <!-- số khách -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggleBtn = document.getElementById('toggleBtn');
            var dropdownMenu = toggleBtn.nextElementSibling;

            toggleBtn.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });

            document.getElementById('adultsIncrement').addEventListener('click', function() {
                var currentValue = parseInt(document.getElementById('adults').value);
                document.getElementById('adults').value = currentValue + 1;
            });

            document.getElementById('adultsDecrement').addEventListener('click', function() {
                var currentValue = parseInt(document.getElementById('adults').value);
                if (currentValue > 0) {
                    document.getElementById('adults').value = currentValue - 1;
                }
            });

            document.getElementById('childrenIncrement').addEventListener('click', function() {
                var currentValue = parseInt(document.getElementById('children').value);
                document.getElementById('children').value = currentValue + 1;
            });

            document.getElementById('childrenDecrement').addEventListener('click', function() {
                var currentValue = parseInt(document.getElementById('children').value);
                if (currentValue > 0) {
                    document.getElementById('children').value = currentValue - 1;
                }
            });

            document.getElementById('infantIncrement').addEventListener('click', function() {
                var currentValue = parseInt(document.getElementById('infant').value);
                document.getElementById('infant').value = currentValue + 1;
            });

            document.getElementById('infantDecrement').addEventListener('click', function() {
                var currentValue = parseInt(document.getElementById('infant').value);
                if (currentValue > 0) {
                    document.getElementById('infant').value = currentValue - 1;
                }
            });

            document.addEventListener('click', function(event) {
                if (!toggleBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
    </form>
</body>
</html>