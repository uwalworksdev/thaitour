<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfTestController extends BaseController
{
    public function generatePdf()
    {
        // Cấu hình Dompdf
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans'); // Hỗ trợ tiếng Việt
        $dompdf = new Dompdf($options);

        // Nội dung HTML muốn xuất ra PDF
        $html = '
            <h1 style="text-align: center;">Chào mừng đến với CodeIgniter 4242</h1>
            <p style="color: blue;">Đây là file PDF được tạo bởi Dompdf.</p>
        ';

        // Load HTML vào Dompdf
        $dompdf->loadHtml($html);
        
        // Cài đặt khổ giấy và hướng giấy (A4 - portrait)
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML thành PDF
        $dompdf->render();

        // Xuất PDF ra trình duyệt
        $dompdf->stream("document.pdf", ["Attachment" => false]); // false để hiển thị trực tiếp trên trình duyệt
    }
}
