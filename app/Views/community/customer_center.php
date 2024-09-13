<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<link href="/css/community/community.css" rel="stylesheet" type="text/css" />
<link href="/css/community/community_responsive.css" rel="stylesheet" type="text/css" />
<section class="customer-center-page">
    <div class="inner">
        <div class="main-container">
            <div class="side-bar">
                <h2 class="title-side-bar">고객센터</h2>
                <div class="list-item-bar">
                    <div class="itembar active">
                        <a href="/community/customer_center">자주 찾는 질문</a>
                    </div>
                    <div class="itembar"><a href="/community/customer_center/list_notify">공지사항</a></div>
                    <div class="itembar"><a href="/community/customer_center/notify_table">1 : 1 게시판</a></div>
                    <div class="itembar"><a href="/community/customer_center/customer_speak">고객의 소리</a></div>
                </div>
            </div>
            <div class="con-right">
                <div class="menu">
                    <div class="menu-header">
                        <h3 class="title-menu">
                            자주 찾는 질문
                        </h3>
                        <div class="list-tag">
                            <div class="item-tag <?php if($code_no == ""){ echo "active"; }?>" onclick="location.href='/community/customer_center'">
                                <?php 
                                    if($code_no == ""){ 
                                        $img_all = "customer_icon_01_active.png";
                                    }else{
                                        $img_all = "customer_icon_01.png";
                                    }
                                ?>
                                <img src="/images/community/<?=$img_all?>" alt="customer_icon_01">
                                <span class="tag-name">전체</span>
                            </div>
                            <?php
                                $i = 2;
                                foreach($code_gubun as $code){
                                    if($code["code_no"] == $code_no){
                                        $img = "customer_icon_0". $i ."_active.png";
                                    }else{
                                        $img = "customer_icon_0". $i .".png";
                                    }
                            ?>
                                <div class="item-tag" <?php if($code["code_no"] == $code_no){ echo "active"; } ?> onclick="location.href='/community/customer_center?code_no=<?=$code['code_no']?>'">
                                    <?php 
                                        if($i < 7) {
                                    ?>      
                                        <img src="/images/community/<?=$img?>" alt="customer_icon">
                                    <?php
                                        }else{
                                    ?>
                                        <span class="icon-custom">ATC</span>
                                    <?php } ?>
                                    <span class="tag-name"><?=$code["code_name"]?></span>
                                </div>
                            <?php 
                                $i++;
                                } 
                            ?>
                            
                        </div>
                    </div>
                    <div class="list-q">
                        <?php 
                            foreach($question_list as $row) {
                        ?>
                            <div class="item-q">
                                <div class="custom-con">
                                    <div class="flex-title-con">
                                        <div class="con-q">
                                            <div class="label-q">Q</div>
                                            <span class="name"><?= $row['code_name'] ?></span>
                                        </div>
                                        <p class="content"><?= $row['r_title'] ?></p>
                                    </div>
                                    <div class="con-a" style="display: none;">
                                        <div class="label-a">A</div>
                                        <div class="content"><?= viewSQ($row['r_content']) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <!-- <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">상품문의</span>
                                    </div>
                                    <p class="content">트래블 케어에는 어떤 것들이 있나요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">예약문의</span>
                                    </div>
                                    <p class="content">내맘대로 항공호텔이란 무엇인가요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">결제문의</span>
                                    </div>
                                    <p class="content">항공여정과 호텔 투숙일정이 통일해야만 예약 가능한가요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">결제문의</span>
                                    </div>
                                    <p class="content">호텔을 여러 개 예약 할 수 있나요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">포인트</span>
                                    </div>
                                    <p class="content">여권보험을 모르는데 예약이 가능한가요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">기타문의</span>
                                    </div>
                                    <p class="content">비회원 예약이 가능한가요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">상품문의</span>
                                    </div>
                                    <p class="content">최대 몇 명까지 한번에 예약할 수 있나요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">상품문의</span>
                                    </div>
                                    <p class="content">내 맘대로 항고예약을 위한 결제방법을 무엇이 있나요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">상품문의</span>
                                    </div>
                                    <p class="content">쿠폰 사용이 가능한가요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div>
                        <div class="item-q">
                            <div class="custom-con">
                                <div class="flex-title-con">
                                    <div class="con-q">
                                        <div class="label-q">Q</div>
                                        <span class="name">항공권</span>
                                    </div>
                                    <p class="content">두개의 카드로 분할 결제가 가능한가요?</p>
                                </div>
                                <div class="con-a" style="display: none;">
                                    <div class="label-a">A</div>
                                    <p class="content">여행자 1인당 총 면세품 구입금액이 $3,000을 넘어서는 안되며, 시계 등의 고가품은 물건 1개당 $400을 넘어서는 안됩니다.
                                        $3,000을 초과하여 물품을 반입하는 경우, 비록 출국시 국내 면세점에서 구입한 물품일지라도 세관에 반드시 신고하여 관세를
                                        납부하여야 합니다. 위 사항을 위반할 시에는 관세법 규정에 의거 처벌받게 됩니다.
                                        우리나라 입국 시에는 면세금액 한도가 $400미만으로 적용되기 때문에 주의해서 들어오셔야 합니다.</p>
                                </div>
                            </div>
                        </div> -->

                    </div>

                    <?php 
                        echo ipagelistingSub($pg, $total_page, $scale, current_url() . "?code_no=". $code_no ."&pg=")
                    ?>

                    <!-- <div class="pagination">
                        <a href="#" class="page-link">
                            <img src="/images/community/pagination_prev.png" alt="pagination_prev">
                        </a>
                        <a href="#" class="page-link" style="margin-right: 24px;">
                            <img src="/images/community/pagination_prev_s.png" alt="pagination_prev">
                        </a>
                        <a href="#" class="page-link active">1
                        </a>
                        <a href="#" class="page-link">2</a>
                        <a href="#" class="page-link">3</a>
                        <a href="#" class="page-link" style="margin-left: 24px;">
                            <img src="/images/community/pagination_next_s.png" alt="pagination_next">
                        </a>
                        <a href="#" class="page-link">
                            <img src="/images/community/pagination_next.png" alt="pagination_next">
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(".flex-title-con .con-q, .flex-title-con .content").on("click", function() {
        $(this).closest(".item-q").toggleClass("active");
        if($(this).closest(".item-q").hasClass("active")){
            $(this).closest(".item-q").find(".con-a").css("display", "flex");
        }else{
            $(this).closest(".item-q").find(".con-a").css("display", "none");
        }
    })
</script>

<script>
    const items = document.querySelectorAll('.item-tag');

    items.forEach((item, index) => {
        item.addEventListener('click', function() {
            items.forEach(i => i.classList.remove('active'));

            this.classList.add('active');

            const img = this.querySelector('img');
            if (img) {
                img.src = `/images/community/customer_icon_0${index + 1}_active.png`;
            }

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