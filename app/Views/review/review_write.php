<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
    <link href="/css/review/evaluate.css" rel="stylesheet" type="text/css"/>
    <link href="/css/review/evaluate_responsive.css" rel="stylesheet" type="text/css"/>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .note-editor.note-frame,
        .note-editor.note-airframe {
            width: 987px;
        }

        .rating {
            display: flex;
            justify-content: start;
            align-items: center;
            grid-gap: .5rem;
            font-size: 25px;
            color: #FFBD13;
        }

        .rating .star {
            cursor: pointer;
        }

        .rating .star.active {
            opacity: 0;
            animation: animate .5s calc(var(--i) * .1s) ease-in-out forwards;
        }

        @keyframes animate {
            0% {
                opacity: 0;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        .rating .star:hover {
            transform: scale(1.1);
        }

        .input_checkbox {
            display: unset !important;
            padding: unset !important;
            height: unset !important;
            -webkit-appearance: checkbox !important;
            -moz-appearance: checkbox !important;
            -ms-appearance: checkbox !important;
            -o-appearance: checkbox !important;
            appearance: checkbox !important;
        }


        @media screen and (max-width: 850px) {

        }

    </style>
    <section class="evaluate_write_section">
        <div class="inner">
            <div class="title">
                <h1>여행후기</h1>
            </div>
            <form action="#" name="frm" id="frm" method="post" enctype="multipart/form-data">
                <input type="hidden" name="r_name" value="<?= $row_m["user_name"] ?>">
                <input type="text" name="product_idx" id="" hidden value="<?= $product_idx ?>">
                <?php if ($idx || $product_idx) { ?>
                    <input type="text" name="idx" id="idx" hidden value="<?= $idx ?>">
                    <input type="hidden" name="travel_type" id="travel_type" value="<?= $travel_type ?>">
                    <input type="hidden" name="travel_type_2" id="travel_type_2" value="<?= $travel_type_2 ?>">
                    <input type="hidden" name="travel_type_3" id="travel_type_3" value="<?= $travel_type_3 ?>">
                <?php } ?>
                <table class="evaluate_table">
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td class="subject">여행형태</td>
                        <td class="input_box travel_box">
                            <div class="travel_box_child" style="display: flex;gap: 10px;">
                                <?php if ($idx || $product_idx) { ?>
                                    <input style="width: 25%" type="text" name="" value="<?= $travel_type_name ?>"
                                           disabled>

                                    <?php if ($travel_type_name_2): ?>
                                        <input style="width: 25%" type="text" name="travel_type_2"
                                               value="<?= $travel_type_name_2 ?>" disabled>
                                    <?php endif; ?>
                                    <?php if ($travel_type_name_3) { ?>
                                        <input type="text" name="travel_type_3" value="<?= $travel_type_name_3 ?>"
                                               style="width: 25%" disabled>
                                    <?php } ?>
                                    <input type="text" name="" id="products" class="in_pro" value="<?= $product_name ?>"
                                           style="width: 50%" disabled>
                                <?php } else {
                                    ?>
                                    <select name="travel_type" id="travel_type_1">
                                        <option value="">선택</option>
                                        <?php

                                        foreach ($list_code as $row0) {
                                            ?>
                                            <option value="<?= $row0['code_no'] ?>"><?= $row0['code_name'] ?></option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                    <select style="display: none;" name="travel_type_2" id="travel_type_2">
                                        <option value="">선택</option>
                                    </select>
                                    <!--                                    <select style="display: none;" name="travel_type_3" id="travel_type_3">-->
                                    <!--                                        <option value="">선택</option>-->
                                    <!--                                    </select>-->
                                    <select style="display: none;"
                                            name="travel_type_3s" id="travel_type_3">
                                        <!-- <option value="">차량상품</option> -->
                                        <option value="C">차량상품</option>
                                        <option value="D">차량 기사</option>
                                    </select>
                                    <select style="display: none; width: 50%; padding-right: 40px" name="product_idx" id="products">
                                        <option value="">선택</option>
                                    </select>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">평점</td>
                        <td class="input_box">
                            <div class="rating">
                                <input id="ratingValue" type="number" name="number_stars" value="<?= (int)$number_stars ?>" hidden>
                                <input id="review_type" type="text" name="review_type" value="<?= $review_type ?>"
                                       hidden>
                                <?php for ($i = 0; $i < (int)$number_stars; $i++) { ?>
                                    <i class='bx bx-star bxs-star star active' style="--i: <?= $i + 1; ?>;"></i>
                                <?php } ?>

                                <?php for ($i = (int)$number_stars + 1; $i <= 5; $i++) { ?>
                                    <i class='bx bx-star star' style="--i: <?= $i; ?>;"></i>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>

                    <tr class="guide_n">
                        <td class="subject">평가 구분</td>
                        <td class="input_box list_checkbox">
                            <div id="list_code_type">

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">작성자</td>
                        <td class="input_box">
                            <input class="name" name="user_name" type="text" value="<?= $user_name ?>">
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">이메일</td>
                        <td class="input_box mail_box">
                            <input class="mail" id="mail_name" value="<?= $email[0] ?>" name="mail_name" type="text">
                            <span>@</span>
                            <input class="mail" id="mail_host" name="mail_host" value="<?php if ($email[1]) {
                                echo $email[1];
                            } else {
                                echo " naver.com";
                            } ?>" type="text">
                            <select id="mail_select" onchange="populate(this.id, 'mail_host');">
                                <option value="naver.com" <?php if ($email[1] == "naver.com") {
                                    echo "selected";
                                } ?>>naver.com
                                </option>
                                <option value="hanmail.net" <?php if ($email[1] == "hanmail.net") {
                                    echo "selected";
                                } ?>>
                                    hanmail.net
                                </option>
                                <option value="hotmail.com" <?php if ($email[1] == "hotmail.com") {
                                    echo "selected";
                                } ?>>
                                    hotmail.com
                                </option>
                                <option value="nate.com" <?php if ($email[1] == "nate.com") {
                                    echo "selected";
                                } ?>>nate.com
                                </option>
                                <option value="yahoo.co.kr" <?php if ($email[1] == "yahoo.co.kr") {
                                    echo "selected";
                                } ?>>
                                    yahoo.co.kr
                                </option>
                                <option value="empas.com" <?php if ($email[1] == "empas.com") {
                                    echo "selected";
                                } ?>>empas.com
                                </option>
                                <option value="dreamwiz.com" <?php if ($email[1] == "dreamwiz.com") {
                                    echo "selected";
                                } ?>>
                                    dreamwiz.com
                                </option>
                                <option value="freechal.com" <?php if ($email[1] == "freechal.com") {
                                    echo "selected";
                                } ?>>
                                    freechal.com
                                </option>
                                <option value="lycos.co.kr" <?php if ($email[1] == "lycos.co.kr") {
                                    echo "selected";
                                } ?>>
                                    lycos.co.kr
                                </option>
                                <option value="korea.com" <?php if ($email[1] == "korea.com") {
                                    echo "selected";
                                } ?>>korea.com
                                </option>
                                <option value="gmail.com" <?php if ($email[1] == "gmail.com") {
                                    echo "selected";
                                } ?>>gmail.com
                                </option>
                                <option value="hanmir.com" <?php if ($email[1] == "hanmir.com") {
                                    echo "selected";
                                } ?>>
                                    hanmir.com
                                </option>
                                <option value="paran.com" <?php if ($email[1] == "paran.com") {
                                    echo "selected";
                                } ?>>paran.com
                                </option>
                                <option value="custom" <?php if ($email[1] == "custom") {
                                    echo "selected";
                                } ?>>직접입력
                                </option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td class="subject">제목</td>
                        <td class="input_box"><input class="ttl_name" name="title" id="title" type="text"
                                                     value="<?= $title ?>"></td>
                    </tr>

                    <tr>
                        <td class="subject">내용</td>
                        <td class="input_box">
                            <textarea id="contents" class="contents" name="contents"
                                      style="height: 300px"><?= viewSQ($contents) ?></textarea>
                            <script type="text/javascript">
                                $('#contents').summernote({
                                    height: 300,
                                    width: '100%',
                                    minHeight: null,
                                    maxHeight: null,
                                    focus: true,
                                    lang: "ko-KR",

                                    popover: {
                                        image: [
                                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                                        ],

                                    },
                                    callbacks: {
                                        onFocus: function (contents) {
                                            if ($('.summernote').summernote('isEmpty')) {
                                                $(".summernote").html('');
                                            }
                                        },
                                        onImageUpload: function (files) {
                                            for (var i = 0; i < files.length; i++) {
                                                sendFile(files[i], this);
                                            }
                                        }
                                    }
                                });
                            </script>
                        </td>
                    </tr>

                    <tr class="open_file_">
                        <td class="subject">베스트글로 선정될 시 메인에 노출될 사진</td>
                        <td class="input_box file_box file_box_1">
                            <div class="file_select">
                                <input type="text" class="file">
                                <div>
                                    <input type="file" name="ufile1" id="ufile1">
                                    <label for="ufile1">파일선택</label>
                                </div>
                            </div>
                            <div class="file_name file_best">
                                <input type="text" value="<?= $rfile1 ?>" disabled>
                                <i onclick="removeImg()"></i>
                            </div>
                            <p><span></span></p>
                        </td>
                    </tr>
                    <tr class="open_file_">
                        <td class="subject">첨부파일</td>
                        <td class="input_box file_box file_box_2">
                            <div class="file_select">
                                <input type="text" class="file">
                                <div>
                                    <input type="file" name="ufile2" id="ufile2">
                                    <label for="ufile2">파일선택</label>
                                </div>
                            </div>
                            <div class="file_name file_user">
                                <input type="text" value="<?= $rfile2 ?>" disabled>
                                <i onclick="removeFile()"></i>
                            </div>
                            <p><span></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">개인정보처리방침</td>
                        <td class="input_box wrap_check">
                            <div class="privacy" name="security"><?= viewSQ($privacy['policy_contents']) ?></div>
                            <!-- <textarea style="resize:none" name="security"></textarea> -->
                            <div class="check_box">
                                <input type="checkbox" name="checkbox_sec" class="security" id="checkbox_1" checked>
                                <label for="checkbox_1">개인정보처리방침에 동의합니다.</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="subject">개인정보 제3자 제공</td>
                        <td class="input_box wrap_check">
                            <div class="privacy" name="info"><?= viewSQ($third_paties['policy_contents']) ?></div>
                            <div class="check_box">
                                <input type="checkbox" name="checkbox_info" class="info" id="checkbox_2" checked>
                                <label for="checkbox_2">개인정보처리방침에 동의합니다.</label>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <!-- <div class="flex_box_cap">

                    <img src="" alt="captcha" id="cap_re" loading="lazy">
                    <div class="spinner" id="spinner_load"></div>

                    <input type="hidden" value="" id="hidden_captcha"/>

                    <button class="re_btn" type="button" onclick="reloadCaptcha()">
                        <img class="re_cap" src="/images/ico/reloadicon.png" alt="">
                        <p>새로고침</p>
                    </button>

                    <div class="input-wrapper">
                        <input class="captcha_input" id="captcha_input" type="text" name="captcha">
                        <label for="captcha_input" class="placeholder-text">보안 문자 입력</label>
                    </div>

                </div> -->
                <div class="write_container">
                    <div class="btn-wrap">
                        <a href="/review/review_list" type="button" class="btn btn-lg btn_cancel">취소하기</a>
                        <button type="button" onclick="send_it(event)"
                                class="btn btn-lg btn-point btn_submit"><?= ($idx ? "수정하기" : "등록하기") ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- <script>
        var input = document.getElementById('captcha_input');
        var placeholder = document.querySelector('.placeholder-text');

        input.addEventListener('input', function () {
            if (input.value) {
                placeholder.classList.add('hide-placeholder');
            } else {
                placeholder.classList.remove('hide-placeholder');
            }
        });

        if (input.value) {
            placeholder.classList.add('hide-placeholder');
        }
    </script> -->
    <!-- <script>

        document.getElementById('cap_re').style.opacity = "0"

        function reloadCaptcha() {
            $.ajax({
                url: '/tools/generate_captcha',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    document.getElementById('cap_re').src = data.captcha_image;
                    document.getElementById('hidden_captcha').value = data.captcha_value;
                    document.getElementById('spinner_load').style.display = "none"
                    document.getElementById('cap_re').style.opacity = "1"
                }
            })
        }

        reloadCaptcha();
    </script> -->

    <script>
        $(function () {

            // datepick
            $(".datepick input").datepicker({
                dateFormat: 'yy.mm.dd',
                showOn: "both",
                buttonImage: '../assets/img/ico/ico_datepick.png',
                showMonthAfterYear: true,
                buttonImageOnly: true,
                monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월',
                    '12월'
                ],
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
                minDate: new Date(),
            });

            //$('.datepick input').datepicker('setDate', 'today');
            //(-1D:하루전, -1M:한달전, -1Y:일년전), (+1D:하루후, -1M:한달후, -1Y:일년후)
        });

        function sendFile(files, el) {
            let form = document;

            form = form.frm;

            let data = new FormData(form);

            data.append("file", files);

            for (var pair of data.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            $.ajax({
                url: "/ajax/uploader",
                data: data,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.result == "ERROR") {
                        alert(response.msg);
                    } else {
                        $(el).summernote("insertImage", response.msg, 'filename');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                }
            });
        }

        function send_it(event) {
            var captchaValue = $("#hidden_captcha").val();
            var userInputCaptcha = $("#captcha_input").val();
            event.preventDefault();
            const form = $("#frm");
            const frm = document.frm;
            <?php if (!$product_idx) { ?>
            if (!frm.travel_type.value) {
                alert("여행형태 선택해주세요!");
                return;
            }
            <?php } ?>
            let arr = [];
            $('.input_checkbox').each(function () {
                if ($(this).is(':checked')) {
                    arr.push($(this).val())
                }
            })

            let travel_type_2 = $("#travel_type_2").val();

            if (arr.length == 0 && travel_type_2 != '132403') {
                console.log(travel_type_2);
                alert("평가구분을 선택해주세요!");
                return;
            }

            let review_type_ = arr.join('|');

            $('#review_type').val(review_type_)

            if (!frm.mail_name.value) {
                alert("이메일 선택해주세요!");
                return;
            }
            if (!frm.number_stars.value) {
                alert("별 개수를 선택하세요!");
                return;
            }

            if (!frm.title.value) {
                alert("제목 선택해주세요!");
                return;
            }
            if (!$("#checkbox_1").is(':checked')) {
                alert("개인정보처리방침 선택해주세요!");
                return;
            }
            if (!$("#checkbox_2").is(':checked')) {
                alert("개인정보 제3자 제공 선택해주세요!");
                return;
            }
            // if (userInputCaptcha !== captchaValue) {
            //     alert("보안문자 일치하지 않습니다.");
            //     $("#captcha_input").focus();
            //     reloadCaptcha();
            //     return false;
            // }
            if (frm.contents.length < 2) {
                frm.contents.focus();
                alert_("내용을 입력하셔야 합니다.");
                return;
            }
            $("#ajax_loader").removeClass("display-none");

            const formData = new FormData($('#frm')[0]);

            $.ajax({
                url: "./review_write_ok",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response)
                    $(window).off('beforeunload', handleUnload);
                    if ($("#idx").val()) {
                        alert("정상적으로 수정되었습니다!");
                        location.href = `/review/review_detail?idx=${$("#idx").val()}`;
                    } else {
                        alert("정상적으로 등록되었습니다!");
                        location.href = '/review/review_list';
                    }
                }
            })

        }

        //mail
        function populate(s1, s2) {
            var s1 = document.getElementById(s1);
            var s2 = document.getElementById(s2);

            s2.value = s1.value;
        }

        $('.file_box #ufile1').change(function () {
            var fileName = $(this).prop('files')[0].name;

            let fileSizeInBytes = $(this).prop('files')[0].size;
            let fileSize, unit;
            if (fileSizeInBytes < 1024) {
                fileSize = fileSizeInBytes;
                unit = 'b';
            } else if (fileSizeInBytes < 1024 * 1024) {
                fileSize = fileSizeInBytes / 1024;
                unit = 'kb';
            } else if (fileSizeInBytes < 1024 * 1024 * 1024) {
                fileSize = fileSizeInBytes / (1024 * 1024);
                unit = 'mb';
            } else {
                fileSize = fileSizeInBytes / (1024 * 1024 * 1024);
                unit = 'gb';
            }

            $('.file_box .file_best input[type=text]').val(fileName);
            $('.evaluate_write_section .evaluate_table .file_box .file_best i').css("display", "inline-block");
            $('.file_box_1 p span').text(fileSize.toFixed(2) + ' ' + unit);
        });

        function removeImg() {
            $('.file_box .file_best input[type=text]').val('');
            $('.evaluate_write_section .evaluate_table .file_box .file_best i').css("display", "none");
            $('.file_box_1 p span').text('0');
        }

        $('.file_box #ufile2').change(function () {
            var fileName = $(this).prop('files')[0].name;

            let fileSizeInBytes = $(this).prop('files')[0].size;
            let fileSize, unit;
            if (fileSizeInBytes < 1024) {
                fileSize = fileSizeInBytes;
                unit = 'b';
            } else if (fileSizeInBytes < 1024 * 1024) {
                fileSize = fileSizeInBytes / 1024;
                unit = 'kb';
            } else if (fileSizeInBytes < 1024 * 1024 * 1024) {
                fileSize = fileSizeInBytes / (1024 * 1024);
                unit = 'mb';
            } else {
                fileSize = fileSizeInBytes / (1024 * 1024 * 1024);
                unit = 'gb';
            }

            $('.file_box .file_user input[type=text]').val(fileName);
            $('.evaluate_write_section .evaluate_table .file_box .file_user i').css("display", "inline-block");
            $('.file_box_2 p span').text(fileSize.toFixed(2) + ' ' + unit);
        });

        function removeFile() {
            $('.file_box .file_user input[type=text]').val('');
            $('.evaluate_write_section .evaluate_table .file_box .file_user i').css("display", "none");
            $('.file_box_2 p span').text('0');
        }

        $("#travel_type_1").on("change", function (event) {
            $.ajax({
                url: "/tools/get_travel_types",
                type: "POST",
                data: {
                    code: event.target.value,
                    depth: 3
                },
                success: function (res) {
                    const data = JSON.parse(res);
                    if (data.cnt == 0) {
                        $("#travel_type_2").hide();
                        // $("#travel_type_3").hide();
                        $("#products").hide();
                    } else {
                        $("#travel_type_2").html(data.data);
                        $("#travel_type_2").show();
                        // $("#travel_type_3").show();
                        $("#products").show();
                    }
                }
            })
        })

        function openListType() {
            let travel_type_1 = $("#travel_type_1").val();
            let travel_type_2 = $("#travel_type_2").val();

            if (travel_type_1 == "1324" && travel_type_2 == "132404") {
                $("#travel_type_3").show();
            } else {
                $("#travel_type_3").hide();
            }
        }

        function showListCodeType(type) {
            let travel_type_1 = $("#travel_type_1").val();
            let travel_type_2 = $("#travel_type_2").val();
            let travel_type_3 = $("#travel_type_3").val();
            let url = '<?= route_to('tools.get_list_code_type_review') ?>?type=' + type
                + '&product_code_1=' + travel_type_1
                + '&product_code_2=' + travel_type_2
                + '&product_code_3=' + travel_type_3;

            $.ajax({
                url: url,
                type: "GET",
                success: function (res) {
                    console.log(res);
                    let html = '';
                    let codes = res.data.codes;

                    if(travel_type_2 == "132403") {
                        $(".guide_n").hide();
                    } else {
                        $(".guide_n").show();
                        for (let i = 0; i < codes.length; i++) {
                            let code = codes[i];
    
                            html += `<div class="wrapper_label">
                                        <input type="checkbox" class="input_checkbox" value="${code.code_no}"
                                            ${code.checked}
                                            name="input_checkbox" id="input_checkbox${code.code_no}">
                                        <label for="input_checkbox${code.code_no}" style="margin-right: 10px">${code.code_name}</label>
                                    </div>`;
                        }
    
                        $('#list_code_type').empty().append(html);
                    }

                }
            })
        }

        getListCodeType();

        function getListCodeType() {
            let product_idx = `<?= $product_idx ?>`;
            let idx = `<?= $idx ?>`;
            let url = '<?= route_to('tools.get_list_code_type_review') ?>?product_idx=' + product_idx + '&idx=' + idx;

            $.ajax({
                url: url,
                type: "GET",
                success: function (res) {
                    console.log(res);
                    let html = '';
                    let codes = res.data.codes;

                    for (let i = 0; i < codes.length; i++) {
                        let code = codes[i];

                        html += `<div class="wrapper_label">
                                    <input type="checkbox" class="input_checkbox" value="${code.code_no}"
                                        ${code.checked}
                                        name="input_checkbox" id="input_checkbox${code.code_no}">
                                    <label for="input_checkbox${code.code_no}" style="margin-right: 10px">${code.code_name}</label>
                                </div>`;
                    }

                    $('#list_code_type').empty().append(html);
                }
            })
        }

        $("#travel_type_2").on("change", function (event) {
            let travel_type_1 = $("#travel_type_1").val();
            let travel_type_2 = $(this).val();
            openListType();
            if (travel_type_1 == "1324" && travel_type_2 == "132404") {
                $("#products").show();
                let travel_type_2 = $("#travel_type_2").val();
                $.ajax({
                    url: "/tools/get_list_product",
                    type: "POST",
                    data: {
                        product_code: travel_type_2,
                        s_code: event.target.value
                    },
                    dataType: 'json',
                    success: function (res) {
                        // const data = JSON.parse(res);
                        // $("#travel_type_3").html(data.data)
                        showListCodeType(3);
                        $("#products").html(res.data)
                    }
                })
            } else {
                $.ajax({
                    url: "/tools/get_list_product",
                    type: "POST",
                    data: {
                        product_code: event.target.value,
                    },
                    dataType: 'json',
                    success: function (res) {
                        // const data = JSON.parse(res);
                        // $("#travel_type_3").html(data.data)
                        showListCodeType(2);
                        $("#products").html(res.data)
                    }
                })
            }
        })
        

        $("#travel_type_3").on("change", function (event) {
            let travel_type_2 = $("#travel_type_2").val();
            $.ajax({
                url: "/tools/get_list_product",
                type: "POST",
                data: {
                    product_code: travel_type_2,
                    s_code: event.target.value
                },
                dataType: 'json',
                success: function (res) {
                    // const data = JSON.parse(res);
                    // $("#travel_type_3").html(data.data)
                    showListCodeType(3);
                    $("#products").html(res.data)
                }
            })
        })

        function handleUnload(event) {
            let confirmationMessage = '사이트를 새로고침하시겠습니까?';

            if (typeof event === 'undefined') {
                event = window.event;
            }

            if (event) {
                event.returnValue = confirmationMessage;
            }

            return confirmationMessage;
        }

        $(window).on('beforeunload', handleUnload);

        const allStar = document.querySelectorAll('.rating .star')

        allStar.forEach((item, idx) => {
            item.addEventListener('click', function () {
                let click = 0;
                document.getElementById("ratingValue").setAttribute('value', idx + 1);
                allStar.forEach(i => {
                    i.classList.replace('bxs-star', 'bx-star')
                    i.classList.remove('active')
                })
                for (let i = 0; i < allStar.length; i++) {
                    if (i <= idx) {
                        allStar[i].classList.replace('bx-star', 'bxs-star')
                        allStar[i].classList.add('active')
                    } else {
                        allStar[i].style.setProperty('--i', click)
                        click++
                    }
                }
            })
        })
    </script>

<?php $this->endSection(); ?>