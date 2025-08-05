<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminPromotionController extends BaseController
{
    protected $connect;
    protected $areaPromotion;
    protected $productPromotion;
    protected $codeModel;
    protected $promotionList;
    protected $promotionImg;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->areaPromotion    = model("AreaPromotion");
        $this->productPromotion = model("ProductPromotion");
        $this->codeModel        = model("Code");
        $this->promotionList    = model("PromotionList");
        $this->promotionImg     = model("PromotionImg");
    }

    public function list()
    {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $search_category    = updateSQ($_GET["search_category"] ?? '');

        $where = [
            'search_txt'        => $search_txt,
            'search_category'   => $search_category,
        ];

        $result = $this->promotionList->get_list($where, $g_list_rows, $pg);

        $data = [
            'result'                => $result['items'],
            'num'                   => $result['num'],
            'nTotalCount'           => $result['nTotalCount'],
            'nPage'                 => $result['nPage'],
            'pg'                    => $pg,
            'g_list_rows'           => $g_list_rows,
            'search_txt'            => $search_txt,
            'search_category'       => $search_category,
        ];
        return view("admin/_promotion/list", $data);
    }

    public function write()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');

        $fresult = $this->codeModel->whereIn('code_no', ['6201', '6202', '6203'])
                            ->where('status', 'Y')
                            ->orderBy('onum', 'ASC')
                            ->orderBy('code_idx', 'ASC')->findAll();

        foreach ($fresult as $key => $value) {
            $fresult[$key]["code_child_list"] = $this->codeModel->getByParentCode($value["code_no"])->getResultArray();
        }

        if ($idx) {
            $row = $this->promotionList->find($idx);
            $img_list = $this->promotionImg->getImg($idx);

            $area_list = $this->areaPromotion->where("promotion_idx", $idx)->orderBy("onum", "ASC")->orderBy("idx", "ASC")->findAll();
            $product_list = $this->productPromotion->where("promotion_idx", $idx)->orderBy("onum", "ASC")->orderBy("idx", "ASC")->findAll();
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? [],
            'fresult' => $fresult ?? [],
            'img_list' => $img_list ?? [],
            'area_list' => $area_list ?? [],
            'product_list' => $product_list ?? [],
        ];
        return view("admin/_promotion/write", $data);
    }

    public function write_ok($idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['title']  = updateSQ($_POST["title"] ?? '');
            $data['author'] = updateSQ($_POST["author"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/promotion/';

            for ($i = 1; $i <= 2; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("m_checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->promotionList->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $arr_i_idx = $this->request->getPost("i_idx") ?? [];
            $arr_onum = $this->request->getPost("onum_img") ?? [];

            $ufiles = $this->request->getFileMultiple('ufile') ?? [];

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->promotionList->updateData($idx, $data);

                if (isset($ufiles) && count($ufiles) > 0) {
                    foreach ($ufiles as $key => $file) {
                        $i_idx = $arr_i_idx[$key] ?? null;

                        if (!empty($i_idx)) {
                            $this->promotionImg->updateData($i_idx, [
                                "onum" => $arr_onum[$key],
                            ]);
                        }

                        if ($file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);
                
                            if (!empty($i_idx)) {
                                $this->promotionImg->updateData($i_idx, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            } else {
                                $this->promotionImg->insertData([
                                    "promotion_idx" => $idx,
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

                $idx = $this->promotionList->insertData($data);

                if (isset($ufiles)) {
                    foreach ($ufiles as $key => $file) {

                        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);

                            $this->promotionImg->insertData([
                                "promotion_idx" => $idx,
                                "ufile" => $ufile,
                                "rfile" => $rfile,
                                "onum" => $arr_onum[$key],
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }

            }

            $area_idx = $this->request->getPost("area_idx") ?? [];
            $area_title = $this->request->getPost("area_title") ?? [];
            $area_desc = $this->request->getPost("area_desc") ?? [];
            $area_color = $this->request->getPost("area_color") ?? [];
            $area_onum = $this->request->getPost("area_onum") ?? [];
            $arr_area_ufile = $files['area_ufile'] ?? [];
            $area_checkImg = $this->request->getPost("area_checkImg") ?? [];

            $product_idx = $this->request->getPost("product_idx") ?? [];
            $category_code_1 = $this->request->getPost("category_code_1") ?? [];
            $category_code_2 = $this->request->getPost("category_code_2") ?? [];
            $product_title = $this->request->getPost("product_title") ?? [];
            $product_keyword = $this->request->getPost("product_keyword") ?? [];
            $product_url = $this->request->getPost("product_url") ?? [];
            $product_subtitle = $this->request->getPost("product_subtitle") ?? [];
            $product_onum = $this->request->getPost("product_onum") ?? [];
            $arr_product_ufile = $files['product_ufile'] ?? [];
            $product_checkImg = $this->request->getPost("product_checkImg") ?? [];

            foreach ($area_idx as $key => $value) {
                $data_area = [
                    "promotion_idx" => $idx,
                    "title" => $area_title[$key],
                    "desc" => $area_desc[$key],
                    "color" => $area_color[$key],
                    "onum" => $area_onum[$key]
                ];

                $area_ufile = isset($arr_area_ufile[$key]) ? $arr_area_ufile[$key] : null;
    
                if (isset($area_ufile) && $area_ufile->isValid() && !$area_ufile->hasMoved()) {
                    $data_area["rfile1"] = $area_ufile->getClientName();
                    $data_area["ufile1"] = $area_ufile->getRandomName();
                    $area_ufile->move($publicPath, $data_area["ufile1"]);
                }

                $checkImg = isset($area_checkImg[$key]) ? $area_checkImg[$key] : null;
                if (isset($checkImg) && $checkImg == "N") {
                    $data_area["rfile1"] = '';
                    $data_area["ufile1"] = '';
                }

                if(!empty($value)) {
                    $data_area["m_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                    $this->areaPromotion->updateData($value, $data_area);
                }else {
                    $data_area["r_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                    $this->areaPromotion->insertData($data_area);
                }
            }

             foreach ($product_idx as $key => $value) {
                $data_product = [
                    "promotion_idx" => $idx,
                    "title" => $product_title[$key],
                    "subtitle" => $product_subtitle[$key],
                    "category_code_1" => $category_code_1[$key],
                    "category_code_2" => $category_code_2[$key],
                    "keyword" => $product_keyword[$key],
                    "url" => $product_url[$key],
                    "onum" => $product_onum[$key]
                ];

                $product_ufile = isset($arr_product_ufile[$key]) ? $arr_product_ufile[$key] : null;
    
                if (isset($product_ufile) && $product_ufile->isValid() && !$product_ufile->hasMoved()) {
                    $data_product["rfile1"] = $product_ufile->getClientName();
                    $data_product["ufile1"] = $product_ufile->getRandomName();
                    $product_ufile->move($publicPath, $data_product["ufile1"]);
                }

                $checkImg = isset($product_checkImg[$key]) ? $product_checkImg[$key] : null;
                if (isset($checkImg) && $checkImg == "N") {
                    $data_product["rfile1"] = '';
                    $data_product["ufile1"] = '';
                }

                if(!empty($value)) {
                    $data_product["m_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                    $this->productPromotion->updateData($value, $data_product);
                }else {
                    $data_product["r_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                    $this->productPromotion->insertData($data_product);
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
                    parent.location.href='/AdmMaster/_promotion/list';
                </script>";


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

            $result = $this->promotionImg->updateData($i_idx, [
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

                    $result = $this->promotionImg->updateData($i_idx, [
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

    public function del_area()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'msg' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $result = $this->areaPromotion->delete($idx);
            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }

            return $this->response->setJSON(['message' => $msg]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_product()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'msg' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $result = $this->productPromotion->delete($idx);
            if ($result) {
                $msg = "일차전체 삭제 완료";
            } else {
                $msg = "일차전체 삭제 오류";
            }

            return $this->response->setJSON(['message' => $msg]);

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
                $db1 = $this->promotionList->delete($iValue);
                $this->areaPromotion->where('promotion_idx', $iValue)->delete();
                $this->productPromotion->where('promotion_idx', $iValue)->delete();
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

    public function change()
    {
        try {
            $idx = $this->request->getPost('code_idx') ?? [];
            $onum = $this->request->getPost('onum') ?? [];
            $status = $this->request->getPost('status') ?? [];

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
                    'status' => $status[$j],
                ];

                $result = $this->promotionList->updateData($idx[$j], $data);

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

    public function prod_update()
    {
        try {
            $idx = $this->request->getPost('idx');
            $status = $this->request->getPost('status');
            $onum = $this->request->getPost('onum');

            $db = $this->promotionList->update($idx, [
                'onum' => $onum,
                'status' => $status,
            ]);

            if (!$db) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'message' => '수정 중 오류가 발생했습니다!!'
                        ]
                    );
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status' => 'success',
                        'message' => '수정 했습니다.'
                    ]
                );
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
