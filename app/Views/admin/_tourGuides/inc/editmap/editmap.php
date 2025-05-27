<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail"
       style="margin-top: 50px">
    <caption>
    </caption>
    <colgroup>
        <col width="10%"/>
        <col width="90%"/>
    </colgroup>
    <tbody>
    <tr>
        <th>
            옵션추가
            <button style="margin: 0px;" type="button" class="btn_01"
                    onclick="add_option();">추가
            </button>
        </th>
        <td>
            <table>
                <tbody id="list_option">
                <?php foreach ($options as $option) { ?>
                    <tr class="main_op_">
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
                                                   value='<?= $option['o_idx'] ?>'>
                                            <input type='text' class='o_name'
                                                   name='o_name[]'
                                                   value='<?= $option['o_name'] ?>'>
                                        </div>
                                    </td>
                                    <td>
                                        <input type='text' class='number' name='o_price[]'
                                               value='<?= $option['o_price'] ?>'>
                                    </td>
                                    <td>
                                        <input type='text' class='number'
                                               name='o_sale_price[]'
                                               value='<?= $option['o_sale_price'] ?>'>
                                    </td>

                                    <td>
                                        <input type='text' class='number'
                                               name='o_people_cnt[]'
                                               value='<?= $option['o_people_cnt'] ?>'>
                                    </td>
                                    <td>
                                        <input type='text' class='number' name='o_onum[]'
                                               value='<?= $option['onum'] ?>'>
                                    </td>
                                    <td style="text-align: center">
                                        <select name='o_availability[]' id="">
                                            <option value="Y" <?= $option['o_availability'] == 'Y' ? 'selected' : '' ?>>판매중</option>
                                            <option value="N" <?= $option['o_availability'] == 'N' ? 'selected' : '' ?>>판매중지</option>
                                        </select>
                                        <!-- <input type='text' class='o_availability'
                                               name='o_availability[]'
                                               value='<?= $option['o_availability'] ?>'> -->
                                    </td>
                                    <td class='tac'>
                                        <button style='margin: 0;' type='button'
                                                class='btn_02'
                                                onclick='delOption("<?= $option['o_idx'] ?>", "P", this);'>
                                            삭제
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <table>
                                            <colgroup>
                                                <col width="10%"/>
                                                <col width="90%"/>
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th style="text-align: center">
                                                    옵션포함 추가
                                                    <button style="margin: 0px;" type="button" class="btn_01"
                                                            onclick="addMOption('<?= $option['o_idx'] ?>');">추가
                                                    </button>
                                                </th>
                                                <td>
                                                    <table>
                                                        <colgroup>
                                                            <col width="x"/>
                                                            <col width="10%"/>
                                                            <col width="10%"/>
                                                        </colgroup>
                                                        <thead>
                                                        <tr>
                                                            <th style="text-align: center">
                                                                옵션명
                                                            </th>
                                                            <th style="text-align: center">
                                                                판매가격
                                                            </th>
                                                            <th style="text-align: center">
                                                                관리
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbodyOption<?= $option['o_idx'] ?>">
                                                        <?php foreach ($option['sup_options'] as $item): ?>
                                                            <tr>
                                                                <td>
                                                                    <input type='hidden' name='sup_o_idx[]'
                                                                           value='<?= $item['s_idx'] ?>'>
                                                                    <input type='hidden' name='po_idx[]'
                                                                           value='<?= $option['o_idx'] ?>'>
                                                                    <input type='text' class='sup_o_name'
                                                                           name='sup_o_name[]'
                                                                           value='<?= $item['s_name'] ?>'>
                                                                </td>
                                                                <td>
                                                                    <input type='text' class='number'
                                                                           name='sup_o_price[]'
                                                                           value='<?= $item['s_price'] ?>'>
                                                                </td>
                                                                <td>
                                                                    <button style='margin: 0;' type='button'
                                                                            class='btn_02'
                                                                            onclick='delOption("<?= $item['s_idx'] ?>", "C",this);'>
                                                                        삭제
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>