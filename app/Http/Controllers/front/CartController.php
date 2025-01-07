<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Shoe;
use App\Models\Size;

class CartController extends Controller
{
    public function index()
    {
        $brands = Brand::with('categories')->get();
        return view('front.cart', compact('brands'));
    }

    // Hàm để hiển thị giỏ hàng
    public function showCart()
    {
        //header
        $brands = Brand::with('categories')->get();

        $cart = session()->get('cart', []);
        return view('front.cart', compact('brands', 'cart'));
    }

    // Hàm để thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $id)
    {
        $shoe = Shoe::find($id);
        $sizeId = $request->size; // Chọn cỡ giày
        $size = Size::find($sizeId);
        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
        $cart = session()->get('cart', []);

        $cart[$id] = [
            'name' => $shoe->shoe_name,
            'price' => $shoe->price,
            'size' => $size->size,
            'quantity' => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1,
            'image' => $shoe->images->first()->image_url,  // Lấy ảnh đầu tiên của sản phẩm
        ];

        // Lưu lại giỏ hàng vào session
        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Product added to cart!');
    }

    // Hàm để xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product removed from cart!');
    }

    // Hàm để cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Cart updated!');
    }
}
