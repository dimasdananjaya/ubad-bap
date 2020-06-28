<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function kelolaUser()
    {
        $dataUser=User::all();
        return view('admin.admin-users')->with('dataUser',$dataUser);
    }

    public function editUser()
    {
        
    }
}
