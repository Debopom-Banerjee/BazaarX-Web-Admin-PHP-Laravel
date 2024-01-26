@extends('backend.layouts.app')

@section('content')
<div class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center justify-content-center" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
                {{-- <div class="card-header">{{ __('Verify Your Email Address') }}</div> --}}

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <div class="logo-img">
                        <img height="60" src="{{ getBackendLogo(getSetting('app_white_logo'))}}" class="header-brand-img mb-4" title="DZE"> 
                     </div>
                     <h4>Verify your email Address</h4>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
