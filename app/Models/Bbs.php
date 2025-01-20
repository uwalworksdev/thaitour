<?php

namespace App\Models;

use CodeIgniter\Model;

class Bbs extends Model
{

    protected $table = 'tbl_bbs_list';

    protected $primaryKey = 'bbs_idx';

    protected $allowedFields = [
        "code", "category", "category1", "subject", "subject_e", "writer", "email", "user_id", "m_idx", "passwd", "notice_yn", "secure_yn",
        "recomm_yn", "contents", "simple", "displays", "hit", "cmt_cnt", "country_code", "url", "s_date", "e_date", "s_time", "e_time", "reply", "ufile1", "rfile1",
        "ufile2", "rfile2", "ufile3", "rfile3", "ufile4", "rfile4", "ufile5", "rfile5", "ufile6", "rfile6", "b_ref", "b_step", "b_level",
        "ip_address", "r_date", "status", "onum", "seq", "encode", "describe"
    ];

    /**
     * 게시글 출력
     * * Model 로 페이지네이션 사용용도
     */

    public function list_time_sale() {
        $currentDateTime = date('Y-m-d H:i:s');

        $builder = $this;
        $builder->select("{$this->table}.*");

        $builder->where('code', "time_sale");
        $builder->where("CONCAT(s_date, ' ', s_time) <=", $currentDateTime);
        $builder->where("CONCAT(e_date, ' ', e_time) >=", $currentDateTime);
        
        $builder->orderBy("{$this->table}.r_date", "desc");
        $builder->orderBy("{$this->table}.bbs_idx", "desc");

        return $builder;
    } 

    public function List($code, $whereArr = [])
    {
        $builder = $this;
        $builder->select("{$this->table}.*, 
        (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as scategory,
        (select count(*) from tbl_bbs_cmt inner join tbl_member on tbl_member.m_idx = tbl_bbs_cmt.r_m_idx where tbl_bbs_cmt.r_idx = tbl_bbs_list.bbs_idx and tbl_bbs_cmt.r_code = '$code' and tbl_bbs_cmt.r_delYN = 'N') as comment_cnt,
        (select count(*) from tbl_wish_list where tbl_wish_list.bbs_idx=tbl_bbs_list.bbs_idx) as cnt_like");
        if (!empty($whereArr['search_word'])) {
            if (!empty($whereArr['search_mode'])) {
                $builder->like($whereArr['search_mode'], $whereArr['search_word']);
            } else {
                $builder->groupStart();
                $builder->orLike('subject', $whereArr['search_word']);
                if($code != "time_sale"){
                    $builder->orLike('contents', $whereArr['search_word']);
                    $builder->orLike('writer', $whereArr['search_word']);
                }
                $builder->groupEnd();
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

    public function ListHome($code, $whereArr = [])
    {
        $builder = $this;
        $builder->select("{$this->table}.*, 
        (select subject from tbl_bbs_category where tbl_bbs_category.tbc_idx=tbl_bbs_list.category) as scategory,
        (select count(*) from tbl_bbs_cmt where tbl_bbs_cmt.r_idx=tbl_bbs_list.bbs_idx) as comment_cnt");
        if (!empty($whereArr['search_word'])) {
            if (!empty($whereArr['search_mode'])) {
                $builder->like($whereArr['search_mode'], $whereArr['search_word']);
            } else {
                $builder->groupStart();
                $builder->orLike('subject', $whereArr['search_word']);
                $builder->orLike('contents', $whereArr['search_word']);
                $builder->orLike('writer', $whereArr['search_word']);
                $builder->groupEnd();
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
    public function InfoInsert($data)
    {
        $insertId = $this->insert($data);
        $resultArr['result'] = true;
        $resultArr['insertId'] = $insertId;
    }

    /**
     * 게시글 업데이트
     * @param int $idx 게시글 식별번호
     * @param string $code 게시글 코드
     * @param array $data 업데이트할 정보
     * @return boolean
     */
    public function InfoUpdate($idx, $data)
    {
        return $this->update($idx, $data);
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

    public function getLineBanners($category = '123')
    {
        return $this->where('category', $category)->first();
    }
}