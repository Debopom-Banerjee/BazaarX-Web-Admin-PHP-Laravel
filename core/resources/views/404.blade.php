@extends('backend.layouts.empty') 
@section('title', '404')
@section('content')
<style>
    .b-not_found {
        padding-bottom: 100px;
        padding-top: 50px;
        position: fixed;
    top: 50%; left: 50%;
    width: 100%;
    transform: translate(-50%,-50%);
    }

    .b-not_found .b-page_header h1 {
        margin: auto;
        padding: 25px 0;
        text-align: center;
        text-transform: uppercase;
        color: #1B1919;
        opacity: .8;
        letter-spacing: 3px;
        font-size: 50px;
        font-weight: 700;
    }

    .b-not_found h2 {
        font-size: 36px;
        letter-spacing: 1px;
        line-height: 1.5;
        color: #1B1919;
        font-weight: bold;
    }

    .b-not_found p {
        line-height: 1.7;
        color: #8E8E8E;
        margin-bottom: 20px;
    }

    @media (max-width: 990px) {
        .b-not_found h2 {
            font-size: 28px;
        }
    }

    @media (max-width: 767px) {
        .b-not_found .b-page_header h1 {
            font-size: 35px;
            padding: 15px 0;
        }

        .b-not_found h2 {
            font-size: 22px;
        }
    }
</style>
<!-- ============================================= -->
<section id="about-page" class="about-page-section pb-0">
    <div class="container">
        <div class="row h-100">
            <div class="b-not_found w-100 ">
                <div class="text-center">
                    <div class="b-page_header">
                        <h1 class="page-title">Oops! Something went wrong</h1>
                    </div>
                    <h2><b>THIS IS SOMEWHAT EMBARRASSING, ISN’T IT?</b></h2>
                    <p>
                        It looks like nothing was found at this location. 
                    </p>
                    <div >
                        <a href="{{url('/')}}" class="btn btn-outline-primary">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    <!-- Start of footer section

@endsection
