<?php

if (!function_exists('private_key')) {
    function private_key()
    {
        return "gkdlghwn!@12";
    }
}

if (!function_exists('isDateInRange')) {
    function isDateInRange($date, $deadline_date)
    {
        $deadline_date_array = explode(",", $deadline_date);
        $deadline_date_array = array_filter($deadline_date_array, function ($value) {
            return $value;
        });
        $is_date_in_range = false;

        foreach ($deadline_date_array as $value) {
            $date_array = explode("~", $value);
            $dateObj = new DateTime($date);
            $startObj = new DateTime($date_array[0]);
            $endObj = new DateTime($date_array[1]);

            if ($dateObj >= $startObj && $dateObj <= $endObj) {
                $is_date_in_range = true;
            }
        }

        return $is_date_in_range;
    }
}

function getProductPacks($product_idx)
{
    $sql = "SELECT * FROM tbl_product_pack WHERE product_idx = '$product_idx' AND pack_status = 'Y' ORDER BY pack_idx ASC";
    $fresult = db_connect()->query($sql);
    $fresult = $fresult->getResultArray();
    $count = 0;
    $output = '';

    foreach ($fresult as $row) {
        if ($count % 2 == 0) {
            if ($count > 0) {
                $output .= '</div>';
            }
            $output .= '<div class="first-i-below-c first-i-below-c_last-1">';
        }

        $output .= '<div class="left">';
        $output .= '<span class="font-bold lb-bc">' . htmlspecialchars($row['pack_name']) . '</span>';
        $output .= '<div class="label-yellow-bc label-bc">';
        $output .= '<span>시작</span>';
        $output .= '<span>' . htmlspecialchars($row['pack_s_date']) . '</span>';
        $output .= '</div>';
        $output .= '<div class="label-red-bc label-bc">';
        $output .= '<span>종료</span>';
        $output .= '<span>' . htmlspecialchars($row['pack_e_date']) . '</span>';
        $output .= '</div>';
        $output .= '</div>';

        $count++;
    }

    if ($count % 2 != 0) {
        $output .= '</div>';
    }

    return $output;
}


function dowYoil($strdate)
{
    $yoil = array("일", "월", "화", "수", "목", "금", "토");
    $date = $strdate;

    $dow = $yoil[date('w', strtotime($date))];
    return $dow;
}

function getCodeSlice($_tmp_code, $char = "UTF-8")
{
    $_tmp_code = mb_substr($_tmp_code, 1, mb_strlen($_tmp_code) - 2, $char);
    return $_tmp_code;
}

function get_cate_text($code)
{
    $fsql = "select * from tbl_code where code_no='" . $code . "' limit 1";
    $fresult = db_connect()->query($fsql);
    $frow = $fresult->getRowArray();

    if ($frow) {
        $now_cnt = $frow['depth'] - 1;
        $out_txt = $frow['code_name'];
        $parent_code_no = $frow['parent_code_no'];

        while ($now_cnt > 1) {
            $now_cnt--;

            $fsql2 = "select * from tbl_code where code_no='" . $parent_code_no . "' limit 1";
            $fresult2 = db_connect()->query($fsql2);
            $frow2 = $fresult2->getRowArray();
            $parent_code_no = $frow2['parent_code_no'];

            $out_txt = $frow2['code_name'] . " &gt; " . $out_txt;

        }

    }

    return $out_txt ?? '';
}

function getSubMenu($parent_code_no, $urls)
{
    $sub_sql = "SELECT code_name, code_no FROM tbl_code WHERE parent_code_no = '$parent_code_no' AND status = 'Y' ORDER BY onum ASC";
    $sub_result = db_connect()->query($sub_sql);
    $sub_items = $sub_result->getResultArray();

    $sub_html = "<div class='sub_nav_menu'>";
    foreach ($sub_items as $sub_item) {
        $code_no = htmlspecialchars($sub_item['code_no']);
        $code_name = htmlspecialchars($sub_item['code_name']);
        if ($parent_code_no == 1302) {
            $url = "/product-golf/list-golf/$code_no";
        } elseif ($parent_code_no == 1301) {
            $url = "/product-tours/tours-list/$code_no";
        } elseif ($parent_code_no == 1325) {
            $url = "/product-spa/$parent_code_no?keyword=&product_code_2=$code_no";
        } elseif ($parent_code_no == 1317) {
            $url = "/show-ticket/$parent_code_no?keyword=&product_code_2=$code_no";
        } elseif ($parent_code_no == 1320) {
            $url = "/product-restaurant/$parent_code_no?keyword=&product_code_2=$code_no";
        } else {
            $url = $urls[$code_no] ?? "/product-hotel/list-hotel?s_code_no=$code_no";
        }
        $sub_html .= "<a href='$url' class='sub_item'><p>$code_name</p></a>";
    }
    $sub_html .= "</div>";
    return $sub_html;
}

function getSubMenuMo($parent_code_no, $urls)
{
    $sub_sql = "SELECT code_name, code_no FROM tbl_code WHERE parent_code_no = '$parent_code_no' AND status = 'Y' ORDER BY onum ASC";
    $sub_result = db_connect()->query($sub_sql);
    $sub_items = $sub_result->getResultArray();

    $sub_html = "<div class='menu_level_2 flex_b_c'>";
    foreach ($sub_items as $sub_item) {
        $code_no = htmlspecialchars($sub_item['code_no']);
        $code_name = htmlspecialchars($sub_item['code_name']);
        if ($parent_code_no == 1302) {
            $url = "/product-golf/list-golf/$code_no";
        } elseif ($parent_code_no == 1301) {
            $url = "/product-tours/tours-list/$code_no";
        } elseif ($parent_code_no == 1325) {
            $url = "/product-spa/$parent_code_no?keyword=&product_code_2=$code_no";
        } elseif ($parent_code_no == 1317) {
            $url = "/show-ticket/$parent_code_no?keyword=&product_code_2=$code_no";
        } elseif ($parent_code_no == 1320) {
            $url = "/product-restaurant/$parent_code_no?keyword=&product_code_2=$code_no";
        } else {
            $url = $urls[$code_no] ?? "/product-hotel/list-hotel?s_code_no=$code_no";
        }
        $sub_html .= "<a href='$url' class='sub_item'><p>$code_name</p></a>";
    }
    $sub_html .= "</div>";
    return $sub_html;
}

function getCouponList()
{
    $fsql = "SELECT * FROM tbl_coupon_mst WHERE state != 'C' AND exp_end_day > CURDATE() ORDER BY regdate DESC LIMIT 1";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getRowArray();
    $html = '<div class="coupon_sale">';
    $html .= '<img src="/data/coupon/' . $fresult["ufile1"] . '" alt="Coupon">';
    $html .= '<div class="tit_cou">';
    $html .= '<p>' . $fresult["coupon_name"] . '</p>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

function getHeaderTab()
{
    $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '13' AND status = 'Y' ORDER BY onum ASC";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getResultArray();

    $currentUrl = current_url();

    $tabLinks = [
        1303 => [
            "/product-hotel/1303",
            "/product-hotel/list-hotel",
            "/product-hotel/hotel-detail/",
            "/product-hotel/reservation-form",
        ],
        1302 => [
            "/product-golf/1302/1",
            "/product-golf/list-golf/",
            "/product-golf/golf-detail/",
            "/product-golf/customer-form",
        ],
        1301 => [
            "/product-tours/1301",
            "/product-tours/tours-list/",
            "/product-tours/item_view/",
            "/product-tours/confirm-info",
        ],
        1325 => [
            "/product-spa/1325",
            "/product-spa/spa-details/",
            "/product-spa/product-booking",
            "/product-spa/completed-order",
        ],
        1317 => [
            "/show-ticket/1317",
            "/ticket/ticket-detail/",
            "/ticket/ticket-booking",
            "/ticket/completed-order",
        ],
        1320 => [
            "/product-restaurant/1320",
            "/product-restaurant/restaurant-detail/",
            "/product-restaurant/restaurant-booking",
            "/product-restaurant/completed-order",
        ],
        1324 => [
            "/vehicle-guide/132404",
            "/tour-guide/",
            "/guide_view",
            "/guide_booking",
        ],
        // 1326 => [
        //     "/tour-guide/1326",
        //     "/guide_view/",
        // ]
    ];

    $tabLinkMain = [
        1303 => "/product-hotel/1303",
        1302 => "/product-golf/1302/1",
        1301 => "/product-tours/1301",
        1325 => "/product-spa/1325",
        1317 => "/show-ticket/1317",
        1320 => "/product-restaurant/1320",
        1324 => "/vehicle-guide/132404",
        // 1326 => "/tour-guide/1326",
    ];


    $html = "";
    foreach ($fresult as $frow) {
        $tab_ = $frow['code_no'];

        $links = $tabLinks[$tab_];

        $activeClass = "";
        foreach ($links as $link) {
            if (strpos($currentUrl, $link) !== false) {
                $activeClass = "active_";
                break;
            }
        }

        if (array_key_exists($tab_, $tabLinkMain)) {
            $link = $tabLinkMain[$tab_];
        } else {
            $link = "/product-hotel/1303";
        }

        $sub_html = "";

        if ($tab_ == 1303) {
            $sub_html = getSubMenu(1303, []);
        } elseif ($tab_ == 1302) {
            $sub_html = getSubMenu(1302, []);
        } elseif ($tab_ == 1301) {
            $sub_html = getSubMenu(1301, []);
        } elseif ($tab_ == 1325) {
            $sub_html = getSubMenu(1325, []);
        } elseif ($tab_ == 1317) {
            $sub_html = getSubMenu(1317, []);
        } elseif ($tab_ == 1320) {
            $sub_html = getSubMenu(1320, []);
        } elseif ($tab_ == 1324) {
            $sub_html = getSubMenu(1324, [
                '132404' => '/vehicle-guide/132404',
                '132403' => '/tour-guide/132403',
            ]);
        }

        $link = "<a class='$activeClass' href='$link'>" . $frow['code_name'] . "</a>";
        $html .= "<li>" . $link . $sub_html . "</li>";
    }

    return $html;
}

function getHeaderTabMo()
{
    $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '13' AND status = 'Y' ORDER BY onum ASC";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getResultArray();

    $currentUrl = current_url();

    $tabLinks = [
        1303 => [
            "/product-hotel/1303",
            "/product-hotel/list-hotel",
            "/product-hotel/hotel-detail/",
            "/product-hotel/reservation-form",
        ],
        1302 => [
            "/product-golf/1302/1",
            "/product-golf/list-golf/",
            "/product-golf/golf-detail/",
            "/product-golf/customer-form",
        ],
        1301 => [
            "/product-tours/1301",
            "/product-tours/tours-list/",
            "/product-tours/item_view/",
            "/product-tours/confirm-info",
        ],
        1325 => [
            "/product-spa/1325",
            "/product-spa/spa-details/",
            "/product-spa/product-booking",
            "/product-spa/completed-order",
        ],
        1317 => [
            "/show-ticket/1317",
            "/ticket/ticket-detail/",
            "/ticket/ticket-booking",
            "/ticket/completed-order",
        ],
        1320 => [
            "/product-restaurant/1320",
            "/product-restaurant/restaurant-detail/",
            "/product-restaurant/restaurant-booking",
            "/product-restaurant/completed-order",
        ],
        1324 => [
            "/vehicle-guide/132404",
            "/tour-guide/",
            "/guide_view",
            "/guide_booking",
        ],
        // 1326 => [
        //     "/tour-guide/1326",
        //     "/guide_view/",
        // ]
    ];

    $tabLinkMain = [
        1303 => "/product-hotel/1303",
        1302 => "/product-golf/1302/1",
        1301 => "/product-tours/1301",
        1325 => "/product-spa/1325",
        1317 => "/show-ticket/1317",
        1320 => "/product-restaurant/1320",
        1324 => "/vehicle-guide/132404",
        // 1326 => "/tour-guide/1326",
    ];


    $html = "";
    foreach ($fresult as $frow) {
        $tab_ = $frow['code_no'];

        $links = $tabLinks[$tab_];

        $activeClass = "";
        foreach ($links as $link) {
            if (strpos($currentUrl, $link) !== false) {
                $activeClass = "active_";
                break;
            }
        }

        if (array_key_exists($tab_, $tabLinkMain)) {
            $link = $tabLinkMain[$tab_];
        } else {
            $link = "/product-hotel/1303";
        }

        $sub_html = "";

        if ($tab_ == 1303) {
            $sub_html = getSubMenuMo(1303, []);
        } elseif ($tab_ == 1302) {
            $sub_html = getSubMenuMo(1302, []);
        } elseif ($tab_ == 1301) {
            $sub_html = getSubMenuMo(1301, []);
        } elseif ($tab_ == 1325) {
            $sub_html = getSubMenuMo(1325, []);
        } elseif ($tab_ == 1317) {
            $sub_html = getSubMenuMo(1317, []);
        } elseif ($tab_ == 1320) {
            $sub_html = getSubMenuMo(1320, []);
        } elseif ($tab_ == 1324) {
            $sub_html = getSubMenuMo(1324, [
                '132404' => '/vehicle-guide/132404',
                '132403' => '/tour-guide/132403',
            ]);
        }

        $links = "<div class='menu_level_1 flex_b_c'>";
        $links .= "<a class='$activeClass' href='$link'>" . $frow['code_name'] . "</a>";
        $links .= "<img src='/images/ico/gnb_select_ico_m.png' alt='' class='btn_toggle'>";
        $links .= "</div>";
        $html .= "<li class='gnb_menu_item'>" . $links . $sub_html . "</li>";
    }

    return $html;
}

function getHeaderTabSub($code_no = '')
{
    $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '13' AND code_no IN (1303, 1302, 1301) AND status = 'Y' ORDER BY onum ASC";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getResultArray();

    $tabLinks = [
        1303 => "/product-hotel/list-hotel?s_code_no=",
        1302 => "/product-golf/list-golf/",
        1301 => "/product-tours/tours-list/",
    ];


    $html = "";
    foreach ($fresult as $frow) {
        $tab_ = $frow['code_no'];

        $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '$tab_' AND status = 'Y' ORDER BY code_no ASC ";
        $fresult = db_connect()->query($fsql);
        $fresult = $fresult->getRowArray();

        $link = $tabLinks[$tab_] . $fresult['code_no'] ?? "!#";

        $activeClass = ($code_no == $tab_) ? "active_" : "";

        $html .= "<li class='depth_1_item_ $activeClass' data-code='" . $tab_ . "' data-href='$link'>";
        $html .= "<p class=''>" . $frow['code_name'] . "</p>";
        $html .= "</li>";
    }

    return $html;
}

function getHeaderTabSubChild($parent_code_no = '', $code_no = '')
{
    $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '$parent_code_no' AND status = 'Y' ORDER BY onum ASC";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getResultArray();

    $html = "";

    $tabLinks = [
        1303 => "/product-hotel/list-hotel?s_code_no=",
        1302 => "/product-golf/list-golf/",
        1301 => "/product-tours/tours-list/",
    ];

    foreach ($fresult as $frow) {
        $tab_ = $frow['code_no'];

        $activeClass = ($code_no == $tab_) ? "active_" : "";

        $link = $tabLinks[$parent_code_no] . $tab_ ?? "!#";

        $html .= "<li class='depth_2_item_ $activeClass' data-code='" . $tab_ . "'>";
        $html .= "<a href='$link' class=''>" . $frow['code_name'] . "</a>";
        $html .= "</li>";
    }

    return $html;
}

function getHeaderTabSubChildNew($parent_code_no = '', $code_no = '')
{
    $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '$parent_code_no' AND status = 'Y' ORDER BY onum ASC";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getResultArray();

    $html = "";

    $tabLinks = [
        1303 => "/product-hotel/list-hotel?s_code_no=",
        1302 => "/product-golf/list-golf/",
        1301 => "/product-tours/tours-list/",
    ];

    foreach ($fresult as $frow) {
        $tab_ = $frow['code_no'];

        $activeClass = ($code_no == $tab_) ? "active_" : "";

        $link = $tabLinks[$parent_code_no] . $tab_ ?? "!#";

        $html .= "<li class='depth_2_item_new_ $activeClass' data-code='" . $tab_ . "'>";
        $html .= "<a href='$link' class=''>" . $frow['code_name'] . "</a>";
        $html .= "</li>";
    }

    return $html;
}

function getHeaderTabMobile()
{
    $fsql = "SELECT * FROM tbl_code WHERE code_gubun = 'tour' AND parent_code_no = '13' AND status = 'Y' ORDER BY onum ASC";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getResultArray();

    $currentUrl = current_url();

    $tabLinks = [
        1303 => "/product-hotel/1303",
        1302 => "/product-golf/1302/1",
        1301 => "/product-tours/1301",
        1325 => "/product-spa/1325",
        1317 => "/show-ticket/1317",
        1320 => "/product-restaurant/1320",
        1324 => "/vehicle-guide/1324"
    ];

    $html = "";
    foreach ($fresult as $frow) {
        $tab_ = $frow['code_no'];

        if (array_key_exists($tab_, $tabLinks)) {
            $link = $tabLinks[$tab_];
        } else {
            $link = "/product-hotel/1303";
        }

        $activeClass = ($currentUrl === base_url($link)) ? "active_" : "";

        $link = "<a class='$activeClass' href='$link'>" . $frow['code_name'] . "</a>";
        $html .= " <span class=''>" . $link . "</span>";
    }

    return $html;
}

function getTab($tab_active)
{
    $tab_ = $tab_active ?? 0;
    switch ($tab_) {
        case 1:
            $tab_1 = 'on';
            break;
        case 2:
            $tab_2 = 'on';
            break;
        case 3:
            $tab_3 = 'on';
            break;
        case 4:
            $tab_4 = 'on';
            break;
        case 5:
            $tab_5 = 'on';
            break;
        case 6:
            $tab_6 = 'on';
            break;
        case 7:
            $tab_7 = 'on';
            break;
        default:
            $tab_active = 1;
            break;
    }
}

function getLeftBottomBanner()
{
    $fsql = "SELECT * FROM tbl_bbs_list WHERE code = 'banner' AND category = '125' AND status = 'Y' ORDER BY onum ASC";
    return db_connect()->query($fsql)->getRowArray();
}

function get_device()
{
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone", "iPod", "IPad", "Android", "Blackberry", "SymbianOS|SCH-M\d+", "Opera Mini", "Windows CE", "Nokia", "Sony", "Samsung", "LGTelecom", "SKT", "Mobile", "Phone");
    $str = "P";
    for ($i = 0; $i < count($ary_m); $i++) {
        if (preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
            $str = "M";
            break;
        }
    }
    return $str;
}


function sql_password($value)
{
    $row = db_connect()->query(" select SHA1(MD5('" . $value . "')) as pass ")->getRowArray();
    return $row['pass'];
}

function goUrl($url = "", $msg = "")
{
    echo "<script type='text/javascript'>";
    if ($msg) {
        echo "	alert('" . $msg . "');";
    }
    if ($url) {

        echo "setTimeout( function() {	";
        echo "	location.href='" . $url . "';";
        echo "}, 1000);					";

        //echo "	location.href='".$url."';";
    }
    echo "</script>";
}

function getLoginDeviceUserChk($user_id)
{

    $device_type = get_device();
    $gTime = time() + 86400; //하루 24시간
    $cookieValue = "user_id_" . $user_id;

    if ($user_id != "") {

        $cookieVal = cookie($cookieValue);

        if ($cookieVal == "") {
            $sql = " select * from tbl_login_device where DATE(regdate) = DATE(now())";
            $row = db_connect()->query($sql)->getRowArray();
            $login_type_P = $row['login_type_P'];
            $login_type_M = $row['login_type_M'];

            if ($login_type_P == "") {

                if ($device_type == "P") {
                    $login_type_P = 1;
                    $login_type_M = 0;
                } else if ($device_type == "M") {
                    $login_type_P = 0;
                    $login_type_M = 1;
                }

                $sql = " insert into tbl_login_device set regdate = now()
					, login_type_P = " . $login_type_P . "
					, login_type_M = " . $login_type_M . "
					, itemCnt_P = 0
					, itemCnt_M = 0
					";

                db_connect()->query($sql);
            } else {

                if ($device_type == "P") {
                    $login_type_P = $login_type_P + 1;
                    $sSQl = " login_type_P = " . $login_type_P;
                } else if ($device_type == "M") {
                    $login_type_M = $login_type_M + 1;
                    $sSQl = " login_type_M = " . $login_type_M;
                }

                $sql = " update tbl_login_device set " . $sSQl . " where DATE(regdate) = DATE(now())";
                db_connect()->query($sql);
            }
        }

        setcookie($cookieValue, $cookieValue, $gTime);
    }

    $out_text = "";

    return $out_text;
}

function getLoginIPChk()
{
    $REMOTE_ADDR = request()->getIPAddress();

    $gTime = time() + 86400; //하루 24시간
    $cookieValue = "user_ip_" . str_replace(".", "", $REMOTE_ADDR);

    $cookieVal = $_COOKIE[$cookieValue] ?? "";

    if ($cookieVal == "") {

        $sql = " select * from tbl_login_ip where loginIP = '" . $REMOTE_ADDR . "' ";

        $row = db_connect()->query($sql)->getRowArray();
        $loginIP = $row['loginIP'];
        $loginCnt = $row['loginCnt'];

        if ($loginIP == "") {
            $sql = " insert into tbl_login_ip set loginIP = '" . $REMOTE_ADDR . "', loginCnt = 1";
            db_connect()->query($sql);
        } else {
            $loginCnt = $loginCnt + 1;
            $sql = "
					update tbl_login_ip set loginCnt = " . $loginCnt . " where loginIP = '" . $REMOTE_ADDR . "'
				";
            db_connect()->query($sql);
        }
    }

    setcookie($cookieValue, $cookieValue, $gTime);

    $out_text = "";
    return $out_text;
}

function ipagelisting2($cur_page, $total_page, $n, $url, $deviceType = 'P', $focus_element_id = "")
{
    if ($focus_element_id) {
        $focus_element_id = "#" . $focus_element_id;
    }
    $page_range = $deviceType === 'M' ? 5 : 10;

    if ($total_page < 2) {
        $hide = "style='display:none;'";
    } else {
        $hide = "";
    }

    $retValue = "<div class='paging' $hide><ul class='page'>";

    if ($cur_page > 1) {
        $retValue .= "<li class='skip backward'><a href='" . $url . "1$focus_element_id' title='Go to first page'></a></li>";
    } else {
        $retValue .= "<li class='skip backward'><a href='javascript:;' title='Go to first page'></a></li>";
    }

    if ($cur_page > ($deviceType === 'M' ? 5 : 10)) {
        $retValue .= "<li class='preview one'><a href='" . $url . ($cur_page - ($deviceType === 'M' ? 5 : 10)) . "$focus_element_id' title='Go to previous page'></a></li>";
    } else {
        $retValue .= "<li class='preview one'><a href='javascript:;' title='Go to previous page'></a></li>";
    }

    $start_page = ((int)(($cur_page - 1) / $page_range)) * $page_range + 1;
    $end_page = min($start_page + $page_range - 1, $total_page);

    for ($k = $start_page; $k <= $end_page; $k++) {
        if ($cur_page != $k) {
            $retValue .= "<li><a href='$url$k$focus_element_id' title='Go to page $k'>$k</a></li>";
        } else {
            $retValue .= "<li class='active'><a href='javascript:;' title='Go to page $k'><strong>$k</strong></a></li>";
        }
    }

    if ($cur_page < $total_page - ($deviceType === 'M' ? 5 : 10)) {
        $retValue .= "<li class='next one'><a href='$url" . ($cur_page + ($deviceType === 'M' ? 5 : 10)) . "$focus_element_id' title='Go to next page'></a></li>";
    } else {
        $retValue .= "<li class='next one'><a href='javascript:;' title='Go to next page'></a></li>";
    }

    if ($cur_page < $total_page) {
        $retValue .= "<li class='skip forward'><a href='" . $url . $total_page . "$focus_element_id' title='Go to last page'></a></li>";
    } else {
        $retValue .= "<li class='skip forward'><a href='javascript:;' title='Go to last page'></a></li>";
    }

    $retValue .= "</ul></div>";
    return $retValue;
}

function ipagelistingSub($cur_page, $total_page, $n, $url, $deviceType = 'P', $focus_element_id = "")
{
    if ($focus_element_id) {
        $focus_element_id = "#" . $focus_element_id;
    }
    $page_range = $deviceType === 'M' ? 5 : 10;

    $retValue = "<div class='pagination'>";

    if ($cur_page > 1) {
        $retValue .= "<a class='page-link' href='" . $url . "1$focus_element_id' title='Go to first page'>
						<img src='/images/community/pagination_prev.png' alt='pagination_prev'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' href='javascript:;'  title='Go to first page'>
						<img src='/images/community/pagination_prev.png' alt='pagination_prev'>
					</a>";
    }

    if ($cur_page > 1) {
        $retValue .= "<a class='page-link' style='margin-right: 20px;' href='" . $url . ($cur_page - 1) . "$focus_element_id' title='Go to previous page'>
						<img src='/images/community/pagination_prev_s.png' alt='pagination_prev'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' style='margin-right: 20px;' href='javascript:;' title='Go to previous page'>
						<img src='/images/community/pagination_prev_s.png' alt='pagination_prev'>
					</a>";
    }

    $start_page = ((int)(($cur_page - 1) / $page_range)) * $page_range + 1;
    $end_page = min($start_page + $page_range - 1, $total_page);

    for ($k = $start_page; $k <= $end_page; $k++) {
        if ($cur_page != $k) {
            $retValue .= "<a class='page-link' href='$url$k$focus_element_id' title='Go to page $k'>$k</a>";
        } else {
            $retValue .= "<a class='page-link active' href='javascript:;' title='Go to page $k'><strong>$k</strong></a>";
        }
    }

    if ($cur_page < $total_page) {
        $retValue .= "<a class='page-link' style='margin-left: 20px;' href='$url" . ($cur_page + 1) . "$focus_element_id' title='Go to next page'>
						<img src='/images/community/pagination_next_s.png' alt='pagination_next'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' style='margin-left: 20px;' href='javascript:;' title='Go to next page'>
						<img src='/images/community/pagination_next_s.png' alt='pagination_next'>
					</a>";
    }

    if ($cur_page < $total_page) {
        $retValue .= "<a class='page-link'  href='" . $url . $total_page . "$focus_element_id' title='Go to last page'>
						<img src='/images/community/pagination_next.png' alt='pagination_next'>
					</a>";
    } else {
        $retValue .= "<a class='page-link' href='javascript:;' title='Go to last page'>
						<img src='/images/community/pagination_next.png' alt='pagination_next'>
					</a>";
    }

    $retValue .= "</div>";
    return $retValue;
}

function device_chk()
{
    // 모바일 기종(배열 순서 중요, 대소문자 구분 안함)
    $ary_m = array("iPhone", "iPod", "IPad", "Android", "Blackberry", "SymbianOS|SCH-M\d+", "Opera Mini", "Windows CE", "Nokia", "Sony", "Samsung", "LGTelecom", "SKT", "Mobile", "Phone");
    $str = "PC";
    for ($i = 0; $i < count($ary_m); $i++) {
        if (preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            //return $ary_m[$i];
            $str = "MO";
            break;
        }
    }
    return $str;
}

function get_status_name($status)
{
    $str = "";
    if ($status == "W") {
        $str = "예약접수";
    } elseif ($status == "Y") {
        $str = "결제완료";
    } elseif ($status == "G") {
        $str = "결제대기";
    } elseif ($status == "J") {
        $str = "입금대기";
    } elseif ($status == "C") {
        $str = "예약취소";
    }
    return $str;
}

;
function get_mileage_name($code)
{
    $str = "";
    if ($code == "tour") {
        $str = "여행";
    } elseif ($code == "guide") {
        $str = "가이드";
    } elseif ($code == "trans") {
        $str = "마일리지양도";
    } elseif ($code == "trans_del") {
        $str = "마일리지양도거절";
    } elseif ($code == "receive") {
        $str = "마일리지양도";
    } elseif ($code == "admin") {
        $str = "관리자부여";
    } else {
        $str = "총합결제";
    }
    return $str;
}

function chk_member_id($userid)
{
    $connect = db_connect();

    $fsql = " select count(*) cnts from tbl_member where user_id = '" . $userid . "'";
    $frow = $connect->query($fsql)->getRowArray();

    return $frow['cnts'];
}

function chk_member_col($userid, $cols)
{
    $connect = db_connect();
    if (chk_member_id($userid) < 1) {

        return "error";

    } else {
        $fsql = " select " . $cols . " as outcol from tbl_member where user_id = '" . $userid . "'";
        $frow = $connect->query($fsql)->getRowArray();

        return $frow['outcol'];
    }
}

function DateAdd($interval, $number, $date)
{

    //getdate()함수를 통해 얻은 배열값을 각각의 변수에 지정합니다.

    $date_time_array = getdate($date);
    $hours = $date_time_array["hours"];
    $minutes = $date_time_array["minutes"];
    $seconds = $date_time_array["seconds"];
    $month = $date_time_array["mon"];
    $day = $date_time_array["mday"];
    $year = $date_time_array["year"];


    //switch()구문을 사용해서 interval에 따라 적용합니다.

    switch ($interval) {
        case "yyyy":
            $year += $number;
            break;

        case "q":
            $year += ($number * 3);
            break;

        case "m":
            $month += $number;
            break;

        case "y":
        case "d":
        case "w":
            $day += $number;
            break;

        case "ww":
            $day += ($number * 7);
            break;

        case "h":
            $hours += $number;
            break;

        case "n":
            $minutes += $number;
            break;

        case "s":
            $seconds += $number;
            break;

    }


    $timestamp = date("Y-m-d", mktime($hours, $minutes, $seconds, $month, $day, $year));
    return $timestamp;
}

function strAsterisk($string)
{

    $string = trim($string);
    $length = mb_strlen($string, 'utf-8');
    $string_changed = $string;
    if ($length <= 2) {
        // 한두 글자면 그냥 뒤에 별표 붙여서 내보낸다.
        $string_changed = mb_substr($string, 0, 1, 'utf-8') . '*';
    }
    if ($length >= 3) {
        // 3으로 나눠서 앞뒤.
        $leave_length = floor($length / 3); // 남겨 둘 길이. 반올림하니 너무 많이 남기게 돼, 내림으로 해서 남기는 걸 줄였다.
        $asterisk_length = $length - ($leave_length * 2);
        $offset = $leave_length + $asterisk_length;
        $head = mb_substr($string, 0, $leave_length, 'utf-8');
        $tail = mb_substr($string, $offset, $leave_length, 'utf-8');
        $string_changed = $head . implode('', array_fill(0, $asterisk_length, '*')) . $tail;
    }
    return $string_changed;
}

function createAndUpdateCaptcha()
{
    $session = session();
    $image = imagecreatetruecolor(200, 50);

    $background = imagecolorallocate($image, 22, 86, 165);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    $noise_color = imagecolorallocate($image, 200, 200, 200);

    imagefill($image, 0, 0, $background);

    for ($i = 0; $i < 1000; $i++) {
        imagesetpixel($image, rand(0, 200), rand(0, 50), $noise_color);
    }

    for ($i = 0; $i < 10; $i++) {
        imageline($image, rand(0, 200), rand(0, 50), rand(0, 200), rand(0, 50), $noise_color);
    }

    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $rand_str = '';
    for ($i = 0; $i < 6; $i++) {
        $rand_str .= $chars[rand(0, strlen($chars) - 1)];
    }

    $session->set('captcha', $rand_str);
    $font_size = 18;
    $font_path = FCPATH . 'fonts/ONE-Mobile-Regular.ttf';
    $char_width = 8;
    $char_height = 16;

    $string_length = strlen($rand_str);
    $string_width = $string_length * $char_width;

    $x = (170 - $string_width) / 2;
    $y = (80 - $char_height) / 2;

    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_path, $rand_str);

    ob_start();
    imagejpeg($image);
    $image_data = ob_get_clean();
    imagedestroy($image);

    $captcha_image = 'data:image/jpeg;base64,' . base64_encode($image_data);

    return array('captcha_image' => $captcha_image, 'captcha_value' => $rand_str);
}

function noFileExt($fileName)
{
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $allowedExtensions);
}

function yoil_convert($day)
{
    $yoil = array("일", "월", "화", "수", "목", "금", "토");
    $yoil = $yoil[date('w', strtotime($day))];
    return $yoil;
}

// function GD2_make_thumb($source, $destination, $width, $height)
// {
//     if (file_exists($source)) {
//         $image = imagecreatefromjpeg($source);

//         list($original_width, $original_height) = getimagesize($source);

//         if ($original_width > 0 && $original_height > 0) {
//             $ratio = $original_width / $original_height;
//             if ($width / $height > $ratio) {
//                 $width = $height * $ratio;
//             } else {
//                 $height = $width / $ratio;
//             }

//             $thumb = imagecreatetruecolor($width, $height);

//             imagecopyresampled($thumb, $image, 0, 0, 0, 0, $width, $height, $original_width, $original_height);

//             imagejpeg($thumb, $destination);

//             imagedestroy($image);
//             imagedestroy($thumb);
//         }
//     }
// }

function GD2_make_thumb($max_x, $max_y, $dst_name, $src_file)
{
    $img_info = @getimagesize($src_file);
    $sx = $img_info[0];
    $sy = $img_info[1];
    //썸네일 보다 큰가?
    if ($sx >= $max_x || $sy >= $max_y) {
        if ($sx > $sy) {
            $thumb_y = ceil(($sy * $max_x) / $sx);
            $thumb_x = $max_x;
        } else {
            $thumb_x = ceil(($sx * $max_y) / $sy);
            $thumb_y = $max_y;
        }
    } else {
        $thumb_y = $sy;
        $thumb_x = $sx;
    }
    // JPG 파일인가?
    if ($img_info[2] == "1") {
        $_dq_tempFile = basename($src_file);                                //파일명 추출
        $_dq_tempDir = str_replace($_dq_tempFile, "", $src_file);        //경로 추출
        $_dq_tempFile = $dst_name;        //경로 + 새 파일명 생성

        $_create_thumb_file = true;
        if (file_exists($_dq_tempFile)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
            $old_img = @getimagesize($_dq_tempFile);
            if ($old_img[0] != $thumb_x)
                $_create_thumb_file = true;
            else
                $_create_thumb_file = false;
            if ($old_img[1] != $thumb_y)
                $_create_thumb_file = true;
            else
                $_create_thumb_file = false;
        }
        if ($_create_thumb_file) {
            // 복제
            $src_img = imagecreatefromgif($src_file);
            $dst_img = ImageCreateTrueColor($thumb_x, $thumb_y);
            ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_x, $thumb_y, $sx, $sy);
            Imagejpeg($dst_img, $_dq_tempFile, 100);
            // 메모리 초기화
            ImageDestroy($dst_img);
            ImageDestroy($src_img);
        }
    }
    if ($img_info[2] == "2") {
        $_dq_tempFile = basename($src_file);                                //파일명 추출
        $_dq_tempDir = str_replace($_dq_tempFile, "", $src_file);        //경로 추출
        $_dq_tempFile = $dst_name;        //경로 + 새 파일명 생성

        $_create_thumb_file = true;
        if (file_exists($_dq_tempFile)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
            $old_img = @getimagesize($_dq_tempFile);
            if ($old_img[0] != $thumb_x)
                $_create_thumb_file = true;
            else
                $_create_thumb_file = false;
            if ($old_img[1] != $thumb_y)
                $_create_thumb_file = true;
            else
                $_create_thumb_file = false;
        }
        if ($_create_thumb_file) {
            // 복제
            $src_img = ImageCreateFromjpeg($src_file);
            $dst_img = ImageCreateTrueColor($thumb_x, $thumb_y);
            ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_x, $thumb_y, $sx, $sy);
            Imagejpeg($dst_img, $_dq_tempFile, 100);
            // 메모리 초기화
            ImageDestroy($dst_img);
            ImageDestroy($src_img);
        }
    }
    if ($img_info[2] == "3") {
        $_dq_tempFile = basename($src_file);                                //파일명 추출
        $_dq_tempDir = str_replace($_dq_tempFile, "", $src_file);        //경로 추출
        $_dq_tempFile = $dst_name;        //경로 + 새 파일명 생성

        $_create_thumb_file = true;
        if (file_exists($_dq_tempFile)) { //섬네일 파일이 이미 존제한다면 이미지의 사이즈 비교
            $old_img = @getimagesize($_dq_tempFile);
            if ($old_img[0] != $thumb_x)
                $_create_thumb_file = true;
            else
                $_create_thumb_file = false;
            if ($old_img[1] != $thumb_y)
                $_create_thumb_file = true;
            else
                $_create_thumb_file = false;
        }
        if ($_create_thumb_file) {
            // 복제
            $src_img = imagecreatefrompng($src_file);
            $dst_img = ImageCreateTrueColor($thumb_x, $thumb_y);
            ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_x, $thumb_y, $sx, $sy);
            Imagejpeg($dst_img, $_dq_tempFile, 100);
            // 메모리 초기화
            ImageDestroy($dst_img);
            ImageDestroy($src_img);
        }
    }
}

function get_img($img, $path, $width, $height, $water = "")
{
    $file_dir = "";
    $thumb_img_path = $_SERVER["DOCUMENT_ROOT"] . $path . "thum_" . $width . "_$height/";

    if (!is_dir($thumb_img_path)) {
        @mkdir($thumb_img_path, 0777);
    }
    $thumb_img = $thumb_img_path . $img;
    if (!file_exists($thumb_img)) {
        @GD2_make_thumb($width, $height, $thumb_img, $_SERVER["DOCUMENT_ROOT"] . $path . "/" . $img);
    }
    chmod($_SERVER['DOCUMENT_ROOT'] . $path . "thum_" . $width . "_" . $height . "/" . $img, 0777);

    return $path . "thum_" . $width . "_" . $height . "/" . $img;
}

function get_img_tour($img, $path, $width, $height, $water = "")
{
    $file_dir = "";
    $thumb_img_path = $_SERVER["DOCUMENT_ROOT"];
    if (!is_dir($thumb_img_path)) {
        @mkdir($thumb_img_path, 0777);
    }
    $thumb_img = $thumb_img_path . $img;
    if (!file_exists($thumb_img)) {
        @GD2_make_thumb($width, $height, $thumb_img, $_SERVER["DOCUMENT_ROOT"] . "/" . $path . "/" . $img);
    }
    return $path . $img;
}

function getConImg($con)
{
    $cnt = preg_match_all('@<img\s[^>]*src\s*=\s*(["\'])?([^\s>]+?)\1@i', stripslashes($con), $output);
    $j = 0;
    $img = '';
    for ($i = 0; $i < $cnt; $i++) {
        $cols[$j][] = str_replace('""', '"', ($output[2][$i] != '') ? $output[2][$i] : $output[4][$i]);

        if ($output[6][$i] != '')
            $j++;

        $img = $cols[0][$i];
    }
    return $img;
}

function file_check($ok_filename, $ok_file, $path, $ftype)
{
    if ($ok_filename == "" || $ok_file == "") {
        return false;
    } else {
        //한글파일 파일명 대체

        $download = $path;
        $aa = date('YmdHms');
        //	$check=explode(".",$ok_filename);

        $ext = substr(strrchr($ok_filename, "."), 1);     //확장자앞 .을 제거하기 위하여 substr()함수를 이용
        $ext = strtolower($ext);             //확장자를 소문자로 변환

        $check1 = $aa;
        $check2 = strtolower($ext);

        $ok_filename = $check1 . "." . $check2;
        $attached = $ok_filename;
        if ($ftype == "I") {
            if ($check2 != "gif" && $check2 != "jpg" && $check2 != "jpeg" && $check2 != "bmp") {
                echo "<script>alert('이미지 파일만 업로드할수있습니다.');
				  history.back(1);</script>";
                exit;
            }
        } else
            $attached = $ok_filename;
        $ok_filename = $download . $ok_filename;
        if (file_exists($ok_filename)) {    // 같은 파일 존재
            //$file_splited = explode("\.", $attached, 2);
            $file_splited = explode(".", $attached);
            $i = 0;
            do {
                $tmp_filename = $file_splited[0] . $i . "." . $file_splited[1];
                $tmp_filelocation = $download . $tmp_filename;
                $i++;
            } while (file_exists($tmp_filelocation));
            $ok_filename = $tmp_filelocation;
            $attached = $tmp_filename;
        }

        if ($check2 == "png") {
            /*
                           $wfp = fopen($ok_filename, "wb");

                           if ($fp = fopen($ok_file, 'r')) {
                              $contents = '';
                              // 전부 읽을때까지 계속 읽음
                              while ($line = fgets($fp, 1024)) {
                                 $contents .= $line;
                              }
                           }

                           //echo $contents;

                           fwrite($wfp,$contents);
                           fclose($rfp);
                           fclose($wfp);
                           */

            copy($ok_file, $ok_filename);
        } else {
            copy($ok_file, $ok_filename);
        }


        //copy($ok_file, $ok_filename[background="255 128 128"]);
        unlink($ok_file);
        //GD2_make_thumb(20000,20000,str_replace("img_","thumb_",$path.$attached),$path.$attached);

        return $attached;
    }
}

function getCharge($charge_idx)
{
    $fsql = "SELECT * FROM tbl_product_charge WHERE charge_idx = " . $charge_idx;
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getRowArray();

    return $fresult;
}

function getMOption($code_idx)
{
    $fsql = "SELECT * FROM tbl_tours_moption WHERE code_idx = " . $code_idx;
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getRowArray();

    return $fresult;
}

function getOption($idx)
{
    $fsql = "SELECT * FROM tbl_tours_option WHERE idx = " . $idx;
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getRowArray();

    return $fresult;
}

function getUrlFromProduct($product)
{
    $product_code_1 = $product['product_code_1'];
    switch ($product_code_1) {
        case '1320':
            $url = '/product-restaurant/restaurant-detail/';
            break;
        case '1317':
            $url = '/ticket/ticket-detail/';
            break;
        case '1325':
            $url = '/product-spa/spa-details/';
            break;
        case '1301':
            $url = '/product-tours/item_view/';
            break;
        case '1302':
            $url = '/product-golf/golf-detail/';
            break;
        default:
            $url = '/product-hotel/hotel-detail/';
            break;
    }
    $url .= $product['product_idx'];
    return $url;
}

function getCodeFromCodeNo($code_no)
{
    $fsql = "SELECT * FROM tbl_code WHERE code_no = '" . $code_no . "'";
    $fresult = db_connect()->query($fsql);
    $fresult = $fresult->getRowArray();

    return $fresult;
}

function getBanner($subject)
{
    $c_sql = "SELECT * FROM tbl_bbs_category WHERE subject = '" . $subject . "' AND code = 'banner' AND status = 'Y' ORDER BY onum ASC, tbc_idx DESC";
    $c_result = db_connect()->query($c_sql);
    $c_result = $c_result->getRowArray();

    if ($c_result) {
        $category_idx = $c_result['tbc_idx'];

        $b_sql = "SELECT * FROM tbl_bbs_list WHERE category = '" . $category_idx . "' and status = 'Y' ORDER BY onum ASC, bbs_idx DESC";
        return db_connect()->query($b_sql)->getRowArray();
    }
    return [];
}

function getBannerByCategory($category_idx)
{
    $b_sql = "SELECT * FROM tbl_bbs_list WHERE category = '" . $category_idx . "' and status = 'Y' ORDER BY onum ASC, bbs_idx DESC";
    write_log($b_sql);
    return db_connect()->query($b_sql)->getRowArray();
}
