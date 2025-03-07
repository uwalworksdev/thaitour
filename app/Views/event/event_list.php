<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>

<script src="/js/cms.js" type="text/javascript"></script>
<div id="container" class="sub event">

    <section class="event_sect">
        <div class="inner">
            <div class="sect_ttl_box">
                <h2>이벤트</h2>
            </div>
            <div class="tab_wrap">
                <ul>
                    <li class="on"> <a href="./event_list">이벤트 안내</a></li>
                    <li><a href="./winning_list">당첨자 발표</a></li>
                </ul>
            </div>
            <div class="contents">
                <div class="list_wrap event_list_wrap">
                    <ul class="flex col_3 mo_block_100" style="--mg-x: 15px; --mg-t: 40px; --mo-mg-t: 4rem ">
                        <?php
                        foreach ($event_list as $row) {
                            $toDay = date('Y-m-d');
                            if ($row['ufile6'] != '') {
                                $img = '/data/bbs/' . $row['ufile6'];
                            } else {
                                $img = '/data/product/noimg.png';
                            }
                            ?>
                            <li class="list_box">
                                <a href="./event_view?code=event&bbs_idx=<?= $row['bbs_idx'] ?>">
                                    <div class="thumb">
                                        <img src="<?= $img ?>" alt="<?= $row['rfile6'] ?>">

                                        <?php if ($row['e_date'] < $toDay) { ?>
                                            <div class="hover_active"><span>이벤트 종료</span></div>
                                        <?php } ?>
                                    </div>
                                    <div class="summary">
                                        <h3 class="subject"><?= $row['subject'] ?></h3>
                                        <p class="date"><span><?= $row['s_date'] ?></span> ~
                                            <span><?= $row['e_date'] ?></span>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <?php
                            $deviceType = get_device();
                        }
                        ?>
                    </ul>
                </div>
                <div class="paging_wrap">
                    <?php echo ipageListing2($page, $total_page, $total_cnt, $currentUri . "?category=$category&page=", $deviceType) ?>
                </div>
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