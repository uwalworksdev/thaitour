<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
<link rel="stylesheet" href="/css/magazines/magazines.css">
<main id="container" class="sub magazines_page_">
    <div class="inner magazines_area_">
        <!-- <div class="magazines_breadcrumb_">
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
            </div> -->
        <div class="sect_ttl_box">
            <h2>프로모션</h2>
        </div>

        <div class="magazines_list_">
            <div class="magazines_list__top_">
                <div class="magazines_list__top_left_">
                    <div class="total_">
                        총 상품
                        <span class="count_">5</span>
                    </div>
                </div>

                <div class="magazines_list__top_right_">
                    <div class="form_el_">
                        <select name="search_category" id="search_mode_" class="select_sort_">
                            <option value="subject">제목</option>
                        </select>
                    </div>
                    <div class="form_el_">
                        <input type="text" class="input_search_" name="search_txt" id="search_word_" value="" placeholder="검색어를 입력해 주세요">
                        <div class="icon_">
                            <img role="button" src="/images/ico/icon_search_23_22.png" alt="" class="icon_search_" id="icon_search_">
                        </div>
                    </div>
                </div>
            </div>
            <div class="magazines_list__content_">
                <a href="/promotion" class="magazines_list__item_">
                    <img src="/data/bbs/20250620171833458.jpg" alt="" class="magazines_list__item_image_">
                    <div class="magazines_list__item_title_ text_truncate_">
                        매거진 5 </div>
                    <div class="magazines_list__item_desc_">
                        2025-06-20 (금) <span class="src_">|</span> <span class="view_">36</span>
                    </div>
                    <div class="magazines_list__item_author_">
                        관리자 </div>
                </a>
                <a href="/promotion" class="magazines_list__item_">
                    <img src="/data/bbs/20250527191949650.jpg" alt="" class="magazines_list__item_image_">
                    <div class="magazines_list__item_title_ text_truncate_">
                        매거진4 </div>
                    <div class="magazines_list__item_desc_">
                        2025-05-27 (화) <span class="src_">|</span> <span class="view_">26</span>
                    </div>
                    <div class="magazines_list__item_author_">
                        관리자 </div>
                </a>
                <a href="/promotion" class="magazines_list__item_">
                    <img src="/data/bbs/20250527191849038.jpg" alt="" class="magazines_list__item_image_">
                    <div class="magazines_list__item_title_ text_truncate_">
                        매거진3 </div>
                    <div class="magazines_list__item_desc_">
                        2025-05-27 (화) <span class="src_">|</span> <span class="view_">28</span>
                    </div>
                    <div class="magazines_list__item_author_">
                        관리자 </div>
                </a>
                <a href="/promotion" class="magazines_list__item_">
                    <img src="/data/bbs/20250527191658510.jpg" alt="" class="magazines_list__item_image_">
                    <div class="magazines_list__item_title_ text_truncate_">
                        매거진2 </div>
                    <div class="magazines_list__item_desc_">
                        2025-05-27 (화) <span class="src_">|</span> <span class="view_">21</span>
                    </div>
                    <div class="magazines_list__item_author_">
                        관리자 </div>
                </a>
                <a href="/promotion" class="magazines_list__item_">
                    <img src="/data/bbs/20250527191624097.jpg" alt="" class="magazines_list__item_image_">
                    <div class="magazines_list__item_title_ text_truncate_">
                        매거진1 </div>
                    <div class="magazines_list__item_desc_">
                        2025-05-27 (화) <span class="src_">|</span> <span class="view_">18</span>
                    </div>
                    <div class="magazines_list__item_author_">
                        관리자 </div>
                </a>

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
            <!-- DEBUG-VIEW START 1 APPPATH/Views/Pagers/custom1.php -->

            <div class="pagination_">
                <div class="customer-center-page">
                    <div class="pagination">
                        <a class="page-link" href="javascript:void(0);" aria-label="First"><img src="/images/community/pagination_prev.png" alt="pagination_prev">
                        </a>
                        <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                            <img src="/images/community/pagination_prev_s.png" alt="pagination_prev">
                        </a>
                        <a class="page-link active" href="https://thetourlab.com/magazines/list?page=1">
                            1 </a>
                        <a class="page-link" href="javascript:void(0);" aria-label="Next"><img src="/images/community/pagination_next_s.png" alt="pagination_next">
                        </a>
                        <a class="page-link" href="javascript:void(0);" aria-label="Last">
                            <img src="/images/community/pagination_next.png" alt="pagination_next">
                        </a>
                    </div>
                </div>
            </div>
            <!-- DEBUG-VIEW ENDED 1 APPPATH/Views/Pagers/custom1.php -->
        </div>
    </div>
</main>
<script>
    $("#icon_search_").click(function() {
        const search_mode = $("#search_mode_").val();
        const search_word = $("#search_word_").val();
        location.href = "/magazines/list?search_mode=" + search_mode + "&search_word=" + search_word
    })
</script>
<?php $this->endSection(); ?>