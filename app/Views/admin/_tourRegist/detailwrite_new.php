<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
    <link rel="stylesheet" href="/css/admin/popup.css" type="text/css"/>
    <script type="text/javascript" src="/js/admin/tours/detail_write.js"></script>
<style type="text/css">
	.daily_div{
		margin-bottom:20px;
		border: 1px solid #dddddd;
		padding:10px;
		background: #fbf4f4;

	}
	.btn_div{
		float:right;
		
	}

</style>

<div id="container"> <span id="print_this">
    <!-- 인쇄영역 시작 //-->

    <header id="headerContainer">
      <div class="inner">
        <h2>상세일정</h2>
        <div class="menus">
          <ul>

            <li>
              <a href="#!" class="btn btn-default" onclick="go_view('<?=$product_idx?>','<?=$air_code?>');" >
                <span class="glyphicon glyphicon-cog"></span>
                <span class="txt">상세페이지</span>
              </a>
            </li>
            <li>
				<a href="javascript:send_it()" class="btn btn-default">
					<span class="glyphicon glyphicon-cog"></span>
					<span class="txt">수정</span>
				</a>
            </li>            

          </ul>
        </div>
      </div>
      <!-- // inner -->

    </header>
    <!-- // headerContainer -->



    <div id="contents">


		<div class="listWrap_noline timetable">


			<form id="frmm" name="frm" action="detailwrite_new_ok.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="product_idx" id="product_idx" value="<?=$product_idx?>" />
				<input type="hidden" name="air_code" id="air_code" value="<?=$air_code?>" />
			  
				<div class="listBottom">
					<table cellpadding="0" cellspacing="0" summary="" class="listTable time_detail">
						<colgroup>
							<col width="10%" />
							<col width="40%" />
							<col width="10%" />
							<col width="40%" />
						</colgroup>
						<tr height=45>
							<th>상품명</th>
							<td><?=$product['product_name']?></td>
							<th>항공사</th>
							<td><?=$airline['code_name'] ?? ''?></td>
						</tr>
					  

						<tr height=45>
							<th>스케줄</th>
							<td colspan=3>
								<div class="form_input">
                                    <input type="hidden" id="sdate" class="input_txt date_pic" value="<?= $scheduleDetails[0]['sdate'] ?? '' ?>" placeholder="시작일자" style="width:150px"/>
									<button type="button" class="btn btn-primary more_detail" onclick="fn_add_days();" >일차추가</button>
								</div>
							</td>
						</tr>
					
						<tbody class="main_list">
                        <?php for ($dd = 1; $dd <= $totalDays; $dd++): ?>
                            <?php
                                $schedule = isset($schedules[$dd]) ? $schedules[$dd] : null;
                            ?>
                            <tr class="sch_list">
                                <th>
                                    <?= ($dd) ?>일차 <br><br>
                                    <button type="button" class="btn btn-danger more_detail" onclick="day_seq_delete(this);" value="<?= $schedule['idx'] ?>,<?=$dd?> ">일차삭제</button>
                                </th>
                                <td colspan=3><input type="hidden" name="schedule_date[<?= $dd ?>]" id="schedule_date<?= $dd ?>" class="input_txt" value="<?= $schedule['sdate'] ?>" placeholder="여행일자" style="width:150px" />
                                    <div class="input-wrap">
                                        <b class="label">일자별 타이틀</b>
                                        <div class="flex__c">
                                            <div class="input-row">
                                                <input type="text" name="detail_title[<?= $dd ?>]" value="<?= $schedule['detail_title'] ?>" class="ip02" placeholder="일자별 타이틀">
                                            </div>
                                            <div class="flex__c btn_cont">
                                                <button type="button" class="btn btn-primary more_detail" onclick="add_days(this, '<?= $dd ?>')">일정추가</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add_in">
                                        <?php
                                        $groups = $subSchedules[$schedule['idx']] ?? [];
                                        foreach ($groups as $group): 
                                        ?>
                                            <div class="input-wrap add_detail_form">
                                                <div class="daily_div">
                                                    <div class="btn_div">
                                                        <button type="button" class="btn btn-danger remove_form" value="<?= $detail_idx ?>,<?= $dd ?>,<?= $group[0]['groups'] ?>" onclick="del_days(this)">일정 전체 삭제</button>
                                                        <button type="button" class="btn btn-primary add_form" onclick="add_line(this, '<?= $dd ?>', '<?= $group[0]['groups'] ?>')">추가</button>
                                                    </div>

                                                    <b class="label">상세일정</b>
                                                    <?php foreach ($group as $row_ds): ?>
                                                        <div class="flex__c sub_line" style="margin-top:20px; gap: 20px">
                                                            <select name="detail_desc[<?= $dd ?>][<?= $row_ds['groups'] ?>][<?= $row_ds['onum'] ?>]" id="">
                                                                <option value="E" <?= $row_ds['detail_desc'] == "E" ? 'selected' : '' ?>>일반</option>
                                                                <option value="C" <?= $row_ds['detail_desc'] == "C" ? 'selected' : '' ?>>택1</option>
                                                                <option value="P" <?= $row_ds['detail_desc'] == "P" ? 'selected' : '' ?>>특전</option>
                                                                <option value="S" <?= $row_ds['detail_desc'] == "S" ? 'selected' : '' ?>>추천</option>
                                                                <option value="B" <?= $row_ds['detail_desc'] == "B" ? 'selected' : '' ?>>유료</option>
                                                                <option value="D" <?= $row_ds['detail_desc'] == "D" ? 'selected' : '' ?>>택2</option>
                                                            </select>
                                                            <div class="input-row">
                                                                <input type="text" name="detail_summary[<?= $dd ?>][<?= $row_ds['groups'] ?>][<?= $row_ds['onum'] ?>]" value="<?= htmlspecialchars(viewSQ($row_ds['detail_summary']), ENT_QUOTES, 'UTF-8') ?>" placeholder="상세일정 설명">
                                                            </div>
                                                            <div class="flex__c btn_cont">
                                                                <button type="button" class="btn btn-success cont_in" onclick="set_detail_pop('<?= $row_ds['detail_idx'] ?>', '<?= $row_ds['day_idx'] ?>', '<?= $row_ds['groups'] ?>', '<?= $row_ds['onum'] ?>')">상세등록</button>
                                                                <button type="button" class="btn btn-danger remove_form" value="<?= $row_ds['detail_idx'] ?>,<?= $row_ds['day_idx'] ?>,<?= $row_ds['groups'] ?>,<?= $row_ds['onum'] ?>" onclick="del_line(this)">삭제</button>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endfor; ?>
					 </tbody>

					</table>
				</div>
			</form>

			<div class="tail_menu">
				<ul>
					<li class="left"></li>
					<li class="right_sub">


						<a href="#!" class="btn btn-default" onclick="go_view('<?=$product_idx?>','<?=$air_code?>');" >
							<span class="glyphicon glyphicon-cog"></span>
							<span class="txt">상세페이지</span>
						</a>

						<a href="javascript:send_it()" class="btn btn-default">
							<span class="glyphicon glyphicon-cog"></span>
							<span class="txt">수정</span>
						</a>

					</li>
				</ul>
			</div>

		</div>

    </div>

    
    <!-- 상세일정 삭제 팝업 -->
    <div class="pop_common detail_pop">
      <div class="pop_item">
        <div class="pop_top">
          <button
            type="button"
            class="btn_close no_txt"
            onclick="PopCloseBtn('.detail_pop')">
            닫기
          </button>
        </div>

		<form name="img_form" id="img_form" method="post" enctype="multipart/form-data">
        <div class="pop_mid">
          <div class="common_ttl tac">
          <input type="hidden"  name="detail_idx" id="detail_idx"  value=''>
		  <input type="hidden"  name="day_idx" id="day_idx"  value=''>
		  <input type="hidden"  name="groups" id="groups"  value=''>
		  <input type="hidden"  name="onum" id="onum"  value=''>



          <input type="hidden" id='file_num'    value='0'>
          <input type="hidden" id='product_idx' value='<?=$product_idx?>'>
          <input type="hidden" id='air_code'    value='<?=$air_code?>'>
		  
		  <?php for($i=1;$i<=6;$i++) { ?>
		  <input type="hidden" name="ufile<?=$i?>" id="ufile<?=$i?>" value="">
		  <input type="hidden" name="rfile<?=$i?>" id="rfile<?=$i?>" value="">
          <?php } ?>

          <span id="common_ttl"></span>
          </div>
          <ul class="in_form">
            <li>
              <div class="input-wrap hotel">
                <b class="label">상세 타이틀<?=$detail_idx?></b>
                <div class="input-row">
                  <input type="text" name="detail_summary" id="detail_summary">
                </div>
              </div>
            </li>

            <li>
              <div class="input-wrap hotel">
                <b class="label">상세 설명</b>
                <div class="input-row">
                  <textarea name="detail_sub_memo" id="detail_sub_memo" class="bs-textarea"></textarea>
                </div>
              </div>
            </li>

            <li>
              <div class="input-wrap hotel">
                <b class="label">상세 이미지(이미지 사이즈:600x400)</b>
                <ul class="file_box">
					<div class="img_add">
						<div class="file_input <?=($ufile1 != '' ? "applied":"")?>">
							<input type="file" name='ufile1' id="file_add01" onchange="img_ajax(this,1)">
							<label for="file_add01" style='background-image:url(/data/schedule/<?=$ufile1?>)'></label>
							<input type="hidden" id="ufile_chk" value="<?=$ufile1?>">
							<button type="button" class="remove_btn" onclick="delImg1(1)">삭제</button>
						</div>
						<div class="file_input <?=($ufile2 != '' ? "applied":"")?>">
							<input type="file" name='ufile2' id="file_add02" onchange="img_ajax(this,2)" >
							<label for="file_add02" style='background-image:url(/data/schedule/<?=$ufile2?>)'></label>
							<button type="button" class="remove_btn" onclick="delImg1(2)"></button>
						</div>
						<div class="file_input <?=($ufile3 != '' ? "applied":"")?>">
							<input type="file" name='ufile3' id="file_add03" onchange="img_ajax(this,3)">
							<label for="file_add03" style='background-image:url(/data/schedule/<?=$ufile3?>)'></label>
							<button type="button" class="remove_btn" onclick="delImg1(3)"></button>
						</div>
						<div class="file_input <?=($ufile4 != '' ? "applied":"")?>">
							<input type="file" name='ufile4' id="file_add04" onchange="img_ajax(this,4)">
							<label for="file_add04" style='background-image:url(/data/schedule/<?=$ufile4?>)'></label>
							<button type="button" class="remove_btn" onclick="delImg1(4)"></button>
						</div>
						<div class="file_input <?=($ufile5 != '' ? "applied":"")?>">
							<input type="file" name='ufile5' id="file_add05" onchange="img_ajax(this,5)">
							<label for="file_add05" style="background-image:url(/data/schedule/<?=$ufile5?>)"></label>
							<button type="button" class="remove_btn" onclick="delImg1(5)"></button>
						</div>

						<div class="file_input <?=($ufile6 != '' ? "applied":"")?>">
							<input type="file" name='ufile6' id="file_add06" onchange="img_ajax(this,6)">
							<label for="file_add06" style='background-image:url(/data/schedule/<?=$ufile6?>)'></label>
							<input type="hidden" id="ufile_chk" value="<?=$ufile1?>">
							<button type="button" class="remove_btn" onclick="delImg1(6)">삭제</button>
						</div>
						<div class="file_input <?=($ufile7 != '' ? "applied":"")?>">
							<input type="file" name='ufile7' id="file_add07" onchange="img_ajax(this,7)" >
							<label for="file_add07" style='background-image:url(/data/schedule/<?=$ufile7?>)'></label>
							<button type="button" class="remove_btn" onclick="delImg1(7)"></button>
						</div>
						<div class="file_input <?=($ufile8 != '' ? "applied":"")?>">
							<input type="file" name='ufile8' id="file_add08" onchange="img_ajax(this,8)">
							<label for="file_add08" style='background-image:url(/data/schedule/<?=$ufile8?>)'></label>
							<button type="button" class="remove_btn" onclick="delImg1(8)"></button>
						</div>
						<div class="file_input <?=($ufile9 != '' ? "applied":"")?>">
							<input type="file" name='ufile9' id="file_add09" onchange="img_ajax(this,9)">
							<label for="file_add09" style='background-image:url(/data/schedule/<?=$ufile9?>)'></label>
							<button type="button" class="remove_btn" onclick="delImg1(9)"></button>
						</div>
						<div class="file_input <?=($ufile10 != '' ? "applied":"")?>">
							<input type="file" name='ufile10' id="file_add010" onchange="img_ajax(this,10)">
							<label for="file_add010" style="background-image:url(/data/schedule/<?=$ufile10?>)"></label>
							<button type="button" class="remove_btn" onclick="delImg1(10)"></button>
						</div>
					</div> 
					
				</ul>
              </div>
            </li>
          </ul>
        </div>
		</form>

        <div class="pop_bot">
          <div class="btn_wrap flex_c_c">
            <button
              type="button"
              class="btn  btn-success"
              onclick="PopCloseBtn('.detail_pop')" >
              취소
            </button>
            <button class="btn  btn-primary" onclick="detail_up();">확인</button>
          </div>
        </div>
      </div>
      <div class="pop_dim"></div>
    </div>

    <div class="pop_common experience_pop">
      <div class="pop_item">
        <div class="pop_top">
          <button
            type="button"
            class="btn_close no_txt"
            onclick="PopCloseBtn('.experience_pop')">
            닫기
          </button>
        </div>

		<form name="img_form_exp" id="img_form_exp" method="post" enctype="multipart/form-data">
        <div class="pop_mid">
          <div class="common_ttl tac">
          <input type="hidden"  name="detail_exp_idx" id="detail_exp_idx" value=''>
		  <input type="hidden"  name="day_exp_idx"    id="day_exp_idx"    value=''>
		  <input type="hidden"  name="exp_onum"       id="exp_onum"       value=''>



          <input type="hidden" id='file_num_ex'    value='0'>
          <input type="hidden" id='product_idx' value='<?=$product_idx?>'>
          <input type="hidden" id='air_code'    value='<?=$air_code?>'>
		  
		  <?php for($i=1;$i<=6;$i++) { ?>
		  <input type="hidden" name="ufile<?=$i?>" id="ufile_ex_<?=$i?>" value="">
		  <input type="hidden" name="rfile<?=$i?>" id="rfile_ex_<?=$i?>" value="">
          <?php } ?>

          <span id="common_ttl"></span>
            <h3>체험 상세설명 등록</h3>
          </div>
          <ul class="in_form">
            <li>
              <div class="input-wrap hotel">
                <b class="label">상세 타이틀</b>
                <div class="input-row">
                  <input type="text" name="detail_sub_tit_exp" id="detail_sub_tit_exp">
                </div>
              </div>
            </li>

            <li>
              <div class="input-wrap hotel">
                <b class="label">상세 설명</b>
                <div class="input-row">
                  <textarea name="detail_sub_memo_exp" id="detail_sub_memo_exp" class="bs-textarea"></textarea>
                </div>
              </div>
            </li>

            <li>
              <div class="input-wrap hotel">
                <b class="label">상세 이미지(이미지 사이즈:600x400)</b>
                <ul class="file_box">
                    <li class="file_more">
                      <input type="file" name="file" id="img_add_exp" class="upload-hidden" multiple>
                      <label for="img_add_exp" >추가</label>
                    </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
		</form>

        <div class="pop_bot">
          <div class="btn_wrap flex_c_c">
            <button
              type="button"
              class="btn  btn-success"
              onclick="PopCloseBtn('.experience_pop')" >
              취소
            </button>
            <button class="btn  btn-primary" onclick="experience_up();">확인</button>
            <button class="btn  btn-danger" onclick="experience_del();">삭제</button>
          </div>
        </div>
      </div>
      <div class="pop_dim"></div>
    </div>

  </span>
</div>

<script>
function experience_del()
{

        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        var f = document.img_form_exp;

		var exp_data = $(f).serialize();
		var save_result = "";
		$.ajax({
			type  : "POST",
			data  : exp_data,
			url   :  "./ajax.experience_del.php",
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

function go_view(product_idx,air_code) 
{
         var view_url = '<?=$view_url?>';
         location.href='/AdmMaster/_tourRegist/'+view_url+'?product_idx='+ product_idx +'&air_code='+air_code;
		 //history.back(-1);
}
</script>

<!-- // container -->
<script>

</script>

<script>
function img_ajax(obj,num){

    var product_idx = '<?=$product_idx?>';
	var formData = new FormData();

	formData.append('num',num);
	formData.append('product_idx',product_idx);
	formData.append('detail_idx',$('#detail_idx').val());
	formData.append('day_idx',$('#day_idx').val());
	formData.append('groups',$('#groups').val());
	formData.append('onum',$('#onum').val());
	formData.append('air_code',$('#air_code').val());
	formData.append('files', $('#file_add0'+num)[0].files[0]);

	//alert( $('#file_add01').val() );
	//return;

	$.ajax({
		url:"./write_img_ajax.php"
		,data:formData
		,type:"POST"
		,dataType : 'json'
		,contentType : false
		,processData : false
		,error : function(request, status, error){
			alert("CODE : "+request.status+"\r\nmessage : " + request.reponseText);
			return false;
		}
		,success : function(response, status, request){
			/*
			background-image:url('/data/product/'+response);
			background-repeat : no-repeat;
			background-size : cover
			*/
			//alert(response.ufile);
			//$('#g_idx').val(response.g_idx);
			$('#file_add0'+num).closest("div").find('label').css(
				{"background-image":"url(/data/schedule/"+response.ufile+")","background-repeat":"no-repeat","background-size":"cover"}
			);

			$('#file_add0'+num).closest("div").addClass('applied');
			if (num == '1')
			{
				$('#ufile_chk').val(response.ufile);
			}
		}
	})
}

/*이미지만 새로고침없이 DB및 홈페이지 삭제*/
function img_del(num){
 var g_idx = $('#g_idx').val();
 var params = "g_idx=" + g_idx + "&num=" + num;
 if (num == '1')
 {
	 alert("필수이미지는 삭제가 불가능합니다.");
	 return false;
 }else{
	 $.ajax({
		url:"./write_img_del.php"
		,data:params
		,type:"POST"
		,error:function(request, status, error){
			alert("CODE : "+request.status+"\r\nmessage : "+request.reponseText);
			return false;
		}
		,success:function(response, status, request){
			$('#file_add0'+num).closest("div").find('label').css("background-image",'');
			$('#file_add0'+num).closest('div').removeClass('applied');
			
		}
	 });
 }
}
</script>

<script>
function select_add_it(idx)
{
//   popOpen( '1024' , '650' , '../_tourStay/popup.php?strs='+$("#stay_list"+idx).val()+'&idx='+idx , 'stay');
	$("#stay_idx").val(idx);
	search_stay_f();
}

function shopping_add_it(idx)
{
  popOpen( '1024' , '650' , '../_tourShopping/popup.php?strs='+$("#shopping_list"+idx).val()+'&idx='+idx , 'shopping');
}

function sight_add_it()
{
  popOpen( '1024' , '600' , '../_tourSights/popup.php?strs='+$("#sight_list").val() , 'sight');
}

function country_add_it()
{
  popOpen( '1024' , '600' , '../_tourCountry/popup.php?strs='+$("#sight_list").val() , 'country');
}

function active_add_it()
{
  popOpen( '1024' , '600' , '../_tourGuide/popup.php?strs='+$("#sight_list").val() , 'country');
}
</script>

<script>

  $(document).ready(function () {

		// 상세일정추가
		$("#img_add").change(function (e) {
		 //div 내용 비워주기
		 // $('#Preview').empty();

		 var files = e.target.files;
		 var arr = Array.prototype.slice.call(files);

		 //업로드 가능 파일인지 체크
		 for (var i = 0; i < files.length; i++) {
		   if (!checkExtension(files[i].name, files[i].size)) {
			 return false;
		   }
		 }
		 preview(arr);
		//  checkOverflow();

		 function checkExtension(fileName, fileSize) {
		   var regex = new RegExp("(.*?)\.(exe|sh|zip|alz)$");
		   var maxSize = 20971520; //20MB

		   if (fileSize >= maxSize) {
			 alert('이미지 크기가 초과되었습니다.');
			 $("#img_add").val(""); //파일 초기화
			 return false;
		   }

		   if (regex.test(fileName)) {
			 alert('확장자명을 확인해주세요.');
			 $("#img_add").val(""); //파일 초기화
			 return false;
		   }
		   return true;
		 }

		 function preview(arr) {
		   arr.forEach(function (f) {

			 //div에 이미지 추가
			 var str = '<li>';
			 str += '<figure>';

			 //이미지 파일 미리보기
			 if (f.type.match('image.*')) {
			   //파일을 읽기 위한 FileReader객체 생성
				var reader = new FileReader();
				reader.onload = function (e) {
				  //파일 읽어들이기를 성공했을때 호출되는 이벤트 핸들러
				  str += '<img src="' + e.target.result + '" title="' + f.name + '">';
				  str += '<span class="delBtn" onclick="delImg(this)"></span>';
				  str += '</figure>';
				  str += '</li>';
				  $(str).insertAfter('.file_more');
				}

				var file_num = $("#file_num").val();

				var image_form = document.getElementById('img_form');
				formData = new FormData(image_form);
				$.ajax({
					url:"ajax.img_upload.php",
					data:formData,
					type:"POST",
					dataType:"JSON",
					processData: false,
					contentType: false,
					error:function(request, status, error){
						alert("CODE : " + request.status + "\r\nmessage : " + request.reponseText);
						return false;
					},
					success:function(response, status, request){
						if(response.result == 'OK'){
							//$('#ufile'+file_num).val(response.ufile);
							//$('#rfile'+file_num).val(response.rfile);
							var idx  = parseInt($("#file_num").val()) + 1;
							$("#file_num").val(idx);
							$("#ufile"+idx).val(response.ufile);
							$("#rfile"+idx).val(response.rfile);
						}else{
						
						}
					}
				});

			   reader.readAsDataURL(f);
			 } else {
			   //이미지 파일 아닐 경우 대체 이미지
			 }
		   })
		 }
	   })


		// 체험일정추가
		$("#img_add_exp").change(function (e) {
		 //div 내용 비워주기
		 // $('#Preview').empty();

		 var files = e.target.files;
		 var arr = Array.prototype.slice.call(files);

		 //업로드 가능 파일인지 체크
		 for (var i = 0; i < files.length; i++) {
		   if (!checkExtension(files[i].name, files[i].size)) {
			 return false;
		   }
		 }
		 preview_exp(arr);
		//  checkOverflow();

		 function checkExtension(fileName, fileSize) {
		   var regex = new RegExp("(.*?)\.(exe|sh|zip|alz)$");
		   var maxSize = 20971520; //20MB

		   if (fileSize >= maxSize) {
			 alert('이미지 크기가 초과되었습니다.');
			 $("#img_add").val(""); //파일 초기화
			 return false;
		   }

		   if (regex.test(fileName)) {
			 alert('확장자명을 확인해주세요.');
			 $("#img_add").val(""); //파일 초기화
			 return false;
		   }
		   return true;
		 }

		 function preview_exp(arr) {
		   arr.forEach(function (f) {

			 //div에 이미지 추가
			 var str = '<li>';
			 str += '<figure>';

			 //이미지 파일 미리보기
			 if (f.type.match('image.*')) {
			   //파일을 읽기 위한 FileReader객체 생성
				var reader = new FileReader();
				reader.onload = function (e) {
				  //파일 읽어들이기를 성공했을때 호출되는 이벤트 핸들러
				  str += '<img src="' + e.target.result + '" title="' + f.name + '">';
				  str += '<span class="delBtn" onclick="delImg(this)"></span>';
				  str += '</figure>';
				  str += '</li>';
				  $(str).insertAfter('.file_more');
				}

				var file_num = $("#file_num_ex").val();

				var image_form = document.getElementById('img_form_exp');
				formData = new FormData(image_form);
				$.ajax({
					url:"ajax.imgex_upload.php",
					data:formData,
					type:"POST",
					dataType:"JSON",
					processData: false,
					contentType: false,
					error:function(request, status, error){
						alert("CODE : " + request.status + "\r\nmessage : " + request.reponseText);
						return false;
					},
					success:function(response, status, request){
						if(response.result == 'OK'){
							//$('#ufile'+file_num).val(response.ufile);
							//$('#rfile'+file_num).val(response.rfile);
							var idx  = parseInt($("#file_num_ex").val()) + 1;
							$("#file_num_ex").val(idx);
							$("#ufile_ex_"+idx).val(response.ufile);
							$("#rfile_ex_"+idx).val(response.rfile);
						}else{
						
						}
					}
				});

			   reader.readAsDataURL(f);
			 } else {
			   //이미지 파일 아닐 경우 대체 이미지
			 }
		   })
		 }
	   })

  })

  function delImg(button) {
      $(button).closest('li').remove();
    }

  function delImg1(id) {

            var num = id;
		    $("#btn"+id).closest('li').remove();
		    $("#ufile"+id).val('');
		    $("#rfile"+id).val('');
 
			var message = "";
			$.ajax({

				url: "./ajax.schedule_imgdel.php",
				type: "POST",
				data: {
					
						"num"        :  id,
						"detail_idx" :  $('#detail_idx').val(),
						"day_idx"    :  $('#day_idx').val(),
						"groups"     :  $('#groups').val(),
						"onum"       :  $('#onum').val(),
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function(data, textStatus) {
					message = data.message;
					alert(message);
					//location.reload();
				},
				error:function(request,status,error){
					alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
				}
			});

			$('#file_add0'+num).closest("div").removeClass("applied").find('label').css(
				{"background-image":"url('')","background-repeat":"no-repeat","background-size":"cover"}
			);

			//$('#file_add0'+num).closest("div").addClass('applied');
			//if (num == '1')
			//{
			//	$('#ufile_chk').val(response.ufile);
			//}

 
    }

  function delImg1_ex(id) {
      $("#btn"+id).closest('li').remove();
      $("#ufile_ex_"+id).val('');
      $("#rfile_ex_"+id).val('');
    }
</script>

<script>
	//이미지 등록
	//$('input:file').off('click').on('click',function(){


    //});
</script>

<script>
  function add_it() {
    var cnt  = parseInt($(".sch_list").length) + 1;
	var days = $("#days").val();
    $.ajax({
		  url: "ajax.add_it.php",
		  type: "POST",
		  data: "cnt=" + cnt+'&days='+days,
		  error: function (request, status, error) {
			//통신 에러 발생시 처리
			alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
		  },
		  complete: function (request, status, error) {
			//				$("#ajax_loader").addClass("display-none");
		  },
		  success: function (response, status, request) {
			//alert(response);
			console.log(response);
			$(".main_list").append(response);
		  }
    });
  }

  function update_it()
  {
	    	if (!confirm("여행일정을 정말 수정하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
                return false;

     		var cnt  = parseInt($(".sch_list").length);
			var message = "";
			$.ajax({

				url: "./ajax.update_it.php",
				type: "POST",
				data: {
					
						
					"product_idx" : $("#product_idx").val(),
					"air_code"    : $("#air_code").val(),
					"day_idx"     : cnt,
					"days"        : $("#days").val()
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

  function remove_it() {
    var cnt = parseInt($(".sch_list").length);
    if (cnt > 1) {
      $(".sch_list:eq(" + (parseInt(cnt) - 1) + ")").remove();
    }
  }
</script>
<script>
  function del_it() {
    if (confirm(" 삭제후 복구하실수 없습니다. \n\n 삭제하시겠습니까?")) {
      hiddenFrame.location.href = "del.php?a_idx[]=<?=$a_idx?>&mode=view";
    }
  }

  function del_detail(air_code) {
    if (confirm("삭제하시겠습니까?\n삭제후에는 복구가 불가합니다.")) {
      hiddenFrame.location.href = "/AdmMaster/_tourRegist/detail_del.php?product_idx=<?=$product_idx?>&air_code=" +
        air_code;
    }
  }
</script>
<iframe width="300" height="300" name="hiddenFrame" id="hiddenFrame" src="" style="display:none"></iframe>
<?= $this->endSection() ?>