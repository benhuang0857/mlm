<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $data = [
            'POSTS' => $posts,
        ];
        return view('back.post.index')->with($data);
    }

    public function create()
    {
        return view("back.post.create");
    }

    public function store(Request $request)
    {
        $post = new Post;
        
        if($request->hasFile('PostImage'))
        {
            $PostImage = $request->file('PostImage')->getClientOriginalName();
            $imageName = pathinfo($PostImage, PATHINFO_FILENAME);
            $extension = $request->file('PostImage')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = $request->file('PostImage')->storeAs('public/images/postimage', $imageNametoStore);
        }

        $post->title = $request->input('PostName');
        $post->image = $imageNametoStore;
        $post->body = $request->input('PostDescription');

        $post->save();
        return redirect('/admin/post');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $data = [
            'POST' => $post,
        ];
        return view('back.post.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if($request->hasFile('PostImage'))
        {
            $PostImage = $request->file('PostImage')->getClientOriginalName();
            $imageName = pathinfo($PostImage, PATHINFO_FILENAME);
            $extension = $request->file('PostImage')->getClientOriginalExtension();
            $imageNametoStore = $imageName.'_'.time().'.'.$extension;
            $path = $request->file('PostImage')->storeAs('public/images/postimage', $imageNametoStore);
            Storage::delete('public/images/postimage/'.$post->image);
        }

        if($request->hasFile('PostImage')){
            $post->image = $imageNametoStore;
        }

        $post->title = $request->input('PostName');
        $post->body = $request->input('PostDescription');

        $post->save();
        return redirect('/admin/post');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        return redirect('/admin/post');
    }
}
