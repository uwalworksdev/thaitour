<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;

class AdminProductApi extends BaseController
{
    protected $connect;
    protected $productModel;
    protected $hotelOptionModel;
    private $memberModel;
    private $CodeModel;
    protected $roomImg;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $this->productModel = model("ProductModel");
        $this->hotelOptionModel = model("HotelOptionModel");
        $this->memberModel = new \App\Models\Member();
        $this->CodeModel = model("Code");
        $this->roomImg = model("RoomImg");
    }

    public function write_price_ok()
    {
        try {
            $product_idx = $_POST["product_idx"];

            if (!$product_idx) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => '제품을 찾을 수 없습니다!!'
                ])->setStatusCode(400);
            }

            $data['original_price'] = updateSQ($_POST["original_price"] ?? '');
            $data['product_price'] = updateSQ($_POST["product_price"] ?? '');
            $data['product_code'] = updateSQ($_POST["product_code"] ?? '');
            $data['is_won_bath'] = updateSQ($_POST["is_won_bath"] ?? '');

            $o_idx = $_POST["o_idx"] ?? [];
            $o_name = $_POST["o_name"] ?? [];
            $o_price1 = $_POST["o_price1"] ?? [];
            $o_price2 = $_POST["o_price2"] ?? [];
            $o_price3 = $_POST["o_price3"] ?? [];
            $o_sdate = $_POST["o_sdate"] ?? [];
            $o_edate = $_POST["o_edate"] ?? [];
            $o_room = $_POST["o_room"] ?? [];
            $option_type = $_POST["option_type"] ?? [];
            $o_soldout = $_POST["o_soldout"] ?? [];
            $price_secret = $_POST["price_secret"] ?? [];
            $arr_op_won_bath = $_POST["op_won_bath"] ?? [];

            $rop_idx = $_POST["rop_idx"] ?? [];
            $sup_room__idx = $_POST["sup_room__idx"] ?? [];
            $sup_room__name = $_POST["sup_room__name"] ?? [];
            $sup__key = $_POST["sup__key"] ?? [];
            $sup__name = $_POST["sup__name"] ?? [];
            $sup__price = $_POST["sup__price"] ?? [];
            $sup__price_2 = $_POST["sup__price_2"] ?? [];
            $sup__price_3 = $_POST["sup__price_3"] ?? [];

            $min_date = date('Y-m-d');
            $max_date = date('Y-m-d');

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
                    $item_price2 = $o_price2[$key] ?? '';
                    $item_price3 = $o_price3[$key] ?? '';
                    $item_sdate = $o_sdate[$key] ?? '';
                    $item_edate = $o_edate[$key] ?? '';
                    $item_room = $o_room[$key] ?? '';
                    $item_type = $option_type[$key] ?? '';
                    $item_soldout = $o_soldout[$key] ?? '';
                    $chk_price_secret = $price_secret[$key] ?? '';
                    $op_won_bath = $arr_op_won_bath[$key] ?? '';

                    if ($item_sdate <= $min_date) {
                        $min_date = $item_sdate;
                    }
                    if ($max_date <= $item_edate) {
                        $max_date = $item_edate;
                    }

                    if ($row_chk['cnts'] < 1) {
                        $sql_su = "insert into tbl_hotel_option SET
                                         goods_code		= '" . $data['product_code'] . "'
                                        ,goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,goods_price2	= '" . $item_price2 . "'
                                        ,goods_price3	= '" . $item_price3 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,price_secret	= '" . $chk_price_secret . "'
                                        ,op_won_bath	= '" . $op_won_bath . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                ";
                       // write_log("1- " . $sql_su);
                        $this->connect->query($sql_su);

                        $sql_opt = "SELECT LAST_INSERT_ID() AS last_id";
                        $option = $this->connect->query($sql_opt)->getRowArray();
                        $option_idx = $option['last_id'];

                        $dateRange = getDateRange($item_sdate, $item_edate);

                        $ii = -1;
                        foreach ($dateRange as $date) {
                            $ii++;

                            $goods_date = $dateRange[$ii];
                            $dow = dateToYoil($goods_date);

                            $sql_c = "INSERT INTO tbl_hotel_price  SET  
																	  o_idx        = '" . $option_idx . "' 	
																	 ,goods_code   = '" . $data['product_code'] . "' 	
																	 ,goods_name   = '" . $item_name . "'
																	 ,goods_date   = '" . $goods_date . "'
																	 ,dow 	       = '" . $dow . "'
																	 ,goods_price1 = '" . $item_price1 . "' 
																	 ,goods_price2 = '" . $item_price2 . "'
																	 ,goods_price3 = '" . $item_price3 . "'
																	 ,use_yn       = ''
																	 ,o_sdate 	   = '" . $item_sdate . "'
																	 ,o_edate      = '" . $item_edate . "'
																	 ,reg_date     = now() ";
                           // write_log("가격정보-1 : " . $sql_c);
                            $this->connect->query($sql_c);
                        }
                    } else {
                        $sql_su = "update tbl_hotel_option SET 
                                         goods_name		= '" . $item_name . "'
                                        ,goods_price1	= '" . $item_price1 . "'
                                        ,goods_price2	= '" . $item_price2 . "'
                                        ,goods_price3	= '" . $item_price3 . "'
                                        ,o_sdate		= '" . $item_sdate . "'
                                        ,o_edate		= '" . $item_edate . "'
                                        ,o_room			= '" . $item_room . "'
                                        ,option_type	= '" . $item_type . "'
                                        ,price_secret	= '" . $chk_price_secret . "'
                                        ,op_won_bath	= '" . $op_won_bath . "'
                                        ,o_soldout		= '" . $item_soldout . "'
                                    where idx	= '" . $val . "'
                                ";

                        $this->connect->query($sql_su);

                        $dateRange = getDateRange($item_sdate, $item_edate);

                        $ii = -1;
                        foreach ($dateRange as $date) {
                            $ii++;

                            $goods_date = $dateRange[$ii];
                            $dow = dateToYoil($goods_date);

                            $sql_chk_date = " select count(*) as cnts from tbl_hotel_price where o_idx	= '" . $val . "' and goods_date = '". $goods_date ."'";
                            $result_chk_date = $this->connect->query($sql_chk_date);
                            $row_chk_date = $result_chk_date->getRowArray();

                            if($row_chk_date['cnts'] == 0){
                                $sql_c = "INSERT INTO tbl_hotel_price  SET  
                                                                          o_idx        = '" . $val . "' 	
                                                                         ,goods_code   = '" . $data['product_code'] . "' 	
                                                                         ,goods_name   = '" . $item_name . "'
                                                                         ,goods_date   = '" . $goods_date . "'
                                                                         ,dow 	       = '" . $dow . "'
                                                                         ,goods_price1 = '" . $item_price1 . "' 
                                                                         ,goods_price2 = '" . $item_price2 . "'
                                                                         ,goods_price3 = '" . $item_price3 . "'
                                                                         ,use_yn       = ''
                                                                         ,o_sdate 	   = '" . $item_sdate . "'
                                                                         ,o_edate      = '" . $item_edate . "'
                                                                         ,reg_date     = now() ";
                               // write_log("가격정보-1 : " . $sql_c);
                                $this->connect->query($sql_c);
                            }

                        }
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
                    $r_key     = $sup__key[$key] ?? '';
                    $r_name    = $sup_room__name[$key] ?? '';
                    $r_val     = $sup__name[$key] ?? '';
                    $r_price   = $sup__price[$key] ?? '';
                    $r_price_2 = $sup__price_2[$key] ?? '';
                    $r_price_3 = $sup__price_3[$key] ?? '';

                    $r_idx = $sup_room__idx[$key] ?? '';

                    if ($row_chk['cnts'] < 1) {
                        $sql_su = "insert into tbl_room_options SET
                                         r_key		= '" . $r_key . "'
                                        ,r_val		= '" . $r_val . "'
                                        ,r_price	= '" . $r_price . "'
                                        ,r_price_2		= '" . $r_price_2 . "'
                                        ,r_price_3		= '" . $r_price_3 . "'
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
                                        ,r_price_2		= '" . $r_price_2 . "'
                                        ,r_price_3		= '" . $r_price_3 . "'
                                        ,h_idx			= '" . $product_idx . "'
                                        ,r_idx	        = '" . $r_idx . "'
                                        ,r_name		    = '" . $r_name . "'
                                    where rop_idx	    = '" . $val . "'
                                ";

                        $this->connect->query($sql_su);
                    }
                }
            }

            $data['min_date'] = strval($min_date);
            $data['max_date'] = strval($max_date);
            $data['m_date'] = Time::now('Asia/Seoul')->format('Y-m-d H:i:s');

            $this->productModel->update($product_idx, $data);

            $message = "수정되었습니다(Hotel)2.";
            return "<script>
                    alert('$message');
                    parent.location.reload();
                    </script>";


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function write_room_stay()
    {
        try {
            $product_idx = $this->request->getPost("product_idx");
            $g_idx = $this->request->getPost("g_idx");

            $product = $this->productModel->getById($product_idx);

            $stay_idx = $product['stay_idx'] ?? '';

            $hsql = "SELECT * FROM tbl_product_stay WHERE stay_idx = '" . $stay_idx . "'";
            $hresult = $this->connect->query($hsql)->getRowArray();

            $room_list = $hresult['room_list'] ?? '';
            $_arr = explode("|", $room_list);
            $_arr_room_list = array_filter($_arr);

            $list__room_list = rtrim(implode(',', $_arr_room_list), ',');

            return $this->response->setJSON([
                'result' => true,
                'stay_hotel' => $hresult,
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function write_room_ok()
    {
		$db = \Config\Database::connect(); // 데이터베이스 연결

        try {
            $files = $this->request->getFiles();
            $product_idx = updateSQ($_POST["product_idx"]);
            $g_idx = updateSQ($_POST["g_idx"]);
            $hotel_code = updateSQ($_POST["hotel_code"] ?? '');
            $roomName = updateSQ($_POST["roomName"] ?? '');
            $room_facil = updateSQ($_POST["room_facil"] ?? '');
            $room_category = updateSQ($_POST["room_category"] ?? '');
            $scenery = updateSQ($_POST["scenery"] ?? '');

            $breakfast = updateSQ($_POST["breakfast"] ?? 'N');
            $lunch = updateSQ($_POST["lunch"] ?? 'N');
            $dinner = updateSQ($_POST["dinner"] ?? 'N');

            $extent = updateSQ($_POST["extent"] ?? '');
            $floor = updateSQ($_POST["floor"] ?? '');
            $policy_customer = updateSQ($_POST["policy_customer"] ?? '');
            $max_num_people = updateSQ($_POST["max_num_people"] ?? 1);

            $publicPath = ROOTPATH . 'public/uploads/rooms';

            // for ($i = 1; $i <= 6; $i++) {
            //     $file = isset($files["room_ufile" . $i]) ? $files["room_ufile" . $i] : null;
            //     ${"checkImg_" . $i} = $this->request->getPost("checkImg_" . $i);

            //     if (isset(${"checkImg_" . $i}) && ${"checkImg_" . $i} == "N") {
            //         $sql = "
            //             UPDATE tbl_room SET
            //             ufile" . $i . "='',
            //             rfile" . $i . "=''
            //             WHERE g_idx='$g_idx'
            //         ";
            //         $this->connect->query($sql);

            //     } elseif (isset($file) && $file->isValid() && !$file->hasMoved()) {
            //         ${"rfile_" . $i} = $file->getName();
            //         ${"ufile_" . $i} = $file->getRandomName();
            //         $file->move($publicPath, ${"ufile_" . $i});

            //         if ($g_idx) {
            //             $sql = "UPDATE tbl_room SET
            //                     ufile" . $i . "='" . ${"ufile_" . $i} . "',
            //                     rfile" . $i . "='" . ${"rfile_" . $i} . "'
            //                     WHERE g_idx='$g_idx';
            //                 ";
            //             $this->connect->query($sql);
            //         }

            //     } else {
            //         ${"rfile_" . $i} = '';
            //         ${"ufile_" . $i} = '';
            //     }
            // }

            $max_num_people = (int)$max_num_people;

            $arr_i_idx = $this->request->getPost("i_idx") ?? [];

            $arr_onum = $this->request->getPost("onum_img") ?? [];

            $files = $this->request->getFileMultiple('ufile');


            if ($g_idx) {
                $sql = "update tbl_room SET
                             hotel_code			= '" . $product_idx . "'
                            ,roomName			= '" . $roomName . "'
                            ,room_facil			= '" . $room_facil . "'
                            ,scenery			= '" . $scenery . "'
                            ,category			= '" . $room_category . "'
                            ,breakfast			= '" . $breakfast . "'
                            ,lunch				= '" . $lunch . "'
                            ,dinner				= '" . $dinner . "'
                            ,extent				= '" . $extent . "'
                            ,floor				= '" . $floor . "'
                            ,policy_customer	= '" . $policy_customer . "'
                            ,max_num_people		= '" . $max_num_people . "'
                        where g_idx = '" . $g_idx . "'
                    ";
                $db = $this->connect->query($sql);

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
                            $this->roomImg->updateData($i_idx, [
                                "onum" => $arr_onum[$key],
                            ]);
                        }

                        if ($file->isValid() && !$file->hasMoved()) {
                            $rfile = $file->getClientName();
                            $ufile = $file->getRandomName();
                            $file->move($publicPath, $ufile);
                
                            if (!empty($i_idx)) {
                                $this->roomImg->updateData($i_idx, [
                                    "ufile" => $ufile,
                                    "rfile" => $rfile,
                                    "m_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                                ]);
                            } else {
                                $this->roomImg->insertData([
                                    "room_idx" => $g_idx,
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
                $sql = "insert into tbl_room SET
                             hotel_code				= '" . $product_idx . "'
                            ,roomName				= '" . $roomName . "'
                            ,room_facil				= '" . $room_facil . "'
                            ,scenery			    = '" . $scenery . "'
			                ,category			    = '" . $room_category . "'
                            ,breakfast				= '" . $breakfast . "'
                            ,lunch					= '" . $lunch . "'
                            ,dinner					= '" . $dinner . "'
                            ,extent				    = '" . $extent . "'
                            ,floor				    = '" . $floor . "'
                            ,policy_customer	    = '" . $policy_customer . "'
                            ,max_num_people			= '" . $max_num_people . "'
                    ";
                $db = $this->connect->query($sql);
                $g_idx = $this->connect->insertID();
				
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

                            $this->roomImg->insertData([
                                "room_idx" => $g_idx,
                                "ufile" => $ufile,
                                "rfile" => $rfile,
                                "onum" => $arr_onum[$key],
                                "r_date" => Time::now('Asia/Seoul')->format('Y-m-d H:i:s')
                            ]);
                        }
                    }
                }

                $sql_room = "INSERT INTO tbl_hotel_rooms SET g_idx       = '". $g_idx ."'
				                                             ,goods_code = '". $product_idx ."' "; 				
                $db = $this->connect->query($sql_room);
				
				// 마지막 삽입된 룸의 ID 가져오기
                $rooms_idx = $this->connect->insertID();

				// 베드 추가
				/*
				$sql_bed = "INSERT INTO tbl_room_beds SET  
						                          rooms_idx = '$rooms_idx', 
												  bed_type  = '침대타입', 
												  goods_price1 = '0', 
												  goods_price2 = '0', 
												  goods_price3 = '0', 
												  goods_price4 = '0', 
												  goods_price5 = '0', 
												  bed_seq      = '0', 
												  reg_date     = now() ";
                $db = $this->connect->query($sql_bed);
				*/
            }

            $product_idx = $this->request->getPost("product_idx");

            $product = $this->productModel->getById($product_idx);
            $stay_idx = $product['stay_idx'] ?? '';

            $query = "SELECT room_list FROM tbl_product_stay WHERE stay_idx = ?";
            $hresult = $this->connect->query($query, [$stay_idx])->getRowArray();

            $room_list = $hresult['room_list'] ?? '';
            $_arr = explode("|", $room_list);
            $_arr_room_list = array_filter($_arr);

            $_new_arr = [$g_idx];
            $_arr_room_list = array_merge($_new_arr, $_arr_room_list);

            $list__room_list = implode('|', $_arr_room_list);

            $updateQuery = "UPDATE tbl_product_stay SET room_list = ? WHERE stay_idx = ?";
            $this->connect->query($updateQuery, [$list__room_list, $stay_idx]);

            if ($g_idx) {
                $message = "등록되었습니다.";
            } else {
                $message = "정상적인 등록되었습니다.";
            }
            if ($db) {
                return $this->response
                    ->setStatusCode(200)
                    ->setJSON(
                        [
                            'status' => 'success',
                            'room' => ['g_idx' => $g_idx],
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

    public function getListRoomHotel()
    {
        try {
            $product_idx = $this->request->getVar("product_idx");

            $product = $this->productModel->getById($product_idx);

            $stay_idx = $product['stay_idx'] ?? '';

            $hsql = "SELECT * FROM tbl_product_stay WHERE stay_idx = '" . $stay_idx . "'";
            $hresult = $this->connect->query($hsql)->getRowArray();

            $room_list = $hresult['room_list'] ?? '';
            $_arr = explode("|", $room_list);
            $_arr_room_list = array_filter($_arr);

            $list__room_list = rtrim(implode(',', $_arr_room_list), ',');

            $r_sql = " SELECT * FROM tbl_room WHERE g_idx IN ($list__room_list) ORDER BY g_idx ASC";
            $rresult = $this->connect->query($r_sql)->getResultArray();

            return $this->response->setJSON([
                'result' => true,
                'rooms' => $rresult,
                'stay_hotel' => $hresult,
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function getListRoomHotelByIdx()
    {
        try {
            $room_ids = updateSQ($_GET['room_ids']);

            $_arr_ = explode(',', $room_ids);
            $list__idx = rtrim(implode(',', $_arr_), ',');

            $r_sql = " SELECT * FROM tbl_room WHERE g_idx IN ($list__idx) ORDER BY g_idx ASC ";
            $rresult = $this->connect->query($r_sql)->getResultArray();

            return $this->response->setJSON([
                'result' => true,
                'rooms' => $rresult,
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function selectRoomById()
    {
        try {
            $idx  = $this->request->getVar("idx");

            $sql1 = " select * from tbl_room where g_idx = '" . $idx . "' ";
            $db1  = $this->connect->query($sql1)->getRowArray();

            $img_list = $this->roomImg->getImg($idx);

            $arr_facil_text = [];

            if($db1){
                $arr_facil = explode("|", $db1["room_facil"]);
                $conditions = [
                    "code_gubun" => 'Room facil',
                    "depth" => '2',
                ];
                $list_cat = $this->CodeModel->getCodesByConditions($conditions);

                foreach ($list_cat as $category) {
                    if(in_array($category['code_no'], $arr_facil)){
                        array_push($arr_facil_text, $category['code_name']);
                    }
                }

                $db1["facil_text"] = implode(", ", $arr_facil_text);
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON(
                    [
                        'status'    => 'success',
                        'room'      => $db1,
                        'img_list'  => $img_list
                    ]
                );

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(400);
        }
    }

    public function deleteRoomById()
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
				
                $sql2 = " delete from tbl_hotel_rooms where g_idx = '" . $iValue . "' ";
                $db2 = $this->connect->query($sql2);

				$sql3 = " delete from tbl_room_price where g_idx = '" . $iValue . "' ";
                $db3 = $this->connect->query($sql3);
				
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


    public function deleteRoomImgById()
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

            $result = $this->roomImg->updateData($i_idx, [
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

    public function deleteAllRoomImg()
    {
        try {
            $request = service('request');
            $imgData = $request->getJSON();
    
            if (!empty($imgData->arr_img)) {
                foreach ($imgData->arr_img as $item) {
                    $i_idx = $item->i_idx;

                    $result = $this->roomImg->updateData($i_idx, [
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

    public function copyRoom()
    {
        try {
            $g_idx = $this->request->getPost("g_idx");
            $rooms_idx = $this->request->getPost("rooms_idx");

            if (!isset($rooms_idx)) {
                $data = [
                    'result' => false,
                    'message' => 'idx가 설정되지 않았습니다!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $sql    = "select * from tbl_hotel_rooms where rooms_idx ='". $rooms_idx ."' ";
            $room   = $this->connect->query($sql);
            $room   = $room->getRowArray();

            $sql_room_bed = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ?";
            $room_bed = $this->connect->query($sql_room_bed, [$rooms_idx])->getResultArray();

            //$sql_room_price = "SELECT * FROM tbl_room_price WHERE rooms_idx = ?";
            //$room_price = $this->connect->query($sql_room_price, [$rooms_idx])->getResultArray();

            $room["room_name"] = $room["room_name"] ."(복사)";
            $sql = " INSERT INTO tbl_hotel_rooms SET g_idx    = '$g_idx'
                                                ,goods_code   = '". $room["goods_code"] ."'
                                                ,room_name    = '". $room["room_name"] ."'
                                                ,baht_thai    = '". $room["baht_thai"] ."' 
                                                ,goods_price1 = '". $room["goods_price1"] ."'
                                                ,goods_price2 = '". $room["goods_price2"] ."'
                                                ,goods_price3 = '". $room["goods_price3"] ."'
                                                ,goods_price4 = '". $room["goods_price4"] ."'
                                                ,secret_price = '". $room["secret_price"] ."'
                                                ,special_discount = '". $room["special_discount"] ."'
                                                ,discount_rate    = '". $room["discount_rate"] ."'
                                                ,price_view   = '". $room["price_view"] ."'
                                                ,breakfast    = '". $room["breakfast"] ."'
                                                ,adult        = '". $room["adult"] ."'
                                                ,kids         = '". $room["kids"] ."'
                                                ,bed_type     = '". $room["bed_type"] ."'
                                                ,bed_price    = '". $room["bed_price"] ."'
                                                ,option_val   = '". $room["option_val"] ."'
                                                ,price_secret = '". $room["price_secret"] ."'
                                                ,o_sdate      = ''
                                                ,o_edate      = ''
                                                ,is_view_promotion = '". $room["is_view_promotion"] ."'
                                                ,r_contents1  = '". $room["r_contents1"] ."'
                                                ,r_contents2  = '". $room["r_contents2"] ."'
                                                ,r_contents3  = '". $room["r_contents3"] ."'
                                                ,copy_row     = 'Y'
                                                ,reg_date     = now() ";
				 
			$result = $this->connect->query($sql);
          
            $insertID = $this->connect->insertID();

            if (!empty($room_bed)) {
                foreach ($room_bed as $row) {
                    unset($row['bed_idx']);
                    $row['rooms_idx'] = $insertID;
            
                    $this->connect->table('tbl_room_beds')->insert($row);
                }                
            } 

            if (!empty($room_price)) {
                foreach ($room_price as $row) {
                    unset($row['idx']);
                    $row['rooms_idx'] = $insertID;
            
                    $this->connect->table('tbl_room_price')->insert($row);
                }                
            } 

            if (!$result) {
                $data = [
                    'result' => false,
                    'message' => '복사 실패'
                ];
                return $this->response->setJSON($data, 400);
            }

            $data = [
                'result' => true,
                'message' => '성공적으로 복사되었습니다.'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function updateContent()
    {
        try {
            $rooms_idx = $this->request->getPost("rooms_idx");
            $content = $this->request->getPost("content");
            $type = $this->request->getPost("type");

            if (!isset($rooms_idx)) {
                $data = [
                    'result' => false,
                    'message' => 'idx가 설정되지 않았습니다!'
                ];
                return $this->response->setJSON($data, 400);
            }

            if($type == 1){
                $col = "r_contents1";
            }else if($type == 2){
                $col = "r_contents2";
            }else{
                $col = "r_contents3";
            }

            $sql = " UPDATE tbl_hotel_rooms SET $col = '$content' WHERE rooms_idx = '$rooms_idx' ";
				 
			$result = $this->connect->query($sql);
          
            if (!$result) {
                $data = [
                    'result' => false,
                    'message' => '업데이트 실패!'
                ];
                return $this->response->setJSON($data, 400);
            }

            $data = [
                'result' => true,
                'message' => '성공적으로 업데이트되었습니다.'
            ];
            return $this->response->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
