<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
    <div id="print_this">
        <!-- 인쇄영역 시작 //-->

        <header id="headerContainer">
            <div class="inner">
                <h2>
                    <?php
                        if($code == "banner" && $type == "main"){
                            echo "메인 관리";
                        }else{
                            echo $board_name;
                        }
                    ?>
                </h2>
                <div class="menus">
                    <ul class="first">
                        <li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), true)"
                               class="btn btn-success">전체선택</a></li>
                        <li><a href="javascript:CheckAll(document.getElementsByName('bbs_idx[]'), false)"
                               class="btn btn-success">선택해체</a></li>
                        <li><a href="javascript:SELECT_DELETE()" class="btn btn-danger">선택삭제</a></li>
                    </ul>
                    <ul class="last">
                        <?php if ($code == "banner" || $code == "event" || $code == "main_event" || $code == "awards") { ?>
                            <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                        <?php } ?>
                        <li>
                            <a href="/AdmMaster/_bbs/board_write?code=<?= esc($code) ?>&type=<?= esc($type) ?>&scategory=<?= esc($scategory) ?>"
                               class="btn btn-primary">
                                <span class="glyphicon glyphicon-pencil"></span>
                                <span class="txt">글 등록</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div id="contents">
            <form name="frmSearch" method="GET">
                <input type="hidden" name="code" value="<?= esc($code) ?>">
                <input type="hidden" name="type" value="<?= esc($type) ?>">
                <input type="hidden" name="scategory" value="<?= esc($scategory) ?>">
                <header id="headerContents" <?php if(isset($type) && $type != ""){ ?> style="display: flex; justify-content: space-between;" <?php } ?>>
                    <?php
                        if(isset($type) && $type != ""){
                    ?>     
                        <div class="menu_tab">
                            <a href="/AdmMaster/_tourSuggestion/list" class="btn btn_fil">상품관리</a>
                            <a href="/AdmMaster/_bbs/board_list?code=banner&type=main" class="btn btn_fil active">배너관리</a>
                        </div>   
                    <?php
                        }
                    ?>
                    <p>
                        <input type="radio" name="search_mode"
                               value="" <?php if ($search_mode == "") echo "checked"; ?>>
                        전체 &nbsp; &nbsp;
                        <input type="radio" name="search_mode"
                               value="subject" <?php if ($search_mode == "subject") echo "checked"; ?>> 제목 &nbsp; &nbsp;
                        <?php
                            if($code != "time_sale"){
                        ?>
                            <input type="radio" name="search_mode"
                                value="contents" <?php if ($search_mode == "contents") echo "checked"; ?>> 내용 &nbsp;
                        <?php
                            }
                        ?>
                        &nbsp;
                        <input type="radio" name="search_mode"
                               value="writer" <?php if ($search_mode == "writer") echo "checked"; ?>> 작성자 &nbsp; &nbsp;
                        <input type="text" name="search_word" value='<?= esc($search_word) ?>'
                               class="input_txt placeHolder" style="width:240px"/>

                        <a href="javascript:document.frmSearch.submit();" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                            <span class="txt">검색하기</span>
                        </a>
                    </p>
                    <div></div>
                </header>
            </form>

            <div class="listWrap">
                <div class="listTop flex_b_c" style="margin-bottom: 20px;">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= esc($nTotalCount) ?>개의 목록이 있습니다.</p>
                    </div>
                    <div class="">
                        <?php if ($is_category == "Y"): ?>
                            
                            <select name="category" class="input_select">
                                <option value="">선택</option>
                                <?php
                                    if($code == "tour" || $code == "infographics" || $code == "trip") {
                                ?>       
                                    <?php foreach ($code_list as $frow): ?>
                                        <option value="<?= $frow['code_idx'] ?>" <?= $frow['code_idx'] == $scategory ? 'selected' : '' ?>>
                                            <?= $frow['code_name'] ?>
                                        </option>
                                    <?php endforeach; ?> 
                                <?php
                                    }else{
                                ?>
                                    <?php foreach ($categories as $frow): ?>
                                        <option value="<?= $frow['tbc_idx'] ?>" <?= $frow['tbc_idx'] == $scategory ? 'selected' : '' ?>>
                                            <?= $frow['subject'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php
                                    }
                                ?>
                            </select>
                        <?php endif; ?>
                    </div>
                </div>


                <?php $skin = BBS_LIST_CONFIG[$code]['skin'];
                    if($skin == "list") {
                        echo $this->include('admin/_board/list1');
                    } else {
                        echo $this->include('admin/_board/photo');
                    }
                ?>

                <?= ipageListing($pg, $nPage, $g_list_rows, current_url() . "?scategory=$scategory&search_mode=$search_mode&search_word=$search_word&code=$code&type=$type&pg=") ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $("select[name='category']").change(function(){
            var cate = $(this).val();
            location.href = "?code=<?= $code ?>&type=<?= $type ?>&scategory=" + cate;
        });
    });
</script>

<script>
    function CheckAll(checkBoxes, checked) {
        var i;
        if (checkBoxes.length) {
            for (i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = checked;
            }
        } else {
            checkBoxes.checked = checked;
        }
    }

    function SELECT_DELETE() {

        var tmpChkCnt = $(".bbs_idx:checked").length;

        if (tmpChkCnt == 0) {
            alert("삭제할 게시물을 선택하셔야 합니다.");
            return;
        }
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: "<?= route_to('admin.api.bbs.bbs_del') ?>",
            type: "POST",
            data: $("#lfrm").serialize(),
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            },
            success: function (response, status, request) {
                alert_("정상적으로 삭제되었습니다.");
                setTimeout(function () {
                    location.reload();
                }, 1000);
                return;
            }
        });
    }


    function del_it(bbs_idx) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: "<?= route_to('admin.api.bbs.bbs_del') ?>",
            type: "POST",
            data: "bbs_idx[]=" + bbs_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            },
            success: function (response, status, request) {
                alert_("정상적으로 삭제되었습니다.");
                setTimeout(function () {
                    location.reload();
                }, 1000);
                return;
            }
        });


    }

    function change_it() {
        var f = document.lfrm;

        var banner_data = $(f).serialize();
        var save_result = "";
        $.ajax({
            type: "POST",
            data: banner_data,
            url: "<?= route_to('admin.api.bbs.bbs_change') ?>",
            cache: false,
            async: false,
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
<?= $this->endSection() ?>
