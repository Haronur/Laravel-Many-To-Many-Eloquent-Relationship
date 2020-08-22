<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

class ManyController extends Controller
{
    //
    public function manyRoles()
    {
 
        $user = User::find(1);
        $role = Role::find(1);
        // dd($role);
    	// return;
        return view('index',compact('user','role'));
       
    }
}
