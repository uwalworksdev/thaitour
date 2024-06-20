
// 검색 실행
function go_sch(){
	var url = r_code+".php?";
	url += "&"+$("#frm_sch").serialize();

	document.location.href = url;
}

// 페이지 이동
function go_page(_page){

	var total_page = Math.ceil(total_cnt / scale); // 전체 페이지 수

	// 페이지 지정
	if(_page == "first") _page = 1;
	else if(_page == "prev") _page = page - 1;
	else if(_page == "next") _page = page + 1;
	else if(_page == "last") _page = total_page;
	else if(_page == "" || _page == undefined) _page = page;

	if(_page > total_page) _page = total_page;
	if(_page < 1) _page = 1;

	var url = r_code+".php?page="+_page;
	url += "&"+sch_param;
	url += "&"+sort_param;

	document.location.href = url;
}

// 상세보기
function go_view(r_idx){

	var url = r_code+"_view.php";
	url += "?cmd=view";
	url += "&r_idx="+r_idx;

	if(page != "") url += "&page="+page;
	if(sch_param != "") url += "&"+sch_param;
	if(sort_param != "") url += "&"+sort_param;

	console.log("go_view:"+url);
	document.location.href = url;
}

// 입력폼
function go_form(r_idx){

	var cmd = (r_idx == "" || r_idx == undefined) ? "new" : "mod";

	var url = r_code+"_write.php";
	url += "?cmd="+cmd;
	if(cmd == "mod") url += "&r_idx="+r_idx;

	if(page != "") url += "&page="+page;
	if(sch_param != "") url += "&"+sch_param;
	if(sort_param != "") url += "&"+sort_param;

	console.log("go_form : "+url);
	document.location.href = url;
}




// 목록으로 이동
function go_list(){
	var url = r_code+".php?page="+page;
	url += "&"+sch_param;
	url += "&"+sort_param;

	document.location.href = url;
}

// 등록
function go_regist(cmd){

	var r_idx = $("#frm_form input[name='r_idx']").val();

	// 스마트에디터 -> 폼 필드
	if(use_editor == "Y"){
		oEditors.getById["r_content"].exec("UPDATE_CONTENTS_FIELD", []);
		if($("#frm_form [name='r_content']").val() == "<p>&nbsp;</p>")
			$("#frm_form [name='r_content']").val("");
	}

	// 입력값 검사
	var check = true;
	$("#frm_form .must").each(function(){
		console.log($(this).attr("name")+" : " +$(this).val());
		var type = $(this).attr("type");
		if(type == "checkbox"){
			if(!$(this).prop("checked")){
				alert("["+$(this).attr("title")+"] 항목을 체크해 주세요.");
				$(this).focus();
				check = false;
				return false; // break
			}
		}
		else if($(this).val() == ""){
			alert("["+$(this).attr("title")+"] 항목의 값을 입력해 주세요.");
			$(this).focus();
			check = false;
			return false; // break
		}
	});
	if(!check)
		return false;

	// 파일 첨부
	var is_stop = false;
	$("#new_file li").each(function(){
		if($(this).find("[type='file']").val() == ""){
			if($("#new_file li").length < 1)
				$(this).remove();

			return;
		}

		/*if($(this).find("[name='new_title[]']").val() == ""){
			alert("파일 제목을 입력해 주세요.");
			$(this).find("[name='new_title[]']").focus();
			is_stop = true;
			return false; // each 종료
		}*/
	});
	if(is_stop) return false;

	// 명령 지정
	if(cmd == "" || cmd == undefined)
		cmd = (r_idx == "") ? "new_ok" : "mod_ok";

	$("#frm_form input[name='cmd']").val(cmd);

	// 입력 폼 값
	var args = $('#frm_form').serialize();
	console.log("args : " + args);

	$("#frm_form").ajaxForm({
		type: "POST", // GET, POST
		dataType: "text", // json, text
		url: "/ok.php",
		data: args,
		success: function(data, textStatus){
			console.log("go_regist:"+data);
			data = JSON.parse(data); // text -> json

			if(data.status == "Y"){ // 작업 성공
				if(data.msg != "") alert(data.msg); // 안내 메시지

				// 목록으로 이동
				go_list();
			}
			else{
				if(data.msg != "") alert(data.msg); // 안내 메시지
				if(data.item != "" && data.item != undefined)
					$("#frm_form [name='"+data.item+"']").focus();
			}
		},
		error: function(xhr, textStatus, Thrown){ // ajax 오류
			console.log("go_regist (error) : "+textStatus+" -> "+Thrown);
		}
	}).submit();
}


// 삭제
function go_del_ok(r_idx){

	/*if(r_idx == "checked"){
		var idx_arr = new Array();
		$("input.check_idx:checked").each(function(){
			idx_arr.push($(this).val());
		});
		r_idx = idx_arr.join(",");
	}*/

	if(r_idx == "")
		return alert("대상이 지정되지 않았습니다.");

	if(!confirm("삭제하시겠습니까?"))
		return;

	$.ajax({
		type: "GET", // GET, POST
		dataType: "text", // json, text
		url: "/ok.php",
		data: {
			"r_code": r_code,
			"r_idx": r_idx,
			"cmd": "del_ok",
			"call_type": "ajax",
			"data_type": "json"
		},
		success: function(data, textStatus){
			//console.log("go_del_ok:"+data);
			data = JSON.parse(data); // text -> json
			if(data.status == "Y"){ // 작업 성공
				if(data.msg != "") alert(data.msg); // 안내 메시지

				go_list(); // 목록으로 이동
			}
		},
		error: function(xhr, textStatus, Thrown){ // ajax 오류
			console.log("go_del_ok (error) : "+textStatus+" -> "+Thrown);
		}
	});
}
