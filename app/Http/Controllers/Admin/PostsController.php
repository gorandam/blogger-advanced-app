<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Support\Str;
use App\Http\Requests\PostFormRequest;
use App\Http\Requests\PostEditFormRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
      $user_id = Auth::user()->id;
      $post = Post::create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'slug' => Str::slug($request->input('title'), '-'),
        'user_id' => $user_id
      ]);

      $post->categories()->sync($request->input('categories'));// Here we create relationship between posts and catogories, when we created post we store related categories in the database table

      return redirect()->route('backend.posts.create')->with('status', 'The post has been created!');

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
    public function edit(Post $post)
    {
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->toArray();

        return view('backend.posts.edit', ['post' => $post, 'categories' => $categories, 'selectedCategories' => $selectedCategories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditFormRequest $request, Post $post)
    {
        //We update it and save it
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('title'), '-');
        $post->save();

        //We sync exiting seletected posts with new ones in our database pivot TokyoTyrantTable
        $post->categories()->sync($request->input('categories'));

        // We must create response

        return redirect()->route('backend.posts.edit', $post->id)->with('status', 'The post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
