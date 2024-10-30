<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class AdminSpaController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
    }

    public function write_ok()
    {
        try {
            $pg = updateSQ($_POST["pg"] ?? '');
            $search_name = updateSQ($_POST["search_name"] ?? '');
            $search_category = updateSQ($_POST["search_category"] ?? '');
            $upload = "../../data/product/";
            $product_idx = updateSQ($_POST["product_idx"] ?? '');
            $product_code_1 = updateSQ($_POST["product_code_1"] ?? '');
            $product_code_2 = updateSQ($_POST["product_code_2"] ?? '');
            $product_code_3 = updateSQ($_POST["product_code_3"] ?? '');
            $product_code_4 = updateSQ($_POST["product_code_4"] ?? '');
            $product_code_name_1 = updateSQ($_POST["product_code_name_1"] ?? '');
            $product_code_name_2 = updateSQ($_POST["product_code_name_2"] ?? '');
            $product_code_name_3 = updateSQ($_POST["product_code_name_3"] ?? '');
            $product_code_name_4 = updateSQ($_POST["product_code_name_4"] ?? '');
            $product_name = updateSQ($_POST["product_name"] ?? '');
            $product_air = updateSQ($_POST["product_air"] ?? '');
            $product_info = updateSQ($_POST["product_info"] ?? '');
            $product_schedule = updateSQ($_POST["product_schedule"] ?? '');
            $product_country = updateSQ($_POST["product_country"] ?? '');
            $is_view = updateSQ($_POST["is_view"] ?? '');
            $product_period = updateSQ($_POST["product_period"] ?? '');
            $product_manager = updateSQ($_POST["product_manager"] ?? '');
            $product_manager_id = updateSQ($_POST["product_manager_id"] ?? '');
            $original_price = str_replace(",", "", updateSQ($_POST["original_price"]) ?? '');
            $min_price = str_replace(",", "", updateSQ($_POST["min_price"]) ?? '');
            $max_price = str_replace(",", "", updateSQ($_POST["max_price"]) ?? '');
            $keyword = $_POST["keyword"];
            $product_price = str_replace(",", "", updateSQ($_POST["product_price"]) ?? '');
            $product_best = updateSQ($_POST["product_best"] ?? '');
            $onum = updateSQ($_POST["onum"] ?? '');
            $product_contents = updateSQ($_POST["product_contents"] ?? '');

            $product_confirm = updateSQ($_POST["product_confirm"] ?? '');
            $product_confirm_m = updateSQ($_POST["product_confirm_m"] ?? '');
            $product_able = updateSQ($_POST["product_able"] ?? '');
            $product_unable = updateSQ($_POST["product_unable"] ?? '');
            $mobile_able = updateSQ($_POST["mobile_able"] ?? '');
            $mobile_unable = updateSQ($_POST["mobile_unable"] ?? '');
            $special_benefit = updateSQ($_POST["special_benefit"] ?? '');
            $special_benefit_m = updateSQ($_POST["special_benefit_m"] ?? '');
            $notice_comment = updateSQ($_POST["notice_comment"] ?? '');
            $notice_comment_m = updateSQ($_POST["notice_comment_m"] ?? '');
            $etc_comment = updateSQ($_POST["etc_comment"] ?? '');
            $etc_comment_m = updateSQ($_POST["etc_comment_m"] ?? '');
            $main_top_best = updateSQ($_POST["main_top_best"] ?? '');
            $main_theme_best = updateSQ($_POST["main_theme_best"] ?? '');

            $benefit = updateSQ($_POST["benefit"] ?? '');
            $local_info = updateSQ($_POST["local_info"] ?? '');
            $phone = updateSQ($_POST["phone"] ?? '');
            $email = updateSQ($_POST["email"] ?? '');
            $phone_2 = updateSQ($_POST["phone_2"] ?? '');
            $email_2 = updateSQ($_POST["email_2"] ?? '');
            $product_route = updateSQ($_POST["product_route"] ?? '');

            $minium_people_cnt = updateSQ($_POST["minium_people_cnt"] ?? '');
            $total_people_cnt = updateSQ($_POST["total_people_cnt"] ?? '');

            $stay_list = updateSQ($_POST["stay_list"] ?? '');
            $country_list = updateSQ($_POST["country_list"] ?? '');
            $active_list = updateSQ($_POST["active_list"] ?? '');
            $sight_list = updateSQ($_POST["sight_list"] ?? '');
            $tour_period = updateSQ($_POST["tour_period"] ?? '');
            $tour_info = updateSQ($_POST["tour_info"] ?? '');
            $tour_detail = updateSQ($_POST["tour_detail"] ?? '');
            $product_mileage = updateSQ($_POST["product_mileage"] ?? '');

            $exchange = updateSQ($_POST["exchange"] ?? '');
            $jetlag = updateSQ($_POST["jetlag"] ?? '');
            $capital_city = updateSQ($_POST["capital_city"] ?? '');
            $information = updateSQ($_POST["information"] ?? '');
            $meeting_guide = updateSQ($_POST["meeting_guide"] ?? '');
            $meeting_place = updateSQ($_POST["meeting_place"] ?? '');
            $product_level = updateSQ($_POST["product_level"] ?? '');
            $product_option = updateSQ($_POST["product_option"] ?? '');
            $coupon_y = updateSQ($_POST["coupon_y"] ?? '');
            $special_price = updateSQ($_POST["special_price"] ?? '');

            $adult_text = updateSQ($_POST["adult_text"] ?? '');
            $kids_text = updateSQ($_POST["kids_text"] ?? '');
            $baby_text = updateSQ($_POST["baby_text"] ?? '');

            for ($i = 1; $i <= 7; $i++) {
                if (${"del_" . $i} == "Y") {
                    $sql = "
			UPDATE tbl_product_mst SET 
			ufile" . $i . "='',
			rfile" . $i . "=''
			WHERE product_idx='$product_idx'
		";
                    mysqli_query($connect, $sql) or die (mysqli_error($connect));
                } elseif ($_FILES["ufile" . $i]['name']) {
                    $wow = $_FILES["ufile" . $i]['name'];
                    if (no_file_ext($_FILES["ufile" . $i]['name']) != "Y") {
                        echo "NF";
                        exit();
                    }

                    ${"rfile_" . $i} = $wow;
                    $wow2 = $_FILES["ufile" . $i]['tmp_name'];//tmp 폴더의 파일
                    ${"ufile_" . $i} = file_check($wow, $wow2, $upload, "N");
                    if ($product_idx) {
                        $sql = "
					UPDATE tbl_product_mst SET 
					ufile" . $i . "='" . ${"ufile_" . $i} . "',
					rfile" . $i . "='" . ${"rfile_" . $i} . "'
					WHERE product_idx='$product_idx';
				";
                        mysqli_query($connect, $sql) or die (mysqli_error($connect));
                    }
                }
            }
            if ($product_idx) {
                $sql = "
		update tbl_product_mst SET 
			product_code_1			= '" . $product_code_1 . "'
			,product_code_2			= '" . $product_code_2 . "'
			,product_code_3			= '" . $product_code_3 . "'
			,product_code_4			= '" . $product_code_4 . "'
			,product_code_name_1	= '" . $product_code_name_1 . "'
			,product_code_name_2	= '" . $product_code_name_2 . "'
			,product_code_name_3	= '" . $product_code_name_3 . "'
			,product_code_name_4	= '" . $product_code_name_4 . "'
			,product_name			= '" . $product_name . "'
			,product_air			= '" . $product_air . "'
			,product_info			= '" . $product_info . "'
			,product_schedule		= '" . $product_schedule . "'
			,product_country		= '" . $product_country . "'
			,is_view				= '" . $is_view . "'
			,product_period			= '" . $product_period . "'
			,product_manager		= '" . $product_manager . "'
			,product_manager_id		= '" . $product_manager_id . "'		
			,original_price			= '" . $original_price . "'
			,min_price				= '" . $min_price . "'
			,max_price				= '" . $max_price . "'
			,keyword				= '" . $keyword . "'
			,product_price			= '" . $product_price . "'
			,product_best			= '" . $product_best . "'
			,onum					= '" . $onum . "'
			,product_contents		= '" . $product_contents . "' 
			,product_confirm		= '" . $product_confirm . "' 
			,product_confirm_m		= '" . $product_confirm_m . "' 
			,product_able			= '" . $product_able . "'
			,product_unable			= '" . $product_unable . "'
			,mobile_able			= '" . $mobile_able . "'
			,mobile_unable			= '" . $mobile_unable . "'
            ,special_benefit        = '" . $special_benefit . "'
            ,special_benefit_m      = '" . $special_benefit_m . "'
            ,notice_comment         = '" . $notice_comment . "'
            ,notice_comment_m       = '" . $notice_comment_m . "'
            ,etc_comment            = '" . $etc_comment . "'
            ,etc_comment_m          = '" . $etc_comment_m . "'

			,stay_list				= '" . $stay_list . "'
			,country_list			= '" . $country_list . "'
			,active_list			= '" . $active_list . "'
			,sight_list				= '" . $sight_list . "'

			,benefit				= '" . $benefit . "'
			,local_info				= '" . $local_info . "'
			,phone					= '" . $phone . "'
			,email 					= '" . $email . "'
			,product_manager_2		= '" . $product_manager_2 . "'	
			,phone_2				= '" . $phone_2 . "'
			,email_2				= '" . $email_2 . "'

			,product_route			= '" . $product_route . "'
			,minium_people_cnt		= '" . $minium_people_cnt . "'
			,total_people_cnt		= '" . $total_people_cnt . "'
			,tour_period			= '" . $tour_period . "'
			,tour_info				= '" . $tour_info . "'
			,tour_detail			= '" . $tour_detail . "'
			,product_mileage		= '" . $product_mileage . "'
			,exchange				= '" . $exchange . "'
			,jetlag					= '" . $jetlag . "'
			,main_top_best			= '" . $main_top_best . "'
			,main_theme_best		= '" . $main_theme_best . "'
			,capital_city			= '" . $capital_city . "'
			,information			= '" . $information . "'
	        ,meeting_guide          = '" . $meeting_guide . "'
	        ,meeting_place          = '" . $meeting_place . "'
			,product_level			= '" . $product_level . "'
			,product_option         = '" . $product_option . "'
			,coupon_y               = '" . $coupon_y . "'
			,special_price			= '" . $special_price . "'
			,adult_text             = '" . $adult_text . "'
			,kids_text              = '" . $kids_text . "'
			,baby_text              = '" . $baby_text . "'

			,m_date					= now()
		where product_idx = '" . $product_idx . "'
	";
                write_log("상품정보수정 : " . $sql);
                mysqli_query($connect, $sql) or die (mysqli_error($connect));

                $city_idx_str = "";
                for ($i = 0; $i < count($city_idx); $i++) {
                    if ($city_idx[$i] != "") {
                        $city_idx_str = $city_idx_str . $city_idx[$i] . ",";
                    }
                }
                if (strlen($city_idx_str) > 0) {
                    $city_idx_str = substr($city_idx_str, 0, strlen($city_idx_str) - 1);
                    $sql = "
			delete from tbl_product_city 
			where city_idx not in (" . $city_idx_str . ") and product_idx = '" . $product_idx . "'
		";
                    //write_log("도시별 좌표정리 : ".$sql);
                    mysqli_query($connect, $sql) or die (mysqli_error($connect));
                }
                for ($i = 0; $i < count($city_idx); $i++) {
                    if ($city_idx[$i] == "") {
                        $sql = "
				insert into tbl_product_city SET 
					product_idx		= '" . $product_idx . "'
					,city_name		= '" . $city_name[$i] . "'
					,city_lat		= '" . $city_lat[$i] . "'
					,city_lng		= '" . $city_lng[$i] . "'
					,r_date			= now()
			";
                        //write_log("도시별 좌표입력 : ".$sql);
                        mysqli_query($connect, $sql) or die (mysqli_error($connect));
                    } else {
                        $sql = "
				update tbl_product_city SET 
					product_idx		= '" . $product_idx . "'
					,city_name		= '" . $city_name[$i] . "'
					,city_lat		= '" . $city_lat[$i] . "'
					,city_lng		= '" . $city_lng[$i] . "'
					where city_idx	= '" . $city_idx[$i] . "'
			";
                        //write_log("도시별 좌표수정 : ".$sql);
                        mysqli_query($connect, $sql) or die (mysqli_error($connect));
                    }
                    echo $sql . "<br>";
                }


            } else {
                $sql = "
		insert into tbl_product_mst SET 
			product_idx				= '" . $product_idx . "'
			,product_code_1			= '" . $product_code_1 . "'
			,product_code_2			= '" . $product_code_2 . "'
			,product_code_3			= '" . $product_code_3 . "'
			,product_code_4			= '" . $product_code_4 . "'
			,product_code_name_1	= '" . $product_code_name_1 . "'
			,product_code_name_2	= '" . $product_code_name_2 . "'
			,product_code_name_3	= '" . $product_code_name_3 . "'
			,product_code_name_4	= '" . $product_code_name_4 . "'
			,product_name			= '" . $product_name . "'
			,product_air			= '" . $product_air . "'
			,product_info			= '" . $product_info . "'
			,product_schedule		= '" . $product_schedule . "'
			,product_country		= '" . $product_country . "'
			,rfile1					= '" . $rfile_1 . "'
			,rfile2					= '" . $rfile_2 . "'
			,rfile3					= '" . $rfile_3 . "'
			,rfile4					= '" . $rfile_4 . "'
			,rfile5					= '" . $rfile_5 . "'
			,rfile6					= '" . $rfile_6 . "'
			,ufile1					= '" . $ufile_1 . "'
			,ufile2					= '" . $ufile_2 . "'
			,ufile3					= '" . $ufile_3 . "'
			,ufile4					= '" . $ufile_4 . "'
			,ufile5					= '" . $ufile_5 . "'
			,ufile6					= '" . $ufile_6 . "'
			,ufile7					= '" . $ufile_7 . "'
			,is_view				= '" . $is_view . "'
			,product_period			= '" . $product_period . "'
			,product_manager		= '" . $product_manager . "'
			,product_manager_id		= '" . $product_manager_id . "'		
			,original_price			= '" . $original_price . "'
			,keyword				= '" . $keyword . "'
			,product_price			= '" . $product_price . "'
			,product_best			= '" . $product_best . "'
			,onum					= '" . $onum . "'
			,product_contents		= '" . $product_contents . "'
			,min_price				= '" . $min_price . "'
			,max_price				= '" . $max_price . "'
			,product_able			= '" . $product_able . "'
			,product_unable			= '" . $product_unable . "'
			,mobile_able			= '" . $mobile_able . "'
			,mobile_unable			= '" . $mobile_unable . "'
            ,notice_comment         = '" . $notice_comment . "'
            ,notice_comment_m       = '" . $notice_comment_m . "'
            ,etc_comment            = '" . $etc_comment . "'
            ,etc_comment_m          = '" . $etc_comment_m . "'

			,stay_list				= '" . $stay_list . "'
			,country_list			= '" . $country_list . "'
			,active_list			= '" . $active_list . "'
			,sight_list				= '" . $sight_list . "'
			,tour_period			= '" . $tour_period . "'
			,tour_info				= '" . $tour_info . "'
			,tour_detail			= '" . $tour_detail . "'

			,benefit				= '" . $benefit . "'
			,local_info				= '" . $local_info . "'
			,phone					= '" . $phone . "'
			,email 					= '" . $email . "'
			,product_manager_2		= '" . $product_manager_2 . "'	
			,phone_2				= '" . $phone_2 . "'
			,email_2				= '" . $email_2 . "'
			,product_route			= '" . $product_route . "'
			,minium_people_cnt		= '" . $minium_people_cnt . "'
			,total_people_cnt		= '" . $total_people_cnt . "'

			,exchange				= '" . $exchange . "'
			,jetlag					= '" . $jetlag . "'
			,capital_city			= '" . $capital_city . "'

			,user_id				= '" . $_SESSION[member][id] . "'
			,user_level				= '" . $_SESSION[member][level] . "'
			,information			= '" . $information . "'
	        ,meeting_guide          = '" . $meeting_guide . "'
	        ,meeting_place          = '" . $meeting_place . "'
			,product_level			= '" . $product_level . "'
			,product_option         = '" . $product_option . "'
			,coupon_y               = '" . $coupon_y . "'
			,special_price			= '" . $special_price . "'
			,adult_text             = '" . $adult_text . "'
			,kids_text              = '" . $kids_text . "'
			,baby_text              = '" . $baby_text . "'

			,m_date					= now()
			,r_date					= now()
	";
                //write_log("상품정보입력 : ".$sql);
                mysqli_query($connect, $sql) or die (mysqli_error($connect));

                $product_idx = mysqli_insert_id($connect);

                $sql = "
		update tbl_product_mst SET 
			product_code = 'T" . str_pad($product_idx, 5, "0", STR_PAD_LEFT) . "'
			where product_idx = '" . $product_idx . "'
	";
                //write_log("여행정보코드입력 : ".$sql);
                mysqli_query($connect, $sql) or die (mysqli_error($connect));

                for ($i = 0; $i < count($city_name); $i++) {
                    $sql = "
			insert into tbl_product_city SET 
				product_idx		= '" . $product_idx . "'
				,city_name		= '" . $city_name[$i] . "'
				,city_lat		= '" . $city_lat[$i] . "'
				,city_lng		= '" . $city_lng[$i] . "'
				,r_date			= now()
		";
                    //write_log("도시별 좌표입력 : ".$sql);
                    mysqli_query($connect, $sql) or die (mysqli_error($connect));
                    //echo $sql;
                }
            }

            if ($product_idx) {
                $message = "수정되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.reload();
                    </script>";
            } else {
                $message = "등록되었습니다.";
                return "<script>
                    alert('$message');
                        parent.location.href='/AdmMaster/_tourRegist/list_spas';
                    </script>";
            }
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function get_code()
    {
        try {
            $depth = $this->request->getVar('depth');
            $parent_code_no = $this->request->getVar('parent_code_no');

            try {
                $sql = "SELECT * FROM tbl_code WHERE depth = ? AND parent_code_no = ? AND status = 'Y'";
                $query = $this->connect->query($sql, [$depth, $parent_code_no]);
                $results = $query->getResultArray();

                if (count($results) > 0) {
                    return $this->response->setJSON($results);
                }

                return $this->response->setJSON(['message' => '데이터를 찾을 수 없습니다']);
            } catch (\Exception $e) {
                return $this->response->setJSON(['error' => $e->getMessage()]);
            }
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function prod_update()
    {
        try {
            $product_idx = $_POST['product_idx'] ?? '';
            $product_best = $_POST['product_best'] ?? '';
            $special_price = $_POST['special_price'] ?? '';
            $is_view = $_POST['is_view'] ?? '';
            $onum = $_POST['onum'] ?? '';

            $sql = " UPDATE tbl_product_mst SET product_best = '$product_best', special_price = '$special_price', is_view = '$is_view', onum = '$onum' WHERE product_idx = '$product_idx' ";

            $result = $this->connect->query($sql);
            if ($result) {
                $msg = "수정 되었습니다!";
            } else {
                $msg = "수정 오류!";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function del()
    {
        try {
            if (!isset($_POST['product_idx'])) {
                return $this->response
                    ->setStatusCode(400)
                    ->setJSON(
                        [
                            'status' => 'error',
                            'error' => '제품 ID가 설정되지 않았습니다!'
                        ]
                    );
            };

            $sql = '';
            $connect = $this->connect;
            $product_idx = $_POST['product_idx'];
            for ($i = 0; $i < count($product_idx); $i++) {
                $sql1 = $sql . " delete from tbl_product_mst where product_idx=" . $product_idx[$i] . " ";
                $db1 = $connect->query($sql1);
                if (!$db1) {
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(
                            [
                                'status' => 'error',
                                'error' => '오류가 발생했습니다. 다시 시도해 주세요!'
                            ]
                        );
                }

                $sql1 = $sql . " delete from tbl_product_yoil where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);

                $sql1 = $sql . " delete from tbl_product_air where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);

                $sql1 = $sql . " delete from tbl_product_day_detail where product_idx='" . $product_idx[$i] . "' ";
                $db2 = $connect->query($sql1);
            }
            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => '삭제 성공!'
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function ajax_change()
    {
        try {
            $code_idx = $this->request->getPost('code_idx');
            $onum = $this->request->getPost('onum');
            $is_view = $this->request->getPost('is_view');
            $product_best = $this->request->getPost('product_best');
            $special_price = $this->request->getPost('special_price');
            $tot = count($code_idx);
            $result = null;
            for ($j = 0; $j < $tot; $j++) {
                $sql = " update tbl_product_mst set is_view = '" . $is_view[$j] . "' , product_best = '" . $product_best[$j] . "' , special_price = '" . $special_price[$j] . "' , onum='" . $onum[$j] . "' where product_idx='" . $code_idx[$j] . "'";

                $result = $this->connect->query($sql);
            }

            if ($result) {
                $msg = "수정 되었습니다!";
            } else {
                $msg = "순위조정 오류!";
            }

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function change_manager()
    {
        try {
            $msg = '';

            $private_key = private_key();

            $user_id = $_POST['user_id'];

            $sql = " SELECT AES_DECRYPT(UNHEX(user_name), '$private_key') AS user_name
                    ,AES_DECRYPT(UNHEX(user_phone), '$private_key') AS user_phone
                    ,AES_DECRYPT(UNHEX(user_email), '$private_key') AS user_email
            FROM tbl_member WHERE user_id = '$user_id'";

            $result = $this->connect->query($sql);

            $row = $result->getRowArray();

            $resultArr['user_name'] = $row["user_name"];
            $resultArr['user_phone'] = $row["user_phone"];
            $resultArr['user_email'] = $row["user_email"];

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'data' => $row,
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function add_moption()
    {
        try {
            $product_idx = $_POST['product_idx'];
            $moption_name = $_POST['moption_name'];

            $sql = "INSERT INTO tbl_tours_moption SET  product_idx  = '$product_idx'
                                        	 , moption_name = '$moption_name'
                                        	 , use_yn       = 'Y' 
											 , rdate        =  now() ";

            $this->connect->query($sql);

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function upd_moption()
    {
        try {
            $code_idx = $_POST['code_idx'];
            $moption_name = $_POST['moption_name'];

            $sql = "UPDATE tbl_tours_moption SET moption_name = '$moption_name' WHERE code_idx = '$code_idx' ";

            $this->connect->query($sql);

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del_moption()
    {
        try {
            $code_idx = $_POST['code_idx'];

            $sql = "DELETE FROM tbl_tours_moption WHERE code_idx = '$code_idx' ";

            $this->connect->query($sql);

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function add_option()
    {
        try {
            $code_idx = $_POST['code_idx'];
            $product_idx = $_POST['product_idx'];
            $option_cnt = count($_POST['o_name']);

            $sql = "delete from tbl_tours_option where code_idx = '" . $code_idx . "'  and product_idx = '" . $product_idx . "' ";

            $this->connect->query($sql);

            for ($i = 0; $i < $option_cnt; $i++) {
                $option_name = $_POST['o_name'][$i];
                $option_price = $_POST['o_price'][$i];
                $use_yn = $_POST['use_yn'][$i];
                $onum = $_POST['o_num'][$i];

                if ($option_name && $option_price) {
                    $sql = "insert into tbl_tours_option set   code_idx     = '$code_idx'  
													 , product_idx  = '$product_idx' 
													 , option_name  = '$option_name'
													 , option_price = '$option_price'
													 , use_yn       = '$use_yn'
													 , onum         = '$onum'
													 , rdate        =  now()		  
				   ";

                    $this->connect->query($sql);
                }
            }

            $msg = "등록 완료.";

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function del_option()
    {
        try {
            $msg = "등록 완료.";

            $idx = $_POST['idx'];

            $sql = "DELETE FROM tbl_tours_option  WHERE idx = '$idx' ";

            $this->connect->query($sql);

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function upd_option()
    {
        try {
            $msg = "등록 완료.";

            $idx = $_POST['idx'];
            $option_name = $_POST['option_name'];
            $option_price = $_POST['option_price'];
            $use_yn = $_POST['use_yn'];
            $onum = $_POST['onum'];

            $sql = "UPDATE tbl_tours_option SET   option_name  = '$option_name'
										, option_price = '$option_price'
										, use_yn       = '$use_yn'
	                                    , onum         = '$onum'
	                                    WHERE      idx = '$idx' ";

            $this->connect->query($sql);

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }

    public function img_remove()
    {
        try {
            $msg = '';

            return $this->response->setStatusCode(200)
                ->setJSON([
                    'status' => 'success',
                    'message' => $msg
                ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(
                    [
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ]
                );
        }
    }
}
