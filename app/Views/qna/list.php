<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php


$r_code = "qna";

// 공지사항 게시판
?>
<link href="/css/qna/travel.css" rel="stylesheet" type="text/css" />
<link href="/css/qna/travel_responsive.css" rel="stylesheet" type="text/css" />
<section class="travel_section_1">
    <div class="inner">
        <?php if ($visual) { ?>
            <a href="<?= $visual['url'] ?>" id="myLink">
                <?php if ($visual['ufile6']) { ?>
                    <div class="ttl_img" style="background-image: url('/data/bbs/<?= $visual['ufile6'] ?>');"></div>
                <?php } else { ?>
                    <div class="ttl_img" style="display: none"></div>
                <?php } ?>
            </a>
        <?php } ?>
        <div class="ttl_box">
            <h1>1:1 여행상담</h1>
        </div>
        <div class="flex notice_search">
            <form name="search" id="search">
                <div class="evaluate_search flex">
                    <select name="search_category" class="evaluate_filter_selection">
                        <option value="title" <?php if ($search_category == "title")
                            echo "selected"; ?>>제목</option>
                        <option value="contents" <?php if ($search_category == "contents")
                            echo "selected"; ?>>내용</option>
                        <option value="user_name" <?php if ($search_category == "user_name")
                            echo "selected"; ?>>글쓴이
                        </option>
                    </select>
                    <input type="text" name="s_txt" value="<?= $s_txt ?>">
                    <button class="search_button" type="button" onclick="search_it()">검색</button>
                </div>
            </form>
        </div>
        <script>
            function search_it() {
                var frm = document.search;
                frm.submit();
            }
        </script>
        <table class="status_table">
            <colgroup>
                <col width="10%">
                <col width="*">
                <col width="10%">
                <col width="10%">

            </colgroup>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>제목</th>
                    <th>작성자</th>
                    <th>등록일</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($total_cnt == 0) {
                    ?>
                    <tr>
                        <td colspan=4 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                    </tr>
                    <?php
                }
                $now = strtotime(date("Y-m-d H:i:s"));

                foreach ($list_qna as $row) {

                    $time = strtotime($row['r_reg_date']);
                    $diff_time = $now - $time;
                    $is_new = $diff_time < (24 * 60 * 60) ? "<i></i>" : "";
                    $href = "#!";

                    if ($row["passwd_yn"] == "Y") {
                        $href = "javascript:showCheckPass('$row[idx]')";
                    } else {
                        $href = "./travel_view?idx=$row[idx]";
                    }

                    ?>
                    <tr>
                        <td class="id_2"><?= $no ?></td>
                        <td class="des travel_des">
                            <?php
                            if (
                                (session('member.idx') && $row["reg_m_idx"] == session('member.idx'))
                                || (session('member.idx') && session('member.id') == 'admin')
                                || (session('member.idx') && session('member.level') <= 2)
                            ) {
                                echo "<a href='./view?idx=$row[idx]'>$row[title]</a>";
                            } else {
                                $message = !session('member.idx') ? "로그인을 해주세요!" : "내가쓴글만 열람이 가능합니다.";
                                echo "<a href='#' onclick='alert(`$message`);'>$row[title]</a><i></i>";
                            }
                            ?>
                            <span class="red">(<?= $row['cmt_cnt'] ?>)</span>
                        </td>
                        <td class="writer"><?= strAsterisk(sqlSecretConver($row['user_name'], 'decode')) ?></td>
                        <td class="date"><?= date("Y.m.d", strtotime($row['r_date'])) ?></td>
                    </tr>
                    <?php
                    $no--;
                }
                ?>
            </tbody>
        </table>

        <div class="paging_wrap">
            <?php echo ipageListing2($page, $total_page, 10, $currentUri . "?search_mode=" . $search_mode . "&search_word=" . $search_word . "&page=", $deviceType) ?>
            <a href="./write" class="contact_btn">문의하기</a>
        </div>

        <div class="popup_wrap edit_input_pop">
            <form id="view_inquiry_frm" class="pop_box" action="./inquiry_view" method="post">
                <button type="button" class="close" onclick="closePopup()"></button>
                <div class="pop_body">
                    <div class="padding">
                        <div class="pop_txt">
                            <p>비밀번호를 입력해주세요.</p>
                        </div>
                        <div class="pop_input flex_c_c">
                            <input type="text" name="pw" id="pw">
                        </div>
                        <div class="pop_input flex_c_c">
                            <button type="button" class="default_btn" onclick="closePopup()">취소</button>
                            <button type="submit" class="default_btn">확인</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="dim"></div>
        </div>
    </div>
</section>

<script>

    
    $(".contact_btn").on("click", function () {
        event.preventDefault();

        <?php if(empty(session()->get("member")["id"])) { ?>
            showOrHideLoginItem().then(() => { 
                location.href = '/qna/write'; 
            }).catch(error => {
                console.error("fail:", error);
            });

            return false;
        <?php } ?>

        location.href = '/qna/write';
    })
    function showCheckPass(idx) {
        $("#view_inquiry_frm").attr("action", `./inquiry_view?idx=${idx}`)
        $('.edit_input_pop').show();
    }

    function closePopup() {
        $('.popup_wrap').hide();
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myLink = document.getElementById("myLink");

        if (myLink.getAttribute("href") === "") {
            myLink.addEventListener("click", function (event) {
                event.preventDefault();
            });
        }
    });
</script>
<?php $this->endSection(); ?>