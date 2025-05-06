<h3>예약 내역 (<?= esc($tab) ?>)</h3>
<table border="1">
    <tr>
        <th>예약번호</th>
        <th>상품명</th>
        <th>이용일</th>
        <th>상태</th>
        <th>기준값</th>
    </tr>
    <?php foreach ($reservations as $row): ?>
    <tr>
        <td><?= esc($row->order_no) ?></td>
        <td><?= esc($row->product_name) ?></td>
        <td><?= esc($row->use_date) ?></td>
        <td><?= esc(get_deli_type()[$row->order_status] ?? '알수없음') ?></td>
        <td>
            <?php
                switch ($tab) {
                    case 'paid':
                    case 'confirmed':
                        echo '결제번호: ' . esc($row->payment_no);
                        break;
                    case 'used':
                    case 'cancelled':
                        echo '예약번호: ' . esc($row->order_no);
                        break;
                    default:
                        echo '그룹번호: ' . esc($row->group_no);
                        break;
                }
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>