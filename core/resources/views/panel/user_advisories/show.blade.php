@extends('backend.layouts.main') 
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
    <style>
        .error{
            color:red;
        }
        .parentForm:not(:first-of-type) {
            display: none
        }
        table {
        table-layout: fixed;
        width: 100%;
    }
       

      
    </style>
    @endpush

    <div class="container-fluid ">
        <div class="card">
            <div class="card-header">
              <h6>User Detail</h6>
            </div>

            @php 
             $user_detail = json_decode($user_advisory->user_detail);
            @endphp
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Name</td>
                        <td>{{$user_detail->name ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Date of birth</td>
                        <td>{{$user_detail->dob ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Married</td>
                        <td>{{$user_detail->married ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>No of Dependents</td>
                        <td>{{$user_detail->no_dependents ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Do you Smoke</td>
                        <td>{{$user_detail->smoke ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Total Age of Dependents</td>
                        <td>{{$user_detail->total_dependent ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                        <td>Are you Salaried/Business</td>
                        <td>{{$user_detail->salary_business ?? 'N/A'}}</td>
                      </tr>
                    </tbody>
                  </table>
             
            </div>
        </div>

        <div class="card">
            <div class="card-header">
               <h6>Assets</h6>
            </div>
            @php 
             $asset = json_decode($user_advisory->assests);
            @endphp
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Properties/Cars/Bikes/Other Assets</td>
                        <td>{{$asset->assests}}</td>
                        <td>{{$asset->assets_amount}}</td>
                      </tr>
                      <tr>
                        <td>Stocks/MF/Derivatives</td>
                        <td>{{$asset->stock}}</td>
                        <td>{{$asset->stock_amount}}</td>
                      </tr>
                      <tr>
                        <td>FD/PD/PPF/Other debt instruments</td>
                        <td>{{$asset->debet_instrument}}</td>
                        <td>{{$asset->debet_instrument_amount}}</td>
                      </tr>
                      <tr>
                        <td>Gold,Precious,CryptoCurrencies</td>
                        <td>{{$asset->precious}}</td>
                        <td>{{$asset->precious_amount}}</td>
                      </tr>
                      <tr>
                        <td>Cash/Other liquid asset</td>
                        <td>{{$asset->other_liablities}}</td>
                        <td>{{$asset->other_liablities_amount}}</td>
                      </tr>
                    </tbody>
                  </table>
             
            </div>
        </div>

        <div class="card">
            <div class="card-header">
             <h6>Liabilities</h6>
            </div>
            @php 
            $liabilities = json_decode($user_advisory->liabilities);
           @endphp
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                      <tr >
                        <td>Loans (Home,Personal,Car,other)</td>
                        <td>{{$liabilities->personal_loan}}</td>
                        <td>{{$liabilities->personal_loan_amount}}</td>
                      </tr>
                      <tr >
                        <td>Short term loan (Credit card etc.)</td>
                        <td>{{$liabilities->short_loan}}</td>
                        <td>{{$liabilities->short_loan_amount}}</td>
                      </tr>
                      
                    </tbody>
                  </table>
             
            </div>
        </div>

        <div class="card">
            <div class="card-header">
              <h6>Goals</h6>
            </div>
            @php 
            $goal = json_decode($user_advisory->goals);
           @endphp
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Vacation</td>
                        <td>{{$goal->vacation}}</td>
                        <td>{{$goal->vacation_years}}</td>
                      </tr>
                      <tr>
                        <td>Collage Education</td>
                        <td>{{$goal->collage_education1}}</td>
                        <td>{{$goal->collage_education_year1}}</td>
                      </tr>
                      <tr>
                        <td>Collage Education</td>
                        <td>{{$goal->collage_education2}}</td>
                        <td>{{$goal->collage_education_year2}}</td>
                      </tr>
                      <tr>
                        <td>House Property</td>
                        <td>{{$goal->house_property}}</td>
                        <td>{{$goal->house_property_year}}</td>
                      </tr>
                      <tr>
                        <td>Retirement</td>
                        <td>{{$goal->retirement}}</td>
                        <td>{{$goal->retirement_year}}</td>
                      </tr>
                     
                    </tbody>
                  </table>
             
            </div>
        </div>

        <div class="card">
            <div class="card-header">
              <h6>Budget</h6>
            </div>
            @php 
            $budget = json_decode($user_advisory->budget);
           @endphp
            <div class="card-body p-0">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Salary</td>
                        <td>{{$budget->salary_source}}</td>
                      </tr>
                      <tr>
                        <td>Other Source</td>
                        <td>{{$budget->other_source}}</td>
                      </tr>
                      <tr>
                        <td>Loan</td>
                        <td>{{$budget->loan_expenses}}</td>
                      </tr>
                      <tr>
                        <td>Insurance</td>
                        <td>{{$budget->insurance_expenses}}</td>
                      </tr>
                      <tr>
                        <td>Otder Expenses</td>
                        <td>{{$budget->other_expenses}}</td>
                      </tr>
                      <tr>
                        <td>Tax</td>
                        <td>{{$budget->tax}}</td>
                      </tr>
                      
                    </tbody>
                  </table>
             
            </div>
        </div>

        <div class="card">
            <div class="card-header">
              <h6>Risk Score</h6>
            </div>
            @php 
            $risk = json_decode($user_advisory->risk_assessment);
           @endphp
            <div class="card-body p-0">
                <table class="table user_advisory_show_table">
                    <tbody>
                      <tr>
                        <td>1.Is your job secure</td>
                        <td>{{$risk->job_secure}}</td>
                      </tr>
                      <tr>
                        <td>2.Are you comformtable paying your EMIs?</td>
                        <td>{{$risk->paying_loans}}</td>
                      </tr>
                      <tr>
                        <td>3.When did you first bought stocks</td>
                        <td>{{$risk->bougth_stock}}</td>
                      </tr>
                      <tr>
                        <td>4.How much % invested in stock/Equity mutual fund currently ?</td>
                        <td>{{$risk->mutual_fund}}</td>
                      </tr>
                      <tr>
                        <td>5.If your holding decling by 20% what would you do ?</td>
                        <td>{{$risk->decling}}</td>
                      </tr>
                      <tr>
                        <td>6.How much do you save from income ?</td>
                        <td>{{$risk->save_income}}</td>
                      </tr>
                      <tr>
                        <td>7.How long do you intend to invest for ?</td>
                        <td>{{$risk->invest}}</td>
                      </tr>
                      <tr>
                        <td>8.How much lost can you bear ?</td>
                        <td>{{$risk->lost_bear}}</td>
                      </tr>
                      <tr>
                        <td>9.Are you willing to take financial risks ?</td>
                        <td>{{$risk->financial_risk}}</td>
                      </tr>
                      <tr>
                        <td>10.Average growth expected in salary in next 5 years(per years) ?</td>
                        <td>{{$risk->avg_salary}}</td>
                      </tr>
                      
                    </tbody>
                  </table>
             
            </div>
        </div>
    
    </div>
@endsection
