<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use Exception;

class TimeSaleController extends BaseController
{
    protected $connect;
    protected $bbsModel;
    protected $bbsCategoryModel;
    protected $wishModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->bbsModel = model("Bbs");
        $this->bbsCategoryModel = model("BbsCategoryModel");
        $this->wishModel = model("WishModel");

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

    public function like() {
        try {
            $bbs_idx = updateSQ($this->request->getPost('bbs_idx') ?? 0);

            $m_idx = session()->get("member")["idx"];

            if(empty($m_idx)) {
                $resultArr['result'] = false;
                $resultArr['message'] = "로그인 하셔야 합니다.";
            }else{

                if($this->wishModel->getWishCntFromBbs($m_idx, $bbs_idx) > 0) {
                    $this->wishModel->where("m_idx", $m_idx)->where("bbs_idx", $bbs_idx)->delete();

                    $resultArr['result'] = true;
                    $resultArr['message'] = "당신은 좋아요를 취소했습니다.";
                }else{
                    $this->wishModel->insertWish( [
                        "m_idx" => $m_idx,
                        'bbs_idx' => $bbs_idx,
                        "wish_r_date" => Time::now('Asia/Seoul', 'en_US')->format('Y-m-d H:i:s')
                    ]);

                    $resultArr['result'] = true;
                    $resultArr['message'] = "당신은 그것을 좋아했다.";
                }
            }

        } catch (Exception $err) {
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $this->response->setJSON($resultArr);
        }
    }
}
