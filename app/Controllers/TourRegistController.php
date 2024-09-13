<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class TourRegistController extends BaseController
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
        $data = $this->get_list_('1324');
        return view("admin/_tourRegist/list", $data);
    }

    public function list_honeymoon()
    {
        $data = $this->get_list_('1320');
        return view("admin/_tourRegist/list", $data);
    }

    public function list_tours()
    {
        $data = $this->get_list_('1317');
        return view("admin/_tourRegist/list", $data);
    }

    public function list_golfs()
    {
        $data = $this->get_list_('1325');
        return view("admin/_tourRegist/list", $data);
    }

    private function get_list_($product_code_1)
    {
        $g_list_rows = 10;
        $pg = updateSQ($_GET["pg"] ?? "");
        if ($pg == "") $pg = 1;
        $search_name = updateSQ($_GET["search_name"] ?? "");
        $search_category = updateSQ($_GET["search_category"] ?? "");

        $product_code_2 = updateSQ($_GET["product_code_2"] ?? "");
        $product_code = updateSQ($_GET["product_code"] ?? "");
        $product_code_3 = updateSQ($_GET["product_code_3"] ?? "");
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? "");
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? "");
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? "");
        $date_chker = updateSQ($_GET["date_chker"] ?? "");
        $s_date = updateSQ($_GET["s_date"] ?? "");
        $e_date = updateSQ($_GET["e_date"] ?? "");
        $s_time = updateSQ($_GET["s_time"] ?? "");
        $e_time = updateSQ($_GET["e_time"] ?? "");
        $is_view_y = $_GET["is_view_y"] ?? "";
        $is_view_n = $_GET["is_view_n"] ?? "";
        $best = $_GET["best"] ?? "";
        $orderBy = $_GET["orderBy"] ?? "";
        if ($orderBy == "") $orderBy = 1;

        $search_val = "?product_code_1=" . $product_code_1;
        $search_val .= "&product_code=" . $product_code;
        $search_val .= "&product_code_2=" . $product_code_2;
        $search_val .= "&product_code_3=" . $product_code_3;
        $search_val .= "&is_view_y=" . $is_view_y;
        $search_val .= "&is_view_n=" . $is_view_n;
        $search_val .= "&best=" . $best;
        $search_val .= "&s_date=" . $s_date;
        $search_val .= "&e_date=" . $e_date;
        $search_val .= "&s_time=" . $s_time;
        $search_val .= "&e_time=" . $e_time;
        $search_val .= "&search_category=" . $search_category;
        $search_val .= "&search_name=" . $search_name;
        $search_val .= "&orderBy=" . $orderBy;

        $strSql = "";

        if ($is_view_y == "Y") {
            $strSql = $strSql . " and is_view = 'Y' ";
        }

        if ($is_view_n == "Y") {
            $strSql = $strSql . " and is_view = 'N' ";
        }

        if ($best == "Y") {
            $strSql = $strSql . " and product_best = 'Y' ";
        }

        if ($search_name) {
            $strSql = $strSql . " and replace(" . $search_category . ",'-','') like '%" . str_replace("-", "", $search_name) . "%' ";
        }

        if ($product_code_1) {
            $strSql = $strSql . " and product_code_1 = '" . $product_code_1 . "' ";
        }
        if ($product_code_2) {
            $strSql = $strSql . " and product_code_2 = '" . $product_code_2 . "' ";
        }
        if ($product_code_3) {
            $strSql = $strSql . " and product_code_3 = '" . $product_code_3 . "' ";
        }

        $total_sql = " 
					SELECT p1.*, c1.code_name AS product_code_name_1, c2.code_name AS product_code_name_2 FROM tbl_product_mst AS p1 
						LEFT JOIN tbl_code AS c1 ON p1.product_code_1 = c1.code_no
						LEFT JOIN tbl_code AS c2 ON c2.code_no = p1.product_code_2  where 1=1 $strSql group by p1.product_idx ";


        $result = $this->connect->query($total_sql) or die ($this->connect->error);
        $nTotalCount = $result->getNumRows();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1324' and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult3 = $fresult3->getResultArray();

        $order = " onum desc ";
        if ($orderBy == "1") $order = " onum desc ";
        if ($orderBy == "2") $order = " r_date desc ";
        if ($orderBy == "3") {
            $order = " deposit_cnt desc ";
        }

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $sql = $total_sql . " order by $order limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql) or die ($this->connect->error);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();

        $data = [
            "fresult" => $fresult,
            "fresult2" => $fresult2,
            "fresult3" => $fresult3,
            "num" => $num,
            "nPage" => $nPage,
            "pg" => $pg,
            "g_list_rows" => $g_list_rows,
            "search_val" => $search_val,
            "nTotalCount" => $nTotalCount,
            "result" => $result,
            "orderBy" => $orderBy,
            "best" => $best,
            "is_view_n" => $is_view_n,
            "search_name" => $search_name,
            "product_code_1" => $product_code_1,
            "product_code_2" => $product_code_2,
            "product_code_3" => $product_code_3,
            "s_product_code_1" => $s_product_code_1,
            "s_product_code_2" => $s_product_code_2,
            "s_product_code_3" => $s_product_code_3,
            "is_view_y" => $is_view_y,
            "search_category" => $search_category,
        ];

        return $data;
    }

    public function write()
    {
        $product_idx = updateSQ($_GET["product_idx"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');
        $search_name = updateSQ($_GET["search_name"] ?? '');
        $search_category = updateSQ($_GET["search_category"] ?? '');
        $product_code_1 = "1324";
        $product_code_2 = updateSQ($_GET["product_code_2"] ?? "");
        $product_code = updateSQ($_GET["product_code"] ?? "");
        $product_code_3 = updateSQ($_GET["product_code_3"] ?? "");
        $s_product_code_1 = updateSQ($_GET["s_product_code_1"] ?? "");
        $s_product_code_2 = updateSQ($_GET["s_product_code_2"] ?? "");
        $s_product_code_3 = updateSQ($_GET["s_product_code_3"] ?? "");
        $titleStr = '';
        $orderBy = $_GET["orderBy"] ?? "";
        if ($orderBy == "") $orderBy = 1;

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='2' and code_no = '1324' and status='Y' order by onum desc, code_idx desc";
        $fresult = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult = $fresult->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='3' and parent_code_no='" . $product_code_1 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult2 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult2 = $fresult2->getResultArray();

        $fsql = "select * from tbl_code where code_gubun='tour' and depth='4' and parent_code_no='" . $product_code_2 . "' and status='Y'  order by onum desc, code_idx desc";
        $fresult3 = $this->connect->query($fsql) or die ($this->connect->error);
        $fresult3 = $fresult3->getResultArray();
        $row = null;

        if ($product_idx) {
            $sql = " select * from tbl_product_mst where product_idx = '" . $product_idx . "'";
            $row = $this->connect->query("$sql")->getResultArray()[0];
            $product_code_1 = $row["product_code_1"];
            $product_code_2 = $row["product_code_2"];
            $product_code_3 = $row["product_code_3"];
            $product_code_4 = $row["product_code_4"];
            $product_code_name_1 = $row["product_code_name_1"];
            $product_code_name_2 = $row["product_code_name_2"];
            $product_code_name_3 = $row["product_code_name_3"];
            $product_code_name_4 = $row["product_code_name_4"];
            $min_price = $row["min_price"];
            $max_price = $row["max_price"];
            $ufile1 = $row["ufile1"];
            $rfile1 = $row["rfile1"];
            $ufile2 = $row["ufile2"];
            $rfile2 = $row["rfile2"];
            $ufile3 = $row["ufile3"];
            $rfile3 = $row["rfile3"];
            $ufile4 = $row["ufile4"];
            $rfile4 = $row["rfile4"];
            $ufile5 = $row["ufile5"];
            $rfile5 = $row["rfile5"];
            $ufile6 = $row["ufile6"];
            $rfile6 = $row["rfile6"];
            $ufile7 = $row["ufile7"];
            $rfile7 = $row["rfile7"];
            $product_name = $row["product_name"];
            $product_air = $row["product_air"];
            $product_info = $row["product_info"];
            $product_schedule = $row["product_schedule"];
            $product_country = $row["product_country"];
            $is_view = $row["is_view"];
            $product_period = $row["product_period"];
            $product_manager = $row["product_manager"];
            $product_manager_2 = $row["product_manager_2"];
            $original_price = $row["original_price"];
            $keyword = $row["keyword"];
            $product_price = $row["product_price"];
            $product_best = $row["product_best"];
            $onum = $row["onum"];
            $product_contents = $row["product_contents"];
            $product_confirm = $row["product_confirm"];
            $product_confirm_m = $row["product_confirm_m"];
            $product_able = $row["product_able"];
            $product_unable = $row["product_unable"];
            $mobile_able = $row["mobile_able"];
            $mobile_unable = $row["mobile_unable"];
            $special_benefit = $row["special_benefit"];
            $special_benefit_m = $row["special_benefit_m"];
            $notice_comment = $row["notice_comment"];
            $notice_comment_m = $row["notice_comment_m"];
            $etc_comment = $row["etc_comment"];
            $etc_comment_m = $row["etc_comment_m"];

            $tour_info = $row["tour_info"];
            $tour_detail = $row["tour_detail"];

            $benefit = $row["benefit"];
            $local_info = $row["local_info"];
            $phone = $row["phone"];
            $email = $row["email"];
            $phone_2 = $row["phone_2"];
            $email_2 = $row["email_2"];
            $product_route = $row["product_route"];
            $minium_people_cnt = $row["minium_people_cnt"];
            $total_people_cnt = $row["total_people_cnt"];
            $stay_list = $row["stay_list"];
            $country_list = $row["country_list"];
            $active_list = $row["active_list"];
            $sight_list = $row["sight_list"];
            $tour_period = $row["tour_period"];
            $product_mileage = $row["product_mileage"];
            $exchange = $row["exchange"];
            $jetlag = $row["jetlag"];
            $capital_city = $row["capital_city"];
            $information = $row["information"];
            $meeting_guide = $row["meeting_guide"];
            $meeting_place = $row["meeting_place"];
            $product_option = $row["product_option"];
            $coupon_y = $row["coupon_y"];
            $product_manager_id = $row["product_manager_id"];

            $m_date = $row["m_date"];
            $r_date = $row["r_date"];
        }


        $private_key = '';
        $sql = "select user_id, AES_DECRYPT(UNHEX(user_name), '$private_key') AS user_name from tbl_member where user_level = '2'";
        $mresult = $this->connect->query($sql)->getResultArray();

        $sql_o = " select * from tbl_product_option where status != 'N' ";
        $oresult = $this->connect->query($sql_o)->getResultArray();

        $sql_l = " select * from tbl_product_level where status != 'N' ";
        $lresult = $this->connect->query($sql_l)->getResultArray();

        $sql_m = " select * from tbl_homeset where idx='1' ";
        $mresult2 = $this->connect->query($sql_m)->getResultArray();

        $yoil_html = $this->get_yoil($product_idx);

        $fsql = "select air_code_1, air_code_2, code_name
											, (select ifnull(total_day,0)  as cnt from tbl_product_day_detail where tbl_product_day_detail.air_code=a.air_code_1 and product_idx = '" . $product_idx . "') as cnt
											from tbl_product_air a, tbl_code b, tbl_product_yoil c 
											where a.air_code_1 = b.code_no and a.product_idx = '" . $product_idx . "' 
											and a.yoil_idx=c.yoil_idx
										group by 	air_code_1, code_name
										order by 	c.r_date desc
										";
        $fresult4 = $this->connect->query($fsql)->getResultArray();
        $fTotalresult4 = count($fresult4);

        return view("admin/_tourRegist/write", [
            "product_idx" => $product_idx,
            "product_code" => $product_code,
            "row" => $row,
            "titleStr" => $titleStr,
            "pg" => $pg,
            "orderBy" => $orderBy,
            "s_date" => '',
            "e_date" => '',
            "s_time" => '',
            "e_time" => '',
            "fTotalresult4" => $fTotalresult4,
            "search_name" => $search_name,
            "search_category" => $search_category,
            "product_code_1" => $product_code_1,
            "product_code_2" => $product_code_2,
            "product_code_3" => $product_code_3,
            "s_product_code_1" => $s_product_code_1,
            "s_product_code_2" => $s_product_code_2,
            "s_product_code_3" => $s_product_code_3,
            "fresult" => $fresult,
            "fresult2" => $fresult2,
            "fresult3" => $fresult3,
            "fresult4" => $fresult4,
            "yoil_html" => $yoil_html,
            "member_list" => $mresult,
            "oresult" => $oresult,
            "lresult" => $lresult,
            "mresult2" => $mresult2,
            "product_code_4" => $product_code_4 ?? '',
            "product_code_name_1" => $product_code_name_1 ?? '',
            "product_code_name_2" => $product_code_name_2 ?? '',
            "product_code_name_3" => $product_code_name_3 ?? '',
            "product_code_name_4" => $product_code_name_4 ?? '',
            "min_price" => $min_price ?? '',
            "max_price" => $max_price ?? '',
            "ufile1" => $ufile1 ?? '',
            "rfile1" => $rfile1 ?? '',
            "ufile2" => $ufile2 ?? '',
            "rfile2" => $rfile2 ?? '',
            "ufile3" => $ufile3 ?? '',
            "rfile3" => $rfile3 ?? '',
            "ufile4" => $ufile4 ?? '',
            "rfile4" => $rfile4 ?? '',
            "ufile5" => $ufile5 ?? '',
            "rfile5" => $rfile5 ?? '',
            "ufile6" => $ufile6 ?? '',
            "rfile6" => $rfile6 ?? '',
            "ufile7" => $ufile7 ?? '',
            "rfile7" => $rfile7 ?? '',
            "product_name" => $product_name ?? '',
            "product_air" => $product_air ?? '',
            "product_info" => $product_info ?? '',
            "product_schedule" => $product_schedule ?? '',
            "product_country" => $product_country ?? '',
            "is_view" => $is_view ?? '',
            "product_period" => $product_period ?? '',
            "product_manager" => $product_manager ?? '',
            "product_manager_2" => $product_manager_2 ?? '',
            "original_price" => $original_price ?? '',
            "keyword" => $keyword ?? '',
            "product_price" => $product_price ?? '',
            "product_best" => $product_best ?? '',
            "onum" => $onum ?? '',
            "product_contents" => $product_contents ?? '',
            "product_confirm" => $product_confirm ?? '',
            "product_confirm_m" => $product_confirm_m ?? '',
            "product_able" => $product_able ?? '',
            "product_unable" => $product_unable ?? '',
            "mobile_able" => $mobile_able ?? '',
            "mobile_unable" => $mobile_unable ?? '',
            "special_benefit" => $special_benefit ?? '',
            "special_benefit_m" => $special_benefit_m ?? '',
            "notice_comment" => $notice_comment ?? '',
            "notice_comment_m" => $notice_comment_m ?? '',
            "etc_comment" => $etc_comment ?? '',
            "etc_comment_m" => $etc_comment_m ?? '',
            "tour_info" => $tour_info ?? '',
            "tour_detail" => $tour_detail ?? '',
            "benefit" => $benefit ?? '',
            "local_info" => $local_info ?? '',
            "phone" => $phone ?? '',
            "email" => $email ?? '',
            "phone_2" => $phone_2 ?? '',
            "email_2" => $email_2 ?? '',
            "product_route" => $product_route ?? '',
            "minium_people_cnt" => $minium_people_cnt ?? '',
            "total_people_cnt" => $total_people_cnt ?? '',
            "stay_list" => $stay_list ?? '',
            "country_list" => $country_list ?? '',
            "active_list" => $active_list ?? '',
            "sight_list" => $sight_list ?? '',
            "tour_period" => $tour_period ?? '',
            "product_mileage" => $product_mileage ?? '',
            "exchange" => $exchange ?? '',
            "jetlag" => $jetlag ?? '',
            "capital_city" => $capital_city ?? '',
            "information" => $information ?? '',
            "meeting_guide" => $meeting_guide ?? '',
            "meeting_place" => $meeting_place ?? '',
            "product_option" => $product_option ?? '',
            "coupon_y" => $coupon_y ?? '',
            "product_manager_id" => $product_manager_id ?? '',
            "m_date" => $m_date ?? '',
            "r_date" => $r_date ?? ''
        ]);
    }

    public function detail_admin()
    {
        $idx = updateSQ($_GET['idx']);
        $row = $this->ReviewModel->getReview($idx);
        return view("admin/_review/detail", [
            "row" => $row
        ]);
    }

    public function change_ajax()
    {
        $idx = $this->request->getPost('idx_change');
        $onum = $this->request->getPost('onum');
        $display = $this->request->getPost('display');
        $is_best = $this->request->getPost('is_best');

        $success = true;

        foreach ($idx as $i => $id) {
            $data = [
                'onum' => $onum[$i],
                'display' => $display[$i],
                'is_best' => $is_best[$i]
            ];

            if (!$this->ReviewModel->update($id, $data)) {
                $success = false;
                break;
            }
        }

        $msg = $success ? "순위변경되었습니다." : "순위변경실패!!!";

        return $this->response->setJSON(['message' => $msg]);
    }

    public function del()
    {
        $idx = $this->request->getPost('idx');
        $mode = $this->request->getPost('mode');

        foreach ($idx as $id) {
            $this->ReviewModel->delete($id);
        }

        if ($mode == "view") {
            return $this->response->setBody("<script>
                    alert('삭제처리되었습니다.');
                    parent.history.back();
                  </script>");
        } else {
            return $this->response->setBody('OK');
        }
    }

    public function ajax_del()
    {
        $idx = $this->request->getPost('idx');

        if ($this->ReviewModel->delete($idx)) {
            $msg = "삭제 성공.";
        } else {
            $msg = "삭제 오류.";
        }

        return $this->response->setJSON(['message' => $msg]);
    }

    public function detail_review()
    {
        $idx = updateSQ($_GET["idx"]);

        if ($idx) {
            $total_sql = " select a.*, b.product_name, c.code_name
                        from tbl_travel_review a 
                        LEFT JOIN tbl_product_mst b ON a.product_idx = b.product_idx 
                        LEFT JOIN tbl_code c ON a.travel_type = c.code_no 
                        where a.idx='" . $idx . "'";
            $review = $this->db->query($total_sql)->getRowArray();
            if ($review) {
                return view("review/review_detail", ["review" => $review, "idx" => $idx]);
            } else {
                return view("errors/html/error_404", ["message" => "<a href='/'>마이페이지에 접속된 것가 없는 모든 것이 있습니다. </a>"]);
            }
        } else {
            return view("errors/html/error_404");
        }
    }

    public function write_review()
    {
        $member_Id = session('member.idx');
        $private_key = private_key();
        if (!$member_Id) {
            return "
            <script>
                alert('로그인 필요합니다.');
                location.href = '/member/login.php';
            </script>
        ";
        }
        $sql = "SELECT * FROM tbl_policy_info WHERE policy_code = 'privacy'";
        $privacy = $this->db->query($sql)->getRowArray();

        $sql = "SELECT * FROM tbl_policy_info WHERE policy_code = 'third_paties'";
        $third_paties = $this->db->query($sql)->getRowArray();

        $sql0 = "SELECT * FROM tbl_code WHERE code_no IN('1300', '1320', '1324', '1317', '1325', '1326') AND depth = '2' ORDER BY onum ";
        $list_code = $this->db->query($sql0)->getResultArray();

        $sql_m = "SELECT     birthday
                        , AES_DECRYPT(UNHEX(user_name),   '$private_key') AS user_name
                        , AES_DECRYPT(UNHEX(user_mobile), '$private_key') AS user_mobile
                        , AES_DECRYPT(UNHEX(user_email),  '$private_key') AS user_email
                        , AES_DECRYPT(UNHEX(zip),         '$private_key') AS zip
                        , AES_DECRYPT(UNHEX(addr1),       '$private_key') AS addr1
                        , AES_DECRYPT(UNHEX(addr2),       '$private_key') AS addr2
                            FROM tbl_member WHERE m_Idx = '$member_Id' ";
        $row_m = $this->db->query($sql_m)->getRowArray();

        $email = explode("@", $row_m['user_email']);

        $user_name = $row_m["user_name"];

        $idx = updateSQ($_GET["idx"]);
        $product_idx = updateSQ($_GET["product_idx"]);
        if ($idx) {
            $sql_info = "select t1.*, t2.code_no as travel_type, t3.code_no as travel_type_2, t4.code_no as travel_type_3,
                t2.code_name as travel_type_name, t3.code_name as travel_type_name_2, t4.code_name as travel_type_name_3, t5.product_name
                from tbl_travel_review t1
                left join tbl_code t2 on t1.travel_type = t2.code_no
                left join tbl_code t3 on t1.travel_type_2 = t3.code_no
                left join tbl_code t4 on t1.travel_type_3 = t4.code_no
                left join tbl_product_mst t5 on t1.product_idx = t5.product_idx
                where t1.idx = '$idx'
                ";

            $info = $this->db->query($sql_info)->getRowArray();

            $user_name = sqlSecretConver($info["user_name"], 'decode');
            $user_email = sqlSecretConver($info["user_email"], 'decode');

            $email = explode("@", $user_email);

            $status = $info["status"];
            $is_best = $info["is_best"];
            $ufile1 = $info["ufile1"];
            $rfile1 = $info["rfile1"];
            $ufile2 = $info["ufile2"];
            $rfile2 = $info["rfile2"];
            $r_date = $info["r_date"];
            $travel_type = $info["travel_type"];
            $travel_type_2 = $info['travel_type_2'];
            $travel_type_3 = $info['travel_type_3'];
            $product_idx = $info['product_idx'];
            $title = $info['title'];
            $contents = $info["contents"];
            $travel_type_name = $info['travel_type_name'];
            $travel_type_name_2 = $info['travel_type_name_2'];
            $travel_type_name_3 = $info['travel_type_name_3'];
            $product_name = $info['product_name'];
        } else if ($product_idx) {
            $sql_r = "select a.product_idx,a.product_name, b.code_no as travel_type, c.code_no as travel_type_2, d.code_no as travel_type_3, 
            b.code_name as travel_type_name, c.code_name as travel_type_name_2, d.code_name as travel_type_name_3 
            from tbl_product_mst a
            left join tbl_code b on a.product_code_1 = b.code_no
            left join tbl_code c on a.product_code_2 = c.code_no
            left join tbl_code d on a.product_code_3 = d.code_no
            where b.code_gubun = 'tour' and a.product_idx = '{$product_idx}' ";
            $row_r = $this->db->query($sql_r)->getRowArray();
            $travel_type = $row_r["travel_type"];
            $travel_type_2 = $row_r["travel_type_2"];
            $travel_type_3 = $row_r["travel_type_3"];
            $travel_type_name = $row_r['travel_type_name'];
            $travel_type_name_2 = $row_r['travel_type_name_2'];
            $travel_type_name_3 = $row_r['travel_type_name_3'];
            $product_name = $row_r['product_name'];
        }

        $data = [
            "idx" => $idx,
            "user_name" => $user_name,
            "email" => $email,
            "product_idx" => $product_idx,
            "travel_type" => $travel_type,
            "travel_type_2" => $travel_type_2,
            "travel_type_3" => $travel_type_3,
            "travel_type_name" => $travel_type_name,
            "travel_type_name_2" => $travel_type_name_2,
            "travel_type_name_3" => $travel_type_name_3,
            "product_name" => $product_name,
            "status" => $status,
            "is_best" => $is_best,
            "ufile1" => $ufile1,
            "rfile1" => $rfile1,
            "ufile2" => $ufile2,
            "rfile2" => $rfile2,
            "r_date" => $r_date,
            "title" => $title,
            "contents" => $contents,
            "privacy" => $privacy,
            "third_paties" => $third_paties,
            "list_code" => $list_code
        ];

        return view("review/review_write", $data);
    }

    public function save_review()
    {
        $data = $this->request->getPost();
        $files = [
            "ufile1" => $this->request->getFile("ufile1"),
            "ufile2" => $this->request->getFile("ufile2"),
        ];
        $session = session();
        $role = updateSQText($data['role']);

        $idx = updateSQText($data['idx']);
        $travel_type_2 = updateSQText($data['travel_type_2']);
        $travel_type_3 = updateSQText($data['travel_type_3']);
        $travel_type = updateSQText($data['travel_type']);
        $user_name = updateSQText($data['user_name']);
        $title = updateSQText($data['title']);
        $contents = updateSQ($data['contents']);
        $product_idx = updateSQText($data['product_idx']);
        $user_phone = updateSQ($_POST["user_phone"]);

        if ($role == "admin") {
            $user_email = updateSQ($_POST["user_email"]);
            $status = updateSQ($_POST["status"]);
            $is_best = updateSQ($_POST["is_best"]);
            $display = updateSQ($_POST["display"]);
            $r_date = updateSQ($_POST["r_date"]);
        } else {
            $mail_name = updateSQText($data['mail_name']);
            $mail_host = updateSQText($data['mail_host']);
            $user_email = $mail_name . '@' . $mail_host;
            $status = "Y";
            $is_best = "N";
            $display = "Y";
            $r_date = date("Y-m-d H:i:s");
        }

        $user_phone_string = implode(explode("-", $user_phone));
        $pass = substr($user_phone_string, -4);

        $upload = WRITEPATH . 'uploads/review/';

        $r_file_name1 = $r_file_code1 = $r_file_name2 = $r_file_code2 = null;

        if (isset($files['ufile1']) && $files['ufile1']->isValid()) {
            if (!noFileExt($files['ufile1']->getName())) {
                return 'NF';
            }

            $r_file_name1 = $files['ufile1']->getName();
            $r_file_code1 = $files['ufile1']->getRandomName();
            $files['ufile1']->move($upload, $r_file_code1);
        }

        if (isset($files['ufile2']) && $files['ufile2']->isValid()) {
            if (!noFileExt($files['ufile2']->getName())) {
                return 'NF';
            }

            $r_file_name2 = $files['ufile2']->getName();
            $r_file_code2 = $files['ufile2']->getRandomName();
            $files['ufile2']->move($upload, $r_file_code2);
        }

        if ($idx) {
            $dataToUpdate = [
                'user_name' => sqlSecretConver($user_name, 'encode'),
                'user_email' => sqlSecretConver($user_email, 'encode'),
                'title' => $title,
                'contents' => $contents
            ];

            if ($role == "admin") {
                $dataToUpdate['status'] = $status;
                $dataToUpdate['is_best'] = $is_best;
                $dataToUpdate['display'] = $display;
                $dataToUpdate['r_date'] = $r_date;
                $dataToUpdate['user_phone'] = $user_phone;
            }

            if ($r_file_name1) {
                $dataToUpdate['rfile1'] = $r_file_name1;
                $dataToUpdate['ufile1'] = $r_file_code1;
            }

            if ($r_file_name2) {
                $dataToUpdate['rfile2'] = $r_file_name2;
                $dataToUpdate['ufile2'] = $r_file_code2;
            }

            $this->ReviewModel->update($idx, $dataToUpdate);
            return alert_msg("정상적으로 수정되었습니다.", "/review/review_list");
        } else {
            $dataToInsert = [
                'user_name' => sqlSecretConver($user_name, 'encode'),
                'user_email' => sqlSecretConver($user_email, 'encode'),
                'reg_m_idx' => $session->get('member.idx'),
                'rfile1' => $r_file_name1,
                'ufile1' => $r_file_code1,
                'rfile2' => $r_file_name2,
                'ufile2' => $r_file_code2,
                'product_idx' => $product_idx,
                'travel_type' => $travel_type,
                'travel_type_2' => $travel_type_2,
                'travel_type_3' => $travel_type_3,
                'title' => $title,
                'contents' => $contents,
                'r_date' => $r_date,
                'passwd' => $pass,
                'user_ip' => $_SERVER['REMOTE_ADDR']
            ];

            if ($role == "admin") {
                $dataToInsert['status'] = $status;
                $dataToInsert['is_best'] = $is_best;
                $dataToInsert['display'] = $display;
                $dataToInsert['user_phone'] = $user_phone;
            }

            $this->ReviewModel->insert($dataToInsert);
            return alert_msg("정상적으로 등록되었습니다.", "/review/review_list");
        }
    }

    public function review_delete()
    {
        $idx = $_POST['idx'];

        $db1 = $this->ReviewModel->delete($idx);
        if (!$db1) {
            return "NO";
        }
        return "OK";
    }

    public function get_yoil($product_idx)
    {
        $db = $this->connect;

        $fsql = "SELECT * FROM tbl_product_yoil WHERE product_idx = ? AND depth = '1' ORDER BY r_date DESC";
        $fresult4 = $db->query($fsql, [$product_idx])->getResultArray();

        $html = '<tbody>';

        $i = 1;
        foreach ($fresult4

                 as $frow) {
            $yoilStr = $this->getYoilString($frow);

            $fsql2 = "SELECT a.*, b.* 
                      FROM tbl_product_air a 
                      LEFT JOIN tbl_code b ON a.air_code_1 = b.code_no 
                      LEFT JOIN tbl_code c ON a.air_code_2 = c.code_no 
                      WHERE b.code_gubun = 'air' 
                      AND product_idx = ? 
                      AND yoil_idx = ? 
                      ORDER BY air_idx ASC";
            $fresult2 = $db->query($fsql2, [$product_idx, $frow['yoil_idx']])->getResultArray();

            $i++;
            $html .= "<tr style='height:50px'>
                        <td>{$i}</td>
                        <td class='tac'>{$frow['s_date']}</td>
                        <td class='tac'>{$frow['e_date']}</td>
                        <td class='tac'>
                            <table cellpadding='0' cellspacing='0' class='listTable' style='width:100%' align=center>
                                <colgroup>
                                    <col width='10%'/><col width='10%'/><col width='10%'/><col width='20%'/>
                                    <col width='10%'/><col width='10%'/><col width='10%'/><col width='10%'/><col width='10%'/>
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>항공사</th>
                                        <th>항공편</th>
                                        <th>출발시간</th>
                                        <th>도착시간</th>
                                        <th>비행시간</th>
                                        <th>성인가격</th>
                                        <th>아동가격</th>
                                        <th>유아가격</th>
                                        <th>유류할증료</th>
                                    </tr>";
            foreach ($fresult2 as $frow2) {

//                var_dump($frow2);
//                die();
                $html .= "<tr style='height:40px'>
                            <td>{$frow2['code_name']}</td>
                            <td>{$frow2['air_name_1']}</td>
                            <td>{$frow2['s_air_port_1']} {$frow2['s_air_time_1']}</td>
                            <td>{$frow2['e_air_port_1']} {$frow2['e_air_time_1']}</td>
                            <td>{$frow2['fly_time_1']}</td>
                            <td rowspan='2'>" . number_format($frow2['tour_price'], 0) . "원</td>
                            <td rowspan='2'>" . number_format($frow2['tour_price_kids'], 0) . "원</td>
                            <td rowspan='2'>" . number_format($frow2['tour_price_baby'], 0) . "원</td>
                            <td rowspan='2'>" . number_format($frow2['oil_price'], 0) . "원</td>
                          </tr>";
            }
            $html .= "</thead></table></td><td class='tac'>";

            $sale = '';
            $product_code_1 = '';
            $s_product_code_1 = '';
            $s_product_code_2 = '';
            $s_product_code_3 = '';
            $search_name = '';
            $search_category = '';
            $pg = '';
            $back_url = '';

            if ($product_code_1 == "1301") {
                $html .= getYoil($frow["s_date"]);
            } else {
                $html .= $yoilStr;
            };

            if ($sale == "N") {
                $html .= "<span style='font-weight:bold;color:red;'><br>[예약마감]</span>";
            };


            $html .= "</td><td class='tac'>";

            $html .= $frow["r_date"];
            $html .= "</td><td class='tac'>
                 <a href='" . "../_tourPrice/write?s_product_code_1=" . $s_product_code_1 .
                "&s_product_code_2=" . $s_product_code_2 .
                "&s_product_code_2=" . $s_product_code_3 .
                "&search_name=" . $search_name .
                "&search_category=" . $search_category .
                "&pg=" . $pg .
                "&product_idx=" . $product_idx .
                "&back_url=" . $back_url .
                "&yoil_idx=" . $frow["yoil_idx"] .
                "' class='btn btn-default'>수정하기</a>";
            $html .= "<a href='javascript:del_yoil(" . $frow["yoil_idx"] . ");' class='btn btn -default'>삭제하기</a>";
            $html .= "</td></tr>";
        }

        $html .= ' </tbody > ';

        return $html;
    }


    private function getYoilString($frow)
    {
        $yoilStr = "";
        if ($frow["yoil_0"] == "Y") $yoilStr .= "일, ";
        if ($frow["yoil_1"] == "Y") $yoilStr .= "월, ";
        if ($frow["yoil_2"] == "Y") $yoilStr .= "화, ";
        if ($frow["yoil_3"] == "Y") $yoilStr .= "수, ";
        if ($frow["yoil_4"] == "Y") $yoilStr .= "목, ";
        if ($frow["yoil_5"] == "Y") $yoilStr .= "금, ";
        if ($frow["yoil_6"] == "Y") $yoilStr .= "토, ";
        return rtrim($yoilStr, ", ");
    }
}