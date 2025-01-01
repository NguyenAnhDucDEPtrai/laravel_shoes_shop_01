<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $users = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
            'role' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.unique' => 'Tên này đã được sử dụng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Bạn phải nhập email',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Bạn cần nhập mật khẩu.',
            'password.min' => 'Mật khẩu cần ít nhất :min ký tự.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'address.required' => 'Địa chỉ không được để trống.',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('admin.users.index')->with('success', 'Thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:3',
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
            'role' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.unique' => 'Tên này đã được sử dụng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Bạn phải nhập email',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Bạn cần nhập mật khẩu.',
            'password.min' => 'Mật khẩu cần ít nhất :min ký tự.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'address.required' => 'Địa chỉ không được để trống.',
        ]);

        $user = User::find($id);
        $user->update($validatedData);
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công');
    }
}
