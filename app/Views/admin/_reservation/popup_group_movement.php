<div class="group_movement_popup_content custom_popup_content">
    <div class="btn_close_popup">
        <img src="/img/btn/btn_close_black_20x20.png" alt="닫기">
    </div>
    <h1>그룹이동</h1>

    <div class="sec2">
        <div class="box_select">
            <select id="groupSelect">
                <option value="">그룹명 선택</option>
                <?php foreach ($groups as $g): ?>
                    <option value="<?= esc($g['group_no']) ?>" <?= $g['group_no'] == $group_no ? 'selected' : '' ?>>
                        <?= esc($g['group_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="btn_select">그룹이동</div>
        </div>

        <table>
            <colgroup>
                <col width="30px">
                <col width="70px">
                <col width="*">
                <col width="110px">
            </colgroup>
            <thead>
                <tr>
                    <th><input type="checkbox" id="check_all"></th>
                    <th>종류</th>
                    <th>내용</th>
                    <th>가격</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i): ?>
                <tr>
                    <td><input type="checkbox" class="check_item" value="<?= esc($i['id']) ?>"></td>
                    <td><?= esc($i['type']) ?></td>
                    <td><?= esc($i['title']) ?> <br> <?= esc($i['date']) ?></td>
                    <td><?= number_format($i['price']) ?>원</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="list_desc">
        <p>* 상품을 선택하고 그룹을 선택 후 그룹이동 버튼을 클릭합니다.</p>
    </div>
</div>
