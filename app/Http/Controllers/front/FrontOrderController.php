<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontOrderController extends Controller
{
    //Đặt hàng
    public function showOrder()
    {
        //header
        $brands = Brand::with('categories')->get();

        //order
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('front.order', compact('brands', 'user', 'cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'status' => 'Chờ xử lý',
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'shoe_id' => $item['shoe_id'],
                'size_id' => $item['size_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        Session::forget('cart');

        return redirect()->route('front.myOrders')->with('success', 'Đặt giày thành công!');
    }

    //Xem đơn hàng của tôi
    public function myOrders()
    {
        //header
        $brands = Brand::with('categories')->get();

        //my orders
        $orders = Order::where('user_id', Auth::id())->get();
        return view('front.my-orders', compact('brands', 'orders'));
    }

    public function orderDetail($orderId)
    {
        //header
        $brands = Brand::with('categories')->get();

        //detail order
        $order = Order::with([
            'orderDetails.shoe',
            'orderDetails.size',
            'user',
            'orderDetails.shoe.images'
        ])->findOrFail($orderId);

        return view('front.order-detail', compact('brands', 'order'));
    }
}
