<?php

use CodeIgniter\Model;

class Qna extends Model
{
    protected $table = 'tbl_point';

    protected $primaryKey = 'idx';

    protected $allowedFields = [
        "member_point",
        "review_point",
        "comment_point",
        "regdate"
    ];

    public function getPoint() {
        return $this->where("idx", 1)->first();
    }

    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    public function insertData($data)
    {
        return $this->insert($data);
    }

    public function deleteData($idx)
    {
        return $this->delete($idx);
    }
}