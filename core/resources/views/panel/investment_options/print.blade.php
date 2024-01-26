@extends('backend.layouts.empty') 
@section('title', 'Investment Options')
@section('content')
@php
/**
 * Investment Option 
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
                                    <th>Mutual Fund</th>
                                    <th>Allocation</th>
                                    <th>Scrip Name</th>
                                    <th>Tenure</th>
                                    <th>Type</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($investment_options->count() > 0)
                                    @foreach($investment_options as  $investment_option)
                                        <tr>
                                            <td>{{$investment_option['mutual_fund'] }}</td>
                                             <td>{{$investment_option['allocation'] }}</td>
                                             <td>{{$investment_option['scrip_name'] }}</td>
                                             <td>{{$investment_option['tenure'] }}</td>
                                             <td>{{$investment_option['type'] }}</td>
                                                 
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
