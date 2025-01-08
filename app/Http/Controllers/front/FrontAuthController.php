<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FrontAuthController extends Controller
{
    public function showLogin()
    {
        //header
        $brands = Brand::with('categories')->get();


        return view('front.login', compact('brands'));
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:3',
        ], [
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.max' => 'Email không được vượt quá :max ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('front.home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Sai mật khẩu hoặc email!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.home')->with('success', 'Bạn đăng xuất thành công!');
    }

    public function showRegister()
    {
        //header
        $brands = Brand::with('categories')->get();


        return view('front.register', compact('brands'));
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone_number' => 'required|numeric',
            'address' => 'required|string',
            'role' => ''
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.unique' => 'Tên này đã được sử dụng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Bạn phải nhập email',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Bạn cần nhập mật khẩu.',
            'password.min' => 'Mật khẩu cần ít nhất :min ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'address.required' => 'Địa chỉ không được để trống.',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('front.auth.showLogin')->with('success', 'Đăng ký tài khoản thành công!');
    }
}
