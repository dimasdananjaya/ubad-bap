<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodeModel;
use App\BAPModel;
use DB;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class PimpinanController extends Controller
{
    public function showBAPPeriodePimpinan(Request $request){
        $id_periode=$request->input('id_periode');
        $periode = PeriodeModel::where('id_periode', $id_periode)->first();
        $dataLaporanBAPUser=DB::select(DB::raw("SELECT users.*, sum( bap.sks ) AS total_sks FROM bap LEFT JOIN users ON 
        users.id_user=bap.id_user WHERE id_periode=$id_periode GROUP BY bap.id_user"));
        

        return view('pimpinan.pimpinan-show-laporan')
        ->with('dataLaporanBAPUser',$dataLaporanBAPUser)
        ->with('periode',$periode);
    }

    public function detailLaporanBAPPimpinan(Request $request){
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
        
        return view('pimpinan.pimpinan-detail-laporan')
        ->with('dataLaporanBAPPeriode',$dataDetailLaporanBAP)
        ->with('periode',$periode)
        ->with('name',$name);
    }

    public function pimpinanPilihPeriodeLaporan()
    {
        $dataPeriode=PeriodeModel::all();
        return view('pimpinan.pimpinan-pilih-periode')->with('dataPeriode',$dataPeriode);
    }
}
