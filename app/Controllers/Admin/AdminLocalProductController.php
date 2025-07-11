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

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->localProduct     = model("LocalProductModel");
        $this->memberModel      = new \App\Models\Member();
        $this->codeModel        = model("Code");
    }

    public function list()
    {
        $g_list_rows     = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg              = updateSQ($_GET["pg"] ?? '1');
        $search_txt      = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy         = updateSQ($_GET["orderBy"]) ?? "1";
        $city_code       = updateSQ($_GET["city_code"] ?? '');
        $category_code   = updateSQ($_GET["category_code"] ?? '');

        $where = [
            'search_txt'      => $search_txt,
            'search_category' => $search_category,
            'orderBy'         => $orderBy,
            'city_code'       => $city_code,
            'category_code'   => $category_code,
        ];

        $orderByArr = [
            'r_date' => 'DESC'
        ];		

        $result = $this->localProduct->get_list($where, $g_list_rows, $pg, $orderByArr);

        $category_code_list = $this->codeModel->getListByParentCode("6004");
        $city_code_list = $this->codeModel->getListByParentCode("6003");

        $data = [
            'result'                => $result['items'],
            'orderBy'               => $orderBy,
            'num'                   => $result['num'],
            'nTotalCount'           => $result['nTotalCount'],
            'nPage'                 => $result['nPage'],
            'pg'                    => $pg,
            'g_list_rows'           => $g_list_rows,
            'search_txt'            => $search_txt,
            'search_category'       => $search_category,
            'city_code'             => $city_code,
            'category_code'         => $category_code,
            'city_code_list'        => $city_code_list,
            'category_code_list'    => $category_code_list,


        ];
        return view("admin/_local_product/list", $data);
    }

    public function write()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');
        $city_code        = updateSQ($_GET["city_code"] ?? '');
        $category_code    = updateSQ($_GET["category_code"] ?? '');

        if ($idx) {
            $row = $this->localProduct->find($idx);
        }

        $category_code_list = $this->codeModel->getListByParentCode("6004");
        $city_code_list = $this->codeModel->getListByParentCode("6003");

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'city_code' => $city_code,
            'category_code' => $category_code,
            'category_code_list' => $category_code_list,
            'city_code_list' => $city_code_list,
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

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->localProduct->updateData($idx, $data);

            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->localProduct->insertData($data);
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
