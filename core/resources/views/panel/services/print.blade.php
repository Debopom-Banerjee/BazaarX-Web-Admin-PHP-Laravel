@extends('backend.layouts.empty') 
@section('title', 'Services')
@section('content')
@php
/**
 * Service 
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Banner</th>
                                    <th>Is Publish</th>
                                    <th>Category Id</th>
                                    <th>Permission</th>
                                    <th>Price</th>
                                    <th>Mrp</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($services->count() > 0)
                                    @foreach($services as  $service)
                                        <tr>
                                            <td>{{$service['title'] }}</td>
                                             <td>{{$service['description'] }}</td>
                                             <td><a href="{{ asset($service['banner']) }}" target="_blank" class="btn-link">{{$service['banner'] }}</a></td>
                                             <td>{{$service['is_publish'] }}</td>
                                             <td>{{$service['category_id'] }}</td>
                                             <td>{{$service['permission'] }}</td>
                                             <td>{{$service['price'] }}</td>
                                             <td>{{$service['mrp'] }}</td>
                                                 
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
