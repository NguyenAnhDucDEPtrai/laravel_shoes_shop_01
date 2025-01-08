<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Shoe;

class FrontController extends Controller
{
    public function home()
    {
        $brands = Brand::with('categories')->get();
        $shoes_random = Shoe::inRandomOrder()->limit(8)->get();
        $shoes_last = Shoe::orderBy('id', 'desc')->limit(8)->get();
        return view('front.home', compact('brands', 'shoes_last','shoes_random'));
    }
}
