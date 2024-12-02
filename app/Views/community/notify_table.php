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
                        <div class="itembar"><a href="/community/customer_center/list_notify">태국뉴스 및 공지사항</a></div>
                        <div class="itembar active"><a href="/qna/list">1 : 1 게시판</a>
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
                        <form class="form_table_notify_" name=frm id=frm action="/community/customer_center/notify_table_ok" method=post enctype="multipart/form-data">
                            <div class="form_el">
                                <label class="form_label_" for="title">제목*</label>
                                <input class="form_input_" type="text" id="title" name="title" placeholder="">
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="lname">첨부파일</label>
                                <div class="form_upload_container">
                                    <div class="form_upload_info">
                                        <input type="file" id="file-upload" class="upload-input" name="ufile1" style="display: none">
                                        <div class="form_upload_text form_input_">최대 3개까지 30MB, JPG, PNG 파일만 첨부 가능합니다.
                                        </div>
                                    </div>
                                    <button type="button" class="form_upload_button" id="upload-button">파일첨부</button>
                                </div>
                                <div class="form_uploaded_file_list" id="uploaded-file-list">

                                </div>
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="contents">내용*</label>
                                <textarea class="form_textarea_" id="contents" name="contents" rows="4" cols="50"></textarea>
                            </div>

                            <div class="form_el">
                                <label class="form_label_" for="email_name">이메일 주소*</label>
                                <div class="form_el_cont">
                                    <input class="form_input_ form_50" id="email_name" name="email_name" type="text"
                                           placeholder="이메일">
                                    <label for="email_host">@</label>
                                    <select class="form_input_ form_50" name="email_host" id="email_host">
                                        <option value="naver.com">선택해주세요.</option>
                                        <option value="naver.com">naver.com</option>
                                        <option value="hanmail.net">hanmail.net</option>
                                        <option value="hotmail.com">hotmail.com</option>
                                        <option value="nate.com">nate.com</option>
                                        <option value="yahoo.co.kr">yahoo.co.kr</option>
                                        <option value="empas.com">empas.com</option>
                                        <option value="dreamwiz.com">dreamwiz.com</option>
                                        <option value="freechal.com">freechal.com</option>
                                        <option value="lycos.co.kr">lycos.co.kr</option>
                                        <option value="korea.com">korea.com</option>
                                        <option value="gmail.com">gmail.com</option>
                                        <option value="hanmir.com">hanmir.com</option>
                                        <option value="paran.com">paran.com</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form_radio">
                                <label class="form_label_" for="yes">답변여부를 메일로 받으시겠습니까?</label>
                                <input type="radio" id="yes" name="email_yn" value="Y">
                                <label class="form_label_" for="yes">예</label>
                                <input type="radio" id="no" name="email_yn" value="N" checked>
                                <label class="form_label_" for="no">아니오</label>
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

            if(frm.title.value == ""){
                alert("제목를 입력해주세요!");
                frm.title.focus();
                return false;
            }

            if(frm.contents.value == ""){
                alert("내용를 입력해주세요!");
                frm.contents.focus();
                return false;
            }

            let email = $("#email_name").val() + "@" + $("#email_host").val();

            if(!validateEmail(email)){
                alert("잘못된 이메일 주소!");
                frm.email_name.focus();
                return false;
            }

            formData.append("email", email);

            $.ajax({
                type  : "POST",
                data  : formData,
                url   :  "/community/customer_center/notify_table_ok",
                processData: false,
                contentType: false,
                success: function(data, textStatus) {
                    alert(data.message);
                    if(data.result == true) {
                        location.reload();
                    }
                },
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                }
            });

        }

        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            return regex.test(email);
        }


        function go_list() {
            window.history.back();
        }

        $('#upload-button').click(function () {
            $('#file-upload').click();
            const input = document.getElementById('file-upload');
    
            input.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    const file = this.files[0];
                    
                    const fileName = file.name;
                    
                    document.querySelector('.form_upload_text').textContent = fileName;
                } else {
                    document.querySelector('.form_upload_text').textContent = "No file chosen";
                }
            });
        })


        document.addEventListener('DOMContentLoaded', function () {
            const uploadInput = document.getElementById('file-upload');
            const uploadButton = document.getElementById('upload-button');
            const uploadedFileList = document.getElementById('uploaded-file-list');
            const maxFiles = 3;

            // Add event listener for the upload button
            uploadButton.addEventListener('click', function () {
                const files = Array.from(uploadInput.files);

                if (files.length + uploadedFileList.children.length > maxFiles) {
                    alert(`최대 ${maxFiles}개까지 파일을 업로드할 수 있습니다.`);
                    return;
                }

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

                uploadInput.value = '';
            });
        });
    </script>
<?php $this->endSection(); ?>