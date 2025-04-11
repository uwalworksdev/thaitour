<?php
foreach ($result3 as $row) {
    ?>
    <tr id="tr_<?= $row['code_idx'] ?>">
        <td>
            <input type="checkbox" class="select_idx" name="idx[]" value="<?= $row['code_idx'] ?>">
        </td>
        <td>
            <?php
                if ($row["ufile1"] != "" && is_file(ROOTPATH . "/public/data/product/" . $row["ufile1"])) {
                    $src = "/data/product/" . $row["ufile1"];
                } else {
                    $src = "/data/product/noimg.png";
                }
            ?>
            <img src="<?= $src ?>" style="max-width:150px; max-height:100px;">
        </td>
        <td>
            <?= $row['product_name'] ?>
        </td>
        <td style="text-align:center;">
            <select name="product_status" id="product_status_<?= $row["product_idx"] ?>"  onchange="updateStatus('<?= $row['product_idx'] ?>', this.value)">
                <option value="sale" <?php if (isset($row["product_status"]) && $row["product_status"] === "sale") {
                    echo "selected";
                } ?>>노출
                </option>
                <option value="stop" <?php if (isset($row["product_status"]) && $row["product_status"] === "stop") {
                    echo "selected";
                } ?>>비노출
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