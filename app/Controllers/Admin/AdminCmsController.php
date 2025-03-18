<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\App;
use JkCms;

class AdminCmsController extends BaseController
{
    protected $connect;
    protected $db;
    protected $policyModel;
    protected $policyCancel;
    protected $cmsModel;
    protected $cmsConfModel;
    protected $status_arr = ['Y' => '사용', 'N' => '중지', 'D' => '삭제'];

    protected $close_arr = array(
        "today" => "오늘 그만보기",
        "never" => "더이상 보이지 않기"
    );

    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        $this->policyModel = model("PolicyModel");
        $this->cmsModel = model("CmsModel");
        $this->cmsConfModel = model("CmsConfModel");
        $this->policyCancel = model("PolicyCancel");
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

    public function policy_cancel_list() {
        $search_txt      = updateSQ($_GET["search_txt"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $product_code_1  = updateSQ($_GET["product_code_1"] ?? '');
        $product_code_2  = updateSQ($_GET["product_code_2"] ?? '');
        $product_code_3  = updateSQ($_GET["product_code_3"] ?? '');
    
        $where = [];
    
        if (!empty($search_txt)) {
            $where['tbl_product_mst.product_name LIKE'] = "%$search_txt%";
        }
        if (!empty($product_code_1)) {
            $where['tbl_policy_cancel.product_code'] = $product_code_1;
        }
        if (!empty($product_code_2)) {
            $where['tbl_policy_cancel.product_code_2'] = $product_code_2;
        }
        if (!empty($product_code_3)) {
            $where['tbl_policy_cancel.product_code_3'] = $product_code_3;
        }
    
        $g_list_rows = 10;
        $pg = isset($_GET["pg"]) && is_numeric($_GET["pg"]) ? (int)$_GET["pg"] : 1;
        if ($pg < 1) $pg = 1;
        $nPage = ($pg - 1) * $g_list_rows;
    
        $builder = $this->policyCancel
        ->select('
                tbl_policy_cancel.*, 
                t2.code_no as product_code, 
                t3.code_no as product_code_2, 
                t4.code_no as product_code_3,
                t2.code_name as product_code_name, 
                t3.code_name as product_code_name_2, 
                t4.code_name as product_code_name_3, 
                t5.product_name
            ')
            ->join('tbl_code t2', 'tbl_policy_cancel.product_code = t2.code_no', 'left')
            ->join('tbl_code t3', 'tbl_policy_cancel.product_code_2 = t3.code_no', 'left')
            ->join('tbl_code t4', 'tbl_policy_cancel.product_code_3 = t4.code_no', 'left')
            ->join('tbl_product_mst t5', 'tbl_policy_cancel.product_idx = t5.product_idx', 'left');
    
        if (!empty($where)) {
            $builder->where($where);
        }
    
        $nTotalCount = $builder->countAllResults(false); 
        $result = $builder->orderBy('tbl_policy_cancel.r_date', 'DESC')->findAll($g_list_rows, $nPage);
    
        $num = $nTotalCount - $nPage;
        $nTotalPages = ceil($nTotalCount / $g_list_rows);

        $fsql     = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no in (1303, 1301, 1302, 1325, 1317, 1324, 1320)  and status='Y' order by onum asc, code_idx desc";
        $fresult  = $this->connect->query($fsql);
        $fresult  = $fresult->getResultArray();

        $fsql     = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by onum asc, code_idx desc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql     = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum asc, code_idx desc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();
    
        $data = [
            "result" => $result,
            "nTotalCount" => $nTotalCount,
            "pg" => $pg,
            "nPage" => $nPage,
            "num" => $num,
            "nTotalPages" => $nTotalPages,
            "g_list_rows" => $g_list_rows,
            'search_txt'      => $search_txt,
            'search_category' => $search_category,
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,
            'fresult'         => $fresult,
            'fresult2'        => $fresult2,
            'fresult3'        => $fresult3,
        ];
    
        return view('admin/_cms/policy_cancel_list', $data);
    }
    

    public function policy_cancel_write() {
        $sql0 = "SELECT * FROM tbl_code WHERE parent_code_no=13 AND depth = '2' ORDER BY onum ";
        $list_code = $this->db->query($sql0)->getResultArray();
        $p_idx = updateSQ($_GET["p_idx"]);
        $product_idx = updateSQ($_GET["product_idx"] ?? 0);
        if ($p_idx) {
            $sql_info = "select t1.*, t2.code_no as product_code, t3.code_no as product_code_2, t4.code_no as product_code_3,
                t2.code_name as product_code_name, t3.code_name as product_code_name_2, t4.code_name as product_code_name_3, t5.product_name
                from tbl_policy_cancel t1
                left join tbl_code t2 on t1.product_code = t2.code_no
                left join tbl_code t3 on t1.product_code_2 = t3.code_no
                left join tbl_code t4 on t1.product_code_3 = t4.code_no
                left join tbl_product_mst t5 on t1.product_idx = t5.product_idx
                where t1.p_idx = '$p_idx'
                ";

            $info = $this->db->query($sql_info)->getRowArray();
            $product_code = $info["product_code"];
            $product_code_2 = $info['product_code_2'];
            $product_code_3 = $info['product_code_3'];
            $product_idx = $info['product_idx'];
            $product_code_name = $info['product_code_name'];
            $product_code_name_2 = $info['product_code_name_2'];
            $product_code_name_3 = $info['product_code_name_3'];
            $product_name = $info['product_name'];
            $policy_contents = $info['policy_contents'];
        } else if ($product_idx) {
            $sql_r = "select a.product_idx,a.product_name, b.code_no as product_code, c.code_no as product_code_2, d.code_no as product_code_3, 
            b.code_name as product_code_name, c.code_name as product_code_name_2, d.code_name as product_code_name_3 
            from tbl_product_mst a
            left join tbl_code b on a.product_code_1 = b.code_no
            left join tbl_code c on a.product_code_2 = c.code_no
            left join tbl_code d on a.product_code_3 = d.code_no
            where b.code_gubun = 'tour' and a.product_idx = '{$product_idx}' ";
            $row_r = $this->db->query($sql_r)->getRowArray();
            $product_code = $row_r["product_code"];
            $product_code_2 = $row_r["product_code_2"];
            $product_code_3 = $row_r["product_code_3"];
            $product_code_name = $row_r['product_code_name'];
            $product_code_name_2 = $row_r['product_code_name_2'];
            $product_code_name_3 = $row_r['product_code_name_3'];
            $product_name = $row_r['product_name'];
        }

        $data = [
            "p_idx" => $p_idx,
            "product_idx" => $product_idx,
            "product_code" => $product_code,
            "product_code_2" => $product_code_2,
            "product_code_3" => $product_code_3,
            "product_code_name" => $product_code_name,
            "product_code_name_2" => $product_code_name_2,
            "product_code_name_3" => $product_code_name_3,
            "product_name" => $product_name,
            "list_code" => $list_code,
            "policy_contents" => $policy_contents,
        ]; 
        return view('admin/_cms/policy_cancel_write', $data);
    }

    public function policy_cancel_ok() {
        $data = $this->request->getPost();

        $p_idx = updateSQText($data['p_idx'] ?? '');
        $product_code_2 = updateSQText($data['product_code_2'] ?? '');
        $product_code_3 = updateSQText($data['product_code_3'] ?? '');
        $product_code = updateSQText($data['product_code'] ?? '');
        $policy_contents = updateSQText($data['policy_contents'] ?? '');
        $product_idx = updateSQText($data['product_idx'] ?? 0);


        if ($p_idx) {
            $dataToUpdate = [
                'policy_contents' => $policy_contents
            ];


            $this->policyCancel->update($p_idx, $dataToUpdate);

            return alert_msg("정상적으로 수정되었습니다.", "/AdmMaster/_cms/policy_cancel_list");
        }

        $dataToInsert = [
            'product_idx' => $product_idx ?? 0,
            'product_code' => $product_code,
            'product_code_2' => $product_code_2 ?? 0,
            'product_code_3' => $product_code_3 ?? 0,
            'policy_contents' => $policy_contents,
            'policy_type' => '취소 규정',
            'r_date' => $r_date ?? date("Y-m-d H:i:s"),
        ];

        $this->policyCancel->insert($dataToInsert);
        return alert_msg("정상적으로 등록되었습니다.", "/AdmMaster/_cms/policy_cancel_list");
    }

    public function check_product_exists()
    {
        $product_idx = $this->request->getPost("product_idx");

        $query = "SELECT COUNT(*) as count FROM tbl_policy_cancel WHERE product_idx = ?";
        $result = $this->db->query($query, [$product_idx])->getRowArray();

        return $this->response->setJSON(["exists" => $result["count"] > 0]);
    }

    public function del()
    {
        $p_idx = $this->request->getPost('p_idx');
        
        if (isset($p_idx) && is_array($p_idx)) {
            foreach ($p_idx as $id) {
                $this->policyCancel->delete($id);
            }
            return $this->response->setJSON(['status' => 'OK']);
        } else {
            return $this->response->setJSON(['status' => 'Invalid input']);
        }
    }


}
