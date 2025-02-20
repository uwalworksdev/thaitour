<?php

namespace App\Controllers;


class BoardController extends BaseController
{
    private $bbsConfigModel;
    private $bbsModel;
    private $bbsCategoryModel;
    private $codeModel;
    private $ProductModel;
    private $bbsCommentModel;
    private $eventDispModel;
    private $uploadPath = ROOTPATH . "public/data/bbs/";

    public function __construct()
    {
        $this->bbsConfigModel = model("BbsConfigModel");
        $this->bbsModel = model("Bbs");
        $this->bbsCategoryModel = model("BbsCategoryModel");
        $this->codeModel = model("Code");
        $this->ProductModel = model("ProductModel");
        $this->bbsCommentModel = model("BbsCommentModel");
        $this->eventDispModel = model("EventDispModel");
        error_reporting(1);
    }

    public function listNew($term, $reg_date1)
    {
        $sub_date = date("Y-m-d H:i:s", mktime(date('H') - $term, date('i'), date('s'), date('m'), date('d'), date('Y')));

        if ($reg_date1 < $sub_date) {
            $show = 1;
        } else {
            $show = 0;
        }

        return $show;
    }

    public function index()
    {
        $code = $this->request->getGet('code');
        $scategory = $this->request->getGet('scategory');
        $search_word = $this->request->getGet('search_word');
        $search_mode = $this->request->getGet('search_mode');
        $g_list_rows = 10;

        $pg = $this->request->getGet('pg') ?? 1;

        $builder = $this->bbsModel->List($code, ['search_word' => $search_word, 'search_mode' => $search_mode, 'category' => $scategory]);

        $nTotalCount = $builder->countAllResults(false);

        $nPage = ceil($nTotalCount / $g_list_rows);

        $rows = $builder->paginate($g_list_rows, 'default', $pg);

        foreach ($rows as &$row) {
            $row['is_new'] = $this->listNew(24, $row['r_date']);
        }

        $config = $this->bbsConfigModel->where("board_code", $code)->first();

        $data = [
            'code' => $code,
            'scategory' => $scategory,
            'search_mode' => $search_mode,
            'search_word' => $search_word,
            'nTotalCount' => $nTotalCount,
            'g_list_rows' => $g_list_rows,
            'pg' => $pg,
            'nPage' => $nPage,
            'rows' => $rows,
            'categories' => $this->bbsCategoryModel->getCategoriesByCodeAndStatus($code),
        ];

        // Load the view with the data
        return view('admin/_board/list', array_merge($data, $config));
    }

    public function board_write($bbs_idx = null)
    {
        $data = $this->request->getVar();

        if ($bbs_idx) {
            $data['bbs_idx'] = $bbs_idx;
            $info = $this->bbsModel->View($bbs_idx);
            $data['info'] = $info;
            $data['event_list'] = $this->ProductModel->getProductsByEvent($bbs_idx);
            $data['list_comment'] = $this->bbsCommentModel->getCommentsWithMemberDetails($bbs_idx, $data['code'], private_key());
            $data['list_code3'] = $this->codeModel->getByParentAndDepth($info['product_code_1'], '3')->getResultArray();
            $info['list_code4'] = $this->codeModel->getByParentAndDepth($info['product_code_2'], '4')->getResultArray();
        }

        $data['config'] = $this->bbsConfigModel->where("board_code", $data['code'])->first();
        $data['list_category'] = $this->bbsCategoryModel->getCategoriesByCodeAndStatus($data['code']);
        $data['list_code'] = $this->codeModel->getCodesByGubunDepthAndStatus('tour', '2');
        $data['list_code2'] = $this->codeModel->getCodesByGubunDepthAndStatusExclude('tour', '2', ['1308', '1309']);
        $data['list_code_faq'] = $this->codeModel->getCodesByGubunDepthAndStatus('faq', '2');

        return view('admin/_board/write', $data);
    }

    public function write_ok($bbs_idx = null)
    {
        $uploadPath = $this->uploadPath;

        $files = $this->request->getFiles();

        $data = $this->request->getPost();

        if (!$data['writer']) {
            $data['writer'] = '관리자';
        }

        for ($i = 1; $i <= 6; $i++) {
            if ($this->request->getPost("del_$i") == "Y") {
                $data["ufile$i"] = "";
                $data["rfile$i"] = "";

            }
            if ($files["ufile$i"]) {
                $file = $files["ufile$i"];

                if ($file->isValid() && !$file->hasMoved()) {
                    $fileName = $file->getClientName();
                    $data["rfile$i"] = $fileName;

                    if (no_file_ext($fileName) == "Y") {
                        $microtime = microtime(true);
                        $timestamp = sprintf('%03d', ($microtime - floor($microtime)) * 1000);
                        $date = date('YmdHis');
                        $ext = explode(".", strtolower($fileName));
                        $newName = $date . $timestamp . '.' . $ext[1];
                        $data["ufile$i"] = $newName;
                        write_log("$i - $uploadPath - $newName");
                        $file->move($uploadPath, $newName);

                    }
                }
            }
        }

        if ($bbs_idx) {
            $data['r_date'] = date("Y-m-d H:i:s");
            $this->bbsModel->update($bbs_idx, $data);
            $msg = "수정완료";
        } else {
            $data['r_date'] = date("Y-m-d H:i:s");
            $this->bbsModel->insert($data);
            $msg = "등록완료";
        }

        return $this->response->setJSON([
            "message" => $msg
        ]);

    }

    public function view($bbs_idx)
    {

        $info = $this->bbsModel->View($bbs_idx);

        $data = [
            'info' => $info,
        ];
        return view('admin/_board/view', $data);
    }

    public function bbs_del()
    {

    }

    public function goods_find()
    {
        $code_no = $_POST['code_no'];
        $inq_sw = $_POST['inq_sw'];
    }

    public function item_allfind()
    {
        $product_code_1  = $_POST['product_code_1'];
        $product_code_2  = $_POST['product_code_2'];
        $product_code_3  = $_POST['product_code_3'];
        $search_category = $_POST['search_category'];
        $search_txt      = $_POST['search_txt'];


        $prdList = $this->ProductModel->findProductPaging([
            'product_code_1'  => $product_code_1,
            'product_code_2'  => $product_code_2,
            'product_code_3'  => $product_code_3,
            'search_category' => $search_category,
            'search_txt'      => $search_txt
        ], 1000, 1)['items'];

        $html = "";

        foreach ($prdList as $key => $row) {
            $html .= "<tr>
                        <td><input type='checkbox' name='idx[]' class='idx' value='".$row['product_idx']."'></td>
                        <td>".viewSQ(html_entity_decode($row['product_name']))."</td>
                        <td>".$row['product_code']."</td>
                    </tr>
                ";
        }

        return $html;

    }

    public function event_update()
    {
        $isrt_code = $this->request->getPost('isrt_code');
        $idx = $this->request->getPost('idx');

        foreach ($idx as $item) {
            $this->eventDispModel->insert([
                'code_no' => $isrt_code,
                'product_idx' => $item,
                'status' => "Y",
            ]);
        }

        return $this->response->setJSON([
            'message' => '등록완료'
        ]);

    }


    public function event_dis_delete()
    {
        $idx = $this->request->getPost('idx');

        $this->eventDispModel->delete($idx);

        return $this->response->setJSON([
            'message' => '정상적으로 제외되었습니다.'
        ]);

    }

}
