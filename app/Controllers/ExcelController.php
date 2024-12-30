<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\Controller;

class ExcelController extends Controller
{
    public function downloadExcel()
    {
        // 1. 데이터 준비
        $data = [
            ['ID', 'Name', 'Email', 'Phone'],
            [1, 'John Doe', 'john@example.com', '123-456-7890'],
            [2, 'Jane Smith', 'jane@example.com', '098-765-4321']
        ];

        // 2. 스프레드시트 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 3. 데이터 삽입
        $row = 1;
        foreach ($data as $columns) {
            $col = 'A';
            foreach ($columns as $cell) {
                $sheet->setCellValue($col . $row, $cell);
                $col++;
            }
            $row++;
        }

        // 4. 파일 다운로드 설정
        $filename = 'sample.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
