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
                    grid-template-columns: 4fr 4fr 2fr 2fr 2fr;
                    margin-bottom: 15px;
                    padding: 10px;
                    gap: 15px;">
            
            <input type="text" style="padding: 4px 10px; border-radius: 5px;" name="txtDDi" value="<?php if(isset($data['ddi'])){echo $data['ddi'];} ?>" placeholder="Tìm kiếm theo điểm đi...">
            <input type="text" style="padding: 4px 10px; border-radius: 5px;" name="txtDDen" value="<?php if(isset($data['dde'])){echo $data['dde'];} ?>" placeholder="Tìm kiếm theo điểm đến...">
            <button type="submit" class="btn btn-primary" name="btnTimkiem">Tìm kiếm</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='http://localhost/hoanghuy/QuanLy/Danhsachgiave/them'">Thêm</button>
            <button type="button" class="btn btn-primary" onclick="Excel()">Xuất Excel</button>
        </div>
        
        <table id="mainTable" style="width: 1140px;" class="table table-striped table-bordered">
            <thead class="thead-dark" style="font-size: 18px;">
                <tr class="ttlh">
                    <th>ID</th>
                    <th>Điểm Đi</th>
                    <th>Điểm Đến</th>
                    <th>Hãng Bay</th>
                    <th>Hạng</th>
                    <th>Giờ Hoạt Động</th>
                    <th>Giá</th>
                    <th class='detail-table'>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0){
                        while($row = mysqli_fetch_assoc($data['dulieu'])){
                        echo "<tr class='ttlh'>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['DiemDi'] . "</td>";
                        echo "<td>" . $row['DiemDen'] . "</td>";
                        echo "<td>" . $row['HangBay'] . "</td>";
                        echo "<td>" . $row['Hang'] . "</td>";
                        echo "<td>" . $row['GioDi'] . "</td>";
                        echo "<td>" . $row['Gia'] . "</td>";
                        echo "<td class='detail-table'>";
                        echo "<a class='btn btn-outline-primary' 
                                href='http://localhost/hoanghuy/QuanLy/Danhsachgiave/sua/" . $row['ID'] . "'>Sửa</a> ";
                        echo "<a class='btn btn-outline-danger' 
                                href='http://localhost/hoanghuy/QuanLy/Danhsachgiave/xoa/" . $row['ID'] . "'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
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
        function Excel() {
        // Lấy bảng dữ liệu từ HTML
        var table = document.getElementById('mainTable');
        var rows = table.querySelectorAll('tr');
        var data = [];

        // Duyệt qua các hàng của bảng
        rows.forEach(function(row) {
                var cells = row.querySelectorAll('td, th');
                var rowData = [];
                cells.forEach(function(cell, cellIndex) {
                    if (cellIndex < 7) { // Chỉ lấy các ô hiển thị và đến cột thứ 7
                        rowData.push(cell.innerText);
                    }
                });
                data.push(rowData);
        });

        // Tạo worksheet và workbook từ dữ liệu
        var worksheet = XLSX.utils.aoa_to_sheet(data);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách giá vé");

        // Lưu workbook thành file Excel
        XLSX.writeFile(workbook, 'danh_sach_gia_ve.xlsx');
        }
    </script>
</body>
</html>
