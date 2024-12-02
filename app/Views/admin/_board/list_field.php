<?php
$name = BBS_LIST_CONFIG[$code]['names'][$key];
$showType = BBS_LIST_CONFIG[$code]['showTypes'][$key];

$statusArr = [
    'Y' => '사용',
    'N' => '중지',
    'D' => '삭제'
]

?>

<?php if ($showType == "image"):
    $img = "/uploads/bbs/" . $info[$name];
    ?>
    <?php if ($img != '') { ?>
        <img src="<?= $img ?>" style="width:280px; height:100px;">
    <?php } else { ?>
        <p>No Image</p>
    <?php } ?>
<?php endif; ?>

<?php if ($showType == "input"): ?>
    <input type="text" name="<?= $name ?>[]" value="<?= $info[$name] ?>">
<?php endif; ?>

<?php if ($showType == ""): ?>
    <?php if ($name == "status") { ?>
        <?= $statusArr[$info[$name]] ?>
    <?php } else { ?>
        <?= $info[$name] ?>
    <?php } ?>
<?php endif; ?>