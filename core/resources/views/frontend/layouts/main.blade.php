<!DOCTYPE html>
<html lang="en">

<head>
	 @yield('meta_data')
   	@include('frontend.include.head')
   {{-- @laravelPWA --}}
</head>

	<body>
		<div>
			<!-- initiate header-->
			@if(!session()->has('mob'))
				@include('frontend.include.countdown')
				@include('frontend.include.header')
				@include('frontend.include.mobile-header')
			@endif

			
			<div class="main-content">
				@yield('content')
			</div>
			<!-- initiate footer section-->
			@include('frontend.include.footer')
			@if(!session()->has('mob'))
				<div class="mobile-sidebar">
					@include('frontend.include.mobile-bottom-bar')
				</div>
			@endif
		</div>
		
		<!-- initiate scripts-->
		@include('frontend.include.script')	
		@stack('script')
	</body>
</html>