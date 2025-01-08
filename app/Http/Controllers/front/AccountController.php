<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    // thông tin cá nhân
    public function showProfile()
    {
        //header
        $brands = Brand::with('categories')->get();

        //account
        $user = Auth::user();
        return view('front.profile', compact('brands', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Bạn phải nhập email hợp lệ.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'address.required' => 'Địa chỉ không được để trống.',
        ]);

        $user = User::find(Auth::id());
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone'];
        $user->address = $validatedData['address'];

        $user->save();

        return redirect()->back()->with('success', 'Thông tin của bạn đã được cập nhật!');
    }

    //Đổi mật khẩu
    public function showChangePassword()
    {
        //header
        $brands = Brand::with('categories')->get();

        //account
        $user = Auth::user();
        return view('front.change-password', compact('brands', 'user'));
    }

    public function changePassword(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:3|confirmed',
        ], [
            'current_password.required' => 'Mật khẩu cũ là bắt buộc.',
            'new_password.required' => 'Mật khẩu mới là bắt buộc.',
            'new_password.min' => 'Mật khẩu mới cần ít nhất 3 ký tự.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($validatedData['current_password'], Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng');
        }

        // Cập nhật mật khẩu mới
        $user = User::find(Auth::id());
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return back()->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
