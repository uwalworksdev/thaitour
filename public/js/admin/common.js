(function ($) {
    $.fn.alphanumeric = function (p) {
        var input = $(this),
            az = "abcdefghijklmnopqrstuvwxyz_.",
            options = $.extend({
                ichars: '!@#$%^&*()+=[]\\\';,/{}|":<>?~`. ',
                nchars: '',
                allow: ''
            }, p),
            s = options.allow.split(''),
            i = 0,
            ch,
            regex;

//		$(this).attr({'style':'ime-mode:disabled'});
		$(this).css('ime-mode', 'disabled'); 


        for (i; i < s.length; i++) {
            if (options.ichars.indexOf(s[i]) != -1) {
                s[i] = '\\' + s[i];
            }
        }


        if (options.nocaps) {
            options.nchars += az.toUpperCase();
        }
        if (options.allcaps) {
            options.nchars += az;
        }


        options.allow = s.join('|');


        regex = new RegExp(options.allow, 'gi');
        ch = (options.ichars + options.nchars).replace(regex, '');


        input.keypress(function (e) {
            var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);


            if (ch.indexOf(key) != -1 && !e.ctrlKey) {
                e.preventDefault();
            }
        });


        input.blur(function () {
            var value = input.val(),
                j = 0;


            for (j; j < value.length; j++) {
                if (ch.indexOf(value[j]) != -1) {
                    input.val('');
                    return false;
                }
            }
            return false;
        });


        return input;
    };


    $.fn.numeric = function (p) {
        var az = 'abcdefghijklmnopqrstuvwxyz',
            aZ = az.toUpperCase();


        return this.each(function () {
//            $(this).attr({'style':'ime-mode:disabled'});
			$(this).css('ime-mode', 'disabled'); 
            $(this).alphanumeric($.extend({ nchars: az + aZ }, p));
        });
    };


    $.fn.alpha = function (p) {
        var nm = '1234567890';
        return this.each(function () {
            $(this).alphanumeric($.extend({ nchars: nm }, p));
        });
    };

})(jQuery);


// alert + focus
function af(msg, obj){
	if(msg != "") alert(msg);
	if(obj != undefined) obj.focus();
	return false;
}

function popOpen( pW , pH , pUrl , pName ) {
 
	var pL = parseInt((window.screen.width-pW)/2); 							// 해상도가로
	var pT = parseInt((window.screen.height-pH)/2); 						// 해상도세로
	var pProp = 'width=' + pW + ',height=' + pH + ',scrollbars=yes,resizable=no,left=' + pL + ',top=' + pT + ',directories=no,status=no,menubar=no';

	var newWin = window.open( pUrl , pName, pProp );
	if (!newWin)
		alert('차단된 팝업창을 허용해 주세요.');
	else
		newWin.focus();
}

function number_format(n) {
	var reg = /(^[+-]?\d+)(\d{3})/;   // 정규식
	n += '';                          // 숫자를 문자열로 변환

	while (reg.test(n))
	n = n.replace(reg, '$1' + ',' + '$2');
	return n;
}

// 콤마를 제거
function removeComma(s) {
    var rtn = parseFloat(s.replace(/,/gi, ""));
    if (isNaN(rtn)) {
        return 0;
    }
    else {
        return rtn;
    }
}

function phone_chk(ph)
{
    var pattern = new RegExp(/^[0-9-+]+$/); //전화번호 검증
	/*
  또는
    var pattern = new RegExp(/^[a-z0-9_]+$/); //아이디 검증 
  또는

    var pattern = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/); //날짜 형식 검증

  또는

    var pattern = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/); //이메일 형식 검증
	*/

   return pattern.test(ph);
}

function mail_chk(ph)
{
	var pattern = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/); //이메일 형식 검증
	return pattern.test(ph);
}


function nick_check(vals){

	var str = document.getElementById(vals);



	if( str.value == '' || str.value == null ){
		alert( '닉네임을 입력해주세요' );
		return;
	}

	var blank_pattern = /^\s+|\s+$/g;
	if( str.value.replace( blank_pattern, '' ) == "" ){
		alert('닉네임에 공백만 입력되었습니다 ');
		return;
	}


//공백 금지
	//var blank_pattern = /^\s+|\s+$/g;(/\s/g
	var blank_pattern = /[\s]/g;
	if( blank_pattern.test( str.value) == true){
		alert('닉네임에 공백은 사용할 수 없습니다. ');
		return;
	} 

	var special_pattern = /[`~!@#$%^&*|\\\'\";:\/?]/gi;

	if( special_pattern.test(str.value) == true ){
		alert('닉네임에 특수문자는 사용할 수 없습니다.');
		return;
	}

	//alert( '최종 : ' + str.value );

	/*
	if( str.value.search(/\W|\s/g) > -1 ){
		alert( '특수문자 또는 공백을 입력할 수 없습니다.' );
		str.focus();
		return false;
	}*/



}


function check(f) {
  var len;
  var str = f.value;
  str = str.replace(/,/g,'');
  var str1 = '';

  len = str.length;

  if(len>3) {
    for(var i=0;len-i-3>0;i+=3) {
      str1 = ','+str.substring(len-3-i,len-i)+str1;
    }
    str1 = str.substring(0,len-i)+str1;
    f.value = str1;
  }
}

function fc_chk_byte(memo, num) 
 { 
	var str = memo.name;
	var ari_max=num;
	var ls_str = memo.value; // 이벤트가 일어난 컨트롤의 value 값 
	var li_str_len = ls_str.length; // 전체길이 

	// 변수초기화 
	var li_max = ari_max; // 제한할 글자수 크기 
	var i = 0;     // for문에 사용 
	var li_byte = 0;  // 한글일경우는 2 그밗에는 1을 더함 
	var li_len = 0;  // substring하기 위해서 사용 
	var ls_one_char = ""; // 한글자씩 검사한다 
	var ls_str2 = ""; // 글자수를 초과하면 제한할수 글자전까지만 보여준다. 

  for(i=0; i< li_str_len; i++) 
  { 
   // 한글자추출 
   ls_one_char = ls_str.charAt(i); 
 
    li_byte++; 
   // 전체 크기가 li_max를 넘지않으면 
   if(li_byte <= li_max){ 
    li_len = i + 1; 
   } 
  } 
 
	document.getElementById(str+"_num").innerHTML = li_len;
	// 전체길이를 초과하면 
	if(li_byte > li_max){ 
		alert(num+" 자를 초과 입력할수 없습니다. \n 초과된 내용은 자동으로 삭제 됩니다. "); 
		ls_str2 = ls_str.substr(0, li_len); 
		document.getElementById(str+"_num").innerHTML = li_max;
		memo.value = ls_str2; 
	} 
	memo.focus(); 
} 


function fc_chk_byte_en(memo, num) 
 { 
  var ari_max=num;
  var ls_str = memo.value; // 이벤트가 일어난 컨트롤의 value 값 
  var li_str_len = ls_str.length; // 전체길이 
 
  // 변수초기화 
  var li_max = ari_max; // 제한할 글자수 크기 
  var i = 0;     // for문에 사용 
  var li_byte = 0;  // 한글일경우는 2 그밗에는 1을 더함 
  var li_len = 0;  // substring하기 위해서 사용 
  var ls_one_char = ""; // 한글자씩 검사한다 
  var ls_str2 = ""; // 글자수를 초과하면 제한할수 글자전까지만 보여준다. 
 
  for(i=0; i< li_str_len; i++) 
  { 
   // 한글자추출 
   ls_one_char = ls_str.charAt(i); 
 
   // 한글이면 2를 더한다. 
   if (escape(ls_one_char).length > 4) { 
    li_byte += 2; 
   }else{   // 그밗의 경우는 1을 더한다. 
    li_byte++; 
   } 
   // 전체 크기가 li_max를 넘지않으면 
   if(li_byte <= li_max){ 
    li_len = i + 1; 
   } 
  } 
 
  // 전체길이를 초과하면 
  if(li_byte > li_max){ 
   alert("The contents are limited to "+num+" bytes. Excess contents will be deleted automatically."); 
   ls_str2 = ls_str.substr(0, li_len); 
   memo.value = ls_str2; 
  } 
  memo.focus(); 
 } 

 function fc_chk2() 
 { 
  if(event.keyCode == 13) 
  event.returnValue=false; 
 } 



function check_ext(str){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.jpg|.jpeg|.gif|.png)/)) {
             // ok
         }else{
            alert(".이미지파일을 선택하셔야 합니다.")
            event.srcElement.select();
             //document.selection.clear();

			if (document.getSelection) { // for Firefox
				 str.value = '';
			 } else if (document.selection && document.selection.createRange) { // for IE
				 str.select();
				if (document.selection) {
					document.selection.clear(); // IE
				} else {
					window.getSelection().removeAllRanges();
				}
			} 

             return false;
         }
     }
 }

function check_exe(str){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.exe)/)) {
            alert(".exe파일은 첨부가 불가합니다.")
            event.srcElement.select();
             //document.selection.clear();

			if (document.getSelection) { // for Firefox
				 str.value = '';
			 } else if (document.selection && document.selection.createRange) { // for IE
				 str.select();
				if (document.selection) {
					document.selection.clear(); // IE
				} else {
					window.getSelection().removeAllRanges();
				}
			} 

             return false;
         }
     }
 }

function check_ext_ai(str){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.ai)/)) {
             // ok
         }else{
            alert("AI이미지파일을 선택하셔야 합니다.")
            event.srcElement.select();
             //document.selection.clear();

			if (document.getSelection) { // for Firefox
				 str.value = '';
			 } else if (document.selection && document.selection.createRange) { // for IE
				 str.select();
				if (document.selection) {
					document.selection.clear(); // IE
				} else {
					window.getSelection().removeAllRanges();
				}
			} 

             return false;
         }
     }
 }

function check_ext2(){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.jpg|.tiff|.pdf|.jpeg|.gif|.png)/)) {
             // ok
         }else{
             alert("이미지 파일을 선택하세요.")
            event.srcElement.select();
             document.selection.clear();
             return false;
         }
     }
		alert(this.files[0].size);

 }
function check_ai(){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.ai)/)) {
             // ok
         }else{
             alert("AI 파일을 선택하세요.")
            event.srcElement.select();
             document.selection.clear();
             return false;
         }
     }
		alert(this.files[0].size);

 }
function check_ai_en(){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.ai)/)) {
             // ok
         }else{
             alert("Please Select AI file.")
            event.srcElement.select();
             document.selection.clear();
             return false;
         }
     }
		alert(this.files[0].size);

 }

function check_ext2_en(){
     if(event.srcElement.value){
         if(event.srcElement.value.toLowerCase().match(/(.jpg|.tiff|.pdf|.jpeg|.gif|.png)/)) {
             // ok
         }else{
             alert("Please select only jpg, gif, giff, pdf, png file .")
            event.srcElement.select();
             document.selection.clear();
             return false;
         }
     }
		alert(this.files[0].size);

 }

function Close2(){
	$(".pupupLayer").remove();
}

function openPopLayer(src, w, h) {
if (!w) w = 600;
if (!h) h = 400;
$("body").append('<div class="pupupLayer"></div>');
var popupLayer = $('.pupupLayer');
var cssObj = {
'position': 'fixed'
, '_position': 'absolute'
, 'top': '0'
, 'left': '0'
, 'width': '100%'
, 'height': '100%'
, 'z-index': '10000'
, 'display': 'none'
}
popupLayer.css(cssObj);
popupLayer.append('<div class="bg"></div>');
var bg = $('.pupupLayer .bg');
cssObj = {
'position': 'absolute'
, 'top': '0'
, 'left': '0'
, 'width': '100%'
, 'height': '100%'
, 'background': '#000'
, 'opacity': '.1'
, 'filter': 'alpha(opacity=10)'
}
bg.css(cssObj);
popupLayer.append('<div class="layerArea"></div>');
var area = $('.pupupLayer .layerArea');
cssObj = {
'position': 'absolute'
, 'top': '50%'
, 'left': '50%'
, 'width': w + 'px'
, 'height': h + 'px'
, 'background': '#fff'
, 'border': '1px solid #ddd'
}
area.css(cssObj);
area.append('<iframe src=' + src + ' frameBorder="2" width="100%" height="100%" scrolling="auto"> </iframe>');
if (area.outerHeight() < $(document).height()) area.css('margin-top', '-' + area.outerHeight() / 2 + 'px');
else area.css('top', '0px');
if (area.outerWidth() < $(document).width()) area.css('margin-left', '-' + area.outerWidth() / 2 + 'px');
else area.css('left', '0px');
area.append('<img class="layerCloseBtn" src="http://www.kibs.com/bbs_img/layer_close.gif" alt="닫기" />');
var closeBtn = $('.pupupLayer .layerCloseBtn');
cssObj = {
'position': 'absolute'
, 'padding': '5px'
, 'top': '-6px'
, 'left': (area.outerWidth() - 30) + 'px'
, 'cursor': 'pointer'
}
closeBtn.css(cssObj);
popupLayer.fadeIn(200);
closeBtn.click(function () {
popupLayer.fadeOut(200, function () { popupLayer.remove() });
})
} 

function checkNumber(){ 
	var objEv = event.srcElement; 
	var numPattern = /([^0-9])/; 
	numPattern = objEv.value.match(numPattern); 
	if(numPattern != null){ 
//		alert("숫자만 입력해 주세요!"); 
		objEv.value=""; 
		objEv.focus(); 
		return false; 
	} 
} 



$(function()

{

 $(document).on("keyup", "input[numberOnly]", function(e) {
		if( ( e.keyCode >=  48 && e.keyCode <=  57 ) ||   //숫자열 0 ~ 9 : 48 ~ 57
		( e.keyCode >=  96 && e.keyCode <= 105 ) ||   //키패드 0 ~ 9 : 96 ~ 105
		e.keyCode ==   8 ||    //BackSpace
		e.keyCode ==  46 ||    //Delete
		e.keyCode == 109 ||    //소수점(.) : 문자키배열
		e.keyCode == 110 ||    //소수점(.) : 문자키배열
		e.keyCode == 190 ||    //소수점(.) : 키패드
		e.keyCode ==  37 ||    //좌 화살표
		e.keyCode ==  39 ||    //우 화살표
		e.keyCode ==  35 ||    //End 키
		e.keyCode ==  36 ||    //Home 키
		e.keyCode ==   9 ||    //Tab 키
		e.keyCode ==  13    // Enter 키
		) {
		} else {
			$(this).val($(this).val().replace(/[^0-9-]/gi,"") );
		}
	}
);

 $(document).on("keyup", "input:text[datetimeOnly]", function() {$(this).val( $(this).val().replace(/[^0-9:\-]/gi,"") );});

}); 


//콤마찍기
function numberFormat(num) {
	var pattern = /(-?[0-9]+)([0-9]{3})/;
	while(pattern.test(num)) {
		num = num.replace(pattern,"$1,$2");
	}
	return num;
}

//콤마제거
function unNumberFormat(num) {
	return (num.replace(/\,/g,""));
}


function getXMLHttpRequest() {
	if (window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e1) { return null; }
		}
	} else if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}
var httpRequest = null;

function sendRequest(url, params, callback, method) {
	httpRequest = getXMLHttpRequest();
	var httpMethod = method ? method : 'GET';
	if (httpMethod != 'GET' && httpMethod != 'POST') {
		httpMethod = 'GET';
	}
	var httpParams = (params == null || params == '') ? null : params;
	var httpUrl = url;
	if (httpMethod == 'GET' && httpParams != null) {
		httpUrl = httpUrl + "?" + httpParams;
	}
	httpRequest.open(httpMethod, httpUrl, true);
	httpRequest.setRequestHeader(
		'Content-Type', 'application/x-www-form-urlencoded');
	httpRequest.onreadystatechange = callback;
	httpRequest.send(httpMethod == 'POST' ? httpParams : null);
}

function cfSetFile(param)
{
 var frm = document.frm;
 var fileName = frm.bfile1.value;
 frm.filename1.value = fileName;
}

function cfSetFile2(param)
{
 var frm = document.frm;
 var fileName = frm.bfile2.value;
 frm.filename2.value = fileName;
}

function cancel_it()
{
	if (confirm("작성을 취소하시겠습니까?"))
	{
		location.href="/kor/";
	}
}

function checkForNumber() {
	var key = event.keyCode;
	if(!(key==8||key==9||key==13||key==46||key==144||
	(key>=48&&key<=57)||(key>=96&&key<=105)||key==190)) {
		event.returnValue = false;
	}
}

function email_chk(email){
	var mail = email;
	var t = escape(mail);
	var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/; 



	if(regex.test(t) === false) {  
		return false;
	} else {
		return true;
	}
}

function zipcode(frm, zip1, zip2, addr1, addr2, addr3)
{
	var left_size = (screen.width-500)/2;
	var top_size = (screen.height-150)/2;
	var post_zip = window.open("/zipcode/zip.asp?frm="+frm+"&zip1="+zip1+"&zip2="+zip2+"&addr1="+addr1+"&addr2="+addr2+"&addr3="+addr3+"", 'popupName', 'width=600, height=600, left=50, top=50, statusbar=0, scrollbars=0'); 
//	window.close();
//	window.open ("postcode.php","","width=500 height=150 top="+top_size+" left="+left_size);
}   

function get_sido(strs)
{
        $.ajax({
            type:"GET"
            , url:"../../ajax/get_sido.php"
			, dataType : "html" //전송받을 데이터의 타입
			, timeout : 30000 //제한시간 지정
			, cache : false  //true, false
			, data : "sido_id="+ encodeURI(strs) //서버에 보낼 파라메터
            , success:function(json){
				$("select[name='gugun_id'").find('option').each(function() {
					$(this).remove();
				});
				$("select[name='dong_id'").find('option').each(function() {
					$(this).remove();
				});
				$("select[name='dong_id']").append("<option value=''>읍/면/동 선택</option>");
                var list = $.parseJSON(json);
				var listLen = list.length;
				var contentStr = "";
				$("select[name='gugun_id']").append("<option value=''>구/군 선택</option>");
				for(var i=0; i<listLen; i++){
					if (list[i].idx == "<?=$gugun?>" )
					{
					$("select[name='gugun_id']").append("<option value='"+list[i].gugun+"' selected>"+list[i].gugun+"</option>");
					} else {
					$("select[name='gugun_id']").append("<option value='"+list[i].gugun+"'>"+list[i].gugun+"</option>");
					}
				}
            }
        });
}

//동이름 가져오기
function get_dong(strs)
{
        $.ajax({
            type:"GET"
            , url:"../../ajax/get_dong.php"
			, dataType : "html" //전송받을 데이터의 타입
			, timeout : 30000 //제한시간 지정
			, cache : false  //true, false
			, data : "gugun="+encodeURI(strs)+"&sido="+encodeURI(document.getElementById("sido_id").value)  //서버에 보낼 파라메터
			, error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
			}
            , success:function(json){
				$("select[name='dong_id'").find('option').each(function() {
					$(this).remove();
				});
                var list = $.parseJSON(json);
				var listLen = list.length;
				var contentStr = "";
				$("select[name='dong_id']").append("<option value=''>선택</option>");
				for(var i=0; i<listLen; i++){
					if (list[i].idx == "<?=$dong?>" )
					{
					$("select[name='dong_id']").append("<option value='"+list[i].dong+"' selected>"+list[i].dong+"</option>");
					} else {
					$("select[name='dong_id']").append("<option value='"+list[i].dong+"'>"+list[i].dong+"</option>");
					}
				}
            }
        });
}

function alert_(msg, gubun, time)
{
	if (time == undefined)
	{
		time = 1000;
	}
	if (gubun == undefined)
	{
		gubun = "success";
	}
	notif({
		type: gubun,
		msg: msg,
		width: "all",
		position: "center",
		timeout: time
	});
}

function blank()
{
	return;
}


function ByteCount(obj, maxlength, gubun) {
    var str = obj.value; // 이벤트가 일어난 컨트롤의 value 값

    var str_length = str.length; // 전체길이
 
    // 변수초기화
    var max_length = maxlength; // 제한할 글자수 크기
    var i = 0; // for문에 사용
    var ko_byte = 0; // 한글일경우는 2 그밗에는 1을 더함
    var li_len = 0; // substring하기 위해서 사용
    var one_char = ""; // 한글자씩 검사한다
    var str2 = ""; // 글자수를 초과하면 제한할수 글자전까지만 보여준다.
 
    for (i = 0; i < str_length; i++) {
        // 한글자추출
        one_char = str.charAt(i);
 
        // 한글이면 2를 더한다.
        if (escape(one_char).length > 4) {
            ko_byte += 2;
        }
        // 그밗의 경우는 1을 더한다.
        else {
            ko_byte++;
        }
 
        // 전체 크기가 max_length를 넘지않으면
        if (ko_byte <= max_length) {
            li_len = i + 1;
        }
    }
	$("#"+gubun).html(li_len);
 
    // 전체길이를 초과하면
    if (ko_byte > max_length) {
        alert(max_length+" Byte 를초과 입력할수 없습니다. ");
    }
    obj.focus();
 
}


function changeEmail() {
	if (document.getElementById("email3").value != "")
	{
		document.getElementById("email2").readOnly = true;
	} else {
		document.getElementById("email2").readOnly = false;
	}
	document.getElementById("email2").value = document.getElementById("email3").value;
}

	function changeEmails(str) {
		if (document.getElementById(str+"3").value != "")
		{
			document.getElementById(str+"2").readOnly = true;
		} else {
			document.getElementById(str+"2").readOnly = false;
		}
		document.getElementById(str+"2").value = document.getElementById(str+"3").value;
	}

	function autoHypenPhone(str){
				str = str.replace(/[^0-9:\-]/g, '');
				var tmp = '';
				if( str.length < 4){
					return str;
				}else if(str.length < 7){
					tmp += str.substr(0, 3);
					tmp += '-';
					tmp += str.substr(3);
					return tmp;
				}else if(str.length < 11){
					tmp += str.substr(0, 3);
					tmp += '-';
					tmp += str.substr(3, 3);
					tmp += '-';
					tmp += str.substr(6);
					return tmp;
				}else{              
					tmp += str.substr(0, 3);
					tmp += '-';
					tmp += str.substr(3, 4);
					tmp += '-';
					tmp += str.substr(7);
					return tmp;
				}
				return str;
	}


function mphon(obj) { 
	obj.value =  PhonNumStr( obj.value ); 
} 

 


function PhonNumStr( str ){ 

  var RegNotNum  = /[^0-9]/g; 

  var RegPhonNum = ""; 

  var DataForm   = ""; 


  // return blank     

  if( str == "" || str == null ) return ""; 

 

  // delete not number

  str = str.replace(RegNotNum,''); 


  /* 4자리 이하일 경우 아무런 액션도 취하지 않음. */

  if( str.length < 4 ) return str; 

  /* 지역번호 02일 경우 10자리 이상입력 못하도록 제어함. */

  if(str.substring(0,2)=="02" && str.length > 10){
   str = str.substring(0, 10);
  } 

  if( str.length > 3 && str.length < 7 ) { 
   if(str.substring(0,2)=="02"){
    DataForm = "$1-$2"; 

    RegPhonNum = /([0-9]{2})([0-9]+)/; 
   
   } else {
    DataForm = "$1-$2"; 

    RegPhonNum = /([0-9]{3})([0-9]+)/; 
   }
  } else if(str.length == 7 ) {
   if(str.substring(0,2)=="02"){
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{2})([0-9]{3})([0-9]+)/; 
   } else {
    DataForm = "$1-$2"; 

    RegPhonNum = /([0-9]{3})([0-9]{4})/; 
   }
  } else if(str.length == 9 ) {
    if(str.substring(0,2)=="02"){
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{2})([0-9]{3})([0-9]+)/; 
   } else {
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{3})([0-9]{3})([0-9]+)/; 
   }
  } else if(str.length == 10){ 
   if(str.substring(0,2)=="02"){
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{2})([0-9]{4})([0-9]+)/; 
   }else{
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{3})([0-9]{3})([0-9]+)/;
   }
  } else if(str.length > 10){ 
   if(str.substring(0,2)=="02"){
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{2})([0-9]{4})([0-9]+)/; 
   }else{
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{3})([0-9]{4})([0-9]+)/; 
   }
  } else {  
   if(str.substring(0,2)=="02"){
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{2})([0-9]{3})([0-9]+)/; 
   }else{
    DataForm = "$1-$2-$3"; 

    RegPhonNum = /([0-9]{3})([0-9]{3})([0-9]+)/;
   }
  }


  while( RegPhonNum.test(str) ) {  

   str = str.replace(RegPhonNum, DataForm);  

  } 

  return str; 

} 

function trim(str) {
    str = str.replace(/ /g, ''); 
    return str;

} 

function login_naver() {
	//window_open('/oauth-api/login_with_naver.php')
	popOpen( 600, 600, '/oauth-api/login_with_naver.php', 'naver')
}
function login_google() {
	popOpen( 800, 600, '/oauth-api/login_with_google.php', 'google')
}
function login_facebook() {
	popOpen( 800, 700, '/oauth-api/login_with_facebook.php', 'facebook')
}
function login_daum() {
	//window_open('/oauth-api/login_with_kaokao.php')
	popOpen( 600, 600, '/oauth-api/login_with_daum.php', 'daum')
}
function login_twitter() {
	//window_open('/oauth-api/login_with_kaokao.php')
	popOpen( 600, 600, '/oauth-api/login_with_twitter.php', 'daum')
}

function replaceAll(str, searchStr, replaceStr) {
	if(str != undefined)
	{
    return str.split(searchStr).join(replaceStr);
	}
}

 
function pop_wish(t_idx)
{
	$.colorbox({iframe:true,href:"/mypage/pop_wish.php?t_idx[]="+t_idx, width:"700px", height:"580x"});
}

	function cart_it(str)
	{
		$.ajax({
			url: "/product_image/cart_it.php",
			type: "POST",
			data: "t_idx[]="+str,
			error : function(request, status, error) {
			 //통신 에러 발생시 처리
				alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
				$("#ajax_loader").addClass("display-none");
			}
			,complete: function(request, status, error) {
			}
			, success : function(response, status, request) {
				if (response == "OK")
				{
					location.href="/mypage/cart.php";
					return;
				} else if (response == "OV") {
					alert("이미 카트에 담으셨습니다.");
					return;
				} else if (response == "NL") {
					alert("로그인 하셔야 합니다.");
					return;
				} else {
					alert(response);
					alert("오류가 발생하였습니다!!");
					return;
				}
			}
		});
	}

function purchase_it(str)
{
	$.colorbox({iframe:true,href:"/mypage/pop_purchase.php?t_idx[]="+str, width:"700px", height:"710x"});
}


function getCookie(name) { 
	var Found = false 
	var start, end 
	var i = 0 
	 
	while(i <= document.cookie.length) { 
	start = i 
	end = start + name.length 
	 
	if(document.cookie.substring(start, end) == name) { 
	Found = true 
	break 
	} 
	i++ 
	} 
	 
	if(Found == true) { 
	start = end + 1
	end = document.cookie.indexOf(";", start) 
	if(end < start) 
	end = document.cookie.length 
	return document.cookie.substring(start, end) 
	} 
	return "" 
} 

function setCookie( name, value, expiredays ) {  
    var todayDate = new Date();  
        todayDate.setDate( todayDate.getDate() + expiredays );  
        document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"  
}  

function chk_eng(str){ return str.search(/[a-zA-Z]/g); } function chk_num(str){ return str.search(/[0-9]/g); }
function chk_length(str, min, max){ return (str.length >= min && str.length <= max)?true:false; }

function fnDateAdd(val,dateType,iNum) {
    var _strDate = null;
    var parts = val.split('-');
    var iYar = Number(parts[0]);
    var iMonth = Number(parts[1]) - 1;
    var iDay = Number(parts[2]);
    switch (dateType) {
        case "y":
            iYar = iYar + iNum;
            break;
        case "m":
            iMonth = iMonth + iNum;
            break;
        case "d":
            iDay = iDay + iNum;
            break;
        default:
    }
    var now = new Date(iYar, iMonth, iDay);
    var year = now.getFullYear();
    var mon = (now.getMonth() + 1) > 9 ? '' + (now.getMonth() + 1) : '0' + (now.getMonth() + 1);
    var day = now.getDate() > 9 ? '' + now.getDate() : '0' + now.getDate();
    return year+'-'+mon+'-'+day;
}

function date_diff(d1, d2) {
	a = new Date(d1);
	b = new Date(d2);
	return Math.round(a-b)/86400000;
}

function execDaumPostcode(frm_name, zip, addr1, addr2) {
	var of = document[frm_name];

	new daum.Postcode({
		oncomplete: function(data) {

			var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
			var extraRoadAddr = ''; // 도로명 조합형 주소 변수

			// 법정동명이 있을 경우 추가한다. (법정리는 제외)
			// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
			if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
				extraRoadAddr += data.bname;
			}
			// 건물명이 있고, 공동주택일 경우 추가한다.
			if(data.buildingName !== '' && data.apartment === 'Y'){
			   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
			}
			// 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
			if(extraRoadAddr !== ''){
				extraRoadAddr = ' (' + extraRoadAddr + ')';
			}
			// 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
			if(fullRoadAddr !== ''){
				fullRoadAddr += extraRoadAddr;
			}
			// 주소 정보를 해당 필드에 넣는다.


			of[zip].value = data.zonecode;
			of[addr1].value = fullRoadAddr;
			of[addr2].focus();

			/*
			frm.zip.value = data.zonecode;
			frm.addr1.value = fullRoadAddr;
			//document.getElementById("addr2").value = data.jibunAddress;
			frm.addr2.focus();
			*/

			/*
			document.getElementById("sido").value = data.sido;;
			document.getElementById("gugun").value = data.sigungu;
			document.getElementById("dong").value = data.bname;;
			*/



		}
	}).open();
}

var fileInputs = document.querySelectorAll('input[type="file"]');
	fileInputs.forEach(function(input) {
		var button = document.createElement('button');
		button.type = 'button';
		button.textContent = '선택파일';
		var fileNameSpan = document.createElement('span');
        fileNameSpan.className = "name_file_inp_"
		fileNameSpan.textContent = '선택된 파일 없음';
		button.addEventListener('click', function() {
			input.click();
		});
		input.addEventListener('change', function() {
			if (input.files.length > 0) {
				fileNameSpan.textContent = input.files[0].name;
			} else {
				fileNameSpan.textContent = ''; 
			}
		});

		var container = document.createElement('div');
		container.id = 'input_file_ko';
		container.appendChild(button);
		container.appendChild(fileNameSpan);
		input.parentNode.insertBefore(container, input);
		input.style.display = 'none';
});



$(document).ready(function(){

	//숫자만

	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	$(".onlynump").keyup(function(){$(this).val( $(this).val().replace(/[^0-9-]/g,"") );} );

	//영문만
	 $(".onlyeng").css("ime-mode","disabled");
	 $(".onlyeng").keyup(function(){$(this).val( $(this).val().replace(/[^\!-z]/g,"") );} );


	//한글 금지
	 $(".nothangul").keyup(function(){$(this).val( $(this).val().replace(/[^a-zA-Z0-9_-]/g,"") );} );


});

function PopCloseBtn(selector) {
	$(selector).hide();
}

function updateQueryParam(param, value) {
    let url = new URL(window.location);

    url.searchParams.set(param, value); 

    window.history.pushState({}, '', url);
}

function resetQueryParams() {
    let url = new URL(window.location);
    url.search = '';
    window.history.replaceState({}, '', url);
}