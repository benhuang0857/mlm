<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view("back.product.category")->with('CATEGORY', $category);
    }

    public function store(Request $req)
    {
        $category = new Category;
        $category->name = $req->input('CategoryName');
        $category->save();

        $users = User::all();

        $levelArray = array("$category->name" => "尊榮級顧問",);

        foreach($users as $user)
        {
            $jsonArray = json_decode($user->level,true);
            if($jsonArray != NULL)
            {
                $user->level = json_encode(array_merge($jsonArray, $levelArray),JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $user->level = json_encode($levelArray,JSON_UNESCAPED_UNICODE);
            }
            $user->save();
        }

        return redirect('/admin/product/category');
    }
}
