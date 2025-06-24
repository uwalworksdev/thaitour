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
    private $orderOptionModel;
    private $tourProducts;
	private $ordersCars;
    private $carsCategory;
    public function __construct() {
        $this->db           = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg      = model("RoomImg");
        $this->CodeModel    = model("Code");
        $this->orderOptionModel = model("OrderOptionModel");
        $this->tourProducts = model("ProductTourModel");
		$this->ordersCars = model("OrdersCarsModel");
        $this->carsCategory = model("CarsCategory");
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

        $builder = $db->table('tbl_policy_info');
		$policy = $builder->whereIn('p_idx', [24, 26])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

		$html = view('pdf/invoice_hotel', [
            'result' => $result,
            'policy_1' 	=> $policy[0],
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

        $product_idx = $row["product_idx"];

		$builder = $db->table('tbl_product_mst');
		$builder->select("notice_comment, not_included_product, guide_contents");
		$query  = $builder->where('product_idx', $product_idx)->get();
		$result = $query->getRowArray();
		$notice_contents = $result["notice_comment"];
        $not_included_product = $result["not_included_product"];
		$guide_contents = $result["guide_contents"];

		$builder = $db->table('tbl_policy_cancel');
		$builder->select("policy_contents");
		$query  = $builder->where('product_idx', $product_idx)->get();
		$result = $query->getRowArray();
		$cancle_contents = $result["policy_contents"];

		$html = view('pdf/invoice_golf', [
            'row'         => $row,
			'golf_info'   => $order_info,
			'golf_option' => $golf_option,
            'notice_contents' => $notice_contents,
            'not_included_product' => $not_included_product,
			'guide_contents' => $guide_contents,
			'cancle_contents' => $cancle_contents
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
					$order->adult_price_bath = round($order->people_adult_price / $this->setting['baht_thai']);
					$order->kids_price_bath = round($order->people_kids_price / $this->setting['baht_thai']);
					$order->baby_price_bath = round($order->people_baby_price / $this->setting['baht_thai']);
					$order->real_price_bath = round($order->real_price_won / $this->setting['baht_thai']);

					$totalOptionBath = 0;
					foreach ($optionResult as $option) {
						$totalOptionBath += $option->option_cnt * $option->option_price;
					}
					$order->total_options = $totalOptionBath;
					$order->total_bath = $order->real_price_bath + $totalOptionBath;

					$order->total_options_won = round($totalOptionBath * $this->setting['baht_thai']);
					$order->total_won = round($order->total_bath * $this->setting['baht_thai']);
					
				}

				$firstRow = $orderResult[0] ?? null;

				$product_idx = $firstRow->product_idx;

				$builder = $db->table('tbl_product_mst');
				$builder->select("notice_comment");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$notice_contents = $result["notice_comment"];
		
				$builder = $db->table('tbl_policy_cancel');
				$builder->select("policy_contents");
				$query  = $builder->where('product_idx', $product_idx)->get();
				$result = $query->getRowArray();
				$cancle_contents = $result["policy_contents"];

				$builder = $db->table('tbl_policy_info');
				$policy = $builder->whereIn('p_idx', [26])
									->orderBy('p_idx', 'asc')
									->get()->getResultArray();

		$html = view('pdf/invoice_tour', [
            'result' => $orderResult,
            'notice_contents' => $notice_contents,
            'cancle_contents' => $cancle_contents,
            'policy_1' 	=> $policy[0]
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
		$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, option_price");
		$query = $builder->where('order_idx', $order_idx)->get();
		$optionResult = $query->getResult(); // 옵션 데이터 (객체 배열)

		// 주문 객체에 옵션 정보 추가
		foreach ($orderResult as $order) {
			$order->options = $optionResult; // options 키에 옵션 배열 추가
			$order->adult_price_bath = round($order->people_adult_price / $this->setting['baht_thai']);
			$order->kids_price_bath = round($order->people_kids_price / $this->setting['baht_thai']);
			$order->baby_price_bath = round($order->people_baby_price / $this->setting['baht_thai']);
			$order->real_price_bath = round($order->real_price_won / $this->setting['baht_thai']);

			$totalOptionBath = 0;
			foreach ($optionResult as $option) {
				$totalOptionBath += $option->option_cnt * $option->option_price;
			}
			$order->total_options = $totalOptionBath;
			$order->total_bath = $order->real_price_bath + $totalOptionBath;

			$order->total_options_won = round($totalOptionBath * $this->setting['baht_thai']);
			$order->total_won = round($order->total_bath * $this->setting['baht_thai']);
			
		}

		$firstRow = $orderResult[0] ?? null;

		$product_idx = $firstRow->product_idx;

		$builder = $db->table('tbl_product_mst');
		$builder->select("notice_comment");
		$query  = $builder->where('product_idx', $product_idx)->get();
		$result = $query->getRowArray();
		$notice_contents = $result["notice_comment"];

		$builder = $db->table('tbl_policy_cancel');
		$builder->select("policy_contents");
		$query  = $builder->where('product_idx', $product_idx)->get();
		$result = $query->getRowArray();
		$cancle_contents = $result["policy_contents"];

		$builder = $db->table('tbl_policy_info');
		$policy = $builder->whereIn('p_idx', [26])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

		$html = view('pdf/invoice_ticket', [
            'result' => $orderResult,
            'notice_contents' => $notice_contents,
            'cancle_contents' => $cancle_contents,
			'policy_1' 	=> $policy[0],
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

        $firstRow = $orderResult[0] ?? null;

        $product_idx = $firstRow->product_idx;

        $builder = $db->table('tbl_product_mst');
        $builder->select("product_info");
        $query  = $builder->where('product_idx', $product_idx)->get();
        $result = $query->getRowArray();
        $notice_contents = $result["product_info"];

        $builder = $db->table('tbl_policy_cancel');
        $builder->select("policy_contents");
        $query  = $builder->where('product_idx', $product_idx)->get();
        $result = $query->getRowArray();
        $cancle_contents = $result["policy_contents"];

		$order_cars_detail = $this->ordersCars->getByOrder($order_idx);

		$departure_name = $this->carsCategory->getById($firstRow->departure_area)["code_name"];
		$destination_name = $this->carsCategory->getById($firstRow->destination_area)["code_name"];

		$html = view('pdf/invoice_car', [
            'result' => $orderResult,
            'notice_contents' => $notice_contents,
            'cancle_contents' => $cancle_contents,
			'order_cars_detail' => $order_cars_detail,
			'departure_name' => $departure_name,
			'destination_name' => $destination_name,
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

        $firstRow = $orderResult[0] ?? null;

        $product_idx = $firstRow->product_idx;

        $builder = $db->table('tbl_product_mst');
        $builder->select("product_info");
        $query  = $builder->where('product_idx', $product_idx)->get();
        $result = $query->getRowArray();
        $notice_contents = $result["product_info"];

        $builder = $db->table('tbl_policy_cancel');
        $builder->select("policy_contents");
        $query  = $builder->where('product_idx', $product_idx)->get();
        $result = $query->getRowArray();
        $cancle_contents = $result["policy_contents"];

		$html = view('pdf/invoice_guide', [
            'result' => $orderResult,
            'notice_contents' => $notice_contents,
            'cancle_contents' => $cancle_contents
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('invoice_guide.pdf', 'I');
        exit;
    }

    public function voucherHotel()
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
		$type = $this->request->getVar('type'); 

        $private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_name_new), '$private_key') AS order_user_name_new,
					AES_DECRYPT(UNHEX(a.order_user_name_en_new), '$private_key') AS order_user_name_en_new,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.order_user_mobile_new), '$private_key') AS order_user_mobile_new,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $order_idx);

		$query  = $builder->get();
		$result = $query->getRow();

        $builder = $db->table('tbl_policy_info');
		$policy = $builder->whereIn('p_idx', [23])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

        $arr_req = array_filter(explode("|", $result->additional_request ?? ''), fn($v) => trim($v) !== '');
		$arr_text_req = [];
		$arr_text_req_en = [];

		foreach($arr_req as $code){
			$row_code = $this->CodeModel->getByCodeNo($code);
			$code_name = $row_code["code_name"];
			$code_name_en = $row_code["code_name_en"];
			array_push($arr_text_req, $code_name);
			array_push($arr_text_req_en, $code_name_en);
		}

		$str_req = implode(", ", $arr_text_req);
		$str_req_en = implode(", ", $arr_text_req_en);

        $sql    = "SELECT * FROM tbl_room WHERE g_idx = '". $result->room_g_idx ."' ";
		$r_result = $db->query($sql);
		$row    = $r_result->getRowArray();

		$roomName_eng = $row["roomName_eng"];
		$roomName = $row["roomName"];

		$sql            = "SELECT * FROM tbl_room_beds WHERE bed_idx = '". $result->bed_idx ."' ";
		$roomsByType    = $db->query($sql);
		$roomsByType    = $roomsByType->getRowArray();

		$bed_type_en = $roomsByType["bed_type_eng"];

        if($type == "admin"){
			$user_name = $result->order_user_name;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_date = date('d-M-Y(D)', strtotime($result->start_date)) 
						. " " .date('d-M-Y(D)', strtotime($result->end_date))
						. " / ".$result->order_day_cnt." night";
			$room_type = $roomName_eng;
			$bed_type = $bed_type_en;
			$order_room_cnt = $result->order_room_cnt;
			$order_people = ($result->adult + $result->kids)  . "Adult(s)";
            $order_memo = $result->admin_memo;
			$breakfast = $result->breakfast == "N" ? "Include (No) Adult Breakfast" : "Include (Yes) Adult Breakfast";
			$guest_request = $str_req_en;
            $order_remark = $result->custom_req_eng;

		}else{
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_name;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = date('d-M-Y(D)', strtotime($result->start_date)) 
						. " " .date('d-M-Y(D)', strtotime($result->end_date))
						. " / ".$result->order_day_cnt." night";
			}

			if(!empty($result->room_type_new)){
				$room_type = $result->room_type_new;
			}else{
				$room_type = $roomName_eng;;
			}

			if(!empty($result->bed_type_new)){
				$bed_type = $result->bed_type_new;
			}else{
				$bed_type = $bed_type_en;
			}

			if(!empty($result->order_room_cnt_new)){
				$order_room_cnt = $result->order_room_cnt_new;
			}else{
				$order_room_cnt = $result->order_room_cnt;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->adult + $result->kids) . "Adult(s)";
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
                $order_memo = $result->admin_memo;
			}

			if(!empty($result->child_age_new)){
				$child_age = $result->child_age_new;
			}

			if(!empty($result->breakfast_new)){
				$breakfast = $result->breakfast_new;
			}else{
				$breakfast = $result->breakfast == "N" ? "Include (No) Adult Breakfast" : "Include (Yes) Adult Breakfast";
			}

			if(!empty($result->guest_request_new)){
				$guest_request = $result->guest_request_new;
			}else{
				$guest_request = $str_req_en;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}else{
                $order_remark = $result->custom_req_eng;
			}
		}

		$html = view('pdf/voucher_hotel', [ 
            'result'  => $result,
            'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'room_type' => $room_type,
            'bed_type' => $bed_type,
            'order_room_cnt' => $order_room_cnt,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'child_age' => $child_age,
			'breakfast' => $breakfast,
			'guest_request' => $guest_request,
			'order_remark' => $order_remark,
            'policy'  => $policy[0],
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('voucher_hotel.pdf', 'I');
        exit;
    }

    public function voucherGolf()
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
            ],
            'margin_bottom' => 10,
        ]);

        $order_idx = $this->request->getVar('order_idx');
        $type = $this->request->getVar('type'); 
        $private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_name_new), '$private_key') AS order_user_name_new,
					AES_DECRYPT(UNHEX(a.order_user_name_en_new), '$private_key') AS order_user_name_en_new,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.order_user_mobile_new), '$private_key') AS order_user_mobile_new,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $order_idx);

		$query  = $builder->get();
		$result = $query->getRow();

        $main_op = $this->orderOptionModel->getOption($result->order_idx, 'main')[0];

		$main    = explode("|", $main_op["option_name_eng"]);
		// var_dump($this->orderOptionModel->getOption($result->order_idx, 'main'));
		// die();
        $option  = $this->orderOptionModel->getOption($result->order_idx, 'option');
        $vehicle = $this->orderOptionModel->getOption($result->order_idx, 'vehicle');

		foreach ($vehicle as $key => $item): 
			if($item['option_name'] == "카트")   $cart  = $item['option_cnt'] ?? 0;
			if($item['option_name'] == "캐디피") $caddy = $item['option_cnt'] ?? 0;
		endforeach; 

		$fee = "Total :". $main_op["option_cnt"] . " / Cart: " . ($cart ?? 0) . " / Caddy: " . ($caddy ?? 0);

		$hole = trim(explode(":", $main[0])[1]);
		$date = trim(explode(":", $main[1])[1]);
		$day_time = trim(explode(":", $main[1])[0]);
		$parts = explode(":", $main[2]);
		$tee_time = "";
		if(!empty($parts[1]) && !empty($parts[2])){
			$minute = str_pad(trim($parts[1]), 2, "0", STR_PAD_LEFT);
			$second = str_pad(trim($parts[2]), 2, "0", STR_PAD_LEFT);
			$tee_time = $minute . " : " . $second;
		}
		if($type == "admin"){
			$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_date = $date;
			$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)";
			$order_memo = $result->order_memo;
			$order_tee_time = $tee_time;
			$order_hole = $hole . " " . $day_time;
			$order_fee = $fee;
			$order_memo = $result->admin_memo;
			$order_remark = $result->custom_req;

		}else{
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = $date;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0) . " Adult(s)";
			}

			if(!empty($result->t_times_en)){
				$order_tee_time = $result->t_times_en;
			}else{
				$order_tee_time = $tee_time;
			}

			if(!empty($result->hole_en)){
				$order_hole = $result->hole_en;
			}else{
				$order_hole = $hole . " " . $day_time;
			}

			if(!empty($result->fee_en)){
				$order_fee = $result->fee_en;
			}else{
				$order_fee = $fee;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->admin_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}else{
				$order_remark = $result->custom_req;
			}

		}

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [28])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

		$html = view('pdf/voucher_golf',[
            'policy_1' => $policy[0],
            'result'  => $result,
            'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_hole' => $order_hole,
			'order_tee_time' => $order_tee_time,
			'order_fee' => $order_fee,
			'option' => $option
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('voucher_golf.pdf', 'I');
        exit;
    }

    public function voucherTour()
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

        $private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $order_idx);

		// $query  = $builder->get();
		// $result = $query->getRow();


        $query  = $builder->get();
		$result = $query->getRow();

		$tour_prod_name = $this->tourProducts->find($result->tours_idx)["tours_subject_eng"];

		
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$day_map = [
					'월' => 'Mon',
					'화' => 'Tue',
					'수' => 'Wed',
					'목' => 'Thu',
					'금' => 'Fri',
					'토' => 'Sat',
					'일' => 'Sun',
				];

				$order_day = preg_replace_callback('/\((.*?)\)/', function ($matches) use ($day_map) {
						$korean_day = $matches[1];
						return isset($day_map[$korean_day]) ? '(' . $day_map[$korean_day] . ')' : '';
					}, $result->order_day);

				$order_date = $order_day;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s) / " . ($result->people_kids_cnt ?? 0) . " Child(s) / " . ($result->people_baby_cnt ?? 0) . " Baby(s)"; 
			}

			if(!empty($result->time_line_en)){
				$time_line = $result->time_line_en;
			}else{
				$time_line = $result->time_line;
			}

			if(!empty($result->tour_type_en)){
				$tour_type = $result->tour_type_en;
			}else{
				$tour_type = $tour_prod_name;
			}

			if(!empty($result->start_place_en)){
				$start_place = $result->start_place_en;
			}else{
				$start_place = $result->start_place;
			}

			if(!empty($result->id_kakao_en)){
				$id_kakao = $result->id_kakao_en;
			}else{
				$id_kakao = $result->id_kakao;
			}

			if(!empty($result->meeting_date)){
				$pick_time = date('Y-m-d H:i', strtotime($result->meeting_date));
			}else{
				$pick_time = $result->description;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}

			// if(!empty($result->order_option_new)){
			// 	$order_option = $result->order_option_new;
			// }
			$builder = $db->table('tbl_order_option');
			$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, option_price");
			$query = $builder->where('order_idx', $order_idx)->get();
			$optionResult = $query->getResult(); 

			$order_option = '';
			foreach($optionResult as $option){
				if($option->option_cnt > 0)
					$order_option .= $option->option_cnt . ' ' .$option->option_name . ' / ' ;
			}
			$order_option = rtrim($order_option, ' /');
		


		$builder = $db->table('tbl_policy_info');
		$policy = $builder->whereIn('p_idx', [25])
									->orderBy('p_idx', 'asc')
									->get()->getResultArray();

        

		$html = view('pdf/voucher_tour', [
            'result'  => $result,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_option' => $order_option,
			'start_place' => $start_place,
			'pick_time' => $pick_time,
			'id_kakao' => $id_kakao,
			'time_line' => $time_line,
			'tour_type' => $tour_type,
			'policy_1' 	=> $policy[0],
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('voucher_tour.pdf', 'I');
        exit;
    }

    public function voucherTicket()
    {
		$type = $this->request->getVar('type'); 

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

        $private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_name_new), '$private_key') AS order_user_name_new,
					AES_DECRYPT(UNHEX(a.order_user_name_en_new), '$private_key') AS order_user_name_en_new,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.order_user_mobile_new), '$private_key') AS order_user_mobile_new,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $order_idx);

		$query  = $builder->get();
		$result = $query->getRow();	

		$tour_prod_name = $this->tourProducts->find($result->tours_idx)["tours_subject"];


		$builder = $db->table('tbl_order_option');
				$builder->select("option_name, option_name_eng, option_tot, option_cnt, option_date, option_qty, option_price");
				$query = $builder->where('order_idx', $result->order_idx)->get();
				$optionResult = $query->getResult();

				$option = '';
				foreach($optionResult as $res){
					$option .= $res->option_name_eng . " x " . $res->option_cnt . " <br/>";
				}

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [46])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

		if($type == "admin"){
			$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)" . ($result->people_child_cnt ?? 0) . " Child(s)"; 
			$order_memo = $result->order_memo;
			$order_date = $result->order_day;
			$time_line = $result->time_line;
			$start_place = $result->start_place;
			$pick_time = $result->description;
			$id_kakao = $result->id_kakao;
			$tour_type = $tour_prod_name;
			$order_remark = $result->custom_req;

		}else{
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = $result->order_day;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s) / " . ($result->people_kids_cnt ?? 0) . " Child(s)"; 
			}

			if(!empty($result->time_line_en)){
				$time_line = $result->time_line_en;
			}else{
				$time_line = $result->time_line;
			}

			if(!empty($result->tour_type_en)){
				$tour_type = $result->tour_type_en;
			}else{
				$tour_type = $option;
			}


			if(!empty($result->start_place_en)){
				$start_place = $result->start_place_en;
			}else{
				$start_place = $result->start_place;
			}

			if(!empty($result->id_kakao_en)){
				$id_kakao = $result->id_kakao_en;
			}else{
				$id_kakao = $result->id_kakao;
			}

			if(!empty($result->pick_time_en)){
				$pick_time = $result->pick_time_en;
			}else{
				$pick_time = $result->description;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}else {
				$order_remark = $result->custom_req;
			}

			if(!empty($result->order_option_new)){
				$order_option = $result->order_option_new;
			}
		}

		// $builder = $db->table('tbl_order_option');
		// 		$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, option_price");
		// 		$query = $builder->where('order_idx', $result->order_idx)->get();
		// 		$optionResult = $query->getResult();

		// 		$option = '';
		// 		foreach($optionResult as $res){
		// 			$option .= $res->option_name . " x " . $res->option_cnt . "; ";
		// 		}

        // $builder1 = $db->table('tbl_policy_info');
		// $policy = $builder1->whereIn('p_idx', [46])
		// 					->orderBy('p_idx', 'asc')
		// 					->get()->getResultArray();

		$html = view('pdf/voucher_ticket', [
            'policy_1' => $policy[0],
            'result' => $result,
			'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_option' => $order_option,
			'start_place' => $start_place,
			'pick_time' => $pick_time,
			'id_kakao' => $id_kakao,
			'time_line' => $time_line,
			'tour_type' => $tour_type,
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('voucher_ticket.pdf', 'I');
        exit;
    }

	public function voucherCar()
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
        $type = $this->request->getVar('type'); 

        $private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*, a.departure_area as order_departure_area, a.destination_area as order_destination_area,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_name_new), '$private_key') AS order_user_name_new,
					AES_DECRYPT(UNHEX(a.order_user_name_en_new), '$private_key') AS order_user_name_en_new,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.order_user_mobile_new), '$private_key') AS order_user_mobile_new,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $order_idx);

		$query  = $builder->get();
		$result = $query->getRow();

		$departure_name = $this->carsCategory->getById($result->departure_area)["code_name_en"];
		$destination_name = $this->carsCategory->getById($result->destination_area)["code_name_en"];

		if($type == "admin"){
			$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)" . ($result->people_child_cnt ?? 0) . " Child(s)"; 
			$order_memo = $result->order_memo;
			$order_date = $result->order_day;
			$time_line = $result->time_line;
			$start_place = $result->start_place;
			$pick_time = $result->description;
			$id_kakao = $result->id_kakao;
			if(!empty($departure_name) && !empty($destination_name)){
				$tour_type = $departure_name . " / " . $destination_name;
			}
		}else{
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = $result->order_day;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)" . ($result->people_child_cnt ?? 0) . " Child(s)"; 
			}

			if(!empty($result->time_line_en)){
				$time_line = $result->time_line_en;
			}else{
				$time_line = $result->time_line;
			}

			if(!empty($result->tour_type_en)){
				$tour_type = $result->tour_type_en;
			}else{
				if(!empty($departure_name) && !empty($destination_name)){
					$tour_type = $departure_name . " / " . $destination_name;
				}
			}

			if(!empty($result->start_place_en)){
				$start_place = $result->start_place_en;
			}else{
				$start_place = $result->start_place;
			}

			if(!empty($result->id_kakao_en)){
				$id_kakao = $result->id_kakao_en;
			}else{
				$id_kakao = $result->id_kakao;
			}

			if(!empty($result->pick_time_en)){
				$pick_time = $result->pick_time_en;
			}else{
				$pick_time = $result->description;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}

			if(!empty($result->order_option_new)){
				$order_option = $result->order_option_new;
			}
		}

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [25])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

		$order_cars_detail = $this->ordersCars->getByOrder($order_idx);

		$html = view('pdf/voucher_car', [
            'result'  => $result,
			'policy_1' => $policy[0],
			'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_option' => $order_option,
			'start_place' => $start_place,
			'pick_time' => $pick_time,
			'id_kakao' => $id_kakao,
			'time_line' => $time_line,
			'tour_type' => $tour_type,
			'departure_name' => $departure_name,
			'destination_name' => $destination_name,
			'order_cars_detail' => $order_cars_detail,
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('voucher_car.pdf', 'I');
        exit;
    }

	public function voucherGuide()
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
        $type = $this->request->getVar('type'); 

        $private_key = private_key(); // 복호화 키

		$db = db_connect();
		$builder = $db->table('tbl_order_mst a');

		$builder->select("
					a.*, b.*, c.*,
					AES_DECRYPT(UNHEX(a.order_user_name), '$private_key') AS order_user_name,
					AES_DECRYPT(UNHEX(a.order_user_name_new), '$private_key') AS order_user_name_new,
					AES_DECRYPT(UNHEX(a.order_user_name_en_new), '$private_key') AS order_user_name_en_new,
					AES_DECRYPT(UNHEX(a.order_user_email), '$private_key') AS order_user_email,
					AES_DECRYPT(UNHEX(a.order_user_first_name_en), '$private_key') AS order_user_first_name_en,
					AES_DECRYPT(UNHEX(a.order_user_last_name_en), '$private_key') AS order_user_last_name_en,
					AES_DECRYPT(UNHEX(a.order_user_mobile), '$private_key') AS order_user_mobile,
					AES_DECRYPT(UNHEX(a.order_user_mobile_new), '$private_key') AS order_user_mobile_new,
					AES_DECRYPT(UNHEX(a.local_phone), '$private_key') AS local_phone,
					AES_DECRYPT(UNHEX(a.order_zip), '$private_key') AS order_zip,
					AES_DECRYPT(UNHEX(a.order_addr1), '$private_key') AS order_addr1,
					AES_DECRYPT(UNHEX(a.order_addr2), '$private_key') AS order_addr2,
					AES_DECRYPT(UNHEX(a.manager_name), '$private_key') AS manager_name
		");

		$builder->join('tbl_product_mst b', 'a.product_idx = b.product_idx', 'left');
		$builder->join('tbl_product_stay c', 'b.stay_idx = c.stay_idx', 'left');
		$builder->where('a.order_idx', $order_idx);

		$query  = $builder->get();
		$result = $query->getRow();

		$tour_prod_name = $this->tourProducts->find($result->tours_idx)["tours_subject"];

		if($type == "admin"){
			$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			$user_mobile = $result->order_user_mobile;
			$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)"; 
			$order_memo = $result->order_memo;
			$order_date = $result->order_day;
			$time_line = $result->time_line;
			$start_place = $result->start_place;
			$pick_time = $result->description;
			$id_kakao = $result->id_kakao;
			$tour_type = $tour_prod_name;
		}else{
			if(!empty($result->order_user_name_new)){
				$user_name = $result->order_user_name_new;
			}else{
				$user_name = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_name_en_new)){
				$user_name_en = $result->order_user_name_en_new;
			}else{
				$user_name_en = $result->order_user_first_name_en . " " . $result->order_user_last_name_en;
			}

			if(!empty($result->order_user_mobile_new)){
				$user_mobile = $result->order_user_mobile_new;
			}else{
				$user_mobile = $result->order_user_mobile;
			}

			if(!empty($result->order_date_new)){
				$order_date = $result->order_date_new;
			}else{
				$order_date = $result->order_day;
			}

			if(!empty($result->order_people_new)){
				$order_people = $result->order_people_new;
			}else{
				$order_people = ($result->people_adult_cnt ?? 0)  . " Adult(s)"; 
			}

			if(!empty($result->time_line_en)){
				$time_line = $result->time_line_en;
			}else{
				$time_line = $result->time_line;
			}

			if(!empty($result->tour_type_en)){
				$tour_type = $result->tour_type_en;
			}else{
				$tour_type = $tour_prod_name;
			}

			if(!empty($result->start_place_en)){
				$start_place = $result->start_place_en;
			}else{
				$start_place = $result->start_place;
			}

			if(!empty($result->id_kakao_en)){
				$id_kakao = $result->id_kakao_en;
			}else{
				$id_kakao = $result->id_kakao;
			}

			if(!empty($result->pick_time_en)){
				$pick_time = $result->pick_time_en;
			}else{
				$pick_time = $result->description;
			}

			if(!empty($result->order_memo_new)){
				$order_memo = $result->order_memo_new;
			}else{
				$order_memo = $result->order_memo;
			}

			if(!empty($result->order_remark_new)){
				$order_remark = $result->order_remark_new;
			}

			if(!empty($result->order_option_new)){
				$order_option = $result->order_option_new;
			}
		}

        $builder1 = $db->table('tbl_policy_info');
		$policy = $builder1->whereIn('p_idx', [25])
							->orderBy('p_idx', 'asc')
							->get()->getResultArray();

		$html = view('pdf/voucher_guide', [
            'result'  => $result,
			'policy_1' => $policy[0],
			'type' => $type,
            'user_name' => $user_name,
            'user_mobile' => $user_mobile,
            'order_date' => $order_date,
            'order_people' => $order_people,
            'order_memo' => $order_memo,
			'user_name_en' => $user_name_en,
			'order_remark' => $order_remark,
			'order_option' => $order_option,
			'start_place' => $start_place,
			'pick_time' => $pick_time,
			'id_kakao' => $id_kakao,
			'time_line' => $time_line,
			'tour_type' => $tour_type
        ]);
        
        $pdf->WriteHTML($html);
		
        $pdf->Output('voucher_guide.pdf', 'I');
        exit;
    }
}


