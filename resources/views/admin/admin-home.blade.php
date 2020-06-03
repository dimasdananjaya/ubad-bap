@extends('layouts.admin')

@section('content')
<section id="admin-home">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Admin Home</h2>
            <hr>
            <div class="row">
                <div class="col-12 ml-auto col-md-6 col-lg-5">
                    <img class="img-fluid" src="{{asset('resources/logo/admin-home-bap.svg')}}">
                    <h4>Laporan BAP</h4>
                    <p>Lihat Seluruh Laporan BAP Dosen</p>
                    <p><a class="btn btn-primary mb-5 mb-md-0" href="{{route('pilih.periode.laporan')}}">Pilih</a></p>
                </div><!--col-->

                <div class="col-12 ml-auto col-md-6 col-lg-5">
                    <img class="img-fluid" src="{{asset('resources/logo/admin-home-periode.svg')}}">
                    <h4>Setting Periode</h4>
                    <p>Kelola Periode Pelaporan</p>
                    <p><a class="btn btn-primary mb-5 mb-md-0" href="{{route('pilih.periode.laporan')}}">Pilih</a></p>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-->
    </div><!--container-->
</section>
@endsection