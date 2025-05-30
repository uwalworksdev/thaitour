<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use PHPExcel_Cell_DataType;

require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

class ExcelController extends Controller
{
    private $db;

    public function downloadExcel()
    {
		
	    $db = \Config\Database::connect(); // 데이터베이스 연결
		
        $objPHPExcel = new \PHPExcel();
        $sheet       = $objPHPExcel->getActiveSheet();

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

        $result = $db->query($total_sql)->getResultArray();
		
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
        $filename  = date('Y-m-d')." 주문관리" . '.xlsx';

        $response  = $this->response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'max-age=0');
        $objWriter->save('php://output');

        return $response;
    }

    public function get_excel()
    {
        $private_key = private_key();
	    $db = \Config\Database::connect(); // 데이터베이스 연결
        $strSql = " AND a.order_status NOT IN ('B', 'D') ";
        $_deli_type = get_deli_type();

        $sql = "SELECT a.product_name AS product_name_new  
                    , AES_DECRYPT(UNHEX(a.order_user_name),   '$private_key') AS user_name
                    , AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS user_mobile
                    , AES_DECRYPT(UNHEX(a.order_user_email),  '$private_key') AS user_email
                    , a.*
                    , d.user_id  
				    , e.payment_method   AS payment_method
                FROM tbl_order_mst a 
                LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                LEFT JOIN tbl_member d      ON a.m_idx = d.m_idx
                LEFT JOIN tbl_payment_mst e ON a.payment_no = e.payment_no
                WHERE a.is_modify='N' AND a.order_status = 'Z' $strSql 
                GROUP BY a.order_idx 
                ORDER BY group_no DESC, order_r_date DESC, order_idx DESC";

        $result = $db->query($sql)->getResultArray();

        $excel = new \PHPExcel();
        $sheet = $excel->getActiveSheet();
        $sheet->setTitle('예약 리스트');

        $headers = ['번호', '그룹번호', '예약번호', '상태', '상품구분', '상품명', '예약일시', '예약자/아이디', '연락처/이메일', '상품금액(원)', '상품금액(바트)', '결제방법'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $rowIndex = 2;
        $index = 1;

        foreach ($result as $row) {
            $sheet->setCellValueExplicit("A{$rowIndex}", $index++, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("B{$rowIndex}", $row['group_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("C{$rowIndex}", $row['order_no'], PHPExcel_Cell_DataType::TYPE_STRING);

            $sheet->setCellValue("D{$rowIndex}", isset($_deli_type[$row['order_status']]) ? $_deli_type[$row['order_status']] : '');
            $sheet->setCellValue("E{$rowIndex}", isset($row['code_name']) ? $row['code_name'] : '');
            $sheet->setCellValue("F{$rowIndex}", isset($row['product_name']) ? $row['product_name'] : '');
            $sheet->setCellValue("G{$rowIndex}", isset($row['order_r_date']) ? $row['order_r_date'] : '');

            $name = isset($row['user_name']) ? trim($row['user_name']) : '';
            $id   = isset($row['user_id']) ? trim($row['user_id']) : '';

            $reservation = '';
            if ($name !== '' && $id !== '') {
                $reservation = $name . ' / ' . $id;
            } elseif ($name !== '') {
                $reservation = $name;
            } elseif ($id !== '') {
                $reservation = $id;
            }
            $sheet->setCellValue("H{$rowIndex}", $reservation);

            $mobile = isset($row['user_mobile']) ? trim($row['user_mobile']) : '';
            $email  = isset($row['user_email']) ? trim($row['user_email']) : '';

            $contact = '';
            if ($mobile !== '' && $email !== '') {
                $contact = $mobile . ' / ' . $email;
            } elseif ($mobile !== '') {
                $contact = $mobile;
            } elseif ($email !== '') {
                $contact = $email;
            }
            $sheet->setCellValue("I{$rowIndex}", $contact);

            $price_won = isset($row['real_price_won']) ? $row['real_price_won'] : 0;
            $sheet->setCellValue("J{$rowIndex}", number_format($price_won));

            $price_bath = isset($row['real_price_bath']) ? $row['real_price_bath'] : 0;
            $sheet->setCellValue("K{$rowIndex}", number_format($price_bath));

            $sheet->setCellValue("L{$rowIndex}", $row['order_method']);

            $rowIndex++;
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $filename  = date('Y-m-d') . " 정산관리" . '.xls';

        $response  = $this->response->setHeader('Content-Type', 'application/vnd.ms-excel')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'max-age=0');
        $objWriter->save('php://output');

        return $response;

    }

        public function get_excel_main()
    {
        $private_key = private_key();
	    $db = \Config\Database::connect(); // 데이터베이스 연결
        $strSql = "";
        $strSql = " AND a.order_status NOT IN ('B', 'D') ";
        $_deli_type = get_deli_type();

        $sql = "SELECT a.product_name AS product_name_new  
		                     , AES_DECRYPT(UNHEX(a.order_user_name),   '$private_key') AS user_name
						     , AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS user_mobile
						     , AES_DECRYPT(UNHEX(a.order_user_email),  '$private_key') AS user_email
						     , AES_DECRYPT(UNHEX(a.manager_name),      '$private_key') AS man_name
						     , AES_DECRYPT(UNHEX(a.manager_phone),     '$private_key') AS man_phone
						     , AES_DECRYPT(UNHEX(a.manager_email),     '$private_key') AS man_email 
                             , a.*
		                     , d.user_id  
                             , COUNT(c.order_idx) AS cnt_number_person
						FROM tbl_order_mst a 
						LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
                        LEFT JOIN tbl_order_list  c ON c.order_idx   = a.order_idx
						LEFT JOIN tbl_member d      ON a.m_idx       = d.m_idx
						WHERE a.is_modify='N' AND order_status != '' $strSql GROUP BY a.order_idx order by a.group_no desc, a.order_r_date desc, a.order_idx desc ";

        $result = $db->query($sql)->getResultArray();

        $excel = new \PHPExcel();
        $sheet = $excel->getActiveSheet();
        $sheet->setTitle('예약 리스트');

        $headers = ['번호', '그룹번호', '예약번호', '상태', '상품구분', '상품명', '예약일시', '예약자/아이디', '연락처/이메일', '상품금액(원)', '상품금액(바트)', '결제방법'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        $rowIndex = 2;
        $index = 1;

        foreach ($result as $row) {
            $sheet->setCellValueExplicit("A{$rowIndex}", $index++, PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("B{$rowIndex}", $row['group_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("C{$rowIndex}", $row['order_no'], PHPExcel_Cell_DataType::TYPE_STRING);

            $sheet->setCellValue("D{$rowIndex}", isset($_deli_type[$row['order_status']]) ? $_deli_type[$row['order_status']] : '');
            $sheet->setCellValue("E{$rowIndex}", isset($row['code_name']) ? $row['code_name'] : '');
            $sheet->setCellValue("F{$rowIndex}", isset($row['product_name']) ? $row['product_name'] : '');
            $sheet->setCellValue("G{$rowIndex}", isset($row['order_r_date']) ? $row['order_r_date'] : '');

            $name = isset($row['user_name']) ? trim($row['user_name']) : '';
            $id   = isset($row['user_id']) ? trim($row['user_id']) : '';

            $reservation = '';
            if ($name !== '' && $id !== '') {
                $reservation = $name . ' / ' . $id;
            } elseif ($name !== '') {
                $reservation = $name;
            } elseif ($id !== '') {
                $reservation = $id;
            }
            $sheet->setCellValue("H{$rowIndex}", $reservation);

            $mobile = isset($row['user_mobile']) ? trim($row['user_mobile']) : '';
            $email  = isset($row['user_email']) ? trim($row['user_email']) : '';

            $contact = '';
            if ($mobile !== '' && $email !== '') {
                $contact = $mobile . ' / ' . $email;
            } elseif ($mobile !== '') {
                $contact = $mobile;
            } elseif ($email !== '') {
                $contact = $email;
            }
            $sheet->setCellValue("I{$rowIndex}", $contact);

            $price_won = isset($row['real_price_won']) ? $row['real_price_won'] : 0;
            $sheet->setCellValue("J{$rowIndex}", number_format($price_won));

            $price_bath = isset($row['real_price_bath']) ? $row['real_price_bath'] : 0;
            $sheet->setCellValue("K{$rowIndex}", number_format($price_bath));

            $sheet->setCellValue("L{$rowIndex}", '카드결제');

            $rowIndex++;
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $filename  = date('Y-m-d') . " 예약내역" . '.xls';

        $response  = $this->response->setHeader('Content-Type', 'application/vnd.ms-excel')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'max-age=0');
        $objWriter->save('php://output');

        return $response;

    }
}
