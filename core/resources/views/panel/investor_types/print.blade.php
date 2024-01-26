@extends('backend.layouts.empty') 
@section('title', 'Investor Types')
@section('content')
@php
/**
 * Investor Type 
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
                                    <th>Category</th>
                                    <th>Score</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($investor_types->count() > 0)
                                    @foreach($investor_types as  $investor_type)
                                        <tr>
                                            <td>{{$investor_type['category'] }}</td>
                                             <td>{{$investor_type['score'] }}</td>
                                                 
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
