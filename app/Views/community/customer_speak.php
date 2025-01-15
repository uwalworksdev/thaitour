<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<section class="customer-notify-page customer-center-page">
    <div class="inner">
        <div class="main-container">
            <div class="side-bar only_web">
                <h2 class="title-side-bar">고객센터</h2>
                <div class="list-item-bar">
                    <div class="itembar">
                        <a href="/community/customer_center">자주 찾는 질문</a>
                    </div>
                    <div class="itembar"><a href="/community/customer_center/list_notify">태국뉴스 및 공지사항</a></div>
                    <div class="itembar"><a href="/qna/list">1 : 1 게시판</a></div>
                    <div class="itembar active"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                </div>
            </div>
            <div class="gnb_menu only_mo">
                <h1 class="gnb_title">고객센터</h1>
                <button type="button" class="now_tab_text only_mo">예약내역</button>
                <ul class="gnb_menu_list flex">
                    <li class="">
                        <div class="menu_level_1 flex_b_c"><a href="/community/customer_center">자주 찾는 질문</a></div>
                    </li>
                    <li class="">
                        <div class="menu_level_1 flex_b_c"><a href="/community/customer_center/list_notify">태국뉴스 및 공지사항</a></div>
                    </li>
                    <li class="">
                        <div class="menu_level_1 flex_b_c"><a href="/qna/list">1 : 1 게시판</a></div>
                    </li>
                    <li class="on">
                        <div class="menu_level_1 flex_b_c"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                    </li>

                </ul>
            </div>
            <div class="form-customer">
                <div class="menu">
                    <div class="menu-header">
                        <h3 class="title-menu cus-font">
                            고객의 소리
                        </h3>
                    </div>
                    <div class="sec-img">
                        <div class="text-content">
                            <h2 class="title">
                                칭찬 · 건의 · 불편사항<br class="only_web">언제든지 알려주세요.
                            </h2>
                            <p class="content">
                                고객불편상담을 이용하시면 더투어랩 담장자가 <br>
                                불편사항을 신속하게 해결해 드리겠습니다.
                            </p>
                        </div>
                    </div>
                    <form class="form_notify_" name=frm id=frm action="/community/customer_center/notify_table_ok" method=post enctype="multipart/form-data">
                        <input type="hidden" name="star" id="star" value="5">
                        <div class="form_el">
                            <label class="form_label_" for="user_name">제목*</label>
                            <input class="form_input_ full" type="text" id="user_name" name="user_name" placeholder="">
                        </div>
                        <div class="form_el_flex flex">
                            <div class="form_el">
                                <label class="form_label_" for="accuracy">정확성*</label>
                                <select class="form_input_" name="accuracy" id="accuracy">
                                    <option value="">선택해주세요.</option>
                                    <option value="test1">test1</option>
                                    <option value="test2">test2</option>
                                </select>
                            </div>
                            <div class="form_el">
                                <label class="form_label_" for="speed">신속성*</label>
                                <select class="form_input_" name="speed" id="speed">
                                    <option value="">선택해주세요.</option>
                                    <option value="test1">test1</option>
                                    <option value="test2">test2</option>
                                </select>
                            </div>

                            <div class="form_el">
                                <div class="form_label_">친절도*</div>
                                <div class="custom-select">
                                    <div class="select-selected form_input_">
                                        <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                    </div>
                                    <div class="select-items select-hide">
                                        <div data-value="5" class="star-rating">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="4" class="star-rating">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="3" class="star-rating">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="2" class="star-rating">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="1" class="star-rating">
                                            <img class="only_web" src="/images/ico/star_yellow_icon.png" alt="5 stars" loading="lazy">
                                            <img class="only_mo" src="/images/ico/star_yellow_icon_mo.png" alt="5 stars" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form_el form-custom-tab4-mo">
                            <label class="form_label_" for="contents">내용*</label>
                            <textarea class="form_textarea_" id="contents" name="contents" rows="4" cols="20"></textarea>
                        </div>

                        <div class="list_btn_">
                            <button type="button" class="btn_cancel_">취소하기</button>
                            <button type="button" onclick="send_it()" class="btn_submit_">문의하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function send_it() {
        var frm = document.frm;

        formData = new FormData(frm);

        if (frm.user_name.value == "") {
            alert("이름를 입력해주세요!");
            frm.user_name.focus();
            return false;
        }

        if (frm.accuracy.value == "") {
            alert("정확성를 선택해주세요!");
            frm.accuracy.focus();
            return false;
        }

        if (frm.speed.value == "") {
            alert("신속성를 선택해주세요!");
            frm.speed.focus();
            return false;
        }

        if (frm.star.value == "") {
            alert("친절도를 선택해주세요!");
            return false;
        }

        if (frm.contents.value == "") {
            alert("내용를 입력해주세요!");
            frm.contents.focus();
            return false;
        }

        $.ajax({
            type: "POST",
            data: formData,
            url: "/community/customer_center/customer_speak_ok",
            processData: false,
            contentType: false,
            success: function(data, textStatus) {
                alert(data.message);
                if (data.result == true) {
                    location.reload();
                }
            },
            error: function(request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });

    }

    document.addEventListener('DOMContentLoaded', function() {
        var selected = document.querySelector('.select-selected');
        var items = document.querySelector('.select-items');
        var options = items.querySelectorAll('div');
        var star = document.querySelector('#star');

        selected.addEventListener('click', function() {
            items.classList.toggle('select-hide');
        });

        options.forEach(function(option) {
            option.addEventListener('click', function() {
                var value = this.getAttribute('data-value');
                star.value = value;
                selected.innerHTML = this.innerHTML;
                items.classList.add('select-hide');
            });
        });

        document.addEventListener('click', function(event) {
            if (!event.target.matches('.select-selected')) {
                var openDropdowns = document.querySelectorAll('.select-items');
                openDropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('select-hide');
                });
            }
        });
    });
</script>
<script>
    const items = document.querySelectorAll('.item-tag');

    items.forEach((item, index) => {
        item.addEventListener('click', function() {
            // Remove 'active' class from all items
            items.forEach(i => i.classList.remove('active'));

            // Add 'active' class to the clicked item
            this.classList.add('active');

            // Change the image of the active item
            const img = this.querySelector('img');
            if (img) {
                // Change to corresponding active image
                img.src = `/images/community/customer_icon_0${index + 1}_active.png`;
            }

            // Reset images for all non-active items
            items.forEach((i, idx) => {
                if (i !== this) {
                    const nonActiveImg = i.querySelector('img');
                    if (nonActiveImg) {
                        nonActiveImg.src = `/images/community/customer_icon_0${idx + 1}.png`;
                    }
                }
            });
        });
    });


    const item_no = document.querySelectorAll('.item-no');

    item_no.forEach(item => {
        item.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            } else {
                alert("No URL provided!");
            }
        });
    });

    function go_list() {
        window.history.back();
    }


    document.addEventListener('DOMContentLoaded', function() {
        const uploadInput = document.getElementById('file-upload');
        const uploadButton = document.getElementById('upload-button');
        const uploadedFileList = document.getElementById('uploaded-file-list');
        const maxFiles = 3;

        // Add event listener for the upload button
        uploadButton.addEventListener('click', function() {
            // Get the files from the input
            const files = Array.from(uploadInput.files);

            if (files.length + uploadedFileList.children.length > maxFiles) {
                alert(`최대 ${maxFiles}개까지 파일을 업로드할 수 있습니다.`);
                return;
            }

            // Loop through files and add them to the list
            files.forEach(file => {
                if (uploadedFileList.children.length >= maxFiles) return;

                const fileItem = document.createElement('div');
                fileItem.className = 'uploaded-file-item';

                const fileName = document.createElement('span');
                fileName.className = 'file-name';
                fileName.textContent = file.name;

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-button';
                removeButton.textContent = 'x';

                // Add click event to remove file from list
                removeButton.addEventListener('click', function() {
                    uploadedFileList.removeChild(fileItem);
                });

                fileItem.appendChild(fileName);
                fileItem.appendChild(removeButton);
                uploadedFileList.appendChild(fileItem);
            });

            // Clear the input
            uploadInput.value = '';
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        if ($(window).width() <= 850) {
            snbActive();
        }

        function snbActive() {
            $('.now_tab_text').on('click', function() {
                if ($(this).hasClass('active') == true) {
                    $(this).removeClass('active');
                    $('.gnb_menu_list').stop().slideUp();
                } else {
                    $(this).addClass('active');
                    $('.gnb_menu_list').stop().slideDown();
                }
            })
            $('.menu_level_1 > div').on('click', function(e) {
                if ($(this).next('.menu_level_2').length > 0) {
                    e.preventDefault();
                    $(this).next('.menu_level_2').stop().slideToggle();
                } else {
                    $('.gnb_menu_list').stop().slideUp();
                    $('.now_tab_text').removeClass('active');
                }
            });
            let nowTxt = $('.gnb_menu .gnb_menu_list li.on .menu_level_1 a').text();
            $('.gnb_menu .now_tab_text').text(nowTxt);

        }

        $(".gnb_menu_list > li .menu_level_1 .show").on("click", function() {
            $(this).siblings(".btn_togle").toggleClass("up");
            $(this).closest(".menu_level_1").siblings(".menu_level_2").slideToggle(100, function() {

            });
        });
        $(".gnb_menu_list > li .menu_level_1 .btn_togle").on("click", function() {
            $(this).toggleClass("up");
            $(this).closest(".menu_level_1").siblings(".menu_level_2").slideToggle(100, function() {

            });
        });

        $(".gnb_menu_list > li.on").each(function() {
            $(this).find('.menu_level_1 .btn_togle').removeClass("up");
            $(this).find('.menu_level_2').css('display', 'flex');

        });
    })
</script>

<?php $this->endSection(); ?>