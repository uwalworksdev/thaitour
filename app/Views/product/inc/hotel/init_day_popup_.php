<style>
    .hotel_day_popup_ {
        display: none;
        position: absolute;
        top: 210px;
        left: 160px;
        right: auto;
        z-index: 10;
    }

    .hotel_day_popup_.show {
        display: block;
    }

    .hotel_day_popup_content_ {
        width: 800px;
        padding: 10px 20px;
        border: 1px solid #dbdbdb;
        border-radius: 10px;
        background-color: #FFFFFF;
    }

    .list_day_popup_list_ {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .hotel_day_popup_ .day_area_ {
        width: 50%;
    }

    .deadline_date {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translate(-50%, 50%);
        background-color: #fff;
        padding-inline: 5px;
    }

    .hotel_day_popup_ .header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
    }

    .hotel_day_popup_ .header p {
        font-weight: 600;
        font-size: 20px;
        color: #252525;
        padding: 0 16px;
    }

    .hotel_day_popup_ .header img {
        width: 10px;
        height: 15px;
        min-height: unset !important;
    }

    .hotel_day_popup_ .canl_tabel {
        border: 1px solid #aaa;
    }

    .hotel_day_popup_ .canl_tabel .heading {
        display: flex;
        justify-content: space-between;
        padding: 14px 0;
    }

    .hotel_day_popup_ .canl_tabel .heading p {
        flex: 1;
        text-align: center;
    }

    .hotel_day_popup_ .canl_tabel .body {
        display: flex;
        flex-wrap: wrap;
    }

    .hotel_day_popup_ .canl_tabel .body .day {
        position: relative;
        width: 50px;
        height: 50px;
        border-top: 1px solid #aaa;
        border-right: 1px solid #aaa;
        cursor: pointer;
        display: inline-block;
    }

    .hotel_day_popup_ .canl_tabel .body .day:nth-child(7n) {
        border-right: none;
    }

    .hotel_day_popup_ .canl_tabel .body .day.on {
        background-color: rgba(131, 164, 240, 0.1);
    }

    .hotel_day_popup_ .canl_tabel .body .day.active {
        background-color: #cd151b !important;
    }

    .hotel_day_popup_ .canl_tabel .body .day.active span,
    .hotel_day_popup_ .canl_tabel .body .day.active p {
        color: #fff !important;
    }

    .hotel_day_popup_ .canl_tabel .body .day .weekend {
        color: #e5001c;
    }

    .hotel_day_popup_ .canl_tabel .body .day span.label span.label {
        position: absolute;
        top: 28px;
        right: 8px;
        font-size: 10px !important;
        font-weight: 400;
        color: white !important;
    }

    .hotel_day_popup_ .date_number {
        color: black !important;
        position: absolute;
        top: 10px;
        right: 15px;
    }

    .hotel_day_popup_ .day.deadline {
        cursor: unset !important;
        background-color: rgb(237, 237, 237);
    }

    .hotel_day_popup_ .day.deadline:hover {
        cursor: unset !important;
        background-color: unset !important;
    }

    .hotel_day_popup_ .day.current-day {
        background-color: rgb(242, 246, 253);
    }

    .hotel_day_popup_ .week .day:hover {
        background-color: #FFCB08;
    }

    .hotel_day_popup_ span {
        font-size: unset;
        font-weight: unset;
    }

    .hotel_day_popup_ .canl_tabel .body .day p {
        position: absolute;
        top: 42px;
        right: 20px;
        font-size: 14px;
        font-weight: 400;
        color: #656565;
    }

    .hotel_day_popup_ .note {
        margin-top: 21px;
        color: #e5001c;
        font-size: 16px;
        font-weight: 500;
    }

    .hotel_day_popup_ .note span {
        color: #757575;
    }

    .hotel_day_popup_ .week {
        display: flex;
    }

    .hotel_day_popup_ .canl_tabel .body .day span.price {
        color: black;
        margin-top: 20px;

    }

    .sel_date.active_ {
        background-color: #FFCB08;
    }

    .hotel_day_popup_ .allow-text {
        background-color: var(--bs-point);
        color: white;
        padding: 4px 6px;
        font-size: 12px;
        border-radius: 5px;
    }

    .hotel_day_popup_ .sold-out-text {
        background-color: #8C8C8C;
        color: white;
        padding: 4px 6px;
        font-size: 12px;
        border-radius: 5px;
    }

    .hotel_day_popup_ .accept-text {
        background-color: #6ABB2E;
        color: white;
        padding: 4px 6px;
        font-size: 12px;
        border-radius: 5px;
    }

    .hotel_day_popup_ .wait-text {
        background-color: #B74FFE;
        color: white;
        padding: 4px 6px;
        font-size: 12px;
        border-radius: 5px;
    }
</style>

<div class="hotel_day_popup_">
    <div class="hotel_day_popup_content_">
        <div class="list_day_popup_list_">
            <div class="day_area_ ">
                <div class="header">
                    <img onclick="fn_click_start_be();" style="cursor: pointer;"
                         src="/uploads/icons/icon_prev_1.png" alt="icon_prev_1" id="prev_icon"
                         class="btn-pre only_web">
                    <img onclick="fn_click_start_be();" style="cursor: pointer;"
                         src="/uploads/icons/icon_prev_1.png" alt="" id="prev_icon_mo"
                         class="btn-pre only_mo">
                    <p><span id="s_yy"></span>년 <span id="s_mm"></span>월</p>
                    <img onclick="fn_click_end_be();" style="cursor: pointer;"
                         src="/uploads/icons/icon_next_1.png" alt="" id="next_icon"
                         class="btn-next only_web">
                    <img onclick="fn_click_end_be();" style="cursor: pointer;"
                         src="/uploads/icons/icon_next_1.png" alt="" id="next_icon_mo"
                         class="btn-next only_mo">
                </div>
                <div class="canl_tabel">
                    <div class="heading">
                        <p><span style="color : #e5001c">일</span></p>
                        <p><span>월</span></p>
                        <p><span>화</span></p>
                        <p><span>수</span></p>
                        <p><span>목</span></p>
                        <p><span>금</span></p>
                        <p><span style="color : #e5001c">토</span></p>
                    </div>
                    <div class="body start_day_area_" id="start_day_area_">

                    </div>
                </div>
            </div>
            <div class="day_area_">
                <div class="header">
                    <img onclick="fn_click_start_fe();" style="cursor: pointer;"
                         src="/uploads/icons/icon_prev_1.png" alt="icon_prev_1" id="prev_icon"
                         class="btn-pre only_web">
                    <img onclick="fn_click_start_fe();" style="cursor: pointer;"
                         src="/uploads/icons/icon_prev_1.png" alt="" id="prev_icon_mo"
                         class="btn-pre only_mo">
                    <p><span id="e_yy"></span>년 <span id="e_mm"></span>월</p>
                    <img onclick="fn_click_end_fe();" style="cursor: pointer;"
                         src="/uploads/icons/icon_next_1.png" alt="" id="next_icon"
                         class="btn-next only_web">
                    <img onclick="fn_click_end_fe();" style="cursor: pointer;"
                         src="/uploads/icons/icon_next_1.png" alt="" id="next_icon_mo"
                         class="btn-next only_mo">
                </div>
                <div class="canl_tabel">
                    <div class="heading">
                        <p><span style="color : #e5001c">일</span></p>
                        <p><span>월</span></p>
                        <p><span>화</span></p>
                        <p><span>수</span></p>
                        <p><span>목</span></p>
                        <p><span>금</span></p>
                        <p><span style="color : #e5001c">토</span></p>
                    </div>
                    <div class="body end_day_area_" id="end_day_area_">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#input_day_start_, #input_day_end_').on('click', function () {
            $('.hotel_day_popup_').addClass('show');
        });
    })

    renderTimeStart();
    renderDateEnd();

    function fn_click_start_be() {
        let s_yy = parseInt($("#s_yy").text().trim());
        let s_mm = parseInt($("#s_mm").text().trim());

        let s_yy2 = s_yy;
        let s_mm2 = s_mm;

        if (s_mm === 1) {
            s_mm = 12;
            s_yy = s_yy - 1;
        } else {
            s_mm = s_mm - 1;
        }

        s_mm = s_mm < 10 ? "0" + s_mm : s_mm;

        $("#s_yy").text(s_yy);
        $("#s_mm").text(s_mm);

        if (parseInt($("#s_yy").text().trim()) !== s_yy) {
            $("#s_yy").text(s_yy2);
            $("#s_mm").text(s_mm2);
            return false;
        }

        $("#select_date").text('');
        $("#sel_date").val('');
        renderTimeStart();
    }

    function fn_click_end_be() {
        let s_yy = parseInt($("#s_yy").text().trim());
        let s_mm = parseInt($("#s_mm").text().trim());

        let s_yy2 = s_yy;
        let s_mm2 = s_mm;

        if (s_mm === 12) {
            s_mm = 1;
            s_yy = s_yy + 1;
        } else {
            s_mm = s_mm + 1;
        }

        s_mm = s_mm < 10 ? "0" + s_mm : s_mm;

        $("#s_yy").text(s_yy);
        $("#s_mm").text(s_mm);

        if (parseInt($("#s_yy").text().trim()) !== s_yy) {
            $("#s_yy").text(s_yy2);
            $("#s_mm").text(s_mm2);
            return false;
        }

        $("#select_date").text('');
        $("#sel_date").val('');
        renderTimeStart();
    }

    function fn_click_end_fe() {
        let e_yy = parseInt($("#e_yy").text().trim());
        let e_mm = parseInt($("#e_mm").text().trim());

        let e_yy2 = e_yy;
        let e_mm2 = e_mm;

        if (e_mm === 12) {
            e_mm = 1;
            e_yy = e_yy + 1;
        } else {
            e_mm = e_mm + 1;
        }

        e_mm = e_mm < 10 ? "0" + e_mm : e_mm;

        $("#e_yy").text(e_yy);
        $("#e_mm").text(e_mm);

        if (parseInt($("#e_yy").text().trim()) !== e_yy) {
            $("#e_yy").text(e_yy2);
            $("#e_mm").text(e_mm2);
            return false;
        }

        $("#select_e_date").text('');
        $("#sel_e_date").val('');
        renderDateEnd();
    }

    function fn_click_start_fe() {
        let e_yy = parseInt($("#e_yy").text().trim());
        let e_mm = parseInt($("#e_mm").text().trim());

        let e_yy2 = e_yy;
        let e_mm2 = e_mm;

        if (e_mm === 1) {
            e_mm = 12;
            e_yy = e_yy - 1;
        } else {
            e_mm = e_mm - 1;
        }

        e_mm = e_mm < 10 ? "0" + e_mm : e_mm;

        $("#e_yy").text(e_yy);
        $("#e_mm").text(e_mm);

        if (parseInt($("#e_yy").text().trim()) !== e_yy) {
            $("#e_yy").text(e_yy2);
            $("#e_mm").text(e_mm2);
            return false;
        }

        $("#select_e_date").text('');
        $("#sel_e_date").val('');
        renderDateEnd();
    }

    function renderTimeStart() {
        let reject_day_ = '2024-11-27||2024-11-28||||2025-02-01||2025-02-16';
        let allow_day_ = '2024-11-01||2033-01-31';

        let daysHTML = renderTimeData(reject_day_, allow_day_, 'start');
        $("#start_day_area_").html(daysHTML);
    }

    function renderDateEnd() {
        let reject_day_ = '2024-12-25||2024-12-29||||2025-01-01||2025-01-11';
        let allow_day_ = '2024-11-01||2033-01-31';

        let daysHTML = renderTimeData(reject_day_, allow_day_, 'end');
        $("#end_day_area_").html(daysHTML);
    }

    function renderTimeData(reject_day_, allow_day_, type_) {
        let array_day = reject_day_.split('||||');

        array_day = array_day.filter(function (el) {
            return el != null && el != '';
        });

        let today = new Date();
        let defaultYear = today.getFullYear();
        let defaultMonth = today.getMonth() + 1;

        let m__yy = $("#s_yy");
        let m__mm = $("#s_mm");

        let sel_ = $("#sel_date");

        if (type_ === 'end') {
            m__yy = $("#e_yy");
            m__mm = $("#e_mm");
            sel_ = $("#sel_e_date");
        }

        let s_yy = parseInt(m__yy.text().trim());
        let s_mm = parseInt(m__mm.text().trim());
        s_yy = isNaN(s_yy) ? defaultYear : s_yy;
        s_mm = isNaN(s_mm) ? defaultMonth : s_mm;

        m__yy.text(s_yy);
        m__mm.text(s_mm);

        let currentDay = today.getDate();
        let currentMonth = today.getMonth() + 1;
        let currentYear = today.getFullYear();

        let firstDayOfMonth = new Date(s_yy, s_mm - 1, 1);
        let lastDayOfMonth = new Date(s_yy, s_mm, 0).getDate();
        let startDay = firstDayOfMonth.getDay();

        let daysHTML = "<div class='week'>";

        for (let i = 0; i < startDay; i++) {
            daysHTML += "<p class='day'><span>&nbsp;</span></p>";
        }

        let currDate = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(currentDay).padStart(2, '0')}`;

        for (let day = 1; day <= lastDayOfMonth; day++) {
            let priceLabel = "";
            let isToday = "";
            let isDeadline = "";
            let checkDate = `${s_yy}-${String(s_mm).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            if (checkDate < currDate) {
                <?php if (isset($is_check) && $is_check) { ?>
                priceLabel = '<span class="label sold-out-text">마감</span>';
                <?php } ?>
                isDeadline = " deadline";
            } else {
                let is_valid = array_day.some(item => {
                    let [start_, end_] = item.split('||');
                    let start_date = new Date(start_);
                    let end_date = new Date(end_);
                    let checkDate_ = new Date(checkDate);

                    return start_date <= checkDate_ && checkDate_ <= end_date;
                });

                let [start_, end_] = allow_day_.split('||');
                let is_check = new Date(start_) <= new Date(checkDate) && new Date(checkDate) <= new Date(end_);

                <?php if (isset($is_check) && $is_check) { ?>
                if (!is_valid) {
                    if (is_check) {
                        isToday = (day === currentDay && s_mm === currentMonth && s_yy === currentYear) ? " current-day" : "";
                        priceLabel = `<span data-day="${day}" class="label allowBtn allow-text">예약</span>`;
                    } else {
                        priceLabel = '<span class="label sold-out-text">마감</span>';
                        isDeadline = " deadline";
                    }
                } else {
                    priceLabel = '<span class="label sold-out-text">마감</span>';
                    isDeadline = " deadline";
                }
                <?php } ?>
            }

            let s_dd = day < 10 ? "0" + day : day;
            let selDate = `${s_yy}-${String(s_mm).padStart(2, '0')}-${s_dd}`;

            if (sel_.val() != "" && sel_.val() == selDate) {
                daysHTML += `<p class='day${isToday}${isDeadline}' style='background-color: #FFCB08;cursor: none;'><span class='date_number sel_date' data-date='${selDate}'>${day}</span><br><span class='label sel_date' data-date='${selDate}'>${priceLabel}</span></p>`;
            } else if (isDeadline) {
                daysHTML += `<p class='day deadline sel_date' data-date='${selDate}' style='cursor: none;'><span class='date_number sel_date' data-date='${selDate}'>${day}</span><br><span class='label sel_date' data-date='${selDate}'>${priceLabel}</span></p>`;
            } else {
                daysHTML += `<p class='day${isToday} allowDate sel_date' data-day="${day}" data-date='${selDate}'><span class='date_number sel_date' data-date='${selDate}'>${day}</span><br><span class='label sel_date' data-date='${selDate}'>${priceLabel}</span></p>`;
            }

            if ((startDay + day) % 7 === 0) {
                daysHTML += "</div><div class='week'>";
            }
        }

        let remainingDays = 7 - ((startDay + lastDayOfMonth) % 7);
        if (remainingDays < 7) {
            for (var j = 0; j < remainingDays; j++) {
                daysHTML += "<p class='day sel_date'><span>&nbsp;</span></p>";
            }
        }

        daysHTML += "</div>";

        return daysHTML;
    }

    $(document).on('click', '.allowDate', function () {
        $('.sel_date').removeClass('active_');
        $(this).addClass('active_');
        let day_ = $(this).data('date');
    });
</script>