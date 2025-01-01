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
        ], [
            'brand_name.required' => 'Vui lòng nhập tên thương hiệu.',
            'brand_name.unique' => 'Tên thương hiệu này đã tồn tại.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ]);

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
        ], [
            'brand_name.required' => 'Vui lòng nhập tên thương hiệu.',
            'brand_name.unique' => 'Tên thương hiệu này đã tồn tại.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ]);

        $brand = Brand::find($id);
        $brand->update($validatedData);
        return redirect()->route('admin.brands.index')->with('success', 'Cập nhật thương hiệu thành công!');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công');
    }
}
