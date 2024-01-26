@extends('backend.layouts.empty') 
@section('title', 'Requirements')
@section('content')
@php
/**
 * Requirement 
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
                                    <th>Category  </th>
                                    <th>Sub Category  </th>
                                    <th>Price</th>
                                    <th>Cunstomer Info</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Budget</th>
                                    <th>Type</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($requirements->count() > 0)
                                    @foreach($requirements as  $requirement)
                                        <tr>
                                            <td>{{$requirement['title'] }}</td>
                                                 <td>{{fetchFirst('App\Models\CategoryType',$requirement['category_id'],'name','--')}}</td>
                                                 <td>{{fetchFirst('App\Models\Category',$requirement['sub_category_id'],'name','--')}}</td>
                                             <td>{{$requirement['price'] }}</td>
                                             <td>{{$requirement['cunstomer_info'] }}</td>
                                             <td>{{$requirement['location'] }}</td>
                                             <td>{{$requirement['status'] }}</td>
                                             <td>{{$requirement['budget'] }}</td>
                                             <td>{{$requirement['type'] }}</td>
                                                 
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
