<?php

namespace App\Controllers;

use Mpdf\Mpdf;

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
}


