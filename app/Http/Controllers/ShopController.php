<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Cart;
use Session;

class ShopController extends Controller
{
    public function index()
    {
        //商品控制台頁面
        $user = auth()->user();
        $products = Product::all();

        $data = [
            'USER' => $user,
            'PRODUCTS' => $products
        ];

        return view("back.shop.index")->with($data);
    }
}
