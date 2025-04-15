@extends('layouts.app')

@section('body_class')
    page-login layout-full page-dark
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="page-content vertical-align-middle">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control empty" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        <label class="floating-label" for="email">Email</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert" style="font-size: 15px; color: #ff9800;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control empty" id="password" name="password">
                        <label class="floating-label" for="password">Password</label>
                        @error('password')
                        <span class="invalid-feedback" style="font-size: 15px; color: #ff9800;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group remember-div">
                        <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
                            <input type="checkbox" id="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="checkbox">Remember me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-classic">Sign in</button>
                </form>
            </div>
        </div>
@endsection
@section('script')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
