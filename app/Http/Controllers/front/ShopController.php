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
        $sizeIds = $request->input('sizes', []); // Nhận giá trị từ filter size

        $brand = Brand::find($id);
        $categories = $brand->categories;

        // Xây dựng query để lọc theo category
        $shoesQuery = Shoe::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('categories.id', $categories->pluck('id')->toArray());
        });

        // Nếu có chọn filter theo category, thêm điều kiện vào query
        if (!empty($categoryIds)) {
            $shoesQuery->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        // Nếu có chọn filter theo size, thêm điều kiện vào query
        if (!empty($sizeIds)) {
            $shoesQuery->whereHas('sizes', function ($query) use ($sizeIds) {
                $query->whereIn('sizes.id', $sizeIds);
            });
        }

        // Lấy danh sách giày sau khi lọc
        $shoes = $shoesQuery->with('images')->get();

        // Trả về kết quả dưới dạng HTML (dùng để cập nhật lại giày trong view mà không reload trang)
        return view('front.partials.shoe-list', compact('shoes'));
    }
}
