<?php

use CodeIgniter\Model;
class CouponMst extends Model
{
    protected $table = 'tbl_coupon_mst';
    protected $primaryKey = 'idx';
    protected $allowedFields = [
        "coupon_name", "publish_type", "dc_type", "coupon_pe", "coupon_price", "max_coupon_price", "minimum_coupon_price"
        , "exp_start_day", "exp_end_day", "etc_memo", "state", "type_select", "coupon_apply", "member_grade", "coupon_contents", "regdate"
        , "ufile1", "rfile1", "ufile2", "rfile2", "ufile3", "rfile3", "ufile4", "rfile4", "ufile5", "rfile5", "ufile6", "rfile6", "ufile7", "rfile7"
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getCouponList($s_txt = null, $search_category = null, $pg = 1, $g_list_rows = 10, $is_date = false, $is_use = false)
    {

        $builder = $this;
        if($is_use) {
            $builder->where('state !=', 'N');
        }
        
        $builder->where('state !=', 'C');
        
        if ($s_txt && $search_category) {
            $builder->like($search_category, $s_txt);
        }

        if($is_date) {
            $builder->where('STR_TO_DATE(exp_start_day, "%Y-%m-%d") <=', date("Y-m-d"));
            $builder->where('STR_TO_DATE(exp_end_day, "%Y-%m-%d") >=', date("Y-m-d"));
        }

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $coupon_list = $builder->get()->getResultArray();

        foreach($coupon_list as $key => $value) {
            $coupon_list[$key]["member_grade_name"] = $this->db->table("tbl_member_grade")
                                                                ->where("g_idx", $value["member_grade"])
                                                                ->get()->getRowArray()["grade_name"];
        }

        $num = $nTotalCount - $nFrom;

        return [
            'coupon_list' => $coupon_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows,
            'num' => $num,
        ];
    }

	public function get_effected_product($product_code_1, $product_code_2, $product_idx) {
		if ($product_code_1 == 'all') {
			return '전체';
		} else {
			$effected_product = model("Code")->getCodeName($product_code_1);
		}
		if ($product_code_2 == 'all') {
			return "$effected_product <i>></i> 전체";
		} elseif ($product_code_name_2 = model("Code")->getCodeName($product_code_2)) {
			$effected_product .= ' <i>></i> ' . $product_code_name_2;
		}
		if ($product_idx == 'all') {
			return "$effected_product <i>></i> 전체";
		} elseif ($product_name = model("ProductModel")->getById($product_idx)["product_name"]) {
			$effected_product .= ' <i>></i> ' . $product_name;
		}

		return $effected_product;
	}

    public function getCouponListAjax($code = null, $child_code = null, $pg = 1, $g_list_rows = 10)
    {
        $code_model = model('App\Models\Code');
        $builder = $this->db->table('tbl_coupon_mst c1');
        $builder->select('c1.*, c2.product_code_1, c2.product_code_2, c2.product_idx');
        $builder->join('tbl_coupon_product c2', 'c1.idx = c2.coupon_idx', 'left');
        
        $builder->where('state !=', 'C');
        $builder->where('state !=', 'N');
        if(!empty($code)){
            $builder->where('c2.product_code_1 =', $code);
        }

        if(!empty($child_code)){
            $builder->where('c2.product_code_2 =', $child_code);
        }

        $builder->groupStart();
        $builder->where('exp_start_day <= NOW()');
        $builder->where('exp_end_day >= NOW()');
        $builder->groupEnd();

        $builder->orGroupStart();
        $builder->where('state !=', 'C');
        $builder->like("type_select", 'A');
        $builder->where('exp_start_day <= NOW()');
        $builder->where('exp_end_day >= NOW()');
        $builder->groupEnd();


        $builder->groupBy("c1.idx");
        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") {
            $pg = 1;
        }
        $nFrom = ($pg - 1) * $g_list_rows;

        $builder->orderBy('idx', 'desc')
            ->limit($g_list_rows, $nFrom);

        $coupon_list = $builder->get()->getResultArray();

        foreach($coupon_list as $key => $value){
            if(strpos($value["type_select"], "A") !== false) {
                $coupon_list[$key]["category_name"] = "전체";
            }else{
                $coupon_list[$key]["category_name"] = $this->get_effected_product($value["product_code_1"], $value["product_code_2"], $value["product_idx"]);
            }
        }

        return [
            'coupon_list' => $coupon_list,
            'nTotalCount' => $nTotalCount,
            'pg' => $pg,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows
        ];
    }

    public function getCouponTypeMember()
    {
        $builder = $this;
        $builder->where('state !=', 'C');
        $builder->where('exp_start_day <= NOW()');
        $builder->where('exp_end_day >= NOW()');
        $builder->like('type_select', 'M');
        $builder->orderBy('idx', 'desc'); 
        $builder->limit(1); 

        return $builder->get()->getRowArray();
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        $this->insert($filteredData);
        return $this->getInsertID();

    }

    public function updateData($id, $data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter(
            $data,
            function ($key) use ($allowedFields, $data) {
                return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
            },
            ARRAY_FILTER_USE_KEY
        );

        return $this->update($id, $filteredData);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }
}