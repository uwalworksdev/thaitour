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
    function search_it() {

        let product_code_1 = $("#product_code_1").val();
        let product_code_2 = $("#product_code_2").val();
        let product_code_3 = $("#product_code_3").val();
        let search_category = $("#search_category").val();
        let search_txt = $("#search_txt").val();

        $.ajax({

            url: "/AdmMaster/_bbs/item_allfind",
            type: "POST",
            data: {
                "product_code_1": product_code_1,
                "product_code_2": product_code_2,
                "product_code_3": product_code_3,
                "search_category": search_category,
                "search_txt": search_txt,

            },
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {

            }
            , success: function (response, status, request) {

                $("#id_contents").empty();
                $("#id_contents").append(response);
                $('.pick_item_pop02').show();
            }
        });
    }
    function fn_pick_update() {

        var f = document.select_pick_frm;

        var pick_data = $(f).serialize();
        var save_result = "";
        $.ajax({
            type: "POST",
            data: pick_data,
            url: "/AdmMaster/_bbs/event_update",
            cache: false,
            async: false,
            dataType: "json",
            success: function (data, textStatus) {
                var message = data.message;
                alert(message);
                location.reload();
            },
            error: function (request, status, error) {
                alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
            }
        });
    }
</script>