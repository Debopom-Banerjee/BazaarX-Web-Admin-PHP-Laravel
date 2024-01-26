@extends('backend.layouts.main') 
@section('title', $user->name)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-minicolors/jquery.minicolors.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/plugins/datedropper/datedropper.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit User')}}</h5>
                            <span>{{ __('Create new user, assign roles & permissions')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('User')}}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- clean unescaped data is to avoid potential XSS risk -->
                                {{ clean($user->name, 'titles')}}
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('backend.include.message')
            <!-- end message area-->
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('panel.update-user', $user->id) }}" >
                        @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Username')}}<span class="text-red">*</span></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ clean($user->name, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email')}}<span class="text-red">*</span></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required value="{{ clean($user->email, 'titles')}}" required>
                                        <div class="help-block with-errors"></div>
    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Contact Number')}}<span class="text-red">*</span></label>
                                        <input id="phone" type="number" class="form-control" name="phone" placeholder="Enter Contact Number"  required value="{{ $user->phone }}" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">{{ __('Password')}}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password">
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password')}}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">{{ __('Gender')}}<span class="text-red">*</span></label>
                                        <div class="form-radio">
                                            <form>
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="gender" value="Male"   {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                                        <i class="helper"></i>{{ __('Male')}}
                                                    </label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="gender" value="Female"  {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                                        <i class="helper"></i>{{ __('Female')}}
                                                    </label>
                                                </div>
                                            </form>
                                        </div>                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role" required >{{ __('Assign Role')}}<span class="text-red">*</span></label>
                                        {!! Form::select ('role', $roles, $user_role->id??'' ,[ 'class'=>'form-control select2', 'placeholder' => 'Select Role','id'=> 'role', 'required'=>'required']) !!}
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dob">{{ __('DOB')}}</label>
                                        <input class="form-control" type="date" name="dob" placeholder="Select your date" value="{{ $user->dob }}" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="country">{{ __('Country')}}<span class="text-red">*</span></label>
                                        <select name="country" id="country" class="form-control select2" required>
                                            <option value="" readonly>{{ __('Select Country')}}</option>
                                            @foreach (\App\Models\Country::all() as  $country)
                                                <option value="{{ $country->id }}" @if($user->country != null) {{ $country->id == $user->country ? 'selected' : '' }} @elseif($country->name == 'India') selected @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">{{ __('State')}}<span class="text-red">*</span></label> 
                                        <select name="state" id="state" class="form-control select2" required>
                                            @if($user->state != null)
                                                <option value="{{ $user->state }}" selected>{{ fetchFirst('App\Models\State', $user->state, 'name') }}</option>
                                            @endif
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">{{ __('City')}}<span class="text-red">*</span></label>
                                        <select name="city" id="city" class="form-control select2" required>
                                            @if($user->city != null)
                                                <option value="{{ $user->city }}" selected>{{ fetchFirst('App\Models\City', $user->city, 'name') }}</option>
                                            @endif
                                        </select> 
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label for="pincode">{{ __('Pincode')}}<span class="text-red">*</span></label>
                                        <input id="pincode" type="number" class="form-control" name="pincode"  placeholder="Enter Pincode"  required value="{{ $user->pincode }}" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('Status')}}<span class="text-red">*</span>  </label>
                                                                                
                                        <select required name="status" class="form-control select2"  >
                                            <option value="" readonly>{{ __('Select Status')}}</option>
                                            @foreach (getStatus() as $index => $item)
                                                <option value="{{ $item['id'] }}" {{ $user->status == $item['id'] ? 'selected' :'' }}>{{ $item['name'] }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">{{ __('Address')}}<span class="text-red">*</span></label>
                                        <textarea id="address" type="text" class="form-control"  name="address" required  placeholder="Enter Address" >{{ $user->address }}  </textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control-right float-right">{{ __('Update')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('backend/plugins/select2/dist/js/select2.min.js') }}"></script>
        <!--get role wise permissiom ajax script-->
        <script src="{{ asset('backend/js/get-role.js') }}"></script>
        <script src="{{ asset('backend/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/datedropper/datedropper.min.js') }}"></script>
        <script src="{{ asset('backend/js/form-picker.js') }}"></script>
        <script>
           
           function getStates(countryId = 101) {
				$.ajax({
					url: '{{ route("world.get-states") }}',
					method: 'GET',
					data: {
						country_id: countryId
					},
					success: function(res) {
						$('#state').html(res).css('width', '100%').select2();
					}
				})
			}
			
			function getCities(stateId = 101) {
				$.ajax({
					url: '{{ route("world.get-cities") }}',
					method: 'GET',
					data: {
						state_id: stateId
					},
					success: function(res) {
						$('#city').html(res).css('width', '100%').select2();
					}
				})
			}
    
        	// Country, City, State Code
			$('#state, #country, #city').css('width', '100%').select2();
			
			$('#country').on('change', function(e) {
				getStates($(this).val());
			})
		
			$('#state').on('change', function(e) {
				getCities($(this).val());
			})

			 // this functionality work in edit page
			function getStateAsync(countryId) {
				return new Promise((resolve, reject) => {
					$.ajax({
						url: '{{ route("world.get-states") }}',
						method: 'GET',
					data: {
						country_id: countryId
					},
					success: function (data) {
						$('#state').html(data);
						$('.state').html(data);
					resolve(data)
					},
					error: function (error) {
					reject(error)
					},
				})
				})
			}
    
			function getCityAsync(stateId) {
				if(stateId != ""){
					return new Promise((resolve, reject) => {
						$.ajax({
							url: '{{ route("world.get-cities") }}',
							method: 'GET',
							data: {
								state_id: stateId
							},
							success: function (data) {
								$('#city').html(data);
								$('.city').html(data);
							resolve(data)
							},
							error: function (error) {
							reject(error)
							},
						})
					})
				}
			}
            $(document).ready(function(){
            var country = "{{ $user->country }}";
			var state = "{{ $user->state }}";
			var city = "{{ $user->city }}";

            if(state){
                getStateAsync(country).then(function(data){
                    $('#state').val(state).change();
                    $('#state').trigger('change');
                });
			}
			if(city){
                $('#state').on('change', function(){
                    if(state == $(this).val()){
                        getCityAsync(state).then(function(data){
                            $('#city').val(city).change();
                            $('#city').trigger('change');
                        });
                    }
                });
			}
            }); 

        </script>
    @endpush
@endsection
