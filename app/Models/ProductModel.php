<?php

namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product_mst';

    protected $primaryKey = 'product_idx';

    protected $allowedFields = [
        "product_code", "product_code_1", "product_code_2", "product_code_3", "product_code_4",
        "product_code_name_1", "product_code_name_2", "product_code_name_3", "product_code_name_4", "ufile1",
        "rfile1", "ufile2", "rfile2", "ufile3", "rfile3", "ufile4", "rfile4", "rfile5", "ufile5", "rfile6", "ufile6",
        "rfile7", "ufile7", "product_name", "product_air", "product_info", "product_schedule", "product_country",
        "is_view", "product_period", "product_manager", "product_manager_2", "original_price", "min_price",
        "max_price", "keyword", "product_price", "product_best", "special_price", "product_option", "product_level",
        "onum", "product_contents", "product_confirm", "product_confirm_m", "product_able", "product_unable",
        "mobile_able", "mobile_unable", "special_benefit", "special_benefit_m", "notice_comment", "notice_comment_m",
        "etc_comment", "etc_comment_m", "benefit", "local_info", "phone", "email", "phone_2", "email_2", "product_route",
        "minium_people_cnt", "total_people_cnt", "stay_list", "shopping_list", "sight_list", "country_list", "active_list",
        "tour_period", "tour_info", "tour_detail", "guide_s_date", "guide_e_date", "guide_yoil_0", "guide_yoil_1", "guide_yoil_2",
        "guide_yoil_3", "guide_yoil_4", "guide_yoil_5", "guide_yoil_6", "money_info", "taffic", "guide_unit", "product_price_kids",
        "product_price_baby", "guide_type", "guide_hour", "product_mileage", "exchange", "jetlag", "main_top_best", "main_theme_best",
        "tour_time", "capital_city", "m_date", "r_date", "user_id", "user_level", "information", "meeting_guide", "meeting_place",
        "deposit_cnt", "tours_cate", "yoil_0", "yoil_1", "yoil_2", "yoil_3", "yoil_4", "yoil_5", "yoil_6", "guide_lang", "wish_cnt",
        "order_cnt", "point", "coupon_y", "tour_transport", "adult_text", "kids_text", "baby_text", "product_manager_id", "is_best_value",
        "product_code_list", "product_status", "room_cnt", "addrs", 'product_theme', 'product_bedrooms', 'product_type', 'product_promotions'
    ];

    protected function initialize()
    {
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
                ->orderBy('b.onum', 'DESC')
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

        $builder->where('is_view', 'Y');
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
            ->orderBy('onum', 'desc')
            ->get()
            ->getResultArray();
    }

    public function getProductsByCode($suggest_code, $limit)
    {
        return $this->db->table('tbl_product_mst a')
            ->select('a.*, b.onum, b.code_idx')
            ->join('tbl_main_disp b', 'a.product_idx = b.product_idx')
            ->whereIn('b.code_no', $suggest_code)
            ->orderBy('b.onum', 'desc')
            ->orderBy('b.code_idx', 'desc')
            ->limit($limit)
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
                return "onum DESC";
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
                return "onum DESC";
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

    public function getBestProducts()
    {
        return $this
            ->where('is_view', 'Y')
            ->where('product_best', 'Y')->findAll();
    }

    public function findProductPaging($where = [], $g_list_rows = 1000, $pg = 1, $orderBy = [])
    {
        helper(['setting']);
        $setting = homeSetInfo();
        $builder = $this->builder();
        if ($where['product_code_1'] != "") {
            $builder->where('product_code_1', $where['product_code_1']);
        }
        if ($where['product_code_2'] != "") {
            $builder->where('product_code_2', $where['product_code_2']);
        }
        if ($where['product_code_3'] != "") {
            $builder->where('product_code_3', $where['product_code_3']);
        }

        if($where['product_code_list']) {
            $builder->like('product_code_list', $where['product_code_list']);
        }

        if($where['search_product_name']) {
            $builder->like('product_name', $where['search_product_name']);
        }

        if($where['search_txt'] != "") {
            if($where['search_category'] != "") {
                $builder->like($where['search_category'], $where['search_txt']);
            }
        }
        if ($where['is_view'] != "") {
            $builder->where("is_view", $where['is_view']);
        }

        if($where['special_price'] != "") {
            $builder->where("special_price", $where['special_price']);
        }

        if($where['product_status'] != "") {
            $builder->where("product_status", $where['product_status']);
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

        foreach ($items as $key => $value) {
            $product_price = (float)$value['product_price'];
            $baht_thai = (float)($setting['baht_thai'] ?? 0);
            $product_price_baht = $product_price / $baht_thai;
            $items[$key]['product_price_baht'] = $product_price_baht;
        }
        $data = [
            'items' => $items,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'pg' => (int)$pg,
            'search_txt' => $where['search_txt'],
            'search_category' => $where['search_category'],
            'search_product_name' => $where['search_product_name'],
            'is_view' => $where['is_view'],
            'product_code_1' => $where['product_code_1'],
            'product_code_2' => $where['product_code_2'],
            'product_code_3' => $where['product_code_3'],
            'g_list_rows' => $g_list_rows,
            'num' => $nTotalCount - $nFrom
        ];
        return $data;
    }

    public function getKeyWordAll($code_no)
    {
        $keyWords = $this->select("keyword")->where("product_code_1", $code_no)->get()->getResultArray();
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


        return array_slice($uniqueArray, 0, 20);
    }
}