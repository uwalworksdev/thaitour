<?php

// /app/Common/insertRoomPrice.php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function insertRoomPrice($db, $rooms_idx, $baht_thai, $goods_code, $g_idx, $o_sdate, $o_edate)
{
    // 가격 테이블 삭제
    $builder = $db->table('tbl_room_price');
    $builder->delete(['rooms_idx' => $rooms_idx]);

    // 방 정보 가져오기
    $sql   = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ? ORDER BY bed_seq";
    $query = $db->query($sql, [$rooms_idx]);
    $rows  = $query->getResultArray(); // 연관 배열 반환

    foreach ($rows as $row) {
        // 시작일과 종료일 설정
        $startDate = $o_sdate; // 시작일
        $endDate = $o_edate;   // 종료일

        // DateTime 객체 생성
        $start = new DateTime($startDate);
        $end   = new DateTime($endDate);
        $end->modify('+1 day'); // 종료일까지 포함하기 위해 +1일 추가

        // 날짜 반복
        while ($start < $end) {
            $currentDate = $start->format("Y-m-d"); // 현재 날짜 (형식: YYYY-MM-DD)

            // SQL 삽입
            $sql = "INSERT INTO tbl_room_price 
                    SET product_idx = ?, 
                        g_idx = ?, 
                        rooms_idx = ?, 
                        bed_idx = ?, 
                        goods_date = ?, 
                        dow = ?, 
                        baht_thai = ?, 
                        goods_price1 = 0, 
                        goods_price2 = 0, 
                        goods_price3 = 0, 
                        goods_price4 = 0, 
                        use_yn = 0, 
                        reg_date = NOW()";

            // 요일 계산 함수 호출 (dateToYoil 함수는 이미 정의되어 있다고 가정)
            $dow = dateToYoil($currentDate);

            // 데이터 삽입
            $db->query($sql, [
                $goods_code,
                $g_idx,
                $rooms_idx,
                $row['bed_idx'],
                $currentDate,
                $dow,
                $baht_thai
            ]);

            // 다음 날짜로 이동
            $start->modify('+1 day');
        }
    }

    return true; // 성공적으로 처리된 경우
}

?>