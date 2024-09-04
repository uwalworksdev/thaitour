<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ReservationController extends BaseController
{
    public function list()
    {
        return view('admin/_reservation/list');
    }
}
