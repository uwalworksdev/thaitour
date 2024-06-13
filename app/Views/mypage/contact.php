<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
    $connect = db_connect();

    $page = $_GET['pg'];
    if ($_SESSION["member"]["mIdx"] == "") {
        alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
?>
<style>
    .cancel .btn.btn-lg {
        height: 45px;
        font-size: 16px;
    }

    .cancel a.btn.btn-lg {
        line-height: 45px;
    }

    @media screen and (max-width: 850px) {

        .cancel .btn.btn-lg {
            height: 2.4615rem;
            font-size: 0.6667rem;
        }

        .cancel a.btn.btn-lg {
            line-height: 2.4615rem;
            margin: 0;
            width: 6.3333rem;
        }
        }
</style>

<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
                echo view("/mypage/mypage_gnb_menu_inc.php", ["tab_6" => "on", "tab_6_2" => "on"]);
            ?>
            <div class="content">
                <h1 class="ttl_table">문의하기</h1>
                <p class="count">전체 <span>
                        <?php
                        $sql = "select * from tbl_travel_contact t where t.reg_m_idx = " . $_SESSION["member"]["mIdx"];
                        $result = $connect->query($sql);
                        $row = $result->getRowArray();
                        echo $result->getNumRows();
                        ?>
                    </span>개</p>
                <table class="details_table mo">
                    <colgroup>
                    <col width="5%">
                        <col width="10%">
                        <col width="15%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <div class="ch_visit">
                                    <input type="checkbox" id="agree1" class="agree1" name="agree">
                                    <label for="agree1"></label>
                                </div>
                            </th>
                            <th>번호</th>
                            <th>구분</th>
                            <th>제목</th>
                            <th>상태</th>
                            <th>등록일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT t.idx, c.code_name, c.code_no, t.product_name, t.title, t.`status`, t.r_date FROM tbl_travel_contact t
                        left join tbl_code c on t.travel_type_1 = c.code_no where t.reg_m_idx = '" . $_SESSION["member"]["mIdx"] . "'   ";
                        $talCount_wish_cnt = $connect->query($sql)->getNumRows();
                        $g_list_rows = 10;
                        $nPage = ceil($talCount_wish_cnt / $g_list_rows);
                        if ($page == "") $page = 1;
                        $nFrom = ($page - 1) * $g_list_rows;
                        $fsql   = $sql . " order by r_date asc limit $nFrom, $g_list_rows ";
                        $fresult = $connect->query($fsql)->getResultArray();
                        $num = $talCount_wish_cnt - $nFrom;

                        $stt=1;
                        foreach ($fresult as $row) {
                        ?>
                            <tr>
                                <td class="check">
                                    <div class="ch_visit">

                                        <!-- <input type="checkbox" id="<?= $row['idx'] ?>" class="agree" name="agree" onclick="change_stt(this)"> -->
                                        <input type="checkbox" id="<?= $row['idx'] ?>" class="agree" name="agree">
                                        <label for="<?= $row['idx'] ?>"></label>
                                    </div>
                                </td>
                                <td class="no"><span>
                                        <?php echo $stt++ ?>
                                        <!-- <?php echo $row['idx'] ?> -->
                                    </span></td>
                                <td class="num">
                                    <?php echo $row['code_name'] ?>
                                </td>
                                <td class="des"><a href="../mypage/inquiry_view.php?idx=<?= $row['idx'] ?>">
                                        <? echo $row['title'] ?>
                                    </a></td>
                                <td class="stt">
                                    <?php
                                    if ($row['status'] == 'W') {
                                    ?>
                                        <span style="color: #e5001a">답변대기</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span>답변완료</span>
                                </td>
                            <?php } ?>
                            <td class="date spe">
                                <?php
                                // $date = explode(" ", $row['r_date']);
                                $date = $row['r_date'];
                                echo $date; ?>
                            </td>
                            </tr>
                        <?php
                        }

                        ?>

                    </tbody>
                </table>
                <div class="cancel flex_b_c">
                    <!-- <div class="ch_visit">
                        <input type="checkbox" id="agree10" class="agree" name="agree">
                        <label for="agree10"></label>
                    </div> -->
                    <button id="delete">선택삭제</button>
                    <a href="/inquiry/inquiry_write.php" class="btn btn-lg btn-point contact_btn" style="position: relative">문의하기</a>
                </div>
                <?php echo ipageListing2($page, $nPage, $g_list_rows, $_SERVER['PHP_SELF'] . "?scategory=$scategory&pg=") ?>
            </div>
        </div>
    </div>
</section>
<div class="popup_wrap agree_pop">
    <div class="popup">
        <div class="top">
            <button type="button" class="close">
                <img src="/assets/img/btn/ico_closed.png" alt="닫기 아이콘">
            </button>
        </div>
        <div class="content">
            <div class="padding">
                <h1 class="title">현금 영수증 발급안내 내용</h1>
                <p class="content_1">- 현금으로 여행상품 결제 시 출발 다음 날부터 30일 이내에 담당자에게 요청하
                    시면 즉시 발급해 드립니다.<br>
                    - 다녀오신 당해 년도의 여행에 한해서만 발행이 가능합니다.
                </p>
                <p class="content_2">※ 여행취소수수료는 조세특례제한법 126조 3의 ④에 의해 현금영수증은
                    재화와 용역을 공급받은 자에게 그 대금을 현금으로 받는 경우 현금영수증을
                    발급할 수 있고, 부가가치세 기본통칙 제4조 4-0-1 공급받을 자의 해약으로
                    인하여 공급할 자가 재화 또는 용역의 공급 없이 받는 위약금의경우 과세대상
                    이 되지 아니한다고 명시되어 있음에 따라 현금영수증을 발급 받을실 수
                    없습니다.
                </p>
            </div>
        </div>
    </div>
    <div class="bg"></div>
    <!-- </div> -->
</div>
<script>
    $('.show_popup').on('click', function() {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function() {
        $(".popup_wrap").hide();
    });
    $('#agree1').click(function() {
        var x = [];
        x = document.getElementsByClassName("agree");
        var y = document.getElementById("agree1");
        if (y.checked == true) {
            for (let i = 0; i < x.length; i++) {
                x[i].checked = true;
            }
        } else {
            for (let i = 0; i < x.length; i++) {
                x[i].checked = false;
            }
        }
    });

    $('#delete').click(function() {
        var x = [],
            y = [];
        x = document.getElementsByClassName("agree");
        a = document.getElementById("agree1");
        for (let i = 0; i < x.length; i++) {
            if (x[i].checked == true) {
                y.push(x[i].id);
            }
        }
        $.ajax({
            type: 'POST',
            url: './contactDel.ajax.php',
            data: {
                data: y
            },
            success: function(response) {
                alert("삭제되었습니다!");
                location.reload();
            },
            error: function(error) {
                alert("lỗi");
            }
        });
    })
</script>
<?php $this->endSection(); ?>
