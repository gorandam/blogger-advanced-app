<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;


class BlogController extends Controller
{
    public function index()
    {

      //$posts = Post::all();
        $posts = Post::latest() // Here is our refactoring query scope code for getting posts from selected month/ Our scope code is in the Post.php
          ->filter(request(['month', 'year']))
          ->get();

        $archives = Post::archives();
      //$archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')// this is our complex query to get all our posts by year and month by descending order
          //->groupBy('year', 'month')
        //->orderByRaw('min(created_at)desc')
          //->get();


      return view('blog.index', ['posts' => $posts, 'archives' => $archives]);   //We create response and send view data/ Here we must add in array 'archives' => archives if we want to show our posts by monts
    }


    public function show($slug)
    {
      $post = Post::whereSlug($slug)->firstOrFail();
      $comments = $post->comments()->get(); // This will return all comments that belogns to retrived Post model instance
      return view('blog.show', ['post' => $post, 'comments' => $comments]);// Here we return view response object
    }

}
