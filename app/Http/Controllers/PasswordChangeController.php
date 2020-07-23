<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;

class PasswordChangeController extends Controller
{
    public function changePassword(Request $request)
    {
        $id_user=$request->input('id_user');
        $validator = Validator::make($request->all(), [
            'id_user', 'password'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal !', 'Isi Form Dengan Benar');
            return back();
        }

        else{

            $simpan=User::find($id_user);
            $password=$request->input('password');
            $simpan->password=Hash::make($password);
            $simpan->pwd=$request->input('password');
            $simpan->save();
            alert()->success('Success !', 'Password Baru Disimpan');
            return back();
        }

    }
}
