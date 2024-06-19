<?php

namespace App\Models;

use CodeIgniter\Model;

class Bbs_list_model extends Model
{
    protected $table = 'tbl_bbs_list';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category', 'url', 'ufile5', 'ufile6'];

    public function getLineBanners($category = '123')
    {
        return $this->where('category', $category)->first();
    }
}
