<div class="popup_wraper">

        <div class="popup_container">
            <div class="btn_close_popup">X</div>
            <div class="s_form">
                <div class="top_serach show">
                    <div class="top_serach_box">
                        <div class="search_location">
                            <span class="ic_mapmarker"></span>
                            <input type="text" id="city_name" name="city_name" title="" placeholder="도시를 선택해 주세요" value="">
                        </div>

                        <div class="search_datecheck" id="two-inputs" style="width: inherit;">
                            <div class="custom_input mr5"><span class="ic_chin"></span>
                                <div class="val_wrap"><input type="text" id="checkInDate" placeholder="체크인" readonly="readonly" value=""><input type="hidden" name="checkInDate" id="checkInDate_Alt" value=""><img src="https://thai.monkeytravel.com/globals/common/kr/img/btn/btn_date.gif" class="cal"></div>
                            </div><!-- 호텔 인포 페이지 숙박일수 추가  -->
                            <div class="custom_input"><span class="ic_chout"></span>
                                <div class="val_wrap"><input type="text" id="checkOutDate" placeholder="체크아웃" readonly="readonly" value=""><input type="hidden" name="checkOutDate" id="checkOutDate_Alt" value=""><img src="https://thai.monkeytravel.com/globals/common/kr/img/btn/btn_date.gif" class="cal"></div>
                            </div>
                        </div>
                        <div class="custom_input_ht"><span class="ic_hotelnm"></span><input type="text" name="name" placeholder="호텔명(미입력시 전체)" id="top_search_hotels_input"></div>
                        <div class="btn_area"><input type="button" class="custom_btn1 b_orange b_p1030" value="검색" onclick="javascript:goTopSearchHotel('HT');"><input type="hidden" name="topSerachDetailBtnOpen" id="topSerachDetailBtnOpen" value="N"><input type="button" class="custom_btn1 b_gray2 b_p1030 ml10" onclick="javascript:goMapSearchHotel();" value="지도검색"> </div>
                    </div>
                    <div class="top_serach_box_filter">
                        <table>
                            <colgroup>
                                <col style="width: 17%">
                                <col style="width: 83%">
                            </colgroup>
                            <tbody><!-- 세부지역 -->
                                <tr>
                                    <th><span class="search_block"> 세부지역 <i class="fa fa-plus f_13"></i> <i class="fa fa-minus f_13"></i></span></th>
                                    <td id="town" data-sid="hoteltype" class="ui-buttonset">
                                        <div class="filter_content"><span class="search_block"><input type="checkbox" id="area0" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="99"><label for="area0" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button-text">스쿰빗(아속-프롬퐁)</span></label></span><span class="search_block"><input type="checkbox" id="area1" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="2"><label for="area1" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">차오프라야강가</span></label></span><span class="search_block"><input type="checkbox" id="area2" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="7"><label for="area2" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">실롬/사톤</span></label></span><span class="search_block"><input type="checkbox" id="area3" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="12"><label for="area3" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">시암</span></label></span><span class="search_block"><input type="checkbox" id="area4" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="628"><label for="area4" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">스쿰빗(통로-에까마이)</span></label></span><span class="search_block"><input type="checkbox" id="area5" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="3"><label for="area5" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">랑수언/위타유</span></label></span><span class="search_block"><input type="checkbox" id="area6" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="4"><label for="area6" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">스쿰빗(나나-플런칫)</span></label></span><span class="search_block"><input type="checkbox" id="area7" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="24"><label for="area7" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">카오산/왕궁/차이나타운</span></label></span><span class="search_block"><input type="checkbox" id="area8" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="23"><label for="area8" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">라차다</span></label></span><span class="search_block"><input type="checkbox" id="area9" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="25"><label for="area9" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">수완나품 공항주변</span></label></span><span class="search_block"><input type="checkbox" id="area10" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="629"><label for="area10" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">스쿰빗(프라카농-온눗)</span></label></span><span class="search_block"><input type="checkbox" id="area11" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="647"><label for="area11" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">빠뚜남/펫부리</span></label></span><span class="search_block"><input type="checkbox" id="area12" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="683"><label for="area12" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">아눗싸와리-짜뚜짝</span></label></span><span class="search_block"><input type="checkbox" id="area13" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="26"><label for="area13" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">방나 / 시나카린</span></label></span><span class="search_block"><input type="checkbox" id="area14" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="630"><label for="area14" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">스쿰빗(방짝-우돔숙)</span></label></span><span class="search_block"><input type="checkbox" id="area15" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="91"><label for="area15" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">돈무앙 공항주변</span></label></span><span class="search_block"><input type="checkbox" id="area16" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="684"><label for="area16" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">람캄행</span></label></span><span class="search_block"><input type="checkbox" id="area17" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="80"><label for="area17" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">논타부리</span></label></span><span class="search_block"><input type="checkbox" id="area18" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="45"><label for="area18" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">사뭇 쁘라칸</span></label></span><span class="search_block"><input type="checkbox" id="area19" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="1142"><label for="area19" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">차오프라야 강건너 외곽</span></label></span><span class="search_block"><input type="checkbox" id="area20" class="town_id_class ui-helper-hidden-accessible" name="town_id" value="63"><label for="area20" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button-text">기타</span></label></span></div>
                                    </td>
                                </tr><!-- 호텔타입 -->
                                <tr>
                                    <th><span class="search_block">호텔타입 </span></th>
                                    <td id="hoteltype" data-sid="hoteltype" class="ui-buttonset"><span class="search_block"><input type="checkbox" id="t0" name="searchOptionOR[]" value="HOTEL" class="ui-helper-hidden-accessible"><label for="t0" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button-text"> 호텔</span></label></span><span class="search_block"><input type="checkbox" id="t1" name="searchOptionOR[]" value="RESIDENCE" class="ui-helper-hidden-accessible"><label for="t1" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"> 레지던스</span></label></span><span class="search_block"><input type="checkbox" id="t2" name="searchOptionOR[]" value="RESORT" class="ui-helper-hidden-accessible"><label for="t2" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"> 리조트</span></label></span><span class="search_block"><input type="checkbox" id="t3" name="searchOptionOR[]" value="POOLVILLA" class="ui-helper-hidden-accessible"><label for="t3" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button-text"> 풀빌라</span></label></span></td>
                                </tr><!-- 호텔등급 -->
                                <tr>
                                    <th><span class="search_block">호텔등급</span></th>
                                    <td id="prdgrade_top_search" data-sid="grade" class="ui-buttonset"><span class="search_block ui-button ui-widget ui-corner-all"><input type="checkbox" id="rat5" name="grade[]" value="5" class="ui-helper-hidden-accessible"><label for="rat5" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button-text"> 5성급</span></label></span><span class="search_block ui-button ui-widget ui-corner-all"><input type="checkbox" id="rat4" name="grade[]" value="4" class="ui-helper-hidden-accessible"><label for="rat4" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"> 4성급</span></label></span><span class="search_block ui-button ui-widget ui-corner-all"><input type="checkbox" id="rat3" name="grade[]" value="3" class="ui-helper-hidden-accessible"><label for="rat3" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"> 3성급</span></label></span><span class="search_block ui-button ui-widget ui-corner-all"><input type="checkbox" id="rat2" name="grade[]" value="2" class="ui-helper-hidden-accessible"><label for="rat2" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button-text"> 2성급</span></label></span></td>
                                </tr><!-- 1박 가격대 -->
                                <tr>
                                    <th><span class="search_block">1박 평균가격 </span></th>
                                    <td id="price_range"><input type="hidden" class="searchFilter" data-sid="priceFrom" id="priceFrom" name="priceFrom" value="10000"><input type="hidden" class="searchFilter" data-sid="priceTo" id="priceTo" name="priceTo" value="500000">
                                        <div class="w50"><span class="pt7 fl price_from_txt"><span> 10,000원</span></span>
                                            <div class="price_rangebox pt10">
                                                <div id="slider_price_top_search" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                                                    <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a>
                                                </div>
                                            </div><span class="pt7 fl price_to_txt"><span> 500,000원 이상</span></span>
                                        </div>
                                        <div class="btn_currencybox" style="left: 600px">
                                            <div class="btn_currency mt3 ui-buttonset"><span class="label_left pt4" style="left: -50px">원</span><input type="radio" id="btn_currency_KRW" class="searchFilter ui-helper-hidden-accessible" data-sid="currentp" name="currentp" onclick="selectCurrencyType($(this).val());" value="KRW" checked="checked"><label for="btn_currency_KRW" style="left: -5px;" class="ui-button ui-widget ui-state-default ui-button-text-only ui-state-active ui-corner-left" role="button" aria-disabled="false" aria-pressed="true"><span class="ui-button-text"></span></label><input type="radio" id="btn_currency_THB" class="searchFilter ui-helper-hidden-accessible" data-sid="currentp" name="currentp" onclick="selectCurrencyType($(this).val());" value="THB"><label for="btn_currency_THB" style="left:15px;" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false" aria-pressed="false"><span class="ui-button-text"></span></label><span class="label_right t pt4">바트</span></div>
                                        </div>
                                    </td>
                                </tr><!-- 프로모션 -->
                                <tr class="box_toggle" id="chkPromotionYn">
                                    <th><span class="search_block">프로모션 <i class="fa fa-plus f_13"></i> <i class="fa fa-minus f_13"></i></span></th>
                                    <td id="promotion_type" data-sid="promotion_type" class="ui-buttonset">
                                        <div class="filter_content01"><span class="search_block"><input type="checkbox" id="AFH0" name="AFH0" value="Y" class="ui-helper-hidden-accessible"><label for="AFH0" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button-text">무료숙박(1+1,2+1등)</span></label></span><span class="search_block"><input type="checkbox" id="AFH1" name="AFH1" value="Y" class="ui-helper-hidden-accessible"><label for="AFH1" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">특별패키지</span></label></span><span class="search_block"><input type="checkbox" id="AFH2" name="AFH2" value="Y" class="ui-helper-hidden-accessible"><label for="AFH2" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">룸업그레이드</span></label></span><span class="search_block"><input type="checkbox" id="AFH3" name="AFH3" value="Y" class="ui-helper-hidden-accessible"><label for="AFH3" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">레이트 체크아웃 무료</span></label></span><span class="search_block"><input type="checkbox" id="AFH4" name="AFH4" value="Y" class="ui-helper-hidden-accessible"><label for="AFH4" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">얼리버드 할인</span></label></span><span class="search_block"><input type="checkbox" id="AFH5" name="AFH5" value="Y" class="ui-helper-hidden-accessible"><label for="AFH5" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">엑스트라베드 무료</span></label></span><span class="search_block"><input type="checkbox" id="AFH6" name="AFH6" value="Y" class="ui-helper-hidden-accessible"><label for="AFH6" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">아동엑스트라베드 무료</span></label></span><span class="search_block"><input type="checkbox" id="AFH7" name="AFH7" value="Y" class="ui-helper-hidden-accessible"><label for="AFH7" class="ui-button ui-widget ui-state-default ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">아동조식 무료</span></label></span><span class="search_block"><input type="checkbox" id="AFH8" name="AFH8" value="Y" class="ui-helper-hidden-accessible"><label for="AFH8" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button-text">공항픽업 무료</span></label></span><span class="search_block"></span><span class="search_block"></span></div>
                                    </td>
                                </tr><!-- 테마 --><!-- 침실수 -->
                                <tr>
                                    <th><span class="search_block">침실수</span></th>
                                    <td id="num_room" data-sid="num_room" class="ui-buttonset"><span class="search_block"><input type="checkbox" id="AFH26" name="AFH26" value="Y" class="ui-helper-hidden-accessible"><label for="AFH26" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-left" role="button" aria-disabled="false"><span class="ui-button-text">2 베드룸(성인 4~5인)</span></label></span><span class="search_block"><input type="checkbox" id="AFH27" name="AFH27" value="Y" class="ui-helper-hidden-accessible"><label for="AFH27" class="ui-button ui-widget ui-state-default ui-button-text-only ui-corner-right" role="button" aria-disabled="false"><span class="ui-button-text">3 베드룸~(성인 6인~)</span></label></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn_area ac mt10"><input type="button" class="custom_btn1 b_orange b_p1030" value="검색" onclick="javascript:goTopSearchHotel('HT');"><input type="hidden" name="topSerachDetailBtnOpen" id="topSerachDetailBtnOpen" value="N"><input type="button" class="custom_btn1 b_gray2 b_p1030 ml10" onclick="javascript:goMapSearchHotel();" value="지도검색"></div>
                    </div>
                    <script type="text/javascript" src="/globals/js/checkAge.js?v=2019122702"></script>
                    <script>
                        var _KRW = [10000, 500000, '원'];
                        var _THB = [100, 10000, '바트'];
                        var _TWD = [100, 10000, '대만달러'];
                        var _PHP = [100, 15000, '페소'];
                        var _VND = [100, 5000, '동'];
                        var _USD = [10, 1000, '달러'];
                        var _tmpCurrency = "KRW"; /* 셀렉트박스 클릭 범위가 작아 div영역에 클릭이벤트 할당 */
                        $(document).ready(function() {
                            var a = $('#amount_search, #adultCount, #childCount'); /*  모바일 -> PC 전환시 작동가능하게 */
                            a.selectric({
                                disableOnMobile: false,
                                nativeOnMobile: false
                            });
                            $("#brRoom").on('click', function() {
                                openSelectric('#amount_search');
                            });
                            $("#brAdult").on('click', function() {
                                openSelectric('#adultCount');
                            });
                            $("#brChild").on('click', function() {
                                openSelectric('#childCount');
                            });
                            setAdultChildText();
                        }); /* jquery.Selectric 옵션 활용 setTimeout 줘야 작동 */
                        function openSelectric(divID) {
                            var Selectric = $(divID);
                            Selectric.selectric('init');
                            setTimeout(function() {
                                Selectric.selectric('open');
                            }, 50);
                        }

                        function checkDuplicate(value) {
                            var searchRecentList = JSON.parse(localStorage.getItem("searchMainInfo"));
                            var result = true;
                            var checkValue = value.checkInDate + value.checkOutDate + value.amount + value.adult + value.child + value.age;
                            if (searchRecentList && searchRecentList.length > 0) {
                                searchRecentList.map(function(item) {
                                    if (item.child == null) {
                                        item.child = 0;
                                        item.age = "";
                                    }
                                    if (checkValue == item.checkInDate + item.checkOutDate + item.amount + item.adult + item.child + item.age) {
                                        result = false;
                                    }
                                });
                            }
                            return result;
                        }

                        function saveLocalStorage(obj) {
                            localStorage.setItem('searchMainInfo', JSON.stringify(obj));
                        }

                        function goTopSearchHotelInfo(tp) {
                            var f = document.schMain;
                            $("#mapSearchYN").val("N");
                            if (tp == "HT") {
                                checkTheme();
                            }
                            if (ck_form(f)) {
                                var obj = {
                                    cityName: '',
                                    checkInDate: moment($('#checkInDate').val()).format('YYYY-MM-DD'),
                                    checkOutDate: moment($('#checkOutDate').val()).format('YYYY-MM-DD'),
                                    city_id: '1',
                                    town_id: '',
                                    adult: $('#adultCount').val(),
                                    amount: $('#amount_search').val(),
                                    child: $('#childCount').val(),
                                    age: $('select[name="ck_childAge[]"] option:selected').toArray().map(item => item.value)
                                };
                                if (checkDuplicate(obj) == true) {
                                    var searchRecentList = JSON.parse(localStorage.getItem("searchMainInfo"));
                                    if (searchRecentList == null) {
                                        searchRecentList = [];
                                    }
                                    searchRecentList.unshift(obj);
                                    console.log(searchRecentList);
                                    if (searchRecentList.length > 3) {
                                        searchRecentList.pop();
                                    }
                                    saveLocalStorage(searchRecentList);
                                };
                                f.action = "product_info.php";
                                f.submit();
                            }
                        }

                        function goTopSearchHotel(tp) {
                            var f = document.schMain;
                            $("#mapSearchYN").val("N");
                            if (tp == "HT") {
                                checkTheme();
                            }
                            if (ck_form(f)) {
                                f.submit();
                            }
                        }

                        function goMapSearchHotel() {
                            var f = document.schMain;
                            $("#mapSearchYN").val("Y");
                            checkTheme();
                            if (ck_form(f)) {
                                f.submit();
                            }
                        }

                        function goMapSearchHotelInfo() {
                            var f = document.schMain;
                            $("#mapSearchYN").val("Y");
                            checkTheme();
                            if (ck_form(f)) {
                                f.action = "product_info.php";
                                f.submit();
                            }
                        } /*상단으로 스크롤*/
                        function goTopSearchForm() {
                            var objTarget = '';
                            objTarget = ".product_hotel_search_div";
                            var obj = $(objTarget).offset().top;
                            if (typeof(obj) != "undefined") {
                                $('html,body').animate({
                                    'scrollTop': obj
                                }, 900);
                                if ($("#mapSearchYN").val() == 'Y') {
                                    setTimeout(function() {
                                        tracking('MAP_PC_LIST', '0');
                                        showMapSearch('hotel', '1', 'N');
                                    }, 910);
                                }
                            }
                        } /* 테마 선택 */
                        function checkTheme() {
                            /*var text = "";$('input[id^="theme_filter_"]').each(function(){if ($(this).is(":checked")) {if (text != ""){text += ",";}text += $(this).val();}});$('#theme_list_id').val(text);*/
                        } /*나이 선택*/
                        function choice_age_join() {
                            var text = "";
                            if ($("#childCount").val() != 0 && $("#childCount").val() != null) {
                                $('select[id^="input_age_"]').each(function(index) {
                                    if (index > 0) {
                                        text += ",";
                                    }
                                    text += $(this).val();
                                });
                            }
                            $('#child_age_value').val(text);
                            $('#child_age_value_XML').val(text);
                        } /* 아동  나이 객실 수 상관없이 아동수 받기로 변경 */
                        function age_wrap_option(val, arr) {
                            var amount = $("#amount_search").val();
                            var childCount = parseInt(val);
                            var html = "";
                            var childPolicyAge = 12;
                            var arrAge = "";
                            if (typeof arr == "undefined" || arr == null || arr == '' || arr == "undefined") {} else {
                                var arrAge = arr.split(',');
                            }
                            $('#child_age').html("");
                            if (childCount > 0) {
                                for (var i = 1; i <= childCount; i++) {
                                    html = "";
                                    html += "<select class='selectric' name='ck_childAge[]' id='input_age_" + i + "' onchange='choice_age_join()'>";
                                    for (var j = 1; j < childPolicyAge; j++) {
                                        if (j == arrAge[i - 1]) {
                                            html += "<option value=" + j + " selected>" + j + "</option>";
                                        } else {
                                            html += "<option value=" + j + ">" + j + "</option>";
                                        }
                                    }
                                    html += "</select>";
                                    html += "<br />";
                                    $('#child_age').append(html);
                                    $('#input_age_' + i).selectric();
                                }
                                $(".age_wrap").show();
                                $(".is_child").show();
                            } else {
                                $('#child_age').html("");
                                $(".age_wrap").hide();
                                $('#child_age_value').val("");
                                $('#child_age_value_XML').val("");
                            }
                            showRoomCuestsInfomation();
                        } /* 객실 선택에 따른 투숙인원 변경 */
                        function setNumberOfGuests(val) {
                            $(".multi_room").show();
                            setAdultChildText();
                            showRoomCuestsInfomation();
                        }

                        function setAdultChildText() {
                            if ($("#amount_search").val() > 1) {
                                $("#adultCountText").show();
                                $("#childCountText").show();
                            } else {
                                $("#adultCountText").hide();
                                $("#childCountText").hide();
                            }
                        } /* 객실 및 정보 영역 객실 및 인원선택시 항상 실행 */
                        function showRoomCuestsInfomation() {
                            $("#roomCnt").text($("#amount_search").val());
                            $("#adultCnt").text($("#adultCount").val() * $("#amount_search").val());
                            $("#childCnt").text($("#childCount").val() * $("#amount_search").val());
                            choice_age_join();
                        } /* 숫자 3자리 콤마 찍기 */
                        function commaSplit(n) {
                            var txtNumber = '' + n;
                            var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
                            var arrNumber = txtNumber.split('.');
                            arrNumber[0] += '.';
                            do {
                                arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
                            } while (rxSplit.test(arrNumber[0]));
                            if (arrNumber.length > 1) {
                                return arrNumber.join('');
                            } else {
                                return arrNumber[0].split('.')[0];
                            }
                        } /* 가격 선택 */
                        function selectCurrencyType(v) {
                            $("#priceFrom").val("");
                            $("#priceTo").val("");
                            setSlidePrice("_" + v);
                        } /* city_id로 town_list 가져오기 */
                        function getRegionSpan(city_id, fn) {
                            $.get("/user/getRegion.php", {
                                "city_id": city_id
                            }, function(res) {
                                var spr = eval('(' + res + ')');
                                fn.call(null, city_id, spr);
                            });
                        } /* city_id로 town list 가져오기 */
                        function regionSubSpan(rgn, jdoc) {
                            if (rgn == "") {
                                $("#town").empty();
                            } else if (jdoc.errNo == "00") {
                                var opts = '<span class="search_block">';
                                for (var i = 0; i < jdoc.rgnList.length; i++) {
                                    if (jdoc.rgnList[i].town_i18n.localName == null) {
                                        jdoc.rgnList[i].town_i18n.localName = jdoc.rgnList[i].town.globalName;
                                    }
                                    opts += '<input type="radio" id="area' + i + '" name="town_id" value="' + jdoc.rgnList[i].town.id + '"><label for="area' + i + '">' + jdoc.rgnList[i].town_i18n.localName + '</label>';
                                }
                                opts += '</span>';
                                $("#town").empty().html(opts);
                                $("#town").buttonset();
                            }
                        } /* 가격 검색 슬라이드바 값 세팅 */
                        function setSlidePrice(curType) {
                            /* curType은 _THB, _KRW 등 전역변수에서 가져옴 */
                            var thisEval = eval(curType);
                            var priceTextFrom = "";
                            var priceTextTo = "";
                            var fromVal = thisEval[0];
                            var toVal = thisEval[1];
                            var currencyVal = thisEval[2];
                            if ($("#priceFrom").val() > 0 && $("#priceTo").val() > 0) {
                                fromVal = $("#priceFrom").val();
                                toVal = $("#priceTo").val();
                            }
                            $("#btn_currency" + curType).attr('checked', true).trigger("create");
                            $(".btn_currency").buttonset();
                            if (curType == "_VND") {
                                priceTextFrom += "<span> " + commaSplit(fromVal) + "K</span>";
                                priceTextTo += "<span> " + commaSplit(toVal) + "K" + currencyVal + " 이상</span>";
                            } else {
                                priceTextFrom += "<span> " + commaSplit(fromVal) + currencyVal + "</span>";
                                priceTextTo += "<span> " + commaSplit(toVal) + currencyVal + " 이상</span>";
                            }
                            if (curType == '_KRW') {
                                stepVal = 10000;
                            } else if (curType == '_USD') {
                                stepVal = 10;
                            } else {
                                stepVal = 100;
                            }
                            $(".price_from_txt").html(priceTextFrom).trigger("create");
                            $(".price_to_txt").html(priceTextTo).trigger("create");
                            $("#slider_price_top_search").slider({
                                min: thisEval[0],
                                max: thisEval[1],
                                step: stepVal,
                                range: true,
                                values: [fromVal, toVal],
                                slide: function(event, ui) {
                                    priceTextFrom = "";
                                    priceTextTo = "";
                                    fromVal = ui.values[0];
                                    toVal = ui.values[1];
                                    if (curType == "_VND") {
                                        priceTextFrom += "<span> " + commaSplit(fromVal) + "K</span>";
                                        priceTextTo += "<span> " + commaSplit(toVal) + "K" + currencyVal;
                                    } else {
                                        priceTextFrom += "<span> " + commaSplit(fromVal) + currencyVal + "</span>";
                                        priceTextTo += "<span> " + commaSplit(toVal) + currencyVal;
                                    }
                                    if (toVal == thisEval[1]) {
                                        priceTextTo += " 이상";
                                    }
                                    priceTextTo += "</span>";
                                    $(".price_from_txt").html(priceTextFrom).trigger("create");
                                    $(".price_to_txt").html(priceTextTo).trigger("create");
                                },
                                stop: function(event, ui) {
                                    priceTextFrom = "";
                                    priceTextTo = "";
                                    fromVal = ui.values[0];
                                    toVal = ui.values[1];
                                    if (curType == "_VND") {
                                        priceTextFrom += "<span> " + commaSplit(fromVal) + "K</span>";
                                        priceTextTo += "<span> " + commaSplit(toVal) + "K" + currencyVal;
                                    } else {
                                        priceTextFrom += "<span> " + commaSplit(fromVal) + currencyVal + "</span>";
                                        priceTextTo += "<span> " + commaSplit(toVal) + currencyVal;
                                    }
                                    if (toVal == thisEval[1]) {
                                        priceTextTo += " 이상";
                                    }
                                    priceTextTo += "</span>";
                                    $(".price_from_txt").html(priceTextFrom).trigger("create");
                                    $(".price_to_txt").html(priceTextTo).trigger("create");
                                    $("#priceFrom").val(fromVal);
                                    $("#priceTo").val(toVal);
                                }
                            });
                        }
                        $(function() {
                            if ($("#childCount").val() == 0) {
                                $(".age_wrap").hide();
                                $("#childCount").val("");
                            } else {
                                age_wrap_option($("#childCount").val(), $("#pre_child_age_value").val());
                                childChangeAction($("#childCount").val(), 'N');
                            }
                            showRoomCuestsInfomation();
                            $('.top_serach').addClass('show');
                            $(".notice_txt").hide();
                            $("#town, #theme_type").buttonset();
                            $('#prdgrade_top_search, #hoteltype, #promotion_type, #num_room').buttonset();
                            $(".btn_currency").buttonset(); /* 라디오 처럼 동작하기 */
                            $('input[type="checkbox"][name="town_id"]').click(function() {
                                if ($(this).prop('checked')) {
                                    $("#town .town_id_class").prop('checked', false).button("refresh");
                                    $(this).prop('checked', true).button("refresh");
                                }
                            });
                            $('input[type="checkbox"][name="theme_list_id"]').click(function() {
                                if ($(this).prop('checked')) {
                                    $("#theme_type .theme_list_id_class").prop('checked', false).button("refresh");
                                    $(this).prop('checked', true).button("refresh");
                                }
                            }); /* 라디오 처럼 동작하기 끝 */ /* 가격 초기화 */
                            var thisVal = _tmpCurrency;
                            setSlidePrice("_" + thisVal);
                            $("#top_search_hotels_input").keypress(function(e) {
                                if (e.which == 10 || e.which == 13) {
                                    /* alert("aaa");*/
                                    $("#top_search_hotel_form").submit();
                                }
                            });
                            var today = new Date();
                            today = moment(today).format('YYYY-MM-DD'); /*checkInDate, checkOutDate가 url parameter로 사용되어 변환이 필요 */
                            var datePickerTargetID = '';
                            var checkInDateID = $('#checkInDate');
                            var checkOutDateID = $('#checkOutDate');
                            var checkInDateAltID = $('#checkInDate_Alt');
                            var checkOutDateAltID = $('#checkOutDate_Alt');
                            datePickerTargetID = 'two-inputs';
                            $('#' + datePickerTargetID).dateRangePicker({
                                separator: ' ~ ',
                                container: '#search_calenderbox',
                                autoClose: true,
                                minDays: 1,
                                startDate: today,
                                stickyMonths: true,
                                language: 'ko',
                                getValue: function() {
                                    if (checkInDateID.val() && checkOutDateID.val()) {
                                        return checkInDateID.val() + ' ~ ' + checkOutDateID.val();
                                    } else {
                                        return '';
                                    }
                                },
                                setValue: function(s, s1, s2) {
                                    moment.locale('ko');
                                    s1 = moment(s1).format('YYYY-MM-DD(ddd)');
                                    s2 = moment(s2).format('YYYY-MM-DD(ddd)');
                                    checkInDateID.val(s1);
                                    checkOutDateID.val(s2);
                                    var nm1 = moment(s1, "YYYY-MM-DD").format('YYYY-MM-DD');
                                    var nm2 = moment(s2, "YYYY-MM-DD").format('YYYY-MM-DD');
                                    checkInDateAltID.val(nm1);
                                    checkOutDateAltID.val(nm2);
                                    var days = moment(s2, "YYYY-MM-DD").diff(moment(s1, "YYYY-MM-DD"));
                                    days = Math.ceil(days / 86400000);
                                    $('#show_days').val(days + "박");
                                }
                            }).bind('datepicker-closed', function() {
                                /* This event will be triggered before date range picker close animation */
                                $('.modal_delete.close3').trigger('click');
                            });
                        }); /* 아동 셀렉트박스 인원변동 액션 */
                        function childChangeAction(childCount, yn) {
                            var amount = $("#amount_search").val();
                            var childCount = parseInt(childCount);
                            var html = "";
                            var childPolicyAge = 12;
                            $("#childCount_XML").val(childCount);
                            if (childCount != 0) {
                                onDraw('#babyDrawArea', childCount, childPolicyAge);
                                if (yn == 'Y') {
                                    $("#layerBaby").show();
                                }
                            } else {
                                $("#babyDrawArea").empty();
                                $("#layerBaby").hide();
                                $('#child_age_value').val("");
                                $('#child_age_value_XML').val("");
                            }
                            showRoomCuestsInfomation();
                        } /* 아동나이 레이어 팝업 아동수만큼 그려주기 */
                        function onDraw(divID, selval, childMaxAge) {
                            var arr = $("#pre_child_age_value").val();
                            var arrAge = '';
                            if (typeof arr == "undefined" || arr == null || arr == '' || arr == "undefined") {} else {
                                arrAge = arr.split(',');
                            }
                            $(divID).empty();
                            for (var i = 1; i <= selval; i++) {
                                var strTemp = '';
                                if (arrAge[i - 1] == '') {
                                    strTemp = '<option value="" selected>선택</option>';
                                } else {
                                    strTemp = '<option value="">선택</option>';
                                }
                                for (var k = 1; k < childMaxAge; k++) {
                                    if (k == arrAge[i - 1]) {
                                        strTemp += '<option value=' + k + ' selected>' + k + '세</option>';
                                    } else {
                                        strTemp += '<option value=' + k + '>' + k + '세</option>';
                                    }
                                }
                                $(divID).append('<dt>아동 ' + i + ':</dt>' + '<dd>' + '<p>만</p>' + '<select name="ck_childAge[]" id="input_age_' + i + '" exp="나이" msgr="아동의 나이를 선택해 주세요." onchange="choice_age_join()" >' + strTemp + '</select>' + '</dd>');
                            }
                        } /* 만나이 계산하기 버튼 클릭(입실일 기준) */
                        function getAge() {
                            var a = $("#birthdt").val();
                            var b = "";
                            if (a != "" && b != "" && a.length > 9 && b.length > 9) {
                                $("#calage").text("만 " + ageCompute(a.substring(0, 10), b.substring(0, 10)) + "세입니다.");
                                $("#calageLayer").show();
                            } else {
                                alert("만나이 계산기 날짜를 입력해주세요");
                                $("#calage").text("");
                                $("#calageLayer").hide();
                                return false;
                            }
                        }

                        function ageCompute(birthday, checkInDate) {
                            var checkarr = checkInDate.split("-");
                            var nd = new Date(checkarr[0], checkarr[1] - 1, checkarr[2]);
                            var birtharr = birthday.split("-");
                            var id = new Date(birtharr[0], birtharr[1] - 1, birtharr[2]);
                            var rd = ((nd.getTime() - id.getTime()) / 1000 / 60 / 60 / 24);
                            var ryear = nd.getFullYear() - id.getFullYear();
                            var rmonth = nd.getMonth() - id.getMonth();
                            var rdate = nd.getDate() - id.getDate();
                            if (rdate < 0) {
                                rmonth--;
                                rdate += 30;
                            }
                            if (rmonth < 0) {
                                ryear--;
                                rmonth += 12;
                            }
                            var agem = nd.getFullYear() - id.getFullYear() - 1;
                            if ((nd.getMonth() >= id.getMonth() && nd.getDate() >= id.getDate()) || nd.getMonth() > id.getMonth()) agem++;
                            return agem;
                        }

                        function setSearchParam(value) {
                            var checkInDate = moment(value.checkInDate);
                            var checkOutDate = moment(value.checkOutDate);
                            $('#checkInDate').val(checkInDate.format('YYYY-MM-DD(dd)'));
                            $('#checkOutDate').val(checkOutDate.format('YYYY-MM-DD(dd)'));
                            $('#checkInDate_Alt').val(checkInDate.format('YYYY-MM-DD'));
                            $('#checkOutDate_Alt').val(checkOutDate.format('YYYY-MM-DD'));
                            var days = checkOutDate.diff(checkInDate);
                            days = Math.ceil(days / 86400000);
                            $('#show_days').val(days + "박");
                            $('#amount_search').prop('selectedIndex', value.amount - 1).selectric('refresh');
                            $('#adultCount').prop('selectedIndex', value.adult - 1).selectric('refresh');
                            $('#childCount').prop('selectedIndex', value.child).selectric('refresh');
                            childChangeAction($("#childCount").val(), 'Y');
                            if (value.child > 0) {
                                $('select[id^="input_age_"]').each(function(index) {
                                    $(this).val(value.age[index]).change();
                                });
                            }
                        }
                    </script>
                </div>
                <style>
                    .top_serach {
                        margin: inherit !important;
                        padding: 0 !important;
                        border: 0 !important;
                    }

                    .search_location {
                        width: 170px !important;
                        border: 1px solid #e2e2e2;
                        padding: 7px 5px;
                        float: left;
                        background: #fff;
                        margin-right: 5px;
                        position: relative;
                        cursor: pointer;
                    }

                    tr .filter_content,
                    tr .filter_content01,
                    tr .filter_content02 {
                        font-size: 13px;
                        height: inherit;
                    }

                    .custom_input_ht {
                        width: 210px !important;
                        border: 1px solid #e2e2e2;
                        padding: 7px 0;
                        float: left;
                        background: #fff;
                        margin-right: 5px;
                        position: relative;
                        cursor: pointer;
                        height: 40px;
                        padding-left: 3px
                    }
                </style>
                <style>
                    .mr5 {
                        margin-right: 5px
                    }

                    .ml10 {
                        margin-left: 10px !important;
                    }

                    .custom_input_ht input {
                        width: 180px;
                        font-size: 12px;
                        height: 22px;
                        border: 0;
                        outline: none;
                        float: right;
                        color: #555;
                        padding: 0 0 0 5px !important;
                        background: 0 0;
                        cursor: pointer
                    }

                    .filter_content,
                    .filter_content01,
                    .filter_content02 {
                        font-size: 13px;
                        height: 32px;
                        overflow: hidden;
                    }

                    .top_serach_btn {
                        padding: 10px 50px;
                        font-size: 14px
                    }

                    tr.box_toggle .filter_content,
                    tr.box_toggle .filter_content01,
                    tr.box_toggle .filter_content02 {
                        height: inherit;
                    }

                    tr i.fa-minus {
                        display: none;
                    }

                    tr i.fa-plus {
                        display: none;
                    }

                    .top_serach_box_filter th {
                        text-align: left;
                        padding-left: 10px;
                        position: relative;
                        font-weight: normal;
                    }

                    .top_serach_box_filter th i {
                        position: absolute;
                        top: 18px;
                        right: 45px;
                        font-weight: normal;
                        color: #ccc
                    }

                    .top_serach_box_filter .ui-state-default,
                    .top_serach_box_filter .ui-widget-content .ui-state-default,
                    .top_serach_box_filter .ui-widget-header .ui-state-default {
                        font-weight: normal;
                        font-family: Dotum, '돋움', Helvetica, AppleSDGothicNeo, sans-serif;
                        color: #555;
                    }

                    .top_serach_box_filter .ui-state-active .ui-button-text {
                        color: #fff
                    }

                    .top_serach_box_filter td#price_range {
                        padding-left: 14px
                    }

                    .item_list_area .item_list .thm img {
                        width: 170px;
                        height: 128px
                    }

                    .item_list li>.cont_side {
                        width: 20%;
                        height: 128px;
                    }
                </style>
                <style>
                    .s_form {
                        padding: 0px;
                    }
                </style>
            </div>
        </div>
        <div class="popup_bg"></div>
    </div>

    <style>
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
            width: 1000px;
            min-height: 180px;
            border: 1px solid #eee;
            padding: 15px;
            z-index: 1200;
            box-sizing: border-box;
            margin: 145px auto 100px;
            position: relative;
            border: 1px solid #17469E;
            border-radius: 10px;

        }

        .popup_wraper .btn_close_popup {
            position: absolute;
            top: -23px;
            right: 4px;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
}



        .top_serach_box_filter {
            width: 100%;
            height: 0;
            border-top: 1px solid #eee;
            opacity: 0;
            visibility: hidden;
            transition: height .2s ease-in-out, opacity .1s ease-in-out, visibility .1s ease-in-out, padding-top .2s ease-in-out;
            overflow: hidden
        }

        .ac {
            text-align: center !important;
        }

        #price_range .price_rangebox {
    width: 53%;
    float: left;
    padding: 3%;
}
.w50 {
    width: 50% !important;
}
.pt7 {
    padding-top: 7px !important;
}
.fl {
    float: left;
}
#price_range .ui-widget-content {
    border: 1px solid #e2e2e2;
}
#price_range .ui-corner-all {
    border-radius: 10px;
}
#price_range .ui-slider-horizontal {
    height: .5em;
}
.ui-widget-content {
    border: 1px solid #aaa;
    background: #fff url(/globals/common/css/images/ui-bg_flat_75_ffffff_40x100.png) 50% 50% repeat-x;
    color: #222;
}
.ui-slider {
    position: relative;
    text-align: left;
}

#price_range .ui-slider-horizontal .ui-slider-range {
    top: 0;
    height: 100%;
    background: #ffc411 !important;
    border: solid 1px #ffb03b;
}
.ui-slider .ui-slider-range {
    position: absolute;
    z-index: 1;
    font-size: .7em;
    display: block;
    border: 0;
    background-position: 0 0;
}

.pt10 {
    padding-top: 10px !important;
}

        .top_serach_box_filter table {
            height: 0;
            opacity: 0;
            visibility: hidden;
            transition: height .2s ease-in-out, opacity .1s ease-in-out, visibility .1s ease-in-out, padding-top .2s ease-in-out;
            overflow: hidden;
        }

        .top_serach_box_filter {
            height: inherit;
            opacity: 1;
            visibility: visible;
            transition: height .2s ease-in-out, opacity .3s ease-in-out, visibility .3s ease-in-out, padding-top .2s ease-in-out;
            margin-top: 20px
        }

        .top_serach_box_filter table {
            height: inherit;
            opacity: 1;
            visibility: visible;
            transition: height .2s ease-in-out, opacity .3s ease-in-out, visibility .3s ease-in-out, padding-top .2s ease-in-out
        }

        .b_p1030 {
            padding: 10px 30px;
        }

        .b_orange {
            color: #fff !important;
            border: solid 1px #d86619;
            background: #fb7622;
        }

        .custom_btn1 {
            display: inline-block !important;
            outline: none !important;
            cursor: pointer !important;
            text-align: center !important;
            text-decoration: none !important;
            line-height: normal !important;
            overflow: visible;
            vertical-align: middle !important;
            border: 0;
        }

        .b_gray2 {
            color: #fff !important;
            background-color: #777 !important;
        }

        .ui-button-text-only .ui-button-text {
            padding: .4em 1em;
        }

        .top_serach_detailbtn.open {
            display: none
        }

        .top_serach_detailbtn.close {
            display: block
        }

        .search_location {
            width: 250px;
            border: 1px solid #eee !important;
            padding: 7px 5px;
            float: left;
            background: #fff;
            margin-right: 5px;
            position: relative;
            cursor: pointer
        }

        .search_location input {
            border: 0;
            outline: none;
            width: 88%;
            float: right;
            padding: 0;
            height: 24px
        }

        .search_datecheck {
            float: left;
            margin-right: 5px;
            width: 339px;
            position: relative;
            cursor: pointer
        }

        .search_datecheck .custom_input {
            float: left;
            padding: 7px 0;
            border: 1px solid #eee;
            background: #fff
        }

        .search_datecheck .custom_input .val_wrap {
            border: 0;
            width: 165px
        }

        .search_datecheck .custom_input .val_wrap input {
            border: 0;
            outline: none;
            width: 78%;
            float: right
        }

        .search_datecheck .custom_input .val_wrap button img {
            position: absolute;
            top: 12px
        }

        .top_serach_box .custom_input .val_wrap {
            height: 24px
        }

        .top_serach_box .custom_input .val_wrap input {
            height: 24px
        }

        .search_datecheck .virtual-arrow {
            position: absolute;
            opacity: 0;
            left: 0;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            border-bottom: 11px solid #fff;
            border-left: 11px solid transparent;
            border-right: 11px solid transparent;
            will-change: left;
            z-index: 1;
            transition: opacity .2s ease-in
        }

        .search_peple {
            width: 220px;
            border: 1px solid #e2e2e2;
            padding: 7px 5px;
            float: left;
            background: #fff;
            margin-right: 5px;
            position: relative;
            cursor: pointer
        }

        .search_peple .search_peple_inform {
            cursor: pointer;
            margin-left: 30px
        }

        .search_peple .search_peple_inform span {
            font-size: 13px;
            float: left;
            line-height: 22px;
            margin-left: 5px;
            padding: 1px 0
        }

        .search_location_sel {
            position: absolute;
            top: 38px;
            padding: 20px;
            background: #fff;
            border: 1px solid #eee;
            font-size: 14px;
            min-width: 220px;
            z-index: 1002;
            left: -1px;
            opacity: 0;
            visibility: hidden;
            transition: height .2s ease-in-out, opacity .1s ease-in-out, visibility .1s ease-in-out, padding-top .2s ease-in-out;
            overflow: hidden
        }

        .search_location_sel li {
            padding: 5px 0
        }

        .search_location_sel.show {
            height: inherit;
            opacity: 1;
            visibility: visible;
            transition: height .2s ease-in-out, opacity .3s ease-in-out, visibility .3s ease-in-out, padding-top .2s ease-in-out
        }

        .search_people_sel {
            position: absolute;
            top: 38px;
            padding: 20px;
            background: #fff;
            border: 1px solid #eee;
            font-size: 14px;
            min-width: 190px;
            z-index: 100002;
            left: -1px;
            opacity: 0;
            visibility: hidden;
            transition: height .2s ease-in-out, opacity .1s ease-in-out, visibility .1s ease-in-out, padding-top .2s ease-in-out
        }

        .search_people_sel li {
            padding: 5px 0;
            line-height: 28px
        }

        .search_people_sel.show {
            height: inherit;
            opacity: 1;
            visibility: visible;
            transition: height .2s ease-in-out, opacity .3s ease-in-out, visibility .3s ease-in-out, padding-top .2s ease-in-out
        }

        .search_box_shadow {
            box-shadow: 0 4px 10px 3px rgba(0, 0, 0, .2)
        }

        #info_tab_1_tab .top_serach.product_hotel_search_div {
            background: #f9f9f9;
            border: 1px solid #e2e2e2;
            padding: 11px 20px;
            float: left
        }

        #info_tab_1_tab .top_serach.product_hotel_search_div .search_datecheck .custom_input {
            padding: 10px 0;
            margin-right: 10px
        }

        #info_tab_1_tab .top_serach.product_hotel_search_div .search_datecheck .custom_input .val_wrap input {
            font-size: 15px;
            color: #e60000;
            font-weight: 500
        }

        #info_tab_1_tab .top_serach.product_hotel_search_div .search_peple {
            padding: 10px 5px;
            width: 230px
        }
        #price_range .ui-state-default, #price_range .ui-widget-content .ui-state-default, #price_range .ui-widget-header .ui-state-default {
    border: 1px solid #f9f9f9;
    font-weight: 400;
    color: #212121;
    background: #e6e6e6 url(/globals/common/css/images/ui-bg_glass_75_e6e6e6_1x400.png) 50% 50% repeat-x;
}

        #info_tab_1_tab .top_serach.product_hotel_search_div .btn_area input {
            font-size: 16px;
            border: none;
            padding: 13px 40px;
            margin-top: 0 !important;
            background: #464646;
            line-height: 18px !important
        }

        #info_tab_1_tab .top_serach.product_hotel_search_div .search_peple .search_peple_inform span {
            font-size: 15px;
            color: #333
        }

        .top_serach_box_filter th i {
            top: 29px !important
        }

        .custom_input_ht input {
            margin-left: 30px;
            float: none !important
        }

        .h_search_wrap {
            background: #fff;
            border: 1px solid #eee
        }

        .h_search_wrap input {
            font-weight: 500;
            font-size: 14px !important
        }

        .ic_hotelnm {
            display: inline-block;
            width: 25px;
            height: 27px;
            overflow: hidden;
            background: url('/globals/common/img/ic/ic_searchbox.png') no-repeat;
            background-position: -155px -12px;
            position: absolute
        }

        .ic_mapmarker {
            display: inline-block;
            width: 20px;
            height: 27px;
            overflow: hidden;
            background: url('/globals/common/img/ic/ic_searchbox.png') no-repeat;
            background-position: -11px -11px;
            position: absolute
        }

        .ic_chin {
            display: inline-block;
            width: 25px;
            height: 27px;
            overflow: hidden;
            background: url('/globals/common/img/ic/ic_searchbox.png') no-repeat;
            background-position: -35px -11px;
            position: absolute
        }

        .ic_chout {
            display: inline-block;
            width: 25px;
            height: 27px;
            overflow: hidden;
            background: url('/globals/common/img/ic/ic_searchbox.png') no-repeat;
            background-position: -70px -11px;
            position: absolute
        }

        .ic_people {
            display: inline-block;
            width: 30px;
            height: 27px;
            overflow: hidden;
            background: url('/globals/common/img/ic/ic_searchbox.png') no-repeat;
            background-position: -115px -11px;
            position: absolute
        }

        .search_block {
            cursor: pointer
        }

        .top_serach_box_filter th,
        .top_serach_box_filter td {
            vertical-align: top;
            padding: 15px 5px;
            border-bottom: 1px solid #fff
        }

        .top_serach_box_filter tr:last-child th,
        .top_serach_box_filter tr:last-child td {
            border-bottom: none
        }

        .top_serach_box_filter th {
            padding-top: 25px;
            color: #999
        }

        .filter_content,
        .filter_content01 {
            font-size: 14px;
            height: 32px;
            overflow: hidden
        }

        .box_toggle {
            height: inherit
        }

        .search_people_sel li.notice_box {
            border-top: 1px dotted #e2e2e2;
            padding-top: 10px
        }

        .search_people_sel li .notice_txt {
            display: block;
            font-size: 12px;
            color: #888;
            line-height: 16px
        }

        .search_people_tit {
            font-weight: 500
        }

        .search_people_sel .selectricWrapper {
            width: 60px;
            float: right
        }

        .search_datebox {
            position: absolute;
            top: 38px;
            padding: 20px;
            background: #fff;
            border: 1px solid #e2e2e2;
            font-size: 14px;
            min-width: 420px;
            z-index: 1002;
            left: 0;
            opacity: 0;
            visibility: hidden;
            transition: height .2s ease-in-out, opacity .1s ease-in-out, visibility .1s ease-in-out, padding-top .2s ease-in-out;
            overflow: hidden
        }

        .search_datebox.show {
            height: inherit;
            opacity: 1;
            visibility: visible;
            transition: height .2s ease-in-out, opacity .3s ease-in-out, visibility .3s ease-in-out, padding-top .2s ease-in-out
        }

        .search_datebox li:first-child {
            border-bottom: 1px solid #e2e2e2;
            padding-bottom: 10px
        }

        .top_serach_box_filter .ui-state-default,
        .top_serach_box_filter .ui-widget-content .ui-state-default,
        .top_serach_box_filter .ui-widget-header .ui-state-default {
            border: 1px solid #f9f9f9;
            background: inherit
        }

        .top_serach_box_filter .ui-state-active {
            border: 1px solid #fd9802;
            background: #ff9f11;
            color: #fff;
            border-radius: 5px !important
        }

        .top_serach_box_filter .ui-widget {
            font-size: 13px
        }

        .top_serach_box_filter .ui-buttonset .ui-button {
            margin-left: 0;
            margin-right: 5px;
            margin-bottom: 5px
        }

        .top_serach_box_filter .ui-buttonset .ui-button:hover {
            color: #fb7622
        }

        .ui-button .ui-button-text {
            line-height: 1.4
        }
    </style>