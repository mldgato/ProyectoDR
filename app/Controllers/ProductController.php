<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('products/index');
    }
}
