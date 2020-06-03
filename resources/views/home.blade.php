@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center">
                        <p style="color:black;">You are logged in as {{Auth::user()->level}}<br></p>

                        @if(Auth::user()->level == 'admin')
                        <a href="{{route('admin.home')}}" class="btn btn-primary">Kembali Ke Halaman Admin</a>
                        @else
                        <a href="{{route('dosen.home')}}" class="btn btn-primary">Kembali Ke Halaman Dosen</a>
                        @endif
                    </div><!--flex-->
                </div><!--card body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
</div>
@endsection
