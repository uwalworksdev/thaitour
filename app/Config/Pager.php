<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    /*
     |--------------------------------------------------------------------------
     | Template
     |--------------------------------------------------------------------------
     |
     | You can define your own template for the pagination links using the
     | "templates" array. Just pass the name as the third parameter in the
     | pagination methods and specify the file you created here.
     |
     */
    public $templates = [
        'default_full'   => 'App\Views\Pagers\default_full',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',
    ];

    /*
     |--------------------------------------------------------------------------
     | Default Number of Links
     |--------------------------------------------------------------------------
     |
     | The number of links you would like shown by default.
     |
     */
    public $perPage = 20;
}
?>
