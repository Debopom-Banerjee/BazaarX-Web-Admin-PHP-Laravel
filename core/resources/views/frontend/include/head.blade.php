<title> {{ $meta_title ?? getSetting('seo_meta_title') }} </title>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta name="description" content="{{ $meta_description ?? getSetting('seo_meta_description') }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name='subject' content='{{$meta_motto}}'>
    <meta name='copyright' content='{{env('APP_NAME')}}'>
    <meta name='language' content='IN'>
    <meta name='robots' content='index,follow'>
    <meta name='abstract' content='@isset($meta_abstract){{$meta_abstract}}@endisset'>
    <meta name='topic' content='Business'>
    <meta name='summary' content='{{$meta_motto}}'>
    <meta name='Classification' content='Business'>
    <meta name='author' content='@isset($meta_author_name){{$meta_author_email}}@endisset'>
    <meta name='designer' content='Defenzelite'>
    <meta name='reply-to' content='@isset($meta_author_name){{$meta_author_name}}@endisset'>
    <meta name='owner' content='@isset($meta_reply_to){{$meta_reply_to}}@endisset'>
    <meta name='url' content='{{url()->current()}}'>

    <meta name="og:title" content="{{ $meta_title }}"/>
    <meta name="og:type" content="{{$meta_motto}}"/>
    <meta name="og:url" content="{{url()->current()}}"/>
    <meta name="og:image" content="@isset($meta_img){{$meta_img}}@endisset"/>
    <meta name="og:site_name" content="{{env('APP_NAME')}}"/>
    <meta name="og:description" content="{{ $meta_description ?? getSetting('seo_meta_description') }}"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href=" {{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ getBackendLogo(getSetting('app_favicon')) }}" />
    <link href=" {{ asset('frontend/assets/css/style.css')}}"  rel="stylesheet" type="text/css">
<link href=" {{asset('frontend/assets/vendor/icons/icofont.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('frontend/cdn.jsdelivr.net/npm/bootstrap-icons%401.8.1/font/bootstrap-icons.css')}}">


<link rel="stylesheet" href="{{ asset('backend/plugins/jquery-toast-plugin/dist/jquery.toast.min.css')}}">
<link href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}" rel="stylesheet" />
<link href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="bb8251c7f9efda90a45cb208-text/javascript"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}" type="bb8251c7f9efda90a45cb208-text/javascript"></script>

<script src="{{ asset('frontend/assets/js/beacon.min.js') }}" type="bb8251c7f9efda90a45cb208-text/javascript"></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039" integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g==" data-cf-beacon='{"rayId":"7eab0f672d383fc6","version":"2023.4.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>

<!--Start of Tawk.to Script--> <script type="text/javascript"> var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date(); (function(){ var s1=document.createElement("script"), s0=document.getElementsByTagName("script")[0]; s1.async=true; s1.src='https://embed.tawk.to/64e4355994cf5d49dc6bc031/1h8dn0qe6'; s1.charset='UTF-8'; s1.setAttribute('crossorigin','*'); s0.parentNode.insertBefore(s1,s0); })(); </script> <!--End of Tawk.to Script-->

<!-- Meta Pixel Code --> <script> !function(f,b,e,v,n,t,s) {if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)}; if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s)}(window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '6194964877289241'); fbq('track', 'PageView'); </script> <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=6194964877289241&ev=PageView&noscript=1" /></noscript> <!-- End Meta Pixel Code -->