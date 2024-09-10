<?php

namespace App\Controllers;

use App\Models\Banner_model;
use App\Models\Product_model;
use CodeIgniter\Controller;
use App\Config\CustomConstants;
use Config\CustomConstants as ConfigCustomConstants;
use Exception;

class Orders extends BaseController
{
    private $OrdersModel;
    private $OrdersSub;
    private $comment;
    public function __construct()
    {
        $this->db = db_connect();
        $this->OrdersModel = model("OrdersModel");
        $this->OrdersSub = model("OrderSubModel");
        $this->comment = model("CommentModel");
        helper('my_helper');
        $constants = new ConfigCustomConstants();
    }
    public function list_invoice()
    {
        $private_key = private_key();
        $deviceType = get_device();
        $pg = $this->request->getVar('pg');
        $s_txt = $this->request->getVar('s_txt');
        $search_category = $this->request->getVar('search_category');
        $currentUri = $this->request->getUri()->getPath();
        $sql = "select * from tbl_bbs_list where code = 'banner' and category = '110' ";
        $visual = $this->db->query($sql)->getRowArray();

        $ordersObj = $this->OrdersModel->getOrders($s_txt, $search_category, $pg, 10);

        $order_list = $ordersObj['order_list'];
        $nTotalCount = $ordersObj['nTotalCount'];
        $nPage = $ordersObj['nPage'];
        $num = $ordersObj['num'];
        $pg = $ordersObj['pg'];

        foreach ($order_list as $key => $row) {
            $sql_d = "SELECT   AES_DECRYPT(UNHEX('{$row['order_user_name']}'),   '$private_key') order_user_name";
            $row_d = $this->db->query($sql_d)->getRowArray();
            $row['order_user_name'] = $row_d['order_user_name'];
            $row['cmt_cnt'] = count($this->comment->getComments('order', $row['order_idx'], $private_key));
            $row['cnt'] = count($this->OrdersSub->getOrderSub($row['order_idx']));
            $order_list[$key] = $row;
        }

        return view("invoice/invoice_list", [
            "order_list" => $order_list,
            "num" => $num,
            "nTotalCount" => $nTotalCount,
            "nPage" => $nPage,
            "pg" => $pg,
            "s_txt" => $s_txt,
            "search_category" => $search_category,
            "visual" => $visual,
            "deviceType" => $deviceType,
            "currentUri" => $currentUri
        ]);
    }
    public function invoice_view_paid()
    {
        $private_key = private_key();
        $order_idx = updateSQ($_GET["order_idx"]);

        $sql = " select s1.*, s2.product_code, s2.product_code_1, s2.product_code_2, s2.product_code_3, s2.product_info, s2.ufile1, s2.tour_period,
                            s3.code_name as code_name_1, s4.code_name as code_name_2, s5.code_name as code_name_3,
                            s6.tour_price, s6.tour_price_kids, s6.tour_price_baby,
                            s8.code_name as air_code_name, s7.air_name_1 as air_name_1, s8.ufile1 as air_image, s7.s_air_time_1, s7.e_air_time_1,
                            s7.air_no_1, s7.air_no_2, s7.s_air_time_2, s7.e_air_time_2,
                            s9.addr1, s9.addr2
                            from tbl_order_mst s1
                            left join tbl_product_mst s2 on s1.product_idx = s2.product_idx
                            left join tbl_product_air s7 on s1.product_idx = s7.product_idx
                            left join tbl_code s8 on s7.air_code_1 = s8.code_no
                            left join tbl_code s3 on s3.code_no = s2.product_code_1
                            left join tbl_code s4 on s4.code_no = s2.product_code_2
                            left join tbl_code s5 on s5.code_no = s2.product_code_3
                            left join tbl_product_tours s6 on s1.product_idx = s6.product_idx
                            left join tbl_member s9 on s1.m_idx = s9.m_idx
                            where order_idx='" . $order_idx . "' group by s1.order_idx, s3.code_idx, s4.code_idx, s5.code_idx, s6.tours_idx, s7.air_idx, s8.code_idx";
        $order_detail = $this->db->query($sql)->getRowArray();

        $sql_d = "SELECT   AES_DECRYPT(UNHEX('{$order_detail['order_user_name']}'),   '$private_key') order_user_name
        , AES_DECRYPT(UNHEX('{$order_detail['addr1']}'), '$private_key') addr1
        , AES_DECRYPT(UNHEX('{$order_detail['addr2']}'), '$private_key') addr2
        , AES_DECRYPT(UNHEX('{$order_detail['order_user_mobile']}'), '$private_key') order_user_mobile
        , AES_DECRYPT(UNHEX('{$order_detail['order_user_phone']}'),  '$private_key') order_user_phone
        , AES_DECRYPT(UNHEX('{$order_detail['order_user_email']}'),  '$private_key') order_user_email
        , AES_DECRYPT(UNHEX('{$order_detail['manager_name']}'),      '$private_key') manager_name
        , AES_DECRYPT(UNHEX('{$order_detail['manager_phone']}'),     '$private_key') manager_phone
        , AES_DECRYPT(UNHEX('{$order_detail['manager_email']}'),     '$private_key') manager_email
        , AES_DECRYPT(UNHEX('{$order_detail['local_phone']}'),       '$private_key') local_phone ";

        $row_d = $this->db->query($sql_d)->getRowArray();

        $order_detail['addr1'] = $row_d['addr1'];
        $order_detail['addr2'] = $row_d['addr2'];
        $order_detail['order_user_name'] = $row_d['order_user_name'];
        $order_detail['order_user_mobile'] = $row_d['order_user_mobile'];
        $order_detail['order_user_phone'] = $row_d['order_user_phone'];
        $order_detail['order_user_email'] = $row_d['order_user_email'];
        $order_detail['manager_name'] = $row_d['manager_name'];
        $order_detail['manager_phone'] = $row_d['manager_phone'];
        $order_detail['manager_email'] = $row_d['manager_email'];
        $order_detail['local_phone'] = $row_d['local_phone'];

        $m_idx = $order_detail["m_idx"];

        if (session('member.id') != 'admin' && session('member.level') > 2) {
            if ($m_idx !== session('member.idx')) {
                return "<script>
            alert('비밀글입니다!');
            location.href= '/invoice/invoice_list.php';
            </script>";
            }
        }
        $sql2 = "SELECT *, AES_DECRYPT(UNHEX(order_first_name), '$private_key') order_first_name
        , AES_DECRYPT(UNHEX(order_name_kor),   '$private_key') order_name_kor
        , AES_DECRYPT(UNHEX(order_last_name),  '$private_key') order_last_name
        , AES_DECRYPT(UNHEX(passport_num),  '$private_key') passport_num
        , AES_DECRYPT(UNHEX(order_mobile),      '$private_key') order_mobile
        , AES_DECRYPT(UNHEX(order_email),     '$private_key') order_email
        FROM tbl_order_list where order_idx = $order_idx";
        $order_detail_extra = $this->db->query($sql2)->getResultArray();
        return view("invoice/invoice_view_paid", ["order_idx" => $order_idx, "order_detail" => $order_detail, "order_detail_extra" => $order_detail_extra]);
    }
}