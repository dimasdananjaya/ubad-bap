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
use Storage;
use Image;
use File;
use App\MataKuliah;


class BAPLaporanController extends Controller
{
    public function kelolaLaporanPeriodeDosen(Request $request){
        $id_periode=$request->input('id_periode');
        $periode = PeriodeModel::where('id_periode', $id_periode)->first();
        $id_user=Auth::user()->id_user;

        $dataLaporanBAPPeriode=DB::select(DB::raw("SELECT*FROM bap where id_periode=$id_periode AND id_user=$id_user"));
        $totalSKS=DB::select(DB::raw("SELECT SUM(sks) AS totalSKS FROM bap where id_user=$id_user AND id_periode=$id_periode"));

        return view('dosen.dosen-kelola-bap-periode')
        ->with('dataLaporanBAPPeriode',$dataLaporanBAPPeriode)
        ->with('periode',$periode)
        ->with('totalSKS',$totalSKS);
    }

    public function storeLaporanBap(Request $request){
        $validator = Validator::make($request->all(), [
            'id_user'=> 'required',
            'id_periode'=> 'required',
            //'tanggal' => 'required',
            'mata_kuliah'=> 'required',
            'jam'=> 'required',
            'sks'=> 'required',
            'materi'=> 'required',
            'file'=> 'required',
            'end_date'    => 'required|date',
            'tanggal'      => 'required|date|before_or_equal:end_date'
        ]);


        if ($validator->fails()) {
            Alert::error('Data BAP Gagal Disimpan!', 'Isi Formulir Dengan Benar / Perhatikan tanggal periode pelaporan');
            return back();
        }

        elseif($request->hasFile('file')){
            $image = $request->file('file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $id_periode=$request->input('id_periode');
            $id_user=$request->input('id_user');
            $destinationPath = storage_path('app/public/file/');

            if(!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath);
                Image::make($image->getRealPath())->resize(320,440)->save($destinationPath . '/' . $image_name);
            }

            else{
                Image::make($image->getRealPath())->resize(320,440)->save($destinationPath . '/' . $image_name);
            }

            //$destinationPath = public_path('/resources/file');
            //$path = $resize_image->storeAs(
             //   'public/file', $name
            //);
            //$file->move($destinationPath, $name);

            $bap = BAPModel::create([
                'id_user' => $request->input('id_user'),
                'id_periode' => $request->input('id_periode'),
                'tanggal' => $request->input('tanggal'),
                'mata_kuliah' => $request->input('mata_kuliah'),
                'jam' => $request->input('jam'),
                'sks' => $request->input('sks'),
                'materi' => $request->input('materi'),
                'jumlah_mahasiswa'=>$request->input('jumlah_mahasiswa'),
                'file' => $image_name,
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
            //'tanggal' => 'required',
            'mata_kuliah'=> 'required',
            'jam'=> 'required',
            'sks'=> 'required',
            'materi'=> 'required',
            'jumlah_mahasiswa'=>'required',
            'end_date'    => 'required|date',
            'tanggal'      => 'required|date|before_or_equal:end_date'
        ]);

        if ($validator->fails()) {
            Alert::error('Data BAP Gagal Disimpan!', 'Isi Formulir Dengan Benar / Perhatikan tanggal periode pelaporan');
            return back();
        }

        elseif($request->hasFile('file')){
            $delete = $request->input('file_lama'); //cari nama file
            $id_periode=$request->input('id_periode');
            $id_user=$request->input('id_user');

            Storage::delete('public/file/'.$delete); //hapus file

            $image = $request->file('file');
            $image_name = time() . '.' . $image->getClientOriginalExtension(); 
            $destinationPath = storage_path('app/public/file/');
            Image::make($image->getRealPath())->resize(320,440)->save($destinationPath . '/' . $image_name);
            //$file = $request->file('file');
            //$name = time() . '.' . $file->getClientOriginalExtension();
            //$destinationPath = public_path('/resources/file');
            //$path = $request->file('file')->storeAs(
            //    'public/file', $name
            //);
            //$file->move($destinationPath, $name);

            $bap->id_user=$request->input('id_user');
            $bap->id_periode=$request->input('id_periode');
            $bap->tanggal=$request->input('tanggal');
            $bap->mata_kuliah=$request->input('mata_kuliah');
            $bap->jam=$request->input('jam');
            $bap->sks=$request->input('sks');
            $bap->materi=$request->input('materi');
            $bap->jumlah_mahasiswa=$request->input('jumlah_mahasiswa');
            $bap->file = $image_name;
            $bap->save();
            Alert::success('Data BAP Berhasil Disimpan!');
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
            $bap->jumlah_mahasiswa=$request->input('jumlah_mahasiswa');
            $bap->save();
            Alert::success('Data BAP Berhasil Disimpan!');
            return back();
        }
    }

    public function deleteLaporanBap(Request $request)
    {
        $id = $request->input('id_bap');
        $id_periode=$request->input('id_periode');
        $id_user=$request->input('id_user');
        $delete = $request->input('file_bap'); //cari nama file

        Storage::delete('public/file/'.$delete); //hapus file

        BAPModel::find($id)->delete();

        alert()->success('Berhasil Dihapus!', '');
        return back();
    }

     function getAutocompleteMataKuliah(Request $request){
            if($request->has('term')){
                return MataKuliah::where('nama_mk','like','%'.$request->input('term').'%')->get();
            }
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
        ->where('bap.id_user',$id_user)
        ->get();
        
        return view('admin.admin-detail-laporan-bap')
        ->with('dataLaporanBAPPeriode',$dataDetailLaporanBAP)
        ->with('periode',$periode)
        ->with('name',$name);
    }
}
