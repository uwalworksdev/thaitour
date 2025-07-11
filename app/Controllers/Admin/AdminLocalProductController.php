<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminLocalProductController extends BaseController
{
    protected $connect;
    protected $localProduct;
    private $memberModel;
    private $codeModel;
    protected $localGuideImg;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->localProduct     = model("LocalProductModel");
        $this->memberModel      = new \App\Models\Member();
        $this->codeModel        = model("Code");
        $this->localGuideImg    = model("LocalGuideImg");
    }

    public function list()
    {
        $g_list_rows     = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg              = updateSQ($_GET["pg"] ?? '1');
        $search_txt      = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy         = updateSQ($_GET["orderBy"]) ?? "1";
        $product_code_1  = 1303;
        $product_code_2  = updateSQ($_GET["product_code_2"] ?? '');
        $product_code_3  = updateSQ($_GET["product_code_3"] ?? '');

        $where = [
            'search_txt'      => $search_txt,
            'search_category' => $search_category,
            'orderBy'         => $orderBy,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,
        ];

        $orderByArr = [];

        if ($orderBy == 1) {
			$orderByArr = [
				'onum'   => 'ASC',
				'r_date' => 'DESC'
			];			
        } elseif ($orderBy == 2) {
            $orderByArr['r_date'] = "DESC";
        } else {
            $orderByArr['r_date'] = "DESC";
        }

        $result = $this->localProduct->get_list($where, $g_list_rows, $pg, $orderByArr);

        $data = [
            'result'          => $result['items'],
            'orderBy'         => $orderBy,
            'num'             => $result['num'],
            'nTotalCount'     => $result['nTotalCount'],
            'nPage'           => $result['nPage'],
            'pg'              => $pg,
            'g_list_rows'     => $g_list_rows,
            'search_txt'      => $search_txt,
            'search_category' => $search_category,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,

        ];
        return view("admin/_local_product/list", $data);
    }

    public function write()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? '');

        if ($idx) {
            $row = $this->localProduct->find($idx);
        }

        $data = [
            'idx' => $idx,
            'product_code_1' => $row['product_code_1'],
            'product_code_2' => $row['product_code_2'],
            'product_code_3' => $row['product_code_3'],
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            's_product_code_3' => $s_product_code_3,
            'row' => $row ?? '',
        ];
        return view("admin/_local_product/write", $data);
    }

    public function write_ok($idx = null)
    {
		
        try {
            $files = $this->request->getFiles();

            $data['product_code']       = updateSQ($_POST["product_code"] ?? '');
            $data['product_code_2']     = updateSQ($_POST["product_code_2"] ?? '');
            $data['product_code_3']     = updateSQ($_POST["product_code_3"] ?? '');
            $data['product_name']       = updateSQ($_POST["product_name"] ?? '');
            $data['product_name_en']    = updateSQ($_POST["product_name_en"] ?? '');

            $data['onum']               = updateSQ($_POST["onum"] ?? '');

            $data['addrs']              = updateSQ($_POST["addrs"] ?? '');
            $data['latitude']           = updateSQ($_POST["latitude"] ?? '');
            $data['longitude']          = updateSQ($_POST["longitude"] ?? '');
            $data['time_line']          = updateSQ($_POST["time_line"] ?? '');
            $data['url']                = updateSQ($_POST["url"] ?? '');
            $data['contact']            = updateSQ($_POST["contact"] ?? '');
            $data['product_contents']   = updateSQ($_POST["product_contents"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/product/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->localProduct->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $arr_i_idx = $this->request->getPost("i_idx") ?? [];
            $arr_onum = $this->request->getPost("onum_img") ?? [];

            $files = $this->request->getFileMultiple('ufile') ?? [];

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->localProduct->updateData($idx, $data);

                if (count($files) > 40) {
                    $message = "40개 이미지로 제한이 있습니다.";
                    return "<script>
                        alert('$message');
                        parent.location.reload();
                        </script>";
                }
   
                if (isset($files) && count($files) > 0) {
                    foreach ($files as $key => $file) {
                        $i_idx = $arr_i_idx[$key] ?? null;

                        if (!empty($i_idx)) {
                            $this->localGuideImg->updateData($i_idx, [
                                "onum" => $arr_onum[$key],
                            ]);
                        }

                        if ($file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);
                
                            if (!empty($i_idx)) {
                                $this->localGuideImg->updateData($i_idx, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            } else {
                                $this->localGuideImg->insertData([
                                    "lg_idx" => $idx,
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "onum" => $arr_onum[$key],
                                    "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                }
            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->localProduct->insertData($data);

                if (count($files) > 40) {
                    $message = "40개 이미지로 제한이 있습니다.";
                    return "<script>
                        alert('$message');
                        parent.location.reload();
                        </script>";
                }

                if (isset($files)) {
                    foreach ($files as $key => $file) {

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                            $this->localGuideImg->insertData([
                                "lg_idx" => $insertId,
                                "ufile" => $ufile,
                                "rfile" => $rfile,
                                "onum" => $arr_onum[$key],
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }
            }

            if ($idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                    parent.location.reload();
                    </script>";
            }

            $message = "정상적인 등록되었습니다.";
            return "<script>
                alert('$message');
                    parent.location.href='/AdmMaster/_local_product/list';
                </script>";


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $db1 = $this->localProduct->delete($iValue)   ;
                if (!$db1) {
                    $data = [
                        'status' => 'error',
                        'error' => 'error!'
                    ];
                    return $this->response->setJSON($data, 400);
                }
            }

            $data = [
                'status' => 'success',
                'message' => 'delete success!'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
