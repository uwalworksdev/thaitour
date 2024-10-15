<?php
foreach ($result3 as $row) {
    ?>
    <tr>
        <td>
            <input type="checkbox" class="select_idx" name="idx[]" value="<?= $row['code_idx'] ?>">
        </td>
        <td>
            <?= $row['product_name'] ?>
        </td>
        <td style="text-align:center;">
            <?= $row['product_code'] ?>
        </td>
        <td style="text-align:center;">
            <a href="#!" class="order_btn"
                onclick="return positionUP('<?= $replace_code ?>','<?= $row['code_idx']; ?>','U')">▲</a>
            <a href="#!" class="order_btn"
                onclick="return positionUP('<?= $replace_code ?>','<?= $row['code_idx']; ?>','D')">▼</a>
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="javascript:goods_del('<?= $row['code_idx'] ?>');">
                삭제
            </button>
        </td>
    </tr>
    <?php
}
?>