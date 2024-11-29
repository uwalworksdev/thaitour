<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\App;
use JkCms;

class AdminCmsController extends BaseController
{
    protected $connect;
    protected $policyModel;
    protected $cmsModel;
    protected $cmsConfModel;
    protected $status_arr = ['Y' => '사용', 'N' => '중지', 'D' => '삭제'];

    protected $close_arr = array(
        "today" => "오늘 그만보기",
        "never" => "더이상 보이지 않기"
    );

    public function __construct()
    {
        $this->connect = Config::connect();
        $this->policyModel = model("PolicyModel");
        $this->cmsModel = model("CmsModel");
        $this->cmsConfModel = model("CmsConfModel");
        helper('my_helper');
        helper('alert_helper');
        helper('JkCms_helper');
    }

    public function index()
    {
        $r_code = $this->request->getVar('r_code') ?: 'popup';

        $sch_status = $this->request->getVar('sch_status') ?? '';
        $sch_item = $this->request->getVar('sch_item') ?? '';
        $sch_value = $this->request->getVar('sch_value') ?? '';
        $scale = $this->request->getVar('scale') ?? 25;

        $page = $this->request->getVar('page') ?? 1;

        $result = $this->cmsModel->getPaging([
            'r_code' => $r_code,
            'sch_status' => $sch_status,
            'sch_item' => $sch_item,
            'sch_value' => $sch_value
        ], $scale, $page);

        $data = [
            'code_info' => $this->cmsConfModel->find($r_code),
            'list_arr' => $result['items'],
            'page' => $page,
            'nPage' => $result['nPage'],
            'r_code' => $r_code,
            'scale' => $scale,
            'num' => $result['num'],
            'sch_status' => $sch_status,
            'sch_item' => $sch_item,
            'sch_value' => $sch_value,
        ];
        return view('admin/_cms/index', $data);
    }

    public function write()
    {
        $r_code = $_GET['r_code'] ?? '';
        $r_idx = $this->request->getVar('r_idx') ?? '';

        $data = [
            'code_info' => $this->cmsConfModel->find($r_code),
            'r_idx' => $r_idx,
            'r_code' => $r_code,
            'form_data' => $this->cmsModel->find($r_idx),
            'status_arr' => $this->status_arr,
            'close_arr' => $this->close_arr,
        ];
        return view('admin/_cms/write', $data);
    }

    public function write_ok($r_idx = null)
    {

        $data = $this->request->getPost();

        $data['r_s_date'] = $data['r_s_date_d'] . ' ' . $data['r_s_date_h'] . ':' . $data['r_s_date_m'] . ':' . $data['r_s_date_s'];
        $data['r_e_date'] = $data['r_e_date_d'] . ' ' . $data['r_e_date_h'] . ':' . $data['r_e_date_m'] . ':' . $data['r_e_date_s'];

        if($r_idx) {
            $this->cmsModel->update($r_idx, $data);
            return $this->response->setJSON(['result' => 'success', 'msg' => '수정 완료']);
        } else {
            $this->cmsModel->insert($data);
            return $this->response->setJSON(['result' => 'success', 'msg' => '등록 완료']);
        }

    }

    public function del_ok() {
        $r_idx = $this->request->getRawInput()['r_idx'];
        $this->cmsModel->where('r_idx', $r_idx)->set(['r_status' => 'D'])->update();
        return $this->response->setJSON(['result' => 'success', 'msg' => '삭제 완료']);
    }

    public function policy_list()
    {
        $sql = " select * from tbl_policy_info order by p_idx asc ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();

        $data = [
            'page' => $_GET['page'] ?? 1,
            'result' => $result,
            'num' => $num ?? 0,
            'pg' => $pg ?? 0,
            'nTotalCount' => $nTotalCount ?? 0,
            'nPage' => $nPage ?? 0,
            's_parent_code_no' => $s_parent_code_no ?? '',
            'g_list_rows' => $g_list_rows ?? 10,
            'ca_idx' => $ca_idx ?? '',
            'search_category' => $search_category ?? '',
            'search_name' => $search_name ?? '',
        ];
        return view('admin/_cms/policy_list', $data);
    }

    public function policy_write()
    {
        $p_idx = $_GET['p_idx'] ?? '';
        $total_sql = " select * from tbl_policy_info where p_idx = '$p_idx' ";
        $result = $this->connect->query($total_sql);
        $row = $result->getRowArray();

        $data = [
            'p_idx' => $p_idx,
            'row' => $row
        ];
        return view('admin/_cms/policy_write', $data);
    }

    public function policy_ok()
    {
        $p_idx		      = updateSQ($_POST["p_idx"]);
        $policy_type      = updateSQ($_POST["policy_type"]);
        $policy_contents  = updateSQ($_POST["policy_contents"]);

        if($p_idx) {
            $this->policyModel->update($p_idx, ['policy_type' => $policy_type, 'policy_contents' => $policy_contents]);
            return redirect()->to("/AdmMaster/_cms/policy_write?p_idx=$p_idx");
        } else {
            $this->policyModel->insert(['policy_type' => $policy_type, 'policy_contents' => $policy_contents]);
            return redirect()->to("/AdmMaster/_cms/policy_list");
        }
    }
}
