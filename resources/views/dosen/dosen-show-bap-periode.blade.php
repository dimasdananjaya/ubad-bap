@extends('layouts.dosen')

@section('content')
<section id="dosen-show-bap-periode">
    <div class="container-fluid">
        <div class="background">
            <h2 class="text-center"><b>Kelola Data BAP Periode : {{$periode->periode}}</b></h2>
            <img class="img-fluid d-block mx-auto" src="{{asset('resources/logo/laporan-bap-dosen.svg')}}">
            <hr>

            <h4><b>Total SKS : @foreach ($totalSKS as $tsks) {{$tsks->totalSKS}}@endforeach</b></h4>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#tambahLaporanBapModal">
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
                            {!!Form::open(['action'=>'BAPLaporanController@storeLaporanBap', 'method'=>'POST', 'files' => true])!!}
                                {{Form::label('tanggal','Tanggal :')}}
                                {{Form::date('tanggal','',['class'=>'form-control form-group','placeholder'=>'dd/mm/yyyy','required'])}}
                                {{Form::label('mata_kuliah','Mata Kuliah :')}}
                                {{Form::text('mata_kuliah','',['class'=>'form-control form-group','placeholder'=>'','required'])}}
                                {{Form::label('jam','Jam :')}}
                                {{Form::text('jam','',['class'=>'form-control form-group','placeholder'=>'Jam','required'])}}
                                {{Form::label('sks','SKS :')}}
                                {{Form::number('sks','',['class'=>'form-control form-group','placeholder'=>'sks','required'])}}
                                {{Form::label('materi','Materi :')}}
                                {{Form::text('materi','',['class'=>'form-control form-group','placeholder'=>'Materi','required'])}}
                                {{Form::label('jumlah_mahasiswa','Jumlah Mahasiswa :')}}
                                {{Form::number('jumlah_mahasiswa','',['class'=>'form-control form-group','placeholder'=>'Jumlah Mahasiswa','required'])}}
                                {{Form::label('file','File :')}}
                                {{Form::file('file',['class'=>'form-control-file form-group'])}}
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

            <table class="table table-sm table-bordered table-hover text-center table-responsive-sm table-responsive-md" id="tabel-laporan-bap">
                <thead>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Mata Kuliah</th>
                    <th>Jam</th>
                    <th>SKS</th>
                    <th>Materi</th>
                    <th>Jumlah Mahasiswa</th>
                    <th>Gambar</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach ($dataLaporanBAPPeriode as $dlbp)
                    <tr>
                        <td></td>
                        <td>{{$dlbp->tanggal}}</td>
                        <td>{{$dlbp->mata_kuliah}}</td>
                        <td>{{$dlbp->jam}}</td>
                        <td>{{$dlbp->sks}}</td>
                        <td>{{$dlbp->materi}}</td>
                        <td>{{$dlbp->jumlah_mahasiswa}}</td>
                        <td><img src="{{ asset('storage/file/'.$dlbp->file) }}" alt="{{$dlbp->file}}"></td>
                        <td>
                            <a class="btn btn-success" style="color:#fff;float:center;" data-toggle="modal" data-target="#bap-edit-modal{{$dlbp->id_bap}}">Edit</a>
                        </td>
                        <td>
                            {!!Form::open(['action'=>['BAPLaporanController@deleteLaporanBap', $dlbp->id_bap], 'method'=>'POST','id'=>'form-delete-bap'.$dlbp->id_bap])!!}
                                {{ Form::hidden('id_bap',$dlbp->id_bap) }}
                                {{ Form::hidden('file',$dlbp->file) }}
                                {{Form::submit('Hapus',['class'=>'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </td>          
                        <!-- Modal Edit BAP-->
                        <div class="modal fade" id="bap-edit-modal{{$dlbp->id_bap}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2>Edit Data BAP</h2>   
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">                  
                                        {!!Form::open(['action'=>['BAPLaporanController@updateLaporanBap', $dlbp->id_bap], 'method'=>'PUT','files' => true])!!}
                                            {{Form::label('tanggal','Tanggal :')}}
                                            {{Form::text('tanggal',$dlbp->tanggal,['class'=>'form-control form-group','placeholder'=>'dd/mm/yyyy','required'])}}
                                            {{Form::label('mata_kuliah','Mata Kuliah :')}}
                                            {{Form::text('mata_kuliah',$dlbp->mata_kuliah,['class'=>'form-control form-group','placeholder'=>'','required'])}}
                                            {{Form::label('jam','Jam :')}}
                                            {{Form::text('jam',$dlbp->jam,['class'=>'form-control form-group','placeholder'=>'Jam','required'])}}
                                            {{Form::label('sks','SKS :')}}
                                            {{Form::text('sks',$dlbp->sks,['class'=>'form-control form-group','placeholder'=>'Materi','required'])}}
                                            {{Form::label('materi','Materi :')}}
                                            {{Form::text('materi',$dlbp->materi,['class'=>'form-control form-group','placeholder'=>'Materi','required'])}}
                                            {{Form::label('jumlah_mahasiswa','Jumlah Mahasiswa :')}}
                                            {{Form::number('jumlah_mahasiswa',$dlbp->jumlah_mahasiswa,['class'=>'form-control form-group','placeholder'=>'Jumlah Mahasiswa','required'])}}
                                            {{Form::label('file','File :')}}
                                            {{Form::file('file',['class'=>'form-control-file form-group'])}}
                                            {{Form::hidden('id_user',Auth::user()->id_user)}}
                                            {{Form::hidden('id_periode',$periode->id_periode)}}
                                            {{Form::hidden('file_lama',$dlbp->file)}}
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
            <a class="btn btn-primary mb-5 mb-md-0 mt-2" style="width: 10em;" href="{{route('dosen.home')}}">Kembali ke Home</a>
        </div><!--card-->
    </div><!--container-->
</section>
<script>
    $(document).ready(function() {
        var table = $('#tabel-laporan-bap').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
        } );
    
        table.buttons().container()
            .appendTo( '#tabel-laporan-bap_wrapper .col-md-6:eq(0)' );

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } );
</script>
@endsection