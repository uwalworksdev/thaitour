<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<table width="100%" cellpadding="6" cellspacing="0">
    <tbody>
        <tr>
            <td>

                <table width="100%" border="0" cellspacing="0" cellpadding="2">
                    <tbody>
                        <tr>
                            <td class="tit_sub"><img src="../image/ics_tit.gif"> <?= esc($members['user_id']) ?> 님의 적립금</td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="t_rd" colspan="20"></td>
                        </tr>
                        <tr class="t_th">
                            <th width="25%">적립일자</th>
                            <th>내용</th>
                            <th width="15%">적립금</th>
                            <th width="15%">기능</th>
                            <th td="">
                            </th>
                        </tr>
                        <tr>
                            <td class="t_rd" colspan="20"></td>
                        </tr>
                        <?php 
                            $index = 0;
                            
                            foreach ($point_list as $row) {
                                $index++;
                                $order_gubun = get_mileage_name($row["order_gubun"]);
                                $order_mileage_str = "";
                                if ($row["order_mileage"] < 0) {
                                    $order_mileage_str = "사용";
                                } else {
                                    $order_mileage_str = "적립";
                                }

                        ?>
                        <tr bgcolor="ffffff" align="center">
                            <td height="30"><?= date("Y.m.d", strtotime($row["mi_r_date"])) ?></td>
                            <td><?= $row["mi_title"] ?></td>
                            <td><?= $row["order_mileage"] ?></td>
                            <td>
                                <!--  <a href=javascript:orderView('240516120217916');>[주문보기]</a> -->
                                <a href="javascript:deleteReserve('<?= $row['m_idx']?>', '<?= $row['mi_idx']?>');" class="AW-btn-s del">삭제</a>
                            </td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td colspan="20" class="t_line"></td>
                        </tr>
                    </tbody>
                </table>

                <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td height="30">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="33%"></td>
                                            <td width="33%">
                                                <!-- <div class="AW-pagenum"> <strong><a href="?page=1&amp;&amp;id=lifeess"><img src="/img/ico/page-first.jpg"></a></strong> <strong><a href="?page=1&amp;&amp;id=lifeess"><img src="/img/ico/page-prev.jpg"></a></strong> <b><em>1</em> </b> <strong><a href="?page=1&amp;&amp;id=lifeess"><img src="/img/ico/page-next.jpg"></a></strong> <strong><a href="?page=1&amp;&amp;id=lifeess"><img src="/img/ico/page-last.jpg"></a></strong> </div> -->
                                            </td>
                                            <td width="33%" align="right">
                                                <font color="red"><b>총 적립금 : <?= $members['mileage'] ?>P</b></font>&nbsp; &nbsp;
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">

                                <table border="0" cellpadding="0" cellspacing="0" class="t_style">
                                    <form name="frm" action="member_save.php" method="post" onsubmit="return inputCheck(this)"></form>
                                    <input type="hidden" name="mode" value="reserve">
                                    <input type="hidden" name="memid" value="lifeess">
                                    <tbody>
                                        <tr>
                                            <td align="right" class="t_value">
                                                <select name="reserve_gubun" style="padding:0 0 0 10px; width:80px">
                                                    <option value="+"> + (적립)
                                                    </option>
                                                    <option value="-"> - (차감)
                                                    </option>
                                                </select>
                                                <input type="text" name="reserve" placeholder="적립금" size="12" onkeyup="chkNum(this)" class="input" oninput="regExpAlert('적립금은 숫자 6자 이하로 입력이 가능합니다.', 'phone', '6')" onclick="inputEmpty(this,'적립금');">
                                                <input type="text" name="reservemsg" placeholder="적립내용" size="35" class="input" oninput="regExpAlert('적립내용 한글, 영어, 숫자, 특수문자 20자 이하만 입력이 가능합니다.', null, '20')" onclick="inputEmpty(this,'적립내용');">
                                                <input type="submit" value="확인">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td align="right" height="25"><strong>* 상품주문 적립금은 주문관리에서 "배송완료" 처리후에 적립됩니다.</strong></td>
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

                <br><br>

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

    a:link {
    color: #444;
    text-decoration: none;
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
}

tbody tr {
    font-size: 13px;
}

.t_line {
    height: 1px;
    background: #dcd8d6;
}
</style>
<script>
    function deleteReserve(m_idx, mi_idx) {
        if (!confirm("정말 삭제하시겠습니까?")) return;
    
        $.ajax({
            url: "/AdmMaster/_member/deleteReserve",
            type: "POST",
            data: { m_idx: m_idx, mi_idx: mi_idx },
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
