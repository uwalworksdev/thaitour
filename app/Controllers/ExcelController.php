<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

class ExcelController extends Controller
{
    public function downloadExcel()
    {
        $objPHPExcel = new \PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();

        $sheet->setCellValue('A1', '주문번호');
        $sheet->setCellValue('B1', '주문자명');
        $sheet->setCellValue('C1', '주문자 아이디');
        $sheet->setCellValue('D1', '이용기간(월)');
        $sheet->setCellValue('E1', '구매금액(원)');
        $sheet->setCellValue('F1', '주문일자');
        $sheet->setCellValue('G1', '입금내역');
        $sheet->setCellValue('H1', '결제일자');
        $sheet->setCellValue('I1', '취소일자');
        $sheet->setCellValue('J1', '적용시작');
        $sheet->setCellValue('K1', '적용종료');
        $sheet->setCellValue('L1', '상태');

        $total_sql = "
				select  *
				from tbl_payment_mst order by payment_date asc ";

        $result = $this->db->query($sql)->getResultArray();
		
        $rowNum = 2;
        foreach ($result as $row) {
                $sheet->setCellValue('A' . $rowNum, $row['order_code']);
                $sheet->setCellValue('B' . $rowNum, sqlSecretConver($row['user_name'], 'decode'));
                $sheet->setCellValue('C' . $rowNum, $row['user_id']);
                $sheet->setCellValue('D' . $rowNum, $row['tickcet_month']);
                $sheet->setCellValue('E' . $rowNum, number_format($row['total_price']));
                $sheet->setCellValue('F' . $rowNum, $row['reg_date']);
                $sheet->setCellValue('G' . $rowNum, getPgMethod($row['payMethod']));
                $sheet->setCellValue('H' . $rowNum, $row['pay_date']);
                $sheet->setCellValue('I' . $rowNum, $row['cancel_date']);
                $sheet->setCellValue('J' . $rowNum, $row['from_date']);
                $sheet->setCellValue('K' . $rowNum, $row['to_date']);
                $sheet->setCellValue('L' . $rowNum, $row['status']);
                $rowNum++;
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = date('Y-m-d')." 주문관리" . '.xlsx';

        $response = $this->response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'max-age=0');
        $objWriter->save('php://output');

        return $response;
    }
}
