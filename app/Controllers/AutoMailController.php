<?php

namespace App\Controllers;

use App\Models\AutoMailModel;

class AutoMailController extends BaseController
{
    public function index()
    {
        $model = new AutoMailModel();
        
        $g_list_rows = 10;
        $pg = $this->request->getGet('pg') ?? 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $total_count = $model->getTotalCount();
        $nPage = ceil($total_count / $g_list_rows);

        $emails = $model->getEmails($nFrom, $g_list_rows);

        $data = [
            'emails' => $emails,
            'total_count' => $total_count,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
        ];

        return view('admin/_member/auto_mail_list', $data);
    }
}
