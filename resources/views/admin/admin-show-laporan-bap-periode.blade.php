@extends('layouts.admin')

@section('content')
<section id="admin-show-laporan-bap-periode">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Data BAP Periode : {{$periode->periode}}</h2>

            <hr>
            <table class="table table-lg table-hover table-striped table-responsive-sm table-responsive-md" id="tabel-laporan-bap">
                <thead>
                    <th>No.</th>
                    <th>Nama</th>
                    <th class="text-center">Total SKS Mengajar</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($dataLaporanBAPUser as $dlbu)
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td>{{$dlbu->name}}</td>
                        <td class="text-center">{{$dlbu->total_sks}}</td>
                        <td class="text-center">
                            {!!Form::open(['action'=>['BAPLaporanController@detailLaporanBAP', $dlbu->id_user], 'method'=>'GET'])!!}
                                {{Form::hidden('id_periode',"$periode->id_periode")}}
                                {{Form::hidden('id_user',"$dlbu->id_user")}}
                                {{Form::submit('Pilih',['class'=>'btn btn-success btn-block'])}}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><a class="btn btn-primary mb-5 mb-md-0" href="{{route('admin.pilih.periode.laporan')}}">Kembali ke Pilih Periode</a></p>
        </div><!--card-->
    </div><!--container-->
</section>
@endsection