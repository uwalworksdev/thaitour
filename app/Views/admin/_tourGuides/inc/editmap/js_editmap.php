<script>
    function add_option() {
        let html = ` <tr class="main_op_">
                        <td style="border: none" colspan="7">
                            <table>
                                <colgroup>
                                    <col width="*%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="10%"/>
                                    <col width="8%"/>
                                    <col width="10%"/>
                                    <col width="8%"/>
                                </colgroup>
                                <tr>
                                    <th style="text-align: center">옵션명</th>
                                    <th style="text-align: center">최초가격</th>
                                    <th style="text-align: center">판매가격</th>
                                    <th style="text-align: center">총인원</th>
                                    <th style="text-align: center">우선순위</th>
                                    <th style="text-align: center">예약가능여부</th>
                                    <th style="text-align: center">관리</th>
                                </tr>
                <tr>
                    <td>
                        <div class='flex_c_c'>
                            <input type='hidden' name='o_idx[]'
                                   value=''>
                            <input type='text' class='o_name' name='o_name[]'
                                   value=''>
                        </div>
                    </td>
                    <td>
                        <input type='text' class='number' name='o_price[]'
                               value=''>
                    </td>
                    <td>
                        <input type='text' class='number' name='o_sale_price[]'
                               value=''>
                    </td>

                    <td>
                        <input type='text' class='number' name='o_people_cnt[]'
                               value=''>
                    </td>
                    <td>
                        <input type='text' class='number' name='o_onum[]'
                               value=''>
                    </td>
                    <td style="text-align: center">
                        <select name='o_availability[]' id="">
                            <option value="Y">판매중</option>
                            <option value="N">판매중지</option>
                        </select>
                    </td>
                    <td class='tac'>
                        <button style='margin: 0;' type='button' class='btn_02'
                                onclick='delOption("", "P", this);'>
                            삭제
                        </button>
                    </td>
                </tr></table>
                        </td>
                    </tr>`;

        $('#list_option').append(html)
    }

    function delOption(o_idx, type, el) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
            return;
        }

        if (type == "P") {
            $(el).closest('tr.main_op_').remove();
        } else if (type == "C"){
            $(el).closest('tr').remove();
        }

        if (o_idx && o_idx !== "") {
            if (type == "P") {
                delPOption(o_idx);
            } else if (type == "C") {
                delMOption(o_idx, el)
            }
        }
    }

    function delPOption(o_idx) {
        let url = '<?= route_to('admin._option_guides.delete') ?>';

        let data = {
            o_idx: o_idx
        };

        mainDeleteData(data, url);
    }

    function delCOption(s_idx) {
        let url = '<?= route_to('admin._sup_option_guides.delete') ?>';

        let data = {
            s_idx: s_idx
        };

        mainDeleteData(data, url);
    }

    function mainDeleteData(data, url) {
        $("#ajax_loader").removeClass("display-none");

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            error: function (request, status, error) {
                //통신 에러 발생시 처리
                alert("code : " + request.status + "\r\nmessage : " + request.reponseText);
                $("#ajax_loader").addClass("display-none");
            }
            , complete: function (request, status, error) {
//				$("#ajax_loader").addClass("display-none");
            }
            , success: function (response, status, request) {
                alert(response.message);
                console.log(response)
                $("#ajax_loader").addClass("display-none");
            }
        });
    }

    function addMOption(idx) {
        let html = `<tr>
                                                            <td>
                                                                <input type='hidden' name='sup_o_idx[]'
                                                                       value=''>
                                                                <input type='hidden' name='po_idx[]'
                                                                       value='${idx}'>
                                                                <input type='text' class='sup_o_name'
                                                                       name='sup_o_name[]'
                                                                       value=''>
                                                            </td>
                                                            <td>
                                                                <input type='text' class='number'
                                                                       name='sup_o_price[]'
                                                                       value=''>
                                                            </td>
                                                            <td>
                                                                <button style='margin: 0;' type='button'
                                                                        class='btn_02'
                                                                        onclick='delOption("", "C",this);'>
                                                                    삭제
                                                                </button>
                                                            </td>
                                                        </tr>`;

        $('#tbodyOption' + idx).append(html);
    }

    function delMOption(idx, el) {
        delCOption(idx);
    }
</script>