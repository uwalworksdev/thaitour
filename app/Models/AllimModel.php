<?php

namespace App\Models;

use CodeIgniter\Model;

class AllimModel extends Model
{
    protected $table      = 'tbl_homeset'; // DB 테이블명
    protected $primaryKey = 'idx';

    public function getAllimSettings()
    {
        return $this->select('allim_apikey, allim_userid, allim_senderkey')->first();
    }
}

?>
