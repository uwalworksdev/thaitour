<?php
    foreach($products as $product){
?>
    <tr class="product_area">
        <td colspan="2">
            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                style="table-layout:fixed;">

                <colgroup>
                    <col width="10%" />
                    <col width="*" />
                </colgroup>
                <tbody>
                    <tr>
                        <input type="hidden" name="s_idx[<?= $index ?>][]" value="">
                        <input type="hidden" name="product_idx[<?=$index?>][]" value="<?=$product['product_idx']?>">
                        <input type="hidden" name="step[<?=$index?>][]" class="step_index" value="">

                        <th style="text-align: center;">
                            <div class="flex_c_c" style="margin-top: 5px;">
                                <button type="button" onclick="del_product(this, '');" class="btn btn-danger">삭제</button>
                            </div>
                        </th>
                        <td colspan="3">
                            <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                style="table-layout:fixed;">

                                <colgroup>
                                    <col width="10%" />
                                    <col width="40%" />
                                    <col width="10%" />
                                    <col width="40%" />
                                </colgroup>
                                <tbody>                                                                
                                    <tr>
                                        <th>상품명</th>
                                        <td colspan="3">
                                            <input type="text" name="theme_name[<?=$index?>][]"
                                                        value="<?=$product['product_name']?>"
                                                        class="text" maxlength="100" />
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>등급</th>
                                        <td colspan="3">
                                            <select name="star[<?=$index?>][]" class="input_select">
                                                <option value="5" <?php if($product['review_average'] == 5) echo "selected";?>>
                                                    <font color="#17469E">★★★★★</font>
                                                </option>
                                                <option value="4" <?php if($product['review_average'] == 4) echo "selected";?>>
                                                    <font color="#17469E">★★★★</font>
                                                </option>
                                                <option value="3" <?php if($product['review_average'] == 3) echo "selected";?>>
                                                    <font color="#17469E">★★★</font>
                                                </option>
                                                <option value="2" <?php if($product['review_average'] == 2) echo "selected";?>>
                                                    <font color="#17469E">★★</font>
                                                </option>
                                                <option value="1" <?php if($product['review_average'] == 1) echo "selected";?>>
                                                    <font color="#17469E">★</font>
                                                </option>
                                            </select>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <th>내용</th>
                                        <td colspan="3">
                                            <textarea name="recommend_text[<?=$index?>][]" rows="10" cols="100"  class="input_txt"  style="width:100%; height:100px;"><?= viewSQ($product['product_info']) ?></textarea><textarea name="product_info" id="product_info" rows="10" cols="100"  class="input_txt"  style="width:100%; height:400px; display:none;"><?= viewSQ($product_info) ?></textarea>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>대표이미지(600X440)</th>
                                        <td colspan="3">

                                            <div class="img_add">
                                                <?php
                                                    for ($i = 1; $i <= 1; $i++) :
                                                        $img = "/data/product/" . $product['ufile' . $i];
                                                ?>
                                                    <div class="file_input_wrap">
                                                        <div class="file_input <?= empty($product['ufile' . $i]) ? "" : "applied" ?>">
                                                            <input type="file" name='ufile_<?= $i ?>[<?=$index?>][]' id="ufile_<?=$index?>_<?= $i ?>"
                                                                onchange="productImagePreview(this, '<?= $i ?>')">
                                                            <label for="ufile_<?=$index?>_<?= $i ?>" <?= !empty($product['ufile' . $i]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                            <input type="hidden" name="s_checkImg_<?= $i ?>[<?=$index?>][]" class="checkImg">
                                                            
                                                            <button type="button" class="remove_btn"
                                                                onclick="productImagePreviewRemove(this)"></button>

                                                            <?php if ($product['ufile' . $i]) { ?>
                                                                <a class="img_txt imgpop" href="<?= $img ?>"
                                                                    id="text_ufile_<?=$index?>_<?= $i ?>">미리보기</a>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                <?php
                                                endfor;
                                                ?>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>대표이미지(600X440)</th>
                                        <td colspan="3">

                                            <div class="img_add img_add_group">
                                                <?php
                                                for ($i = 2; $i <= 4; $i++) :
                                                    $img ="/data/product/" . $product["img_list"][$i - 2]["ufile"];
                                                ?>
                                                    <div class="file_input_wrap">
                                                        <div class="file_input <?= empty($product["img_list"][$i - 2]["ufile"]) ? "" : "applied" ?>">
                                                            <input type="file" name='ufile_<?= $i ?>[<?=$index?>][]' id="ufile_<?=$index?>_<?= $i ?>"
                                                                onchange="productImagePreview(this, '<?= $i ?>')">
                                                            <label for="ufile_<?=$index?>_<?= $i ?>" <?= !empty($product["img_list"][$i - 2]["ufile"]) ? "style='background-image:url($img)'" : "" ?>></label>
                                                            <input type="hidden" name="s_checkImg_<?= $i ?>[<?=$index?>][]" class="checkImg">
                                                        
                                                            <button type="button" class="remove_btn"
                                                                onclick="productImagePreviewRemove(this)"></button>

                                                            <?php if ($product["img_list"][$i - 2]["ufile"]) { ?>
                                                                <a class="img_txt imgpop" href="<?= $img ?>"
                                                                    id="text_ufile_<?=$index?>_<?= $i ?>">미리보기</a>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                <?php
                                                    endfor;
                                                ?>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>  
                </tbody>
            </table>
        </td>
    </tr>  
<?php
    }
?>