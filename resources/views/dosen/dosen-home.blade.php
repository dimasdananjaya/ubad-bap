@extends('layouts.dosen')

@section('content')
<section id="dosen-home">
    <div class="container">
        <div class="card">
            <h2 class="text-center">Dosen Home</h2>

            <hr>
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img class="d-block mx-auto" src="{{asset('resources/logo/admin-home-bap.svg')}}">
                    <h4>Laporankan BAP</h4>
                    <p>Laporkan Berita Acara Perkuliahan</p>
                    <p><a class="btn btn-primary mb-5 mb-md-0" href="{{route('dosen.pilih.periode.laporan')}}">Pilih</a></p>
                </div><!--col-->

                <div class="col-lg-6 text-center">
                    <img class="d-block mx-auto" src="{{asset('resources/logo/login-page.svg')}}">
                    <h4>Ganti Password</h4>
                    <p>Ganti Password Login</p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#gantiPasswordModal">
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
                        </div>
                        <div class="modal-body">
                        {!!Form::open(['action'=>['PasswordChangeController@changePassword'], 'method'=>'POST'])!!}
                            {{Form::label('password','Masukkan Password Baru :')}}
                            {{Form::text('password','',['class'=>'form-control form-group','required'])}}
                            {{Form::hidden('id_user',Auth::user()->id_user)}}
                            {{Form::submit('Update',['class'=>'btn btn-success btn-block'])}}
                        {!!Form::close()!!}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-->

        
    </div><!--container-->
</section>
@endsection