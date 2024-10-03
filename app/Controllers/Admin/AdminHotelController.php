<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminHotelController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function list()
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $strSql = '';
        $orderBy = $_GET["orderBy"] ?? "";
        if ($orderBy == "") $orderBy = 1;

        if ($search_name) {
            $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
        }

        $total_sql = " select * from tbl_hotel where item_state != 'dele' $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == "1") $order = " onum desc ";
        if ($orderBy == "2") $order = " reg_date desc ";

        $sql = $total_sql . " order by $order, g_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            'result' => $result,
            'orderBy' => $orderBy,
            'num' => $num,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];
        return view("admin/_hotel/list", $data);
    }

    public function write()
    {
        $g_idx = updateSQ($_GET["g_idx"] ?? '');
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

        if ($g_idx) {
            $sql = " select * from tbl_hotel where g_idx = '" . $g_idx . "'";
            $result = $this->connect->query($sql);
            $row = $result->getRowArray();
        }

        $data = [
            'g_idx' => $g_idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'row' => $row ?? '',
            'fresult' => $fresult,
            'fresult2' => $fresult2,
            'fresult3' => $fresult3,
        ];
        return view("admin/_hotel/write", $data);
    }

    public function write_ok()
    {
        try {
            $files = $this->request->getFiles();
            $g_idx = updateSQ($_POST["g_idx"] ?? '');
            $product_code = updateSQ($_POST["product_code"] ?? '');
            $product_option = updateSQ($_POST["product_option"] ?? '');
            $goods_code = updateSQ($_POST["goods_code"] ?? '');
            $goods_name_front = updateSQ($_POST["goods_name_front"] ?? '');
            $goods_keyword = updateSQ($_POST["goods_keyword"] ?? '');
            $item_state = updateSQ($_POST["item_state"] ?? '');
            $admin_memo = updateSQ($_POST["admin_memo"] ?? '');
            $price_mk = updateSQ($_POST["price_mk"] ?? '');
            $price_se = updateSQ($_POST["price_se"] ?? '');
            $content = updateSQ($_POST["content"] ?? '');
            $caution = updateSQ($_POST["caution"] ?? '');
            $c_calendar = updateSQ($_POST["c_calendar"] ?? '');
            $goods_dis1 = updateSQ($_POST["goods_dis1"] ?? '');
            $goods_dis2 = updateSQ($_POST["goods_dis2"] ?? '');
            $goods_dis3 = updateSQ($_POST["goods_dis3"] ?? '');
            $goods_dis4 = updateSQ($_POST["goods_dis4"] ?? '');
            $goods_dis5 = updateSQ($_POST["goods_dis5"] ?? '');
            $dis_date_s = updateSQ($_POST["dis_date_s"] ?? '');
            $dis_date_e = updateSQ($_POST["dis_date_e"] ?? '');
            $days1 = updateSQ($_POST["days1"] ?? '');
            $days2 = updateSQ($_POST["days2"] ?? '');
            $days3 = updateSQ($_POST["days3"] ?? '');
            $days4 = updateSQ($_POST["days4"] ?? '');
            $days5 = updateSQ($_POST["days5"] ?? '');
            $days6 = updateSQ($_POST["days6"] ?? '');
            $days7 = updateSQ($_POST["days7"] ?? '');

            $grade = updateSQ($_POST["grade"] ?? '');
            $addrs = updateSQ($_POST["addrs"] ?? '');
            $locations = updateSQ($_POST["locations"] ?? '');
            $room_cnt = updateSQ($_POST["room_cnt"] ?? '');
            $chkIn = updateSQ($_POST["chkIn"] ?? '');
            $oneInfo = updateSQ($_POST["oneInfo"] ?? '');
            $goods_icon_txt = "";

            $o_idx = $_POST["o_idx"] ?? [];
            $o_name = $_POST["o_name"] ?? [];
            $o_price1 = $_POST["o_price1"] ?? [];
            $o_sdate = $_POST["o_sdate"] ?? [];
            $o_edate = $_POST["o_edate"] ?? [];
            $o_room = $_POST["o_room"] ?? [];
            $option_type = $_POST["option_type"] ?? [];
            $o_soldout = $_POST["o_soldout"] ?? [];

            for ($i = 1; $i <= 6; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;

                if (isset(${"del_" . $i}) && ${"del_" . $i} === "Y") {
                    $sql = " UPDATE tbl_hotel SET
                            ufile" . $i . "='',
                            rfile" . $i . "=''
                            WHERE g_idx='$g_idx'
                        ";

                    $this->connect->query($sql);

                } elseif (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    ${"rfile_" . $i} = $file->getName();
                    ${"ufile_" . $i} = $file->getRandomName();
                    $publicPath = WRITEPATH . '../public/uploads/hotel/';
                    $file->move($publicPath, ${"ufile_" . $i});

                    if ($g_idx) {
                        $sql = "UPDATE tbl_hotel SET
                                ufile" . $i . "='" . ${"ufile_" . $i} . "',
                                rfile" . $i . "='" . ${"rfile_" . $i} . "'
                                WHERE g_idx='$g_idx';
                            ";
                        $this->connect->query($sql);
                    }

                } else {
                    ${"rfile_" . $i} = '';
                    ${"ufile_" . $i} = '';
                }
            }


            if ($g_idx) {

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
                                         goods_code		= '" . $goods_code . "'
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

                // 상품 테이블 변경

                $sql = " update tbl_hotel SET
                         product_code			= '" . $product_code . "'
                        ,goods_code				= '" . $goods_code . "'
                        ,goods_name_front		= '" . $goods_name_front . "'
                        ,goods_keyword			= '" . $goods_keyword . "'
                        ,goods_icon				= '" . $goods_icon_txt . "'
                        ,item_state				= '" . $item_state . "'
                        ,admin_memo				= '" . $admin_memo . "'
                        ,price_mk				= '" . $price_mk . "'
                        ,price_se				= '" . $price_se . "'
                        ,content				= '" . $content . "'
                        ,caution				= '" . $caution . "'
                        ,c_calendar				= '" . $c_calendar . "'
                        ,goods_dis1				= '" . $goods_dis1 . "'
                        ,goods_dis2				= '" . $goods_dis2 . "'
                        ,goods_dis3				= '" . $goods_dis3 . "'
                        ,goods_dis4				= '" . $goods_dis4 . "'
                        ,goods_dis5				= '" . $goods_dis5 . "'
                        ,days1					= '" . $days1 . "'
                        ,days2					= '" . $days2 . "'
                        ,days3					= '" . $days3 . "'
                        ,days4					= '" . $days4 . "'
                        ,days5					= '" . $days5 . "'
                        ,days6					= '" . $days6 . "'
                        ,days7					= '" . $days7 . "'
                        ,dis_date_s				= '" . $dis_date_s . "'
                        ,dis_date_e				= '" . $dis_date_e . "'
                        ,grade					= '" . $grade . "'
                        ,addrs					= '" . $addrs . "'
                        ,locations				= '" . $locations . "'
                        ,room_cnt				= '" . $room_cnt . "'
                        ,chkIn					= '" . $chkIn . "'
                        ,oneInfo				= '" . $oneInfo . "'
                        ,mod_date				= now()
                    where g_idx = '" . $g_idx . "'
                ";
                write_log("상품등록 : " . $sql);

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
                                     goods_code		= '" . $goods_code . "'
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

                $sql = "insert into tbl_hotel SET
                         product_code			= '" . $product_code . "'
                        ,goods_code				= '" . $goods_code . "'
                        ,goods_name_front		= '" . $goods_name_front . "'
                        ,goods_keyword			= '" . $goods_keyword . "'
                        ,goods_icon				= '" . $goods_icon_txt . "'
                        ,item_state				= '" . $item_state . "'
                        ,admin_memo				= '" . $admin_memo . "'
                        ,price_mk				= '" . $price_mk . "'
                        ,price_se				= '" . $price_se . "'
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
                        ,content				= '" . $content . "'
                        ,caution				= '" . $caution . "'
                        ,c_calendar				= '" . $c_calendar . "'
                        ,goods_dis1				= '" . $goods_dis1 . "'
                        ,goods_dis2				= '" . $goods_dis2 . "'
                        ,goods_dis3				= '" . $goods_dis3 . "'
                        ,goods_dis4				= '" . $goods_dis4 . "'
                        ,goods_dis5				= '" . $goods_dis5 . "'
                        ,days1					= '" . $days1 . "'
                        ,days2					= '" . $days2 . "'
                        ,days3					= '" . $days3 . "'
                        ,days4					= '" . $days4 . "'
                        ,days5					= '" . $days5 . "'
                        ,days6					= '" . $days6 . "'
                        ,days7					= '" . $days7 . "'
                        ,dis_date_s				= '" . $dis_date_s . "'
                        ,dis_date_e				= '" . $dis_date_e . "'
                        ,reg_id					= '" . $_SESSION["member"]["id"] . "'
                        ,grade					= '" . $grade . "'
                        ,addrs					= '" . $addrs . "'
                        ,locations				= '" . $locations . "'
                        ,room_cnt				= '" . $room_cnt . "'
                        ,chkIn					= '" . $chkIn . "'
                        ,oneInfo				= '" . $oneInfo . "'
                        ,reg_date				= now()
                ";
                write_log("상품수정 : " . $sql);
                $db = $this->connect->query($sql);
            }


            if ($g_idx) {
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
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => '저장 중 오류가 발생했습니다.'
                    ]
                );

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
            $g_idx = $_POST['code_idx'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $tot = count($g_idx);
            for ($j = 0; $j < $tot; $j++) {
                $sql = " update tbl_hotel set onum='" . $onum[$j] . "' where g_idx='" . $g_idx[$j] . "'";
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
            $g_idx = $_POST['g_idx'] ?? '';
            $onum = $_POST['onum'] ?? '';
            $goods_dis3 = $_POST['product_best'] ?? '';

            $sql = " update tbl_hotel set onum='" . $onum . "', goods_dis3='" . $goods_dis3 . "' where g_idx='" . $g_idx . "'";

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
            $idx = $_POST['g_idx'] ?? '';
            if (!isset($idx)) {
                $data = [
                    'status' => 'error',
                    'error' => 'idx is not set!'
                ];
                return $this->response->setJSON($data, 400);
            }

            foreach ($idx as $iValue) {
                $sql1 = " update tbl_hotel set item_state = 'dele' where g_idx = '" . $iValue . "' ";
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
                $sql_re = " goods_code = '" . $searchCode . "' ";
            } else if ($codeType === "erp") {
                $sql_re = " goods_erp = '" . $searchCode . "' ";
            }

            $sql_c2 = " SELECT count(*) as cnts FROM tbl_hotel WHERE " . $sql_re;
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
}
