<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CommentFormRequest;// Here we insert with namespace CommentFormRequest class
use App\Comment;// Here we insert with namespace our Comment model

class CommentsController extends Controller
  {
    public function newComment(CommentFormRequest $request) {
      $comment = new Comment(array(
        'post_id' => $request->get('post_id'),
        'content' => $request->get('content')
      ));

      $comment->save();

      return redirect()->back()->with('status', 'Your comment has been created!');// Here we use global redirect() witch return redirect response object with previous location with global back() helper and flashing data to season with with() function
    }
}