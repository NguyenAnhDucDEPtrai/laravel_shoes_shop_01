<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Shoe;
use App\Models\ShoeImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ShoeRequest;
use Illuminate\Support\Facades\Validator;

class ShoeController extends Controller
{
    public function index(Request $request)
    {
        $query = Shoe::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('shoe_name', 'LIKE', '%' . $request->search . '%');
        }
        $shoes = $query->with('images')->orderBy('id', 'desc')->paginate(10);
        return view('admin.shoes.index', compact('shoes'));
    }

    public function create()
    {
        $brands = Brand::all();
        $sizes = Size::all();
        return view('admin.shoes.create', compact('brands', 'sizes'));
    }

    public function getCategoriesByBrand($brandId)
    {
        $categories = Category::where('brand_id', $brandId)->get(['id', 'category_name']);
        return response()->json($categories);
    }

    public function getImagesByShoe($shoeId)
    {
        $updatedImages = ShoeImage::where('shoe_id', $shoeId)->get();
        return response()->json([
            'success' => 'Images uploaded successfully',
            'updatedImages' => $updatedImages
        ]);
    }

    public function upload_shoe(Request $request)
    {
        $shoeId = $request->input('shoe_id');
        if (!$shoeId) {
            return response()->json(['success' => false, 'message' => 'Giày không hợp lệ']);
        }

        $images = [];
        foreach ($request->file('inputFiles') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_shoes'), $imageName);
            $images[] = 'images_shoes/' . $imageName;
        }

        foreach ($images as $image) {
            ShoeImage::create([
                'shoe_id' => $shoeId,
                'image_url' => $image,
            ]);
        }

        session()->flash('success', 'Thêm giày thành công!');
        return response()->json([
            'success' => true,
            'redirect_url' => route('admin.shoes.index')
        ]);
    }

    public function update_img_shoes(Request $request)
    {
        $shoeId = $request->input('shoe_id');

        $images = [];
        foreach ($request->file('inputFiles') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_shoes'), $imageName);
            $images[] = 'images_shoes/' . $imageName;
        }

        foreach ($images as $image) {
            ShoeImage::create([
                'shoe_id' => $shoeId,
                'image_url' => $image,
            ]);
        }

        return response()->json([
            'success' => 'Images uploaded successfully',
        ]);
    }

    public function deleteImage($imageId)
    {
        $image = ShoeImage::find($imageId);
        dump($image);
        $imagePath = public_path($image->image_url);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $image->delete();

        return response()->json(['success' => 'Image deleted successfully']);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shoe_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Block',
            'brand_id' => 'required|exists:brands,id',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'size_id' => 'required|array|min:1',
            'size_id.*' => 'exists:sizes,id',
        ]);

        if ($validator->passes()) {

            $shoe = new Shoe();
            $shoe->shoe_name = $request->shoe_name;
            $shoe->price = $request->price;
            $shoe->description = $request->description;
            $shoe->quantity = $request->quantity;
            $shoe->status = $request->status;
            $shoe->save();

            $categoryIds = $request->input('categories', []);
            foreach ($categoryIds as $categoryId) {
                DB::table('shoe_categories')->insert([
                    'shoe_id' => $shoe->id,
                    'category_id' => $categoryId,
                ]);
            }

            $sizeIds = $request->input('size_id', []);
            foreach ($sizeIds as $sizeId) {
                DB::table('shoe_sizes')->insert([
                    'shoe_id' => $shoe->id,
                    'size_id' => $sizeId,
                ]);
            }

            session()->flash('success', 'Thêm giày thành công!');
            return response()->json([
                'success' => true,
                'shoe_id' => $shoe->id,
                'redirect_url' => route('admin.shoes.index')
            ]);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function edit($id)
    {
        $shoe = Shoe::with(['categories', 'images', 'sizes'])->findOrFail($id);
        $brands = Brand::all();
        $sizes = Size::all();

        $firstCategory_current = $shoe->categories->first();
        $brand_current = null;
        if ($firstCategory_current) {
            $brand_current = $firstCategory_current->brand;
        }

        $categories = Category::where('brand_id', $brand_current->id)->get(['id', 'category_name']);

        return view('admin.shoes.edit', compact('shoe', 'brands', 'categories', 'sizes', 'brand_current'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'shoe_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Block',
            'brand_id' => 'required|exists:brands,id',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'size_id' => 'required|array|min:1',
            'size_id.*' => 'exists:sizes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            $shoe = Shoe::find($id);
            $shoe->shoe_name = $request->shoe_name;
            $shoe->price = $request->price;
            $shoe->description = $request->description;
            $shoe->quantity = $request->quantity;
            $shoe->status = $request->status;
            $shoe->save();

            DB::table('shoe_categories')->where('shoe_id', $shoe->id)->delete();
            $categoryIds = $request->input('categories', []);
            foreach ($categoryIds as $categoryId) {
                DB::table('shoe_categories')->insert([
                    'shoe_id' => $shoe->id,
                    'category_id' => $categoryId,
                ]);
            }

            DB::table('shoe_sizes')->where('shoe_id', $shoe->id)->delete();
            $sizeIds = $request->input('size_id', []);
            foreach ($sizeIds as $sizeId) {
                DB::table('shoe_sizes')->insert([
                    'shoe_id' => $shoe->id,
                    'size_id' => $sizeId,
                ]);
            }

            session()->flash('success', 'Thêm giày thành công!');
            return response()->json([
                'success' => true,
                'redirect_url' => route('admin.shoes.index')
            ]);
        }
    }


    public function destroy($id)
    {
        $shoe = Shoe::find($id);
        if (!$shoe) {
            return redirect()->route('admin.shoes.index')->with('error', 'Giày không tồn tại');
        }

        $shoeImages = ShoeImage::where('shoe_id', $shoe->id)->get();

        foreach ($shoeImages as $image) {
            $imagePath = public_path($image->image_url);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $image->delete();
        }

        $shoe->delete();

        return redirect()->route('admin.shoes.index')->with('success', 'Xóa Giày và Hình ảnh thành công');
    }
}
