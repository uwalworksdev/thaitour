<!-- Script for place popular if create product -->
<script>
    listPlace();

    async function listPlace() {
        let array_place = JSON.parse(localStorage.getItem('place')) || [];
        let placeIds = array_place.join(',');
        let apiUrl = `<?= route_to('admin._product_place.list.idx') ?>?place_ids=${placeIds}`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let data = await response.json();
            renderPlace(data.data);
        } catch (error) {
            console.error('Error fetching hotel data:', error);
        }
    }

    function renderPlace(data) {
        let place_idx = '';
        let html = '';
        for (let i = 0; i < data.length; i++) {
            let item = data[i];
            let count = i + 1;
            place_idx += item.idx + '|';
            html += `<tr style="height:50px">
                                                        <td>${count}</td>
                                                        <td class="tal">${item.name}</td>
                                                        <td class="tac">
                                                             <img src="/data/code/${item.ufile}" alt="" style="width: 200px">
                                                        </td>
                                                        <td class="tac">${item.type}</td>
                                                        <td class="tac">${item.distance}</td>
                                                        <td class="tac">${item.onum}</td>
                                                        <td style="text-align: center">
                                                            <a href="#!" onclick="deletePlace('${item.idx}');"
                                                               class="btn btn-default">코드삭제</a>
                                                            <a href="#!" onclick="editPlace('${item.idx}');"
                                                               class="btn btn-default">추가등록</a>
                                                        </td>
                                                    </tr>`;
        }

        $('#tbodyData').html(html);
        $("#place_list").val(place_idx);
    }

    function writePlace() {
        let formData = new FormData($('#formPlace')[0]);

        let apiUrl = `<?= route_to('admin._product_place.write_ok') ?>`;

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
                showOrHidePlace();
                let place = response.data;
                saveTempPlace(place)
                listPlace();
            },
            error: function (request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
        })
    }

    function saveTempPlace(data) {
        let array_place = JSON.parse(localStorage.getItem('place'));
        if (array_place) {
            array_place.push(data.idx);
        } else {
            array_place = [data.idx];
        }
        localStorage.setItem('place', JSON.stringify(array_place));
    }
</script>
<!-- Script for room option if create product -->
<script>
    listRoom();

    async function listRoom() {
        let array_room = JSON.parse(localStorage.getItem('room')) || [];
        let roomIds = array_room.join(',');

        let apiUrl = `<?= route_to('admin.api.hotel_.list_room.by.idx') ?>?room_ids=${roomIds}`;
        try {
            let response = await fetch(apiUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            let data = await response.json();
            console.log('rooms: ', data)
            renderRoom(data.rooms);
        } catch (error) {
            console.error('Error fetching hotel data:', error);
        }
    }

    function saveValueRoom(e) {
        e.preventDefault();
        let formData = new FormData($('#formRoom')[0]);

        let room_facil = $("input[name=_room_facil]:checked").map(function () {
            return $(this).val();
        }).get().join('|');
        formData.append("room_facil", room_facil);

        let room_category = $("input[name=_room_category]:checked").map(function () {
            return $(this).val();
        }).get().join('|');
        formData.append("room_category", room_category);

        let apiUrl = `<?= route_to('admin.api.hotel_.write_room_ok') ?>`;

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
                showOrHide();
                saveTempRoom(response.room)
                listRoom();
            },
            error: function (request, status, error) {
                alert("Error " + request.status + ": " + request.responseText);
                $("#ajax_loader").addClass("display-none");
            }
        });
    }

    function saveTempRoom(data) {
        let array_room = JSON.parse(localStorage.getItem('room'));
        if (array_room) {
            array_room.push(data.g_idx);
        } else {
            array_room = [data.g_idx];
        }
        localStorage.setItem('room', JSON.stringify(array_room));
    }
</script>