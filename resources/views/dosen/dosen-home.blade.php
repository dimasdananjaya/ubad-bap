@extends('layouts.dosen')

@section('content')
<section id="dosen-home">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Dosen Home</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img class="img-fluid" src="{{asset('resources/logo/admin-home-bap.svg')}}">
                    <h4>Laporankan BAP</h4>
                    <p>Laporkan Berita Acara Perkuliahan</p>
                    <p><a class="btn btn-primary mb-5 mb-md-0" href="{{route('dosen.pilih.periode.laporan')}}">Pilih</a></p>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-->
    </div><!--container-->
</section>
@endsection