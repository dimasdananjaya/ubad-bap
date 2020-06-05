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
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($dataPeriode as $dtprd)
                    <tr>
                        <td>{{$dtprd->periode}}</td>
                        <td>{{$dtprd->status}}</td>
                        <td>
                            <a class="btn btn-success" style="color:#fff;float:left; margin-right:20px;">Show</a>
                        </td>          
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--card-->
    </div><!--container-->
</section>
@endsection