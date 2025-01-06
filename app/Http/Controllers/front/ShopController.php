<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Shoe;
use App\Models\Size;

class ShopController extends Controller
{
    public function shopByBrand($id)
    {
        //header
        $brands = Brand::with('categories')->get();

        //shop
        $sizes = Size::all();
        $brand = Brand::find($id);
        $categories = $brand->categories;
        $shoes = Shoe::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories->pluck('id')->toArray());
        })->with('images')->get();

        return view('front.shop', compact('brands', 'brand', 'categories', 'shoes', 'sizes'));
    }

    public function filterShoes(Request $request, $id)
    {
        $categoryIds = $request->input('categories', []);
        $sizeIds = $request->input('sizes', []);

        $brand = Brand::find($id);
        $categories = $brand->categories;

        $shoesQuery = Shoe::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories->pluck('id')->toArray());
        });

        if (!empty($categoryIds)) {
            $shoesQuery->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        if (!empty($sizeIds)) {
            $shoesQuery->whereHas('sizes', function ($query) use ($sizeIds) {
                $query->whereIn('sizes.id', $sizeIds);
            });
        }

        $shoes = $shoesQuery->with('images')->get();

        return view('front.partials.shoe-list', compact('shoes'));
    }

    public function shoeDetail($id)
    {
        //header
        $brands = Brand::with('categories')->get();
        
        //shop
        $shoe = Shoe::with('images', 'sizes')->find($id);
        return view('front.shoeDetail', compact('brands', 'shoe'));
    }
}
