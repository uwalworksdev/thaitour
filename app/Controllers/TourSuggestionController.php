<?php  

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourSuggestionController extends BaseController
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

    public function getCodeData($code_, $gubun){
        $code = $_GET['code'] ?? "";
        $parent_code = $_GET["parent_code"] ?? '';
        $parent_code_1 = $_GET["parent_code_1"] ?? '';

        if(empty($parent_code)){
            $sql_code_first    = "select  * from tbl_code where parent_code_no = '$code_' and status = 'Y' order by onum asc, code_idx asc ";
            $result_code_first = $this->connect->query($sql_code_first);
            $result_code_first = $result_code_first->getResultArray();
            $parent_code = $result_code_first[0]['code_no'];
        }

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

        $sql    = "  select  * from tbl_code where parent_code_no = '$code_' and status = 'Y' order by onum asc, code_idx asc ";
        $result = $this->connect->query($sql);
        $result = $result->getResultArray();

        $sql     = "select  * from tbl_code where parent_code_no = '$parent_code' and status = 'Y' order by onum asc, code_idx asc ";
        $result2 = $this->connect->query($sql);
        $result2 = $result2->getResultArray();

        if ($code != '' && isset($code)) {
            $replace_code = $code;
        } else if ($parent_code_1 != '' && isset($parent_code_1)) {
            $replace_code = $parent_code_1;
        } else if ($parent_code != '' && isset($parent_code)){
            $replace_code = $parent_code;
        }else {
            $replace_code = $result[0]['code_no'];
        }

        // $sql = "select  a.product_name, 
        //                 a.product_idx, 
        //                 a.product_code, 
        //                 a.is_view,
        //                 b.onum,
        //                 b.code_idx
        //                 from tbl_product_mst a, tbl_main_disp b
        //                 where a.product_idx    =  b.product_idx
        //                 and b.code_no    = '$replace_code' 
        //                 order by b.onum asc, b.code_idx desc";

        $sql     = "select  * from tbl_code where parent_code_no = '$parent_code_1' and status = 'Y' order by onum asc, code_idx asc ";
        $result3 = $this->connect->query($sql);
        $result3 = $result3->getResultArray();

        if($gubun == "hotel"){
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1303' and status='Y' order by onum asc, code_idx desc";
        }else if($gubun == "golf") {
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1302' and status='Y' order by onum asc, code_idx desc";
        }else if($gubun == "tour") {
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1301' and status='Y' order by onum asc, code_idx desc";
        }else if($gubun == "spa") {
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1325' and status='Y' order by onum asc, code_idx desc";
        }else if($gubun == "ticket") {
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1317' and status='Y' order by onum asc, code_idx desc";
        }else if($gubun == "restaurant") {
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1320' and status='Y' order by onum asc, code_idx desc";
        }else {
            $fsql    = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no not in ('1308','1309') and status='Y' order by onum asc, code_idx desc";
        }
        $fresult = $this->connect->query($fsql);
        $fresult = $fresult->getResultArray();

        $code_1 = isset($row) ? $row["product_code_1"] : '';
        $code_2 = isset($row) ? $row["product_code_2"] : '';

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $code_1 . "' and status='Y'  order by onum asc, code_idx desc";
        $fresult2 = $this->connect->query($fsql);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $code_2 . "' and status='Y'  order by onum asc, code_idx desc";
        $fresult3 = $this->connect->query($fsql);
        $fresult3 = $fresult3->getResultArray();

        $data = [
            'row1' => $row1 ?? [],
            'code' => $code,
            'parent_code' => $parent_code,
            'parent_code_1' => $parent_code_1,
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

        return $data;
    }

    public function list()
    {
        $data = $this->getCodeData('29', 'main');

        return view('admin/_tourSuggestionSub/list', $data);
    }

    public function list_hotel()
    {
        $data = $this->getCodeData('2335', 'hotel');

        return view('admin/_tourSuggestionSub/list_hotel', $data);
    }

    public function list_golf()
    {
        $data = $this->getCodeData('2337', 'golf');

        return view('admin/_tourSuggestionSub/list_golf', $data);
    }

    public function list_tour()
    {
        $data = $this->getCodeData('2333', 'tour');

        return view('admin/_tourSuggestionSub/list_tour', $data);
    }

    public function list_spa()
    {
        $data = $this->getCodeData('2336', 'spa');

        return view('admin/_tourSuggestionSub/list_spa', $data);
    }

    public function list_ticket()
    {
        $data = $this->getCodeData('2334', 'ticket');

        return view('admin/_tourSuggestionSub/list_ticket', $data);
    }

    public function list_restaurant()
    {
        $data = $this->getCodeData('2338', 'restaurant');

        return view('admin/_tourSuggestionSub/list_restaurant', $data);
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
                        a.product_code_1,
                        a.product_code_2, 
                        a.product_code_list,
                        a.is_view,
                        a.product_status,
                        a.special_price,
                        a.r_date,
                        a.ufile1,
                        a.rfile1,
                        b.onum,
                        b.code_idx
                        from tbl_product_mst a, tbl_main_disp b
                        where a.product_idx = b.product_idx
                        and product_status != 'D'
                        and b.code_no = '$replace_code' 
                        order by b.onum asc, b.code_idx desc";

        $result3 = $this->connect->query($sql);
        $result3 = $result3->getResultArray();

        foreach($result3 as $key => $value) {
            $sql_code_1 = "select code_name from tbl_code where code_no = '". $value['product_code_1'] ."'";
            $result_code_1 = $this->connect->query($sql_code_1)->getRowArray();
            $result3[$key]['product_code_name_1'] = $result_code_1['code_name'];

            $sql_code_2 = "select code_name from tbl_code where code_no = '". $value['product_code_2'] ."'";
            $result_code_2 = $this->connect->query($sql_code_2)->getRowArray();
            $result3[$key]['product_code_name_2'] = $result_code_2['code_name'];
        }
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
        // $code_no                = $this->request->getVar('code');
        $code_no                = (int) $this->request->getVar('code');
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
            $data = ['onum' => 'onum - 1.5'];
            $this->mainDispModel->update($id, $data);
            // write_log("UPDATE tbl_main_disp SET onum = onum - 1.5 WHERE code_idx = " . $id);
        } else if ($flag == "D") {
            $data = ['onum' => 'onum + 1.5'];
            $this->mainDispModel->update($id, $data);
            write_log("UPDATE tbl_main_disp SET onum = onum + 1.5 WHERE code_idx = " . $id);
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

    public function updateStatus()
    {
        $product_idx = $this->request->getPost('product_idx');
        $product_status = $this->request->getPost('product_status');

        if ($this->productModel->update($product_idx, ['product_status' => $product_status])) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }
}
