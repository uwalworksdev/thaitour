<?php
     function createCouponNum()
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
        $last_idx = createLastIdx();


        // 1. 날짜
        $date_dec = date('ymd');
        $date_hex = decTohex($date_dec);

        // 2. last_idx
        $idx_dec = $last_idx;
        $tmp_idx_desc = $idx_dec;
        if ($tmp_idx_desc > 4095) {
            $tmp_idx_desc = $tmp_idx_desc - 4095;
        }
        $idx_hex = decTohex($tmp_idx_desc, 3);

        // 3. 랜덤값
        $rand_dec = rand(1, 26);
        //$rand_dec  = date('i'); 중복 테스트할려고 만든 거

        $rand_hex = convertChar($rand_dec);


        // 4. 확인코드
        $t_bit = $date_dec . $idx_dec . $rand_dec;
        $t_hap = 0;

        for ($i = 0; $i < strlen($t_bit); $i++) {
            //echo $i . " : " . substr($t_bit,$i,1)  . "<br/>";
            $t_hap += substr($t_bit, $i, 1);
        }

        $t_hap = $t_hap % 26;
        $t_hap++;

        $chk_bit = convertChar($t_hap);

        // 쿠폰번호 조합
        $coupon_txt = $date_hex . $idx_hex . $rand_hex . $chk_bit;


        return $coupon_txt;

    }

    function convertChar($nums)
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

    function createCouponChk($coupon)
    {
        $connect = db_connect();
        $query = $connect->query("select * from tbl_coupon where coupon_num='" . $coupon . "'");
        return $query->getNumRows();
    }

    function createCouponMemberChk($coupon_mst_idx, $user_id)
    {
        $connect = db_connect();
        $query = $connect->query("select * from tbl_coupon where coupon_mst_idx='" . $coupon_mst_idx . "' and user_id = '" . $user_id . "'");
        return $query->getNumRows();
    }

    function createCouponMemberExpDays($coupon_mst_idx)
    {
        $connect = db_connect();
        $query = $connect->query("select * from tbl_coupon where coupon_mst_idx='" . $coupon_mst_idx . "' and enddate > curdate()");
        return $query->getNumRows();
    }

    function createLastIdx()
    {
        $connect = db_connect();
        $query = $connect->query("select IFNULL( max(last_idx), 0) + 1 as l_idx from tbl_coupon where left(regdate,10) = curdate()");
        $frow = $query->getRowArray();

        return $frow['l_idx'];
    }

    function fn_addDays($day2, $d)
    {
        $day2 = strtotime(date($day2));
        $day = $day2 + $d * 86400;

        $day = date('Y-m-d', $day);


        return $day;
    }

    function Unescape($str)
    {
        return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'UnescapeFunc', $str));
    }

    function UnescapeFunc($str)
    {
        return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($str[1], 2, 2))) . chr(hexdec(substr($str[1], 0, 2))));
    }