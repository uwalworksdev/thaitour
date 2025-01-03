<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>

<link rel="stylesheet" href="./assets/css/write.css">
<script src="/lib/summernote/summernote-lite.js"></script>
<script src="/lib/summernote/lang/summernote-ko-KR.js"></script>
<link rel="stylesheet" href="/lib/summernote/summernote-lite.css">
<script>
    $(function () {
        $.datepicker.regional['ko'] = {
            showButtonPanel: true,
            beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            },
            closeText: '닫기',
            prevText: '이전',
            nextText: '다음',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            weekHeader: 'Wk',
            dateFormat: 'yy-mm-dd',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: true,
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear: true,
            closeText: '닫기',  // 닫기 버튼 패널
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['ko']);

        $(".datepicker").datepicker({
            showButtonPanel: true
            , beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                    var btn = $('<BUTTON class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</BUTTON>');
                    btn.unbind("click").bind("click", function () {
                        $.datepicker._clearDate(input);
                    });
                    btn.appendTo(buttonPane);
                }, 1);
            }
            , dateFormat: 'yy-mm-dd'
            , showOn: "both"
            , yearRange: "c-100:c+10"
            , buttonImage: "/img/ico/date_ico.png"
            , buttonImageOnly: true
            , closeText: '닫기'
            , prevText: '이전'
            , nextText: '다음'
            // ,minDate: 1
            <?php if ($str_guide != "") { ?>
            , beforeShowDay: function (date) {

                var day = date.getDay();
                return [(<?=$str_guide?>)];

            }
            <?php } ?>


        });
        $('img.ui-datepicker-trigger').css({'cursor': 'pointer'});
        $('input.hasDatepicker').css({'cursor': 'pointer'});
        $(".datepicker").datepicker("option", "maxDate", "<?=$guide_e_date?>");
    });


</script>

<?php
$titleStr = "여행후기";
if ($row) {
    $user_name = sqlSecretConver($row["user_name"], 'decode');
    if (isset($row["user_phone"])) {
        $user_phone = sqlSecretConver($row["user_phone"], 'decode');
    }
    $user_email = sqlSecretConver($row["user_email"], 'decode');

    $status = $row["status"];
    $is_best = $row["is_best"];
    $ufile1 = $row["ufile1"];
    $rfile1 = $row["rfile1"];
    $ufile2 = $row["ufile2"];
    $rfile2 = $row["rfile2"];
    $r_date = $row["r_date"];
    $travel_type = $row["travel_type"];
    $travel_type_2 = $row['travel_type_2'];
    $travel_type_3 = $row['travel_type_3'];
    $product_idx = $row['product_idx'];
    $title = $row['title'];
    $contents = $row["contents"];
    $display = $row["display"];
    $idx = $row["idx"];
    $number_stars = $row["number_stars"];
    $review_type = $row["review_type"];
    // echo $product_idx;
}
?>
<script type="text/javascript">
    function checkForNumber(str) {
        var key = event.keyCode;
        var frm = document.frm1;
        if (!(key == 8 || key == 9 || key == 13 || key == 46 || key == 144 ||
            (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190)) {
            event.returnValue = false;
        }
    }

    function send_it() {

        const formData = new FormData($('#frm')[0]);

        if ($("#is_best").attr("checked")) {
            formData.set("is_best", "Y")
        } else {
            formData.set("is_best", "N")
        }

        if ($("#display").attr("checked")) {
            formData.set("display", "Y")
        } else {
            formData.set("display", "N")
        }

        $.ajax({
            url: "/review/review_write_ok",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: () => {
                window.location.href = "/AdmMaster/_review/list";
            }
        })
    }
</script>


<div id="container"> <span id="print_this"><!-- 인쇄영역 시작 //-->
	
	<header id="headerContainer">
		<div class="inner">
			<h2><?= $titleStr ?></h2>
			<div class="menus">
				<ul>
					<li><a href="/AdmMaster/_review/list" class="btn btn-default"><span
                                    class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
					<?php if ($row) { ?>
                        <li><a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a></li>
                        <li><a href="javascript:del_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a></li>
                    <?php } else { ?>
                        <li><a href="javascript:send_it()" class="btn btn-default"><span
                                        class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a></li>
                    <?php } ?>
					
				</ul>
			</div>
		</div>
        <!-- // inner -->
		
	</header>
        <!-- // headerContainer -->
	
<form name=frm id="frm" action="/review/review_write_ok" method=post target="hiddenFrame">

	<input type=hidden name="idx" value='<?= $idx ?>'>
	<input type="hidden" id="role" name="role" value="admin">
	<input type="hidden" id="number_stars" name="number_stars" value="<?= $number_stars ?>">
	<input type="hidden" id="review_type" name="review_type" value="<?= $review_type ?>">

	<div id="contents">
		<div class="listWrap_noline">
				
			
			<div class="listBottom">
				<table cellpadding="0" cellspacing="0" summary="" id="table_form_online_quote"
                       class="listTable mem_detail">
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
							<th>현황</th>
							<td>
								<select name="status">
									<option value="Y" <?php if ($status == "Y") {
                                        echo "selected";
                                    } ?>>승인</option>
                                    <!-- <option value="Y" <?php if ($status == "Y") {
                                        echo "selected";
                                    } ?>>상담완료</option> -->
									<option value="N" <?php if ($status == "N") {
                                        echo "selected";
                                    } ?>>미승인</option>
								</select>
							</td>
							<?php if ($row) { ?>
                                <th>게시날짜</th>
                                <td><input type="text" value="<?= date('Y-m-d H:i:s', strtotime($r_date)) ?>"
                                           name="r_date" id="r_date"></td>
                            <?php } ?>
						</tr>
						<tr>
							<th>베스트</th>
								<td>
									<input type="checkbox" name="is_best"
                                           id="is_best" <?= ($is_best == "Y" ? "checked" : "") ?>>
								</td>
							<th>메인노출</th>
							<td>
								<input type="checkbox" name="display"
                                       id="display" <?= ($display == "Y" ? "checked" : "") ?>>
							</td>
						</tr>
						<tr>
							<th>여행자 성함</th>
							<td>
								<div class="tra_name flex">
                                    <input type="text" value="<?= $user_name ?>" name="user_name" id="user_name"
                                           placeholder="한글이름">
                                </div>
							</td>
							<th>이메일</th>
							<td>
                                <div class="email flex__c">
                                    <input type="text" name="user_email" id="user_email" value="<?= $user_email ?>">
                                </div>
							</td>
						</tr>
						<tr>
							<th>여행형태</th>
							<td colspan="3">
								<div class="depart flex__c gap-1">
										<select name="travel_type" id="travel_type_1">
											<option value="">선택</option>
											<?php
                                            $codeModel = model("Code");
                                            $productModel = model("ProductModel");
                                            $result0 = $codeModel->getByParentAndDepth(13, 2)->getResultArray();


                                            foreach ($result0 as $row0) {
                                                ?>
                                                <option value="<?= $row0['code_no'] ?>" <?= ($row0['code_no'] == $travel_type ? "selected" : "") ?>><?= $row0['code_name'] ?></option>
                                                <?php
                                            }

                                            ?>
										</select>
										<?php

                                        $result = $codeModel->getByParentAndDepth($travel_type, 3)->getResultArray();

                                        ?>
										<select name="travel_type_2" id="travel_type_2"
                                                style="margin-left: 5px;<?= (!$travel_type ? "display: none;" : "") ?>">
											<option value="">선택</option>
											<?php
                                            foreach ($result as $row) {
                                                ?>
                                                <option value="<?= $row['code_no'] ?>" <?= ($row['code_no'] == $travel_type_2 ? "selected" : "") ?>><?= $row['code_name'] ?></option>
                                                <?php
                                            }
                                            ?>
										</select>
										<?php

                                        $result = $codeModel->getByParentAndDepth($travel_type_2, 4)->getResultArray();

                                        ?>
										<select name="travel_type_3" id="travel_type_3"
                                                style="margin-left: 5px;<?= (!$travel_type_2 ? "display: none;" : "") ?>">
											<option value="">선택</option>
											<?php
                                            foreach ($result as $row) {
                                                ?>
                                                <option value="<?= $row['code_no'] ?>" <?= ($row['code_no'] == $travel_type_3 ? "selected" : "") ?>><?= $row['code_name'] ?></option>
                                                <?php
                                            }
                                            ?>
										</select>
										<select name="product_idx" id="products"
                                                style="<?= (!$travel_type_3 ? "display: none;" : "") ?>">
											<option value="">선택</option>
											<?php
                                            $result = $productModel->getProducts($travel_type_3, 1);
                                            foreach ($result as $row) {
                                                ?>
                                                <option value="<?= $row['product_idx'] ?>" <?= ($row['product_idx'] == $product_idx ? "selected" : "") ?>><?= $row['product_name'] ?></option>
                                                <?php
                                            }
                                            ?>
										</select>
                                </div>
							</td>
						</tr>
						<tr>
							<th>제목</th>
							<td colspan="3"><input style="width: 100%;" type="text" name="title" id="title"
                                                   value="<?= $title ?>"/></td>
						</tr>
						<tr>
							<th>내용</th>
							<td colspan="3"><textarea name="contents" id="summernote"><?= $contents ?></textarea></td>
						</tr>
						<tr>
							<th>베스트 셈네일 첨부파일</th>
							<td colspan="3">
								<input type="file" name="ufile1">
								<a href="/data/review/<?= $ufile1 ?>" download="<?= $rfile1 ?>"><?= $rfile1 ?></a>
							</td>
						</tr>
						<tr>
							<th>첨부파일</th>
							<td colspan="3">
								<input type="file" name="ufile2">
								<a href="/data/review/<?= $ufile2 ?>" download="<?= $rfile2 ?>"><?= $rfile2 ?></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<div class="tail_menu">
		<ul>
			<li class="left"></li>
			<li class="right_sub">

				<a href="/AdmMaster/_review/list" class="btn btn-default"><span
                            class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
				<?php if ($idx == "") { ?>
                    <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span
                                class="txt">등록</span></a>
                <?php } else { ?>
                    <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span
                                class="txt">수정</span></a>
                    <a href="javascript:del_it()" class="btn btn-default"><span
                                class="glyphicon glyphicon-trash"></span><span class="txt">삭제</span></a>
                <?php } ?>
			</li>
		</ul>
	</div>
		
	</div>
    <!-- // contents -->
	</form>
		<div class="inner cmt_area" style="">
			<form action="" id="frm" name="com_form" class="com_form">
				<input type="hidden" name="code" id="code" value="review">
				<input type="hidden" name="r_code" id="r_code" value="review">
				<input type="hidden" name="r_idx" id="r_idx" value="<?= $idx ?>">
				<div class="comment_box-input flex">
					<textarea class="cmt_input" name="comment" id="comment" placeholder="댓글을 입력해주세요."></textarea>
					<button type="button" class="btn btn-point comment_btn"
                            onclick="fn_comment('<?= session('member.idx') ?>')">등록</button>
				</div>
			</form>
			<div id="comment_list"></div>
		</div>
	</span><!-- 인쇄 영역 끝 //-->
</div>
<!-- // container -->
<script>
    async function del_it() {
        if (confirm(" 삭제후 복구하실수 없습니다. \n 삭제하시겠습니까?")) {
            //hiddenFrame.location.href = "del?idx[]=<?php //=$idx?>//&mode=view";
            $("#ajax_loader").removeClass("display-none");

            let idx = [];
            idx.push(<?=$idx?>);
            let data = {
                idx: idx
            }
            await $.ajax({
                url: "del",
                type: "POST",
                data: data,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                },
                complete: function (request, status, error) {
                    $("#ajax_loader").addClass("display-none");
                },
                success: function (response, status, request) {
                    if (response == "OK") {
                        alert_("정상적으로 삭제되었습니다.");
                        window.location.href = "/AdmMaster/_review/list";
                        return;
                    } else {
                        alert(response);
                        alert_("오류가 발생하였습니다!!");
                        return;
                    }
                }
            });
        }

    }

</script>
<script>
    function sendFile(files, el) {
        let form = document;

        form = form.frm;

        data = new FormData(form);

        data.append("file", files);

        data.append("r_code", "review");

        for (var pair of data.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            url: "/ajax/uploader",
            data: data,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                // console.log($(el).summernote("insertImage", response.msg, 'filename'));
                $(el).summernote("insertImage", response.msg, 'filename');
                if (response.result == "ERROR") {
                    alert(response.msg);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus + " " + errorThrown);
            }
        });
    }

    $('#summernote').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true,
        lang: "ko-KR",

        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
            ],

        },
        callbacks: {
            onFocus: function (contents) {
                if ($('.summernote').summernote('isEmpty')) {
                    $(".summernote").html('');
                }
            },
            onImageUpload: function (files) {
                for (var i = 0; i < files.length; i++) {
                    sendFile(files[i], this);
                }
            }
        }
    });

    $('.tick_ch input[type="radio"]').on('change', function () {
        var idx = $(this).parent().index();
        $('.tic_form').hide();
        $('.tic_form').eq(idx).show();
    })

    $("#travel_type_1").on("change", function (event) {
        $.ajax({
            url: "/tools/get_travel_types",
            type: "POST",
            data: {
                code: event.target.value,
                depth: 3
            },
            dataType: 'json',
            success: function (res) {
                if (res.cnt == 0) {
                    $("#travel_type_2").hide().html("");
                    $("#travel_type_3").hide().html("");
                    $("#products").hide().html("");
                } else {
                    $("#travel_type_2").show().html(res.data);
                    $("#travel_type_3").show().html("");
                    $("#products").show().html("");
                }
            }
        })
    })


    $("#travel_type_2").on("change", function (event) {
        $.ajax({
            url: "/tools/get_travel_types",
            type: "POST",
            data: {
                code: event.target.value,
                depth: 4
            },
            dataType: 'json',
            success: function (res) {
                $("#travel_type_3").html(res.data);
                $("#products").html("");
            }
        })
    })

    $("#travel_type_3").on("change", function (event) {
        $.ajax({
            url: "/tools/get_list_product",
            type: "POST",
            data: {
                product_code: event.target.value
            },
            dataType: 'json',
            success: function (res) {
                $("#products").html(res.data)
            }
        })
    })
    const r_code = "review";
    const r_idx = "<?=$idx?>";
    const role = "admin";
</script>
<script src="/js/comment.js"></script>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>

<?= $this->endSection() ?>

