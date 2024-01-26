@extends('frontend.layouts.main')

@section('meta_data')
    @php
		$meta_title = 'Setting | '.getSetting('app_name');		
		$meta_description = '' ?? getSetting('seo_meta_description');
		$meta_keywords = '' ?? getSetting('seo_meta_keywords');
		$meta_motto = '' ?? getSetting('site_motto');		
		$meta_abstract = '' ?? getSetting('site_motto');		
		$meta_author_name = '' ?? 'Defenzelite';		
		$meta_author_email = '' ?? 'support@defenzelite.com';		
		$meta_reply_to = '' ?? getSetting('frontend_footer_email');		
		$meta_img = ' ';		
		$customer = 1;		
	@endphp
@endsection

@section('content')
        <!-- Profile Start -->
   <!-- Hero Start -->
<section class="bg-profile d-table w-100 bg-primary" style="background: url('assets/images/account/bg.png') center center;">
    <div class="container">
        @include('frontend.customer.include.profile-header')
    </div><!--ed container-->
</section><!--end section-->
<!-- Hero End -->

<!-- Profile Start -->
<section class="section mt-60">
    <div class="container mt-lg-3">
        <div class="row">
            @include('frontend.customer.include.sidebar')
            <div class="col-lg-8 col-12">
                <div class="card border-0 rounded shadow">
                    <ul class="nav nav-pills custom-pills mb-0 wrapper_pills bg-white" id="pills-tab" role="tablist" style="border-bottom: 1px solid #ccc8c8;">
                        <li class="nav-item ">
                            <a data-active="my_info" class="mr-2 customer_tabs btn pills-btn active-swicher  active" href="#">{{ __('My Info')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="address_info" class="mr-2 customer_tabs active-swicher pills-btn btn  " >{{ __('Address')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="ekyc_info" class="mr-2 customer_tabs active-swicher pills-btn btn  " >{{ __('Ekyc')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-active="notification" class="mr-2 customer_tabs active-swicher pills-btn btn ">{{ __('Notification')}}</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="customer_card card-my_info">
                            <h5 class="text-md-start text-center">Personal Detail :</h5>

                            <div class="mt-3 text-md-start text-center d-sm-flex">
                                <img src="{{ getAuthProfileImage(auth()->user()->avatar ) }}" class="avatar float-md-left avatar-medium rounded-circle shadow me-md-4" alt="">
                                
                                <div class="mt-md-4 mt-3 mt-sm-0">
                                    <a href="javascript:void(0)" id="changeProfileModal" class="btn btn-primary mt-2">Change Picture</a>
                                </div>
                            </div>
                            
                                <form class="row mt-4" action="{{ route('customer.update.info',auth()->id()) }}" method="post">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input name="name" id="first" type="text" class="form-control ps-5" placeholder="First Name :" value="{{ auth()->user()->name }}">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="phone" class="fea icon-sm icons"></i>
                                                <input name="phone" id="phone" type="number" class="form-control ps-5" placeholder="Phone :" value="{{ auth()->user()->phone}}">
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input readonly name="email" id="email" type="email" class="form-control ps-5" value="{{ auth()->user()->email }}" placeholder="Your email :">
                                            </div>
                                        </div> 
                                    </div><!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Occupation</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="bookmark" class="fea icon-sm icons"></i>
                                                <input name="occupation" id="occupation" type="text" class="form-control ps-5" placeholder="Occupation :" value="{{ auth()->user()->occupation }}">
                                            </div>
                                        </div> 
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Bio</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="message-circle" class="fea icon-sm icons"></i>
                                                <textarea name="bio" id="comments" rows="4" class="form-control ps-5" placeholder="Bio :">{{ auth()->user()->bio }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="submit" id="submit" class="btn btn-primary" value="Save Changes">
                                    </div><!--end col-->
                                </form><!--end row-->
                          
                        </div>
             
                        <div class="mt-3 customer_card card-address_info ">
                            
                            <div class="d-flex justify-content-between">
                                <h5>Address :</h5>
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary add-address">Add Address</a>
                            </div>
                            <div class="border-bottom pb-4">
                                <div class="row mt-2">
                                    @forelse ($addresses as $address)
                                        @php
                                            $address_decoded = json_decode($address->details,true) ?? '';
                                        @endphp
                                        <div class="col-lg-6">
                                            <div class="m-1 p-2 border rounded">
                                                <div class="mb-2">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h6 class="m-0 p-0">{{ $address_decoded['type'] == 0 ? 'Home' : 'Office' }} Address:</h6>
                                                        <div>
                                                            <a href="javascript:void(0)" class="text-primary editAddress h5 mb-0" title=""  data-id="{{ $address  }}"
                                                                data-original-title="Edit"><i class="uil uil-edit"></i></a>
                                                            <a href="{{ route('customer.address.destroy',$address->id) }}"
                                                                class="text-primary delete-item h5 mb-0" title=""
                                                                data-original-title="delete"><i class="uil uil-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pt-4 border-top">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <div>
                                                            <p class="h6 text-muted">{{ $address_decoded['address_1'] }}</p>
                                                            <p class="h6 text-muted">{{ $address_decoded['address_2'] }}</p>
                                                            <p class="h6 text-muted">
                                                                {{ CountryById($address_decoded['country']) }},
                                                                {{ StateById( $address_decoded['state']) }}, 
                                                                {{ CityById( $address_decoded['city']) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty  
                                        <div class="col-lg-8 mx-auto text-center">
                                            @php
                                                $empty_msg = 'No Addresses yet!';
                                            @endphp
                                            @include('frontend.empty')
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            
                        </div>

                        <div class="mt-3 customer_card card-ekyc_info ">
                            
                            <div class="d-flex justify-content-between">
                                <h5>Ekyc :</h5>
                                @if ($user_kyc->status == 0)
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary ekyc-btn">Fill now</a>
                                @elseif($user_kyc->status == 1)  
                                    <div class="alert alert-success">Ekyc Verified</div> 
                               
                                @elseif($user_kyc->status == 2)  
                                    <div class="alert alert-danger">Ekyc Rejected</div> 
                                @else
                                    <div class="alert alert-danger">Under Approval</div>
                                @endif
                            </div>
                            <div class="border-bottom pb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{-- @dump($ekyc->document_type) --}}
                                            <label class="form-label">Document Type</label>
                                            <div class="form-icon position-relative">
                                                <select disabled class="form-control" name="document_type" id="">
                                                    <option value="" aria-readonly="true">Select Document Type</option>
                                                        <option @if(isset($ekyc) && $ekyc['document_type'] == "Pan Card") selected @endif value="Pan Card" readonly>PAN CARD</option>

                                                    <option @if(isset($ekyc) && $ekyc['document_type'] == "Aadhar Card") selected @endif value="Aadhar Card" readonly>AADHAR CARD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Document Number</label>
                                            <div class="form-icon position-relative">
                                                <input disabled name="document_number" type="text" class="form-control" value="{{ $ekyc['document_number'] ?? ' ' }}" placeholder="Enter Document Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">  
                                        <div class="mb-3">
                                            <label class="form-label">Document Front Attactment</label>
                                            <div class="form-icon position-relative">
                                                @if ($ekyc && $ekyc['document_front'] != null)
                                                    <a href="{{ asset($ekyc['document_front']) ?? '' }}" target="_blank">
                                                        <span class="badge bg-danger mt-2 p-2"><i class="uil uil-eye pr-2"></i>View Attachment</span>
                                                    </a>    
                                                @endif 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Document Back Attactment</label>
                                            <div class="form-icon position-relative">
                                                @if ($ekyc && $ekyc['document_back'] != null)
                                                        <a href="{{ asset($ekyc['document_back']) ?? '' }}" target="_blank">
                                                        <span class="badge bg-danger mt-2 p-2"><i class="uil uil-eye pr-2"></i>View Attachment</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                            
                        <div class="mt-3 customer_card"> 
                            <h5>Change password :</h5>
                            <form>
                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Old password :</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control ps-5" placeholder="Old password" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">New password :</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control ps-5" placeholder="New password" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Re-type New password :</label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control ps-5" placeholder="Re-type New password" required="">
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-lg-12 mt-2 mb-0">
                                        <button class="btn btn-primary">Save password</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div>
                      
                        <div class="rounded shadow mt-4 customer_card card-notification">
                            <div class="p-4 border-bottom">
                                <h5 class="mb-0">Account Notifications :</h5>
                            </div>
        
                            <div class="p-4">
                                <div class="d-flex justify-content-between pb-4">
                                    <h6 class="mb-0">When someone mentions me</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="noti1">
                                        <label class="form-check-label" for="noti1"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-4 border-top">
                                    <h6 class="mb-0">When someone follows me</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" checked id="noti2">
                                        <label class="form-check-label" for="noti2"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-4 border-top">
                                    <h6 class="mb-0">When shares my activity</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="noti3">
                                        <label class="form-check-label" for="noti3"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-4 border-top">
                                    <h6 class="mb-0">When someone messages me</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="noti4">
                                        <label class="form-check-label" for="noti4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="rounded shadow mt-4 customer_card">
                            <div class="p-4 border-bottom">
                                <h5 class="mb-0">Marketing Notifications :</h5>
                            </div>
        
                            <div class="p-4">
                                <div class="d-flex justify-content-between pb-4">
                                    <h6 class="mb-0">There is a sale or promotion</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="noti5">
                                        <label class="form-check-label" for="noti5"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-4 border-top">
                                    <h6 class="mb-0">Company news</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="noti6">
                                        <label class="form-check-label" for="noti6"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-4 border-top">
                                    <h6 class="mb-0">Weekly jobs</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" checked id="noti7">
                                        <label class="form-check-label" for="noti7"></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between py-4 border-top">
                                    <h6 class="mb-0">Unsubscribe News</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" checked id="noti8">
                                        <label class="form-check-label" for="noti8"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="rounded shadow mt-4 customer_card">
                            <div class="p-4 border-bottom">
                                <h5 class="mb-0 text-danger">Delete Account :</h5>
                            </div>
        
                            <div class="p-4">
                                <h6 class="mb-0">Do you want to delete the account? Please press below "Delete" button</h6>
                                <div class="mt-4">
                                    <button class="btn btn-danger">Delete Account</button>
                                </div><!--end col-->
                            </div>
                        </div>
                    </div>
                </div>

                
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Profile Setting End -->
    @include('frontend.modal.update-profile-picture')  
    @include('frontend.modal.add-address')
    @include('frontend.modal.edit-address')
    @include('frontend.modal.ekyc')
@endsection

@push('script')
    <script>
        $('.customer_card').hide();
        $('.card-my_info').show();
           $('.customer_tabs').on('click',function(){
            $('.customer_tabs').removeClass('active');
              $(this).addClass('active');
               var data = $(this).data('active');
               $('.customer_card').hide();
               $('.card-'+data).show();
           });
           $('#changeProfileModal').on('click',function(){
                $('#profilePicture').modal('show');
           });
           $('.ekyc-btn').on('click',function(){
                $('#ekycVerification').modal('show');
           });
  



    function getStates(countryId = 101) {
        $.ajax({
            url: "{{ route('world.get-states') }}",
            method: 'GET',
            data: {
                country_id: countryId
            },
            success: function(res) {
                $('#state').html(res).css('width', '100%');
            }
        })
    }
    function getCities(stateId = 101) {
        $.ajax({
            url: "{{ route('world.get-cities') }}",
            method: 'GET',
            data: {
                state_id: stateId
            },
            success: function(res) {
                $('#city').html(res).css('width', '100%');
            }
        })
    }
    function getEditStates(countryId = 101) {
            $.ajax({
                url: "{{ route('world.get-states') }}",
                method: 'GET',
                data: {
                    country_id: countryId
                },
                success: function(res) {
                    $('#stateEdit').html(res).css('width', '100%');
                }
            })
        }

        function getEditCities(stateId = 101) {
            $.ajax({
                url: "{{ route('world.get-cities') }}",
                method: 'GET',
                data: {
                    state_id: stateId
                },
                success: function(res) {
                    $('#cityEdit').html(res).css('width', '100%');
                }
            })
        }
    getStates();
    $(document).ready(function () {
        $('.add-address').on('click', function () {
            $('#addAddressModal').modal('show');
        });

        $('#country').on('change', function() {
            getStates($(this).val());
        });

        $('#state').on('change', function() {
            getCities($(this).val());
        });
        $('#countryEdit').on('change', function() {
            getEditStates($(this).val());
        });

        $('#stateEdit').on('change', function() {
            getEditCities($(this).val());
        });
    });

        $('.editAddress').click(function(){
          var  address = $(this).data('id');
          if(address.type == 0){
              $('.homeInput').attr("checked", "checked");
            }else{
                $('.officeInput').attr("checked", "checked");
          }
          var details = jQuery.parseJSON(address.details);
          $('#id').val(address.id);
          $('#user_id').val(address.user_id);
          $('#type').val(address.type);
          $('#address_1').val(details.address_1);
          $('#address_2').val(details.address_2);
          $('#countryEdit').val(details.country).change();
          
          setTimeout(() => {
              $('#stateEdit').val(details.state).change();
              setTimeout(() => {
                  $('#cityEdit').val(details.city).change();
                }, 500);
            }, 500);
            $('#editAddressModal').modal('show');
        });


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

            function updateURL(key,val){
                var url = window.location.href;
                var reExp = new RegExp("[\?|\&]"+key + "=[0-9a-zA-Z\_\+\-\|\.\,\;]*");

                if(reExp.test(url)) {
                    // update
                    var reExp = new RegExp("[\?&]" + key + "=([^&#]*)");
                    var delimiter = reExp.exec(url)[0].charAt(0);
                    url = url.replace(reExp, delimiter + key + "=" + val);
                } else {
                    // add
                    var newParam = key + "=" + val;
                    if(!url.indexOf('?')){url += '?';}

                    if(url.indexOf('#') > -1){
                        var urlparts = url.split('#');
                        url = urlparts[0] +  "&" + newParam +  (urlparts[1] ?  "#" +urlparts[1] : '');
                    } else {
                        url += "?" + newParam;
                    }
                }
                window.history.pushState(null, document.title, url);
            }

            $('.active-swicher').on('click', function() {
                var active = $(this).attr('data-active');
                updateURL('active',active);
            });

</script>

@endpush