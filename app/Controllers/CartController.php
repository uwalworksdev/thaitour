<?php

namespace App\Controllers;

use App\Libraries\SessionChk;
use Config\View;
use Exception;

class CartController extends BaseController
{
    public function __construct()
    {
    }
    public function itemList($code_no)
    {
        return $this->renderView('cart/item-list');
    }
}