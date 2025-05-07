<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminStatisticsController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function statistics01_01()
    {
        $gubun = updateSQ($_GET['gubun'] ?? "");
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
        return view('admin/_statistics/statistics_sale_yoil');
    }

    public function statistics_sale_day()
    {
        return view('admin/_statistics/statistics_sale_day');
    }

    public function statistics_sale_month()
    {
        return view('admin/_statistics/statistics_sale_month');
    }

    public function statistics_sale_year()
    {
        return view('admin/_statistics/statistics_sale_year');
    }

    public function statistics_sale_sales()
    {
        return view('admin/_statistics/statistics_sale_sales');
    }

    public function statistics_sale_type()
    {
        return view('admin/_statistics/statistics_sale_type');
    }


    public function statistics_sale_type_day()
    {
        return view('admin/_statistics/statistics_sale_type_day');
    }

    public function statistics_sale_type_week()
    {
        return view('admin/_statistics/statistics_sale_type_week');
    }

    public function statistics_sale_type_month()
    {
        return view('admin/_statistics/statistics_sale_type_month');
    }

    public function statistics_sale_type_year()
    {
        return view('admin/_statistics/statistics_sale_type_year');
    }

    public function statistics_sale_type2()
    {
        return view('admin/_statistics/statistics_sale_type2');
    }

    public function statistics_sale_type3()
    {
        return view('admin/_statistics/statistics_sale_type3');
    }

    public function statistics_sale_type3_day()
    {
        return view('admin/_statistics/statistics_sale_type3_day');
    }

    public function statistics_sale_type3_week()
    {
        return view('admin/_statistics/statistics_sale_type3_week');
    }

    public function statistics_sale_type3_month()
    {
        return view('admin/_statistics/statistics_sale_type3_month');
    }

    public function statistics_sale_type3_year()
    {
        return view('admin/_statistics/statistics_sale_type3_year');
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
        return view('admin/_statistics/member_statistics4');
    }

    public function member_statistics4_day()
    {
        return view('admin/_statistics/member_statistics4_day');
    }

    public function member_statistics4_week()
    {
        return view('admin/_statistics/member_statistics4_week');
    }

    public function member_statistics4_month()
    {
        return view('admin/_statistics/member_statistics4_month');
    }

    public function member_statistics4_year()
    {
        return view('admin/_statistics/member_statistics4_year');
    }

    public function member_statistics5()
    {
        return view('admin/_statistics/member_statistics5');
    }
}
