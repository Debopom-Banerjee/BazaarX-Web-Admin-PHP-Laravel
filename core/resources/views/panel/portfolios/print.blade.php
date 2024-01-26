@extends('backend.layouts.empty') 
@section('title', 'Portfolios')
@section('content')
@php
/**
 * Portfolio 
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
                                    <th>Service  </th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Buy Link</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if($portfolios->count() > 0)
                                    @foreach($portfolios as  $portfolio)
                                        <tr>
                                                <td>{{fetchFirst('App\Models\Service',$portfolio['service_id'],'name','--')}}</td>
                                             <td>{{$portfolio['title'] }}</td>
                                             <td>{{$portfolio['description'] }}</td>
                                             <td>{{$portfolio['buy_link'] }}</td>
                                                 
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
