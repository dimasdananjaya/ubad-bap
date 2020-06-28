@extends('layouts.admin')

@section('content')
<section id="register-page">
<div class="row">
    
    <div class="col-lg-12">
        <div class="background">
            <h2 class="text-center">Halaman Kelola Users</h2>
            <img class="mx-auto d-block" src="{{asset('resources/logo/users.svg')}}">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="d-flex justify-content-center">
                            <div class="background">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid img-responsive register-img" src="{{asset('resources/logo/register-page.svg')}}" alt="Card image cap">
                                </div><!--end flex-->
                                <div class="background">
                                    <h3 class="text-center">Register</h3>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                
                                        <div class="form-group row">
                                            <label for="name" class="col-md-12 col-form-label">{{ __('Name') }}</label>
                
                                            <div class="col-md-12">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>
                
                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>
                
                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>
                
                                            <div class="col-md-12">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label for="level" class="col-md-12 col-form-label">{{ __('Level') }}</label>
                
                                            <div class="col-md-12">
                                                <select name="level" class="form-group form-control">
                                                    <option value="admin">Admin</option>
                                                    <option value="dosen">Dosen</option>
                                                </select>
                                            </div>
                                        </div>
                
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-modal mr-3">
                                                {{ __('Register') }}
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Batal</button>
                                        </div>

                                    </form>
                                </div><!--card body-->
                            </div><!--card-->
                        </div><!--flex-->
                    </div><!--content-->
                </div><!--dialog-->
            </div><!--modal fade-->

            <h3>Daftar Users</h3>
            <!-- Button trigger modal -->
            <hr>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                Tambah User
            </button>
            <table id="tabel-user" class="table table-striped table-hover table-responsive-sm table-responsive-md">
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Level</th>
                </thead>
                <tbody>
                    @foreach ($dataUser as $dtu)
                        <tr>
                            <td>{{$dtu->id_user}}</td>
                            <td>{{$dtu->name}}</td>
                            <td>{{$dtu->email}}</td>
                            <td>{{$dtu->pwd}}</td>
                            <td>{{$dtu->level}}</td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary mb-5 mb-md-0 mt-2" href="{{route('admin.home')}}">Kembali ke Home</a>
        </div><!--background-->
    </div><!--col-->
</div><!--row-->
</section>
<script>
    $(document).ready(function() {
        $('#tabel-user').DataTable();
    } );
</script>
@endsection