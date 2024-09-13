<?php
namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;

class ImageController extends BaseController
{
    public function show($code, $filename)
    {
        $path = WRITEPATH . 'uploads/'. $code . '/' . $filename;
        
        if (!is_file($path)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND, 'Image not found.');
        }

        $image = file_get_contents($path);

        $mimeType = mime_content_type($path);

        return $this->response
            ->setContentType($mimeType)
            ->setBody($image);
    }
}
