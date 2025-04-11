<?php

namespace App\Models;

use CodeIgniter\Model;

class BbsCategoryModel extends Model
{
    protected $table = 'tbl_bbs_category';

    protected $primaryKey = 'tbc_idx';

    protected $allowedFields = [
        'subject',
        'onum',
        'code',
        'type',
        'status'
    ];
    protected $useTimestamps = false;
    protected $useSoftDeletes = false;

    public function getCategoriesByCodeAndStatus($code, $type)
    {
        return $this->where('code', $code)
                    ->where('type', $type)
                    ->where('status', 'Y')
                    ->orderBy('onum', 'ASC')
                    ->findAll();
    }
}

