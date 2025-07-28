<?php

use CodeIgniter\Database\QueryBuilder;
use DateTime;

function mainPrice($db, $product_idx, $g_idx, $rooms_idx)
{
		if (!$db) {
			$db = \Config\Database::connect();
		}
		
        $baht_thai   = (float)($setting['baht_thai'] ?? 0);
        $goods_date  = date('Y-m-d', strtotime('+1 day'));
        $goods_date  = date('Y-m-d');

        $sql = "SELECT *
				FROM  tbl_room_price
				WHERE product_idx   = ?
				AND   g_idx         = ?
				AND   rooms_idx     = ?
				AND   goods_date    = ?
				ORDER BY (goods_price2 + goods_price3) ASC
				LIMIT 1 ";

        $query    = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $goods_date]);
        $priceRow = $query->getRow();

        if ($priceRow) {
            $goods_price1  = $priceRow->goods_price1;
            $goods_price2  = $priceRow->goods_price2;
            $goods_price3  = $priceRow->goods_price3;
            $goods_price4  = $priceRow->goods_price4;
            $goods_price5  = $priceRow->goods_price5;
        } else {
            $goods_price1  = 0;
            $goods_price2  = 0;
            $goods_price3  = 0;
            $goods_price4  = 0;
            $goods_price5  = 0;
        }

        $result = $goods_price1 . "|" . $goods_price2 . "|" . $goods_price3 . "|" . $goods_price4 . "|" . $goods_price5;
	
        return $result; // 성공적으로 처리된 경우
}

function roomPrice($db, $product_idx, $g_idx, $rooms_idx)
{
		if (!$db) {
			$db = \Config\Database::connect();
		}

        $goods_date  = date('Y-m-d');

		// 방 정보 가져오기
		$bed_type  = "";
		$bed_price = "";
		$extra_bed = "";
		$bed_idx   = "";

		$price1    = "";
		$result    = "";

		$sql   = "SELECT * FROM tbl_room_beds WHERE rooms_idx = ? ORDER BY bed_seq";
		$query = $db->query($sql, [$rooms_idx]);
		$rows  = $query->getResultArray(); // 연관 배열 반환

		foreach ($rows as $row) {
			// bed_type 문자열 조합
			$bed_type .= ($bed_type === "") ? $row['bed_type'] : "," . $row['bed_type'];

			$sql = "SELECT * FROM tbl_room_price WHERE product_idx = ? AND 
													   g_idx       = ? AND 
													   rooms_idx   = ? AND 
													   bed_idx     = ? AND 
													   goods_date  = ?";
			$query    = $db->query($sql, [$product_idx, $g_idx, $rooms_idx, $row['bed_idx'], $goods_date]);
			$priceRow = $query->getRow();

			if ($priceRow) {
				$price        =  $priceRow->goods_price2 + $priceRow->goods_price3;
				$extra_price  =  $priceRow->goods_price5;
			} else {
				$price        = 0;
				$extra_price  = 0;
			}

			// bed_price 문자열 조합
			$bed_price .= ($bed_price === "") ? $price : "," . $price;
			$extra_bed .= ($extra_bed === "") ? $extra_price : ","  . $extra_price;
			$bed_idx .= ($bed_idx === "") ? $row['bed_idx'] : ","  . $row['bed_idx'];
		}

		$result = $bed_type . "|" . $bed_price . "|" . $extra_bed . "|" . $bed_idx;
		return $result; // 성공적으로 처리된 경우
}

function depositPrice($db, int $product_idx, int $g_idx, int $rooms_idx, string $o_sdate, int $days)
{
		// DB 연결 확인 후 연결
		if (!$db) {
			$db = \Config\Database::connect();
		}

        $setting   = homeSetInfo();
        $baht_thai = (float)($setting['baht_thai'] ?? 0);
        $o_edate   = date('Y-m-d', strtotime($o_sdate . " + " . ($days - 1) . " days"));

		$builder = $db->table('tbl_room_price p');
		$builder->select('p.bed_idx, 
						  SUM(p.goods_price1) AS price1, 
						  SUM(p.goods_price2) AS price2, 
						  SUM(p.goods_price3) AS price3, 
						  SUM(p.goods_price4) AS price4, 
						  SUM(p.goods_price5) AS price5, 
						  b.bed_type, 
						  b.bed_seq');
		$builder->join('tbl_room_beds b', 'p.rooms_idx = b.rooms_idx AND p.bed_idx = b.bed_idx', 'left');
		$builder->where('p.product_idx', $product_idx);
		$builder->where('p.g_idx', $g_idx);
		$builder->where('p.rooms_idx', $rooms_idx);
		$builder->where('p.goods_date >=', $o_sdate);
		$builder->where('p.goods_date <=', $o_edate);
		$builder->groupBy(['p.bed_idx', 'b.bed_type', 'b.bed_seq']);
		$builder->orderBy('(SUM(p.goods_price2) + SUM(p.goods_price3))', 'ASC');
		$builder->orderBy('b.bed_seq', 'ASC');
		$builder->limit(1);

		$query = $builder->get();
		$row = $query->getRowArray(); // 결과 가져오기
        
		// 실행된 쿼리 확인 (디버깅 용도)
		//write_log("depositPrice - " . $db->getLastQuery());

		// 만약 결과가 없을 경우 기본값 반환
		if (!$row) {
			return "0|0|0|0|0";
		}

		// 결과 문자열 생성
		return "{$row['price1']}|{$row['price2']}|{$row['price3']}|{$row['price4']}|{$row['price5']}|{$baht_thai}";
}

function detailPrice($db, int $product_idx, int $g_idx, int $rooms_idx, string $o_sdate, int $days)
{
		// DB 연결 확인 후 연결
		if (!$db) {
			$db = \Config\Database::connect();
		}

        $setting   = homeSetInfo();
        $baht_thai = (float)($setting['baht_thai'] ?? 0);

		// 종료 날짜 계산 (시작일 + ($days - 1)일)
		$o_edate = date('Y-m-d', strtotime($o_sdate . " + " . ($days - 1) . " days"));
/*		
		// Query Builder 생성
		$builder = $db->table('tbl_room_price p')
			->select('p.goods_date, p.goods_price1, p.goods_price2, p.goods_price3, p.goods_price4, p.goods_price5, 
					  b.bed_idx, b.bed_type, b.bed_seq')
			->join('tbl_room_beds b', 'p.rooms_idx = b.rooms_idx AND p.bed_idx = b.bed_idx', 'left')
			->where('p.product_idx',   $product_idx)
			->where('p.g_idx',         $g_idx)
			->where('p.rooms_idx',     $rooms_idx)
			->where('p.goods_date >=', $o_sdate)
			->where('p.goods_date <=', $o_edate)
			->orderBy('p.goods_date', 'ASC')
			->orderBy('b.bed_seq', 'ASC'); // 침대순 정렬
		$query     = $builder->get();
		$dateRows  = $query->getResultArray(); // 여러 개의 행을 가져옴
		// 실행된 쿼리 확인 (디버깅 용도)
		write_log("datePrice - " . $db->getLastQuery());
*/
		$builder = $db->table('tbl_room_price p')
			->select('
				p.bed_idx, 
				SUM(p.goods_price1) as price1,
				SUM(p.goods_price2) as price2,
				SUM(p.goods_price3) as price3,
				SUM(p.goods_price4) as price4,
				SUM(p.goods_price5) as price5,
				b.bed_type, 
				b.bed_seq')
			->join('tbl_room_beds b', 'p.rooms_idx = b.rooms_idx AND p.bed_idx = b.bed_idx', 'left')
			->where('p.product_idx', $product_idx)
			->where('p.g_idx', $g_idx)
			->where('p.rooms_idx', $rooms_idx)
			->where('p.goods_date >=', $o_sdate)
			->where('p.goods_date <=', $o_edate)
			->groupBy('p.bed_idx, b.bed_type, b.bed_seq')  // Grouping by bed_idx
			->orderBy('p.goods_date', 'ASC')
			->orderBy('b.bed_seq', 'ASC');  // 침대순 정렬

		// 쿼리 실행
		$query     = $builder->get();
		$priceRows = $query->getResultArray(); // 여러 개의 행을 가져옴

		// 실행된 쿼리 확인 (디버깅 용도)
		
		//if($product_idx  == "2207" && $g_idx == "377" && $rooms_idx == "826") {
		//   write_log("detailPrice - " . $db->getLastQuery());
        //}
		
        $room_r = "";
        foreach ($priceRows as $row) :
			     $val = $row['bed_type'] .":". $row['bed_idx'] .":". $row['price1'] .":". $row['price2'] .":". $row['price3'] .":". $row['price5'] .":". $baht_thai;
			     if($room_r == "") {
			        $room_r .= $val;
				 } else {
			        $room_r .= "|". $val; 
				 }	
			     
		endforeach;
		
		// 만약 결과가 없을 경우 빈 배열 반환
		return $room_r;
}


function detailBedPrice($db, int $product_idx, int $g_idx, int $rooms_idx, $o_sdate, int $days, int $bed_idx)  
{
    // DB 연결 확인 후 연결
    if (!$db) {
        $db = \Config\Database::connect();
    }

    $setting   = homeSetInfo();
    $baht_thai = (float)($setting['baht_thai'] ?? 0);

    // 종료 날짜 계산 (시작일 + ($days - 1)일)
    $o_edate = date('Y-m-d', strtotime($o_sdate . " + " . ($days - 1) . " days"));

    // Query Builder 생성
    $builder = $db->table('tbl_room_price')
        ->select('
            bed_idx, 
            goods_date, 
            goods_price1,
            goods_price2,
            goods_price3,
            goods_price4,
            goods_price5')
        ->where('product_idx', $product_idx)
        ->where('g_idx', $g_idx)
        ->where('rooms_idx', $rooms_idx)
        ->where('bed_idx', $bed_idx)
        ->where('goods_date >=', $o_sdate)
        ->where('goods_date <=', $o_edate)
        ->orderBy('goods_date', 'ASC'); // 일자별 정렬

    $query    = $builder->get();
    $dateRows = $query->getResultArray(); // 여러 개의 행을 가져옴

    // 실행된 SQL 로그 출력 (디버깅)
    //if ($product_idx == 2207 && $g_idx == 377 && $rooms_idx == 826) {
    //    write_log("detailBedPrice SQL - " . $builder->getCompiledSelect());
    //}

    // 결과값 조합
    $room_r = array_map(function ($row) use ($baht_thai) {
        return implode(":", [
            $row['goods_date'],
            $row['goods_price1'],
            $row['goods_price2'],
            $row['goods_price3'],
            $row['goods_price4'],
            $row['goods_price5'],
            $row['bed_type'],
            $baht_thai,
        ]);
    }, $dateRows);

    // 로그 기록
    //write_log("room_r - " . implode("|", $room_r));

    // 결과 반환
    return implode("|", $room_r);
}




function todayPriceView($db, int $product_idx, int $g_idx, int $rooms_idx, int $bed_idx)
{
		// DB 연결 확인 후 연결
		if (!$db) {
			$db = \Config\Database::connect();
		}

        $setting   = homeSetInfo();
        $baht_thai = (float)($setting['baht_thai'] ?? 0);

		// 종료 날짜 계산 (시작일 + ($days - 1)일)
		$today = date('Y-m-d');
		
		// Query Builder 생성
		$builder = $db->table('tbl_room_price');

		// 안전한 SQL 쿼리 작성 (SQL Injection 방지)
		$builder->where('product_idx',   $product_idx)
				->where('g_idx',         $g_idx)
				->where('rooms_idx',     $rooms_idx)
				->where('bed_idx',       $bed_idx)
				->where('goods_date  =', $today)
				->limit(1); // 최소값 1개만 가져오기

		// 쿼리 실행
		$query  = $builder->get();
		$row    = $query->getRowArray(); // 한 개의 행만 가져옴

		// 실행된 쿼리 확인 (디버깅 용도)
		//write_log("depositPrice - " . $db->getLastQuery());

		// 만약 결과가 없을 경우 기본값 반환
		if (!$row) {
			return "0|0|0|0|0";
		}

		// 결과 문자열 생성
		return "{$row['goods_price1']}|{$row['goods_price2']}|{$row['goods_price3']}|{$row['goods_price4']}|{$row['goods_price5']}|{$baht_thai}";
}
?>