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
        $uploadPath = ROOTPATH . "public/uploads/data/editor_img/$r_code/";

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

    public function golf_option_delete()
    {
            $db    = \Config\Database::connect();

            $idx   = $_POST['idx'];
			
			$sql = "DELETE FROM tbl_golf_option WHERE idx = '". $idx ."'  ";
			write_log($sql);
			$result = $db->query($sql);

			$sql = "DELETE FROM tbl_golf_price WHERE o_idx = '". $idx ."'  ";
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
			write_log("dow_val- ". $dow_val);
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
			write_log("dow_val- ". $dow_val);
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
				      write_log($row['o_idx'] ." - ". $row['goods_date']); 
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
            write_log($sql_o);											   
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

	public function cart_payment() {

		    $db = \Config\Database::connect(); // 데이터베이스 연결

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
					'tot_cnt' => $row->tot_cnt
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
		$merchantKey    = "EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg=="; // 상점키
		$MID            = "nicepay00m"; // 상점아이디

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
            write_log($sql);
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
	
}