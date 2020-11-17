@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
        <h3 class="text-center" style="font-weight:bold;color:#8b64aa">Welcome to  Luna Wellbeing</h3>
            <div class="card mt-3" style="background:#fff;border-color:none;">
                <div class="card-header text-center" style="background:#8b64aa ">
                <h2 style="color:#fff;font-weight:bold;  ">Login</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4  col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                   

                        <div class="form-group  ">
                            <div class="col-md-8 offset-md-2 text-center">
                                <button type="submit" class="btn btn-primary w-50" style="background:#8b64aa ;border:none">
                                    {{ __('Login') }}
                                </button>                    
                            </div>

                        
                    </form>
                </div>
            </div>
            
        </div>
     
    </div>
   
</div>
@endsection
