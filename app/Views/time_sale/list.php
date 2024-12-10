<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>

<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
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
                        <span>타임세일</span>
                        <img class="circle_direct_" src="/images/ico/circle_direct_18_18.png" alt=""></a>
                </li>
            </ul>
        </div>

        <div class="magazines_list_">
            <div class="magazines_list__top_">
                <div class="magazines_list__top_left_">
                    <div class="total_">
                        총 상품
                        <span class="count_">70</span>
                    </div>
                </div>

                <div class="magazines_list__top_right_">
                    <div class="form_el_">
                        <select name="search_category" id="search_mode_" class="select_sort_">
                            <option value="subject">제목</option>
                        </select>
                    </div>
                    <div class="form_el_">
                        <input type="text" class="input_search_" name="search_txt" id="search_word_"
                            value=""
                            placeholder="검색어를 입력해 주세요">
                        <div class="icon_">
                            <img role="button" src="/images/ico/icon_search_23_22.png" alt="" class="icon_search_" id="icon_search_">
                        </div>
                    </div>
                </div>
            </div>

            <div class="time_sale_list">
                <div class="time_sale_child" onclick="showPopup()">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_1.png" alt="time_sale_1">
                        <div class="time_status expired">
                            <i></i>
                            <span>타임세일 예약마감</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_2.png" alt="time_sale_2">
                        <div class="time_status expired">
                            <i></i>
                            <span>타임세일 예약마감</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_3.png" alt="time_sale_3">
                        <div class="time_status live">
                            <i></i>
                            <span>타임세일 준비중</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_4.png" alt="time_sale_4">
                        <div class="time_status expired">
                            <i></i>
                            <span>타임세일 예약마감</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_5.png" alt="time_sale_5">
                        <div class="time_status progress">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_6.png" alt="time_sale_6">
                        <div class="time_status live">
                            <i></i>
                            <span>타임세일 준비중</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_7.png" alt="time_sale_7">
                        <div class="time_status progress">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_8.png" alt="time_sale_8">
                        <div class="time_status progress">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_9.png" alt="time_sale_9">
                        <div class="time_status progress">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_10.png" alt="time_sale_10">
                        <div class="time_status expired">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_11.png" alt="time_sale_11">
                        <div class="time_status expired">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_sale_child">
                    <div class="time_sale_img">
                        <img src="/images/time_sale/time_sale_12.png" alt="time_sale_12">
                        <div class="time_status live">
                            <i></i>
                            <span>타임세일 진행중</span>
                        </div>
                        <div class="coating"></div>
                    </div>
                    <h4 class="ttl">클리닉 웰니스 스파 -시암 스퀘어 원 로얄 타이 마사지 90분 20% 할인</h4>
                    <div class="tools">
                        <p class="date">2024-12-09(월)</p>
                        <div class="tools_list">
                            <div class="tools_el like">
                                <i></i>
                                <span>0</span>
                            </div>
                            <div class="tools_el view">
                                <i></i>
                                <span>10</span>
                            </div>
                            <div class="tools_el comment">
                                <i></i>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
                echo ipagelistingSub(1, 3, 12, current_url() . "?pg=")
            ?>
        </div>
    </div>
</main>

<div class="popup_wrap comment_pop">
    <div class="pop_box">
        <button type="button" class="close" onclick="closePopup()"></button>
        <div class="pop_body">
            <div class="padding">
                <div class="popup_place__head">
                    <div class="popup_place__head__ttl">
                        <h2>취소 규정</h2>
                    </div>
                </div>
                <div class="popup_place__body">
                </div>
            </div>
        </div>
    </div>
    <div class="dim"></div>
</div>
<script>
    function showPopup() {
        $(".comment_pop").show();
    }

    function closePopup() {
        $(".comment_pop").hide();
    }
</script>
<?php $this->endSection(); ?>