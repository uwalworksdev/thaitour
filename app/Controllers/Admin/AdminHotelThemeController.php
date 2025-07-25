<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminHotelThemeController extends BaseController
{
    protected $connect;
    protected $hotelTheme;
    protected $codeModel;
    protected $hotelThemeSub;
    protected $productModel;
    protected $reviewModel;
    protected $productImg;
    protected $hotelArea;


    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->hotelTheme       = model("HotelThemeModel");
        $this->codeModel        = model("Code");
        $this->hotelThemeSub    = model("HotelThemeSub");
        $this->hotelArea        = model("HotelAreaTheme");
        $this->productModel     = model("ProductModel");
        $this->reviewModel      = model("ReviewModel");
        $this->productImg       = model("ProductImg");

    }

    public function list()
    {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $search_category    = updateSQ($_GET["search_category"] ?? '');
        $orderBy            = updateSQ($_GET["orderBy"]) ?? "1";

        $where = [
            'search_txt'        => $search_txt,
            'search_category'   => $search_category,
            'orderBy'           => $orderBy,
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

        $result = $this->hotelTheme->get_list($where, $g_list_rows, $pg, $orderByArr);

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
        ];
        return view("admin/_hotel_theme/list", $data);
    }

    public function write_month()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');

        if ($idx) {
            $row = $this->hotelTheme->find($idx);

            $product_list = $this->hotelThemeSub->where("theme_idx", $idx)->findAll();
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? '',
            'product_list' => $product_list,
        ];
        return view("admin/_hotel_theme/write_month", $data);
    }

    public function write_area()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');

        $category_list = $this->codeModel->getListByParentCode("1303") ?? [];

        if ($idx) {
            $row = $this->hotelTheme->find($idx);

            $area_list = $this->hotelArea->where("theme_idx", $idx)->findAll();

            foreach ($area_list as $key => $item) {
                $area_list[$key]['category_name'] = $this->codeModel->getCodeName($item['category_code']);
                $area_list[$key]['product_list'] = $this->hotelThemeSub->where("ha_idx", $item['ha_idx'])
                                                                        ->orderBy("step", "ASC")
                                                                        ->orderBy("s_idx", "ASC")
                                                                        ->findAll();
            }
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? '',
            'category_list' => $category_list,
            'area_list' => $area_list,
        ];
        return view("admin/_hotel_theme/write_area", $data);
    }

    public function get_products() {
        $idxList = $this->request->getVar('idx');
        $index = $this->request->getVar('area_index');

        if (!$idxList || !is_array($idxList)) {
            return $this->response->setJSON(['error' => 'idx가 존재하지 않습니다']);
        }

        $products = $this->productModel->whereIn('product_idx', $idxList)->findAll();

        foreach ($products as $key => $item) {
            $itemReview = $this->reviewModel->getProductReview($item['product_idx']);
            $products[$key]['total_review']    = $itemReview['total_review'];
            $products[$key]['review_average']  = (int)$itemReview['avg'];
            $products[$key]['img_list']        = $this->productImg->getImg($item['product_idx']);
        }

        return view('admin/_hotel_theme/list_product', [
            "products" => $products,
            "index" => $index,
        ]);
    }

    public function write_ok($idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['type']               = updateSQ($_POST["type"] ?? '');
            $data['title']              = updateSQ($_POST["title"] ?? '');
            $data['subtitle']           = updateSQ($_POST["subtitle"] ?? '');
            $data['recommend_text']     = updateSQ($_POST["m_recommend_text"] ?? '');
            $data['url']                = updateSQ($_POST["url"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/product/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("m_checkImg_" . $i);
                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $this->hotelTheme->updateData($idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $arr_ha_idx = $this->request->getPost("ha_idx") ?? [];
            $s_category_code = $this->request->getPost("s_category_code") ?? [];
            $s_idx = $this->request->getPost("s_idx") ?? [];
            $theme_name = $this->request->getPost("theme_name") ?? [];
            $star = $this->request->getPost("star") ?? [];
            $recommend_text = $this->request->getPost("recommend_text") ?? [];
            $details = $this->request->getPost("details") ?? [];
            $step = $this->request->getPost("step") ?? [];
            $arr_product_idx = $this->request->getPost("product_idx") ?? [];

            $ufile_1 = $files['ufile_1'] ?? [];
            $ufile_2 = $files['ufile_2'] ?? [];
            $ufile_3 = $files['ufile_3'] ?? [];
            $ufile_4 = $files['ufile_4'] ?? [];

            $s_checkImg_1 = $this->request->getPost("s_checkImg_1") ?? [];
            $s_checkImg_2 = $this->request->getPost("s_checkImg_2") ?? [];
            $s_checkImg_3 = $this->request->getPost("s_checkImg_3") ?? [];
            $s_checkImg_4 = $this->request->getPost("s_checkImg_4") ?? [];

            $o_ufile_1 = $files['o_ufile_1'] ?? [];
            $o_ufile_2 = $files['o_ufile_2'] ?? [];

            $o_checkImg_1 = $this->request->getPost("o_checkImg_1") ?? [];
            $o_checkImg_2 = $this->request->getPost("o_checkImg_2") ?? [];

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->hotelTheme->updateData($idx, $data);
   
                if($data['type'] == "area"){
                    foreach ($arr_ha_idx as $key => $ha_idx) {
                        if(empty($ha_idx)){
                             $data_area = [
                                "theme_idx" => $idx,
                                "category_code" => $s_category_code[$key],
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
                            ];
        
                            $s_ha_idx = $this->hotelArea->insertData($data_area);
                        }
    
                        foreach ($s_idx[$key] as $i => $value) {
                            $data_product = [
                                "product_idx" => $arr_product_idx[$key][$i],
                                "theme_name" => $theme_name[$key][$i],
                                "recommend" => $recommend_text[$key][$i],
                                "star" => $star[$key][$i],
                                "step" => $step[$key][$i],
                            ];
                            if(empty($ha_idx)){
                                $data_product["ha_idx"] = $s_ha_idx;
                            }else{
                                $data_product["ha_idx"] = $ha_idx;
                            }

                            $product = $this->productModel->find($arr_product_idx[$key][$i]);
                            $img_list = $this->productImg->getImg($arr_product_idx[$key][$i]);

                            for ($n = 1; $n <= 4; $n++) {
                                $ufile = isset(${"ufile_{$n}"}[$key][$i]) ? ${"ufile_{$n}"}[$key][$i] : null;
    
                                if (isset($ufile) && $ufile->isValid() && !$ufile->hasMoved()) {
                                    $data_product["rfile{$n}"] = $ufile->getClientName();
                                    $data_product["ufile{$n}"] = $ufile->getRandomName();
                                    $ufile->move($publicPath, $data_product["ufile{$n}"]);
                                }else{
                                    if(empty($value)){
                                        if($n == 1) {
                                            $data_product["rfile{$n}"] = $product['rfile1'];
                                            $data_product["ufile{$n}"] = $product['ufile1'];
                                        }else{
                                            $data_product["rfile{$n}"] = $img_list[$n-2]['rfile'];
                                            $data_product["ufile{$n}"] = $img_list[$n-2]['ufile'];
                                        }
                                    }
                                }

                                ${"checkImg_" . $n} = isset(${"s_checkImg_{$n}"}[$key][$i]) ? ${"s_checkImg_{$n}"}[$key][$i] : null;
                                if (isset(${"checkImg_" . $n}) && ${"checkImg_" . $n} == "N") {
                                    $data_product["rfile{$n}"] = '';
                                    $data_product["ufile{$n}"] = '';
                                }
                            }

                            if(!empty($value)){
                                $data_product["m_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                                $this->hotelThemeSub->updateData($value, $data_product);
                            }else{
                                $data_product["r_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                                $this->hotelThemeSub->insertData($data_product);
                            }
    
                        }
                    }
                }else {
                    foreach ($s_idx as $i => $value) {
                        $data_product = [
                            "theme_idx" => $idx,
                            "theme_name" => $theme_name[$i],
                            "recommend" => $recommend_text[$i],
                            "details" => $details[$i],
                        ];

                        for ($n = 1; $n <= 2; $n++) {
                            $ufile = isset(${"o_ufile_{$n}"}[$i]) ? ${"o_ufile_{$n}"}[$i] : null;
    
                            if (isset($ufile) && $ufile->isValid() && !$ufile->hasMoved()) {
                                $data_product["rfile{$n}"] = $ufile->getClientName();
                                $data_product["ufile{$n}"] = $ufile->getRandomName();
                                $ufile->move($publicPath, $data_product["ufile{$n}"]);
                            }
    
                            ${"checkImg_" . $n} = isset(${"o_checkImg_{$n}"}[$i]) ? ${"o_checkImg_{$n}"}[$i] : null;
                            if (isset(${"checkImg_" . $n}) && ${"checkImg_" . $n} == "N") {
                                $data_product["rfile{$n}"] = '';
                                $data_product["ufile{$n}"] = '';
                            }
                        }

                        if(!empty($value)){
                            $data_product["m_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                            $this->hotelThemeSub->updateData($value, $data_product);
                        }else{
                            $data_product["r_date"] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');
                            $this->hotelThemeSub->insertData($data_product);
                        }
        
                    }
                }
                
            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->hotelTheme->insertData($data);

                if($data['type'] == "area"){
                    foreach ($s_category_code as $key => $area_code) {
                        $data_area = [
                            "theme_idx" => $insertId,
                            "category_code" => $area_code,
                            "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
                        ];
    
                        $ha_idx = $this->hotelArea->insertData($data_area);
    
                        foreach ($theme_name[$key] as $i => $name) {
                            $data_product = [
                                "ha_idx" => $ha_idx,
                                "product_idx" => $arr_product_idx[$key][$i],
                                "theme_name" => $name,
                                "recommend" => $recommend_text[$key][$i],
                                "star" => $star[$key][$i],
                                "step" => $step[$key][$i],
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
                            ];

                            $product = $this->productModel->find($arr_product_idx[$key][$i]);
                            $img_list = $this->productImg->getImg($arr_product_idx[$key][$i]);

                            for ($n = 1; $n <= 4; $n++) {
                                $ufile = isset(${"ufile_{$n}"}[$key][$i]) ? ${"ufile_{$n}"}[$key][$i] : null;
    
                                if (isset($ufile) && $ufile->isValid() && !$ufile->hasMoved()) {
                                    $data_product["rfile{$n}"] = $ufile->getClientName();
                                    $data_product["ufile{$n}"] = $ufile->getRandomName();
                                    $ufile->move($publicPath, $data_product["ufile{$n}"]);
                                }else{
                                    if($n == 1) {
                                        $data_product["rfile{$n}"] = $product['rfile1'];
                                        $data_product["ufile{$n}"] = $product['ufile1'];
                                    }else{
                                        $data_product["rfile{$n}"] = $img_list[$n-2]['rfile'];
                                        $data_product["ufile{$n}"] = $img_list[$n-2]['ufile'];
                                    }
                                }

                                ${"checkImg_" . $n} = isset(${"s_checkImg_{$n}"}[$key][$i]) ? ${"s_checkImg_{$n}"}[$key][$i] : null;
                                if (isset(${"checkImg_" . $n}) && ${"checkImg_" . $n} == "N") {
                                    $data_product["rfile{$n}"] = '';
                                    $data_product["ufile{$n}"] = '';
                                }
                            }
    
                            $this->hotelThemeSub->insertData($data_product);
                        }
                    }
                }else {
                    foreach ($theme_name as $i => $name) {
                        $data_product = [
                            "theme_idx" => $insertId,
                            "theme_name" => $name,
                            "recommend" => $recommend_text[$i],
                            "details" => $details[$i],
                            "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
                        ];
    
    
                        for ($n = 1; $n <= 2; $n++) {
                            $ufile = isset(${"o_ufile_{$n}"}[$i]) ? ${"o_ufile_{$n}"}[$i] : null;
    
                            if (isset($ufile) && $ufile->isValid() && !$ufile->hasMoved()) {
                                $data_product["rfile{$n}"] = $ufile->getClientName();
                                $data_product["ufile{$n}"] = $ufile->getRandomName();
                                $ufile->move($publicPath, $data_product["ufile{$n}"]);
                            }
    
                            ${"checkImg_" . $n} = isset(${"o_checkImg_{$n}"}[$i]) ? ${"o_checkImg_{$n}"}[$i] : null;
                            if (isset(${"checkImg_" . $n}) && ${"checkImg_" . $n} == "N") {
                                $data_product["rfile{$n}"] = '';
                                $data_product["ufile{$n}"] = '';
                            }
                        }
    
                        $this->hotelThemeSub->insertData($data_product);
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
                    parent.location.href='/AdmMaster/_hotel_theme/list';
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
                $db1 = $this->hotelTheme->delete($iValue)   ;
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

            $result = $this->hotelArea->delete($ha_idx)   ;
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
            $s_idx = $_POST['s_idx'] ?? '';
            if (!isset($s_idx)) {
                $data = [
                    'status' => 'error',
                    'msg' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $result = $this->hotelThemeSub->delete($s_idx);
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

                $result = $this->hotelTheme->updateData($idx[$j], $data);

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
