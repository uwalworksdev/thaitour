<?php

use CodeIgniter\Model;

class Board extends Model{

    protected $table = 'tbl_board';

    protected $primaryKey = 'idx';

    protected $allowedFields = [];

    protected function initialize()
    {
        
    }

    /**
     * 게시글 출력
     * * Model 로 페이지네이션 사용용도
     */
    public function List($code, $whereArr = []){
        $builder = $this;
        $fileTable = "tbl_file";
        $builder->select("{$this->table}.*, {$fileTable}.b_idx, {$fileTable}.ufile, {$fileTable}.rfile");
        $builder->join($fileTable, "{$fileTable}.b_idx = {$this->table}.idx", "left outer");
        if(!empty($whereArr['search_word'])){
            if(!empty($whereArr['search_mode'])){
                $builder->like($whereArr['search_mode'], $whereArr['search_word']);
            }else{
                $builder->orLike('title', $whereArr['search_word']);
                $builder->orLike('content', $whereArr['search_word']);
                $builder->orLike('writer', $whereArr['search_word']);
            }
        }
        if(!empty($whereArr['category'])){
            $builder->where('category', $whereArr['category']);
        }
        $whereArr['lang'] = !empty($whereArr['lang']) ? $whereArr['lang'] : "kr";
        $builder->where('lan', $whereArr['lang']);
        
        $builder->where('board_code', $code);
        $builder->groupBy("{$this->table}.idx");
        $onumCodeArray = ['ultrapure', 'waterTreatment', 'wasteWater', 'seaWater', 'report'];
        if(in_array($code, $onumCodeArray)){
            $builder->orderBy("{$this->table}.onum", "DESC");
        }
        $builder->orderBy("{$this->table}.idx", "desc");

        return $builder;
    }
    
    public function View($idx = null){
        $builder = $this;
        $fileTable = "tbl_file";
        $builder->select("{$this->table}.*, {$fileTable}.b_idx, {$fileTable}.ufile, {$fileTable}.rfile");
        $builder->join($fileTable, "{$fileTable}.b_idx = {$this->table}.idx", "left outer");
        // $builder->where("{$this->table}.idx", $idx);

        return $builder->find($idx);
    }

    public function Preidx($code, $idx = null)
    {
        $array = ['board_code =' => $code, 'idx <' => $idx];

        $builder = $this->db->table('tbl_board');
        $builder->selectMax('idx');
        $builder->where($array);
        $query = $builder->get();
        $result = $query->getRow();

        return $result->idx;
    }

    public function Nextidx($code, $idx = null)
    {
        $array = ['board_code =' => $code, 'idx >' => $idx];

        $builder = $this->db->table('tbl_board');
        $builder->selectMin('idx');
        $builder->where($array);
        $query = $builder->get();
        $result = $query->getRow();

        return $result->idx;
    }

    // public function broIdx($idx = null)
    // {
    //     $builder = $this->db->table('tbl_file');
    //     $builder->selectMin('idx');
    //     $builder->where('b_idx', $idx);
    //     $query = $builder->get();
    //     $result = $query->getRow();

    //     return $result->idx;
    // }

    // public function VisitUpdate($idx = null)
    // {
    //     $builder = $this->db->table('tbl_board');
    //     $builder->set('visit', 'visit+1', FALSE);
    //     $builder->where('idx',  $idx);
    //     $builder->update();
    // }

    // public function fileInfo($idx = null)
    // {
    //     $builder = $this->db->table('tbl_file');
    //     $builder->where('b_idx', $idx);
    //     $query = $builder->get();
    //     $result = $query->getResultArray();

    //     return $result;

    // }

    /**
     * 게시글 등록
     */
    public function InfoInsert($code, $data){
        try {
            switch($code) {
                case in_array($code, ['license', 'certified', 'brochure']):
                    $this->allowedFields = ['title', 'board_code', 'category', 'lan'];
                    break;
                case in_array($code, ['ultrapure','waterTreatment','wasteWater', 'seaWater', 'report', 'notice']):
                    $this->allowedFields = ['board_code','topic1','topic2','topic3','content','title','writer','url', 'lan'];
                    if($code == 'report'){
                        $this->allowedFields[] = 'reg_date';
                    }
                    break;
                case in_array($code, ['notice', 'publicNotice']):
                    $this->allowedFields = ['board_code','content','title','writer', 'lan'];
                    break;
                default:
                   throw new Exception("게시글 코드가 없습니다.");
                break;
            }
            $insertId = $this->insert($data);
            $resultArr['result'] = true;
            $resultArr['insertId'] = $insertId;
        } catch (Exception $err) {
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $resultArr;
        }
    }
    /**
     * 게시글 업데이트
     * @param int $idx 게시글 식별번호
     * @param string $code 게시글 코드
     * @param array $data 업데이트할 정보
     * @return array 
     */
    public function InfoUpdate($idx, $code, $data){
        try {
            switch($code){
                case in_array($code, ['license', 'certified', 'brochure']):
                    $this->allowedFields = ['title', 'category','lan'];
                    $updateResult = $this->update($idx, $data);
                    if(!$updateResult){
                        throw new Exception("수정 과정 중 오류가 발생했습니다.");
                    }
                    break;
                case in_array($code, ['ultrapure','waterTreatment','wasteWater', 'seaWater', 'report', 'notice']):
                    $this->allowedFields = ['board_code','topic1','topic2','topic3','content','title','url','lan'];
                    if($code == 'report'){
                        $this->allowedFields[] = 'reg_date';
                    }
                    $updateResult = $this->update($idx, $data);
                    if(!$updateResult){
                        throw new Exception("수정 과정 중 오류가 발생했습니다.");
                    }
                    break;
                case in_array($code, ['notice', 'publicNotice']):
                    $this->allowedFields = ['content','title'];
                    $updateResult = $this->update($idx, $data);
                    if(!$updateResult){
                        throw new Exception("수정 과정 중 오류가 발생했습니다.");
                    }
                    break;
                default:
                    throw new Exception("게시글 코드가 없습니다.");
                    break;
            }
            $resultArr['result'] = true;
        } catch (Exception $err) {
            $resultArr['result'] = false;
            $resultArr['message'] = $err->getMessage();
        } finally {
            return $resultArr;
        }
    }
    /**
     * 이미지 경로 치환된 내용 재 업데이트
     * @param int $idx 게시판 식별번호
     * @param array $data 업데이트 할 정보
     * @return bool
     */
    public function InfoContentUpdate($idx, $code, $data){
        $this->allowedFields = ['content'];
        return $this->update($idx, $data);
    }
    /**
     * 우선순위 변경
     */
    public function OnumUpdate($idx, $code, $data){
        $this->allowedFields = ['onum'];
        return $this->where('board_code', $code)
                    ->update($idx, $data);
    }
}