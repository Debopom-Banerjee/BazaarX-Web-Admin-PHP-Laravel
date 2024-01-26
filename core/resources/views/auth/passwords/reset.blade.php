@extends('frontend.layouts.assets')
@if(getSetting('recaptcha') == 1)
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endif

@section('meta_data')
    @php
        $meta_title = 'Forgot Password | '.getSetting('app_name');
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');
		$meta_abstract = '' ?? getSetting('site_motto');
		$meta_author_name = '' ?? 'Defenzelite';
		$meta_author_email = '' ?? 'support@defenzelite.com';
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');
		$meta_img = ' ';
    @endphp
@endsection
@section('content')
    <div class="bg-home d-flex align-items-center position-relative" style="background: url('assets/images/shape01.png') center;">
            <div class="container h-100 mx-5">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" >
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href=""><img width="150"  src="{{ asset('img/logo.png')}}" alt=""></a>
                            </div>
                            <h3>{{ __('Reset Password') }}</h3>
                            <p>{{ __('Enter your new password.') }}</p>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.update') }}">
                                <input type="hidden" name="token" value="{{ $token }}">
                                @csrf
                                <div class="form-group mb-2">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your email address" name="email" value="{{ old('email') }}" required>
                                    <i class="ik ik-mail"></i>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group mb-2">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                                    <i class="ik ik-lock"></i>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                    <i class="ik ik-eye-off"></i>
                                </div>

                                <div class="mt-2">
                                    <button class="btn btn-primary d-block w-100">{{ __('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
