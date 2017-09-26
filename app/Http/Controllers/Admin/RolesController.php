<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest; //This we insert RoleFormRequest class wich implements Request form validaition
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
  public function index()
  {
    $roles = Role::all();
    return view('backend.roles.index', ['roles' => $roles]);
  }

  public function create()
  {
    return view('backend.roles.create');
  }

  public function store(RoleFormRequest $request)
  {
    Role::create(['name' => $request->input('name')]);// Here we create new roles using create() method

    return redirect()->route('backend.roles.create')->with('status', 'A new role has been created!');
  }


}
