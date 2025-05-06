<?php foreach ($groupTotals as $group): ?>
    <div class="group-block">
        <strong>그룹번호: <?= esc($group['group_no']) ?></strong> /
        <span>합계: <?= number_format($group['group_total']) ?>원</span>

        <ul>
            <?php foreach ($groupedOrders[$group->group_no] as $order): ?>
                <li>
                    예약번호: <?= esc($order->order_no) ?> /
                    금액: <?= number_format($order->order_amount) ?>원
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>