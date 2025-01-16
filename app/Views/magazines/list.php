<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <link rel="stylesheet" href="/css/magazines/magazines.css">
    <main id="container" class="sub magazines_page_">
        <div class="inner magazines_area_">
            <div class="magazines_breadcrumb_">
                <ul class="breadcrumb_">
                    <li class="breadcrumb_item_">
                        <a href="#"><img class="home_icon_" src="/images/ico/home_icon_14_12.png" alt=""></a>
                    </li>
                    <li class="breadcrumb_item_">
                        <img class="home_icon_" src="/images/ico/navi_icon_7_14.png" alt="">
                    </li>
                    <li class="breadcrumb_item_">
                        <a href="#">
                            <span>매거진</span>
                            <img class="circle_direct_" src="/images/ico/circle_direct_18_18.png" alt=""></a>
                    </li>
                </ul>
            </div>

            <div class="magazines_list_">
                <div class="magazines_list__top_">
                    <div class="magazines_list__top_left_">
                        <div class="total_">
                            총 상품
                            <span class="count_"><?=$nTotalCount?></span>
                        </div>
                    </div>

                    <div class="magazines_list__top_right_">
                        <div class="form_el_">
                            <select name="search_category" id="search_mode_" class="select_sort_">
                                <option value="subject" <?=$search_mode == "subject" ? "selected" : ""?>>제목</option>
                            </select>
                        </div>
                        <div class="form_el_">
                            <input type="text" class="input_search_" name="search_txt" id="search_word_"
                                value="<?=$search_word?>"
                                placeholder="검색어를 입력해 주세요">
                            <div class="icon_">
                                <img role="button" src="/images/ico/icon_search_23_22.png" alt="" class="icon_search_" id="icon_search_">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="magazines_list__content_">
                    <?php foreach ($magazines as $row) : ?>
                        <a href="/magazines/detail?m_idx=<?= $row['bbs_idx'] ?>" class="magazines_list__item_">
                            <img src="/data/bbs/<?= $row['ufile1'] ?>" alt="" class="magazines_list__item_image_">
                            <div class="magazines_list__item_title_ text_truncate_">
                                <?= $row['subject'] ?>
                            </div>
                            <div class="magazines_list__item_desc_">
                                <?=date('Y-m-d', strtotime($row['r_date']))?> (<?=dateToYoil($row['r_date'])?>) <span class="src_">|</span> <span class="view_"><?= $row['hit'] ?></span>
                            </div>
                            <div class="magazines_list__item_author_">
                                <?= $row['writer'] ?>
                            </div>
                        </a>
                    <?php endforeach; ?>

                    <!-- <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_02.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진99호]정글 감성 하이엔드 스테이, 인터컨티넨탈 ...
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a>

                    <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_03.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진 98] 위치 최고! 24년 오픈 신상 5성급 10만..
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a>

                    <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_04.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진 97호] 몽키트래블은 부채 0원, 신용도 AAA / ...
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a>

                    <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_05.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진 100호] 아마리 후아힌 천원대 찬스, 푸른 ...
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a>

                    <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_06.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진99호]정글 감성 하이엔드 스테이, 인터컨티넨탈 ...
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a>

                    <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_07.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진 98] 위치 최고! 24년 오픈 신상 5성급 10만..
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a>

                    <a href="/magazines/detail?m_idx=1" class="magazines_list__item_">
                        <img src="/images/magazines/magazines_list__item_image_08.png" alt=""
                             class="magazines_list__item_image_">
                        <div class="magazines_list__item_title_ text_truncate_">
                            [매거진 97호] 몽키트래블은 부채 0원, 신용도 AAA / ...
                        </div>
                        <div class="magazines_list__item_desc_">
                            2024-11-03(일) <span class="src_">|</span> <span class="view_">3885</span>
                        </div>
                        <div class="magazines_list__item_author_">
                            Younn
                        </div>
                    </a> -->
                </div>
                <?=$pager?>
            </div>
        </div>
    </main>
    <script>
        $("#icon_search_").click(function () {
            const search_mode = $("#search_mode_").val();
            const search_word = $("#search_word_").val();
            location.href = "/magazines/list?search_mode=" + search_mode + "&search_word=" + search_word
        })
    </script>
<?php $this->endSection(); ?>