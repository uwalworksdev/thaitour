<?php

namespace App\Controllers;
use DateTime;
use CodeIgniter\I18n\Time;

class AjaxController extends BaseController {
    private $db;
    private $productModel;
    private $roomImg;
    private $CodeModel;
    private $orderOptionModel;
    private $orderModel;
    protected $historyOrderUpdate;


    public function __construct() {
        $this->db = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg = model("RoomImg");
        $this->CodeModel = model("Code");
        $this->orderOptionModel = model("OrderOptionModel");
        $this->orderModel = model("OrdersModel");
        $this->historyOrderUpdate = model("HistoryOrderUpdate");
    }

    public function uploader() {
        $r_reg_m_idx = $this->request->getPost('r_reg_m_idx');
        $r_code      = $this->request->getPost('r_code') ?? '000';
        $uploadPath  = ROOTPATH . "public/uploads/data/editor_img/$r_code/";

        $pathView = "/uploads/data/editor_img/$r_code/";

        if ($this->request->getFile('file')->getSize() > 5242880) {
            $output = [
                "result" => "ERROR",
                "msg" => "파일의 사이즈가 5MB를 초과할 수 없습니다."
            ];

            return $this->response->setJSON($output);
        }

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getName();

            if (no_file_ext($fileName) != "Y") {
                exit();
            }

            $tempPath = $file->getTempName();

            $ufile = fileCheckImgUpload($r_reg_m_idx, $fileName, $tempPath, $uploadPath, "N");

            $resultMsg = $pathView . $ufile;
        } else {
            $resultMsg = 'Your upload triggered the following error: ' . $file->getErrorString();
        }

        $output = [
            "result" => "OK",
            "msg" => $resultMsg
        ];

        return $this->response->setJSON($output);
    }

    public function get_travel_types() {
        $code  = $this->request->getPost('code');
        $depth = $this->request->getPost('depth');
        $db    = \Config\Database::connect();

        $sql = "SELECT * FROM tbl_code WHERE parent_code_no = '$code' AND depth = '$depth' order by onum asc";
        $cnt = $db->query($sql)->getNumRows();

        $rows = $db->query($sql)->getResultArray();
        $data = "";
        $data .= "<option value=''>선택</option>";
        foreach ($rows as $row) {
            $data .= "<option value='$row[code_no]'>$row[code_name]</option>";
        }

        $output = [
            "data"  => $data,
            "cnt"   => $cnt
        ];
        
        return $this->response->setJSON($output);
    }

public function get_golf_option() {
        $db           = \Config\Database::connect();
		$setting      = homeSetInfo();
        $baht_thai    = (float)($setting['baht_thai'] ?? 0);
		
        $product_idx  = $this->request->getPost('product_idx');
        $goods_date   = $this->request->getPost('goods_date');
        $goods_name   = $this->request->getPost('goods_name');

		$sql = "SELECT a.*. b.* FROM tbl_golf_option a 
		                         LEFT JOIN tbl_golf_price b ON a.group_idx = b.group_idx 
								 WHERE product_idx = '". $product_idx ."' 
								 AND goods_date = '". $goods_date ."' 
								 AND goods_name = '". $goods_name ."' "; 
		write_log("get_golf_option- ". $sql);						 
		$rows = $db->query($sql)->getResultArray();
		foreach ($rows as $row) {
				 
                 $option_idx        = $row['idx'];	
                 $vehicle_price1_ba = $row['vehicle_price1'];	
	             $vehicle_price2_ba = $row['vehicle_price2'];	
	             $vehicle_price3_ba = $row['vehicle_price3'];	
	             $cart_price_ba     = $row['cart_price'];
	             $caddie_fee_ba     = $row['caddie_fee']; 

	             $o_cart_due	    = $row['o_cart_due']; 	
	             $o_caddy_due	    = $row['o_caddy_due']; 	
	             $o_cart_cont	    = $row['o_cart_cont']; 	
	             $o_caddy_cont	    = $row['o_caddy_cont']; 			 
                 
				 $vehicle_price1    = (int) round($row['vehicle_price1'] * $baht_thai);	
	             $vehicle_price2    = (int) round($row['vehicle_price2'] * $baht_thai); 	
	             $vehicle_price3    = (int) round($row['vehicle_price3'] * $baht_thai); 	
	             $cart_price        = (int) round($row['cart_price']     * $baht_thai);
	             $caddie_fee        = (int) round($row['caddie_fee']     * $baht_thai);   
		}

        $output = [
					"option_idx"         => $option_idx,
					"vehicle_price1"     => $vehicle_price1,
					"vehicle_price2"     => $vehicle_price2,
					"vehicle_price3"     => $vehicle_price3,
					"cart_price"         => $cart_price,
					"caddie_fee"         => $caddie_fee, 
					"o_cart_due"	     => $o_cart_due, 	
					"o_caddy_due"	     => $o_caddy_due, 	
					"o_cart_cont"	     => $o_cart_cont, 	
					"o_caddy_cont"	     => $o_caddy_cont, 			 
			
					"vehicle_price1_ba"  => $vehicle_price1_ba,
					"vehicle_price2_ba"  => $vehicle_price2_ba,
					"vehicle_price3_ba"  => $vehicle_price3_ba,
					"cart_price_ba"      => $cart_price_ba,
					"caddie_fee_ba"      => $caddie_fee_ba 
        ];
        
        return $this->response->setJSON($output);		
	}
	
	public function hotel_price_add()
    {
		    $product_idx = $this->request->getPost('product_idx');
		    $g_idx       = $this->request->getPost('g_idx');
			$rooms_idx   = $this->request->getPost('rooms_idx');
		    $days        = $this->request->getPost('days');

			// 방 정보를 가져옵니다.
			$sql      = "SELECT * FROM tbl_hotel_rooms WHERE rooms_idx = ?";
			$query    = $this->db->query($sql, [$rooms_idx]);
			$roomData = $query->getRow(); // 객체 형태로 반환

			if (!$roomData) {
				return $this->response->setJSON([
					'status' => 'fail',
					'message' => '방 정보를 찾을 수 없습니다'
				]);
			}

			// insertRoomPrice.php 파일을 포함하여 가격 삽입 함수 호출
			include_once APPPATH . 'Common/insertPriceAdd.php';

			// 공통 함수 호출
			$baht_thai = $this->setting['baht_thai'];

			$sql       = "SELECT * FROM tbl_room_price WHERE product_idx = '$product_idx' AND g_idx = '$g_idx' AND rooms_idx = '$rooms_idx' ORDER BY goods_date desc limit 0,1 ";
			$row       = $this->db->query($sql)->getRow();
			$from_date = $row->goods_date;  	

			$from_date    = day_after($from_date, 1);
			$to_date      = day_after($from_date, $days-1);
			
			$result = insertPriceAdd($this->db, $rooms_idx, $baht_thai, $roomData->goods_code, $roomData->g_idx, $from_date, $to_date);

  			
			// 호텔 객실가격 시작일
			$sql     = "SELECT * FROM tbl_room_price WHERE product_idx = '$product_idx' AND g_idx = '$g_idx' AND rooms_idx = '$rooms_idx' ORDER BY goods_date ASC limit 0,1 ";
            $row     = $this->db->query($sql)->getRow();
			$s_date  = $row->goods_date; 

			// 호텔 객실가격 종료일
			$sql     = "SELECT * FROM tbl_room_price WHERE product_idx = '$product_idx' AND g_idx = '$g_idx' AND rooms_idx = '$rooms_idx' ORDER BY goods_date DESC limit 0,1 ";
            $row     = $this->db->query($sql)->getRow();
			$e_date  = $row->goods_date; 
			
			$sql_o = "UPDATE tbl_hotel_rooms  SET o_sdate = '". $s_date."'   
										  	    , o_edate = '". $e_date ."' WHERE rooms_idx = '". $rooms_idx ."' "; 
			$result = $this->db->query($sql_o);
 
 
			if (isset($result) && $result) {
				$msg = "호텔 객실일자 추가완료";
			} else {
				$msg = "호텔 객실일자 추가오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg,
					's_date'  => $from_date,
					'e_date'  => $to_date
				]);

    }
	
	public function fnAddIp_insert()   
    {
        $db    = \Config\Database::connect();

        try {
            $blockip = $_POST["ip"];

            if (empty($blockip)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'No IP provided'
                    ]);
            }

            $sql = "insert into tbl_block_ip set ip = '$blockip', reg_date = now() ";
			//write_log($sql);
			$result = $db->query($sql);

            if (isset($result) && $result) {
                $msg = "아이피 등록완료";
            } else {
                $msg = "아이피 등록오류";
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }   
    } 


	public function fnAddIp_delete()   
    {
        $db    = \Config\Database::connect();

        try {
            $m_idx = $_POST["m_idx"];

            if (empty($m_idx)) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'No IP provided'
                    ]);
            }

            $sql = "delete from tbl_block_ip where m_idx = '$m_idx'  ";
			//write_log($sql);
			$result = $db->query($sql);

            if (isset($result) && $result) {
                $msg = "아이피 삭제완료";
            } else {
                $msg = "아이피 삭제오류";
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }   
    } 


	public function fnAddIp_sel_delete()   
    {
        $db    = \Config\Database::connect();

        try {
            $m_idx = $_POST['m_idx'] ?? [];
            $tot   = count($m_idx);

            for($j=0;$j<$tot;$j++)
            {
					if ($m_idx[$j]) {
						$sql = "delete from tbl_block_ip where m_idx = '". $m_idx[$j] ."'  ";
						//write_log($sql);
						$result = $db->query($sql);

						if (isset($result) && $result) {
							$msg = "아이피 삭제완료";
						} else {
							$msg = "아이피 삭제오류";
						}
                    }
            }

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }  
    }

	public function popup_update()   
    {
            $db    = \Config\Database::connect();

			$r_idx      = $_POST['r_idx'];
			$r_status   = $_POST['r_status'];
			$r_s_date_d = $_POST['r_s_date_d'];
			$r_s_date_h = $_POST['r_s_date_h'];
			$r_s_date_i = $_POST['r_s_date_i'];
			$r_s_date_s = $_POST['r_s_date_s'];
			$r_s_date   = $r_s_date_d ." ". $r_s_date_h .":". $r_s_date_i .":". $r_s_date_s;

			$r_e_date_d = $_POST['r_e_date_d'];
			$r_e_date_h = $_POST['r_e_date_h'];
			$r_e_date_i = $_POST['r_e_date_i'];
			$r_e_date_s = $_POST['r_e_date_s'];
			$r_e_date   = $r_e_date_d ." ". $r_e_date_h .":". $r_e_date_i .":". $r_e_date_s;

			$r_open     = $_POST['r_open'];
			$r_close    = $_POST['r_close'];
			$r_title    = $_POST['r_title'];
			$r_content  = $_POST['r_content'];
			$r_url      = $_POST['r_url'];

			//write_log("popup update");

			if ($r_idx == "") {
				$sql = "insert into tbl_cms set r_status  = '$r_status'  
			                                   ,r_s_date  = '$r_s_date'
			                                   ,r_e_date  = '$r_e_date'
			                                   ,r_open    = '$r_open'
											   ,r_close   = '$r_close'
											   ,r_title   = '$r_title'
											   ,r_content = '$r_content'
											   ,r_url     = '$r_url' ";
            } else {
				$sql = "update      tbl_cms set r_status  = '$r_status'  
			                                   ,r_s_date  = '$r_s_date'
			                                   ,r_e_date  = '$r_e_date'
			                                   ,r_open    = '$r_open'
											   ,r_close   = '$r_close'
											   ,r_title   = '$r_title'
											   ,r_content = '$r_content'
											   ,r_url     = '$r_url' where r_idx = '$r_idx' ";
            }
			
			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "팝업 등록완료";
			} else {
				$msg = "팝업 등록오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'Y',
					'message' => $msg
				]);
 
 
    }
	
	public function hotel_price_update()   
    {
        $db    = \Config\Database::connect();

            $idx          = $_POST['idx'];
			$goods_price1 = str_replace(',', '', $_POST['goods_price1']);
			$goods_price2 = str_replace(',', '', $_POST['goods_price2']);
            $use_yn       = $_POST['use_yn'];
			
			$sql = "UPDATE tbl_hotel_price SET goods_price1 = '". $goods_price1 ."'
			                                 , goods_price2 = '". $goods_price2 ."'
											 , use_yn       = '". $use_yn ."'
											 , upd_date     = now() WHERE idx = '". $idx ."'  ";
			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "가격 수정완료";
			} else {
				$msg = "가격 수정오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }
	
	public function hotel_price_delete()   
    {
        $db    = \Config\Database::connect();

            $idx          = $_POST['idx'];
			
			$sql = "DELETE FROM tbl_hotel_price WHERE idx = '". $idx ."'  ";
			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "가격 삭제완료";
			} else {
				$msg = "가격 식제오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }

	public function hotel_price_allupdate()   
    {
            $db           = \Config\Database::connect();
		    $setting      = homeSetInfo();
            $baht_thai    = (float)($setting['baht_thai'] ?? 0);

            $o_idx        = $_POST['o_idx'];
            $idx          = $_POST['idx'];
			$goods_date   = $_POST['goods_date'];
			$goods_price1 = str_replace(',', '', $_POST['goods_price1']);
			$goods_price2 = str_replace(',', '', $_POST['goods_price2']);

            $o_soldout    = $_POST['o_soldout'];
            $chk_idx      = explode(",", $_POST['chk_idx']);

			$sql    = "UPDATE tbl_hotel_option SET o_soldout = '". $o_soldout ."' WHERE idx = '". $o_idx ."'  ";
			$result = $db->query($sql);

			$sql    = "UPDATE tbl_hotel_price SET use_yn = '' WHERE o_idx = '". $o_idx ."'  ";
			$result = $db->query($sql);

            for($i=0;$i<count($chk_idx);$i++)
		    {
					$sql    = "UPDATE tbl_hotel_price SET use_yn = 'N' WHERE idx = '". $chk_idx[$i] ."'  ";
					$result = $db->query($sql);
            }

            for($i=0;$i<count($idx);$i++)
		    {
					$sql    = "UPDATE tbl_hotel_price SET goods_price1 = '". $goods_price1[$i] ."', goods_price2 = '". $goods_price2[$i] ."' WHERE idx = '". $idx[$i] ."'  ";
					$result = $db->query($sql);
            }

			if (isset($result) && $result) {
				$msg = "가격 등록완료";
			} else {
				$msg = "가격 등록오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }

	public function hotel_room_allupdate()   
    {
            $db           = \Config\Database::connect();
		    $setting      = homeSetInfo();
            $baht_thai    = (float)($setting['baht_thai'] ?? 0);
			
            $postData     = $_POST;
			
			// 룸 가격 전체저장
			foreach ($postData['room_name'] as $key => $roomName) {
				$goods_code       = $postData['product_idx'][$key] ?? 'N/A';  // tbl_product_mst
				$g_idx            = $postData['g_idx'][$key] ?? 'N/A';        // tbl_room
				$rooms_idx        = $postData['rooms_idx'][$key] ?? 'N/A';    // tbl_hotel_rooms
				$room_name        = $postData['room_name'][$key] ?? 'N/A';    // 룸 명칭
				$o_sdate          = $postData['o_sdate'][$key] ?? 'N/A';      // 시작일자
                $o_edate          = $postData['o_edate'][$key] ?? 'N/A';      // 종료일자					
				$goods_price1     = $postData['goods_price1'][$key] ?? 'N/A'; // 기본가
				$goods_price2     = $postData['goods_price2'][$key] ?? 'N/A'; // 컨택가
				$goods_price3     = $postData['goods_price3'][$key] ?? 'N/A'; // 수익
				$goods_price4     = $postData['goods_price4'][$key] ?? 'N/A'; // 수익
				$goods_price5     = $postData['goods_price5'][$key] ?? 'N/A'; // 수익
				$secret_price     = $postData['secret_price'][$key] ?? '';    // 비밀특가
				$special_discount = $postData['special_discount'][$key] ?? '';    // 특별할인 노출여부
				$discount_rate    = $postData['discount_rate'][$key] ?? '';    // 특별할인율(%)
				$price_view       = $postData['price_view'][$key] ?? 'N/A';   // 가격노출
				$breakfast        = $postData['breakfast'][$key];             // 조식포함 여부
				$adult            = $postData['adult'][$key];                 // 성인
				$kids             = $postData['kids'][$key];                  // 아동

				$is_view_promotion = $postData['is_view_promotion'][$key] ?? 'N';                  

				$r_contents1      = $postData['r_contents1'][$key];
				$r_contents2      = $postData['r_contents2'][$key];                 
				$r_contents3      = $postData['r_contents3'][$key];
				
				$bed_idx  = $postData['bed_idx'][$key] ?? [];  // 베드 IDX
				$bed_num  = $postData['bed_num'][$key] ?? []; // 베드타입
				$bed_type = $postData['bed_type'][$key] ?? []; // 베드타입
				$bed_type_eng = $postData['bed_type_eng'][$key] ?? []; // 베드타입
				$price1   = $postData['price1'][$key] ?? []; // 베드타입
				$price2   = $postData['price2'][$key] ?? []; // 베드타입
				$price3   = $postData['price3'][$key] ?? []; // 베드타입
				$price4   = $postData['price4'][$key] ?? []; // 베드타입
				$price5   = $postData['price5'][$key] ?? []; // 베드타입
				$bed_seq  = $postData['bed_seq'][$key] ?? [];  // 정렬순서

				// 배열인지 확인 후 처리
				if (!is_array($bed_idx)) {
					$bed_idx = [$bed_idx];  // 배열이 아니면 배열로 변환
				}
				if (!is_array($bed_seq)) {
					$bed_num = [$bed_num];  // 배열이 아니면 배열로 변환
				}
				if (!is_array($bed_type)) {
					$bed_type = [$bed_type];
				}
				if (!is_array($bed_type_eng)) {
					$bed_type_eng = [$bed_type_eng];
				}
				if (!is_array($price1)) {
					$price1 = [$price1];
				}
				if (!is_array($price2)) {
					$price2 = [$price2];
				}
				if (!is_array($price3)) {
					$price3 = [$price3];
				}
				if (!is_array($price4)) {
					$price4 = [$price4];
				}
				if (!is_array($price5)) {
					$price5 = [$price5];
				}
				if (!is_array($bed_seq)) {
					$bed_seq = [$bed_seq];
				}

				for ($i = 0; $i < count($bed_idx); $i++) {
					if (!empty($bed_idx[$i])) {
						
						//write_log("bed_idx- ". $bed_idx[$i]);
						
						$price1[$i] = str_replace(",", "", $price1[$i]); // 콤마 제거
						$price2[$i] = str_replace(",", "", $price2[$i]); // 콤마 제거
						$price3[$i] = str_replace(",", "", $price3[$i]); // 콤마 제거
						$price4[$i] = str_replace(",", "", $price4[$i]); // 콤마 제거
						$price5[$i] = str_replace(",", "", $price5[$i]); // 콤마 제거
					
						$sql_bed = "UPDATE tbl_room_beds 
									SET bed_type       = ?,
									    bed_type_eng   = ?, 
										bed_seq        = ?, 
										goods_price1   = ?, 
										goods_price2   = ?, 
										goods_price3   = ?, 
										goods_price4   = ?, 
										goods_price5   = ? 
									WHERE bed_idx = ?";

						//write_log("SQL 실행: " . $sql_bed . " 값: [" . $bed_type[$i] . ", " . $bed_type_eng[$i] . ", " . $bed_seq[$i] . ", " . $price1[$i] . ", " . $price2[$i] . ", " . $price3[$i] . ", " . $price4[$i] . ", " . $price5[$i] . "]");

						$db->query($sql_bed, [$bed_type[$i], $bed_type_eng[$i], $bed_num[$i], $price1[$i], $price2[$i], $price3[$i], $price4[$i], $price5[$i], $bed_idx[$i]]);

						// 마지막 실행된 쿼리 출력
						//write_log("hotel_room_allupdate- ". $db->getLastQuery());	
						
						$sql_c = "UPDATE tbl_room_price  SET  
																 goods_price1 = '". $price1[$i] ."'	
																,goods_price2 = '". $price2[$i] ."'
																,goods_price3 = '". $price3[$i] ."'
																,goods_price4 = '". $price4[$i] ."'
																,goods_price5 = '". $price5[$i] ."'
																,upd_date     = now() 
																 WHERE 
																 product_idx  = '". $goods_code ."' AND 
																 g_idx        = '". $g_idx ."'      AND 
																 rooms_idx    = '". $rooms_idx ."'  AND 
																 upd_yn      != 'Y'                 AND 
																 bed_idx      = '". $bed_idx[$i] ."' ";
																
						//write_log("객실가격정보-x : " . $sql_c);
						$db->query($sql_c);
					}
				}

 
				$option_val       = $postData['option_val'][$key] ?? [];     // 옵션 내용
				$option_val       = implode(',', $option_val);
                $option_val       = htmlspecialchars($option_val, ENT_QUOTES);				

				if($rooms_idx) {
				   $sql = " UPDATE tbl_hotel_rooms  SET goods_code   = '$goods_code'
													   ,room_name    = '$room_name'
													   ,baht_thai    = '$baht_thai' 
													   ,goods_price1 = '$goods_price1'
													   ,goods_price2 = '$goods_price2'
													   ,goods_price3 = '$goods_price3'
													   ,goods_price4 = '$goods_price4'
													   ,goods_price5 = '$goods_price5'
													   ,secret_price = '$secret_price'
													   ,special_discount = '$special_discount'
													   ,discount_rate    = '$discount_rate'
													   ,price_view   = '$price_view'
													   ,breakfast    = '$breakfast'
													   ,adult        = '$adult'
												  	   ,kids         = '$kids'
													   ,bed_type     = '$bed_type'
													   ,bed_type_eng = '$bed_type_eng'
													   ,bed_price    = '$bed_price'
													   ,option_val   = '$option_val'
													   ,price_secret = '$price_secret'
													   ,o_sdate      = '$o_sdate'
													   ,o_edate      = '$o_edate'
													   ,is_view_promotion = '$is_view_promotion'
													   ,r_contents1  = '$r_contents1'
													   ,r_contents2  = '$r_contents2'
													   ,r_contents3  = '$r_contents3'
													   ,upd_date     = now() WHERE rooms_idx = '$rooms_idx' ";
				} else {
				   $sql = " INSERT INTO tbl_hotel_rooms SET g_idx        = '$g_idx'
                                                           ,goods_code   = '$goods_code'
														   ,room_name    = '$room_name'
													       ,baht_thai    = '$baht_thai' 
														   ,goods_price1 = '$goods_price1'
														   ,goods_price2 = '$goods_price2'
														   ,goods_price3 = '$goods_price3'
														   ,goods_price4 = '$goods_price4'
														   ,secret_price = '$secret_price'
													       ,special_discount = '$special_discount'
													       ,discount_rate    = '$discount_rate'
														   ,price_view   = '$price_view'
														   ,breakfast    = '$breakfast'
														   ,adult        = '$adult'
														   ,kids         = '$kids'
														   ,bed_type     = '$bed_type'
														   ,bed_type_eng = '$bed_type_eng'
														   ,bed_price    = '$bed_price'
														   ,option_val   = '$option_val'
														   ,price_secret = '$price_secret'
														   ,o_sdate      = '$o_sdate'
														   ,o_edate      = '$o_edate'
													   	   ,is_view_promotion = '$is_view_promotion'
														   ,r_contents1  = '$r_contents1'
														   ,r_contents2  = '$r_contents2'
														   ,r_contents3  = '$r_contents3'
														   ,reg_date     = now() ";
				}   
				//write_log($sql);
				$result = $db->query($sql);
				
			}
 

 
 			
			if (isset($result) && $result) {
				$msg = "룸 가격 등록완료";
			} else {
				$msg = "룸 가격 등록오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }
	
    public function hotel_room_search()
	{
            $db             = \Config\Database::connect();
            include_once APPPATH . 'Common/hotelPrice.php';

            $sql           = "SELECT * FROM tbl_code WHERE parent_code_no = '36' AND depth = '2' order by onum asc, code_idx desc"; 
            $fresult11     = $this->db->query($sql);
			$fresult11     = $fresult11->getResultArray();
		
		    $product_idx    = $_POST['product_idx'];
		    $date_check_in  = $_POST['date_check_in'];
		    $date_check_out = $_POST['date_check_out'];
		    $days           = $_POST['days'];
		    $room_qty       = $_POST['room_qty'];

	        $sql            = "SELECT distinct(g_idx) AS g_idx FROM tbl_hotel_rooms
			                                                   WHERE ('$date_check_in'  BETWEEN o_sdate AND o_edate) AND 
			                                                         ('$date_check_out' BETWEEN o_sdate AND o_edate) AND  
																	 goods_code = '". $product_idx ."' ORDER BY g_idx ASC ";
            //write_log("hotel_room_search-1 ". $sql);							 
            $roomTypes      = $db->query($sql);
            $roomTypes      = $roomTypes->getResultArray();
			
            $sql            = "SELECT * FROM tbl_hotel_rooms WHERE ('$date_check_in'  BETWEEN o_sdate AND o_edate) AND 
			                                                       ('$date_check_out' BETWEEN o_sdate AND o_edate) AND 
																   goods_code ='". $product_idx ."' ORDER BY g_idx DESC";
            $roomsByType    = $db->query($sql);
            $roomsByType    = $roomsByType->getResultArray();

			$sql            = "SELECT * FROM tbl_code WHERE code_gubun = 'Room facil' AND depth = '2' "; 
            $fresult10      = $db->query($sql);
			$fresult10      = $fresult10->getResultArray();

            $msg = '';
			foreach ($roomTypes as $type): 

                 $sql    = "SELECT * FROM tbl_room WHERE g_idx = '". $type['g_idx'] ."' ";
                 $result = $db->query($sql);
                 $row    = $result->getRowArray();
			     $hotel_room = $row['roomName'];

				 $sql_img    = "SELECT * FROM tbl_room_img WHERE room_idx = '". $type['g_idx'] ."' LIMIT 3";
				 $query_img  = $db->query($sql_img);
				 $result     = $query_img->getResult();

				 // 결과 출력
				 $img_cnt = 0;
				 foreach ($result as $row1) {
					 $img_cnt++;
					 if($img_cnt == 1) {
					    $ufile1 = $row1->ufile;
					 }   

					 if($img_cnt == 2) {
					    $ufile2 = "/uploads/rooms/" . $row1->ufile;
					 }   

					 if($img_cnt == 3) {
					    $ufile3 = "/uploads/rooms/" . $row1->ufile;
					 }   
				 }
				 
				 $msg .= '<div class="card-item-sec3">
								<div class="card-item-container">
									<div class="card-item-left">
										<div class="card-title-sec3-container">
											<h2>'. $row['roomName'] .'</h2>
											<div class="label">'. $row['scenery'] .'</div>
										</div>
										<div class="only_web">
											<div class="grid2_2_1">
												<img src="/uploads/rooms/'. $ufile1 .'" style="width: 285px; border: 1px solid #dbdbdb; height: 190px" onclick="fn_pops(\''.$row['g_idx'].'\', \''. $row['roomName']. '\')" onerror="this.src=\'/images/share/noimg.png\'" alt="'. $row['roomName'] .'">
												
												<div class="" style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%">
													<img class="imageDetailOption_"
														src="'. $ufile2 .'"
														onclick="fn_pops(\''.$row['g_idx'].'\', \''. $row['roomName']. '\')"
														onerror="this.src=\'/images/share/noimg.png\'" alt="'. $row['roomName'] .'">

													<img class="imageDetailOption_"
														src="'. $ufile3 .'"
														onclick="fn_pops(\''.$row['g_idx'].'\', \''. $row['roomName']. '\')"
														onerror="this.src=\'/images/share/noimg.png\'" alt="'. $row['roomName'] .'">
												</div>
								
											</div>
										</div>
										<div class="grid2_2_1_m only_mo">
											<img src="/uploads/rooms/'. $ufile1 .'" alt="hotel_item_1_1" onerror="this.src=\'/images/share/noimg.png\'">
										</div>
										<div class="wrap_btn_detail">
                                             <a href="javascript:showPopupRoom(\'' . $type['g_idx'] . '\')">객실 상세정보 및 사진 ></a>
                                        </div>
									</div>									
										'; 

                    
                            $arr_type_room = explode("|", $row['category']);
                            $arr_text_type = [];
                            foreach($fresult11 as $category){
                                if(in_array($category["code_no"], $arr_type_room)){
                                    $arr_text_type[] = $category["code_name"];
                                }
                            }
                        
							$msg .= '
							<div>
							<div class="area_info">
								<div class="pallet child">
									<div class="icon">
										<i></i>
										<img src="/images/sub/question-icon.png" alt="" 
											onclick="showPolicyRoom();"
											style="width : 14px; margin-top : 4px ; opacity: 0.6; cursor: pointer;">
									</div>
									<div class="content">'.  implode(" · ", $arr_text_type) .'</div>
								</div>   
								   
								<div class="extent child">
									<div class="icon">
										<i></i>
									</div>
									<div class="content">'. $row['extent'] .
										'<span class="unit">m</span>
									</div>
								</div>

								<div class="floor child">
									<div class="icon">
										<i></i>
									</div>
									<div class="content">'. $row['floor'] .'
										<span> 층</span>
									</div>
								</div>
							</div>
						<table class="room-table">
							<colgroup>
								<col width="30%">
								<col width="15%">
								<col width="*">
							</colgroup>
							<thead>
								<tr>
									<th>옵션 상세</th>
									<th>정원</th>
									<th>객실 요금</th>
								</tr>
							</thead>
							<tbody>';

							$target_g_idx  = $type['g_idx']; // 원하는 g_idx 값 (예: 1번 그룹만 표시)
							$filteredRooms = array_filter($roomsByType, function($room) use ($target_g_idx) {
								return $room['g_idx'] == $target_g_idx;
							});
										
						                foreach ($filteredRooms as $room): 
												 $msg .= '<tr class="room_op_" data-room="'. $room['rooms_idx'] .'" data-g_idx="'. $room['g_idx'] .'" data-opid="149" data-optype="S" data-ho_idx="'. $row['goods_code'] .'">';
												 $msg .= '<input type="hidden" class="r_contents2" value="' . $room['r_contents2'] . '">';
												 $msg .= '<input type="hidden" class="r_contents3" value="' . $room['r_contents3'] . '">';
										
												 $msg .= '<td>
																	<div class="room-details">
																		<p class="room-p-cus-1">'. $room['room_name'] .'</p>';
																		
																		if($room['breakfast'] != "N") {
																		   $breakfast = "조식 포함";
																		} else {
																		   $breakfast = "조식 비포함";	
																		}   
																		
																		$option_val = explode(",", $room['option_val']);
																		
																		$msg .= '<ul>
																			<li><span>'. $breakfast .'</span> <img src="/images/sub/question-icon.png" alt="" style="width : 14px; height : 14px; margin-top : 4px ; opacity: 0.6;"></li>';
											
																		for($i=0;$i<count($option_val);$i++) { 
																			$msg .= '<li>'. htmlspecialchars_decode($option_val[$i]) .'</li>';
																		} 
																			
																		$msg .= '</ul>
																	             </div>
																</td>'; 															
 
												$msg .= '<td>
													<div class="people_qty">
														<img src="/images/sub/user-iconn.png" alt="">
														<p>성인 : ' . $room['adult'] . '명</p>
														<p>아동 : ' . $room['kids'] . '명</p>';
														
														if (!empty($room['r_contents2'])) {
															$msg .= '<a href="javascript:viewBenefitPopup(' . $room['rooms_idx'] . ');" style="color: #104aa8">혜택보기 &gt;</a>';
														}

												$msg .= '</div>
													</td>';



												$result    = depositPrice($db, $room['goods_code'], $room['g_idx'], $room['rooms_idx'], $date_check_in, $days);
											  
												$arr       = explode("|", $result);
												$room['goods_price1']  = $arr[0];											
												$room['goods_price2']  = $arr[1];											
												$room['goods_price3']  = $arr[2];											
												$room['goods_price4']  = $arr[3];											
												$room['goods_price5']  = $arr[4];											
                                                $baht_thai             = $arr[5];
												
												$basic_won  =  (int)($room['goods_price1'] * (int)($room_qty) * $baht_thai);
												$basic_bath =  $room['goods_price1'] * (int)($room_qty);
											
												$price_won  =  (int)(($room['goods_price2'] + $room['goods_price3']) * (int)($room_qty) * $baht_thai);
												$price_bath =  ($room['goods_price2'] + $room['goods_price3']) * (int)($room_qty);
															
												$msg .= '<td>
														<div class="col_wrap_room_rates">';
											
												if($room['secret_price'] == "Y"){		
													
													$msg .= '<div class="price-secret">
																<span>비밀특가</span>
																<img src="/images/sub/question-icon.png" alt="" style="width : 14px ; opacity: 0.6;">
																<div class="layer_secret">
																	<b style="color: #ef4337 ;">회원 전용 특가상품</b> 
																	<br>  
																	로그인 하시고 특가요금 확인하세요!
																</div>
															</div>';
												}else{
													$msg .=		'<div class="price-details">
																	<p style="">
																		<span class="price totalPrice" id="149" data-price="'. $price_won .'" data-price_bath="'. $price_bath .'">';

													if($room['price_view'] == "") {  
													$msg .= '<span class="op_price">'. number_format($price_won) .'</span><span>원</span> 
																<span class="price_bath">('. number_format($price_bath) .'바트)</span>';
													} 
													
													if($room['price_view'] == "W") {  
													$msg .= '<span class="op_price">'. number_format($price_won) .'</span><span>원</span>';
													} 

													if($room['price_view'] == "B") {  
													$msg .= '<span class="op_price">'. number_format($price_bath) .'바트</span>';
													} 
													$msg .= '</span></p>';
													$xxx  = "data- ". $room['goods_code'] .":". $room['g_idx'] .":". $room['rooms_idx'];
													$msg .= '<span class="total" style="">객실금액: <span class="price-strike hotel_price_sale" data-price="'. $basic_won .'">'. number_format($basic_won) .'원</span>
																<span class="price-strike hotel_price_day_sale" data-price="'. $basic_bath .'">('. number_format($basic_bath) .'바트)</span> 
															</span>';
													
													if($room['special_discount'] == "Y") {  	
														$msg .= '<div class="discount" style="">
																<span class="label">특별할인</span>
																<span class="price_content"><i class="hotel_price_percent">'. $room['discount_rate'] .'</i>%할인</span>
																</div>';
													}  
													$msg .= '</div></div>';
												}
												
		
												//write_log($room['goods_code']."-".$room['g_idx']."-".$room['rooms_idx']."-".$date_check_in."-".$days);		
												$result    = detailPrice($db, $room['goods_code'], $room['g_idx'], $room['rooms_idx'], $date_check_in, $days);
											    //write_log("11111111- ". $result);
												$msg .= '<div class="wrap_bed_type">
															<div class="tit">
																<span>침대타입(요청사항)</span>
																<div class="view_promotion view_promotion2"> 
																	<img src="/images/sub/question-icon.png" alt="" style="width : 14px ; opacity: 0.6;">';
																
                                                if(!empty(trim($room['r_contents3']))) {  
													$msg .= '<div class="layer_promotion layer_promotion2">
																<p style="white-space: pre-line">'. $room['r_contents3'] .'</p>
															</div>';   
												}
												$msg .=			'</div>
																<p class="wrap_btn_book_note">세금서비스비용 포함</p>
															</div>
														<div class="wrap_input_radio">';

												$arr  = explode("|", $result); // 침대타입(요청사항)킹베드 더블:3:3:6:9:12:42.41|
												
												for($i=0;$i<count($arr);$i++)
		                                        {	 
													 $_room     =  explode(":", $arr[$i]);
													 $baht_thai =  $_room[6];
													 $real_won  =  (int)(($_room[3] + $_room[4]) * (int)($room_qty) * $baht_thai);
													 //$extra_won =  $_room[5];
													 $real_bath =  ($_room[3] + $_room[4]) * (int)($room_qty);
													 $bed_idx   =  $_room[1];
													 //write_log("AjaxCFontroller- ". $room['goods_code'].":".$room['g_idx'].":".$room['rooms_idx'].":".$date_check_in.":".$days.":".$bed_idx);
													 $result_d  = detailBedPrice($db, $room['goods_code'], $room['g_idx'], $room['rooms_idx'], $date_check_in, $days, $bed_idx);
                                                     //write_log("222222- ". $result_d);
												     $msg .= '<div class="wrap_input" style="margin-bottom: 10px;">
															  <input type="radio" name="bed_type_" 
																  id="bed_type_'. $room['g_idx'].$room['rooms_idx'].$bed_idx .'" 
																  data-id="'. $room['g_idx'].$room['rooms_idx'].$bed_idx .'" 
																  data-room="'. $hotel_room .'" 
																  data-price="'. $result_d .'"  
																  data-adult="'. $room['adult'] .'" 
																  data-kids="'. $room['kids'] .'"  
																  data-roomtype="'. $room['room_name'] .'" 
																  data-breakfast="'. $room['breakfast'] .'" 
																  data-won="'. $real_won .'" 
																  data-bath="'. $real_bath .'" 
																  data-type="'. $_room[0] .'" 
																  data-bed_idx="'. $_room[1] .'" 
																  data-g_idx="'. $room['g_idx'] .'" 
																  value="'. $room['rooms_idx'] .'" 
																  class="sel_'. $room['rooms_idx'] .'">
															  <label for="bed_type_'. $room['g_idx'] . $room['rooms_idx'] . $bed_idx .'">'.$_room[0] .':';
													 
													 if($room['secret_price'] == "Y"){
																$msg .=		'<span>비밀특가</span>';
													 }else{
														$msg .=	' <span style="color :coral">'. number_format($real_won) .'원 ('.  number_format($real_bath) .'바트)</span></label>';
													 }
													 $msg .= '</div>';
													 
													 if($_room[5] > 0) {
														  $extra_won  = (int)($_room[5] * (int)($room_qty) * $baht_thai);
														  $extra_bath = $_room[5] * (int)($room_qty);	  
												    	  $msg .= '<div class="wrap_check extra" id="chk_'. $room['g_idx'].$room['rooms_idx'].$bed_idx .'"  style="display:none; padding-left: 20px; margin-bottom: 20px; margin-top: 10px;">';
													      $msg .= '<input type="checkbox" 
														            name="extra_" 
																	id="extra_'. $room['g_idx'].$room['rooms_idx'].$bed_idx .'" 
																	data-id="'.$room['g_idx'].$room['rooms_idx'].$bed_idx .'"
																	data-g_idx="'.$room['g_idx'].'"
																    data-name="Extra베드" data-won="'. $extra_won .'" data-bath="'. $extra_bath .'" value="'. $room['rooms_idx'] .'" >';
													      $msg .= '<label for="extra_'. $room['g_idx'].$room['rooms_idx'].$bed_idx .'" >Extra 베드: <span style="color :coral">'. number_format($extra_won) .'원 ('.  number_format($extra_bath) .'바트)</span></label>';
													      $msg .= '</div>';
													 }
													 
													 
											    } 
												  
												//if($extra_won > 0) {
												//	  $msg .= '<div class="wrap_check">';
												//	  $msg .= '<input type="checkbox" name="extra_" id="extra_'. $room['g_idx'].$room['rooms_idx'].$i .'" 
												//				data-name="Extra베드" data-won="'. $extra_won .'" data-bath="'. $extra_bath .'" value="'. $room['rooms_idx'] .'" >';
												//	  $msg .= '<label for="extra_'. $room['g_idx'].$room['rooms_idx'].$i .'" >Extra 베드: <span style="color :coral">'. number_format($extra_won) .'원 ('.  number_format($extra_bath) .'바트)</span></label>';
												//	  $msg .= '</div>';
                                                //}
												  
												$msg .= '</div>
														   </div>';

												if($price_won > 0) {  
													$msg .=	'<div class="wrap_btn_book">
																<div class="flex__c btn_re">
																	<button type="button" id="reserv_'. $room['rooms_idx'] .'" data-yes="Y" data-idx="'. $room['rooms_idx'] .'" class="reservation book-button book_btn_217" >예약하기</button>
																	<button type="button" data-idx="'. $room['rooms_idx'] .'" class="reservationx book-add-cart">장바구니</button>
                                                    				<button type="button" id="contact_'. $room['rooms_idx'] .'" class="reservationx contact-button default-button">문의하기</button>
																</div>
															</div>
															';
												} else {
													$msg .=	'<div class="wrap_btn_book">
																<button type="button" id="reserv_'. $room['rooms_idx'] .'" data-yes="N" data-idx="'. $room['rooms_idx'] .'" class="reservation book-button disabled" >문의하기</button>
                                                    			<button type="button" id="contact_'. $room['rooms_idx'] .'" class="reservationx contact-button default-button">문의하기</button>
															</div>';
												}			   
												$msg .=		   '</td>
														   </tr>';
                             			endforeach; 

										$msg .= '</tbody>
									</table>
									</div>
								</div>
							</div>'; 
			endforeach; 

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);		
    }
	
	public function golf_price_update()   
    {
            $db           = \Config\Database::connect();
            
			$product_idx  = $_POST['product_idx'];
			$idx          = $_POST['idx'];
			$price_1        = str_replace(',', '', $_POST['price_1']);
			$price_2        = str_replace(',', '', $_POST['price_2']);
			$price_3        = str_replace(',', '', $_POST['price_3']);
			$use_yn       = $_POST['use_yn'];
/*
			$sql          = "SELECT * FROM tbl_golf_option WHERE product_idx = '". $product_idx ."' AND
  			                                                     hole_cnt    = '". $hole_cnt    ."' AND
																 hour        = '". $hour        ."' AND  
																 minute      = '". $minute     ."' ";
            write_log("1- ". $sal);
            $result       = $db->query($sql);
            $nTotalCount  = $result->getNumRows();

		    if($nTotalCount == 0) {
				$sql = "INSERT INTO tbl_golf_option SET product_idx	  = '". $product_idx ."'	
  			                                           ,hole_cnt      = '". $hole_cnt    ."'  
													   ,hour          = '". $hour        ."'  
													   ,minute        = '". $minute     ."'  
													   ,option_price  = '0'	
													   ,option_price1 = '0'
													   ,option_price2 = '0'	
													   ,option_price3 = '0'	
													   ,option_price4 = '0'	
													   ,option_price5 = '0'	
													   ,option_price6 = '0'	
													   ,option_price7 = '0'	
													   ,option_cnt	  = '0'
													   ,use_yn	      = 'Y'	
													   ,afile	      = ''
													   ,bfile	      = ''	
													   ,option_type	  = 'M'	
													   ,onum	      = '0'	
													   ,rdate	      = now()	
													   ,caddy_fee	  = ''
													   ,cart_pie_fee  = '' ";
				write_log($sql);
				$result = $db->query($sql);

				$sql_opt    = "SELECT LAST_INSERT_ID() AS last_id";
				$option     = $db->query($sql_opt)->getRowArray();
				$o_idx      = $option['last_id'];
            } else {
				$o_idx      = "";
            }

            if($o_idx) {
				$sql = "UPDATE tbl_golf_price SET  o_idx        = '". $o_idx    ."'    
												 , hole_cnt     = '". $hole_cnt    ."'  
												 , hour         = '". $hour        ."'  
												 , minute       = '". $minute     ."'  
												 , option_price = '". $option_price ."'
												 , caddy_fee    = '". $caddy_fee ."'
												 , cart_pie_fee = '". $cart_pie_fee ."'
												 , use_yn       = '". $use_yn ."'
												 , upd_date     = now() WHERE idx = '". $idx ."'  ";
			} else {
*/
				$sql = "UPDATE tbl_golf_price SET  price_1      = '". $price_1 ."'
				                                 , price_2      = '". $price_2 ."'
												 , price_3      = '". $price_3 ."'
												 , use_yn       = '". $use_yn ."'
												 , upd_date     = now() WHERE idx = '". $idx ."'  ";
//			}

			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "가격 수정완료";
			} else {
				$msg = "가격 수정오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }

    public function golf_option_delete()
    {
            $db    = \Config\Database::connect();

            $idx   = $_POST['idx'];
			
			$sql = "DELETE FROM tbl_golf_option WHERE idx = '". $idx ."'  ";
			//write_log($sql);
			$result = $db->query($sql);

			$sql = "DELETE FROM tbl_golf_price WHERE o_idx = '". $idx ."'  ";
			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "가격 삭제완료";
			} else {
				$msg = "가격 식제오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
		
    }

	public function golf_price_delete()   
    {
            $db    = \Config\Database::connect();

            $idx          = $_POST['idx'];
			
			$sql = "DELETE FROM tbl_golf_price WHERE idx = '". $idx ."'  ";
			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "가격 삭제완료";
			} else {
				$msg = "가격 식제오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }

	public function golf_dow_update()   
    {
            $db    = \Config\Database::connect();

			//$o_idx    = $_POST['o_idx'];
			$product_idx    = $_POST['product_idx'];
			$dow_val  = $_POST['dow_val'];
			
			if($dow_val == "") {
			   $sql    = " UPDATE tbl_golf_price SET use_yn = 'Y'  WHERE product_idx = '$product_idx' ";
            } else {
			   $sql    = " UPDATE tbl_golf_price SET use_yn = 'N'  WHERE dow in($dow_val) AND product_idx = '$product_idx' ";
            }
			//write_log("dow_val- ". $dow_val);
			$result = $db->query($sql);

			if($result) {
			   $msg = "수정 완료";
			} else {
			   $msg = "수정 오류";	
			}   

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg
				]);
    }


	public function golf_dow_charge()   
    {
            $db    = \Config\Database::connect();

			$s_date      = $this->request->getPost('s_date');
			$e_date      = $this->request->getPost('e_date');
			//$o_idx    = $this->request->getPost('o_idx');
			$product_idx = $this->request->getPost('product_idx');
    		$holesStr    = $this->request->getPost("holes");
			$dow_val     = $this->request->getPost('dow_val');
			$price_1     = $this->request->getPost('price_1');
			$price_2     = $this->request->getPost('price_2');
			$price_3     = $this->request->getPost('price_3');

			if($holesStr) { 
				$arr_name = explode(",", $holesStr);
				$placeholders = "";
				for($i=0;$i<count($arr_name);$i++)
				{
					if($placeholders == "") {
					   $placeholders  = "'". $arr_name[$i] ."'";
					} else {  
					   $placeholders .= ",'". $arr_name[$i] ."'";
					}   
				}	

				if($placeholders) $search = " AND goods_name IN (" . $placeholders . ")";
			}
		
		    $sql    = " UPDATE tbl_golf_price SET 
			                                   price_1 = '". $price_1 ."'  
			                                  ,price_2 = '". $price_2 ."'  
			                                  ,price_3 = '". $price_3 ."'  
			            WHERE dow in($dow_val) 
						AND product_idx = '$product_idx' 
						$search
						AND goods_date >= '". $s_date ."'
						AND goods_date <= '". $e_date ."' ";
			
			//write_log("golf_dow_charge- ". $sql);
			$result = $db->query($sql);

			if($result) {
			   $msg = "수정 완료";
			} else {
			   $msg = "수정 오류";	
			}   

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg
				]);
    }

    public function hotel_price_pageupdate()
    {
            $db    = \Config\Database::connect();

            $idx          = $_POST['idx'];
            $goods_price1 = $_POST['goods_price1'];
            $goods_price2 = $_POST['goods_price2'];
            $goods_price3 = $_POST['goods_price3'];
            $goods_price4 = $_POST['goods_price4'];
			$use_yn       = $_POST['use_yn'];
			$updateData   = explode("|", $_POST['updateData']);

            for($i=0;$i<count($updateData);$i++)
		    { 
				    $arr     = explode(":", $updateData[$i]); 
					$idx     = $arr[0];
					$use_yn  = $arr[1];
					$sql1    = "UPDATE tbl_room_price SET use_yn = '". $use_yn ."' 
					                                     ,upd_yn = 'Y'
					                                 WHERE idx = '". $idx ."'  ";
					$result1 = $db->query($sql1);
			
			}
 			
            for($i=0;$i<count($idx);$i++)
		    { 
				    $price1 = str_replace(",", "", $goods_price1[$i]); // 콤마 제거
				    $price2 = str_replace(",", "", $goods_price2[$i]); // 콤마 제거
				    $price3 = str_replace(",", "", $goods_price3[$i]); // 콤마 제거
				    $price4 = str_replace(",", "", $goods_price4[$i]); // 콤마 제거

					$sql  = "UPDATE tbl_room_price SET  goods_price1 = '". $price1 ."' 
					                                   ,goods_price2 = '". $price2 ."'
													   ,goods_price3 = '". $price3 ."'
													   ,goods_price4 = '". $price4 ."'
													   ,upd_yn       = 'Y' WHERE idx = '". $idx[$i] ."'  ";
					$result = $db->query($sql);
            }
             
			if (isset($result) && $result) {
				$msg = "가격 수정완료";
			} else {
				$msg = "가격 수정오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }
	
	public function golf_price_allupdate()   
    {
            $db    = \Config\Database::connect();

            $product_idx  = $_POST['product_idx'];
            $idx          = $_POST['idx'];

			$price_1      = str_replace(',', '', $_POST['price_1']);
			$price_2      = str_replace(',', '', $_POST['price_2']);
			$price_3      = str_replace(',', '', $_POST['price_3']);
			$chk_idx      = explode(",", $_POST['chk_idx']);
            for($i=0;$i<count($chk_idx);$i++)
		    { 
                    $use  = explode(":", $chk_idx[$i]);
					$sql  = "UPDATE tbl_golf_price SET  use_yn    = '". $use[1] ."' WHERE idx = '". $use[0] ."'  ";
					$result = $db->query($sql);
            }
            
            for($i=0;$i<count($idx);$i++)
		    {

                    if (isset($use_yn[$i])) {
						$use = "N";
                    } else {
						$use = "";
                    }

					$sql = "UPDATE tbl_golf_price SET  price_1     = '". $price_1[$i]    ."' 
				                                     , price_2     = '". $price_2[$i]    ."'  	
				                                     , price_3     = '". $price_3[$i]    ."'  	
													 , upd_date     = now() WHERE idx = '". $idx[$i] ."'  ";

					$result = $db->query($sql);
            }

			if (isset($result) && $result) {
				$msg = "가격 등록완료";
			} else {
				$msg = "가격 등록오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }

	public function golf_price_add()
    {
		    $db = \Config\Database::connect(); // 데이터베이스 연결

		    $product_idx = $_POST['product_idx'];
		    $o_idx       = $_POST['o_idx'];
		    $to_date     = $_POST['a_date'];

			$query       = $db->query("SELECT DATE_ADD(MAX(goods_date), INTERVAL 1 DAY) AS next_date 
									   FROM tbl_golf_price 
									   WHERE o_idx = '" . $o_idx . "'");
			$row         = $query->getRow();
			$from_date   = $row->next_date;
 		
			$sql    = "SELECT * FROM tbl_golf_price WHERE product_idx = '$product_idx' AND o_idx = '$o_idx' ORDER BY goods_date desc limit 0,1 ";
			$result = $db->query($sql)->getResultArray();
			foreach($result as $row)
		    { 
				      //write_log($row['o_idx'] ." - ". $row['goods_date']); 
					  $o_idx       = $row['o_idx'];
					  $goods_name  = $row['goods_name'];  
		    }
 
			// 결과 출력
            //$from_date   = day_after($from_date, 1);
            //$to_date     = day_after($from_date, $days-1);
			$dateRange   = getDateRange($from_date, $to_date);

			$ii = -1;
			foreach ($dateRange as $date) 
			{ 
				$ii++;
		 
				$goods_date = $dateRange[$ii];
				$dow        = dateToYoil($goods_date);

				$sql_p = "INSERT INTO tbl_golf_price  SET  
													  o_idx        = '". $o_idx ."' 	
													 ,goods_date   = '". $goods_date ."' 	
													 ,dow 	       = '". $dow ."'
													 ,product_idx  = '". $product_idx ."' 
													 ,goods_name   = '". $goods_name ."' 
													 ,price        = '0'
													 ,day_yn       = ''
													 ,day_price    = '0'
													 ,night_yn     = 'Y'
													 ,night_price  = '0'
													 ,use_yn       = ''	
													 ,caddy_fee    = ''
													 ,cart_pie_fee = ''
													 ,reg_date     = now() ";
                //write_log($sql_p); 													 
				$result = $db->query($sql_p);
			} 
 
			// 골프가격 시작일
			$sql     = "SELECT * FROM tbl_golf_price WHERE product_idx = '". $product_idx ."' AND o_idx = '". $o_idx ."' ORDER BY goods_date ASC LIMIT 0,1";
			$result  = $db->query($sql);
			$result  = $result->getResultArray();
			foreach ($result as $row) 
			{
					 $s_date = $row['goods_date']; 
			}

			// 골프가격 종료일
			$sql     =  "SELECT * FROM tbl_golf_price WHERE product_idx = '". $product_idx ."' AND o_idx = '". $o_idx ."' ORDER BY goods_date DESC LIMIT 0,1";
			$result  = $db->query($sql);
			$result  = $result->getResultArray();
			foreach ($result as $row) 
			{
					 $e_date = $row['goods_date']; 
			}

			$sql_o = "UPDATE tbl_golf_option  SET o_sdate = '". $s_date."'   
										  	    , o_edate = '". $e_date ."' WHERE idx = '". $o_idx ."' "; 
            //write_log($sql_o);											   
			$result = $db->query($sql_o);
 
			if (isset($result) && $result) {
				$msg = "일정 추가완료";
			} else {
				$msg = "일정 추가오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg,
					's_date'  => $from_date,
					'e_date'  => $to_date
				]);

    }

	public function room_price_update()   
    {
            $db           = \Config\Database::connect();

			$idx          = $_POST['idx'];
			$goods_price1 = str_replace(',', '', $_POST['goods_price1']);
			$goods_price2 = str_replace(',', '', $_POST['goods_price2']);
			$goods_price3 = str_replace(',', '', $_POST['goods_price3']);
			$goods_price4 = str_replace(',', '', $_POST['goods_price4']);
			$goods_price5 = str_replace(',', '', $_POST['goods_price5']);
			$use_yn       = $_POST['use_yn'];	
			
			$sql = "UPDATE tbl_room_price SET goods_price1 = '$goods_price1'
			                                , goods_price2 = '$goods_price2'
											, goods_price3 = '$goods_price3'
											, goods_price4 = '$goods_price4'
											, goods_price5 = '$goods_price5'
											, upd_date     =  now()
											, use_yn       = '$use_yn' WHERE idx = '$idx' ";
			//write_log($sql);
			$result = $db->query($sql);

			if (isset($result) && $result) {
				$msg = "가격 수정완료";
			} else {
				$msg = "가격 수정오류";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status' => 'success',
					'message' => $msg
				]);
    }


	public function update_upd_yn()   
	{
		$db = \Config\Database::connect();

		// POST 데이터 가져오기
		$idx    = $this->request->getPost('idx');
		$upd_yn = $this->request->getPost('upd_yn');

		// idx 값이 없으면 오류 반환
		if (!$idx) {
			return $this->response
				->setStatusCode(400)
				->setJSON(['status' => 'error', 'message' => 'Invalid ID']);
		}

		// 데이터 업데이트
		$result = $db->table('tbl_room_price')
					 ->where('idx', $idx)
					 ->update([
						 'upd_yn'   => $upd_yn,
						 'upd_date' => date('Y-m-d H:i:s') // 현재 시간 설정
					 ]);

		return $this->response
			->setStatusCode(200)
			->setJSON([
				'status'  => $result ? 'success' : 'error',
				'message' => $result ? '수정완료' : '수정오류'
			]);
	}

	
	public function hotel_dow_charge()   
    {
            $db    = \Config\Database::connect();

			$uncheck  = $this->request->getPost('uncheck');

			// POST 데이터 받아오기
			$s_date        = $_POST['s_date'];
			$e_date        = $_POST['e_date'];  
			$bed_val       = $_POST['bed_val'];
			$dow_val       = $_POST['dow_val'];
			$product_idx   = $_POST['product_idx'];
			$g_idx         = $_POST['g_idx'];
			$roomIdx       = $_POST['roomIdx'];
			$goods_price1  = $_POST['goods_price1'];
			$goods_price2  = $_POST['goods_price2'];
			$goods_price3  = $_POST['goods_price3'];
			$goods_price5  = $_POST['goods_price5'];
			$goods_price4  = $goods_price2 + $goods_price3;

			//write_log("bed_val". $bed_val);

			// bed_val가 비어 있을 경우 IN() 구문을 제외
			$bed_idx_condition = '';
			if (!empty($bed_val)) {
				$bed_idx_condition = "AND bed_idx IN (". $bed_val .") ";
			}

			// SQL 쿼리 작성
			$sql = "UPDATE tbl_room_price
					SET goods_price1 = '" . $db->escapeString($goods_price1) . "',
						goods_price2 = '" . $db->escapeString($goods_price2) . "',
						goods_price3 = '" . $db->escapeString($goods_price3) . "',
						goods_price4 = '" . $db->escapeString($goods_price4) . "',
						goods_price5 = '" . $db->escapeString($goods_price5) . "',
						upd_date = NOW()
					WHERE dow IN ($dow_val)
					$bed_idx_condition
					AND product_idx = '" . $db->escapeString($product_idx) . "'
					AND g_idx = '" . $db->escapeString($g_idx) . "'
					AND upd_yn != 'Y'
					AND rooms_idx = '" . $db->escapeString($roomIdx) . "'
					AND goods_date BETWEEN '" . $db->escapeString($s_date) . "' AND '" . $db->escapeString($e_date) . "'";

			// 쿼리 실행 전에 로그 출력 (디버깅용)
			//write_log("dow_val- ". $dow_val ." - ". $sql);

			// 쿼리 실행
			$result = $db->query($sql);

			
/*
			$errors   = [];

            $idxs = implode(',', $uncheck);
			
			$sql = "UPDATE tbl_room_price SET 
					upd_yn       = '', 
					upd_date     = now() 
					WHERE idx IN($idxs) ";

			// query() 메서드로 실행
			if (!$db->query($sql)) {
				$errors[] = "Update failed: " . $db->error();
			}			

			$sql    = "SELECT * FROM tbl_room_price WHERE g_idx = '$g_idx' AND rooms_idx = '$roomIdx' ORDER BY goods_date ASC LIMIT 0, 1";
			$row    = $db->query($sql)->getRow();
            $goods_price1 = $row->goods_price1;
            $goods_price2 = $row->goods_price2;
            $goods_price3 = $row->goods_price3;
            $goods_price4 = $row->goods_price4;
			
            $sql          = "	UPDATE tbl_hotel_rooms SET goods_price1 = '". $goods_price1 ."'
			                                              ,goods_price2 = '". $goods_price2 ."'
			                                              ,goods_price3 = '". $goods_price3 ."'
			                                              ,goods_price4 = '". $goods_price4 ."'
			                                              ,goods_price5 = '". $goods_price5 ."'
														  ,upd_date     =     now()  WHERE rooms_idx = '". $roomIdx ."' AND g_idx = '". $g_idx ."'";  
            write_log($sql);
			$result        = $db->query($sql);
*/

			if($result) {
			   $msg = "수정 완료";
			} else {
			   $msg = "수정 오류";	
			}   

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg
				]);
    }
	
	public function memberSession()
    {

        $user_id    = "N_". time();
        $user_name  = "비회원";
		$m_idx      = time();
        $data       = [];

        $data['id']    = $user_id;
        $data['name']  = $user_name;
        $data['idx']   = $m_idx;
        $data["mIdx"]  = $m_idx;
		$data['level'] = "99";

        session()->set("member", $data);


        $output = [
            "message"  => "비회원 로그인"
        ];

		return $this->response->setJSON($output);

    }

	public function check_product_code() {
		$product_code = $this->request->getPost("product_code");

		$count_product_code = $this->productModel->where("product_code", $product_code)->countAllResults();

		if($count_product_code > 0){
			return $this->response->setJSON([
				"result" => false,
				"message" => "이미 있는 상품코드입니다. \n 다시 확인해주시기바랍니다."
			]);
		}else{
			return $this->response->setJSON([
				"result" => true,
				"message" => "사용 가능한 제품 코드"
			]);
		}
	}

	public function cart_payment() {

		    $db = \Config\Database::connect(); // 데이터베이스 연결
		    $setting      = homeSetInfo();
            $baht_thai    = (float)($setting['baht_thai'] ?? 0);

		    $array = explode(",", $_POST['dataValue']);

			// 각 요소에 작은따옴표 추가
			$quotedArray = array_map(function($item) {
				return "'" . $item . "'";
			}, $array);

			// 배열을 다시 문자열로 변환
			$output = implode(',', $quotedArray);

			$sql    = "SELECT SUM(order_price) AS tot_amt, COUNT(order_no) AS tot_cnt FROM tbl_order_mst WHERE order_no IN(". $output .") AND order_no != '' ";
			$row    = $db->query($sql)->getRow();

            $msg    = "확인";
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg,
					'tot_amt' => number_format($row->tot_amt),
					'tot_cnt' => $row->tot_cnt,
					'tot_bath' => number_format(round($row->tot_amt / $baht_thai))
				]);

    }
	
    public function get_cart_sum() {
        
        $db        = \Config\Database::connect();

		helper(['setting']);
        $setting = homeSetInfo();
        
        $SignatureUtil = service('iniStdPayUtil');

        $payment_no = $this->request->getPost('payment_no');
	    $dataValue  = $this->request->getPost('dataValue');

		$array = explode(",", $dataValue);

		// 각 요소에 작은따옴표 추가
		$quotedArray = array_map(function($item) {
			return "'" . $item . "'";
		}, $array);

		// 배열을 다시 문자열로 변환
		$output = implode(',', $quotedArray);

		$sql            = "SELECT payment_tot       AS sum, 
		                          payment_price     AS lastPrice,
								  used_coupon_money AS coupon_money,
								  used_point        AS point
								  FROM tbl_payment_mst WHERE payment_no = '". $payment_no ."' ";
		$row            = $db->query($sql)->getRow();
        $price          = $row->sum;
        $lastPrice      = $row->lastPrice;
        $coupon_money   = $row->coupon_money;
        $point          = $row->point;
    
	
	    // 나이스페이
		$setting        = homeSetInfo();
		$merchantKey    = $setting['nicepay_key']; //"9TGrEiVAtgD9dxVp710YEIoab8/InI4gloDSq6ifxmAXktaFNfk3KtS5mKiX9IoMVUG4JZMu4TUk41qaXvfiyA=="; // 상점키
		$MID            = $setting['nicepay_mid']; //"tourlab00m"; // 상점아이디

		$ediDate        = date("YmdHis");
		$hashString     = bin2hex(hash('sha256', $ediDate.$MID.$lastPrice.$merchantKey, true));


        // 이니시스
		$mid 			=  $setting['inicis_mid'];     //"thaitour37";  								// 상점아이디			
		$signKey 		=  $setting['inicis_signkey']; //"QUhWMTNsZmRlQjQyM0NrRzFycVhsUT09"; 			// 웹 결제 signkey

		$mKey 	        = $SignatureUtil->makeHash($signKey, "sha256");

		$timestamp 		= $SignatureUtil->getTimestamp();   			// util에 의해서 자동생성
		$use_chkfake	= "Y";											// PC결제 보안강화 사용 ["Y" 고정]	
		$orderNumber 	= "P_". date('YmdHis') . rand(100, 999); 				// 가맹점 주문번호(가맹점에서 직접 설정)

        $orderNumber    =  $_POST['payment_no']; 
		$params = array(
			"oid"       => $orderNumber,
			"price"     => $lastPrice,
			"timestamp" => $timestamp
		);

		$sign   = $SignatureUtil->makeSignature($params);

		$params = array(
			"oid"       => $orderNumber,
			"price"     => $lastPrice,
			"signKey"   => $signKey,
			"timestamp" => $timestamp
		);

		$sign2   = $SignatureUtil->makeSignature($params);

        $output = [
            "sum"          => $price,
            "lastPrice"    => $lastPrice,
            "coupon_money" => $coupon_money,
            "point"        => $point,
			"EdiDate"      => $ediDate,
            "hashString"   => $hashString,
            "timestamp"    => $timestamp,
            "mKey"         => $mKey,
            "sign"         => $sign,
            "sign2"        => $sign2,
            "orderNumber"  => $orderNumber
        ];
        
        return $this->response->setJSON($output);
    }

    public function get_last_sum() {

        $db = \Config\Database::connect();

		$data = [
			'payment_tot'       => $this->request->getPost('payment_tot'),
			'payment_price'     => $this->request->getPost('payment_price'),
			'used_coupon_idx'   => $this->request->getPost('coupon_idx'),
			'used_coupon_num'   => $this->request->getPost('coupon_num'),
			'used_coupon_name'  => $this->request->getPost('coupon_name'),
			'used_coupon_pe'    => $this->request->getPost('coupon_pe'),
			'used_coupon_price' => $this->request->getPost('coupon_price'),
			'used_coupon_money' => $this->request->getPost('used_coupon_money'),
			'used_point'        => $this->request->getPost('used_point')
		];

		$payment_no = $this->request->getPost('payment_no');

		// Use CodeIgniter 4 Query Builder
		$db = db_connect();
		$builder = $db->table('tbl_payment_mst');

		// Update query
		$builder->where('payment_no', $payment_no);
		$result = $builder->update($data);

		// Error handling
		if (!$result) {
			log_message('error', 'Database Update Failed: ' . $db->error());
		} else {
			log_message('info', 'Database Update Successful');
		}


		helper(['setting']);
        $setting = homeSetInfo();
        
        $SignatureUtil  = service('iniStdPayUtil');

        $price          = $this->request->getPost('payment_price');
    
	    // 나이스페이
		//$merchantKey    = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키
		//$MID            = "nicepay00m"; // 상점아이디
		
		$merchantKey     = $setting['nicepay_key'] ; //"EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키  
		$MID             = $setting['nicepay_mid'];  //"nicepay00m"; // 상점아이디

		$ediDate        = date("YmdHis");
		$hashString     = bin2hex(hash('sha256', $ediDate.$MID.$price.$merchantKey, true));


        // 이니시스
		$mid 			=  $setting['inicis_mid'];     //"thaitour37";  								// 상점아이디			
		$signKey 		=  $setting['inicis_signkey']; //"QUhWMTNsZmRlQjQyM0NrRzFycVhsUT09"; 			// 웹 결제 signkey

		$mKey 	        = $SignatureUtil->makeHash($signKey, "sha256");

		$timestamp 		= $SignatureUtil->getTimestamp();   			// util에 의해서 자동생성
		$use_chkfake	= "Y";											// PC결제 보안강화 사용 ["Y" 고정]	

        $orderNumber    =  $payment_no; 
		$params = array(
			"oid"       => $orderNumber,
			"price"     => $price,
			"timestamp" => $timestamp
		);

		$sign   = $SignatureUtil->makeSignature($params);

		$params = array(
			"oid"       => $orderNumber,
			"price"     => $price,
			"signKey"   => $signKey,
			"timestamp" => $timestamp
		);

		$sign2   = $SignatureUtil->makeSignature($params);

        $output = [
			"EdiDate"     => $ediDate,
            "hashString"  => $hashString,
            "timestamp"   => $timestamp,
            "mKey"        => $mKey,
            "sign"        => $sign,
            "sign2"       => $sign2,
            "orderNumber" => $orderNumber
        ];
        
        return $this->response->setJSON($output);
    }

	public function payInfo_update() {

		    $db = \Config\Database::connect(); // 데이터베이스 연결

            $payment_no  = $_POST['payment_no']; 
            $pay_name    = encryptField($_POST['pay_name'], "encode");
            $pay_email   = encryptField($_POST['pay_email'], "encode");
            $pay_hp      = encryptField($_POST['pay_hp'], "encode");

			$sql    = "UPDATE tbl_payment_mst SET pay_name  = '". $pay_name."'
			                                     ,pay_email = '". $pay_email ."'
												 ,pay_hp    = '". $pay_hp ."' WHERE payment_no = '". $payment_no ."' ";
            //write_log("payInfo_update- ". $sql);
			$db->query($sql);
			
			/*
			use Config\Database;

			// 데이터베이스 연결
			$db = Database::connect();

			// POST 데이터 수신 및 암호화 처리
			$payment_no = $this->request->getPost('payment_no');
			$pay_name   = encryptField($this->request->getPost('pay_name'), "encode");
			$pay_email  = encryptField($this->request->getPost('pay_email'), "encode");
			$pay_hp     = encryptField($this->request->getPost('pay_hp'), "encode");

			// 업데이트할 데이터 배열
			$data = [
				'pay_name'  => $pay_name,
				'pay_email' => $pay_email,
				'pay_hp'    => $pay_hp
			];

			// 쿼리 빌더 사용
			$builder = $db->table('tbl_payment_mst'); // 테이블 선택
			$builder->where('payment_no', $payment_no) // 조건 설정
					->update($data);                   // 데이터 업데이트

			// 실행된 SQL 로그 확인
			$sql = $db->getLastQuery(); // 최종 SQL 구문 가져오기
			write_log($sql);            // 로그 기록
			*/

            $msg    = "확인";
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);

    }

	public function id_check() {

		    $db = \Config\Database::connect(); // 데이터베이스 연결

            $user_id  = $_POST['user_id']; 

			$sql    = "SELECT * FROM tbl_member WHERE user_id = '". $user_id ."' ";
			$row    = $db->query($sql)->getRow();

            if($row->user_id) {
               $msg    = "회원이 확인됬습니다";
			   $m_idx  =  $row->m_idx;
               $status = "Y";
            } else {
               $msg    = "회원이 없습니다";
			   $m_idx  =  "";
               $status = "N";
            }
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => $status,
					'm_idx'   => $m_idx, 
					'message' => $msg 
				]);

    }

	public function deleteCart()
	{
		$request = service('request');
		$ids     = $request->getPost('ids'); // 선택된 게시글 ID 배열

		if (!empty($ids)) {
			$db = \Config\Database::connect();
			$builder = $db->table('tbl_order_mst'); // 'posts' 테이블
			$builder->whereIn('order_idx', $ids);
			$builder->delete(); // 삭제 실행
			return $this->response->setJSON(['success' => true]);
		}
		return $this->response->setJSON(['success' => false]);
	}

	public function order_inq()
	{
		    $private_key = private_key();
		
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$order_no			= $_POST["order_no"];
			$order_user_name	= $_POST["order_user_name"];
			$order_user_mobile1	= $_POST["order_user_mobile1"];
			$order_user_mobile2	= $_POST["order_user_mobile2"];
			$order_user_mobile3	= $_POST["order_user_mobile3"];
			$order_user_mobile  = $order_user_mobile1 ."-". $order_user_mobile2 ."-". $order_user_mobile3;

			$total_sql = "	SELECT count(*) AS cnt FROM  tbl_order_mst
									 WHERE order_no = '$order_no'
									 AND   CONVERT(AES_DECRYPT(UNHEX(order_user_name),  '$private_key') USING utf8) = '$order_user_name'
									 AND   CONVERT(AES_DECRYPT(UNHEX(order_user_mobile),'$private_key') USING utf8) = '$order_user_mobile' ";
			//echo $total_sql;
			$row    = $db->query($total_sql)->getRow();
 /*
			// POST 데이터 수신
			$order_no             = $this->request->getPost('order_no');
			$order_user_name      = $this->request->getPost('order_user_name');
			$order_user_mobile1   = $this->request->getPost('order_user_mobile1');
			$order_user_mobile2   = $this->request->getPost('order_user_mobile2');
			$order_user_mobile3   = $this->request->getPost('order_user_mobile3');
			//$private_key          = 'your_private_key'; // 개인 키

			// 휴대폰 번호 조합
			$order_user_mobile = $order_user_mobile1 . "-" . $order_user_mobile2 . "-" . $order_user_mobile3;

			// 모델 초기화
			$model = new PaymentModel();

			// 쿼리 실행
			$query = $model->select('COUNT(*) as cnt')
						   ->where('order_no', $order_no)
						   ->where("CONVERT(AES_DECRYPT(UNHEX(order_user_name), ?) USING utf8) =", $order_user_name)
						   ->where("CONVERT(AES_DECRYPT(UNHEX(order_user_mobile), ?) USING utf8) =", $order_user_mobile)
						   ->bind([$private_key, $private_key]) // 바인딩 처리
						   ->get();

			// 결과 처리
			$row = $query->getRow();
*/

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $row->cnt 
				]);

    }
	
	public function ajax_status_upd()
	{
		
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$payment_idx   = $_POST["payment_idx"];
			$order_no	   = $_POST["order_no"];
			$order_status  = $_POST["order_status"];
			
            $sql           = "	update tbl_payment_mst set  payment_status    = '". $order_status ."'
			                                               ,payment_m_date    = now()
			                                                where payment_idx = '". $payment_idx ."' ";
            //write_log($sql);
			$result        = $db->query($sql);
			
            $sql           = "	update tbl_order_mst set order_status = '". $order_status ."' where FIND_IN_SET (order_no, '". $order_no ."') ";
            //write_log($sql);
			$result        = $db->query($sql);
		    if($result) {
			   $msg = "수정 완료";	
			} else {  
			   $msg = "수정 오류";	
			}

		    if($order_status == "W") $alimCode = "UA_5373";  // 예약접수
		    if($order_status == "X") $alimCode = "UA_5373";  // 예약확인
		    if($order_status == "Y") $alimCode = "TY_1654";  // 결제완료
		    if($order_status == "Z") $alimCode = "TY_1655";  // 예약확정
		    if($order_status == "C") $alimCode = "TY_1657";  // 예약취소
		    if($order_status == "N") $alimCode = "TY_1653";  // 예약불가 
		    if($order_status == "E") $alimCode = "UA_5373";  // 이용완료.			

            $result = alimTalk_send($order_no, $alimCode);
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
	}	
	
	public function ajax_room_detail()
	{
		$db = \Config\Database::connect();
		try {
            $idx  = $this->request->getVar("idx");

            $sql1 = " select * from tbl_room where g_idx = '" . $idx . "' ";
            $db1  = $db->query($sql1)->getRowArray();

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

	public function ajax_room_delete()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$g_idx       = $_POST["g_idx"];
			$rooms_idx   = $_POST["rooms_idx"];

			$total_sql   = " select * from tbl_hotel_rooms where g_idx = '". $g_idx ."' ";
			$result      = $db->query($total_sql);
			$nTotalCount = $result->getNumRows();
			//write_log("nTotalCount- ". $nTotalCount);
            $row         = $db->query($total_sql)->getRow();

            $g_idx       = $row->g_idx;
	     	$goods_code  = $row->goods_code;
			
            $sql         = "DELETE FROM tbl_hotel_rooms WHERE g_idx = '$g_idx' AND rooms_idx = '". $rooms_idx ."' ";
			//write_log($sql);
			$result      = $db->query($sql);
			
            $sql         = "DELETE FROM tbl_room_beds WHERE rooms_idx = '". $rooms_idx ."' ";
			//write_log($sql);
			$result      = $db->query($sql);
			
		    if($result) {
			   //if($nTotalCount == 1) {
				//   $sql  = "insert into tbl_hotel_rooms set g_idx = '". $g_idx ."', goods_code = '". $goods_code ."' ";
				//   $db->query($sql);
			   //}
			   $msg = "삭제 완료";	
			} else {  
			   $msg = "삭제 오류";	
			}
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
		
	}
	
	public function ajax_allimtalk_send()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$order_no    = $_POST["order_no"];
			$alimCode    = $_POST["alimCode"];

            $result = alimTalk_send($order_no, $alimCode);
			
		    $msg    = "전송완료";	
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
		
	}
	
	public function ajax_allimtalk_send1()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$payment_idx = $_POST["payment_idx"];
			$alimCode    = $_POST["alimCode"];

            $result = alimTalk_send_group($payment_idx, $alimCode);
			
		    $msg    = "전송완료";	
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
		
	}
	
	public function ajax_incoiceHotel_send()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
		    $private_key = private_key();
 		
			$order_no  = $_POST["order_no"];
			$order_user_email = $_POST["order_user_email"];
 
			$sql       = "SELECT   a.*, b.product_name
			                     , AES_DECRYPT(UNHEX(order_user_name),   '$private_key') AS user_name
						         , AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS user_mobile  
						         , AES_DECRYPT(UNHEX(order_user_email),  '$private_key') AS user_email  FROM tbl_order_mst a
								LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
								WHERE order_no = '". $order_no ."' ";
 								 
			$row         = $db->query($sql)->getRow();
 		    $order_price = number_format($row->order_price) ."원";
			
			$gubun = $row->order_gubun;

			if($row->order_gubun == "vehicle") {
				$gubun = "car";
			}

			if($row->order_gubun == "ticket" || $row->order_gubun == "restaurant" || $row->order_gubun == "spa" ) {
				$gubun = "ticket";
			}

			$_tmp_fir_array = [
				'gubun'   => $gubun,
				'order_idx'   => $row->order_idx,
				'예약번호'    => $order_no,
				'예약일짜'    => substr($row->order_r_date,0,10),
				'회원이름'    => $row->user_name,
				'이메일'      => $row->user_email,
				'전화번호'     => $row->user_mobile,
				'여행자성명'   => $row->user_name,
				'여행자연락처' => $row->user_mobile,
				'여행자이메일' => $row->user_email,
				'여행상품'     => $row->product_name,	
				'총인원'       => $row->order_room_cnt ."Room",
				'총금액'	      => $order_price,
				'총견적금액'   => $order_price,
			];

			if($row->order_gubun == "hotel") {
				$code        = "A21";
				$checkin     = $row->start_date ."(". get_korean_day($row->start_date) .") ~ ". $row->end_date ."(". get_korean_day($row->end_date) .") / ". $row->order_day_cnt ."일";

				$_tmp_fir_array['이용날짜'] = $checkin;
				$_tmp_fir_array['총인원'] = $row->order_room_cnt ."Room";
				$_tmp_fir_array['총금액'] = $order_price;
				$_tmp_fir_array['총금액'] = $order_price;
			}else if($row->order_gubun == "golf"){
				$code = "A22";
				$_tmp_fir_array['이용날짜'] = $row->order_day;
			}else if($row->order_gubun == "tour"){
				$code = "A24";
				$_tmp_fir_array['이용날짜'] = $row->order_day;
			}else if($row->order_gubun == "spa"){
				$code = "A26";
				$_tmp_fir_array['이용날짜'] = $row->order_day;
			}else if($row->order_gubun == "ticket"){
				$code = "A34";
				$_tmp_fir_array['이용날짜'] = $row->order_day;
			}else if($row->order_gubun == "restaurant"){
				$code = "A35";
				$_tmp_fir_array['이용날짜'] = $row->order_day;
			}else if($row->order_gubun == "vehicle"){
				$code = "A28";
				
				$str_day_v = date("Y.m.d", strtotime($row->meeting_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->meeting_date))) . ")";

				if($row->code_parent_category == "5403"){
					$str_day_v .= " ~ " . date("Y.m.d", strtotime($row->return_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->return_date))) . ")";			
				}

				$_tmp_fir_array['이용날짜'] = $str_day_v;

			}else {
				$code = "A30";

				$str_day_g =  date("Y.m.d", strtotime($row->start_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->start_date))) . ")" . " ~ " .
					date("Y.m.d", strtotime($row->end_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->end_date))) . ")";
				$_tmp_fir_array['이용날짜'] = $str_day_g;
			
			}
		
			if(!empty($order_user_email)) $user_mail = $order_user_email;
			else $user_mail   = $row->user_email;
			
			autoEmail($code, $user_mail, $_tmp_fir_array);
	
		    $msg    = "전송완료";	
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
		
	}
	
	public function ajax_voucherHotel_send()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
		    $private_key = private_key();
 		
			$order_no  = $_POST["order_no"];
			$order_user_email  = $_POST["order_user_email"];
 
			$sql       = "SELECT   a.*, b.*, c.*
			                     , AES_DECRYPT(UNHEX(order_user_name),   '$private_key') AS user_name
						         , AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS user_mobile  
						         , AES_DECRYPT(UNHEX(order_user_email),  '$private_key') AS user_email
								 , AES_DECRYPT(UNHEX(order_user_first_name_en),  '$private_key') AS user_first_name_en 
								 , AES_DECRYPT(UNHEX(order_user_last_name_en),  '$private_key') AS user_last_name_en
								 , AES_DECRYPT(UNHEX(order_user_name_en_new),  '$private_key') AS user_name_en_new
								 , AES_DECRYPT(UNHEX(order_user_mobile_new),  '$private_key') AS user_mobile_new   

								FROM tbl_order_mst a
								LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx
								LEFT JOIN tbl_product_stay c ON b.stay_idx = c.stay_idx
								WHERE order_no = '". $order_no ."' ";			 
 								 
			$row         = $db->query($sql)->getRow();
 		    $order_price = number_format($row->order_price) ."원";

			if(!empty($row->user_name_en_new)){
				$user_name_en = $row->user_name_en_new;
			}else{
				$user_name_en = $row->user_first_name_en . " " . $row->user_last_name_en;
			}

			if(!empty($row->user_mobile_new)){
				$user_mobile = $row->user_mobile_new;
			}else{
				$user_mobile = $row->user_mobile;
			}
			
			$gubun = $row->order_gubun;

			if($row->order_gubun == "vehicle") {
				$gubun = "car";
			}

			if($row->order_gubun == "ticket" || $row->order_gubun == "restaurant" || $row->order_gubun == "spa" ) {
				$gubun = "ticket";
			}

			$_tmp_fir_array = [
				'gubun'   => $gubun,
				'order_idx'  => $row->order_idx,
	            '회원이름'    => $row->user_name,
 	            '이메일'      => $row->user_email,
 	            '전화번호'     => $row->user_mobile,
				'영문호텔명'     => $row->product_name_en,	
				'영문호텔주소'   => $row->stay_address,
				'호텔전화번호'   => $row->user_mobile,
				'고객영문이름'   => $user_name_en,
				'국가약자'   => '',
				'휴대전화번호'   => $user_mobile,
				'예약번호'    => $order_no,
	            '이용날짜'    => substr($row->order_r_date,0,10),
				'여행자연락처' => $row->user_mobile,
				'여행자이메일' => $row->user_email,
				'총인원'       => $row->order_room_cnt ."Room",
				'총금액'	   => $order_price,
				'총견적금액'   => $order_price,

				'투어명명'     => $row->product_name_en,	
				'투어업체'     => $row->product_name_en,
				'투어전화번호'     => $row->product_name_en,
				'상품이용일'     => $row->product_name_en,
				'제품명'     => $row->product_name_en,

			];

			if($row->order_gubun == "tour"){
				$code = 'A25';
				$_tmp_fir_array['투어명명'] = $row->product_name_en;
				$_tmp_fir_array['투어업체'] = $row->addrs;
				$_tmp_fir_array['투어전화번호'] = $row->phone;
				$_tmp_fir_array['상품이용일'] = $row->order_day;
				// $_tmp_fir_array['제품명'] = $row->tour_type_en;
			}
			else if($row->order_gubun == "spa" || $row->order_gubun == "ticket" || $row->order_gubun == "restaurant"){

				$builder = $db->table('tbl_order_option');
				$builder->select("option_name, option_tot, option_cnt, option_date, option_qty, option_price_bath");
				$query = $builder->where('order_idx', $row->order_idx)->get();
				$optionResult = $query->getResult();

				$option = '';
				foreach($optionResult as $res){
					$option .= $res->option_name . " x " . $res->option_cnt . "; ";
				}

				if(!empty($row->product_name_en)) $product_name_cs = $row->product_name_en;
				else $product_name_cs = $row->product_name;

				if($row->order_gubun == "spa"){
					$code = 'A27';

					$_tmp_fir_array['스파명'] = $product_name_cs;
					$_tmp_fir_array['스파주소'] = $row->addrs;
					$_tmp_fir_array['스파전화번호'] = $row->phone_2;
				}else if($row->order_gubun == "ticket") {
					$code = 'A54';

					$_tmp_fir_array['쇼&틱킷명'] = $product_name_cs;
					$_tmp_fir_array['쇼&틱주소'] = $row->addrs;
					$_tmp_fir_array['쇼&틱전화번호'] = $row->phone_2;
				}else {
					$code = 'A55';

					$_tmp_fir_array['레스토랑명'] = $product_name_cs;
					$_tmp_fir_array['레스토랑주소'] = $row->addrs;
					$_tmp_fir_array['레스토랑전화번호'] = $row->phone_2;
				}

				$_tmp_fir_array['상품이용일'] = $row->order_day;
				$_tmp_fir_array['제품명'] = $row->option;

				
			}else if($row->order_gubun == "hotel") {
				$code        = "A20";
				$checkin     = $row->start_date ."(". get_korean_day($row->start_date) .") ~ ". $row->end_date ."(". get_korean_day($row->end_date) .") / ". $row->order_day_cnt ."일";
				
				$sql    = "SELECT * FROM tbl_room WHERE g_idx = '". $row->room_g_idx ."' ";
				$r_result = $db->query($sql);
				$row_r    = $r_result->getRowArray();

				$roomName_eng = $row_r["roomName_eng"];

				if(!empty($row->room_type_new)){
					$room_type = $row->room_type_new;
				}else{
					$room_type = $roomName_eng;
				}

				$_tmp_fir_array['체크인'] = $checkin;
				$_tmp_fir_array['호텔상품명'] = $room_type;

			}else if($row->order_gubun == "golf"){
				$code        = "A23";
				$main_op = $this->orderOptionModel->getOption($row->order_idx, 'main')[0];

				$main = explode("|", $main_op["option_name_eng"]);
				$hole = trim(explode(":", $main[0])[1]);

				$_tmp_fir_array['골프상품명'] = $hole;
				$_tmp_fir_array['영문호텔주소'] = $row->addrs;
			}
			else if($row->order_gubun == "vehicle"){
				$code = "A29";

				$str_day_v = date("Y.m.d", strtotime($row->meeting_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->meeting_date))) . ")";

				if($row->code_parent_category == "5403"){
					$str_day_v .= " ~ " . date("Y.m.d", strtotime($row->return_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->return_date))) . ")";			
				}
				$_tmp_fir_array['상품이용일'] = $str_day_v;

			}
			else {
				$code = "A31";

				$str_day_g =  date("Y.m.d", strtotime($row->start_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->start_date))) . ")" . " ~ " .
					date("Y.m.d", strtotime($row->end_date)) . "(" . get_korean_day(date("Y.m.d", strtotime($row->end_date))) . ")";
				$_tmp_fir_array['상품이용일'] = $str_day_g;
			}

			if(!empty($order_user_email)){
					$user_mail = $order_user_email;
				}else $user_mail = $row->user_email;

			autoEmail($code, $user_mail, $_tmp_fir_array);
	
		    $msg    = "전송완료";	
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
		
	}
	
	public function hotel_allUpdRoom_pricex()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$g_idx        =  $_POST["g_idx"];
			$rooms_idx    =  $_POST["rooms_idx"];
			$o_sdate      =  $_POST["o_sdate"]; 
			$o_edate      =  $_POST["o_edate"];
			$goods_price1 =  $_POST["goods_price1"];
			$goods_price2 =  $_POST["goods_price2"];
			$goods_price3 =  $_POST["goods_price3"];
			$goods_price4 =  $_POST["goods_price4"]; 		

            $sql          = "	UPDATE tbl_hotel_rooms SET o_sdate      = '". $o_sdate ."'
			                                              ,o_edate      = '". $o_edate ."'
			                                              ,goods_price1 = '". $goods_price1 ."'
			                                              ,goods_price2 = '". $goods_price2 ."'
			                                              ,goods_price3 = '". $goods_price3 ."'
														  ,goods_price4 = '". $goods_price4 ."' WHERE rooms_idx = '". $rooms_idx ."' AND g_idx = '". $g_idx ."'";  
            //write_log($sql);
			$result        = $db->query($sql);

			// 시작일과 종료일 설정
			$startDate = $o_sdate;   // 시작일
			$endDate   = $o_edate;   // 종료일

			// DateTime 객체 생성
			$start = new DateTime($startDate);
			$end   = new DateTime($endDate);
			$end->modify('+1 day'); // 종료일까지 포함하기 위해 +1일 추가

			// 날짜 반복
			while ($start < $end) 
			{
				$currentDate = $start->format("Y-m-d"); // 현재 날짜 (형식: YYYY-MM-DD)
				
				$sql = "UPDATE tbl_room_price SET  goods_price1 = '". $goods_price1 ."'
												  ,goods_price2 = '". $goods_price2 ."'
												  ,goods_price3 = '". $goods_price3 ."'
												  ,goods_price4 = '". $goods_price4 ."' WHERE rooms_idx = '". $rooms_idx ."' AND g_idx = '". $g_idx ."' AND goods_date = '". $currentDate ."' ";


				//write_log($sql);
				$result  = $db->query($sql);
				$start->modify('+1 day'); // 다음 날짜로 이동
			}
		
		    $msg    = "전송완료";	
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
	}

	public function hotel_allUpdRoom_price()
	{
		$db = \Config\Database::connect(); // DB 연결

        $product_idx  = $_POST["product_idx"];
		$g_idx        = $_POST["g_idx"];
		$rooms_idx    = $_POST["rooms_idx"];
		$o_sdate      = $_POST["o_sdate"];
		$o_edate      = $_POST["o_edate"];
		$goods_price1 = $_POST["goods_price1"];
		$goods_price2 = $_POST["goods_price2"];
		$goods_price3 = $_POST["goods_price3"];
		$goods_price4 = $_POST["goods_price4"];
	

		// 호텔 룸 가격 업데이트
		$sql1 = "UPDATE tbl_hotel_rooms 
				 SET o_sdate = ?, o_edate = ?, goods_price1 = ?, goods_price2 = ?, goods_price3 = ?, goods_price4 = ? 
				 WHERE rooms_idx = ? AND g_idx = ?";
		$db->query($sql1, [$o_sdate, $o_edate, $goods_price1, $goods_price2, $goods_price3, $goods_price4, $rooms_idx, $g_idx]);

		// 특정 기간 내 데이터가 없으면 INSERT, 있으면 UPDATE
		$start = new DateTime($o_sdate);
		$end   = new DateTime($o_edate);
		$end->modify('+1 day'); // 종료일까지 포함

		$values = [];
		while ($start < $end) {
            $dow      =  dateToYoil($start->format("Y-m-d"));
	        $values[] = "('{$rooms_idx}', '{$g_idx}', '{$start->format("Y-m-d")}', '{$goods_price1}', '{$goods_price2}', '{$goods_price3}', '{$goods_price4}', '{$product_idx}', '{$dow}')";
			$start->modify('+1 day');
		}

		if (!empty($values)) {
			$sql = "INSERT INTO tbl_room_price (rooms_idx, g_idx, goods_date, goods_price1, goods_price2, goods_price3, goods_price4, product_idx, dow) 
					VALUES " . implode(',', $values) . "
					ON DUPLICATE KEY UPDATE 
						goods_price1 = VALUES(goods_price1), 
						goods_price2 = VALUES(goods_price2), 
						goods_price3 = VALUES(goods_price3), 
						goods_price4 = VALUES(goods_price4)";
			write_log("hotel_allUpdRoom_price- ". $sql);			
			$db->query($sql);
		}

		return $this->response
			->setStatusCode(200)
			->setJSON([
				'status'  => 'success',
				'message' => '전송완료'
			]);
	}


	public function ajax_open_yoil()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$p_idx  =  $_POST["p_idx"];

            $sql    = "	UPDATE tbl_product_price SET sale  = 'Y' WHERE p_idx = '". $p_idx ."'";  
			$result = $db->query($sql);
			
			if($result) {
		       $msg  = "마감해제 완료";
			} else { 
		       $msg  = "마감해제 오류";	
			}
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
	}	
		
	public function ajax_close_yoil()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$p_idx  =  $_POST["p_idx"];

            $sql    = "	UPDATE tbl_product_price SET sale  = 'N' WHERE p_idx = '". $p_idx ."'";  
			$result = $db->query($sql);
			
			if($result) {
		       $msg  = "마감 완료";
			} else { 
		       $msg  = "마감 오류";	
			}
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);
	}	
	
	public function ajax_set_status()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 			$private_key = private_key();

			$order_idx     =  $_POST["order_idx"];
			$order_status  =  $_POST["order_status"];

            if($order_status == "X") { 
               $sql      = "UPDATE tbl_order_mst SET order_status  = '". $order_status ."', confirmed_datetime = now() WHERE order_idx = '". $order_idx ."'";  
			} else {  
               $sql      = "UPDATE tbl_order_mst SET order_status  = '". $order_status ."', order_r_date = now() WHERE order_idx = '". $order_idx ."'";  
			}

			$m_idx = session()->get("member")["idx"] ?? 0;
            $ipAddress = $this->request->getIPAddress();

			$this->historyOrderUpdate->insertData([
                "m_idx" => $m_idx,
                "order_idx" => $order_idx,
                "ip_address" => $ipAddress,
                "updated_date" =>  Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
            ]);

			write_log("ajax_set_status- ".  $sql);
			$result   = $db->query($sql);
			
			if($result) {
		       $msg  = "예약 변경완료";
			} else { 
		       $msg  = "예약 변경오류";	
			}

			$sql       = "SELECT   a.*, b.product_name
			                     , AES_DECRYPT(UNHEX(order_user_name),   '$private_key') AS user_name
						         , AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS user_mobile  
						         , AES_DECRYPT(UNHEX(order_user_email),  '$private_key') AS user_email 
								 , AES_DECRYPT(UNHEX(order_user_first_name_en), '$private_key') AS user_first_name_en
								 , AES_DECRYPT(UNHEX(order_user_last_name_en), '$private_key') AS user_last_name_en
								 FROM tbl_order_mst a
								 LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx WHERE order_idx = '". $order_idx ."' ";


			$row      = $db->query($sql)->getRow();
			$order_no = $row->order_no;
			$product_code_1 = $row->product_code_1;
			$product_code_2 = $row->product_code_2;
			$user_mail   = $row->user_email;
    		$order_price = number_format($row->order_price);
			$use_day = $row->order_day;

			if($product_code_1 == '1303') {
				$product_type = '호텔';
			} else if ($product_code_1 == '1302') {
				$product_type = '골프';
			} else if ($product_code_1 == '1301') {
				$product_type = '투어';
			} else if ($product_code_1 == '1325') {
				$product_type = '스파';
			} else if ($product_code_1 == '1317') {
				$product_type = '쇼ㆍ입장권';
			} else if ($product_code_1 == '1320') {
				$product_type = '레스토랑';
			} else if ($product_code_2 == '132404') {
				$product_type = '차량';
			} else if ($product_code_2 == '132403') {
				$product_type = '가이드';
			}

			if($row->order_gubun == "hotel"){
				$count = (int)$row->adult + (int)$row->kids;
			} else if($row->order_gubun == "golf"){
				$sql_cnt = "SELECT * FROM tbl_order_option WHERE order_idx = '". $order_idx ."' AND option_type = 'main'";
				$row_cnt = $db->query($sql_cnt)->getRow();
				$count = $row_cnt->option_cnt;
			}

			else{
				$count = (int)$row->people_adult_cnt + (int)$row->people_kids_cnt;
			} 



			// CREATE ALARM
			 $m_idx = $row->m_idx;
			 $_deli_type = get_deli_type();
			 $status_text = $_deli_type[$row->order_status];
			 $content_alarm = $row->code_name . $status_text . "가 되었습니다.";
			 $sql_alarm = "INSERT tbl_alarm SET contents = '$content_alarm',
												m_idx = '$m_idx',
												r_date = now()
			 ";
			 $db->query($sql_alarm);
			// END CREATE ALARM

			if(!empty($row->user_name_en_new)){
				$user_name_en = $row->user_name_en_new;
			}else{
				$user_name_en = $row->user_first_name_en . " " . $row->user_last_name_en;
			}

			if(!empty($row->user_mobile_new)){
				$user_mobile = $row->user_mobile_new;
			}else{
				$user_mobile = $row->user_mobile;
			}

			if(!empty($row->room_type_new)){
				$room_type = $row->room_type_new;
			}else{
				$room_type = $row->room_type;
			}

		    if($order_status == "W") {  // 예약접수
				$alimCode = "UA_5373";  
			
				$code        = "A14";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $order_no,
					'PROD_TYPE'   => $product_type,
					'ORDER_DATE'   => substr($row->order_r_date,0,10),
					'ORDER_NAME'   => $row->user_name,
					'ORDER_NUM_PEOPLE'   => $count,
				];
		
				autoEmail($code, $user_mail, $_tmp_fir_array);
				
			}  
			
		    if($order_status == "X") {  // 예약확인 
				$alimCode = "UA_5319";

				// if($row->order_gubun == "hotel"){
				// 	$code = "A21";
				// 	$gubun = "hotel";
				// 	$use_day = $row->start_date . "(" . get_korean_day($row->start_date) . ")" . " ~ " 
				// 		. $row->end_date . "(" . get_korean_day($row->end_date) . ")" . " / " . $row->order_day_cnt . "일";
				// }else if($row->order_gubun == "golf"){
				// 	$code = "A22";
				// 	$gubun = "golf";
				// }else if($row->order_gubun == "tour"){
				// 	$code = "A24";
				// 	$gubun = "tour";
				// }else if($row->order_gubun == "spa"){
				// 	$code = "A26";		
				// 	$gubun = "ticket";
				// }else if($row->order_gubun == "ticket"){
				// 	$code = "A34";		
				// 	$gubun = "ticket";
				// }else if($row->order_gubun == "restaurant"){
				// 	$code = "A35";	
				// 	$gubun = "ticket";
				// }else if($row->order_gubun == "vehicle"){
				// 	$code = "A28";	
				// 	$gubun = "car";
				// 	$use_day = substr($row->order_date,0,10);					
				// }else {
				// 	$code = "A30";
				// 	$gubun = "guide";
				// 	$use_day = $row->start_date . "(" . get_korean_day($row->start_date) . ")" . " ~ " 
				// 		. $row->end_date . "(" . get_korean_day($row->end_date) . ")";
				// }

				// $_tmp_fir_array = [
				// 	'order_idx' => $order_idx,
				// 	'gubun' => $gubun,
				// 	'예약번호' => $order_no,
				// 	'예약일자' => substr($row->order_r_date,0,10),
				// 	'회원이름' => $row->user_name,
				// 	'이메일' => $row->user_email,
				// 	'전화번호' => $row->user_mobile,
				// 	'이용날짜' => $use_day,
				// 	'여행자성명' => $row->user_first_name_en . " " . $row->user_last_name_en,
				// 	'여행자연락처' => $row->user_mobile,
				// 	'여행자이메일' => $row->user_email,
				// 	'여행상품' => $row->product_name_en,
				// ];

				$code        = "A56";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $order_no,
					'ORDER_PRICE' => $order_price,
					'PROD_TYPE'   => $product_type,
					'ORDER_DATE'   => substr($row->order_r_date,0,10),
					'ORDER_NAME'   => $row->user_name,
					'ORDER_NUM_PEOPLE' => $count,
				];
		
				autoEmail($code, $user_mail, $_tmp_fir_array);

			}
			
		    if($order_status == "Y") {   // 결제완료
				$alimCode = "UA_5328"; 

				$code = "A17";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $order_no,
					'PROD_TYPE'   => $product_type,
					'ORDER_DATE'   => substr($row->order_r_date,0,10),
					'ORDER_NAME'   => $row->user_name,
				];
		
				autoEmail($code, $user_mail, $_tmp_fir_array);

			}  
			 
		    if($order_status == "Z") { // 예약확정 
				$alimCode = "UA_5331"; 

				// if($row->order_gubun == "hotel"){
				// 	$code = "A20";
				// 	$gubun = "hotel";
				// 	$use_day = $row->start_date . "(" . get_korean_day($row->start_date) . ")" . " ~ " 
				// 		. $row->end_date . "(" . get_korean_day($row->end_date) . ")" . " / " . $row->order_day_cnt . "일";
				// }else if($row->order_gubun == "golf"){
				// 	$code = "A23";
				// 	$gubun = "golf";
				// }else if($row->order_gubun == "tour"){
				// 	$code = "A25";
				// 	$gubun = "tour";
				// }else if($row->order_gubun == "spa"){
				// 	$code = "A27";		
				// 	$gubun = "ticket";
				// }else if($row->order_gubun == "ticket"){
				// 	$code = "A54";		
				// 	$gubun = "ticket";
				// }else if($row->order_gubun == "restaurant"){
				// 	$code = "A55";	
				// 	$gubun = "ticket";
				// }else if($row->order_gubun == "vehicle"){
				// 	$code = "A29";	
				// 	$gubun = "car";
				// 	$use_day = substr($row->order_date,0,10);					

				// }else {
				// 	$code = "A31";
				// 	$gubun = "guide";
				// 	$use_day = $row->start_date . "(" . get_korean_day($row->start_date) . ")" . " ~ " 
				// 		. $row->end_date . "(" . get_korean_day($row->end_date) . ")";
				// }

				// $_tmp_fir_array = [
				// 	'gubun'   => $gubun,
				// 	'order_idx'  => $order_idx,
				// 	'회원이름'    => $row->user_name,
				// 	'이메일'      => $row->user_email,
				// 	'전화번호'    => $row->user_mobile,
				// 	'영문호텔명'   => $row->product_name_en,	
				// 	'영문호텔주소' => $row->stay_address,
				// 	'호텔전화번호' => $row->tel_no,

				// 	'고객영문이름' => $user_name_en,
				// 	'국가약자'    => '',
				// 	'휴대전화번호' => $user_mobile,

				// 	'예약번호'    => $order_no,
				// 	'이용날짜'    => substr($row->order_r_date,0,10),
				// 	'호텔상품'    => $room_type,
				// 	'골프상품명'  => '',
				// 	'제품명'     => '',
				// 	'영문상품명'  => $use_day,

				// 	'여행자연락처' => $row->user_mobile,
				// 	'여행자이메일' => $row->user_email,
				// 	'총인원'      => $row->order_room_cnt ."Room",
				// 	'총금액'	  => $order_price,
				// 	'총견적금액'   => $order_price
				// ];
				$code        = "A58";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $order_no,
					'PROD_TYPE'   => $product_type,
					'ORDER_DATE'   => substr($row->order_r_date,0,10),
					'ORDER_NAME'   => $row->user_name,
					'ORDER_NUM_PEOPLE'   => $count,
				];
		
				autoEmail($code, $user_mail, $_tmp_fir_array);
			}
			
		    if($order_status == "C") {  // 예약취소
				$alimCode = "UA_5348"; 

				$code = "A33";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $order_no,
					'PROD_TYPE'   => $product_type,
					'ORDER_DATE'   => substr($row->order_r_date,0,10),
					'ORDER_NAME'   => $row->user_name,
					'ORDER_NUM_PEOPLE'   => $count,
				];
		
				autoEmail($code, $user_mail, $_tmp_fir_array);
			}  

			if($order_status == "N") {  // 예약불가
				$alimCode = "UA_5325"; 

				$code = "A57";
				$_tmp_fir_array = [
					'RECEIVE_NAME'=> $row->user_name,
					'PROD_NAME'   => $row->product_name,
					'ORDER_NO'    => $order_no,
					'PROD_TYPE'   => $product_type,
					'ORDER_DATE'   => substr($row->order_r_date,0,10),
					'ORDER_NAME'   => $row->user_name,
					'ORDER_NUM_PEOPLE'   => $count,
				];
		
				autoEmail($code, $user_mail, $_tmp_fir_array);
			}   
		    if($order_status == "E") {  // 이용완료.
				$alimCode = "UA_5373"; 
			}  			

            alimTalk_send($order_no, $alimCode);
            //email_send($order_no, $order_status);

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);		
	}	
	
	public function ajax_bank_deposit()
    {
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$order_no     =  $_POST["order_no"];
            $order_method =  $_POST["order_method"];
			$baht_thai    =  $this->setting['baht_thai'];
			
            $sql    = "	UPDATE tbl_order_mst SET order_status  = 'J'
			                                   , order_method  = '". $order_method ."'
											   , baht_thai     = '". $baht_thai ."'
											   , order_r_date  = now() WHERE order_no = '". $order_no ."'";  
			$result = $db->query($sql);
			
			if($result) {
		       $msg  = "입금대기 완료";
			} else { 
		       $msg  = "입금대기 오류";	
			}
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);		
		
	}	
	
	public function ajax_booking_delete()
    {
		    $db = \Config\Database::connect(); // 데이터베이스 연결
 		
			$order_idx =  $_POST["idx"];
			
            $sql       = "	DELETE FROM tbl_order_mst WHERE order_idx = '". $order_idx ."'";  
			$result    = $db->query($sql);
			
			if($result) {
		       $msg  = "예약정보 삭제완료";
			} else { 
		       $msg  = "예약정보 삭제오류";	
			}
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);		
		
	}	
	
	public function ajax_room_add()
	{
		$db = \Config\Database::connect(); // 데이터베이스 연결

		$goods_code  = $this->request->getPost("prod_idx");
		$g_idx       = $this->request->getPost("g_idx");

		try {
			// 호텔 룸 추가
			$sql = "INSERT INTO tbl_hotel_rooms (g_idx, goods_code, reg_date) VALUES (?, ?, NOW())";
			$db->query($sql, [$g_idx, $goods_code]);

			// 마지막 삽입된 룸의 ID 가져오기
			$rooms_idx = $db->insertID();

			// 베드 추가
			//$sql = "INSERT INTO tbl_room_beds 
			//		(rooms_idx, bed_type, goods_price1, goods_price2, goods_price3, goods_price4, goods_price5, bed_seq, reg_date) 
			//		VALUES (?, '침대타입', 0, 0, 0, 0, 0, 0, NOW())";
			//$db->query($sql, [$rooms_idx]);

			$msg = "룸 등록 완료";

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg
				]);
		} catch (\Exception $e) {
			return $this->response
				->setStatusCode(500)
				->setJSON([
					'status'  => 'error',
					'message' => "룸 등록 오류: " . $e->getMessage()
				]);
		}
	}
	
	public function ajax_bed_rank()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결

			$current_bed_idx = $_POST['current_bed_idx'];
			$swap_bed_idx    = $_POST['swap_bed_idx'];
			$current_bed_seq = $_POST['current_bed_seq'];
			$swap_bed_seq    = $_POST['swap_bed_seq'];

			$sql       = "SELECT *  FROM tbl_room_beds WHERE bed_idx = '". $current_bed_idx ."' ";
			$row       = $db->query($sql)->getRow();

			if ($current_bed_idx && $swap_bed_idx) {
				// 순위 변경 SQL 실행
				$update1 = "UPDATE tbl_room_beds SET bed_seq = ? WHERE bed_idx = ?";
				$update2 = "UPDATE tbl_room_beds SET bed_seq = ? WHERE bed_idx = ?";
				//write_log("update1- ". $update1);
				//write_log("update2- ". $update2);
				$stmt1 = $db->query($update1, [$swap_bed_seq, $current_bed_idx]);
				$stmt2 = $db->query($update2, [$current_bed_seq, $swap_bed_idx]);

				if ($stmt1 && $stmt2) {
					
					// 순차적으로 실행해야 함
					$db->query("SET @new_seq = 0"); 

					$sql = "UPDATE tbl_room_beds 
							SET bed_seq = (@new_seq := @new_seq + 1) 
							WHERE rooms_idx = ? 
							ORDER BY bed_seq ASC";
					$db->query($sql, [$row->rooms_idx]);

					$status = "success";
					$msg    = "DB 업데이트 OK";
				} else {
					$status = "fail";
					$msg    = "DB 업데이트 실패";
				}
			} else {
					$status = "fail";
					$msg    = "잘못된 요청";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);		
	}
	
	public function ajax_bed_add()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결

            $product_idx = $this->request->getPost('product_idx');
            $g_idx       = $this->request->getPost('g_idx');
            $rooms_idx   = $this->request->getPost('rooms_idx');
            $room_name   = $this->request->getPost('room_name');
			$o_sdate     = $this->request->getPost('o_sdate');	
			$o_edate     = $this->request->getPost('o_edate');	
            $adult       = $this->request->getPost('adult');
            $kids        = $this->request->getPost('kids');

			$sql = "SELECT * FROM tbl_hotel_rooms WHERE rooms_idx   = '". $rooms_idx ."' ";
			$row = $db->query($sql)->getRowArray();
            if($row['o_sdate'] == "" || $row['o_edate'] == "") {
                $msg = "침대 타입을 추가하시려면 적용 기간을 등록하셔야 합니다.";
				return $this->response
					->setStatusCode(200)
					->setJSON([
						'status'  => $status,
						'message' => $msg 
					]);		
            }
			
			$sql       = "UPDATE tbl_hotel_rooms SET room_name = '$room_name'
			                                        ,o_sdate   = '$o_sdate'
			                                        ,o_edate   = '$o_edate'
			                                        ,adult     = '$adult' 
			                                        ,kids      = '$kids' 
          			      WHERE rooms_idx = '$rooms_idx' ";
			$result    = $db->query($sql);

			$sql       = "INSERT INTO tbl_room_beds (rooms_idx, bed_seq, reg_date) VALUES (?, ?, NOW())";
			$result    = $db->query($sql, [$rooms_idx, 9999]);
            $bed_idx   = $db->insertID();

			$ii = -1;
			$dateRange = getDateRange($o_sdate, $o_edate);
			foreach ($dateRange as $date) {

					$ii++;
					$room_date = $dateRange[$ii];
					$dow       = dateToYoil($room_date);

					$sql_opt = "SELECT count(*) AS cnt FROM tbl_room_price WHERE product_idx = '". $product_idx ."' AND 
					                                                             g_idx       = '". $g_idx ."'       AND 
																				 rooms_idx   = '". $rooms_idx ."'   AND 
																				 bed_idx     = '". $bed_idx ."'     AND
																				 goods_date  = '". $room_date ."'  ";
					//write_log("2- " . $sql_opt);
					$option = $db->query($sql_opt)->getRowArray();
					if ($option['cnt'] == 0) {
				        $baht_thai = (float)($this->setting['baht_thai'] ?? 0);
						$sql_c = "INSERT INTO tbl_room_price  SET  
																 product_idx  = '". $product_idx ."'
																,g_idx        = '". $g_idx ."'
																,rooms_idx    = '". $rooms_idx ."'
																,bed_idx      = '". $bed_idx ."'
																,goods_date	  = '". $room_date ."'
																,dow	      = '". $dow ."'
																,baht_thai    = '". $baht_thai ."'	
																,goods_price1 = '". $goods_price1 ."'	
																,goods_price2 = '". $goods_price2 ."'
																,goods_price3 = '". $goods_price3 ."'
																,goods_price4 = '". $goods_price4 ."'
																,use_yn	= ''	
																,reg_date = now() ";	
						write_log("객실가격정보-1 : " . $sql_c);
						$db->query($sql_c);
					}
			}
				
			if ($result) {
				$status = "success";
				$msg    = "침대타입 등록완료";
			} else {
				$status = "fail";
				$msg    = "침대타입 등록실패";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => $status,
					'message' => $msg 
				]);		
	}
	
	public function ajax_bed_delete()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결

            $bed_idx   = $this->request->getPost('bed_idx');
			$rooms_idx = $this->request->getPost('rooms_idx');
            $room_name = $this->request->getPost('room_name');
			$o_sdate   = $this->request->getPost('o_sdate');	
			$o_edate   = $this->request->getPost('o_edate');	
            $adult     = $this->request->getPost('adult');
            $kids      = $this->request->getPost('kids');

			$sql       = "UPDATE tbl_hotel_rooms SET room_name = '$room_name'
			                                        ,o_sdate   = '$o_sdate'
			                                        ,o_edate   = '$o_edate'
			                                        ,adult     = '$adult' 
			                                        ,kids      = '$kids' 
          			      WHERE rooms_idx = '$rooms_idx' ";
			$result    = $db->query($sql);
			
			$sql       = "DELETE FROM tbl_room_beds WHERE bed_idx = '". $bed_idx ."' "; 
			//write_log($sql);
			$result    = $db->query($sql);

			$sql       = "DELETE FROM tbl_room_price WHERE bed_idx = '". $bed_idx ."' "; 
			//write_log($sql);
			$result    = $db->query($sql);

			if ($result) {
				$status = "success";
				$msg    = "삭제 OK";
			} else {
				$status = "fail";
				$msg    = "삭제 실패";
			}

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => $status,
					'message' => $msg 
				]);		
	}
	
    public function ajax_bedPrice_insert()
    {
			$rooms_idx = $this->request->getPost('rooms_idx');
			$from_date = $this->request->getPost('from_date');
			$to_date   = $this->request->getPost('to_date');
			
			// 방 정보를 가져옵니다.
 			
			$sql      = "SELECT * FROM tbl_hotel_rooms WHERE rooms_idx = ?";
			$query    = $this->db->query($sql, [$rooms_idx]);
			$roomData = $query->getRow(); // 객체 형태로 반환

			if (!$roomData) {
				return $this->response->setJSON([
					'status' => 'fail',
					'message' => '방 정보를 찾을 수 없습니다'
				]);
			}

			// insertRoomPrice.php 파일을 포함하여 가격 삽입 함수 호출
			include_once APPPATH . 'Common/insertRoomPrice.php';

			// 공통 함수 호출
			$baht_thai = $this->setting['baht_thai'];

			$result = insertRoomPrice($this->db, $rooms_idx, $baht_thai, $roomData->goods_code, $roomData->g_idx, $from_date, $to_date);

			// 호텔 객실가격 시작일
			$sql     = "SELECT * FROM tbl_room_price WHERE product_idx = '". $roomData->goods_code ."' AND g_idx = '". $roomData->g_idx ."' AND rooms_idx = '". $rooms_idx ."' ORDER BY goods_date ASC limit 0,1 ";
			//write_log("from- ". $sql);
			$result  = $this->db->query($sql);
			$result  = $result->getResultArray();
			foreach ($result as $row) 
			{
					 $s_date = $row['goods_date']; 
			}

			// 호텔 객실가격 종료일
			$sql     = "SELECT * FROM tbl_room_price WHERE product_idx = '". $roomData->goods_code ."' AND g_idx = '". $roomData->g_idx ."' AND rooms_idx = '". $rooms_idx ."' ORDER BY goods_date DESC limit 0,1 ";
			//write_log("to- ". $sql);
			$result  = $this->db->query($sql);
			$result  = $result->getResultArray();
			foreach ($result as $row) 
			{
					 $e_date = $row['goods_date']; 
			}
 
			$sql_o = "UPDATE tbl_hotel_rooms  SET o_sdate = '". $from_date."'   
										  	    , o_edate = '". $to_date ."' WHERE rooms_idx = '". $rooms_idx ."' "; 
            //write_log("ajax_bedPrice_insert- ". $sql_o);											   
			$result = $this->db->query($sql_o);
			
			if ($result) {
				return $this->response->setJSON([
					'status' => 'success',
					'message' => '생성 OK'
				]);
			} else {
				return $this->response->setJSON([
					'status' => 'fail',
					'message' => '생성 실패'
				]);
			}
    }

	public function all_price_update()
	{
		header('Content-Type: application/json');

		$db = \Config\Database::connect(); // 데이터베이스 연결

		if ($this->request->getMethod() == 'post') {
			$uncheck  = $this->request->getPost('uncheck');
			$rows     = $this->request->getPost('rows');
			$errors   = [];

            $idxs = implode(',', $uncheck);
			
			$sql = "UPDATE tbl_room_price SET 
					upd_yn       = '', 
					upd_date     = now() 
					WHERE idx IN($idxs) ";

			// query() 메서드로 실행
			if (!$db->query($sql)) {
				$errors[] = "Update failed: " . $db->error();
			}
					
			try {
				foreach ($rows as $row) {
					$idx = (int) $row['idx'];
					$goods_price1 = (float) str_replace(',', '', $row['goods_price1']);
					$goods_price2 = (float) str_replace(',', '', $row['goods_price2']);
					$goods_price3 = (float) str_replace(',', '', $row['goods_price3']);
					$goods_price4 = (float) str_replace(',', '', $row['goods_price4']);
					$goods_price5 = (float) str_replace(',', '', $row['goods_price5']);
					$use_yn       = $row['use_yn'];

					// 바인딩된 SQL 쿼리 실행
					$sql = "UPDATE tbl_room_price SET 
							goods_price1 = $goods_price1, 
							goods_price2 = $goods_price2, 
							goods_price3 = $goods_price3, 
							goods_price4 = $goods_price4, 
							goods_price5 = $goods_price5, 
							use_yn       = '$use_yn', 
							upd_yn       = 'Y', 
							upd_date     = now() 
							WHERE idx = $idx";

					// query() 메서드로 실행
					if (!$db->query($sql)) {
						$errors[] = "Update failed: " . $db->error();
					}
				}

				if (empty($errors)) {
					return $this->response->setJSON(["status" => "success"]);
				} else {
					return $this->response->setJSON(["status" => "error", "message" => implode(", ", $errors)]);
				}
			} catch (Exception $e) {
				return $this->response->setJSON(["status" => "error", "message" => $e->getMessage()]);
			}
		} else {
			return $this->response->setJSON(["status" => "error", "message" => "잘못된 요청"]);
		}
	}

	public function update_upd_y()
	{
				$db = \Config\Database::connect(); // DB 연결

				// POST 데이터 받기
				$product_idx = $this->request->getPost('product_idx');	
				$g_idx 	     = $this->request->getPost('g_idx');
				$rooms_idx   = $this->request->getPost('rooms_idx');						
				$s_date      = $this->request->getPost('s_date');
				$e_date      = $this->request->getPost('e_date');
				$dow_val     = $this->request->getPost('dow_val'); // "일" 같은 문자열
				$idx         = $this->request->getPost('idx'); // 배열로 받아야 함
				$upd_yn      = $this->request->getPost('upd_yn');

				// dow_val을 배열로 변환 (빈 값 체크 및 공백 제거)
				$dowArray = (!empty($dow_val)) ? array_map('trim', explode(',', $dow_val)) : [];

				// 쿼리 실행
				$builder = $db->table('tbl_room_price');
				$builder->set('upd_yn', $upd_yn)
						->groupStart()  // 그룹 시작 (OR 조건을 그룹으로 묶기)
							->where('product_idx =', $product_idx)
							->where('g_idx       =', $g_idx)
							->where('rooms_idx   =', $rooms_idx)
							->where('goods_date >=', $s_date)
							->where('goods_date <=', $e_date)
						->groupEnd();  // 그룹 종료

				// idx 값이 있을 때만 whereIn('idx', $idx) 조건 추가
				if (!empty($idx)) {
					$builder->whereIn('idx', $idx);
				}

				if (!empty($dowArray)) {
					$builder->whereIn('dow', $dowArray);
				}

				$success = $builder->update();

				// 실행된 SQL 확인 (디버깅용)
				log_message('debug', $db->getLastQuery()); // 로그로 저장

				// 실행 결과 확인
				if ($success) {
					$message = ($upd_yn == "Y") ? '수정불가 설정완료' : '수정가능 설정완료';
					return $this->response
						->setStatusCode(200)
						->setJSON(['status' => 'success', 'message' => $message]);
				} else {
					return $this->response
						->setStatusCode(500)
						->setJSON(['status' => 'error', 'message' => 'Database update failed']);
				}
	}

    public function ajax_check_end()
    {

				$db = \Config\Database::connect(); // DB 연결

				// 체크된 항목 업데이트 (use_yn = 'N')
				if (!empty($_POST['checked_list']) && is_array($_POST['checked_list'])) {
					$checkedIdx = implode(",", array_map('intval', $_POST['checked_list']));
					$query      = "UPDATE tbl_room_price SET use_yn = 'N' WHERE idx IN ($checkedIdx)";
					$result1    = $db->query($query);
				}

				// 체크 해제된 항목 업데이트 (use_yn = '')
				if (!empty($_POST['unchecked_list']) && is_array($_POST['unchecked_list'])) {
					$uncheckedIdx = implode(",", array_map('intval', $_POST['unchecked_list']));
					$query        = "UPDATE tbl_room_price SET use_yn = '' WHERE idx IN ($uncheckedIdx)";
					$result2      = $db->query($query);
				}

				return $this->response
					->setStatusCode(200)
					->setJSON(['status' => 'success', 'message' => '일괄 마감완료']);

		
	}	

    public function ajax_golf_end()
    {

				$db = \Config\Database::connect(); // DB 연결

				// 체크된 항목 업데이트 (use_yn = 'N')
				if (!empty($_POST['checked_list']) && is_array($_POST['checked_list'])) {
					$checkedIdx = implode(",", array_map('intval', $_POST['checked_list']));
					$query      = "UPDATE tbl_golf_price SET use_yn = 'N' WHERE idx IN ($checkedIdx)";
					$result1    = $db->query($query);
				}

				// 체크 해제된 항목 업데이트 (use_yn = '')
				if (!empty($_POST['unchecked_list']) && is_array($_POST['unchecked_list'])) {
					$uncheckedIdx = implode(",", array_map('intval', $_POST['unchecked_list']));
					$query        = "UPDATE tbl_golf_price SET use_yn = '' WHERE idx IN ($uncheckedIdx)";
					$result2      = $db->query($query);
				}

				return $this->response
					->setStatusCode(200)
					->setJSON(['status' => 'success', 'message' => '일괄 마감완료']);

		
	}	
		
	public function ajax_trip_change()
	{
				$db = \Config\Database::connect(); // DB 연결

				$setting   = homeSetInfo();
				$baht_thai = (float)($setting['baht_thai'] ?? 0);

				// POST 데이터 받기
				$idx         = $this->request->getPost('idx');    
				$product_idx = $this->request->getPost('product_idx');    
				$goods_name  = $this->request->getPost('goods_name');    
				$type        = $this->request->getPost('type');
				$car         = $this->request->getPost('car');

				// 기본 가격 값 초기화
				$price_won  = 0;
				$price_bath = 0;

				// 골프 차량 금액 조회 (SQL Injection 방지를 위해 바인딩 사용)
				$sql = "SELECT * FROM tbl_golf_option WHERE idx = ? AND product_idx = ? AND goods_name = ?";
				$query = $db->query($sql, [$idx, $product_idx, $goods_name."홀" ]);

				if ($row = $query->getRowArray()) { // 단일 행 가져오기
					switch ($car) {
						case "1":
							$price_bath = ($type == "0") ? $row['vehicle_price1'] : $row['vehicle_o_price1'];
							break;
						case "2":
							$price_bath = ($type == "0") ? $row['vehicle_price2'] : $row['vehicle_o_price2'];
							break;
						case "3":
							$price_bath = ($type == "0") ? $row['vehicle_price3'] : $row['vehicle_o_price3'];
							break;
						default:
							return $this->response
								->setStatusCode(400)
								->setJSON(['status' => 'error', 'message' => '잘못된 차량 선택']);
					}

					$price_won = (int) round($price_bath * $baht_thai); // 원화 환산
				}

				return $this->response
					->setStatusCode(200)
					->setJSON(['status' => 'success', 'price_won' => $price_won, 'price_bath' => $price_bath]);
	}

	public function ajax_getMinDate()
	{
        $db = \Config\Database::connect();
		/*
		$o_idx     = $this->request->getPost('o_idx');
		
		$query     = $db->query("SELECT DATE_ADD(MAX(goods_date), INTERVAL 1 DAY) AS next_date 
							     FROM tbl_golf_price 
							     WHERE o_idx = '" . $o_idx . "'");
		$row       = $query->getRow();
		$next_date = $row->next_date;
        */
		
		$product_idx     = $this->request->getPost('product_idx');
		
		$query     = $db->query("SELECT DATE_ADD(MAX(edate), INTERVAL 1 DAY) AS next_date 
							     FROM tbl_golf_group 
							     WHERE product_idx = '" . $product_idx . "'");
		$row       = $query->getRow();
		$next_date = $row->next_date;
		
		if ($row) {
			return $this->response
					->setStatusCode(200)
					->setJSON(['status' => 'success', 'min_date' => $next_date]);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => '날짜를 불러올 수 없습니다.'
        ]);		
	}	
	
	public function ajax_golfPrice_add()
	{
			$db = \Config\Database::connect();
			$builder = $db->table('tbl_golf_group');

			// POST 데이터 수신
			$product_idx = $this->request->getPost('product_idx');

			// insert용 데이터 배열 구성
			$data = [
				'product_idx' => $product_idx,
				'reg_date'    => date('Y-m-d H:i:s') // DB now() 대신 PHP 처리
			];

			// 로그 출력
			//write_log("골프가격정보-1 : " . json_encode($data, JSON_UNESCAPED_UNICODE));

			// insert 실행
			$result = $builder->insert($data);

			if ($result) {
				return $this->response
							->setStatusCode(200)
							->setJSON(['status' => 'success', 'message' => '가격 등록완료']);
			} else {
				return $this->response
							->setStatusCode(500)
							->setJSON(['status' => 'error', 'message' => '가격 등록오류']);
			}

	}	
	
	public function ajax_golfHole_add()
	{
		$db = \Config\Database::connect(); // 데이터베이스 연결

		$product_idx  = $this->request->getPost("product_idx");
		$group_idx    = $this->request->getPost("group_idx");
		$goods_name   = $this->request->getPost("goods_name");
		$o_sdate      = $this->request->getPost("o_sdate");
		$o_edate      = $this->request->getPost("o_edate");

		try {
			
			$query     = $db->query("SELECT COUNT(*) AS cnt 
									 FROM tbl_golf_option 
									 WHERE product_idx = '" . $product_idx . "' AND group_idx = '". $group_idx ."' AND goods_name = '". $goods_name."' ");
			$row       = $query->getRow();
			if($row->cnt > 0) {
				$msg = "기 등록되어있는 홀입니다.";
				return $this->response
					->setStatusCode(200)
					->setJSON([
						'status'  => 'success',
						'message' => $msg
					]);
            }
			
			// 골프 홀 추가
			$sql = "INSERT INTO tbl_golf_option (product_idx, group_idx, goods_name, o_sdate, o_edate, option_type, reg_date) VALUES (?, ?, ?, ?, ?, 'M', NOW())";
			$db->query($sql, [$product_idx, $group_idx, $goods_name, $o_sdate, $o_edate]);

			// 마지막 삽입된 룸의 ID 가져오기
			$o_idx = $db->insertID();

			// 일자뱔 가격등록
			$dateRange   = getDateRange($o_sdate, $o_edate);

			$ii = -1;
			foreach ($dateRange as $date) 
			{ 
				$ii++;
		 
				$goods_date = $dateRange[$ii];
				$dow        = dateToYoil($goods_date);

				$sql_p = "INSERT INTO tbl_golf_price  SET  
													  o_idx        = '". $o_idx ."' 	
													 ,goods_date   = '". $goods_date ."' 	
													 ,dow 	       = '". $dow ."'
													 ,product_idx  = '". $product_idx ."' 
													 ,group_idx    = '". $group_idx ."' 
													 ,goods_name   = '". $goods_name ."' 
													 ,price_1      = '0'
													 ,price_2      = '0'
													 ,price_3      = '0'
													 ,day_yn       = ''
													 ,day_price    = '0'
													 ,night_yn     = 'Y'
													 ,night_price  = '0'
													 ,use_yn       = ''	
													 ,caddy_fee    = ''
													 ,cart_pie_fee = ''
													 ,reg_date     = now() ";
                //write_log($sql_p); 													 
				$result = $db->query($sql_p);
			} 
	
			$msg = "홀 등록 완료";

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg
				]);
		} catch (\Exception $e) {
			return $this->response
				->setStatusCode(500)
				->setJSON([
					'status'  => 'error',
					'message' => "룸 등록 오류: " . $e->getMessage()
				]);
		}	
		
    }	
	
	function getKoreanDay($num)
	{
		$days = ['일', '월', '화', '수', '목', '금', '토'];
		return $days[$num];
	}

	public function ajax_golfGroup_del()
	{
		$db = \Config\Database::connect(); // 데이터베이스 연결

		$db->transBegin();

		try {
			$group_idx = $this->request->getPost("group_idx");

			if (empty($group_idx)) {
				return $this->response
					->setStatusCode(400)
					->setJSON([
						'status' => 'error',
						'message' => 'No group_idx provided'
					]);
			}

			$db->query("DELETE FROM tbl_golf_group  WHERE group_idx = ?", [$group_idx]);
			$db->query("DELETE FROM tbl_golf_option WHERE group_idx = ?", [$group_idx]);
			$db->query("DELETE FROM tbl_golf_price  WHERE group_idx = ?", [$group_idx]);

			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '삭제 중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '골프가격 삭제완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}
		
	}
	
	public function ajax_golfGroup_copy()
	{
		$db = \Config\Database::connect();

		$old_group_idx = $this->request->getPost("group_idx");

		// 새로운 group_idx 생성 (예: max값 + 1)
		$builder = $db->table('tbl_golf_group');
		$new_group_idx = $db->table('tbl_golf_group')->selectMax('group_idx')->get()->getRow()->group_idx + 1;

		// 1. tbl_golf_group 복사
		$oldGroup = $db->table('tbl_golf_group')->where('group_idx', $old_group_idx)->get()->getRowArray();
		if ($oldGroup) {
			unset($oldGroup['group_idx']);
			$oldGroup['group_idx'] = $new_group_idx;
			$oldGroup['sdate']     = "";
			$oldGroup['edate']     = "";
			$oldGroup['reg_date'] = date('Y-m-d H:i:s');
			$db->table('tbl_golf_group')->insert($oldGroup);
		}

		// 2. tbl_golf_option 복사
		$options = $db->table('tbl_golf_option')->where('group_idx', $old_group_idx)->get()->getResultArray();
		foreach ($options as $opt) {
			$old_o_idx = $opt['idx'];
			unset($opt['idx']); // auto_increment 제거
			$opt['group_idx'] = $new_group_idx;
			$opt['o_sdate']   = "";
			$opt['o_edate']   = "";
			$opt['reg_date']  = date('Y-m-d H:i:s');
			$db->table('tbl_golf_option')->insert($opt);
			$new_o_idx = $db->insertID();

			// 3. tbl_golf_price 복사
			/*
			$prices = $db->table('tbl_golf_price')->where('o_idx', $old_o_idx)->get()->getResultArray();
			foreach ($prices as $price) {
				unset($price['idx']);
				$price['group_idx'] = $new_group_idx;
				$price['o_idx'] = $new_o_idx;
				
				$price['reg_date'] = date('Y-m-d H:i:s');
				$price['upd_date'] = date('Y-m-d H:i:s');
				$db->table('tbl_golf_price')->insert($price);
			}
			*/
		}

		return $this->response->setStatusCode(200)->setJSON([
			'status'  => 'success',
			'message' => '복사 완료'
		]);

	}	
	
	public function get_start_date()
	{
		$db = \Config\Database::connect();
		$product_idx = $this->request->getPost('product_idx');

		if (!$product_idx) {
			return $this->response->setStatusCode(400)->setJSON([
				'status' => 'error',
				'message' => '상품코드 누락'
			]);
		}

		$query     = $db->query("SELECT DATE_ADD(MAX(edate), INTERVAL 1 DAY) AS next_date 
							     FROM tbl_golf_group 
							     WHERE product_idx = '" . $product_idx . "'");
		$row       = $query->getRow();
		$next_date = $row->next_date;
 
		if ($next_date) {
			return $this->response->setJSON([
				'sdate' => $next_date
			]);
		} else {
			return $this->response->setJSON([
				'sdate' => date('Y-m-d')  // 기본값
			]);
		}
	}
	
	public function ajax_golfDay_update()
	{	
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$group_idx = $this->request->getPost("group_idx");
			$sdate     = $this->request->getPost("sdate");
			$edate     = $this->request->getPost("edate");

			if (empty($group_idx)) {
				return $this->response
					->setStatusCode(400)
					->setJSON([
						'status'  => 'error',
						'message' => 'No group_idx provided'
					]);
			}

			$db->query("UPDATE tbl_golf_group SET sdate = ?, edate = ? WHERE group_idx = ?", [$sdate, $edate, $group_idx]);

			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '기간 설정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '기간설정 완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
	}
	
	public function ajax_mainDisp_ranks()
    {
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$rankData = $this->request->getPost("rankData");
            $arr = explode("|", $rankData);

            for($i=0;$i<count($arr);$i++)
			{	
				$var = explode(":", $arr[$i]);
			    $db->query("UPDATE tbl_main_disp SET onum = ? WHERE code_idx = ?", [$var[1], $var[0]]);
            } 
			
			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '순위 설정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '순위설정 완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}			
	}
	
	public function ajax_golfOpt_ranks()
	{	
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$rankData = $this->request->getPost("rankData");
            $arr = explode("|", $rankData);

            for($i=0;$i<count($arr);$i++)
			{	
				$var = explode(":", $arr[$i]);
			    $db->query("UPDATE tbl_golf_option SET o_seq = ? WHERE idx = ?", [$var[1], $var[0]]);
            } 
			
			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '순위 설정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '순위설정 완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
	}
	
	
	public function ajax_golf_upd_y()
	{	
			$db = \Config\Database::connect(); // DB 연결

			// POST 데이터 받기
			$product_idx = $this->request->getPost('product_idx');	
			$group_idx   = $this->request->getPost('group_idx');
			$s_date      = $this->request->getPost('s_date');
			$e_date      = $this->request->getPost('e_date');
			$dow_val     = $this->request->getPost('dow_val'); // "일" 같은 문자열
			$idx         = $this->request->getPost('idx');     // 배열로 받아야 함
			$upd_yn      = $this->request->getPost('upd_yn');

			// dow_val을 배열로 변환 (빈 값 체크 및 공백 제거)
			$dowArray = (!empty($dow_val)) ? array_map('trim', explode(',', $dow_val)) : [];

			// 쿼리 실행
			$builder = $db->table('tbl_golf_price');
			$builder->set('upd_yn', $upd_yn)
					->groupStart()  // 그룹 시작 (OR 조건을 그룹으로 묶기)
						->where('product_idx =', $product_idx)
						//->where('goods_date >=', $s_date)
						//->where('goods_date <=', $e_date)
					->groupEnd();  // 그룹 종료

			// idx 값이 있을 때만 whereIn('idx', $idx) 조건 추가
			if (!empty($idx)) {
				$builder->whereIn('idx', $idx);
			}

			if (!empty($dowArray)) {
				$builder->whereIn('dow', $dowArray);
			}

			$success = $builder->update();
            
			//write_log("ajax_golf_upd_y- ". $db->getLastQuery());
			
			// 실행된 SQL 확인 (디버깅용)
			log_message('debug', $db->getLastQuery()); // 로그로 저장

			// 실행 결과 확인
			if ($success) {
				$message = ($upd_yn == "Y") ? '수정불가 설정완료' : '수정가능 설정완료';
				return $this->response
					->setStatusCode(200)
					->setJSON(['status' => 'success', 'message' => $message]);
			} else {
				return $this->response
					->setStatusCode(500)
					->setJSON(['status' => 'error', 'message' => 'Database update failed']);
			}		
	}
	
	public function ajax_golfPrice_all()
    {
			$db = \Config\Database::connect(); // DB 연결

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$optionsx = $_POST['optionsx'] ?? [];

				if (hasOverlappingDateRanges($optionsx)) {
					return $this->response->setStatusCode(200)->setJSON([
						'status'  => 'success',
						'message' => '중복된 날짜 구간이 있습니다.'
					]);
				}	
					
			}

			
			$data              = $this->request->getPost();
			$product_idx       = $data['product_idx'];

			$options           = $data['optGolf']; // 다차원 배열로 받음

			foreach ($options as $index => $option) 
			{
   					$group_idx         = $option['group_idx'];
					$o_sdate           = $option['o_sdate'];				
					$o_edate           = $option['o_edate'];				

					// 일자별 가격설정
					$sql = "DELETE FROM tbl_golf_price 
							WHERE group_idx = ?
							AND product_idx = ?
							AND use_yn     != 'N'
							AND upd_yn     != 'Y'";

					$result = $db->query($sql, [$group_idx, $product_idx]);
					//write_log('LAST QUERY: ' . $db->getLastQuery());
            
            }

			foreach ($options as $index => $option) {
		
					$o_idx             = $option['o_optidx'];
					$group_idx         = $option['group_idx'];
					$option_type       = $option['option_type'];
					$o_name            = $option['goods_name'];
					$o_sdate           = $option['o_sdate'];				
					$o_edate           = $option['o_edate'];				
					$o_price1_1        = $option['o_price1_1'];
					$o_price1_2        = $option['o_price1_2'];
					$o_price1_3        = $option['o_price1_3'];
					$o_price2_1        = $option['o_price2_1'];
					$o_price2_2        = $option['o_price2_2'];
					$o_price2_3        = $option['o_price2_3'];
					$o_price3_1        = $option['o_price3_1'];
					$o_price3_2        = $option['o_price3_2'];
					$o_price3_3        = $option['o_price3_3'];
					$o_price4_1        = $option['o_price4_1'];
					$o_price4_2        = $option['o_price4_2'];
					$o_price4_3        = $option['o_price4_3'];
					$o_price5_1        = $option['o_price5_1'];
					$o_price5_2        = $option['o_price5_2'];
					$o_price5_3        = $option['o_price5_3'];
					$o_price6_1        = $option['o_price6_1'];
					$o_price6_2        = $option['o_price6_2'];
					$o_price6_3        = $option['o_price6_3'];
					$o_price7_1        = $option['o_price7_1'];
					$o_price7_2        = $option['o_price7_2'];
					$o_price7_3        = $option['o_price7_3'];
					$vehicle_price1    = $option['vehicle_price1'];
					$vehicle_price2    = $option['vehicle_price2'];
					$vehicle_price3    = $option['vehicle_price3'];
					$vehicle_o_price1  = $option['vehicle_o_price1'];
					$vehicle_o_price2  = $option['vehicle_o_price2'];
					$vehicle_o_price3  = $option['vehicle_o_price3'];
					$cart_price        = $option['cart_price'];
					$o_cart_due        = $option['o_cart_due'];
					$o_caddy_due       = $option['o_caddy_due'];
					$o_cart_cont       = $option['o_cart_cont'];
					$o_caddy_cont      = $option['o_caddy_cont'];
					$caddie_fee        = $option['caddie_fee'];

					$o_golf            = $option['o_golf'];
					$option_type       = $option['option_type'];
					$o_soldout         = $option['o_soldout'];
			 
					if ($o_idx) {
						$sql_g  = "UPDATE tbl_golf_group SET sdate = '". $o_sdate ."', edate = '". $o_edate ."' WHERE group_idx = '". $group_idx ."' ";
						$result = $db->query($sql_g);

						$sql    = "UPDATE  tbl_golf_option  SET 
															 goods_name		= '" . $o_name . "'
															,goods_price1_1	= '" . $o_price1_1 . "'
															,goods_price1_2	= '" . $o_price1_2 . "'
															,goods_price1_3	= '" . $o_price1_3 . "'
															,goods_price2_1	= '" . $o_price2_1 . "'
															,goods_price2_2	= '" . $o_price2_2 . "'
															,goods_price2_3	= '" . $o_price2_3 . "'
															,goods_price3_1	= '" . $o_price3_1 . "'
															,goods_price3_2	= '" . $o_price3_2 . "'
															,goods_price3_3	= '" . $o_price3_3 . "'
															,goods_price4_1	= '" . $o_price4_1 . "'
															,goods_price4_2	= '" . $o_price4_2 . "'
															,goods_price4_3	= '" . $o_price4_3 . "'
															,goods_price5_1	= '" . $o_price5_1 . "'
															,goods_price5_2	= '" . $o_price5_2 . "'
															,goods_price5_3	= '" . $o_price5_3 . "'
															,goods_price6_1	= '" . $o_price6_1 . "'
															,goods_price6_2	= '" . $o_price6_2 . "'
															,goods_price6_3	= '" . $o_price6_3 . "'
															,goods_price7_1	= '" . $o_price7_1 . "'
															,goods_price7_2	= '" . $o_price7_2 . "'
															,goods_price7_3	= '" . $o_price7_3 . "'
															
															,vehicle_price1 = '" . $vehicle_price1 . "'
															,vehicle_price2 = '" . $vehicle_price2 . "'
															,vehicle_price3 = '" . $vehicle_price3 . "'
															,vehicle_o_price1 = '" . $vehicle_o_price1 . "'
															,vehicle_o_price2 = '" . $vehicle_o_price2 . "'
															,vehicle_o_price3 = '" . $vehicle_o_price3 . "'
															,cart_price     = '" . $cart_price . "'
															,caddie_fee     = '" . $caddie_fee . "'	
															,o_cart_due     = '" . $o_cart_due . "'	
															,o_caddy_due    = '" . $o_caddy_due . "'	
															,o_cart_cont    = '" . $o_cart_cont . "'	
															,o_caddy_cont   = '" . $o_caddy_cont . "'	
															
															,o_sdate		= '" . $o_sdate . "'
															,o_edate		= '" . $o_edate . "'
															,o_golf			= '" . $o_golf . "'
															,option_type	= '" . $option_type . "'
															,o_soldout		= '" . $o_soldout . "'
														WHERE idx	        = '" . $o_idx . "' ";
						//write_log("111- ". $sql);								
						$result = $db->query($sql);
					}
					
					$ii = -1;
					$dateRange = getDateRange($o_sdate, $o_edate);
					foreach ($dateRange as $date) {

						$ii++;
						$golf_date = $dateRange[$ii];
						$dow       = dateToYoil($golf_date);

						if ($dow == "일") {
							$price1 = $o_price1_1;
							$price2 = $o_price1_2;
							$price3 = $o_price1_3;
						}
						
						if ($dow == "월") {
							$price1 = $o_price2_1;
							$price2 = $o_price2_2;
							$price3 = $o_price2_3;
						}
						
						if ($dow == "화") {
							$price1 = $o_price3_1;
							$price2 = $o_price3_2;
							$price3 = $o_price3_3;
						}
						
						if ($dow == "수") {
							$price1 = $o_price4_1;
							$price2 = $o_price4_2;
							$price3 = $o_price4_3;
						}
						
						if ($dow == "목") {
							$price1 = $o_price5_1;
							$price2 = $o_price5_2;
							$price3 = $o_price5_3;
						}
						
						if ($dow == "금") {
							$price1 = $o_price6_1;
							$price2 = $o_price6_2;
							$price3 = $o_price6_3;
						}
						
						if ($dow == "토") {
							$price1 = $o_price7_1;
							$price2 = $o_price7_2;
							$price3 = $o_price7_3;
						}

						$sql_1 = "SELECT * FROM tbl_golf_price WHERE o_idx	      = '". $o_idx ."'       AND
																	 goods_date   = '". $golf_date ."'   AND
																	 dow	      = '". $dow ."'         AND	
							                                         product_idx  = '". $product_idx. "' AND 
						                                             group_idx    = '". $group_idx ."'   AND 
						                                             goods_name   = '". $o_name ."'"; 
						//write_log("sql_1- ". $sql_1);
						$cnt_1 = $db->query($sql_1)->getNumRows();
						
						if($cnt_1 == 0) {
							$sql_c = "INSERT INTO tbl_golf_price  SET  
																	  o_idx	      = '" . $o_idx . "'	
																	, goods_date  = '" . $golf_date . "'	
																	, dow	      = '" . $dow . "'	
																	, product_idx = '" . $product_idx . "'	
																	, group_idx   = '" . $group_idx . "'	
																	, goods_name  = '" . $o_name . "'	
																	, price_1	  = '" . $price1 . "'	
																	, price_2	  = '" . $price2 . "'	
																	, price_3	  = '" . $price3 . "'	
																	, use_yn	  = ''	
																	, reg_date    = now() ";
						    //write_log("sql_c- ". $sql_c);
							$db->query($sql_c);
					    }		
					}
					
			}
			
			// 골프 옵션 조회
			$sql = "SELECT DISTINCT(goods_name) AS goods_name 
					FROM tbl_golf_price 
					WHERE product_idx = ? "; 
			$query   = $db->query($sql, [$product_idx]);
			$results = $query->getResultArray();

			$holes_number = ""; 
			foreach ($results as $row) {
				if($holes_number == "") {
				   $holes_number  = $row['goods_name'];
				} else {  
				   $holes_number .= ", ". $row['goods_name'];
				}   
			}

			// 업데이트 쿼리 실행
			$sql_u = "UPDATE tbl_golf_info SET holes_number = ? WHERE product_idx = ?";
			$db->query($sql_u, [$holes_number, $product_idx]);
			
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '기간요금 설정완료'
			]);
		
    }	
	
	public function ajax_payment()
    {
        $db         = \Config\Database::connect();

		$array = explode(",", $this->request->getPost('dataValue'));	

		// 각 요소에 작은따옴표 추가
		$quotedArray = array_map(function($item) {
			return "'" . $item . "'";
		}, $array);

		// 배열을 다시 문자열로 변환
		$output = implode(',', $quotedArray);
 
		$sql = "SELECT 
				tbl_order_mst.*, SUM(tbl_order_mst.order_price) AS payment_price, 
				GROUP_CONCAT(CONCAT(tbl_order_option.option_name, ':', tbl_order_option.option_cnt) SEPARATOR '|') as options
				FROM 
					tbl_order_mst
				LEFT JOIN 
					tbl_order_option 
				ON 
					tbl_order_mst.order_idx = tbl_order_option.order_idx
				WHERE tbl_order_mst.order_no IN(". $output .") AND order_no != '' 
				GROUP BY 
					tbl_order_mst.order_no ";
		$result = $db->query($sql)->getResultArray();

		$payment_no            = "P_". date('YmdHis') . rand(100, 999); 				// 가맹점 결제번호

		return $this->response->setStatusCode(200)->setJSON([
            "result"     => $result,
			"payment_no" => $payment_no
		]);
		
	}
	
	public function ajax_calc_set()
	{
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$order_idx = $this->request->getPost("order_idx");
			$calc      = $this->request->getPost("calc");
			
		    $db->query("UPDATE tbl_order_mst SET calc = ? WHERE order_idx = ?", [$calc, $order_idx]);
			
			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '정산 설정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '정산설정 완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
	}
	
	public function ajax_price_update()
    {
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$order_no        = $this->request->getPost("order_no");
			$real_price_bath = (float) str_replace(',', '', $this->request->getPost("real_price_bath"));
			$real_price_won  = (float) str_replace(',', '', $this->request->getPost("real_price_won"));
            $m_idx = session()->get("member")["idx"] ?? 0;
            $ipAddress = $this->request->getIPAddress();

			$order_idx = $this->orderModel->where('order_no', $order_no)->get()->getRow()->order_idx;

            $db->query("UPDATE tbl_order_mst SET real_price_won = ?, real_price_bath = ? WHERE order_no = ?", [$real_price_won, $real_price_bath, $order_no]);
			
			$this->historyOrderUpdate->insertData([
                "m_idx" => $m_idx,
                "order_idx" => $order_idx,
                "ip_address" => $ipAddress,
                "updated_date" =>  Time::now('Asia/Seoul')->format('Y-m-d H:i:s'),
            ]);

			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '결제금액 수정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '결제금액 수정완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
    }
	
	public function ajax_voucher_update()
    {
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$order_no        = $this->request->getPost("order_no");
			$voucher_price_bath = (float) str_replace(',', '', $this->request->getPost("voucher_price_bath"));
			$voucher_price_won  = (float) str_replace(',', '', $this->request->getPost("voucher_price_won"));

            $db->query("UPDATE tbl_order_mst SET voucher_price_won = ?, voucher_price_bath = ? WHERE order_no = ?", [$voucher_price_won, $voucher_price_bath, $order_no]);
			
			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '바우처금액 수정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '바우처금액 수정완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
    }
	
	public function ajax_group_movement()
	{
		$m_idx    = $this->request->getPost('m_idx');
		$group_no = $this->request->getPost('group_no');

		$db = \Config\Database::connect();

		// ① 전체 그룹 목록
		$groups = $db->query("SELECT DISTINCT(group_no) AS group_no FROM tbl_order_mst WHERE m_idx = '". $m_idx ."' AND group_no != '". $group_no."' ORDER BY group_no ASC")->getResultArray();

		// ② 해당 그룹의 아이템 목록
		$items = $db->query("SELECT * FROM tbl_order_mst WHERE group_no = ?", [$group_no])->getResultArray();

		$data = [
			'group_no' => $group_no,
			'groups'   => $groups,
			'items'    => $items
		];

		return view('admin/_reservation/popup_group_movement', $data);
	}

    public function ajax_group_change()
    {
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$order_idxs    = explode('|', $this->request->getPost('order_idxs')); // 예: "101|102|103"
			$selectedGroup = $this->request->getPost('selectedGroup');

			foreach ($order_idxs as $idx) {
				$db->query("UPDATE tbl_order_mst SET group_no = ? WHERE order_idx = ?", [$selectedGroup, $idx]);
			}

			
			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '그룹변겸중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '그룹변겸 완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
		
	}	
	
	public function ajax_group_estimate()
	{
		$m_idx    = $this->request->getPost('m_idx');
		$group_no = $this->request->getPost('group_no');

		$db = \Config\Database::connect();

		// 요약 정보 (상품 코드별 집계)
		$sql = "SELECT code_name, 
					   COUNT(order_idx) AS cnt,
					   SUM(real_price_bath) AS total_bath,
					   SUM(real_price_won) AS total_won
				FROM tbl_order_mst
				WHERE group_no = ?
				GROUP BY code_name";

		$sum = $db->query($sql, [$group_no])->getResultArray();

		// ① 그룹 해당 예약 목록
		$items = $db->query("SELECT * FROM tbl_order_mst WHERE m_idx = ? AND group_no = ?", [$m_idx, $group_no])->getResultArray();

		$data = [
			'group_no' => $group_no,
			'sum'      => $sum,
			'items'    => $items
		];

		return view('admin/_reservation/popup_group_estimate', $data);
	}

	public function ajax_grade_update()
    {
		$db = \Config\Database::connect();

		$db->transBegin();

		try {
			$g_idx       = $this->request->getPost('g_idx');
			$grade_name  = $this->request->getPost('grade_name');
			$amount_rate = $this->request->getPost('amount_rate');

            $db->query("UPDATE tbl_member_grade SET grade_name = ?, amount_rate = ?, upd_date = now() WHERE g_idx = ?",[$grade_name, $amount_rate, $g_idx]);
			
			if ($db->transStatus() === false) {
				$db->transRollback();
				return $this->response->setStatusCode(500)->setJSON([
					'status'  => 'error',
					'message' => '등급 정보 수정중 오류가 발생했습니다.'
				]);
			}

			$db->transCommit();
			return $this->response->setStatusCode(200)->setJSON([
				'status'  => 'success',
				'message' => '등급 정보 수정완료'
			]);

		} catch (\Exception $e) {
			$db->transRollback();
			return $this->response->setStatusCode(500)->setJSON([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}		
		
	}	
	
	public function ajax_estimate_mailsend()
    {
		    $db = \Config\Database::connect(); // 데이터베이스 연결
		    $private_key = private_key();
 		
			$group_no  = $_POST["group_no"];
			$order_no  = "S20250423002";
 
			$sql       = "SELECT   *
			                     , AES_DECRYPT(UNHEX(order_user_name),   '$private_key') AS user_name
						         , AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS user_mobile  
						         , AES_DECRYPT(UNHEX(order_user_email),  '$private_key') AS user_email  FROM tbl_order_mst WHERE order_no = '". $order_no ."' ";
 								 
			$row         = $db->query($sql)->getRow();
 		    $order_price = number_format($row->order_price) ."원";
			$code        = "A21";
			$user_mail   = $row->user_email;
			$checkin     = $row->start_date ."(". get_korean_day($row->start_date) .") ~ ". $row->end_date ."(". get_korean_day($row->end_date) .") / ". $row->order_day_cnt ."일";
			$_tmp_fir_array = [
				
				'예약번호'    => $order_no,
	            '예약일자'    => substr($row->order_r_date,0,10),
	            '회원이름'    => $row->user_name,
 	            '이메일'      => $row->user_email,
 	            '전화번호'     => $row->user_mobile,
				'체크인'	      => $checkin,
				'여행자성명'   => $row->user_name,
				'여행자연락처' => $row->user_mobile,
				'여행자이메일' => $row->user_email,
				'여행상품'     => $row->product_name,	
				'총인원'       => $row->order_room_cnt ."Room",
				'총금액'	      => $order_price,
				'총견적금액'   => $order_price
			];
	
			autoEmail($code, $user_mail, $_tmp_fir_array);
	
		    $msg    = "전송완료";	
			
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'status'  => 'success',
					'message' => $msg 
				]);		
	}
	
	public function ajax_nicepay_cancelResult()
	{
		$db      = \Config\Database::connect();
		$setting = homeSetInfo();

		$paymentNo = $this->request->getPost('payment_no');

		$row = $db->table('tbl_payment_mst')
				  ->where('payment_no', $paymentNo)
				  ->get()
				  ->getRowArray();

		if (!$row) {
			return $this->response->setJSON(['message' => '결제 정보가 없습니다.']);
		}

		$orderList = "'" . implode("','", array_filter(explode(',', rtrim($row['order_no'], ',')))) . "'";

		$merchantKey = $setting['nicepay_key'];
		$mid         = $setting['nicepay_mid'];
		$moid        = $paymentNo;
		$cancelMsg   = "고객요청";

		$tid       = $row['TID_1'];
		$cancelAmt = $row['Amt_1'];

		$ediDate   = date("YmdHis");
		$signData  = bin2hex(hash('sha256', $mid . $cancelAmt . $ediDate . $merchantKey, true));

		try {
			$data = [
				'TID'               => $tid,
				'MID'               => $mid,
				'Moid'              => $moid,
				'CancelAmt'         => $cancelAmt,
				'CancelMsg'         => iconv("UTF-8", "EUC-KR", $cancelMsg),
				'PartialCancelCode' => '0',
				'EdiDate'           => $ediDate,
				'SignData'          => $signData,
				'CharSet'           => 'utf-8'
			];

			$response = $this->reqPost($data, "https://webapi.nicepay.co.kr/webapi/cancel_process.jsp");
			$responseData = json_decode($response, true);

			$resultCode = $responseData['ResultCode'] ?? '9999';
			$resultMsg  = $responseData['ResultMsg']  ?? '응답 오류';

			if (in_array($resultCode, ['2001', '2211'])) {
				$cancelDate = $responseData['CancelDate'] ?? date('Y-m-d H:i:s');

				$db->table('tbl_payment_hist')
				   ->where('TID', $tid)
				   ->update(['order_status' => 'C', 'CancelDate' => $cancelDate]);

				// 여러 주문번호에 대해 업데이트 수행
				$db->query("UPDATE tbl_order_mst SET CancelDate_1 = ?, order_status = 'C' WHERE order_no IN ($orderList)", [$cancelDate]);

				return $this->response->setJSON(['message' => "[$resultCode] $resultMsg"]);
			} else {
				return $this->response->setJSON(['message' => "[$resultCode] $resultMsg"]);
			}

		} catch (\Exception $e) {
			return $this->response->setJSON(['message' => "[9999] 통신실패: " . $e->getMessage()]);
		}
	}

	// POST API 요청 함수
	private function reqPost(array $data, string $url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_POST, true);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}

	public function  ajax_order_del()
	{
		$db = \Config\Database::connect();

		try {
			$orderIdx = $this->request->getPost('order_idx');

			if (empty($orderIdx)) {
				return $this->response
					->setStatusCode(400)
					->setJSON([
						'result'  => false,
						'message' => 'order_idx not provided'
					]);
			}

			// 단일 값이 넘어왔을 경우 배열로 변환
			if (!is_array($orderIdx)) {
				$orderIdx = [$orderIdx];
			}

			$builder = $db->table('tbl_order_mst');
			$builder->whereIn('order_idx', $orderIdx);
			$deleted = $builder->delete();

			$msg = $deleted ? "예약 삭제 완료" : "예약 삭제 실패";

			return $this->response
				->setStatusCode(200)
				->setJSON([
					'result'  => $deleted ? true : false,
					'message' => $msg
				]);
		} catch (\Exception $e) {
			return $this->response
				->setStatusCode(500)
				->setJSON([
					'result' => false,
					'message' => $e->getMessage()
				]);
		}
	}

    public function  ajax_temp()
	{
		$db = \Config\Database::connect();
		
		// 3. 로그 (CI4 방식 사용)
		//write_log("ajax_temp");  // logs/log-*.php에 기록됨

		// 4. 알림톡 함수 호출
		$payment_idx = "2097";
		alimTalk_depisit_send($payment_idx);
		
		echo "ajax_temp end ";
	}
	
	public function ajax_order_cancel()
	{
		$db = \Config\Database::connect();
		$order_idx = $this->request->getPost('order_idx');

		if (!$order_idx) {
			return $this->response
				->setStatusCode(400)
				->setJSON([
					'result'  => false,
					'message' => 'order_idx가 전달되지 않았습니다.'
				]);
		}

		// 바인딩 방식으로 SQL 실행
		$sql = "UPDATE tbl_order_mst SET CancelDate_1 = NOW(), order_status = 'C' WHERE order_idx = ?";
		$result = $db->query($sql, [$order_idx]);

		if ($result && $db->affectedRows() > 0) {
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'result'  => true,
					'message' => '예약취소 완료'
				]);
		} else {
			return $this->response
				->setStatusCode(500)
				->setJSON([
					'result'  => false,
					'message' => '예약취소에 실패했습니다. (존재하지 않거나 이미 취소됨)'
				]);
		}
	}

	public function ajax_order_delete()
	{
		$db = \Config\Database::connect();
		$order_no = $this->request->getPost('order_no');

		if (!$order_no) {
			return $this->response
				->setStatusCode(400)
				->setJSON([
					'result'  => false,
					'message' => '예약번호가 전달되지 않았습니다.'
				]);
		}

		// 바인딩 방식으로 SQL 실행
		$sql = "DELETE FROM tbl_order_mst WHERE order_no = ?";
		$result = $db->query($sql, [$order_no]);

		if ($result && $db->affectedRows() > 0) {
			return $this->response
				->setStatusCode(200)
				->setJSON([
					'result'  => true,
					'message' => '예약삭제 완료'
				]);
		} else {
			return $this->response
				->setStatusCode(500)
				->setJSON([
					'result'  => false,
					'message' => '예약삭제 실패했습니다. (존재하지 않거나 이미 삭제됨)'
				]);
		}
	}		
}	