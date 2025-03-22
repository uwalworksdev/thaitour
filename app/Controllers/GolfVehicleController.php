<?php

namespace App\Controllers;

use App\Models\GolfVehicleModel;
use CodeIgniter\Controller;

class GolfVehicleController extends Controller
{
    protected $golfVehicleModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->golfVehicleModel = new GolfVehicleModel();
    }

    public function list()
    {
        $g_list_rows = 100;
        $s_parent_code_no = $this->request->getVar("s_parent_code_no");
        $pg = $this->request->getVar("pg");

        $code_name = $this->golfVehicleModel->getCodeName($s_parent_code_no);

        $nTotalCount = $this->golfVehicleModel->getTotalCount($s_parent_code_no);
        $nPage = ceil($nTotalCount / $g_list_rows);
        if (empty($pg)) $pg = 1;
        $nFrom = ($pg - 1) * $g_list_rows;

        $result = $this->golfVehicleModel->getPagedData($s_parent_code_no, $nFrom, $g_list_rows);
        $num = $nTotalCount - $nFrom;
        return view('admin/_tourRegist/golf_vehicle/list', [
            "result" => $result,
            "num" => $num,
            "s_parent_code_no" => $s_parent_code_no,
            "nPage" => $nPage,
            "pg" => $pg,
            "nTotalCount" => $nTotalCount,
            "currentUri" => $this->request->getUri()->getPath(),
            "g_list_rows" => $g_list_rows,
            "code_name" => $code_name
        ]);
    }
    public function write($code_idx = null)
    {
        $s_parent_code_no = $this->request->getVar('s_parent_code_no');
        $product_idx = $this->request->getVar('product_idx');
        $yoil_idx = $this->request->getVar('yoil_idx');

        $titleStr = "생성";
        $parent_code_no = empty($s_parent_code_no) ? "0" : $s_parent_code_no;
        $distance = '';
        $type = '';
        if ($code_idx) {
            $row = $this->golfVehicleModel->getCodeByIdx($code_idx);
            $code_no = $row['code_no'];
            $code_name = $row['code_name'];
            $init_oil_price = $row['init_oil_price'];
            $ufile1 = $row['ufile1'];
            $rfile1 = $row['rfile1'];
            $status = $row['status'];
            $price = $row['price'];
            $min_cnt = $row['min_cnt'];
            $max_cnt = $row['max_cnt'];
            $onum = $row['onum'];
            $is_best = $row['is_best'];
            $distance = $row['distance'];
            $type = $row['type'];
            $titleStr = "수정";

            $depth = $row['depth'];
        } else {
            $row = $this->golfVehicleModel->getDepthAndCodeGubunByNo($parent_code_no);
            $depth = ($row['depth'] ?? 0) + 1;
            $code_gubun = $row['code_gubun'] ?? '';

            $maxCodeNoRow = $this->golfVehicleModel->getMaxCodeNo($parent_code_no, $s_parent_code_no);
            $code_no = $maxCodeNoRow['code_no'] ?? '';

            if ($code_no == "1308") { // 예약된 코드(현지투어)로 사용할 수 없습니다.
                $maxCodeNoRow = $this->golfVehicleModel->getMaxCodeNoWithReserved($parent_code_no, $s_parent_code_no);
                $code_no = $maxCodeNoRow['code_no'];
            }

            $onum = 0;
            $is_best = false;
        }
        return view("admin/_tourRegist/golf_vehicle/write", [
            "row" => $row,
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
            "min_cnt" => $min_cnt ?? "",
            "max_cnt" => $max_cnt ?? "",
            'price' => $price ?? '',
            "onum" => $onum,
            "depth" => $depth,
            "code_gubun" => $code_gubun ?? "",
            "titleStr" => $titleStr,
            "is_best" => $is_best,
            "distance" => $distance,
            "type" => $type,
            'code_idx' => $code_idx
        ]);
    }

    public function write_ok()
    {
        $code_idx = $this->request->getPost('code_idx');
        $code_gubun = $this->request->getPost('code_gubun');
        $code_no = $this->request->getPost('code_no');
        $code_name = $this->request->getPost('code_name');
        $parent_code_no = $this->request->getPost('parent_code_no');
        $depth = $this->request->getPost('depth');
        $status = $this->request->getPost('status');
        $init_oil_price = $this->request->getPost('init_oil_price') ?? 0;
        $onum = $this->request->getPost('onum');
        $product_idx = $this->request->getPost('product_idx');
        $yoil_idx = $this->request->getPost('yoil_idx');
        $is_best = (bool)$this->request->getPost('is_best');
        $distance = $this->request->getPost('distance');
        $type = $this->request->getPost('type');
        $file = $this->request->getFile('ufile1');
        $price = str_replace(',', '', $this->request->getPost('price'));
        $min_cnt = $this->request->getPost('min_cnt');
        $max_cnt = $this->request->getPost('max_cnt');

        $upload = ROOTPATH . 'public/data/code/';
        $uploadpload = ROOTPATH . 'public/data/code/';


        if ($code_idx) {
            $data = [
                'code_name' => $code_name,
                'status' => $status,
                'init_oil_price' => $init_oil_price,
                'onum' => $onum,
                'price' => $price,
                'min_cnt' => $min_cnt,
                'max_cnt' => $max_cnt,
                'is_best' => $is_best,
                'distance' => $distance,
                'type' => $type,
            ];
            $this->golfVehicleModel->update($code_idx, $data);
            //write_log("코드수정: " . json_encode($data));
        } else {
            // if ($parent_code_no == "0") {
            //     $existingCode = $this->golfVehicleModel->where('code_gubun', $code_gubun)->first();
            //     if ($existingCode) {
            //         echo "<script>alert('중복된 코드값입니다.');</script>";
            //         return;
            //     }
            // }

            $data = [
                'code_gubun' => $code_gubun,
                'code_no' => $code_no,
                'code_name' => $code_name,
                'parent_code_no' => $parent_code_no,
                'depth' => $depth,
                'status' => $status,
                'init_oil_price' => $init_oil_price,
                'onum' => $onum,
                'price' => $price,
                'min_cnt' => $min_cnt,
                'max_cnt' => $max_cnt,
                'is_best' => $is_best,
                'type' => $type,
                'distance' => $distance,
            ];
            $this->golfVehicleModel->insert($data);
            $code_idx = $this->golfVehicleModel->insertID();
            //write_log("코드등록: " . json_encode($data));
        }

        if (isset($file) && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($upload, $newName);

            $this->golfVehicleModel->update($code_idx, [
                'ufile1' => $newName,
                'rfile1' => $file->getName()
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
            $this->golfVehicleModel->delete($code_idx);
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
            $this->golfVehicleModel->update($code_idx[$j], ['onum' => $onum[$j]]);
        }
        return "OK";
    }
}
