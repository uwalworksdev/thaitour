<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminRoomController extends BaseController
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
        $hotel_code = updateSQ($_GET["hotel_code"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $strSql = '';

        if ($search_name) {
            $strSql = $strSql . " and roomName like '%" . str_replace("-", "", $search_name) . "%' ";
        }
        if ($hotel_code) {
//            $strSql = $strSql . " and r.hotel_code = '" . $hotel_code . "' ";
        }

//        $total_sql = "
//					SELECT r.*
//					      ,c.code_name as hotelName
//					  FROM tbl_room r
//					  LEFT OUTER JOIN tbl_code c
//					    ON r.hotel_code = c.code_no
//					 WHERE 1=1 $strSql
//				 ";
        $total_sql = " 
					SELECT * FROM tbl_room WHERE 1=1 $strSql 
				 ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by g_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

//        $fsql = "select *
//                    from tbl_code
//                    where code_gubun = 'fsaf'
//                    and parent_code_no = '30'
//                    order by onum asc, code_idx desc";
//        $fresult = $this->connect->query($fsql);
//        $fresult = $fresult->getResultArray();

        $data = [
            'result' => $result,
            'fresult' => $fresult ?? '',
            'num' => $num,
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'nTotalCount' => $nTotalCount,
            'search_name' => $search_name,
            'hotel_code' => $hotel_code,
            'nPage' => $nPage
        ];
        return view('admin/_room/list', $data);
    }

    public function write()
    {
        $g_idx = updateSQ($_GET["g_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? '');
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? '');

        if ($g_idx) {
            $sql = " select * from tbl_room where g_idx = '" . $g_idx . "'";
            $result = $this->connect->query($sql);
            $row = $result->getRowArray();
        }

        $fsql = "select * from tbl_code where code_gubun='Room facil' and depth='2' order by onum asc, code_idx desc";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='hotel_cate' and depth='2' order by onum asc, code_idx desc";
        $fresult2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();

        $data = [
            'g_idx' => $g_idx,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_product_code_1' => $s_product_code_1,
            's_product_code_2' => $s_product_code_2,
            'room_facil' => '',
            'row' => $row ?? '',
            'fresult' => $fresult ?? '',
            'fresult2' => $fresult2 ?? '',
        ];
        return view('admin/_room/write', $data);
    }

    public function write_ok()
    {
        try {
            $files = $this->request->getFiles();
            $g_idx = updateSQ($_POST["g_idx"]);
            $hotel_code = updateSQ($_POST["hotel_code"] ?? '');
            $roomName = updateSQ($_POST["roomName"] ?? '');
            $room_facil = updateSQ($_POST["room_facil"] ?? '');
            $room_category = updateSQ($_POST["room_category"] ?? '');
            $scenery = updateSQ($_POST["scenery"] ?? '');

            $breakfast = updateSQ($_POST["breakfast"] ?? 'N');
            $lunch = updateSQ($_POST["lunch"] ?? 'N');
            $dinner = updateSQ($_POST["dinner"] ?? 'N');
            $max_num_people = updateSQ($_POST["max_num_people"] ?? 1);

            for ($i = 1; $i <= 6; $i++) {
                $file = isset($files["ufile" . $i]) ? $files["ufile" . $i] : null;
                ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

                if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
                    $sql = "
                        UPDATE tbl_room SET
                        ufile" . $i . "='',
                        rfile" . $i . "=''
                        WHERE g_idx='$g_idx'
                    ";
                    $this->connect->query($sql);

                } elseif (isset($file) && $file->isValid() && !$file->hasMoved()) {
                    ${"rfile_" . $i} = $file->getName();
                    ${"ufile_" . $i} = $file->getRandomName();
                    $publicPath = ROOTPATH . 'public/uploads/rooms';
                    $file->move($publicPath, ${"ufile_" . $i});

                    if ($g_idx) {
                        $sql = "UPDATE tbl_room SET
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

            $max_num_people = (int)$max_num_people;

            if ($g_idx) {
                $sql = "update tbl_room SET
                             hotel_code			= '" . $hotel_code . "'
                            ,roomName			= '" . $roomName . "'
                            ,room_facil			= '" . $room_facil . "'
                            ,scenery			= '" . $scenery . "'
                            ,category			= '" . $room_category . "'
                            ,breakfast			= '" . $breakfast . "'
                            ,lunch				= '" . $lunch . "'
                            ,dinner				= '" . $dinner . "'
                            ,max_num_people		= '" . $max_num_people . "'
                        where g_idx = '" . $g_idx . "'
                    ";
            } else {
                $sql = "insert into tbl_room SET
                             hotel_code				= '" . $hotel_code . "'
                            ,roomName				= '" . $roomName . "'
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
                            ,room_facil				= '" . $room_facil . "'
                            ,scenery			    = '" . $scenery . "'
			                ,category			    = '" . $room_category . "'
                            ,breakfast				= '" . $breakfast . "'
                            ,lunch					= '" . $lunch . "'
                            ,dinner					= '" . $dinner . "'
                            ,max_num_people			= '" . $max_num_people . "'
                    ";
            }

            $db = $this->connect->query($sql);

            if ($g_idx) {
                $message = "수정되었습니다.";
            } else {
                $message = "정상적인 등록되었습니다.";
            }
            if ($db) {
                return $this->response
                    ->setStatusCode(200)
                    ->setJSON(
                        [
                            'status' => 'success',
                            'message' => $message
                        ]
                    );
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
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del()
    {
        try {
            if (!isset($_POST['idx'])) {
                $data = [
                    'status' => 'error',
                    'error' => '데이터가 설정되지 않았습니다!!'
                ];
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON($data);
            }

            $idx = $_POST['idx'];

            if (count($idx) == 0) {
                $data = [
                    'status' => 'error',
                    'error' => '데이터가 비어있습니다!!'
                ];
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON($data);
            }

            foreach ($idx as $iValue) {
                $sql1 = " delete from tbl_room where g_idx = '" . $iValue . "' ";
                $db1 = $this->connect->query($sql1);
                if (!$db1) {
                    $db1 = null;
                    break;
                }
            }

            if (isset($db1) && $db1) {
                $data = [
                    'result' => 'success',
                    'message' => '정상적으로 삭제되었습니다.',
                    'data' => '',
                    'code' => 200
                ];

                return $this->response
                    ->setStatusCode(200)
                    ->setJSON($data);
            }
            $data = [
                'result' => 'fail',
                'message' => '오류가 발생하였습니다!!',
                'data' => '',
                'code' => 400
            ];
            return $this->response
                ->setStatusCode(400)
                ->setJSON($data);
        } catch (\Exception $e) {
            $data = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
            return $this->response
                ->setStatusCode(400)
                ->setJSON($data);
        }
    }
}
