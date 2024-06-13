<?php $this->extend('inc/layout_index'); ?>
<?php $this->section('content'); ?>
<?php
    $connect = db_connect();
if ($_SESSION["member"]["mIdx"] == "") {
    alert_msg("", "/member/login?returnUrl=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>



<link href="/css/mypage/mypage_new.css" rel="stylesheet" type="text/css" />
<link href="/css/mypage/mypage_reponsive_new.css" rel="stylesheet" type="text/css" />
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
<!--
<script src="/mypage/mypage.js" type="text/javascript"></script>
-->

<section class="mypage_container">
    <div class="inner">
        <div class="mypage_wrap">
            <?php
            echo view("/mypage/mypage_gnb_menu_inc.php", [ 'tab_6' => "on", 'tab_6_1' => "on" ]);
            $page = $_GET['page'];
            $scale = 10;

            $total_sql = " select *		
                                from tbl_inquiry where 1=1 and user_id = '{$_SESSION["member"]["mIdx"]}' ";
            $total_cnt = $connect->query($total_sql)->getNumRows();

            $total_page = ceil($total_cnt / $scale);

            if ($page == "") $page = 1;
            $start = ($page - 1) * $scale;

            $sql    = $total_sql . " order by r_date desc limit $start, $scale ";
            $result = $connect->query($sql)->getResultArray();

            $num = $total_cnt - $start;
            $no = $total_cnt - $start;
            ?>
            <form id="frm" name="frm" class="content">
                <h1 class="ttl_table">맞춤여행</h1>
                <p class="count">전체 <span><?= $total_cnt ?></span>개</p>
                <table class="details_table mo">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="15%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                        <!-- <col width="10%"> -->
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <div class="ch_visit">
                                    <input type="checkbox" id="agree1" class="agree" name="agree">
                                    <label for="agree1"></label>
                                </div>
                            </th>
                            <th>번호</th>
                            <th>국문이름</th>
                            <th>이메일</th>
                            <th>답변상태</th>
                            <th>등록일</th>
                            <!-- <th>시간</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt =1;
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <input type="hidden" name="contact_idx[]" value="<?= $row['idx'] ?>">
                                <td class="check">
                                    <div class="ch_visit">
                                        <input type="checkbox" data-idx="<?= $row['idx'] ?>" id="del_check_<?= $no ?>" class="agree del_check" name="del_check[]">
                                        <label for="del_check_<?= $no ?>"></label>
                                    </div>
                                </td>
                                <!-- <td class="no"><span><?= $no ?></span></td> -->
                                <td class="no"><span><?= $stt++ ?></span></td>
                                <td class="num"><?=sqlSecretConver($row["user_name_eng"], 'decode')?></td>
                                </td>
                                <td class="des"><a href="../mypage/custom_travel_view.php?idx=<?= $row["idx"] ?>"><?=sqlSecretConver($row["user_email"], 'decode')?></a></td>
                                <td class="stt">

                                    <?php

                                    if ($row["status"] == "Y")
                                    {
                                        echo "상담완료";
                                    } elseif ($row["status"] == "C") {
                                        echo "상담취소";
                                    } elseif ($row["status"] == "W") {
                                        echo "문의접수";
                                    }

                                   
                                    ?>

                                </td>
                                <td class="date"><?= $row['r_date'] ?></td>
                                <!-- <td class="date"><?= date("Y.m.d", strtotime($row['r_date'])) ?></td> -->
                                <!-- <td class="date"><?= date("H:i:s", strtotime($row['r_date'])) ?></td> -->
                            </tr>
                        <?php
                            $no--;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="cancel flex_b_c">
                    <!-- <div class="ch_visit">
                            <input type="checkbox" id="agree10" class="agree" name="agree">
                            <label for="agree10"></label>
                        </div> -->
                    <button type="button" onclick="delete_selected()">선택삭제</button>
                    <a href="/t-travel/item_write.php" class="btn btn-lg btn-point contact_btn" style="position: relative">문의하기</a>
                </div>
                <?php echo ipageListing2($page, $total_page, 10, $_SERVER['PHP_SELF'] . "?scategory=$scategory&page=") ?>
            </form>
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
</div>
<script>
    $("#agree1").on("click", function() {
        if ($(this).is(":checked")) {
            $("input.del_check").prop("checked", true);
        } else {
            $("input.del_check").prop("checked", false);
        }
    })
    $("input.del_check").on("click", function() {
        let flag = true;
        $("input.del_check").each(function(index, elm) {
            if (!$(elm).is(":checked")) {
                flag = false;
            }
        });

        if (flag) {
            $("#agree1").prop("checked", true);
        } else {
            $("#agree1").prop("checked", false);
        }
    })
    $('.show_popup').on('click', function() {
        $('.agree_pop').show();
    });
    $(".popup_wrap .close, .popup_wrap .bg").on("click", function() {
        $(".popup_wrap").hide();
    });

    function delete_selected() {
        if ($("input.del_check").is(":checked") == false) {
            alert("삭제할 내용을 선택하셔야 합니다.");
            return;
        }
        if (!confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.")) {
            return;
        }
        let del_idxs = [];
        $("input.del_check").each(function() {
            if ($(this).is(":checked")) {
                del_idxs.push($(this).data("idx"));
            }
        })
        $.ajax({
            type: "POST",
            url: "./ajax.custom_del.php",
            data: {
                del_idxs: del_idxs.join(",")
            },
            success: function(response, textStatus, jqXHR) {
                if (response === "OK") {
                    alert("정상적으로 삭제되었습니다.");
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
            }
        });
    }
</script>
<?php $this->endSection(); ?>