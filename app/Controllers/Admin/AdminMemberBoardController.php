<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\BoardController;
use CodeIgniter\Database\Config;
use Config\CustomConstants as ConfigCustomConstants;

class AdminMemberBoardController extends BaseController
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Config::connect();
        helper('my_helper');
        helper('alert_helper');
        $constants = new ConfigCustomConstants();
    }

    public function board_list()
    {
        $code = updateSQ($_GET["code"] ?? '');
        $pg = updateSQ($_GET["pg"] ?? '');

        $fsql = " select * from tbl_bbs_config where board_code='$code' ";

        $fresult = $this->connect->query($fsql);
        $frow = $fresult->getRowArray();
        if ($frow['tbc_idx'] == "") {
            exit();
        } else {
            $board_name = $frow['board_name'];
            $board_code = $frow['board_code'];
            $isCategory = $frow['is_category'];
            $isSecure = $frow['is_secure'];
            $isRight = $frow['is_right'];
            $isReply = $frow['is_reply'];
            $isComment = $frow['is_comment'];
            $isRecomm = $frow['is_recomm'];
            $isNotice = $frow['is_notice'];
            $skin = $frow['skin'];
            $is_comment = $frow['is_comment'];
        }

        $scategory = updateSQ($_GET['scategory'] ?? '');
        $search_word = updateSQ($_GET['search_word'] ?? '');
        $search_mode = updateSQ($_GET['search_mode'] ?? '');
        $boardController = new BoardController();
        $is_category = $boardController->isBoardCategory($code);
        $g_list_rows = 10;
        if ($search_word != "") {
            if ($search_mode != "") {
                $strSql = " and $search_mode like '%$search_word%' ";
            } else {
                $strSql = " and (subject like '%$search_word%' or contents like '%$search_word%') ";
            }
        }
        if ($scategory != "") {
            $strSql = $strSql . " and category = '$scategory'";
        }
        $strSql = $strSql . " and code = '$code'";
        $total_sql = " select *  from tbl_bbs_list where 1=1 " . $strSql;
        $result = $this->connect->query($total_sql);
        $nTotalCount = $result->getNumRows();

        $nPage = ceil($nTotalCount / $g_list_rows);
        if ($pg == "") $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $orderStr = '';
        $sql = $total_sql . " order by $orderStr notice_yn desc, r_date desc limit $nFrom, $g_list_rows ";
        $result = $this->connect->query($sql);
        $num = $nTotalCount - $nFrom;
        $result = $result->getResultArray();
        $boardName = $boardController->getBoardName($code);
        $data = [
            'boardName' => $boardName ?? '',
            'code' => $code ?? '',
            'board_code' => $board_code ?? '',
            'board_name' => $board_name ?? '',
            'skin' => $skin ?? '',
            'isCategory' => $isCategory ?? '',
            'is_category' => $is_category ?? '',
            'isRight' => $isRight ?? '',
            'isReply' => $isReply ?? '',
            'isComment' => $isComment ?? '',
            'isRecomm' => $isRecomm ?? '',
            'isNotice' => $isNotice ?? '',
            'isSecure' => $isSecure ?? '',
            'is_comment' => $is_comment ?? '',
            'scategory' => $scategory ?? '',
            'search_word' => $search_word ?? '',
            'search_mode' => $search_mode ?? '',
            'pg' => $pg,
            'num' => $num,
            'result' => $result,
            'nTotalCount' => $nTotalCount,
            'nPage' => $nPage,
            'g_list_rows' => $g_list_rows
        ];
        return view('admin/_memberBoard/board_list', $data);
    }

    public function board_write()
    {
        $code = updateSQ($_GET["code"] ?? '');

        $fsql = " select * from tbl_bbs_config where board_code='$code' ";

        $fresult = $this->connect->query($fsql);
        $frow = $fresult->getRowArray();
        if ($frow['tbc_idx'] == "") {
            exit();
        } else {
            $board_name = $frow['board_name'];
            $board_code = $frow['board_code'];
            $isCategory = $frow['is_category'];
            $isSecure = $frow['is_secure'];
            $isRight = $frow['is_right'];
            $isReply = $frow['is_reply'];
            $isComment = $frow['is_comment'];
            $isRecomm = $frow['is_recomm'];
            $isNotice = $frow['is_notice'];
            $skin = $frow['skin'];
            $is_comment = $frow['is_comment'];
        }

        $writer = $_SESSION['member']['name'] ?? '';
        $search_mode = updateSQ($_GET['search_mode'] ?? '');
        $search_word = updateSQ($_GET['search_word'] ?? '');
        $pg = updateSQ($_GET['pg'] ?? '');
        $bbs_idx = updateSQ($_GET['bbs_idx'] ?? '');
        $wDate = date("Y-m-d H:i:s", time());
        $hit = 0;
        $mode = updateSQ($_GET['mode'] ?? '');

        $total_sql = " select * from tbl_bbs_list where bbs_idx='" . $bbs_idx . "'";
        $result = $this->connect->query($total_sql);
        $row = $result->getRowArray();

        $boardController = new BoardController();
        $boardName = $boardController->getBoardName($code);
        $data = [
            'boardName' => $boardName ?? '',
            'code' => $code ?? '',
            'board_code' => $board_code ?? '',
            'board_name' => $board_name ?? '',
            'skin' => $skin ?? '',
            'isCategory' => $isCategory ?? '',
            'is_category' => $is_category ?? '',
            'isRight' => $isRight ?? '',
            'isReply' => $isReply ?? '',
            'isComment' => $isComment ?? '',
            'isRecomm' => $isRecomm ?? '',
            'isNotice' => $isNotice ?? '',
            'isSecure' => $isSecure ?? '',
            'is_comment' => $is_comment ?? '',
            'scategory' => $scategory ?? '',
            'search_word' => $search_word ?? '',
            'search_mode' => $search_mode ?? '',

            'row' => $row ?? '',
            'pg' => $pg,
            'wDate' => $wDate,
            'writer' => $writer,
            'bbs_idx' => $bbs_idx,
            'hit' => $hit,
            'mode' => $mode
        ];

        return view('admin/_memberBoard/board_write', $data);
    }

    public function getBoardConfig($code)
    {
        $fsql = " select * from tbl_bbs_config where board_code='$code' ";

        $fresult = $this->connect->query($fsql);
        $frow = $fresult->getRowArray();
        if ($frow['tbc_idx'] == "") {
            exit();
        } else {
            $board_name = $frow['board_name'];
            $board_code = $frow['board_code'];
            $isCategory = $frow['is_category'];
            $isSecure = $frow['is_secure'];
            $isRight = $frow['is_right'];
            $isReply = $frow['is_reply'];
            $isComment = $frow['is_comment'];
            $isRecomm = $frow['is_recomm'];
            $isNotice = $frow['is_notice'];
            $skin = $frow['skin'];
            $is_comment = $frow['is_comment'];
        }
    }
}
