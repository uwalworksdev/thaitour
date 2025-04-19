<?php
public function generateQuotation()
{
    $pdf = new \Mpdf\Mpdf([
        'default_font' => 'dejavusans',
        'tempDir' => WRITEPATH . 'mpdf_tmp'
    ]);

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

    $html = view('pdf/quotation', $data);

    $pdf->WriteHTML($html);
    $pdf->Output('quotation.pdf', 'I'); // 브라우저 출력
    exit;
}

