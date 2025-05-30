<!-- Script for place popular if edit product -->
<script>
    function deletePlace(_idx) {
        if (!confirm("코드를 삭제하고 싶을까요?")) {
            return;
        }

        let apiUrl = `<?= route_to('admin._product_place.delete') ?>`;

        let formData = new FormData();
        formData.append('idx', _idx);

        $("#ajax_loader").removeClass("display-none");

        $.ajax(apiUrl, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                alert(response.message);
                $("#ajax_loader").addClass("display-none");
                listPlace();
            },
            error: function (request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
        })
    }

    async function editPlace(_idx) {
        showOrHidePlace();

        let apiUrl = `<?= route_to('admin._product_place.detail') ?>?idx=${_idx}`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let data = await response.json();
            setPlace(data.data);
        } catch (error) {
            console.error('Error fetching hotel data:', error);
        }
    }

    function resetPlace() {
        $('#product_place_idx').val('');
        $('#product_place_name').val('');
        $('#product_place_type').val('');
        $('#product_place_distance').val('');
        $('#product_place_onum').val('');
        $('#product_place_ufile1').val('');
        $('#place_image_').empty('');
        $('#product_url').val('');

        $('.name_file_inp_').html('');
    }

    function setPlace(data) {
        let idx = data.idx;
        let name = data.name;
        let ufile = data.ufile;
        let type = data.type;
        let distance = data.distance;
        let onum = data.onum;
        let url = data.url;

        $('#product_place_idx').val(idx);
        $('#product_place_name').val(name);
        $('#product_place_type').val(type);
        $('#product_place_distance').val(distance);
        $('#product_place_onum').val(onum);
        $('#product_url').val(url);

        if (ufile) {
            let html = `<img src="/data/code/${ufile}" alt="" style="width: 200px">`;
            $('#place_image_').empty().append(html);
        }
    }

    function showOrHidePlace() {
        resetPlace();
        $("#popupPlace_").toggleClass('show_');
    }
</script>

<!-- Script for room option if edit product -->
<script>
    async function removeRoomSelect(el, idx) {
        if (!confirm('객실을 삭제하시겠습니까?')) {
            return;
        }
        $(el).parent().remove();

        let formData = new FormData();

        formData.append('idx[]', idx)

        let apiUrl = `<?= route_to('admin.api.hotel_.delete_room') ?>`;

        $("#ajax_loader").removeClass("display-none");

        $.ajax(apiUrl, {
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            async: false,
            success: function (response) {
                console.log(response);
                alert(response.message);
				location.reload();
                //$("#ajax_loader").addClass("display-none");
                //listRoom();
            },
            error: function (request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
        })
    }

    function setRoom(room, img_list) {
        $('#room_facil').val(room.room_facil);
        $('#g_idx').val(room.g_idx);
        $('#room_category').val(room.category);
        $('#roomName').val(room.roomName);
        $('#roomName_eng').val(room.roomName_eng);
        $('#scenery').val(room.scenery);
        $('#extent').val(room.extent);
        $('#floor').val(room.floor);
        $('#max_num_people').val(parseInt(room.max_num_people ?? 1));
        $('#policy_customer').val(room.policy_customer ?? "");
        let room_facil = room.room_facil ? room.room_facil.split('|') : [];
        $('input[name="_room_facil"]').each(function () {
            $(this).prop('checked', room_facil.includes($(this).val()));
        });

        let category = room.category ? room.category.split('|') : [];
        $('input[name="_room_category"]').each(function () {
            $(this).prop('checked', category.includes($(this).val()));
        });

        if (room.breakfast == 'Y') {
            $('#rbreakfast').prop('checked', true);
        }
        if (room.lunch == 'Y') {
            $('#lunch').prop('checked', true);
        }
        if (room.dinner == 'Y') {
            $('#dinner').prop('checked', true);
        }        
        
		var img_add  = "";
		// var img_add1 = "";
		// var img_add2 = "";
		// var img_add3 = "";
		// var img_add4 = "";
		// var img_add5 = "";
		// var img_add6 = "";
		
        for(let i = 0; i < img_list.length; i++) {
            if(img_list[i].ufile){
                img_add += roomImgView(i + 1, img_list[i]);
            }
        }

		// if(room.ufile1) {
		//    img_add1 = roomImgView(1, room.ufile1);
		// } else {   
		//    img_add1 = roomImgNone(1, room.ufile1);
		// }
		
		// if(room.ufile2) {
		//    img_add2 = roomImgView(2, room.ufile2);
		// } else {   
		//    img_add2 = roomImgNone(2, room.ufile2);
		// }
		
		// if(room.ufile3) {
		//    img_add3 = roomImgView(3, room.ufile3);
		// } else {   
		//    img_add3 = roomImgNone(3, room.ufile3);
		// }
		
		// if(room.ufile4) {
		//    img_add4 = roomImgView(4, room.ufile4);
		// } else {   
		//    img_add4 = roomImgNone(4, room.ufile4);
		// }
		
		// if(room.ufile5) {
		//    img_add5 = roomImgView(5, room.ufile5);
		// } else {   
		//    img_add5 = roomImgNone(5, room.ufile5);
		// }
		
		// img_add  = img_add1 + img_add2 + img_add3 + img_add4 + img_add5;
		$("#img_add").html(img_add);

        $(".imgpop_p").each(function () {
            if ($(this).attr("href") && $(this).attr("href").match(/\.(jpg|jpeg|png|gif|bmp)$/i)) {
                $(this).colorbox({
                    rel: 'imgpop_p',
                    maxWidth: '90%',
                    maxHeight: '90%'
                });
            }
        });

        check_room_facil();
		/*
        setBackgroundImage('label[for="room_ufile1"]', room.ufile1);
        setBackgroundImage('label[for="room_ufile2"]', room.ufile2);
        setBackgroundImage('label[for="room_ufile3"]', room.ufile3);
        setBackgroundImage('label[for="room_ufile4"]', room.ufile4);
        setBackgroundImage('label[for="room_ufile5"]', room.ufile5);
        setBackgroundImage('label[for="room_ufile6"]', room.ufile6);
		*/
    }

	function roomImgView(idx, img) {
		
		let imgUrl = img.ufile ? `/uploads/rooms/${img.ufile}` : ""; // 파일이 없을 경우 대비
        let img_add = `<div class="file_input_wrap">`;
		img_add += `<div class="file_input ${ img.ufile ? "applied" : "" }">`;
		img_add += `<input type="hidden" name="i_idx[]" value="${ img.i_idx }">`;
		img_add += `<input type="hidden" class="onum_img" name="onum_img[]" value="${ img.onum }">`;
		img_add += `<input type="file" name="ufile[]" id="ufile${idx}" multiple onchange="productImagePreview(this, '${idx}')" style="display: none;">`;
		img_add += `<label for="ufile${idx}" style="background-image: url('${imgUrl}');"></label>`;
		img_add += `<input type="hidden" name="checkImg_${idx}" class="checkImg">`;
		img_add += `<button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)" style="display: block;"></button>`;
		
		// 미리보기 링크 추가 (ufile이 있을 경우만)
		if (img.ufile) {
			img_add += `<a class="img_txt imgpop_p" href="${imgUrl}" id="text_room_ufile${idx}">미리보기</a>`;
		}

		img_add += `</div>`;
		img_add += `</div>`;

		return img_add;
	}

	function roomImgNone(idx, ufile) {

		let img_add  = `<div class="file_input">`;											
		img_add += `<div id="input_file_ko"><button type="button">선택파일</button><span class="name_file_inp_">선택된 파일 없음</span></div>`;
		img_add += `<input type="file" name="room_ufile${idx}" id="room_ufile${idx}" onchange="productImagePreview2(this, '${idx}')" style="display: none;">`;
		img_add += `<label for="room_ufile${idx}"></label>`;
		img_add += `<input type="hidden" name="checkImg_${idx}">`;
		img_add += `<button type="button" class="remove_btn" onclick="productImagePreviewRemove(this)" style="display: none;"></button>`;
		img_add += `</div>`;
		
		return img_add;
	}

    function setBackgroundImage(selector, fileName) {
        let base_url = '/uploads/rooms/';
        if (fileName && fileName.trim() !== "") {
            $(selector).css('background-image', `url('${base_url + fileName}')`).closest('.file_input ').addClass('applied').find('button.remove_btn').css('display', 'block');	 
        }
    }

    function resetBackgroundImage(selector) {
        $(selector).css('background-image', ``).closest('.file_input ').find('button.remove_btn').css('display', 'none');
    }

    async function editRoom(_idx) {
        showOrHide();

        let apiUrl = `<?= route_to('admin.api.hotel_.detail_room') ?>?idx=${_idx}`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let data = await response.json();
            setRoom(data.room, data.img_list);
        } catch (error) {
            console.error('Error fetching hotel data:', error);
        }
    }

    function resetRoom() {
        $('#room_facil').val('');
        $('#g_idx').val('');
        $('#room_category').val('');
        $('#roomName').val('');
        $('#roomName_eng').val('');
        $('#scenery').val('');
        $('#max_num_people').val('');
        $('input[name="_room_facil"]').prop('checked', false);
        $('input[name="_room_category"]').prop('checked', false);
        $('#rbreakfast').prop('checked', false);
        $('#lunch').prop('checked', false);
        $('#dinner').prop('checked', false);
        resetBackgroundImage('label[for="room_ufile1"]');
        resetBackgroundImage('label[for="room_ufile2"]');
        resetBackgroundImage('label[for="room_ufile3"]');
        resetBackgroundImage('label[for="room_ufile4"]');
        resetBackgroundImage('label[for="room_ufile5"]');
        resetBackgroundImage('label[for="room_ufile6"]');
    }

    async function updateRoomSelect(el, idx) {
        await editRoom(idx);
    }

    function priceRoomProcess()
	{
		var product_idx = $("#product_idx").val();
		location.href='/AdmMaster/_hotel/write_price?search_category=&search_txt=&pg=&product_idx='+product_idx;
	}
	
    function renderRoom(room_list) {
        let room_idx = '';
        let html = '';
        
        if (room_list) {
            let c = room_list.length;
            if (c > 0) {
                for (let i = 0; i < c; i++) {
                    let data = room_list[i];
                    room_idx += data.g_idx + '|';

                    let roomHtml = renderFresult10(data.room_facil);
                    let categoryHtml = renderFresult11(data.category);

                    html += `<div class="item_">
                            <input readonly type="text" value="${data.roomName}">
                            <input readonly type="text" value="${data.roomName_eng}">
                            <!--button class="update_" onclick="priceRoomProcess()"                    type="button">가격관리</button-->
                            <button class="delete_" onclick="removeRoomSelect(this, ${data.g_idx})" type="button">삭제</button>
                            <button class="update_" onclick="updateRoomSelect(this, ${data.g_idx})" type="button">수정</button>
                        </div>

                        <!--table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                               style="table-layout:fixed;">
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
                                <td colspan="4">
                                    기본정보
                                </td>
                            </tr>
                            <tr>
                                <th>객실시설</th>
                                <td colspan="3">
                                    ${roomHtml}
                                </td>
                            </tr>

                            <tr>
                                <th>장면</th>
                                <td colspan="3">
                                    <input type="text" name="scenery" value="${data.scenery ?? ''}" class="text"
                                           id="scenery${data.g_idx}" style="width:300px" maxlength="50"/>
                                </td>
                            </tr>

                            <tr>
                                <th>범주</th>
                                <td colspan="3">
 ${categoryHtml}
                                </td>
                            </tr>

                            <tr>
                                <th>식사</th>
                                <td colspan="3">
                                    <input type="checkbox" id="rbreakfast${data.g_idx}" name="breakfast"
                                           value="Y" ${data.breakfast == "Y" ? "checked" : ""} />
                                    <label for="rbreakfast">조식 </label>

                                    <input type="checkbox" id="lunch${data.g_idx}" name="lunch"
                                           value="Y" ${data.lunch == "Y" ? "checked" : ""} />
                                    <label for="lunch">중식</label>

                                    <input type="checkbox" id="dinner${data.g_idx}" name="dinner"
                                           value="Y" ${data.dinner == "Y" ? "checked" : ""} />
                                    <label for="dinner">석식</label>
                                </td>
                            </tr>

                            <tr>
                                <th>총인원</th>
                                <td colspan="3">
                                    <input type="text" name="max_num_people" value="${data.max_num_people ?? 1}"
                                           id="max_num_people${data.g_idx}" class="number" min="1" style="width:100px"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
                               style="margin-top:50px;">
                            <caption>
                            </caption>
                            <colgroup>
                                <col width="10%"/>
                                <col width="90%"/>
                            </colgroup>
                            <tbody>

                            <tr>
                                <td colspan="2">
                                    이미지 등록
                                </td>
                            </tr>

                            <tr>
                                <th>서브이미지(600X400)</th>
                                <td colspan="3">
                                    <div class="img_add">
                                        <div class="" style="display: flex; gap: 20px">
                                            <img src="/uploads/rooms/${data.ufile1}" alt="" width="100px">
                                            <img src="/uploads/rooms/${data.ufile2}" alt="" width="100px">
                                            <img src="/uploads/rooms/${data.ufile3}" alt="" width="100px">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table-->
                        `;
                }
            }
        }

        console.log(room_idx)

        $("#room_list_render_").empty().append(html);
        $("#room_list").val(room_idx);
    }

    function renderFresult10(room_facil) {
        let fresult10 = <?= json_encode($fresult10); ?>;

        let arr_room_facil = room_facil.split('|');

        let html = '';
        fresult10.forEach(item => {
            let isChecked = arr_room_facil.includes(item.code_no);

            html += `<input type="checkbox" id="room_facil_${item.code_no}"
                           name="" ${isChecked ? 'checked' : ''}
                           value="${item.code_no}"/>
                 <label for="room_facil_${item.code_no}">${item.code_name}</label>`;
        });

        return html;
    }

    function renderFresult11(category) {
        let fresult10 = <?= json_encode($fresult11); ?>;

        let arr_category = category.split('|');

        let html = '';
        fresult10.forEach(item => {
            let isChecked = arr_category.includes(item.code_no);

            html += `<input type="checkbox" id="room_category_${item.code_no}"
                           name="" ${isChecked ? 'checked' : ''}
                           value="${item.code_no}"/>
                 <label for="room_category_${item.code_no}">${item.code_name}</label>`;
        });

        return html;
    }

    function showOrHide() {
        resetRoom();
        $("#popupItem_").toggleClass('show_');
    }
</script>