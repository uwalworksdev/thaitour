<!-- Script for place popular if edit product -->
<script>
    listPlace();

    async function listPlace() {
        let apiUrl = `<?= route_to('admin._product_place.list') ?>?product_idx=<?= $stay_idx ?>`;
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
        console.log(data)
        let html = '';
        for (let i = 0; i < data.length; i++) {
            let item = data[i];
            let count = i + 1;
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
                listPlace();
            },
            error: function (request, status, error) {
                alert_("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
        })
    }
</script>
<!-- Script for room option if edit product -->
<script>
    listRoom();

    async function listRoom() {
        let apiUrl = `<?= route_to('admin.api.hotel_.list_room') ?>?product_idx=<?= $product_idx ?>`;
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
                listRoom();
            },
            error: function (request, status, error) {
                alert("Error " + request.status + ": " + request.responseText);
                $("#ajax_loader").addClass("display-none");
            }
        });
    }
</script>