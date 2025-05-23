<style>
    .sel_date.active_ {
        background-color: #FFCB08;
    }
</style>
<div class="calendar">
    <div class="header">
        <img onclick="fn_click_be();" style="cursor: pointer;"
             src="/uploads/icons/icon_prev_1.png" alt="icon_prev_1" id="prev_icon"
             class="btn-pre only_web">
        <img onclick="fn_click_be();" style="cursor: pointer;"
             src="/uploads/icons/icon_prev_1.png" alt="" id="prev_icon_mo"
             class="btn-pre only_mo">
        <p><span id="s_yy"></span>년 <span id="s_mm"></span>월</p>
        <img onclick="fn_click_ne();" style="cursor: pointer;"
             src="/uploads/icons/icon_next_1.png" alt="icon_next_1" id="next_icon"
             class="btn-next only_web">
        <img onclick="fn_click_ne();" style="cursor: pointer;"
             src="/uploads/icons/icon_next_1.png" alt="icon_next_1" id="next_icon_mo"
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

        <div class="body" id="option_cal">

        </div>
    </div>
    <div class="label-container mt-20">
        <div class="label-item">
            <span class="allow-text">예약가능</span>
            <span class="label-text">예약이 가능한 일자입니다.</span>
        </div>
        <div class="label-item">
            <span class="sold-out-text">예약마강</span>
            <span class="label-text">예약이 마감된 상태로 예약이 불가합니다.</span>
        </div>
    </div>
</div>

<script>
    viewCal();

    function fn_click_be() {
        var s_yy = parseInt($("#s_yy").text().trim());
        var s_mm = parseInt($("#s_mm").text().trim());

        var s_yy2 = s_yy;
        var s_mm2 = s_mm;

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

        viewCal();
    }

    // 다음달
    function fn_click_ne() {
        var s_yy = parseInt($("#s_yy").text().trim());
        var s_mm = parseInt($("#s_mm").text().trim());

        var s_yy2 = s_yy;
        var s_mm2 = s_mm;

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

        viewCal();
    }

    function viewCal_sel(dateY, dateM) {
        $("#s_yy").text(dateY);
        $("#s_mm").text(dateM);

        viewCal();
    }

    function viewCal() {
        let product_idx = `<?= $data_['product_idx'] ?>`;

        var today = new Date();
        var defaultYear = today.getFullYear();
        var defaultMonth = today.getMonth() + 1;

        var s_yy = parseInt($("#s_yy").text().trim());
        var s_mm = parseInt($("#s_mm").text().trim());
        s_yy = isNaN(s_yy) ? defaultYear : s_yy;
        s_mm = isNaN(s_mm) ? defaultMonth : s_mm;

        $("#s_yy").text(s_yy);
        $("#s_mm").text(s_mm);

        let currentDay = today.getDate();
        let currentMonth = today.getMonth() + 1;
        let currentYear = today.getFullYear();

        let firstDayOfMonth = new Date(s_yy, s_mm - 1, 1);
        let lastDayOfMonth = new Date(s_yy, s_mm, 0).getDate();
        let startDay = firstDayOfMonth.getDay();

        $.ajax({
            url: '<?= route_to('api.product.get_spas_price') ?>',
            type: "GET",
            data: {
                "product_idx": '<?= $data_['product_idx'] ?>',
                "month": s_mm,
                "year": s_yy
            },
            async: false,
            cache: false,
            success: function (data, textStatus) {                                

                let daysHTML = "<div class='week'>";

                for (let i = 0; i < startDay; i++) {
                    daysHTML += "<p class='day'><span>&nbsp;</span></p>";
                }

                let currDate = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(currentDay).padStart(2, '0')}`;

                for (let day = 1; day <= lastDayOfMonth; day++) {
                    let priceLabel;
                    let isToday = "";
                    let isDeadline = "";
                    let checkDate = `${s_yy}-${String(s_mm).padStart(2, '0')}-${String(day).padStart(2, '0')}`;                    

                    let date = new Date(s_yy, s_mm - 1, day);
                    
                    date = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                    const formatDate = date.toLocaleDateString('en-CA');                    

                    const dayData = data.find(d => d.goods_date === formatDate);   
                    
                    if (checkDate < currDate) {
                        priceLabel = '<span class="label sold-out-text">예약마감</span>';
                        isDeadline = " deadline";
                    } else {
                        isToday = (day === currentDay && s_mm === currentMonth && s_yy === currentYear) ? " active_" : "";

                        if (!dayData) {
                            priceLabel = '<span class="label sold-out-text">예약마감</span>';
                            isDeadline = " deadline";
                        } else {
                            priceLabel = `<span data-day="${day}" class="label allowBtn allow-text">예약가능</span>`;
                        }
                    }

                    let s_dd = day < 10 ? "0" + day : day;
                    let selDate = `${s_yy}-${String(s_mm).padStart(2, '0')}-${s_dd}`;

                    if ($("#sel_date").val() != "" && $("#sel_date").val() == selDate) {
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

                $("#option_cal").html(daysHTML);
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });

        
    }
</script>