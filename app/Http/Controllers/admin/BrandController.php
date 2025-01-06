<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('brand_name', 'LIKE', '%' . $request->search . '%');
        }
        $brands = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'brand_name.required' => 'Vui lòng nhập tên thương hiệu.',
            'brand_name.unique' => 'Tên thương hiệu này đã tồn tại.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images_brands'), $imageName);
            $validatedData['image'] = 'images_brands/' . $imageName;
        }

        Brand::create($validatedData);
        return redirect()->route('admin.brands.index')->with('success', 'Thêm thương hiệu thành công!');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name,' . $id,
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'brand_name.required' => 'Vui lòng nhập tên thương hiệu.',
            'brand_name.unique' => 'Tên thương hiệu này đã tồn tại.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'image.image' => 'File phải là hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        $brand = Brand::find($id);
        $validatedData['image'] = $brand->image;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($brand->image && file_exists(public_path($brand->image))) {
                unlink(public_path($brand->image));
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images_brands'), $imageName);
            $validatedData['image'] = 'images_brands/' . $imageName;
        }

        // Cập nhật thông tin thương hiệu
        $brand->update($validatedData);

        // Trả về thông báo thành công
        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thương hiệu thành công!');
    }



    public function destroy($id)
    {
        $brand = Brand::find($id);

        if ($brand && $brand->image && file_exists(public_path($brand->image))) {
            unlink(public_path($brand->image));
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công');
    }
}
