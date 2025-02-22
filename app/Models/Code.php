<?php

namespace App\Models;

use CodeIgniter\Model;

class Code extends Model
{
    protected $table = 'tbl_code';

    protected $primaryKey = 'code_idx';

    protected $allowedFields = [
        "code_gubun",
        "code_no",
        "code_name",
        "code_memo",
        "ufile1",
        "rfile1",
        "code_url",
        "parent_code_no",
        "depth",
        "rolling_yn",
        "status",
        "onum",
        "init_oil_price",
        "is_best",
        "distance",
        "type",
        "ref_product_code_idx"
    ];

    public function getByParentAndDepth($parent_code_no, $depth)
    {
        return $this->select('*')
            ->where('parent_code_no', $parent_code_no)
            ->where('depth', $depth)
            ->where('status', 'Y')
            ->orderBy('onum', 'ASC')
            ->get();
    }

    public function getByParentCode($parent_code_no)
    {
        return $this->select('*')
            ->where('parent_code_no', $parent_code_no)
            ->where('status', 'Y')
            ->orderBy('onum', 'ASC')
            // ->orderBy('code_idx', 'ASC')
            ->get();
    }

    public function getListByParentCode($parent_code_no)
    {
        return $this->select('*')
            ->where('parent_code_no', $parent_code_no)
            ->where('status', 'Y')
            ->orderBy('onum', 'ASC')
            ->findAll();
    }

    public function getByCodeNo($code_no)
    {
        return $this->where('code_no', $code_no)->first();
    }

    public function getByCodeNos($code_nos)
    {
        if (empty($code_nos)) return [];
        return $this->whereIn('code_no', $code_nos)->findAll();
    }

    public function getTotalCount($parentCodeNo = '')
    {
        $builder = $this->builder();

        if ($parentCodeNo != "") {
            $builder->where('parent_code_no', $parentCodeNo);
        } else {
            $builder->where('parent_code_no', '0');
        }

        $builder->where('code_gubun !=', 'bank');
        return $builder->countAllResults();
    }

    public function getPagedData($parentCodeNo = '', $nFrom, $g_list_rows)
    {
        $builder = $this->builder();

        $builder->select('*, (select ifnull(count(*),0) as cnt from tbl_code a where a.parent_code_no=tbl_code.code_no) as cnt');

        if ($parentCodeNo != "") {
            $builder->where('parent_code_no', $parentCodeNo);
        } else {
            $builder->where('parent_code_no', '0');
        }

        $builder->where('code_gubun !=', 'bank');
        $builder->orderBy('onum', 'ASC')
            ->orderBy('code_idx', 'DESC')
            ->limit($g_list_rows, $nFrom);

        return $builder->get()->getResultArray();
    }

    public function getCodeName($code_no)
    {
        if (empty($code_no)) {
            return "전체";
        }

        $builder = $this->builder();
        $builder->select('code_name')->where('code_no', $code_no);

        $result = $builder->get()->getRow();

        if ($result) {
            return $result->code_name;
        } else {
            return "전체";
        }
    }

    public function getCodeByIdx($code_idx)
    {
        return $this->where('code_idx', $code_idx)->first();
    }

    public function countByParentCodeNo($parent_code_no)
    {
        return $this->where('parent_code_no', $parent_code_no)->countAllResults();
    }

    public function getDepthAndCodeGubunByNo($code_no)
    {
        return $this->select('depth, code_gubun')->where('code_no', $code_no)->first();
    }

    public function getMaxCodeNo($parent_code_no, $s_parent_code_no)
    {
        return $this->select("IFNULL(MAX(code_no),'{$s_parent_code_no}00')+1 as code_no")
            ->where('parent_code_no', $parent_code_no)
            ->first();
    }

    public function getMaxCodeNoWithReserved($parent_code_no, $s_parent_code_no)
    {
        return $this->select("IFNULL(MAX(code_no),'{$s_parent_code_no}00')+2 as code_no")
            ->where('parent_code_no', $parent_code_no)
            ->first();
    }

    public function getCodesByGubunDepthAndStatus($code_gubun, $depth)
    {
        return $this->where('code_gubun', $code_gubun)
            ->where('depth', $depth)
            ->where('status', 'Y')
            ->orderBy('onum', 'ASC')
            ->findAll();
    }

    public function getCodesByParentCodeAndStatus($parent_code_no, $depth)
    {
        return $this->where('parent_code_no', $parent_code_no)
            ->where('depth', $depth)
            ->where('status', 'Y')
            ->orderBy('onum', 'ASC')
            ->findAll();
    }

    public function getCodesByGubunDepthAndStatusExclude($code_gubun, $depth, $exclude)
    {
        return $this->where('code_gubun', $code_gubun)
            ->where('depth', $depth)
            ->where('status', 'Y')
            ->whereNotIn('code_no', $exclude)
            ->orderBy('onum', 'ASC')
            ->orderBy('code_idx', 'ASC')
            ->findAll();
    }

    public function getCodesByConditions(array $conditions)
    {
        $builder = $this;

        foreach ($conditions as $field => $value) {
            $builder = $builder->where($field, $value);
        }

        $builder = $builder->where('status', 'Y')
            ->orderBy('onum', 'ASC')
            ->orderBy('code_idx', 'DESC');

        return $builder->findAll();
    }

    public function getParentCodeNoByCodeNo($code_no)
    {
        $parent_code_no = $this->select('parent_code_no')->where('code_no', $code_no)->first()['parent_code_no'] ?? 0;
        return $this->where('code_no', $parent_code_no)->first();
    }

    public function getCodeTree($code_no)
    {
        $code_arr = [];
        $code_info = $this->where('code_no', $code_no)->first();
        while ($code_info) {
            $code_arr[] = $code_info;
            $code_info = $this->where('code_no', $code_info['parent_code_no'])->first();
        }
        array_pop($code_arr);
        return array_reverse($code_arr);
    }

    public function getCodeSpa($depth, $parent_code_no)
    {
        $sql = "SELECT * FROM tbl_code WHERE depth = ? AND parent_code_no = ? AND status = 'Y'";
        return $this->db->query($sql, [$depth, $parent_code_no])->getResultArray();
    }

    public function getAllDescendants(string $parentCodeNo): array
    {
        $descendants = [];

        $children = $this->where('parent_code_no', $parentCodeNo)->findAll();

        foreach ($children as $child) {
            $descendants[] = $child;

            $childDescendants = $this->getAllDescendants($child['code_no']);
            $descendants = array_merge($descendants, $childDescendants);
        }

        return $descendants;
    }
}