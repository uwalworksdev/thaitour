<?php

namespace App\Models;

use CodeIgniter\Model;

class GolfOptionModel extends Model
{
    protected $table = 'tbl_golf_option';
    protected $primaryKey = 'idx';

    protected $allowedFields = [
        'product_idx',
        'hole_cnt',
        'hour',
        'minute',
        'option_price',
        'option_cnt',
        'use_yn',
        'afile',
        'bfile',
        'option_type',
        'onum',
        'rdate'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;

    public function getOptions($product_idx)
    {
        return $this->where("product_idx", $product_idx)->findAll();
    }
    public function checkOptionExist($product_idx, $hole_cnt, $hour, $minute)
    {
        $cnt = $this->where("product_idx", $product_idx)
                    ->where("hole_cnt", $hole_cnt)
                    ->where("hour", $hour)
                    ->where("minute", $minute)
                    ->countAllResults();
        if ($cnt > 0) {
            return true;
        } else {
            return false;
        }
    }
}
