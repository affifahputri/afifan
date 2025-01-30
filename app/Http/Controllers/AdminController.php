<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function admin()
    {
        // Mengambil daftar produk dengan paginasi (misalnya 10 per halaman)
        $products = Product::paginate(1);

        // Mengembalikan view 'admin' dengan data produk
        return view('admin', compact('products'));
    }
}