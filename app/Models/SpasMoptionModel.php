<?php

use CodeIgniter\Model;

class SpasMoptionModel extends Model
{
    protected $table = 'tbl_spas_moption';

    protected $primaryKey = 'code_idx';

    protected $allowedFields = ['info_idx', 'product_idx', 'moption_name', 'use_yn', 'onum', 'rdate'];


}