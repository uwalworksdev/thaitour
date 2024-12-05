<?php

$codeModel = new \App\Models\Code();

$code1List = $codeModel->getCodesByGubunDepthAndStatusExclude('tour', '2', ['1308', '1309']);

$code2List = $codeModel->getCodesByParentCodeAndStatus($product_code_1, '3');

$code3List = $codeModel->getCodesByParentCodeAndStatus($product_code_2, '4');

?>
<select id="product_code_1" name="product_code_1" class="input_select" onchange="javascript:get_code(this.value, 3)">
    <option value="">1차분류</option>
    <?php foreach ($code1List as $frow) {
        $status_txt = "";
        if ($frow["status"] == "Y") {
            $status_txt = "";
        } elseif ($frow["status"] == "N") {
            $status_txt = "[삭제]";
        } elseif ($frow["status"] == "C") {
            $status_txt = "[마감]";
        } ?>
        <option value="<?= $frow["code_no"] ?>" <?php if ($product_code_1 == $frow["code_no"]) { echo "selected"; } ?>>
            <?= $frow["code_name"] ?> <?= $status_txt ?>
        </option>
    <?php } ?>
</select>
<select id="product_code_2" name="product_code_2" class="input_select" onchange="javascript:get_code(this.value, 4)">
    <option value="">2차분류</option>
    <?php foreach ($code2List as $frow) {
        $status_txt = "";
        if ($frow["status"] == "Y") {
            $status_txt = "";
        } elseif ($frow["status"] == "N") {
            $status_txt = "[삭제]";
        } elseif ($frow["status"] == "C") {
            $status_txt = "[마감]";
        }
        ?>
        <option value="<?= $frow["code_no"] ?>" <?php if ($product_code_2 == $frow["code_no"]) { echo "selected"; } ?>>
            <?= $frow["code_name"] ?> <?= $status_txt ?>
        </option>
    <?php } ?>
</select>
<select id="product_code_3" name="product_code_3" class="input_select">
    <option value="">3차분류</option>
    <?php 
    foreach ($code3List as $frow) {
        $status_txt = "";
        if ($frow["status"] == "Y") {
            $status_txt = "";
        } elseif ($frow["status"] == "N") {
            $status_txt = "[삭제]";
        } elseif ($frow["status"] == "C") {
            $status_txt = "[마감]";
        } ?>
        <option value="<?= $frow["code_no"] ?>" <?php if ($product_code_3 == $frow["code_no"]) { echo "selected"; } ?>>
            <?= $frow["code_name"] ?> <?= $status_txt ?>
        </option>
    <?php } ?>
</select>
<script>
    function get_code(strs, depth) {
        $.ajax({
            type: "GET"
            , url: "/ajax/get_code"
            , dataType: "html" //전송받을 데이터의 타입
            , timeout: 30000 //제한시간 지정
            , cache: false  //true, false
            , data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
            , error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , success: function (json) {
                //alert(json);
                if (depth <= 3) {
                    $("#product_code_2").find('option').each(function () {
                        $(this).remove();
                    });
                    $("#product_code_2").append("<option value=''>2차분류</option>");
                }
                if (depth <= 4) {
                    $("#product_code_3").find('option').each(function () {
                        $(this).remove();
                    });
                    $("#product_code_3").append("<option value=''>3차분류</option>");
                }
                if (depth <= 4) {
                    $("#product_code_4").find('option').each(function () {
                        $(this).remove();
                    });
                    $("#product_code_4").append("<option value=''>4차분류</option>");
                }
                var list = $.parseJSON(json);
                var listLen = list.length;
                var contentStr = "";
                for (var i = 0; i < listLen; i++) {
                    contentStr = "";
                    if (list[i].code_status == "C") {
                        contentStr = "[마감]";
                    } else if (list[i].code_status == "N") {
                        contentStr = "[사용안함]";
                    }
                    $("#product_code_" + (parseInt(depth) - 1)).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
                }
            }
        });
    }
</script>