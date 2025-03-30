<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php

$member_Id = $_SESSION['member']['idx'];

if (!$member_Id) {
    echo "
            <script>
                alert('로그인 필요합니다.');
                location.href = '/member/login';
            </script>
        ";
    die();
}

$user_name = sqlSecretConver($row["user_name"], "decode");
$user_phone = sqlSecretConver($row["user_phone"], "decode");
$user_email = sqlSecretConver($row["user_email"], "decode");

$user_name = !empty($user_name) ? $user_name : $row_m["user_name"];
$user_phone = !empty($user_phone) ? $user_phone : $row_m["user_mobile"];
$user_email = !empty($user_email) ? $user_email : $row_m["user_email"];

?>


<style>
    @media screen and (max-width: 850px) {
        .sect_ttl_box {
            margin: 2.1429rem 0;
            position: relative;
        }

        .sect_ttl_box h2 {
            font-size: 4.3rem;
            text-align: center;
            line-height: 1.4;
        }

        .bs_table tbody,
        .bs_table {
            display: block;
        }

        .write_container .bs_table tbody tr {
            padding: 1.7143rem 0;
            display: flex;
            flex-wrap: wrap;
        }

        .bs_table.row tbody th {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.7143rem;
            font-weight: 500;
        }

        .bs_table.row tbody td {
            text-align: left;
            width: 100%;
            padding: 1rem 0;
        }

        .write_container .bs_table tbody td .bs-select.mx-sm,
        .write_container .bs_table tbody td .bs-input.mx-sm,
        .write_container .bs_table tbody td .bs-select.mx-md,
        .write_container .bs_table tbody td .bs-input.mx-md {
            max-width: 100%;
        }

        .email_row {
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .email_row .bs-input {
        width: calc(50% - 2.7368rem);
    }

    .email_row span {
        width: 1.4736rem;
        margin: 0;
    }

    .email_row .bs-select {
        width: 100%;
        margin-top: 0.7894rem;
        margin-left: 0;
        height : 8.2rem;
        font-size: 2.8rem;

    }

    .bs-select, .bs-input {
        font-size: 2.8rem;
        height: 8.2rem;
    }
    .write_container .contents {
        height: 14rem;
        padding: 1.2rem 0.7143rem;
    }

    .flex_box_cap {
        display: flex;
        margin-top: 3.5rem;
        gap: 1rem;
        min-height: 9rem;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .flex_box_cap img {
        width: 49%;
        height: 9rem;
    }

    .re_btn {
        width : 49%;
        font-size: 3rem;
        padding: 0.5rem 2rem;
        height: 9rem;
        background-color: #EEEEEE;
        display: flex
    ;
        align-items: center;
        justify-content: center;
        gap: 1rem;

    }

    .input-wrapper {
        width  : 100%;
        
    }
    
    .captcha_input {
        width : 100%;
        height: 9rem;
    }
    }
</style>
<div id="container" class="sub write_container">
    <section class="write_sect">
        <div class="inner">
            <div class="sect_ttl_box">
                <h2>여행 문의하기</h2>
            </div>
            <form name="frm" id="frm">
                <input type="text" name="idx" value="<?= $idx ?>" hidden>
                <table class="bs_table row">
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>이름*</th>
                            <td>
                                <input class="bs-input mx-sm" name="user_name" id="user_name" value="<?= $user_name ?>" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th>연락처*</th>
                            <td>
                                <input class="bs-input mx-md" value="<?= $user_phone ?>" name="user_phone" maxlength="13" oninput="this.value = formatPhoneNumber(this.value.replace(/[^0-9]/g, ''))" id="user_phone" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th>이메일*</th>
                            <?php
                            $arr_email = explode('@', $user_email);
                            ?>
                            <td>
                                <div class="email_row">
                                    <input class="bs-input mx-sm" id="mail1" value="<?= $arr_email[0] ?>" name="mail1" type="text">
                                    <span>@</span>
                                    <input class="bs-input mx-sm" id="mail2" value="<?= $arr_email[1] ?>" name="mail2" type="text">
                                    <select name="mail_select" class="bs-select mx-sm" id="" onchange="$('#mail2').val(this.value)">
                                        <option value="">선택</option>
                                        <option value="naver.com" <?php if ($arr_email[1] == "naver.com") {
                                                                        echo "selected";
                                                                    } ?>>naver.com</option>
                                        <option value="hanmail.net" <?php if ($arr_email[1] == "hanmail.net") {
                                                                        echo "selected";
                                                                    } ?>>hanmail.net</option>
                                        <option value="hotmail.com" <?php if ($arr_email[1] == "hotmail.com") {
                                                                        echo "selected";
                                                                    } ?>>hotmail.com</option>
                                        <option value="nate.com" <?php if ($arr_email[1] == "nate.com") {
                                                                        echo "selected";
                                                                    } ?>>nate.com</option>
                                        <option value="yahoo.co.kr" <?php if ($arr_email[1] == "yahoo.co.kr") {
                                                                        echo "selected";
                                                                    } ?>>yahoo.co.kr</option>
                                        <option value="empas.com" <?php if ($arr_email[1] == "empas.com") {
                                                                        echo "selected";
                                                                    } ?>>empas.com</option>
                                        <option value="dreamwiz.com" <?php if ($arr_email[1] == "dreamwiz.com") {
                                                                            echo "selected";
                                                                        } ?>>dreamwiz.com</option>
                                        <option value="freechal.com" <?php if ($arr_email[1] == "freechal.com") {
                                                                            echo "selected";
                                                                        } ?>>freechal.com</option>
                                        <option value="lycos.co.kr" <?php if ($arr_email[1] == "lycos.co.kr") {
                                                                        echo "selected";
                                                                    } ?>>lycos.co.kr</option>
                                        <option value="korea.com" <?php if ($arr_email[1] == "korea.com") {
                                                                        echo "selected";
                                                                    } ?>>korea.com</option>
                                        <option value="gmail.com" <?php if ($arr_email[1] == "gmail.com") {
                                                                        echo "selected";
                                                                    } ?>>gmail.com</option>
                                        <option value="hanmir.com" <?php if ($arr_email[1] == "hanmir.com") {
                                                                        echo "selected";
                                                                    } ?>>hanmir.com</option>
                                        <option value="paran.com" <?php if ($arr_email[1] == "paran.com") {
                                                                        echo "selected";
                                                                    } ?>>paran.com</option>
                                        <option value="custom" <?php if ($arr_email[1] == "custom") {
                                                                    echo "selected";
                                                                } ?>>직접입력</option>
                                    </select>
                                    <!-- <input type="hidden" name="user_email" id="user_email"> -->
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>여행예정일</th>
                            <td>
                                <div class="datepick_wrap flex__c">
                                    <div class="datepick">
                                        <input name="departure_date" id="departure_date" value="<?= $row["departure_date"] ?? "" ?>" class="bs-input mx-sm" type="text">
                                    </div>
                                    <span>~</span>
                                    <div class="datepick">
                                        <input name="arrival_date" id="arrival_date" class="bs-input mx-sm" type="text" value="<?= $row["arrival_date"] ?? "" ?>">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>여행형태</th>
                            <td>
                                <div class="travel_box flex__c">
                                    <select name="travel_type_1" id="travel_type_1" class="bs-select mx-sm">
                                        <option value="">선택</option>
                                        <?php
                                        foreach ($list_code as $code) {
                                        ?>
                                            <option value="<?= $code['code_no'] ?>"
                                                <?php if ($row["travel_type_1"] == $code["code_no"]) {
                                                    echo "selected";
                                                } ?>>
                                                <?= $code['code_name'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if (!empty($idx)) {
                                    ?>
                                        <select name="travel_type_2" id="travel_type_2" class="bs-select mx-sm">
                                            <option value="">선택</option>
                                            <?php
                                            foreach ($code_child_1 as $code) {
                                            ?>
                                                <option value="<?= $code["code_no"] ?>"
                                                    <?php if ($code["code_no"] == $row["travel_type_2"]) {
                                                        echo "selected";
                                                    } ?>>
                                                    <?= $code["code_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <select name="travel_type_3" id="travel_type_3" class="bs-select mx-sm">
                                            <option value="">선택</option>
                                            <?php
                                            foreach ($code_child_2 as $code) {
                                            ?>
                                                <option value="<?= $code["code_no"] ?>"
                                                    <?php if ($code["code_no"] == $row["travel_type_3"]) {
                                                        echo "selected";
                                                    } ?>>
                                                    <?= $code["code_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <select name="travel_type_2" id="travel_type_2" class="bs-select mx-sm">
                                            <option value="">선택</option>
                                        </select>
                                        <select name="travel_type_3" id="travel_type_3" class="bs-select mx-sm">
                                            <option value="">선택</option>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>상담가능시간</th>
                            <td><input class="bs-input" name="consultation_time" id="consultation_time" type="text" value="<?= $row["consultation_time"] ?? "" ?>"></td>
                        </tr>
                        <tr>
                            <th>상품명</th>
                            <td>
                                <?php
                                if (!empty($idx)) {
                                ?>
                                    <select name="product_name" id="product_name" class="bs-select mx-sm">
                                        <option value="">선택</option>
                                        <?php
                                        foreach ($products as $product) {
                                        ?>
                                            <option value="<?= $product["product_name"] ?>"
                                                <?php if ($product["product_name"] == $row["product_name"]) {
                                                    echo "selected";
                                                } ?>>
                                                <?= $product["product_name"] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                <?php
                                } else {
                                ?>
                                    <select name="product_name" id="product_name" class="bs-select mx-sm">
                                        <option value="">선택</option>
                                    </select>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>제목*</th>
                            <td>
                                <input class="bs-input" name="title" id="title" type="text" value="<?= $row["title"] ?? "" ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td>
                                <textarea style="resize:none" name="contents" id="contents" class="bs-input contents"><?= $row["contents"] ?? "" ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>첨부파일</th>
                            <td class="file_box">
                                <div class="file_select">
                                    <input type="text" class="bs-input mx-md file">
                                    <div>
                                        <input type="file" name="ufile1" id="ufile1">
                                        <label for="ufile1">파일선택</label>
                                    </div>
                                </div>
                                <div class="file_name">
                                    <input type="text" value='<?= viewSQ($row["ufile1"]) ?>' class="bs-input" disabled>
                                    <i></i>
                                </div>
                                <span class="file_size">0kb</span>
                            </td>
                        </tr>
                        <script>
                            $("#ufile1").on("change", function(event) {
                                let file = event.target?.files[0];
                                $(".file_name input").val(file?.name);
                                let fileSizeInBytes = file?.size;

                                let fileSize, unit;
                                if (fileSizeInBytes < 1024) {
                                    fileSize = fileSizeInBytes;
                                    unit = 'B';
                                } else if (fileSizeInBytes < 1024 * 1024) {
                                    fileSize = fileSizeInBytes / 1024;
                                    unit = 'KB';
                                } else if (fileSizeInBytes < 1024 * 1024 * 1024) {
                                    fileSize = fileSizeInBytes / (1024 * 1024);
                                    unit = 'MB';
                                } else {
                                    fileSize = fileSizeInBytes / (1024 * 1024 * 1024);
                                    unit = 'GB';
                                }
                                $(".file_size").text(fileSize.toFixed(2) + ' ' + unit);
                            })
                        </script>
                        <tr>
                            <th>개인정보처리방침*</th>
                            <td class="wrap_check">
                                <div class="privacy" style="position: relative;">
                                    <div>
                                        <?= viewSQ($privacy['policy_contents']) ?>
                                    </div></div>
                                </div>
                                <div class="check_box">
                                    <input type="checkbox" name="privacy_agree" class="security" id="privacy_agree" checked>
                                    <label for="privacy_agree">개인정보처리방침에 동의합니다.</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>개인정보 제3자 제공*</th>
                            <td class="wrap_check">
                                <div class="privacy" style="position: relative;">
                                    <?= viewSQ($third_paties['policy_contents']) ?>
                                </div>
                                <div class="check_box">
                                    <input type="checkbox" name="third_parties_agree" class="info" id="third_parties_agree" checked>
                                    <label for="third_parties_agree">개인정보 제3자 제공에 동의합니다.</label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="flex_box_cap">

                    <img src="" alt="captcha" id="cap_re" loading="lazy">
                    <div class="spinner" id="spinner_load"></div>

                    <input type="hidden" value="" id="hidden_captcha" />
                    <button class="re_btn" type="button" onclick="reloadCaptcha()">
                        <img class="re_cap" src="../assets/img/reload.png" alt="">
                        <p>새로고침</p>
                    </button>

                    <div class="input-wrapper">
                        <input class="captcha_input" id="captcha_input" type="text" name="captcha">
                        <label for="captcha_input" class="placeholder-text">보안 문자 입력</label>
                    </div>

                </div>
                <div class="btn-wrap">
                    <a href="/inquiry/main.php" class="btn btn-lg btn_cancel">취소하기</a>
                    <button type="button" class="btn btn-lg btn-point btn_submit" id="btn_submit">문의하기</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    var input = document.getElementById('captcha_input');
    var placeholder = document.querySelector('.placeholder-text');

    input.addEventListener('input', function() {
        if (input.value) {
            placeholder.classList.add('hide-placeholder');
        } else {
            placeholder.classList.remove('hide-placeholder');
        }
    });

    if (input.value) {
        placeholder.classList.add('hide-placeholder');
    }

    document.getElementById('cap_re').style.opacity = "0"

    function reloadCaptcha() {
        $.ajax({
            url: '/tools/generate_captcha',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                document.getElementById('cap_re').src = data.captcha_image;
                document.getElementById('hidden_captcha').value = data.captcha_value;
                document.getElementById('spinner_load').style.display = "none"
                document.getElementById('cap_re').style.opacity = "1"
            }
        })
    }

    reloadCaptcha();
</script>

<script>
    $(function() {

        $(".datepick input").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            buttonImage: '/images/ico/datepicker_ico.png',
            showMonthAfterYear: true,
            buttonImageOnly: true,
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            minDate: new Date(),
        });


        var formSubmitted = false;
        $("#btn_submit").on("click", function() {

            if (formSubmitted) {
                return;
            }
            const formData = new FormData($('#frm')[0]);
            var captchaValue = $("#hidden_captcha").val();
            var userInputCaptcha = $("#captcha_input").val();

            if (!formData.get("user_name")) {
                $("#user_name").focus();
                alert("이름 입력해주세요!");
                return;
            }

            if (!formData.get("user_phone")) {
                $("#user_phone").focus();
                alert("연락처 입력해주세요!");
                return;
            }

            if (!formData.get("mail1")) {
                $("#mail1").focus();
                alert("이메일 입력해주세요!");
                return;
            }

            if (!formData.get("mail2")) {
                $("#mail2").focus();
                alert("이메일 입력해주세요!");
                return;
            }

            if (!formData.get("title")) {
                $("#title").focus();
                alert("제목 입력해주세요!");
                return;
            }

            if (formData.get("privacy_agree") != 'on') {
                $("#privacy_agree").focus();
                alert("개인정보처리방침 입력해주세요!");
                return;
            }

            if (formData.get("third_parties_agree") != 'on') {
                $("#third_parties_agree").focus();
                alert("개인정보 제3자 제공 입력해주세요!");
                return;
            }

            if (userInputCaptcha !== captchaValue) {
                alert("보안문자 일치지않습니다.");
                $("#captcha_input").focus();
                reloadCaptcha();
                return false;
            }

            $.ajax({
                url: "/contact/write_ok",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    formSubmitted = true;
                },
                success: function(response) {

                    try {
                        alert(response.message);
                        if (response.result) {
                            $(window).off('beforeunload', handleUnload);
                            if (response.status == "update") {
                                location.reload();
                            } else if (response.status == "insert") {
                                location.href = '/contact/main';
                            }
                        }
                    } catch (e) {
                        alert("오류가 발생 하였습니다.");
                    }
                }
            })
        });


        $("#travel_type_1").on("change", function(event) {
            $.ajax({
                url: "/ajax/get_sub_code",
                type: "GET",
                data: {
                    code: event.target.value,
                    depth: 3
                },
                success: function(res) {
                    if (res.cnt == 0) {
                        $("#travel_type_2").hide().html("");
                        $("#travel_type_3").hide().html("");
                        $("#product_name").hide().html("");
                    } else {
                        let data = res.results;
                        let html = `<option value=''>선택</option>`;
                        data.forEach(element => {
                            html += `<option value='${element["code_no"]}'>${element["code_name"]}</option>`;
                        });
                        $("#travel_type_2").show().html(html);
                        $("#travel_type_3").show();
                        $("#product_name").show();
                    }
                }
            })
        });


        $("#travel_type_2").on("change", function(event) {
            $.ajax({
                url: "/ajax/get_sub_code",
                type: "GET",
                data: {
                    code: event.target.value,
                    depth: 4
                },
                success: function(res) {
                    if (res.cnt == 0) {
                        $("#travel_type_3").hide().html("");
                    } else {
                        let data = res.results;
                        let html = `<option value=''>선택</option>`;
                        data.forEach(element => {
                            html += `<option value='${element["code_no"]}'>${element["code_name"]}</option>`;
                        });
                        $("#travel_type_3").show().html(html);
                    }
                }
            })
        });

        $("#travel_type_3").on("change", function(event) {
            $.ajax({
                url: "/ajax/get_list_product",
                type: "GET",
                data: {
                    field: "product_code_3",
                    product_code: event.target.value
                },
                success: function(res) {
                    let data = res.results;
                    let html = `<option value=''>선택</option>`;
                    data.forEach(element => {
                        html += `<option value='${element["product_name"]}'>${element["product_name"]}</option>`;
                    });
                    $("#product_name").html(html);
                }
            })
        });

    });

    function formatPhoneNumber(input) {
        const numericString = input.replace(/\D/g, '');
        if (numericString.length >= 8) {
            const a = numericString.substring(0, 3);
            const b = numericString.substring(3, 7);
            const c = numericString.substring(7);
            return `${a}-${b}-${c}`;
        } else if (numericString.length >= 4) {
            const a = numericString.substring(0, 3);
            const b = numericString.substring(3);
            return `${a}-${b}`;
        } else {
            return input;
        }
    }

    function handleUnload(event) {
        var confirmationMessage = '사이트를 새로고침하시겠습니까?';

        if (typeof event === 'undefined') {
            event = window.event;
        }

        if (event) {
            event.returnValue = confirmationMessage;
        }

        return confirmationMessage;
    }
    $(window).on('beforeunload', handleUnload);
</script>

<?php $this->endSection(); ?>