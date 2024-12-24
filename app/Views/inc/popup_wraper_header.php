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
    
    $productModel = new \App\Models\ProductModel();
    $codeModel = new \App\Models\Code();
    // 검색어
    $codes_hotel = $codeModel->getByParentCode("1303")->getResultArray();
?>

<div class="popup_wraper">
    <div class="popup_container">
        <div class="popup_top">
            <div class="list_tab_select">
                <div class="item_tab hotel active">
                    <p>호텔</p>
                </div>
                <div class="item_tab tour">
                    <p>투어</p>
                </div>
            </div>
            <div class="btn_close_popup">
                <img src="../images/ico/close-btn-grey.png" alt="">
            </div>
        </div>

        <div class="popup_content hotel">
            <div class="popup_header">
                <div class="form_element_">
                    <div class="form_input_">
                        <label for="inp_keyword_">여행지</label>
                        <input type="text" readonly="" id="inp_keyword_" class="input_keyword_" placeholder="호텔 지역을 입력해주세요!">
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
                    <div class="form_input_">
                        <label for="input_hotel">호텔명(미입력 시 전체)</label>
                        <input type="text" style="text-transform: none;" id="inp_hotel" class="input_custom_" placeholder="호텔명을 입력해주세요.">
                    </div>
                    <button type="button" onclick="searchProduct();" class="btn_search_">
                        검색
                    </button>
                </div>
                <input type="text" id="daterange_picker_hotel" class="daterange_picker">
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
                                <div class="list_area">
                                    <p>전체</p>
                                    <p>스쿰빗(아속-프롬퐁)</p>
                                    <p>짜오프라야강가</p>
                                    <p>실롬/사톤</p>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>숙박유형</th>
                            <td>
                                <div class="list_area">
                                    <p>전체</p>
                                    <p>호텔</p>
                                    <p>레지던스</p>
                                    <p>리조트</p>
                                    <p>풀빌라</p>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>호텔등급</th>
                            <td>
                                <div class="list_area">
                                    <p>전체</p>
                                    <p>호텔 5성[★★★★★]</p>
                                    <p>호텔 4성[★★★★]</p>
                                    <p>호텔 3성[★★★]</p>
                                    <p>콘도</p>
                                    <p>리조트</p>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>프로모션</th>
                            <td>
                                <div class="list_area">
                                    <p>무료숙박(1+1,2+1등)</p>
                                    <p>특별패키지</p>
                                    <p>룸업그레이드</p>
                                    <p>공항픽업 무료</p>
                                    <p>레이트 체크아웃 무료</p>
                                    <p>얼리버드 할인</p>
                                    <p>엑스트라베드 무료</p>
                                    <p>아동 엑스트라베드 무료</p>
                                    <p>아동조식 무료</p>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>테마</th>
                            <td>
                                <div class="list_area">
                                    <p>체크인 후 24시간 이용 가능</p>
                                    <p>쇼핑몰과 연결 되어있는 호텔</p>
                                    <p>인피니티 풀이 있는 호텔</p>
                                    <p>풀억세스룸이 있는 호텔</p>
                                    <p>워터 슬라이드가 있는 호텔</p>
                                    <p>루프탑바가 있는 호텔</p>
                                    <p>가성비 5성급 호텔</p>
                                    <p>BTS(지상철)과 연결된 호텔</p>
                                    <p>펫프렌들리 호텔</p>
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
                                            <button type="button" class="btn_fil_price active">원</button>
                                            <button type="button" class="btn_fil_price">바트</button>
                                        </div>
                                    </div>

                                    <div class="slider-container only_web">
                                        <div class="slider-background"></div>
                                        <div class="slider-track" id="slider-track" style="left: 0%; width: 0%;"></div>
                                        <input type="range" min="0" max="500000" value="0" name="price_min" class="slider" id="slider-min">
                                        <input type="range" min="0" max="500000" value="0" name="price_max" class="slider" id="slider-max">
                                    </div>
                                    <span>
                                        <i class="price_min">0</i>원 ~ <i class="price_max">0</i> 이상
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>침실수</th>
                            <td>
                                <div class="list_area">
                                    <p>2 베드룸(성인 4~5인)</p>
                                    <p>베드룸~(성인6인~)</p>
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
                        <label for="inp_keyword_02">여행지</label>
                        <input type="text" readonly="" id="inp_keyword_02" class="input_keyword_" placeholder="호텔 지역을 입력해주세요!">
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
                    <div class="form_input_">
                        <label for="input_hotel">호텔명(미입력 시 전체)</label>
                        <input type="text" style="text-transform: none;" id="inp_hotel" class="input_custom_" placeholder="호텔명을 입력해주세요.">
                    </div>
                    <button type="button" onclick="searchProduct();" class="btn_search_">
                        검색
                    </button>
                </div>
                <input type="text" id="daterange_picker_tour" class="daterange_picker">
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
                                <div class="list_area">
                                    <p>전체키워드</p>
                                    <p>#태국호캉스 바닷가라운딩</p>
                                    <p>#로컬투어</p>
                                    <p>#태국호캉스 바닷가라운딩1</p>
                                    <p>#태국호캉스 바닷가라운딩1</p>
                                    <p>#태국호캉스 바닷가라운딩2</p>
                                    <p>#끄라비 투어</p>
                                    <p>#조인</p>
                                    <p>#한국거 기이드</p>
                                    <p>#퀸즐랜드주 관광청 특별지원 프로모션</p>
                                    <p>#카오락 투어</p>
                                </div>
                            </td>
    
                        </tr>
                        <tr>
                            <th>투어타입</th>
                            <td>
                                <div class="list_area">
                                    <p>전체타입</p>
                                    <p>하루 투어</p>
                                    <p>반일 투어</p>
                                    <p>맞춤투어</p>
                                    <p>택시단독투어</p>
                                    <p>쇼</p>
                                    <p>입장권</p>
                                    <p>스파</p>
                                    <p>레스토랑</p>
                                    <p>디너크루즈</p>
                                    <p>뷰티</p>
                                    <p>교통패스</p>
                                    <p>기타</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>1박 평균가격</th>
                            <td>
                                <div class="tab_price_area">
                                    <div class="tab-currency filter_price_wrap">
                                        <div class="filter">
                                            <button type="button" class="btn_fil_price active">원</button>
                                            <button type="button" class="btn_fil_price">바트</button>
                                        </div>
                                    </div>

                                    <div class="slider-container only_web">
                                        <div class="slider-background"></div>
                                        <div class="slider-track" id="slider-track" style="left: 0%; width: 0%;"></div>
                                        <input type="range" min="0" max="500000" value="0" name="price_min" class="slider" id="slider-min">
                                        <input type="range" min="0" max="500000" value="0" name="price_max" class="slider" id="slider-max">
                                    </div>
                                    <span>
                                        <i class="price_min">0</i>원 ~ <i class="price_max">0</i> 이상
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

        const datepickers = document.querySelectorAll('.daterangepicker');

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

    $(document).ready(function () {
        $('.popup_wraper .list_popup_item_').click(function () {
            let ttl = $(this).text().trim();
            let idx = $(this).data('id');
            $('.popup_wraper .input_keyword_').val(ttl).data('id', idx);
            $('.popup_wraper .hotel_popup_').removeClass('show');
        });

        $('.popup_wraper .input_keyword_').on('click', function () {
            $('.popup_wraper .hotel_popup_').addClass('show');
        });
    });

    $(document).on('click', function (event) {
        const $popup = $('.popup_wraper .hotel_popup_');
        const $input_keyword_ = $('.popup_wraper .input_keyword_');
        if ($input_keyword_.has(event.target).length > 0 || $input_keyword_.is(event.target)) {
            $popup.addClass('show');
        } else {
            $popup.removeClass('show');
        }
    });
</script>