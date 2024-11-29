<?php

namespace App\Controllers;

class FileUpload extends BaseController
{
    public function file_uploader()
    {
        $callback = $this->request->getVar('callback');
        $callbackFunc = $this->request->getVar('callback_func');
        $url = $callback . '?callback_func=' . $callbackFunc;

        $file = $this->request->getFile('Filedata');
        // SUCCESSFUL
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = time() . "_" . $file->getName();
            $filename_ext = strtolower($file->getExtension());
            $allow_file = ["jpg", "png", "bmp", "gif"];

            if (!in_array($filename_ext, $allow_file)) {
                $url .= '&errstr=' . $name;
            } else {
                $uploadDir = FCPATH . 'data/editor/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if ($file->move($uploadDir, $name)) {
                    $url .= "&bNewLine=true";
                    $url .= "&sFileName=" . $name;
                    $url .= "&sFileURL=/data/editor/" . $name;
                }
            }
        }
        // FAILED
        else {
            $url .= '&errstr=error';
        }

        return redirect()->to($url);
    }
}
