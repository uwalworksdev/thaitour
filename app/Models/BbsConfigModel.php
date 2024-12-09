<?php

namespace App\Models;

use CodeIgniter\Model;

class BbsConfigModel extends Model
{
    protected $table = 'tbl_bbs_config';

    protected $primaryKey = 'tbc_idx';

    protected $allowedFields = [
        'board_name',
        'board_code',
        'board_url',
        'is_category',
        'is_secure',
        'is_right',
        'is_reply',
        'is_comment',
        'is_recomm',
        'is_notice',
        'skin'
    ];

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;

    function codeInfo($code)
    {
        $this->db = db_connect();
        $builder = $this->db->table('tbl_bbs_config');
        $builder->select('*');
        $builder->where('board_code', $code);
        $result = $builder->get()->getRowArray();
        if ($result) {
            return [
                'board_name' => $result['board_name'],
                'board_code' => $result['board_code'],
            ];
        } else {
            return false;
        }
    }
}

