// 스케쥴 날짜 및 일수 증가
function fn_add_days(){

	if( confirm("스케쥴을 수정하면 지금까지 수정내역이 저장되지 않습니다.\r수정내역이 있을 경우 수정 버튼을 먼저 눌러주세요.\r정말 수정하시겠습니까?") ){

		// 상품 키값
		let product_idx = $("#product_idx").val();

		// 항공 코드
		let air_code = $("#air_code").val();

		// 시작일자
		let sdate = $("#sdate").val();


		if( product_idx == "" || air_code == ""){
			alert("잘못된 페이지 접근입니다. 다시 접속해주세요.");
			return false;

		}

		//if(sdate == ""){
		//	alert("시작일자를 선택해주세요.");
		//	$("#sdate").focus();
		//	return false;
		//}



		$.ajax({

			url: "/AdmMaster/_tours/chg_detailwrite",
			type: "POST",
			data: {
				"product_idx": product_idx,
				"air_code"   : air_code,
				"sdate"		 : sdate
			},
			success: function(data) {
				if(data.trim() == "OK"){
					alert("추가되었습니다.");
					location.reload();
				}else{
					alert("오류! " + data);
				}
				
				// location.reload();
			},
			error:function(request,status,error){
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});

	}

}


//상세 추가
function add_line(obj, dd, groups){
	//alert(dd);
	//alert(groups);
	max_onum = parseInt(max_onum) +1;

	let main_div = $(obj).closest(".daily_div");

	let tmp_div = add_line_html.replace(/\[%dd%\]/g, dd);
	tmp_div = tmp_div.replace(/\[%group%\]/g, groups);
	tmp_div = tmp_div.replace(/\[%onum%\]/g, max_onum);

	$(main_div).append(tmp_div);
}



// 상세 삭제
function del_line(obj){
	
	var idx = $(obj).attr('value');

	if(idx) {
		
		if (!confirm("선택한 등록내용을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
		return false;

		var message = "";
		$.ajax({

			url: "./ajax.del_line.php",
			type: "POST",
			data: {
				"idx": idx
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function(data, textStatus) {
				message = data.message;
				alert(message);
				location.reload();
			},
			error:function(request,status,error){
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
    }

	$(obj).closest(".sub_line").remove();

}


// 일정추가
function add_days(obj, dd) {

	max_group = parseInt(max_group) +1;
	max_onum = parseInt(max_onum) +1;
	
	let main_div = $(obj).closest("td").find(".add_in");

	let tmp_div = add_day_html.replace(/\[%dd%\]/g, dd);
	tmp_div = tmp_div.replace(/\[%group%\]/g, max_group);
	tmp_div = tmp_div.replace(/\[%onum%\]/g, max_onum);

	$(main_div).append( tmp_div );

}

// 일일전체 삭제
function day_seq_delete(obj)
{
    
    var idx = $(obj).attr('value');
    
    console.log('abc');
    if(idx) {
        
        if (!confirm("선택한 일차의 내용을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
			return false;

			var message = "";
			$.ajax({

				url: "/AdmMaster/_tours/day_seq_delete",
				type: "POST",
				data: {
					"idx": idx
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function(data, textStatus) {
					message = data.message;
					alert(message);
					location.reload();
				},
				error:function(request,status,error){
					alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});
		}
}

// 일정삭제
function del_days(obj) {

	var idx = $(obj).attr('value');
	console.log(idx);
	

	if(idx) {
		
		if (!confirm("선택한 일정전체 내용을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
		return false;

		var message = "";
		$.ajax({

			url: "/AdmMaster/_tours/del_day",
			type: "POST",
			data: {
				"idx": idx
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function(data, textStatus) {
				message = data.message;
				alert(message);
				location.reload();
			},
			error:function(request,status,error){
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
    }

	$(obj).closest(".add_detail_form").remove();
}




// 세부일정 추가 부분
const add_line_html = `
<div class="flex__c sub_line" style="margin-top:20px; gap: 20px">
	<div class="input-row">
		<input type="text" name="detail_summary[[%dd%]][[%group%]][[%onum%]]" value="" placeholder="상세일정 설명">
	</div>
</div>
`;



// 일정추가 부분
const add_day_html = `
<div class="input-wrap add_detail_form">
	<div class="daily_div">
		<div class="btn_div">
			<button type="button" class="btn btn-danger remove_form" onclick="del_days(this)">일정 전체 삭제</button>
		</div>
		<b class="label">상세일정</b>
		<div class="flex__c sub_line" style="margin-top:20px;">
			<div class="input-row">
				<input type="text" name="detail_summary[[%dd%]][[%group%]][[%onum%]]" value="" placeholder=" 상세일정 타이틀">
			</div>
		</div>
	</div>
</div>
`;








// 수정하기


	function send_it() {
		let frmm = document.getElementById("frmm"); // Sử dụng id của form để lấy phần tử form cụ thể
		frmm.submit();
	}
	



// 상세등록 클릭
function set_detail_pop(detail_idx, day_idx, groups, onum){

	 $(".detail_pop").fadeIn();
	  $("html").addClass("fixed");

	  
		$("#detail_idx").val(detail_idx);
		$("#day_idx").val(day_idx);
		$("#groups").val(groups);
		$("#onum").val(onum);


		var message = "";
		$.ajax({

			url: "./ajax.detail.get.php",
			type: "POST",
			data: {
				"detail_idx": detail_idx
			  , "day_idx": day_idx
			  , "groups": groups
			  , "onum": onum

			},
			dataType: "json",
			async: false,
			cache: false,
			success: function(data, textStatus) {
				message = data.message;
				//alert(message);
				var _msg = message.split("|");
				$("#detail_summary").val(_msg[0]);
				$("#detail_sub_memo").val(_msg[1]);
				$("#detail_desc01").val(_msg[2]);
				$("#detail_desc02").val(_msg[3]);
				$("#detail_desc03").val(_msg[4]);
				$("#file_num").val(data.file_num);
				
				var img_grp ='';
				if(_msg[5])  $("#ufile1").val(_msg[5]);
				if(_msg[6])  $("#ufile2").val(_msg[6]);
				if(_msg[7])  $("#ufile3").val(_msg[7]);
				if(_msg[8])  $("#ufile4").val(_msg[8]);
				if(_msg[9])  $("#ufile5").val(_msg[9]);
				if(_msg[10])  $("#ufile6").val(_msg[10]);
				if(_msg[11])  $("#ufile7").val(_msg[11]);
				if(_msg[12])  $("#ufile8").val(_msg[12]);
				if(_msg[13]) $("#ufile9").val(_msg[13]);
				if(_msg[14]) $("#ufile10").val(_msg[14]);

				
				if(_msg[5])  img_grp  ='<li id="btn1"><figure><img src="/data/schedule/'+_msg[5] +'" title="2.png"><span class="delBtn" onclick="delImg1(1)"></span></figure></li>';
				if(_msg[6])  img_grp +='<li id="btn2"><figure><img src="/data/schedule/'+_msg[6] +'" title="2.png"><span class="delBtn" onclick="delImg1(2)"></span></figure></li>';
				if(_msg[7])  img_grp +='<li id="btn3"><figure><img src="/data/schedule/'+_msg[7] +'" title="2.png"><span class="delBtn" onclick="delImg1(3)"></span></figure></li>';
				if(_msg[8])  img_grp +='<li id="btn4"><figure><img src="/data/schedule/'+_msg[8] +'" title="2.png"><span class="delBtn" onclick="delImg1(4)"></span></figure></li>';
				if(_msg[9])  img_grp +='<li id="btn5"><figure><img src="/data/schedule/'+_msg[9] +'" title="2.png"><span class="delBtn" onclick="delImg1(5)"></span></figure></li>';
				if(_msg[10]) img_grp +='<li id="btn6"><figure><img src="/data/schedule/'+_msg[10]+'" title="2.png"><span class="delBtn" onclick="delImg1(6)"></span></figure></li>';
				if(_msg[11]) img_grp +='<li id="btn6"><figure><img src="/data/schedule/'+_msg[11]+'" title="2.png"><span class="delBtn" onclick="delImg1(7)"></span></figure></li>';
				if(_msg[12]) img_grp +='<li id="btn6"><figure><img src="/data/schedule/'+_msg[12]+'" title="2.png"><span class="delBtn" onclick="delImg1(8)"></span></figure></li>';
				if(_msg[13]) img_grp +='<li id="btn6"><figure><img src="/data/schedule/'+_msg[13]+'" title="2.png"><span class="delBtn" onclick="delImg1(9)"></span></figure></li>';
				if(_msg[14]) img_grp +='<li id="btn6"><figure><img src="/data/schedule/'+_msg[14]+'" title="2.png"><span class="delBtn" onclick="delImg1(10)"></span></figure></li>';

				$('#file_add01').closest("div").addClass(_msg[5]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[5]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add02').closest("div").addClass(_msg[6]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[6]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add03').closest("div").addClass(_msg[7]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[7]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add04').closest("div").addClass(_msg[8]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[8]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add05').closest("div").addClass(_msg[9]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[9]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add06').closest("div").addClass(_msg[10]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[10]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add07').closest("div").addClass(_msg[11]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[11]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add08').closest("div").addClass(_msg[12]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[12]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add09').closest("div").addClass(_msg[13]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[13]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				$('#file_add010').closest("div").addClass(_msg[14]?"applied":"").find('label').css(
					{"background-image":"url(/data/schedule/"+_msg[14]+")","background-repeat":"no-repeat","background-size":"cover"}
				);

				// $(".file_box").append(img_grp);
				//location.reload();
			},
			error:function(request,status,error){
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
	 
	
}



// 체험상품 등록 클릭
// function set_experience_pop(detail_idx, day_idx, onum){

// 	 $(".experience_pop").fadeIn();
// 	  $("html").addClass("fixed");

// 		$("#detail_exp_idx").val(detail_idx);
// 		$("#day_exp_idx").val(day_idx);
// 		$("#exp_onum").val(onum);


// 		var message = "";
// 		$.ajax({

// 			url: "./ajax.experience.get.php",
// 			type: "POST",
// 			data: {
// 				"detail_idx": detail_idx
// 			  , "day_idx": day_idx
// 			  , "onum": onum

// 			},
// 			dataType: "json",
// 			async: false,
// 			cache: false,
// 			success: function(data, textStatus) {
// 				message = data.message;
// 				//alert(message);
// 				var _msg = message.split("|");
// 				$("#detail_sub_tit_exp").val(_msg[0]);
// 				$("#detail_sub_memo_exp").val(_msg[1]);
// 				$("#file_num_ex").val(data.file_num);
				
// 				if(_msg[2]) $("#ufile_ex_1").val(_msg[2]);
// 				if(_msg[3]) $("#ufile_ex_2").val(_msg[3]);
// 				if(_msg[4]) $("#ufile_ex_3").val(_msg[4]);
// 				if(_msg[5]) $("#ufile_ex_4").val(_msg[5]);
// 				if(_msg[6]) $("#ufile_ex_5").val(_msg[6]);
// 				if(_msg[7]) $("#ufile_ex_6").val(_msg[7]);
// 			},
// 			error:function(request,status,error){
// 				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
// 			}
// 		});
	 
	
// }



function detail_up()
{
        var f = document.img_form;

		var detail_data = $(f).serialize();
		var save_result = "";
		$.ajax({
			type  : "POST",
			data  : detail_data,
			url   :  "./ajax.detail_up.php",
			cache : false,
			async : false,
			success: function(data, textStatus) {
				save_result = data;
				//alert('save_result- '+save_result);
				var obj = jQuery.parseJSON(save_result);
                var message = obj.message;
                alert(message); 
				location.reload();
			},
			error:function(request,status,error) {
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
}
function experience_up()
{
        var f = document.img_form_exp;

		var detail_data = $(f).serialize();
		var save_result = "";
		$.ajax({
			type  : "POST",
			data  : detail_data,
			url   :  "./ajax.experience_up.php",
			cache : false,
			async : false,
			success: function(data, textStatus) {
				save_result = data;
				//alert('save_result- '+save_result);
				var obj = jQuery.parseJSON(save_result);
                var message = obj.message;
                alert(message); 
				location.reload();
			},
			error:function(request,status,error){
				alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
			}
		});
}
