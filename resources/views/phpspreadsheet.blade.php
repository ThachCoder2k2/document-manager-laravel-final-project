<?php
//require_once '../vendor/autoload.php';
//require_once '../vendor/phpoffice/phpspreadsheet/spreadsheet.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$conn = new PDO('mysql:host=localhost;dbname=pka_s', 'root', '');

$sql = 'SELECT
    sv.MSSV,
    sv.HoTen,
    mh.MaMH,
    mh.TenMH,
    dangky.Ky
FROM dangky
INNER JOIN sinhvien sv ON dangky.MSSV = sv.MSSV
INNER JOIN monhoc mh ON dangky.MaMH = mh.MaMH;';
$stmt = $conn->query($sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'MSSV');
$sheet->setCellValue('B1', 'Họ và tên');
$sheet->setCellValue('C1', 'Mã môn học');
$sheet->setCellValue('D1', 'Tên môn học');
$sheet->setCellValue('E1', 'Kỳ học');

$row = 2;
foreach ($stmt as $rowdata) {
    $sheet->setCellValue('A' . $row, $rowdata['MSSV']);
    $sheet->setCellValue('B' . $row, $rowdata['HoTen']);
    $sheet->setCellValue('C' . $row, $rowdata['MaMH']);
    $sheet->setCellValue('D' . $row, $rowdata['TenMH']);
    $sheet->setCellValue('E' . $row, $rowdata['Ky']);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('D:\danhsach-dangky.xlsx');

$conn = null;

?>