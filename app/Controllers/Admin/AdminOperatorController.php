<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminOperatorController extends BaseController
{

    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function coupon_setting()
    {
        $g_list_rows = 100;
        $strSql = '';
        $pg = updateSQ($_GET["pg"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $total_sql = " select *	from tbl_coupon_setting where state != 'C' $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;
        $data = [
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'ca_idx' => $ca_idx,
            'nTotalCount' => $nTotalCount,
            'result' => $result,
            'num' => $num,
            'nPage' => $nPage
        ];
        return view('admin/_operator/coupon_setting', $data);
    }

    public function coupon_setting_write()
    {
        $idx = updateSQ($_GET["idx"] ?? '');

        $row = null;
        if ($idx) {
            $total_sql = " select * from tbl_coupon_setting where idx='" . $idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();
        }
        $data = [
            'row' => $row,
            'idx' => $idx
        ];
        return view('admin/_operator/coupon_setting_write', $data);
    }

    public function coupon_setting_write_ok()
    {
        try {
            $idx = updateSQ($_POST["idx"]);
            $coupon_name = updateSQ($_POST["coupon_name"] ?? '');
            $publish_type = updateSQ($_POST["publish_type"] ?? '');
            $dc_type = updateSQ($_POST["dc_type"] ?? '');
            $coupon_pe = updateSQ($_POST["coupon_pe"] ?? '');
            $coupon_price = updateSQ($_POST["coupon_price"] ?? '');
            $dex_price_pe = updateSQ($_POST["dex_price_pe"] ?? '');
            $exp_days = updateSQ($_POST["exp_days"] ?? '');
            $etc_memo = updateSQ($_POST["etc_memo"] ?? '');
            $state = updateSQ($_POST["state"] ?? '');
            $nobrand = updateSQ($_POST["nobrand"] ?? '');
            $coupon_type = updateSQ($_POST["coupon_type"] ?? '');

            if ($idx) {
                $sql = "
                    update tbl_coupon_setting SET 
                        coupon_name			= '" . $coupon_name . "'	
                        ,publish_type		= '" . $publish_type . "'
                        ,dc_type			= '" . $dc_type . "'
                        ,coupon_pe			= '" . $coupon_pe . "'
                        ,coupon_price		= '" . $coupon_price . "'
                        ,dex_price_pe		= '" . $dex_price_pe . "'
                        ,exp_days			= '" . $exp_days . "'
                        ,etc_memo			= '" . $etc_memo . "'
                        ,state				= '" . $state . "'
                        ,nobrand			= '" . $nobrand . "'
                        ,coupon_type        = '" . $coupon_type . "'
                    where idx = '" . $idx . "'
                ";

            } else {

                $sql = "
                    insert into tbl_coupon_setting SET 
                         coupon_name		= '" . $coupon_name . "'	
                        ,publish_type		= '" . $publish_type . "'	
                        ,dc_type			= '" . $dc_type . "'
                        ,coupon_pe			= '" . $coupon_pe . "'
                        ,coupon_price		= '" . $coupon_price . "'
                        ,dex_price_pe		= '" . $dex_price_pe . "'
                        ,exp_days			= '" . $exp_days . "'
                        ,etc_memo			= '" . $etc_memo . "'
                        ,state				= '" . $state . "'
                        ,nobrand			= '" . $nobrand . "'
                        ,coupon_type		= '" . $coupon_type . "'
                        ,regdate			= now()
                ";
            }

            $this->connect->query($sql);

            if ($idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            }

            $message = "등록되었습니다.";
            return "<script>
                alert('$message');
                    parent.location.href='/AdmMaster/_operator/coupon_setting';
                </script>";

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function coupon_setting_del()
    {
        try {
            if (!isset($_POST['idx'])) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => 'idx is not set'
                ], 400);
            }

            $idx = $_POST['idx'];

            for ($i = 0; $i < count($idx); $i++) {
                $sql1 = " update tbl_coupon_setting set state = 'C' where idx = '" . $idx[$i] . "' ";
                $this->connect->query($sql1);

            }

            $message = "삭제 성공.";
            return $this->response->setJSON([
                'result' => true,
                'message' => $message
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function coupon_list()
    {
        $g_list_rows = 100;
        $strSql = '';
        $pg = updateSQ($_GET["pg"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');

        $total_sql = " select c.c_idx, c.coupon_num, c.user_id, c.regdate, c.enddate, c.usedate, c.status, c.types, s.coupon_name, s.dc_type, s.coupon_pe, s.coupon_price
					from tbl_coupon c
					left outer join tbl_coupon_setting s
					  on c.coupon_type = s.idx
				   where 1=1 and c.status != 'C'  $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by c_idx desc limit $nFrom, $g_list_rows ";
        //echo $sql;
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;
        $data = [
            'pg' => $pg,
            'g_list_rows' => $g_list_rows,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'ca_idx' => $ca_idx,
            'nTotalCount' => $nTotalCount,
            'result' => $result,
            'num' => $num,
            'nPage' => $nPage
        ];
        return view('admin/_operator/coupon_list', $data);
    }

    public function coupon_write()
    {
        $idx = updateSQ($_GET["idx"] ?? '');
        $ca_idx = updateSQ($_GET["ca_idx"] ?? '');

        $sql_c = " select *	from tbl_coupon_setting where state = 'Y' order by idx desc ";
        $result_c = $this->connect->query($sql_c);
        $result_c = $result_c->getResultArray();

        $data = [
            'idx' => $idx,
            'ca_idx' => $ca_idx,
            'result_c' => $result_c
        ];

        return view('admin/_operator/coupon_write', $data);
    }

    public function coupon_write_ok()
    {
        try {
            $types = updateSQ($_POST["types"]);
            $coupon_type = updateSQ($_POST["coupon_type"]);
            $coupon_cnt = updateSQ($_POST["coupon_cnt"]);

            echo $coupon_type . " / " . $coupon_cnt;

            $ok_cnt = 0;
            $er_cnt = 0;

            for ($i = 1; $i <= $coupon_cnt; $i++) {

                $new_coupon = $this->createCoupon($coupon_type);

                if ($new_coupon === "Error") {
                    $er_cnt++;
                } else {
                    $ok_cnt++;
                }
            }

            $message = "등록되었습니다.";
            return "<script>
                alert('$message');
                    parent.location.href='/AdmMaster/_operator/coupon_list';
                </script>";
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function send_coupon() {
        $user_id    = $_GET['user_id'];
	    $coupon_num	= $_GET['coupon_nums'];

        try {
            if( $this->createCouponChk($coupon_num) < 1 ){	// 존재하지 않는 쿠폰 타입일 경우
                $message = "존재하지 않는 쿠폰입니다:" . $coupon_num;
        
                return $this->response->setJSON([
                    'result' => false,
                    'message' => $message
                ], 400);
        
            }else{
                // 쿠폰 내역 조회
                $fresult = $this->connect->table('tbl_coupon')
                         ->where('coupon_num', $coupon_num)
                         ->get();
                $frow    = $fresult->getResultArray();
        
                if( $frow[0]['status'] != "D" ){
                    $message = "이미 발급되었거나 사용된 쿠폰입니다";
        
                    return $this->response->setJSON([
                        'result' => false,
                        'message' => $message
                    ], 400);
                }
        
                if( $frow[0]['user_id'] != "" ){
                    $message = "이미 발급된 쿠폰입니다";

                    return $this->response->setJSON([
                        'result' => false,
                        'message' => $message
                    ], 400);
                }
        
                if( $frow[0]['enddate'] <= date('Y-m-d') ){
                    $message = "사용기한이 지난 쿠폰입니다";

                    return $this->response->setJSON([
                        'result' => false,
                        'message' => $message
                    ], 400);
                }
        
        
                $fsql = " update tbl_coupon set
                                    user_id	= '".$user_id."'
                                    ,status	= 'N'
                                    where coupon_num = '".$coupon_num."'
                        ";
        
                $message = "쿠폰발급(유저) : " . $fsql;
        
                $fresult    = $this->connect->query($fsql);

                return $this->response->setJSON([
                    'result' => true,
                    'message' => $fsql
                ], 200);
        
            }

        }catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
        
    }

    private function createCoupon($coupon_type)
    {
        $fsql = "select * from tbl_coupon_setting where idx='" . $coupon_type . "' ";
        $fresult = $this->connect->query($fsql);
        $nTotalCount = $fresult->getNumRows();

        $frow_type = $fresult->getRowArray();

        if ($nTotalCount == 0) {    // 존재하지 않는 쿠폰 타입일 경우
            $message = "존재하지 않는 쿠폰 타입니다 : " . $fsql;
            $this->write_log_dir($message, $_SERVER['DOCUMENT_ROOT'] . "/AdmMaster/_coupon/log/");

            return "Error";

        }

        $message = "쿠폰생성-x";
        $this->write_log_dir($message, $_SERVER['DOCUMENT_ROOT'] . "/AdmMaster/_coupon/log/");

        $_couponNum = $this->createCouponNum();
        $message = "쿠폰생성-3 : " . $_couponNum;
        $this->write_log_dir($message, $_SERVER['DOCUMENT_ROOT'] . "/AdmMaster/_coupon/log/");

        while ($this->createCouponChk($_couponNum) >= 1) {
            $_couponNum = $this->createCouponNum();
        }

        $last_idx = $this->createLastIdx();

        // 테스트 (구현 필요)
        $exp_days = $frow_type['exp_days'] + 1;
        $enddate = $this->fn_addDays(date('Y-m-d'), $exp_days);

        //$enddate = "2018-12-24";

        $fsql = " insert into tbl_coupon set
                  coupon_num	= '" . $_couponNum . "'
                , coupon_type	= '" . $coupon_type . "'
                , types			= 'N'
                , status		= 'D'
                , last_idx	= '" . $last_idx . "'
                , regdate	= now()
                , enddate	= '" . $enddate . "'
        ";

        $message = "쿠폰생성 : " . $fsql;
        $this->write_log_dir($message, $_SERVER['DOCUMENT_ROOT'] . "/AdmMaster/_coupon/log/");

        $fresult = $this->connect->query($fsql);

        return $_couponNum;

    }

    private function createCouponNum()
    {

        /*
        쿠폰번호는 10자리

        날짜(5) + last_idx(3) + 랜덤값(1) + 확인코드(1)

        1. 날짜
           date('ymd')

        2. last_idx (1일 4,095개 생성, 랜덤값 적용 시 4095 x 26 = 106,470 까지 가능)
           일일 단위로 idx를 넣어서 적용 예정

        3. 랜덤값
           A~Z

        4. 확인코드
           10진수 기준으로 모든 문자를 합친 후 각 자리수들을 하나씩 끊어 합한 후에 27로 나눈 값을 문자로 표현
           ex)180302 + 10 + 14 -> 1803021014 (문자합계) -> 20 -> convertChar(20) -> T
        */

        $coupon_txt = "";
        $chk_bit = "";

        // last_idx 값을 먼저 가져오자
        $last_idx = $this->createLastIdx();


        // 1. 날짜
        $date_dec = date('ymd');
        $date_hex = $this->decTohex($date_dec);

        // 2. last_idx
        $idx_dec = $last_idx;
        $tmp_idx_desc = $idx_dec;
        if ($tmp_idx_desc > 4095) {
            $tmp_idx_desc = $tmp_idx_desc - 4095;
        }
        $idx_hex = $this->decTohex($tmp_idx_desc, 3);

        // 3. 랜덤값
        $rand_dec = rand(1, 26);
        //$rand_dec  = date('i'); 중복 테스트할려고 만든 거

        $rand_hex = $this->convertChar($rand_dec);


        // 4. 확인코드
        $t_bit = $date_dec . $idx_dec . $rand_dec;
        $t_hap = 0;

        for ($i = 0; $i < strlen($t_bit); $i++) {
            //echo $i . " : " . substr($t_bit,$i,1)  . "<br/>";
            $t_hap += substr($t_bit, $i, 1);
        }

        $t_hap = $t_hap % 26;
        $t_hap++;

        $chk_bit = $this->convertChar($t_hap);

        // 쿠폰번호 조합
        $coupon_txt = $date_hex . $idx_hex . $rand_hex . $chk_bit;


        return $coupon_txt;

    }

    private function convertChar($nums)
    {
        $char_code = $nums + 64;

        return chr($char_code);
    }

    function decTohex($nums, $length = 0)
    {
        $nums = strtoupper(dechex($nums));

        if ($length > 0) {
            $nums = str_pad($nums, $length, "0", STR_PAD_LEFT);
        }

        return $nums;
    }

    private function createCouponChk($coupon)
    {
        $fsql = "select * from tbl_coupon where coupon_num='" . $coupon . "' ";
        return $this->connect->query($fsql)->getNumRows();
    }

    private function createLastIdx()
    {
        $fsql = " select IFNULL( max(last_idx), 0) + 1 as l_idx from tbl_coupon where left(regdate,10) = curdate() ";
        $fresult = $this->connect->query($fsql);
        $frow = $fresult->getRowArray();
        //$last_idx = "3"; 중복 테스트할려고 만든 것

        return $frow['l_idx'];
    }

    /**
     * Writes a message to a log file
     *
     * @param string $message The message to write
     * @param string $dir The directory to write the log file to
     */
    private function write_log_dir($message, $dir)
    {
        //$dir = "./log/";
//        $myfile = fopen($dir . date("Ymd") . ".txt", "a") or die("Unable to open file!");
//        $txt = chr(13) . chr(10) . date("Y.m.d G:i:s") . "(" . $_SERVER['REMOTE_ADDR'] . " " . $_SERVER['PHP_SELF'] . " ) : " . chr(13) . chr(10) . $message . chr(13) . chr(10);
//        fwrite($myfile, chr(13) . chr(10) . $txt . chr(13) . chr(10));
//        fclose($myfile);

    }

    private function write_log_dir1($message, $dir)
    {
        //$dir = "./log/";
//        $myfile = fopen($dir . date("Ymd") . ".txt", "a") or die("Unable to open file!");
//        $txt = chr(13) . chr(10) . date("Y.m.d G:i:s") . "(" . $_SERVER['REMOTE_ADDR'] . " " . $_SERVER['PHP_SELF'] . " ) : " . chr(13) . chr(10) . $message . chr(13) . chr(10);
//        fwrite($myfile, chr(13) . chr(10) . $txt . chr(13) . chr(10));
//        fclose($myfile);

    }

    private function fn_addDays($day2, $d)
    {
        $day2 = strtotime(date($day2));
        $day = $day2 + $d * 86400;

        $day = date('Y-m-d', $day);


        return $day;
    }

    public function coupon_del()
    {
        try {
            if (!isset($_POST['idx'])) {
                return $this->response->setJSON([
                    'result' => false,
                    'message' => 'idx is not set'
                ], 400);
            }

            $idx = $_POST['idx'];

            for ($i = 0; $i < count($idx); $i++) {
                $sql1 = " update tbl_coupon set status = 'C' where c_idx=" . $idx[$i] . " ";
                $this->connect->query($sql1);

            }

            $message = "삭제 성공.";
            return $this->response->setJSON([
                'result' => true,
                'message' => $message
            ], 200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function find_user()
    {
        try {
            $private_key = private_key();
            $user_id = $this->Unescape($_GET['user_id']);

            $sql = "SELECT *, CONVERT(AES_DECRYPT(UNHEX(user_name), '$private_key') USING utf8) as user_name_convert FROM tbl_member 
                            WHERE user_level > '1' 
                            AND status = 'Y' 
                            AND (user_id LIKE '%" . $user_id . "%' OR CONVERT(AES_DECRYPT(UNHEX(user_name), '$private_key') USING utf8) LIKE '%" . $user_id . "%') 
                            ORDER BY user_id ASC";

            $result = $this->connect->query($sql);
            $nTotalCount = $result->getNumRows();

            if ($nTotalCount < 1) {
                return '<tr>
                    <th colspan="2">일치하는 회원이 없습니다.</th>
                </tr>';
            }

            $html = '';
            foreach ($result->getResultArray() as $row) {
                $html .= '<tr onclick="sel_user_id(\'' . $row['user_id'] . '\');">
                      <th>' . $row['user_name_convert'] . '</th>
                      <td>' . $row['user_id'] . '</td>
                  </tr>';
            }

            return $html;
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'result' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    private function Unescape($str)
    {
        return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', [$this, 'UnescapeFunc'], $str));
    }

    private function UnescapeFunc($str)
    {
        return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($str[1], 2, 2))) . chr(hexdec(substr($str[1], 0, 2))));
    }
}
