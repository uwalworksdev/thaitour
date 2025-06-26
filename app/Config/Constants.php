<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);

define('GOLF_HOLES', [18, 27, 36, 45]);

define('GOLF_HOURS', ['06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19']);
//define('GOLF_HOURS', ['오전', '오후']);

define('GOLF_MIN', ['00', '12', '24', '36', '48']);

//b2b_notice
$b2b_notice['titles'][0]        = "작성자";
$b2b_notice['names'][0]         = "writer";
$b2b_notice['inputTypes'][0]    = "text";
$b2b_notice['widths'][0]        = "150px";

$b2b_notice['titles'][1]        = "이메일";
$b2b_notice['names'][1]         = "email";
$b2b_notice['inputTypes'][1]    = "text";

$b2b_notice['titles'][2]        = "공지글";
$b2b_notice['names'][2]         = "notice_yn";
$b2b_notice['inputTypes'][2]    = "checkbox";

$b2b_notice['titles'][3]        = "등록일";
$b2b_notice['names'][3]         = "r_date";
$b2b_notice['inputTypes'][3]    = "text";

$b2b_notice['titles'][4]        = "조회";
$b2b_notice['names'][4]         = "hit";
$b2b_notice['inputTypes'][4]    = "text";

$b2b_notice['titles'][5]        = "제목";
$b2b_notice['names'][5]         = "subject";
$b2b_notice['inputTypes'][5]    = "text";

$b2b_notice['titles'][6]        = "내용";
$b2b_notice['names'][6]         = "contents";
$b2b_notice['inputTypes'][6]    = "summernote";

//faq
$faq['titles'][0]        = "상태";
$faq['names'][0]         = "status";
$faq['inputTypes'][0]    = "select";
$faq['widths'][0]        = "150px";

$faq['titles'][1]        = "분류";
$faq['names'][1]         = "category";
$faq['inputTypes'][1]    = "select";
$faq['widths'][1]        = "150px";

$faq['titles'][2]        = "제목";
$faq['names'][2]         = "subject";
$faq['inputTypes'][2]    = "text";

$faq['titles'][3]        = "상세정보";
$faq['names'][3]         = "contents";
$faq['inputTypes'][3]    = "summernote";

//winner
$winner['titles'][0]        = "조회";
$winner['names'][0]         = "hit";
$winner['inputTypes'][0]    = "text";
$winner['widths'][0]        = "150px";

$winner['titles'][1]        = "제목";
$winner['names'][1]         = "subject";
$winner['inputTypes'][1]    = "text";
$winner['widths'][1]        = "100%";

$winner['titles'][2]        = "내용";
$winner['names'][2]         = "contents";
$winner['inputTypes'][2]    = "summernote";

//banner
$banner["titles"][0] = "구분";
$banner["names"][0] = "category";
$banner["inputTypes"][0] = "select";
$banner["widths"][0] = "150px";

$banner["titles"][1] = "제목";
$banner["names"][1] = "subject";
$banner["inputTypes"][1] = "text";
$banner["widths"][1] = "100%";

$banner["titles"][2] = "제목2";
$banner["names"][2] = "describe";
$banner["inputTypes"][2] = "text";

$banner["titles"][3] = "링크";
$banner["names"][3] = "url";
$banner["inputTypes"][3] = "text";

$banner["titles"][6] = "현황";
$banner["names"][6] = "status";
$banner["inputTypes"][6] = "select";
$banner["widths"][6] = "150px";

$banner["titles"][4] = "PC 이미지(1200)";
$banner["names"][4] = "ufile6";
$banner["inputTypes"][4] = "files";

$banner["titles"][5] = "모바일 이미지(660)";
$banner["names"][5] = "ufile5";
$banner["inputTypes"][5] = "files";

//event
$event['titles'][0]        = "조회";
$event['names'][0]         = "hit";
$event['inputTypes'][0]    = "text";
$event['widths'][0]        = "150px";

$event['titles'][1]        = "제목";
$event['names'][1]         = "subject";
$event['inputTypes'][1]    = "text";
$event['widths'][1]        = "100%";

$event['titles'][2]        = "이벤트 기간";
$event['names'][2]         = ['s_date', 'e_date'];
$event['inputTypes'][2]    = "duration";

$event['titles'][3]        = "내용";
$event['names'][3]         = "contents";
$event['inputTypes'][3]    = "summernote";

$event['titles'][4]        = "이미지첨부";
$event['names'][4]         = "ufile6";
$event['inputTypes'][4]    = "files";

// $event['titles'][5]        = "관련상품";
// $event['names'][5]         = "product_list";
// $event['inputTypes'][5]    = "product_pickup";

//magazines
$magazines['titles'][0]        = "조회";
$magazines['names'][0]         = "hit";
$magazines['inputTypes'][0]    = "text";
$magazines['widths'][0]        = "150px";

$magazines['titles'][1]        = "제목";
$magazines['names'][1]         = "subject";
$magazines['inputTypes'][1]    = "text";
$magazines['widths'][1]        = "100%";

$magazines['titles'][2]        = "내용";
$magazines['names'][2]         = "contents";
$magazines['inputTypes'][2]    = "summernote";

$magazines['titles'][3]        = "이미지첨부";
$magazines['names'][3]         = "ufile1";
$magazines['inputTypes'][3]    = "files";

//time_sale
$time_sale['titles'][0]        = "작성자";
$time_sale['names'][0]         = "writer";
$time_sale['inputTypes'][0]    = "text";
$time_sale['widths'][0]        = "200px";

$time_sale['titles'][1]        = "제목";
$time_sale['names'][1]         = "subject";
$time_sale['inputTypes'][1]    = "text";

// $time_sale['titles'][2]        = "상태";
// $time_sale['names'][2]         = "category";
// $time_sale['inputTypes'][2]    = "select";
// $time_sale['widths'][2]        = "200px";

$time_sale['titles'][2]        = "이벤트 기간";
$time_sale['names'][2]         = ['s_date', 's_time', 'e_date', 'e_time'];
$time_sale['inputTypes'][2]    = "time_sale";

$time_sale['titles'][3]        = "조회";
$time_sale['names'][3]         = "hit";
$time_sale['inputTypes'][3]    = "text";
$time_sale['widths'][3]        = "100px";

$time_sale['titles'][4]        = "url";
$time_sale['names'][4]         = "url";
$time_sale['inputTypes'][4]    = "text";

$time_sale['titles'][5]        = "이미지첨부";
$time_sale['names'][5]         = "ufile1";
$time_sale['inputTypes'][5]    = "files";
// mem_board
// mem_pds
// awards
// main_event
// hashtag

//tour

$tour["titles"][0]        = "구분";
$tour["names"][0]         = "category";
$tour["inputTypes"][0]    = "select";
$tour["widths"][0]        = "150px";

$tour['titles'][1]        = "작성자";
$tour['names'][1]         = "writer";
$tour['inputTypes'][1]    = "text";
$tour['widths'][1]        = "150px";

$tour['titles'][2]        = "조회";
$tour['names'][2]         = "hit";
$tour['inputTypes'][2]    = "text";
$tour['widths'][2]        = "150px";

$tour['titles'][3]        = "제목";
$tour['names'][3]         = "subject";
$tour['inputTypes'][3]    = "text";
$tour['widths'][3]        = "100%";

$tour['titles'][4]        = "내용";
$tour['names'][4]         = "contents";
$tour['inputTypes'][4]    = "summernote";

$tour['titles'][5]        = "이미지첨부";
$tour['names'][5]         = "ufile1";
$tour['inputTypes'][5]    = "files";

//infographics
$infographics["titles"][0]        = "구분";
$infographics["names"][0]         = "category";
$infographics["inputTypes"][0]    = "select";
$infographics["widths"][0]        = "150px";

$infographics['titles'][1]        = "작성자";
$infographics['names'][1]         = "writer";
$infographics['inputTypes'][1]    = "text";
$infographics['widths'][1]        = "150px";

$infographics['titles'][2]        = "조회";
$infographics['names'][2]         = "hit";
$infographics['inputTypes'][2]    = "text";
$infographics['widths'][2]        = "150px";

$infographics['titles'][3]        = "제목";
$infographics['names'][3]         = "subject";
$infographics['inputTypes'][3]    = "text";
$infographics['widths'][3]        = "100%";

$infographics['titles'][4]        = "내용";
$infographics['names'][4]         = "contents";
$infographics['inputTypes'][4]    = "summernote";

$infographics['titles'][5]        = "이미지첨부";
$infographics['names'][5]         = "ufile1";
$infographics['inputTypes'][5]    = "files";

//trip

$trip["titles"][0]        = "구분";
$trip["names"][0]         = "category";
$trip["inputTypes"][0]    = "select";
$trip["widths"][0]        = "150px";

$trip['titles'][1]        = "작성자";
$trip['names'][1]         = "writer";
$trip['inputTypes'][1]    = "text";
$trip['widths'][1]        = "150px";

$trip['titles'][2]        = "조회";
$trip['names'][2]         = "hit";
$trip['inputTypes'][2]    = "text";
$trip['widths'][2]        = "150px";

$trip['titles'][3]        = "제목";
$trip['names'][3]         = "subject";
$trip['inputTypes'][3]    = "text";
$trip['widths'][3]        = "100%";

$trip['titles'][4]        = "내용";
$trip['names'][4]         = "contents";
$trip['inputTypes'][4]    = "summernote";

$trip['titles'][5]        = "이미지첨부";
$trip['names'][5]         = "ufile1";
$trip['inputTypes'][5]    = "files";
define("BBS_WRITE_CONFIG", [
    "b2b_notice"    => $b2b_notice,
    "faq"           => $faq,
    "winner"        => $winner,
    "banner"        => $banner,
    'event'         => $event,
    'magazines'     => $magazines,
    'time_sale'     => $time_sale,
    'tour'          => $tour,
    'infographics'  => $infographics,
    'trip'  => $trip,
]);

$b2b_notice_list['skin'] = "list";
$b2b_notice_list['titles'][0] = "제목";
$b2b_notice_list['names'][0] = "subject";
$b2b_notice_list['widths'][0] = "*";


$faq_list['skin'] = "list";
$faq_list['titles'][0] = "분류";
$faq_list['names'][0] = "category_code_name";
$faq_list['widths'][0] = "100px";

$faq_list['titles'][1] = "제목";
$faq_list['names'][1] = "subject";
$faq_list['widths'][1] = "*";

$winner_list['skin'] = "list";
$winner_list['titles'][0] = "제목";
$winner_list['names'][0] = "subject";
$winner_list['widths'][0] = "*";

$banner_list['skin'] = "list";    
$banner_list['titles'][0] = "순위";
$banner_list['names'][0] = "onum";
$banner_list["showTypes"][0] = "input";
$banner_list['widths'][0] = "100px";

$banner_list['titles'][1] = "이미지";
$banner_list['names'][1] = "ufile6";
$banner_list["showTypes"][1] = "image";
$banner_list['widths'][1] = "500px";

$banner_list['titles'][2] = "제목";
$banner_list['names'][2] = "subject";
$banner_list['widths'][2] = "*";

$banner_list['titles'][3] = "카테고리";
$banner_list['names'][3] = "scategory";
$banner_list['widths'][3] = "150px";

$banner_list['titles'][4] = "날짜";
$banner_list['names'][4] = "r_date";
$banner_list['widths'][4] = "150px";

$banner_list['titles'][5] = "현황";
$banner_list['names'][5] = "status";
$banner_list['widths'][5] = "120px";

$event_list['skin'] = "photo";

$award_list['skin'] = "photo";

$main_event_list['skin'] = "photo";

$hashtag_list['skin'] = "list";

$hashtag_list['titles'][0] = "제목";
$hashtag_list['names'][0] = "subject";
$hashtag_list['widths'][0] = "*";


$magazines_list['skin'] = "list";

$magazines_list['skin'] = "list";
$magazines_list['titles'][0] = "제목";
$magazines_list['names'][0] = "subject";
$magazines_list['widths'][0] = "*";

//time_sale
$time_sale_list['skin'] = "list";

$time_sale_list['titles'][0] = "썸네일이미지";
$time_sale_list['names'][0] = "ufile1";
$time_sale_list["showTypes"][0] = "image";
$time_sale_list['widths'][0] = "10%";

$time_sale_list['titles'][1] = "제목";
$time_sale_list['names'][1] = "subject";
$time_sale_list['widths'][1] = "*";

$time_sale_list['titles'][2] = "작성자";
$time_sale_list['names'][2] = "writer";
$time_sale_list['widths'][2] = "10%";

$time_sale_list['titles'][3] = "조회";
$time_sale_list['names'][3] = "hit";
$time_sale_list['widths'][3] = "7%";

$time_sale_list['titles'][4] = "등록일";
$time_sale_list['names'][4] = "r_date";
$time_sale_list['widths'][4] = "15%";

//tour
$tour_list['skin'] = "list";

$tour_list['titles'][0] = "구분";
$tour_list['names'][0] = "category_code_name";
$tour_list['widths'][0] = "8%";

$tour_list['titles'][1] = "썸네일이미지";
$tour_list['names'][1] = "ufile1";
$tour_list["showTypes"][1] = "image";
$tour_list['widths'][1] = "10%";

$tour_list['titles'][2] = "제목";
$tour_list['names'][2] = "subject";
$tour_list['widths'][2] = "*";

$tour_list['titles'][3] = "작성자";
$tour_list['names'][3] = "writer";
$tour_list['widths'][3] = "10%";

$tour_list['titles'][4] = "조회";
$tour_list['names'][4] = "hit";
$tour_list['widths'][4] = "7%";

$tour_list['titles'][5] = "등록일";
$tour_list['names'][5] = "r_date";
$tour_list['widths'][5] = "15%";

//trip
$trip_list['skin'] = "list";

$trip_list['titles'][0] = "구분";
$trip_list['names'][0] = "category_code_name";
$trip_list['widths'][0] = "8%";

$trip_list['titles'][1] = "썸네일이미지";
$trip_list['names'][1] = "ufile1";
$trip_list["showTypes"][1] = "image";
$trip_list['widths'][1] = "10%";

$trip_list['titles'][2] = "제목";
$trip_list['names'][2] = "subject";
$trip_list['widths'][2] = "*";

$trip_list['titles'][3] = "작성자";
$trip_list['names'][3] = "writer";
$trip_list['widths'][3] = "10%";

$trip_list['titles'][4] = "조회";
$trip_list['names'][4] = "hit";
$trip_list['widths'][4] = "7%";

$trip_list['titles'][5] = "등록일";
$trip_list['names'][5] = "r_date";
$trip_list['widths'][5] = "15%";

//infographics
$infographics_list['skin'] = "photo";

define("BBS_LIST_CONFIG", [
    "b2b_notice" => $b2b_notice_list,
    "faq" => $faq_list,
    "winner" => $winner_list,
    "banner" => $banner_list,
    "event" => $event_list,
    "mem_board" => [],
    "mem_pds" => [],
    "awards" => $award_list,
    "main_event" => $main_event_list,
    "hashtag" => $hashtag_list,
    'magazines' => $magazines_list,
    'time_sale' => $time_sale_list,
    'tour' => $tour_list,
    'trip' => $trip_list,
    'infographics' => $infographics_list
]);


$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'  ? 'https://' : 'http://') . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost:8080') . dirname($_SERVER['SCRIPT_NAME']) . '/';

defined('BASE_URL') OR define('BASE_URL', $baseUrl);
