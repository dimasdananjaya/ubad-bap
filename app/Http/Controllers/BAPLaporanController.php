<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PeriodeModel;
use App\BAPModel;
use DB;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;


class BAPLaporanController extends Controller
{
    public function kelolaLaporanPeriodeDosen(Request $request){
        $id_periode=$request->input('id_periode');
        $periode = PeriodeModel::where('id_periode', $id_periode)->first();
        $id_user=Auth::user()->id_user;

        $dataLaporanBAPPeriode=DB::select(DB::raw("SELECT*FROM bap where id_periode=$id_periode AND id_user=$id_user"));
        $totalSKS=DB::select(DB::raw("SELECT SUM(sks) AS totalSKS FROM bap where id_user=$id_user AND id_periode=$id_periode"));

        return view('dosen.dosen-show-bap-periode')
        ->with('dataLaporanBAPPeriode',$dataLaporanBAPPeriode)
        ->with('periode',$periode)
        ->with('totalSKS',$totalSKS);
    }

    public function storeLaporanBap(Request $request){
        $validator = Validator::make($request->all(), [
            'id_user'=> 'required',
            'id_periode'=> 'required',
            'tanggal' => 'required',
            'mata_kuliah'=> 'required',
            'jam'=> 'required',
            'sks'=> 'required',
            'materi'=> 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Data BAP Gagal Disimpan!', 'Isi Formulir Dengan Benar');
            return back();
        }
        else{
            $bap = BAPModel::create([
                'id_user' => $request->input('id_user'),
                'id_periode' => $request->input('id_periode'),
                'tanggal' => $request->input('tanggal'),
                'mata_kuliah' => $request->input('mata_kuliah'),
                'jam' => $request->input('jam'),
                'sks' => $request->input('sks'),
                'materi' => $request->input('materi'),
            ]);

            $bap->save();
            Alert::success('Data BAP Berhasil Disimpan!');
            return back();
        }
    }


    public function updateLaporanBap(Request $request, $id)
    {
        $bap=BAPModel::find($id);

        $validator = Validator::make($request->all(), [
            'id_user'=> 'required',
            'id_periode'=> 'required',
            'tanggal' => 'required',
            'mata_kuliah'=> 'required',
            'jam'=> 'required',
            'sks'=> 'required',
            'materi'=> 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Data BAP Gagal Disimpan!', 'Kembali');
            return back();
        }

        else{  
            $bap->id_user=$request->input('id_user');
            $bap->id_periode=$request->input('id_periode');
            $bap->tanggal=$request->input('tanggal');
            $bap->mata_kuliah=$request->input('mata_kuliah');
            $bap->jam=$request->input('jam');
            $bap->sks=$request->input('sks');
            $bap->materi=$request->input('materi');
            $bap->save();
            Alert::success('Data BAP Berhasil Disimpan!');
            return back();
        }
    }

    public function deleteLaporanBap(Request $request )
    {
        $id = $request->input('id_bap');
        BAPModel::find($id)->delete();
        alert()->success('Berhasil Dihapus!', '');
        return back();
    }

    public function showBAPPeriodeAdmin(Request $request){
        $id_periode=$request->input('id_periode');
        $periode = PeriodeModel::where('id_periode', $id_periode)->first();
        $dataLaporanBAPUser=DB::select(DB::raw("SELECT users.*, sum( bap.sks ) AS total_sks FROM bap LEFT JOIN users ON 
        users.id_user=bap.id_user WHERE id_periode=$id_periode GROUP BY bap.id_user"));

        return view('admin.admin-show-laporan-bap-periode')
        ->with('dataLaporanBAPUser',$dataLaporanBAPUser)
        ->with('periode',$periode);
    }

    public function detailLaporanBAP(Request $request){
        $id_periode=$request->input('id_periode');
        $periode = PeriodeModel::where('id_periode', $id_periode)->first();
        $id_user=$request->input('id_user');
        $name = User::where('id_user', $id_user)->first();

        //$dataLaporanBAPPeriode=DB::select(DB::raw(" SELECT*FROM bap where id_periode=$id_periode AND id_user=$id_user"));

        $dataDetailLaporanBAP= DB::table('bap')
        ->join('users', 'users.id_user', '=', 'bap.id_user')
        ->select('bap.*', 'users.name')
        ->where('id_periode',$id_periode)
        ->get();
        
        return view('admin.admin-detail-laporan-bap')
        ->with('dataLaporanBAPPeriode',$dataDetailLaporanBAP)
        ->with('periode',$periode)
        ->with('name',$name);
    }
}
