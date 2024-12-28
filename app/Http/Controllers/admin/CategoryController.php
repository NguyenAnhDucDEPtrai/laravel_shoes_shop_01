<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('brand')->orderBy('id', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('admin.categories.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name',
            'brand_id' => 'required',
            'status' => 'required',
        ], [
            'category_name.required' => 'Vui lòng nhập tên danh mục.',
            'category_name.unique' => 'Danh mục đã tồn tại.',
            'category_name.max' => 'Tên danh mục không được vượt quá :max ký tự.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ]);

        Category::create($validatedData);
        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $brands = Brand::all();
        return view('admin.categories.edit', compact('category', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name, ' .$id,
            'brand_id' => 'required',
            'status' => 'required',
        ], [
            'category_name.required' => 'Vui lòng nhập tên danh mục.',
            'category_name.unique' => 'Danh mục đã tồn tại.',
            'category_name.max' => 'Tên danh mục không được vượt quá :max ký tự.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'status.required' => 'Vui lòng chọn trạng thái.',
        ]);

        $category = Category::find($id);
        $category->update($validatedData);
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy($id)
    {
        $categori = Category::find($id);
        $categori->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công');
    }
}
