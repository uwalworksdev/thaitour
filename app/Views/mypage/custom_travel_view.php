<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php

    $connect = db_connect();
    $r_code = "contact";
    $idx = updateSQ($_GET['idx']);
    $pw = updateSQ($_POST['pw']);
    $r_idx = $idx;

if ($idx) {
    $total_sql = " select * from tbl_inquiry 
                        where idx='" . $idx . "'";
    $row = $connect->query($total_sql)->getRowArray();


    if ($_POST['check_pass'] === 'Y' || $pw == $row['passwd']) {

    } else if ($row['user_id'] == "0" || !$row['user_id']) {
        ?>
            <div class="popup_wrap edit_input_pop" style="display: block">
                <form id="view_inquiry_frm" class="pop_box" action="/mypage/custom_travel_view?idx=<?=$r_idx?>" method="post">
                    <button type="button" class="close" onclick="closePopup()"></button>
                    <div class="pop_body">
                        <div class="padding">
                            <div class="pop_txt">
                                <p>비밀번호를 입력해주세요.</p>
                            </div>
                            <div class="pop_input flex_c_c">
                                <input type="text" name="pw" id="pw">
                            </div>
                            <?php
                            if ($pw && $pw != $row['passwd']) {
                                ?>
                                <div class="wrong_alert">비밀번호 일치지않았습니다.</div>
                                <?php
                            }
                            ?>
                            <div class="pop_input flex_c_c">
                                <button type="button" class="default_btn" onclick="closePopup()">취소</button>      
                                <button type="submit" class="default_btn">확인</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="dim"></div>
            </div>
            <script>
                function closePopup() {
                    $('.popup_wrap').hide();
                    history.back(1);
                }
            </script>
        <?php
        die();
    } elseif ($row['user_id'] != session('member.idx') or !session('member.idx')) {
                echo "
            <script>
                alert('비밀번호 올바르게 입력해주세요!');
                location.href = '/t-travel/item_list';
            </script>
        ";
        die();
    }





    foreach ($row as $key => $value) {
        ${$key} = $value;
    }

    $user_name_kor = sqlSecretConver($row["user_name_kor"], 'decode');
    $user_name_eng = sqlSecretConver($row["user_name_eng"], 'decode');
    $user_phone = sqlSecretConver($row["user_phone"], 'decode');
    $user_email = sqlSecretConver($row["user_email"], 'decode');

}
// 공지사항 게시판
?>
<link rel="stylesheet" href="/css/travel/sub_travel.css" type="text/css">
<link rel="stylesheet" href="/css/travel/sub_travel_responsive.css" type="text/css">

<section class="travel_info travel_info_detail view_container">
    <div class="inner">
    <h1 class="inquy_title">맞춤여행</h1>
        <p class="reg_date">
            <?= date("Y.m.d", strtotime($r_date)) ?>
        </p>
        <p class="top_ttl">
            여행자 기본정보
        </p>

        <form action="./inquiry_ok.php" id="reg_mem_fm" name="reg_mem_fm" enctype="multipart/form-data" method="post">
            <input type="hidden" name="user_id" value="7433">
            <table class="table_form">
                <colgroup>
                    <col width="125px">
                    <col width="*">
                    <col width="125px">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th>여행 인원</th>
                        <td>
                            <pre>성인: <?= $travel_person1 ?>       어린이: <?=$travel_person2 ? $travel_person2 : 0 ?>       유아: <?=$travel_person3 ? $travel_person3 : 0 ?></pre>
                        </td>
                        <th>예약번호</th>
                        <td>
                            <?= $id_checking ?>
                        </td>
                    </tr>
                    <tr>
                        <th>여행자 성함</th>
                        <td>
                            <?= $user_name_kor ?> /
                            <?= $user_name_eng ?>
                        </td>
                        <th>전화번호</th>
                        <td>
                            <?= $user_phone ?>
                        </td>
                    </tr>
                    <tr>
                        <th>생년월일</th>
                        <td>
                            <?= $birthday ?>
                        </td>
                        <th>이메일</th>
                        <td>
                            <?= $user_email ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="name_per_travel">
                <?php

                $sql_mem = "select * from tbl_inquiry_companion where inquiry_idx = $idx";

                $result_mem = $connect->query($sql_mem)->getResultArray();

                $nn = 1;
                foreach ($result_mem as $row) {
                    ?>
                    <p class="title">
                        동반여행자
                        <?= $nn ?>
                    </p>
                    <table class="table_form traveler traveler1">
                        <colgroup>
                            <col width="125px">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>여행자 성함</th>
                                <td>
                                    <?= sqlSecretConver($row['user_name_kor'], 'decode') ?> /
                                    <?= sqlSecretConver($row['user_name_eng'], 'decode') ?>
                                </td>
                            </tr>
                            <tr>
                                <th>생년월일</th>
                                <td>
                                    <?= $row['birthday'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    $nn++;
                }

                ?>
            </div>
            <p class="title">여행 정보</p>
            <table class="table_form info">
                <colgroup>
                    <col width="170px">
                    <col width="*">
                    <col width="170px">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th>여행목적</th>
                        <td>
                            <?= $travel_purpose ?>
                        </td>
                        <th>계획중인 여행지역</th>
                        <td>
                            <?= nl2br($planned_travel_area) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>여행자 유형</th>
                        <td>
                            <?= $travel_type ?>
                        </td>
                        <th>1인당 예산</th>
                        <td>
                            <?= $one_charge ?>
                        </td>
                    </tr>
                    <tr>
                        <th>희망 출발일~ 귀국일</th>
                        <td colspan="3">
                            <?= $departure_date ?> ~
                            <?= $arrival_date ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="title">항공권 정보</p>
            <table class="table_form flight">
                <colgroup>
                    <col width="170px">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th>항공권 소지여부</th>
                        <td>
                            <?= ($air_yn == "Y" ? "소지하고 있습니다." : "소지하고 있지 않습니다.") ?>
                        </td>
                    </tr>
                    <?php
                    if ($air_yn == "Y") {
                        ?>
                        <tr>
                            <th>소지하신 항공스케쥴</th>
                            <td>
                                <?= nl2br($flight_schedule) ?>
                            </td>
                        </tr>
                    <?php
                    } else {
                        ?>
                        <tr>
                            <th>선호항공</th>
                            <td>
                                <?= $hope_air_type ?>
                            </td>
                        </tr>
                        <tr>
                            <th>좌석등급</th>
                            <td>
                                <?= $hope_air_class ?>
                            </td>
                        </tr>
                        <tr>
                            <th>그외 사항</th>
                            <td>
                                <?= nl2br($air_other_matters) ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <p class="title">숙박 정보</p>
            <table class="table_form">
                <colgroup>
                    <col width="170px">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th>선호 숙소</th>
                        <td>
                            <?= $sel_hotel ?>
                        </td>
                    </tr>
                    <tr>
                        <th>선호 등급</th>
                        <td>
                            <?= $hotel ?>
                        </td>
                    </tr>
                    <tr>
                        <th>그 외 사항</th>
                        <td style="word-break: break-all;">
                            <?= nl2br($accom_other_master) ?>
                        </td>
                    </tr>
                </tbody>

            </table>

            <p class="title">기타사항</p>
            <table class="table_form">
                <colgroup>
                    <col width="170px">
                    <col width="*">
                </colgroup>
                <tbody>
                    <tr>
                        <th>기타 요청사항</th>
                        <td style="word-break: break-all;">
                            <?= nl2br($other_requests) ?>
                        </td>
                    </tr>
                    <tr>
                        <th>방문경로</th>
                        <td>
                            <?= $visit_routes ?>
                        </td>
                    </tr>
                </tbody>

            </table>
        </form>
        <div class="comment_box">
                <div class="comment_box-top">
                    <div class="comment_box-count">
                        <span>댓글</span>
                        <span id="comment_count">(0)</span>
                    </div>
                    <form action="" name="com_form" id="frm" class="frm">
                        <input type="hidden" name="r_idx" value="<?= $idx ?>">
                        <input type="hidden" name="code" id="code" value="inquiry">
                        <input type="hidden" name="r_code" id="r_code" value="inquiry">
                        <div class="comment_box-input flex">
                            <textarea style="resize:none" class="bs-input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
                            <button type="button" onclick="fn_comment(<?= session('member.idx')?>)" class="btn btn-point comment_btn">등록</button>
                        </div>
                    </form>
                </div>
                <div class="comment_box-details" id="comment_list">
                    <?php
                        $r_code = "inquiry";
                        $r_idx  = $idx;

                        // include $_SERVER['DOCUMENT_ROOT'] . "/include/comment_list.php" 
                    ?>
                </div>
        </div>
        <div class="btn_submit flex__c">
            <a href="/t-travel/item_list" type="button" class="btn" id="btn_submit_inquiry">목록으로</a>
        </div>
    </div>
</section>
<script>
    const r_code = "inquiry";
    const r_idx = "<?=$idx?>";
</script>
<script src="/js/comment.js"></script>
<?php $this->endSection(); ?>
