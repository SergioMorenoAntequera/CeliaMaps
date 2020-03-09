@extends('layouts.master')

@section('title', 'Celia Maps')

@section('header')
@endsection

@section('content')

<div class="container">

   

    <div class="wholePanel" style="height:50%">
        <div class="leftPanel widht:40%">
            
            <div class="content">               

                <img src="{{url('/img/icons/userWhite.png')}}" width="50%" alt="" class="img-fluid">
            </div>            
        </div>
        <div class="rightPanel">
           <!-- <div class="mt-5">{{ __('Login') }}</div> -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Correo Electrónico') }}</label>

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
                    <label for="password" class="col-md-4 col-form-label text-md-right text-dark">{{ __('Contraseña') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recordar') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0" >
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-success" href="{{ route('password.request') }}">
                                {{ __('olvidaste la contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
               
            </div>
</div>
</div>

@endsection
