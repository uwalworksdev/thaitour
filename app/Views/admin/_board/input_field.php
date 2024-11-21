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
        } ?>
    </select>
<?php endif; ?>

<?php if ($inputType == "files"): ?>
    <input type="file" name="<?= $name ?>" />
    <?php if ($info[$name]) { ?>
        <br>파일삭제:
        <input type=checkbox name="del_<?= $i ?>" value='Y'>
        <a href="/data/bbs/"><?= $info[$name] ?></a>
    <?php } ?>
<?php endif; ?>