<div class="popup_wraper">

    <div class="popup_container">
        <div class="popup_top">
            <div class="list_tab_select">
                <div class="item_tab active">
                    <p>호텔</p>
                </div>
                <div class="item_tab">
                    <p>투어</p>
                </div>
            </div>
            <div class="btn_close_popup">
                <img src="../images/ico/close-btn-grey.png" alt="">
            </div>

        </div>
        <div class="popup_header">
            <div class="form_element_">
                <div class="form_input_">
                    <label for="input_keyword_">여행지</label>
                    <input type="text" readonly="" id="input_keyword_" class="input_keyword_" placeholder="호텔 지역을 입력해주세요!">
                </div>
                <div class="form_input_multi_">
                    <div class="form_gr_" id="openDateRangePicker2">
                        <div class="form_input_ form_gr_item_">
                            <label for="input_day">체크인</label>
                            <input type="text" id="inp_day_start_" class="input_custom_ input_ranger_date_" placeholder="체크인 선택해주세요." readonly="">
                        </div>
                        <p>
                            <span id="countDay2" class="count">0</span>박
                        </p>
                        <div class="form_input_ form_gr_item_ form_gr_item_flex_">
                            <label for="input_day">체크아웃</label>
                            <input type="text" id="inp_day_end_" class="input_custom_ input_ranger_date_" placeholder="체크아웃 선택해주세요." readonly="">
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
        <div class="btns_submit">
            <button class="find search">검색</button>
        </div>
    </div>

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
    }


    .popup_wraper .list_tab_select {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 30px;
    }


    .popup_wraper .item_tab {
        padding: 10px 20px;
    font-size: 16px;
    background: #fff;
    border : 1px solid #dbdbdb;
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
</style>