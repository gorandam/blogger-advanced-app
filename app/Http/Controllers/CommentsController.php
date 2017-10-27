<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CommentFormRequest;// Here we insert with namespace CommentFormRequest class
use App\Comment;// Here we insert with namespace our Comment model

class CommentsController extends Controller
  {
    public function newComment(CommentFormRequest $form) { // Here we also use Request class to validate our request data

      $form->persist(); //Here we call method in what we define our logic in our CommentFormRequest class

      return redirect()->back()->with('status', 'Your comment has been created!');// Here we use global redirect() witch return redirect response object with previous location with global back() helper and flashing data to season with with() function
    }
}
