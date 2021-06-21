@extends('admin.auth.layouts.app')
@section('content')
    <div class="container px-4 py-5 mx-auto d-flex justify-content-center">
        <div class="card card2">
            <div class="my-auto mx-md-5 px-md-5 right">
            <div class="row justify-content-center my-auto">
                <div class="col-12 my-1">
                    <div class="row justify-content-center px-3 mb-3"> <img id="logo" src="{{url('/').'/'.SiteSetting('logo')}}"> </div>
                    <h3 class="mb-5 text-center heading">{{ SiteSetting('name') }}</h3>
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="mb-3">
                        <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                        
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="row justify-content-center my-3 px-3"> <button class="btn-block btn-color">{{ __('Login') }}</button> </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection


