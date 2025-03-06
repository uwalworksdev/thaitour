<?php

use CodeIgniter\Model;

class ProductTourModel extends Model
{
    protected $table = 'tbl_product_tours';

    protected $primaryKey = 'tours_idx';

    protected $allowedFields = ['product_idx', 'tours_subject', 'tours_subject_eng', 'tour_price', 'tour_price_kids', 'tour_price_baby', 'tour_price_ori', 'tour_price_kids_ori', 'tour_price_baby_ori', 'tour_price_max', 'tour_price_kids_max', 'tour_price_baby_max', 'r_date', 'status', 'info_idx'];

    public function getTourById($tours_idx)
    {
        return $this->where('tours_idx', $tours_idx)->findAll();
    }

    public function deleteTour($tours_idx)
    {
        return $this->where('tours_idx', $tours_idx)->delete();
    }
}