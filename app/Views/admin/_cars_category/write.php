<?php
    $formAction = $ca_idx ? "/AdmMaster/_cars_category/write_ok/$ca_idx" : "/AdmMaster/_cars_category/write_ok";
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
    }
</style>
<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js"></script>
<script type="text/javascript" src="/js/admin/tours/write.js"></script>

<?php
    $titleStr = "차량 정보관리";
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
                                <a href="javascript:del_it_c(`<?= route_to("admin._cars_category.del") ?>`, `<?= $ca_idx ?>`)"
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
                                        <select id="departure_name" name="departure_name" class="input_select">
                                            <option value="">선택</option>
                                            <?php
                                                foreach($place_start_list as $code){
                                            ?>
                                                <option value="<?=$code["code_name"]?>"><?=$code["code_name"]?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>

                                    <th>도착지역</th>
                                    <td colspan="3">
                                        <select id="destination_name" name="destination_name" class="input_select">
                                            <option value="">선택</option>
                                            <?php
                                                foreach($place_end_list as $code){
                                            ?>
                                                <option value="<?=$code["code_name"]?>"><?=$code["code_name"]?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>   
                            
                            </tbody>
                        </table>
                         
                        <table cellpadding="0" cellspacing="0" class="listTable mem_detail" style="margin-top:50px;">
                            <colgroup>
                                <col width="15%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                                <tr height="45">
                                    <th>카테고리 선택 1</th>
                                    <td>
                                        <select name="category_code_1" class="input_select category_code_1">
                                            <option value="all">선택</option>
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

                        <div class="main_depth">
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
                        </div>
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
                                <a href="javascript:del_it_c(`<?= route_to("admin._cars_category.del") ?>`, `<?= $ca_idx ?>`)"
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

    var tree_codes = <?=json_encode($tree_codes)?>;
                                  
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
                <tr height="45" class="child_category" data-code="${code}">
                    <th>
                        <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
                            ${text}
                            <button type="button" onclick="del_category(this)" class="btn_02">삭제</button>
                        </div>
                    </th>
                    <td>
                    <table cellpadding="0" cellspacing="0" class="listTable mem_detail">
                        <colgroup>
                            <col width="15%"/>
                            <col width="90%"/>
                        </colgroup>
                        <tbody>
    
                            <tr height="45">
                                <th>카테고리 선택 ${depth + 1}</th>
                                <td>
                                    <select name="category_code_${depth + 1}" class="input_select category_code_${depth + 1}">
                                        <option value="all">선택</option>`;
                filteredData.forEach(data => {
                    html += `<option value="${data["code_no"]}">${data["code_name"]}</option>`;
                });                    
                html +=             `</select>
                                    <button type="button" onclick="get_depth_category(this, ${depth + 1})" class="btn_01">추가</button>
                                </td>
                            </tr>
    
                        </tbody>
                    </table>
                    </td>
                </tr>`;
            $(button).closest("tbody").append(html);

    }

    function get_depth_category(button, depth) {
        let code = $(button).closest("tr").children("td").find("select").val();
        
        let selectedText = $(button).closest("tr").children("td").find("select option:selected").text();
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
                add_depth_category(button, depth, code, selectedText);
            }
        }
    }

    function del_category(button) {
        $(button).closest(".child_category").remove();
    }

    function add_depth_code(button, depthLevel) {

        const maxDepth = 4;

        if (depthLevel >= maxDepth) {
            alert('새 레벨을 추가할 수 없습니다. \n 레벨 제한이 4개에 도달했습니다!');
            return;
        }

        const parent = button.closest(`.depth_${depthLevel}`) || button.closest('.main_depth');
        if(!depthLevel){
            depthLevel = 0;
        }

        const newDepthLevel = depthLevel + 1;
        const newDepth = document.createElement('div');
        newDepth.className = `depth_${newDepthLevel}`;
        newDepth.style.paddingLeft = '20px';
        newDepth.innerHTML = `
            <div class="flex__c depth" style="gap: 20px;">
                옵션 ${newDepthLevel}
                <div class="flex__c" style="gap: 5px;">
                    <input type="text" class="ca_name" style="width:300px">
                    <button type="button" class="btn_02" onclick="remove_depth(this, ${newDepthLevel});">-</button>
                    <button type="button" class="btn_01" onclick="add_depth_code(this, ${newDepthLevel});">+</button>
                </div>
            </div>
        `;

        parent.appendChild(newDepth);
    }

    function remove_depth(button, depthLevel) {
        if (!confirm('이 레벨과 모든 하위 레벨을 삭제하시겠습니까?')) {
            return false;
        }

        const depthToRemove = button.closest(`.depth_${depthLevel}`);
        if (depthToRemove) {
            depthToRemove.remove();
        }
    }

    function buildCategoryTree($container, depth) {
        const categories = [];

        $container.children('.depth').each(function () {
            const $this = $(this);

            const ca_name = $this.find('.ca_name').val();

            const $childrenContainer = $this.nextAll(`.depth_${depth + 1}`);

            const category = {
                ca_name: ca_name.trim(),
                depth: depth,
                children: []
            };

            if ($childrenContainer.length > 0) {
                
                category.children = buildCategoryTree($childrenContainer, depth + 1);
            }

            categories.push(category);
        });

        return categories;
    }

    function send_it_c() {

        var frm = document.frm;

        const treeData = buildCategoryTree($('.depth_1'), 1);

        if(frm.departure_name.value == ""){
            alert("출발지역 선택해주세요!");
            return false;
        }

        if(frm.destination_name.value == ""){
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

        $.ajax({
            url: '/AdmMaster/_cars_category/write_ok',
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
                    window.location.href = '/AdmMaster/_cars_category/list';
                }

                return;

            }
        });

        // $("#frm").submit();
    }

    function del_it_c(url, g_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: url,
            type: "POST",
            data: "g_idx[]=" + g_idx,
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