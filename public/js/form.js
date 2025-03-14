
// 목록으로 이동
function go_list(){
	var url = "index.php?page="+page;
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

	//console.log("go_form : "+url);
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
	var tr    = $("#tbl_list tr[data-idx='"+r_idx+"']");
	var no    = tr.find(".td_no").html();

	// 입력값 검사
	var check = true;
	$("#frm_form .must").each(function(){
		//console.log($(this).attr("name")+" : " +$(this).val());
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

	// 신규 구분 추가
	if($("#frm_form [name='r_type']").val() == "add_new_type"){
		var new_type_key = $("#frm_form [name='new_type_key']").val();
		if(new_type_key == ""){
			alert("새로 추가하는 구분의 코드를 입력해 주세요.");
			$("#frm_form [name='new_type_key']").focus();
			return false;
		}
		if($("#frm_form [name='r_type'] option[value='"+new_type_key+"']").length > 0){
			alert("새로 추가하는 구분의 코드와 동일한 코드가 있습니다. 다른 값을 입력해 주세요.");
			$("#frm_form [name='new_type_key']").focus();
			return false;
		}

		var new_type_val = $("#frm_form [name='new_type_val']").val();
		if(new_type_val == ""){
			alert("새로 추가하는 구분의 제목을 입력해 주세요.");
			$("#frm_form [name='new_type_val']").focus();
			return false;
		}
		if($("#frm_form [name='r_type'] option[text='"+new_type_val+"']").length > 0){
			alert("새로 추가하는 구분의 제목과 동일한 제목이 있습니다. 다른 값을 입력해 주세요.");
			$("#frm_form [name='new_type_val']").focus();
			return false;
		}
	}

	// 열기 옵션 취합
	var open = {};
	$(".open").each(function(){
		open[$(this).attr("data-item")] = $(this).val();
	});
	$("#frm_form input[name='r_open']").val(JSON.stringify(open));


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
	});
	if(is_stop) return false;

	// 명령 지정
	$("#frm_form input[name='cmd']").val(cmd);

	// 입력 폼 값
	var args = $('#frm_form').serialize();
	//console.log("args : " + args);
 
	$("#frm_form").ajaxForm({
		type: "POST", // GET, POST
		dataType: "text", // json, text
		url: "/ajax/popup_update",
		data: args,
		success: function(data, textStatus){

			data = JSON.parse(data); // text -> json

			if(data.status == "Y"){ // 작업 성공
				if(data.message != "") alert(data.message); // 안내 메시지

				// 목록으로 이동
				//go_list();
				//document.location.reload();
				location.href='/AdmMaster/_cms/index?r_code=popup';
			}
			else{
				if(data.message != "") alert(data.message); // 안내 메시지
				if(data.item != "" && data.item != undefined)
					$("#frm_form [name='"+data.item+"']").focus();
			}
		},
		error: function(xhr, textStatus, Thrown){ // ajax 오류
			console.log("go_regist (error) : "+textStatus+" -> "+Thrown);
		}
	}).submit();
}

// 현재 적용된 템플릿
var cur_template = "";

function set_template(r_template){
	if(r_template == "")
		r_template = $("#frm_form [name='r_template']:checked").val();

	if(r_template == ""){
		if(use_editor == "Y"){
			//$("#frm_form [name='r_content']").val("");
			//oEditors.getById["r_content"].exec("LOAD_CONTENTS_FIELD"); // textarea -> editor
			CKEDITOR.instances.r_content.setData("")
		}
		else{
			$("#frm_form [name='r_content']").val("");
		}
		return;
	}

	$.ajax({
		type: "GET", // GET, POST
		dataType: "text", // json, text
		url: r_template,
		success: function(data, textStatus){
			//alert(data);
			if(use_editor == "Y"){
				//$("#frm_form [name='r_content']").val(data);
				//oEditors.getById["r_content"].exec("LOAD_CONTENTS_FIELD"); // textarea -> editor
				CKEDITOR.instances.r_content.setData(data);
			}
			else{
				$("#frm_form [name='r_content']").val(data);
			}
		}
	});
}

$(function(){

	// 분류 설정
	$("#frm_form [name='r_type']").change(function(){
		if($(this).val() == "add_new_type")
			$("#div_new_type").show();
		else
			$("#div_new_type").hide();
	});

	// 템플릿 설정
	$("#frm_form [name='r_template']").click(function(){
		if(!confirm("템플릿을 적용하거나 해제하면 기존 내용이 삭제됩니다.\n진행하시겠습니까?")){
			$("#frm_form [name='r_template'][value='"+cur_template+"']").prop("checked", true);
			return;
		}
		set_template("");
	});
});