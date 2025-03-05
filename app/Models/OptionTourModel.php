<?php

use CodeIgniter\Model;

class OptionTourModel extends Model
{
    protected $table = 'tbl_tours_option';

    protected $primaryKey = 'idx';

    protected $allowedFields = ['code_idx' , 'product_idx', 'option_name', 'option_name_eng', 'option_price', 'option_cnt', 'use_yn', 'afile', 'bfile', 'option_type', 'onum', 'rdate'];

    public function findOptionIdx($idx)
    {
        return $this->where('idx', $idx)->findAll();
    }

}