<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Auth;

class OrderController extends Controller
{
    public function getHistoryOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->get();
        $data = [
            'ORDERS' => $orders,
        ];

        return view('back.shop.order-history')->with($data);
    }

    public function showHistoryOrdersDetail($id)
    {
        $order = Order::where('id', $id)->first();
        $order->cart = unserialize($order->cart);
        $leader = User::where('id', $order->leader_id)->first();

        $data = [
            'ORDER' => $order,
            'USER' => Auth::user(),
            'CART' => $order->cart,
            'TOTALPRICE' => $order->totalprice,
            'STATUS' => $order->status,
            'LEADER' => $leader,
        ];

        return view('back.shop.order-history-detail')->with($data);
    }

    //顯示下線訂單
    public function showYourMemberOrders()
    {
        $id = Auth::user()->id;
        $orders = Order::where('leader_id', $id)->get();
        //dd($orders);
        $data = [
            'USER' => Auth::user(),
            'ORDERS' => $orders
        ];

        return view('back.shop.order-history-members')->with($data);
    }

    //更新下線訂單狀態
    public function updateOrdersStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->address = $request->input('inputAdress');
        $order->name = $request->input('inputName');
        $order->phone = $request->input('inputPhone');
        $order->email = $request->input('inputEmail');
        $order->status = $request->input('inputStatus');
        $order->pay = $request->input('inputPay');

        $order->save();
        return redirect('/admin/order-history-member');
    }

    public function cancelOrders($id)
    {
        $order = Order::where('id', $id)->first();
        $order->status = '取消訂單';
        $order->save();

        return redirect('/admin/order-history-member');
    }

    public function deleteOrders($id)
    {
        $order = Order::where('id', $id)->first();

        if ($order->status == '完成訂購')
        {
            $order->status = '刪除訂單';
            $order->save();
        }
        else
        {
            $order->delete();
        }
        

        return redirect('/admin/order-history-member');
    }

}
