<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;//This tells we can use User model in the this class
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserEditFormRequest;
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

    public function update($id, UserEditFormRequest $request) { //Here we use inject $id from URL query string, use request class to DI request instance in Controller method
      $user = User::whereId($id)->firstOrFail(); // Here we retrive edit user form database
      $user->name = $request->input('name'); // Here we insert form fields for edit user in the database
      $user->email = $request->input('email');
      $password = $request->input('password');
      if($user->password != ""){
        $user->password = Hash::make($password); //Here we hash new inserted password to store it to the database
      }

      $user->save();
      $user->syncRoles($request->input('role'));// Here we sync roles and add new aded role to user in database table

      return redirect()->route('backend.users.edit', $user->id)->with('status', 'The user has been updated');// Here we return redirect response object


    }



}
