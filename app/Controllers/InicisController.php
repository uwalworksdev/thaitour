<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use CodeIgniter\Database\Config;
use CodeIgniter\I18n\Time;
use Config\Services;
use CodeIgniter\Controller;

use Libraries\INIStdPayUtil;
use Libraries\HttpClient;
use Libraries\properties;
use Libraries\propertiesM;

class InicisController extends BaseController
{
    public function processPayment()
    {
        // 라이브러리 인스턴스 생성
        $util   = new INIStdPayUtil();
        $client = new HttpClient();
        $prop   = new properties();

        // 사용 예시
        $timestamp = $util->getTimestamp();
        echo "Timestamp: " . $timestamp;
    }

    public function request()
    {
        // 로직 구현

		$data[] = "";
		return $this->renderView('inicis_request', $data);
    }

    public function close()
    {
        // 로직 구현

		$data[] = "";
		return $this->renderView('inicis_close', $data);
    }

	public function inicisResult()
	{
		$session = session();

        $db  = \Config\Database::connect();

		require_once(APPPATH . 'Libraries/INIStdPayUtil.php');
		require_once(APPPATH . 'Libraries/HttpClient.php');
		require_once(APPPATH . 'Libraries/properties.php');

        $util = new INIStdPayUtil();
        $prop = new properties();

	    header("Content-Type:text/html; charset=utf-8;"); 

		try {
 
            //#############################
            // 인증결과 파라미터 수신
            //#############################

            if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {
 
                //############################################
                // 1.전문 필드 값 설정(***가맹점 개발수정***)
                //############################################
 
                $mid            = $_REQUEST["mid"];
                $signKey 	    = $setting['inicis_key']; //"SU5JTElURV9UUklQTEVERVNfS0VZU1RS";
                $timestamp      = $util->getTimestamp();
                $charset        = "UTF-8";
                $format         = "JSON";
                $authToken      = $_REQUEST["authToken"]; 
                $authUrl        = $_REQUEST["authUrl"];
                $netCancel      = $_REQUEST["netCancelUrl"];        
                $merchantData   = $_REQUEST["merchantData"];
                
				//##########################################################################
				// 승인요청 API url (authUrl) 리스트 는 properties 에 세팅하여 사용합니다.
				// idc_name 으로 수신 받은 센터 네임을 properties 에서 include 하여 승인요청하시면 됩니다.
				//##########################################################################
                $idc_name 	= $_REQUEST["idc_name"];
                $authUrl    = $prop->getAuthUrl($idc_name);

                if (strcmp($authUrl, $_REQUEST["authUrl"]) == 0) {

                    //#####################
                    // 2.signature 생성
                    //#####################
                    $signParam["authToken"] = $authToken;   // 필수
                    $signParam["timestamp"] = $timestamp;   // 필수
                    // signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
                    $signature = $util->makeSignature($signParam);

                    $veriParam["authToken"] = $authToken;   // 필수
                    $veriParam["signKey"]   = $signKey;     // 필수
                    $veriParam["timestamp"] = $timestamp;   // 필수
                    // verification 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)
                    $verification = $util->makeSignature($veriParam);
    
    
                    //#####################
                    // 3.API 요청 전문 생성
                    //#####################
                    $authMap["mid"]          = $mid;            // 필수
                    $authMap["authToken"]    = $authToken;      // 필수
                    $authMap["signature"]    = $signature;      // 필수
                    $authMap["verification"] = $verification;   // 필수
                    $authMap["timestamp"]    = $timestamp;      // 필수
                    $authMap["charset"]      = $charset;        // default=UTF-8
                    $authMap["format"]       = $format;         // default=XML
    
                    try {
    
                        $httpUtil = new HttpClient();
    
                        //#####################
                        // 4.API 통신 시작
                        //#####################
    
                        $authResultString = "";
                        if ($httpUtil->processHTTP($authUrl, $authMap)) {
                            $authResultString = $httpUtil->body;
    
                        } else {
                            echo "Http Connect Error\n";
                            echo $httpUtil->errormsg;
    
                            throw new Exception("Http Connect Error");
                        }
    
                        //############################################################
                        //5.API 통신결과 처리(***가맹점 개발수정***)
                        //############################################################
                        
                        $resultMap = json_decode($authResultString, true);
    
					    $paydate  = date("YmdHis");
						
						// 1. 결제 정보 업데이트
						$data = [
									'payment_method'  => '신용카드',
									'payment_status'  => 'Y',
									'payment_pg'      => 'INICIS',
									'paydate'         => $paydate,
									'ResultCode_1'    => $resultMap['resultCode'],
									'ResultMsg_1'     => $resultMap['resultMsg'],
									'Amt_1'           => $resultMap['TotPrice'],
									'TID_1'           => $resultMap['tid'],
									'AuthCode_1'      => $resultMap['applNum'],
									'AuthDate_1'      => $resultMap['AuthDate']
						];

						// 업데이트 실행
						$db->table('tbl_payment_mst')
						   ->where('payment_no', $resultMap['MOID'])
						   ->update($data);

						// 2. 업데이트된 결제 정보 조회
						$row = $db->table('tbl_payment_mst')
								  ->where('payment_no', $resultMap['MOID'])
								  ->get()
								  ->getRowArray();

						// 사용자 ID 추출
						$m_idx = $row['m_idx'];
						

						$output = explode(",", $row['order_no']);
						// 끝에 쉼표 제거
						$order_no = rtrim($row['order_no'], ',');

						// 문자열을 배열로 변환
						$orderArr = explode(',', $row['order_no']);

						// 각 항목을 따옴표로 감싸기
						$orderList = "'" . implode("','", $orderArr) . "'";

						$sql = "UPDATE tbl_order_mst SET  order_method   = '신용카드'  
														, order_status   = 'Y' 
														, payment_no     = '". $resultMap['MOID'] ."'
														, ResultCode_1   = '". $resultMap['resultCode'] ."'
														, ResultMsg_1    = '". $resultMap['resultMsg'] ."'
														, Amt_1          = '". $resultMap['TotPrice'] ."'
														, TID_1          = '". $resultMap['tid'] ."'
														, AuthCode_1     = '". $resultMap['applNum'] ."'
														, AuthDate_1     = '". $resultMap['AuthDate'] ."'
														WHERE order_no IN(". $orderList .") "; 
						write_log("inicisResult- ". $sql);								
						$db->query($sql);

						// 쿠폰, 포인트 소멸부분 추가
						if($row['used_coupon_idx']) {
						   $sql = "UPDATE tbl_coupon SET status = 'E'	WHERE c_idx = '". $row['used_coupon_idx'] ."' "; 
						   $db->query($sql);
						}

						// 포인트 소멸부분 추가
						if($row['used_point'] > 0) {
						   $mi_title      = $row['product_name'] ."(". $row['order_no'] .")";
						   $order_mileage = $row['used_point'] * -1; 
						   $sql = "INSERT INTO tbl_order_mileage SET
																 mi_title          = '". $mi_title ."'
															   , order_idx         = '". $row['payment_idx'] ."'
															   , order_no          = '". $row['order_no'] ."'
															   , order_mileage     = '". $order_mileage ."'
															   , order_gubun       = '통합결제'
															   , m_idx             = '". $row['m_idx']."'
															   , product_idx       = ''
															   , mi_r_date         = now() ";
						   $db->query($sql);
						   set_all_mileage($row['m_idx']);
						}

						// 포인트 지급
						$sql   = "select a.user_id, a.m_idx, b.amount_rate from tbl_member a
												left join tbl_member_grade b on a.user_level = b.user_level where a.m_idx = '". $row['m_idx'] ."' ";
						$row_p = $db->query($sql)->getRowArray();
						$order_mileage = $resultMap['TotPrice'] * $row_p['amount_rate'] / 100;
						
						$mi_title = "예약결제 후 포인트지급(". $moid .")";
						$sql_m    = "insert tbl_order_mileage set
															  mi_title          = '". $mi_title ."'
															 ,order_idx         = '". $row['payment_idx'] ."'
															 ,order_no          = '". $row['order_no'] ."'
															 ,order_mileage     = '". $order_mileage ."'
															 ,order_gubun       = '예약포인트 지급'
															 ,m_idx             = '". $row['m_idx'] ."'
															 ,mi_r_date         = now()
															 ,remaining_mileage = '' ";
						$db->query($sql_m);
						$insertId    = $db->insertID();
						
						$sql		 = " select ifnull(sum(order_mileage),0) as sum_mileage from tbl_order_mileage where m_idx = '".$row['m_idx']."' ";
						$row         = $db->query($sql)->getRowArray();
						$sum_mileage = $row["sum_mileage"];

						$sql = "update tbl_member SET mileage = '".$sum_mileage."' where m_idx = '".$row['m_idx']."' ";																   
						$db->query($sql);

						$sql = "update tbl_order_mileage SET remaining_mileage = '".$sum_mileage."' where mi_idx = '".$insertId."' ";																   
						$db->query($sql);

                    } catch (Exception $e) {
                        //    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                        //####################################
                        // 실패시 처리(***가맹점 개발수정***)
                        //####################################
                        //---- db 저장 실패시 등 예외처리----//
                        $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
                        echo $s;
    
                        //#####################
                        // 망취소 API
                        //#####################
    
                        $netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
                        $netCancel    = $prop->getNetCancel($idc_name);
                        
                        if (strcmp($netCancel, $_REQUEST["netCancelUrl"]) == 0) {

                            if ($httpUtil->processHTTP($netCancel, $authMap)) {
                                $netcancelResultString = $httpUtil->body;
                            } else {
                                echo "Http Connect Error\n";
                                echo $httpUtil->errormsg;
        
                                throw new Exception("Http Connect Error");
                            }
        
                            echo "<br/>## 망취소 API 결과 ##<br/>";
                            
                            /*##XML output##*/
                            //$netcancelResultString = str_replace("<", "&lt;", $$netcancelResultString);
                            //$netcancelResultString = str_replace(">", "&gt;", $$netcancelResultString);
        
                            // 취소 결과 확인
                            echo "<p>". $netcancelResultString . "</p>";
                        }
                    }

                } else {
                    echo "authUrl check Fail\n";
                }

            } else {
 
            }

        } catch (Exception $e) {
            $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
            echo $s;
        }

        $data = [];

		$sql = " SELECT * from tbl_member WHERE m_idx = '" . $m_idx . "'";
		$row = $db->query($sql)->getRowArray();

        $data['id']    = $row['user_id'];
        $data['idx']   = $row['m_idx'];
        $data["mIdx"]  = $row['m_idx'];
        $data['name']  = encryptField($row['user_name'], "decode");
        $data['email'] = encryptField($row['user_email'], "decode");
        $data['level'] = $row['user_level'];
        $data['phone'] = encryptField($row['user_mobile'], "decode");

        session()->set("member", $data);

	    $data['ResultMsg'] = $resultMap['resultMsg'];

	    return $this->renderView('inicis_result', $data);

    }

	public function inicisResult_m()
	{
	   $session = session();

       $db  = \Config\Database::connect();

       require_once(APPPATH . 'Libraries/propertiesM.php');

	   $prop = new propertiesM();
	 
	   $P_STATUS    = $_REQUEST["P_STATUS"];
	   $P_RMESG1    = $_REQUEST["P_RMESG1"];
	   $P_TID       = $_REQUEST["P_TID"];
	   $P_REQ_URL   = $_REQUEST["P_REQ_URL"];
	   $P_NOTI      = $_REQUEST["P_NOTI"];
	   $P_AMT       = $_REQUEST["P_AMT"];
	  
	   if ($_REQUEST["P_STATUS"] === "00") {             // 인증이 P_STATUS===00 일 경우만 승인 요청
	 
			$id_merchant = substr($P_TID,'10','10');     // P_TID 내 MID 구분
			$data = array(
			
			 'P_MID' => $id_merchant,         // P_MID
			 'P_TID' => $P_TID                // P_TID

			);

			//##########################################################################
			// 승인요청 API url (authUrl) 리스트 는 properties 에 세팅하여 사용합니다.
			// idc_name 으로 수신 받은 센터 네임을 properties 에서 include 하여 승인요청하시면 됩니다.
			//##########################################################################
			$idc_name 	= $_REQUEST["idc_name"];
			$P_REQ_URL  = $prop->getAuthUrl($idc_name); 
	 
			if (strcmp($P_REQ_URL, $_REQUEST["P_REQ_URL"]) == 0) {
			
					// curl 통신 시작 
				
					$ch = curl_init();                                                //curl 초기화
					curl_setopt($ch, CURLOPT_URL, $_REQUEST["P_REQ_URL"]);            //URL 지정하기
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                   //요청 결과를 문자열로 반환 
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);                     //connection timeout 10초 
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);                      //원격 서버의 인증서가 유효한지 검사 안함
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));    //POST 로 $data 를 보냄
					curl_setopt($ch, CURLOPT_POST, 1);                                //true시 post 전송 
			
			
					$response = curl_exec($ch);
					//write_log($response);
					curl_close($ch);

					parse_str($response, $out);
					//print_r($out);
					
					$paydate  = date("YmdHis");
					
					$sql = "UPDATE tbl_payment_mst SET payment_method  = '신용카드'
													  ,payment_status  = 'Y'
												      ,payment_pg      = 'INICIS'
													  ,paydate		   = '". $paydate ."'
													  ,ResultCode_1    = '". $out["P_STATUS"] ."'
													  ,ResultMsg_1     = '". $out["P_RMESG1"] ."'
													  ,Amt_1           = '". $out["P_AMT"] ."'
													  ,TID_1           = '". $out["P_TID"] ."'
													  ,AuthCode_1      = '". $out['P_AUTH_NO'] ."'
													  ,AuthDate_1      = '". $out["P_AUTH_DT"] ."' 
													  WHERE payment_no = '". $out["P_OID"] ."'";
					$result = $db->query($sql);

					$sql   = " SELECT * from tbl_payment_mst WHERE payment_no = '" . $out["P_OID"] . "'";
					$row   = $db->query($sql)->getRowArray();
					$m_idx = $row['m_idx'];

					$output = explode(",", $row['order_no']);
					// 끝에 쉼표 제거
					$order_no = rtrim($row['order_no'], ',');

					// 문자열을 배열로 변환
					$orderArr = explode(',', $row['order_no']);

					// 각 항목을 따옴표로 감싸기
					$orderList = "'" . implode("','", $orderArr) . "'";

					$sql = "UPDATE tbl_order_mst SET order_method   = '신용카드'  
													,order_status   = 'Y' 
													,payment_no     = '". $out["P_OID"] ."'
													,ResultCode_1   = '". $out["P_STATUS"] ."'
													,ResultMsg_1    = '". $out["P_RMESG1"] ."'
													,Amt_1          = '". $out["P_AMT"] ."'
													,TID_1          = '". $out["P_TID"] ."'
													,AuthCode_1     = '". $out['P_AUTH_NO'] ."'
													,AuthDate_1     = '". $out["P_AUTH_DT"] ."' 
													WHERE order_no IN(". $orderList .") "; 
					write_log("Inicis-1 ". $sql);								
					$db->query($sql);
								

					// 쿠폰, 포인트 소멸부분 추가
					if($row['used_coupon_idx']) {
					   $sql = "UPDATE tbl_coupon SET status = 'E'	WHERE c_idx = '". $row['used_coupon_idx'] ."' "; 
					   $db->query($sql);
					}

					// 포인트 소멸부분 추가
					if($row['used_point'] > 0) {
					   $mi_title      = $row['product_name'] ."(". $row['order_no'] .")";
					   $order_mileage = $row['used_point'] * -1; 
					   $sql = "INSERT INTO tbl_order_mileage SET
															 mi_title          = '". $mi_title ."'
														   , order_idx         = '". $row['payment_idx'] ."'
														   , order_no         = '". $row['order_no'] ."'
														   , order_mileage     = '". $order_mileage ."'
														   , order_gubun       = '통합결제'
														   , m_idx             = '". $row['m_idx']."'
														   , product_idx       = ''
														   , mi_r_date         = now() ";
    				   write_log("Inicis-2 ". $sql);								
					   $db->query($sql);
					   
						// 포인트 지급
						$sql   = "select a.user_id, a.m_idx, b.amount_rate from tbl_member a
												left join tbl_member_grade b on a.user_level = b.user_level where a.m_idx = '". $row['m_idx'] ."' ";
						$row_p = $db->query($sql)->getRowArray();
						$order_mileage = $P_AMT * $row_p['amount_rate'] / 100;
						
						$mi_title = "예약결제 후 포인트지급(". $moid .")";
						$sql_m    = "insert tbl_order_mileage set
															  mi_title          = '". $mi_title ."'
															 ,order_idx         = '". $row['payment_idx'] ."'
															 ,order_no          = '". $row['order_no'] ."'
														     ,payment_no        = '". $row['payment_no'] ."'
															 ,order_mileage     = '". $order_mileage ."'
															 ,order_gubun       = '포인트적립'
															 ,m_idx             = '". $row['m_idx'] ."'
															 ,mi_r_date         = now()
															 ,remaining_mileage = '' ";
     				    write_log("Inicis-3 ". $sql);								
						$db->query($sql_m);
						$insertId    = $db->insertID();
						
						$sql		 = " select ifnull(sum(order_mileage),0) as sum_mileage from tbl_order_mileage where m_idx = '".$row['m_idx']."' ";
						$row         = $db->query($sql)->getRowArray();
						$sum_mileage = $row["sum_mileage"];

						$sql = "update tbl_member SET mileage = '".$sum_mileage."' where m_idx = '".$row['m_idx']."' ";																   
						$db->query($sql);

						$sql = "update tbl_order_mileage SET remaining_mileage = '".$sum_mileage."' where mi_idx = '".$insertId."' ";																   
						$db->query($sql);
								
					   //set_all_mileage($row['m_idx']);
					}			
			}
			
			$data = [];

			$sql = " SELECT * from tbl_member WHERE m_idx = '" . $out["P_OID"] . "'";
			$row = $db->query($sql)->getRowArray();

			$data['id']    = $row['user_id'];
			$data['idx']   = $row['m_idx'];
			$data["mIdx"]  = $row['m_idx'];
			$data['name']  = encryptField($row['user_name'], "decode");
			$data['email'] = encryptField($row['user_email'], "decode");
			$data['level'] = $row['user_level'];
			$data['phone'] = encryptField($row['user_mobile'], "decode");

			session()->set("member", $data);

			$data['ResultMsg'] = $out["P_RMESG1"];			

		} else {
	        $data['ResultMsg'] = "[". $_REQUEST["P_STATUS"] ."]". $_REQUEST["P_RMESG1"];
			
		}

	    return $this->renderView('inicis_result', $data);

    }

	public function inicisRefund()
	{
	    $session = session();
        $setting = homeSetInfo();

        $db         = \Config\Database::connect();
        $payment_no = $this->request->getPost('payment_no');
		if (empty($payment_no)) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => '결제 정보를 찾을 수 없습니다.',
			]);
		}
		
		header('Content-Type:text/html; charset=utf-8');

		// 결제정보 조회
		$row = $db->table('tbl_payment_mst')
				  ->where('payment_no', $payment_no)
				  ->get()
				  ->getRowArray();

		if (!$row) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => '결제 정보를 찾을 수 없습니다.',
			]);
		}

		$output = explode(",", $row['order_no']);
		// 끝에 쉼표 제거
		$order_no = rtrim($row['order_no'], ',');

		// 문자열을 배열로 변환
		$orderArr = explode(',', $row['order_no']);

		// 각 항목을 따옴표로 감싸기
		$orderList = "'" . implode("','", $orderArr) . "'";
		
		//step1. 요청을 위한 파라미터 설정
		$key       = "cjAo6CD95LpJS0S4";
		$type      = "refund";
		$timestamp = date("YmdHis");
		$clientIp  = $_SERVER["REMOTE_ADDR"];
		
		$postdata              = array();
		$postdata["mid"]       = $setting['inicis_mid'];
		$postdata["type"]      = $type;
		$postdata["timestamp"] = $timestamp;
		$postdata["clientIp"]  = $clientIp;
		
		//// Data 상세
		$detail        = array();
		$detail["tid"] = $row['TID_1']; 
		$detail["msg"] = "관리자 결제취소";

		$postdata["data"] = $detail;
		
		$details = str_replace('\\/', '/', json_encode($detail, JSON_UNESCAPED_UNICODE));

		//// Hash Encryption
		$plainTxt = $key.$postdata["mid"].$type.$timestamp.$details;
		$hashData = hash("sha512", $plainTxt);

		$postdata["hashData"] = $hashData;

		$post_data = json_encode($postdata, JSON_UNESCAPED_UNICODE);
				
		//step2. 요청전문 POST 전송
		
		$url = "https://iniapi.inicis.com/v2/pg/refund";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 
		$response = curl_exec($ch);
		
	    curl_close($ch); // cURL 종료

        // JSON 형식 파싱
        $response_data = json_decode($response, true); // 연관 배열로 변환

		$resultCode = $response_data['resultCode'];
		$resultMsg  = $response_data['resultMsg'];

		$cancelDate = $response_data['cancelDate'] ." ". $response_data['cancelTime'];

		if ($resultCode == "0000") {
			$db->table('tbl_payment_mst')
			   ->where('payment_no', $payment_no)
			   ->update(['payment_status' => 'C', 'CancelDate_1' => $cancelDate]);

			// 여러 주문번호에 대해 업데이트 수행
			$db->query("UPDATE tbl_order_mst SET CancelDate_1 = ?, order_status = 'C' WHERE order_no IN ($orderList)", [$cancelDate]);

            // 적립포인트 재조정
			cancelMileage($payment_no, 0);

			return $this->response->setJSON(['message' => "[$resultCode] $resultMsg"]);
		} else {
			// 취소 실패
			return $this->response->setJSON([
				'status'  => 'error',
				'message' => '결제 취소 실패: ' . ($response_data['resultMsg'] ?? '오류'),
			]);
		}

	    //return view('inicis_refund', $response_data);
		
		/*
			plainTxt : cjAo6CD95LpJS0S4thaitour37refund20250428001325{"tid":"StdpayCARDthaitour3720250428001952866722","msg":"관리자 결제취소"}

			hashData : a406b12be880ef0fe3fd1e3fe4bd120efaa3d286dc6d564871cbbbfb3eeb3f8179777396b9255cfb0678dec53373f6e93cfd90435f86e98db0176dea68a221bb

			**** 요청전문 ****
			{"mid":"thaitour37",
			"type":"refund",
			"timestamp":"20250428001325",
			"clientIp":"118.38.5.223",
			"data":{"tid":"StdpayCARDthaitour3720250428001952866722",
			"msg":"관리자 결제취소"},
			"hashData":"a406b12be880ef0fe3fd1e3fe4bd120efaa3d286dc6d564871cbbbfb3eeb3f8179777396b9255cfb0678dec53373f6e93cfd90435f86e98db0176dea68a221bb"}

			Array
			(
				[resultCode] => 00
				[resultMsg] => 정상처리되었습니다.
				[cancelDate] => 20250428
				[cancelTime] => 002315
			)
			**** 응답전문 ****
			{"resultCode":"00",
			"resultMsg":"정상처리되었습니다.",
			"cancelDate":"20250428",
			"cancelTime":"002315"}


			KR 한국어
        */		
		
    }
	
	public function inicisPartialRefund()
	{
	    $session = session();
        $setting = homeSetInfo();

        $db         = \Config\Database::connect();
		
		// Ajax로 넘어온 payment_no 받기
		$payment_no  = $this->request->getPost('payment_no');
		$cancelAmt   = $this->request->getPost('cancel_amt');
		$order_nos   = $this->request->getPost('order_no');
		$amts        = $this->request->getPost('amt');
        $add_mileage = $this->request->getPost('add_mileage');

		for ($i = 0; $i < count($order_nos); $i++) {
			$order_no = $order_nos[$i];
			$amt = $amts[$i];

			// 예: DB 처리 또는 로그
			// cancelPartialOrder($payment_no, $order_no, $amt);
		}
		
		if (empty($payment_no)) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => '결제 정보를 찾을 수 없습니다.',
			]);
		}
		
		header('Content-Type:text/html; charset=utf-8');

		// 결제정보 조회
		$row = $db->table('tbl_payment_mst')
				  ->where('payment_no', $payment_no)
				  ->get()
				  ->getRowArray();

		if (!$row) {
			return $this->response->setJSON([
				'status' => 'error',
				'message' => '결제 정보를 찾을 수 없습니다.',
			]);
		}		

        //step1. 요청을 위한 파라미터 설정
		$key       = "cjAo6CD95LpJS0S4";
        $mid       = $setting['inicis_mid'];
	    $type      = "partialRefund";
	    $timestamp = date("YmdHis");
	    $clientIp  = $_SERVER["REMOTE_ADDR"];

		$postdata              = array();
		$postdata["mid"]       = $mid;
		$postdata["type"]      = $type;
		$postdata["timestamp"] = $timestamp;
		$postdata["clientIp"]  = $clientIp;
	
		//// Data 상세
		$detail                 = array();
		$detail["tid"]          = $row['TID_1'];
		$detail["msg"]          = "관리자 부분결제취소";
		$detail["price"]        = $cancelAmt;
		$detail["confirmPrice"] = $cancelAmt;
		$detail["currency"]     = "WON";
		$detail["tax"]          = "0";
		$detail["taxfree"]      = "0";
		
		$postdata["data"] = $detail;
		
		$details = str_replace('\\/', '/', json_encode($detail, JSON_UNESCAPED_UNICODE));

		//// Hash Encryption
		$plainTxt = $key.$mid.$type.$timestamp.$details;
		$hashData = hash("sha512", $plainTxt);

		$postdata["hashData"] = $hashData;

	    //echo "plainTxt : ".$plainTxt."<br/><br/>"; 
	    //echo "hashData : ".$hashData."<br/><br/>"; 

	    $post_data = json_encode($postdata, JSON_UNESCAPED_UNICODE);
	
	    //echo "**** 요청전문 **** <br/>" ; 
	    //echo str_replace(',', ',<br>', $post_data)."<br/><br/>" ; 
	
	
		//step2. 요청전문 POST 전송
		
		$url = "https://iniapi.inicis.com/v2/pg/partialRefund";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 
		$response = curl_exec($ch);
		
	    curl_close($ch); // cURL 종료

        // JSON 형식 파싱
        $response_data = json_decode($response, true); // 연관 배열로 변환

		$resultCode = $responseData['resultCode'];
		$resultMsg  = $responseData['resultMsg'];

		$cancelDate = $responseData['cancelDate'] ." ". $responseData['cancelTime'];

		// 각 항목을 따옴표로 감싸기
		$orderList   = "'" . implode("','", array_map('addslashes', $order_nos)) . "'";

		if ($resultCode == "00") {
			$db->table('tbl_payment_mst')
			   ->where('payment_no', $payment_no)
			   ->update(['order_status' => 'C', 'payment_c_date' => $cancelDate]);

			// 여러 주문번호에 대해 업데이트 수행
			$db->query("UPDATE tbl_order_mst SET CancelDate_1 = ?, order_status = 'C' WHERE order_no IN ($orderList)", [$cancelDate]);

			// 적립포인트 재조정
			cancelMileage($payment_no, $cancelAmt);

			return $this->response->setJSON(['message' => "[$resultCode] $resultMsg"]);
		} else {
			// 취소 실패
			return $this->response->setJSON([
				'status'  => 'error',
				'message' => '결제 취소 실패: ' . ($response_data['resultMsg'] ?? '오류'),
			]);
		}		
	}	

}

?>
