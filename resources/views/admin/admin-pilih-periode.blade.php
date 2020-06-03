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
                    <tr>
                        <td>Januari 2020</td>
                        <td><a class="btn btn-success" href="#">Pilih</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!--container-->
</section>
@endsection