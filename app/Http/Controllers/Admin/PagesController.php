<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home() {

      return view('backend.home');// Here we return view response object and our admin home page view

    }
}
