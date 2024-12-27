<link rel="stylesheet" type="text/css" href="/lib/daterangepicker/daterangepicker_custom.css"/>
<script type="text/javascript" src="/lib/momentjs/moment.min.js"></script>
<script type="text/javascript" src="/lib/daterangepicker/daterangepicker.min.js"></script>

<style>
    .daterange_picker {
        width: 1px !important;
        height: 1px !important;
        background-color: transparent !important;
        padding: 0 !important;
        border: none !important;
        margin: auto;
        position: relative;
        bottom: 20px;
    }
    .form_gr_ {
        width: 500px;
        gap: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #dbdbdb;
        border-radius: 6px;
    }

    .popup_wraper .form_element_ .form_gr_item_ {
        max-width: unset;
        max-height: 75px;
        overflow: hidden;
    }

    .popup_wraper .form_element_ .form_gr_item_ input {
        border: hidden;
    }

    .popup_wraper .form_element_ .form_gr_item_flex_ label {
        left: unset;
        right: 20px;
    }

    .popup_wraper .form_element_ .form_gr_item_flex_ input {
        text-align: end;
    }

    .popup_wraper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 99999;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
    }

    .popup_wraper.show {
        display: block;
    }

    .popup_wraper .popup_container {
        background: #fafafa;
        width: 1200px;
        min-height: 180px;
        border: 1px solid #eee;
        padding: 15px;
        padding-top: 38px;
        padding-bottom: 30px;
        z-index: 1200;
        box-sizing: border-box;
        margin: 0 auto;
        margin-top: 78px;
        position: relative;
        border: 1px solid #17469E;
        border-radius: 10px;
        max-height: 750px;
        overflow-y: scroll
    }


    .popup_wraper .list_tab_select {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 30px;
    }
    .popup_wraper .item_tab {
        padding: 11px 25px;
        font-size: 19px;
        background: #fff;
        border: 1px solid #dbdbdb;
        border-radius: 10px;
        cursor: pointer;
    }

    .popup_wraper .item_tab.active {
        background-color: #17469E;
        color : #fff;
    }

    .popup_wraper .btn_close_popup {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        color: #fff;
        cursor: pointer;
    }

    .popup_header .form_element_ {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0;
        border-radius: 16px;
        background-color: #ffffff;
        padding: 20px;
        gap: 12px;
    }

    .popup_header .form_element_ .form_input_ {
        width: 100%;
        height: auto;
        max-height: 74px;
        position: relative;
    }

    .popup_header .form_element_ input {
        width: 100%;
        height: 100%;
        border: 1px solid #dbdbdb;
        border-radius: 6px;
        padding: 40px 20px 10px 20px;
        font-size: 19px;
        letter-spacing: -1px;
        line-height: 26px;
        text-transform: uppercase;
        color: #353535;
        font-weight: bold;
        font-family: "Pretendard";
    }

    .popup_header .form_element_ input::placeholder {
        font-size: 19px;
        letter-spacing: -1px;
        line-height: 26px;
        text-transform: uppercase;
        color: #353535;
        font-weight: bold;
        font-family: "Pretendard";
    }

    .popup_header .form_element_ .form_button_ {
        width: 100%;
        max-width: 120px;
        height: 100%;
        max-height: 72px;
    }

    .popup_header label {
        font-size: 14px;
        letter-spacing: -1px;
        line-height: 26px;
        text-transform: uppercase;
        color: #999999;
        position: absolute;
        left: 20px;
        top: 10px;
    }

    .popup_header button {
        border-radius: 6px;
        background-color: #17469E;
        font-size: 22px;
        letter-spacing: -1px;
        line-height: 26px;
        text-transform: uppercase;
        color: #ffffff;
        font-weight: bold;
        font-family: "Pretendard";
        text-align: center;
        padding: 24px;
        width: 108px;
        margin-left: 8px;
    }

    .popup_header .form_gr_ {
        width: 535px;
    }

    .popup_header .form_gr_ {
        width: 500px;
        gap: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #dbdbdb;
        border-radius: 6px;
    }

    .popup_header .form_element_ .form_gr_item_ input {
        border: hidden;
    }

    .popup_table table {
        width: 100%;
    }


    .popup_table table tr {
        border-bottom: 1px solid #ccc;
    }

    .popup_table table td {
        padding: 14px 10px;
    }

    .popup_table table td .list_area {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .popup_table table td .list_area p {
        padding: 6px 10px;
        border: 1px solid transparent;
        border-radius: 6px;

    }

    .popup_table table td .list_area p.active {
        color: #fff;
        background-color: #17469E;
    }

    .popup_table table td .list_area p.active font {
        color: #fff;
    }

    .popup_table table td .list_area p:hover {
        border: 1px solid #17469E;
        cursor: pointer;
    }

    .btns_submit {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 40px
    }

    .btns_submit .find {
        display: flex;
        justify-content: center;
        height: 60px;
        width: 210px;
        padding: 0 30px;
        align-items: center;
        background-color: #dbdbdb;
        border-radius: 12px;
        font-size: 22px;
        font-weight: 500;
    }

    .btns_submit .find.search {
        color: #fff;
        background-color: #17469E;
    }

    .hotel_popup_ {
        display: none;
        position: absolute;
        top: 215px;
        left: 35px;
        z-index: 10;
    }

    .hotel_popup_.show {
        display: block;
    }

    .hotel_popup_content_ {
        background: #fff;
        border: 1px solid #dadfe6;
        border-radius: 8px;
        width: 420px;
        padding: 5px;
    }

    .hotel_popup_ttl_ {
        background: #f7f7fb;
        color: #666;
        font-size: 14px;
        font-weight: 700;
        height: 32px;
        line-height: 32px;
    }

    .list_popup_list_ {
        align-items: flex-start;
        display: flex;
        flex-wrap: wrap;
        padding: 8px;
    }

    .list_popup_item_ {
        box-sizing: border-box;
        cursor: pointer;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 16px;
        text-overflow: ellipsis;
        width: 20%;
        -webkit-box-orient: vertical;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        border-radius: 4px;
        word-break: break-word;
    }
</style>

<?php
    helper(['setting']);
    $setting = homeSetInfo();
    $baht_thai_header = (float)($setting['baht_thai'] ?? 0);

    $productModel = new \App\Models\ProductModel();
    $codeModel = new \App\Models\Code();

    // 호텔
    $codes_hotel = $codeModel->getByParentCode("1303")->getResultArray();

    $code_first_hotel = $codes_hotel[0] ?? [];

    $hotel_arr = $codeModel->getByParentAndDepth(40, 2)->getResultArray();
    $rating_arr = $codeModel->getByParentAndDepth(30, 2)->getResultArray();
    $promotion_arr = $codeModel->getByParentAndDepth(41, 2)->getResultArray();
    $topic_arr = $codeModel->getByParentAndDepth(38, 2)->getResultArray();
    $bedroom_arr = $codeModel->getByParentAndDepth(39, 2)->getResultArray();

    //골프

    $codes_golf = $codeModel->getByParentCode("1302")->getResultArray();

    $code_first_golf = $codes_golf[0] ?? [];

    $green_peas_arr = $codeModel->getByParentCode(4501)->getResultArray();
    $sports_days_arr = $codeModel->getByParentCode(4502)->getResultArray();
    $slots_arr = $codeModel->getByParentCode(4503)->getResultArray();
    $golf_course_arr = $codeModel->getByParentCode(4504)->getResultArray();
    $travel_times_arr = $codeModel->getByParentCode(4505)->getResultArray();
    $carts_arr = $codeModel->getByParentCode(4506)->getResultArray();
    $facilities_arr = $codeModel->getByParentCode(4507)->getResultArray();

    //투어

    $codes_tour = $codeModel->getByParentCode("1301")->getResultArray();

    $code_first_tour = $codes_tour[0] ?? [];

    $keyWordAll = $productModel->getKeyWordAll(1301);
    $product_theme = $codeModel->getByParentAndDepth(55, 2)->getResultArray();
?>

<div class="popup_wraper">
    <div class="popup_container">
        <div class="popup_top">
            <div class="list_tab_select">
                <div class="item_tab hotel active" data-tab="hotel">
                    <p>호텔</p>
                </div>
                <div class="item_tab golf" data-tab="golf">
                    <p>골프</p>
                </div>
                <div class="item_tab tour" data-tab="tour">
                    <p>투어</p>
                </div>
            </div>
            <div class="btn_close_popup">
                <img src="/images/ico/close-btn-grey.png" alt="">
            </div>
        </div>

        <div class="popup_content hotel">
            <div class="popup_header">
                <div class="form_element_">
                    <div class="form_input_">
                        <label for="inp_keyword_">여행지</label>
                        <input type="text" readonly="" id="inp_keyword_" class="input_keyword_" value="<?=$code_first_hotel["code_name"]?>" data-id="<?=$code_first_hotel["code_no"]?>"  placeholder="호텔 지역을 입력해주세요!">
                    </div>
                    <div class="form_input_multi_">
                        <div class="form_gr_ openDateRangePicker2">
                            <div class="form_input_ form_gr_item_">
                                <label for="input_day">체크인</label>
                                <input type="text" id="inp_day_start_" class="input_custom_ input_ranger_date_ inp_day_start_" placeholder="체크인 선택해주세요." readonly="">
                            </div>
                            <p>
                                <span id="countDay2" class="count countDay2">0</span>박
                            </p>
                            <div class="form_input_ form_gr_item_ form_gr_item_flex_">
                                <label for="input_day">체크아웃</label>
                                <input type="text" id="inp_day_end_" class="input_custom_ input_ranger_date_ inp_day_end_" placeholder="체크아웃 선택해주세요." readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="form_input_" style="position: relative;">
                        <label for="inp_hotel">호텔명(미입력 시 전체)</label>
                        <input type="text" style="text-transform: none;" id="inp_hotel" class="input_custom_ inp_name_" placeholder="호텔명을 입력해주세요.">
                        <ul class="search_words_list search_words_products">
                        </ul>
                    </div>
                    <button type="button" onclick="search_popup();" class="btn_search_">
                        검색
                    </button>
                </div>
                <div class="date_picker_popup" style="position: relative;">
                    <input type="text" id="daterange_picker_hotel" class="daterange_picker">
                </div>
                <div class="hotel_popup_">
                    <div class="hotel_popup_content_">
                        <div class="hotel_popup_ttl_">인기 여행지</div>
                        <div class="list_popup_list_">
                            <?php
                                foreach($codes_hotel as $code){
                            ?>
                                <div class="list_popup_item_" data-id="<?= $code['code_no'] ?>">
                                    <?= $code['code_name'] ?>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup_table">
                <table>
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 80%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>세부지역</th>
                            <td>
                                <div class="list_area list_category">
                                    <!-- <p>지역전체</p>
                                    <p>스쿰빗(아속-프롬퐁)</p>
                                    <p>짜오프라야강가</p>
                                    <p>실롬/사톤</p> -->
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>숙박유형</th>
                            <td>
                                <div class="list_area list_hotel">
                                    <p data-code="all">유형전체</p>
                                    <?php
                                        foreach ($hotel_arr as $code) {
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        } 
                                    ?>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>호텔등급</th>
                            <td>
                                <div class="list_area list_rating">
                                    <p data-code="all">등급전체</p>
                                    <?php
                                        foreach ($rating_arr as $code) {
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        } 
                                    ?>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>1박 평균가격</th>
                            <td>
                                <div class="tab_price_area">
                                    <div class="tab-currency filter_price_wrap">
                                        <!-- <span class="currency active">원 · </span><span class="currency">원</span> -->
                                        <div class="filter">
                                            <button type="button" class="btn_fil_price active" data-type="W">원</button>
                                            <button type="button" class="btn_fil_price" data-type="B">바트</button>
                                        </div>
                                    </div>

                                    <div class="slider-container only_web">
                                        <div class="slider-background"></div>
                                        <div class="slider-track" id="slider-track" style="left: 0%; width: 0%;"></div>
                                        <input type="range" min="0" max="500000" value="0" name="price_min" class="slider" id="slider-min">
                                        <input type="range" min="0" max="500000" value="0" name="price_max" class="slider" id="slider-max">
                                    </div>
                                    <span class="price_range">
                                        <i class="price_min">0</i>원 ~ <i class="price_max">0</i>원 이상
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>프로모션</th>
                            <td>
                                <div class="list_area list_promotion">
                                    <?php
                                        foreach ($promotion_arr as $code) {
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        } 
                                    ?>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>테마</th>
                            <td>
                                <div class="list_area list_topic">
                                    <?php
                                        foreach ($topic_arr as $code) {
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        } 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>침실수</th>
                            <td>
                                <div class="list_area list_bedroom">
                                    <?php
                                        foreach ($bedroom_arr as $code) {
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        } 
                                    ?>
                                </div>
                            </td>
    
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="popup_content golf" style="display: none;">
            <div class="popup_header">
                <div class="form_element_">
                    <div class="form_input_">
                        <label for="inp_keyword_">여행지</label>
                        <input type="text" readonly="" id="inp_keyword_" class="input_keyword_" value="<?=$code_first_golf["code_name"]?>" data-id="<?=$code_first_golf["code_no"]?>"  placeholder="호텔 지역을 입력해주세요!">
                    </div>
                    <div class="form_input_" style="position: relative;">
                        <label for="inp_hotel">제품명(미기재 시 전체 이름)</label>
                        <input type="text" style="text-transform: none;" id="inp_hotel" class="input_custom_ inp_name_" placeholder="제품명을 입력해주세요.">
                        <ul class="search_words_list search_words_products">
                        </ul>
                    </div>
                    <button type="button" onclick="search_popup();" class="btn_search_">
                        검색
                    </button>
                </div>
                <div class="hotel_popup_">
                    <div class="hotel_popup_content_">
                        <div class="hotel_popup_ttl_">인기 여행지</div>
                        <div class="list_popup_list_">
                            <?php
                                foreach($codes_golf as $code){
                            ?>
                                <div class="list_popup_item_" data-id="<?= $code['code_no'] ?>">
                                    <?= $code['code_name'] ?>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup_table">
                <table>
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 80%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>그린피</th>
                            <td>
                                <div class="list_area list_green_peas">
                                    <p data-code="all">전체</p>
                                    <?php
                                        foreach($green_peas_arr as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>시간대</th>
                            <td>
                                <div class="list_area list_slots">
                                    <p data-code="all">전체</p>
                                    <?php
                                        foreach($slots_arr as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>골프장 홀수</th>
                            <td>
                                <div class="list_area list_golf_course">
                                    <p data-code="all">전체</p>
                                    <?php
                                        foreach($golf_course_arr as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>이동시간</th>
                            <td>
                                <div class="list_area list_travel_times">
                                    <p data-code="all">전체</p>
                                    <?php
                                        foreach($travel_times_arr as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>카트</th>
                            <td>
                                <div class="list_area list_carts">
                                    <p data-code="all">전체</p>
                                    <?php
                                        foreach($carts_arr as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>시설</th>
                            <td>
                                <div class="list_area list_facilities">
                                    <p data-code="all">전체</p>
                                    <?php
                                        foreach($facilities_arr as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="popup_content tour" style="display: none;">
            <div class="popup_header">
                <div class="form_element_">
                    <div class="form_input_">
                        <label for="inp_keyword_">여행지</label>
                        <input type="text" readonly="" id="inp_keyword_" class="input_keyword_" value="<?=$code_first_tour["code_name"]?>" data-id="<?=$code_first_tour["code_no"]?>"  placeholder="호텔 지역을 입력해주세요!">
                    </div>
                    <div class="form_input_" style="position: relative;">
                        <label for="inp_hotel">제품명(미기재 시 전체 이름)</label>
                        <input type="text" style="text-transform: none;" id="inp_hotel" class="input_custom_ inp_name_" placeholder="제품명을 입력해주세요.">
                        <ul class="search_words_list search_words_products">
                        </ul>
                    </div>
                    <button type="button" onclick="search_popup();" class="btn_search_">
                        검색
                    </button>
                </div>
                <div class="hotel_popup_">
                    <div class="hotel_popup_content_">
                        <div class="hotel_popup_ttl_">인기 여행지</div>
                        <div class="list_popup_list_">
                            <?php
                                foreach($codes_tour as $code){
                            ?>
                                <div class="list_popup_item_" data-id="<?= $code['code_no'] ?>">
                                    <?= $code['code_name'] ?>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup_table">
                <table>
                    <colgroup>
                        <col style="width: 20%">
                        <col style="width: 80%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>키워드</th>
                            <td>
                                <div class="list_area list_keyword">
                                    <p data-code="all">전체키워드</p>
                                    <?php
                                        foreach($keyWordAll as $key => $item){
                                    ?>
                                        <p data-code="<?=$item?>">#<?=$item?></p>
                                    <?php } ?>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>투어타입</th>
                            <td>
                                <div class="list_area list_product_tour">
                                    <p data-code="all">전체타입</p>
                                    <?php
                                        foreach($product_theme as $code){
                                    ?>
                                        <p data-code="<?=$code["code_no"]?>"><?=$code["code_name"]?></p>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>1박 평균가격</th>
                            <td>
                                <div class="tab_price_area">
                                    <div class="tab-currency filter_price_wrap">
                                        <div class="filter">
                                            <button type="button" class="btn_fil_price active" data-type="W">원</button>
                                            <button type="button" class="btn_fil_price" data-type="B">바트</button>
                                        </div>
                                    </div>

                                    <div class="slider-container only_web">
                                        <div class="slider-background"></div>
                                        <div class="slider-track" id="slider-track" style="left: 0%; width: 0%;"></div>
                                        <input type="range" min="0" max="500000" value="0" name="price_min" class="slider" id="slider-min">
                                        <input type="range" min="0" max="500000" value="0" name="price_max" class="slider" id="slider-max">
                                    </div>
                                    <span class="price_range">
                                        <i class="price_min">0</i>원 ~ <i class="price_max">0</i>원 이상
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="btns_submit">
            <button class="find search">검색</button>
        </div>
    </div>

</div>

<script>
    $(".inp_name_").keyup(function (event) {
        let search_name = $(this).val().trim();

        let gubun = $(".popup_wraper .list_tab_select .item_tab.active").data("tab");

        if (search_name == "") {
            $(".search_words_products").hide();
        } else {

            clearTimeout(debounceTimeout);

            debounceTimeout = setTimeout(function () {
                $.ajax({
                    url: "/api/products/get_search_products",
                    type: "GET",
                    data: "search_name=" + search_name + "&gubun="+ gubun,
                    error: function (request, status, error) {
                        alert("code : " + request.status + "\r\nmessage : " + request.responseText);
                    },
                    success: function (response, status, request) {
                        let products = response;

                        if (products.length > 0) {
                            let html = ``;
                            let url = '';

                            let sub_url = "";

                            if(gubun == "hotel"){
                                sub_url = "product-hotel/hotel-detail";
                            }else if(gubun == "golf"){
                                sub_url = "product-golf/golf-detail";
                            }else{
                                sub_url = "product-tours/item_view";
                            }

                            products.forEach(product => {
                                html += `<li><a href="/${sub_url}/${product["product_idx"]}">${product["product_name"]}</a></li>`;
                            });

                            $(".search_words_products").html(html);
                            $(".search_words_products").show();
                        } else {
                            $(".search_words_products").hide();
                        }
                        return;
                    }
                });
            }, 100);
        }

        if (event.keyCode == 13) {
            location.href = "/product_search?search_name=" + search_name;
        }
    });

</script>

<script>
    var baht_thai_header = parseFloat('<?=$baht_thai_header?>');    

    $(document).on('click', '.popup_wraper .btn_fil_price', function() {
        $(this).addClass("active").siblings().removeClass("active");
        let type = $(this).data("type");
        let price_max = 500000;
        let text_unit = "원";
        if(type == "B"){
            price_max = parseInt(500000 / baht_thai_header);     
            text_unit = "바트";
        }        

        $(this).closest(".tab_price_area").find(".price_range").html(`<i class="price_min">0</i>${text_unit} ~ <i class="price_max">0</i>${text_unit} 이상`);
        $(this).closest(".tab_price_area").find("#slider-track").css({"left": "0%", "width" : "0%"});
        $(this).closest(".tab_price_area").find("#slider-min").val(0);
        $(this).closest(".tab_price_area").find("#slider-min").attr("max", price_max);
        $(this).closest(".tab_price_area").find("#slider-max").val(0);
        $(this).closest(".tab_price_area").find("#slider-max").attr("max", price_max);


    });

    const sliders_header = document.querySelectorAll('.popup_wraper .slider-container');
    sliders_header.forEach(slider => {
        const sliderMin = slider.querySelector('#slider-min');
        const sliderMax = slider.querySelector('#slider-max'); 
        const sliderTrack = slider.querySelector('#slider-track');
        
        function updateSliderTrack() {
            const min = parseFloat(sliderMin.value);
            const max = parseFloat(sliderMax.value);

            if (min > max) {
                [sliderMin.value, sliderMax.value] = [sliderMax.value, sliderMin.value];
            }

            const percentMin = (sliderMin.value - sliderMin.min) / (sliderMin.max - sliderMin.min) * 100;
            const percentMax = (sliderMax.value - sliderMax.min) / (sliderMax.max - sliderMax.min) * 100;

            sliderTrack.style.left = percentMin + '%';
            sliderTrack.style.width = (percentMax - percentMin) + '%';

            $(".popup_wraper .price_min").text(number_format(sliderMin.value));
            $(".popup_wraper .price_max").text(number_format(sliderMax.value));
        }

        sliderMin.addEventListener('input', updateSliderTrack);
        sliderMax.addEventListener('input', updateSliderTrack);

        window.addEventListener('DOMContentLoaded', updateSliderTrack);
    });

    $(document).on('click', '.popup_table table td .list_area p', function() {
        $(this).toggleClass("active");
        if($(this).data("code") == "all"){
            if($(this).hasClass("active")){
                $(this).siblings().addClass("active");
            }else{
                $(this).siblings().removeClass("active");
            }
        }else{
            let len = $(this).closest(".list_area").children("p.active").not('[data-code="all"]').length;
            if(len == $(this).closest(".list_area").children("p").length - 1){
                $(this).siblings("[data-code='all']").addClass("active");
            }else{
                $(this).siblings("[data-code='all']").removeClass("active");
            }
        }

    });

    $(".list_tab_select .item_tab").click(function () {
        $(".list_tab_select .item_tab").removeClass("active");
        $(this).addClass("active");
        $(".inp_name_").val("");
        $(".search_words_products").hide();

        if($(this).hasClass("hotel")){
            $(".popup_content.hotel").show();
            $(".popup_content.golf").hide();
            $(".popup_content.tour").hide();
        }else if($(this).hasClass("golf")){
            $(".popup_content.golf").show();
            $(".popup_content.hotel").hide();
            $(".popup_content.tour").hide();
        }else{
            $(".popup_content.tour").show();
            $(".popup_content.hotel").hide();
            $(".popup_content.golf").hide();
        }

        $(".popup_content").each(function() {
            $(this).find(".btn_fil_price[data-type='W']").addClass("active");
            $(this).find(".btn_fil_price[data-type='B']").removeClass("active");
            $(this).find(".price_range").html(`<i class="price_min">0</i>원 ~ <i class="price_max">0</i>원 이상`);
            $(this).find("#slider-track").css({"left": "0%", "width" : "0%"});
            $(this).find("#slider-min").val(0);
            $(this).find("#slider-min").attr("max", 500000);
            $(this).find("#slider-max").val(0);
            $(this).find("#slider-max").attr("max", 500000);
        });

    });

    $(document).ready(function() {
        $('.daterange_picker').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' ~ ',
                applyLabel: '적용',
                cancelLabel: '취소',
                fromLabel: '시작일',
                toLabel: '종료일',
                customRangeLabel: '사용자 정의',
                daysOfWeek: ['일', '월', '화', '수', '목', '금', '토'],
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                firstDay: 0
            },
            parentEl: ".date_picker_popup",
            linkedCalendars: true,
            autoApply: true,
            minDate: moment().add(1, 'days'),
            opens: "center"
        },
        function(start, end) {

            const startDate = moment(start.format('YYYY-MM-DD'));
            const endDate = moment(end.format('YYYY-MM-DD'));

            $('.inp_day_start_').val(startDate.format('YYYY-MM-DD'));
            $('.inp_day_end_').val(endDate.format('YYYY-MM-DD'));

            const duration = moment.duration(endDate.diff(startDate));
            const days = Math.round(duration.asDays());
            $(".countDay2").text(days);
        });

        $('.openDateRangePicker2').click(function() {
            if($(this).closest(".popup_content").css("display") != "none"){
                
                $(this).closest(".popup_content").find('.daterange_picker').click();
            }
        });

        const datepickers = document.querySelectorAll('.date_picker_popup .daterangepicker');

        datepickers.forEach((datepicker) => {
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'childList' && $(mutation.target).hasClass('calendar-table')) {
                        $(mutation.target)
                            .find('td')
                            .each(function () {
                                const $cell = $(this);
                                const text = $cell.text().trim();
                                if (!$cell.find('.custom-info').length) {
                                    $cell.html(`
                                        <div class="custom-info">
                                            <span>${text}</span>
                                        </div>
                                    `);
                                }
                            });

                        $(mutation.target)
                            .find('tr')
                            .filter(function () {
                                const tds = $(this).find('td');
                                return tds.length > 0 && tds.toArray().every(td => $(td).hasClass('ends'));
                            })
                            .hide();
                    }
                });
            });

            observer.observe(datepicker, {
                childList: true,
                subtree: true,
            });
        });

    });

    $('.popup_wraper .list_popup_item_').click(function () {
        let ttl = $(this).text().trim();
        let idx = $(this).data('id');
        $(this).closest(".popup_content").find('.input_keyword_').val(ttl).data('id', idx);
        if($(this).closest(".popup_content").hasClass("hotel")){
            render_category("hotel");
        }
        $('.popup_wraper .hotel_popup_').removeClass('show');
    });

    $('.popup_wraper .input_keyword_').on('click', function () {
        $('.popup_wraper .hotel_popup_').addClass('show');
    });

    render_category("hotel");

    function render_category(type_category) {
        let code = $(".popup_content." + type_category).find(".input_keyword_").data("id");

        $.ajax({
            url: "/ajax/get_child_code",
            type: "GET",
            data: 'code=' + code,
            error: function(request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            },
            success: function(response, status, request) {
                let html = `<p data-code="all">지역전체</p>`;
                let data = response;
                data.forEach(category => {
                    html += `<p data-code="${category["code_no"]}">${category["code_name"]}</p>`; 
                });
                $(".popup_content." + type_category).find(".list_category").html(html);

                return;
            }
        });
    }

    $(document).on('click', function (event) {
        const $popup = $('.popup_wraper .hotel_popup_');
        const $input_keyword_ = $('.popup_wraper .input_keyword_');
        if ($input_keyword_.has(event.target).length > 0 || $input_keyword_.is(event.target)) {
            $popup.addClass('show');
        } else {
            $popup.removeClass('show');
        }
    });

    function search_popup() {
        let type_category = $(".list_tab_select .item_tab.active").data("tab");

        if(type_category == "hotel"){
            let search_product_category = [];
            let search_product_hotel = [];
            let search_product_rating = [];
            let search_product_promotion = [];
            let search_product_topic = [];
            let search_product_bedroom = [];
            let price_type = $(".popup_content." + type_category).find(".btn_fil_price.active").data("type");
            let pg = 1;
            let s_code_no = $(".popup_content." + type_category).find(".input_keyword_").data("id");
            let day_start = $(".popup_content." + type_category).find(".inp_day_start_").val();
            let day_end = $(".popup_content." + type_category).find(".inp_day_end_").val();
            let keyword = $(".popup_content." + type_category).find(".inp_name_").val();
            let price_min = $(".popup_content." + type_category).find("#slider-min").val();
            let price_max = $(".popup_content." + type_category).find("#slider-max").val();

            $(".popup_content." + type_category).find(".list_category p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    search_product_category = [];
                    return false;
                }else{
                    search_product_category.push(code_no);
                }
            });

            if(search_product_category.length == $(".popup_content." + type_category).find(".list_category p").length - 1){
                search_product_category = [];
            }

            $(".popup_content." + type_category).find(".list_hotel p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    search_product_hotel = [];
                    return false;
                }else{
                    search_product_hotel.push(code_no);
                }
            });

            if(search_product_hotel.length == $(".popup_content." + type_category).find(".list_hotel p").length - 1){
                search_product_hotel = [];
            }

            $(".popup_content." + type_category).find(".list_rating p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    search_product_rating = [];
                    return false;
                }else{
                    search_product_rating.push(code_no);
                }
            });

            if(search_product_rating.length == $(".popup_content." + type_category).find(".list_rating p").length - 1){
                search_product_rating = [];
            }

            $(".popup_content." + type_category).find(".list_promotion p.active").each(function() {
                let code_no = $(this).data("code");
                search_product_promotion.push(code_no);
            });

            $(".popup_content." + type_category).find(".list_topic p.active").each(function() {
                let code_no = $(this).data("code");
                search_product_topic.push(code_no);
            });

            $(".popup_content." + type_category).find(".list_bedroom p.active").each(function() {
                let code_no = $(this).data("code");
                search_product_bedroom.push(code_no);
            });

            let url = `/product-hotel/list-hotel?search_product_category=${search_product_category.join(",")}&search_product_hotel=${search_product_hotel.join(",")}&search_product_rating=${search_product_rating.join(",")}&search_product_promotion=${search_product_promotion.join(",")}&search_product_topic=${search_product_topic.join(",")}&search_product_bedroom=${search_product_bedroom.join(",")}&pg=${pg}&price_type=${price_type}&s_code_no=${s_code_no}&price_min=${price_min}&price_max=${price_max}&day_start=${day_start}&day_end=${day_end}&keyword=${keyword}`;
            window.location.href = url;
        }else if(type_category == "golf"){
            let green_peas = [];
            let slots = [];
            let golf_course_odd_numbers = [];
            let travel_times = [];
            let carts = [];
            let facilities = [];
            let pg = 1;
            let s_code_no = $(".popup_content." + type_category).find(".input_keyword_").data("id");
            let keyword = $(".popup_content." + type_category).find(".inp_name_").val();

            //green_peas
            $(".popup_content." + type_category).find(".list_green_peas p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    green_peas = [];
                    return false;
                }else{
                    green_peas.push(code_no);
                }
            });

            if(green_peas.length == $(".popup_content." + type_category).find(".list_green_peas p").length - 1){
                green_peas = [];
            }

            //slots
            $(".popup_content." + type_category).find(".list_slots p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    slots = [];
                    return false;
                }else{
                    slots.push(code_no);
                }
            });

            if(slots.length == $(".popup_content." + type_category).find(".list_slots p").length - 1){
                slots = [];
            }

            //golf_course_odd_numbers
            $(".popup_content." + type_category).find(".list_golf_course p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    golf_course_odd_numbers = [];
                    return false;
                }else{
                    golf_course_odd_numbers.push(code_no);
                }
            });

            if(golf_course_odd_numbers.length == $(".popup_content." + type_category).find(".list_golf_course p").length - 1){
                golf_course_odd_numbers = [];
            }

            //travel_times
            $(".popup_content." + type_category).find(".list_travel_times p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    travel_times = [];
                    return false;
                }else{
                    travel_times.push(code_no);
                }
            });

            if(travel_times.length == $(".popup_content." + type_category).find(".list_travel_times p").length - 1){
                travel_times = [];
            }

            //carts
            $(".popup_content." + type_category).find(".list_carts p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    carts = [];
                    return false;
                }else{
                    carts.push(code_no);
                }
            });

            if(carts.length == $(".popup_content." + type_category).find(".list_carts p").length - 1){
                carts = [];
            }

            //carts
            $(".popup_content." + type_category).find(".list_facilities p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    facilities = [];
                    return false;
                }else{
                    facilities.push(code_no);
                }
            });

            if(facilities.length == $(".popup_content." + type_category).find(".list_facilities p").length - 1){
                facilities = [];
            }

            let url = `/product-golf/list-golf/${s_code_no}?green_peas=${green_peas.join(",")}&slots=${slots.join(",")}&golf_course_odd_numbers=${golf_course_odd_numbers.join(",")}&travel_times=${travel_times.join(",")}&carts=${carts.join(",")}&facilities=${facilities.join(",")}&pg=${pg}&search_word=${keyword}`;
            window.location.href = url;
        }else{
            let search_keyword = [];
            let search_product_tour = [];
            let price_type = $(".popup_content." + type_category).find(".btn_fil_price.active").data("type");
            let pg = 1;
            let s_code_no = $(".popup_content." + type_category).find(".input_keyword_").data("id");
            let keyword = $(".popup_content." + type_category).find(".inp_name_").val();
            let price_min = $(".popup_content." + type_category).find("#slider-min").val();
            let price_max = $(".popup_content." + type_category).find("#slider-max").val();

            $(".popup_content." + type_category).find(".list_keyword p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    search_keyword = [];
                    return false;
                }else{
                    search_keyword.push(code_no);
                }
            });

            if(search_keyword.length == $(".popup_content." + type_category).find(".list_keyword p").length - 1){
                search_keyword = [];
            }

            $(".popup_content." + type_category).find(".list_product_tour p.active").each(function() {
                let code_no = $(this).data("code");
                if(code_no == "all"){
                    search_product_tour = [];
                    return false;
                }else{
                    search_product_tour.push(code_no);
                }
            });

            if(search_product_tour.length == $(".popup_content." + type_category).find(".list_product_tour p").length - 1){
                search_product_tour = [];
            }

            let url = `/product-tours/tours-list/${s_code_no}?search_keyword=${search_keyword.join(",")}&search_product_tour=${search_product_tour.join(",")}&price_type=${price_type}&pg=${pg}&price_min=${price_min}&price_max=${price_max}&search_word=${keyword}`;
            window.location.href = url;
        }
    }

    $(".btns_submit button").on("click", function() {
        search_popup();
    });
</script>