<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('id', 'desc')->paginate(10);
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'size' => 'required|numeric||unique:sizes,size',
            'status' => 'required|in:Active,Block',
        ], [
            'size.required' => 'Kích thước không đc để trống.',
            'size.numeric' => 'Kích thước phải là một số.',
            'size.unique' => 'Kích thước đã tồn tại.',
            'status.required' => 'Trạng thái không đc để trống.',
        ]);


        Size::create($validatedData);
        return redirect()->route('admin.sizes.index')->with('success', 'Thêm cỡ giày thành công!');
    }

    public function edit($id)
    {
        $size = Size::find($id);
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $validatedData =  $request->validate([
            'size' => 'required|numeric||unique:sizes,size,' .$id,
            'status' => 'required|in:Active,Block',
        ], [
            'size.required' => 'Kích thước không đc để trống.',
            'size.numeric' => 'Kích thước phải là một số.',
            'size.unique' => 'Kích thước đã tồn tại.',
            'status.required' => 'Trạng thái không đc để trống.',
        ]);

        $size = Size::find($id);
        $size->update($validatedData);
        return redirect()->route('admin.sizes.index')->with('success', 'Cập nhật cỡ giày thành công!');
    }

    public function destroy($id)
    {
        $size = Size::find($id);
        $size->delete();

        return redirect()->route('admin.sizes.index')->with('success', 'Xóa cỡ giày thành công');
    }
}
