<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourSuggestionSubController extends BaseController
{
    private $tourRegistModel;
    private $Bbs;
    private $tours;
    private $db;
    private $mainDispModel;
    private $productModel;
    protected $connect;

    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        $this->tourRegistModel = model("ReviewModel");
        $this->Bbs = model("Bbs");
        $this->mainDispModel = model("MainDispModel");
        $this->productModel = model("ProductModel");
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function list()
    {
        $code = $_GET['code'] ?? "";
        $parent_code = $_GET["parent_code"] ?? '';

        $product_code_no = '';
        $product_code_name = '';
        if ($code != "") {
            $sql1 = "select t1.*, t2.code_no as product_code_no from tbl_code t1
                left join tbl_code t2 on t1.ref_product_code_idx = t2.code_no
                where t1.code_no = '$code' ";

            $result = $this->connect->query($sql1);

            $row1 = $result->getResultArray()[0];

            $product_code_no = $row1['product_code_no'];
            $product_code_name = $row1['code_name'];
        };

        $sql = "  select  * from tbl_code where code_gubun = 'suggestion' and depth = '2' and status = 'Y' order by onum desc ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();

        $sql = "select  * from tbl_code where parent_code_no = '$parent_code' and depth = '3' and status = 'Y' order by onum desc ";
        $result2 = $this->connect->query($sql);
        $result2 = $result2->getResultArray();

        if ($code != '' && isset($code)) {
            $replace_code = $code;
        } else {
            $replace_code = $parent_code;
        }

        $sql = "select  a.product_name, 
                        a.product_idx, 
                        a.product_code, 
                        a.is_view,
                        b.onum,
                        b.code_idx
                        from tbl_product_mst a, tbl_main_disp b
                        where a.product_idx    =  b.product_idx
                        and b.code_no    = '$replace_code' and a.product_status != 'stop'
                        order by b.onum desc, b.code_idx desc";

        $result3 = $this->connect->query($sql);
        $result3 = $result3->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no not in ('1308','1309')  and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $code_1 = isset($row) ? $row["product_code_1"] : '';
        $code_2 = isset($row) ? $row["product_code_2"] : '';

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $code_1 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $data = [
            'row1' => $row1 ?? [],
            'code' => $code,
            'parent_code' => $parent_code,
            'replace_code' => $replace_code,
            'result' => $result,
            'result2' => $result2,
            'result3' => $result3,
            'fresult' => $fresult,
            'fresult2' => $fresult2,
            'fresult3' => $fresult3,
            'product_code_1' => $code_1,
            'product_code_2' => $code_2,
            'product_code_no' => $product_code_no,
            'product_code_name' => $product_code_name
        ];

        return view('admin/_tourSuggestionSub/list', $data);
    }

    public function create()
    {
        $data = [];

        return view('admin/_tourSuggestionSub/write', $data);
    }

    public function prd_list() {
        $code = $this->request->getVar('code');
        $parent_code = $this->request->getVar('parent_code');
        if ($code != '0' && isset($code)) {
            $replace_code = $code;
        } else {
            $replace_code = $parent_code;
        }
        $sql = "select  a.product_name, 
                        a.product_idx, 
                        a.product_code, 
                        a.is_view,
                        b.onum,
                        b.code_idx
                        from tbl_product_mst a, tbl_main_disp b
                        where a.product_idx    =  b.product_idx
                        and b.code_no    = '$replace_code' and a.product_status != 'stop'
                        order by b.onum desc, b.code_idx desc";

        $result3 = $this->connect->query($sql);
        $result3 = $result3->getResultArray();
        return view('admin/_tourSuggestionSub/prd_list', ['result3' => $result3, 'replace_code' => $replace_code]);
    }

    public function goods_find() {
        $code_no = $_GET['code_no'];
        $inq_sw = $_GET['inq_sw'];
        if($inq_sw != "fst") {
            $list = $this->mainDispModel->goods_find($code_no)['items'];
        } else {
            $list = [];
        }
        return view('admin/_tourSuggestionSub/goods_find', ['list' => $list]);
    }

    public function item_allfind() {
        $code_no                = $this->request->getVar('code');
        $whereArr               = $this->request->getVar();
        // $whereArr['is_view']    = "Y";

        $list = $this->productModel->findProductPaging($whereArr)['items'];

        foreach ($list as $key => $value) {
            $list[$key]['cnt'] = $this->mainDispModel->itemCntByProductAndCode($value['product_idx'], $code_no);
        }

        return view('admin/_tourSuggestionSub/item_allfind', ['list' => $list]);
    }
    public function main_update() {
        $idx = $this->request->getVar('idx');
        $isrt_code = $this->request->getVar('isrt_code');

        foreach ($idx as $value) {
            $this->mainDispModel->insert(['product_idx' => $value, 'code_no' => $isrt_code, 'status' => 'Y']);
        }

        return $this->response->setJSON(['result' => 'OK', 'message' => '등록완료.']);
    }
    public function goods_alldel() {
        $idx_val = $this->request->getVar('idx_val');
        $idx_val = explode(',', $idx_val);
        $this->mainDispModel->whereIn('code_idx', $idx_val)->delete();
        return $this->response->setJSON(['result' => 'OK', 'message' => '정상적으로 제외되었습니다.']);
    }
    public function seq_upd1() {
        $code      = $_POST['code'];
        $id        = $_POST['id'];
        $flag      = $_POST['flag'];

        if ($flag == "U") {
            $data = ['onum' => 'onum + 1.5'];
            $this->mainDispModel->update($id, $data);
            // write_log("UPDATE tbl_main_disp SET onum = onum + 1.5 WHERE code_idx = " . $id);
        } else if ($flag == "D") {
            $data = ['onum' => 'onum - 1.5'];
            $this->mainDispModel->update($id, $data);
            // write_log("UPDATE tbl_main_disp SET onum = onum - 1.5 WHERE code_idx = " . $id);
        }

        $mainDispList = $this->mainDispModel->where('code_no', $code)->orderBy('onum', 'ASC')->findAll();

        $num = 0;
        foreach ($mainDispList as $item) {
            $num++;
            $dataUpdate = ['onum' => $num];
            $this->mainDispModel->update($item['code_idx'], $dataUpdate);
            // write_log("UPDATE tbl_main_disp SET onum = '" . $num . "' WHERE code_no = '$code' and code_idx = '" . $item['code_idx'] . "'");
        }
        return $this->response->setJSON(['result' => 'OK', 'message' => 'OK']);
    }
}
