<?php
namespace App\Controllers;

use Mpdf\Mpdf;

class PdfController extends BaseController
{
    public function generateQuotation()
    {
        // 출력 버퍼 정리
        ob_clean();

        // PDF 객체 생성 (임시 디렉토리 포함)
        $pdf = new Mpdf([
            'tempDir' => WRITEPATH . 'mpdf_tmp',
            'format' => 'A4'
        ]);

        // 전달할 데이터
        $data = [
            'quotation_date' => '2025년 03월 14일',
            'customer_name'  => '김평진',

            'hotel_count' => '0건',
            'hotel_price' => '0원',

            'golf_count'  => '12건',
            'golf_price'  => '303,175원',

            'tour_count'  => '1건',
            'tour_price'  => '39,000원',

            'car_count'   => '0건',
            'car_price'   => '0원',

            'guide_count' => '0건',
            'guide_price' => '0원',

            'total_count' => '2건',
            'total_price' => '342,175원'
        ];

        // View 로부터 HTML 가져오기
        $html = view('pdf/quotation', $data);

        // PDF 출력
        $pdf->WriteHTML($html);
        return $pdf->Output('quotation.pdf', 'I'); // 브라우저에 출력
    }
}
