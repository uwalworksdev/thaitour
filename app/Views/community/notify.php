<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<section class="customer-center-page customer-notify-page">
    <div class="inner">
        <div class="main-container">
            <div class="side-bar">
                <h2 class="title-side-bar">커뮤니티</h2>
                <div class="list-item-bar">
                    <div class="itembar">
                        <a href="/community/customer_center">자주 찾는 질문</a>
                    </div>
                    <div class="itembar active"><a href="/community/customer_center/notify">공지사항</a></div>
                    <div class="itembar"><a href="/community/customer_center/notify_table">1 : 1 게시판</a></div>
                    <div class="itembar"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                </div>
            </div>
            <div class="con-right">
                <div class="menu">
                    <div class="menu-header">
                        <h3 class="title-menu">
                            공지사항
                        </h3>
                    </div>
                    <div class="item1">
                        <h3 class="item1-title">2024년 8월 국제선 대한항공/아시아나항공 유류할증료 안내</h3>
                        <div class="item1-date">2024.07.26</div>
                    </div>
                    <div class="item2">
                        <p class="des1">2024년 8월 발권 부 변경되는 대한항공/아시아나항공 한국 발 유류할증료를 아래와 같이 안내드립니다. 구매에 참고 부탁 드립니다.
                        예약일/탑승일과 관계없이 발권일이 해당 8월1일 이후인 경우 아래 유류할증료가 적용됩니다.</p>
                        <p class="des2">7월 예약 8월 발권시 유류할증료가 인상 조정 될 수 있습니다.<br>
7월 31일 까지 발권된 항공권에 대해서는 해당사항 없습니다. 감사합니다.
</p>
                        <p class="des3">>> 아 래 <<</p>
                        <p class="des4">1. 2024년 8월 부 한국발 유류할증료 금액</p>
                        <p class="des5">○ 적용 기간 : 2024.8.1 ~ 8.31 (발권일 기준, LST)<br>(편도 및 대권거리 miles 기준, 단위:KRW)</p>
                        <p class="des6">○ 대한항공 (mile)<br>~500 미만 // 18,200원<br>500~1,000미만 // 32,200원<br>1,000~1,500미만 // 36,400원<br>1,500~2,000미만 // 44,800원<br>2,000~3,000미만 // 54,600원<br>3,000~4,000미만 // 58,800원<br>4,000~5,000미만 // 86,800원<br>5,000 ~ 6,500미만 // 116,200원<br>6,500~10,000미만 // 141,400원</p>
                        <p class="des7">10000만이상 // 144,200 원</p>
                    </div>
                    <div class="btn-c">
                        <button class="notity-btn">
                            목록으로
                        </button>
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

function go_list() {
    window.history.back();
}
</script>
<?php $this->endSection(); ?>