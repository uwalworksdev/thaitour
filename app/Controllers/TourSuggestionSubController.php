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

    protected $connect;

    public function __construct()
    {
        $this->db = db_connect();
        $this->connect = Config::connect();
        $this->tourRegistModel = model("ReviewModel");
        $this->Bbs = model("Bbs");
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function list()
    {
        $code = $_POST['code'] ?? "";
        $parent_code = $_POST["parent_code"] ?? '';

        $product_code_no = '';
        $product_code_name = '';
        if ($code == "") {
            $code = "0";
        } else {
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
                        and b.code_no    = '$replace_code' 
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
}
