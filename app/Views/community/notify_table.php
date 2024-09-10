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
                        <div class="itembar active"><a href="/community/customer_center/notify_table">1 : 1 게시판</a>
                        </div>
                        <div class="itembar"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                    </div>
                </div>
                <div class="form-customer">
                    <div class="menu">
                        <div class="menu-header">
                            <h3 class="title-menu">
                                1 : 1 게시판
                            </h3>
                        </div>
                        <form class="form_table_notify_" action="#">
                            <div class="form_el">
                                <label class="form_label_" for="title_">제목*</label>
                                <input class="form_input_" type="text" id="title_" name="title_" placeholder="">
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="lname">첨부파일</label>
                                <div class="form_upload_container">
                                    <div class="form_upload_info">
                                        <input type="file" id="file-upload" multiple class="upload-input"
                                               style="display: none">
                                        <div class="form_upload_text form_input_">최대 3개까지 30MB, JPG, PNG 파일만 첨부 가능합니다.
                                        </div>
                                    </div>
                                    <button type="button" class="form_upload_button" id="upload-button">파일첨부</button>
                                </div>
                                <div class="form_uploaded_file_list" id="uploaded-file-list">

                                </div>
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="w3review">내용*</label>
                                <textarea class="form_textarea_" id="w3review" name="w3review" rows="4"
                                          cols="50"></textarea>
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="email">이메일 주소*</label>
                                <div class="form_el_cont">
                                    <input class="form_input_ form_50" id="email" name="email" type="text"
                                           placeholder="이메일">
                                    <label for="email_select">@</label>
                                    <select class="form_input_ form_50" name="email_select" id="email_select">
                                        <option value="선택해주세요.">선택해주세요.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form_radio">
                                <label class="form_label_" for="yes">답변여부를 메일로 받으시겠습니까?</label>
                                <input type="radio" id="yes" name="receive" value="yes">
                                <label class="form_label_" for="yes">예</label>
                                <input type="radio" id="no" name="receive" value="no" checked>
                                <label class="form_label_" for="no">아니오</label>
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
        function go_list() {
            window.history.back();
        }

        $('.form_upload_text').click(function () {
            $('#file-upload').click();
        })

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
                    if (uploadedFileList.children.length >= maxFiles) {
                        return;
                    }

                    const fileName = document.createElement('span');

                    let html = `<div class="file_item_">
                                        ${fileName}
                                        <span class="file_remove_"></span>
                                    </div>`;
                });

                // Clear the input
                uploadInput.value = '';
            });
        });
    </script>
<?php $this->endSection(); ?>