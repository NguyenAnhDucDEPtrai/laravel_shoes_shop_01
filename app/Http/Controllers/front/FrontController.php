<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class FrontController extends Controller
{
    public function home()
    {
        $brands = Brand::with('categories')->get();

        return view('front.home', compact('brands'));
    }
}
