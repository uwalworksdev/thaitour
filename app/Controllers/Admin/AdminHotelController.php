<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Cassandra\Date;
use CodeIgniter\Database\Config;

class AdminHotelController extends BaseController
{
    protected $connect;
    protected $productModel;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_txt = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy = $_GET["orderBy"] ?? "";

        $where = [
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'orderBy' => $orderBy,
            'product_code_1' => 1303,
        ];

        $orderByArr = [];

        if($orderBy == 1) {
            $orderByArr['onum'] = "DESC";
        } elseif ($orderBy == 2) {
            $orderByArr['r_date'] = "DESC";
        }

        $result = $this->productModel->findProductPaging($where, $g_list_rows, $pg, $orderByArr);

        $data = [
            'result' => $result['items'],
            'orderBy' => $orderBy,
            'num' => $result['num'],
            'nTotalCount' => $result['nTotalCount'],
            'nPage' => $result['nPage'],
            'pg' => $pg,
            'search_txt' => $search_txt,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];
        return view("admin/_hotel/list", $data);
    }

    public function write()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');

        $fsql = "select * from tbl_code where code_gubun = 'tour' and code_no = '1303'";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $fsql = " select *
						, (select code_name from tbl_code where code_gubun = 'stay' and depth='2' and tbl_code.code_no=tbl_product_stay.stay_code) as stay_gubun
						, (select code_name from tbl_code where code_gubun = 'country' and depth='2' and tbl_code.code_no=tbl_product_stay.country_code_1) as country_name_1
						, (select code_name from tbl_code where code_gubun = 'country' and depth='3' and tbl_code.code_no=tbl_product_stay.country_code_2) as country_name_2
						from tbl_product_stay where 1=1";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        if ($product_idx) {
            $row = $this->productModel->find($product_idx);
        }

        $fsql9 = "select * from tbl_code where parent_code_no='30' order by onum desc, code_idx desc";
        $fresult9 = $this->connect->query($fsql9);
        $fresult9 = $fresult9->getResultArray();

        $fsql = "select * from tbl_room_options where h_idx='" . $product_idx . "' order by rop_idx desc";
        $roresult = $this->connect->query($fsql);
        $roresult = $roresult->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='38' order by onum desc, code_idx desc";
        $product_themes = $this->connect->query($sql);
        $product_themes = $product_themes->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='39' order by onum desc, code_idx desc";
        $product_bedrooms = $this->connect->query($sql);
        $product_bedrooms = $product_bedrooms->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='40' order by onum desc, code_idx desc";
        $product_types = $this->connect->query($sql);
        $product_types = $product_types->getResultArray();

        $sql = "select * from tbl_code where parent_code_no='41' order by onum desc, code_idx desc";
        $product_promotions = $this->connect->query($sql);
        $product_promotions = $product_promotions->getResultArray();

        $data = [
            'product_idx' => $product_idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'row' => $row ?? '',
            'fresult' => $fresult,
            'fresult3' => $fresult3,
            'fresult9' => $fresult9,
            'roresult' => $roresult,
            'pthemes' => $product_themes,
            'pbedrooms' => $product_bedrooms,
            'ptypes' => $product_types,
            'ppromotions' => $product_promotions,
        ];
        return view("admin/_hotel/write", $data);
    }

    public function write_ok($product_idx = null)
    {
        try {
            $files = $this->request->getFiles();
            $data['product_code_list'] = updateSQ($_POST["product_code_list"] ?? '');
            $data['product_code'] = updateSQ($_POST["product_code"] ?? '');
            $data['product_name'] = updateSQ($_POST["product_name"] ?? '');
            $data['keyword'] = updateSQ($_POST["keyword"] ?? '');
            $data['product_status'] = updateSQ($_POST["product_status"] ?? '');
            $data['original_price'] = updateSQ($_POST["original_price"] ?? '');
            $data['product_price'] = updateSQ($_POST["product_price"] ?? '');

            $data['product_level'] = updateSQ($_POST["product_level"] ?? '');
            $data['addrs'] = updateSQ($_POST["addrs"] ?? '');
            $data['room_cnt'] = updateSQ($_POST["room_cnt"] ?? '');
            $data['product_info'] = updateSQ($_POST["product_info"] ?? '');
            $data['product_best'] = updateSQ($_POST["product_best"] ?? 'N');
            $data['special_price'] = updateSQ($_POST["special_price"] ?? 'N');
            $data['is_view'] = "Y";

            $data['product_theme'] = updateSQ($_POST["product_theme"] ?? ''); // code=38 호텔 테마
            $data['product_bedrooms'] = updateSQ($_POST["product_bedrooms"] ?? ''); // code=39 호텔 침실수
            $data['product_type'] = updateSQ($_POST["product_type"] ?? ''); // code=40 호텔타입
            $data['product_promotions'] = updateSQ($_POST["product_promotions"] ?? '');// code=41 호텔 프로모션

            $o_idx = $_POST["o_idx"] ?? [];
            $o_name = $_POST["o_name"] ?? [];
            $o_price1 = $_POST["o_price1"] ?? [];
            $o_sdate = $_POST["o_sdate"] ?? [];
            $o_edate = $_POST["o_edate"] ?? [];
            $o_room = $_POST["o_room"] ?? [];
            $option_type = $_POST["option_type"] ?? [];
            $o_soldout = $_POST["o_soldout"] ?? [];

            $rop_idx = $_POST["rop_idx"] ?? [];
            $sup_room__idx = $_POST["sup_room__idx"] ?? [];
            $sup_room__name = $_POST["sup_room__name"] ?? [];
            $sup__key = $_POST["sup__key"] ?? [];
            $sup__name = $_POST["sup__name"] ?? [];
            $sup__price = $_POST["sup__price"] ?? [];
            $sup__price_sale = $_POST["sup__price_sale"] ?? [];

            for ($i = 1; $i <= 7; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                    $this->productModel->update($product_idx, ['ufile' . $i => '', 'rfile' . $i => '']);
                }

                if (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    $data["rfile$i"] = $file->getClientName();
                    $data["ufile$i"] = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/hotel/';
                    $file->move($publicPath, $data["ufile$i"]);
                }
            }


            if ($product_idx) {

                foreach ($o_idx as $key => $val) {
                    $sql_chk = "
					select count(*) as cnts
					  from tbl_hotel_option
					 where idx	= '" . $val . "'
					";
                    $result_chk = $this->connect->query($sql_chk);
                    $row_chk = $result_chk->getRowArray();

                    if ($row_chk) {
                        // 이미 등록된 옵션이 아니라면...
                        $item_name = $o_name[$key] ?? '';
                        $item_price1 = $o_price1[$key] ?? '';
                        $item_sdate = $o_sdate[$key] ?? '';
                        $item_edate = $o_edate[$key] ?? '';
                        $item_room = $o_room[$key] ?? '';
                        $item_type = $option_type[$key] ?? '';
                        $item_soldout = $o_soldout[$key] ?? '';

                        if ($row_chk['cnts'] < 1) {
                            $sql_su = "insert into tbl_hotel_option SET
                                         goods_code		= '" . $data['product_code'] . "'
                                        ,goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                ";

                            $this->connect->query($sql_su);

                        } else {
                            $sql_su = "update tbl_hotel_option SET 
                                         goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                    where idx	= '" . $val . "'
                                ";

                            $this->connect->query($sql_su);
                        }
                    }
                }

                foreach ($rop_idx as $key => $val) {
                    $sql_chk = "
					select count(*) as cnts
					    from tbl_room_options
					    where rop_idx	= '" . $val . "'
					";
                    $result_chk = $this->connect->query($sql_chk);
                    $row_chk = $result_chk->getRowArray();

                    if ($row_chk) {
                        // 이미 등록된 옵션이 아니라면...
                        $r_key = $sup__key[$key] ?? '';
                        $r_name = $sup_room__name[$key] ?? '';
                        $r_val = $sup__name[$key] ?? '';
                        $r_price = $sup__price[$key] ?? '';
                        $r_sale_price = $sup__price_sale[$key] ?? '';

                        $r_idx = $sup_room__idx[$key] ?? '';

                        if ($row_chk['cnts'] < 1) {
                            $sql_su = "insert into tbl_room_options SET
                                         r_key		= '" . $r_key . "'
                                        ,r_val		= '" . $r_val . "'
                                        ,r_price	= '" . $r_price . "'
                                        ,r_sale_price		= '" . $r_sale_price . "'
                                        ,r_created_at		= '" . date('Y-m-d H:i:s') . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	= '" . $r_idx . "'
                                        ,r_name		= '" . $r_name . "'
                                ";

                            $this->connect->query($sql_su);


                        } else {
                            $sql_su = "update tbl_room_options SET 
                                         r_key		    = '" . $r_key . "'
                                        ,r_val	        = '" . $r_val . "'
                                        ,r_price		= '" . $r_price . "'
                                        ,r_sale_price	= '" . $r_sale_price . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	        = '" . $r_idx . "'
                                        ,r_name		    = '" . $r_name . "'
                                    where rop_idx	    = '" . $val . "'
                                ";

                            $this->connect->query($sql_su);
                        }
                    }
                }


                // 상품 테이블 변경
                $this->productModel->update($product_idx, $data);
                // write_log("호텔상품수정 : " . $sql);

                // $db = $this->connect->query($sql);


            } else {
                // 옵션 등록
                foreach ($o_idx as $key => $val) {
                    $item_name = $o_name[$key] ?? '';
                    $item_price1 = $o_price1[$key] ?? '';
                    $item_sdate = $o_sdate[$key] ?? '';
                    $item_edate = $o_edate[$key] ?? '';
                    $item_room = $o_room[$key] ?? '';
                    $item_type = $option_type[$key] ?? '';
                    $item_soldout = $o_soldout[$key] ?? '';

                    $sql_su = "insert into tbl_hotel_option SET
                                     goods_code		= '" . $data['product_code'] . "'
                                    ,goods_name		= '" . $item_name . "'
                                    ,goods_price1	= '" . $item_price1 . "'
                                    ,o_sdate		= '" . $item_sdate . "'
                                    ,o_edate		= '" . $item_edate . "'
                                    ,o_room			= '" . $item_room . "'
                                    ,option_type	= '" . $item_type . "'
                                    ,o_soldout		= '" . $item_soldout . "'
                            ";

                    $this->connect->query($sql_su);

                }

                $data['product_code_1'] = '1303';

                $this->productModel->insert($data);

                $sql = 'SELECT product_idx FROM tbl_product_mst WHERE product_code = "' . $data['product_code'] . '"';
                $hotel = $this->connect->query($sql)->getRowArray();
                $new_product_idx = $hotel['product_idx'];

                foreach ($o_idx as $key => $val) {
                    $r_key = $sup__key[$key] ?? '';
                    $r_name = $sup_room__name[$key] ?? '';
                    $r_val = $sup__name[$key] ?? '';
                    $r_price = $sup__price[$key] ?? '';
                    $r_sale_price = $sup__price_sale[$key] ?? '';

                    $r_idx = $sup_room__idx[$key] ?? '';

                    $sql_su = "insert into tbl_room_options SET
                                         r_key		= '" . $r_key . "'
                                        ,r_val		= '" . $r_val . "'
                                        ,r_price	= '" . $r_price . "'
                                        ,r_sale_price		= '" . $r_sale_price . "'
                                        ,r_created_at		= '" . date('Y-m-d H:i:s') . "'
                                        ,h_idx			= '" . $new_product_idx . "'
                                        ,r_idx	= '" . $r_idx . "'
                                        ,r_name		= '" . $r_name . "'
                                ";

                    $this->connect->query($sql_su);
                }
            }

            if ($product_idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            } else {
                $message = "등록되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.href='/AdmMaster/_hotel/list';
                    </script>";
            }


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
            $product_idx = $_POST['code_idx'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $tot = count($product_idx);
            for ($j = 0; $j < $tot; $j++) {
                $sql = " update tbl_product_mst set onum='" . $onum[$j] . "' where product_idx='" . $product_idx[$j] . "'";
                $db = $this->connect->query($sql);
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

    public function prod_update()
    {
        try {
            $product_idx = $_POST['product_idx'] ?? '';
            $onum = $_POST['onum'] ?? '';
            $product_best = $_POST['product_best'] ?? '';
            $product_status = $this->request->getPost("product_status");

            $db = $this->productModel->update($product_idx, [
                "onum" => $onum,
                "product_best" => $product_best,
                "product_status" => $product_status
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

    public function del()
    {
        try {
            $idx = $_POST['product_idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $sql1 = " update tbl_product_mst set product_status = 'D' where product_idx = '" . $iValue . "' ";
                $db1 = $this->connect->query($sql1);
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

    public function get_room()
    {
        $data = [];
        $gidx = $_GET['gidx'] ?? '';

        $_sql = "SELECT * FROM tbl_product_stay WHERE code_no = ?";
        $result = $this->connect->query($_sql, [$gidx]);
        $result = $result->getRowArray();

        if ($result) {
            $room_list = $result['room_list'];
            $room_list = trim($room_list, '|');
            $room_array = explode('|', $room_list);

            if (!empty($room_array)) {
                $room_array_str = implode(',', array_map('intval', $room_array));

                $sql = "SELECT * FROM tbl_room WHERE g_idx IN ($room_array_str)";
                $result = $this->connect->query($sql);
                $rooms = $result->getResultArray();

                foreach ($rooms as $room) {
                    $data[] = [
                        'g_idx' => $room['g_idx'],
                        'roomName' => $room['roomName']
                    ];
                }
            }
        }

        return $this->response->setJSON($data);
    }

    public function getListOption($goods_code)
    {
        if (!isset($goods_code)) {
            return [];
        }
        $gsql = "SELECT * 
                 FROM tbl_hotel_option 
                 WHERE option_type = 'M' 
                 AND goods_code='" . $goods_code . "' 
                 ORDER BY o_room ASC 
            ";

        return $this->connect->query($gsql)->getResultArray();
    }

    public function getListOptionRoom($goods_code, $o_room)
    {
        if (!isset($goods_code)) {
            return [];
        }

        $fsql3 = "SELECT * 
                  FROM tbl_hotel_option 
                  WHERE option_type = 'M' 
                  AND goods_code='" . $goods_code . "' 
                  AND o_room = '" . $o_room . "'
                  ORDER BY o_sdate ASC
            ";

        return $this->connect->query($fsql3)->getResultArray();
    }

    public function getListOptionType($goods_code)
    {
        if (!isset($goods_code)) {
            return [];
        }

        $fsql3 = "select * from tbl_hotel_option where option_type = 'S' and  goods_code='" . $goods_code . "' order by idx asc ";

        return $this->connect->query($fsql3)->getResultArray();
    }

    public function search_code()
    {
        try {
            $codeType = $_POST['codeType'] ?? '';
            $searchCode = $_POST['searchCode'] ?? '';


            if ($codeType === "code") {
                $sql_re = " product_code = '" . $searchCode . "' ";
            }

            $sql_c2 = " SELECT count(*) as cnts FROM tbl_product_mst WHERE " . $sql_re;
            $result_c2 = $this->connect->query($sql_c2);
            $row_c2 = $result_c2->getRowArray();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => $row_c2['cnts']
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_hotel_option()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $sql = "DELETE FROM tbl_hotel_option WHERE idx = " . $idx;
            $this->connect->query($sql);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '삭제되었습니다.'
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function del_room_option()
    {
        try {
            $idx = $_POST['idx'] ?? '';
            if (!isset($idx)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'idx가 없습니다.'
                ], 400);
            }

            $sql = "DELETE FROM tbl_room_options WHERE rop_idx = " . $idx;
            $this->connect->query($sql);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => '삭제되었습니다.'
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
