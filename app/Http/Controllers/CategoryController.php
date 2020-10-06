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

    public function edit($id)
    {
        $category = Category::find($id);
        return view('back.product.editcategory')->with('CATEGORY', $category);
    }

    public function store(Request $req)
    {
        $category = new Category;
        $category->name = $req->input('CategoryName');
        $category->a_level = $req->input('a_level');
        $category->b_level = $req->input('b_level');
        $category->c_level = $req->input('c_level');
        $category->d_level = $req->input('d_level');
        $category->e_level = $req->input('e_level');
        $category->f_level = $req->input('f_level');

        $category->a_name = $req->input('a_name');
        $category->b_name = $req->input('b_name');
        $category->c_name = $req->input('c_name');
        $category->d_name = $req->input('d_name');
        $category->e_name = $req->input('e_name');
        $category->f_name = $req->input('f_name');

        $category->save();

        $users = User::all();

        $levelArray = array("$category->name" => "F",);

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

    public function update(Request $req, $id)
    {
        $category = Category::find($id);
        $category->name = $req->input('CategoryName');
        $category->a_level = $req->input('a_level');
        $category->b_level = $req->input('b_level');
        $category->c_level = $req->input('c_level');
        $category->d_level = $req->input('d_level');
        $category->e_level = $req->input('e_level');
        $category->f_level = $req->input('f_level');

        $category->a_name = $req->input('a_name');
        $category->b_name = $req->input('b_name');
        $category->c_name = $req->input('c_name');
        $category->d_name = $req->input('d_name');
        $category->e_name = $req->input('e_name');
        $category->f_name = $req->input('f_name');

        $category->save();
        return redirect('/admin/product/category');
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        $catName = $category->name;

        $users = User::all();

        foreach($users as $user)
        {
            $levelArray = json_decode($user->level, true);
            //dd($catName);

            unset($levelArray[$catName]);
            $levelArray = json_encode($levelArray,JSON_UNESCAPED_UNICODE);
            $user->level = $levelArray;
            $user->save();
        }

        $category->delete();
        return redirect('/admin/product/category');

    }
}
