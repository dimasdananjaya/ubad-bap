@extends('layouts.admin')

@section('content')
<section id="admin-detail-laporan-bap">
    <div class="container">
        <div class="card">
            <p class="card-text"><b>Detail Laporan : {{$name->name}} <br> BAP Periode : {{$periode->periode}}</b></p>

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
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach ($dataLaporanBAPPeriode as $dlbp)
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td>{{$dlbp->tanggal}}</td>
                        <td>{{$dlbp->mata_kuliah}}</td>
                        <td>{{$dlbp->jam}}</td>
                        <td>{{$dlbp->sks}}</td>
                        <td>{{$dlbp->materi}}</td>
                        <td>{{$dlbp->jumlah_mahasiswa}}</td>
                        <td><img src="{{ asset('storage/file/'.$dlbp->file) }}" alt="{{$dlbp->file}}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!!Form::open(['action'=>['BAPLaporanController@showBAPPeriodeAdmin', $dlbp->id_periode], 'method'=>'GET'])!!}
                {{Form::hidden('id_periode',"$dlbp->id_periode")}}
                {{Form::submit('Kembali Ke Laporan Periode',['class'=>'btn btn-primary mt-4'])}}
            {!!Form::close()!!}
        </div><!--card-->
    </div><!--container-->
</section>    
<script>
    $(document).ready(function() {
        var table = $('#tabel-laporan-bap').DataTable( {
            lengthChange: false,
            buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: function () {
                    printCounter++;
 
                    if ( printCounter === 1 ) {
                        return 'This is the first time you have printed this document.';
                    }
                    else {
                        return 'You have printed this document '+printCounter+' times';
                    }
                },
                messageBottom: null
            }
        ]
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