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
        $types = updateSQ($_POST["types"]);
        $coupon_type = updateSQ($_POST["coupon_type"]);
        $coupon_cnt = updateSQ($_POST["coupon_cnt"]);

        echo $coupon_type . " / " . $coupon_cnt;


        $ok_cnt = 0;
        $er_cnt = 0;

        for ($i = 1; $i <= $coupon_cnt; $i++) {

            $new_coupon = createCoupon($coupon_type);

            if ($new_coupon == "Error") {
                $er_cnt++;
            } else {
                $ok_cnt++;
            }


        }
    }
}
