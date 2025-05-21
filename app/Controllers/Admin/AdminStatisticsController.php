<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminStatisticsController extends BaseController
{
    protected $connect;
    protected $codeModel;

    public function __construct()
    {
        $this->connect = Config::connect();

        $this->codeModel = model("Code");

        helper('my_helper');
        helper('alert_helper');
    }

    public function statistics01_01()
    {
        $gubun    = updateSQ($_GET['gubun'] ?? "");
        $or_c_cnt = updateSQ($_GET['or_c_cnt'] ?? "");
        $rd_c_sum = updateSQ($_GET['rd_c_sum'] ?? "");
        $rd_d_sum = updateSQ($_GET['rd_d_sum'] ?? "");
        $rd_e_sum = updateSQ($_GET['rd_e_sum'] ?? "");
        $rd_total_sum = updateSQ($_GET['rd_total_sum'] ?? "");

        $sYear = updateSQ($_GET['sYear'] ?? "");
        if ($sYear == "") {
            $sYear = date("Y");
        }

        $sMonth = updateSQ($_GET['sMonth'] ?? "");
        if ($sMonth == "") {
            $sMonth = date("n");
        }

        $sDate = updateSQ($_GET['sDate'] ?? "");
        $eDate = updateSQ($_GET['eDate'] ?? "");
        $sWhere2 = "";
        if ($sDate != "" && $eDate != "") {
            $sWhere2 = " AND (DATE(order_r_date) >= '" . $sDate . "' AND DATE(order_r_date) <= '" . $eDate . "')";
        }

        // 지난주 예약건수 (상품)
        $total_sql1 = " 
            SELECT CONCAT(
                      DATE_FORMAT(
                         DATE_SUB(order_r_date, INTERVAL (DAYOFWEEK(order_r_date) - 1) DAY),
                         '%Y/%m/%d'),
                      '~ ',
                      DATE_FORMAT(
                         DATE_SUB(order_r_date, INTERVAL (DAYOFWEEK(order_r_date) - 7) DAY),
                         '%Y/%m/%d'))
                      AS date,
                   count(*) AS out_count
                FROM tbl_order_mst
                where order_status in ('W','Y','G','J','R')
             /*WHERE NOT (`created` IS NULL)*/
            GROUP BY date
            ORDER BY order_r_date DESC limit 0, 1
            ";
        $week_result1 = $this->connect->query($total_sql1);
        $week_row1 = $week_result1->getRowArray();
        $week_count1 = $week_row1['out_count'] ?? 0;

        $week_count = $week_count1;

        // 지난달 예약건수 (상품)
        $month_sql1 = "select substring(order_r_date,1,7) as date,count(*) as month_count from tbl_order_mst where order_status in('W','Y','G','J','R') group by date ORDER BY order_r_date DESC limit 1, 1";
        $month_result1 = $this->connect->query($month_sql1);
        $month_row1 = $month_result1->getRowArray();
        $month_count1 = $month_row1['month_count'] ?? 0;

        $month_count = $month_count1;

        // 이번달 예약건수 (상품)
        $nmonth_sql1 = "select substring(order_r_date,1,7) as date,count(*) as month_count from tbl_order_mst where order_status in('W','Y','G','J','R') group by date ORDER BY order_r_date DESC limit 0, 1";
        $nmonth_result1 = $this->connect->query($nmonth_sql1);
        $nmonth_row1 = $nmonth_result1->getRowArray();
        $nmonth_count1 = $nmonth_row1['month_count'] ?? 0;

        $nmonth_count = $nmonth_count1;

        // 오늘 예약건수 (상품)
        $now_sql1 = "select count(*) as now_count from tbl_order_mst where order_status in('W','Y','G','J','R') and date(order_r_date) = date_format(now(), '%Y-%m-%d') ";
        $now_result1 = $this->connect->query($now_sql1);
        $now_row1 = $now_result1->getRowArray();
        $now_count1 = $now_row1['now_count'] ?? 0;

        $now_count = $now_count1;

        // 어제 예약건수 (상품)
        $y_sql1 = "select count(*) as y_count from tbl_order_mst where order_status in('W','Y','G','J','R') and order_r_date = curdate( ) - INTERVAL 1 DAY";
        $y_result1 = $this->connect->query($y_sql1);
        $y_row1 = $y_result1->getRowArray();
        $y_count1 = $y_row1['now_count'] ?? 0;

        $y_count = $y_count1;

        // 상태(예약확인중) (상품)
        $r_sql1 = "select count(*) as rever_cnt from tbl_order_mst where order_status in ('')";
        $r_result1 = $this->connect->query($r_sql1);
        $r_row1 = $r_result1->getRowArray();
        $r_count1 = $r_row1['rever_cnt'];

        $r_count = $r_count1;

        // 상태(결제완료) (상품)
        $p_sql1 = "select count(*) as pay_cnt from tbl_order_mst where order_status in ('Y')";
        $p_result1 = $this->connect->query($p_sql1);
        $p_row1 = $p_result1->getRowArray();
        $p_count1 = $p_row1['pay_cnt'];

        $p_count = $p_count1;

        // 상태(취소완료) (상품)
        $c_sql1 = "select count(*) as pay_cnt from tbl_order_mst where order_status in ('C')";
        $c_result1 = $this->connect->query($c_sql1);
        $c_row1 = $c_result1->getRowArray();
        $c_count1 = $c_row1['pay_cnt'];

        $c_count = $c_count1;

        $_table = "(select order_idx, order_r_date, order_status from tbl_order_mst
				union all
				select order_idx, order_r_date, order_status from tbl_horder)";

        $_week = "|일|월|화|수|목|금|토";
        $dow = explode("|", $_week);

        $_date = $sYear . "-" . $sMonth;
        $sql = "SELECT DATE(order_r_date) AS date, 
										   sum(order_price) as order_price,
										   sum(deposit_price) as deposit_price,
										   sum(order_confirm_price) as order_confirm_price,
										   count(product_idx) as order_cnt
								   FROM tbl_order_mst
								   WHERE DATE_FORMAT(order_r_date,'%Y-%m') = '$_date' AND order_status in('W','Y','G','J','R') GROUP BY date ";
        $result2 = $this->connect->query($sql);
        $result2 = $result2->getResultArray();

        $data = [
            'sYear' => $sYear,
            'sMonth' => $sMonth,
            'nmonth_count' => $nmonth_count,
            'now_count' => $now_count,
            'y_count' => $y_count,
            'r_count' => $r_count,
            'p_count' => $p_count,
            'c_count' => $c_count,
            'week' => $week ?? 0,
            'month' => $month ?? 0,
            'year' => $year ?? 0,
            'week_count' => $week_count,
            'month_count' => $month_count,
            'year_count' => $year_count ?? 0,
            'dow' => $dow,
            'gubun' => $gubun,
            'or_c_cnt' => $or_c_cnt,
            'rd_c_sum' => $rd_c_sum,
            'rd_d_sum' => $rd_d_sum,
            'rd_e_sum' => $rd_e_sum,
            'rd_total_sum' => $rd_total_sum,
            'result2' => $result2
        ];
        return view('admin/_statistics/statistics01_01', $data);
    }

    public function statistics02_01()
    {
        $search_name = updateSQ($_GET['search_name'] ?? '');
        $search_category = updateSQ($_GET['search_category'] ?? '');
        $s_status = updateSQ($_GET['s_status'] ?? '');
        $gubun = updateSQ($_GET['gubun'] ?? '');
        $strSql = '';

        $g_list_rows = 10;
        if ($search_name) {
            $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
        }

        if ($s_status == "") {
            $s_status = "Y";
        }

        //        $total_sql = " select d.*, g.goods_name_front
        //	                 from tbl_counsel_deal d
        //					 left outer join tbl_goods g
        //					   on d.sel_goods = g.g_idx
        //					where 1=1 $strSql ";
        //        $result = $this->connect->query($total_sql);
        //        $nTotalCount = $result->getNumRows();

        $data = [
            'search_name' => $search_name,
            'search_category' => $search_category,
            's_status' => $s_status,
            'gubun' => $gubun,
            'pg' => $pg ?? 1,
            'nPage' => $nPage ?? 1,
            'g_list_rows' => $g_list_rows,
            'nTotalCount' => $nTotalCount ?? 0,
        ];

        return view('admin/_statistics/statistics02_01', $data);
    }

    public function statistics03_01()
    {
        $data = [];

        return view('admin/_statistics/statistics03_01', $data);
    }

    public function statistics04_01()
    {
        $data = [];

        return view('admin/_statistics/statistics04_01', $data);
    }

    public function statistics05_01()
    {
        $data = [];

        return view('admin/_statistics/statistics05_01', $data);
    }

    public function getData($row)
    {
        $sql_week = "select dayofweek('{$row['date']}') as week ";
        $result_week = $this->connect->query($sql_week);
        $row_week = $result_week->getRowArray();
        return $row_week;
    }

	public function statistics_sale_yoil()
	{
		$years  = $this->request->getGet('years')  ?? date('Y');
		$months = str_pad($this->request->getGet('months') ?? date('m'), 2, '0', STR_PAD_LEFT);
		$yoil   = $this->request->getGet('weeks');  // 요일: 1(일)~7(토)
		$payin  = $this->request->getGet('payin');  // P / M

		$startDate = "$years-$months-01";
		$endDate   = date('Y-m-t', strtotime($startDate));

		$db = \Config\Database::connect();

		// 요일별 초기화
		$pc_price_arr      = $pc_cnt_arr      = $pc_coupon_arr      = $pc_point_arr      = array_fill(1, 7, 0);
		$mobile_price_arr  = $mobile_cnt_arr  = $mobile_coupon_arr  = $mobile_point_arr  = array_fill(1, 7, 0);

		// ===== PC
		if (empty($payin) || $payin === 'P') {
			$builder = $db->table('tbl_order_mst');
			$builder->select("
				DAYOFWEEK(tbl_order_mst.order_date) as yoil,
				SUM(tbl_order_mst.real_price_won) as total,
				SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
				SUM(tbl_payment_mst.used_point) as point_total,
				COUNT(*) as count
			");
			$builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
			$builder->where("tbl_order_mst.order_date >=", $startDate);
			$builder->where("tbl_order_mst.order_date <=", $endDate);
			$builder->where("tbl_order_mst.device_type", "P");
			$builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);

			if (!empty($yoil)) {
				$builder->where("DAYOFWEEK(tbl_order_mst.order_date)", (int)$yoil);
			}

			$builder->groupBy("yoil");
			$results = $builder->get()->getResult();

			foreach ($results as $row) {
				$y = (int)$row->yoil;
				$pc_price_arr[$y]     = (int)$row->total;
				$pc_cnt_arr[$y]       = (int)$row->count;
				$pc_coupon_arr[$y]    = (int)$row->coupon_total;
				$pc_point_arr[$y]     = (int)$row->point_total;
			}
		}

		// ===== Mobile
		if (empty($payin) || $payin === 'M') {
			$builder = $db->table('tbl_order_mst');
			$builder->select("
				DAYOFWEEK(tbl_order_mst.order_date) as yoil,
				SUM(tbl_order_mst.real_price_won) as total,
				SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
				SUM(tbl_payment_mst.used_point) as point_total,
				COUNT(*) as count
			");
			$builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
			$builder->where("tbl_order_mst.order_date >=", $startDate);
			$builder->where("tbl_order_mst.order_date <=", $endDate);
			$builder->where("tbl_order_mst.device_type", "M");
			$builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);

			if (!empty($yoil)) {
				$builder->where("DAYOFWEEK(tbl_order_mst.order_date)", (int)$yoil);
			}

			$builder->groupBy("yoil");
			$results = $builder->get()->getResult();

			foreach ($results as $row) {
				$y = (int)$row->yoil;
				$mobile_price_arr[$y]    = (int)$row->total;
				$mobile_cnt_arr[$y]      = (int)$row->count;
				$mobile_coupon_arr[$y]   = (int)$row->coupon_total;
				$mobile_point_arr[$y]    = (int)$row->point_total;
			}
		}

		return view('admin/_statistics/statistics_sale_yoil', [
			'years'              => $years,
			'months'             => $months,
			'yoil'               => $yoil,
			'payin'              => $payin,
			'pc_price_arr'       => $pc_price_arr,
			'pc_cnt_arr'         => $pc_cnt_arr,
			'pc_coupon_arr'      => $pc_coupon_arr,
			'pc_point_arr'       => $pc_point_arr,
			'mobile_price_arr'   => $mobile_price_arr,
			'mobile_cnt_arr'     => $mobile_cnt_arr,
			'mobile_coupon_arr'  => $mobile_coupon_arr,
			'mobile_point_arr'   => $mobile_point_arr
		]);
	}

public function statistics_sale_day()
{
    $db     = \Config\Database::connect();

    $years  = $this->request->getGet('years');
    $months = $this->request->getGet('months');
    $payin  = $this->request->getGet('payin'); // P / M

    if (empty($years))  $years  = date('Y');
    if (empty($months)) $months = date('m');
    if (strlen($months) < 2) $months = "0". $months;

    $startDate = "{$years}-{$months}-01";
    $endDate   = date("Y-m-t", strtotime($startDate)); // 그 달의 마지막 날까지

    $pc_price_arr = [];
    $mobile_price_arr = [];

    // === PC
    if (empty($payin) || $payin === 'P') {
        $builder = $db->table('tbl_order_mst');
        $builder->select("
            DATE_FORMAT(tbl_order_mst.order_date, '%Y-%m-%d') as yyyymmdd,
            SUM(tbl_order_mst.real_price_won) as total,
			SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
			SUM(tbl_payment_mst.used_point) as point_total,
            COUNT(*) as count
        ");
        $builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
        $builder->where("tbl_order_mst.order_date >=", $startDate);
        $builder->where("tbl_order_mst.order_date <=", $endDate);
        $builder->where("tbl_order_mst.device_type", "P");
        $builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);
        $builder->groupBy("yyyymmdd");

        $results = $builder->get()->getResult();
        foreach ($results as $row) {
            $pc_price_arr[$row->yyyymmdd]  = (int)$row->total;
            $pc_coupon_arr[$row->yyyymmdd] = (int)$row->coupon_total;
            $pc_point_arr[$row->yyyymmdd]  = (int)$row->point_total;
            $pc_count_arr[$row->yyyymmdd]  = (int)$row->count;
        }
    }

    // === Mobile
    if (empty($payin) || $payin === 'M') {
        $builder = $db->table('tbl_order_mst');
        $builder->select("
            DATE_FORMAT(tbl_order_mst.order_date, '%Y-%m-%d') as yyyymmdd,
            SUM(tbl_order_mst.real_price_won) as total,
			SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
			SUM(tbl_payment_mst.used_point) as point_total,
            COUNT(*) as count
        ");
        $builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
        $builder->where("tbl_order_mst.order_date >=", $startDate);
        $builder->where("tbl_order_mst.order_date <=", $endDate);
        $builder->where("tbl_order_mst.device_type", "M");
        $builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);
        $builder->groupBy("yyyymmdd");

        $results = $builder->get()->getResult();
        foreach ($results as $row) {
            $mobile_price_arr[$row->yyyymmdd]  = (int)$row->total;
            $mobile_coupon_arr[$row->yyyymmdd] = (int)$row->coupon_total;
            $mobile_point_arr[$row->yyyymmdd]  = (int)$row->point_total;
            $mobile_count_arr[$row->yyyymmdd]  = (int)$row->count;
        }
    }

    // === 차트 및 테이블 데이터 구성
    $chart_data = [
        ['날짜', 'PC', 'Mobile']
    ];

    $table_data = [];
    $max_day = date('t', strtotime($startDate));
    for ($d = 1; $d <= $max_day; $d++) {
        $date          = sprintf("%s-%02d-%02d", $years, $months, $d);
        $pc_price      = $pc_price_arr[$date] ?? 0;
        $pc_coupon     = $pc_coupon_arr[$date] ?? 0;
        $pc_point      = $pc_point_arr[$date] ?? 0;
        $pc_count      = $pc_count_arr[$date] ?? 0;
        $mobile_price  = $mobile_price_arr[$date] ?? 0;
        $mobile_coupon = $mobile_coupon_arr[$date] ?? 0;
        $mobile_point  = $mobile_point_arr[$date] ?? 0;
        $mobile_count  = $mobile_count_arr[$date] ?? 0;

        $chart_data[] = [$date, $pc_price, $mobile_price];

        $table_data[] = [
            'date'          => $date,
            'pc_price'      => $pc_price,
            'pc_coupon'     => $pc_coupon,
            'pc_point'      => $pc_point,
            'pc_count'      => $pc_count,
            'mobile_price'  => $mobile_price,
            'mobile_coupon' => $mobile_coupon,
            'mobile_point'  => $mobile_point,
            'mobile_count'  => $mobile_count,
        ];
    }

    return view('admin/_statistics/statistics_sale_day', [
        'years'      => $years,
        'months'     => $months,
        'payin'      => $payin,
        'chart_data' => $chart_data,
        'table_data' => $table_data,
    ]);
}



	public function statistics_sale_month()
	{
		$db     = \Config\Database::connect();

		$years  = $this->request->getGet('years');  // 연도
		$payin  = $this->request->getGet('payin');  // P / M

		if($years == "") $years = date('Y');
		$startDate = $years . '-01-01';
		$endDate   = $years . '-12-31';

		$pc_price_arr = [];
		$mobile_price_arr = [];

		// ===== PC
		if (empty($payin) || $payin === 'P') {
			$builder = $db->table('tbl_order_mst');
			$builder->select("
				DATE_FORMAT(tbl_order_mst.order_date, '%Y-%m') as yyyymm,
				SUM(tbl_order_mst.real_price_won) as total,
				SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
				SUM(tbl_payment_mst.used_point) as point_total,
				COUNT(*) as count
			");
			$builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
			$builder->where("tbl_order_mst.order_date >=", $startDate);
			$builder->where("tbl_order_mst.order_date <=", $endDate);
			$builder->where("tbl_order_mst.device_type", "P");
			$builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);
			$builder->groupBy("yyyymm");

			$results = $builder->get()->getResult();
			foreach ($results as $row) {
				$pc_price_arr[$row->yyyymm]  = (int)$row->total;
				$pc_cnt_arr[$row->yyyymm]    = (int)$row->count;
				$pc_coupon_arr[$row->yyyymm] = (int)$row->coupon_total;
				$pc_point_arr[$row->yyyymm]  = (int)$row->point_total;
			}
		}

		// ===== Mobile
		if (empty($payin) || $payin === 'M') {
			$builder = $db->table('tbl_order_mst');
			$builder->select("
				DATE_FORMAT(tbl_order_mst.order_date, '%Y-%m') as yyyymm,
				SUM(tbl_order_mst.real_price_won) as total,
				SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
				SUM(tbl_payment_mst.used_point) as point_total,
				COUNT(*) as count
			");
			$builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
			$builder->where("tbl_order_mst.order_date >=", $startDate);
			$builder->where("tbl_order_mst.order_date <=", $endDate);
			$builder->where("tbl_order_mst.device_type", "M");
			$builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);
			$builder->groupBy("yyyymm");

			$results = $builder->get()->getResult();
			foreach ($results as $row) {
				$mobile_price_arr[$row->yyyymm]  = (int)$row->total;
				$mobile_cnt_arr[$row->yyyymm]    = (int)$row->count;
				$mobile_coupon_arr[$row->yyyymm] = (int)$row->coupon_total;
				$mobile_point_arr[$row->yyyymm]  = (int)$row->point_total;
			}
		}

		// 합산 데이터 생성
		$total_price_arr = [];
		for ($m = 1; $m <= 12; $m++) {
			$month = sprintf("%s-%02d", $years, $m);
			$total_price_arr[$month] = 
				($pc_price_arr[$month] ?? 0) + 
				($mobile_price_arr[$month] ?? 0);
		}

		for ($m = 1; $m <= 12; $m++) {
			$month          = sprintf("%s-%02d", $years, $m);
			$price_arr[$m]  = ($pc_price_arr[$month] ?? 0) + ($mobile_price_arr[$month] ?? 0);
			$cnt_arr[$m]    = ($pc_cnt_arr[$month] ?? 0) + ($mobile_cnt_arr[$month] ?? 0);
			$pc_point_arr1[$m]  = $pc_point_arr[$month] ?? 0;
			$mobile_point_arr1[$m]  = $mobile_point_arr[$month] ?? 0;
			$pc_coupon_arr1[$m] = $pc_coupon_arr[$month] ?? 0;
			$mobile_coupon_arr1[$m] = $mobile_coupon_arr[$month] ?? 0;
			$cp_arr[$m]     = 0; // 예시용, CP 수수료 값도 추가했다면 이 부분 채우세요
		}

		return view('admin/_statistics/statistics_sale_month', [
			'years'             => $years,
			'payin'             => $payin,
			'price_arr'         => $price_arr,
			'point_arr'         => $point_arr,
			'coupon_arr'        => $coupon_arr,
			'cnt_arr'           => $cnt_arr,
			'pc_price_arr'      => $pc_price_arr,
			'pc_cnt_arr'        => $pc_cnt_arr,
			'pc_coupon_arr'     => $pc_coupon_arr1,
			'pc_point_arr'      => $pc_point_arr1,
			'mobile_price_arr'  => $mobile_price_arr,
			'mobile_cnt_arr'    => $mobile_cnt_arr,
			'mobile_coupon_arr' => $mobile_coupon_arr1,
			'mobile_point_arr'  => $mobile_point_arr1
		]);
	}


	public function statistics_sale_year()
	{
		$db     = \Config\Database::connect();

		$payin  = $this->request->getGet('payin');  // P / M

		// 전체 주문의 시작/끝 날짜 자동 계산
		$query     = $db->query("SELECT MIN(order_date) as min_date, MAX(order_date) as max_date FROM tbl_order_mst");
		$row       = $query->getRow();
		$startDate = substr($row->min_date,0,10) ?? '2000-01-01';
		$endDate   = substr($row->max_date,0,10) ?? date('Y-m-d');
	 
		$pc_price_arr     = $pc_cnt_arr     = $pc_coupon_arr     = $pc_point_arr     = [];
		$mobile_price_arr = $mobile_cnt_arr = $mobile_coupon_arr = $mobile_point_arr = [];

		// ===== PC
		if (empty($payin) || $payin === 'P') {
			$builder = $db->table('tbl_order_mst');
			$builder->select("
				YEAR(tbl_order_mst.order_date) as year,
				SUM(tbl_order_mst.real_price_won) as total,
				SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
				SUM(tbl_payment_mst.used_point) as point_total,
				COUNT(*) as count
			");
			$builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
			$builder->where("tbl_order_mst.order_date >=", $startDate);
			$builder->where("tbl_order_mst.order_date <=", $endDate);
			$builder->where("tbl_order_mst.device_type", "P");
			$builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);
			$builder->groupBy("YEAR(tbl_order_mst.order_date)");

			$results = $builder->get()->getResult();
			foreach ($results as $row) {
				$year = (int)$row->year;
				$pc_price_arr[$year]     = (int)$row->total;
				$pc_cnt_arr[$year]       = (int)$row->count;
				$pc_coupon_arr[$year]    = (int)$row->coupon_total;
				$pc_point_arr[$year]     = (int)$row->point_total;
			}
		}

		// ===== Mobile
		if (empty($payin) || $payin === 'M') {
			$builder = $db->table('tbl_order_mst');
			$builder->select("
				YEAR(tbl_order_mst.order_date) as year,
				SUM(tbl_order_mst.real_price_won) as total,
				SUM(tbl_payment_mst.used_coupon_money) as coupon_total,
				SUM(tbl_payment_mst.used_point) as point_total,
				COUNT(*) as count
			");
			$builder->join('tbl_payment_mst', 'tbl_order_mst.payment_no = tbl_payment_mst.payment_no', 'left');
			$builder->where("tbl_order_mst.order_date >=", $startDate);
			$builder->where("tbl_order_mst.order_date <=", $endDate);
			$builder->where("tbl_order_mst.device_type", "M");
			$builder->whereIn("tbl_order_mst.order_status", ['Y', 'Z', 'E']);
			$builder->groupBy("YEAR(tbl_order_mst.order_date)");

			$results = $builder->get()->getResult();
			foreach ($results as $row) {
				$year = (int)$row->year;
				$mobile_price_arr[$year]    = (int)$row->total;
				$mobile_cnt_arr[$year]      = (int)$row->count;
				$mobile_coupon_arr[$year]   = (int)$row->coupon_total;
				$mobile_point_arr[$year]    = (int)$row->point_total;
			}
		}

		// 통합 배열 초기화
		$price_arr = $cnt_arr = $coupon_arr = $point_arr = [];

		for ($year = date('Y', strtotime($startDate)); $year <= date('Y', strtotime($endDate)); $year++) {
			$price_arr[$year]  = ($pc_price_arr[$year] ?? 0) + ($mobile_price_arr[$year] ?? 0);
			$cnt_arr[$year]    = ($pc_cnt_arr[$year] ?? 0) + ($mobile_cnt_arr[$year] ?? 0);
			$coupon_arr[$year] = ($pc_coupon_arr[$year] ?? 0) + ($mobile_coupon_arr[$year] ?? 0);
			$point_arr[$year]  = ($pc_point_arr[$year] ?? 0) + ($mobile_point_arr[$year] ?? 0);
		}

		return view('admin/_statistics/statistics_sale_year', [
			'payin'              => $payin,
			'pc_price_arr'       => $pc_price_arr,
			'pc_cnt_arr'         => $pc_cnt_arr,
			'pc_coupon_arr'      => $pc_coupon_arr,
			'pc_point_arr'       => $pc_point_arr,
			'mobile_price_arr'   => $mobile_price_arr,
			'mobile_cnt_arr'     => $mobile_cnt_arr,
			'mobile_coupon_arr'  => $mobile_coupon_arr,
			'mobile_point_arr'   => $mobile_point_arr,

			// 추가된 데이터
			'price_arr'          => $price_arr,
			'cnt_arr'            => $cnt_arr,
			'coupon_arr'         => $coupon_arr,
			'point_arr'          => $point_arr,

			// 년도 범위 전달
			'years_s'            => (int)date('Y', strtotime($startDate)),
			'years_e'            => (int)date('Y', strtotime($endDate)),
		]);

	}

    public function statistics_sale_sales()
    {
        return view('admin/_statistics/statistics_sale_sales');
    }

	public function statistics_sale_type()
	{
		$db = \Config\Database::connect();

		$s_date = $this->request->getGet('s_date') ?? date('Y-m-d');
		$e_date = $this->request->getGet('e_date') ?? date('Y-m-d');
		$payin  = $this->request->getGet('payin'); // 'P' or 'M'

		$sql = "
			SELECT pm.payment_method, SUM(pm.Amt_1) AS total
			FROM tbl_payment_mst pm
			JOIN tbl_order_mst om ON pm.payment_no = om.payment_no
			WHERE pm.paydate BETWEEN ? AND ?
			  AND pm.payment_method IS NOT NULL
			  AND pm.payment_method != ''
		";

		$params = [$s_date . ' 00:00:00', $e_date . ' 23:59:59'];

		if (!empty($payin)) {
			$sql .= " AND om.device_type = ?";
			$params[] = $payin;
		}

		$sql .= " GROUP BY pm.payment_method ORDER BY total DESC";

		$query  = $db->query($sql, $params);
		$result = $query->getResult();

		// 한글 결제수단 → 코드명 매핑
		$code_map = [
			'신용카드'       => 'Card',
			'가상계좌'       => 'VBank',
			'계좌입금'       => 'MBank',
			'실시간계좌이체' => 'DBank',
		];

		$converted_result = [];

		foreach ($result as $row) {
			$kor_method = $row->payment_method;
			$code_name  = $code_map[$kor_method] ?? 'Unknown';

			$converted_result[] = [
				'method' => $code_name,
				'total'  => (int) $row->total,
			];
		}

		return view('admin/_statistics/statistics_sale_type', [
			'converted_result' => $converted_result,
			's_date'           => $s_date,
			'e_date'           => $e_date,
			'payin'            => $payin,
		]);
	}

    public function statistics_sale_type_day()
    {
		$db = \Config\Database::connect();

		$years  = $this->request->getGet('years') ?? date('Y');
		$months = $this->request->getGet('months') ?? date('m');
	    $days   = $this->request->getGet('months') ?? date('d');

		$payin  = $this->request->getGet('payin'); // 'P' or 'M'

		// 해당 연도의 시작일과 종료일 설정
		$s_date = $years . '-'. $months .'-'. $days;
		$e_date = $years . '-'. $months .'-'. $days;

		$sql = "
			SELECT pm.payment_method, SUM(pm.Amt_1) AS total
			FROM tbl_payment_mst pm
			JOIN tbl_order_mst om ON pm.payment_no = om.payment_no
			WHERE pm.paydate BETWEEN ? AND ?
			  AND pm.payment_method IS NOT NULL
			  AND pm.payment_method != ''
		";

		$params = [$s_date . ' 00:00:00', $e_date . ' 23:59:59'];

		if (!empty($payin)) {
			$sql .= " AND om.device_type = ?";
			$params[] = $payin;
		}

		$sql .= " GROUP BY pm.payment_method ORDER BY total DESC";

		$query  = $db->query($sql, $params);
		$result = $query->getResult();

		// 한글 결제수단 → 코드명 매핑
		$code_map = [
			'신용카드'       => 'Card',
			'가상계좌'       => 'VBank',
			'계좌입금'       => 'MBank',
			'실시간계좌이체' => 'DBank',
		];

		$converted_result = [];

		foreach ($result as $row) {
			$kor_method = $row->payment_method;
			$code_name  = $code_map[$kor_method] ?? 'Unknown';

			$converted_result[] = [
				'method' => $code_name,
				'total'  => (int) $row->total,
			];
		}

		return view('admin/_statistics/statistics_sale_type_day', [
			'converted_result' => $converted_result,
			'years'            => $years,
			'payin'            => $payin,
		]);			
    }

	public function statistics_sale_type_week()
	{
		$db = \Config\Database::connect();

		$years  = $this->request->getGet('years') ?? date('Y');
		$months = $this->request->getGet('months') ?? date('m');
		$weeks  = $this->request->getGet('weeks') ?? 1;
		$payin  = $this->request->getGet('payin'); // 'P' or 'M'

		// 월의 첫날
		$first_day_of_month = new \DateTime("{$years}-{$months}-01");

		// 해당 월의 요일 offset 계산 (0: 일요일, 1: 월요일, ...)
		$day_of_week = (int) $first_day_of_month->format('w'); // 일:0 ~ 토:6

		// N번째 주의 시작일 계산
		$start_date = clone $first_day_of_month;
		$start_date->modify('+' . (7 * ($weeks - 1)) . ' days');

		// N번째 주의 종료일 계산
		$end_date = clone $start_date;
		$end_date->modify('+6 days');

		// 종료일이 월을 넘기면 월 말일로 제한
		$last_day_of_month = new \DateTime($first_day_of_month->format('Y-m-t'));
		if ($end_date > $last_day_of_month) {
			$end_date = $last_day_of_month;
		}

		$sql = "
			SELECT pm.payment_method, SUM(pm.Amt_1) AS total
			FROM tbl_payment_mst pm
			JOIN tbl_order_mst om ON pm.payment_no = om.payment_no
			WHERE pm.paydate BETWEEN ? AND ?
			  AND pm.payment_method IS NOT NULL
			  AND pm.payment_method != ''
		";

		$params = [$start_date->format('Y-m-d') . ' 00:00:00', $end_date->format('Y-m-d') . ' 23:59:59'];

		if (!empty($payin)) {
			$sql .= " AND om.device_type = ?";
			$params[] = $payin;
		}

		$sql .= " GROUP BY pm.payment_method ORDER BY total DESC";

		$query  = $db->query($sql, $params);
		$result = $query->getResult();

		// 한글 결제수단 → 코드명 매핑
		$code_map = [
			'신용카드'       => 'Card',
			'가상계좌'       => 'VBank',
			'계좌입금'       => 'MBank',
			'실시간계좌이체' => 'DBank',
		];

		$converted_result = [];

		foreach ($result as $row) {
			$kor_method = $row->payment_method;
			$code_name  = $code_map[$kor_method] ?? 'Unknown';

			$converted_result[] = [
				'method' => $code_name,
				'total'  => (int) $row->total,
			];
		}

		return view('admin/_statistics/statistics_sale_type_week', [
			'converted_result' => $converted_result,
			'years'            => $years,
			'months'           => $months,
			'weeks'            => $weeks,
			'payin'            => $payin,
			's_date'           => $start_date->format('Y-m-d'),
			'e_date'           => $end_date->format('Y-m-d'),
		]);
	}


    public function statistics_sale_type_month()
    {
		$db = \Config\Database::connect();

		$years  = $this->request->getGet('years') ?? date('Y');
		$months = $this->request->getGet('months') ?? date('m');
		$payin  = $this->request->getGet('payin'); // 'P' or 'M'

		// 해당 연도의 시작일과 종료일 설정
		$s_date = $years . '-'. $months .'-01';
		$e_date = $years . '-'. $months .'-31';

		$sql = "
			SELECT pm.payment_method, SUM(pm.Amt_1) AS total
			FROM tbl_payment_mst pm
			JOIN tbl_order_mst om ON pm.payment_no = om.payment_no
			WHERE pm.paydate BETWEEN ? AND ?
			  AND pm.payment_method IS NOT NULL
			  AND pm.payment_method != ''
		";

		$params = [$s_date . ' 00:00:00', $e_date . ' 23:59:59'];

		if (!empty($payin)) {
			$sql .= " AND om.device_type = ?";
			$params[] = $payin;
		}

		$sql .= " GROUP BY pm.payment_method ORDER BY total DESC";

		$query  = $db->query($sql, $params);
		$result = $query->getResult();

		// 한글 결제수단 → 코드명 매핑
		$code_map = [
			'신용카드'       => 'Card',
			'가상계좌'       => 'VBank',
			'계좌입금'       => 'MBank',
			'실시간계좌이체' => 'DBank',
		];

		$converted_result = [];

		foreach ($result as $row) {
			$kor_method = $row->payment_method;
			$code_name  = $code_map[$kor_method] ?? 'Unknown';

			$converted_result[] = [
				'method' => $code_name,
				'total'  => (int) $row->total,
			];
		}

		return view('admin/_statistics/statistics_sale_type_month', [
			'converted_result' => $converted_result,
			'years'            => $years,
			'payin'            => $payin,
		]);		
    }

	public function statistics_sale_type_year()
	{
		$db = \Config\Database::connect();

		$years = $this->request->getGet('years') ?? date('Y');
		$payin = $this->request->getGet('payin'); // 'P' or 'M'

		// 해당 연도의 시작일과 종료일 설정
		$s_date = $years . '-01-01';
		$e_date = $years . '-12-31';

		$sql = "
			SELECT pm.payment_method, SUM(pm.Amt_1) AS total
			FROM tbl_payment_mst pm
			JOIN tbl_order_mst om ON pm.payment_no = om.payment_no
			WHERE pm.paydate BETWEEN ? AND ?
			  AND pm.payment_method IS NOT NULL
			  AND pm.payment_method != ''
		";

		$params = [$s_date . ' 00:00:00', $e_date . ' 23:59:59'];

		if (!empty($payin)) {
			$sql .= " AND om.device_type = ?";
			$params[] = $payin;
		}

		$sql .= " GROUP BY pm.payment_method ORDER BY total DESC";

		$query  = $db->query($sql, $params);
		$result = $query->getResult();

		// 한글 결제수단 → 코드명 매핑
		$code_map = [
			'신용카드'       => 'Card',
			'가상계좌'       => 'VBank',
			'계좌입금'       => 'MBank',
			'실시간계좌이체' => 'DBank',
		];

		$converted_result = [];

		foreach ($result as $row) {
			$kor_method = $row->payment_method;
			$code_name  = $code_map[$kor_method] ?? 'Unknown';

			$converted_result[] = [
				'method' => $code_name,
				'total'  => (int) $row->total,
			];
		}

		return view('admin/_statistics/statistics_sale_type_year', [
			'converted_result' => $converted_result,
			'years'            => $years,
			'payin'            => $payin,
		]);
	}

    public function statistics_sale_type2()
    {
        return view('admin/_statistics/statistics_sale_type2');
    }

    public function statistics_sale_type3()
    {
        $code_list = $this->codeModel->getByParentCode(1303)->getResultArray();

        $code_names = array_column($code_list, 'code_name');

        return view('admin/_statistics/statistics_sale_type3', [
            'code_names' => $code_names
        ]);
    }

    public function statistics_sale_type3_day()
    {
        $code_list = $this->codeModel->getByParentCode(1303)->getResultArray();

        $code_names = array_column($code_list, 'code_name');
        return view('admin/_statistics/statistics_sale_type3_day',[
            'code_names' => $code_names
        ]);
    }

    public function statistics_sale_type3_week()
    {
        $code_list = $this->codeModel->getByParentCode(1303)->getResultArray();

        $code_names = array_column($code_list, 'code_name');
        return view('admin/_statistics/statistics_sale_type3_week', [
            'code_names' => $code_names
        ]);
    }

    public function statistics_sale_type3_month()
    {
        $code_list = $this->codeModel->getByParentCode(1303)->getResultArray();

        $code_names = array_column($code_list, 'code_name');
        return view('admin/_statistics/statistics_sale_type3_month', [
            'code_names' => $code_names
        ]);
    }

    public function statistics_sale_type3_year()
    {
        $code_list = $this->codeModel->getByParentCode(1303)->getResultArray();

        $code_names = array_column($code_list, 'code_name');
        return view('admin/_statistics/statistics_sale_type3_year', [
            'code_names' => $code_names
        ]);
    }

    public function statistics_sale_list()
    {
        return view('admin/_statistics/statistics_sale_list');
    }

    public function member_statistics()
    {

        $years    = $this->request->getGet('years');
        $months = $this->request->getGet('months');
        $days    = $this->request->getGet('days');
        $payin    = $this->request->getGet('payin');

        if ($years == "") {
            $years = date('Y');
        }

        if ($months == "") {
            $months = date('m');
        }

        if ($days == "") {
            $days = date('d');
        }


        $last_day = date('t', mktime(0, 0, 0, $months, 1, $years));

        if ($last_day < $days) {
            $days = "01";
        }

        $s_date = date('Y-m-d 00:00:00', mktime(0, 0, 0, $months, $days, $years));
        $e_date = date('Y-m-d 23:59:59', mktime(0, 0, 0, $months, $days, $years));

        $hour_arr = array();
        $hour_arr2 = array();

        for ($i = 0; $i <= 23; $i++) {
            $hour_arr[$i] = 0;
        }

        for ($i = 0; $i <= 23; $i++) {
            $hour_arr2[$i] = 0;
        }

        $builder1 = $this->connect->table('tbl_member');
        $builder1->select('HOUR(r_date) AS hs, COUNT(*) as tcnt');
        $builder1->where('r_date >=', $s_date);
        $builder1->where('r_date <=', $e_date);
        $builder1->where('status', "Y");
        $builder1->groupBy('hs');
        $builder1->orderBy('hs', 'ASC');

        $query1 = $builder1->get();
        $hour_arr = [];

        foreach ($query1->getResultArray() as $row) {
            $hour_arr[$row['hs']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($hour_arr);

        $builder2 = $this->connect->table('tbl_member');
        $builder2->select('HOUR(out_date) AS hs, COUNT(*) as tcnt');
        $builder2->where('out_date >=', $s_date);
        $builder2->where('out_date <=', $e_date);
        $builder2->where('status', "O");
        $builder2->groupBy('hs');
        $builder2->orderBy('hs', 'ASC');

        $query2 = $builder2->get();
        $hour_arr2 = [];

        foreach ($query2->getResultArray() as $row) {
            $hour_arr2[$row['hs']] = $row['tcnt'];
        }

        $_total_cnt2 = array_sum($hour_arr2);

        $top_banner1_arr = array();
        $top_banner1_arr['M'] = 0;
        $top_banner1_arr['P'] = 0;

        $builder = $this->connect->table('tbl_member');
        $builder->select('reg_device, COUNT(*) as tcnt');
        $builder->where('r_date >=', $s_date);
        $builder->where('r_date <=', $e_date);
        $builder->where('status', "Y");
        $builder->groupBy('reg_device');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $top_banner1_arr[$row['reg_device']] = $row['tcnt'];
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "days" => $days,
            "payin" => $payin,
            "hour_arr" => $hour_arr,
            "hour_arr2" => $hour_arr2,
            "_total_cnt" => $_total_cnt,
            "_total_cnt2" => $_total_cnt2,
            "top_banner1_arr" => $top_banner1_arr,
        ];

        return view('admin/_statistics/member_statistics', $data);
    }

    public function member_statistics_yoil()
    {
        $years    = $this->request->getGet('years');
        $months = $this->request->getGet('months');
        $weeks    = $this->request->getGet('weeks');
        $payin    = $this->request->getGet('payin');

        if ($years == "") {
            $years = date('Y');
        }

        if ($months == "") {
            $months = date('m');
        }

        if ($weeks == "") {
            $s_date = date('Y-m-d 00:00:00', mktime(0, 0, 0, $months, 1, $years));
            $e_date = date('Y-m-d 23:59:59', mktime(0, 0, 0, $months, date('t', mktime(0, 0, 0, $months, 1, $years)), $years));
        } else {


            $week_tmp = getWeeksOfMonth($years, $months);
            foreach ($week_tmp as $index => $week_tmp) {

                if (($index + 1) == $weeks) {
                    $s_date = $week_tmp['start'] . " 00:00:00";
                    $e_date = $week_tmp['end'] . " 23:59:59";
                }
            }
        }


        $yoil_arr = array();
        $yoil_arr[1] = "일";
        $yoil_arr[2] = "월";
        $yoil_arr[3] = "화";
        $yoil_arr[4] = "수";
        $yoil_arr[5] = "목";
        $yoil_arr[6] = "금";
        $yoil_arr[7] = "토";

        $hour_arr = array();
        $hour_arr2 = array();

        for ($i = 1; $i <= 7; $i++) {
            $hour_arr[$i] = 0;
        }

        for ($i = 1; $i <= 7; $i++) {
            $hour_arr2[$i] = 0;
        }

        $builder1 = $this->connect->table('tbl_member');
        $builder1->select('DAYOFWEEK(r_date) AS weekday, COUNT(*) as tcnt');
        $builder1->where('r_date >=', $s_date);
        $builder1->where('r_date <=', $e_date);
        $builder1->where('status', "Y");
        $builder1->groupBy('weekday');
        $builder1->orderBy('weekday', 'ASC');

        $query1 = $builder1->get();
        $hour_arr = [];

        foreach ($query1->getResultArray() as $row) {
            $hour_arr[$row['weekday']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($hour_arr);

        $builder2 = $this->connect->table('tbl_member');
        $builder2->select('DAYOFWEEK(out_date) AS weekday, COUNT(*) as tcnt');
        $builder2->where('out_date >=', $s_date);
        $builder2->where('out_date <=', $e_date);
        $builder2->where('status', "O");
        $builder2->groupBy('weekday');
        $builder2->orderBy('weekday', 'ASC');

        $query2 = $builder2->get();
        $hour_arr2 = [];

        foreach ($query2->getResultArray() as $row) {
            $hour_arr2[$row['weekday']] = $row['tcnt'];
        }

        $_total_cnt2 = array_sum($hour_arr2);

        $top_banner1_arr = array();
        $top_banner1_arr['M'] = 0;
        $top_banner1_arr['P'] = 0;

        $builder = $this->connect->table('tbl_member');
        $builder->select('reg_device, COUNT(*) as tcnt');
        $builder->where('r_date >=', $s_date);
        $builder->where('r_date <=', $e_date);
        $builder->where('status', "Y");
        $builder->groupBy('reg_device');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $top_banner1_arr[$row['reg_device']] = $row['tcnt'];
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "weeks" => $weeks,
            "payin" => $payin,
            "yoil_arr" => $yoil_arr,
            "hour_arr" => $hour_arr,
            "hour_arr2" => $hour_arr2,
            "_total_cnt" => $_total_cnt,
            "_total_cnt2" => $_total_cnt2,
            "top_banner1_arr" => $top_banner1_arr,
        ];

        return view('admin/_statistics/member_statistics_yoil', $data);
    }

    public function member_statistics_day()
    {
        $years    = $this->request->getGet('years');
        $months   = $this->request->getGet('months');
        $payin    = $this->request->getGet('payin');

        if ($years == "") {
            $years = date('Y');
        }

        if ($months == "") {
            $months = date('m');
        }


        $s_date = date('Y-m-01 00:00:00', mktime(0, 0, 0, $months, 1, $years));
        $e_date = date('Y-m-d 23:59:59', mktime(0, 0, 0, $months, date('t', mktime(0, 0, 0, $months, 1, $years)), $years));

        $hour_arr = array();
        $hour_arr2 = array();

        for ($i = 0; $i <= 31; $i++) {
            $hour_arr[$i] = 0;
        }

        for ($i = 0; $i <= 31; $i++) {
            $hour_arr2[$i] = 0;
        }

        $builder1 = $this->connect->table('tbl_member');
        $builder1->select('DAY(r_date) AS days, COUNT(*) as tcnt');
        $builder1->where("r_date >=", $s_date);
        $builder1->where("r_date <=", $e_date);
        $builder1->where('status', "Y");
        $builder1->groupBy('days');
        $builder1->orderBy('days', 'ASC');

        $query1 = $builder1->get();
        $hour_arr = [];

        foreach ($query1->getResultArray() as $row) {
            $hour_arr[$row['days']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($hour_arr);

        $builder2 = $this->connect->table('tbl_member');
        $builder2->select('DAY(out_date) AS days, COUNT(*) as tcnt');
        $builder2->where("out_date >=", $s_date);
        $builder2->where("out_date <=", $e_date);
        $builder2->where('status', "O");
        $builder2->groupBy('days');
        $builder2->orderBy('days', 'ASC');

        $query2 = $builder2->get();
        $hour_arr2 = [];

        foreach ($query2->getResultArray() as $row) {
            $hour_arr2[$row['days']] = $row['tcnt'];
        }

        $_total_cnt2 = array_sum($hour_arr2);

        $top_banner1_arr = array();
        $top_banner1_arr['M'] = 0;
        $top_banner1_arr['P'] = 0;

        $builder = $this->connect->table('tbl_member');
        $builder->select('reg_device, COUNT(*) as tcnt');
        $builder->where('r_date >=', $s_date);
        $builder->where('r_date <=', $e_date);
        $builder->where('status', "Y");
        $builder->groupBy('reg_device');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $top_banner1_arr[$row['reg_device']] = $row['tcnt'];
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "payin" => $payin,
            "hour_arr" => $hour_arr,
            "hour_arr2" => $hour_arr2,
            "_total_cnt" => $_total_cnt,
            "_total_cnt2" => $_total_cnt2,
            "top_banner1_arr" => $top_banner1_arr,
        ];

        return view('admin/_statistics/member_statistics_day', $data);
    }

    public function member_statistics_month()
    {
        $years    = $this->request->getGet('years');
        $months   = $this->request->getGet('months');
        $payin    = $this->request->getGet('payin');

        if ($years == "") {
            $years = date('Y');
        }

        $s_date = date('Y-m-01 00:00:00', mktime(0, 0, 0, 1, 1, $years));
        $e_date = date('Y-m-d 23:59:59', mktime(0, 0, 0, 12, date('t', mktime(0, 0, 0, 12, 1, $years)), $years));

        $hour_arr = array();
        $hour_arr2 = array();

        for ($i = 0; $i <= 12; $i++) {
            $hour_arr[$i] = 0;
        }

        for ($i = 0; $i <= 12; $i++) {
            $hour_arr2[$i] = 0;
        }

        $builder1 = $this->connect->table('tbl_member');
        $builder1->select('MONTH(r_date) AS months, COUNT(*) as tcnt');
        $builder1->where("r_date >=", $s_date);
        $builder1->where("r_date <=", $e_date);
        $builder1->where('status', "Y");
        $builder1->groupBy('months');
        $builder1->orderBy('months', 'ASC');

        $query1 = $builder1->get();
        $hour_arr = [];

        foreach ($query1->getResultArray() as $row) {
            $hour_arr[$row['months']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($hour_arr);

        $builder2 = $this->connect->table('tbl_member');
        $builder2->select('MONTH(out_date) AS months, COUNT(*) as tcnt');
        $builder2->where("out_date >=", $s_date);
        $builder2->where("out_date <=", $e_date);
        $builder2->where('status', "O");
        $builder2->groupBy('months');
        $builder2->orderBy('months', 'ASC');

        $query2 = $builder2->get();
        $hour_arr2 = [];

        foreach ($query2->getResultArray() as $row) {
            $hour_arr2[$row['months']] = $row['tcnt'];
        }

        $_total_cnt2 = array_sum($hour_arr2);

        $top_banner1_arr = array();
        $top_banner1_arr['M'] = 0;
        $top_banner1_arr['P'] = 0;

        $builder = $this->connect->table('tbl_member');
        $builder->select('reg_device, COUNT(*) as tcnt');
        $builder->where('r_date >=', $s_date);
        $builder->where('r_date <=', $e_date);
        $builder->where('status', "Y");
        $builder->groupBy('reg_device');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $top_banner1_arr[$row['reg_device']] = $row['tcnt'];
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "payin" => $payin,
            "hour_arr" => $hour_arr,
            "hour_arr2" => $hour_arr2,
            "_total_cnt" => $_total_cnt,
            "_total_cnt2" => $_total_cnt2,
            "top_banner1_arr" => $top_banner1_arr,
        ];

        return view('admin/_statistics/member_statistics_month', $data);
    }

    public function member_statistics_year()
    {
        $years_s = 2024;
        $years_e = date('Y');

        $s_date = date('Y-m-01 00:00:00', mktime(0, 0, 0, 1, 1, $years_s));
        $e_date = date('Y-m-d 23:59:59', mktime(0, 0, 0, 12, 31, $years_e));

        $hour_arr = array();
        $hour_arr2 = array();

        for ($i = $years_s; $i <= $years_e; $i++) {
            $hour_arr[$i] = 0;
        }

        for ($i = $years_s; $i <= $years_e; $i++) {
            $hour_arr2[$i] = 0;
        }

        $builder1 = $this->connect->table('tbl_member');
        $builder1->select('YEAR(r_date) AS years, COUNT(*) as tcnt');
        $builder1->where("r_date >=", $s_date);
        $builder1->where("r_date <=", $e_date);
        $builder1->where('status', "Y");
        $builder1->groupBy('years');
        $builder1->orderBy('years', 'ASC');

        $query1 = $builder1->get();
        $hour_arr = [];

        foreach ($query1->getResultArray() as $row) {
            $hour_arr[$row['years']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($hour_arr);

        $builder2 = $this->connect->table('tbl_member');
        $builder2->select('YEAR(out_date) AS years, COUNT(*) as tcnt');
        $builder2->where("out_date >=", $s_date);
        $builder2->where("out_date <=", $e_date);
        $builder2->where('status', "O");
        $builder2->groupBy('years');
        $builder2->orderBy('years', 'ASC');

        $query2 = $builder2->get();
        $hour_arr2 = [];

        foreach ($query2->getResultArray() as $row) {
            $hour_arr2[$row['years']] = $row['tcnt'];
        }

        $_total_cnt2 = array_sum($hour_arr2);

        $top_banner1_arr = array();
        $top_banner1_arr['M'] = 0;
        $top_banner1_arr['P'] = 0;

        $builder = $this->connect->table('tbl_member');
        $builder->select('reg_device, COUNT(*) as tcnt');
        $builder->where('r_date >=', $s_date);
        $builder->where('r_date <=', $e_date);
        $builder->where('status', "Y");
        $builder->groupBy('reg_device');

        $query = $builder->get();

        foreach ($query->getResultArray() as $row) {
            $top_banner1_arr[$row['reg_device']] = $row['tcnt'];
        }

        $data = [
            "years_s" => $years_s,
            "years_e" => $years_e,
            "hour_arr" => $hour_arr,
            "hour_arr2" => $hour_arr2,
            "_total_cnt" => $_total_cnt,
            "_total_cnt2" => $_total_cnt2,
            "top_banner1_arr" => $top_banner1_arr,
        ];

        return view('admin/_statistics/member_statistics_year', $data);
    }

    public function member_statistics3()
    {
        $years  = $this->request->getGet('years') ?? date('Y');
        $months = $this->request->getGet('months') ?? date('m');
        $weeks  = $this->request->getGet('weeks');
        $payin  = $this->request->getGet('payin');

        $sql_select = "";
        if (!empty($payin)) {
            if($payin == "P") {
                $sql_select .= "SUM(login_type_P) AS tcnt";
            }else {
                $sql_select .= "SUM(login_type_M) AS tcnt";
            }
        }else{
            $sql_select .= "SUM(login_type_P + login_type_M) AS tcnt";
        }

        if (empty($weeks)) {
            $s_date = date('Y-m-01', mktime(0, 0, 0, $months, 1, $years));
            $e_date = date('Y-m-t', mktime(0, 0, 0, $months, 1, $years));
        } else {
            $weekData = getWeeksOfMonth($years, $months);
            $targetWeek = $weekData[(int)$weeks - 1] ?? null;
            if ($targetWeek) {
                $s_date = $targetWeek['start'];
                $e_date = $targetWeek['end'];
            } 
        }

        $yoil_arr = [1 => "일", 2 => "월", 3 => "화", 4 => "수", 5 => "목", 6 => "금", 7 => "토"];
        $price_arr = array_fill(1, 7, 0);

        $sql = "
            SELECT {$sql_select}, DAYOFWEEK(regdate) AS weekday
            FROM tbl_login_device
            WHERE DATE(regdate) BETWEEN " . $this->connect->escape($s_date) . " AND " . $this->connect->escape($e_date) . "
            GROUP BY DAYOFWEEK(regdate)
            ORDER BY weekday ASC
        ";

        $query = $this->connect->query($sql);
        $results = $query->getResultArray();

        foreach ($results as $row) {
            $price_arr[$row['weekday']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($price_arr);

        $data = [
            "years" => $years,
            "months" => $months,
            "weeks" => $weeks,
            "payin" => $payin,
            "yoil_arr" => $yoil_arr,
            "price_arr" => $price_arr,
            "_total_cnt" => $_total_cnt
        ];

        return view('admin/_statistics/member_statistics3', $data);
    }

    public function member_statistics3_day()
    {
        $years  = $this->request->getGet('years') ?? date('Y');
        $months = $this->request->getGet('months') ?? date('m');
        $payin  = $this->request->getGet('payin');

        $sql_select = "";
        if (!empty($payin)) {
            if($payin == "P") {
                $sql_select .= "SUM(login_type_P) AS tcnt";
            }else {
                $sql_select .= "SUM(login_type_M) AS tcnt";
            }
        }else{
            $sql_select .= "SUM(login_type_P + login_type_M) AS tcnt";
        }

        $s_date = date('Y-m-01', mktime(0, 0, 0, $months, 1, $years));
        $e_date = date('Y-m-t', mktime(0, 0, 0, $months, 1, $years));

        $price_arr = array_fill(1, 31, 0);

        $sql = "
            SELECT {$sql_select}, DAY(regdate) AS days
            FROM tbl_login_device
            WHERE DATE(regdate) BETWEEN " . $this->connect->escape($s_date) . " AND " . $this->connect->escape($e_date) . "
            GROUP BY DAY(regdate)
            ORDER BY days ASC
        ";

        $query = $this->connect->query($sql);
        $results = $query->getResultArray();

        foreach ($results as $row) {
            $price_arr[$row['days']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($price_arr);

        $data = [
            "years" => $years,
            "months" => $months,
            "payin" => $payin,
            "price_arr" => $price_arr,
            "_total_cnt" => $_total_cnt
        ];

        return view('admin/_statistics/member_statistics3_day', $data);
    }

    public function member_statistics3_month()
    {
        $years  = $this->request->getGet('years') ?? date('Y');
        $payin  = $this->request->getGet('payin');

        $sql_select = "";
        if (!empty($payin)) {
            if($payin == "P") {
                $sql_select .= "SUM(login_type_P) AS tcnt";
            }else {
                $sql_select .= "SUM(login_type_M) AS tcnt";
            }
        }else{
            $sql_select .= "SUM(login_type_P + login_type_M) AS tcnt";
        }

        $s_date = date('Y-m-01', mktime(0, 0, 0, 1, 1, $years));
        $e_date = date('Y-m-t', mktime(0, 0, 0, 12, 1, $years));

        $price_arr = array_fill(1, 12, 0);

        $sql = "
            SELECT {$sql_select}, MONTH(regdate) AS months
            FROM tbl_login_device
            WHERE DATE(regdate) BETWEEN " . $this->connect->escape($s_date) . " AND " . $this->connect->escape($e_date) . "
            GROUP BY MONTH(regdate)
            ORDER BY months ASC
        ";

        $query = $this->connect->query($sql);
        $results = $query->getResultArray();

        foreach ($results as $row) {
            $price_arr[$row['months']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($price_arr);

        $data = [
            "years" => $years,
            "payin" => $payin,
            "price_arr" => $price_arr,
            "_total_cnt" => $_total_cnt
        ];

        return view('admin/_statistics/member_statistics3_month', $data);
    }

    public function member_statistics3_year()
    {
        $years_s = 2024;
        $years_e = date('Y');
        $payin  = $this->request->getGet('payin');

        $sql_select = "";
        if (!empty($payin)) {
            if($payin == "P") {
                $sql_select .= "SUM(login_type_P) AS tcnt";
            }else {
                $sql_select .= "SUM(login_type_M) AS tcnt";
            }
        }else{
            $sql_select .= "SUM(login_type_P + login_type_M) AS tcnt";
        }

        $s_date = date('Y-m-01', mktime(0, 0, 0, 1, 1, $years_s));
        $e_date = date('Y-m-t', mktime(0, 0, 0, 12, 31, $years_e));

        $price_arr = array_fill($years_s, $years_e, 0);

        $sql = "
            SELECT {$sql_select}, YEAR(regdate) AS years
            FROM tbl_login_device
            WHERE DATE(regdate) BETWEEN " . $this->connect->escape($s_date) . " AND " . $this->connect->escape($e_date) . "
            GROUP BY YEAR(regdate)
            ORDER BY years ASC
        ";

        $query = $this->connect->query($sql);
        $results = $query->getResultArray();

        foreach ($results as $row) {
            $price_arr[$row['years']] = $row['tcnt'];
        }

        $_total_cnt = array_sum($price_arr);

        $data = [
            "years_s" => $years_s,
            "years_e" => $years_e,
            "payin" => $payin,
            "price_arr" => $price_arr,
            "_total_cnt" => $_total_cnt
        ];

        return view('admin/_statistics/member_statistics3_year', $data);
    }

    public function member_statistics4()
    {
        $s_date = $this->request->getGet('s_date');
        $e_date = $this->request->getGet('e_date');

        $s_date = empty($s_date) ? date('Y-m-d') : date('Y-m-d', strtotime($s_date));
        $e_date = empty($e_date) ? date('Y-m-d') : date('Y-m-d', strtotime($e_date));

        $builder = $this->connect->table('tbl_search_keyword');

        $builder->select('keyword, COUNT(*) as tcnt')
                ->where('keyword IS NOT NULL')
                ->where('keyword !=', '')
                ->where("DATE(regdate) >=", $s_date)
                ->where("DATE(regdate) <=", $e_date)
                ->groupBy('keyword')
                ->orderBy('tcnt', 'DESC');
    
        $query = $builder->get();
        $results = $query->getResultArray();
    
        $total_cnt = 0;
        $data_arr = [];
    
        foreach ($results as $row) {
            $total_cnt += $row['tcnt'];
            $data_arr[] = $row;
        }

        $data = [
            "s_date" => $s_date,
            "e_date" => $e_date,
            "total_cnt" => $total_cnt,
            "data_arr" => $data_arr,
        ];

        return view('admin/_statistics/member_statistics4', $data);
    }

    public function member_statistics4_day()
    {
        $years = $this->request->getGet('years') ?? date('Y');
        $months = $this->request->getGet('months') ?? date('m');
        $days = $this->request->getGet('days') ?? date('d');

        if( $days > date('t', mktime(0, 0, 0, $months, 1, $years)) ){
            $days = 1;
        }
        
        $s_date = date('Y-m-d', mktime(0, 0, 0, $months, $days, $years));
        $e_date = date('Y-m-d', mktime(0, 0, 0, $months, $days, $years));

        $builder = $this->connect->table('tbl_search_keyword');

        $builder->select('keyword, COUNT(*) as tcnt')
                ->where('keyword IS NOT NULL')
                ->where('keyword !=', '')
                ->where("DATE(regdate) >=", $s_date)
                ->where("DATE(regdate) <=", $e_date)
                ->groupBy('keyword')
                ->orderBy('tcnt', 'DESC');
    
        $query = $builder->get();
        $results = $query->getResultArray();
    
        $total_cnt = 0;
        $data_arr = [];
    
        foreach ($results as $row) {
            $total_cnt += $row['tcnt'];
            $data_arr[] = $row;
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "days" => $days,
            "total_cnt" => $total_cnt,
            "data_arr" => $data_arr,
        ];

        return view('admin/_statistics/member_statistics4_day', $data);
    }

    public function member_statistics4_week()
    {
        $years = $this->request->getGet('years') ?? date('Y');
        $months = $this->request->getGet('months') ?? date('m');
        $weeks = $this->request->getGet('weeks');

        if( $weeks == "" ){
            $week_arr = getWeeksOfMonth($years, $months);

            foreach ($week_arr as $index => $week) {
                if( date('Y-m-d') >= $week['start'] && date('Y-m-d') <= $week['end'] ){
                    $weeks = ($index +1);
                }
            }
        }

        $week_tmp = getWeeksOfMonth($years, $months);
        foreach ($week_tmp as $index => $week_tmp) {

            if (($index + 1) == $weeks) {
                $s_date = $week_tmp['start'] . " 00:00:00";
                $e_date = $week_tmp['end'] . " 23:59:59";
            }
        }
        
        $builder = $this->connect->table('tbl_search_keyword');

        $builder->select('keyword, COUNT(*) as tcnt')
                ->where('keyword IS NOT NULL')
                ->where('keyword !=', '')
                ->where("DATE(regdate) >=", $s_date)
                ->where("DATE(regdate) <=", $e_date)
                ->groupBy('keyword')
                ->orderBy('tcnt', 'DESC');
    
        $query = $builder->get();
        $results = $query->getResultArray();
    
        $total_cnt = 0;
        $data_arr = [];
    
        foreach ($results as $row) {
            $total_cnt += $row['tcnt'];
            $data_arr[] = $row;
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "weeks" => $weeks,
            "total_cnt" => $total_cnt,
            "data_arr" => $data_arr,
        ];

        return view('admin/_statistics/member_statistics4_week', $data);
    }

    public function member_statistics4_month()
    {
        $years = $this->request->getGet('years') ?? date('Y');
        $months = $this->request->getGet('months') ?? date('m');

        $s_date = date('Y-m-01', mktime(0, 0, 0, $months, 1, $years));
        $e_date = date('Y-m-d', mktime(0, 0, 0, $months, date('t', mktime(0, 0, 0, $months, 1, $years)) , $years));

        $builder = $this->connect->table('tbl_search_keyword');

        $builder->select('keyword, COUNT(*) as tcnt')
                ->where('keyword IS NOT NULL')
                ->where('keyword !=', '')
                ->where("DATE(regdate) >=", $s_date)
                ->where("DATE(regdate) <=", $e_date)
                ->groupBy('keyword')
                ->orderBy('tcnt', 'DESC');
    
        $query = $builder->get();
        $results = $query->getResultArray();
    
        $total_cnt = 0;
        $data_arr = [];
    
        foreach ($results as $row) {
            $total_cnt += $row['tcnt'];
            $data_arr[] = $row;
        }

        $data = [
            "years" => $years,
            "months" => $months,
            "total_cnt" => $total_cnt,
            "data_arr" => $data_arr,
        ];

        return view('admin/_statistics/member_statistics4_month', $data);
    }

    public function member_statistics4_year()
    {
        $years = $this->request->getGet('years') ?? date('Y');

        $s_date = date('Y-m-01', mktime(0, 0, 0, 1, 1, $years));
        $e_date = date('Y-m-d', mktime(0, 0, 0, 12, date('t', mktime(0, 0, 0, 12, 1, $years)) , $years));

        $builder = $this->connect->table('tbl_search_keyword');

        $builder->select('keyword, COUNT(*) as tcnt')
                ->where('keyword IS NOT NULL')
                ->where('keyword !=', '')
                ->where("DATE(regdate) >=", $s_date)
                ->where("DATE(regdate) <=", $e_date)
                ->groupBy('keyword')
                ->orderBy('tcnt', 'DESC');
    
        $query = $builder->get();
        $results = $query->getResultArray();
    
        $total_cnt = 0;
        $data_arr = [];
    
        foreach ($results as $row) {
            $total_cnt += $row['tcnt'];
            $data_arr[] = $row;
        }

        $data = [
            "years" => $years,
            "total_cnt" => $total_cnt,
            "data_arr" => $data_arr,
        ];

        return view('admin/_statistics/member_statistics4_year', $data);    
    }

    public function member_statistics5()
    {
        $builder    = $this->connect->table('tbl_visit_info');

        $limit      = $this->request->getGet('limit') ?? 10;
        $sort       = strtoupper($this->request->getGet('sort') ?? 'DESC');
        $keyword    = $this->request->getGet('keyword') ?? '';
        $s_date     = $this->request->getGet('s_date') ?? date('Y-m-d');
        $e_date     = $this->request->getGet('e_date') ?? date('Y-m-d');
        $pg         = (int) ($this->request->getGet('pg') ?? 1);

        $builder->where("DATE(regdate) >=", $s_date);
        $builder->where("DATE(regdate) <=", $e_date);

        if ($keyword !== '') {
            $builder->like('url', $keyword);
        }

        $total = $builder->countAllResults(false);

        $offset = ($pg - 1) * $limit;
		$num = $total - $offset;

        $builder->orderBy('regdate', $sort);
        $builder->limit($limit, $offset);
        $query = $builder->get();

        $data['visit_list']   = $query->getResultArray();
        $data['total_count']  = $total;
        $data['page_count']   = ceil($total / $limit);
        $data['current_pg']   = $pg;
        $data['limit']        = $limit;
        $data['num']          = $num;
        $data['keyword']      = $keyword;
        $data['s_date']       = $s_date;
        $data['e_date']       = $e_date;
        $data['sort']         = $sort;

        return view('admin/_statistics/member_statistics5', $data);
    }
}
