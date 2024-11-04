<div class="price-right-c">
    <div class="view_nav" id="sticky" style="position: sticky; top: 30px;">
        <div class="scroll_box">

            <div class="cho_nav">
                <p class="date_label">
                    <i></i> <span>출발일 <span id="select_date">2024-10-30</span></span>
                </p>

                <p class="label item_label">예약인원을 확인해주세요.</p>

                <ul class="select_peo">
                    <li class="flex_b_c cus-count-input">
                        <div class="payment">
                            <p class="ped_label">성인 </p>
                            <p class="money adult">
                                <span id="adult_msg">담당자에게 문의해주세요</span>
                                <!-- <strong>0</strong> 원 -->
                            </p>
                        </div>
                        <div class="opt_count_box count_box flex__c">
                            <button type="button" class="minus_btn" id="minusAdult"></button>
                            <input type="text" class="input-qty" name="qty" id="adultQty" min="1" value="1"
                                   readonly="">
                            <button type="button" class="plus_btn" id="addAdult"></button>
                        </div>
                    </li>
                </ul>
            </div>

            <script>
                $(document).ready(function () {
                   $('.plus_btn').click(function () {
                       let input = $(this).parent().find('input');
                       input.val(parseInt(input.val()) + 1);
                   })

                    $('.minus_btn').click(function () {
                       let input = $(this).parent().find('input');
                       if (parseInt(input.val()) > 1) {
                           input.val(parseInt(input.val()) - 1);
                       }
                   })
                });
            </script>

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

                    <div class="opt_result_wrap option_item" id="option_item">
                    </div>
                </div>
                <!-- // opt_list -->
            </div>
        </div>

        <div class="total_paymemt payment">
            <!--p class="ped_label">총 예약금액</p-->
            <p class="money"><span
                        style="margin-right:50px;"><strong>합계</strong></span><strong><span
                            id="total_sum" class="total_sum">0</span> 원</strong></p>
        </div>
        <h3 class="title-r label">약관동의</h3>
        <div class="item-info-check item_check_term_">
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
            <a href="/product-spa/product-booking/8386">
                <button type="button" class="btn-point" onclick="order_it();">상품 예약하기</button>
            </a>
            <div class="flex">
                <button type="button" class="btn-default"
                        onclick="location='/inquiry/inquiry_write.php?product_idx=1219'">상담 문의하기
                </button>

            </div>
        </div>
    </div>
</div>
<script>
    $('.item_check_term_').click(function () {
        $(this).toggleClass('checked_');
        let input = $(this).find('input');
        if (input.val() == 'N') {
            input.val('Y');
        } else {
            input.val('N');
        }

        console.log(input.val())
    })

    function sel_moption(code_idx) {
        let url = `<?= route_to('api.product.sel_moption') ?>`;
        $.ajax({
            url: url,
            type: "POST",
            data: {
                "product_idx": '<?= $spa['product_idx'] ?>',
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
        let idx = code_idx.split("|");
        let option_cnt = 0;
        $("input[name='option_idx[]']").each(function (index) {
            if (idx[0] == $(this).val()) option_cnt++;
        });

        if (option_cnt == 0) {
            let message = "";
            $.ajax({

                url: url,
                type: "POST",
                data: {
                    "product_idx": '<?=$product_idx?>',
                    "code_idx": code_idx
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function (data, textStatus) {
                    message = data.message;
                    $(".option_item").append(message);
                    price_account();
                    //location.reload();
                },
                error: function (request, status, error) {
                    alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });
        } else {
            alert('선택된 옵션입니다.');
            return false;
        }

    }

    function order_it() {
        var frm = document.frm;
        if (frm.total_price.value == "0" || frm.total_price.value == "") {
            alert("인원을 추가해주세요.");
            return false;
        }

        if (frm.start_date_in.value == "") {
            alert("춟발일자를 선택해주세요.");
            return false;
        }

        if (frm.tours_idx.value == "") {
            alert("상품을 선택해 주세요");
            return false;
        }

        $("#go_view").attr("action", "/cart/order_form.php").submit();
    }

    function remove(idx) {
        $("#opt_result_box_" + idx).remove();
        price_account();
    }
</script>