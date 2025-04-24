<?php

namespace App\Controllers;

use Mpdf\Mpdf;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends BaseController
{
    private $db;
    private $productModel;
    private $roomImg;
    private $CodeModel;


    public function __construct() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
    }
	
    public function generateQuotation()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$group_no = $this->request->getVar('group_no');

		$db = \Config\Database::connect();

		// 요약 정보 (상품 코드별 집계)
		$sql = "SELECT code_name, 
					   COUNT(order_idx) AS cnt,
					   SUM(real_price_bath) AS total_bath,
					   SUM(real_price_won) AS total_won
				FROM tbl_order_mst
				WHERE group_no = ?
				GROUP BY code_name";

		$sum = $db->query($sql, [$group_no])->getResultArray();

		// ① 그룹 해당 예약 목록
		$items = $db->query("SELECT * FROM tbl_order_mst WHERE group_no = ?", [$group_no])->getResultArray();

		$data = [
			'group_no' => $group_no,
			'sum'      => $sum,
			'items'    => $items
		];

		$html = view('pdf/quotation', $data);

        $pdf->WriteHTML($html);
		
        $pdf->Output('quotation.pdf', 'I');
        exit;
    }

    public function invoiceHotel()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$order_idx = $this->request->getVar('order_idx');

        $private_key = private_key();
		
		$db      = db_connect(); // DB 연결
		$builder = $db->table('tbl_order_mst'); // 테이블 지정
		$builder->select(" *,
			AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
			AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
			AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
			AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
			AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
			AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
			AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
			AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
			AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
			AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
		");		
		$query   = $builder->where('order_idx', $order_idx)->get(); // 조건 추가 후 실행

		$result  = $query->getResult(); // 결과 가져오기 (객체 배열)

		$html = view('pdf/invoice_hotel', [
            'result' => $result,
        ]);

        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_hotel.pdf', 'I');
        exit;
    }

    public function invoiceGolf()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$order_idx = $this->request->getVar('order_idx');

        $private_key = private_key();
		$db = db_connect(); // DB 연결

		$builder = $db->table('tbl_order_mst');
		$builder->select(" *,
			AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
			AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
			AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
			AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
			AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
			AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
			AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
			AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
			AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
			AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
		");

		$query  = $builder->where('order_idx', $order_idx)->get();
		$result = $query->getResultArray();
		$row    = $result[0];

        $query1     = $db->query("SELECT * FROM tbl_order_option WHERE order_idx = '". $order_idx ."' AND option_type = 'main' ");
		$order_info = $query1->getRowArray();

		// 기타 옵션
		$query2      = $db->query("SELECT * FROM tbl_order_option WHERE order_idx = '". $order_idx ."' AND option_type != 'main' ");
		$golf_option = $query2->getResultArray();

		$html = view('pdf/invoice_golf', [
            'row'         => $row,
			'golf_info'   => $order_info,
			'golf_option' => $golf_option
        ]);

        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_golf.pdf', 'I');
        exit;
    }

    public function invoiceTour()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$order_idx = $this->request->getVar('order_idx');

        $private_key = private_key();

        $db = db_connect(); // DB 연결

        // 주문 정보 가져오기
        $builder = $db->table('tbl_order_mst');
        $builder->select("
            *,
            AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
            AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
            AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
            AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
            AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
            AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
            AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
            AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
            AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
            AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
        ");
        $query = $builder->where('order_idx', $order_idx)->get();
        $orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

        // 옵션 정보 가져오기
        $builder = $db->table('tbl_order_option');
        $builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
        $query = $builder->where('order_idx', $order_idx)->get();
        $optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

        // 주문 객체에 옵션 정보 추가
        foreach ($orderResult as $order) {
            $order->options = $optionResult; // options 키에 옵션 배열 추가
        }

		$html = view('pdf/invoice_tour', [
            'result' => $orderResult
        ]);
        

        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_tour.pdf', 'I');
        exit;
    }

    public function invoiceTicket()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$order_idx = $this->request->getVar('order_idx');

        $private_key = private_key();

        $db = db_connect(); // DB 연결

        // 주문 정보 가져오기
        $builder = $db->table('tbl_order_mst');
        $builder->select("
            *,
            AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
            AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
            AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
            AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
            AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
            AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
            AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
            AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
            AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
            AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
        ");
        $query = $builder->where('order_idx', $order_idx)->get();
        //write_log("last query- " . $db->getLastQuery());
        $orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

        // 옵션 정보 가져오기
        $builder = $db->table('tbl_order_option');
        $builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
        $query = $builder->where('order_idx', $order_idx)->get();
        $optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

        // 주문 객체에 옵션 정보 추가
        foreach ($orderResult as $order) {
            $order->options = $optionResult; // options 키에 옵션 배열 추가
        }

		$html = view('pdf/invoice_ticket', [
            'result' => $orderResult
        ]);
        

        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_ticket.pdf', 'I');
        exit;
    }

    public function invoiceCar()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$order_idx = $this->request->getVar('order_idx');

        $private_key = private_key();

        $db = db_connect(); // DB 연결

        // 주문 정보 가져오기
        $builder = $db->table('tbl_order_mst');
        $builder->select("
            *,
            AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
            AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
            AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
            AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
            AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
            AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
            AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
            AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
            AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
            AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
        ");
        $query = $builder->where('order_idx', $order_idx)->get();
        $orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

        // 옵션 정보 가져오기
        $builder = $db->table('tbl_order_option');
        $builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
        $query = $builder->where('order_idx', $order_idx)->get();
        $optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

        // 주문 객체에 옵션 정보 추가
        foreach ($orderResult as $order) {
            $order->options = $optionResult; // options 키에 옵션 배열 추가
        }

		$html = view('pdf/invoice_car', [
            'result' => $orderResult
        ]);
        

        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_car.pdf', 'I');
        exit;
    }

    public function invoiceGuide()
    {
        $pdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'], // 폰트 폴더 추가
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

		$order_idx = $this->request->getVar('order_idx');

        $private_key = private_key();

        $db = db_connect(); // DB 연결

        // 주문 정보 가져오기
        $builder = $db->table('tbl_order_mst');
        $builder->select("
            *,
            AES_DECRYPT(UNHEX(order_user_name), '$private_key') AS order_user_name,
            AES_DECRYPT(UNHEX(order_user_email), '$private_key') AS order_user_email,
            AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS order_user_first_name_en,
            AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS order_user_last_name_en,
            AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS order_user_mobile,
            AES_DECRYPT(UNHEX(local_phone), '$private_key') AS local_phone,
            AES_DECRYPT(UNHEX(order_zip), '$private_key') AS order_zip,
            AES_DECRYPT(UNHEX(order_addr1), '$private_key') AS order_addr1,
            AES_DECRYPT(UNHEX(order_addr2), '$private_key') AS order_addr2,
            AES_DECRYPT(UNHEX(manager_name), '$private_key') AS manager_name
        ");
        $query = $builder->where('order_idx', $order_idx)->get();
        //write_log("last query- " . $db->getLastQuery());
        $orderResult = $query->getResult(); // 주문 데이터 (객체 배열)

        // 옵션 정보 가져오기
        $builder = $db->table('tbl_order_option');
        $builder->select("option_name, option_tot, option_cnt, option_date, option_qty, baht_thai");
        $query = $builder->where('order_idx', $order_idx)->get();
        $optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

        // 주문 객체에 옵션 정보 추가
        foreach ($orderResult as $order) {
            $order->options = $optionResult; // options 키에 옵션 배열 추가
        }

		$html = view('pdf/invoice_guide', [
            'result' => $orderResult
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_guide.pdf', 'I');
        exit;
    }
}


