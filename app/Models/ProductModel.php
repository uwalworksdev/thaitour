<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product_mst';

    protected $primaryKey = 'product_idx';

    protected $allowedFields = [
        "product_code", "product_code_1", "product_code_2", "product_code_3", "product_code_4", "product_important_notice_m",
        "product_code_name_1", "product_code_name_2", "product_code_name_3", "product_code_name_4", "ufile1", "product_notes_m",
        "rfile1", "ufile2", "rfile2", "ufile3", "rfile3", "ufile4", "rfile4", "rfile5", "ufile5", "rfile6", "ufile6",
        "rfile7", "ufile7", "rfile8", "ufile8", "rfile9", "ufile9", "rfile10", "ufile10", "rfile11", "ufile11", "rfile12", "ufile12",   
        "product_name",  "product_name_en", "product_air", "product_info", "product_intro", "product_schedule", "product_country", "mbti",
        "is_view", "product_period", "product_manager", "product_manager_2", "original_price", "min_price", "review_average",
        "max_price", "keyword", "product_price", "vehicle_price1", "vehicle_price2", "vehicle_price3",
	    "price_min", "product_best", "special_price", "product_option", "product_level",
        "onum", "product_contents", "product_confirm", "product_confirm_m", "product_able", "product_unable", "product_video",
        "mobile_able", "mobile_unable", "special_benefit", "special_benefit_m", "notice_comment", "notice_comment_m",
        "etc_comment", "etc_comment_m", "benefit", "local_info", "phone", "email", "phone_2", "email_2", "product_route",
        "minium_people_cnt", "total_people_cnt", "stay_list", "shopping_list", "sight_list", "country_list", "active_list",
        "tour_period", "tour_info", "tour_detail", "guide_s_date", "guide_e_date", "guide_yoil_0", "guide_yoil_1", "guide_yoil_2",
        "guide_yoil_3", "guide_yoil_4", "guide_yoil_5", "guide_yoil_6", "money_info", "taffic", "guide_unit", "product_price_kids",
        "product_price_baby", "guide_type", "guide_hour", "product_mileage", "exchange", "jetlag", "main_top_best", "main_theme_best",
        "tour_time", "capital_city", "m_date", "r_date", "user_id", "user_level", "information", "meeting_guide", "meeting_place",
        "deposit_cnt", "tours_cate", "yoil_0", "yoil_1", "yoil_2", "yoil_3", "yoil_4", "yoil_5", "yoil_6", "guide_lang", "wish_cnt",
        "order_cnt", "point", "coupon_y", "tour_transport", "adult_text", "kids_text", "baby_text", "product_manager_id", "is_best_value", "caddie_fee_sel",
        "product_code_list", "product_status", "room_cnt", "addrs", 'product_theme', 'product_bedrooms', "product_notes",
        'product_type', 'product_promotions', 'product_more', 'product_contents_m', "min_date", "max_date", "product_important_notice",
        "latitude", "longitude", "product_points", "code_utilities", "code_services", "code_best_utilities", "code_populars",
        "available_period", "deadline_time", "md_recommendation_yn", "hot_deal_yn", "departure_area", "destination_area", "time_line", "stay_idx",
        "adult_people_cnt", "people_cnt", "special_name", "slogan", "age", "exp", "language", "direct_payment", "is_won_bath", "room_guides", "important_notes", "note_news", "worker_id", "worker_name"
    ];

    protected function initialize()
    {
    }

    public function getById($product_idx)
    {
        $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
        write_log($sql);
        return $this->db->query($sql)->getRowArray();
    }

    public function findSearchProducts($search_name, $gubun = "")
    {
        $builder = $this->builder();
        $builder->like("product_name", $search_name);

        if (!empty($gubun)) {
            if ($gubun == "hotel") {
                $builder->where("product_code_1", 1303);
            }else if($gubun == "golf"){
                $builder->where("product_code_1", 1302);
            }else{
                $builder->where("product_code_1", 1301);
            }
        }

        $builder->where("product_status !=", "D")
            ->orderBy("product_idx", "DESC");

        return $builder->get()->getResultArray();
    }

    public function insertData($data)
    {
        $allowedFields = $this->allowedFields;

        $filteredData = array_filter($data, function ($key) use ($allowedFields, $data) {
            return in_array($key, $allowedFields) && (is_string($data[$key]) || is_numeric($data[$key]));
        },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($filteredData as $key => $value) {
            $filteredData[$key] = updateSQ($value);
        }

        return $this->insert($filteredData);
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

        foreach ($filteredData as $key => $value) {	
            $filteredData[$key] = updateSQ($value);
        }

		return $this->update($id, $filteredData);
    }

    public function getSuggestedProducts($code_no)
    {
        $suggest_code_no = '';
        switch ($code_no) {
            case '132401':
                $suggest_code_no = '233201';
                break;
            case '132404':
                $suggest_code_no = '233202';
                break;
            case '1320':
                $suggest_code_no = '2331';
                break;
            case '1324':
                $suggest_code_no = '2332';
                break;
            case '1325':
                $suggest_code_no = '2330';
                break;
            case '132501':
                $suggest_code_no = '233001';
                break;
            case '132502':
                $suggest_code_no = '233002';
                break;
        }


        if ($suggest_code_no) {
            return $this->db->table('tbl_product_mst a')
                ->select('a.*, b.onum, b.code_idx')
                ->join('tbl_main_disp b', 'a.product_idx = b.product_idx')
                ->where('b.code_no', $suggest_code_no)
                ->orderBy('b.onum', 'ASC')
                ->orderBy('b.code_idx', 'DESC')
                ->get()
                ->getResultArray();
        }

        return [];
    }

    public function getDayDetails($product_idx)
    {
        $sql = "SELECT * FROM tbl_product_day_detail WHERE product_idx = ? ";
        $query = $this->db->query($sql, [$product_idx]);
        return $query->getRowArray();
    }

    public function getProductDetails($product_idx)
    {
        return $this->where('product_idx', $product_idx)->first();
    }

    public function getProductLevel($product_level)
    {
        $query = $this->db->query("SELECT * FROM tbl_product_level WHERE idx = ?", [$product_level]);
        return $query->getRowArray();
    }

    public function getProducts($code_no, $s, $perPage = 10, $page = 1)
    {
        $order_by = $this->getOrderBy($s);
        $code_col = $this->getCodeColumn($code_no);

        $offset = ($page - 1) * $perPage;

        $builder = $this->builder();

        if ($code_col) {
            $builder->where($code_col, $code_no);
        }

        $builder->orderBy($order_by);
        $builder->limit($perPage, $offset);

        return $builder->get()->getResultArray();
    }

    public function getCodes($parent_code_no)
    {
        return $this->db->table('tbl_code')
            ->where('parent_code_no', $parent_code_no)
            ->where('depth', 3)
            ->where('status', 'Y')
            ->orderBy('onum', 'asc')
            ->get()
            ->getResultArray();
    }

    public function getProductsByCode($suggest_code, $limit)
    {
        return $this->db->table('tbl_product_mst a')
            ->select('a.*, b.onum, b.code_idx')
            ->join('tbl_main_disp b', 'a.product_idx = b.product_idx')
            ->whereIn('b.code_no', $suggest_code)
            ->orderBy('b.onum', 'asc')
            ->orderBy('b.code_idx', 'desc')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getAllProductsByCode($code)
    {
        return $this->where('product_code_1', $code)
            ->orderBy('onum', 'asc')
            ->orderBy('product_idx', 'desc')
            ->get()
            ->getResultArray();
    }

    public function getAllProductsBySubCode($field, $code)
    {
        return $this->where($field, $code)
            ->orLike('product_code_list', $code)
            ->where('product_status !=', "D")
            ->orderBy('onum', 'asc')
            ->orderBy('product_idx', 'desc')
            ->get()
            ->getResultArray();
    }

    public function getTotalProducts($suggest_code)
    {
        return $this->db->table('tbl_product_mst a')
            ->select('a.*, b.onum, b.code_idx')
            ->join('tbl_main_disp b', 'a.product_idx = b.product_idx')
            ->whereIn('b.code_no', $suggest_code)
            ->countAllResults();
    }

    private function getOrderBy($s)
    {
        switch ($s) {
            case "1":
                return "onum ASC";
            case "2":
                return "wish_cnt DESC";
            case "3":
                return "order_cnt DESC";
            case "4":
                return "point DESC";
            case "5":
                return "product_price DESC";
            case "6":
                return "product_price ASC";
            default:
                return "onum ASC";
        }
    }

    public function getCodeColumn($code_no)
    {
        $length = strlen($code_no);
        if ($length == 4)
            return 'product_code_1';
        if ($length == 6)
            return 'product_code_2';
        if ($length == 8)
            return 'product_code_3';
        return '';
    }

    public function getProductConfirm($product_idx)
    {
        $sql = "SELECT confirm_info FROM tbl_product_mst WHERE product_idx = ?";
        $query = $this->db->query($sql, [$product_idx]);
        return $query->getRowArray();
    }

    public function get_next_available_date($product_idx, $current_date)
    {
        $addDay = 1;

        while (true) {
            $addDay++;
            $next_date = date("Y-m-d", strtotime("+$addDay days", strtotime($current_date)));
            $day_of_week = date("w", strtotime($next_date));

            $detail_sql = "";
            if ($day_of_week == 0) {
                $detail_sql = " AND yoil_0 = 'Y' ";
            } else if ($day_of_week == 1) {
                $detail_sql = " AND yoil_1 = 'Y' ";
            } else if ($day_of_week == 2) {
                $detail_sql = " AND yoil_2 = 'Y' ";
            } else if ($day_of_week == 3) {
                $detail_sql = " AND yoil_3 = 'Y' ";
            } else if ($day_of_week == 4) {
                $detail_sql = " AND yoil_4 = 'Y' ";
            } else if ($day_of_week == 5) {
                $detail_sql = " AND yoil_5 = 'Y' ";
            } else if ($day_of_week == 6) {
                $detail_sql = " AND yoil_6 = 'Y' ";
            }

            $sql_g = "
                SELECT * 
                FROM tbl_product_yoil 
                WHERE product_idx = ? 
                AND depth = '1' 
                AND ? BETWEEN s_date AND e_date
                $detail_sql
            ";

            $query_g = $this->db->query($sql_g, array($product_idx, $next_date));
            $nTotalCount = $query_g->getNumRows();

            if ($nTotalCount > 0) {
                return $next_date;
            }

            $sql_m = "
                SELECT * 
                FROM tbl_product_yoil 
                WHERE product_idx = ? 
                AND depth = '1' 
                AND ? <= e_date
            ";

            $query_m = $this->db->query($sql_m, array($product_idx, $next_date));
            $nTotalCount2 = $query_m->getNumRows();

            if ($nTotalCount2 < 1) {
                break;
            }

            if ($addDay > 365) {
                break;
            }
        }

        return $current_date;
    }

    public function get_product_info($product_idx, $start_date_in)
    {
        $sql = "SELECT * FROM tbl_product_yoil WHERE product_idx = ? AND depth = '1' AND e_date >= ?";
        return $this->db->query($sql, array($product_idx, $start_date_in))->getResultArray();
    }

    public function get_air_info($product_idx, $start_date_in)
    {
        $selDate = $start_date_in; // Gán giá trị cho biến $selDate
        $dow = date('w', strtotime($start_date_in));
        $dowSql = " AND a.yoil_$dow = 'Y' "; // Chỉ định rõ ràng bảng a để tránh lỗi ambiguous

        $sql = "SELECT a.*, b.*, c.product_name, c.original_price, c.product_period, d.code_name 
                FROM tbl_product_yoil a 
                LEFT JOIN tbl_product_air b ON a.yoil_idx = b.yoil_idx
                LEFT JOIN tbl_product_mst c ON a.product_idx = c.product_idx
                LEFT JOIN tbl_code d ON b.air_code_1 = d.code_no
                WHERE ('$selDate' BETWEEN a.s_date AND a.e_date OR '$selDate' BETWEEN a.s_date AND a.e_date)
                AND a.product_idx = ? $dowSql
                ORDER BY tour_price ASC";

        return $this->db->query($sql, [$product_idx])->getResultArray();
    }

    public function insertPriceVal($seq, $product_idx, $current_date)
    {
        $addDay = 1;

        while (true) {
            $addDay++;
            $next_date = date("Y-m-d", strtotime("+$addDay days", strtotime($current_date)));
            $day_of_week = date("w", strtotime($next_date));

            $detail_sql = "";
            if ($day_of_week == 0) {
                $detail_sql = " AND yoil_0 = 'Y' ";
            } else if ($day_of_week == 1) {
                $detail_sql = " AND yoil_1 = 'Y' ";
            } else if ($day_of_week == 2) {
                $detail_sql = " AND yoil_2 = 'Y' ";
            } else if ($day_of_week == 3) {
                $detail_sql = " AND yoil_3 = 'Y' ";
            } else if ($day_of_week == 4) {
                $detail_sql = " AND yoil_4 = 'Y' ";
            } else if ($day_of_week == 5) {
                $detail_sql = " AND yoil_5 = 'Y' ";
            } else if ($day_of_week == 6) {
                $detail_sql = " AND yoil_6 = 'Y' ";
            }

            $sql_g = "
                SELECT * 
                FROM tbl_product_yoil 
                WHERE product_idx = ? 
                AND depth = '1' 
                AND ? BETWEEN s_date AND e_date
                $detail_sql
            ";

            $query_g = $this->db->query($sql_g, array($product_idx, $next_date));
            $nTotalCount = $query_g->getNumRows();

            if ($nTotalCount > 0) {
                return $next_date;
            }

            $sql_m = "
                SELECT * 
                FROM tbl_product_yoil 
                WHERE product_idx = ? 
                AND depth = '1' 
                AND ? <= e_date
            ";

            $query_m = $this->db->query($sql_m, array($product_idx, $next_date));
            $nTotalCount2 = $query_m->getNumRows();

            if ($nTotalCount2 < 1) {
                break;
            }

            if ($addDay > 365) {
                break;
            }
        }

        return $current_date;
    }

    public function getPriceData($seq, $product_idx, $sDate)
    {
        $sql = "SELECT get_date, MIN(tour_price) as price FROM price_val WHERE seq = ? AND product_idx = ? AND get_date >= ? GROUP BY get_date";
        return $this->db->query($sql, [$seq, $product_idx, $sDate])->getResultArray();
    }

    public function getFirstDate($seq, $product_idx, $today)
    {
        $sql = "SELECT get_date FROM price_val WHERE seq = ? AND product_idx = ? AND get_date > ? GROUP BY get_date LIMIT 1";
        return $this->db->query($sql, [$seq, $product_idx, $today])->getRowArray();
    }

    public function deletePriceVal($seq)
    {
        $sql = "DELETE FROM price_val WHERE seq = ?";
        $this->db->query($sql, [$seq]);
    }

    public function getCodeName($code_no)
    {
        return $this->db->table('tbl_code')
            ->where('code_no', $code_no)
            ->get()
            ->getRowArray();
    }

    public function getProductsByEvent($bbs_idx)
    {
        return $this->db->table('tbl_product_mst a')
            ->select('a.product_name, a.product_idx, a.product_code, a.is_view, b.onum, b.code_idx')
            ->join('tbl_event_disp b', 'a.product_idx = b.product_idx')
            ->where('b.code_no', $bbs_idx)
            ->orderBy('b.onum', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getBestProducts($code_1 = "", $code_2 = "", $code_3 = "")
    {
        $result = $this->where("is_view", "Y")->where("product_best", "Y");

        if ($code_1 != "") {
            $result->where("product_code_1", $code_1);
        }

        if ($code_2 != "") {
            $result->where("product_code_2", $code_2);
        }

        if ($code_3 != "") {
            $result->where("product_code_3", $code_3);
        }
        return $result->findAll();
    }

    public function findProductPagingAdmin($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->builder();
        $baht_thai = (float)($setting['baht_thai'] ?? 0);
        if ($where['product_code_1'] != "") {
            $builder->where('product_code_1', $where['product_code_1']);
        }
        if ($where['product_code_2'] != "") {
            $builder->groupStart();
            $builder->where('product_code_2', $where['product_code_2']);
            $builder->orLike('product_code_list', "|" .$where['product_code_2']);
            $builder->groupEnd();
        }
        if ($where['product_code_3'] != "") {
            $builder->groupStart();
            $builder->where('product_code_3', $where['product_code_3']);
            $builder->orLike('product_code_list', "|" .$where['product_code_3']);
            $builder->groupEnd();
        }

        if ($where['guide_type'] != "") {
            $builder->where('guide_type', $where['guide_type']);
        }

        if ($where['product_code_list']) {
            $product_code_list = explode(",", $where['product_code_list']);
            $cnt_code = 1;
            $builder->groupStart();
            foreach ($product_code_list as $code) {
                if ($cnt_code > 1) {
                    $builder->orLike('product_code_list', $code);
                } else {
                    $builder->like('product_code_list', $code);
                }
                $cnt_code++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_category']) {
            if (strpos($where['search_product_category'], 'all') === false) {
                $search_product_category = explode(",", $where['search_product_category']);
                $cnt_cat = 1;
                $builder->groupStart();
                foreach ($search_product_category as $category) {
                    if ($cnt_cat > 1) {
                        $builder->orLike('product_code_list', $category);
                    } else {
                        $builder->like('product_code_list', $category);
                    }
                    $cnt_cat++;
                }
                $builder->groupEnd();
            }
        }

        if ($where['search_product_hotel']) {
            if (strpos($where['search_product_hotel'], 'all') === false) {
                $search_product_hotel = explode(",", $where['search_product_hotel']);
                $cnt_type = 1;
                $builder->groupStart();
                foreach ($search_product_hotel as $type) {
                    if ($cnt_type > 1) {
                        $builder->orLike('product_type', $type);
                    } else {
                        $builder->like('product_type', $type);
                    }
                    $cnt_type++;
                }
                $builder->groupEnd();
            }
        }

        if ($where['search_product_rating']) {
            if (strpos($where['search_product_rating'], 'all') === false) {
                $search_product_rating = explode(",", $where['search_product_rating']);
                $cnt_rating = 1;
                $builder->groupStart();
                foreach ($search_product_rating as $rating) {
                    if ($cnt_rating > 1) {
                        $builder->orWhere('product_level', $rating);
                    } else {
                        $builder->where('product_level', $rating);
                    }
                    $cnt_rating++;
                }
                $builder->groupEnd();
            }
        }

        if (!empty($where['price_max'])) {
            if (empty($where['price_type']) || $where['price_type'] == "W") {
                $builder->where("(product_price * $baht_thai) > ", (float)$where['price_min']);
                $builder->where("(product_price * $baht_thai) < ", (float)$where['price_max']);
            } else {
                $builder->where("product_price > ", (float)$where['price_min']);
                $builder->where("product_price < ", (float)$where['price_max']);
            }
        }

        if ($where['search_product_promotion']) {
            $search_product_promotion = explode(",", $where['search_product_promotion']);
            $cnt_promotion = 1;
            $builder->groupStart();
            foreach ($search_product_promotion as $promotion) {
                if ($cnt_promotion > 1) {
                    $builder->orLike('product_promotions', $promotion);
                } else {
                    $builder->like('product_promotions', $promotion);
                }
                $cnt_promotion++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_topic']) {
            $search_product_topic = explode(",", $where['search_product_topic']);
            $cnt_theme = 1;
            $builder->groupStart();
            foreach ($search_product_topic as $theme) {
                if ($cnt_theme > 1) {
                    $builder->orLike('product_theme', $theme);
                } else {
                    $builder->like('product_theme', $theme);
                }
                $cnt_theme++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_bedroom']) {
            $search_product_bedroom = explode(",", $where['search_product_bedroom']);
            $cnt_bedroom = 1;
            $builder->groupStart();
            foreach ($search_product_bedroom as $bedroom) {
                if ($cnt_bedroom > 1) {
                    $builder->orLike('product_bedrooms', $bedroom);
                } else {
                    $builder->like('product_bedrooms', $bedroom);
                }
                $cnt_bedroom++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_name']) {
            $builder->like('product_name', $where['search_product_name']);
        }

        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->groupStart();
                $builder->like('product_name', $where['search_txt']);
                $builder->orLike('keyword', $where['search_txt']);
                $builder->groupEnd();
            }
        }

        if ($where['search_keyword']) {
            if (strpos($where['search_keyword'], 'all') === false) {
                $search_keyword = explode(",", $where['search_keyword']);
                $cnt_keyword = 1;
                $builder->groupStart();
                foreach ($search_keyword as $category) {
                    if ($cnt_keyword > 1) {
                        $builder->orLike('keyword', $category);
                    } else {
                        $builder->like('keyword', $category);
                    }
                    $cnt_keyword++;
                }
                $builder->groupEnd();
            }
        }


        if ($where['search_product_tour']) {
            if (strpos($where['search_product_tour'], 'all') === false) {
                $search_product_tour = explode(",", $where['search_product_tour']);
                $cnt_tour = 1;
                $builder->groupStart();
                foreach ($search_product_tour as $category) {
                    if ($cnt_tour > 1) {
                        $builder->orLike('product_theme', $category);
                    } else {
                        $builder->like('product_theme', $category);
                    }
                    $cnt_tour++;
                }
                $builder->groupEnd();
            }
        }

        if (trim($where['arr_search_txt']) != "") {
            $builder->groupStart();

            $str_search_txt = preg_replace('/[^a-zA-Z0-9가-힣\s]+/u', ' ', trim($where['arr_search_txt']));
            $arr_search_txt = preg_split('/\s+/', $str_search_txt);

            foreach ($arr_search_txt as $index => $txt) {

                if ($index > 0) {
                    $builder->orGroupStart();
                }

                $escapedTxt = $this->db->escapeLikeString($txt);
                $builder->like('product_name', $escapedTxt);
                $builder->orLike('keyword', $escapedTxt);

                if ($index > 0) {
                    $builder->groupEnd();
                }
            }
            $builder->groupEnd();
        }

        if ($where['is_view'] != "") {
            $builder->where("is_view", $where['is_view']);
        }

        if ($where['special_price'] != "") {
            $builder->where("special_price", $where['special_price']);
        }

//        if ($where['product_status'] != "") {
//            $builder->where("product_status", $where['product_status']);
//        }

        $currentUrl = current_url();
        $link = '/AdmMaster/';
        if (strpos($currentUrl, $link) === false) {
            $builder->where('product_status != ', 'stop');
        }

        $builder->where("product_status !=", "D");
        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['product_idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }
        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $total_price_max = 500000;

        if ($where['price_type'] == "B") {
            $total_price_max = (int)$total_price_max / $baht_thai;
        }

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];

            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;
        }

        

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;
        }
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'checkin' => $where['checkin'],
            'checkout' => $where['checkout'],
            'search_product_name' => $where['search_product_name'],
            'search_product_category' => $where['search_product_category'],
            'search_product_hotel' => $where['search_product_hotel'],
            'search_product_rating' => $where['search_product_rating'],
            'search_product_promotion' => $where['search_product_promotion'],
            'search_product_topic' => $where['search_product_topic'],
            'search_product_bedroom' => $where['search_product_bedroom'],
            'price_type' => $where['price_type'],
            'price_min' => $where['price_min'],
            'price_max' => $where['price_max'],
            'total_price_max' => $total_price_max,
            'is_view' => $where['is_view'],
            'product_code_1' => $where['product_code_1'],
            'product_code_2' => $where['product_code_2'],
            'product_code_3' => $where['product_code_3'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }

    public function findProductPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->builder();
        $baht_thai = (float)($setting['baht_thai'] ?? 0);
        if ($where['product_code_1'] != "") {
            $builder->where('product_code_1', $where['product_code_1']);
        }
        if ($where['product_code_2'] != "") {
            $builder->where('product_code_2', $where['product_code_2']);
        }
        if ($where['product_code_3'] != "") {
            $builder->where('product_code_3', $where['product_code_3']);
        }

        if ($where['guide_type'] != "") {
            $builder->where('guide_type', $where['guide_type']);
        }

        if ($where['product_code_list']) {
            $product_code_list = explode(",", $where['product_code_list']);
            $cnt_code = 1;
            $builder->groupStart();
            foreach ($product_code_list as $code) {
                if ($cnt_code > 1) {
                    $builder->orLike('product_code_list', $code);
                } else {
                    $builder->like('product_code_list', $code);
                }
                $cnt_code++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_category']) {
            if (strpos($where['search_product_category'], 'all') === false) {
                $search_product_category = explode(",", $where['search_product_category']);
                $cnt_cat = 1;
                $builder->groupStart();
                foreach ($search_product_category as $category) {
                    if ($cnt_cat > 1) {
                        $builder->orLike('product_code_list', $category);
                    } else {
                        $builder->like('product_code_list', $category);
                    }
                    $cnt_cat++;
                }
                $builder->groupEnd();
            }
        }

        if ($where['search_product_hotel']) {
            if (strpos($where['search_product_hotel'], 'all') === false) {
                $search_product_hotel = explode(",", $where['search_product_hotel']);
                $cnt_type = 1;
                $builder->groupStart();
                foreach ($search_product_hotel as $type) {
                    if ($cnt_type > 1) {
                        $builder->orLike('product_type', $type);
                    } else {
                        $builder->like('product_type', $type);
                    }
                    $cnt_type++;
                }
                $builder->groupEnd();
            }
        }

        if ($where['search_product_rating']) {
            if (strpos($where['search_product_rating'], 'all') === false) {
                $search_product_rating = explode(",", $where['search_product_rating']);
                $cnt_rating = 1;
                $builder->groupStart();
                foreach ($search_product_rating as $rating) {
                    if ($cnt_rating > 1) {
                        $builder->orWhere('product_level', $rating);
                    } else {
                        $builder->where('product_level', $rating);
                    }
                    $cnt_rating++;
                }
                $builder->groupEnd();
            }
        }

        if (!empty($where['price_max'])) {
            if (empty($where['price_type']) || $where['price_type'] == "W") {
                $builder->where("(product_price * $baht_thai) > ", (float)$where['price_min']);
                $builder->where("(product_price * $baht_thai) < ", (float)$where['price_max']);
            } else {
                $builder->where("product_price > ", (float)$where['price_min']);
                $builder->where("product_price < ", (float)$where['price_max']);
            }
        }

        if ($where['search_product_promotion']) {
            $search_product_promotion = explode(",", $where['search_product_promotion']);
            $cnt_promotion = 1;
            $builder->groupStart();
            foreach ($search_product_promotion as $promotion) {
                if ($cnt_promotion > 1) {
                    $builder->orLike('product_promotions', $promotion);
                } else {
                    $builder->like('product_promotions', $promotion);
                }
                $cnt_promotion++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_topic']) {
            $search_product_topic = explode(",", $where['search_product_topic']);
            $cnt_theme = 1;
            $builder->groupStart();
            foreach ($search_product_topic as $theme) {
                if ($cnt_theme > 1) {
                    $builder->orLike('product_theme', $theme);
                } else {
                    $builder->like('product_theme', $theme);
                }
                $cnt_theme++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_bedroom']) {
            $search_product_bedroom = explode(",", $where['search_product_bedroom']);
            $cnt_bedroom = 1;
            $builder->groupStart();
            foreach ($search_product_bedroom as $bedroom) {
                if ($cnt_bedroom > 1) {
                    $builder->orLike('product_bedrooms', $bedroom);
                } else {
                    $builder->like('product_bedrooms', $bedroom);
                }
                $cnt_bedroom++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_name']) {
            $builder->like('product_name', $where['search_product_name']);
        }

        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->groupStart();
                $builder->like('product_name', $where['search_txt']);
                $builder->orLike('keyword', $where['search_txt']);
                $builder->groupEnd();
            }
        }

        if ($where['search_keyword']) {
            if (strpos($where['search_keyword'], 'all') === false) {
                $search_keyword = explode(",", $where['search_keyword']);
                $cnt_keyword = 1;
                $builder->groupStart();
                foreach ($search_keyword as $category) {
                    if ($cnt_keyword > 1) {
                        $builder->orLike('keyword', $category);
                    } else {
                        $builder->like('keyword', $category);
                    }
                    $cnt_keyword++;
                }
                $builder->groupEnd();
            }
        }


        if ($where['search_product_tour']) {
            if (strpos($where['search_product_tour'], 'all') === false) {
                $search_product_tour = explode(",", $where['search_product_tour']);
                $cnt_tour = 1;
                $builder->groupStart();
                foreach ($search_product_tour as $category) {
                    if ($cnt_tour > 1) {
                        $builder->orLike('product_theme', $category);
                    } else {
                        $builder->like('product_theme', $category);
                    }
                    $cnt_tour++;
                }
                $builder->groupEnd();
            }
        }

        if (trim($where['arr_search_txt']) != "") {
            $builder->groupStart();

            $str_search_txt = preg_replace('/[^a-zA-Z0-9가-힣\s]+/u', ' ', trim($where['arr_search_txt']));
            $arr_search_txt = preg_split('/\s+/', $str_search_txt);

            foreach ($arr_search_txt as $index => $txt) {

                if ($index > 0) {
                    $builder->orGroupStart();
                }

                $escapedTxt = $this->db->escapeLikeString($txt);
                $builder->like('product_name', $escapedTxt);
                $builder->orLike('keyword', $escapedTxt);

                if ($index > 0) {
                    $builder->groupEnd();
                }
            }
            $builder->groupEnd();
        }

        if ($where['is_view'] != "") {
            $builder->where("is_view", $where['is_view']);
        }

        if ($where['special_price'] != "") {
            $builder->where("special_price", $where['special_price']);
        }

//        if ($where['product_status'] != "") {
//            $builder->where("product_status", $where['product_status']);
//        }

        $currentUrl = current_url();
        $link = '/AdmMaster/';
        if (strpos($currentUrl, $link) === false) {
            $builder->where('product_status != ', 'stop');
        }

        $builder->where("product_status !=", "D");
        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['product_idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }
        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $total_price_max = 500000;

        if ($where['price_type'] == "B") {
            $total_price_max = (int)$total_price_max / $baht_thai;
        }

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];

            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;
        }

        

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;
        }
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'checkin' => $where['checkin'],
            'checkout' => $where['checkout'],
            'search_product_name' => $where['search_product_name'],
            'search_product_category' => $where['search_product_category'],
            'search_product_hotel' => $where['search_product_hotel'],
            'search_product_rating' => $where['search_product_rating'],
            'search_product_promotion' => $where['search_product_promotion'],
            'search_product_topic' => $where['search_product_topic'],
            'search_product_bedroom' => $where['search_product_bedroom'],
            'price_type' => $where['price_type'],
            'price_min' => $where['price_min'],
            'price_max' => $where['price_max'],
            'total_price_max' => $total_price_max,
            'is_view' => $where['is_view'],
            'product_code_1' => $where['product_code_1'],
            'product_code_2' => $where['product_code_2'],
            'product_code_3' => $where['product_code_3'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }

    public function findProductHotelPagingSpecial($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->db->table('tbl_product_mst AS p');
        $builder->select('p.*, MIN(STR_TO_DATE(h.o_sdate, "%Y-%m-%d")) AS oldest_date, MAX(STR_TO_DATE(h.o_edate, "%Y-%m-%d")) AS latest_date');
        $builder->join('tbl_hotel_option AS h', 'p.product_code = h.goods_code', 'left');

        $builder->where([
            'o_sdate IS NOT NULL' => null,
            'o_edate IS NOT NULL' => null,
            'h.option_type' => 'M',
        ]);
        $builder->where('o_sdate <>', '');
        $builder->where('o_edate <>', '');

        $addWhereConditions = function ($field, $value) use ($builder) {
            if (!empty($value)) {
                $builder->where($field, $value);
            }
        };

        $addGroupConditions = function ($field, $values) use ($builder) {
            if (!empty($values)) {
                $values = explode(',', $values);
                $builder->groupStart();
                foreach ($values as $index => $value) {
                    if ($index === 0) {
                        $builder->like($field, $value);
                    } else {
                        $builder->orLike($field, $value);
                    }
                }
                $builder->groupEnd();
            }
        };

        $addWhereConditions('product_code_1', $where['product_code_1'] ?? '');
        $addWhereConditions('product_code_2', $where['product_code_2'] ?? '');
        $addWhereConditions('product_code_3', $where['product_code_3'] ?? '');
        $addWhereConditions('is_view', $where['is_view'] ?? '');
        $addWhereConditions('special_price', $where['special_price'] ?? '');
        $addWhereConditions('product_status', $where['product_status'] ?? '');

        if (!empty($where['keyword'])) {
            $builder->like('product_name', $where['keyword']);
        }

        $addGroupConditions('product_code_list', $where['product_code_list'] ?? '');
        $addGroupConditions('product_type', $where['search_product_hotel'] ?? '');
        $addGroupConditions('product_level', $where['search_product_rating'] ?? '');
        $addGroupConditions('product_promotions', $where['search_product_promotion'] ?? '');
        $addGroupConditions('product_theme', $where['search_product_topic'] ?? '');
        $addGroupConditions('product_bedrooms', $where['search_product_bedroom'] ?? '');

        if (!empty($where['price_min']) && !empty($where['price_max'])) {
            $builder->where('product_price >', $where['price_min']);
            $builder->where('product_price <', $where['price_max']);
        }

        if (!empty($where['checkin']) && !empty($where['checkout'])) {
            $builder->groupStart();
            $builder->where('STR_TO_DATE(o_sdate, "%Y-%m-%d") >=', date('Y-m-d', strtotime($where['checkin'])));
            $builder->where('STR_TO_DATE(o_edate, "%Y-%m-%d") <=', date('Y-m-d', strtotime($where['checkout'])));
            $builder->groupEnd();
        }

        if (!empty($where['search_txt'])) {
            $builder->groupStart();
            if (!empty($where['search_category'])) {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->like('product_name', $where['search_txt']);
                $builder->orLike('keyword', $where['search_txt']);
            }
            $builder->groupEnd();
        }

        if (!empty($where['day_start'])) {
            $builder->where('h.o_sdate >=', $where['day_start']);
        }
        if (!empty($where['day_end'])) {
            $builder->where('h.o_edate <=', $where['day_end']);
        }

        $builder->where('product_status !=', 'D');
        $builder->groupBy('product_idx');

        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        $pg = $pg ?: 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $orderBy = $orderBy ?: ['product_idx' => 'DESC'];
        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }

        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $baht_thai = (float)($setting['baht_thai'] ?? 0);
        foreach ($items as &$item) {
            $item['product_price_won'] = (float)$item['product_price'] * $baht_thai;
        }

        $arr_ = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom,
        ];

        return array_merge($arr_, $where);
    }

    public function findProductHotelPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $baht_thai = (float)($setting['baht_thai'] ?? 0);

        $builder = $this->db->table('tbl_product_mst AS p');
        $builder->select('p.*, MIN(STR_TO_DATE(h.o_sdate, "%Y-%m-%d")) AS oldest_date, MAX(STR_TO_DATE(o_edate, "%Y-%m-%d")) AS latest_date');
        $builder->join('tbl_hotel_rooms AS h', 'p.product_idx = h.goods_code', 'left');

        $builder->where('h.o_sdate IS NOT NULL');
        $builder->where('h.o_edate IS NOT NULL');
        $builder->where('h.o_sdate <>', '');
        $builder->where('h.o_edate <>', '');
		
        if ($where['day_start'] && $where['day_start'] != "") {
            $builder->where('h.o_sdate <=', $where['day_start']); 
        }

        if ($where['day_end'] && $where['day_end'] != "") {
            $builder->where('h.o_edate >=', $where['day_end']);
        }

		
        //$builder->where('h.option_type', 'M');

        if ($where['product_code_1'] != "") {
            $builder->where('product_code_1', $where['product_code_1']);
        }
        if ($where['product_code_2'] != "") {
            $builder->where('product_code_2', $where['product_code_2']);
        }
        if ($where['product_code_3'] != "") {
            $builder->where('product_code_3', $where['product_code_3']);
        }

        if ($where['keyword'] && $where['keyword'] != "") {
            $builder->like('product_name', $where['keyword']);
        }

        if ($where['product_code_list']) {
            $product_code_list = explode(",", $where['product_code_list']);
            $cnt_code = 1;
            $builder->groupStart();
            foreach ($product_code_list as $code) {
                if ($cnt_code > 1) {
                    $builder->orLike('product_code_list', $code);
                } else {
                    $builder->like('product_code_list', $code);
                }
                $cnt_code++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_category']) {
            if (strpos($where['search_product_category'], 'all') === false) {
                $search_product_category = explode(",", $where['search_product_category']);
                $cnt_cat = 1;
                $builder->groupStart();
                foreach ($search_product_category as $category) {
                    if ($cnt_cat > 1) {
                        $builder->orLike('product_code_list', $category);
                    } else {
                        $builder->like('product_code_list', $category);
                    }
                    $cnt_cat++;
                }
                $builder->groupEnd();
            }
        }

        if ($where['search_product_hotel']) {
            if (strpos($where['search_product_hotel'], 'all') === false) {
                $search_product_hotel = explode(",", $where['search_product_hotel']);
                $cnt_type = 1;
                $builder->groupStart();
                foreach ($search_product_hotel as $type) {
                    if ($cnt_type > 1) {
                        $builder->orLike('product_type', $type);
                    } else {
                        $builder->like('product_type', $type);
                    }
                    $cnt_type++;
                }
                $builder->groupEnd();
            }
        }

        if ($where['search_product_rating']) {
            if (strpos($where['search_product_rating'], 'all') === false) {
                $search_product_rating = explode(",", $where['search_product_rating']);
                $cnt_rating = 1;
                $builder->groupStart();
                foreach ($search_product_rating as $rating) {
                    if ($cnt_rating > 1) {
                        $builder->orWhere('product_level', $rating);
                    } else {
                        $builder->where('product_level', $rating);
                    }
                    $cnt_rating++;
                }
                $builder->groupEnd();
            }
        }

        if (!empty($where['price_max'])) {
            if (empty($where['price_type']) || $where['price_type'] == "W") {
                $builder->where("(product_price * $baht_thai) > ", (float)$where['price_min']);
                $builder->where("(product_price * $baht_thai) < ", (float)$where['price_max']);
            } else {
                $builder->where("product_price > ", (float)$where['price_min']);
                $builder->where("product_price < ", (float)$where['price_max']);
            }
        }

        if ($where['search_product_promotion']) {
            $search_product_promotion = explode(",", $where['search_product_promotion']);
            $cnt_promotion = 1;
            $builder->groupStart();
            foreach ($search_product_promotion as $promotion) {
                if ($cnt_promotion > 1) {
                    $builder->orLike('product_promotions', $promotion);
                } else {
                    $builder->like('product_promotions', $promotion);
                }
                $cnt_promotion++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_topic']) {
            $search_product_topic = explode(",", $where['search_product_topic']);
            $cnt_theme = 1;
            $builder->groupStart();
            foreach ($search_product_topic as $theme) {
                if ($cnt_theme > 1) {
                    $builder->orLike('product_theme', $theme);
                } else {
                    $builder->like('product_theme', $theme);
                }
                $cnt_theme++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_bedroom']) {
            $search_product_bedroom = explode(",", $where['search_product_bedroom']);
            $cnt_bedroom = 1;
            $builder->groupStart();
            foreach ($search_product_bedroom as $bedroom) {
                if ($cnt_bedroom > 1) {
                    $builder->orLike('product_bedrooms', $bedroom);
                } else {
                    $builder->like('product_bedrooms', $bedroom);
                }
                $cnt_bedroom++;
            }
            $builder->groupEnd();
        }

        if (!empty($where['checkin']) && !empty($where['checkout'])) {
            $builder->groupStart();
            $builder->where('STR_TO_DATE(o_sdate, "%Y-%m-%d") >=', date('Y-m-d', strtotime($where['checkin'])));
            $builder->orWhere('STR_TO_DATE(o_edate, "%Y-%m-%d") <=', date('Y-m-d', strtotime($where['checkout'])));
            $builder->groupEnd();
        }

        if ($where['search_product_name']) {
            $builder->like('product_name', $where['search_product_name']);
        }

        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->groupStart();
                $builder->like('product_name', $where['search_txt']);
                $builder->orLike('keyword', $where['search_txt']);
                $builder->groupEnd();
            }
        }

        if (trim($where['arr_search_txt']) != "") {
            $builder->groupStart();
            // $str_search_txt = trim($where['arr_search_txt']);
            // $arr_search_txt = preg_split('/\s+/', $str_search_txt);

            $str_search_txt = preg_replace('/[^a-zA-Z0-9가-힣\s]+/u', ' ', trim($where['arr_search_txt']));
            $arr_search_txt = preg_split('/\s+/', $str_search_txt);

            foreach ($arr_search_txt as $index => $txt) {

                if ($index > 0) {
                    $builder->orGroupStart();
                }

                $escapedTxt = $this->db->escapeLikeString($txt);
                $builder->like('product_name', $escapedTxt);
                $builder->orLike('keyword', $escapedTxt);

                // $builder->where("product_name REGEXP '\\\b" . $escapedTxt . "\\\b'");
                // $builder->orWhere("keyword REGEXP '\\\b" . $escapedTxt . "\\\b'");

                if ($index > 0) {
                    $builder->groupEnd();
                }
            }
            $builder->groupEnd();
        }

        if ($where['is_view'] != "") {
            $builder->where("is_view", $where['is_view']);
        }

        if ($where['special_price'] != "") {
            $builder->where("special_price", $where['special_price']);
        }

//        if ($where['product_status'] != "") {
//            $builder->where("product_status", $where['product_status']);
//        }

        $currentUrl = current_url();
        $link = '/AdmMaster/';
        if (strpos($currentUrl, $link) === false) {
            $builder->where('product_status != ', 'stop');
        }

        $builder->where("product_status !=", "D");
        $builder->groupBy('product_idx');
        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['product_idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }

//        $sql = $builder->getCompiledSelect();
//        var_dump($sql);
//        die();

        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        $total_price_max = 500000;

        if ($where['price_type'] == "B") {
            $total_price_max = (int)$total_price_max / $baht_thai;
        }

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];

            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;
        }
		
        //write_log("last- ". $this->db->getLastQuery());
		
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'checkin' => $where['checkin'],
            'checkout' => $where['checkout'],

            'keyword' => $where['keyword'],
            'day_start' => $where['day_start'],
            'day_end' => $where['day_end'],

            'search_product_name' => $where['search_product_name'],
            'search_product_category' => $where['search_product_category'],
            'search_product_hotel' => $where['search_product_hotel'],
            'search_product_rating' => $where['search_product_rating'],
            'search_product_promotion' => $where['search_product_promotion'],
            'search_product_topic' => $where['search_product_topic'],
            'search_product_bedroom' => $where['search_product_bedroom'],
            'price_type' => $where['price_type'],
            'price_min' => $where['price_min'],
            'price_max' => $where['price_max'],
            'total_price_max' => $total_price_max,
            'is_view' => $where['is_view'],
            'product_code_1' => $where['product_code_1'],
            'product_code_2' => $where['product_code_2'],
            'product_code_3' => $where['product_code_3'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }

    public function findProductCarPrice($ca_idx)
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->db->table('tbl_cars_price AS c');
        $builder->select('p.*, c.cp_idx, c.ca_idx, c.init_price, c.sale_price');
        $builder->join('tbl_product_mst AS p', 'p.product_idx = c.product_idx', 'left');

        $builder->where("p.product_idx IS NOT NULL");
        $builder->where('c.ca_idx', $ca_idx);
        $builder->where("product_status !=", "D");

        $builder->orderBy("p.onum", "asc");
        $builder->orderBy("p.product_idx", "desc");

        $items = $builder->get()->getResultArray();

        foreach ($items as $key => $value) {
            $product_price = (float)$value['sale_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $car_price_won = $product_price * $baht_thai;
            $items[$key]['car_price_won'] = $car_price_won;
        }

        return $items;
    }

    public function findProductCarPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->db->table('tbl_cars_sub AS c');
        $builder->select('p.*, c.idx as cs_idx, c.departure_code, c.destination_code, c.car_price');
        $builder->join('tbl_product_mst AS p', 'p.product_idx = c.product_idx', 'left');

        if ($where['product_code_1'] != "") {
            $builder->where('product_code_1', $where['product_code_1']);
        }
        if ($where['product_code_2'] != "") {
            $builder->where('product_code_2', $where['product_code_2']);
        }
        if ($where['product_code_3'] != "") {
            $builder->where('product_code_3', $where['product_code_3']);
        }

        if ($where['product_code_list']) {
            $product_code_list = explode(",", $where['product_code_list']);
            $cnt_code = 1;
            $builder->groupStart();
            foreach ($product_code_list as $code) {
                if ($cnt_code > 1) {
                    $builder->orLike('product_code_list', $code);
                } else {
                    $builder->like('product_code_list', $code);
                }
                $cnt_code++;
            }
            $builder->groupEnd();
        }

        if ($where['search_product_name']) {
            $builder->like('product_name', $where['search_product_name']);
        }

        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            }
        }
        if ($where['is_view'] != "") {
            $builder->where("is_view", $where['is_view']);
        }

        if ($where['special_price'] != "") {
            $builder->where("special_price", $where['special_price']);
        }

        if ($where['product_status'] != "") {
            $builder->where("product_status", $where['product_status']);
        }

        if (!empty($where['departure_code']) && !empty($where['destination_code'])) {
            $builder->where("departure_code", $where['departure_code']);
            $builder->where("destination_code", $where['destination_code']);
        }

        $builder->where("product_status !=", "D");
        $nTotalCount = $builder->countAllResults(false);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['p.product_idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }
        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        foreach ($items as $key => $value) {
            $baht_thai = (float)($setting['baht_thai'] ?? 0);

            $product_price = (float)$value['product_price'];
            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;

            $car_price = (float)$value['car_price'];
            $car_price_won = $car_price * $baht_thai;
            $items[$key]['car_price_won'] = $car_price_won;
        }
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'is_view' => $where['is_view'],
            'product_code_1' => $where['product_code_1'],
            'product_code_2' => $where['product_code_2'],
            'product_code_3' => $where['product_code_3'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }

    public function findProductGolfPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->db->table($this->table . " as pm");
        $builder->select('pm.*');
        if ($where['product_code_1'] != "") {
            $builder->where('product_code_1', $where['product_code_1']);
        }
        if ($where['product_code_2'] != "") {
            $builder->where('product_code_2', $where['product_code_2']);
        }
        if ($where['product_code_3'] != "") {
            $builder->where('product_code_3', $where['product_code_3']);
        }

        if ($where['search_product_name']) {
            $builder->like('product_name', $where['search_product_name']);
        }

        if ($where['search_txt'] != "") {
            if ($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            } else {
                $builder->groupStart();
                $builder->like('product_name', $where['search_txt']);
                $builder->orLike('keyword', $where['search_txt']);
                $builder->groupEnd();
            }
        }

        if (trim($where['arr_search_txt']) != "") {
            $builder->groupStart();

            $str_search_txt = preg_replace('/[^a-zA-Z0-9가-힣\s]+/u', ' ', trim($where['arr_search_txt']));
            $arr_search_txt = preg_split('/\s+/', $str_search_txt);

            foreach ($arr_search_txt as $index => $txt) {

                if ($index > 0) {
                    $builder->orGroupStart();
                }

                $escapedTxt = $this->db->escapeLikeString($txt);
                $builder->like('product_name', $escapedTxt);
                $builder->orLike('keyword', $escapedTxt);

                if ($index > 0) {
                    $builder->groupEnd();
                }
            }
            $builder->groupEnd();
        }

        if ($where['is_view'] != "") {
            $builder->where("is_view", $where['is_view']);
        }

        if ($where['special_price'] != "") {
            $builder->where("special_price", $where['special_price']);
        }

//        if ($where['product_status'] != "") {
//            $builder->where("product_status", $where['product_status']);
//        }

        $currentUrl = current_url();
        $link = '/AdmMaster/';
        if (strpos($currentUrl, $link) === false) {
            $builder->where('product_status != ', 'stop');
        }

        $filter_fields = ['green_peas', 'sports_days', 'slots', 'golf_course_odd_numbers', 'travel_times', 'carts', 'facilities'];

        foreach ($filter_fields as $filter_field) {
            if (!empty($where[$filter_field])) {
                $builder->groupStart();
                foreach ($where[$filter_field] as $key => $value) {
                    $builder->orLike('gi.' . $filter_field, "|$value|");
                }
                $builder->groupEnd();
            }
        }

        $builder->join("tbl_golf_info gi", "gi.product_idx = pm.product_idx", "left");

        $builder->where("product_status !=", "D");
        $nTotalCount = $builder->countAllResults(false);
        $nPage = (int)ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        if ($orderBy == []) {
            $orderBy = ['pm.product_idx' => 'DESC'];
        }

        foreach ($orderBy as $key => $value) {
            $builder->orderBy($key, $value);
        }
        $items = $builder->limit($g_list_rows, $nFrom)->get()->getResultArray();

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $product_price_won = $product_price * $baht_thai;
            $items[$key]['product_price_won'] = $product_price_won;
        }
		
        write_log("golf last- ". $this->db->getLastQuery());
		
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'is_view' => $where['is_view'],
            'product_code_1' => $where['product_code_1'],
            'product_code_2' => $where['product_code_2'],
            'product_code_3' => $where['product_code_3'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }


    public function getKeyWordAll($code_no = null, $g_list_rows = 1000)
    {
        $keyWords = $this->select("keyword");

        if ($code_no) {
            $keyWords = $keyWords->where("product_code_1", $code_no);
        }

        $keyWords = $keyWords->where("is_view", "Y")->where("product_status !=", "D")->get()->getResultArray();
        $keyWordsArray = [];
        foreach ($keyWords as $keyWord) {
            $keyWordStr = $keyWord['keyword'];
            $keyWordArray = explode(",", $keyWordStr);
            foreach ($keyWordArray as $keyWord) {
                $keyWord = trim($keyWord);
                if ($keyWord != "") {
                    $keyWordsArray[] = $keyWord;
                }
            }
        }


        $countedArray = array_count_values($keyWordsArray);
        arsort($countedArray);
        $uniqueArray = array_keys($countedArray);


        return array_slice($uniqueArray, 0, $g_list_rows);
    }

    public function batchUpdate(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_product_mst');

        foreach ($data as $item) {
            $builder->where('product_idx', $item['product_idx']);
            $builder->update([
                'is_view' => $item['is_view'],
                'product_best' => $item['product_best'],
                'special_price' => $item['special_price'],
                'onum' => $item['onum']
            ]);
        }

        return true;
    }

    public function delProductYoil($product_idx)
    {
        $sql = " delete from tbl_product_yoil where product_idx='" . $product_idx . "' ";
        write_log($sql);
        return $this->db->query($sql);
    }

    public function delProductAir($product_idx)
    {
        $sql = " delete from tbl_product_air where product_idx='" . $product_idx . "' ";
        write_log($sql);
        return $this->db->query($sql);
    }

    public function delProductDay($product_idx)
    {
        $sql = " delete from tbl_product_day_detail where product_idx='" . $product_idx . "' ";
        write_log($sql);
        return $this->db->query($sql);
    }

    public function copyProduct($product_idx)
    {
        $info = $this->where("product_idx", $product_idx)->get()->getRowArray();

        unset($info['product_idx']);
        $info['r_date'] = date("Y-m-d H:i:s");
        $info['product_name'] .= "(COPY)";
        $info['product_code'] .= "_COPY";
        $insert_id = $this->insert($info);

        return [
            'insert_id' => $insert_id,
            'info' => $info
        ];
    }

    public function createProductCode($type)
    {
        $prefixLength = strlen($type);
        $todayOrder = $this->select()->where('date(r_date)', date('Y-m-d'))
            ->where("LEFT(product_code, $prefixLength) =", $type)
            ->get()
            ->getResultArray();
        $maxOrderNo = 0;
        foreach ($todayOrder as $key => $value) {
            $no = substr($value['product_code'], -3);
            if ($no > $maxOrderNo) {
                $maxOrderNo = $no;
            }
        }

        $maxOrderNo++;

        $order_no = str_pad($maxOrderNo, 3, "0", STR_PAD_LEFT);
        return $type . date('Ymd') . $order_no;
    }
}