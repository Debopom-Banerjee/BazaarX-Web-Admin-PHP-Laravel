@extends('backend.layouts.empty') 
@section('title', 'Debt Logics')
@section('content')
@php
/**
 * Debt Logic 
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
                                    <th>Institutions</th>
                                    <th>Type Of Bank</th>
                                    <th>Rate</th>
                                    <th>Period</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($debt_logics->count() > 0)
                                    @foreach($debt_logics as  $debt_logic)
                                        <tr>
                                            <td>{{$debt_logic['institutions'] }}</td>
                                             <td>{{$debt_logic['type_of_bank'] }}</td>
                                             <td>{{$debt_logic['rate'] }}</td>
                                             <td>{{$debt_logic['period'] }}</td>
                                                 
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
