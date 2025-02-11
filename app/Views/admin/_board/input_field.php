<?php
$name = BBS_WRITE_CONFIG[$code]['names'][$key];
$inputType = BBS_WRITE_CONFIG[$code]['inputTypes'][$key];
$width = BBS_WRITE_CONFIG[$code]['widths'][$key];

$banner["titles"][4] = "xxxxxxxxxxx";
?>

<?php if ($inputType == "text"): ?>
    <input type="text" name="<?= $name ?>" value="<?= $info[$name] ?>" style="width: <?= $width ?>">
<?php endif; ?>

<?php if ($inputType == "checkbox"): ?>
    <input type="checkbox" name="<?= $name ?>" <?= $info[$name] == "Y" ? "checked" : "" ?> style="width: <?= $width ?> ">
<?php endif; ?>

<?php if ($inputType == "summernote"): ?>
    <textarea name="<?= $name ?>" id="<?= $name ?>_" rows="10" cols="100" class="input_txt"
        style="width:100%; height:412px; display:none;"><?= $info[$name] ?></textarea>
    <script type="text/javascript">
        if(typeof oEditors == "undefined") {
            var oEditors = [];
        }

        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "<?= $name ?>_",
            sSkinURI: "/lib/smarteditor/SmartEditor2Skin.html",
            htParams: {
                bUseToolbar: true, // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseVerticalResizer: true, // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseModeChanger: true, // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                fOnBeforeUnload: function () {
                    //alert("완료!");
                }
            }, //boolean
            fCreator: "createSEditor2"
        });
    </script>
<?php endif; ?>

<?php if ($inputType == "select"): ?>
    <select name="<?= $name ?>" id="<?= $name ?>" style="width: <?= $width ?>" onchange="select_cate(this.value);">
        <option value="">선택</option>
        <?php if($name == "category") { ?>
            <?php foreach ($list_category as $frow) {
                ?>
                <option value="<?= $frow["tbc_idx"] ?>" <?= ($frow["tbc_idx"] == $info[$name]) ? "selected" : ""?> >
                    <?= $frow["subject"] ?>
                </option>
            <?php
            }
        } else if($name == "status") { ?>
            <option value="Y" <?= ($info[$name] == "Y") ? "selected" : ""?> >사용</option>
            <option value="N" <?= ($info[$name] == "N") ? "selected" : ""?> >중지</option>
        <?php } ?>
    </select>
<?php endif; ?>

<?php if ($inputType == "files"): ?>
    <input type="file" name="<?= $name ?>" />
    <?php if ($info[$name]) {
        if(strpos($name, "ufile") !== false) {
            $fileIndex = str_replace("ufile", "", $name);
        }
        ?>
        <?php
            if($code != "time_sale"){
        ?>
            <br>파일삭제:
            <input type=checkbox name="del_<?=$fileIndex?>" value='Y'>
            <a href="/data/bbs/<?= $info[$name]?>"><?= $info["rfile$fileIndex"] ?></a>
        <?php
            }else{
        ?>
            <br>이미지삭제:
            <input type=checkbox name="del_<?=$fileIndex?>" value='Y'>
            <a href="/data/bbs/<?= $info[$name]?>">
                <img src="/data/bbs/<?= $info[$name]?>" alt="<?= $info["rfile$fileIndex"] ?>">
            </a>
        <?php
            }
        ?>
    <?php } ?>
<?php endif; ?>

<?php if ($inputType == "duration"): ?>
    <input type="text" id="<?=$name[0]?>" name="<?=$name[0]?>" value='<?= $info[$name[0]] ?>' class="datepicker input_txt" style="width:110px;" rel="" style="width:98%" /> ~
    <input type="text" id="<?=$name[1]?>" name="<?=$name[1]?>" value='<?= $info[$name[1]] ?>' class="datepicker input_txt" style="width:110px" rel="" style="width:98%" />
<?php endif; ?>

<?php if ($inputType == "time_sale"): ?>
    <input type="text" id="date_sale_start" name="<?=$name[0]?>" value='<?= $info[$name[0]] ?>' class="input_txt" style="width:110px;" readonly/>
    <input type="time" id="time_sale_start" name="<?=$name[1]?>" value='<?= $info[$name[1]] ?>' class="input_txt" style="width:90px;"/>
    ~
    <input type="text" id="date_sale_end" name="<?=$name[2]?>" value='<?= $info[$name[2]] ?>' class="input_txt" style="width:110px" readonly/>
    <input type="time" id="time_sale_end" name="<?=$name[3]?>" value='<?= $info[$name[3]] ?>' class="input_txt" style="width:90px;"/>
<?php endif; ?>

<?php if ($inputType == "product_pickup"): ?>
    <?=view("admin/_board/product_pickup")?>
<?php endif; ?>

<script>
function select_cate(cate)
{
         //alert(cate);	
}	
</script>

<script>
    $(function () {
        $("#date_sale_start").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "both",
            buttonImage: "/images/admin/common/date.png",
            buttonImageOnly: true,
            closeText: '닫기',
            currentText: '오늘',
            prevText: '이전',
            nextText: '다음',
            yearRange: "c:c+10",
            minDate: new Date(),
            maxDate: "+99Y",
            onClose: function (selectedDate) {
                $("#date_sale_end").datepicker("option", "minDate", selectedDate);
            },
            beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
        });


        $("#date_sale_end").datepicker({
            showButtonPanel: true
            , onClose: function (selectedDate) {
                // To 날짜 선택기의 최소 날짜를 설정
                $("#date_sale_start").datepicker("option", "maxDate", selectedDate);
            }
            , beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
            , dateFormat: 'yy-mm-dd'
            , showOn: "both"
            , yearRange: "c:c+30"
            , buttonImage: "/images/admin/common/date.png"
            , buttonImageOnly: true
            , closeText: '닫기'
            , currentText: '오늘' // 오늘 버튼 텍스트 설정
            , prevText: '이전'
            , nextText: '다음'
            , minDate: new Date() 
            , maxDate: "+99Y"
        });
    });
</script>