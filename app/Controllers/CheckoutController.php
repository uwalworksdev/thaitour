<?php

namespace App\Controllers;

class CheckoutController extends BaseController
{
    public function show()
    {
        return view('checkout/show');
    }

    public function confirm()
    {
        return view('checkout/confirm');
    }
}
