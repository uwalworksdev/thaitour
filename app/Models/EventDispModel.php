<?php

namespace App\Models;

use CodeIgniter\Model;

class EventDispModel extends Model
{
    protected $table = 'tbl_event_disp';

    protected $primaryKey = 'code_idx';

    protected $allowedFields = ["code_no", "product_idx", "status", "onum", "p_idx"];
}