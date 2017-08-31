<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;//This tells we can use User model in the this class

class UsersController extends Controller
{
    public function index() {
      $users = User::all(); //It will return Collection object that contains our  User model instances
      return view('backend.users.index', ['users' => $users]);//Here we return view response object and pass array data with it(['users' => $users])

    }
}
