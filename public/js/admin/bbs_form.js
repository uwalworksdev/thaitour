// 목록으로 이동
function go_list(){
	var url = "board_list_q?page="+page;
	url += "&"+sch_param;
	url += "&"+sort_param;

	document.location.href = url;
}

// 입력폼
function go_form(r_idx){

	var cmd = (r_idx == "" || r_idx == undefined) ? "new" : "mod";

	var url = "form.php";
	url += "?cmd="+cmd;
	if(cmd == "mod") url += "&r_idx="+r_idx;

	if(page != "") url += "&page="+page;
	if(sch_param != "") url += "&"+sch_param;
	if(sort_param != "") url += "&"+sort_param;

	console.log("go_form : "+url);
	document.location.href = url;
}


// 등록
function go_regist(cmd){
	// 삭제
	if(cmd == "del_ok"){
		if(!confirm("삭제하시겠습니까?")){
			return;
		}
	}

	var r_idx = $("#frm_form input[name='r_idx']").val();
	var tr = $("#tbl_list tr[data-idx='"+r_idx+"']");
	var no = tr.find(".td_no").html();

	// 스마트에디터 -> 폼 필드
	if(use_editor == "Y"){
		
		oEditors.getById["r_content"].exec("UPDATE_CONTENTS_FIELD", []);
		if($("#frm_form [name='r_content']").val() == "<p>&nbsp;</p>")
			$("#frm_form [name='r_content']").val("");
		
		//document.frm_form.r_content.value = CKEDITOR.instances.r_content.getData();
	}

	// 파일 첨부
	var is_stop = false;
	$("#ul_file [type='file']").each(function(){
		if($(this).val() == ""){
			if($("#ul_file li").length < 1)
				$(this).closest("li").remove();

			return; // continue
		}

		/*if($(this).find("[name='new_title[]']").val() == ""){
			alert("파일 제목을 입력해 주세요.");
			$(this).find("[name='new_title[]']").focus();
			is_stop = true;
			return false; // each 종료
		}*/
	});
	if(is_stop) return;

	// 전처리 함수 호출
	if(typeof pre_regist == "function"){
		if(!pre_regist())
			return;
	}

	// 명령 지정
	$("#frm_form input[name='cmd']").val(cmd);

	// 입력 폼 값
	var r_flag = document.getElementById("r_flag").checked;
	$("#frm_form input[name='r_flag']").val(r_flag ? 1 : 0)
	console.log("r_flag : " + $("#frm_form input[name='r_flag']").val());
	var args = $('#frm_form').serialize();
	// console.log("args : " + args);
	console.log(args);
	$("#frm_form").ajaxForm({
		type: "POST", // GET, POST
		dataType: "text", // json, text
		url: "form_ok",
		data: args,
		success: function(data, textStatus){
			console.log("go_regist:"+data);
			data = JSON.parse(data); // text -> json

			if(data.status == "Y"){ // 작업 성공
				// 후처리 함수 호출
				if(typeof post_regist == "function"){
					post_regist(data);
				}
				else{
					if(data.msg != "") alert(data.msg); // 안내 메시지

					// 목록으로 이동
					//go_list();

					// 입력 폼 새로고침
					//document.location.reload();
					go_list();
				}
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

	if(r_idx == "")
		return alert("대상이 지정되지 않았습니다.");

	if(!confirm("삭제하시겠습니까??"))
		return;

	$.ajax({
		type: "GET", // GET, POST
		dataType: "text", // json, text
		url: "form_ok",
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

				go_list(); // 목록
			}
		},
		error: function(xhr, textStatus, Thrown){ // ajax 오류
			console.log("go_del_ok (error) : "+textStatus+" -> "+Thrown);
		}
	});
}
