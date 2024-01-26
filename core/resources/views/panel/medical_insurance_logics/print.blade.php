@extends('backend.layouts.empty') 
@section('title', 'Medical Insurance Logics')
@section('content')
@php
/**
 * Medical Insurance Logic 
 *
 * @category  zStarter
 *
 * @ref  zCURD
 * @author    Defenzelite <hq@defenzelite.com>
 * @license  https://www.defenzelite.com Defenzelite Private Limited
 * @version  <zStarter: 1.1.0>
 * @link        https://www.defenzelite.com
 */
@endphp
   

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                     
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr>                                      
                                    <th>Family Income</th>
                                    <th>Insurance Amount</th>
                                    <th>Of Family Members</th>
                                    <th>Coverage Required For Family</th>
                                    <th>Approx Premium</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($medical_insurance_logics->count() > 0)
                                    @foreach($medical_insurance_logics as  $medical_insurance_logic)
                                        <tr>
                                            <td>{{$medical_insurance_logic['family_income'] }}</td>
                                             <td>{{$medical_insurance_logic['insurance_amount'] }}</td>
                                             <td>{{$medical_insurance_logic['of_family_members'] }}</td>
                                             <td>{{$medical_insurance_logic['coverage_required_for_family'] }}</td>
                                             <td>{{$medical_insurance_logic['approx_premium'] }}</td>
                                                 
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">No Data Found...</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
