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
                    grid-template-columns: 8fr 2fr 2fr 2fr;
                    margin-bottom: 15px;
                    padding: 10px;
                    gap: 15px;">
            
            <input type="text" style="padding: 4px 10px; border-radius: 5px;" name="txtDDi" value="<?php if(isset($data['ddi'])){echo $data['ddi'];} ?>" placeholder="Tìm kiếm theo tên người dùng...">
            <button type="submit" class="btn btn-primary" name="btnTimkiem">Tìm kiếm</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='http://localhost/hoanghuy/QuanLy/Danhsachuser/them'">Thêm</button>
            <button type="button" class="btn btn-primary" onclick="Excel()">Xuất Excel</button>
        </div>
        <table id="mainTable" style="width: 1140px;" class="table table-striped table-bordered">
            <thead class="thead-dark" style="font-size: 18px;">
                <tr class="ttlh">
                    <th>ID</th>
                    <th>Tên Người Dùng</th>
                    <th>Mật Khẩu</th>
                    <th>Quyền</th>
                    <th>Tài Khoản</th>
                    <th>Giới Tính</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th class='detail-table'>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($data['dulieu']) && mysqli_num_rows($data['dulieu']) > 0){
                        while($row = mysqli_fetch_assoc($data['dulieu'])){
                        echo "<tr class='ttlh'>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['display_Account'] . "</td>";
                        echo "<td>" . $row['password_Account'] . "</td>";
                        echo "<td>" . $row['type_Account'] . "</td>";
                        echo "<td>" . $row['username_Account'] . "</td>";
                        echo "<td>" . $row['gender_Account'] . "</td>";
                        echo "<td>" . $row['phone_Account'] . "</td>";
                        echo "<td>" . $row['gmail_Account'] . "</td>";
                        echo "<td class='detail-table'>";
                        echo "<a class='btn btn-outline-primary' 
                                href='http://localhost/hoanghuy/QuanLy/Danhsachuser/sua/" . $row['id'] . "'>Sửa</a> ";
                        echo "<a class='btn btn-outline-danger' 
                                href='http://localhost/hoanghuy/QuanLy/Danhsachuser/xoa/" . $row['id'] . "'>Xóa</a>";
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
        var table = document.getElementById('mainTable');
        var rows = table.querySelectorAll('tr');
        var data = [];

        // Duyệt qua các hàng của bảng
        rows.forEach(function(row) {
                var cells = row.querySelectorAll('td, th');
                var rowData = [];
                cells.forEach(function(cell, cellIndex) {
                    if (cellIndex < 8) { // Chỉ lấy các ô hiển thị và đến cột thứ 7
                        rowData.push(cell.innerText);
                    }
                });
                data.push(rowData);
        });

        var worksheet = XLSX.utils.aoa_to_sheet(data);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách tài khoản");

        // Lưu workbook thành file Excel
        XLSX.writeFile(workbook, 'danh_sach_tai_khoan.xlsx');
        }
    </script>
</body>
</html>
