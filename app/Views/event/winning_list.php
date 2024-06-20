<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<script src="/js/cms.js" type="text/javascript"></script>
<div id="container" class="sub event">

    <section class="event_sect">
        <div class="inner">
            <div class="sect_ttl_box">
                <h2>이벤트</h2>
            </div>
            <div class="tab_wrap mb-lg">
                <ul>
                    <li> <a href="./event_list">이벤트 안내</a></li>
                    <li class="on"><a href="./winning_list">당첨자 발표</a></li>
                </ul>
            </div>
            <div class="content">
                <div class="event_list">
                    <table class="bs_table">
                        <colgroup>
                            <col width="80px">
                            <col width="*">
                            <col width="110px">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>제목</th>
                                <th>발표일</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($winning_list as $row) {
                                ?>
                                <tr>
                                    <td class="num"><span><?= $num-- ?></span></td>
                                    <td class="subject"><a
                                            href="./event_view?code=winner&bbs_idx=<?= $row['bbs_idx'] ?>"><?= $row['subject'] ?><span
                                                class="red"><?php echo '(' . $row['comment_cnt'] . ')' ?></span></a></td>
                                    <td class="date"><?= date("Y.m.d", strtotime($row['r_date'])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="paging_wrap">
                <?php echo ipageListing2($pg, $nPage, $g_list_rows, $currentUri . "?category=$category&pg=") ?>
            </div>

        </div>
    </section>
</div>
<script>
    $('.event_tab ul li').on('click', function () {
        $(this).siblings().removeClass('on');
        $(this).addClass('on');
    })
</script>
<?php $this->endSection(); ?>