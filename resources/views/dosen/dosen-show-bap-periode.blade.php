@extends('layouts.dosen')

@section('content')
<section id="dosen-show-bap-periode">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Kelola Data BAP Periode : {{$periode->periode}}</h2>
            <hr>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahLaporanBapModal">
                Tambah Laporan BAP
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="tambahLaporanBapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Laporan BAP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div><!-- modal header-->
                        <div class="modal-body">
                            {!!Form::open(['action'=>'BAPLaporanController@storeLaporanBap', 'method'=>'POST'])!!}
                                {{Form::label('tanggal','Tanggal :')}}
                                {{Form::text('tanggal','',['class'=>'form-control form-group','placeholder'=>'dd/mm/yyyy','required'])}}
                                {{Form::label('mata_kuliah','Mata Kuliah :')}}
                                {{Form::text('mata_kuliah','',['class'=>'form-control form-group','placeholder'=>'','required'])}}
                                {{Form::label('jam','Jam :')}}
                                {{Form::text('jam','',['class'=>'form-control form-group','placeholder'=>'Jam','required'])}}
                                {{Form::label('sks','SKS :')}}
                                {{Form::number('sks','',['class'=>'form-control form-group','placeholder'=>'sks','required'])}}
                                {{Form::label('materi','Materi :')}}
                                {{Form::text('materi','',['class'=>'form-control form-group','placeholder'=>'Materi','required'])}}
                                {{Form::hidden('id_user',Auth::user()->id_user)}}
                                {{Form::hidden('id_periode',$periode->id_periode)}}
                                {{Form::submit('Simpan',['class'=>'btn btn-success btn-block'])}}
                            {!!Form::close()!!}
                        </div><!-- modal body-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div><!--modal footer-->
                    </div><!--modal content-->
                </div><!--modal dialog-->
            </div><!--modal-->
            <hr>
            <table class="table table-sm table-hover table-striped text-center table-responsive-sm table-responsive-md" id="tabel-laporan-bap">
                <thead>
                    <th>Tanggal</th>
                    <th>Mata Kuliah</th>
                    <th>Jam</th>
                    <th>SKS</th>
                    <th>Materi</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($dataLaporanBAPPeriode as $dlbp)
                    <tr>
                        <td>{{$dlbp->tanggal}}</td>
                        <td>{{$dlbp->mata_kuliah}}</td>
                        <td>{{$dlbp->jam}}</td>
                        <td>{{$dlbp->sks}}</td>
                        <td>{{$dlbp->materi}}</td>
                        <td>
                            <a class="btn btn-success" style="color:#fff;float:center;" data-toggle="modal" data-target="#periode-edit-modal{{$dlbp->id_bap}}">Edit</a>
                        </td>          
                        <!-- Modal Edit BAP-->
                        <div class="modal fade" id="periode-edit-modal{{$dlbp->id_bap}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>Edit Data BAP</h2>   
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">                  
                                        {!!Form::open(['action'=>['BAPLaporanController@updateLaporanBap', $dlbp->id_bap], 'method'=>'PUT'])!!}
                                            {{Form::text('tanggal',$dlbp->tanggal,['class'=>'form-control form-group','placeholder'=>'dd/mm/yyyy','required'])}}
                                            {{Form::label('mata_kuliah','Mata Kuliah :')}}
                                            {{Form::text('mata_kuliah',$dlbp->mata_kuliah,['class'=>'form-control form-group','placeholder'=>'','required'])}}
                                            {{Form::label('jam','Jam :')}}
                                            {{Form::text('jam',$dlbp->jam,['class'=>'form-control form-group','placeholder'=>'Jam','required'])}}
                                            {{Form::label('sks','SKS :')}}
                                            {{Form::text('sks',$dlbp->sks,['class'=>'form-control form-group','placeholder'=>'Materi','required'])}}
                                            {{Form::label('materi','Materi :')}}
                                            {{Form::text('materi',$dlbp->materi,['class'=>'form-control form-group','placeholder'=>'Materi','required'])}}
                                            {{Form::hidden('id_user',Auth::user()->id_user)}}
                                            {{Form::hidden('id_periode',$periode->id_periode)}}
                                            {{Form::hidden('_method','PUT')}}
                                            {{Form::submit('Update',['class'=>'btn btn-success btn-block'])}}
                                        {!!Form::close()!!}
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary mb-5 mb-md-0" style="width: 10em;" href="{{route('dosen.home')}}">Kembali ke Home</a>
        </div><!--card-->
    </div><!--container-->
</section>
<script>
    $(document).ready(function() {
        $('#tabel-laporan-bap').DataTable();
    } );
</script>
@endsection