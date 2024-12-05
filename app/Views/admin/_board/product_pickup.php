<div class="list_up" style="margin: 10px 0">
    <div>
        <button type="button" class="btn btn-list">상품등록</button>
    </div>
</div>
<div id="pick_select_layer" style="display:flex; gap: 10px; flex-wrap: wrap">
    <?php
    $productModel = new \App\Models\ProductModel();

    $list = $productModel->getProductsByEvent($bbs_idx);

    foreach ($list as $row) {
        ?>
        <div class="event_list" style="display: flex; gap: 5px; border: 1px solid #dbdbdb; padding: 10px">
            <?= $row['product_code'] ?>
            <a href="javascript:goods_del('<?= $row['code_idx'] ?>');"><img src="/images/admin/common/ico_error.png"
                    alt="삭제"></a>
        </div>
        <?php
    }
    ?>
</div>
<div class="pick_item_pop02" id="item_pop" style="display:none;">
    <div>
        <h2>이벤트 상품등록</h2>
        <div class="search_box">

            <form name="pick_item_search" id="pick_item_search">
                <input type="hidden" name="upd_code" id="upd_code" value="<?= $code ?>">
                <?=view("admin/_board/product_code_select", [
                    "product_code_1" => $product_code_1,
                    "product_code_2" => $product_code_2,
                    "product_code_3" => $product_code_3
                ])?>
                <select id="search_category" name="search_category" class="input_select" style="width:112px">
                    <option value="product_name">상품명</option>
                    <option value="product_code">상품코드</option>
                </select>
                <input type="text" id="search_txt" name="search_txt" value="" class="input_txt placeHolder"
                    placeholder="검색어 입력" style="width:240px">
                <a href="javascript:search_it()" class="btn btn-default"><span
                        class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
            </form>
        </div>
        <div class="table_box">
            <form method="post" name="select_pick_frm" id="select_pick_frm">
                <input type="hidden" name="isrt_code" id="isrt_code" value="<?= $bbs_idx ?>">
                <table>
                    <caption>상품찾기</caption>
                    <colgroup>
                        <col style="width: 5%;">
                        <col>
                        <col style="width: 20%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>선택</th>
                            <th>상품명</th>
                            <th>코드</th>
                        </tr>
                    </thead>
                    <tbody id="id_contents">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="sel_box">
            <button type="button" class="close">닫기</button>
            <button type="button" class="select_all">전체선택</button>
            <button type="button" onclick="fn_pick_update();" class="search">등록</button>
        </div>
        </form>
    </div>
</div>
<script>
    $(function () {

        $('.list_up .btn-list').on('click', function () {

            $('.pick_item_pop02').show();

        })

        $('.pick_item_pop02 .sel_box .close').on('click', function () {
            $('.pick_item_pop02').hide()
        })

    });
</script>