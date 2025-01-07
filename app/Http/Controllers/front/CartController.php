<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Shoe;
use App\Models\Size;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCart()
    {
        //header
        $brands = Brand::with('categories')->get();

        //cart
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('front.cart', compact('brands', 'cart', 'total'));
    }

    public function addToCart(Request $request, $shoeId)
    {
        $shoe = Shoe::findOrFail($shoeId);
        $sizeId = $request->input('size');
        $size = $shoe->sizes()->find($sizeId);

        $stockQuantity = $shoe->sizes()->where('size_id', $sizeId)->first()->pivot->stock_quantity;
        $cart = Session::get('cart', []);

        $exists = false;
        foreach ($cart as &$item) {
            if ($item['shoe_id'] == $shoe->id && $item['size_id'] == $size->id) {
                if ($item['quantity'] >= $stockQuantity) {
                    return redirect()->route('cart.show')->with('error', 'Số lượng trong giỏ hàng đã vượt quá số lượng tồn kho!');
                }
                $item['quantity']++;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            if (1 > $stockQuantity) {
                return redirect()->route('cart.show')->with('error', 'Số lượng giày không đủ trong kho!');
            }

            $cart[] = [
                'shoe_id' => $shoe->id,
                'shoe_name' => $shoe->shoe_name,
                'size_id' => $size->id,
                'size' => $size->size,
                'price' => $shoe->price,
                'quantity' => 1,
                'image_url' => $shoe->images()->first()->image_url,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Giày đã được thêm vào giỏ hàng!');
    }

    // Tăng số lượng
    public function increaseQuantity($shoeId, $sizeId)
    {
        $shoe = Shoe::findOrFail($shoeId);
        $stockQuantity = $shoe->sizes()->where('size_id', $sizeId)->first()->pivot->stock_quantity;
        $cart = Session::get('cart', []);

        foreach ($cart as &$item) {
            if ($item['shoe_id'] == $shoeId && $item['size_id'] == $sizeId) {
                if ($item['quantity'] >= $stockQuantity) {
                    return redirect()->route('cart.show')->with('error', 'Số lượng trong giỏ hàng đã vượt quá số lượng tồn kho!');
                }
                $item['quantity']++;
                break;
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.show');
    }

    // Giảm số lượng
    public function decreaseQuantity($shoeId, $sizeId)
    {
        $cart = Session::get('cart', []);

        foreach ($cart as &$item) {
            if ($item['shoe_id'] == $shoeId && $item['size_id'] == $sizeId) {
                if ($item['quantity'] > 1) {
                    $item['quantity']--;
                }
                break;
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.show');
    }


    public function removeFromCart($shoeId, $sizeId)
    {
        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['shoe_id'] == $shoeId && $item['size_id'] == $sizeId) {
                unset($cart[$key]);
                break;
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Giày đã được xóa khỏi giỏ hàng!');
    }
}
