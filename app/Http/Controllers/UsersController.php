<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;

class UsersController extends Controller
{
    public function kelolaUser()
    {
        $dataUser=User::all();
        return view('admin.admin-users')->with('dataUser',$dataUser);
    }

    public function tambahUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
        ]);

        if ($validator->fails()) {
            alert()->error('Penyimpanan Gagal !', 'Email sudah dipakai');
            return back();
        }

        else{
            $simpan=new User;
            $simpan->name=$request->input('name');
            $simpan->email=$request->input('email');
            $simpan->level=$request->input('level');
            $password=$request->input('password');
            $simpan->password=Hash::make($password);
            $simpan->pwd=$request->input('password');
            $simpan->save();
            alert()->success('Success !', '');
            return back();
        }
    }

    public function editUser(Request $request)
    {
        $id_user=$request->input('id_user');
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$id_user.',id_user'
        ]);

        if ($validator->fails()) {
            alert()->error('Penyimpanan Gagal !', 'Email sudah dipakai');
            return back();

        }

        else{

            $simpan=User::find($id_user);
            $simpan->name=$request->input('name');
            $simpan->email=$request->input('email');
            $simpan->level=$request->input('level');
            $password=$request->input('password');
            $simpan->password=Hash::make($password);
            $simpan->pwd=$request->input('password');
            $simpan->save();
            alert()->success('Success !', 'Data Tersimpan');
            return back();
        }

    }
}
