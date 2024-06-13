<?php

use CodeIgniter\Model;

class Product_model extends Model
{
    protected $table = 'tbl_product_mst';

    protected $primaryKey = 'product_idx';

    protected $allowedFields = [
        'tour_period',
        'product_code',
        'product_code_1',
        'product_code_2',
        'product_code_3',
        'product_code_4',
        'product_code_name_1',
        'product_code_name_2',
        'product_code_name_3',
        'product_code_name_4',
        'ufile1',
        'rfile1',
        'ufile2',
        'rfile2',
        'ufile3',
        'rfile3',
        'ufile4',
        'rfile4',
        'ufile5',
        'rfile5',
        'ufile6',
        'rfile6',
        'ufile7',
        'rfile7',
        'jetlag',
        'exchange',
        'capital_city',
        'information',
        'product_level',
        'product_option',
        'cancel_policy',
        'adult_text',
        'kids_text',
        'baby_text'
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

        return $this->where($code_col, $code_no)
            ->where('is_view', 'Y')
            ->orderBy($order_by)
            ->findAll($perPage, $offset);
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
}
?>