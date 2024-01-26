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
<style>
    .alert {
        padding: 0px 15px !important;
    }
</style>
@section('content')
    <div class="container-fluid h-100"  style="background-image:url('../frontend/assets/img/app-banner.png');background-size: cover;">
        <section class="d-flex align-items-center position-relative">
            <div class="container">
                @if(session()->has('success'))
                    <div class="alert alert-info">
                        {{ session()->get('success') }}
                    </div>
                @endif
                 <div class="row h-100">
                    <div class="col-12 col-lg-4 mx-auto"style="margin-top:80px;">
                        <div class="card form-signin p-4 rounded shadow ">
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                                        <span class="">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                                        {{ $error }}
                                        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                                            <span class="">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <a href="{{url('/')}}">
                                    <img src="{{ getBackendLogo(getSetting('app_white_logo')) }}" class="avatar avatar-small mb-4 d-block mx-auto" alt="website-logo" style="height: 90px;width:90px;">
                                </a>
                                <h5 class="mb-3 text-center" style="margin-top: -17px;">Reset your password</h5>

                                <div class="px-3">
                                    <p class="text-muted">Please enter your email address. You will receive a link to create a new password via email.</p>
                            
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}" required>
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <button class="btn btn-primary w-100" type="submit">Send</button>
                                </div>
        
                                <p class="mb-0 text-muted mt-3 text-center">© <script>document.write(new Date().getFullYear())</script> {{ getSetting('app_name') }}</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection