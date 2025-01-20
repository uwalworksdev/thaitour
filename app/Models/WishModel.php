<?php

use CodeIgniter\Model;

class WishModel extends Model
{
    protected $table = 'tbl_wish_list';

    protected $primaryKey = 'wish_idx';

    protected $allowedFields = ["m_idx", "product_idx", "bbs_idx", "wish_r_date"];
    public function getWishCnt($m_idx, $product_idx)
    {
        return $this->select("ifnull(count(*),0) as cnt")->where("product_idx", $product_idx)->where("m_idx", $m_idx)->get()->getRow()->cnt;;
    }

    public function getWishCntFromBbs($m_idx, $bbs_idx)
    {
        return $this->select("ifnull(count(*),0) as cnt")->where("bbs_idx", $bbs_idx)->where("m_idx", $m_idx)->get()->getRow()->cnt;;
    }
    public function updateWish($id, $data)
    {
        return $this->update($id, $data);
    }

    public function insertWish($data)
    {
        return $this->insert($data);
    }

    public function deleteWish($data)
    {
        return $this->delete($data);
    }
}