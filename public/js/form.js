
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