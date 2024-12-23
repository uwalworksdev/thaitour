<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminMileageController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function list()
    {
        $g_list_rows = 100;
        $strSql = '';
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? 1);

        if ($search_name) {
            if ($search_category == "user_name") {
                $sql_m = "select * from tbl_member where user_name like '%$search_name%' ";
                $result_m = $this->connect->query($sql_m);
                $cnt = $result_m->getNumRows();
                $result_m = $result_m->getResultArray();
                if ($cnt > 0) {
                    $_in = "";
                    $seq = 0;
                    foreach ($result_m as $row_m) {
                        $seq++;
                        if ($seq == 1) {
                            $_in .= "'" . $row_m['m_idx'] . "'";
                        } else {
                            $_in .= " ,'" . $row_m['m_idx'] . "'";
                        }
                    }
                    $strSql = $strSql . " AND tbl_order_mileage.m_idx IN(" . $_in . ")";
                } else {
                    $strSql = $strSql . " AND tbl_order_mileage.m_idx IN('')";
                }
            }

            if ($search_category == "user_id") {
                $sql_m = "select * from tbl_member where user_id = '$search_name' ";
                $result_m = $this->connect->query($sql_m);
                $cnt = $result_m->getNumRows();
                $result_m = $result_m->getResultArray();
                if ($cnt > 0) {
                    $_in = "";
                    $seq = 0;
                    foreach ($result_m as $row_m) {
                        $seq++;
                        if ($seq == 1) {
                            $_in .= "'" . $row_m['m_idx'] . "'";
                        } else {
                            $_in .= " ,'" . $row_m['m_idx'] . "'";
                        }
                    }
                    $strSql = $strSql . " AND tbl_order_mileage.m_idx IN(" . $_in . ")";
                } else {
                    $strSql = $strSql . " AND tbl_order_mileage.m_idx IN('')";
                }
            }
        }

        $total_sql = "	select *
							, (select order_no from tbl_order_mst where tbl_order_mst.order_idx=tbl_order_mileage.order_idx) as order_no
							, (select user_name from tbl_member where tbl_order_mileage.m_idx=tbl_member.m_idx) as user_name
							, (select product_code from tbl_product_mst where tbl_product_mst.product_idx=tbl_order_mileage.product_idx) as product_code
							from tbl_order_mileage where 1=1 $strSql ";
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by mi_idx desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();
        $num = $nTotalCount - $nFrom;

        $data = [
            'result' => $result,
            'num' => $num,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => $pg,
            'search_name' => $search_name,
            'search_category' => $search_category,
            'g_list_rows' => $g_list_rows,
        ];
        return view('admin/_mileage/list', $data);
    }

    public function write()
    {
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $mi_idx = updateSQ($_GET["mi_idx"] ?? '');
        $coupon_idx = updateSQ($_GET["coupon_idx"] ?? '');
        $user_id = updateSQ($_GET["user_id"] ?? '');

        if ($mi_idx) {
            $total_sql = " select * from bl_order_mileage where mi_idx='" . $mi_idx . "'";
            $result = $this->connect->query($total_sql);
            $row = $result->getRowArray();
        }
        $data = [
            'row' => $row ?? '',
            'search_category' => $search_category,
            'search_name' => $search_name,
            'pg' => $pg,
            'mi_idx' => $mi_idx,
            'coupon_idx' => $coupon_idx,
            'user_id' => $user_id,
        ];
        return view('admin/_mileage/write', $data);
    }

    public function write_ok()
    {
        $mi_title      = $_POST["mi_title"];
        $m_idx         = $_POST["m_idx"];
        $order_mileage = $_POST["order_mileage"];

	    $total_sql = "	select * from tbl_member where m_idx = '".$m_idx."'  ";
        $result    = $this->connect->query($total_sql);
        $row       = $result->getRowArray();

	    $remain_mileage = $row["mileage"] + $order_mileage; 
	    $user_name			= $row["user_name"];

		$fsql = "
			insert into tbl_order_mileage  SET 
										   mi_title 		 = '".$mi_title."'
										  ,order_mileage	 = '".$order_mileage."'
										  ,m_idx			 = '".$m_idx."'
										  ,order_gubun	     = 'admin'
										  ,mi_r_date		 = now()
										  ,remaining_mileage = '".$remain_mileage."'
		";
		write_log("마일리지 입력 : ".$fsql);
		$db3 = $this->connect->query($fsql);

		$fsql	= " select ifnull(sum(order_mileage),0) as sum_mileage from tbl_order_mileage where m_idx = '".$m_idx."' ";
		$result = $this->connect->query($total_sql);
		$frow   = $result->getRowArray();
		$sum_mileage = $frow["sum_mileage"];

		$fsql = "
			update tbl_member SET 
				mileage	 = '".$sum_mileage."'
			 where m_idx = '".$m_idx."' 
		";
		write_log("마일리지 합계수정 : ".$fsql);
		$db4 = $this->connect->query($fsql);

		echo "<script>alert('등록완료');location.href='/AdmMaster/_mileage/list';</script>";

    }

}
