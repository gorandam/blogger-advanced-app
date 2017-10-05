<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
      //Here we fetch all posts from database
      $posts = Post::all();
      return view('blog.index', ['posts' => $posts]);   //We create response and send view data
    }

}
