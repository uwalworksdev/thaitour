<div class="price-right-c">
    <form name="frm" id="frm" method="post" action="<?= route_to('api.product.processBooking') ?>">
        <div class="view_nav" id="sticky" style="position: sticky; top: 30px;">
            <div class="scroll_box">
                <input type="hidden" id="day_" name="day_">
                <input type="hidden" id="product_idx" name="product_idx" value="<?= $data_['product_idx'] ?>">
                <div class="cho_nav">
                    <p class="date_label">
                        <i></i> <span>출발일 <span id="select_date">2024-10-30</span></span>
                    </p>

                    <p class="label item_label">예약인원을 확인해주세요.</p>

                    <ul class="select_peo">
                        <li class="flex_b_c cus-count-input">
                            <div class="payment">
                                <p class="ped_label">성인 </p>
                            </div>
                            <div class="opt_count_box count_box flex__c">
                                <button type="button" onclick="minusInput(this, 'd');" class="minus_btn"
                                        id="minusAdult"></button>
                                <input type="text" class="input-qty" name="qty" id="adultQty" value="1"
                                       readonly="">
                                <button type="button" onclick="plusInput(this);" class="plus_btn"
                                        id="addAdult"></button>
                            </div>
                        </li>
                        <li class="flex_b_c cus-count-input">
                            <div class="payment">
                                <p class="ped_label">아름 </p>
                            </div>
                            <div class="opt_count_box count_box flex__c">
                                <button type="button" onclick="minusInput(this, 'd');" class="minus_btn"
                                        id="minusAdult2"></button>
                                <input type="text" class="input-qty" name="qty" id="adultQty2" value="1"
                                       readonly="">
                                <button type="button" onclick="plusInput(this);" class="plus_btn"
                                        id="addAdult2"></button>
                            </div>
                        </li>
                    </ul>

                    <div class="item_option">
                        <!-- opt_list -->
                        <div class="opt_list">
                            <strong class="label">옵션선택</strong>

                            <div class="opt_select_wrap">
                                <div class="opt_select disabled">
                                    <select name="moption" id="moption" onchange="sel_moption(this.value);">
                                        <option value="">선택</option>
                                        <?php foreach ($moption as $op) { ?>
                                            <option value="<?= $op['code_idx'] ?>"><?= $op['moption_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="opt_select disabled sel_option" id="sel_option">
                                    <select name="option" id="option" onchange="sel_option(this.value);">";
                                        <option value="">옵션 선택</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- // opt_list -->
                    </div>

                    <div class="option_list_" id="option_list_" style="margin-top: 20px">
                        <ul class="select_peo option_list_" id="option_list_">

                        </ul>
                    </div>
                </div>

                <div class="total_paymemt payment">
                    <!--p class="ped_label">총 예약금액</p-->
                    <p class="money"><span
                                style="margin-right:50px;"><strong>합계</strong></span><strong><span
                                    id="total_sum" class="total_sum">0</span> 원</strong></p>
                </div>
                <h3 class="title-r label">약관동의</h3>
                <div class="item-info-check item_check_term_all_">
                    <label for="fullagreement">전체동의</label>
                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                    <input type="hidden" value="N" id="fullagreement">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="">이용약관 동의(필수)</label>
                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                    <input type="hidden" value="N" id="terms">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="">개인정보 처리방침(필수)</label>
                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                    <input type="hidden" value="N" id="policy">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="">개인정보 제3자 제공 및 국외 이전 동의(필수)</label>
                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                    <input type="hidden" value="N" id="information">
                </div>
                <div class="item-info-check item_check_term_">
                    <label for="guidelines">여행안전수칙 동의(필수)</label>
                    <!--            <img src="/uploads/icons/form_check_icon.png" alt="form_check_icon">-->
                    <input type="hidden" value="N" id="guidelines">
                </div>
                <div class="nav_btn_wrap">
                    <div data-href="/product-spa/product-booking/8386">
                        <button type="button" class="btn-point" onclick="order_it();">상품 예약하기</button>
                    </div>
                    <div class="flex">
                        <button type="button" class="btn-default"
                                onclick="location='/inquiry/inquiry_write.php?product_idx=1219'">상담 문의하기
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $('.item_check_term_').click(function () {
        $(this).toggleClass('checked_');
        let input = $(this).find('input');
        input.val($(this).hasClass('checked_') ? 'Y' : 'N');

        checkOrUncheckAll();
    });

    function checkOrUncheckAll() {
        let allChecked = true;

        $('.item_check_term_').each(function () {
            let input = $(this).find('input');
            if (input.val() !== 'Y') {
                allChecked = false;
                return false;
            }
        });

        let allCheckbox = $('.item_check_term_all_');
        let allInput = allCheckbox.find('input');
        allCheckbox.toggleClass('checked_', allChecked);
        allInput.val(allChecked ? 'Y' : 'N');
    }

    $('.item_check_term_all_').click(function () {
        $(this).toggleClass('checked_');
        let allChecked = $(this).hasClass('checked_');
        let value = allChecked ? 'Y' : 'N';
        $(this).find('input').val(value);

        $('.item_check_term_').each(function () {
            $(this).toggleClass('checked_', allChecked);
            $(this).find('input').val(value);
        });
    });

    function sel_moption(code_idx) {
        let url = `<?= route_to('api.product.sel_moption') ?>`;

        $.ajax({
            url: url,
            type: "POST",
            data: {
                "product_idx": '<?= $data_['product_idx'] ?>',
                "code_idx": code_idx
            },
            async: false,
            cache: false,
            success: function (data, textStatus) {
                console.log(data)
                $("#sel_option").html(data);
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function sel_option(code_idx) {
        let url = `<?= route_to('api.product.sel_option') ?>`;
        let idx = code_idx.split("|")[0];

        let moption = $("#moption").val();

        $.ajax({
            url: url,
            type: "POST",
            data: {
                "idx": idx,
                "moption": moption
            },
            async: false,
            cache: false,
            success: function (data, textStatus) {
                console.log(data)
                let parent_name = data.parent_name;

                let option_name = data.option_name;
                let option_price = data.option_price;
                let idx = data.idx;
                let option_tot = data.option_tot ?? 0;
                let option_cnt = data.option_cnt;

                let htm_ = `<li class="flex_b_c cus-count-input" style="margin-top: 10px">
                            <div class="payment">
                                <p class="ped_label">${parent_name}</p>
                                <p class="money adult">
                                    <span id="adult_msg">${option_name}</span>
                                </p>
                            </div>
                            <div class="opt_count_box count_box flex__c">
                                <button type="button" onclick="minusInput(this);" class="minus_btn"
                                        id="minusAdult"></button>
                                <input data-price="${option_price}" type="text" class="input-qty" name="option_qty[]" min="1" value="1"
                                       readonly="">
                                <button type="button" onclick="plusInput(this);" class="plus_btn"
                                        id="addAdult"></button>
                            </div>

                            <div class="" style="display: none">
                                       <input type="hidden" name="option_name[]" value="${option_name}">
                                       <input type="hidden" name="option_idx[]" value="${idx}">
                                       <input type="hidden" name="option_tot[]" value="${option_tot}">
                                       <input type="hidden" name="option_cnt[]" value="${option_cnt}">
                            </div>
                        </li>`;

                $("#option_list_").append(htm_);
                calcTotal();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }

    function order_it() {
        let fullagreement = $("#fullagreement").val();
        let terms = $("#terms").val();
        let policy = $("#policy").val();
        let information = $("#information").val();
        let guidelines = $("#guidelines").val();

        if (fullagreement == "N" || terms == "N" || policy == "N" || information == "N" || guidelines == "N") {
            alert("이전 작업을 피해야 할 수 있습니다.");
            return false;
        }

        let day_ = $('#day_').val();
        if (day_ == "") {
            alert("등록 날짜를 선택하세요.");
            return false;
        }

        let url = '<?= route_to('api.product.processBooking') ?>';

        $("#frm").attr("action", url).submit();
    }

    function remove(idx) {
        $("#opt_result_box_" + idx).remove();
        price_account();
    }
</script>
<script>
    function plusInput(el) {
        let input = $(el).parent().find('input');
        input.val(parseInt(input.val()) + 1);
        calcTotal();
    }

    function minusInput(el, d) {
        let input = $(el).parent().find('input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1);
            calcTotal();
        } else {
            if (d !== 'd') {
                removeData(el);
            }
        }
    }

    function removeData(el) {
        if (confirm('확실히 선택을 취소하고 싶습니다?')) {
            $(el).parent().parent().remove();
            calcTotal();
        }
    }

    function calcTotal() {
        let option_list_ = $("#option_list_").find('li.cus-count-input');

        let total_price = 0;
        for (let i = 0; i < option_list_.length; i++) {
            let inp = $(option_list_[i]).find('input.input-qty');
            let price = inp.attr('data-price');
            let cnt = inp.val();
            total_price += parseInt(price) * parseInt(cnt);
        }

        let adultQty = $('#adultQty').val();
        let price = `<?= $data_['product_price'] ?>`;

        total_price += parseInt(adultQty) * parseInt(price);

        total_price = total_price.toLocaleString();
        $('#total_sum').text(total_price);
    }
</script>