<?php

namespace App\Models;

use CodeIgniter\Model;

class AlarmModel extends Model
{
    protected $table = 'tbl_alarm';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "idx",
        "contents",
        "status",
        "m_idx",
        "r_date",
        "u_date",
    ];
}