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
                        <!-- <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:50px;">
                            <tbody>
                                <tr height="45">
                                    <th>
                                        
                                    </th>
                                </tr> 
                                <tr height="45">
                                    <th>
                                        <div class="flex__c" style="gap: 20px; padding-left: 20px;">
                                            옵션 
                                            <div class="flex__c" style="gap: 5px;">
                                                <input type="text" name="moption_name" id="moption_name_154" value="옵션 1" style="width:300px">
                                                <button type="button" class="btn_02" onclick="">-</button>
                                                <button type="button" class="btn_01" onclick="">+</button>
                                            </div>
                                        </div>
                                    </th>
                                </tr>                
                            </tbody>
                        </table> -->
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