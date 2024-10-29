<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class ProductBooking extends Controller
{
    public function index()
    {
        // Tải view 'home' từ thư mục app/Views
        return view('product-booking');
    }
}
?>