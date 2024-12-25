<table width="100%" cellpadding="6" cellspacing="0">
    <tbody>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tbody>
                <tr>
                    <td class="tit_sub"><img src="../image/ics_tit.gif"> <?= $member['user_name'] ?> 님의 상품주문</td>
                </tr>
                </tbody>
            </table>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td class="t_rd" colspan="20"></td>
                </tr>
                <tr class="t_th">
                    <th>주문일</th>
                    <th>주문번호</th>
                    <th>주문금액</th>
                    <th>주문방법</th>
                    <th>배송상태</th>
                </tr>
                <tr>
                    <td class="t_rd" colspan="20"></td>
                </tr>
                <?php foreach ($order_list as $order): ?>
                    <tr bgcolor="ffffff" align="center">
                        <td height="30">
                            <?= $order['order_date'] ?>
                        </td>
                        <td><?= $order['order_no'] ?></td>
                        <td><?= number_format($order['order_price']) ?> 원</td>
                        <td>
                            <?= $order['order_method'] ?? '무통장 입금' ?>
                        </td>
                        <td>
                            <?php if ($order['order_status'] == "W") {
                                echo "예약접수";
                            } ?>

                            <?php if ($order['order_status'] == "G") {
                                echo "선금대기";
                            } ?>

                            <?php if ($order['order_status'] == "R") {
                                echo "잔금대기";
                            } ?>

                            <?php if ($order['order_status'] == "Y") {
                                echo "결제완료";
                            } ?>

                            <?php if ($order['order_status'] == "C") {
                                echo "예약취소";
                            } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="20" class="t_line"></td>
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

    tbody tr td {
        font-size: 13px;
    }
</style>