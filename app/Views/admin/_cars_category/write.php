<?php
    $formAction = $ca_idx ? "/AdmMaster/_cars_category/write_ok/$ca_idx" : "/AdmMaster/_cars_category/write_ok";

    helper("cars_helper");
?>
<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<style>
    .btn_01 {
        height: 32px !important;
    }
    .depth_1 {
        border: 1px solid #ccc;  
        margin-top: 20px;   
    }

    .depth {
        padding: 10px 0;
    }

    div.listBottom table.listTable tbody td button {
        display: inline-block;
        width: unset;
        margin: unset;
        border: 1px solid rgb(204, 204, 204);
        flex: 0 0 auto;
    }
</style>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
    $titleStr = "차량 상품관리";
    $links = "list";
?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->
        <header id="headerContainer">
            <div class="inner">
                <h2><?= $titleStr ?></h2>
                <div class="menus">
                    <ul>
                        <li><a href="/AdmMaster/_cars_category/list" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        </li>
                        <?php if ($ca_idx) { ?>
                            <li><a href="javascript:send_it_c()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            </li>
                            <li>
                                <a href="javascript:del_it_c(`<?= route_to("admin._cars_category.delete") ?>`, `<?= $ca_idx ?>`)"
                                    class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            </li>
                        <?php } else { ?>
                            <li><a href="javascript:send_it_c()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
            <!-- // inner -->

        </header>
        <!-- // headerContainer -->

        <div id="contents">
            <div class="listWrap_noline">
                <!--  target="hiddenFrame22"  -->
                <form name="frm" id="frm" action="<?= $formAction ?>" method="post"
                        enctype="multipart/form-data"
                        target="hiddenFrame22"> <!--  -->
                    <!-- 상품 고유 번호 -->
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                                style="table-layout:fixed;">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="40%"/>
                                <col width="10%"/>
                                <col width="40%"/>
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>출발지역</th>
                                    <td>
                                        <?php
                                            if(empty($ca_idx)){
                                        ?>
                                            <select id="departure_code" name="departure_code" class="input_select">
                                                <option value="">선택</option>
                                                <?php
                                                    foreach($place_start_list as $code){
                                                ?>
                                                    <option value="<?=$code["code_no"]?>"><?=$code["code_name"]?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                            }else{
                                        ?>
                                            <input type="hidden" name="ca_idx" value="<?=$ca_idx?>">
                                            <input type="hidden" name="departure_code" value="<?=$departure_code?>">
                                            <span><?=getCodeFromCodeNo($departure_code)["code_name"]?></span>
                                        <?php
                                            }
                                        ?>
                                    </td>

                                    <th>도착지역</th>
                                    <td colspan="3">
                                        <?php
                                            if(empty($ca_idx)){
                                        ?>
                                        <select id="destination_code" name="destination_code" class="input_select">
                                            <option value="">선택</option>
                                            <?php
                                                foreach($place_end_list as $code){
                                            ?>
                                                <option value="<?=$code["code_no"]?>"><?=$code["code_name"]?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <?php
                                            }else{
                                        ?>
                                            <input type="hidden" name="depth_2" value="<?=$depth_2?>">
                                            <input type="hidden" name="destination_code" value="<?=$destination_code?>">
                                            <span><?=getCodeFromCodeNo($destination_code)["code_name"]?></span>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>   
                            
                            </tbody>
                        </table>
                        <?php
                            if(count($categories) > 0){
                                echo traverseCategories($categories, 54, 1);
                            }else{
                        ?>   
                             <table cellpadding="0" cellspacing="0" class="listTable mem_detail depth_1" style="margin-top:50px;">
                            <colgroup>
                                <col width="15%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                                <tr height="45">
                                    <th>카테고리 선택 1</th>
                                    <td>
                                        <select name="category_code_1" class="input_select category_code_1">
                                            <option value="all">전체선텍</option>
                                            <?php
                                                foreach ($category_options as $category) {
                                            ?>
                                                <option value="<?= $category["code_no"] ?>">
                                                    <?= $category["code_name"] ?>
                                                </option>
                                            <?php 
                                                } 
                                            ?>
                                        </select>
                                        <button type="button" class="btn_01" onclick="get_depth_category(this, 1)">추가</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <?php
                            }
                        ?>
                       

                        <!-- <div class="main_depth">
                            <button type="button" class="btn_01" onclick="add_depth_code(this, 0);">추가</button>
    
                            <div class="depth_1" style="padding-left: 20px;">
                                <div class="flex__c depth" style="gap: 20px;">
                                    옵션 1
                                    <div class="flex__c" style="gap: 5px;">
                                        <input type="text" class="ca_name" style="width:300px">
                                        <button type="button" class="btn_02" onclick="remove_depth(this, 1);">-</button>
                                        <button type="button" class="btn_01" onclick="add_depth_code(this, 1);">+</button>
                                    </div>
                                </div>
                                
                            </div>                        
                        </div> -->
                    </div>
                </form>

                <div class="tail_menu">
                    <ul>
                        <li class="left"></li>
                        <li class="right_sub">
                            <a href="/AdmMaster/_cars_category/list" class="btn btn-default"><span
                                        class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                            <?php if ($ca_idx == "") { ?>
                                <a href="javascript:send_it_c()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                            <?php } else { ?>
                                <a href="javascript:send_it_c()" class="btn btn-default"><span
                                            class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                                <a href="javascript:del_it_c(`<?= route_to("admin._cars_category.delete") ?>`, `<?= $ca_idx ?>`)"
                                    class="btn btn-default"><span
                                            class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>


            </div>
            <!-- // listWrap -->

        </div>
        <!-- // contents -->

    </div><!-- 인쇄 영역 끝 //-->
</div>

<script>
    $(document).on('input', 'input.onlynum', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    var tree_codes = <?=json_encode($tree_codes)?>;
    var products = <?=json_encode($products)?>;    
    var airlines = <?=json_encode($airline_list)?>;
                                  
    function check_category(button, depth, code){
        let is_check = false;
        $(button).closest("tbody").children(".child_category").each(function() {
            let code_child = $(this).data("code");
            if(code_child == code){
                is_check = true;
            }
        });

        return is_check;
    }

    function add_depth_category(button, depth, code, text) {
        const filteredData = tree_codes.filter(item => item.parent_code_no === code); 
        
        let html = `
            <tr height="45" class="child_category" data-code="${code}" data-ca_idx="">
                <th>
                    <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
                        ${text}
                        <button type="button" onclick="del_category(this, '')" class="btn_02">삭제</button>
                    </div>
                </th>
                <td>`;

        if(depth == 2){
            let parent_code = $(button).closest("table").closest("tr").data("code");
            if(parent_code == "5401"){
                html+=  `
                <table cellpadding="0" cellspacing="0" class="listTable mem_detail airline_table">
                    <colgroup>
                        <col width="15%"/>
                        <col width="90%"/>
                    </colgroup>
                    <tbody>
                        <tr height="45">
                            <th>항공사를 선택하세요</th>
                            <td>
                                <select name="airline_idx" class="input_select airline_idx">
                                    <option value="all">전체선텍</option>`;
                        airlines.forEach(data => {
                            html += `<option value="${data["code_idx"]}">${data["code_name"]}</option>`;
                        });                    
                html +=         `</select>
                                <button type="button" onclick="get_airline(this)" class="btn_01">추가</button>
                            </td>
                        </tr>`;
                html += 
                    `</tbody>
                </table>`;
            }
        }

        html += 
            `<table cellpadding="0" cellspacing="0" class="listTable mem_detail depth_${depth + 1}">
                    <colgroup>
                        <col width="15%"/>
                        <col width="90%"/>
                    </colgroup>
                    <tbody>`;

        if(filteredData.length > 0) {
            html+=      `<tr height="45">
                            <th>카테고리 선택 ${depth + 1}</th>
                            <td>
                                <select name="category_code_${depth + 1}" class="input_select category_code_${depth + 1}">
                                    <option value="all">전체선텍</option>`;
                        filteredData.forEach(data => {
                            html += `<option value="${data["code_no"]}">${data["code_name"]}</option>`;
                        });                    
            html +=             `</select>
                                <button type="button" onclick="get_depth_category(this, ${depth + 1})" class="btn_01">추가</button>
                            </td>
                        </tr>`;
        }else{
            html+=      `<tr height="45">
                            <th>차량 선택</th>
                            <td>
                                <select name="product_idx" class="input_select product_idx">
                                    <option value="all">전체선텍</option>`;
                        products.forEach(product => {
                            html += `<option value="${product["product_idx"]}">${product["product_name"]}</option>`;
                        });                    
            html +=             `</select>
                                <button type="button" onclick="get_product(this)" class="btn_01">추가</button>
                            </td>
                        </tr>`;
            html +=     `<tr>
                            <td colspan="2">
                                <table class="product_table">
                                    <colgroup>
                                        <col width="*">
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="10%">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>상품명</th>
                                        <th>가격(단위: 바트) <input type="checkbox" onchange="init_price_all(this);"> 전체</th>
                                        <th>우대가격(단위: 바트) <input type="checkbox" onchange="sale_price_all(this);"> 전체</th>
                                        <th>삭제</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                `;
        }
        html +=     `</tbody>
                </table>
                </td>
            </tr>`;
        $(button).closest("tbody").append(html);
    }

    function get_depth_category(button, depth) {
        let code = $(button).closest("tr").children("td").find("select").val();
        
        let code_text = $(button).closest("tr").children("td").find("select option:selected").text();
        if(code == "all"){
            $(button).closest("tr").children("td").find("select option").each(function() {
                const value = $(this).val();
                const text = $(this).text();
                if(value != "all" && !check_category(button, depth, value)){   
                    add_depth_category(button, depth, value, text);
                }
            });
        }else{
            if(!check_category(button, depth, code)) {
                add_depth_category(button, depth, code, code_text);
            }
        }
    }

    function del_category(button, ca_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        if(ca_idx){
            $.ajax({
                url: '/AdmMaster/_cars_category/delete_category',
                type: "POST",
                data: { "ca_idx" : ca_idx },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    if(response.result == true){
                        location.reload();
                    }

                    return;

                }
            });
        }

        $(button).closest(".child_category").remove();
    }
    
    //airline
    function del_airline(button, air_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        if(air_idx){
            $.ajax({
                url: '/AdmMaster/_cars_category/delete_airline',
                type: "POST",
                data: { "air_idx" : air_idx },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    if(response.result == true){
                        location.reload();
                    }

                    return;

                }
            });
        }

        $(button).closest(".child_airline").remove();
    }

    function check_airline(button, airline_idx){
        let is_check = false;
        $(button).closest("tbody").children(".child_airline").each(function() {
            let idx = $(this).data("airline_idx");
            if(idx == airline_idx){
                is_check = true;
            }
        });

        return is_check;
    }    

    function add_airline(button, airline_idx, airline_text) {
        let airline = airlines.filter(item => item.code_idx === airline_idx); 

        let html = `
            <tr height="45" class="child_airline" data-airline_idx="${airline_idx}" data-ca_idx="">
                <th>
                    <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
                        ${airline_text}
                        <button type="button" onclick="del_airline(this, '')" class="btn_02">삭제</button>
                    </div>
                </th>
                <td>
                    <table cellpadding="0" cellspacing="0" class="listTable mem_detail">
                        <colgroup>
                            <col width="15%">
                            <col width="90%">
                        </colgroup>
                        <tbody>
                            <tr height="45">
                                <th>비행 선택</th>
                                <td>
                                    <select name="f_idx" class="input_select f_idx">
                                        <option value="all">전체선텍</option>`
                        airline[0]["flights"].forEach(flight => {
                            html += `<option value="${flight["f_idx"]}">${flight["code_flight"]}</option>`;
                        });  
                        html +=      `</select>
                                    <button type="button" onclick="get_flight(this)" class="btn_01">추가</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="flight_table">
                                        <colgroup>
                                            <col width="*">
                                            <col width="40%">
                                            <col width="40%">
                                            <col width="10%">
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th>항공번호</th>
                                            <th>출발지 / 출발시간</th>
                                            <th>도착지 / 도착시간</th>
                                            <th>삭제</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        `;

        $(button).closest("tbody").append(html);
    }

    function get_airline(button) {
        let airline_idx = $(button).closest("tr").children("td").find("select").val();
        
        let airline_text = $(button).closest("tr").children("td").find("select option:selected").text();

        if(airline_idx == "all"){
            $(button).closest("tr").children("td").find("select option").each(function() {
                const value = $(this).val();
                const text = $(this).text();
                if(value != "all" && !check_airline(button, value)){   
                    add_airline(button, value, text);
                }
            });
        }else{
            if(!check_airline(button, airline_idx)) {
                add_airline(button, airline_idx, airline_text);
            }
        }
    }

    //flight
    function del_flight(button, cf_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }

        if(cf_idx){
            $.ajax({
                url: '/AdmMaster/_cars_category/delete_flight',
                type: "POST",
                data: { "cf_idx" : cf_idx },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    if(response.result == true){
                        location.reload();
                    }

                    return;

                }
            });
        }

        $(button).closest("tr").remove();
    }

    function check_flight(button, f_idx){
        let is_check = false;
        $(button).closest("tbody").find(".flight_table tbody").children("tr").each(function() {
            let idx = $(this).data("f_idx");
            if(idx == f_idx){
                is_check = true;
            }
        });

        return is_check;
    }

    function add_flight(button, f_idx, code_flight) {

        let flight = airlines.flatMap(item => item.flights).filter(flight => flight.f_idx === f_idx);

        let html = `
            <tr data-f_idx="${f_idx}" data-cf_idx="">
                <td style="text-align: center;">
                    <span>${code_flight}</span>
                </td>
                <td style="text-align: center;">
                    ${flight[0]["f_depature_name"]} / ${flight[0]["f_depature_time"]}
                </td>
                <td style="text-align: center;">
                    ${flight[0]["f_destination_name"]} / ${flight[0]["f_destination_time"]}
                </td>
                <td style="text-align: center;">
                    <button type="button" onclick="del_flight(this, '')" class="btn_02">
                        삭제
                    </button>
                </td>
            </tr>
        `;

        $(button).closest("tbody").find(".flight_table tbody").append(html);

    }

    function get_flight(button) {
        let f_idx = $(button).closest("tr").children("td").find("select").val();
        
        let code_flight = $(button).closest("tr").children("td").find("select option:selected").text();

        if(f_idx == "all"){
            $(button).closest("tr").children("td").find("select option").each(function() {
                const value = $(this).val();
                const text = $(this).text();
                if(value != "all" && !check_flight(button, value)){   
                    add_flight(button, value, text);
                }
            });
        }else{
            if(!check_flight(button, f_idx)) {
                add_flight(button, f_idx, code_flight);
            }
        }

    }

    //product
    function del_product(button, cp_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        
        if(cp_idx){
            $.ajax({
                url: '/AdmMaster/_cars_category/delete_cars_price',
                type: "POST",
                data: { "cp_idx" : cp_idx },
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                }
                , success: function (response, status, request) {
                    alert(response.message);
                    if(response.result == true){
                        location.reload();
                    }

                    return;

                }
            });
        }

        $(button).closest("tr").remove();
    }

    function check_product(button, product_idx){
        let is_check = false;
        $(button).closest("tbody").find(".product_table tbody").children("tr").each(function() {
            let idx = $(this).data("product_idx");
            if(idx == product_idx){
                is_check = true;
            }
        });

        return is_check;
    }

    function add_product(button, product_idx, product_text) {
        let html = `
            <tr data-product_idx="${product_idx}" data-cp_idx="">
                <td>
                    <span>${product_text}</span>
                </td>
                <td>
                    <input type="text" class="onlynum init_price" style="text-align:right;" max-length="10" value="0">
                </td>
                <td>
                    <input type="text" class="onlynum sale_price" style="text-align:right;" max-length="10" value="0">
                </td>
                <td style="text-align: center;">
                    <button type="button" onclick="del_product(this, '')" class="btn_02">
                        삭제
                    </button>
                </td>
            </tr>
        `;

        $(button).closest("tbody").find(".product_table tbody").append(html);

    }

    function get_product(button) {
        let product_idx = $(button).closest("tr").children("td").find("select").val();
        
        let product_text = $(button).closest("tr").children("td").find("select option:selected").text();

        if(product_idx == "all"){
            $(button).closest("tr").children("td").find("select option").each(function() {
                const value = $(this).val();
                const text = $(this).text();
                if(value != "all" && !check_product(button, value)){   
                    add_product(button, value, text);
                }
            });
        }else{
            if(!check_product(button, product_idx)) {
                add_product(button, product_idx, product_text);
            }
        }

    }


    function init_price_all(checkbox) {
        if($(checkbox).is(':checked')){
            let price = $(checkbox).closest(".product_table").find(".init_price").first().val();
            console.log(price);
            
            $(checkbox).closest(".product_table").find(".init_price").val(price);
        }
    }

    function sale_price_all(checkbox) {
        if($(checkbox).is(':checked')){
            let price = $(checkbox).closest(".product_table").find(".sale_price").first().val();
            $(checkbox).closest(".product_table").find(".sale_price").val(price);
        }
    }

    // function add_depth_code(button, depthLevel) {

    //     const maxDepth = 4;

    //     if (depthLevel >= maxDepth) {
    //         alert('새 레벨을 추가할 수 없습니다. \n 레벨 제한이 4개에 도달했습니다!');
    //         return;
    //     }

    //     const parent = button.closest(`.depth_${depthLevel}`) || button.closest('.main_depth');
    //     if(!depthLevel){
    //         depthLevel = 0;
    //     }

    //     const newDepthLevel = depthLevel + 1;
    //     const newDepth = document.createElement('div');
    //     newDepth.className = `depth_${newDepthLevel}`;
    //     newDepth.style.paddingLeft = '20px';
    //     newDepth.innerHTML = `
    //         <div class="flex__c depth" style="gap: 20px;">
    //             옵션 ${newDepthLevel}
    //             <div class="flex__c" style="gap: 5px;">
    //                 <input type="text" class="ca_name" style="width:300px">
    //                 <button type="button" class="btn_02" onclick="remove_depth(this, ${newDepthLevel});">-</button>
    //                 <button type="button" class="btn_01" onclick="add_depth_code(this, ${newDepthLevel});">+</button>
    //             </div>
    //         </div>
    //     `;

    //     parent.appendChild(newDepth);
    // }

    // function remove_depth(button, depthLevel) {
    //     if (!confirm('이 레벨과 모든 하위 레벨을 삭제하시겠습니까?')) {
    //         return false;
    //     }

    //     const depthToRemove = button.closest(`.depth_${depthLevel}`);
    //     if (depthToRemove) {
    //         depthToRemove.remove();
    //     }
    // }

    function buildCategoryTree($container, depth) {
        const categories = [];

        $container.children('tbody').children('.child_category').each(function () {
            const $this = $(this);
            const code_no = $this.data("code");
            const $childrenContainer = $this.children('td').children(`.depth_${depth + 1}`);
            const ca_idx = $this.data("ca_idx");
            const parent_code = $container.closest(".child_category").data("code");
            const category = {
                ca_idx: ca_idx,
                code_no: code_no,
                depth: depth,
                children: []
            };

            category["product_arr"] = [];
            category["airline_arr"] = [];

            if(depth == 2 && parent_code == "5401" && parent_code){
                $childrenContainer.closest(".child_category").find(".airline_table .child_airline").each(function() {
                    let airline_idx = $(this).data("airline_idx");
                    let flight_arr = [];
                    $(this).find(".flight_table").find("tbody").find("tr").each(function() {
                        let f_idx = $(this).data("f_idx");
                        let cf_idx = $(this).data("cf_idx");
                        let flight = {
                            f_idx : f_idx,
                            cf_idx: cf_idx
                        };
                        flight_arr.push(flight);
                    });
                    category["airline_arr"].push({
                        "airline_idx" : airline_idx,
                        "flights" : flight_arr
                    });
                });
            }

            if ($childrenContainer.children('tbody').children('.child_category').length > 0) {
                
                category.children = buildCategoryTree($childrenContainer, depth + 1);
            }else{
                let product_arr = [];

                $childrenContainer.children('tbody').find('.product_table tbody tr').each(function() {

                    let init_price = $(this).find(".init_price").val();
                    let sale_price = $(this).find(".sale_price").val();
                    let product_idx = $(this).data("product_idx");
                    let cp_idx = $(this).data("cp_idx");

                    let product = {
                        cp_idx : cp_idx,
                        product_idx : product_idx,
                        init_price : init_price,
                        sale_price : sale_price
                    }
                    product_arr.push(product);
                });

                category["product_arr"] = product_arr;
            }


            categories.push(category);
        });

        return categories;
    }

    function send_it_c() {

        var frm = document.frm;

        const treeData = buildCategoryTree($('.depth_1'), 1);        

        // console.log(treeData);   

        if(frm.departure_code.value == ""){
            alert("출발지역 선택해주세요!");
            return false;
        }

        if(frm.destination_code.value == ""){
            alert("도착지역 선택해주세요!");
            return false;
        }

        if(treeData.length <= 0){
            alert("카테고리를 하나 이상 추가하세요.");
            return false;
        }

        var newInput = $('<input>').attr({
            type: 'hidden',
            name: 'category_data',
            value: JSON.stringify(treeData)
        });

        $("#frm").append(newInput);

        let url = "";
        <?php
            if(!empty($ca_idx)){
        ?> 
            url = '/AdmMaster/_cars_category/write_ok/' + <?=$ca_idx?>;
        <?php
            }else{
        ?>    
            url = '/AdmMaster/_cars_category/write_ok';
        <?php
            }
        ?>

        $.ajax({
            url: url,
            type: "POST",
            data: $("#frm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert(response.message);
                if(response.result == true){
                    if(response.exec == "update"){
                        window.location.reload();
                    }else{
                        window.location.href = '/AdmMaster/_cars_category/list';
                    }
                }

                return;

            }
        });

        // $("#frm").submit();
    }

    function del_it_c(url, ca_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: url,
            type: "POST",
            data: "ca_idx=" + ca_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                $("#ajax_loader").addClass("display-none");
                alert("정상적으로 삭제되었습니다.");
                window.location.href = '/AdmMaster/_cars_category/list';
                return;
            }
        });
    }
</script>
    <iframe width="0" height="0" name="hiddenFrame22" id="hiddenFrame22" style="display:none;"></iframe>
<?= $this->endSection() ?>