<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<section class="customer-notify-page customer-center-page">
    <div class="inner">
        <div class="main-container">
            <div class="side-bar">
                <h2 class="title-side-bar">커뮤니티</h2>
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
                        <h3 class="title-menu4">
                            고객의 소리
                        </h3>
                    </div>
                    <div class="sec-img">
                        <div class="text-content">
                            <h2 class="title">
                            칭찬 · 건의 · 불편사항<br>언제든지 알려주세요.
                            </h2>
                            <p class="content">
                                고객불편상담을 이용하시면 더투어랩 담장자가<br>
                                불편사항을 신속하게 해결해 드리겠습니다.
                            </p>
                        </div>
                    </div>
                    <form action="#">
                        <label for="제목">더투어랩 직원 이름 또는 별명*</label>
                        <input type="text" id="" name="" placeholder="">
                        <label for="제목">정확성*</label>
                        <select name="cars" id="cars">
                            <option value="선택해주세요.">선택해주세요.</option>
                        </select>
                        <label for="제목">신속성*</label>
                        <select name="cars" id="cars">
                            <option value="선택해주세요.">선택해주세요.</option>
                        </select>
                        <label for="제목">친절도*</label>
                        <select name="cars" id="cars">
                            <option value="선택해주세요.">****</option>
                        </select>
                        <label for="제목">내용*</label>
                        <textarea id="내용" name="내용" rows="4" cols="200">
                        </textarea>
                    </form>
                    <div class="btn-con">
                        <button class="btn-sub">취소하기</button>
                        <button class="btn-primary">문의하기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
<?php $this->endSection(); ?>