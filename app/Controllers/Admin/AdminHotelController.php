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
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $orderBy = $_GET["orderBy"] ?? "";

        $where = [
            'search_name' => $search_name,
            'search_category' => $search_category,
            'orderBy' => $orderBy,
            'product_code_1' => 1303,
        ];

        $result = $this->productModel->findProductPaging($where, $g_list_rows, $pg);

        $data = [
            'result' => $result['items'],
            'orderBy' => $orderBy,
            'num' => $result['num'],
            'nTotalCount' => $result['nTotalCount'],
            'nPage' => $result['nPage'],
            'pg' => $pg,
            'search_name' => $search_name,
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

        $fsql = "select * from tbl_code where code_gubun = 'tour' and parent_code_no='1303'";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql = " select *
						, (select code_name from tbl_code where code_gubun = 'stay' and depth='2' and tbl_code.code_no=tbl_product_stay.stay_code) as stay_gubun
						, (select code_name from tbl_code where code_gubun = 'country' and depth='2' and tbl_code.code_no=tbl_product_stay.country_code_1) as country_name_1
						, (select code_name from tbl_code where code_gubun = 'country' and depth='3' and tbl_code.code_no=tbl_product_stay.country_code_2) as country_name_2
						from tbl_product_stay where 1=1";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        if ($product_idx) {
            $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
            $result = $this->connect->query($sql);
            $row = $result->getRowArray();
        }

        $fsql = "select * from tbl_code where code_gubun='tour' and parent_code_no='33' order by onum desc, code_idx desc";
        $fresult4 = $this->connect->query($fsql);
        $fresult4 = $fresult4->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and parent_code_no='34' order by onum desc, code_idx desc";
        $fresult5 = $this->connect->query($fsql);
        $fresult5 = $fresult5->getResultArray();

        $fresult5 = array_map(function ($item) {
            $rs = (array)$item;

            $code_no = $rs['code_no'];

            $fsql = "select * from tbl_code where code_gubun='tour' and parent_code_no='$code_no' order by onum desc, code_idx desc";

            $rs_child = $this->connect->query($fsql)->getResultArray();

            $rs['child'] = $rs_child;

            return $rs;
        }, $fresult5);

        $fsql = "select * from tbl_code where code_gubun='tour' and parent_code_no='35' order by onum desc, code_idx desc";
        $fresult8 = $this->connect->query($fsql);
        $fresult8 = $fresult8->getResultArray();

        $fsql9 = "select * from tbl_code where parent_code_no='30' order by onum desc, code_idx desc";
        $fresult9 = $this->connect->query($fsql9);
        $fresult9 = $fresult9->getResultArray();

        $fsql = "select * from tbl_room_options where h_idx='" . $product_idx . "' order by rop_idx desc";
        $roresult = $this->connect->query($fsql);
        $roresult = $roresult->getResultArray();

        $data = [
            'product_idx' => $product_idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'row' => $row ?? '',
            'fresult' => $fresult,
            'fresult2' => $fresult2,
            'fresult3' => $fresult3,
            'fresult4' => $fresult4,
            'fresult5' => $fresult5,
            'fresult8' => $fresult8,
            'fresult9' => $fresult9,
            'roresult' => $roresult
        ];
        return view("admin/_hotel/write", $data);
    }

    public function write_ok()
    {
        try {
            $files = $this->request->getFiles();
            $product_idx = updateSQ($_POST["product_idx"] ?? '');
            $product_code_list = updateSQ($_POST["product_code_list"] ?? '');
            $product_code = updateSQ($_POST["product_code"] ?? '');
            $product_name = updateSQ($_POST["product_name"] ?? '');
            $keyword = updateSQ($_POST["keyword"] ?? '');
            $product_status = updateSQ($_POST["product_status"] ?? '');
            $original_price = updateSQ($_POST["original_price"] ?? '');
            $product_price = updateSQ($_POST["product_price"] ?? '');

            $product_level = updateSQ($_POST["product_level"] ?? '');
            $addrs = updateSQ($_POST["addrs"] ?? '');
            $room_cnt = updateSQ($_POST["room_cnt"] ?? '');
            $product_info = updateSQ($_POST["product_info"] ?? '');

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
                    $sql = " UPDATE tbl_product_mst SET
                            ufile" . $i . "='',
                            rfile" . $i . "=''
                            WHERE product_idx='$product_idx'
                        ";

                    $this->connect->query($sql);

                } elseif (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    ${"rfile_" . $i} = $file->getName();
                    ${"ufile_" . $i} = $file->getRandomName();
                    $publicPath = ROOTPATH . '/public/data/hotel/';
                    $file->move($publicPath, ${"ufile_" . $i});

                    if ($product_idx) {
                        $sql = "UPDATE tbl_product_mst SET
                                ufile" . $i . "='" . ${"ufile_" . $i} . "',
                                rfile" . $i . "='" . ${"rfile_" . $i} . "'
                                WHERE product_idx='$product_idx';
                            ";
                        $this->connect->query($sql);
                    }

                } else {
                    ${"rfile_" . $i} = '';
                    ${"ufile_" . $i} = '';
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
                                         goods_code		= '" . $product_code . "'
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
                                         r_key		= '" . $r_key . "'
                                        ,r_val	= '" . $r_val . "'
                                        ,r_price		= '" . $r_price . "'
                                        ,r_sale_price		= '" . $r_sale_price . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	= '" . $r_idx . "'
                                        ,r_name		= '" . $r_name . "'
                                    where rop_idx	= '" . $val . "'
                                ";

                            $this->connect->query($sql_su);
                        }
                    }
                }


                // 상품 테이블 변경

                $sql = " update tbl_product_mst SET
                         product_code_list			= '" . $product_code_list . "'
                        ,product_code				= '" . $product_code . "'
                        ,product_name		        = '" . $product_name . "'
                        ,keyword			        = '" . $keyword . "'
                        ,product_status				= '" . $product_status . "'
                        ,original_price				= '" . $original_price . "'
                        ,product_price				= '" . $product_price . "'
                        ,product_level				= '" . $product_level . "'
                        ,addrs					    = '" . $addrs . "'
                        ,room_cnt				    = '" . $room_cnt . "'
                        ,product_info				= '" . $product_info . "'
                    where product_idx = '" . $product_idx . "'
                ";
                write_log("호텔상품수정 : " . $sql);

                $db = $this->connect->query($sql);


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
                                     goods_code		= '" . $product_code . "'
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

                $sql = "insert into tbl_product_mst SET
                         product_code_list		= '" . $product_code_list . "'
                        ,product_code			= '" . $product_code . "'
                        ,product_code_1		    = '1303'
                        ,product_name		    = '" . $product_name . "'
                        ,keyword			    = '" . $keyword . "'
                        ,product_status			= '" . $product_status . "'
                        ,original_price			= '" . $original_price . "'
                        ,product_price			= '" . $product_price . "'
                        ,rfile1					= '" . $rfile_1 . "'
                        ,rfile2					= '" . $rfile_2 . "'
                        ,rfile3					= '" . $rfile_3 . "'
                        ,rfile4					= '" . $rfile_4 . "'
                        ,rfile5					= '" . $rfile_5 . "'
                        ,rfile6					= '" . $rfile_6 . "'
                        ,ufile1					= '" . $ufile_1 . "'
                        ,ufile2					= '" . $ufile_2 . "'
                        ,ufile3					= '" . $ufile_3 . "'
                        ,ufile4					= '" . $ufile_4 . "'
                        ,ufile5					= '" . $ufile_5 . "'
                        ,ufile6					= '" . $ufile_6 . "'
                        ,ufile7					= '" . $ufile_7 . "'
                        ,product_level			= '" . $product_level . "'
                        ,addrs					= '" . $addrs . "'
                        ,room_cnt				= '" . $room_cnt . "'
                        ,product_info			= '" . $product_info . "'
                ";
                write_log("상품수정 : " . $sql);
                $db = $this->connect->query($sql);

                $sql = 'SELECT product_idx FROM tbl_product_mst WHERE product_code = "' . $product_code . '"';
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
            } else {
                $message = "등록되었습니다.";
            }

            if (isset($db) && $db) {
                return "<script>
                        alert('$message');
                            parent.location.href='/AdmMaster/_hotel/list';
                        </script>";
            }

            return $this->response
                ->setStatusCode(400)
                ->setBody("
                    <script>
                        alert('저장 중 오류가 발생했습니다.');
                    </script>
                ");

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
            $goods_dis3 = $_POST['product_best'] ?? '';

            $sql = " update tbl_product_mst set onum='" . $onum . "', goods_dis3='" . $goods_dis3 . "' where product_idx='" . $product_idx . "'";

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
                $sql1 = " update tbl_product_mst set product_status = 'dele' where product_idx = '" . $iValue . "' ";
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
                 GROUP BY o_room
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
