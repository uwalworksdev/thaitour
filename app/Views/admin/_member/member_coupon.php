<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<table width="100%" cellpadding="6" cellspacing="0">
    <tbody>
        <tr>
            <td>

                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tbody>
                        <tr>
                            <td class="tit_sub"><img src="../image/ics_tit.gif"> <?= esc($member['user_id']) ?> 님의 쿠폰내역</td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="t_rd" colspan="20"></td>
                        </tr>
                        <tr class="t_th">
                            <th width="5%" height="25">번호</th>
                            <th width="*">쿠폰이름</th>
                            <th width="15%">마감일자</th>
                            <th width="25%">발급일</th>
                            <th width="10%">쿠폰상태</th>
                            <th width="10%">기능</th>
                        </tr>
                        <tr>
                            <td class="t_rd" colspan="20"></td>
                        </tr>
                        <?php

                            $index = 1;

                            if ($nTotalCount == 0) {
                        ?>
                        <tr bgcolor="ffffff" align="center">
                            <td height="35" colspan="7">발급내역이 없습니다.</td>
                        </tr>
                        <?php } ?>
                        <?php
                            foreach ($coupon_list as $row) {
                        ?>
                        <tr bgcolor="ffffff" align="center" class="spe">
                            <td><?= $index;?></td>
                            <td><?= $row['coupon_name'] ?></td>
                            <td><?= $row['enddate'] ?></td>
                            <td><?= $row['regdate'] ?></td>
                            <td>
                                <?php                                 
                                if ($row["status"] == "D") {
                                    echo "대기";
                                } elseif ($row["status"] == "N") {
                                    echo "발급";
                                } elseif ($row["status"] == "E") {
                                    echo "사용";
                                } elseif ($row["status"] == "C") {
                                    echo "취소";
                                }
                                ?>
                            </td>
                            <td><a href="javascript:deleteCoupon('<?= $row['c_idx']?>');" class="AW-btn-s del">삭제</a></td>
                        </tr>
                        <?php
                            $index++;
                            } ?>
                        <tr>
                            <td colspan="20" class="t_line"></td>
                        </tr>
                    </tbody>
                </table>

                <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td height="1" style="background-color: #6e6e6e;"></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="AW-btn-wrap">

                                    <a onclick="self.close();">닫기</a>
                                </div><!-- .AW-btn-wrap -->
                            </td>
                        </tr>
                    </tbody>
                </table>

            </td>
        </tr>
    </tbody>
</table>

<style>
    .tit_sub {
        font-size: 15px;
        color: #111;
        font-weight: 600;
        letter-spacing: -0.02em;
        line-height: 1.3;
        padding: 0 0 10px 15px;
        background: url(image/ics_tit.gif) 0 7px no-repeat;
    }

    .tit_sub img {
        display: none;
    }

    .t_th th {
        text-align: center;
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 0;
    }

    .t_th {
        background: #6f7684;
    }

    tr.spe td {
        padding: 10px 0;
    }

    .AW-btn-s.del {
    border: 1px solid #777;
    background: #888;
    }

    .AW-btn-s {
        font-family: "돋움", 'Dotum';
        display: inline-block;
        height: 19px;
        line-height: 21px;
        font-size: 11px;
        letter-spacing: -0.8px;
        font-weight: normal;
        padding: 0 6px;
        vertical-align: middle;
        border-radius: 3px;
        color: #fff !important;
        border: 1px solid #222;
        background: #444;
        box-sizing: border-box;
        cursor: pointer;
        text-decoration: unset;
    }

    .AW-btn-wrap {
        text-align: center;
        font-size: 16px;
        margin: 20px 0 0;
    }

    .AW-btn-wrap a,
    .AW-btn-wrap input,
    .AW-btn-wrap button {
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        min-width: 65px;
        height: 28px;
        line-height: 26px;
        font-size: 13px;
        color: #fff;
        font-weight: 600;
        padding: 0 15px;
        margin-left: 5px;
        text-align: center;
        border: 1px solid #888;
        border-right-color: #6e6e6e;
        border-bottom-color: #6e6e6e;
        background: #9e9e9e;
        box-sizing: border-box;
    }

    .AW-pagenum {
        text-align: center;
        font-size: 16px;
        white-space: nowrap;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;

    }

    tbody td {
        font-size: 13px;
    }
</style>
<script>
    function deleteCoupon(c_idx) {
        if (!confirm("정말 삭제하시겠습니까?")) return;
    
        $.ajax({
            url: "/AdmMaster/_member/deleteCoupon",
            type: "POST",
            data: { c_idx: c_idx},
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    alert("삭제가 완료되었습니다.");
                    location.reload();
                } else {
                    alert("오류 발생: " + response.message);
                }
            },
            error: function() {
                alert("오류가 발생했습니다. 다시 시도해 주세요."); 
            }
        });
    }
</script>