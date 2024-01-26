@extends('backend.layouts.main') 
@section('title', 'Lead')
@section('content')
@php
$breadcrumb_arr = [
    ['name'=>'Add Lead', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-grid bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Create New Lead')}}</h5>
                            <span>{{ __('Add a new record for Lead')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('backend.include.breadcrumb')
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('backend.include.message')
            <!-- end message area-->
            <div class="col-md-8 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Add Lead')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('panel.admin.lead.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="lead_type_id" value="19">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                                <label for="name" class="control-label">{{ 'Name' }} <span class="text-red">*</span> </label>
                                                <input class="form-control" name="name" type="text" id="name" placeholder="Enter Name" value="{{ isset($lead->name) ? $lead->name : ''}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group {{ $errors->has('owner_email') ? 'has-error' : ''}}">
                                                <label for="owner_email" class="control-label">{{ 'Email' }} </label>
                                                <input class="form-control" name="owner_email" type="email" id="owner_email" placeholder="Enter Email" value="{{ isset($lead->owner_email) ? $lead->owner_email : ''}}" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                                <label for="phone" class="control-label">{{ 'Phone' }} </label>
                                                <input class="form-control" name="phone" type="number" id="phone" placeholder="Enter Phone" value="{{ isset($lead->phone) ? $lead->phone : ''}}" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
                                                <label for="remark" class="control-label">{{ 'Remark' }} </label>
                                                <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" placeholder="Enter Remark" >{{ isset($lead->remark) ? $lead->remark : ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div>
                                        <label for="lead_source_id" class="control-label">{{ 'Source' }} <span class="text-red">*</span> </label>
                                        <div class="form-radio" style="height: 155px;overflow-y: auto;">
                                            @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 5) as $item)
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="lead_source_id" value="{{ $item->id }}">
                                                        <i class="helper"></i>{{ $item->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">                                    
                                    
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
    <script>
        $(document).ready(function(){
            $('#state, #country, #city').css('width','100%').select2();

            function getStates(countryId =  101) {
                $.ajax({
                url: '{{ route("world.get-states") }}',
                method: 'GET',
                data: {
                    country_id: countryId
                },
                success: function(res){
                    $('#state').html(res).css('width','100%').select2();
                }
                })
            }
            getStates(101);

            function getCities(stateId =  101) {
                $.ajax({
                url: '{{ route("world.get-cities") }}',
                method: 'GET',
                data: {
                    state_id: stateId
                },
                success: function(res){
                    $('#city').html(res).css('width','100%').select2();
                }
                })
            }
            $('#country').on('change', function(e){
            getStates($(this).val());
            })

            $('#state').on('change', function(e){
            getCities($(this).val());
            })

        });
    </script>
    @endpush
@endsection
