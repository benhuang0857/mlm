<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Auth;

class CartController extends Controller
{
    //加入購物車
    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);
        $num = $request->input('number');
        $cart->add($product, $product->id, $num);

        $request->session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect('/admin/shop/index');
    }

    //進入購物車
    public function getCart()
    {
        $user = auth()->user();

        if (!Session::has('cart'))
        {
            $data = [
                'USER' => $user,
                'PRODUCTS' => null
            ];

            return view('back.shop.cart')->with($data);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        if (empty($cart->items))
        {
            return redirect('/admin');
        }

        $data = [
            'USER' => $user,
            'PRODUCTS' => $cart->items,
            'TOTALPRICE' => $cart->totalPrice
        ];

        return view('back.shop.cart')->with($data);
    }

    //刪除購物車內的商品
    public function deleteCartItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        //dd($cart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    //結帳頁面
    public function getCheckout()
    {
        $user = auth()->user();
        if (!Session::has('cart'))
        {
            return view('back.shop.cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        $data = [
            'USER' => $user,
            'TOTALPRICE' => $cart->totalPrice
        ];

        return view('back.shop.check-out')->with($data);
    }

    //POST CHECK OUT
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart'))
        {
            return redirect()->back();
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        try {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->leader_id = Auth::user()->leader_id;
            $order->cart = serialize($cart);
            $order->address = $request->input('inputAdress');
            $order->name = $request->input('inputName');
            $order->phone = $request->input('inputPhone');
            $order->email = $request->input('inputEmail');
            $order->status = "已通知店家";
            $order->pay = 0;
            $order->totalprice = $cart->totalPrice;

            $order->save();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        Session::forget('cart');
        return redirect('/admin');
    }
}
