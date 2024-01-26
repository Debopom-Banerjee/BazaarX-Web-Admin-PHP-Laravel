
@extends('backend.layouts.empty') 
@section('title', 'User Advisory')
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
    <!-- push external head elements to head -->
    @push('head')
    <link rel="stylesheet" href="{{ asset('backend/plugins/mohithg-switchery/dist/switchery.min.css') }}">
    <style>
        .error{
            color:red;
      }
        .parentForm:not(:first-of-type) {
            display: none
      }
        table {
        table-layout: fixed;
        width: 100%;
      }
       
    </style>
    @endpush

    <div class="container-fluid ">
      <div class="page-header">
        <div class="row align-items-end">
            <div class="col-12">
                <div class="page-header-title">
                    <i class="ik ik-grid bg-blue"></i>
                    <div class="d-inline">
                        <h5>#OID {{getPrefixZeros($order->id)}}</h5>
                        <span>{{$order->type}}</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mx-auto">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#PID</th>
                  <th>Title </th>
                </tr>
              </thead>
              <tbody>
                @if($order->service_data !=null)
                @foreach($order->service_data as $val)
                <tr>
                    <td>#{{getPrefixZeros($val['id'])}}</td>
                    <td>
                        <a class="text-dark"
                            @if($val['buy_link'] == null)
                                href="javascript:void(0)"
                            @else 
                                href="{{$val['buy_link']}}"
                            @endif
                        >
                            <h6>{{$val['title']}}</h6>
                        </a>
                    </td>
                </tr>    
                @endforeach
            @else
                <tr>
                    <td colspan="2">
                        <h6 class="text-danger text-center">No Data Found !</h6>
                    </td>
                </tr>
            @endif
              </tbody>
            </table>
        </div>
    </div>
@endsection