<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | {{ getSetting('app_name') }}</title>
	<link ref="stylesheets" href="https://cdn3.devexpress.com/jslib/22.1.3/css/dx.common.css" />
    <link ref="stylesheets" href="https://cdn3.devexpress.com/jslib/22.1.3/css/dx.light.css" />
	<!-- initiate head with meta tags, css and script -->
	@include('backend.include.head')

</head>
<body id="app" >
	<div class="wrapper">
		@if(!request()->routeIs('panel.setting.maintanance') == true)
			<div class="page-wrap">
				<div class="main-content">
					@include('backend.include.logged-in-as')
					<!-- yeild contents here -->
					@yield('content')
				</div>


				<!-- initiate chat section-->
				{{-- @include('backend.include.chat') --}}


				<!-- initiate footer section-->
				@include('backend.include.footer')

			</div>
		@endif
    </div>
    
	<!-- initiate modal menu section-->
	@include('backend.include.modalmenu')

	<!-- initiate scripts-->
	@include('backend.include.script')	
</body>
</html>