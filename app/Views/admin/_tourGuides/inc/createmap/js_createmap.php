<script>
    function add_option() {
        let html = ` <tr>
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
                                onclick='delOption("", this);'>
                            삭제
                        </button>
                    </td>
                </tr>`;

        $('#list_option').append(html)
    }

    function delOption(o_idx, el) {
        if (confirm("삭제 하시겠습니까?\n삭제후에는 복구가 불가능합니다.") === false) {
            return;
        }

        $(el).closest('tr').remove();
    }
</script>