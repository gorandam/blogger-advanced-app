<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use App\Repositories\Posts;


class BlogController extends Controller
{
    public function index(Posts $posts)
    {


      $posts = $posts->all();
      //$posts = Post::all();
      //  $posts = Post::latest() // Here is our refactoring query scope code for getting posts from selected month/ Our scope code is in the Post.php
        //  ->filter(request(['month', 'year']))
        //  ->get();

        //$archives = Post::archives();

      return view('blog.index', ['posts' => $posts]);   //We create response and send view data/ Here we must add in array 'archives' => archives if we want to show our posts by monts
                                                        //Here we also in our view() add 'archives' => $archives when we implement our shared.sedebar and our view composers logic..
    }


    public function show($slug)
    {
      $post = Post::whereSlug($slug)->firstOrFail();
      $comments = $post->comments()->get(); // This will return all comments that belogns to retrived Post model instance
      return view('blog.show', ['post' => $post, 'comments' => $comments]);// Here we return view response object
    }

}
