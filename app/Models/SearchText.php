<?php

namespace App\Models;

use CodeIgniter\Model;

class SearchText extends Model
{
    protected $table      = 'tbl_search';
    protected $primaryKey = 'tbc_idx';

    protected $allowedFields = [
        'subject',
        'onum',
        'url' 
    ];

    public function List()
    {
        $builder = $this;
        $builder->select("{$this->table}.*");
        $builder->orderBy("{$this->table}.onum", "desc");

        return $builder;
    }
}


