<?php
$name = BBS_WRITE_CONFIG[$code]['names'][$key];
$inputType = BBS_WRITE_CONFIG[$code]['inputTypes'][$key];
$width = BBS_WRITE_CONFIG[$code]['widths'][$key];

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
    <select name="<?= $name ?>" id="<?= $name ?>" style="width: <?= $width ?>">
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
        <br>파일삭제:
        <input type=checkbox name="del_<?=$fileIndex?>" value='Y'>
        <a href="/data/bbs/<?= $info[$name]?>"><?= $info["rfile$fileIndex"] ?></a>
    <?php } ?>
<?php endif; ?>

<?php if ($inputType == "duration"): ?>
    <input type="text" id="<?=$name[0]?>" name="<?=$name[0]?>" value='<?= $info[$name[0]] ?>' class="datepicker input_txt" style="width:110px;" rel="" style="width:98%" /> ~
    <input type="text" id="<?=$name[1]?>" name="<?=$name[1]?>" value='<?= $info[$name[1]] ?>' class="datepicker input_txt" style="width:110px" rel="" style="width:98%" />
<?php endif; ?>

<?php if ($inputType == "product_pickup"): ?>
    <?=view("admin/_board/product_pickup")?>
<?php endif; ?>