<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
    <link href="/css/community/community.css" rel="stylesheet" type="text/css"/>
    <link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css"/>
    <section class="customer-notify-page customer-center-page">
        <div class="inner">
            <div class="main-container">
                <div class="side-bar">
                    <h2 class="title-side-bar">고객센터</h2>
                    <div class="list-item-bar">
                        <div class="itembar">
                            <a href="/community/customer_center">자주 찾는 질문</a>
                        </div>
                        <div class="itembar"><a href="/community/customer_center/list_notify">공지사항</a></div>
                        <div class="itembar"><a href="/community/customer_center/notify_table">1 : 1 게시판</a></div>
                        <div class="itembar active"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                    </div>
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
                                    칭찬 · 건의 · 불편사항<br>언제든지 알려주세요.
                                </h2>
                                <p class="content">
                                    고객불편상담을 이용하시면 더투어랩 담장자가 <br>
                                    불편사항을 신속하게 해결해 드리겠습니다.
                                </p>
                            </div>
                        </div>
                        <form class="form_notify_" action="#">
                            <div class="form_el">
                                <label class="form_label_" for="name">더투어랩 직원 이름 또는 별명*</label>
                                <input class="form_input_" type="text" id="name" name="name" placeholder="">
                            </div>
                            <div class="form_el">
                                <label class="form_label_" for="accuracy">정확성*</label>
                                <select class="form_input_" name="accuracy" id="accuracy">
                                    <option value="선택해주세요.">선택해주세요.</option>
                                </select>
                            </div>
                            <div class="form_el">
                                <label class="form_label_" for="speed">신속성*</label>
                                <select class="form_input_" name="speed" id="speed">
                                    <option value="선택해주세요.">선택해주세요.</option>
                                </select>
                            </div>

                            <div class="form_el">
                                <div class="form_label_">친절도*</div>
                                <div class="custom-select">
                                    <div class="select-selected form_input_">
                                        <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                    </div>
                                    <div class="select-items select-hide">
                                        <div data-value="1" class="star-rating">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="2" class="star-rating">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="3" class="star-rating">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="4" class="star-rating">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                            <img src="/images/ico/star_yellow_icon.png" alt="1 star" loading="lazy">
                                        </div>
                                        <div data-value="5" class="star-rating">
                                            <img src="/images/ico/star_yellow_icon.png" alt="5 stars" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="detail">내용*</label>
                                <textarea class="form_textarea_" id="detail" name="detail" rows="4" cols="20"></textarea>
                            </div>

                            <div class="list_btn_">
                                <button type="button" class="btn_cancel_">취소하기</button>
                                <button type="button" class="btn_submit_">문의하기</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var selected = document.querySelector('.select-selected');
            var items = document.querySelector('.select-items');
            var options = items.querySelectorAll('div');
            var select = document.querySelector('select');

            selected.addEventListener('click', function () {
                items.classList.toggle('select-hide');
            });

            options.forEach(function (option) {
                option.addEventListener('click', function () {
                    var value = this.getAttribute('data-value');
                    select.value = value;
                    selected.innerHTML = this.innerHTML;
                    items.classList.add('select-hide');
                });
            });

            document.addEventListener('click', function (event) {
                if (!event.target.matches('.select-selected')) {
                    var openDropdowns = document.querySelectorAll('.select-items');
                    openDropdowns.forEach(function (dropdown) {
                        dropdown.classList.add('select-hide');
                    });
                }
            });
        });
    </script>
    <script>
        const items = document.querySelectorAll('.item-tag');

        items.forEach((item, index) => {
            item.addEventListener('click', function () {
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
            item.addEventListener('click', function () {
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


        document.addEventListener('DOMContentLoaded', function () {
            const uploadInput = document.getElementById('file-upload');
            const uploadButton = document.getElementById('upload-button');
            const uploadedFileList = document.getElementById('uploaded-file-list');
            const maxFiles = 3;

            // Add event listener for the upload button
            uploadButton.addEventListener('click', function () {
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
                    removeButton.addEventListener('click', function () {
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
<?php $this->endSection(); ?>