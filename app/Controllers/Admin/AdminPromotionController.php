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

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->areaPromotion    = model("AreaPromotion");
        $this->productPromotion = model("ProductPromotion");
        $this->codeModel        = model("Code");
        $this->promotionList    = model("PromotionList");
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

        if ($idx) {
            $row = $this->promotionList->find($idx);
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? [],
        ];
        return view("admin/_promotion/write", $data);
    }

        public function write_ok($idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['title']  = updateSQ($_POST["title"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/promotion/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("m_checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->areaPromotion->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->promotionList->updateData($idx, $data);

            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->promotionList->insertData($data);
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

    public function list_area()
    {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $search_category    = updateSQ($_GET["search_category"] ?? '');

        $where = [
            'search_txt'        => $search_txt,
            'search_category'   => $search_category,
        ];

        $result = $this->areaPromotion->get_list($where, $g_list_rows, $pg);

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
        return view("admin/_promotion/list_area", $data);
    }

    public function write_area()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');

        if ($idx) {
            $row = $this->areaPromotion->find($idx);
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? [],
        ];
        return view("admin/_promotion/write_area", $data);
    }

    public function write_area_ok($idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['title']  = updateSQ($_POST["title"] ?? '');
            $data['desc']   = updateSQ($_POST["desc"] ?? '');
            $data['color']  = updateSQ($_POST["color"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/promotion/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("m_checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->areaPromotion->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->areaPromotion->updateData($idx, $data);

            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->areaPromotion->insertData($data);
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
                    parent.location.href='/AdmMaster/_promotion/list_area';
                </script>";


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function list_product()
    {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $search_category    = updateSQ($_GET["search_category"] ?? '');
        $type               = updateSQ($_GET["type"] ?? '');

        if($type == "hotel") {
            $category_code_1 = "6201";
        }else if($type == "tour") {
            $category_code_1 = "6202";
        }else {
            $category_code_1 = "6203";
        }

        $where = [
            'category_code_1'   => $category_code_1,
            'search_txt'        => $search_txt,
            'search_category'   => $search_category,
        ];

        $result = $this->productPromotion->get_list($where, $g_list_rows, $pg);

        $data = [
            'result'                => $result['items'],
            'num'                   => $result['num'],
            'nTotalCount'           => $result['nTotalCount'],
            'nPage'                 => $result['nPage'],
            'pg'                    => $pg,
            'g_list_rows'           => $g_list_rows,
            'search_txt'            => $search_txt,
            'search_category'       => $search_category,
            'type'                  => $type
        ];
        return view("admin/_promotion/list_product", $data);
    }

    public function write_product()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');
        $type             = updateSQ($_GET["type"] ?? '');

        $fresult = $this->codeModel->whereIn('code_no', ['6201', '6202', '6203'])
                                    ->where('status', 'Y')
                                    ->orderBy('onum', 'ASC')
                                    ->orderBy('code_idx', 'ASC')->findAll();

        if ($idx) {
            $row = $this->productPromotion->find($idx);
            $fresult2 = $this->codeModel->getByParentAndDepth($row["category_code_1"], 3)->getResultArray();
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'type' => $type,
            'fresult' => $fresult ?? [],
            'fresult2' => $fresult2 ?? [],
            'row' => $row ?? [],
        ];
        return view("admin/_promotion/write_product", $data);
    }

    public function write_product_ok($idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['title']  = updateSQ($_POST["title"] ?? '');
            $data['category_code_1'] = updateSQ($_POST["category_code_1"] ?? '');
            $data['category_code_2'] = updateSQ($_POST["category_code_2"] ?? '');
            $data['keyword'] = updateSQ($_POST["keyword"] ?? '');
            $data['subtitle'] = updateSQ($_POST["subtitle"] ?? '');
            $type = updateSQ($_POST["type"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/promotion/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("m_checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->areaPromotion->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->productPromotion->updateData($idx, $data);

            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->productPromotion->insertData($data);
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
                    parent.location.href='/AdmMaster/_promotion/list_product?type=$type';
                </script>";


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
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $db1 = $this->productPromotion->delete($iValue);
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
                $db1 = $this->areaPromotion->delete($iValue)   ;
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

    public function del_area()
    {
        try {
            $ha_idx = $_POST['ha_idx'] ?? '';
            if (!isset($ha_idx)) {
                $data = [
                    'status' => 'error',
                    'msg' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $result = $this->areaPromotion->delete($ha_idx)   ;
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

                $result = $this->areaPromotion->updateData($idx[$j], $data);

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

    public function change_product()
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

                $result = $this->productPromotion->updateData($idx[$j], $data);

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
