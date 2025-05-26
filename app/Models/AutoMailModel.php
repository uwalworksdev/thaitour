<?php

namespace App\Models;

use CodeIgniter\Model;

class AutoMailModel extends Model
{
    protected $table = 'tbl_auto_mail_skin';
    protected $primaryKey = 'idx';
    protected $allowedFields = ['code', 'title', 'autosend', 'content', 'send_name', 'send_email', 'mail_title', 'onum']; 

    public function getTotalCount()
    {
        return $this->countAllResults();
    }

    public function getEmails($nFrom, $g_list_rows)
    {
        return $this->orderBy('onum', 'DESC')
                    ->orderBy('code', 'ASC')
                    ->findAll($g_list_rows, $nFrom);
    }
}
