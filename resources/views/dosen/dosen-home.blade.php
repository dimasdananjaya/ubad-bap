@extends('layouts.dosen')

@section('content')
<section id="dosen-home">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Dosen Home</h2>
            <hr>
            <div class="row">
                <div class="col-lg-6 text-center">
                    <div class="card mt-3" style="height: 15rem !important;">
                        <img class="d-block mx-auto pr-2" src="{{asset('resources/logo/admin-home-bap.svg')}}">
                        <h4 class="text-center">Laporkan BAP</h4>
                        <p><a class="btn btn-primary d-block mx-auto btn-block" href="{{route('dosen.pilih.periode.laporan')}}">Pilih</a></p>
                    </div><!--card-->
                </div><!--col-->

                <div class="col-lg-6 text-center">
                    <div class="card mt-3" style="height: 15rem !important;">
                        <img class="d-block mx-auto pr-2" src="{{asset('resources/logo/login-page.svg')}}">
                        <h4 class="text-center">Ganti Password</h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success d-block mx-auto btn-block" data-toggle="modal" data-target="#gantiPasswordModal">
                            Pilih
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="gantiPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div><!--modal-header-->
                                <div class="modal-body">
                                {!!Form::open(['action'=>['PasswordChangeController@changePassword'], 'method'=>'POST'])!!}
                                    {{Form::label('password','Masukkan Password Baru :')}}
                                    {{Form::text('password','',['class'=>'form-control form-group','required'])}}
                                    {{Form::hidden('id_user',Auth::user()->id_user)}}
                                    {{Form::submit('Update',['class'=>'btn btn-success btn-block'])}}
                                {!!Form::close()!!}
                                </div><!--modal-body-->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div><!--modal-content-->
                        </div><!--modal-->
                    </div><!--card-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-->
    </div><!--container-->
</section>
@endsection