<?php
namespace App\Controllers;

use Mpdf\Mpdf;

class PdfController extends BaseController
{
    public function generateQuotation()
    {
        // PDF 객체 생성
        $pdf = new Mpdf();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TOTO Booking Co., Ltd.');
        $pdf->SetTitle('여행 견적서');
        $pdf->SetHTMLHeader('', 0, '더투어랩 여행견적서', 'TOTO Booking Co., Ltd.');

        // 페이지 추가
        $pdf->AddPage();

        // HTML 내용
        $html = '
        <h1 style="text-align: center;">더투어랩 여행견적서</h1>
        <h3>TOTO Booking Co., Ltd.</h3>
        <p>Sukhumvit 101 Bangjak<br>
        Prakhanong Bangkok 10260<br>
        서비스/여행업 No.101-86-79949</p>

        <p>견적일: 2025년 03월 14일<br>
        고객명: 김평진 님 귀하</p>

        <table border="1" cellpadding="5">
            <tr>
                <th>호텔</th><td>0건</td><td>0원</td>
                <th>골프</th><td>12건</td><td>303,175원</td>
            </tr>
            <tr>
                <th>투어</th><td>1건</td><td>39,000원</td>
                <th>차량</th><td>0건</td><td>0원</td>
            </tr>
            <tr>
                <th>가이드</th><td>0건</td><td>0원</td>
                <th>합계</th><td>2건</td><td>342,175원</td>
            </tr>
        </table>

        <br><br>

        <table border="1" cellpadding="5">
            <tr>
                <th>품목</th><th>상세</th><th>금액</th>
            </tr>
            <tr>
                <td>골프</td>
                <td>2025-03-28(금) | 로얄 방파인 골프 클럽<br>18홀 오전 1회 | 6,700바트 (3,350바트 X 2명)</td>
                <td>303,175원<br>(6,700바트)</td>
            </tr>
            <tr>
                <td>투어</td>
                <td>2025-03-28(금) | [아속출발] 아유타야 선셋 리버크루즈 반일 투어<br>[프로모션] 자유 여행 1명 | 39,000원 X 1명</td>
                <td>39,000원</td>
            </tr>
        </table>

        <p>- 상기 견적은 고객님께서 직접 선택하신 상품으로 발행된 견적서입니다.<br>
        - 견적서상 내용은 항공 및 예약 가능여부/환율 등에 따라 금액 및 내용에 변동이 있을 수 있습니다.<br>
        - 계좌번호: 636101-01-3031315 (주) 토토북킹<br>
        - 태국: Kasikorn Bank 895-2-19850-6 (Totobooking)</p>
        ';

        // HTML 출력
        $pdf->writeHTML($html, true, false, true, false, '');

        // PDF 출력
        return $pdf->Output('quotation.pdf', 'I');
    }
}

