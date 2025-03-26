<?php

use CodeIgniter\Model;

class MoptionModel extends Model
{
    protected $table = 'tbl_tours_moption';

    protected $primaryKey = 'code_idx';

    protected $allowedFields = ['info_idx', 'product_idx', 'moption_name', 'use_yn', 'rdate'];


}