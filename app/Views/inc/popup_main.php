<style>
    @media screen and (max-width : 850px) {
        .apDiv {
            top: 7.6923rem !important;
            left: 0 !important;
            width: 100% !important;
            height: unset !important;
        }

        .apDiv table {
            width: 100%;
        }
    }

    @media screen and (min-width : 851px) and (max-width : 1350px) {
        .apDiv {
            left: 50% !important;
            transform: translateX(-50%);
        }
    }

    .apDiv img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<script language="JavaScript">
    // 이부분부터  수정할 필요 없습니다. 
    function getCookie(name) {
        var Found = false
        var start, end
        var i = 0

        while (i <= document.cookie.length) {
            start = i
            end = start + name.length

            if (document.cookie.substring(start, end) == name) {
                Found = true
                break
            }
            i++
        }

        if (Found == true) {
            start = end + 1
            end = document.cookie.indexOf(";", start)
            if (end < start)
                end = document.cookie.length
            return document.cookie.substring(start, end)
        }
        return ""
    }

    function setCookie(name, value, expiredays) {
        var todayDate = new Date();
        todayDate.setDate(todayDate.getDate() + expiredays);
        document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
    }

    function closeWin(Divpop) {
        document.getElementById('apDiv' + Divpop).style.visibility = "hidden";
        setCookie("maindivapDiv" + Divpop, "done", 1);
    }

    function closePopup(Divpop) {
        document.getElementById('apDiv' + Divpop).style.visibility = "hidden";
    }

    function openPopup() {
        cookiedata = document.cookie;
        <?php foreach ($popups as $row) {
            $popup = json_decode($row["r_open"]);
            ?>
            if (cookiedata.indexOf("maindivapDiv<?= $row["r_idx"] ?>=done") < 0) {
                <?php if ($row["r_close"] == "today") { ?>
                    document.getElementById('apDiv<?= $row["r_idx"] ?>').style.visibility = "hidden";
                <?php } else if ($row["r_close"] == "never") { ?>
                        document.getElementById('apDiv<?= $row["r_idx"] ?>').style.visibility = "hidden";
                <?php } else { ?>
                        document.getElementById('apDiv<?= $row["r_idx"] ?>').style.visibility = "visible";
                <?php } ?>
            } else {
                document.getElementById('apDiv<?= $row["r_idx"] ?>').style.visibility = "hidden";
            }
            <?php
        }
        ?>
    }
</script>

<?php foreach ($popups as $row) {
    $popup = json_decode($row["r_open"]);
?>
    <div class="apDiv" id="apDiv<?= $row["r_idx"] ?>"
        style="position:absolute; left:<?= $popup->left ?>px; top:<?= $popup->top ?>px; width:<?= $popup->width ?>px; height:<?= $popup->height ?>px; z-index:999999; visibility: hidden;">
        <table border="0" cellspacing="0" cellpadding="0" bgcolor=ffffff style="width: 100%;table-layout:fixed">
            <tr <?php if ($row["r_url"]) { ?>
                    onclick="javascript:<?php if ($row['r_status'] == 'Y') { ?>window.open('<?= $row['r_url'] ?>')<?php } else { ?>location.href='<?= $row['r_url'] ?>'<?php } ?>"
                    style="cursor:pointer;" <?php } ?>>
                <td><?= viewSQ($row["r_content"]) ?></td>
            </tr>
            <form name="frm" id="frm<?= $row["r_idx"] ?>" style="margin:0px">
                <tr bgcolor=333333 height=25 align=center>
                    <td style="height: 3em;">
                        <div style="display: flex;">
                            <a style="flex: 1;border-right: #FFFFFF 1px solid"
                                onClick="javascript:closeWin('<?= $row["r_idx"] ?>')" href="#"><span class="style1"
                                    style="color: #FFFFFF">오늘 하루 열지 않기</span></a>
                            <a style="flex: 1;" onClick="javascript:closePopup('<?= $row["r_idx"] ?>')" href="#"><span
                                    class="style1" style="color: #FFFFFF">닫기</span></a>
                        </div>
                    </td>
                </tr>
            </form>
        </table>
    </div>
<?php } ?>
<script>
    openPopup();
</script>