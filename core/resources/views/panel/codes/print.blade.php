@extends('backend.layouts.empty') 
@section('title', 'Codes')
@section('content')
@php
/**
 * Code 
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
                                    <th>Code</th>
                                    <th>Expires At</th>
                                    <th>Type</th>
                                    <th>Precentage</th>
                                    <th>Max Uses</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($codes->count() > 0)
                                    @foreach($codes as  $code)
                                        <tr>
                                            <td>{{$code['code'] }}</td>
                                             <td>{{$code['expires_at'] }}</td>
                                             <td>{{$code['type'] }}</td>
                                             <td>{{$code['precentage'] }}</td>
                                             <td>{{$code['max_uses'] }}</td>
                                                 
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
