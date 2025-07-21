<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminHotelThemeController extends BaseController
{
    protected $connect;
    protected $hotelTheme;
    private $codeModel;
    protected $subHotelTheme;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->hotelTheme       = model("HotelThemeModel");
        $this->codeModel        = model("Code");
        $this->subHotelTheme    = model("SubThemeModel");
    }

    public function list()
    {
        $g_list_rows        = !empty($_GET["g_list_rows"]) ? intval($_GET["g_list_rows"]) : 30; 
        $pg                 = updateSQ($_GET["pg"] ?? '1');
        $search_txt         = updateSQ($_GET["search_txt"] ?? '');
        $search_category    = updateSQ($_GET["search_category"] ?? '');
        $orderBy            = updateSQ($_GET["orderBy"]) ?? "1";
        $category_code      = updateSQ($_GET["category_code"] ?? '');

        $category_code_list = $this->codeModel->getListByParentCode("1303") ?? [];

        $where = [
            'search_txt'        => $search_txt,
            'search_category'   => $search_category,
            'orderBy'           => $orderBy,
            'category_code'     => $category_code,
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
            'category_code'         => $category_code,
            'category_code_list'    => $category_code_list,
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
            $row = $this->hotelTheme->find($idx);
        }

        $data = [
            'idx' => $idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'row' => $row ?? '',
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

                $this->hotelTheme->updateData($idx, $data);

                if (count($files) > 40) {
                    $message = "40개 이미지로 제한이 있습니다.";
                    return "<script>
                        alert('$message');
                        parent.location.reload();
                        </script>";
                }
   
                
            } else {

                $data['r_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

                $insertId = $this->hotelTheme->insertData($data);

                if (count($files) > 40) {
                    $message = "40개 이미지로 제한이 있습니다.";
                    return "<script>
                        alert('$message');
                        parent.location.reload();
                        </script>";
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
