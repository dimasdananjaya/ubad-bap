@extends('layouts.admin')

@section('content')
<section id="admin-show-laporan-bap-periode">
    <div class="container-fluid">
        <div class="card">
            <h2 class="text-center">Data BAP Periode : {{$periode->periode}}</h2>
            <img class="mx-auto d-block" src="{{asset('resources/logo/admin-home-bap.svg')}}">
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
                                {{Form::submit('Detail',['class'=>'btn btn-success btn-block'])}}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p><a class="btn btn-primary mb-5 mb-md-0 mt-4" href="{{route('admin.pilih.periode.laporan')}}">Kembali ke Pilih Periode</a></p>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <canvas id="canvas" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
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

    var nama = [@foreach($dataLaporanBAPUser as $name) '{{$name->name}}', @endforeach];
    var sks = [@foreach($dataLaporanBAPUser as $sks) {{$sks->total_sks}}, @endforeach];


    var barChartData = {
        labels: nama,
        datasets: [{
            backgroundColor: "rgba(220,220,220,0.5)",
            data: nama,
        }, {
            label: 'sks',
            backgroundColor: "rgba(151,187,205,0.5)",
            data: sks
        }]
    };


    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Chart SKS Mengajar'
                }
            }
        });

    };
    
</script>

@endsection