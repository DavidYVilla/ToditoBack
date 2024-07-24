<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }


    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit',compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
      //dd($request->all());
    //        $user->role = $request->role;
        $user->roles()->sync($request->roles);
        //->assignRole('Administrador');

        return redirect()->route('admin.users.edit',$user)->with('info', 'Se asigno correctamente los roles');
    }


}
