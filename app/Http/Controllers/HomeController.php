<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $popularProducts = Product::where('is_popular', true)->take(4)->get();
        $latestProducts = Product::latest()->take(4)->get();

        // High-end furniture banner content
        $banner = [
            'title' => 'Seni Ruang Minimalis Modern',
            'subtitle' => 'Koleksi Eklusif Furnishare',
            'description' => 'Hadirkan kehangatan, estetika arsitektural, dan kenyamanan fungsional di setiap sudut hunian Anda dengan produk furniture premium pilihan.',
            'image' => 'banner_main.jpg'
        ];

        return view('home', compact('categories', 'popularProducts', 'latestProducts', 'banner'));
    }
}
