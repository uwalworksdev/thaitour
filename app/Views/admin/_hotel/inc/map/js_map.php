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
        $('#place_image_').empty('');
        $('#product_url').val('');
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
                $("#ajax_loader").addClass("display-none");
                listRoom();
            },
            error: function (request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
        })
    }

    function setRoom(room) {
        $('#room_facil').val(room.room_facil);
        $('#g_idx').val(room.g_idx);
        $('#room_category').val(room.category);
        $('#roomName').val(room.roomName);
        $('#scenery').val(room.scenery);
        $('#max_num_people').val(parseInt(room.max_num_people ?? 1));

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

        setBackgroundImage('label[for="room_ufile1"]', room.ufile1);
        setBackgroundImage('label[for="room_ufile2"]', room.ufile2);
        setBackgroundImage('label[for="room_ufile3"]', room.ufile3);
    }

    function setBackgroundImage(selector, fileName) {
        let base_url = '/uploads/rooms/';
        if (fileName && fileName.trim() !== "") {
            $(selector).css('background-image', `url('${base_url + fileName}')`);
        }
    }

    function resetBackgroundImage(selector) {
        $(selector).css('background-image', ``);
    }

    async function editRoom(_idx) {
        showOrHide();

        let apiUrl = `<?= route_to('admin.api.hotel_.detail_room') ?>?idx=${_idx}`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let data = await response.json();
            setRoom(data.room);
        } catch (error) {
            console.error('Error fetching hotel data:', error);
        }
    }

    function resetRoom() {
        $('#room_facil').val('');
        $('#g_idx').val('');
        $('#room_category').val('');
        $('#roomName').val('');
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
    }

    async function updateRoomSelect(el, idx) {
        await editRoom(idx);
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
                    html += `<div class="item_">
                            <input readonly type="text" value="${data.roomName}">
                            <button class="delete_" onclick="removeRoomSelect(this, ${data.g_idx})" type="button">삭제</button>
                            <button class="update_" onclick="updateRoomSelect(this, ${data.g_idx})" type="button">수정</button>
                        </div>`;
                }
            }
        }

        console.log(room_idx)

        $("#room_list_render_").empty().append(html);
        $("#room_list").val(room_idx);
    }

    function showOrHide() {
        resetRoom();
        $("#popupItem_").toggleClass('show_');
    }
</script>