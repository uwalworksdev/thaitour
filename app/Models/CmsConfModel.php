<?php

namespace App\Models;
use CodeIgniter\Model;

class CmsConfModel extends Model
{
    protected $table = 'tbl_cms_conf';
    protected $primaryKey = 'r_code';
    protected $allowedFields = ["r_code", "r_status", "r_reg_date", "r_reg_m_idx", "r_mod_date", "r_mod_m_idx", "r_order", "r_title", "r_desc",
    "r_type_list", "r_flag_list", "r_template_list", "r_img_size", "r_use_type", "r_use_template", "r_use_s_date", "r_use_e_date", "r_use_open",
    "r_use_close", "r_use_order", "r_use_flag", "r_use_name", "r_use_date", "r_use_view_cnt", "r_use_title", "r_use_desc", "r_use_content", 
    "r_use_content_editor", "r_use_content_img", "r_use_product", "r_use_url", "r_use_thumb", "r_use_file", "r_use_file_list"];

}