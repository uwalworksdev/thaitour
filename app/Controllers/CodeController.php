<?php

namespace App\Controllers;

use Config\CustomConstants as ConfigCustomConstants;

class CodeController extends BaseController
{
    private $CodeModel;
    private $productModel;
    private $Bbs;
    private $db;
    private $ProductAirModel;
    private $FlightModel;

    public function __construct()
    {
        $this->db = db_connect();
        $this->CodeModel = model("Code");
        $this->productModel = model("ProductModel");
        $this->ProductAirModel = model("ProductAirModel");
        $this->Bbs = model("Bbs");
        $this->FlightModel = model("FlightModel");
        helper('my_helper');
        helper('alert_helper');
    }

    public function list_admin()
    {
        $g_list_rows = 100;
        $s_parent_code_no = $this->request->getVar("s_parent_code_no");
        $pg = $this->request->getVar("pg");

        $code_name = $this->CodeModel->getCodeName($s_parent_code_no);

        $nTotalCount = $this->CodeModel->getTotalCount($s_parent_code_no);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if (empty($pg)) $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $result = $this->CodeModel->getPagedData($s_parent_code_no, $nFrom, $g_list_rows);
        $num = $nTotalCount - $nFrom;

        $grandParentCode = $this->CodeModel->getParentCodeNoByCodeNo($s_parent_code_no)['code_no'] ?? "";

        return view("admin/_code/list", [
            "result" => $result,
            "num" => $num,
            "s_parent_code_no" => $s_parent_code_no,
            "grandParentCode" => $grandParentCode,
            "nPage" => $nPage,
            "pg" => $pg,
            "nTotalCount" => $nTotalCount,
            "currentUri" => $this->request->getUri()->getPath(),
            "g_list_rows" => $g_list_rows,
            "code_name" => $code_name
        ]);
    }

    public function write_admin()
    {
        $code_idx = $this->request->getVar('code_idx') ?? 0;
        $s_parent_code_no = $this->request->getVar('s_parent_code_no');
        $product_idx = $this->request->getVar('product_idx');
        $yoil_idx = $this->request->getVar('yoil_idx');

        $row_ds = $this->ProductAirModel->getProductAir();

        $titleStr = "생성";
        $parent_code_no = empty($s_parent_code_no) ? "0" : $s_parent_code_no;
        $distance = '';
        $type = '';
        $flight_arr = [];

        if ($code_idx) {
            $row = $this->CodeModel->getCodeByIdx($code_idx);
            $code_no = $row['code_no'];
            $code_name = $row['code_name'];
            $init_oil_price = $row['init_oil_price'];
            $ufile1 = $row['ufile1'];
            $rfile1 = $row['rfile1'];
            $status = $row['status'];
            $onum = $row['onum'];
            $is_best = $row['is_best'];
            $distance = $row['distance'];
            $type = $row['type'];
            $titleStr = "수정";
            $flight_arr = $this->FlightModel->getAllData($code_idx);
            $depth = $this->CodeModel->countByParentCodeNo($row['code_no']);
        } else {
            $row = $this->CodeModel->getDepthAndCodeGubunByNo($parent_code_no);
            $depth = ($row['depth'] ?? 0) + 1;
            $code_gubun = $row['code_gubun'] ?? '';

            $maxCodeNoRow = $this->CodeModel->getMaxCodeNo($parent_code_no, $s_parent_code_no);
            $code_no = $maxCodeNoRow['code_no'] ?? '';

            if ($code_no == "1308") { // 예약된 코드(현지투어)로 사용할 수 없습니다.
                $maxCodeNoRow = $this->CodeModel->getMaxCodeNoWithReserved($parent_code_no, $s_parent_code_no);
                $code_no = $maxCodeNoRow['code_no'];
            }

            $onum = 0;
            $is_best = false;
        }
        return view("admin/_code/write", [
            "row" => $row,
            "row_ds" => $row_ds,
            "s_parent_code_no" => $s_parent_code_no,
            "parent_code_no" => $parent_code_no,
            "product_idx" => $product_idx,
            "yoil_idx" => $yoil_idx,
            "code_no" => $code_no,
            "code_name" => $code_name ?? "",
            "init_oil_price" => $init_oil_price ?? "",
            "ufile1" => $ufile1 ?? "",
            "rfile1" => $rfile1 ?? "",
            "status" => $status ?? "",
            "onum" => $onum,
            "depth" => $depth,
            "code_gubun" => $code_gubun ?? "",
            "titleStr" => $titleStr,
            "is_best" => $is_best,
            "distance" => $distance,
            "type" => $type,
            'code_idx' => $code_idx,
            'flight_arr' => $flight_arr
        ]);
    }

    public function write_ok()
    {
        $code_idx = $this->request->getPost('code_idx');
        $code_gubun = $this->request->getPost('code_gubun');
        $code_no = $this->request->getPost('code_no');
        $code_name = $this->request->getPost('code_name');
        $code_memo = $this->request->getPost('code_memo') ?? '';
        $parent_code_no = $this->request->getPost('parent_code_no');
        $depth = $this->request->getPost('depth');
        $status = $this->request->getPost('status');
        $init_oil_price = $this->request->getPost('init_oil_price') ?? 0;
        $onum = $this->request->getPost('onum');
        $is_best = (bool)$this->request->getPost('is_best');
        $distance = $this->request->getPost('distance');
        $type = $this->request->getPost('type');
        $file = $this->request->getFile('ufile1');

        $f_idx = $this->request->getPost("f_idx") ?? [];
        $code_flight = $this->request->getPost("code_flight") ?? [];
        $f_depature_name = $this->request->getPost("f_depature_name") ?? [];
        $f_destination_name = $this->request->getPost("f_destination_name") ?? [];
        $f_depature_time = $this->request->getPost("f_depature_time") ?? [];
        $f_destination_time = $this->request->getPost("f_destination_time") ?? [];

        $upload = ROOTPATH . 'public/data/code/';

        if ($code_idx) {
            $data = [
                'code_name' => $code_name,
                'status' => $status,
                'init_oil_price' => $init_oil_price,
                'onum' => $onum,
                'is_best' => $is_best,
                'distance' => $distance,
                'type' => $type,
                'code_memo' => $code_memo,
            ];
            $this->CodeModel->update($code_idx, $data);

            if($parent_code_no == "14"){
                foreach($f_idx as $key => $value){
                    if(!empty($value)){
                        $this->FlightModel->updateData($value, [
                            "code_flight" => $code_flight[$key] ?? "",
                            "f_depature_name" => $f_depature_name[$key] ?? "",
                            "f_destination_name" => $f_destination_name[$key] ?? "",
                            "f_depature_time" => $f_depature_time[$key] ?? "",
                            "f_destination_time" => $f_destination_time[$key] ?? ""
                        ]);
                    }else{
                        $this->FlightModel->insertData([
                            "code_idx" => $code_idx,
                            "code_flight" => $code_flight[$key] ?? "",
                            "f_depature_name" => $f_depature_name[$key] ?? "",
                            "f_destination_name" => $f_destination_name[$key] ?? "",
                            "f_depature_time" => $f_depature_time[$key] ?? "",
                            "f_destination_time" => $f_destination_time[$key] ?? ""
                        ]);
                    }
                }
            }

            //write_log("코드수정: " . json_encode($data));
        } else {
            if ($parent_code_no == "0") {
                $existingCode = $this->CodeModel->where('code_gubun', $code_gubun)->first();
                if ($existingCode) {
                    echo "<script>alert('중복된 코드값입니다.');</script>";
                    return;
                }
            }

            $data = [
                'code_gubun' => $code_gubun,
                'code_no' => $code_no,
                'code_name' => $code_name,
                'parent_code_no' => $parent_code_no,
                'depth' => $depth,
                'status' => $status,
                'init_oil_price' => $init_oil_price,
                'onum' => $onum,
                'is_best' => $is_best,
                'type' => $type,
                'distance' => $distance,
                'code_memo' => $code_memo,
            ];
            $this->CodeModel->insert($data);
            $code_idx = $this->CodeModel->insertID();

            if($parent_code_no == "14"){
                foreach($f_idx as $key => $value){
                    $this->FlightModel->insertData([
                        "code_idx" => $code_idx,
                        "code_flight" => $code_flight[$key] ?? "",
                        "f_depature_name" => $f_depature_name[$key] ?? "",
                        "f_destination_name" => $f_destination_name[$key] ?? "",
                        "f_depature_time" => $f_depature_time[$key] ?? "",
                        "f_destination_time" => $f_destination_time[$key] ?? ""
                    ]);
                }
            }
            
            //write_log("코드등록: " . json_encode($data));
        }

        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($upload, $newName);

            $this->CodeModel->update($code_idx, [
                'ufile1' => $newName,
                'rfile1' => $file->getClientName()
            ]);
        }

        if ($code_idx) {
            echo "<script>parent.location.reload();</script>";
        } else {
            echo "<script>parent.location.href='list?s_parent_code_no={$parent_code_no}';</script>";
        }
    }

    public function del()
    {
        $code_idx = $this->request->getPost('code_idx');
        try {
            $this->CodeModel->delete($code_idx);
            $message = "삭제완료";
        } catch (\Throwable $th) {
            $message = "삭제오류: " . $th->getMessage();
        }
        return $this->response->setJSON(['message' => $message]);
    }

    public function delete_flight()
    {
        $f_idx = $this->request->getPost('idx');
        try {
            $this->FlightModel->deleteData($f_idx);
            $message = "삭제완료";
        } catch (\Throwable $th) {
            $message = "삭제오류: " . $th->getMessage();
        }
        return $this->response->setJSON(['message' => $message]);
    }

    public function change_ajax()
    {
        $code_idx = $this->request->getPost('code_idx');
        $onum = $this->request->getPost('onum');
        $tot = count($code_idx);
        for ($j = 0; $j < $tot; $j++) {
            $this->CodeModel->update($code_idx[$j], ['onum' => $onum[$j]]);
        }
        return "OK";
    }
    public function ajaxGet() {
        $depth = $this->request->getVar('depth');
        $parent_code_no = $this->request->getVar('parent_code_no');
        $results = $this->CodeModel->getByParentAndDepth($parent_code_no, $depth)->getResultArray();
        return $this->response->setJSON($results);
    }

    public function get_sub_code() {
        $depth = $this->request->getVar('depth');
        $parent_code_no = $this->request->getVar('code');
        $results = $this->CodeModel->getByParentAndDepth($parent_code_no, $depth)->getResultArray();
        $cnt = count($results);
        $data = [
            "results" => $results,
            "cnt" => $cnt
        ];
        return $this->response->setJSON($data);
    }

    public function get_list_product() {
        $code_no = $this->request->getVar('product_code');
        $field = $this->request->getVar('field');
        $results = $this->productModel->getAllProductsBySubCode($field ,$code_no);
        $cnt = count($results);
        $data = [
            "results" => $results,
            "cnt" => $cnt
        ];
        return $this->response->setJSON($data);
    }


    public function get_child_code() {
        $parent_code_no = $this->request->getVar('code');
        $results = $this->CodeModel->getByParentCode($parent_code_no)->getResultArray();
        return $this->response->setJSON($results);
    }
}