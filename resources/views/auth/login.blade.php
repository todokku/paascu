@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-11">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">{{ __('Login') }}</h4>
                <div class="card-body">

</br>
<div class="container">
  <div class="row">
    <div class="col-sm-5">

            <center><img src="{{ asset('img/paascu.png') }}"></center></br>
            <center><h3>PAASCU Accounting System</h3></center>
    </div>
    <div class="col-sm-7">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label offset-md-1">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-12 col-form-label offset-md-1">{{ __('Password') }}</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-1">
                                <button type="submit" class="btn btn-outline-success float-right">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Reset Password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </br>
    </div>
  </div>
</div>






















                </div>
            </div>
        </div>
    </div>
</div>
@endsection
