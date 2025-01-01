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

class ShoeController extends Controller
{
    public function index(Request $request)
    {
        $query = Shoe::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('shoe_name', 'LIKE', '%' . $request->search . '%');
        }
        $shoes = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.shoes.index', compact('shoes'));
    }

    public function create()
    {
        // Xóa các tập tin trong thư mục uploads_temp
        $tempPath = public_path('uploads_temp');
        if (File::exists($tempPath)) {
            File::cleanDirectory($tempPath);
        }
        session()->forget('temp_files');

        $brands = Brand::all();
        $sizes = Size::all();
        return view('admin.shoes.create', compact('brands', 'sizes'));
    }

    public function getCategoriesByBrand($brandId)
    {
        $categories = Category::where('brand_id', $brandId)->get(['id', 'category_name']);
        return response()->json($categories);
    }

    public function upload_temp(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('uploads_temp'), $filename);

            $tempFiles = session()->get('temp_files', []);
            $tempFiles[] = $filename;
            session()->put('temp_files', $tempFiles);

            return response()->json(['filePath' => asset('uploads_temp/' . $filename)]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    // ShoeController.php
    public function deleteTemp(Request $request)
    {
        $imageUrl = $request->input('image_url');
        $fileName = basename($imageUrl); // Lấy tên file từ URL

        $filePath = public_path('uploads_temp/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath); // Xóa file
            // Xóa file khỏi session (nếu có)
            $tempFiles = session()->get('temp_files', []);
            if (($key = array_search($fileName, $tempFiles)) !== false) {
                unset($tempFiles[$key]);
            }
            session()->put('temp_files', $tempFiles);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'File không tồn tại']);
    }


    public function store(ShoeRequest $request)
    {
        DB::beginTransaction();

        try {
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

            $tempFiles = session()->get('temp_files', []);
            foreach ($tempFiles as $tempFile) {
                $sourcePath = public_path('uploads_temp/' . $tempFile);
                $destinationPath = public_path('uploads_shoes/' . $tempFile);

                if (!file_exists(public_path('uploads_shoes'))) {
                    mkdir(public_path('uploads_shoes'), 0755, true);
                }

                if (file_exists($sourcePath)) {
                    rename($sourcePath, $destinationPath);

                    $shoeImage = new ShoeImage();
                    $shoeImage->shoe_id = $shoe->id;
                    $shoeImage->image_url = 'uploads_shoes/' . $tempFile;
                    $shoeImage->save();
                }
            }

            session()->forget('temp_files');

            // dd($shoeImage);

            DB::commit();
            return redirect()->route('admin.shoes.index')->with('success', 'Thêm giày thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
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
