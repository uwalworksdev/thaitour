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

//define('GOLF_HOURS', ['06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19']);
define('GOLF_HOURS', ['오전', '오후']);

define('GOLF_MIN', ['00', '12', '24', '36', '48']);

$b2b_notice = [
    "titles"        => ["작성자", "이메일", "공지글", "등록일", "조회", "제목", "내용"],
    "names"         => ["writer", "email", "notice_yn", "r_date", "hit", "subject", "contents"],
    "inputTypes"    => ["text", "text", "checkbox", "text", "text", "text", "summernote"],
    "widths"        => ["150px"]
];

$faq = [
    "titles"        => ["상태", "베스트", "분류", "공지", "제목", "상세정보"],
    "names"         => ["r_status", "r_flag", "r_category", "r_notice", "r_title", "r_content"],
    "inputTypes"    => ["select", "checkbox", "select", "checkbox", "text", "summernote"],
    "widths"        => ["150px", "", "150px"]
];

$winner = [
    "titles"        => ["조회", "제목", "내용"],
    "names"         => ["hit", "subject", "contents"],
    "inputTypes"    => ["text", "text", "summernote"],
    "widths"        => ["150px", "100%", ""]
];

$banner = [
    "titles"        => ["구분"       , "제목"        , "제목2", "링크"     , "PC 이미지(1200)"  , "모바일 이미지(660)"],
    "names"         => ["category"  , "subject"     , "describe", "url"     , "ufile6"          , "ufile5"],
    "inputTypes"    => ["select"    , "text"        , "text", "text"    , "files"           , "files" ],
    "widths"        => ["150px"     , "100%"        , ""]
];

define("BBS_WRITE_CONFIG", [
    "b2b_notice" => $b2b_notice,
    "faq" => $faq,
    "winner" => $winner,
    "banner" => $banner
]);
