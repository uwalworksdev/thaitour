<?php
foreach ($result3 as $row) {
    ?>
    <tr id="tr_<?= $row['code_idx'] ?>">
        <td>
            <input type="checkbox" class="select_idx" name="idx[]" value="<?= $row['code_idx'] ?>">
        </td>
        <td>
            <?= $row['product_name'] ?>
        </td>
        <td style="text-align:center;">
            <select name="product_status" id="product_status_<?= $row["product_idx"] ?>"  onchange="updateStatus('<?= $row['product_idx'] ?>', this.value)">
                <option value="sale" <?php if (isset($row["product_status"]) && $row["product_status"] === "sale") {
                    echo "selected";
                } ?>>판매중
                </option>
                <option value="plan" <?php if (isset($row["product_status"]) && $row["product_status"] === "plan") {
                    echo "selected";
                } ?>>예약중지
                </option>
                <option value="stop" <?php if (isset($row["product_status"]) && $row["product_status"] === "stop") {
                    echo "selected";
                } ?>>판매중지
                </option>
            </select>
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