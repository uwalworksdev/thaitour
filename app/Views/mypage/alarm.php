<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
if ($_SESSION["member"]["mIdx"] == "") {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

$m_idx = $_SESSION['member']['mIdx'];
$db = \Config\Database::connect();
$sql = "SELECT 
            COUNT(*) AS total,
            SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS count_status_0
        FROM tbl_alarm 
        WHERE m_idx = '$m_idx'";

$result = $db->query($sql)->getRow();
$count_all = $result->total ?? 0;
$count_status_0 = $result->count_status_0 ?? 0;

$list_alarm = $db->table('tbl_alarm')->where('m_idx', $m_idx)->orderBy('r_date', 'DESC')->get()->getResultArray();
?>
<style>
    .cancel .btn.btn-lg {
        height: 45px;
        font-size: 16px;
    }

    .cancel a.btn.btn-lg {
        line-height: 45px;
    }

    .ch_visit input[type="radio"], .ch_visit input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    z-index: -1;
    display: block;
    }
    
    .text_bold td{
        font-weight: 700;
    }

    @media screen and (max-width: 850px) {

        .cancel .btn.btn-lg {
            height: 2.4615rem;
            font-size: 0.6667rem;
        }

        .cancel a.btn.btn-lg {
            line-height: 2.4615rem;
            margin: 0;
            width: 14.3333rem;
            height: 5rem;
            line-height: 5rem;
            font-size: 2.6667rem;
            margin-right: 1.2rem;
        }
    }

    @media screen and (max-width: 850px) {

        .mypage_container .mypage_wrap .gnb_menu {
            flex-basis: 0 !important;
            flex-shrink: 0;
        }

        .gnb_menu_list {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 1.3684rem 0;
            display: none;
            background-color: #fff;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            z-index: 10;
            margin-top: 0;
            padding: 0 2.9999rem 2.6rem;
        }

        .now_tab_text {
            width: 100%;
            height: 7.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 2.2534rem;
            font-weight: 700;
            background: var(--bs-point) url(/images/btn/arrow_down_m.png) no-repeat right 1.7316rem center/ auto;
            background-size: 2.4001rem 1.6999rem;
        }


        .gnb_menu_list li {
            width: 100%;
            height: 100%;
            border: none;
            text-align: center;
            color: #000;
            font-size: 2.2534rem;
            font-weight: 400;
            background-color: transparent;
            border-bottom: 0.1999rem solid #dbdbdb !important;
        }

        .gnb_menu_list li:last-child {
            border-bottom: none;
        }

        .mypage_container .gnb_menu {
            position: relative;
            overflow-y: visible;
        }

        .mypage_container .gnb_menu_list>li .menu_level_1 {
            height: 7.3666rem;
            border-bottom: none;
            justify-content: center;
        }

        .mypage_container .gnb_menu_list>li .menu_level_1.has_submenu {
            background: url(../assets/img/ico/gnb_menu_list_w.png) no-repeat right 1.7316rem center/ auto;
            background-size: 1.9999rem 1rem;
        }

        .mypage_container .gnb_menu_list>li .menu_level_1 .btn_togle {
            display: none;
        }

        .mypage_container .gnb_menu li .menu_level_1 a {
            font-size: 2.6rem;
            font-family: "Noto Sans KR";
            font-weight: 400;
            color: #252525;
        }

        .mypage_container .gnb_menu li .menu_level_2 a {
            font-size: 2.6rem;
            font-family: "Noto Sans KR";
            font-weight: 400;
            color: #656565;
        }

        .gnb_menu_list>li .menu_level_2 {
            flex-direction: column !important;
            border-bottom: none !important;
            padding: 2.9999rem 0 !important;
            color: #656565 !important;
            gap: 2.9999rem !important;
            background-color: #fafafa !important;
            border-top: 0.1999rem solid #dbdbdb !important;
        }

        .mypage_container .content .details_table.mo colgroup {
            display: none;
        }

        .mypage_container .content .details_table.mo tbody tr .check {
            width: 4.0001rem;
        }

        .mypage_container .content .details_table.mo tbody tr .des {
            order: 0;
            flex-basis: 93%;
            padding-left: 2.4001rem;
        }

        .mypage_container .content .details_table.mo tbody tr .des a {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            word-break: break-all;
            height: 3.8399rem;
            line-height: 1.5;
            text-align: left;
        }

        .mypage_container .content .details_table.mo tbody tr .stt {
            text-align: center;
            color: #999999;
            font-size: 2.4001rem;
            font-weight: 500;
        }

        .mypage_container .content .details_table.mo tbody tr .no {
            display: none;
        }

        .mypage_container .content .details_table.mo tbody tr .num {
            text-align: center;
            color: #454545;
            order: 2;
            padding-right: 2.3rem;
            position: relative;
        }

        .mypage_container .content .details_table.mo tbody tr .num::before {
            content: '구분: ';
            font-size: 2.6rem;
            color: #454545;
        }

        .mypage_container .content .details_table.mo tbody tr .num::after {
            width: 0.1999rem;
            height: 2.08rem;
            background-color: #757575;
            content: '';
            position: absolute;
            right: 0.9799rem;
            top: 0.3754rem;
        }

        .mypage_container .content .details_table.mo tbody tr .stt {
            text-align: center;
            color: #454545;
            order: 3;
            padding-right: 2.3rem;
            position: relative;
        }


        .mypage_container .content .point_table tbody tr .history span {
            height: 100% !important;
        }


        .mypage_container .content .details_table.mo tbody tr .stt::before {
            content: '상태: ';
            font-size: 2.6rem;
            color: #454545;
            font-weight: 400;
        }

        .mypage_container .content .details_table.mo tbody tr .stt::after {
            width: 0.1999rem;
            height: 2.08rem;
            background-color: #757575;
            content: '';
            position: absolute;
            right: 0.9799rem;
            top: 0.22rem;
        }

        .mypage_container .content .details_table.mo tbody tr .date {
            text-align: left;
            color: #454545;
            order: 4;
            padding-right: 2.3rem;
            width: 35.4rem;
            padding: 0 !important;
        }

        .mypage_container .content .details_table.mo tbody tr .date.spe {
            padding: 0 !important;
            text-align: left;
            width: fit-content;
        }

        .mypage_container .content .details_table.mo tbody tr .date::before {
            content: '등록일: ';
            font-size: 2.6rem;
            color: #454545;
        }

        .mypage_container .content .details_table.mo tbody tr .date.spe::before {
            content: unset;
            font-size: 2.6rem;
            color: #454545;
        }

        .mypage_container .content .details_table.mo tbody tr .date::after {
            display: none;
        }

        .ch_visit input[type="radio"]+label::after, .ch_visit input[type="checkbox"]+label::after {
        content: "";
        position: absolute;
        background-color: #fff;
        background-position: center;
        background-repeat: no-repeat;
        border: 0.0769rem solid var(--bs-gray-200);
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 0.0769rem;
    }

    .ch_visit input[type="radio"]+label::before, .ch_visit input[type="checkbox"]+label::before {
        content: "";
        width: 1.41rem;
        height: 2.1rem;
        position: absolute;
        left: 0.2308rem;
        top: calc(50% - 0.5692rem);
        border-radius: 0.0769rem;
        border: 0.538rem solid transparent;
        transform: rotate(45deg) translateY(-50%);
        border-top: none;
        opacity: 0;
        border-left: none;
        z-index: 10;
    }
    }
</style>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<script src="/mypage/mypage.js" type="text/javascript"></script>
<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
                echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_10" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table">알림</h1>
                <div class="box_gr01 clearfix">
                    <p class="my_p_cont f_black mb0">
                        <span class="pr50 f_black">※나만의 알리미는 30 일간 보관합니다.</span>
                        읽지 않은 알림 : <span class="ltsno alarm_unread_org"><?=$count_status_0?></span>   
                        <em>|</em> <br class="only_mo">
                        총 알림갯수 : <span class="ltsno"><?=$count_all?></span>
                    </p>
                </div>
                <form id="alarmForm"></form>
                <table class="details_table mo">
                    <colgroup>
                        <col width="5%">
                        <col width="*">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th style="">
                                <div class="ch_visit">
                                    <input type="checkbox" id="agree1" class="agree1" name="agree">
                                    <label for="agree1"></label>
                                </div>
                            </th>
                            <th>알림내용</th>
                            <th>등록한 날짜</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($count_all == 0):?>
                        <tr style="text-align:center">
                            <td colspan="3" class="none_data">알림이 존재하지 않습니다.</td>
                        </tr>
                        <?php else:?>
                            <?php foreach($list_alarm as $item):?>
                                 <tr style="text-align: center; vertical-align: middle" class="<?= $item['status'] == 0 ? 'text_bold' : ''?>">
                                    <td class="check">
                                        <div class="ch_visit">
                                                <input type="checkbox" id="<?= $item['idx'] ?>" class="agree" name="agree">
                                                <label for="<?= $item['idx'] ?>"></label>
                                        </div>
                                    </td>
                                    <td><?=$item['contents']?></td>
                                    <td><?=date('Y.m.d H:i', strtotime($item['r_date']))?></td>
                                </tr>
                            <?php endforeach?>
                        <?php endif;?>
                    </tbody>
                </table>
                </form>
                <?php echo ipageListing2($page, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?pg=") ?>

                <div class="btn_custom flex_b_c">
                    <button class="custom_btn1 b_white b_p1020" onclick="check_readen()">읽음 표시</button>
                    <div class="flex__c" style="gap: 5px;">
                        <button class="custom_btn1 b_white b_p1020" onclick="del_all()">전체삭제</button>
                        <button class="custom_btn1 b_white b_p1020" onclick="del_select()">선택삭제</button>
                        <button class="custom_btn1 b_white b_p1020" onclick="deL_readen()">읽은 알림 삭제</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('#agree1').click(function() {
        var x = [];
        x = document.getElementsByClassName("agree");
        var y = document.getElementById("agree1");
        if (y.checked == true) {
            for (let i = 0; i < x.length; i++) {
                x[i].checked = true;
            }
        } else {
            for (let i = 0; i < x.length; i++) {
                x[i].checked = false;
            }
        }
    });

    function check_readen(){
        var x = [],
            y = [];
        x = document.getElementsByClassName("agree");
        a = document.getElementById("agree1");
        for (let i = 0; i < x.length; i++) {
            if (x[i].checked == true) {
                y.push(x[i].id);
            }
        }
        
        $.ajax({
            type: 'POST',
            url: '/api/alarm/mark-read',
            data: {
                data: y
            },
            success: function(response) {
                if(response.success ==  true){
                    alert("업데이트 성공!");
                    location.reload();
                }
            },
            error: function(error) {
                alert("ERROR!");
            }
        });
    }

    function del_all(){
        if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/api/alarm/del-all',
            success: function(response) {
                if(response.success ==  true){
                    alert("삭제되었습니다!");
                    location.reload();
                }
            },
            error: function(error) {
                alert("ERROR!");
            }
        });
    }

    function del_select(){
         if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            return;
        }
        var x = [],
            y = [];
        x = document.getElementsByClassName("agree");
        a = document.getElementById("agree1");
        for (let i = 0; i < x.length; i++) {
            if (x[i].checked == true) {
                y.push(x[i].id);
            }
        }
        
        $.ajax({
            type: 'POST',
            url: '/api/alarm/del-select',
            data: {
                data: y
            },
            success: function(response) {
                if(response.success ==  true){
                    alert("삭제되었습니다!");
                    location.reload();
                }
            },
            error: function(error) {
                alert("ERROR!");
            }
        });
    }

    function deL_readen(){
         if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            return;
        }
       
        $.ajax({
            type: 'POST',
            url: '/api/alarm/del-readen',
            success: function(response) {
                if(response.success ==  true){
                    alert("삭제되었습니다!");
                    location.reload();
                }
            },
            error: function(error) {
                alert("ERROR!");
            }
        });
    }
</script>
<?php $this->endSection(); ?>