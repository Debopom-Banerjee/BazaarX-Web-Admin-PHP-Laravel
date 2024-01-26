@extends('backend.layouts.empty') 
@section('title', 'Requirements')
@section('content')


@if($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Error!</strong> {{ $message }}
    </div>
@endif

@if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> {{ $message }}
        
    </div>
@endif

<div class="container">
    <div class="card text-center">
        <div class="card-body">
            <img height="120" class="mb-4" src="{{ asset('storage/backend/logos/' . getSetting('app_logo')) }}" alt="Gofinx" >
            <h4>Please wait...</h4>

            <h6>
                Unlocking {{$requirement->title}} Lead.
            </h6>
            <p class="text-muted checkpoint-message">Creating secure payment link. Do not close this window or press back.</p>
            <br>
            <div>
                <i class="fa fa-spin fa-spinner fa-lg text-success"></i>
            </div>
            <form class="d-none" action="{{ route('panel.partner.leads.pay') }}" method="POST">
                @csrf
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{ env('API_RAZOR_KEY') }}"
                        data-amount="{{$price*100}}"
                        data-buttontext="Pay Amount"
                        data-name="GoFinx"
                        data-description="{{'Buying Lead $RID'.$requirement->id}}"
                        data-prefill.name="{{auth()->user()->name}}"
                        data-prefill.email="{{auth()->user()->email}}"
                        data-prefill.phone="{{auth()->user()->phone}}"
                        data-notes.requirementid="{{$requirement->id}}"
                        data-notes.userid="{{auth()->user()->id}}"
                        data-theme.color="#3f78e0"
                        data-image="https://www.gofinx.com/Transparent.png">
                </script>
            </form>
        </div>

        <div class="card-footer">
            <img style="width:50%;object-fit: contain" class="text-center" src="{{ asset('frontend/assets/images/checkout/payment-options.jpg')}}" alt="Gofinx" >
        </div>
        
       <div class="d-flex justify-content-center">
        <a href="{{route('panel.partner.leads.explore')}}" class="btn btn-link"><i class="fa fa-chevron-left "></i> GO BACK</a>
       </div>

    </div>

</div>


<script>

    setTimeout(() => {
        $('.razorpay-payment-button').trigger('click');
        $('.checkpoint-message').html('Verifying Payment. Do not close or press back button.')
    }, 1000);
</script>

@endsection
