<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{   

    public function __construct(){
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::get();

        return view('posts.index',['posts' => $posts]);
    }


    public function show(Post $post){
        return view('posts.show',['post' => $post]);
    }

    public function create(){
        return view('posts.create',['post' => new Post]);
    }

    public function store(SavePostRequest $request){

        Post::create($request->validated);

        session()->flash('status','Post creado');

        return to_route('posts.index');
    }

    public function edit(Post $post){
        return view('posts.edit',['post' => $post]);
    }

    public function update(Request $request, Post $post){
        $validate = $request->validate([
            'title' => ['required'],
            'body' => ['required']
        ]);

        $post->update($validate);

        session()->flash('status','Post actualizado');

        return to_route('posts.show',$post);
    }


    public function destroy(Post $post){
        $post->delete();
        return to_route('posts.index')->with('status','Post elminado');
    }
}
