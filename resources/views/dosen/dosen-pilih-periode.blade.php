@extends('layouts.dosen')

@section('content')
<section id="dosen-pilih-periode">
    <div class="container">
        <div class="card">
            <h2 class="text-center"><b>Pilih Periode</b></h2>
            <img class="img-fluid d-block mx-auto" src="{{asset('resources/logo/dosen-pilih-periode.svg')}}">
            <hr>
            <table class="table table-sm table-hover table-striped" id="tabel-periode">
                <thead>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($dataPeriode as $dtprd)
                    <tr>
                        <td>{{$dtprd->periode}}</td>
                        <td>{{$dtprd->status}}</td>
                        <td>
                            {!!Form::open(['action'=>['BAPLaporanController@kelolaLaporanPeriodeDosen', $dtprd->id_periode], 'method'=>'GET'])!!}
                                {{Form::hidden('id_periode',"$dtprd->id_periode")}}
                                {{Form::submit('Pilih',['class'=>'btn btn-success btn-block'])}}
                            {!!Form::close()!!}
                        </td>          
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary mb-5 mb-md-0 mt-4" href="{{route('dosen.home')}}">Kembali ke Home</a>
        </div><!--card-->
    </div><!--container-->
</section>
<script>
    $(document).ready(function() {
        $('#tabel-periode').DataTable();
    } );
</script>
@endsection