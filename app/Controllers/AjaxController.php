<?php

namespace App\Controllers;
use DateTime;

class AjaxController extends BaseController {
    private $db;
    private $productModel;
    private $roomImg;
    private $CodeModel;


    public function __construct() {
        $this->db = db_connect();
        $this->productModel = model("ProductModel");
        $this->roomImg = model("RoomImg");
        $this->CodeModel = model("Code");
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
		$setting      = homeSetInfo();
        $product_idx  = $this->request->getPost('product_idx');
        $goods_name   = $this->request->getPost('goods_name');
        $db           = \Config\Database::connect();
        $baht_thai    = (float)($setting['baht_thai'] ?? 0);

        $sql  = "SELECT * FROM tbl_golf_option WHERE product_idx = '$product_idx' AND goods_name = '$goods_name' ";
        $rows = $db->query($sql)->getResultArray();

		foreach ($rows as $row) {
				 
                 $vehicle_price1_ba = $row['vehicle_price1'];	
	             $vehicle_price2_ba = $row['vehicle_price2'];	
	             $vehicle_price3_ba = $row['vehicle_price3'];	
	             $cart_price_ba     = $row['cart_price'];
	             $caddie_fee_ba     = $row['caddie_fee']; 
				 
                 $vehicle_price1    = $row['vehicle_price1'] * $baht_thai;	
	             $vehicle_price2    = $row['vehicle_price2'] * $baht_thai; 	
	             $vehicle_price3    = $row['vehicle_price3'] * $baht_thai; 	
	             $cart_price        = $row['cart_price']     * $baht_thai;
	             $caddie_fee        = $row['caddie_fee']     * $baht_thai;   
		}

        $output = [
					"vehicle_price1"     => $vehicle_price1,
					"vehicle_price2"     => $vehicle_price2,
					"vehicle_price3"     => $vehicle_price3,
					"cart_price"         => $cart_price,
					"caddie_fee"         => $caddie_fee, 
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
			write_log($sql);
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
			write_log($sql);
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
						write_log($sql);
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

			write_log("popup update");

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
			
			write_log($sql);
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
			write_log($sql);
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
			write_log($sql);
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
				$bed_type = $postData['bed_type'][$key] ?? []; // 베드타입
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
				if (!is_array($bed_type)) {
					$bed_type = [$bed_type];
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
						
						$price1[$i] = str_replace(",", "", $price1[$i]); // 콤마 제거
						$price2[$i] = str_replace(",", "", $price2[$i]); // 콤마 제거
						$price3[$i] = str_replace(",", "", $price3[$i]); // 콤마 제거
						$price4[$i] = str_replace(",", "", $price4[$i]); // 콤마 제거
						$price5[$i] = str_replace(",", "", $price5[$i]); // 콤마 제거
					
						$sql_bed = "UPDATE tbl_room_beds 
									SET bed_type       = ?, 
										bed_seq        = ?, 
										goods_price1   = ?, 
										goods_price2   = ?, 
										goods_price3   = ?, 
										goods_price4   = ?, 
										goods_price5   = ? 
									WHERE bed_idx = ?";

						//write_log("SQL 실행: " . $sql_bed . " 값: [" . $bed_type[$i] . ", " . $bed_seq[$i] . ", " . $price1[$i] . ", " . $price2[$i] . ", " . $price3[$i] . ", " . $price4[$i] . ", " . $price5[$i] . "]");

						$result = $db->query($sql_bed, [$bed_type[$i], $bed_seq[$i], $price1[$i], $price2[$i], $price3[$i], $price4[$i], $price5[$i], $bed_idx[$i]]);
						
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
						$result = $db->query($sql_c);
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
 /*
            // 룸 일자별 가격저장
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
				$secret_price     = $postData['secret_price'][$key] ?? '';    // 비밀특가

				$ii = -1;
				$dateRange = getDateRange($o_sdate, $o_edate);
				foreach ($dateRange as $date) {

					$ii++;
					$room_date = $dateRange[$ii];
					$dow       = dateToYoil($room_date);

					$sql_opt = "SELECT count(*) AS cnt FROM tbl_room_price WHERE product_idx = '". $goods_code ."' AND g_idx = '". $g_idx ."' AND rooms_idx = '". $rooms_idx ."' AND goods_date = '". $room_date ."'  ";
					//write_log("2- " . $sql_opt);
					$option = $db->query($sql_opt)->getRowArray();
					if ($option['cnt'] == 0) {
						$sql_c = "INSERT INTO tbl_room_price  SET  
																 product_idx  = '". $goods_code ."'
																,g_idx        = '". $g_idx ."'
																,rooms_idx    = '". $rooms_idx ."'
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
			}   
*/ 			
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

	        $sql            = "SELECT distinct(g_idx) AS g_idx FROM tbl_hotel_rooms
			                                                   WHERE ('$date_check_in'  BETWEEN o_sdate AND o_edate) AND 
			                                                         ('$date_check_out' BETWEEN o_sdate AND o_edate) AND  
																	 goods_code = '". $product_idx ."' ORDER BY g_idx DESC ";
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
											<img src="/uploads/sub/hotel_item_1_1.png" alt="hotel_item_1_1">
										</div>
										<div class="wrap_btn_detail">
                                             <a href="javascript:showPopupRoom(\'' . $type['g_idx'] . '\')">객실 상세정보 및 사진 ></a>
                                        </div>'; 

                    
                            $arr_type_room = explode("|", $row['category']);
                            $arr_text_type = [];
                            foreach($fresult11 as $category){
                                if(in_array($category["code_no"], $arr_type_room)){
                                    $arr_text_type[] = $category["code_name"];
                                }
                            }
                        
							$msg .= '<div class="area_info">
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
												 $msg .= '<tr class="room_op_" data-room="'. $room['rooms_idx'] .'" data-opid="149" data-optype="S" data-ho_idx="'. $row['goods_code'] .'">
																<td>
																	<div class="room-details">
																		<p class="room-p-cus-1">'. $room['room_name'] .'</p>';
																		
																		if($room['breakfast'] != "N") {
																		   $breakfast = "조식 포함";
																		} else {
																		   $breakfast = "조식 비포함";	
																		}   
																		
																		$option_val = explode(",", $room['option_val']);
																		
																		$msg .= '<ul>
																			<li><span>'. $breakfast .'</span> <img src="/images/sub/question-icon.png" alt="" style="width : 14px; margin-top : 4px ; opacity: 0.6;"></li>';
											
																		for($i=0;$i<count($option_val);$i++) { 
																			$msg .= '<li>'. htmlspecialchars_decode($option_val[$i]) .'</li>';
																		} 
																			
																		$msg .= '</ul>
																	             </div>
																</td>																
											                    <td>
																	<div class="people_qty">
																		<img src="/images/sub/user-iconn.png" alt="">
																		<p>성인 : '. $room['adult'] .'명</p>
																		<p>아동 : '. $room['kids'] .'명</p>
																		<a href="#!" style="color : #104aa8">혜택보기 &gt;</a> 
																	</div>
																</td>';

												$result    = depositPrice($db, $room['goods_code'], $room['g_idx'], $room['rooms_idx'], $date_check_in, $date_check_out);
											  
												$arr       = explode("|", $result);
												$room['goods_price1']  = $arr[0];											
												$room['goods_price2']  = $arr[1];											
												$room['goods_price3']  = $arr[2];											
												$room['goods_price4']  = $arr[3];											
												$room['goods_price5']  = $arr[4];											
                                                $baht_thai             = $arr[5];
												
												$basic_won  =  (int)($room['goods_price1'] * $baht_thai);
												$basic_bath =  $room['goods_price1'];
											
												$price_won  =  (int)(($room['goods_price2'] + $room['goods_price3']) * $baht_thai);
												$price_bath =  $room['goods_price2'] + $room['goods_price3'];
															
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
																<span class="price-strike hotel_price_day_sale" data-price="'. $basic_bath .'">('. number_format($basic_bath) .'바트)1</span> 
															</span>';
													
													if($room['special_discount'] == "Y") {  	
														$msg .= '<div class="discount" style="">
																<span class="label">특별할인</span>
																<span class="price_content"><i class="hotel_price_percent">'. $room['discount_rate'] .'</i>%할인</span>
																</div>';
													}  
													$msg .= '</div>';
												}
												
												$msg .=		'<div class="wrap_btn_book">
															<button type="button" id="reserv_'. $room['rooms_idx'] .'" data-idx="'. $room['rooms_idx'] .'" class="reservation book-button book_btn_217" >예약하기</button>
															<p class="wrap_btn_book_note">세금서비스비용 포함</p>
														</div>
														</div>';
														
												$result    = detailPrice($db, $room['goods_code'], $room['g_idx'], $room['rooms_idx'], $date_check_in, $days);
											  
												$msg .= '<div class="wrap_bed_type">
														<p class="tit"><span>침대타입(요청사항)'. $result .'</span> <img src="/images/sub/question-icon.png" alt="" style="width : 14px ; opacity: 0.6;"></p>
														<div class="wrap_input_radio">';

												$arr  = explode("|", $result);
												
												for($i=0;$i<count($arr);$i++)
		                                        {	 
													 $_room     =  explode(":", $arr[$i]);
													 $baht_thai =  $_room[6];
													 $real_won  =  (int)(($_room[2] + $_room[3]) * $baht_thai);
													 $real_bath =  $_room[2] + $_room[3];
													 
												     $msg .= '<div class="wrap_input">
															  <input type="radio" name="bed_type_" id="bed_type_'. $room['g_idx'].$room['rooms_idx'].$i .'" 
															  data-room="'. $hotel_room .'" data-price="'. $real_won .'"  data-adult="'. $room['adult'] .'" data-kids="'. $room['kids'] .'"  
															  data-roomtype="'. $room['room_name'] .'" data-breakfast="'. $room['breakfast'] .'" data-won="'. $real_won .'" 
															  data-bath="'. $real_bath .'" data-type="'. $bed_type[$i] .'" value="'. $room['rooms_idx'] .'" class="sel_'. $room['rooms_idx'] .'">
															  <label for="bed_type_'. $room['g_idx'] . $room['rooms_idx'] . $i .'">'.$_room[0] .':';
													 if($room['secret_price'] == "Y"){
																$msg .=		'<span>비밀특가</span>';
													 }else{
														$msg .=	' <span style="color :coral">'. number_format($real_won) .'원 ('.  number_format($real_bath) .'바트)xxxxx</span></label>';
													 }
													 $msg .= '</div>';
											    } 
												  
												if($extra_won > 0) {
													  $msg .= '<div class="wrap_check">';
													  $msg .= '<input type="checkbox" name="extra_" id="extra_'. $room['g_idx'].$room['rooms_idx'].$i .'" 
																data-name="Extra베드" data-won="'. $extra_won .'" data-bath="'. $extra_bath .'" value="'. $room['rooms_idx'] .'" >';
													  $msg .= '<label for="extra_'. $room['g_idx'].$room['rooms_idx'].$i .'" >Extra 베드: <span style="color :coral">'. number_format($extra_won) .'원 ('.  number_format($extra_bath) .'바트)</span></label>';
													  $msg .= '</div>';
                                                }
												  
												$msg .= '</div>
														   </div>
														   </td>
														   </tr>';
                             			endforeach; 

										$msg .= '</tbody>
									</table>
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
			$price        = str_replace(',', '', $_POST['price']);
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
				$sql = "UPDATE tbl_golf_price SET  price        = '". $price ."'
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

			$o_idx    = $_POST['o_idx'];
			$dow_val  = $_POST['dow_val'];
			
			if($dow_val == "") {
			   $sql    = " UPDATE tbl_golf_price SET use_yn = 'Y'  WHERE o_idx = '$o_idx' ";
            } else {
			   $sql    = " UPDATE tbl_golf_price SET use_yn = 'N'  WHERE dow in($dow_val) AND o_idx = '$o_idx' ";
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

			$o_idx    = $_POST['o_idx'];
			$dow_val  = $_POST['dow_val'];
			$price    = $_POST['price'];

		    $sql    = " UPDATE tbl_golf_price SET price = '". $price ."'  WHERE dow in($dow_val) AND o_idx = '$o_idx' ";
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

			$price        = str_replace(',', '', $_POST['price']);
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

					$sql = "UPDATE tbl_golf_price SET  price     = '". $price[$i]    ."'  
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
		    $days        = $_POST['days'];

			$sql    = "SELECT * FROM tbl_golf_price WHERE product_idx = '$product_idx' AND o_idx = '$o_idx' ORDER BY goods_date desc limit 0,1 ";
			$result = $db->query($sql)->getResultArray();
			foreach($result as $row)
		    { 
				      //write_log($row['o_idx'] ." - ". $row['goods_date']); 
					  $o_idx       = $row['o_idx'];
					  $goods_name  = $row['goods_name'];  
					  $from_date   = $row['goods_date'];  
		    }

			// 결과 출력
            $from_date   = day_after($from_date, 1);
            $to_date     = day_after($from_date, $days-1);
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
											, upd_yn       = 'Y'
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

			$s_date        = $_POST['s_date'];
			$e_date        = $_POST['e_date'];	
			$dow_val       = $_POST['dow_val'];
			$product_idx   = $_POST['product_idx'];
			$g_idx         = $_POST['g_idx'];
			$roomIdx       = $_POST['roomIdx'];
			$goods_price1  = $_POST['goods_price1'];
			$goods_price2  = $_POST['goods_price2'];
			$goods_price3  = $_POST['goods_price3'];
			$goods_price4  = $goods_price2 + $goods_price3;
			$goods_price5  = $_POST['goods_price5'];

			
		    $sql    = " UPDATE tbl_room_price SET goods_price1 = '". $goods_price1 ."'
			                                     ,goods_price2 = '". $goods_price2 ."' 
			                                     ,goods_price3 = '". $goods_price3 ."' 
			                                     ,goods_price4 = '". $goods_price4 ."' 
			                                     ,goods_price5 = '". $goods_price5 ."' 
			                                     ,upd_yn       = 'Y' 
												 ,upd_date     =     now()
			                                      WHERE dow in($dow_val) 
												  AND product_idx = '$product_idx' 
												  AND g_idx       = '$g_idx' 
												  AND rooms_idx   = '$roomIdx' 
												  AND goods_date BETWEEN '". $s_date ."' AND '". $e_date ."' ";
			//write_log("dow_val- ". $dow_val ." - ". $sql);
			$result = $db->query($sql);
			

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
/*
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
		$merchantKey    = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키
		$MID            = "nicepay00m"; // 상점아이디

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
            //write_log($sql);
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
	
	public function ajax_incoiceHotel_send()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
		    $private_key = private_key();
 		
			$order_no  = $_POST["order_no"];
 
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
	
	public function ajax_voucherHotel_send()
	{
		    $db = \Config\Database::connect(); // 데이터베이스 연결
		    $private_key = private_key();
 		
			$order_no  = $_POST["order_no"];
 
			$sql       = "SELECT   *
			                     , AES_DECRYPT(UNHEX(order_user_name),   '$private_key') AS user_name
						         , AES_DECRYPT(UNHEX(order_user_mobile), '$private_key') AS user_mobile  
						         , AES_DECRYPT(UNHEX(order_user_email),  '$private_key') AS user_email  FROM tbl_order_mst WHERE order_no = '". $order_no ."' ";
			//write_log("ajax_voucherHotel_send- ". $sql);					 
 								 
			$row         = $db->query($sql)->getRow();
 		    $order_price = number_format($row->order_price) ."원";
			$code        = "A20";
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
 		
			$order_idx     =  $_POST["order_idx"];
			$order_status  =  $_POST["order_status"];

            $sql    = "	UPDATE tbl_order_mst SET order_status  = '". $order_status ."', order_r_date = now() WHERE order_idx = '". $order_idx ."'";  
			$result = $db->query($sql);
			
			if($result) {
		       $msg  = "예약 변경완료";
			} else { 
		       $msg  = "예약 변경오류";	
			}
			
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
			$sql = "INSERT INTO tbl_room_beds 
					(rooms_idx, bed_type, goods_price1, goods_price2, goods_price3, goods_price4, goods_price5, bed_seq, reg_date) 
					VALUES (?, '침대타입', 0, 0, 0, 0, 0, 0, NOW())";
			$db->query($sql, [$rooms_idx]);

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

			$sql       = "INSERT INTO tbl_room_beds (rooms_idx, bed_seq, reg_date) VALUES (?, ?, NOW())";
			$result    = $db->query($sql, [$rooms_idx, 9999]);

			if ($result) {
				$status = "success";
				$msg    = "DB 업데이트 OK";
			} else {
				$status = "fail";
				$msg    = "DB 업데이트 실패";
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

			$sql_o = "UPDATE tbl_hotel_rooms  SET o_sdate = '". $s_date."'   
										  	    , o_edate = '". $e_date ."' WHERE rooms_idx = '". $rooms_idx ."' "; 
            //write_log($sql_o);											   
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
			$db = \Config\Database::connect(); // 데이터베이스 연결

			// POST 값 받기
			$idx = $this->request->getPost('idx');  // idx 값 배열
			$upd_yn = $this->request->getPost('upd_yn');  // 수정할 값

			// idx 값이 배열인지 확인
			if (empty($idx) || !is_array($idx)) {
				return $this->response
					->setStatusCode(400)
					->setJSON(['status' => 'error', 'message' => 'Invalid idx values']);
			}

			// Prepared Statement 사용하여 SQL 안전하게 처리
			$builder = $db->table('tbl_room_price');

			// 'idx' 배열을 안전하게 처리하여 update 쿼리 실행
			$builder->whereIn('idx', $idx);
			$builder->update(['upd_yn' => $upd_yn]);

			// 결과 확인
			if ($db->affectedRows() > 0) {
				return $this->response
					->setStatusCode(200)
					->setJSON(['status' => 'success', 'message' => 'DB 업데이트 OK']);
			} else {
				return $this->response
					->setStatusCode(500)
					->setJSON(['status' => 'fail', 'message' => 'DB 업데이트 실패']);
			}
	}
	
}	