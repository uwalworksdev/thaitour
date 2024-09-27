function change_it() {
	$.ajax({
		url: "change.php",
		type: "POST",
		data: $("#lfrm").serialize(),
		error: function (request, status, error) {
			//통신 에러 발생시 처리
			alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
			$("#ajax_loader").addClass("display-none");
		}
		, complete: function (request, status, error) {
			//				$("#ajax_loader").addClass("display-none");
		}
		, success: function (response, status, request) {
			if (response.trim() === "OK") {
				alert("정상적으로 변경되었습니다.");
				setTimeout(function () {
					location.reload();
				}, 1000)

				return;
			} else {
				alert(response);
				alert("오류가 발생하였습니다!!");
				return;
			}
		}
	});
}

// 목록으로 이동
function go_list() {
	var url = "board_list_q?page=" + page;
	url += "&" + sch_param;
	url += "&" + sort_param;

	document.location.href = url;
}

// 페이지 이동
function go_page(_page) {

	var total_page = Math.ceil(total_cnt / scale); // 전체 페이지 수

	// 페이지 지정
	if (_page == "first") _page = 1;
	else if (_page == "prev") _page = page - 1;
	else if (_page == "next") _page = page + 1;
	else if (_page == "last") _page = total_page;
	else if (_page == "" || _page == undefined) _page = page;

	if (_page > total_page) _page = total_page;
	if (_page < 1) _page = 1;

	var url = "board_list_q?page=" + _page;
	url += "&" + sch_param;
	url += "&" + sort_param;

	document.location.href = url;
}

// 기본 정렬
function go_sort(item, dir) {

	// 기존 설정
	var sort_item = $("input[name='sort_item']").val();
	var sort_dir = $("input[name='sort_dir']").val();

	// 동일 항목인 경우, 반대 방향으로 정렬
	if (item == sort_item && dir == "")
		dir = (sort_dir == "desc") ? "" : "desc";

	// 설정 변경
	$("input[name='sort_item']").val(item);
	$("input[name='sort_dir']").val(dir);

	// 목록 새로고침
	go_page(1);
}

// 검색
function go_sch() {
	$("input[name='page']").val(1);
	$("#frm_sch").submit();
}



// 엑셀 다운로드
function go_excel_download() {

	var url = "ok.php?class=JkBbs";
	url += "&cmd=excel_download";
	url += "&" + sch_param;
	url += "&" + sort_param;

	//console.log("go_excel_download : " + url);
	document.location.href = url;
}

// 상세보기
function go_view(r_idx) {

	var url = "view";
	url += "?cmd=view";
	url += "&r_idx=" + r_idx;

	if (page != "") url += "&page=" + page;
	if (sch_param != "") url += "&" + sch_param;
	if (sort_param != "") url += "&" + sort_param;

	document.location.href = url;
}

// 입력폼
function go_form(r_idx) {

	var cmd = (r_idx == "" || r_idx == undefined) ? "new" : "mod";

	var url = "form";
	url += "?cmd=" + cmd;
	if (cmd == "mod") url += "&r_idx=" + r_idx;

	if (page != "") url += "&page=" + page;
	if (sch_param != "") url += "&" + sch_param;
	if (sort_param != "") url += "&" + sort_param;

	console.log("go_form : " + url);
	document.location.href = url;
}


// 전체 선택 / 해제
function check_all(check) {
	$("input.check_idx").prop("checked", check);
}

// 삭제    
function go_del_ok(r_idx) {

	if (r_idx == "checked") {
		var idx_arr = new Array();
		$("input.check_idx:checked").each(function () {
			idx_arr.push($(this).val());
		});
		r_idx = idx_arr.join(",");
		console.log(r_idx);
	}

	if (r_idx == "")
		return alert("대상이 지정되지 않았습니다.");

	if (!confirm("삭제하시겠습니까??"))
		return;

	$.ajax({
		type: "POST", // GET, POST
		dataType: "text", // json, text
		url: "form_ok",
		data: {
			"r_code": r_code,
			"r_idx": r_idx,
			"cmd": "del_ok",
			"call_type": "ajax",
			"data_type": "json"
		},
		success: function (data, textStatus) {
			//			alert(data);
			//console.log("go_del_ok:"+data);
			data = JSON.parse(data); // text -> json
			if (data.status == "Y") { // 작업 성공
				if (data.msg != "") {
					alert(data.msg); // 안내 메시지
				}
				// 목록 새로고침
			}
			go_list();
		},
		error: function (xhr, textStatus, Thrown) { // ajax 오류
			console.log("go_del_ok (error) : " + textStatus + " -> " + Thrown);
		}
	});
}

$(function () {

	// 목록 표시
	//go_page(1);

	// 페이지 이동
	$("#div_page").delegate("a", "click", function () {
		//console.log($(this).attr("title"));
		go_page($(this).attr("title"));
	});

	// 정렬
	// $("#tbl_list thead th").click(function(){
	// 	var sort_item = $(this).attr("data-item");
	// 	if(sort_item != "" && sort_item != undefined){
	// 		go_sort(sort_item, "");
	// 	}
	// });

	// 등록 버튼 클릭
	$("#tbl_list").delegate(".btn_new", "click", function () {
		go_form("");
	});

	// 보기 버튼 클릭
	$("#tbl_list").delegate(".btn_view", "click", function () {
		var r_idx = $(this).closest("tr").attr("data-idx");
		go_view(r_idx);
	});

	// 수정 버튼 클릭
	$("#tbl_list").delegate(".btn_mod", "click", function () {
		var r_idx = $(this).closest("tr").attr("data-idx");
		go_form(r_idx);
	});

	// 삭제 버튼 클릭
	$("#tbl_list").delegate(".btn_del", "click", function () {
		var r_idx = $(this).closest("tr").attr("data-idx");
		go_del_ok(r_idx);
	});

	// 팝업레이어에 이동기능 추가
	$(".div_pop").draggable({
		handle: ".div_title"
	});

});

