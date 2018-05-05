<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:10|max:255',
            'slug'        => 'unique:posts,slug',
            'category_id' => 'required',
            'tags'        => 'required',
            'image'       => 'image',
            'body'        => 'required|min:5'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->slug = str_slug($request->slug);
        $post->category_id = $request->category_id;
        $post->image = $request->image;
        $post->body = $request->body;

        if ($request->posted_by) {
            $post->posted_by = $request->posted_by;
        } else {
            $post->posted_by = 0;
        }
        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('success', 'New post has been successfully added!');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::where('id', $id)->first();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        $request->validate([
            'title'       => 'required|min:15|max:255',
            'category_id' => 'required',
            'tags'        => 'required',
            'image'       => 'sometimes|image',
            'body'        => 'required|min:50'
        ]);

        $post = Post::where('id', $id)->first();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->image = $request->image;
        $post->body = $request->body;

        if ($request->posted_by) {
            $post->posted_by = $request->posted_by;
        } else {
            $post->posted_by = 0;
        } 
        $post->save();

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        Session::flash('success', 'Post has been updated successfully!');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        $post->tags()->detach();
        $post->delete();

        Session::flash('success', 'Post has been deleted successfully!');

        return redirect()->route('posts.index');
    }
}
