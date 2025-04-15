<?php
foreach ($result3 as $row) {
    ?>
    <tr id="tr_<?= $row['code_idx'] ?>">
        <td>
            <input type="checkbox" class="select_idx" name="idx[]" value="<?= $row['code_idx'] ?>">
        </td>
        <td>
            <?php

                if($row["product_code_1"] == "1303"){
                    $_product_code_arr = explode("|", $row['product_code_list']);
                    $_product_code_arr = array_filter($_product_code_arr);
                    foreach ($_product_code_arr as $_tmp_code) {
                        $cate_text = get_cate_text($_tmp_code);
                    }
                    $url_detail = '/product-hotel/hotel-detail/' . $row["product_idx"];
                    $url_admin = "/AdmMaster/_hotel/write?product_idx=". $row["product_idx"];
                }else{
                    $cate_text = $row["product_code_name_1"] . " / " . $row["product_code_name_2"];

                    if($row["product_code_1"] == "1302") {
                        $url_detail = '/product-golf/golf-detail/' . $row["product_idx"];
                        $url_admin = "/AdmMaster/_tourRegist/write_golf?product_idx=". $row["product_idx"];
                    }else if($row["product_code_1"] == "1301") {
                        $url_detail = '/product-tours/item_view/' . $row["product_idx"];
                        $url_admin = "/AdmMaster/_tourRegist/write_tours?product_idx=". $row["product_idx"];
                    }else if($row["product_code_1"] == "1325") {
                        $url_detail = '/product-spa/spa-details/' . $row["product_idx"];
                        $url_admin = "/AdmMaster/_tourRegist/write_spas?product_idx=". $row["product_idx"];
                    }else if($row["product_code_1"] == "1317") {
                        $url_detail = '/ticket/ticket-detail/' . $row["product_idx"];
                        $url_admin = "/AdmMaster/_tourRegist/write_spas?product_idx=". $row["product_idx"];
                    }else if($row["product_code_1"] == "1320") {
                        $url_detail = '/product-restaurant/restaurant-detail/' . $row["product_idx"];
                        $url_admin = "/AdmMaster/_tourRegist/write_spas?product_idx=". $row["product_idx"];
                    } 
                } 
            ?>
            <div style="padding: 0 20px; text-align: center;">
                <p class="new"><?= $cate_text ?></p>
            </div>
            <div class="flex_c_c" style="gap: 10px;">
                <a href="<?=$url_detail?>"
                    class="product_view" target="_blank">[<span>상품상세</span>]</a>
                <a href="<?=$url_admin?>"
                    class="product_view" style="color: red;">[<span>상세수정</span>]</a>
            </div>
        </td>
        <td style="text-align:center;">
            <?= $row['product_code'] ?>
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

        <!--td style="text-align:center;">
            <a href="#!" class="order_btn"
                onclick="return positionUP('<?= $replace_code ?>','<?= $row['code_idx']; ?>','U')">▲</a>
            <a href="#!" class="order_btn"
                onclick="return positionUP('<?= $replace_code ?>','<?= $row['code_idx']; ?>','D')">▼</a>
        </td-->
		<td style="text-align:center;">
			<a href="#!" class="order_btn"
				onclick="return changePosition('<?= esc($replace_code) ?>','<?= esc($row['code_idx']) ?>','U')">▲</a>
			<a href="#!" class="order_btn"
				onclick="return changePosition('<?= esc($replace_code) ?>','<?= esc($row['code_idx']) ?>','D')">▼</a>
		</td>
		
        <td style="text-align:center;">
            <?= $row["r_date"] ?>
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