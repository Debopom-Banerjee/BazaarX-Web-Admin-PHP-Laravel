@extends('backend.layouts.empty') 
@section('title', 'User Advisory')
@section('content')
@php
/**
 * User Advisory 
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
$breadcrumb_arr = [
    ['name'=>'Add User Advisory', 'url'=> "javascript:void(0);", 'class' => '']
]
@endphp
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
   <style>
        .error{
            color:red;
        }
        .parentForm:not(:first-of-type) {
            display: none
        }
       .previous-step{
            position: relative;
       }
        .next-step{
            position: relative;
        }
        #riskbtn{
            position: relative !important;
        }
        @media only screen and (max-width: 1023px){
            .wrapper .page-wrap .main-content {
                padding-right: 0;
                padding-bottom: 55px;
            }
        }
    
      
    </style>
    @endpush

    <div class="container-fluid ">
       {{-- step box start --}}
         @include('panel.user_advisories.steps.step')
       {{-- step box end --}}

        <form method="post" action="{{route('panel.user_advisories.store')}}" id="UserAdvisoryForm" >
            {{@csrf_field()}}
            {{-- profile form start --}}
                <div class="row parentForm " data-id="1" style="position: relative">
                    <div class="col-md-12">
                        <!-- start message area-->
                        @include('backend.include.message')
                        <!-- end message area-->
                        <div class="card ">
                            <div class="card-header">
                                <h3>Profile</h3>
                            </div>
                            <div class="card-body ">
                                <div class="row">                                                     
                                    <div class="col-md-12 col-12 "> 
                                        <div class="d-flex w-100 ">
                                            
                                            <div class="form-group w-50 m-2 ">
                                                <label for="first_name" class="control-label">
                                                    First Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input  class="form-control" name="name" type="text" id="first_name" value="{{old('name')}}" placeholder="First Name" required>
                                            </div>

                                            <div class="form-group w-50 m-2 {{ $errors->has('dob') ? 'has-error' : ''}}">
                                                <label for="dob" class="control-label">
                                                    Date of Birth
                                                    <span class="text-danger">*</span>
                                                </label>
                                                
                                                <input  class="form-control " name="dob" type="date" id="dob" max="<?php  echo date("Y-m-d"); ?>" value="{{old('dob')}}" placeholder="Date of Birth" required>
                                            </div>
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-12 col-12 ">
                                        <div class="d-flex w-100">
                                            <div class="form-group w-50 m-2">
                                                <label for="married" class="control-label">Are Yoy Married<span class="text-danger">*</span></label><br>
                                                <div class="d-flex" id="marriedRadioOptContainer">
        
                                                    <div class="form-check" >
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="Yes"  name="married" />
                                                            <h6 style="margin-top: 5px; font-size:12px">Yes</h6>
                                                        </label>
                                                    </div>
        
                                                    <div class="form-check ml-2">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" value="No" name="married" />
                                                            <h6 style="margin-top: 5px; font-size:12px">No</h6>
                                                        </label>
                                                    </div>
        
                                                </div>
                                            </div>  
                                            <div class="form-group w-50 m-2">
                                                <label for="smoke" class="control-label">Do You Smoke<span class="text-danger">*</span></label><br>
                                                <div class="d-flex" id="smokRadioOptContainer">
        
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input"  name="smoke" value="Yes" />
                                                            <h6 style="margin-top: 5px; font-size:12px">Yes</h6>
                                                        </label>
                                                    </div>
        
                                                    <div class="form-check ml-2">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="smoke" value="No"/>
                                                            <h6 style="margin-top: 5px; font-size:12px">No</h6>
                                                        </label>
                                                    </div>
        
                                                </div>
                                            </div> 
                                        </div>
                                    
                                    </div> 

                                    <div class="col-md-12 col-12 "> 
                                        <div class="d-flex w-100">
                                            <div class="form-group w-50 m-2">
                                                <label for="no_dependents">No of Dependents
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select required name="no_dependents" id="no_dependents" class="form-control select2" >
                                                        <option value="" readonly>Select </option>
                                                        <option value="1"> 1</option> 
                                                        <option value="2"> 2</option> 
                                                        <option value="3"> 3</option> 
                                                        <option value="4"> 4</option> 
                                                        <option value="5"> 5</option> 
                                                        <option value="6"> 6</option> 
                                                        <option value="7"> 7</option> 
                                                        <option value="8"> 8</option> 
                                                        <option value="9"> 9</option> 
                                                        <option value="10"> 10</option> 
                                                </select>
                                            </div>   

                                            <div class="form-group w-50 m-2">
                                                <label for="salary_business">Are You?
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select required name="salary_business" id="salary_business" class="form-control select2" >
                                                    <option value="" readonly>Select</option>
                                                    <option value="salaried">Salaried</option> 
                                                    <option value="business">Business</option> 
                                                </select>
                                            </div>  
                                        </div>  
                                    </div>   

                                    <div class="col-md-12 col-12 mb-4"> 
                                        <div class="d-flex w-100">
                                            <div class="form-group w-50 m-2 ">
                                                <label for="total_dependent" class="control-label">Total Age of Dependents<span class="text-danger">*</span></label>
                                                <input  class="form-control" name="total_dependent" type="number" id="total_dependent" value="{{old('total_dependent')}}" placeholder="Dependent" >
                                            </div>
                                        </div>  
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary next-step float-right ml-3" id="profilebtn">Next</button>
                    </div>
                    
                </div>
            {{-- profile form end --}}


            {{-- balance form start --}}
                <div class="row parentForm" data-id="2">
                    <div class="col-md-12">
                        <!-- start message area-->
                    @include('backend.include.message')
                        <!-- end message area-->
                        <div class="card ">
                            <div class="card-header">
                                <h3>Balance Sheet</h3>
                            </div>
                            <div class="card-body fieldset">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="assests" class="control-label">
                                                Select assets you own.
                                            </label>
                                            <select required name="assests[]" multiple id="assests" class="form-control select2" >
                                                <option disabled value="" readonly>Select Assets </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 16) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group">
                                            <label for="assets_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="assets_amount" type="number" id="assets_amount" value="{{old('assets_amount')}}" placeholder="Amount in total" >
                                        </div>
                                    </div> 

                                    <div class="col-md-6 col-12">
                                        <div class="form-group  {{ $errors->has('stock') ? 'has-error' : ''}}">
                                            <label for="stock" class="control-label">
                                                Select stocks you own. <span data-toggle="tooltip" data-placement="top" title="Demat account/Physical holding"></span>
                                            </label>
                                            <select required name="stock[]" multiple id="stock" class="form-control select2" >
                                                <option disabled value="" readonly>Select Stocks </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 17) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('stock_amount') ? 'has-error' : ''}}">
                                            <label for="stock_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="stock_amount" type="number" id="stock_amount" value="{{old('stock_amount')}}" placeholder="Amount in total" >
                                        </div>
                                    </div> 

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('debet_instrument') ? 'has-error' : ''}}">
                                            <label for="debet_instrument" class="control-label">
                                                Select debet you have.
                                            </label>
                                            <select required name="debet_instrument[]" multiple id="debet_instrument" class="form-control select2" >
                                                <option disabled value="" readonly>Select Debet </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 18) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('debet_instrument_amount') ? 'has-error' : ''}}">
                                            <label for="debet_instrument_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="debet_instrument_amount" type="number" id="debet_instrument_amount" value="{{old('debet_instrument_amount')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group  {{ $errors->has('assests') ? 'has-error' : ''}}">
                                            <label for="precious" class="control-label">
                                                Select precious you have. <span data-toggle="tooltip" data-placement="top" title="Physical gold,silver,jewellery etc"></span>
                                            </label>
                                            <select required name="precious[]" multiple id="precious" class="form-control select2" >
                                                <option disabled value="" readonly>Select Precious </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 19) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('precious_amount') ? 'has-error' : ''}}">
                                            <label for="precious_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="precious_amount" type="number" id="precious_amount" value="{{old('precious_amount')}}" placeholder="Amount in total" >
                                        </div>
                                    </div>
                                            
                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('other_liablities') ? 'has-error' : ''}}">
                                                <label for="other_liablities" class="control-label">
                                                Select other liablities you have.
                                            </label>
                                            <select required name="other_liablities[]" multiple id="other_liablities" class="form-control select2" >
                                                <option disabled value="" readonly>Select Liablities </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 20) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('other_liablities_amount') ? 'has-error' : ''}}">
                                            <label for="other_liablities_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="other_liablities_amount" type="number" id="other_liablities_amount" value="{{old('other_liablities_amount')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>
                                            
                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('personal_loan') ? 'has-error' : ''}}">

                                            <label for="personal_loan" class="control-label">
                                                Select loans you have.
                                            </label>
                                            <select required name="personal_loan[]" multiple id="personal_loan" class="form-control select2" >
                                                <option disabled value="" readonly>Select Loans </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 21) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('personal_loan_amount') ? 'has-error' : ''}}">
                                            <label for="personal_loan_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="personal_loan_amount" type="number" id="personal_loan_amount" value="{{old('personal_loan_amount')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>             

                                    <div class="col-md-6 col-12 mb-0 mb-lg-4">
                                        <div class="form-group {{ $errors->has('short_loan') ? 'has-error' : ''}}">
                                            <label for="short_loan" class="control-label">
                                                Select term loans you have.
                                            </label>
                                            <select required name="short_loan[]" multiple id="short_loan" class="form-control select2" >
                                                <option disabled value="" readonly>Select Term Loans </option>
                                                @foreach (fetchGet('App\Models\Category', 'where', 'category_type_id', '=', 22) as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option> 
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-4">
                                        <div class="form-group {{ $errors->has('short_loan_amount') ? 'has-error' : ''}}">
                                            <label for="short_loan_amount" class="control-label">Amount in total (in Rupees)</label>
                                            <input  class="form-control" name="short_loan_amount" type="number" id="short_loan_amount" value="{{old('short_loan_amount')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>      
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary previous-step float-right mr-2" >Previous</button>
                        <button type="button" class="btn btn-primary next-step float-right  mr-3" id="balancebtn">Next</button>
                    </div>
                
                </div>
            {{-- balance form end --}}

            {{-- goal form start --}}
                <div class="row parentForm " data-id="3">
                    <div class="col-md-12">
                        <!-- start message area-->
                        @include('backend.include.message')
                        <!-- end message area-->
                        <div class="card">
                            <div class="card-header">
                                <h3>Goals</h3>
                            </div>
                            <div class="card-body fieldset">
                                <div class="row">

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('vacation') ? 'has-error' : ''}}">
                                            <label for="vacation" class="control-label">What amount do you wish to save for vacations?</label>
                                            <input  class="form-control" name="vacation" type="number" id="vacation" value="{{old('vacation')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group  {{ $errors->has('vacation_years') ? 'has-error' : ''}}">

                                            <label for="vacation_years" class="control-label">When did you need it?</label>
                                            <input class="form-control datepicker" name="vacation_years" type="text" id="vacation_years" value="{{old('vacation_years')}}" placeholder="Enter Years" />
                                        </div>
                                    </div>
                                            
                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('collage_education') ? 'has-error' : ''}}">
                                            <label for="collage_education1" class="control-label">What amount do you wish to save for collage education</label>
                                            <input  class="form-control" name="collage_education1" type="number" id="collage_education1" value="{{old('collage_education1')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('user_detail') ? 'has-error' : ''}}">
                                            <label for="collage_education_year1" class="control-label">When did you need it?</label>
                                            <input  class="form-control datepicker" name="collage_education_year1" type="text" id="collage_education_year1" value="{{old('collage_education_year1')}}" placeholder="Enter Years"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('house_property') ? 'has-error' : ''}}">
                                            <label for="house_property" class="control-label">What amount do you wish to save for house property</label>
                                            <input  class="form-control" name="house_property" type="number" id="house_property" value="{{old('house_property')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group  {{ $errors->has('house_property_year') ? 'has-error' : ''}}">
                                            <label for="house_property_year" class="control-label">When did you need it?</label>
                                            <input  class="form-control datepicker" name="house_property_year" type="text" id="house_property_year" value="{{old('house_property_year')}}" placeholder="Enter Years"/>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 ">
                                        <div class="form-group {{ $errors->has('retirement') ? 'has-error' : ''}}">

                                            <label for="retirement" class="control-label">What amount do you wish to save for retirement</label>
                                            <input  class="form-control" name="retirement" type="number" id="retirement" value="{{old('retirement')}}" placeholder="Amount in total" >
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group  {{ $errors->has('retirement_year') ? 'has-error' : ''}}">

                                            <label for="retirement_year" class="control-label">When did you need it?</label>
                                            <input  class="form-control datepicker" name="retirement_year" type="text" id="retirement_year" value="{{old('retirement_year')}}" placeholder="Enter Years"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-0 mb-lg-4">
                                        <div class="form-group  {{ $errors->has('collage_education2') ? 'has-error' : ''}}">
                                            <label for="collage_education2" class="control-label">How much extra money do you need excluding the above?</label>
                                            <input  class="form-control" name="collage_education2" type="number" id="collage_education2" value="{{old('collage_education2')}}" placeholder="Amount in total" >

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-4">
                                        <div class="form-group  {{ $errors->has('collage_education_year2') ? 'has-error' : ''}}">
                                            <label for="collage_education_year2" class="control-label">When did you need it?</label>
                                            <input  class="form-control datepicker" name="collage_education_year2" type="text" id="collage_education_year2" value="{{old('collage_education_year2')}}" placeholder="Enter Years"/>

                                        </div>
                                    </div>
                                            

                                    {{-- <div class="col-md-12 col-12 "> 
                                        <div class="d-flex w-100 mb-4">
                                            <div class="form-group w-100 m-2 {{ $errors->has('liabilities') ? 'has-error' : ''}}">
                                                <label for="lib_Description" class="control-label">Description</label>
                                                <textarea class="form-control" name="lib_Description" rows="5" id="lib_Description"></textarea>
                                            </div>
                                        </div>  
                                    </div>   --}}
                            
                                    {{-- <div class="col-md-12 ml-auto">
                                        <div class="form-group m-2 d-flex justify-content-between ">
                                            <button type="submit" class="btn btn-primary previous-step">previous</button>
                                            <button type="submit" class="btn btn-primary next-step">Next</button>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary previous-step float-right mr-2" >Previous</button>
                        <button type="button" class="btn btn-primary next-step d-flex justify-content-end   mr-3" id="goalsbtn">Next</button>
                    </div>
                </div>
            {{-- goal form end --}}



            {{-- budget form start --}}
                <div class="row  parentForm " data-id="4">
                    <div class="col-md-12">
                        <!-- start message area-->
                    @include('backend.include.message')
                        <!-- end message area-->
                        <div class="card ">
                            <div class="card-header">
                                <h3>Budget</h3>
                            </div>
                            <div class="card-body fieldset">
                                    <div class="row">
                                            <div class="col-md-12">
                                                <h6 for="monthly" class="control-label ml-2">
                                                    Income  
                                                </h6>
                                                <hr>
                                            </div>
                                            <div class="col-md-6 col-12 "> 
                                                <div class="form-group">
                                                    <label for="salary_source" class="control-label">What is your salary in a year?</label>
                                                    <input  class="form-control" name="salary_source" type="number" id="salary_source" value="{{old('salary_source')}}" placeholder="Amount in total" required/>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 ">
                                                <div class="form-group">
                                                    <label for="other_source" class="control-label">What is your other source income?</label>
                                                    <input  class="form-control" name="other_source" type="number" id="other_source" value="{{old('other_source')}}" placeholder="Amount in total" required/>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <h6 for="monthly" class="control-label ml-2 mt-4">
                                                    Expenses  
                                                </h6>
                                                <hr>
                                            </div>
                                            <div class="col-md-6 col-12 "> 
                                                <div class="form-group">
                                                    <label for="loan_expenses" class="control-label">What is your outstanding loan? 
                                                        <span data-toggle="tooltip" data-placement="top"
                                                        title="Total Loan EMIs"></span></label>
                                                    <input  class="form-control" name="loan_expenses" type="number" id="loan_expenses" value="{{old('loan_expenses')}}" placeholder="Amount in total" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group  {{ $errors->has('insurance_expenses') ? 'has-error' : ''}}">
                                                    <label for="insurance_expenses" class="control-label">How much money is put into insurance
                                                        <span data-toggle="tooltip" data-placement="top" 
                                                        title="Insurance Premiums Paid">?</span></label>
                                                    <input  class="form-control" name="insurance_expenses" type="number" id="insurance_expenses" value="{{old('insurance_expenses')}}" placeholder="Amount in total" required/>

                                                </div>
                                            </div>

                                        <div class="col-md-6 col-12 mb-2"> 
                                            <div class="from-group">
                                                <label for="other_expenses" class="control-label">Other Expenses 
                                                    <span data-toggle="tooltip" data-placement="top" 
                                                    title="Other expenses(household,entertainment,etc)">?</span></label>
                                                <input  class="form-control" name="other_expenses" type="number" id="other_expenses" value="{{old('other_expenses')}}" placeholder="Amount in total" required/>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="tax" class="control-label">How much tax you are submiting
                                                    <span data-toggle="tooltip" data-placement="top" 
                                                    title="Tax">?</span>
                                                </label>
                                                <input  class="form-control" name="tax" type="number" id="tax" value="{{old('tax')}}" placeholder="Amount in total" required/>

                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-6 col-12 mb-2 mb-lg-4"> 
                                            <div class="from-group">
                                                <label for="life_insurance_amount" class="control-label">Life Insurance Coverage Amount 
                                                    <span data-toggle="tooltip" data-placement="top" 
                                                    title="Life Insurance Coverage Amount">?</span></label>
                                                <input  class="form-control" name="life_insurance_amount" type="number" id="life_insurance_amount" value="{{old('life_insurance_amount')}}" placeholder="Amount in total" required/>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-4">
                                            <div class="form-group">
                                                <label for="medical_amount" class="control-label">Medical Amount
                                                    <span data-toggle="tooltip" data-placement="top" 
                                                    title="medical_amount">?</span>
                                                </label>
                                                <input  class="form-control" name="medical_amount" type="number" id="medical_amount" value="{{old('medical_amount')}}" placeholder="Amount in total" required/>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary previous-step float-right mr-2" >Previous</button>
                        <button type="button" class="btn btn-primary next-step float-right mr-3" id="budgetbtn">Next</button>
                    </div>
                </div>
            {{-- budget form end --}}


            {{-- risk score form start --}}
                <div class="row parentForm" data-id="5">
                    <div class="col-md-12">
                        <!-- start message area-->
                    @include('backend.include.message')
                        <!-- end message area-->
                        <div class="card ">
                            <div class="card-header">
                                <h3>Risk Score</h3>
                            </div>
                            <div class="card-body fieldset">
                              
                                    <div class="row">
    
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="job_secure" class="control-label">1. Is your job secure</label><br>
                                                    <div class="d-flex" id="job_secure">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|No"  name="job_secure" />
                                                                <h6 style="margin-top: 5px; font-size:12px">No</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|Somewhat" name="job_secure" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Somewhat</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|Very secure" name="job_secure" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Very secure</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="paying_loans" class="control-label">2. Are you comformtable paying your EMIs?</label><br>
                                                    <div class="d-flex" id="paying_loans">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|1 - 2 years"  name="paying_loans"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">1 - 2 yrs</h6>
                                                            </label>
                                                        </div>
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|Yes" name="paying_loans" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Yes</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|I've no loans" name="paying_loans" />
                                                                <h6 style="margin-top: 5px; font-size:12px">I've no loans</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="bougth_stock" class="control-label">3. When did you first bought stocks</label><br>
                                                    <div class="d-flex" id="bougth_stock">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|1 - 2 years"  name="bougth_stock"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">1 - 2 yrs</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|2 - 5 years" name="bougth_stock" />
                                                                <h6 style="margin-top: 5px; font-size:12px">2 - 5 yrs</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|Less then 5yrs" name="bougth_stock" />
                                                                <h6 style="margin-top: 5px; font-size:12px"> Less then 5yrs</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="mutual_fund" class="control-label">4. How much % invested in stock/Equity mutual fund currently ?</label><br>
                                                    <div class="d-flex" id="mutual_fund">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|0 - 10%"  name="mutual_fund"/>
                                                                <h6 style="margin-top: 5px; font-size:12px">0 - 10%</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|20 - 50%" name="mutual_fund" />
                                                                <h6 style="margin-top: 5px; font-size:12px">20 - 50%</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|Less then 50%" name="mutual_fund" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Less then 50%</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="decling" class="control-label">5. If your holding decling by 20% what would you do ?</label><br>
                                                    <div class="d-flex" id="decling">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|Sell all"  name="decling"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">Sell all</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|Sell some" name="decling" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Sell some</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|Do nothing" name="decling" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Do nothing</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="married" class="control-label">6. How much do you save from income ?</label><br>
                                                    <div class="d-flex" id="save_income">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|Less then 10%" name="save_income"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">Less then 10%</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|10 - 30%" name="save_income" />
                                                                <h6 style="margin-top: 5px; font-size:12px">10 - 30%</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|More then 30%" name="save_income" />
                                                                <h6 style="margin-top: 5px; font-size:12px">More then 30%</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="invest" class="control-label">7. How long do you intend to invest for ?</label><br>
                                                    <div class="d-flex" id="invest">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|Less then 1 years" name="invest"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">Less then 1 yrs</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|1 - 3 years" name="invest" />
                                                                <h6 style="margin-top: 5px; font-size:12px">1 - 3 yrs</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|More then 3 years" name="invest" />
                                                                <h6 style="margin-top: 5px; font-size:12px">More then 3yrs</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="lost_bear" class="control-label">8. How much lost can you bear ?</label><br>
                                                    <div class="d-flex" id="lost_bear">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="1|Less then 10%"  name="lost_bear"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">Less then 10%</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|10 - 20%" name="lost_bear" />
                                                                <h6 style="margin-top: 5px; font-size:12px">10 - 20%</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|More then 20%" name="lost_bear" />
                                                                <h6 style="margin-top: 5px; font-size:12px">More then 20%</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="financial_risk" class="control-label">9. Are you willing to take financial risks ?</label><br>
                                                    <div class="d-flex" id="financial_risk">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label"> 
                                                                <input type="radio" class="form-check-input" value="1|Low"  name="financial_risk"  />
                                                                <h6 style="margin-top: 5px; font-size:12px">Low</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="2|Medium" name="financial_risk" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Medium</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|High" name="financial_risk" />
                                                                <h6 style="margin-top: 5px; font-size:12px">High</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                        <div class="col-md-12 col-12 ">
                                            <div class="d-flex w-100">
                                                <div class="form-group w-100 m-2">
                                                    <label for="avg_salary" class="control-label">10. Average growth expected in salary in next 5 years(per years) ?</label><br>
                                                    <div class="d-flex" id="avg_salary">
            
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"  name="avg_salary" value="1|Less then 8%" />
                                                                <h6 style="margin-top: 5px; font-size:12px">Less then 8%</h6>
                                                            </label>
                                                        </div>
            
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="avg_salary" value="2|8 - 15%" />
                                                                <h6 style="margin-top: 5px; font-size:12px">8 - 15%</h6>
                                                            </label>
                                                        </div>

                                                        <div class="form-check ml-2 mb-4">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" value="3|More then 15%" name="avg_salary" />
                                                                <h6 style="margin-top: 5px; font-size:12px">More then 15%</h6>
                                                            </label>
                                                        </div>
            
                                                    </div>
                                                </div>   
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary previous-step float-right mr-2" >Previous</button>
                        <button type="submit" class="btn btn-primary submit-form float-right  mr-2" id="riskbtn">Submit</button>
                    </div>    
                
                </div>
        </form>   
           {{-- risk score form end --}}
    </div>
    <!-- push external js -->
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="{{asset('backend/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('backend/js/form-advanced.js') }}"></script>
   
    <script>
    
        $(document).ready(function () {
                //profile form validation
                var nxt = false
                $('#profilebtn').click(function (e) {  
                    e.preventDefault();  
                    var first_name = $('#first_name').val();  
                    var dob = $('#dob').val();  
                    var married = document.getElementsByName('married');
                    var smoke = document.getElementsByName('smoke');
                    var no_dependent =  $('#no_dependents').val()
                    var salary = $('#salary_business').val()
                    var total_dependent  =  $('#total_dependent').val()
                    $(".error").remove();  
                    if(first_name.length < 1){  
                        $('#first_name').after('<span class="error">This field is required</span>');  
                    }  

                    if(dob.length < 1){  
                        $('#dob').after('<span class="error">This field is required</span>');  
                    }  
                    if (!(married[0].checked || married[1].checked)) {
                        $('#marriedRadioOptContainer').after('<span class="error">This field is required</span>');
                    }
                    
                    if (!(smoke[0].checked || smoke[1].checked)) {
                        $('#smokRadioOptContainer').after('<span class="error">This field is required</span>');  
                    } 
                    if(no_dependent.length < 1){  
                        $('#no_dependents').after('<span class="error">This field is required</span>');  
                    }  
                    if(salary.length < 1){  
                        $('#salary_business').after('<span class="error">This field is required</span>');  
                    }  
                    if(total_dependent.length < 1){  
                        $('#total_dependent').after('<span class="error">This field is required</span>');  
                    }  

                    $("input[type=radio]").each(function() {
             
                        if ($(this).attr("checked") != "checked") {
                        
                            $("#msg").html(
                        "<span class='alert alert-danger' id='error'>"
                        + "Please Choose atleast one</span>");
                                }
                    });
            
                    if($('.error').length){
                    nxt = false
                    }else{
                        nxt = true
                    }
                   

                });  

                 //Balance form validation
                $('#balancebtn').click(function(){
                    console.log('sd')
                    var assests = $('#assests').val()
                    var assets_amount = $('#assets_amount').val() 

                    var stock  = $('#stock').val()
                    var stock_amount = $('#stock_amount').val()
                    
                    var debet_instrument = $('#debet_instrument').val()
                    var debet_instrument_amount = $('#debet_instrument_amount').val()

                    var precious  = $('#precious').val()
                    var precious_amount = $('#precious_amount').val()

                    var other_liablities  = $('#other_liablities').val()
                    var other_liablities_amount = $('#other_liablities_amount').val()

                    var personal_loan = $('#personal_loan').val()
                    var personal_loan_amount = $('#personal_loan_amount').val()

                    var short_loan  = $('#short_loan').val()
                    var  short_loan_amount = $('#short_loan_amount').val()

                    $(".error").remove();  
                    if(assests.length < 1){  
                        $('#assests').after('<span class="error">This field is required</span>');  
                    }  

                    if(assets_amount.length < 1){  
                        $('#assets_amount').after('<span class="error">This field is required</span>');  
                    }  
                    if(stock.length < 1){  
                        $('#stock').after('<span class="error">This field is required</span>');  
                    }  
                    if(stock_amount.length < 1){  
                        $('#stock_amount').after('<span class="error">This field is required</span>');  
                    }  
                    if(debet_instrument.length < 1){  
                        $('#debet_instrument').after('<span class="error">This field is required</span>');  
                    }  
                    if(debet_instrument_amount.length < 1){  
                        $('#debet_instrument_amount').after('<span class="error">This field is required</span>');  
                    }  
                    if(precious.length < 1){  
                        $('#precious').after('<span class="error">This field is required</span>');  
                    }  
                    if(precious_amount.length < 1){  
                        $('#precious_amount').after('<span class="error">This field is required</span>');  
                    }  
                    
                    if(other_liablities.length < 1){  
                        $('#other_liablities').after('<span class="error">This field is required</span>');  
                    }  
                    if(other_liablities_amount.length < 1){  
                        $('#other_liablities_amount').after('<span class="error">This field is required</span>');  
                    } 
                    if(personal_loan.length < 1){  
                        $('#personal_loan').after('<span class="error">This field is required</span>');  
                    }  
                    if(personal_loan_amount.length < 1){  
                        $('#personal_loan_amount').after('<span class="error">This field is required</span>');  
                    }  
                    if(short_loan.length < 1){  
                        $('#short_loan').after('<span class="error">This field is required</span>');  
                    }  
                    if(short_loan_amount.length < 1){  
                        $('#short_loan_amount').after('<span class="error">This field is required</span>');  
                    }  
                    
                    if($('.error').length){
                    nxt = false
                    }else{
                        nxt = true
                    }



                })

                 //Goals form validation
                $('#goalsbtn').click(function(){
                     var vacation = $('#vacation').val()
                     var vacation_years =  $('#vacation_years').val()
                     var collage_education1 = $('#collage_education1').val()
                     var collage_education_year1 = $('#collage_education_year1').val()
                     var collage_education2 =  $('#collage_education2').val()
                     var collage_education_year2 = $('#collage_education_year2').val()
                     var house_property = $('#house_property').val()
                     var house_property_year = $('#house_property_year').val()
                     var retirement = $('#retirement').val()
                     var retirement_year = $('#retirement_year').val()


                     $(".error").remove();  
                        if(vacation.length < 1){  
                            $('#vacation').after('<span class="error">This field is required</span>');  
                        }  

                        if(vacation_years.length < 1){  
                            $('#vacation_years').after('<span class="error">This field is required</span>');  
                        }  
                        if(collage_education1.length < 1){  
                            $('#collage_education1').after('<span class="error">This field is required</span>');  
                        }  
                        if(collage_education_year1.length < 1){  
                            $('#collage_education_year1').after('<span class="error">This field is required</span>');  
                        }  
                        if(collage_education2.length < 1){  
                            $('#collage_education2').after('<span class="error">This field is required</span>');  
                        }  
                        if(collage_education_year2.length < 1){  
                            $('#collage_education_year2').after('<span class="error">This field is required</span>');  
                        }  
                        if(house_property.length < 1){  
                            $('#house_property').after('<span class="error">This field is required</span>');  
                        }  
                        if(house_property_year.length < 1){  
                            $('#house_property_year').after('<span class="error">This field is required</span>');  
                        }  
                        if(retirement.length < 1){  
                            $('#retirement').after('<span class="error">This field is required</span>');  
                        }  
                        if(retirement_year.length < 1){  
                            $('#retirement_year').after('<span class="error">This field is required</span>');  
                        }  

                        if($('.error').length){
                        nxt = false
                        }else{
                            nxt = true
                        }
                })
               

                //Budget form validation
                $('#budgetbtn').click(function(){
                        var salary_source = $('#salary_source').val()
                        var other_source = $('#other_source').val()
                        var loan_expenses = $('#loan_expenses').val()
                        var insurance_expenses = $('#insurance_expenses').val()
                        var other_expenses = $('#other_expenses').val()
                        var tax = $('#tax').val()
                        var life_insurance_amount = $('#life_insurance_amount').val()
                        var medical_amount = $('#medical_amount').val()

                        $(".error").remove();  
                        if(salary_source.length < 1){  
                            $('#salary_source').after('<span class="error">This field is required</span>');  
                        }  

                        if(other_source.length < 1){  
                            $('#other_source').after('<span class="error">This field is required</span>');  
                        }  
                        if(loan_expenses.length < 1){  
                            $('#loan_expenses').after('<span class="error">This field is required</span>');  
                        }  
                        if(insurance_expenses.length < 1){  
                            $('#insurance_expenses').after('<span class="error">This field is required</span>');  
                        }  
                        if(other_expenses.length < 1){  
                            $('#other_expenses').after('<span class="error">This field is required</span>');  
                        }  
                        if(tax.length < 1){  
                            $('#tax').after('<span class="error">This field is required</span>');  
                        }  
                        if(life_insurance_amount.length < 1){  
                            $('#life_insurance_amount').after('<span class="error">This field is required</span>');  
                        }  
                        if(medical_amount.length < 1){  
                            $('#medical_amount').after('<span class="error">This field is required</span>');  
                        }  

                        if($('.error').length){
                        nxt = false
                        }else{
                            nxt = true
                        }

                })


                // risk form validatiojn
                $('#riskbtn').click(function(e){
                    e.preventDefault()
                    var job_secure = document.getElementsByName('job_secure');
                    var paying_loans = document.getElementsByName('paying_loans');
                    var bougth_stock = document.getElementsByName('bougth_stock');
                    var mutual_fund = document.getElementsByName('mutual_fund');
                    var decling = document.getElementsByName('decling');
                    var save_income = document.getElementsByName('save_income');
                    var invest = document.getElementsByName('invest');
                    var lost_bear = document.getElementsByName('lost_bear');
                    var financial_risk = document.getElementsByName('financial_risk');
                    var avg_salary = document.getElementsByName('avg_salary');
                    $(".error").remove();  
                    if (!(job_secure[0].checked || job_secure[1].checked || job_secure[2].checked)) {
                        $('#job_secure').after('<span class="error">This field is required</span>');
                    }
                    if (!(paying_loans[0].checked || paying_loans[1].checked || paying_loans[2].checked)) {
                        $('#paying_loans').after('<span class="error">This field is required</span>');
                    }
                    if (!(bougth_stock[0].checked || bougth_stock[1].checked || bougth_stock[2].checked)) {
                        $('#bougth_stock').after('<span class="error">This field is required</span>');
                    }
                    if (!(mutual_fund[0].checked || mutual_fund[1].checked || mutual_fund[2].checked)) {
                        $('#mutual_fund').after('<span class="error">This field is required</span>');
                    }
                    if (!(decling[0].checked || decling[1].checked || decling[2].checked)) {
                        $('#decling').after('<span class="error">This field is required</span>');
                    }
                    if (!(save_income[0].checked || save_income[1].checked || save_income[2].checked)) {
                        $('#save_income').after('<span class="error">This field is required</span>');
                    }
                    if (!(invest[0].checked || invest[1].checked || invest[2].checked)) {
                        $('#invest').after('<span class="error">This field is required</span>');
                    }
                    if (!(lost_bear[0].checked || lost_bear[1].checked || lost_bear[2].checked)) {
                        $('#lost_bear').after('<span class="error">This field is required</span>');
                    }
                    if (!(financial_risk[0].checked || financial_risk[1].checked || financial_risk[2].checked)) {
                        $('#financial_risk').after('<span class="error">This field is required</span>');
                    }
                    if (!(avg_salary[0].checked || avg_salary[1].checked || avg_salary[2].checked)) {
                        $('#avg_salary').after('<span class="error">This field is required</span>');
                    }
                  
                    if($('.error').length){
                        nxt = false
                    }else{
                        $("#UserAdvisoryForm").submit();
                        nxt = true
                    }


                })


                var currentGfgStep, nextGfgStep, previousGfgStep;
                var opacity;
                var current = 1;
                var steps = $(".parentForm").length;
       
            
            $(".next-step").click(function () {
                if(nxt){
                    currentGfgStep = $(this).parent().parent();
                    nextGfgStep = $(this).parent().parent().next();
                    $("#progressbar li").eq($(".parentForm")
                        .index(nextGfgStep)).addClass("active");
                    nextGfgStep.show();
                    // currentGfgStep.removeClass('d-block')

                    currentGfgStep.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                    current++;
                }
                nxt  = false
                
            });
            $(".previous-step").click(function () {
                
                currentGfgStep = $(this).parent().parent();
                previousGfgStep = $(this).parent().parent().prev();
        
                $("#progressbar li").eq($(".parentForm")
                    .index(currentGfgStep)).removeClass("active");
        
                previousGfgStep.show();
                currentGfgStep.css({
                            'display': 'none',
                            'position': 'relative'
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var strYear = (new Date().getFullYear()) + 1;
                $(".datepicker").datepicker({
                    format: "yyyy",
                    startDate: strYear.toString(),
                    viewMode: "years", 
                    minViewMode: "years",
                    autoclose:true
                });
        });
    </script>
   
    @endpush
@endsection
