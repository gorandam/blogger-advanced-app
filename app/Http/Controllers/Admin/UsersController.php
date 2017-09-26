<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;//This tells we can use User model in the this class
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index() {
      $users = User::all(); //It will return Collection object that contains our  User model instances
      return view('backend.users.index', ['users' => $users]);//Here we return view response object and pass array data with it(['users' => $users])

    }

    public function edit($id) {
      $user = User::whereId($id)->firstOrFail(); //It will return, retrived User model instance where id is inject data
      $roles = Role::all(); // This will retrun Collection object with all role insatces from the datadabase
      $selectedRoles = $user->roles()->pluck('name')->toArray();
      //dd($selectedRoles);
      return view('backend.users.edit', ['user' => $user, 'roles' => $roles, 'selectedRoles' => $selectedRoles]);//Here we return view response object and pass array data with it(['users' => $users])

    }


}
