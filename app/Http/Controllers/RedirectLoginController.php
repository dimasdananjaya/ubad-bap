<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RedirectLoginController extends Controller
{
    public function isAdmin(){
        $role=Auth::user()->level;
        
        if($role == 'admin')
        {
            return view('admin.admin-home');
        }
        else{
            return view('home');
        }
    }

    public function isDosen(){
        $role=Auth::user()->level;
        
        if($role == 'dosen')
        {
        return view('dosen.dosen-home');
        }
        else{
            return view('home');
        }
    }
}
