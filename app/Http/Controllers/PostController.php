<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $posts = Post::all();
        // $posts = Post::get();
        $posts = Post::orderby('id','DESC')->get();
        return view('posts.index',compact('posts'));

        // 'select * from posts orderby id DESC'
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // 方法一
        // $post = new Post;
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->created_at = now();
        // $post->updated_at = now();

        // 方法二
        // $post = new Post;
        // $post->fill([
        //     'title'     => $request->title,
        //     'content'   => $request->content
        // ]);

        // 方法三
        // $post = new Post;
        // $post->fill($request->all());

        // 方法四
        // Post::create($request->all());
        

        //*
        $post = new Post;
        
        if($request->file('cover')){
            $ext = $request->file('cover')->getClientOriginalExtension();
            $cover = Str::uuid().'.'.$ext;
            $request->file('cover')->storeAs('public/images',$cover.'.'.$ext);
        }else{
            $cover = '';
        }
       
       
        $post->fill($request->all());
        $post->category_id = $request->category_id;
        $post->cover = $cover;
        $post->save();

        return redirect()->route('posts.index');

       
       
        // * 檔案上傳
        // return $request->file('cover');
        // return $request->file('cover')->store('images');
        // return $request->file('cover')->store('images','public');
        // return $request->file('cover')->storeAs('public/images', 'hello');


        // return  $request->file('cover')->getClientOriginalName();
        // return  $request->file('cover')->getClientOriginalExtension();

        // return Str::uuid();

        // $ext = $request->file('cover')->getClientOriginalExtension();
        // $cover = Str::uuid();
        // return $request->file('cover')->storeAs('public/images',$cover.'.'.$ext);

    }

    /**
     * Display the specified resource.
     *23737093
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('posts.show',compact('post'));
        // return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::get();
        return view('posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        // 方法一
        // $post = Post::findOrFail($post->id);
        // $post->fill([
        //     'title'     => $request->title,
        //     'content'   => $request->content
        // ]);

        // 方法二
        // $post = Post::findOrFail($post->id);
        // $post->fill($request->all());

        // 方法三
        $post->fill($request->all());
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()-> route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        // 方法一
        // $post = Post::findOrFail($post->id);
        // $post->delete();

        // 方法二
        // $post->delete();

        // 方法三
        Post::destroy($post->id);

        return redirect()->route('posts.index');
    }
}
