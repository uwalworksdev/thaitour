$(function () {
    $("#hiddenFrame").on('load', function () {
        $("#ajax_loader").addClass("display-none");
    });
})

function get_code(strs, depth, product_code_) {
    $.ajax({
        type: "GET"
        , url: "/ajax/get_code"
        , dataType: "html" //전송받을 데이터의 타입
        , timeout: 30000 //제한시간 지정
        , cache: false  //true, false
        , data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
        , error: function (request, status, error) {
            //통신 에러 발생시 처리
            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
        }
        , success: function (json) {
            //alert(json);
            if (depth <= 3) {
                $("#product_code_2").find('option').each(function () {
                    $(this).remove();
                });
                $("#product_code_2").append("<option value=''>2차분류</option>");
            }

            if (depth <= 4) {
                $("#product_code_3").find('option').each(function () {
                    $(this).remove();
                });
                $("#product_code_3").append("<option value=''>3차분류</option>");
            }

            if (depth <= 5) {
                $("#product_code_4").find('option').each(function () {
                    $(this).remove();
                });
                $("#product_code_4").append("<option value=''>4차분류</option>");
            }

            var list = $.parseJSON(json);
            var listLen = list.length;
            var contentStr = "";
            for (var i = 0; i < listLen; i++) {
                contentStr = "";
                if (list[i].code_status == "C") {
                    contentStr = "[마감]";
                } else if (list[i].code_status == "N") {
                    contentStr = "[사용안함]";
                }

                let select = '';
                if (product_code_ == list[i].code_no) {
                    select = 'selected';
                } else {
                    select = '';
                }
                $("#product_code_" + (parseInt(depth - 1))).append("<option " + select + " value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
            }
        }
    });
}


function get_group(strs, depth) {
    $.ajax({
        type: "GET"
        , url: "../_code/get_group.ajax.php"
        , dataType: "html" //전송받을 데이터의 타입
        , timeout: 30000 //제한시간 지정
        , cache: false  //true, false
        , data: "parent_code_no=" + encodeURI(strs) + "&depth=" + depth //서버에 보낼 파라메터
        , error: function (request, status, error) {
            //통신 에러 발생시 처리
            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
        }
        , success: function (json) {
            //alert(json);
            if (depth <= 2) {
                $("#product_group_2").find('option').each(function () {
                    $(this).remove();
                });
                $("#product_group_2").append("<option value=''>2차분류</option>");
            }

            if (depth <= 3) {
                $("#product_group_3").find('option').each(function () {
                    $(this).remove();
                });
                $("#product_group_3").append("<option value=''>3차분류</option>");
            }

            if (depth <= 4) {
                $("#product_group_4").find('option').each(function () {
                    $(this).remove();
                });
                $("#product_group_4").append("<option value=''>4차분류</option>");
            }

            var list = $.parseJSON(json);
            var listLen = list.length;
            var contentStr = "";
            for (var i = 0; i < listLen; i++) {
                contentStr = "";
                if (list[i].code_status == "C") {
                    contentStr = "[마감]";
                } else if (list[i].code_status == "N") {
                    contentStr = "[사용안함]";
                }
                $("#product_group_" + (parseInt(depth))).append("<option value='" + list[i].code_no + "'>" + list[i].code_name + "" + contentStr + "</option>");
            }
        }
    });

    return this;
}


function send_it() {

    var frm = document.frm;

    // oEditors1.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
    // oEditors2.getById["caution"].exec("UPDATE_CONTENTS_FIELD", []);

    if (frm.product_code_list.value == "") {
        alert("카테고리를 등록해주세요.");
        frm.product_code_1.focus();
        return;
    }

    // if ($("#chk_product_code").val() == "N") {
    //     alert("중복된 제품 코드를 확인하세요.");
    //     return;
    // }

    if (frm.product_code.value == "") {
        alert("상품코드를 입력해주세요.");
        frm.product_code.focus();
        return;
    }


    if (frm.product_name.value == "") {
        alert("상품명을 입력해주세요.");
        frm.product_name.focus();
        return;
    }

    if($("#check_img_ufile1").length > 0 && !$("#check_img_ufile1").val() && $("#ufile1").get(0).files.length === 0){
        alert("이미지를 등록해주세요.");
        return false;
    }

    let _code_utilities = '';
    let _code_services = '';
    let _code_best_utilities = '';
    let _code_populars = '';

    $("input[name=_code_utilities]:checked").each(function () {
        _code_utilities += $(this).val() + '|';
    })

    $("#code_utilities").val(_code_utilities);

    let _code_mbtis = '';
    $("input[name=_code_mbti]:checked").each(function () {
        _code_mbtis += $(this).val() + '|';
    })

    $("#mbti").val(_code_mbtis);

    $("input[name=_code_services]:checked").each(function () {
        _code_services += $(this).val() + '|';
    })

    $("#code_services").val(_code_services);

    $("input[name=_code_best_utilities]:checked").each(function () {
        _code_best_utilities += $(this).val() + '|';
    })

    $("#code_best_utilities").val(_code_best_utilities);

    $("input[name=_code_populars]:checked").each(function () {
        _code_populars += $(this).val() + '|';
    })

    $("#code_populars").val(_code_populars);

    let list__room_name = $('.list__room_name');
    list__room_name.each(function () {
        let item = $(this);

        let sup__name_child = item.find('input.sup__name_child');

        let data = [];
        sup__name_child.each(function () {
            let item2 = $(this);
            let sup__name = item2.val();

            data.push(sup__name);
        })

        let data_convert = data.join('|');
        let nextInp = item.next();
        nextInp.val(data_convert);
    })

    let _product_theme = '';
    let _product_bedrooms = '';
    let _product_type = '';
    let _product_promotions = '';

    let product_theme_ = $('input[name="product_theme_"]');
    product_theme_.each(function () {
        _product_theme += $(this).val() + '|';
    })
    $("#product_theme").val(_product_theme);

    let product_bedroom_ = $('input[name="product_bedroom_"]');
    product_bedroom_.each(function () {
        _product_bedrooms += $(this).val() + '|';
    })
    $("#product_bedrooms").val(_product_bedrooms);

    let product_type_ = $('input[name="product_type_"]');
    product_type_.each(function () {
        _product_type += $(this).val() + '|';
    })
    $("#product_type").val(_product_type);

    let product_promotion_ = $('input[name="product_promotion_"]');
    product_promotion_.each(function () {
        _product_promotions += $(this).val() + '|';
    })
    $("#product_promotions").val(_product_promotions);

    // let meet_out_time = $("#meet_out_time").val();
    // let children_policy = $("#children_policy").val();
    // let baby_beds = $("#baby_beds").val();
    // let deposit_regulations = $("#deposit_regulations").val();
    // let pets = $("#pets").val();
    // let age_restriction = $("#age_restriction").val();
    // let smoking_policy = $("#smoking_policy").val();
    //
    // let breakfast = $("#breakfast").val();
    // let breakfasts_ = $('#tBodyTblBreakfast tr');
    // let data_temp = [];
    // breakfasts_.each(function () {
    //     let item = $(this);
    //     let name = item.find('input[name="breakfast_item_name_"]').val();
    //     let val = item.find('input[name="breakfast_item_value_"]').val();
    //
    //     let temp = {
    //         'name': name,
    //         'val': val
    //     };
    //
    //     data_temp.push(temp);
    // })
    //
    // let data_breakfast = {
    //     'breakfast': breakfast,
    //     'data': data_temp
    // };
    //
    // let product_more2 = {
    //     'meet_out_time': meet_out_time,
    //     'children_policy': children_policy,
    //     'baby_beds': baby_beds,
    //     'deposit_regulations': deposit_regulations,
    //     'pets': pets,
    //     'age_restriction': age_restriction,
    //     'smoking_policy': smoking_policy,
    //     'data_breakfast': data_breakfast,
    //     // 'data_breakfast': JSON.stringify(data_breakfast)
    // }
    //
    // let product_more = [];
    // product_more['meet_out_time'] = meet_out_time;
    // product_more['children_policy'] = children_policy;
    // product_more['baby_beds'] = baby_beds;
    // product_more['deposit_regulations'] = deposit_regulations;
    // product_more['pets'] = pets;
    // product_more['age_restriction'] = age_restriction;
    // product_more['smoking_policy'] = smoking_policy;
    // product_more['data_breakfast'] = data_breakfast;
    //
    // $("#product_more").val(product_more);

    $(".img_add_group .file_input").each(function (index) {
        $(this).find("input[name='onum_img[]']").val((index + 1));
    });

    oEditors1?.getById["product_important_notice"]?.exec("UPDATE_CONTENTS_FIELD", []);
    oEditors2?.getById["product_important_notice_m"]?.exec("UPDATE_CONTENTS_FIELD", []);
    oEditors3?.getById["product_notes"]?.exec("UPDATE_CONTENTS_FIELD", []);
    oEditors4?.getById["product_notes_m"]?.exec("UPDATE_CONTENTS_FIELD", []);
    oEditors5?.getById["room_guides"]?.exec("UPDATE_CONTENTS_FIELD", []);
    // oEditors6?.getById["important_notes"]?.exec("UPDATE_CONTENTS_FIELD", []);

    $("#ajax_loader").removeClass("display-none");
    frm.submit();
}

function send_it_price() {
    var frm = document.frm;

    let list__room_name = $('.list__room_name');
    list__room_name.each(function () {
        let item = $(this);

        let sup__name_child = item.find('input.sup__name_child');

        let data = [];
        sup__name_child.each(function () {
            let item2 = $(this);
            let sup__name = item2.val();

            data.push(sup__name);
        })

        let data_convert = data.join('|');
        let nextInp = item.next();
        nextInp.val(data_convert);
    })

    $("#ajax_loader").removeClass("display-none");
    frm.submit();
}

function del_it(url, g_idx) {
    if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") == false) {
        return;
    }
    $("#ajax_loader").removeClass("display-none");

    $.ajax({
        url: url,
        type: "POST",
        data: "g_idx[]=" + g_idx,
        error: function (request, status, error) {
            //통신 에러 발생시 처리
            alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
            $("#ajax_loader").addClass("display-none");
        }
        , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
        }
        , success: function (response, status, request) {
            $("#ajax_loader").addClass("display-none");
            alert_("정상적으로 삭제되었습니다.");
            window.location.href = '/AdmMaster/_hotel/list';
            return;
        }
    });
}


$(document).ready(function () {
    // 카테고리 추가 부분 시작
    $("#btn_reg_cate").click(function () {

        let tmp_code = "";
        let tmp_code_txt = "";

        let cate_code1 = $("#product_code_1").val();
        let cate_text1 = $("#product_code_1 option:selected").text();

        if (cate_code1) {
            tmp_code = cate_code1;
            tmp_code_txt += cate_text1;
        }

        let cate_code2 = $("#product_code_2").val();
        let cate_text2 = $("#product_code_2 option:selected").text();

        if (cate_code2) {

            tmp_code = cate_code2;
            tmp_code_txt += " > " + cate_text2;
        }

        let cate_code3 = $("#product_code_3").val();
        let cate_text3 = $("#product_code_3 option:selected").text();

        if (cate_code3) {
            tmp_code = cate_code3;
            tmp_code_txt += " > " + cate_text3;
        }

        if (tmp_code === "") {
            alert("카테고리를 선택해주세요.");
            return false;
        }

        console.log(cate_code2);
        addCategory(tmp_code, tmp_code_txt);

    });


    // 코드 중복 체크 검색창 변경 시에 체크 초기화
    $("#pop_search").change(function () {
        $("#chk_codeCnt").val("");
    });


    // 코드 중복 체크 닫기 버튼
    $(".btn_box > .close_btn").click(function () {
        // 검색 관련 전체 초기화
        $("#chk_codeType").val("");
        $("#chk_codeCnt").val("");
        $(".result_text").html("<strong>코드</strong>를 입력하신 후 조회해주세요.");
        $(".popup").hide();
    });

    // 코드 중복 체크 사용 버튼
    $(".btn_box > .ok_btn").click(function () {
        // 검색 관련 전체 초기화
        var chk_codeType = $("#chk_codeType").val();
        var chk_codeCnt = $("#chk_codeCnt").val();
        var pop_search = $("#pop_search").val();
        $(".result_text").html("<strong>코드</strong>를 입력하신 후 조회해주세요.");

        if (pop_search.trim() == "") {
            alert("코드를 입력해주세요.");
            return false;
        }

        if (chk_codeCnt == "") {
            alert("코드를 조회해주세요.");
            return false;
        }

        // 중복된 코드가 없을 때
        if (chk_codeCnt == "0") {

            if (chk_codeType == "code") {
                $("#product_code").val(pop_search);
            } else if (chk_codeType == "erp") {
                $("#goods_erp").val(pop_search);
            }


            $("#chk_codeType").val("");
            $("#chk_codeCnt").val("");
            $(".popup").hide();

        } else {
            alert("해당 코드를 사용할 수 없습니다.");
            return false;
        }
    });

    $(".name_search").click(function () {
        selectCode();
    });


    $("#pop_search").keyup(function (e) {
        if (e.keyCode == 13) {
            selectCode();
        }
    });


});


function selectCode() {
    var codeType = $("#chk_codeType").val();
    var searchCode = $("#pop_search").val();

    $.ajax({
        url: "/AdmMaster/_hotel/search_code",
        type: "POST",
        data: "codeType=" + codeType + "&searchCode=" + searchCode,
        error: function (request, status, error) {
            //통신 에러 발생시 처리
            alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
            $("#ajax_loader").addClass("display-none");
        }
        , complete: function (request, status, error) {

        }
        , success: function (response, status, request) {
            $("#chk_codeCnt").val(response.message);

            response = parseInt(response.message);

            if (response == 0) {
                $(".result_text").html("<p class='result_text'>요청하신 <strong>코드</strong>는 사용 <span>가능</span> 합니다.</p>");
            } else if (response > 0) {
                $(".result_text").html("<p class='result_text'>요청하신 <strong>코드</strong>는 사용 <span>불가능</span> 합니다.</p>");
            }


        }
    });
}


// 카테고리 추가 함수
function addCategory(code, cateText) {
    // 코드 추가 부분
    if (chkCategory(code) > -1) {
        alert("이미 등록된 카테고리입니다.");
        return false;
    }

    var tmp_product_code = $("#product_code_list").val() ?? "";
    console.log(code);

    tmp_product_code = tmp_product_code + "|" + code + "|";


    $("#product_code_list").val(tmp_product_code);

    var newList = "<li class='new'>[" + code + "] " + cateText + " <span onclick=\"delCategory('" + code + "', this);\" >삭제</span></li>";
    $("#reg_cate").append(newList);
}

// 카테고리 삭제 함수
function delCategory(code, obj) {

    if (chkCategory(code) > -1) {

        var tmp_product_code = $("#product_code_list").val();
        var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

        var code_array = re_tmp_product_code.split('||');

        var tmp_product_code_re = "";

        $.each(code_array, function (key, val) {
            if (val != code) {
                tmp_product_code_re = tmp_product_code_re + "|" + val + "|";
            }
        });

        $("#product_code_list").val(tmp_product_code_re);
        obj.closest("li").remove();

    }
}

// 카테고리 중복확인
function chkCategory(chkcode) {
    var tmp_product_code = $("#product_code_list").val();
    var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

    var code_array = re_tmp_product_code.split('||');

    return ($.inArray(chkcode, code_array));
}


// 색상 추가 함수
function addColor(code, cateText) {
    // 코드 추가 부분
    if (chkColor(code) > -1) {
        alert("이미 등록된 색상입니다.");
        return false;
    }
    var tmp_product_code = $("#product_color").val();
    tmp_product_code = tmp_product_code + "|" + code + "|";
    $("#product_color").val(tmp_product_code);

    //var newList =  "<li>["+code+"] "+cateText+" <span onclick=\"delCategory('"+code+"', this);\" >삭제</span></li>";

    var newList = "";
    newList += "<tr rel='" + code + "'>";
    newList += "	<td>";
    newList += "		" + cateText;
    newList += "	</td>";
    newList += "	<td>";
    newList += "		<select name='color" + code + "' id='color" + code + "' onchange='fn_color(this)' >";
    newList += "			<option value='Y'>사용</option>";
    newList += "			<option value='N'>중지</option>";
    newList += "		</select>";
    newList += "	</td>";
    newList += "	<td>";
    newList += "		<input type='text' name='' id='' readonly>";
    newList += "	</td>";
    newList += "	<td>";
    newList += "		<button class='btn_02' type='button' onclick='delColor(\"" + code + "\" , this)' >삭제</button>";
    newList += "	</td>";
    newList += "</tr>";

    $("#color_body").append(newList);
    sizeSetting();
}

// 색상 중복확인
function chkColor(chkcode) {
    var tmp_product_code = $("#product_color").val();
    var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

    var code_array = re_tmp_product_code.split('||');

    return ($.inArray(chkcode, code_array));
}

// 색상 삭제 함수
function delColor(code, obj) {

    if (chkColor(code) > -1) {

        var tmp_product_code = $("#product_color").val();
        var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

        var code_array = re_tmp_product_code.split('||');

        var tmp_product_code_re = "";

        $.each(code_array, function (key, val) {
            if (val != code) {
                tmp_product_code_re = tmp_product_code_re + "|" + val + "|";
            }
        });

        $("#product_color").val(tmp_product_code_re);
        obj.closest("tr").remove();
        sizeSetting();
    }
}


/*
////////////////////////////////////////////
*/

// 대표색상 추가 함수
function addDbColor(code, cateText) {
    // 코드 추가 부분
    if (chkDbColor(code) > -1) {
        alert("이미 등록된 대표색상입니다.");
        return false;
    }
    var tmp_product_code = $("#product_dbcolor").val();
    tmp_product_code = tmp_product_code + "|" + code + "|";
    $("#product_dbcolor").val(tmp_product_code);

    //var newList =  "<li>["+code+"] "+cateText+" <span onclick=\"delCategory('"+code+"', this);\" >삭제</span></li>";

    var newList = "";
    newList += "<span title='" + cateText + "' style='border: 1px solid rgb(204, 204, 204); border-image: none; background:" + code + ";margin-right:10px;cursor:pointer;' ondblclick='delDbColor(\"" + code + "\",this)' >&nbsp;&nbsp;&nbsp;&nbsp;</span> ";

    $("#selectColor").append(newList);

}

// 대표색상 중복확인
function chkDbColor(chkcode) {
    var tmp_product_code = $("#product_dbcolor").val();
    var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

    var code_array = re_tmp_product_code.split('||');

    return ($.inArray(chkcode, code_array));
}

// 대표색상 삭제 함수
function delDbColor(code, obj) {

    if (chkDbColor(code) > -1) {

        var tmp_product_code = $("#product_dbcolor").val();
        var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

        var code_array = re_tmp_product_code.split('||');

        var tmp_product_code_re = "";

        $.each(code_array, function (key, val) {
            if (val != code) {
                tmp_product_code_re = tmp_product_code_re + "|" + val + "|";
            }
        });

        $("#product_dbcolor").val(tmp_product_code_re);
        obj.remove();

    }
}


// 재고 중복확인
function chkOption(chkcode) {
    var tmp_product_code = $("#product_option").val();
    var re_tmp_product_code = tmp_product_code.substr(1, tmp_product_code.length - 2);

    var code_array = re_tmp_product_code.split('||');

    return ($.inArray(chkcode, code_array));
}

// 재고 삭제 함수
async function delOption(idx, obj) {
    if (confirm("정말 삭제하시겠습니까?")) {

        if (idx != "") {
            await $.ajax({
                url: "del_hotel_option",
                type: "POST",
                data: "idx=" + idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {

                }
                , success: function (response, status, request) {
                    alert_(response.message);
                    console.log(response)
                    handleDeleteRow(obj);
                }
            });

        } else {
            handleDeleteRow(obj);
        }
    }
}

function handleDeleteRow(obj) {
    let rowCount = $(obj).closest("tbody").find("tr").length;
    if (rowCount == 1) {
        $(obj).closest("table").remove();
    } else {
        $(obj).closest("tr").remove();
    }
}

async function delOption2(idx, el) {
    if (idx && idx !== "") {
        if (confirm("정말 삭제하시겠습니까?")) {
            await $.ajax({
                url: "del_room_option",
                type: "POST",
                data: "idx=" + idx,
                error: function (request, status, error) {
                    //통신 에러 발생시 처리
                    alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                    $("#ajax_loader").addClass("display-none");
                }
                , complete: function (request, status, error) {

                }
                , success: function (response, status, request) {
                    alert_(response.message);
                    console.log(response)
                    handleDeleteRow(el);
                }
            });
        }
    } else {
        handleDeleteRow(el);
    }
}

$(document).ready(function () {
    $("#btn_tmp_option").click(function () {

        if (confirm("임시 저장을 하시겠습니까?\r삭제된 옵션은 복구 되지 않으며, 기존 주문에 영향을 끼칠 수 있습니다 반드시 확인해주세요.")) {

            var g_idx = $("#g_idx").val();
            if (g_idx == "") {
                alert("올바른 접근이 아닙니다.");
                return false;
            }

            var frm = document.frm;
            frm.action = "alter_option.php";
            frm.target = "hiddenFrame22";
            frm.submit();

        }


    });

    $("#btn_add_option").click(function () {

        var g_idx = $("#roomIdx option:selected").val();
        if (g_idx == undefined) {
            alert("룸을 선택해주세요.");
            return false;
        }

        var exists = false;
        $('.o_room').each(function () {
            if ($(this).val() == g_idx) {
                alert('객실이 중복선택 되었습니다.');
                exists = true; // 일치하는 값이 있으면 true로 설정
            }
        });

        var roomName = $("#roomIdx option:selected").text();


        if (exists == false) {

            if ($("#tblroom" + g_idx).html() == undefined) {


                var addTable = "";

                addTable += "<table>";
                addTable += "	<colgroup>";
                addTable += "		<col width='*'>";
                addTable += "		<col width='30%'>";
                addTable += "		<col width='6%'>";
                addTable += "		<col width='10%'>";
                addTable += "		<col width='10%'>";
                addTable += "		<col width='10%'>";
                addTable += "		<col width='10%'>";
                addTable += "	</colgroup>";
                addTable += "	<thead>";
                addTable += "		<tr>";
                addTable += "			<th>객실명</th>";
                addTable += "			<th>기간</th>";
                addTable += "			<th>비밀특가</th>";
                addTable += "			<th>컨택가</th>";
                addTable += "			<th>프로모션</th>";
                addTable += "			<th>수익</th>";
                addTable += "			<th>삭제</th>";
                addTable += "		</tr>";
                addTable += "	</thead>";
                addTable += "	<tbody id='tblroom" + g_idx + "'>";

                addTable += "	</tbody>";
                addTable += "</table>";


                $("#mainRoom").append(addTable);

            }


            var addOption = "";
            addOption += "<tr color='' size='' >												  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='hidden' name='o_idx[]'  value='' />				  ";
            addOption += "		<input type='hidden' name='option_type[]'  value='M' />			  ";
            addOption += "		<input type='hidden' name='o_room[]' class='o_room'  value='" + g_idx + "' size='70' />		  ";
            addOption += "		<input type='hidden' name='o_name[]'  value='" + roomName + "' size='70' />		  ";
            addOption += "  <span class='room_option_' data-id='" + g_idx + "'>" + roomName + "</span>";
            addOption += "	</td>																  ";
            addOption += "	<td class='flex_td' style='display: flex; align-items: center'>																  ";
            addOption += "		<input type='text' class='s_date datepicker' readonly name='o_sdate[]'  value='' /> ~ ";
            addOption += "		<input type='text' class='e_date datepicker' readonly name='o_edate[]'  value='' /> ";
            addOption += "	</td>																  ";
            addOption += "	<td>																  ";
            addOption += "		<div class='chk_price_wrap' style='display: flex; align-items: center; justify-content: center;'>";
            addOption += "          <input type='checkbox' class='chk_price_secret' value='Y' />";
            addOption += "          <input type='hidden' name='price_secret[]' class='price_secret'>";
            addOption += "      </div>                                                            ";
            addOption += "	</td>                                                           	  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum o_price1' oninput='changeOPrice(this);' name='o_price1[]'  value='0' /> ";
            addOption += "	</td>                                                           	  ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum o_price2' oninput='changeOPrice(this);' name='o_price2[]'  value='0' /> ";
            addOption += "	</td>                                                                 ";
            addOption += "	<td>																  ";
            addOption += "		<input type='text' class='onlynum o_price3' oninput='onlyInputNumber(this);' name='o_price3[]'  value='0' /> ";
            addOption += "	</td>																  ";

            addOption += "	<td>																  ";
            addOption += '		<button type="button" onclick="delOption(\'\',this)" class="btn_02" >삭제</button>	  ';
            addOption += "	</td>																  ";
            addOption += "</tr>																	  ";

            $("#tblroom" + g_idx).append(addOption);

            $(".datepicker").datepicker();

            renderRoom();
        }

    });

    $("#btn_add_option2").click(function () {

        var addOption = "";
        addOption += "<tr color='' size='' >												  ";
        addOption += "	<td>																  ";
        addOption += "		<input type='hidden' name='o_idx[]'  value='' />				  ";
        addOption += "		<input type='hidden' name='option_type[]'  value='S' />			  ";
        addOption += "		<input type='text' name='o_name[]'  value='' size='70' />		  ";
        addOption += "	</td>																  ";
        addOption += "	<td>																  ";
        addOption += "		<input type='text' class='onlynum' name='o_price1[]'  value='' />  ";
        addOption += "	</td>																  ";
        addOption += "	<td>																  ";
        addOption += '		<button type="button" onclick="delOption(\'\',this)" >삭제</button>	  ';
        addOption += "	</td>																  ";
        addOption += "</tr>																	  ";

        $("#settingBody2").append(addOption);

    });

    $('#btn_add_option3').click(function () {
        let roomIdx2 = $("#roomIdx2 option:selected");
        let g_idx = roomIdx2.val();
        if (g_idx === undefined) {
            alert("룸을 선택해주세요.");
            return false;
        }

        let roomName = roomIdx2.text();

        let html = ` <tr> <td>
                                                        <input type='hidden' name='rop_idx[]' id='' value=""/>
                                                        <input type='hidden' name='sup_room__idx[]' id='' value="${g_idx}"/>
                                                        
                                                        <input type='hidden' name='sup_room__name[]' id=''
                                                               value="${roomName}"/>
                                                               ${roomName}
                                                    </td>
                                                    <td>
                                                        <input type='text' name='sup__key[]' id=''
                                                               value="" size="70"/>
                                                    </td>
                                                    <td>
                                                        <button type="button" id="btn_add_name" onclick="addName(this);"
                                                                class="btn_01">추가
                                                        </button>
                                                        <div class="list_name list__room_name" style="margin-top: 10px;">
                                                            <div class="input_item" style="display: flex;margin-top: 5px;">
                                                                <input type='text' class='sup__name_child' name='sup__name_child' id=''
                                                                       value=""/>
                                                                <button type="button" id="btn_del_name"
                                                                        onclick="delName(this);"
                                                                        class="btn_02">삭제
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <input type='hidden' class='' name='sup__name[]' id=''
                                                                       value=""/>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum sup__price' name='sup__price[]' id=''
                                                               oninput="changeSPrice(this);"
                                                               value="0"/>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum sup__price_2' name='sup__price_2[]'
                                                               id='' oninput="changeSPrice(this);"
                                                               value="0"/>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='onlynum sup__price_3' name='sup__price_3[]'
                                                               id='' oninput="onlyInputNumber(this);"
                                                               value="0"/>
                                                    </td>
                                                    <td>
                                                        <button type="button" id="btn_del_option3"
                                                                onclick="delOption2('', this);"
                                                                class="btn_02">삭제
                                                        </button>
                                                    </td>
                                                </tr>`;

        $("#settingBody3").append(html);
    });

    renderRoom();
});

function onlyInputNumber(el) {
    $(el).val($(el).val().replace(/[^0-9]/g, ""));
}

function changeOPrice(el) {
    onlyInputNumber(el);

    let parent = $(el).closest('tr');

    let o_price1 = parent.find('.o_price1').val();
    let o_price2 = parent.find('.o_price2').val();

    if (parseFloat(o_price2) > parseFloat(o_price1)) {
        o_price2 = o_price1;
        parent.find('.o_price2').val(o_price2);
    }

    let price = o_price1 - o_price2;
    parent.find('.o_price3').val(price);
}

function changeSPrice(el) {
    onlyInputNumber(el);

    let parent = $(el).closest('tr');

    let sup__price = parent.find('.sup__price').val();
    let sup__price_2 = parent.find('.sup__price_2').val();

    if (parseFloat(sup__price_2) > parseFloat(sup__price)) {
        sup__price_2 = sup__price;
        parent.find('.sup__price_2').val(sup__price_2);
    }

    let price = sup__price - sup__price_2;
    parent.find('.sup__price_3').val(price);
}

function renderRoom() {
    let room_option_ = $(".room_option_");

    let data = [];

    room_option_.each(function () {
        let op = $(this);
        let op_id = op.data('id');
        let op_name = op.text();
        let item = {
            op_id: op_id,
            op_name: op_name
        }

        data.push(item);
    })

    let options = '';

    for (const datum of data) {
        options += `<option value="${datum.op_id}">${datum.op_name}</option>`
    }

    $("#roomIdx2").empty().append(options);
}

let addNameHtml = ` <div class="input_item" style="display: flex;margin-top: 5px;">
                                                                <input type='text' class='sup__name_child' name='sup__name_child' id=''
                                                                       value=""/>
                                                                <button type="button" id="btn_del_name"
                                                                        onclick="delName(this);"
                                                                        class="btn_02">삭제
                                                                </button>
                                                            </div>`;

function addName(el) {
    let inp = $(el).next();
    $(inp).append(addNameHtml);
}

function delName(el) {
    let inp = $(el).parent();
    inp.remove();
}

function seoson_setting(mon_array) {

    $(".monthchk li").each(function () {
        $(this).removeClass("on");
    });

    $(".monthchk li").each(function () {
        var rel = $(this).attr("rel");

        if ($.inArray(rel, mon_array) > -1) {
            $(this).addClass("on");
        }

    });
    seoson_setting_val();
}

function seoson_setting_val() {

    var tmp_product_code = "";
    $("#use_month").val("");

    $(".monthchk li").each(function () {

        if ($(this).hasClass("on")) {
            var rel = $(this).attr("rel");

            tmp_product_code = tmp_product_code + "|" + rel + "|";
        }
    });

    $("#use_month").val(tmp_product_code);

}

function fn_pop(c_type) {
    $(".popup").show();
    $("#chk_codeType").val(c_type);

    var codeText = "";
    if (c_type == "code") {
        codeText = "상품";
    } else if (c_type == "erp") {
        codeText = "ERP";
    }
    $(".code_text").text(codeText);
    $("#pop_search").val("");
    $("#pop_search").focus();
}

// 색상 사용여부 변경 시
function fn_color(obj) {
    var val = $(obj).val();
    var code = $(obj).closest("tr").attr("rel");

    $("#settingBody tr").each(function () {
        if ($(this).attr("color") == code) {
            $(this).find("select").val(val);
        }
    });

}


// 사이즈 사용여부 변경 시
function fn_size(obj) {
    var val = $(obj).val();
    var code = $(obj).closest("tr").attr("rel");

    $("#settingBody tr").each(function () {
        if ($(this).attr("size") == code) {
            $(this).find("select").val(val);
        }
    });

}

function fn_chgRoom(gidx) {
    $("#roomIdx").html("");
    var selectedValue = document.getElementById("hotel_code").value;

    if (selectedValue.startsWith("H0")) {
        selectedValue = selectedValue.substring(2);
    }

    document.getElementById("stay_idx").value = selectedValue;
    if (gidx !== "") {
        $("#hotel_code").prop("disabled", true);
        $.ajax({
            type: "GET"
            , url: "/AdmMaster/_hotel/get_room"
            , dataType: "html" //전송받을 데이터의 타입
            , timeout: 30000 //제한시간 지정
            , cache: false  //true, false
            , data: "gidx=" + gidx //서버에 보낼 파라메터
            , error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
            }
            , success: function (json) {


                var list = $.parseJSON(json);
                var listLen = list.length;

                for (var i = 0; i < listLen; i++) {
                    // $("#stay_idx").val(g_idx);
                    $("#roomIdx").append("<option value='" + list[i].g_idx + "'>" + list[i].roomName + "</option>");
                }
            }
        });
    }

    $(function () {
        // 시작 날짜
        $(".s_date").datepicker({
            dateFormat: "yy-mm-dd",
            onClose: function (selectedDate) {
                $(".e_date").datepicker("option", "minDate", selectedDate);
            }
        });

        // 종료 날짜
        $(".e_date").datepicker({
            dateFormat: "yy-mm-dd",
            onClose: function (selectedDate) {
                $(".s_date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });

    $("#popup_hotel").fadeOut();

}

$(document).ready(function () {
    $(".search_hotel").on("click", function () {
        $("#popup_hotel").fadeIn();
        $(".pooup_bg").fadeIn();
    });

    $(".pooup_bg").on("click", function () {
        $("#popup_hotel").fadeOut();
        $(".pooup_bg").fadeOut();
    });

    $("#popup_hotel").on("click", ".close-popup", function () {
        $("#popup_hotel").fadeOut();
        $(".pooup_bg").fadeOut();
    });
});

function check_product_code(product_code) {
    $.ajax({
        url: "/ajax/check_product_code",
        type: "POST",
        data: "product_code=" + product_code,
        error: function (request, status, error) {
            //통신 에러 발생시 처리
            alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
        }
        , success: function (response, status, request) {
            alert(response.message);

            if (response.result == true) {
                $("#chk_product_code").val("Y");
            } else {
                $("#chk_product_code").val("N");
                location.reload();
            }
        }
    });
}

function chkNum(obj)
{
    obj.value = obj.value.replace(/[^0-9]/g,'') // numbers only
}