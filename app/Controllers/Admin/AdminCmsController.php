<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\App;
use JkCms;

class AdminCmsController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        helper('JkCms_helper');
    }

    public function index()
    {
        $r_code = $_GET['r_code'] ?? '';
        if ($r_code == "") $r_code = "banner";

// 클래스
        $Cms = new JkCms($r_code);

        $code_info = $Cms->get_code_info();
        $type_arr = $Cms->type_arr;

        $scale = 25; // 목록에 표시되는 정보의 수
        $page_cnt = 10; // 페이지 목록에 표시되는 페이지의 수

        $total_cnt = $Cms->get_total_cnt();
        $total_page = ceil($total_cnt / $scale);

        $page = $_GET['page'] ?? 1;
        if ($page > $total_page) $page = $total_page;
        if ($page < 1) $page = 1;

        $start = ($page - 1) * $scale;
        $Cms->input['start'] = $start;
        $Cms->input['scale'] = $scale;

        $list_arr = $Cms->get_list();
        $list_cnt = count($list_arr);

        $data = [
            'code_info' => $code_info,
            'type_arr' => $type_arr,
            'list_arr' => $list_arr,
            'list_cnt' => $list_cnt,
            'page' => $page,
            'total_page' => $total_page,
            'total_cnt' => $total_cnt,
            'page_cnt' => $page_cnt,
            'r_code' => $r_code,
            'Cms' => $Cms,
            'scale' => $scale,
            'start' => $start,
            'sch_status' => $sch_status ?? '',
            'sch_item' => $sch_item ?? '',
            'sch_value' => $sch_value ?? '',
        ];
        return view('admin/_cms/index', $data);
    }

    public function write()
    {
        // 공용 클래스 (+관리자 인증)

        // 메뉴 구분
//        $r_code = $_GET['r_code'] ?? '';
//
//        // 클래스
//        $Cms = new JkCms($r_code);
//
//        $code_info = $Cms->get_code_info($r_code);
//        $type_arr = $Cms->type_arr;
//        $template_arr = $Cms->template_arr;
//
//        $r_idx = $_GET['r_idx'];
//        if ($r_idx != "") {
//            $form_data = $Cms->get_form_data($r_idx);
//            $file_arr = json_decode($form_data['r_file_list'], true);
//            $file_cnt = count($file_arr);
//        } else {
//            $form_data = array();
//            foreach ($Cms->new_default_arr as $key => $val)
//                $form_data[$key] = $val;
//        }
//
//        $product_arr = $Cms->get_product_arr();
//
//        // 헤더 (관리자 기본 설정 및 인증)
//
//        $data = [
//            'code_info' => $code_info,
//            'type_arr' => $type_arr,
//            'template_arr' => $template_arr,
//            'form_data' => $form_data,
//            'product_arr' => $product_arr,
//            'Cms' => $Cms,
//            'r_idx' => $r_idx,
//            'file_cnt' => $file_cnt ?? '',
//            'file_arr' => $file_arr ?? '',
//            'scale' => $scale ?? '',
//            'start' => $start ?? '',
//            'sch_status' => $sch_status ?? '',
//            'sch_item' => $sch_item ?? '',
//            'sch_value' => $sch_value ?? '',
//        ];
        return view('admin/_cms/write');
    }
}
