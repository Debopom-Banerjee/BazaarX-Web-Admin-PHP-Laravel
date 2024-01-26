@extends('backend.layouts.empty') 
@section('title', 'Assumption Logics')
@section('content')
@php
/**
 * Assumption Logic 
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
                                    <th>Scenerio</th>
                                    <th>Expectancy</th>
                                    <th>Low Limit</th>
                                    <th>High Limit</th>
                                    <th>Year</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($assumption_logics->count() > 0)
                                    @foreach($assumption_logics as  $assumption_logic)
                                        <tr>
                                            <td>{{$assumption_logic['scenerio'] }}</td>
                                             <td>{{$assumption_logic['expectancy'] }}</td>
                                             <td>{{$assumption_logic['low_limit'] }}</td>
                                             <td>{{$assumption_logic['high_limit'] }}</td>
                                             <td>{{$assumption_logic['year'] }}</td>
                                                 
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
