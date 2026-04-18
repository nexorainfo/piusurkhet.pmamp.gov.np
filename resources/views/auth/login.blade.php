@extends('layouts.guest')

@section('content')
    <!-- end col -->
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="form-wrapper border p-4 rounded shadow">
                <h3 class="mb-15 text-center">{{ __('Login') }}</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="email">{{ __('Email') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email"
                                    name="email" id="email" placeholder="{{ __('Email') }}" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" @error('password') class="form-control is-invalid" @enderror
                                    name="password" id="password" placeholder="{{ __('Password') }}" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-xxl-6 col-lg-12 col-md-6">
                            <div class="form-check checkbox-style mb-30">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    value="" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <!-- end col -->
                        @if (Route::has('password.request'))
                            <div class="col-xxl-6 col-lg-12 col-md-6">
                                <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                </div>
                            </div>
                        @endif
                        <!-- end col -->
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </form>
            </div>
        </div>
    </div>
@endsection
