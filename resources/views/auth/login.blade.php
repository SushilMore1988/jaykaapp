@extends('layouts.app2')
@section('content')
<form action="{{ url('/authenticate') }}" method="post" id="signInform">
    {!! csrf_field() !!}
    <div class="mb-3 input-group">
        <input type="email" id="email"  class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
    </div>
    <div class="mb-4 input-group">
        <input type="password" id="password" class="form-control" name="password" placeholder="password">
    </div>
    
    @if ($captcha == "enable" && isset($captchaCredentials->site_key))
    <div class="mb-3 row">
        <div class="col-md-12">
            <div class="g-recaptcha" data-sitekey="{{ $captchaCredentials->site_key }}"></div>
        </div>
    </div>
    @endif

    <div class="form-group">
        <div class="float-left text-left col-6 col-sm-7 p-l-0">
            <div class="switch switch-primary d-inline m-r-10">
                <input type="checkbox" id="switch-p-1" name="remember">
                <label for="switch-p-1" class="cr"></label>
            </div>
            <label>{{ __('Remember me') }}</label>
        </div>

        <div class="float-right col-6 col-sm-5">
            <button class="btn btn-primary custom-btn-small" type="button" id="btnSubmit"><i class="comment_spinner spinner sign_in_spin fa fa-spinner fa-spin custom-btn-small display_none"></i><span id="spinnerText">{{ __('Sign In') }} </span></button>
        </div>
    </div>
    <p class="mb-2 text-left text-muted">{{ __('Forgot your password?') }} <a href="{{ url('/password/reset/admin') }}">{{ __('Reset') }}</a></p>
</form>
@endsection
@section('js')
<?php if ($captcha == "enable" && isset($captchaCredentials->plugin_url)) { ?>
    <script src="{{ $captchaCredentials->plugin_url }}"></script>
<?php } ?>
<script src="{{ asset('dist/js/custom/login.min.js') }}"></script>
@endsection
