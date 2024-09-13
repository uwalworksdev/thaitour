<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<link rel="stylesheet" href="/css/invoice/invoice.css" type="text/css">
<link rel="stylesheet" href="/css/invoice/invoice_responsive.css" type="text/css">

<div id="container" class="sub list_container">

    <section class="invoice_section">
        <div class="inner">
            <?php if ($visual['ufile6']) { ?>
                <div class="sub_visual" style="background-image: url('/data/bbs/<?= $visual['ufile6'] ?>');"></div>
            <?php } else { ?>
                <div class="sub_visual" style="display: none"></div>
            <?php } ?>
            <div class="sect_ttl_box">
                <h2>예약현황</h2>
            </div>
            <div class="flex notice_search">
                <form name="search" id="search">
                    <div class="evaluate_search flex">
                        <select name="search_category" class="evaluate_filter_selection">
                            <option value="order_user_name" <?php if ($search_mode == "order_user_name")
                                echo "selected"; ?>>
                                글쓴이</option>
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
            <table class="bs_table">
                <colgroup>
                    <col width="80px">
                    <col width="110px">
                    <col width="*">
                    <col width="110px">
                    <col width="110px">
                </colgroup>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>구분</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($nTotalCount == 0) {
                        ?>
                        <tr>
                            <td colspan=4 style="text-align:center;height:100px">검색된 결과가 없습니다.</td>
                        </tr>
                        <?php
                    }

                    foreach ($order_list as $row) {
                        ?>
                        <tr>
                            <td class="num"><span><?= $num--; ?></span></td>
                            <td class="ttl"><span><?= $row['code_name'] ?></span></td>
                            <td class="subject">
                                <!-- <span class="stt_1"><?= get_status_name($row["order_status"]) ?></span> -->
                                <?php
                                if (
                                    ($row['m_idx'] == session('member.mIdx'))
                                    || (session('member.idx') && session('member.id') == 'admin')
                                    || (session('member.idx') && session('member.level') <= 2)
                                ) {
                                    ?>
                                    <a href="./view_paid?order_idx=<?= $row['order_idx'] ?>"><?= strAsterisk($row["order_user_name"]) ?>님의
                                        여행예약이 <?= get_status_name($row["order_status"]) ?>되었습니다. <span
                                            class="red">(<?= $row['cmt_cnt'] ?>)</span></a>
                                    <?php
                                } else {
                                    $message = !session('member.idx') ? "로그인을 해주세요!" : "내가쓴글만 열람이 가능합니다.";
                                    ?>
                                    <a href="#" onclick="alert(`<?= $message ?>`);"><?= strAsterisk($row["order_user_name"]) ?>님의
                                        여행예약이 <?= get_status_name($row["order_status"]) ?>되었습니다. <span
                                            class="red">(<?= $row['cmt_cnt'] ?>)</span></a>&nbsp;<i></i>
                                    <?php
                                }

                                ?>


                            </td>
                            <td class="writer"><?= strAsterisk($row['order_user_name']) ?></td>
                            <td class="date"><?= date("Y.m.d", strtotime($row["order_r_date"])) ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <?php
                echo view("inc/popup_inc");
            ?>


            <div class="paging_wrap">
                <?php echo ipageListing2($pg, $nPage, 10, $currentUri . "?pg=", $deviceType) ?></div>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>