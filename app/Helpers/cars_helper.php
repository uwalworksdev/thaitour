<?php
    helper("my_helper");

    function traverseCategories($categories, $code, $depth)
    {   
        $codeModel = model("Code");
        $productModel = model("ProductModel");
        $carsPriceModel = model("CarsPrice");

        $codes = $codeModel->getByParentCode($code)->getResultArray();
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

            $html .=   '<tr height="45" class="child_category" data-code="'. $category["code_no"] .'" data-ca_idx="'. $category["ca_idx"] .'">
                            <th>
                                <div style="display: flex; gap: 20px; align-items: center; justify-content: space-between;">'                                                          
                                    . getCodeFromCodeNo($category["code_no"])["code_name"] . 
                                    '<button type="button" onclick="del_category(this, '. $category["ca_idx"] .')" class="btn_02">삭제</button>
                                </div>
                            </th>
                            <td>';
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
