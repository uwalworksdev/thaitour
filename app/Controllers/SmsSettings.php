<?php
namespace App\Controllers;

use App\Models\SmsModel;

class SmsSettings extends BaseController
{
    public function index()
    {
        $model = new SmsModel();

        $g_list_rows = 15;
        $pg = $this->request->getGet('pg') ?? 1;
        $nFrom = ($pg - 1) * $g_list_rows;
        $total_count = $model->countAll();
        $nPage = ceil($total_count / $g_list_rows);

        $data = [
            'total_count' => $total_count,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'sms_list' => $model->getSms($nFrom, $g_list_rows),
            'pg' => $pg,
        ];

        return view('admin/_member/sms_settings', $data);
    }
}
