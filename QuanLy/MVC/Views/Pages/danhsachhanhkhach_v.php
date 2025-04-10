<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin liên hệ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .details {
            display: none;
        }
        .details-row {
            background-color: #f9f9f9;
        }
        body{
            background: #ecf0f5;
        }
    </style>
</head>
<body>
    <form method="post" action="./timkiem">
        
    <div>
        <div style="background: #e0e0e0;
                    min-height: 50px;
                    align-content: center;
                    display: grid;
                    grid-template-columns: 4fr 1fr 1fr;
                    margin-bottom: 15px;
                    padding: 10px;
                    gap: 15px;">
            <input type="text" style="padding: 4px 10px; border-radius: 5px;" name="txtTenLienHe" value="<?php if(isset($data['tlh'])){echo $data['tlh'];} ?>" placeholder="Tìm kiếm theo tên liên hệ...">
            <button type="submit" class="btn btn-primary" name="btnTimkiem">Tìm kiếm</button>
            <div>
                <button style="width: 100%;" type="button" class="btn btn-primary" onclick="Xuat()">Xuất Excel</button>
                <div style="display: none;
                            background: white;
                            margin-top: 5px;
                            text-align: center;
                            padding: 10px;
                            border-radius: 5px;
                            width: 180px;
                            position: absolute;" id="xuat">
                    <div style="padding: 5px;
                                background: #aaaa;
                                /* color: white; */
                                cursor: pointer;
                                border-radius: 5px; margin-bottom: 2px;" onclick="ExcelLienHe()">Thông tin liên hệ</div>
                    <div style="padding: 5px 0px;
                                background: #aaaa;
                                /* color: white; */
                                cursor: pointer;
                                border-radius: 5px;" onclick="ExcelHanhKhach()">Thông tin hành khách</div>
                </div>
            </div>
        </div>
        
        <table id="mainTable" style="width: 1140px;" class="table table-striped table-bordered">
            <thead class="thead-dark" style="font-size: 18px;">
                <tr class="ttlh">
                    <th>ID</th>
                    <th>Tên Liên Hệ</th>
                    <th>Giới Tính</th>
                    <th>Số Điện Thoại</th>
                    <th>Kênh Liên Hệ</th>
                    <th>Email</th>
                    <th>Tài Khoản</th>
                    <th class='detail-table'>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0){
                        while($row = mysqli_fetch_assoc($data['dulieu'])){
                        echo "<tr class='ttlh'>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['TenLienHe'] . "</td>";
                        echo "<td>" . $row['GioiTinh'] . "</td>";
                        echo "<td>" . $row['SoDienThoai'] . "</td>";
                        echo "<td>" . $row['KenhLienHe'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['TaiKhoan'] . "</td>";
                        echo "<td class='detail-table'>";
                        echo "<button type='button' class='btn btn-info btn-sm' onclick='fetchDetails1(" . $row['ID'] . ")'>Xem chi tiết</button> ";
                        echo "<a class='btn btn-outline-primary' 
                                href='http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/suattlh/" . $row['ID'] . "'>Sửa</a> ";
                        echo "<a class='btn btn-outline-danger' 
                                href='http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/xoattlh/" . $row['ID'] . "'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";

                        // Bảng chi tiết của thongtinhanhkhach
                        echo "<tr class='details-row' id='details-" . $row['ID'] . "' style='display: none;'>";
                        echo "<td colspan='8'>";
                        echo "<table style='width: 1105px; margin-left: 0px;' class='detail-table table table-bordered'>";
                        echo "<thead style='font-size: 18px;' class='thead-light'>";
                        echo "<tr class='details-row ttlh'>";
                        echo "<th>ID Hành Khách</th>";
                        echo "<th>Tên Hành Khách</th>";
                        echo "<th>Giới Tính</th>";
                        echo "<th>Ngày Sinh</th>";
                        echo "<th>Điểm Đi</th>";
                        echo "<th>Điểm Đến</th>";
                        echo "<th>Giờ Bay</th>";
                        echo "<th>Giờ Đến</th>";
                        echo "<th>Ngày Đi</th>";
                        echo "<th>Trạng Thái</th>";
                        echo "<th>Hành Động</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        require_once 'MVC/Core/connectDB1.php';
                        $db = new connectDB1();
                        $conn = $db->getConnection();
                        // Truy vấn dữ liệu từ thongtinhanhkhach có IDLienHe tương ứng
                        $sql_details = "SELECT * FROM thongtinhanhkhach WHERE IDLienHe = " . $row['ID'];
                        $result_details = $conn->query($sql_details);
                        while ($row_details = $result_details->fetch_assoc()) {
                            echo "<tr class='details-row'>";
                            echo "<td>" . $row_details['ID'] . "</td>";
                            echo "<td>" . $row_details['TenHanhKhach'] . "</td>";
                            echo "<td>" . $row_details['GioiTinh'] . "</td>";
                            echo "<td>" . $row_details['NgaySinh'] . "</td>";
                            echo "<td>" . $row_details['DiemDi'] . "</td>";
                            echo "<td>" . $row_details['DiemDen'] . "</td>";
                            echo "<td>" . $row_details['GioBay'] . "</td>";
                            echo "<td>" . $row_details['GioDen'] . "</td>";
                            echo "<td>" . $row_details['NgayDi'] . "</td>";
                            echo "<td>" . $row_details['TrangThai'] . "</td>";
                            echo "<td class='ttlh'>";
                            echo "<a class='btn btn-outline-primary' 
                                    href='http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/suatthk/" . $row_details['ID'] . "'>Sửa</a> ";
                            echo "<a class='btn btn-outline-danger' 
                                    href='http://localhost/hoanghuy/QuanLy/Danhsachhanhkhach/xoatthk/" . $row_details['ID'] . "'>Xóa</a>";
                            echo "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </form>
    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
        function fetchDetails1(id) {
            var detailsTable = document.getElementById('details-' + id);
            if (detailsTable.style.display === 'none') {
                detailsTable.style.display = 'table-row';
            } else {
                detailsTable.style.display = 'none';
            }
        }
        function ExcelLienHe() {
        var detailRows = document.querySelectorAll('.details-row');
        var detailTables = document.querySelectorAll('.detail-table');
        detailRows.forEach(function(row) {
            row.style.display = 'none';
        });

        detailTables.forEach(function(table) {
            table.style.display = 'none';
        });
        var table = document.getElementById('mainTable');
        var rows = table.querySelectorAll('tr');
        var data = [];

        rows.forEach(function(row) {
            if (row.style.display !== 'none') { 
                var cells = row.querySelectorAll('td, th');
                var rowData = [];
                cells.forEach(function(cell, cellIndex) {
                    if (cell.style.display !== 'none' && cellIndex < 7) { 
                        rowData.push(cell.innerText);
                    }
                });
                data.push(rowData);
            }
        });

        var worksheet = XLSX.utils.aoa_to_sheet(data);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách liên hệ");

        XLSX.writeFile(workbook, 'danh_sach_lien_he.xlsx');

        detailRows.forEach(function(row) {
            row.style.display = '';
        });

        detailTables.forEach(function(table) {
            table.style.display = '';
        });
        }

        function ExcelHanhKhach() {
            var detailRows = document.querySelectorAll('.ttlh');
            detailRows.forEach(function(row) {
                row.style.display = 'none';
            });

            var table = document.getElementById('mainTable');
            var rows = table.querySelectorAll('tr');
            var data = [
                ['ID', 'Tên Hành Khách', 'Giới Tính', 'Ngày Sinh', 'Điểm Đi', 'Điểm Đến', 'Giờ Bay', 'Giờ Đến', 'Ngày Đi', 'Trạng Thái']
            ];

            rows.forEach(function(row) {
                if (row.style.display !== 'none') { 
                    var cells = row.querySelectorAll('td, th');
                    var rowData = [];
                    cells.forEach(function(cell, cellIndex) {
                        if (cell.style.display !== 'none') { 
                            rowData.push(cell.innerText);
                        }
                    });
                    data.push(rowData);
                }
            });

            var worksheet = XLSX.utils.aoa_to_sheet(data);

            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách hành khách");

            XLSX.writeFile(workbook, 'danh_sach_hanh_khach.xlsx');

            detailRows.forEach(function(row) {
                row.style.display = '';
            });
        }
        function Xuat(){
            var Xuat = document.getElementById('xuat');
            if (Xuat.style.display === 'none') {
                Xuat.style.display = 'block';
            } else {
                Xuat.style.display = 'none';
            }
        }
    </script>
</body>
</html>
