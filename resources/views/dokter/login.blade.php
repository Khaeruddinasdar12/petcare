@extends('layouts.app')

@section('title') | Dokter - Login @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-muted text-center">Daftar Sebagai Dokter</h2>
        </div>
        
        <div class="col-md-4">
            <img src="{{asset('dokter-hewan.png')}}" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-8">


            <div class="card-body">
                <form method="POST" action="{{route('dokter.postlogin')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                            <a class="btn btn-link" href="{{ route('dokter.register') }}">
                                Daftar sebagai dokter
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection