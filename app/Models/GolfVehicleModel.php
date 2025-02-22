<?php

namespace App\Models;

use CodeIgniter\Model;

class GolfVehicleModel extends Model
{
    protected $table = 'tbl_golf_vehicle';
    protected $primaryKey = 'code_idx';

    protected $allowedFields = [
        'code_gubun',
        'code_no',
        'code_name',
        'code_memo',
        'ufile1',
        'rfile1',
        'code_url',
        'min_cnt',
        'max_cnt',
        'price',
        'parent_code_no',
        'depth',
        'rolling_yn',
        'status',
        'onum',
        'init_oil_price',
        'ref_product_code_idx',
        'is_best',
        'distance',
        'type'
    ];

    protected $useTimestamps = false;
    
    public function getByParentAndDepth($parent_code_no, $depth)
    {
        return $this->select('*')
            ->where('parent_code_no', $parent_code_no)
            ->where('depth', $depth)
            ->orderBy('onum', 'ASC')
            ->get();
    }
    public function getByCodeNo($code_no) {
        return $this->where('code_no', $code_no)->first();
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

        $builder->select('*, (select ifnull(count(*),0) as cnt from tbl_golf_vehicle a where a.parent_code_no=tbl_golf_vehicle.code_no) as cnt');
        
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
        $builder->select('code_name')
                ->where('code_no', $code_no);

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
    public function getCodesByGubunDepthAndStatusExclude($code_gubun, $depth, $exclude)
    {
        return $this->where('code_gubun', $code_gubun)
                    ->where('depth', $depth)
                    ->where('status', 'Y')
                    ->whereNotIn('code_no', $exclude)
                    ->orderBy('onum', 'ASC')
                    ->orderBy('code_idx', 'DESC')
                    ->findAll();
    }
}
