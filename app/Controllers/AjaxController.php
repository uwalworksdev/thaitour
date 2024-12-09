<?php

namespace App\Controllers;

class AjaxController extends BaseController {
    private $db;
    private $productModel;


    public function __construct() {
        $this->db = db_connect();
        $this->productModel = model("ProductModel");

    }

    public function uploader() {
        $r_reg_m_idx = $this->request->getPost('r_reg_m_idx');
        $r_code = $this->request->getPost('r_code') ?? '000';
        $path = "../public/uploads/data/editor_img/$r_code/";
        $uploadPath = WRITEPATH . $path;

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
        $code = $this->request->getPost('code');
        $depth = $this->request->getPost('depth');
        $db = \Config\Database::connect();

        $sql = "SELECT * FROM tbl_code WHERE parent_code_no = '$code' AND depth = '$depth' order by onum desc";
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
            $db    = \Config\Database::connect();

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

	
	public function golf_price_update()   
    {
            $db           = \Config\Database::connect();
            
			$product_idx  = $_POST['product_idx'];
			$idx          = $_POST['idx'];
			$hole_cnt     = $_POST['hole_cnt'];
			$hour         = $_POST['hour'];
			$minute       = $_POST['minute'];

			$option_price = str_replace(',', '', $_POST['option_price']);
			$caddy_fee    = $_POST['caddy_fee'];
			$cart_pie_fee = $_POST['cart_pie_fee'];
            $use_yn       = $_POST['use_yn'];

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
				$sql = "UPDATE tbl_golf_price SET  hole_cnt     = '". $hole_cnt    ."'  
												 , hour         = '". $hour        ."'  
												 , minute       = '". $minute     ."'  
												 , option_price = '". $option_price ."'
												 , caddy_fee    = '". $caddy_fee ."'
												 , cart_pie_fee = '". $cart_pie_fee ."'
												 , use_yn       = '". $use_yn ."'
												 , upd_date     = now() WHERE idx = '". $idx ."'  ";
			}

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
	
	public function golf_price_delete()   
    {
            $db    = \Config\Database::connect();

            $idx          = $_POST['idx'];
			
			$sql = "DELETE FROM tbl_golf_price WHERE idx = '". $idx ."'  ";
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

	public function golf_price_allupdate()   
    {
            $db    = \Config\Database::connect();

            $product_idx  = $_POST['product_idx'];
            $idx          = $_POST['idx'];

			$hole_cnt     = $_POST['hole_cnt'];
			$hour         = $_POST['hour'];
			$minute       = $_POST['minute'];

			$golf_date    = $_POST['golf_date'];
			$option_price = str_replace(',', '', $_POST['option_price']);
			$caddy_fee    = $_POST['caddy_fee'];
			$cart_pie_fee = $_POST['cart_pie_fee'];
            //$chk_idx      = explode(",", $_POST['chk_idx']);

            //for($i=0;$i<count($chk_idx);$i++)
		    //{
			//	    $temp   =  explode(":", $chk_idx[$i]);
			//		$sql    = "UPDATE tbl_golf_price SET use_yn = '". $temp[1] ."' WHERE idx = '". $temp[0] ."'  ";
			//		$result = $db->query($sql);
            //}

            for($i=0;$i<count($idx);$i++)
		    {

					$sql          = "SELECT * FROM tbl_golf_option WHERE product_idx = '". $product_idx  ."' AND
																		 hole_cnt    = '". $hole_cnt[$i] ."' AND
																		 hour        = '". $hour[$i]     ."' AND  
																		 minute      = '". $minute[$i]   ."' ";
					write_log("1- ". $sql);
					$result       = $db->query($sql);
					$nTotalCount  = $result->getNumRows();

					if($nTotalCount == 0) {
						$sql = "INSERT INTO tbl_golf_option SET product_idx	  = '". $product_idx ."'	
															   ,hole_cnt      = '". $hole_cnt[$i]."'  
															   ,hour          = '". $hour[$i]    ."'  
															   ,minute        = '". $minute[$i]  ."'  
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
														 , hole_cnt     = '". $hole_cnt[$i]    ."'  
														 , hour         = '". $hour[$i]        ."'  
														 , minute       = '". $minute[$i]     ."'  
														 , option_price = '". $option_price[$i] ."'
														 , caddy_fee    = '". $caddy_fee[$i] ."'
														 , cart_pie_fee = '". $cart_pie_fee[$i] ."'
														 , upd_date     = now() WHERE idx = '". $idx[$i] ."'  ";
					} else {
						$sql = "UPDATE tbl_golf_price SET  hole_cnt     = '". $hole_cnt[$i]    ."'  
														 , hour         = '". $hour[$i]        ."'  
														 , minute       = '". $minute[$i]     ."'  
														 , option_price = '". $option_price[$i] ."'
														 , caddy_fee    = '". $caddy_fee[$i] ."'
														 , cart_pie_fee = '". $cart_pie_fee[$i] ."'
														 , upd_date     = now() WHERE idx = '". $idx[$i] ."'  ";
					}

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
		    $days        = $_POST['days'];

			$sql    = "SELECT * FROM tbl_golf_price WHERE product_idx = '$product_idx' ORDER BY golf_date desc limit 0,1 ";
			write_log($sql);
			$result = $db->query($sql)->getResultArray();
			foreach($result as $row)
		    { 
				      write_log($row['o_idx'] ." - ". $row['golf_date']); 
					  $o_idx       = $row['o_idx'];
					  $from_date   = $row['golf_date'];  
		    }

			// 결과 출력
            $from_date   = day_after($from_date, 1);
            $to_date     = day_after($from_date, $days-1);
			$dateRange   = getDateRange($from_date, $to_date);

			$ii = -1;
			foreach ($dateRange as $date) 
			{ 
				$ii++;
		 
				$golf_date = $dateRange[$ii];
				$dow       = dateToYoil($golf_date);

				$sql_p = "INSERT INTO tbl_golf_price  SET  
													  o_idx        = '". $o_idx ."' 	
													 ,golf_date    = '". $golf_date ."' 	
													 ,dow 	       = '". $dow ."'
													 ,product_idx  = '". $product_idx ."' 
                                                     ,hole_cnt     = ''
                                                     ,hour         = ''	
                                                     ,minute	   = ''
                                                     ,option_price = '0'
                                                     ,use_yn	   = ''
                                                     ,caddy_fee	   = ''	
                                                     ,cart_pie_fee = ''
													 ,reg_date     = now() ";
				write_log("일정추가 : ".$sql_p);
				$result = $db->query($sql_p);
			} 

			// 골프가격 시작일
			$sql     = "SELECT * FROM tbl_golf_price WHERE product_idx = '". $product_idx ."' ORDER BY golf_date ASC LIMIT 0,1";
			$result  = $db->query($sql);
			$result  = $result->getResultArray();
			foreach ($result as $row) 
			{
					 $s_date = $row['golf_date']; 
			}

			// 골프가격 종료일
			$sql     =  "SELECT * FROM tbl_golf_price WHERE product_idx = '". $product_idx ."' ORDER BY golf_date DESC LIMIT 0,1";
			$result  = $db->query($sql);
			$result  = $result->getResultArray();
			foreach ($result as $row) 
			{
					 $e_date = $row['golf_date']; 
			}

			$sql_o = "UPDATE tbl_golf_info  SET s_date = '". $s_date."'   
										  	  , e_date = '". $e_date ."' WHERE product_idx = '". $product_idx ."' "; 	
			write_log("일정추가 : ".$sql_o);
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
	
}