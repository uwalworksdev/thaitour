<?php

namespace App\Controllers;

use Mpdf\Mpdf;

class PdfController extends BaseController
{
    public function generateQuotation()
    {
        // mPDF 설정
        $config = [
            'mode' => 'utf-8', // UTF-8 모드 사용
            'format' => 'A4',
            'default_font' => 'NanumGothic', // 기본 폰트 설정
        ];

        $mpdf = new Mpdf($config);

        // 한글 폰트 설정
        $mpdf->addTTFfont(FCPATH . 'mpdf/ttfonts/NanumGothic.ttf', 'TrueType', '', 96);
        
        // PDF 내용 작성
        $html = '<h1>한글 테스트</h1><p>이 텍스트는 한글입니다.</p>';
        
        // HTML로 PDF 생성
        $mpdf->WriteHTML($html);
        
        // PDF 출력
        $mpdf->Output();
    }
}


