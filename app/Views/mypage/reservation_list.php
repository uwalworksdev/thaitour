<?php foreach ($groupTotals as $group): ?>
    <div>
        <h3>그룹번호: <?= esc($group->group_no) ?> / 총액: <?= number_format($group->group_total) ?>원</h3>
        <?php if (!empty($groupedOrders[$group->group_no])): ?>
            <ul>
                <?php foreach ($groupedOrders[$group->group_no] as $order): ?>
                    <li>
                        예약번호: <?= esc($order->order_no) ?> /
                        상품명: <?= esc($order->product_name) ?> /
                        금액: <?= number_format($order->order_price) ?>원
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>해당 그룹의 예약 내역이 없습니다.</p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
