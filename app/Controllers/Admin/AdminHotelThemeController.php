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

    public function write_area()
    {
        $idx              = updateSQ($_GET["idx"] ?? '');
        $pg               = updateSQ($_GET["pg"] ?? '');
        $search_name      = updateSQ($_GET["search_name"] ?? '');
        $search_category  = updateSQ($_GET["search_category"] ?? '');

        $category_list = $this->codeModel->getListByParentCode("1303") ?? [];

        if ($idx) {
            $row = $this->hotelTheme->find($idx);
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? '',
            'category_list' => $category_list,
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
            $data['recommend_text']     = updateSQ($_POST["recommend_text"] ?? '');
            
            $publicPath = ROOTPATH . '/public/data/product/';

            for ($i = 1; $i <= 1; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }

            $s_category_code = $this->request->getPost("s_category_code") ?? [];
            $theme_name = $this->request->getPost("theme_name") ?? [];
            $star = $this->request->getPost("star") ?? [];
            $recommend_text = $this->request->getPost("recommend_text") ?? [];
            $step = $this->request->getPost("step") ?? [];
            $arr_product_idx = $this->request->getPost("product_idx") ?? [];

            $ufile_1 = $files['ufile_1'] ?? [];
            $ufile_2 = $files['ufile_2'] ?? [];
            $ufile_3 = $files['ufile_3'] ?? [];
            $ufile_4 = $files['ufile_4'] ?? [];

            if ($idx) {
                $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $this->hotelTheme->updateData($idx, $data);
   
                
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
                            }
    
                            $this->hotelThemeSub->insertData($data_product);
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
