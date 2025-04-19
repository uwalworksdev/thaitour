<?php

namespace App\Controllers;

use Mpdf\Mpdf;

class PdfController extends BaseController
{
    public function generateQuotation()
    {
        // 샘플 데이터 (테스트용)
        $sum = [
            ['code_name' => '호텔', 'cnt' => 1, 'total_won' => 50000],
            ['code_name' => '골프', 'cnt' => 2, 'total_won' => 150000],
        ];

        $items = [
            [
                'code_name' => '호텔',
                'order_date' => '2025-04-19',
                'product_name' => '그랜드호텔',
                'order_gubun' => 'hotel',
                'order_no' => '1234',
                'order_idx' => '1',
                'real_price_won' => 50000,
                'real_price_bath' => 1300
            ],
            [
                'code_name' => '골프',
                'order_date' => '2025-04-20',
                'product_name' => '그린밸리 CC',
                'order_gubun' => 'golf',
                'order_no' => '5678',
                'order_idx' => '2',
                'real_price_won' => 150000,
                'real_price_bath' => 3900
            ],
        ];

        // 사용자 이름 세션 예시
        session()->set(['member' => ['name' => '김평진']]);

        $html = view('pdf/quotation_view', compact('sum', 'items'));

        // mPDF 설정
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => [FCPATH . 'ttfonts'],
            'default_font' => 'nanumgothic',
            'fontdata' => [
                'nanumgothic' => [
                    'R' => 'NanumGothic.ttf',
                    'B' => 'NanumGothicBold.ttf',
                ]
            ]
        ]);

        // CSS 불러오기 (절대 경로 사용)
        $stylesheet = file_get_contents(FCPATH . 'css/mypage/mypage_new.css');
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

        // HTML 내용 출력
        $mpdf->WriteHTML($html);

        // 출력
        return $mpdf->Output('견적서.pdf', 'I');
    }
}



