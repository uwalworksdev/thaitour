<?php

use CodeIgniter\Model;

class ProductSpasModel extends Model
{
    protected $table = 'tbl_product_spas';

    protected $primaryKey = 'spas_idx';

    protected $allowedFields = ['product_idx', 'spas_subject', 'spas_subject_eng', 'spas_price', 'spas_price_kids', 'spas_price_baby', 'spas_price_ori', 'spas_price_kids_ori', 'spas_price_baby_ori', 'spas_price_max', 'spas_price_kids_max', 'spas_price_baby_max', 'spa_onum', 'r_date', 'status', 'info_idx'];

    public function getSpaById($spas_idx)
    {
        return $this->where('spas_idx', $spas_idx)->findAll();
    }

    public function deleteSpa($spas_idx)
    {
        return $this->where('spas_idx', $spas_idx)->delete();
    }
}