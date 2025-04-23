<?php
require_once 'MVC/Core/connectDB1.php';
require_once 'vendor/autoload.php'; // Đường dẫn tới autoload.php của PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo một Spreadsheet mới
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Danh sách liên hệ');

// Thêm tiêu đề cho các cột
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Tên Liên Hệ');
$sheet->setCellValue('C1', 'Giới Tính');
$sheet->setCellValue('D1', 'Số Điện Thoại');
$sheet->setCellValue('E1', 'Kênh Liên Hệ');
$sheet->setCellValue('F1', 'Email');
$sheet->setCellValue('G1', 'Tài Khoản');

// Kết nối CSDL
$db = new connectDB1();
$conn = $db->getConnection();

$sql = "SELECT * FROM thongtinlienhe";
$result = $conn->query($sql);

$rowCount = 2; // Bắt đầu từ hàng thứ 2
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowCount, isset($row['ID']) ? $row['ID'] : '');
    $sheet->setCellValue('B' . $rowCount, isset($row['TenLienHe']) ? $row['TenLienHe'] : '');
    $sheet->setCellValue('C' . $rowCount, isset($row['GioiTinh']) ? $row['GioiTinh'] : '');
    $sheet->setCellValue('D' . $rowCount, isset($row['SoDienThoai']) ? $row['SoDienThoai'] : '');
    $sheet->setCellValue('E' . $rowCount, isset($row['KenhLienHe']) ? $row['KenhLienHe'] : '');
    $sheet->setCellValue('F' . $rowCount, isset($row['Email']) ? $row['Email'] : '');
    $sheet->setCellValue('G' . $rowCount, isset($row['TaiKhoan']) ? $row['TaiKhoan'] : '');
    $rowCount++;
}

// Lưu file Excel vào thư mục cụ thể trên server
$excelFilePath = 'path/to/save/directory/danh_sach_lien_he.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($excelFilePath);

// Đóng kết nối CSDL
$conn->close();

// Trả về kết quả file Excel cho phía client
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="danh_sach_lien_he.xlsx"');
header('Cache-Control: max-age=0');
readfile($excelFilePath);
exit;
?>
