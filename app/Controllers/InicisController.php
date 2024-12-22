<?php

namespace App\Controllers;

use Libraries\INIStdPayUtil;
use Libraries\HttpClient;
use Libraries\properties;

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
        $db  = \Config\Database::connect();
		require_once(APPPATH . 'Libraries/INIStdPayUtil.php');
		require_once(APPPATH . 'Libraries/HttpClient.php');
		require_once(APPPATH . 'Libraries/properties.php');

        $util = new INIStdPayUtil();
        $prop = new properties();

		$timestamp = $util->getTimestamp();
        echo "Timestamp: " . $timestamp;

		try {
 
            //#############################
            // 인증결과 파라미터 수신
            //#############################

            if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {
 
                //############################################
                // 1.전문 필드 값 설정(***가맹점 개발수정***)
                //############################################
 
                $mid            = $_REQUEST["mid"];
                $signKey 	    = "SU5JTElURV9UUklQTEVERVNfS0VZU1RS";
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
    
/*
    [CARD_Quota] => 00
    [CARD_ClEvent] => 
    [CARD_CorpFlag] => 0
    [buyerTel] => 01012345678
    [parentEmail] => 
    [applDate] => 20241222
    [buyerEmail] => test@test.com
    [OrgPrice] => 
    [p_Sub] => 
    [resultCode] => 0000
    [mid] => INIpayTest
    [CARD_UsePoint] => 
    [CARD_Num] => 400933*********7
    [authSignature] => 2645d244ba0c4ef57f26e469f7f995f3d9fe170b262614ab0172af877dc35e09
    [tid] => StdpayCARDINIpayTest20241222133413130195
    [EventCode] => 
    [goodName] => 테스트상품
    [TotPrice] => 1000
    [payMethod] => Card
    [CARD_MemberNum] => 
    [MOID] => INIpayTest_1734841969375
    [CARD_Point] => 
    [currency] => WON
    [CARD_PurchaseCode] => 
    [CARD_PrtcCode] => 1
    [applTime] => 133413
    [goodsName] => 테스트상품
    [CARD_CheckFlag] => 0
    [FlgNotiSendChk] => 
    [CARD_Code] => 14
    [CARD_BankCode] => 26
    [CARD_TerminalNum] => 019058I000
    [P_FN_NM] => 신한카드
    [buyerName] => 테스터
    [p_SubCnt] => 
    [applNum] => 35980068
    [resultMsg] => 정상처리되었습니다.
    [CARD_Interest] => 0
    [CARD_SrcCode] => 
    [CARD_ApplPrice] => 1000
    [CARD_GWCode] => G
    [custEmail] => test@test.com
    [CARD_Expire] => 
    [CARD_PurchaseName] => 신한카드
    [CARD_PRTC_CODE] => 1
    [payDevice] => PC
*/
						$sql = "UPDATE tbl_payment_mst SET payment_method = '신용카드'
													      ,payment_status = 'Y'
													      ,paydate		  = '". $paydate ."'
													      ,ResultCode_1   = '". $resultMap->resultCode ."'
													      ,ResultMsg_1    = '". $resultMap->resultMsg ."'
													      ,Amt_1          = '". $resultMap->TotPrice ."'
													      ,TID_1          = '". $resultMap->tid ."'
													      ,AuthCode_1     = '". $resultMap->applNum ."'
													      ,AuthDate_1     = '". $resultMap->AuthDate ."' WHERE payment_no = '". $resultMap->MOID ."'";														
					    $result = $db->query($sql);
    
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

	    $data['ResultMsg'] = $resultMap->resultMsg;

	    return $this->renderView('inicis_result', $data);

    }


}

?>