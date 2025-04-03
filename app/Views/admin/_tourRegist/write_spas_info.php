<?= $this->extend("admin/inc/layout_admin") ?>
<?= $this->section("body") ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
	div.listBottom table.listTable tbody td button {
		width: fit-content;
		border: none;
		margin: unset;
	}

	div.listBottom table.listTable .td_wrap{
		padding: 0 !important;
		border: none !important;
	}
</style>

<div id="container"> 
    <span id="print_this">
        <header id="headerContainer">
            <div class="inner">
                <h2>스파/쇼·입장권/레스토랑 상품정보입력</h2>
                <div class="menus">
                    <ul >
                        <li><a href="/AdmMaster/_tourRegist/write_spas?search_category=&search_name=&pg=&product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품상세</span></a></li>
                        <li><a href="/AdmMaster/_tourRegist/list_spas" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a></li>
                        <?php if (!empty($productSpasInfo)) { ?>	
                            <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                        <?php } else { ?>
                                <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!-- // inner --> 
            
        </header>
        <!-- // headerContainer -->
        
        <form name=frm action="<?= route_to('admin.api.spa_.write_info_ok') ?>"  method=post >
        <input type=hidden name="product_idx" value='<?=$product_idx?>'> 
        <?php foreach ($groupedData as $info_idx => $data): ?>
            <input type="hidden" name="info_idx[]" value="<?= $info_idx ?>">
        <?php endforeach; ?>
        <input type=hidden name="s_product_code_1" value='<?=$s_product_code_1?>'> 
        <input type=hidden name="s_product_code_2" value='<?=$s_product_code_2?>'> 
        <input type=hidden name="s_product_code_3" value='<?=$s_product_code_3?>'> 
        <div id="contents">
            <div class="listWrap_noline">
                <div class="listBottom">
                    <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail">
                        <caption>
                        </caption>
                        <colgroup>
                        <!-- <col width="10%" />
                        <col width="85%" /> -->
                        </colgroup>
                        <tbody>
                            <tr height=45>
                                <!-- <th>상품정보 [단위 : 바트]</th> -->
                                <td class="td_wrap">
                                    <div style="display: flex; gap: 5px; margin-top: 5px;">
                                        <a href="javascript:add_table();" class="btn btn-primary">추가</a>
                                        <a href="javascript:copy_last_spa(<?=$product_idx?>);" class="btn btn-success">복사하기</a>
                                    </div>
                                    <?php
                                        $i = 0;
                                    ?>
                                    <?php if ($productSpasInfo): ?>
                                        <?php foreach ($productSpasInfo as $info): 
                                        ?>
                                            <div class="table_list" data-info-idx="<?= $i ?>" style="width: 100%; margin-bottom: 20px;">
                                                <table style="width: 100%">
                                                    <colgroup>
                                                        <col width="35%">
                                                        <col width="*">
                                                        <col width="10%">
                                                        <col width="15%">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th>기간</th>
                                                            <th>출발요일</th>
                                                            <th>기존상품가</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                                                    <input type="text" readonly class="datepicker s_date" name="o_sdate[<?=$i?>]" style="width: 150px; cursor: pointer;" 
                                                                        value="<?= substr($info['info']['o_sdate'], 0, 10) ?>"> ~
                                                                    <input type="text" readonly class="datepicker e_date" name="o_edate[<?=$i?>]" style="width: 150px; cursor: pointer;" 
                                                                        value="<?= substr($info['info']['o_edate'], 0, 10) ?>">
                                                                
                                                                    <button class="btn btn-primary" type="button" onclick="write_day_price('<?= $info['info']['info_idx']?>', '<?=$product_idx?>')">날짜별 수정</button>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $count_yoil = 0;
                                                                    for($_y = 0; $_y <= 6; $_y++) {
                                                                        if($info['info']['yoil_'.$_y] == 'Y') {
                                                                            $count_yoil++;
                                                                        }
                                                                    }

                                                                ?>
                                                                <input type="checkbox" class="all_yoil" <?= $count_yoil == 7 ? 'checked' : '' ?>>
                                                                전체&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_0[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_0'] == 'Y' ? 'checked' : '' ?>> 일요일&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_1[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_1'] == 'Y' ? 'checked' : '' ?>> 월요일&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_2[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_2'] == 'Y' ? 'checked' : '' ?>> 화요일&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_3[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_3'] == 'Y' ? 'checked' : '' ?>> 수요일&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_4[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_4'] == 'Y' ? 'checked' : '' ?>> 목요일&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_5[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_5'] == 'Y' ? 'checked' : '' ?>> 금요일&nbsp;&nbsp;
                                                                <input type="checkbox" name="yoil_6[<?=$i?>]" class="yoil" 
                                                                    <?= $info['info']['yoil_6'] == 'Y' ? 'checked' : '' ?>> 토요일&nbsp;&nbsp;
                                                            </td>
                                                            <td>
                                                                <input type="text" name="spas_info_price[<?=$i?>]" value="<?= number_format($info['info']['spas_info_price']) ?>" numberOnly=true>
                                                            </td>
                                                            <td>
                                                                <div style="margin:10px; display: flex; justify-content: center; gap: 5px">
                                                                    <a href="javascript:add_spa(<?= $i ?>);" class="btn btn-primary">추가</a>
                                                                    <a href="javascript:del_spas('<?= $info['info']['info_idx']?>', '<?= $info['spas_idx_json'] ?>');" class="btn btn-danger">삭제</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <table style="width:100%">
                                                                    <thead>
                                                                        <tr style="height:40px">
                                                                            <td style="width:*;text-align:center">
                                                                                상품타입(국문/영문)
                                                                            </td>
                                                                            <td style="width:15%;text-align:center">
                                                                                성인가격(단위: 바트)
                                                                            </td>
                                                                            <td style="width:15%;text-align:center">
                                                                                소아가격(단위: 바트)
                                                                            </td>
                                                                            <td style="width:15%;text-align:center">
                                                                                판매상태
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="air_main" data-info-idx="<?= $i ?>">
                                                                        <?php foreach ($info['spas'] as $spa): ?>
                                                                            <tr class="air_list_1" style="height:40px">
                                                                                <td>
                                                                                <input type="hidden" name="spas_idx[<?=$i?>][]" class="spas_idx" value="<?= $spa['spas_idx'] ?>">
                                                                                    <input type="text" name="spas_subject[<?=$i?>][]" value="<?= $spa['spas_subject'] ?>" placeholder="국문글씨 입력해주세요" class="spas_subject input_txt" style="width:100%" />
                                                                                    <input type="text" name="spas_subject_eng[<?=$i?>][]" value="<?= $spa['spas_subject_eng'] ?>" placeholder="영문글씨 입력해주세요"  class="spas_subject input_txt" style="width:100%; margin-top: 10px;" />
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="spas_price[<?=$i?>][]" value="<?= number_format($spa['spas_price']) ?>" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="spas_price_kids[<?=$i?>][]" value="<?= number_format($spa['spas_price_kids']) ?>" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                                                </td>
         
                                                                                <td>
                                                                                    <div style="display: flex; gap: 10px; align-items: center; justify-content: center">
                                                                                        <select name="status[<?=$i?>][]">
                                                                                            <option value="Y" <?= ($spa['status'] == 'Y') ? 'selected' : '' ?>>판매중</option>
                                                                                            <option value="N" <?= ($spa['status'] == 'N') ? 'selected' : '' ?>>중지</option>
                                                                                        </select>
                                                                                        <a href="javascript:delete_spa('<?= $spa['spas_idx']?>', '<?= $info['info']['info_idx']?>', '<?=$product_idx?>');" class="btn btn-danger">삭제</a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <table style="width: 100%">
                                                                    <colgroup>
                                                                        <col width="7%">
                                                                        <col width="*">
                                                                    </colgroup>
                                                                    
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>옵션추가</th>
                                                                            <td>
                                                                                <button type="button" class="btn btn-primary" onclick="add_main_option(this, <?= $i ?>);">추가</button>	
                                                                                <input type="hidden" class="count_moption" value="<?=count($info['options'])?>">
                                                                                <?php $j = 0;?>
                                                                                <?php foreach ($info['options'] as $moption): ?>
                                                                                    <div class="option_area">
                                                                                        <input type="hidden" name="moption_idx[<?=$i?>][<?=$j?>]" class="moption_idx" value="<?=$moption["code_idx"]?>">
                                                                                        <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
                                                                                            <colgroup>
                                                                                                <col width="10%">
                                                                                                <col width="90%">
                                                                                            </colgroup>
                                                                                            <tbody>
                                                                                            <tr height="45">
                                                                                                <th colspan="5">
                                                                                                    <div class="flex__c" style="gap: 5px;">
                                                                                                        옵션 <input type='text' name='moption_name[<?=$i?>][<?=$j?>]' class="moption_name"
                                                                                                                    value="<?=$moption["moption_name"]?>" style="width:550px"/>
                                                                                                        <button type="button" class="btn btn-danger"
                                                                                                                onclick="del_main_option('<?=$moption['code_idx']?>', this);">삭제
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </th>
                                                                                            </tr>
                                                                                            <tr height="45">
                                                                                                <th>
                                                                                                    추가 옵션등록
                                                                                                    <div class="flex" style="margin-top:10px; gap: 5px;">
                                                                                                        <button type="button"
                                                                                                                onclick="add_sub_option(this, <?= $i ?>, <?=$j?>);"
                                                                                                                class="btn btn-primary">추가
                                                                                                        </button>
                                                                                                    </div>
                                                                                                </th>
                                                                                                <td>
                                                                                                    <span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다.</span>
                                                                                                    <table>
                                                                                                        <colgroup>
                                                                                                            <col width="*"></col>
                                                                                                            <col width="10%"></col>
                                                                                                            <col width="10%"></col>
                                                                                                            <col width="10%"></col>
                                                                                                            <col width="12%"></col>
                                                                                                        </colgroup>
                                                                                                        <thead>
                                                                                                        <tr>
                                                                                                            <th>옵션명 한글/영문</th>
                                                                                                            <th>가격(단위: 바트)</th>
                                                                                                            <th>적용</th>
                                                                                                            <th>순서</th>
                                                                                                            <th>삭제</th>
                                                                                                        </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
        
                                                                                                            <?php foreach ($moption['option_spas'] as $option_spa): ?>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <input type="hidden" name="op_spa_idx[<?=$i?>][<?= $j ?>][]" class="op_spa_idx" value="<?=$option_spa["idx"]?>">
                                                                                                                        <input type='text' name='o_name[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["option_name"]?>" style="width:48%;" />
                                                                                                                        <input type='text' name='o_name_eng[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["option_name_eng"]?>" style="width:48%;" />
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <input type='text' style="text-align:right;"
                                                                                                                                name='o_price[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["option_price"]?>" numberOnly=true/>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <select name="use_yn[<?=$i?>][<?= $j ?>][]" style="width:100%">
                                                                                                                            <option value="Y" <?php if($option_spa["use_yn"] == "Y"){ echo "selected"; }?>>
                                                                                                                                판매중
                                                                                                                            </option>
                                                                                                                            <option value="N" <?php if($option_spa["use_yn"] == "Y"){ echo "selected"; }?>>
                                                                                                                                중지
                                                                                                                            </option>
                                                                                                                        </select>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <input type='text' name='o_num[<?=$i?>][<?= $j ?>][]' value="<?=$option_spa["onum"]?>" numberOnly=true/>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div style="display: flex; gap: 5px; justify-content: center; align-items: center">
                                                                                                                            <button type="button" class="btn btn-danger"
                                                                                                                                    onclick="delOption('<?=$option_spa['idx']?>', this)">삭제
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            <?php endforeach ?>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                <?php $j++;?>
                                                                                <?php endforeach ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="table_list" data-index="0" style="width: 100%; margin-bottom: 20px;">
                                            <table style="width: 100%">
                                                <colgroup>
                                                    <col width="35%">
                                                    <col width="*">
                                                    <col width="10%">
                                                    <col width="15%">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th>기간</th>
                                                        <th>출발요일</th>
                                                        <th>기존상품가</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                                                <input type="text" readonly="" class="datepicker s_date" name="o_sdate[0]" style="width: 150px; cursor: pointer;" value="" id=""> ~
                                                                <input type="text" readonly="" class="datepicker e_date" name="o_edate[0]" style="width: 150px; cursor: pointer;" value="" id="">

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="all_yoil">
                                                            전체&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_0[0]" value="" class="yoil">
                                                            일요일&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_1[0]" value="" class="yoil">
                                                            월요일&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_2[0]" value="" class="yoil">
                                                            화요일&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_3[0]" value="" class="yoil">
                                                            수요일&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_4[0]" value="" class="yoil">
                                                            목요일&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_5[0]" value="" class="yoil">
                                                            금요일&nbsp;&nbsp;
                                                            <input type="checkbox" name="yoil_6[0]" value="" class="yoil">
                                                            토요일&nbsp;&nbsp;
                                                        </td>
                                                        <td>
                                                            <input type="text" name="spas_info_price[0]" numberOnly=true>
                                                        </td>
                                                        <td>
                                                            <div style="margin:10px; display: flex; justify-content: center; gap: 5px">
                                                                <a href="javascript:add_spas(0);" class="btn btn-primary">추가</a>
                                                                <a href="javascript:remove_table(0);" class="btn btn-danger">삭제</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <table style="width:100%">
                                                                <thead>
                                                                    <tr style="height:40px">
                                                                        <td style="width:*;text-align:center">
                                                                            상품타입
                                                                        </td>
                                                                        <td style="width:15%;text-align:center">
                                                                            성인가격(단위: 바트)
                                                                        </td>
                                                                        <td style="width:15%;text-align:center">
                                                                            소아가격(단위: 바트)
                                                                        </td>
                                                                        <td style="width:15%;text-align:center">
                                                                            판매상태
                                                                        </td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="air_main">
                                                                    <tr class="air_list_1" style="height:40px" >
                                                                        <td style="width:100px;text-align:center">
                                                                            <input type="hidden" name="spas_idx[0][]" class="spas_idx" value="">
                                                                            <input type="text" name="spas_subject[0][]" value="" class="spas_subject input_txt" placeholder="국문글씨 입력해주세요" style="width:100%" />
                                                                            <input type="text" name="spas_subject_eng[0][]" value="" class="spas_subject input_txt" placeholder="영문글씨 입력해주세요" style="width:100%; margin-top: 10px;" />
                                                                        </td>
                                                                        <td style="text-align:center">
                                                                            <input type="text" name="spas_price[0][]" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
                                                                        </td>
                                                                        <td style="text-align:center">
                                                                            <input type="text" name="spas_price_kids[0][]" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
                                                                        </td>
                                                                        <td>
                                                                            <div style="display: flex; gap: 10px; align-items: center; justify-content: center">
                                                                                <select name="status[0][]">
                                                                                    <option value="Y" selected>판매중</option>
                                                                                    <option value="N">중지</option>
                                                                                </select>
                                                                                <a href="javascript:remove_spas(0,0);" class="btn btn-danger">삭제</a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <table style="width: 100%">
                                                                <colgroup>
                                                                    <col width="7%">
                                                                    <col width="*">
                                                                </colgroup>
                                                                
                                                                <tbody>
                                                                    <tr>
                                                                        <th>옵션추가</th>
                                                                        <td>
                                                                            <button type="button" class="btn btn-primary" onclick="add_main_option(this, 0);">추가</button>	
                                                                            <div class="option_area">
                                                                                <input type="hidden" name="moption_idx[0][0]" class="moption_idx" value="">
                                                                                <table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
                                                                                    <colgroup>
                                                                                        <col width="10%">
                                                                                        <col width="90%">
                                                                                    </colgroup>
                                                                                    <tbody>
                                                                                    <tr height="45">
                                                                                        <th colspan="5">
                                                                                            <div class="flex__c" style="gap: 5px;">
                                                                                                옵션 <input type='text' name='moption_name[0][0]'
                                                                                                            value="" style="width:550px"/>
                                                                                                <button type="button" class="btn btn-danger"
                                                                                                        onclick="del_main_option('', this);">삭제
                                                                                                </button>
                                                                                            </div>
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr height="45">
                                                                                        <th>
                                                                                            추가 옵션등록
                                                                                            <div class="flex" style="margin-top:10px; gap: 5px;">
                                                                                                <button type="button"
                                                                                                        onclick="add_sub_option(this, 0, 0);"
                                                                                                        class="btn btn-primary">추가
                                                                                                </button>
                                                                                            </div>
                                                                                        </th>
                                                                                        <td>
                                                                                            <span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다.</span>
                                                                                            <table>
                                                                                                <colgroup>
                                                                                                    <col width="*"></col>
                                                                                                    <col width="10%"></col>
                                                                                                    <col width="10%"></col>
                                                                                                    <col width="10%"></col>
                                                                                                    <col width="12%"></col>
                                                                                                </colgroup>
                                                                                                <thead>
                                                                                                <tr>
                                                                                                    <th>옵션명 한글/영문</th>
                                                                                                    <th>가격(단위: 바트)</th>
                                                                                                    <th>적용</th>
                                                                                                    <th>순서</th>
                                                                                                    <th>삭제</th>
                                                                                                </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input type="hidden" name="op_spa_idx[0][0][]" class="op_spa_idx" value="">
                                                                                                            <input type='text' name='o_name[0][0][]' value="" style="width:48%;" />
                                                                                                            <input type='text' name='o_name_eng[0][0][]' value="" style="width:48%;" />
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input type='text' style="text-align:right;"
                                                                                                                    name='o_price[0][0][]' value="" numberOnly=true/>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <select name="use_yn[0][0][]" style="width:100%">
                                                                                                                <option value="Y">
                                                                                                                    판매중
                                                                                                                </option>
                                                                                                                <option value="N">
                                                                                                                    중지
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input type='text' name='o_num[0][0][]' value="" numberOnly=true/>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div style="display: flex; gap: 5px; justify-content: center; align-items: center">
                                                                                                                <button type="button" class="btn btn-danger"
                                                                                                                        onclick="delOption('', this)">삭제
                                                                                                                </button>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif ?>
                                </td>
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>	
            </div>
            <div class="tail_menu">
                <ul>
                    <li class="left"></li>
                    <li class="right_sub">

                        <a href="/AdmMaster/_tourRegist/write_spas?search_category=&search_txt=&pg=&product_idx=<?= $product_idx?>" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">상품상세</span></a>
                        <a href="/AdmMaster/_tourRegist/list_spas" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span><span class="txt">리스트</span></a>
                        <?php if (!empty($productSpasInfo)) { ?>	
                            <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">수정</span></a>
                            <?php } else { ?>
                                <a href="javascript:send_it()" class="btn btn-default"><span class="glyphicon glyphicon-cog"></span><span class="txt">등록</span></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- // contents --> 
        </form>
	</span><!-- 인쇄 영역 끝 //--> 
</div>
<script>
	var tableCount = <?= (isset($productSpasInfo) && count($productSpasInfo) > 0) ? (count($productSpasInfo) - 1) : 0 ?>;
	var arr_count = [];

	$(document).on("change", ".all_yoil", function() {
		if ($(this).is(":checked")) {
			$(this).closest(".table_list").find(".yoil").prop("checked", true);
		} else {
			$(this).closest(".table_list").find(".yoil").prop("checked", false);
		}
	});

	$(document).on("change", ".yoil", function() {
		$(this).closest("td").find(".all_yoil").prop('checked', $(this).closest("td").find(".yoil:checked").length === $(this).closest("td").find(".yoil").length);
	});

	$(document).ready(function () {

		// 개별 체크박스 클릭 시 전체 선택 체크박스 상태 변경
		$('.priceDow').on('change', function () {
			$('#checkAll').prop('checked', $('.priceDow:checked').length === $('.priceDow').length);
		});

		initDatePicker();

	});

	function add_table() {
		tableCount++;
		var newTable = `
			<div class="table_list" data-index="${tableCount}" style="width: 100%; margin-bottom: 20px;">
				<table style="width: 100%">
					<colgroup>
						<col width="35%">
						<col width="*">
						<col width="10%">
						<col width="15%">
					</colgroup>
					<thead>
						<tr>
							<th>기간</th>
							<th>출발요일</th>
							<th>기존상품가</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div style="display: flex; justify-content: center; align-items: center; gap: 5px;">
									<input type="text" readonly class="datepicker s_date" name="o_sdate[${tableCount}]" style="width: 150px; cursor: pointer;" value=""> ~
									<input type="text" readonly class="datepicker e_date" name="o_edate[${tableCount}]" style="width: 150px; cursor: pointer;" value="">
								</div>
							</td>
							<td>
								<input type="checkbox" class="all_yoil">전체&nbsp;&nbsp;
								<input type="checkbox" name="yoil_0[${tableCount}]" value="일요일" class="yoil"> 일요일&nbsp;&nbsp;
								<input type="checkbox" name="yoil_1[${tableCount}]" value="월요일" class="yoil"> 월요일&nbsp;&nbsp;
								<input type="checkbox" name="yoil_2[${tableCount}]" value="화요일" class="yoil"> 화요일&nbsp;&nbsp;
								<input type="checkbox" name="yoil_3[${tableCount}]" value="수요일" class="yoil"> 수요일&nbsp;&nbsp;
								<input type="checkbox" name="yoil_4[${tableCount}]" value="목요일" class="yoil"> 목요일&nbsp;&nbsp;
								<input type="checkbox" name="yoil_5[${tableCount}]" value="금요일" class="yoil"> 금요일&nbsp;&nbsp;
								<input type="checkbox" name="yoil_6[${tableCount}]" value="토요일" class="yoil"> 토요일&nbsp;&nbsp;
							</td>
							<td>
								<input type="text" name="spas_info_price[${tableCount}]" numberOnly=true>
							</td>
							<td>
								<div style="margin:10px; display: flex; justify-content: center; gap: 5px">
									<a href="javascript:add_spas(${tableCount});" class="btn btn-primary">추가</a>
									<a href="javascript:remove_table(${tableCount});" class="btn btn-danger">삭제</a>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<table style="width:100%">
									<thead>
										<tr style="height:40px">
											<td style="width:*;text-align:center">상품타입</td>
											<td style="width:15%;text-align:center">성인가격(단위: 바트)</td>
											<td style="width:15%;text-align:center">소아가격(단위: 바트)</td>
											<td style="width:15%;text-align:center">판매상태</td>
										</tr>
									</thead>
									<tbody class="air_main">
										<tr class="air_list_1" style="height:40px">
											<td style="width:100px;text-align:center">
												<input type="hidden" name="spas_idx[${tableCount}][]" class="spas_idx" value="">
												<input type="text" name="spas_subject[${tableCount}][]" value="" class="spas_subject input_txt" placeholder="국문글씨 입력해주세요" style="width: 100%" />
												<input type="text" name="spas_subject_eng[${tableCount}][]" value="" class="spas_subject input_txt" placeholder="영문글씨 입력해주세요" style="width: 100%; margin-top: 10px;" />
											</td>
											<td style="text-align:center">
												<input type="text" name="spas_price[${tableCount}][]" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
											</td>
											<td style="text-align:center">
												<input type="text" name="spas_price_kids[${tableCount}][]" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
											</td>
											<td>
												<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
													<select name="status[${tableCount}][]">
														<option value="Y" selected>판매중</option>
														<option value="N">중지</option>
													</select>
													<a href="javascript:remove_spas(${tableCount}, 0);" class="btn btn-danger">삭제</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<table style="width: 100%">
									<colgroup>
										<col width="7%">
										<col width="*">
									</colgroup>
									
									<tbody>
										<tr>
											<th>옵션추가</th>
											<td>
												<button type="button" class="btn btn-primary" onclick="add_main_option(this, ${tableCount});">추가</button>	
												<div class="option_area">
													<input type="hidden" name="moption_idx[${tableCount}][0]" class="moption_idx" value="">
													<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
														<colgroup>
															<col width="10%">
															<col width="90%">
														</colgroup>
														<tbody>
														<tr height="45">
															<th colspan="5">
																<div class="flex__c" style="gap: 5px;">
																	옵션 <input type='text' name='moption_name[${tableCount}][0]'
																				value="" style="width:550px"/>
																	<button type="button" class="btn btn-danger"
																			onclick="del_main_option('', this);">삭제
																	</button>
																</div>
															</th>
														</tr>
														<tr height="45">
															<th>
																추가 옵션등록
																<div class="flex" style="margin-top:10px; gap: 5px;">
																	<button type="button"
																			onclick="add_sub_option(this, ${tableCount}, 0);"
																			class="btn btn-primary">추가
																	</button>
																</div>
															</th>
															<td>
																<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다.</span>
																<table>
																	<colgroup>
																		<col width="*"></col>
																		<col width="10%"></col>
																		<col width="10%"></col>
																		<col width="10%"></col>
																		<col width="12%"></col>
																	</colgroup>
																	<thead>
																	<tr>
																		<th>옵션명 한글/영문</th>
																		<th>가격(단위: 바트)</th>
																		<th>적용</th>
																		<th>순서</th>
																		<th>삭제</th>
																	</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td>
																				<input type="hidden" name="op_spa_idx[${tableCount}][0][]" class="op_spa_idx" value="">
																				<input type='text' name='o_name[${tableCount}][0][]' value="" style="width:48%;" />
																				<input type='text' name='o_name_eng[${tableCount}][0][]' value="" style="width:48%;" />
																			</td>
																			<td>
																				<input type='text' style="text-align:right;"
																						name='o_price[${tableCount}][0][]' value="" numberOnly=true/>
																			</td>
																			<td>
																				<select name="use_yn[${tableCount}][0][]" style="width:100%">
																					<option value="Y">
																						판매중
																					</option>
																					<option value="N">
																						중지
																					</option>
																				</select>
																			</td>
																			<td>
																				<input type='text' name='o_num[${tableCount}][0][]' value="" numberOnly=true/>
																			</td>
																			<td>
																				<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
																					<button type="button" class="btn btn-danger"
																							onclick="delOption('', this)">삭제
																					</button>
																				</div>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
														</tbody>
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		`;
		$(".table_list:last").after(newTable);
		// $(".datepicker").datepicker();
		initDatePicker();
		$(".price").number(true);
	}

	function initDatePicker() {
		$(".s_date").datepicker({
			dateFormat: 'yy-mm-dd',
			showOn: "both",
			buttonImage: "/images/admin/common/date.png",
			buttonImageOnly: true,
			closeText: '닫기',
			currentText: '오늘',
			prevText: '이전',
			nextText: '다음',
			yearRange: "c:c+10",
			minDate: new Date(),
			maxDate: "+99Y",
			onClose: function (selectedDate) {
				$(".e_date").datepicker("option", "minDate", selectedDate);
			},
			beforeShow: function (input) {
				setTimeout(function () {
					var buttonPane = $(input)
						.datepicker("widget")
						.find(".ui-datepicker-buttonpane");
					var btn = $('<button class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
					btn.unbind("click").bind("click", function () {
						$.datepicker._clearDate(input);
					});
					btn.appendTo(buttonPane);
				}, 1);
			}
		});


		$(".e_date").datepicker({
			showButtonPanel: true
			, onClose: function (selectedDate) {
				// To 날짜 선택기의 최소 날짜를 설정
				$(".s_date").datepicker("option", "maxDate", selectedDate);
			}
			, beforeShow: function (input) {
				setTimeout(function () {
					var buttonPane = $(input)
						.datepicker("widget")
						.find(".ui-datepicker-buttonpane");
					btn.unbind("click").bind("click", function () {
						$.datepicker._clearDate(input);
					});
					btn.appendTo(buttonPane);
				}, 1);
			}
			, dateFormat: 'yy-mm-dd'
			, showOn: "both"
			, yearRange: "c:c+30"
			, buttonImage: "/images/admin/common/date.png"
			, buttonImageOnly: true
			, closeText: '닫기'
			, currentText: '오늘' // 오늘 버튼 텍스트 설정
			, prevText: '이전'
			, nextText: '다음'
			, minDate: new Date() 
			, maxDate: "+99Y"
		});
	}
	
	function remove_table(tableIndex) {
		var targetTable = $(".table_list[data-index='" + tableIndex + "']");
		if (targetTable.length > 0) {
			targetTable.remove();
		} else {
			alert("최소 하나의 투어는 유지해야 합니다.");
		}
	}

	function add_spas(tableListIndex) {
		var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		var newRow = `
			<tr class="air_list_1" style="height:40px">
				<td style="text-align:center">
					<input type="hidden" name="spas_idx[${tableListIndex}][]" class="spas_idx" value="">
					<input type="text" name="spas_subject[${tableListIndex}][]" value="" class="spas_subject input_txt" placeholder="국문글씨 입력해주세요" style="width:100%" />
					<input type="text" name="spas_subject_eng[${tableListIndex}][]" value="" class="spas_subject input_txt" placeholder="영문글씨 입력해주세요" style="width: 100%; margin-top: 10px;" />
				</td>
				<td style="text-align:center">
					<input type="text" name="spas_price[${tableListIndex}][]" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
				</td>
				<td style="text-align:center">
					<input type="text" name="spas_price_kids[${tableListIndex}][]" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${tableListIndex}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_spas(${tableListIndex}, ${rowIndex});" class="btn btn-danger">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}

	function remove_spas(tableListIndex, rowIndex) {
		var targetTable = $(".table_list[data-index='" + tableListIndex + "']").find(".air_main");
    
		if (targetTable.find(".air_list_1").length > 1) {
			targetTable.find(".air_list_1").eq(rowIndex).remove();
		} else {
			alert("최소 하나의 투어는 유지해야 합니다."); 
		}
	}

	function add_spa(infoIdx) {
		var targetTable = $(".table_list[data-info-idx='" + infoIdx + "']").find(".air_main");
		var rowIndex = targetTable.find(".air_list_1").length;

		var newRow = `
			<tr class="air_list_1" style="height:40px">
				<td>
					<input type="hidden" name="spas_idx[${infoIdx}][]" class="spas_idx" value="new">
					<input type="text" name="spas_subject[${infoIdx}][]" value="" class="spas_subject input_txt" placeholder="국문글씨 입력해주세요" style="width:100%" />
					<input type="text" name="spas_subject_eng[${infoIdx}][]" value="" class="spas_subject input_txt" placeholder="영문글씨 입력해주세요" style="width: 100%; margin-top: 10px;" />
				</td>
				<td>
					<input type="text" name="spas_price[${infoIdx}][]" value="" class="price spas_price input_txt" style="width:100%" numberOnly=true/>
				</td>
				<td>
					<input type="text" name="spas_price_kids[${infoIdx}][]" value="" class="price spas_price_kids input_txt" style="width:90%" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 10px; align-items: center; justify-content: center">
						<select name="status[${infoIdx}][]">
							<option value="Y" selected>판매중</option>
							<option value="N">중지</option>
						</select>
						<a href="javascript:remove_spas(${infoIdx}, ${rowIndex});" class="btn btn-danger">삭제</a>
					</div>
				</td>
			</tr>
		`;

		targetTable.append(newRow);
		$(".price").number(true);
	}

	function add_main_option(button, idx) {
		let count_moption = Number($(button).closest("td").find(".count_moption").val() ?? 0)
		let count = count_moption > 0 ? (count_moption - 1) : 0;
		
		if(!arr_count[idx] && arr_count[idx] != 0){
			arr_count[idx] = count;			
		}
		arr_count[idx]++;
		
		let html = `
			<div class="option_area">
				<input type="hidden" name="moption_idx[${idx}][${arr_count[idx]}]" class="moption_idx" value="">
				<table cellpadding="0" cellspacing="0" summary="" class="listTable mem_detail" style="margin-top:10px;">
					<colgroup>
						<col width="10%">
						<col width="90%">
					</colgroup>
					<tbody>
					<tr height="45">
						<th colspan="5">
							<div class="flex__c" style="gap: 5px;">
								옵션 <input type='text' name='moption_name[${idx}][${arr_count[idx]}]'
											value="" style="width:550px"/>
								<button type="button" class="btn btn-danger"
										onclick="del_main_option('', this);">삭제
								</button>
							</div>
						</th>
					</tr>
					<tr height="45">
						<th>
							추가 옵션등록
							<div class="flex" style="margin-top:10px; gap: 5px;">
								<button type="button"
										onclick="add_sub_option(this, ${idx}, ${arr_count[idx]});"
										class="btn btn-primary">추가
								</button>
							</div>
						</th>
						<td>
							<span style="color:red;">※ 옵션 삭제 시에 해당 옵션과 연동된 주문, 결제내역에 영향을 미치니 반드시 확인 후에 삭제바랍니다.</span>
							<table>
								<colgroup>
									<col width="*"></col>
									<col width="10%"></col>
									<col width="10%"></col>
									<col width="10%"></col>
									<col width="12%"></col>
								</colgroup>
								<thead>
								<tr>
									<th>옵션명 한글/영문</th>
									<th>가격(단위: 바트)</th>
									<th>적용</th>
									<th>순서</th>
									<th>삭제</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="hidden" name="op_spa_idx[${idx}][${arr_count[idx]}][]" class="op_spa_idx" value="">
											<input type='text' name='o_name[${idx}][${arr_count[idx]}][]' value="" style="width:48%;" />
											<input type='text' name='o_name_eng[${idx}][${arr_count[idx]}][]' value="" style="width:48%;" />
										</td>
										<td>
											<input type='text' style="text-align:right;"
													name='o_price[${idx}][${arr_count[idx]}][]' value="" numberOnly=true/>
										</td>
										<td>
											<select name="use_yn[${idx}][${arr_count[idx]}][]" style="width:100%">
												<option value="Y">
													판매중
												</option>
												<option value="N">
													중지
												</option>
											</select>
										</td>
										<td>
											<input type='text' name='o_num[${idx}][${arr_count[idx]}][]' value="" numberOnly=true/>
										</td>
										<td>
											<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
												<button type="button" class="btn btn-danger"
														onclick="delOption('', this)">삭제
												</button>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		`;

		$(button).closest("td").append(html);
	}

	function add_sub_option(button, info_idx, op_idx) {
		let html = `
			<tr>
				<td>
					<input type="hidden" name="op_spa_idx[${info_idx}][${op_idx}][]" class="op_spa_idx" value="">
					<input type='text' name='o_name[${info_idx}][${op_idx}][]' value="" style="width:48%;" />
					<input type='text' name='o_name_eng[${info_idx}][${op_idx}][]' value="" style="width:48%;" />
				</td>
				<td>
					<input type='text' style="text-align:right;"
							name='o_price[${info_idx}][${op_idx}][]' value="" numberOnly=true/>
				</td>
				<td>
					<select name="use_yn[${info_idx}][${op_idx}][]" style="width:100%">
						<option value="Y">
							판매중
						</option>
						<option value="N">
							중지
						</option>
					</select>
				</td>
				<td>
					<input type='text' name='o_num[${info_idx}][${op_idx}][]' value="" numberOnly=true/>
				</td>
				<td>
					<div style="display: flex; gap: 5px; justify-content: center; align-items: center">
						<button type="button" class="btn btn-danger"
								onclick="delOption('', this)">삭제
						</button>
					</div>
				</td>
			</tr>
		`;

		$(button).closest("tr").find("table tbody").append(html);
	}

	$(window).load(function(){
		$("#datepicker1").datepicker("setDate", '<?=$s_date?>');
		$("#datepicker2").datepicker("setDate", '<?=$e_date?>');
	});

	function copy_last_spa(product_idx) {
		if (!confirm("이 제품을 복사하시겠습니까?")) {
			return false;
		}
		$.ajax({
			url: "<?= route_to('admin.api.spa_.copy_last_spa') ?>",
			type: "POST",
			data: {
				"product_idx": product_idx,
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				alert(data.message);
				if(data.result){
					location.reload();
				}
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
	}

	function delete_spa(spas_idx, info_idx, product_idx) {
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "<?= route_to('admin.api.spa_.del_spa_option') ?>",
			type: "POST",
			data: {
				"spas_idx": spas_idx,
				"info_idx": info_idx,
				"product_idx": product_idx
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				alert(data.message);
				location.reload();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
	}

	function del_main_option(idx, button){
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		if(idx){
			$.ajax({
				url: "<?= route_to('admin.api.spa_.del_main_option') ?>",
				type: "POST",
				data: {
					"code_idx": idx,
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					alert(data.message);
					$(button).closest(".option_area").remove();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
				}
			});
		}else{
			$(button).closest(".option_area").remove();
		}
	}

	function delOption(idx, button){
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		if(idx){
			$.ajax({
				url: "<?= route_to('admin.api.spa_.del_sub_option') ?>",
				type: "POST",
				data: {
					"idx": idx,
				},
				dataType: "json",
				async: false,
				cache: false,
				success: function (data, textStatus) {
					alert(data.message);
					$(button).closest("tr").remove();
				},
				error: function (request, status, error) {
					alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
				}
			});
		}else{
			$(button).closest("tr").remove();
		}

	}

	function del_spas(info_idx, spas_idx_json) {	
		var spas_idx_array = JSON.parse(spas_idx_json);

		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다.")) {
			return false;
		}

		$.ajax({
			url: "<?= route_to('admin.api.spa_.del_spas') ?>",
			type: "POST",
			data: {
				"info_idx": info_idx,
				"spas_idx": spas_idx_array
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function (data, textStatus) {
				alert(data.message);
				location.reload();
			},
			error: function (request, status, error) {
				alert("code = " + request.status + " message = " + request.responseText + " error = " + error);
			}
		});
	}	

	function write_day_price(info_idx, product_idx){
		location.href = "/AdmMaster/_tourRegist/list_spas_price?info_idx="+info_idx+"&product_idx="+product_idx;
	}
</script>

<script>
	function send_it(){
		var frm = document.frm;

		for (i = 0; i < $(".spas_idx").length; i++)
		{
			if ($(".spas_subject:eq("+i+")").val() == "")
			{
				$(".spas_subject:eq("+i+")").focus();
				alert("상품명을 입력해주셔야 합니다.");
				return;
			}
		}

		for (i = 0; i < $(".spas_idx").length; i++)
		{
			if ($(".spas_price:eq("+i+")").val() == "")
			{
				$(".spas_price:eq("+i+")").focus();
				alert("가격을 입력해주셔야 합니다.");
				return;
			}

			if ($(".spas_price_kids:eq("+i+")").val() == "")
			{
				$(".spas_price_kids:eq("+i+")").focus();
				alert("가격을 입력해주셔야 합니다.");
				return;
			}
			
			// if ($(".spas_price_baby:eq("+i+")").val() == "")
			// {
			// 	$(".spas_price_baby:eq("+i+")").focus();
			// 	alert("가격을 입력해주셔야 합니다.");
			// 	return;
			// }

		}
		frm.submit();
	}
</script>

<? include "../_include/_footer.php"; ?>
<?= $this->endSection() ?>