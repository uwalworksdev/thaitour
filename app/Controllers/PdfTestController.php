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
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);

        $html = '
            <h1 style="text-align: center;">Welcome to CodeIgniter 4</h1>
            <p style="color: blue;">This is a PDF file</p>
        ';

        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("document.pdf", ["Attachment" => false]);
    }
}
