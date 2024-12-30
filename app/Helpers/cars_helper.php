<?php
    helper("my_helper");

    function traverseCategories($categories, $code, $depth)
    {   
        $codeModel = model("Code");
        $productModel = model("ProductModel");
        $carsPriceModel = model("CarsPrice");
        $flightModel = model("FlightModel");
        $categoryFlight = model("CategoryFlight");

        $codes = $codeModel->getByParentCode($code)->getResultArray();
        $airlines = $codeModel->getByParentCode(14)->getResultArray();

        $products = $productModel->findProductPaging([
                    'product_code_1' => 1324
                ], 10000, 1, [])["items"];

        $html = '
            <table cellpadding="0" cellspacing="0" class="listTable mem_detail depth_'. $depth .'">
                <colgroup>
                    <col width="15%"/>
                    <col width="90%"/>
                </colgroup>
                <tbody>
                    <tr height="45">
                        <th>카테고리 선택 '. $depth .'</th>
                        <td>
                            <select name="category_code_'. $depth .'" class="input_select category_code_'. $depth .'">
                                <option value="all">전체선텍</option>';
                                
        foreach($codes as $code){
            $html.= '<option value="'. $code["code_no"] .'">'. $code["code_name"] .'</option>';
        }   

        $html .=            '</select>
                            <button type="button" class="btn_01" onclick="get_depth_category(this, '. $depth .')">추가</button>
                        </td>
                    </tr>';

        foreach ($categories as $category) {
            $products_price = $carsPriceModel->getData($category["ca_idx"]);
            $arr_child_code = $codeModel->getByParentCode($category["code_no"])->getResultArray();
            $count_child_code = count($arr_child_code);

            $air_arr = $categoryFlight->getAllAirlines($category["ca_idx"]);

            $parent_code = $codeModel->getByCodeNo($category["code_no"])["parent_code_no"];

            $html .=   '<tr height="45" class="child_category" data-code="'. $category["code_no"] .'" data-ca_idx="'. $category["ca_idx"] .'">
                            <th>
                                <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">'                                                          
                                    . getCodeFromCodeNo($category["code_no"])["code_name"] . 
                                    '<button type="button" onclick="del_category(this, '. $category["ca_idx"] .')" class="btn_02">삭제</button>
                                </div>
                            </th>
                            <td>';
             
            if($parent_code == "5401" && !empty($parent_code) && $depth == 2){
                $html .= '
                    <table cellpadding="0" cellspacing="0" class="listTable mem_detail airline_table">
                        <colgroup>
                            <col width="15%"/>
                            <col width="90%"/>
                        </colgroup>
                        <tbody>
                            <tr height="45">
                                <th>항공사를 선택하세요</th>
                                <td>
                                    <select name="airline_idx" class="input_select airline_idx">
                                        <option value="all">전체선텍</option>
                ';
                foreach($airlines as $airline){
                    $html.= '<option value="'. $airline["code_idx"] .'">'. $airline["code_name"] .'</option>';
                }   
                $html .=            '</select>
                                    <button type="button" onclick="get_airline(this)" class="btn_01">추가</button>
                                </td>
                            </tr>';
                foreach($air_arr as $air){
                    $html .=    '<tr height="45" class="child_airline" data-airline_idx="'. $air["air_idx"] .'" data-ca_idx="'. $air["ca_idx"] .'">
                                    <th>
                                        <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">
                                            ' . $air["code_name"] .'
                                            <button type="button" onclick="del_airline(this, '. $air["air_idx"] .')" class="btn_02">삭제</button>
                                        </div>
                                    </th>
                                    <td>
                                        <table cellpadding="0" cellspacing="0" class="listTable mem_detail">
                                            <colgroup>
                                                <col width="15%">
                                                <col width="90%">
                                            </colgroup>
                                            <tbody>
                                                <tr height="45">
                                                    <th>비행 선택</th>
                                                    <td>
                                                        <select name="f_idx" class="input_select f_idx">
                                                            <option value="all">전체선텍</option>';
                    $flights = $flightModel->getAllData($air["air_idx"]);
                    foreach($flights as $flight){
                        $html .=  '<option value="'.$flight["f_idx"].'">'.$flight["code_flight"].'</option>';
                    }

                    $html .=                            '</select>
                                                        <button type="button" onclick="get_flight(this)" class="btn_01">추가</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="flight_table">
                                                            <colgroup>
                                                                <col width="*">
                                                                <col width="40%">
                                                                <col width="40%">
                                                                <col width="10%">
                                                            </colgroup>
                                                            <thead>
                                                            <tr>
                                                                <th>항공번호</th>
                                                                <th>출발지 / 출발시간</th>
                                                                <th>도착지 / 도착시간</th>
                                                                <th>삭제</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>';
                        $flight_arr = $categoryFlight->getAllFlight($category["ca_idx"], $air["air_idx"]);
                        foreach($flight_arr as $flight){
                            $html .=                        '
                                                                <tr data-f_idx="'. $flight["f_idx"] .'" data-cf_idx="'. $flight["cf_idx"] .'">
                                                                    <td style="text-align: center;">
                                                                        <span>'. $flight["code_flight"] .'</span>
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        '. $flight["f_depature_name"] .' / '. $flight["f_depature_time"] .'
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                    '. $flight["f_destination_name"] .' / '. $flight["f_destination_time"] .'
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        <button type="button" onclick="del_flight(this, '. $flight["cf_idx"] .')" class="btn_02">
                                                                            삭제
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            ';
                        }
                        $html .=                            '</tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>';
                }            
                    $html .=    
                        '</tbody>
                    </table>';
            }
                            
            if (!empty($category['children'])) {
                $html .= traverseCategories($category['children'], $category['code_no'], $depth + 1);
            }else if(empty($category['children']) && $count_child_code > 0){
                $html .= '
                    <table cellpadding="0" cellspacing="0" class="listTable mem_detail depth_'. ($depth + 1) .'">
                        <colgroup>
                            <col width="15%">
                            <col width="90%">
                        </colgroup>
                        <tbody>
                            <tr height="45">
                                <th>카테고리 선택 '. ($depth + 1) .'</th>
                                <td>
                                    <select name="category_code_'. ($depth + 1) .'" class="input_select category_code_'. ($depth + 1) .'">
                                        <option value="all">전체선텍</option>';
                        foreach($arr_child_code as $code){
                            $html .= '<option value="'. $code["code_no"] .'">'. $code["code_name"] .'</option>';
                        }                                    
                $html .=            '</select>
                                    <button type="button" onclick="get_depth_category(this, '. ($depth + 1) .')" class="btn_01">추가</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
            }else {
                $html .= '<table cellpadding="0" cellspacing="0" class="listTable mem_detail depth_'. ($depth + 1) .'">
                            <colgroup>
                                <col width="15%">
                                <col width="90%">
                            </colgroup>
                            <tbody>
                                <tr height="45">
                                    <th>차량 선택</th>
                                    <td>
                                        <select name="product_idx" class="input_select product_idx">
                                            <option value="all">전체선텍</option>';
                foreach($products as $product){
                    $html .= '<option value="'. $product["product_idx"] .'">'. $product["product_name"] .'</option>';
                }                            
                $html .=                '</select>
                                        <button type="button" onclick="get_product(this)" class="btn_01">추가</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="product_table">
                                            <colgroup>
                                                <col width="*">
                                                <col width="20%">
                                                <col width="20%">
                                                <col width="10%">
                                            </colgroup>
                                            <thead>
                                            <tr>
                                                <th>상품명</th>
                                                <th>가격(단위: 바트) <input type="checkbox" onchange="init_price_all(this);"> 전체</th>
                                                <th>우대가격(단위: 바트) <input type="checkbox" onchange="sale_price_all(this);"> 전체</th>
                                                <th>삭제</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                    foreach($products_price as $price){
                        $product_name = $productModel->getById($price["product_idx"])["product_name"];
                        $html .= '<tr data-product_idx="'. $price["product_idx"] .'" data-cp_idx="'. $price["cp_idx"] .'">
                                    <td>
                                        <span>'. $product_name .'</span>
                                    </td>
                                    <td>
                                        <input type="text" class="onlynum init_price" style="text-align:right;" max-length="10" value="'. $price["init_price"] .'">
                                    </td>
                                    <td>
                                        <input type="text" class="onlynum sale_price" style="text-align:right;" max-length="10" value="'. $price["sale_price"] .'">
                                    </td>
                                    <td style="text-align: center;">
                                        <button type="button" onclick="del_product(this, '. $price["cp_idx"] .')" class="btn_02">
                                            삭제
                                        </button>
                                    </td>
                                </tr>';
                    }
                    $html .=                '</tbody>
                                        </table>
                                    </td>
                                </tr>
                        </tbody>
                    </table>';
            }

            $html .=        '</td>
                        </tr>';
        }

        $html .=  '</tbody>
            </table>';

        return $html;
    }
