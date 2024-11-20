<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<div id="container">
    <div id="print_this"><!-- 인쇄영역 시작 //-->

        <header id="headerContainer">

            <div class="inner">
                <h2>숙소정보 리스트</h2>
                <div class="menus">
                    <ul class="first">
                    </ul>

                    <ul class="last">
                        <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                        <li><a href="write" class="btn btn-primary"><span
                                        class="glyphicon glyphicon-pencil"></span> <span
                                        class="txt">숙박 등록</span></a></li>
                    </ul>

                </div>

            </div><!-- // inner -->

        </header><!-- // headerContainer -->

        <div id="contents">
            <form name="search" id="search">
                <header id="headerContents">
                    <select id="country_code_1" name="s_country_code_1" class="input_select"
                            onchange="javascript:document.search.submit();">
                        <option value="">1차분류</option>
                        <?php
                        foreach ($fresult as $frow):
                            $status_txt = "";
                            if ($frow["status"] == "Y") {
                                $status_txt = "";
                            } elseif ($frow["status"] == "N") {
                                $status_txt = "[삭제]";
                            } elseif ($frow["status"] == "C") {
                                $status_txt = "[마감]";
                            }

                            ?>
                            <option value="<?= $frow["code_no"] ?>" <?php if ($s_country_code_1 == $frow["code_no"]) {
                                echo "selected";
                            } ?> >
                                <?= $frow["code_name"] ?> <?= $status_txt ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                    <select id="country_code_2" name="s_country_code_2" class="input_select"
                            onchange="javascript:document.search.submit();">
                        <option value="">2차분류</option>
                        <?php
                        foreach ($fresult2 as $frow):
                            $status_txt = "";
                            if ($frow["status"] == "Y") {
                                $status_txt = "";
                            } elseif ($frow["status"] == "N") {
                                $status_txt = "[삭제]";
                            } elseif ($frow["status"] == "C") {
                                $status_txt = "[마감]";
                            }

                            ?>
                            <option value="<?= $frow["code_no"] ?>" <?php if ($s_country_code_2 == $frow["code_no"]) {
                                echo "selected";
                            } ?> >
                                <?= $frow["code_name"] ?> <?= $status_txt ?>
                            </option>
                        <?php endforeach ?>

                    </select>
                    <select id="" name="search_category" class="input_select" style="width:112px">
                        <option value="stay_name_eng" <?php if ($search_category == "stay_name_eng") {
                            echo "selected";
                        } ?> >
                            숙소영문명
                        </option>
                        <option value="stay_name_kor" <?php if ($search_category == "stay_name_kor") {
                            echo "selected";
                        } ?> >
                            숙소국문명
                        </option>
                        <option value="stay_user_name" <?php if ($search_category == "stay_user_name") {
                            echo "selected";
                        } ?> >
                            담당자
                        </option>
                        <option value="stay_contents" <?php if ($search_category == "stay_contents") {
                            echo "selected";
                        } ?> >
                            내용
                        </option>
                    </select>


                    <input type="text" id="" name="search_name" value="<?= $search_name ?>"
                           class="input_txt placeHolder" placeholder="검색어 입력" style="width:240px"/>

                    <a href="javascript:search_it()" class="btn btn-default"><span
                                class="glyphicon glyphicon-search"></span> <span class="txt">검색하기</span></a>
                </header><!-- // headerContents -->
            </form>
            <script>
                function change_it() {
                    let url = "<?= route_to('admin.api.tour_stay.ajax_change') ?>";
                    let frm = document.frm;

                    let stay_data = $(frm).serialize();
                    $.ajax({
                        type: "POST",
                        data: stay_data,
                        url: url,
                        cache: false,
                        async: false,
                        success: function (data, textStatus) {
                            alert(data.message);
                            location.reload();
                        },
                        error: function (request, status, error) {
                            alert("code = " + request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                        }
                    });
                }

                function search_it() {
                    let frm = document.search;
                    if (frm.search_name.value == "검색어 입력") {
                        frm.search_name.value = "";
                    }
                    frm.submit();
                }
            </script>

            <div class="listWrap">
                <!-- 안내 문구 필요시 구성 //-->

                <div class="listTop">
                    <div class="left">
                        <p class="schTxt">■ 총 <?= $nTotalCount ?>개의 목록이 있습니다.</p>
                    </div>

                </div><!-- // listTop -->


                <form name="frm" id="frm">
                    <div class="listBottom">
                        <table cellpadding="0" cellspacing="0" summary="" class="listTable">
                            <caption></caption>
                            <colgroup>
                                <col width="50px"/>
                                <col width="120px"/>
                                <col width="200px"/>
                                <col width="150px"/>
                                <col width="*"/>
                                <col width="*"/>
                                <col width="100px"/>
                                <col width="120px"/>
                                <!-- <col width="120px" /> -->
                                <col width="170px"/>
                                <col width="100px"/>
                            </colgroup>
                            <thead>
                            <tr>
                                <th>번호</th>
                                <th>호텔코드</th>
                                <th>숙소유형/해당도시</th>
                                <th>썸네일이미지</th>
                                <th>숙소영문명</th>
                                <th>숙소국문명</th>
                                <th>순위</th>
                                <th>숙소등급</th>
                                <!-- <th>담당자</th> -->
                                <th>등록일</th>
                                <th>관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($result as $row):
                                ?>
                                <tr style="height:50px">
                                    <td><?= $num-- ?></td>
                                    <td class="tac"><?= $row["code_no"] ?></td>
                                    <td class="tac">호텔
                                        <br><strong
                                                style="color:blue"><?= $row["stay_city"] . " " . $row["country_name_2"] ?></strong>
                                    </td>
                                    <td class="tac">
                                        <? if ($row["ufile1"] != "") { ?>
                                            <a href="/uploads/products/<?= $row["ufile1"] ?>" class="imgpop"><img
                                                        src="/uploads/products/<?= $row["ufile1"] ?>"
                                                        style="max-width:150px"></a>
                                        <? } ?>
                                    </td>
                                    <td class="tal" style="font-weight:bold">
                                        <a href="write?s_country_code_1=<?= $s_country_code_1 ?>&s_country_code_2=<?= $s_country_code_2 ?>&s_country_code_2=<?= $s_country_code_3 ?>&search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>&stay_idx=<?= $row["stay_idx"] ?>"><?= $row["stay_name_eng"] ?></a>

                                    </td>
                                    <td class="tac">
                                        <a href="write?s_country_code_1=<?= $s_country_code_1 ?>&s_country_code_2=<?= $s_country_code_2 ?>&s_country_code_2=<?= $s_country_code_3 ?>&search_category=<?= $search_category ?>&search_name=<?= $search_name ?>&pg=<?= $pg ?>&stay_idx=<?= $row["stay_idx"] ?>"><?= $row["stay_name_kor"] ?></a>
                                    </td>
                                    <td>
                                        <input type="text" name="onum[]" id="onum_<?= $row["stay_idx"] ?>"
                                               value="<?= $row["onum"] ?>" style="width:66px;">
                                        <input type="hidden" name="stay_idx[]" value="<?= $row["stay_idx"] ?>"
                                               class="input_txt">
                                    </td>
                                    <td class="tac">
                                        <?
                                        for ($i = 1; $i <= floor($row["stay_level"]); $i++) {
                                            echo '★';
                                        }

                                        // Check for decimal part and add a half-star if needed
                                        $decimalPart = $row["stay_level"] - floor($row["stay_level"]);
                                        if ($decimalPart == 0.5) {
                                            echo '✭';
                                        }
                                        ?>
                                    </td>
                                    <!-- <td class="tac"><?= $row["stay_user_name"] ?></td> -->
                                    <td>
                                        <?= $row["stay_r_date"] ?>
                                    </td>
                                    <td>
                                        <a href="javascript:del_it('<?= $row["stay_idx"] ?>');"><img
                                                    src="/images/admin/common/ico_error.png" alt="삭제"/></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                            </tbody>
                        </table>
                    </div><!-- // listBottom -->
                </form>

                <?= ipageListing($pg, $nPage, $g_list_rows, site_url('/AdmMaster/_tourStay/list') . $search_val . "&pg=") ?>

                <div id="headerContainer">

                    <div class="inner">
                        <div class="menus">
                            <ul class="first">
                            </ul>

                            <ul class="last">
                                <li><a href="write" class="btn btn-primary"><span
                                                class="glyphicon glyphicon-pencil"></span> <span
                                                class="txt">숙박 등록</span></a></li>
                                <li><a href="javascript:change_it()" class="btn btn-success">순위변경</a></li>
                            </ul>

                        </div>

                    </div><!-- // inner -->

                </div><!-- // headerContainer -->
            </div><!-- // listWrap -->

        </div><!-- // contents -->


    </div><!-- 인쇄 영역 끝 //-->
</div><!-- // container -->

<script>
    function del_it(stay_idx) {

        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
            return;
        }
        $("#ajax_loader").removeClass("display-none");
        $.ajax({
            url: "<?= route_to('admin.api.tour_stay.del') ?>",
            type: "POST",
            data: "stay_idx[]=" + stay_idx,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                // if (response == "OK")
                // {
                console.log(response);
                alert_("정상적으로 삭제되었습니다.");
                location.reload();
                // } else {
                // 	alert(response);
                // 	alert_("오류가 발생하였습니다!!");
                // 	return;
                // }
            }
        });

    }
</script>
<?= $this->endSection() ?>
