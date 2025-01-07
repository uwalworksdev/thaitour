<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class TimeSaleController extends BaseController
{
    protected $connect;
    protected $bbsModel;
    protected $bbsCategoryModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->bbsModel = model("Bbs");
        $this->bbsCategoryModel = model("BbsCategoryModel");

        helper('my_helper');
    }

    public function list()
    {
        $code = "time_sale";
        $search_word = $this->request->getGet('search_word');
        $search_mode = $this->request->getGet('search_mode');
        $pg = $this->request->getGet('pg') ?? 1;

        $g_list_rows = 30;

        $builder = $this->bbsModel->List($code, ['search_word' => $search_word, 'search_mode' => $search_mode]);

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);

        $rows = $builder->paginate($g_list_rows, 'default', $pg);

        foreach($rows as $key => $value){
            $rows[$key]["status_name"] = $this->bbsCategoryModel->find($value["category"])["subject"];
        }

        $data = [
            'code' => $code,
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'pg' => $pg,
            'nPage' => $nPage,
            'rows' => $rows,
        ];

        return $this->renderView('time_sale/list', $data);
    }
}
