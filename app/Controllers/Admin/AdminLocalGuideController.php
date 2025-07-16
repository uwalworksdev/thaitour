<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminLocalGuideController extends BaseController
{
    protected $connect;
    protected $localGuide;
    private $memberModel;
    private $codeModel;
    protected $localGuideImg;
    protected $localProduct;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->localGuide       = model("LocalGuideModel");
        $this->memberModel      = new \App\Models\Member();
        $this->codeModel        = model("Code");
        $this->localGuideImg    = model("LocalGuideImg");
        $this->localProduct     = model("LocalProductModel");
    }

    public function list()
    {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $search_category    = updateSQ($_GET["search_category"] ?? '');
        $orderBy            = updateSQ($_GET["orderBy"]) ?? "1";
        $city_code          = updateSQ($_GET["city_code"] ?? '');
        $category_code      = updateSQ($_GET["category_code"] ?? '');
        $town_code          = updateSQ($_GET["town_code"] ?? '');
        $subcategory_code   = updateSQ($_GET["subcategory_code"] ?? '');

        $category_code_list = $this->codeModel->getListByParentCode("6004") ?? [];
        $city_code_list = $this->codeModel->getListByParentCode("6003") ?? [];

        if(!empty($city_code)) {
            $town_code_list = $this->codeModel->getListByParentCode($city_code) ?? [];
        }

        if(!empty($category_code)) {
            $subcategory_code_list = $this->codeModel->getListByParentCode($category_code) ?? [];
        }

        $where = [
            'search_txt'        => $search_txt,
            'search_category'   => $search_category,
            'orderBy'           => $orderBy,
            'city_code'         => $city_code,
            'category_code'     => $category_code,
            'town_code'         => $town_code,
            'subcategory_code'  => $subcategory_code,
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

        $result = $this->localGuide->get_list($where, $g_list_rows, $pg, $orderByArr);

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
            'town_code'             => $town_code,
            'category_code'         => $category_code,
            'subcategory_code'      => $subcategory_code,
            'category_code_list'    => $category_code_list,
            'city_code_list'        => $city_code_list,
            'town_code_list'        => $town_code_list,
            'subcategory_code_list' => $subcategory_code_list,
        ];
        return view("admin/_local_guide/list", $data);
    }

    public function write()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');

        if ($idx) {
            $row = $this->localGuide->find($idx);

            $row_prod = $this->localProduct->find($row['lp_idx']);

            $town_code_list = $this->codeModel->getListByParentCode($row_prod['city_code']);
            $subcategory_code_list = $this->codeModel->getListByParentCode($row_prod['category_code']);

            $city_code_name = $this->codeModel->getCodeName($row_prod['city_code']);
            $category_code_name = $this->codeModel->getCodeName($row_prod['category_code']);
        }

        $img_list = $this->localGuideImg->getImg($idx);

        $product_list = $this->localProduct->findAll();

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'town_code_list' => $town_code_list,
            'subcategory_code_list' => $subcategory_code_list,
            'product_list' => $product_list,
            'row' => $row ?? '',
            'img_list' => $img_list,
            'city_code_name' => $city_code_name ?? "",
            'category_code_name' => $category_code_name ?? ""
        ];
        return view("admin/_local_guide/write", $data);
    }

    public function write_ok($idx = null)
    {
        try {
            $files = $this->request->getFiles();

            $data['lp_idx']             = updateSQ($_POST["lp_idx"] ?? '');
            $data['town_code']          = updateSQ($_POST["town_code"] ?? '');
            $data['subcategory_code']   = updateSQ($_POST["subcategory_code"] ?? '');
            $data['product_name']       = updateSQ($_POST["product_name"] ?? '');
            $data['product_name_en']    = updateSQ($_POST["product_name_en"] ?? '');

            $data['onum']               = updateSQ($_POST["onum"] ?? '');

            $data['addrs']              = updateSQ($_POST["addrs"] ?? '');
            $data['latitude']           = updateSQ($_POST["latitude"] ?? '');
            $data['longitude']          = updateSQ($_POST["longitude"] ?? '');
            $data['time_line']          = updateSQ($_POST["time_line"] ?? '');
            $data['routes']             = updateSQ($_POST["routes"] ?? '');
            $data['url']                = updateSQ($_POST["url"] ?? '');
            $data['contact']            = updateSQ($_POST["contact"] ?? '');
            $data['product_contents']   = updateSQ($_POST["product_contents"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/product/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->localGuide->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
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

                $this->localGuide->updateData($idx, $data);

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

                $insertId = $this->localGuide->insertData($data);

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
                    parent.location.href='/AdmMaster/_local_guide/list';
                </script>";


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function get_category() {
        $idx = updateSQ($this->request->getGet("idx") ?? '');

        if(!empty($idx)) {
            $local_product = $this->localProduct->find($idx);
    
            $city_code = $local_product['city_code'];
            $category_code = $local_product['category_code'];
            $city_code_name = $this->codeModel->getCodeName($city_code);
            $category_code_name = $this->codeModel->getCodeName($category_code);
    
            $town_code_list = $this->codeModel->getListByParentCode($city_code);
            $subcategory_code_list = $this->codeModel->getListByParentCode($category_code);
    
            return $this->response->setJSON([
                'town_code_list' => $town_code_list,
                'subcategory_code_list' => $subcategory_code_list,
                'city_code_name' => $city_code_name,
                'category_code_name' => $category_code_name,
            ]);
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
                $db1 = $this->localGuide->delete($iValue)   ;
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

    public function del_image()
    {
        try {
            $i_idx = $_POST['i_idx'] ?? '';
            if (!isset($i_idx)) {
                $data = [
                    'result' => false,
                    'message' => 'idx가 설정되지 않았습니다!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $result = $this->localGuideImg->updateData($i_idx, [
                'ufile' => '',
                'rfile' => ''
            ]);
            if (!$result) {
                $data = [
                    'result' => false,
                    'message' => '이미지 삭제 실패'
                ];
                return $this->response->setJSON($data, 400);
            }

            $data = [
                'result' => true,
                'message' => '사진을 삭제했습니다.'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_all_image()
    {
        try {
            $request = service('request');
            $imgData = $request->getJSON();
    
            if (!empty($imgData->arr_img)) {
                foreach ($imgData->arr_img as $item) {
                    $i_idx = $item->i_idx;

                    $result = $this->localGuideImg->updateData($i_idx, [
                        'ufile' => '',
                        'rfile' => ''
                    ]);
                    if (!$result) {
                        $data = [
                            'result' => false,
                            'message' => '이미지 삭제 실패'
                        ];
                        return $this->response->setJSON($data, 400);
                    }
        
                }
            }

            $data = [
                'result' => true,
                'message' => '사진을 삭제했습니다.'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function change()
    {
        try {
            $idx = $this->request->getPost('code_idx') ?? [];
            $onum = $this->request->getPost('onum') ?? [];

            if (!is_array($idx) || !is_array($onum) || count($idx) !== count($onum)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => '입력 데이터가 잘못되었습니다.'
                ]);
            }

            $tot = count($idx);

            for ($j = 0; $j < $tot; $j++) {
                $data = [
                    'onum' => $onum[$j],
                ];

                $result = $this->localGuide->updateData($idx[$j], $data);

                if (!$result) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => '수정 중 오류가 발생했습니다!!'
                    ]);
                }
            }

            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => '수정 했습니다.'
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
