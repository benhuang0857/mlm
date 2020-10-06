<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //商品控制台頁面
        $user = auth()->user();
        $products = Product::all();

        $data = [
            'USER' => $user,
            'PRODUCTS' => $products
        ];

        return view("back.product.index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //商品新增頁面
        $user = auth()->user();
        $category = Category::all();

        $data = [
            'USER' => $user,
            'CATEGORY' => $category,
        ];

        return view("back.product.create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //儲存商品
        $this->validate($request,[
            'ProductName' => 'required',
            'ProductImage' => 'required',
            'ProductDescription' => 'required',
            'Product_A_Price' => 'required',
            'Product_B_Price' => 'required',
            'Product_C_Price' => 'required',
            'Product_D_Price' => 'required',
            'Product_E_Price' => 'required',
            'Product_F_Price' => 'required',
            'Category' => 'required'
        ]);

        $product = new Product;
        
        if($request->hasFile('ProductImage'))
        {
            $ProductImage = $request->file('ProductImage')->getClientOriginalName();
            $imageName = pathinfo($ProductImage, PATHINFO_FILENAME);
            $extension = $request->file('ProductImage')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = $request->file('ProductImage')->storeAs('public/images/productimage', $imageNametoStore);
        }

        
        $product->name = $request->input('ProductName');
        $product->image = $imageNametoStore;
        $product->description = $request->input('ProductDescription');
        $product->a_price = $request->input('Product_A_Price');
        $product->b_price = $request->input('Product_B_Price');
        $product->c_price = $request->input('Product_C_Price');
        $product->d_price = $request->input('Product_D_Price');
        $product->e_price = $request->input('Product_E_Price');
        $product->f_price = $request->input('Product_F_Price');
        $product->category = $request->input('Category');

        $product->save();
        return redirect('/admin/product/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //顯示該商品
        $user = auth()->user();
        $product = Product::find($id);
        $category = Category::all();

        $data = [
            'USER' => $user,
            'PRODUCT' => $product,
            'CATEGORY' => $category,
        ];
        
        return view('back.product.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if($request->hasFile('ProductImage'))
        {
            $ProductImage = $request->file('ProductImage')->getClientOriginalName();
            $imageName = pathinfo($ProductImage, PATHINFO_FILENAME);
            $extension = $request->file('ProductImage')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = $request->file('ProductImage')->storeAs('public/images/productimage', $imageNametoStore);
            Storage::delete('public/images/productimage/'.$product->image);
        }

        if($request->hasFile('ProductImage')){
            $product->image = $imageNametoStore;
        }

        $product->name = $request->input('ProductName');
        $product->description = $request->input('ProductDescription');
        $product->a_price = $request->input('Product_A_Price');
        $product->b_price = $request->input('Product_B_Price');
        $product->c_price = $request->input('Product_C_Price');
        $product->d_price = $request->input('Product_D_Price');
        $product->e_price = $request->input('Product_E_Price');
        $product->f_price = $request->input('Product_F_Price');
        $product->category = $request->input('Category');

        $product->save();
        return redirect('/admin/product/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        
        return redirect('/admin/product/index');
    }
}
