<?php

use CodeIgniter\Model;

class Bbs extends Model
{

    protected $table = 'tbl_bbs_list';

    protected $primaryKey = 'bbs_idx';

    protected $allowedFields = [];

    protected function initialize()
    {

    }

    /**
     * 게시글 출력
     * * Model 로 페이지네이션 사용용도
     */
    public function List($code, $whereArr = [])
    {
        $builder = $this;
        $builder->select("{$this->table}.*, 
        (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as scategory,
        (select count(*) from tbl_bbs_cmt where tbl_bbs_cmt.r_idx=tbl_bbs_list.bbs_idx) as comment_cnt");
        if (!empty($whereArr['search_word'])) {
            if (!empty($whereArr['search_mode'])) {
                $builder->like($whereArr['search_mode'], $whereArr['search_word']);
            } else {
                $builder->orLike('subject', $whereArr['search_word']);
                $builder->orLike('contents', $whereArr['search_word']);
                $builder->orLike('writer', $whereArr['search_word']);
            }
        }
        if (!empty($whereArr['category'])) {
            $builder->where('category', $whereArr['category']);
        }
        $builder->where('code', $code);
        $builder->groupBy("{$this->table}.bbs_idx");
        $onumCodeArray = ['banner'];
        if (in_array($code, $onumCodeArray)) {
            $builder->orderBy("{$this->table}.onum", "DESC");
        }
        $builder->orderBy("{$this->table}.bbs_idx", "desc");

        return $builder;
    }

    public function View($bbs_idx = null)
    {
        $builder = $this;
        $builder->select("{$this->table}.*");

        return $builder->find($bbs_idx);
    }

    public function Preidx($code, $bbs_idx = null)
    {
        $array = ['code =' => $code, 'bbs_idx <' => $bbs_idx];

        $builder = $this->db->table('tbl_bbs_list');
        $builder->selectMax('bbs_idx');
        $builder->where($array);
        $query = $builder->get();
        $result = $query->getRow();

        return $result->bbs_idx;
    }

    public function Next_idx($code, $bbs_idx = null)
    {
        $array = ['code =' => $code, 'bbs_idx >' => $bbs_idx];

        $builder = $this->db->table('tbl_bbs_list');
        $builder->selectMin('bbs_idx');
        $builder->where($array);
        $query = $builder->get();
        $result = $query->getRow();

        return $result->bbs_idx;
    }

    /**
     * 게시글 등록
     */
    public function InfoInsert($code, $data)
    {
        try {
            switch ($code) {
                case in_array($code, ['license', 'certified', 'brochure']):
                    $this->allowedFields = ['title', 'code', 'category', 'lan'];
                    break;
                case in_array($code, ['ultrapure', 'waterTreatment', 'wasteWater', 'seaWater', 'report', 'notice']):
                    $this->allowedFields = ['code', 'topic1', 'topic2', 'topic3', 'content', 'title', 'writer', 'url', 'lan'];
                    if ($code == 'report') {
                        $this->allowedFields[] = 'reg_date';
                    }
                    break;
                case in_array($code, ['notice', 'publicNotice']):
                    $this->allowedFields = ['code', 'content', 'title', 'writer', 'lan'];
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
    public function InfoUpdate($idx, $code, $data)
    {
        try {
            switch ($code) {
                case in_array($code, ['license', 'certified', 'brochure']):
                    $this->allowedFields = ['title', 'category', 'lan'];
                    $updateResult = $this->update($idx, $data);
                    if (!$updateResult) {
                        throw new Exception("수정 과정 중 오류가 발생했습니다.");
                    }
                    break;
                case in_array($code, ['ultrapure', 'waterTreatment', 'wasteWater', 'seaWater', 'report', 'notice']):
                    $this->allowedFields = ['code', 'topic1', 'topic2', 'topic3', 'content', 'title', 'url', 'lan'];
                    if ($code == 'report') {
                        $this->allowedFields[] = 'reg_date';
                    }
                    $updateResult = $this->update($idx, $data);
                    if (!$updateResult) {
                        throw new Exception("수정 과정 중 오류가 발생했습니다.");
                    }
                    break;
                case in_array($code, ['notice', 'publicNotice']):
                    $this->allowedFields = ['content', 'title'];
                    $updateResult = $this->update($idx, $data);
                    if (!$updateResult) {
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
    public function InfoContentUpdate($idx, $code, $data)
    {
        $this->allowedFields = ['content'];
        return $this->update($idx, $data);
    }
    /**
     * 우선순위 변경
     */
    public function OnumUpdate($idx, $code, $data)
    {
        $this->allowedFields = ['onum'];
        return $this->where('code', $code)
            ->update($idx, $data);
    }
    public function Hit($code, $idx)
    {
        $this->allowedFields = ['hit'];
        $hit = $this->where('code', $code)->where('bbs_idx', $idx)->get()->getRow()->hit;
        return $this->where('code', $code)->where('bbs_idx', $idx)
            ->update($idx, ['hit' => $hit + 1]);
    }
}