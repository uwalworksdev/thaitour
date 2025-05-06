<?php foreach ($groupTotals as $group): ?>
    <div class="group-block">
        <strong>그룹번호: <?= esc($group->group_no) ?></strong> /
        <span>합계: <?= number_format($group->group_total) ?>원</span>


    </div>
<?php endforeach; ?>