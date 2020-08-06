@extends('layouts.admin')

@section('content')
<section id="admin-pilih-periode">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Pilih Periode</h2>
            <hr>
            <table class="table table-sm table-hover table-striped" id="tabel-periode">
                <thead>
                    <th>Periode</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($dataPeriode as $dtprd)
                    <tr>
                        <td>{{$dtprd->periode}}</td>
                        <td>
                            {!!Form::open(['action'=>['PimpinanController@showBAPPeriodePimpinan', $dtprd->id_periode], 'method'=>'GET'])!!}
                                {{Form::hidden('id_periode',"$dtprd->id_periode")}}
                                {{Form::submit('Pilih',['class'=>'btn btn-success btn-block'])}}
                            {!!Form::close()!!}
                        </td>          
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--card-->
    </div><!--container-->
</section>
<script>
    $(document).ready(function() {
        $('#tabel-periode').DataTable();
    } );
</script>
@endsection