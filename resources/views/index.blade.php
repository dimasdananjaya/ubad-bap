@extends('layouts.app')

@section('content')
<section id="index-page" class="fdb-block">
    <div class="container d-flex justify-content-center">
      <div class="card">
        <div class="row">
          <div class="col text-center">
            <h3>Pelaporan BAP Online</h3>
            <p>Laporkan Berita Acara Perkuliahan Secara Online</p>
          </div><!--end col-->
        </div><!--end row-->

        <div class="d-flex justify-content-center">
          <img alt="image" class="img-responsive mt-2 index-img" src="{{url('/resources/logo/index-page.svg')}}">
        </div><!--end flex-->

        <div class="row">
          <div class="col-lg-12 mt-3">
            <div class="d-flex justify-content-center">
              <a class="mx-2 btn btn-success btn-round btn-md" href="{{ route('login') }}">Login</a>
            </div>
          </div><!--end col-->
        </div><!--end row-->
      </div><!--end card-->
    </div><!--end container-->
  </section>
@endsection