@extends('backend.layouts.empty') 
@section('title', 'User Advisories')
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
@endphp
   

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">                     
                    <div class="table-responsive">
                        <table id="table" class="table">
                            <thead>
                                <tr>                                      
                                    <th>User  </th>
                                    <th>User Detail</th>
                                    <th>Assests</th>
                                    <th>Liabilities</th>
                                    <th>Goals</th>
                                    <th>Budget</th>
                                    <th>Risk Assessment</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($user_advisories->count() > 0)
                                    @foreach($user_advisories as  $user_advisory)
                                        <tr>
                                                <td>{{fetchFirst('App\User',$user_advisory['user_id'],'name','--')}}</td>
                                             <td>{{$user_advisory['user_detail'] }}</td>
                                             <td>{{$user_advisory['assests'] }}</td>
                                             <td>{{$user_advisory['liabilities'] }}</td>
                                             <td>{{$user_advisory['goals'] }}</td>
                                             <td>{{$user_advisory['budget'] }}</td>
                                             <td>{{$user_advisory['risk_assessment'] }}</td>
                                                 
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
