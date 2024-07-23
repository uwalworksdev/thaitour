<?php $this->extend('inc/layout_index'); ?>

<?php $this->section('content'); ?>
    <div class="body_container main_page_product_result_">
        <section class="inner">
            <div class="breadcrumbs_custom_">
                <ul>
                    <li>
                        <a href="#">
                            <img src="/images/ico/icon_home.png" alt="">
                            <img class="img_c" src="/images/ico/icon-right.png" alt="">
                            <p>호텔</p>
                        </a>
                    </li>
                    <li>
                        <a class="active_" href="#">
                            <img src="/images/ico/icon_btn_down.png" alt="">
                            <img class="img_c" src="/images/ico/icon-right.png" alt="">
                            <p>방콕</p>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="product_result_content_">
                <div class="product_result_content_left_">
                    <div class="product_result_content_left_header_">
                        방콕
                    </div>
                    <div class="main_product_result_content_left_">
                        <div class="list_option_select_">
                            <div class="select_option_item_">
                                <div class="select_option_item_header_">
                                    세부지역
                                </div>
                                <div class="select_option_item_content_">
                                    <ul>
                                        <li>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_result_content_right_">
                    <div class="product_result_content_right_header_">
                        <form action="" class="form_search_">
                            <div class="d-none">
                                <input type="date" class="startDay" id="startDay">
                                <input type="date" class="endDay" id="endDay">
                            </div>
                            <div class="form_element_ render_date_to_text_">
                                <div class="text_placeholder_">
                                    체크인/아웃
                                </div>
                                <div class="text_content_">
                                    <p>
                                        <span class="startDayRender">2024-07-9</span>(화)
                                    </p>
                                    <p>→</p>
                                    <p>
                                        <span class="endDayRender">2024-07-10</span>(수)
                                    </p>
                                </div>
                            </div>
                            <div class="form_element_">
                                <input type="text" id="hotel_name" name="hotel_name" class="form_input_"
                                       value="" placeholder="호텔명(미입력시 전체)">
                            </div>
                            <button class="btn_confirm_">
                                검색
                            </button>
                        </form>
                    </div>
                    <div class="main_product_result_content_right_">

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function () {

        })
    </script>
<?php $this->endSection(); ?>